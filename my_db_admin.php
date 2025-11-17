<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Конфигурация нескольких баз данных
$databases_config = [
    [
        'name' => 'mars-games.ru',
        'host' => 'localhost',
        'user' => 'angreg_marsgame',
        'pass' => 'jeJeQLj8QkkF1',
        'dbname' => 'angreg_marsgame'
    ],
    [
        'name' => 'test.mars-games.ru',
        'host' => 'localhost',
        'user' => 'angreg_marsgame_',
        'pass' => 'jeJeQLj8QkkF1',
        'dbname' => 'angreg_marsgame_'
    ],
    [
        'name' => 'air.mars-games.ru',
        'host' => 'localhost',
        'user' => 'angreg_air',
        'pass' => 'jeJeQLj8QkkF1',
        'dbname' => 'angreg_air'
    ],
    [
        'name' => 'tank.mars-games.ru',
        'host' => 'localhost',
        'user' => 'oksiv92_tank',
        'pass' => 'jeJeQLj8QkkF1',
        'dbname' => 'oksiv92_tank'
    ],
    [
        'name' => 'vipmars.online',
        'host' => 'localhost',
        'user' => 'angreg_vip',
        'pass' => 'jeJeQLj8QkkF1',
        'dbname' => 'angreg_vip'
    ],
    [
        'name' => 'mars.vipmars.online',
        'host' => 'localhost',
        'user' => 'angreg_vip1',
        'pass' => 'jeJeQLj8QkkF1',
        'dbname' => 'angreg_vip1'
    ],
    [
        'name' => 'test2.vipmars.online',
        'host' => 'localhost',
        'user' => 'angreg_marsgame2',
        'pass' => 'jeJeQLj8QkkF1',
        'dbname' => 'angreg_marsgame2'
    ]
];

// Выбор текущей базы данных
$current_db_config = null;
$db_config_id = isset($_GET['db_config_id']) ? (int)$_GET['db_config_id'] : 0;
if (isset($databases_config[$db_config_id])) {
    $current_db_config = $databases_config[$db_config_id];
}

// Подключение к выбранной базе данных
$conn = null;
if ($current_db_config) {
    $conn = mysqli_connect(
        $current_db_config['host'],
        $current_db_config['user'],
        $current_db_config['pass'],
        $current_db_config['dbname']
    );
    if (!$conn) {
        die("Ошибка подключения к MySQL: " . mysqli_connect_error());
    }
}

// Настройки пагинации
$per_page = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 25;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $per_page;

// Параметры поиска
$search_field = isset($_GET['search_field']) ? $_GET['search_field'] : '';
$search_value = isset($_GET['search_value']) ? $_GET['search_value'] : '';

// Параметры сортировки
$sort_field = isset($_GET['sort']) ? $_GET['sort'] : '';
$sort_order = isset($_GET['order']) ? $_GET['order'] : 'ASC';

// Обработка изменения структуры таблицы
if (isset($_POST['alter_table'])) {
    $table = $_POST['table'];
    $alter_sql = $_POST['alter_sql'];
    
    $result = mysqli_query($conn, $alter_sql);
    if ($result) {
        header("Location: ?db_config_id=$db_config_id&table=" . urlencode($table) . "&action=structure");
        exit;
    } else {
        $error = mysqli_error($conn);
    }
}

// Обработка удаления записи
if (isset($_GET['delete'])) {
    $table = $_GET['table'];
    $id_field = $_GET['id_field'];
    $id_value = $_GET['id'];
    
    $sql = "DELETE FROM `$table` WHERE `$id_field` = '" . mysqli_real_escape_string($conn, $id_value) . "'";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        header("Location: ?db_config_id=$db_config_id&table=" . urlencode($table) . "&action=browse&page=$page&per_page=$per_page");
        exit;
    } else {
        $error = mysqli_error($conn);
    }
}

// Обработка массового удаления записей
if (isset($_POST['delete_selected'])) {
    $table = $_POST['table'];
    $id_field = $_POST['id_field'];
    $selected_ids = isset($_POST['selected_ids']) ? $_POST['selected_ids'] : [];
    
    if (!empty($selected_ids)) {
        $ids = array_map(function($id) use ($conn) {
            return "'" . mysqli_real_escape_string($conn, $id) . "'";
        }, $selected_ids);
        
        $sql = "DELETE FROM `$table` WHERE `$id_field` IN (" . implode(',', $ids) . ")";
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            header("Location: ?db_config_id=$db_config_id&table=" . urlencode($table) . "&action=browse&page=$page&per_page=$per_page");
            exit;
        } else {
            $error = mysqli_error($conn);
        }
    }
}

// Обработка очистки таблицы
if (isset($_GET['truncate'])) {
    $table = $_GET['table'];
    
    $sql = "TRUNCATE TABLE `$table`";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        header("Location: ?db_config_id=$db_config_id&table=" . urlencode($table) . "&action=browse");
        exit;
    } else {
        $error = mysqli_error($conn);
    }
}

// Обработка оптимизации таблицы
if (isset($_GET['optimize'])) {
    $table = $_GET['table'];
    
    $sql = "OPTIMIZE TABLE `$table`";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        header("Location: ?db_config_id=$db_config_id&table=" . urlencode($table) . "&action=structure");
        exit;
    } else {
        $error = mysqli_error($conn);
    }
}

// Обработка массовых действий с таблицами
if (isset($_POST['bulk_table_action'])) {
    $action = $_POST['bulk_action'];
    $selected_tables = isset($_POST['selected_tables']) ? $_POST['selected_tables'] : [];
    
    if (!empty($selected_tables)) {
        foreach ($selected_tables as $table) {
            $table = mysqli_real_escape_string($conn, $table);
            
            if ($action == 'drop') {
                $sql = "DROP TABLE `$table`";
            } elseif ($action == 'truncate') {
                $sql = "TRUNCATE TABLE `$table`";
            } elseif ($action == 'optimize') {
                $sql = "OPTIMIZE TABLE `$table`";
            }
            
            mysqli_query($conn, $sql);
        }
        
        header("Location: ?db_config_id=$db_config_id");
        exit;
    }
}

// Обработка экспорта выбранных таблиц
if (isset($_GET['export_selected'])) {
    $selected_tables = isset($_GET['tables']) ? explode(',', $_GET['tables']) : [];
    
    if (!empty($selected_tables)) {
        $return = '';
        foreach ($selected_tables as $table) {
            $table = mysqli_real_escape_string($conn, $table);
            $result = mysqli_query($conn, "SELECT * FROM `$table`");
            $num_fields = mysqli_num_fields($result);
            
            $return .= "DROP TABLE IF EXISTS `$table`;\n";
            $row2 = mysqli_fetch_row(mysqli_query($conn, "SHOW CREATE TABLE `$table`"));
            $return .= $row2[1] . ";\n\n";
            
            for ($i = 0; $i < $num_fields; $i++) {
                while ($row = mysqli_fetch_row($result)) {
                    $return .= "INSERT INTO `$table` VALUES(";
                    for ($j = 0; $j < $num_fields; $j++) {
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = str_replace("\n", "\\n", $row[$j]);
                        if (isset($row[$j])) {
                            $return .= '"' . $row[$j] . '"';
                        } else {
                            $return .= '""';
                        }
                        if ($j < ($num_fields - 1)) {
                            $return .= ',';
                        }
                    }
                    $return .= ");\n";
                }
            }
            $return .= "\n\n";
        }
        
        // Сохранение файла
        $filename = $current_db_config['name'] . '_selected_' . date('Y-m-d') . '.sql';
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        echo $return;
        exit;
    }
}

// Обработка обновления записи
if (isset($_POST['update_record'])) {
    $table = $_POST['table'];
    $id_field = $_POST['id_field'];
    $id_value = $_POST['id_value'];
    
    $update_fields = [];
    foreach ($_POST as $field => $value) {
        if (strpos($field, 'field_') === 0 && $field != 'field_' . $id_field) {
            $field_name = substr($field, 6);
            $update_fields[] = "`$field_name` = '" . mysqli_real_escape_string($conn, $value) . "'";
        }
    }
    
    $sql = "UPDATE `$table` SET " . implode(', ', $update_fields) . " WHERE `$id_field` = '$id_value'";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        header("Location: ?db_config_id=$db_config_id&table=" . urlencode($table) . "&action=browse&page=$page&per_page=$per_page");
        exit;
    } else {
        $error = mysqli_error($conn);
    }
}

// Обработка добавления записи
if (isset($_POST['add_record'])) {
    $table = $_POST['table'];
    
    $fields = [];
    $values = [];
    foreach ($_POST as $field => $value) {
        if (strpos($field, 'new_field_') === 0) {
            $field_name = substr($field, 10);
            $fields[] = "`$field_name`";
            $values[] = "'" . mysqli_real_escape_string($conn, $value) . "'";
        }
    }
    
    $sql = "INSERT INTO `$table` (" . implode(', ', $fields) . ") VALUES (" . implode(', ', $values) . ")";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        header("Location: ?db_config_id=$db_config_id&table=" . urlencode($table) . "&action=browse&page=$page&per_page=$per_page");
        exit;
    } else {
        $error = mysqli_error($conn);
    }
}

// Обработка экспорта базы данных
if (isset($_GET['export'])) {
    $tables = [];
    $tables_result = mysqli_query($conn, "SHOW TABLES");
    while ($row = mysqli_fetch_row($tables_result)) {
        $tables[] = $row[0];
    }
    
    $return = '';
    foreach ($tables as $table) {
        $result = mysqli_query($conn, "SELECT * FROM `$table`");
        $num_fields = mysqli_num_fields($result);
        
        $return .= "DROP TABLE IF EXISTS `$table`;\n";
        $row2 = mysqli_fetch_row(mysqli_query($conn, "SHOW CREATE TABLE `$table`"));
        $return .= $row2[1] . ";\n\n";
        
        for ($i = 0; $i < $num_fields; $i++) {
            while ($row = mysqli_fetch_row($result)) {
                $return .= "INSERT INTO `$table` VALUES(";
                for ($j = 0; $j < $num_fields; $j++) {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = str_replace("\n", "\\n", $row[$j]);
                    if (isset($row[$j])) {
                        $return .= '"' . $row[$j] . '"';
                    } else {
                        $return .= '""';
                    }
                    if ($j < ($num_fields - 1)) {
                        $return .= ',';
                    }
                }
                $return .= ");\n";
            }
        }
        $return .= "\n\n";
    }
    
    // Сохранение файла
    $filename = $current_db_config['name'] . '_' . date('Y-m-d') . '.sql';
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    echo $return;
    exit;
}

// Обработка импорта базы данных
if (isset($_POST['import'])) {
    if (isset($_FILES['sql_file']) && $_FILES['sql_file']['error'] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['sql_file']['tmp_name'];
        $content = file_get_contents($tmp_name);
        
        // Выполнение SQL запросов из файла
        $queries = explode(';', $content);
        foreach ($queries as $query) {
            if (trim($query) != '') {
                mysqli_query($conn, $query);
            }
        }
        
        header("Location: ?db_config_id=$db_config_id");
        exit;
    } else {
        $error = "Ошибка загрузки файла";
    }
}

// Выполнение SQL запросов
$result = null;
$error = '';
if (isset($_POST['sql_query']) && !empty($_POST['sql'])) {
    $sql = $_POST['sql'];
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        $error = mysqli_error($conn);
    }
}

// Действия с таблицами
$current_table = '';
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $current_table = isset($_GET['table']) ? $_GET['table'] : '';
    
    if ($action == 'browse' && !empty($current_table)) {
        // Получаем список всех полей таблицы для поиска и сортировки
        $fields_result = mysqli_query($conn, "DESCRIBE `$current_table`");
        $all_fields = [];
        while ($field = mysqli_fetch_assoc($fields_result)) {
            $all_fields[] = $field['Field'];
        }
        
        // Условие поиска
        $where = '';
        if ($search_field && $search_value && in_array($search_field, $all_fields)) {
            $search_field = mysqli_real_escape_string($conn, $search_field);
            $search_value = mysqli_real_escape_string($conn, $search_value);
            $where = " WHERE `$search_field` LIKE '%$search_value%'";
        }
        
        // Сортировка
        $order_by = '';
        if ($sort_field && in_array($sort_field, $all_fields)) {
            $sort_field = mysqli_real_escape_string($conn, $sort_field);
            $sort_order = strtoupper($sort_order) == 'DESC' ? 'DESC' : 'ASC';
            $order_by = " ORDER BY `$sort_field` $sort_order";
        }
        
        // Получаем общее количество записей для пагинации
        $count_result = mysqli_query($conn, "SELECT COUNT(*) FROM `$current_table` $where");
        $total_rows = mysqli_fetch_row($count_result)[0];
        $total_pages = ceil($total_rows / $per_page);
        
        // Получаем данные с учетом пагинации, поиска и сортировки
        $sql = "SELECT * FROM `$current_table` $where $order_by LIMIT $offset, $per_page";
        $result = mysqli_query($conn, $sql);
        
        // Сохраняем список всех полей для использования в интерфейсе
        $table_fields = $all_fields;
    } elseif ($action == 'structure' && !empty($current_table)) {
        $result = mysqli_query($conn, "DESCRIBE `$current_table`");
    } elseif ($action == 'drop' && !empty($current_table)) {
        $result = mysqli_query($conn, "DROP TABLE `$current_table`");
        if ($result) {
            header("Location: ?db_config_id=$db_config_id");
            exit;
        } else {
            $error = mysqli_error($conn);
        }
    } elseif ($action == 'edit' && !empty($current_table) && !empty($_GET['id'])) {
        $id_field = $_GET['id_field'];
        $id_value = $_GET['id'];
        $edit_result = mysqli_query($conn, "SELECT * FROM `$current_table` WHERE `$id_field` = '$id_value' LIMIT 1");
        $edit_row = mysqli_fetch_assoc($edit_result);
    } elseif ($action == 'add' && !empty($current_table)) {
        $structure_result = mysqli_query($conn, "DESCRIBE `$current_table`");
        $structure = [];
        while ($row = mysqli_fetch_assoc($structure_result)) {
            $structure[] = $row;
        }
    }
}

// Получение списка таблиц в текущей базе
$tables = [];
$tables_need_optimize = [];
if ($conn && !empty($current_db_config['dbname'])) {
    $tables_result = mysqli_query($conn, "SHOW TABLES");
    while ($row = mysqli_fetch_row($tables_result)) {
        $tables[] = $row[0];
    }
    
    // Проверка таблиц, требующих оптимизации
    $status_result = mysqli_query($conn, "SHOW TABLE STATUS");
    while ($row = mysqli_fetch_assoc($status_result)) {
        if ($row['Data_free'] > 0) {
            $tables_need_optimize[] = $row['Name'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Усовершенствованная панель MySQL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .sidebar {
            background-color: #343a40;
            color: white;
            height: 100vh;
            position: fixed;
            padding-top: 20px;
            overflow-y: auto;
            transition: all 0.3s;
            z-index: 1000;
        }
        .sidebar-collapsed {
            width: 50px;
            overflow: hidden;
        }
        .sidebar-collapsed .sidebar-content {
            display: none;
        }
        .sidebar-resizer {
            width: 5px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: <?= isset($_COOKIE['sidebarWidth']) ? $_COOKIE['sidebarWidth'] : '250' ?>px;
            background-color: #495057;
            cursor: col-resize;
            z-index: 1001;
            transition: all 0.3s;
        }
        .sidebar-collapsed + .sidebar-resizer {
            left: 50px;
        }
        .main-content {
            margin-left: <?= (isset($_COOKIE['sidebarWidth']) ? (int)$_COOKIE['sidebarWidth'] + 5 : 255) ?>px;
            padding: 20px;
            transition: all 0.3s;
        }
        .sidebar-collapsed ~ .main-content {
            margin-left: 55px;
        }
        .sql-editor {
            font-family: 'Courier New', Courier, monospace;
            font-size: 14px;
        }
        .table-container {
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            padding: 20px;
            margin-bottom: 20px;
            max-height: 70vh;
            overflow-y: auto;
        }
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
        .breadcrumb {
            background-color: transparent;
            padding: 0;
        }
        .action-btns .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        .pagination .page-item.active .page-link {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .pagination .page-link {
            color: #6c757d;
        }
        .structure-edit-form {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .fixed-header {
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 10;
        }
        .sortable {
            cursor: pointer;
        }
        .sortable:hover {
            background-color: #f1f1f1;
        }
        .sort-asc::after {
            content: " ↑";
            font-size: 0.8em;
        }
        .sort-desc::after {
            content: " ↓";
            font-size: 0.8em;
        }
        .table-checkbox {
            width: 20px;
            height: 20px;
        }
        .toggle-sidebar {
            position: absolute;
            right: 10px;
            top: 10px;
            color: white;
            cursor: pointer;
        }
        .sidebar-collapsed .toggle-sidebar {
            right: 5px;
        }
        .table-actions {
            margin-bottom: 15px;
        }
        .logo {
            text-align: center;
            padding: 0 10px;
        }
        .logo h4 {
            margin-bottom: 0;
        }
        .section-title {
            text-align: center;
            padding: 0 10px;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .table-actions-buttons {
            display: flex;
            gap: 5px;
            margin-bottom: 10px;
        }
        .table-actions-buttons .btn {
            flex: 1;
        }
        .table-list-item {
            position: relative;
        }
        .table-list-item .table-checkbox {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
        }
        .table-list-item a {
            display: block;
            padding-left: 35px;
        }
    </style>
</head>
<body>
    <div class="sidebar <?= isset($_COOKIE['sidebarCollapsed']) && $_COOKIE['sidebarCollapsed'] === 'true' ? 'sidebar-collapsed' : '' ?>" id="sidebar" style="width: <?= isset($_COOKIE['sidebarWidth']) ? $_COOKIE['sidebarWidth'] : '250' ?>px">
        <div class="sidebar-content">
            <div class="logo mb-4">
                <h4><i class="bi bi-database"></i> <span class="sidebar-text">MySQL Admin</span></h4>
            </div>
            
            <h5 class="section-title sidebar-text">Базы данных</h5>
            <div class="list-group">
                <?php foreach ($databases_config as $id => $db): ?>
                    <a href="?db_config_id=<?= $id ?>" 
                       class="list-group-item list-group-item-action <?= $db_config_id == $id ? 'active' : '' ?>">
                       <i class="bi bi-database"></i> <span class="sidebar-text"><?= htmlspecialchars($db['name']) ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
            
            <?php if ($conn && !empty($tables)): ?>
                <h5 class="section-title sidebar-text">Таблицы</h5>
                <form method="post" id="bulkTableForm">
                    <input type="hidden" name="bulk_table_action" value="1">
                    <div class="table-actions mb-2">
                        <select class="form-select form-select-sm" name="bulk_action">
                            <option value="">Действие</option>
                            <option value="drop">Удалить</option>
                            <option value="truncate">Очистить</option>
                            <option value="optimize">Оптимизировать</option>
                        </select>
                        <div class="table-actions-buttons">
                            <button type="button" class="btn btn-sm btn-outline-secondary" id="selectAllTables">
                                <i class="bi bi-check-all"></i> Все
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-info" id="selectNeedOptimize">
                                <i class="bi bi-speedometer2"></i> Оптимизировать
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-success" id="exportSelectedTables">
                                <i class="bi bi-download"></i> Экспорт
                            </button>
                        </div>
                        <button type="submit" class="btn btn-sm btn-danger mt-2 w-100" onclick="return confirm('Вы уверены?')">
                            Применить
                        </button>
                    </div>
                    <div class="list-group">
                        <?php 
                        usort($tables, function($a, $b) {
                            return strcasecmp($a, $b);
                        });
                        foreach ($tables as $table): ?>
                            <div class="list-group-item list-group-item-action <?= $table == $current_table ? 'active' : '' ?> table-list-item">
                                <input type="checkbox" class="form-check-input table-checkbox" name="selected_tables[]" value="<?= htmlspecialchars($table) ?>" <?= in_array($table, $tables_need_optimize) ? 'data-need-optimize="true"' : '' ?>>
                                <a href="?db_config_id=<?= $db_config_id ?>&table=<?= urlencode($table) ?>&action=browse" class="text-decoration-none text-reset">
                                    <i class="bi bi-table"></i> <span class="sidebar-text"><?= htmlspecialchars($table) ?></span>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </form>
            <?php endif; ?>
            
            <?php if ($conn): ?>
                <div class="mt-3">
                    <a href="?db_config_id=<?= $db_config_id ?>&export=1" class="btn btn-sm btn-success w-100 sidebar-text">
                        <i class="bi bi-download"></i> <span class="sidebar-text">Экспорт БД</span>
                    </a>
                </div>
                <div class="mt-2">
                    <button class="btn btn-sm btn-primary w-100 sidebar-text" data-bs-toggle="modal" data-bs-target="#importModal">
                        <i class="bi bi-upload"></i> <span class="sidebar-text">Импорт БД</span>
                    </button>
                </div>
            <?php endif; ?>
        </div>
        <div class="toggle-sidebar" id="toggleSidebar">
            <i class="bi bi-chevron-<?= isset($_COOKIE['sidebarCollapsed']) && $_COOKIE['sidebarCollapsed'] === 'true' ? 'right' : 'left' ?>"></i>
        </div>
    </div>
    
    <div class="sidebar-resizer" id="sidebarResizer"></div>

    <!-- Основное содержимое -->
    <main class="main-content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="?db_config_id=<?= $db_config_id ?>"><i class="bi bi-house-door"></i></a></li>
                    <?php if (!empty($current_db_config['name'])): ?>
                        <li class="breadcrumb-item"><?= htmlspecialchars($current_db_config['name']) ?></li>
                    <?php endif; ?>
                    <?php if (!empty($current_table)): ?>
                        <li class="breadcrumb-item active"><?= htmlspecialchars($current_table) ?></li>
                    <?php endif; ?>
                </ol>
            </nav>
            <div class="btn-toolbar mb-2 mb-md-0">
                <?php if (!empty($current_table)): ?>
                    <div class="btn-group me-2">
                        <a href="?db_config_id=<?= $db_config_id ?>&table=<?= urlencode($current_table) ?>&action=browse" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-list-ul"></i> Данные
                        </a>
                        <a href="?db_config_id=<?= $db_config_id ?>&table=<?= urlencode($current_table) ?>&action=structure" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-gear"></i> Структура
                        </a>
                        <a href="?db_config_id=<?= $db_config_id ?>&table=<?= urlencode($current_table) ?>&action=add" class="btn btn-sm btn-outline-success">
                            <i class="bi bi-plus-circle"></i> Добавить
                        </a>
                        <a href="?db_config_id=<?= $db_config_id ?>&table=<?= urlencode($current_table) ?>&truncate=1" class="btn btn-sm btn-outline-warning" onclick="return confirm('Очистить таблицу <?= htmlspecialchars(addslashes($current_table)) ?>? Все данные будут удалены!')">
                            <i class="bi bi-trash"></i> Очистить
                        </a>
                        <a href="?db_config_id=<?= $db_config_id ?>&table=<?= urlencode($current_table) ?>&optimize=1" class="btn btn-sm btn-outline-info">
                            <i class="bi bi-speedometer2"></i> Оптимизировать
                        </a>
                        <a href="?db_config_id=<?= $db_config_id ?>&table=<?= urlencode($current_table) ?>&action=drop" class="btn btn-sm btn-outline-danger" onclick="return confirm('Удалить таблицу <?= htmlspecialchars(addslashes($current_table)) ?>?')">
                            <i class="bi bi-trash"></i> Удалить
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">Ошибка: <?= htmlspecialchars($error) ?></div>
        <?php elseif (isset($result) && $result !== false && !isset($_GET['action'])): ?>
            <div class="alert alert-success">Запрос выполнен успешно</div>
        <?php endif; ?>

        <!-- Форма SQL запроса -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-code-slash"></i> SQL запрос</h5>
                <form method="post">
                    <div class="mb-3">
                        <textarea class="form-control sql-editor" name="sql" rows="4" placeholder="Введите SQL запрос..."><?= isset($_POST['sql']) ? htmlspecialchars($_POST['sql']) : '' ?></textarea>
                    </div>
                    <button type="submit" name="sql_query" class="btn btn-primary">
                        <i class="bi bi-play-circle"></i> Выполнить
                    </button>
                </form>
            </div>
        </div>

        <!-- Форма поиска -->
        <?php if (isset($_GET['action']) && $_GET['action'] == 'browse' && !empty($current_table)): ?>
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-search"></i> Поиск по таблице</h5>
                    <form method="get">
                        <input type="hidden" name="db_config_id" value="<?= $db_config_id ?>">
                        <input type="hidden" name="table" value="<?= htmlspecialchars($current_table) ?>">
                        <input type="hidden" name="action" value="browse">
                        <input type="hidden" name="sort" value="<?= htmlspecialchars($sort_field) ?>">
                        <input type="hidden" name="order" value="<?= htmlspecialchars($sort_order) ?>">
                        
                        <div class="row g-2">
                            <div class="col-md-4">
                                <select class="form-select" name="search_field">
                                    <option value="">Выберите поле для поиска</option>
                                    <?php if (isset($table_fields)): ?>
                                        <?php foreach ($table_fields as $field): ?>
                                            <option value="<?= htmlspecialchars($field) ?>" 
                                                <?= $search_field == $field ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($field) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="search_value" 
                                       value="<?= htmlspecialchars($search_value) ?>" 
                                       placeholder="Введите значение для поиска">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-search"></i> Найти
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <!-- Редактирование структуры таблицы -->
        <?php if (isset($_GET['action']) && $_GET['action'] == 'structure' && !empty($current_table)): ?>
            <div class="card mb-4">
                <div class="card-body structure-edit-form">
                    <h5 class="card-title"><i class="bi bi-pencil-square"></i> Редактирование структуры таблицы</h5>
                    <?php
                    $structure_result = mysqli_query($conn, "SHOW CREATE TABLE `$current_table`");
                    $structure_row = mysqli_fetch_assoc($structure_result);
                    $create_table_sql = $structure_row['Create Table'];
                    ?>
                    <form method="post">
                        <input type="hidden" name="alter_table" value="1">
                        <input type="hidden" name="table" value="<?= htmlspecialchars($current_table) ?>">
                        
                        <div class="mb-3">
                            <label class="form-label">SQL для изменения структуры:</label>
                            <textarea class="form-control" name="alter_sql" rows="5" placeholder="ALTER TABLE `<?= htmlspecialchars($current_table) ?>` ..."></textarea>
                            <small class="form-text text-muted">
                                Примеры: <br>
                                ADD COLUMN `new_column` INT NULL AFTER `existing_column`<br>
                                MODIFY COLUMN `column_name` VARCHAR(255) NOT NULL<br>
                                DROP COLUMN `column_name`
                            </small>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Текущая структура таблицы:</label>
                            <pre class="bg-light p-3"><?= htmlspecialchars($create_table_sql) ?></pre>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Применить изменения
                        </button>
                        <a href="?db_config_id=<?= $db_config_id ?>&table=<?= urlencode($current_table) ?>&action=structure" class="btn btn-secondary">
                            <i class="bi bi-arrow-counterclockwise"></i> Обновить
                        </a>
                    </form>
                </div>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-list-check"></i> Структура таблицы</h5>
                    <div class="table-container">
                        <table class="table table-hover">
                            <thead class="fixed-header">
                                <tr>
                                    <th>Поле</th>
                                    <th>Тип</th>
                                    <th>NULL</th>
                                    <th>Ключ</th>
                                    <th>По умолчанию</th>
                                    <th>Дополнительно</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $structure_result = mysqli_query($conn, "DESCRIBE `$current_table`");
                                while ($row = mysqli_fetch_assoc($structure_result)): ?>
                                    <tr>
                                        <td><strong><?= htmlspecialchars($row['Field']) ?></strong></td>
                                        <td><?= htmlspecialchars($row['Type']) ?></td>
                                        <td><?= htmlspecialchars($row['Null']) ?></td>
                                        <td><?= htmlspecialchars($row['Key']) ?></td>
                                        <td><?= htmlspecialchars($row['Default']) ?></td>
                                        <td><?= htmlspecialchars($row['Extra']) ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Форма добавления записи -->
        <?php if (isset($_GET['action']) && $_GET['action'] == 'add' && isset($structure)): ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-plus-circle"></i> Добавление новой записи</h5>
                    <form method="post">
                        <input type="hidden" name="add_record" value="1">
                        <input type="hidden" name="table" value="<?= htmlspecialchars($current_table) ?>">
                        
                        <div class="table-container">
                            <table class="table">
                                <thead class="fixed-header">
                                    <tr>
                                        <th>Поле</th>
                                        <th>Значение</th>
                                        <th>Тип</th>
                                        <th>NULL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($structure as $field): ?>
                                        <?php if ($field['Extra'] != 'auto_increment'): ?>
                                            <tr>
                                                <td><strong><?= htmlspecialchars($field['Field']) ?></strong></td>
                                                <td>
                                                    <input type="text" class="form-control" name="new_field_<?= htmlspecialchars($field['Field']) ?>" value="">
                                                </td>
                                                <td><?= htmlspecialchars($field['Type']) ?></td>
                                                <td><?= htmlspecialchars($field['Null']) ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="text-end mt-3">
                            <a href="?db_config_id=<?= $db_config_id ?>&table=<?= urlencode($current_table) ?>&action=browse&page=<?= $page ?>&per_page=<?= $per_page ?>" class="btn btn-secondary me-2">
                                <i class="bi bi-x-circle"></i> Отмена
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Сохранить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <!-- Форма редактирования записи -->
        <?php if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($edit_row)): ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-pencil-square"></i> Редактирование записи</h5>
                    <form method="post">
                        <input type="hidden" name="update_record" value="1">
                        <input type="hidden" name="table" value="<?= htmlspecialchars($current_table) ?>">
                        <input type="hidden" name="id_field" value="<?= htmlspecialchars($_GET['id_field']) ?>">
                        <input type="hidden" name="id_value" value="<?= htmlspecialchars($_GET['id']) ?>">
                        
                        <div class="table-container">
                            <table class="table">
                                <thead class="fixed-header">
                                    <tr>
                                        <th>Поле</th>
                                        <th>Значение</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($edit_row as $field => $value): ?>
                                        <tr>
                                            <td><strong><?= htmlspecialchars($field) ?></strong></td>
                                            <td>
                                                <?php if ($field == $_GET['id_field']): ?>
                                                    <?= htmlspecialchars($value) ?>
                                                <?php else: ?>
                                                    <input type="text" class="form-control" name="field_<?= htmlspecialchars($field) ?>" value="<?= htmlspecialchars($value) ?>">
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="text-end mt-3">
                            <a href="?db_config_id=<?= $db_config_id ?>&table=<?= urlencode($current_table) ?>&action=browse&page=<?= $page ?>&per_page=<?= $per_page ?>" class="btn btn-secondary me-2">
                                <i class="bi bi-x-circle"></i> Отмена
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Сохранить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <!-- Результаты запроса -->
        <?php if (isset($result) && $result !== false && !in_array($_GET['action'] ?? '', ['add', 'edit', 'structure'])): ?>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-table"></i> 
                            <?php if ($_GET['action'] == 'browse'): ?>
                                Данные таблицы <?= htmlspecialchars($current_table) ?>
                                <?php if ($search_field && $search_value): ?>
                                    <small class="text-muted">(фильтр: <?= htmlspecialchars($search_field) ?> = <?= htmlspecialchars($search_value) ?>)</small>
                                <?php endif; ?>
                            <?php else: ?>
                                Результаты запроса
                            <?php endif; ?>
                        </h5>
                        
                        <?php if ($_GET['action'] == 'browse'): ?>
                            <form class="d-flex align-items-center">
                                <input type="hidden" name="db_config_id" value="<?= $db_config_id ?>">
                                <input type="hidden" name="table" value="<?= htmlspecialchars($current_table) ?>">
                                <input type="hidden" name="action" value="browse">
                                <input type="hidden" name="search_field" value="<?= htmlspecialchars($search_field) ?>">
                                <input type="hidden" name="search_value" value="<?= htmlspecialchars($search_value) ?>">
                                <input type="hidden" name="sort" value="<?= htmlspecialchars($sort_field) ?>">
                                <input type="hidden" name="order" value="<?= htmlspecialchars($sort_order) ?>">
                                
                                <label for="per_page" class="me-2">Строк на странице:</label>
                                <select class="form-select form-select-sm" name="per_page" style="width: 80px;" onchange="this.form.submit()">
                                    <option value="10" <?= $per_page == 10 ? 'selected' : '' ?>>10</option>
                                    <option value="25" <?= $per_page == 25 ? 'selected' : '' ?>>25</option>
                                    <option value="50" <?= $per_page == 50 ? 'selected' : '' ?>>50</option>
                                    <option value="100" <?= $per_page == 100 ? 'selected' : '' ?>>100</option>
                                </select>
                            </form>
                        <?php endif; ?>
                    </div>
                    
                    <?php if ($_GET['action'] == 'browse'): ?>
                        <form method="post" id="bulkForm" class="mb-3">
                            <input type="hidden" name="delete_selected" value="1">
                            <input type="hidden" name="table" value="<?= htmlspecialchars($current_table) ?>">
                            <input type="hidden" name="id_field" value="<?= htmlspecialchars($fields[0]->name) ?>">
                            <div class="d-flex justify-content-between">
 _
                                <div>
                                    <span id="selectedCount">0</span> выбрано
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>
                    
                    <div class="table-container">
                        <table class="table table-hover">
                            <thead class="fixed-header">
                                <tr>
                                    <?php if ($_GET['action'] == 'browse'): ?>
                                        <th><input type="checkbox" class="form-check-input" id="selectAll"></th>
                                    <?php endif; ?>
                                    <?php
                                    $fields = mysqli_fetch_fields($result);
                                    foreach ($fields as $field): ?>
                                        <th class="sortable <?= $sort_field == $field->name ? ($sort_order == 'ASC' ? 'sort-asc' : 'sort-desc') : '' ?>"
                                            onclick="window.location='?db_config_id=<?= $db_config_id ?>&table=<?= urlencode($current_table) ?>&action=browse&page=1&per_page=<?= $per_page ?>&search_field=<?= urlencode($search_field) ?>&search_value=<?= urlencode($search_value) ?>&sort=<?= urlencode($field->name) ?>&order=<?= $sort_field == $field->name && $sort_order == 'ASC' ? 'DESC' : 'ASC' ?>'">
                                            <?= htmlspecialchars($field->name) ?>
                                        </th>
                                    <?php endforeach; ?>
                                    <?php if ($_GET['action'] == 'browse'): ?>
                                        <th>Действия</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                mysqli_data_seek($result, 0); // Сброс указателя результата
                                while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <?php if ($_GET['action'] == 'browse'): ?>
                                            <td><input type="checkbox" class="form-check-input row-checkbox" name="selected_ids[]" value="<?= htmlspecialchars($row[$fields[0]->name]) ?>"></td>
                                        <?php endif; ?>
                                        <?php foreach ($row as $value): ?>
                                            <td><?= htmlspecialchars($value) ?></td>
                                        <?php endforeach; ?>
                                        
                                        <?php if ($_GET['action'] == 'browse'): ?>
                                            <td class="action-btns">
                                                <?php
                                                $id_field = $fields[0]->name;
                                                $id_value = $row[$id_field];
                                                ?>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="?db_config_id=<?= $db_config_id ?>&table=<?= urlencode($current_table) ?>&action=edit&id=<?= urlencode($id_value) ?>&id_field=<?= urlencode($id_field) ?>&page=<?= $page ?>&per_page=<?= $per_page ?>&search_field=<?= urlencode($search_field) ?>&search_value=<?= urlencode($search_value) ?>&sort=<?= urlencode($sort_field) ?>&order=<?= urlencode($sort_order) ?>" class="btn btn-outline-primary" title="Редактировать">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <a href="?db_config_id=<?= $db_config_id ?>&table=<?= urlencode($current_table) ?>&action=browse&delete=1&id=<?= urlencode($id_value) ?>&id_field=<?= urlencode($id_field) ?>&page=<?= $page ?>&per_page=<?= $per_page ?>&search_field=<?= urlencode($search_field) ?>&search_value=<?= urlencode($search_value) ?>&sort=<?= urlencode($sort_field) ?>&order=<?= urlencode($sort_order) ?>" class="btn btn-outline-danger" title="Удалить" onclick="return confirm('Удалить запись?')">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <?php if ($_GET['action'] == 'browse' && isset($total_pages) && $total_pages > 1): ?>
                        <nav aria-label="Page navigation" class="mt-3">
                            <ul class="pagination justify-content-center">
                                <?php if ($page > 1): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?db_config_id=<?= $db_config_id ?>&table=<?= urlencode($current_table) ?>&action=browse&page=<?= $page-1 ?>&per_page=<?= $per_page ?>&search_field=<?= urlencode($search_field) ?>&search_value=<?= urlencode($search_value) ?>&sort=<?= urlencode($sort_field) ?>&order=<?= urlencode($sort_order) ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                
                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                        <a class="page-link" href="?db_config_id=<?= $db_config_id ?>&table=<?= urlencode($current_table) ?>&action=browse&page=<?= $i ?>&per_page=<?= $per_page ?>&search_field=<?= urlencode($search_field) ?>&search_value=<?= urlencode($search_value) ?>&sort=<?= urlencode($sort_field) ?>&order=<?= urlencode($sort_order) ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>
                                
                                <?php if ($page < $total_pages): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?db_config_id=<?= $db_config_id ?>&table=<?= urlencode($current_table) ?>&action=browse&page=<?= $page+1 ?>&per_page=<?= $per_page ?>&search_field=<?= urlencode($search_field) ?>&search_value=<?= urlencode($search_value) ?>&sort=<?= urlencode($sort_field) ?>&order=<?= urlencode($sort_order) ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </main>

    <!-- Модальное окно импорта -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Импорт базы данных</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="sqlFile" class="form-label">Выберите SQL файл</label>
                            <input class="form-control" type="file" id="sqlFile" name="sql_file" accept=".sql">
                        </div>
                        <div class="alert alert-warning">
                            <strong>Внимание!</strong> Импорт перезапишет существующие таблицы с такими же именами.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="import" value="1">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary">Импортировать</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Фиксация заголовков таблиц при прокрутке
        document.addEventListener('DOMContentLoaded', function() {
            const tables = document.querySelectorAll('.table-container');
            tables.forEach(table => {
                const thead = table.querySelector('thead');
                if (thead) {
                    const originalOffset = thead.getBoundingClientRect().top;
                    
                    table.addEventListener('scroll', function() {
                        const scrollTop = table.scrollTop;
                        if (scrollTop > 0) {
                            thead.style.transform = `translateY(${scrollTop}px)`;
                        } else {
                            thead.style.transform = 'none';
                        }
                    });
                }
            });
            
            // Выделение всех строк в таблице данных
            const selectAll = document.getElementById('selectAll');
            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    const checkboxes = document.querySelectorAll('.row-checkbox');
                    const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
                    
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = !allChecked;
                    });
                    updateSelectedCount();
                });
            }
            
            // Обновление счетчика выбранных строк
            function updateSelectedCount() {
                const checkboxes = document.querySelectorAll('.row-checkbox:checked');
                document.getElementById('selectedCount').textContent = checkboxes.length;
                
                // Обновляем состояние главного чекбокса
                if (selectAll) {
                    const allCheckboxes = document.querySelectorAll('.row-checkbox');
                    const allChecked = Array.from(allCheckboxes).every(checkbox => checkbox.checked);
                    selectAll.checked = allChecked;
                }
            }
            
            const rowCheckboxes = document.querySelectorAll('.row-checkbox');
            rowCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSelectedCount);
            });
            
            // Выделение всех таблиц
            const selectAllTables = document.getElementById('selectAllTables');
            if (selectAllTables) {
                selectAllTables.addEventListener('click', function() {
                    const checkboxes = document.querySelectorAll('.table-checkbox');
                    const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
                    
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = !allChecked;
                    });
                });
            }
            
            // Выделение таблиц, требующих оптимизации
            const selectNeedOptimize = document.getElementById('selectNeedOptimize');
            if (selectNeedOptimize) {
                selectNeedOptimize.addEventListener('click', function() {
                    const checkboxes = document.querySelectorAll('.table-checkbox');
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = checkbox.dataset.needOptimize === 'true';
                    });
                });
            }
            
            // Экспорт выбранных таблиц
            const exportSelectedTables = document.getElementById('exportSelectedTables');
            if (exportSelectedTables) {
                exportSelectedTables.addEventListener('click', function() {
                    const selectedTables = [];
                    document.querySelectorAll('.table-checkbox:checked').forEach(checkbox => {
                        selectedTables.push(checkbox.value);
                    });
                    
                    if (selectedTables.length > 0) {
                        window.location.href = `?db_config_id=<?= $db_config_id ?>&export_selected=1&tables=${selectedTables.join(',')}`;
                    } else {
                        alert('Выберите хотя бы одну таблицу для экспорта');
                    }
                });
            }
            
            // Переключение сайдбара
            const toggleSidebar = document.getElementById('toggleSidebar');
            if (toggleSidebar) {
                toggleSidebar.addEventListener('click', function() {
                    const sidebar = document.getElementById('sidebar');
                    sidebar.classList.toggle('sidebar-collapsed');
                    
                    // Сохраняем состояние в cookie
                    const isCollapsed = sidebar.classList.contains('sidebar-collapsed');
                    document.cookie = `sidebarCollapsed=${isCollapsed}; path=/`;
                    
                    // Обновляем иконку
                    const icon = toggleSidebar.querySelector('i');
                    icon.classList.toggle('bi-chevron-left');
                    icon.classList.toggle('bi-chevron-right');
                });
            }
            
            // Изменение размера сайдбара
            const sidebarResizer = document.getElementById('sidebarResizer');
            if (sidebarResizer) {
                let isResizing = false;
                let lastX = 0;
                let sidebarWidth = <?= isset($_COOKIE['sidebarWidth']) ? (int)$_COOKIE['sidebarWidth'] : 250 ?>;
                
                sidebarResizer.addEventListener('mousedown', (e) => {
                    isResizing = true;
                    lastX = e.clientX;
                    document.body.style.cursor = 'col-resize';
                    e.preventDefault();
                });
                
                document.addEventListener('mousemove', (e) => {
                    if (!isResizing) return;
                    
                    const deltaX = e.clientX - lastX;
                    lastX = e.clientX;
                    
                    const sidebar = document.getElementById('sidebar');
                    if (sidebar.classList.contains('sidebar-collapsed')) return;
                    
                    sidebarWidth += deltaX;
                    sidebarWidth = Math.max(200, Math.min(400, sidebarWidth));
                    
                    sidebar.style.width = `${sidebarWidth}px`;
                    sidebarResizer.style.left = `${sidebarWidth}px`;
                    document.querySelector('.main-content').style.marginLeft = `${sidebarWidth + 5}px`;
                    
                    // Сохраняем ширину в cookie
                    document.cookie = `sidebarWidth=${sidebarWidth}; path=/`;
                });
                
                document.addEventListener('mouseup', () => {
                    isResizing = false;
                    document.body.style.cursor = '';
                });
            }
            
            // Обработка формы массового удаления
            const bulkForm = document.getElementById('bulkForm');
            if (bulkForm) {
                bulkForm.addEventListener('submit', function(e) {
                    const checkboxes = document.querySelectorAll('.row-checkbox:checked');
                    if (checkboxes.length === 0) {
                        alert('Выберите хотя бы одну запись для удаления');
                        e.preventDefault();
                    }
                });
            }
        });
    </script>
</body>
</html>