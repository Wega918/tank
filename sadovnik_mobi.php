<?php
ob_start();
session_start();
error_reporting(E_ALL);

// Завершение сессии и очистка данных
if (isset($_GET['exit'])) {
    setcookie("message", "", time() - 3600, "/");
    setcookie("us", "", time() - 3600, "/");
    setcookie("page", "", time() - 3600, "/");
    setcookie("SESSID", "", time() - 3600, "/");
    header('Location: ?');
    exit;
}




if (isset($_COOKIE['SESSID']) && isset($_COOKIE['message'])) {
    $message = $_COOKIE['message'];
    $page = isset($_COOKIE['page']) ? (int)$_COOKIE['page'] : 1;
    $us = isset($_COOKIE['us']) ? (int)$_COOKIE['us'] : 1;



    // Начальный URL для загрузки
    $url = "http://sadovnik.mobi/online?page={$page}";

    // Инициализация cURL сессии
    $curl = curl_init($url);

    // Настройки cURL
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_COOKIE, "JSESSIONID={$_COOKIE['SESSID']}");
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); // Следовать за редиректами

    // Выполнение запроса
    $response = curl_exec($curl);

    // Получаем код HTTP-ответа
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    // Проверка на ошибки cURL
    if (curl_errno($curl)) {
        echo "Ошибка cURL: " . curl_error($curl) . "<br>";
        curl_close($curl);
        exit;
    }

    // Проверка успешности запроса (например, 200 OK)
    if ($httpCode != 200) {
        echo "Ошибка при загрузке страницы. HTTP Код: {$httpCode}<br>";
        echo '<a href="?exit" style="color: red; font-weight: bold;">Остановить рассылку</a><br>';
        curl_close($curl);
        exit;
    }

    // Закрытие cURL сессии
    curl_close($curl);



    // Парсинг HTML с помощью DOMDocument
    $doc = new DOMDocument();
    libxml_use_internal_errors(true);
    $doc->loadHTML($response);
    libxml_clear_errors();
    $links = $doc->getElementsByTagName('a');

    // Извлекаем ссылки для пользователей
    $userIds = [];
    foreach ($links as $link) {
        $href = $link->getAttribute('href'); // Получаем атрибут href
        if (strpos($href, '/user/') !== false) {
            // Извлекаем ID пользователя из href
            if (preg_match('#/user/(\d+)#', $href, $matches)) {
                $userIds[] = $matches[1];  // Добавляем ID пользователя в массив
            }
        }
    }

    // Проверка, что пользователи найдены
    if (empty($userIds)) {
        echo "Не удалось найти пользователей на странице.<br>";
        echo '<a href="?exit" style="color: red; font-weight: bold;">Остановить рассылку</a><br>';
    } else {
        // Проверка, что нужный пользователь найден
        if (!isset($userIds[$us - 1])) {
            // Увеличиваем номер страницы и сбрасываем номер пользователя
            setcookie('page', $page + 1, time() + (60 * 60 * 24), '/');
            setcookie('us', 1, time() + (60 * 60 * 24), '/');
        } else {
            // Пользователь найден
            $currentUser = $userIds[$us - 1];
            echo "Пользователь найден: {$currentUser} (страница {$page}, номер {$us}).<br>";
            echo "Список пользователей: " . implode(', ', $userIds) . "<hr>";





$a = curl_init('http://sadovnik.mobi/presentSend?-1.IFormSubmitListener-form&0=' . $currentUser . '&1=278&ok');
$i = $currentUser;
if ($a) {
    // Установка параметров cURL
    curl_setopt($a, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // Заголовок User-Agent
    curl_setopt($a, CURLOPT_REFERER, 'http://sadovnik.mobi/'); // Заголовок Referer
    curl_setopt($a, CURLOPT_TIMEOUT, 600); // Таймаут
    curl_setopt($a, CURLOPT_COOKIE, "JSESSIONID={$_COOKIE['SESSID']}");
    curl_setopt($a, CURLOPT_RETURNTRANSFER, true); // Возвращаем ответ
    curl_setopt($a, CURLOPT_POST, true); // Используем POST метод

    // Параметры для отправки POST-запроса
    $postData = [
        'text' => '💼 Управляй бизнесом на другой планете! Развивай колонию и увеличивай доходы. Попробуй сейчас. https://mars-games.ru', // Текст сообщения
        'submit' => 'Отправить' // Может быть необходимым параметром для отправки формы
    ];

    // Закодируем данные для отправки
    curl_setopt($a, CURLOPT_POSTFIELDS, http_build_query($postData)); 

    // Выполнение cURL запроса
    $o = curl_exec($a); 

    // Проверка ответа
    if ($o) {
        // Если запрос прошел успешно
        echo 'Отправлено юзеру № ' . $i . '!</br>';
    } else {
        // Если произошла ошибка при отправке
        echo 'Ошибка отправки для пользователя № ' . $i . '!</br>';
    }

    // Закрытие ресурса cURL
    curl_close($a);
} else {
    // Ошибка инициализации cURL
    echo 'Ошибка инициализации cURL для пользователя № ' . $i . '!</br>';
}




}

            // Увеличиваем счетчик пользователей
            setcookie('us', $us + 1, time() + (60 * 60 * 24), '/');
        }

        // Переход к следующему пользователю
        if ($us > count($userIds)) {
            setcookie('page', $page + 1, time() + (60 * 60 * 24), '/');
            setcookie('us', 1, time() + (60 * 60 * 24), '/');
            header('Location: ?');
            exit;
        }

        // Переход к следующему пользователю
        setcookie('us', $us + 1, time() + (60 * 60 * 24), '/');
        echo '<a href="?exit" style="color: red; font-weight: bold;">Остановить рассылку</a><br>';
        echo "<script type='text/javascript'>
            setTimeout(function(){
                location.reload();
            }, 500);
        </script>";
    
} else {
    // Форма ввода данных
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['SESSID'], $_POST['message'], $_POST['page'])) {
        setcookie('SESSID', $_POST['SESSID'], time() + (60 * 60 * 4), '/');
        setcookie('message', $_POST['message'], time() + (60 * 60 * 4), '/');
        setcookie('page', $_POST['page'], time() + (60 * 60 * 4), '/');
        setcookie('us', 1, time() + (60 * 60 * 4), '/');
        header('Location: ?');
        exit;
    }
?>

<form action="" method="post">
    <label>ТЕКСТ сообщения:</label><br/>
    <input type="text" name="message" required/><br/>
    <label>SESSID:</label><br/>
    <input type="text" name="SESSID" required/><br/>
    <label>Страница спама:</label><br/>
    <input type="number" name="page" value="1" min="0" required/><br/>
    <input type="submit" value="Запустить" />
</form>

<?php 
}





/* 
for ($i = 100; $i < 102; $i++) { 
    // Инициализация cURL запроса
    $a = curl_init('http://sadovnik.mobi/presentSend?-1.IFormSubmitListener-form&0=' . $i . '&1=278&ok');

    if ($a) {
        // Установка параметров cURL
        curl_setopt($a, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // Заголовок User-Agent
        curl_setopt($a, CURLOPT_REFERER, 'http://sadovnik.mobi/'); // Заголовок Referer
        curl_setopt($a, CURLOPT_TIMEOUT, 600); // Таймаут
        curl_setopt($a, CURLOPT_COOKIE, 'JSESSIONID=53C9DC53DEC9E8B2247D2F5EBC96467B'); // Cookie сессии
        curl_setopt($a, CURLOPT_RETURNTRANSFER, true); // Возвращаем ответ
        curl_setopt($a, CURLOPT_POST, true); // Используем POST метод
        curl_setopt($a, CURLOPT_POSTFIELDS, [
            'text' => '💼 Управляй бизнесом на другой планете! Развивай колонию и увеличивай доходы. Попробуй сейчас. https://mars-games.ru' // Текст сообщения
        ]);

        // Выполнение cURL запроса
        $o = curl_exec($a); 

        if ($o) {
            // Если запрос прошел успешно
            echo 'Отправлено юзеру № ' . $i . '!</br>';
        } else {
            // Если произошла ошибка при отправке
            echo 'Ошибка отправки для пользователя № ' . $i . '!</br>';
        }

        // Закрытие ресурса cURL
        curl_close($a);
    } else {
        // Ошибка инициализации cURL
        echo 'Ошибка инициализации cURL для пользователя № ' . $i . '!</br>';
    }
} */
?>