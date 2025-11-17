
<!DOCTYPE html>
<html>
<head>
    <script>
        // Функция, вызываемая при нажатии на кнопку
        function handleClick(event) {
            event.preventDefault(); // Предотвращение обновления страницы
            // Ваш код обработки события
        }
    </script>
</head>
<body>
    <button onclick="handleClick(event)">Нажми меня</button>
    <!-- Другие элементы и кнопки -->
</body>
</html>





<!DOCTYPE html>
<html>
<head>
    <style>
        .falling-image {
            position: absolute;
            top: -100px;
            left: -100px;
            transition: top 2s, left 2s, opacity 1s;
        }
    </style>
</head>
<body>
    <a href="your_page.php" target="_blank">
        <img class="falling-image" src="your_image.png" alt="Falling Image">
    </a>

    <script>
        // Функция для случайного перемещения картинки
        function moveImage() {
            var image = document.querySelector('.falling-image');
            var screenWidth = window.innerWidth;
            var screenHeight = window.innerHeight;
            var randomX = Math.floor(Math.random() * (screenWidth - 200));
            var randomY = Math.floor(Math.random() * (screenHeight - 200));

            image.style.left = randomX + 'px';
            image.style.top = randomY + 'px';
        }

        // Функция для задержки появления картинки
        function delayAppearance(minDelay, maxDelay) {
            var delay = Math.floor(Math.random() * (maxDelay - minDelay + 1)) + minDelay;

            setTimeout(function() {
                var image = document.querySelector('.falling-image');
                image.style.top = '0';
                image.style.left = '0';
                image.style.opacity = '1';

                setTimeout(function() {
                    moveImage();
                }, 1000);

                setTimeout(function() {
                    image.style.top = (window.innerHeight + 100) + 'px';
                    image.style.left = (window.innerWidth + 100) + 'px';
                    image.style.opacity = '0';
                }, 10000);
            }, delay * 1000);
        }

        // Запуск анимации после загрузки страницы
        window.addEventListener('load', function() {
            var minDelay = 5; // Минимальная задержка появления в секундах
            var maxDelay = 10; // Максимальная задержка появления в секундах

            delayAppearance(minDelay, maxDelay);
        });

        // При изменении размеров окна перерасчет позиции картинки
        window.addEventListener('resize', function() {
            moveImage();
        });
    </script>
</body>
</html>





/* <!DOCTYPE html>
<html>
<head>
    <style>
        .falling-image {
            position: absolute;
            top: -100px; # Начальное положение сверху 
            left: 0;
            transition: top 2s;
        }
    </style>
</head>
<body>
    <a href="your_page.php" target="_blank">
        <img class="falling-image" src="your_image.png" alt="Falling Image">
    </a>

    <script>
        // Функция для случайного перемещения картинки
        function moveImage() {
            var image = document.querySelector('.falling-image');
            var screenWidth = window.innerWidth;
            var screenHeight = window.innerHeight;
            var randomX = Math.floor(Math.random() * (screenWidth - 100)); // Случайное положение по горизонтали
            var randomY = Math.floor(Math.random() * (screenHeight - 100)); // Случайное положение по вертикали

            image.style.left = randomX + 'px';
            image.style.top = randomY + 'px';
        }

        // Запуск анимации через 1 секунду после загрузки страницы
        window.addEventListener('load', function() {
            var image = document.querySelector('.falling-image');
            image.style.top = '0';

            setTimeout(function() {
                moveImage();
            }, 1000);
        });

        // Установка таймера на 10 секунд для исчезновения картинки
        setTimeout(function() {
            var image = document.querySelector('.falling-image');
            image.style.display = 'none';
        }, 10000);
    </script>
</body>
</html> */

<?
error_reporting(E_ALL);
ini_set('display_errors', 1);

$mysqli = mysqli_connect(
'localhost',  // Хост, к которому мы подключаемся 
'melnik09_mtank',       // Имя пользователя 
'j2eJeQLj8QkkF1',   // Используемый пароль 
'melnik09_mtank');    // База данных для запросов по умолчанию  
if (!$mysqli) {
printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
exit;
} 
































//38.00
/* 


// Установка стартовой валюты
$startCurrency = 'UAH';

// Создание нового cURL ресурса
$ch = curl_init();

// Установка URL и других соответствующих параметров
curl_setopt($ch, CURLOPT_URL, 'https://api.binance.com/api/v3/ticker/price');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Выполнение запроса
$response = curl_exec($ch);

// Проверка на наличие ошибок в запросе
if ($response === false) {
    die('Ошибка выполнения запроса: ' . curl_error($ch));
}

// Закрытие cURL ресурса
curl_close($ch);

// Парсинг ответа в формате JSON
$data = json_decode($response, true);

// Установите желаемый лимит вывода записей
$limit = 5000;
// Переменная для отслеживания количества выведенных записей
$count = 0;

// Проверка разницы обменного курса и сохранение выгодных пар
foreach ($data as $item) {
$count++;
$symbol = $item['symbol'];
$price = $item['price'];
$baseCurrency = substr($item['symbol'], 0, -4); // Получение первой валюты
$quoteCurrency = substr($item['symbol'], -4); // Получение второй валюты
// Разделение пары на две части
$firstPart = substr($symbol, 0, -4);//слева
//$secondPart = substr($symbol, -4);//справа


if($firstPart=='UAH'){


echo '<hr>'.$symbol.' '.$price.'<br><br>';


$pvp_us = $mysqli->query('SELECT * FROM `price` WHERE `id`  ORDER BY `id` desc LIMIT 5000');
while ($pvu = $pvp_us->fetch_array()){
$firstPart1 = substr($pvu['symbol'], 0, -4);//слева
$secondPart1 = substr($pvu['symbol'], -4);//справа
//if($secondPart1=='UAH'){
if($firstPart==$secondPart1){
echo ''.$pvu['symbol'].' '.$pvu['price'].'<br>';
}
//}
}



}




if ($count >= $limit) {
break;
}else{
//continue;
}
}


 */







/* 


// Создание нового cURL ресурса
$ch = curl_init();

// Установка URL и других соответствующих параметров
curl_setopt($ch, CURLOPT_URL, 'https://api.binance.com/api/v3/ticker/price');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Выполнение запроса
$response = curl_exec($ch);

// Проверка на наличие ошибок в запросе
if ($response === false) {
    die('Ошибка выполнения запроса: ' . curl_error($ch));
}

// Закрытие cURL ресурса
curl_close($ch);

// Парсинг ответа в формате JSON
$data = json_decode($response, true);

// Установите желаемый лимит вывода записей
$limit = 500;
// Переменная для отслеживания количества выведенных записей
$count = 0;
// Вывод параметра symbol и price

// Вывод параметра symbol и price с разделением пары на две части
$base_currency = 'USD'; // Установите стартовую валюту

$exchange_info = array(); // Массив для хранения информации о выгоде обмена

foreach ($data as $pair => $rate) {
	$count++;
	
    $symbol = $pair['symbol'];
    $price = $pair['price'];
	
    $currency = substr($pair, 0, 3); // Получение кода первой валюты из валютной пары
    $base_rate = 1 / $rate; // Курс обмена стартовой валюты на данную валюту
    

    $exchange_info[$pair] = array(
        'currency' => $currency,
        'base_rate' => $base_rate,
        'rate' => $rate,
        'profit_to_base' => $rate - $base_rate, // Разница в курсе обмена на стартовую валюту
        'profit_from_base' => $base_rate - $rate, // Разница в курсе обмена стартовой валюты на данную валюту
    );
	
	
	echo ''.$exchange_info[$pair]['profit_from_base'].'   Пара: ' . $symbol . '   &nbsp;&nbsp;&nbsp;&nbsp;   Цена обмена: ' . $price . '   &nbsp;&nbsp;&nbsp;&nbsp;   ';
	
	
	if ($count >= $limit) {
	break;
    }
}
 */

















/* рабочий код для вывода всех пар и курса обмена
// Создание нового cURL ресурса
$ch = curl_init();

// Установка URL и других соответствующих параметров
curl_setopt($ch, CURLOPT_URL, 'https://api.binance.com/api/v3/ticker/price');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Выполнение запроса
$response = curl_exec($ch);

// Проверка на наличие ошибок в запросе
if ($response === false) {
    die('Ошибка выполнения запроса: ' . curl_error($ch));
}

// Закрытие cURL ресурса
curl_close($ch);

// Парсинг ответа в формате JSON
$data = json_decode($response, true);

// Установите желаемый лимит вывода записей
$limit = 500;
// Переменная для отслеживания количества выведенных записей
$count = 0;
// Вывод параметра symbol и price

// Вывод параметра symbol и price с разделением пары на две части
foreach ($data as $item) {
	$count++;
    $symbol = $item['symbol'];
    $price = $item['price'];

    // Разделение пары на две части
    $firstPart = substr($symbol, 0, -4);
    $secondPart = substr($symbol, -4);

    // Вывод разделенных частей с прочерком
    echo 'Пара: ' . $firstPart . '_' . $secondPart . '     &nbsp;&nbsp;&nbsp;&nbsp;   Цена обмена: ' . $price . '   &nbsp;&nbsp;&nbsp;&nbsp;   ';

    // Разделение цены на первую и вторую часть
    $priceParts = explode(' ', $price);
    $firstPartPrice = $priceParts[0]; // Цена первой части

    // Проверка наличия второй части цены
    if (isset($priceParts[1])) {
		$secondPartPrice = $priceParts[1]; // Цена второй части
		
		if(($firstPartPrice-$secondPartPrice)>0){
		$bon = '<font color=red>'.($firstPartPrice-$secondPartPrice).'</font>';
		}else{
		$bon = '<font color=green>'.($secondPartPrice-$firstPartPrice).'</font>';
		}

        echo 'Цена второй части: ' . $secondPartPrice . '     &nbsp;&nbsp;&nbsp;&nbsp;         '.$bon.'<br>';
    }else{
	    echo '<br>';
	}
	
	
	
	if ($count >= $limit) {
	break;
    }
} */










/* 
// Создание нового cURL ресурса
$ch = curl_init();

// Установка URL и других соответствующих параметров
curl_setopt($ch, CURLOPT_URL, 'https://api.binance.com/api/v3/ticker/price');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Выполнение запроса
$response = curl_exec($ch);

// Проверка на наличие ошибок в запросе
if ($response === false) {
    die('Ошибка выполнения запроса: ' . curl_error($ch));
}

// Закрытие cURL ресурса
curl_close($ch);

// Парсинг ответа в формате JSON
$data = json_decode($response, true);

// Вывод параметра symbol и price с разделением пары на две части
foreach ($data as $item) {
    $symbol = $item['symbol'];
    $price = $item['price'];

    // Разделение пары на две части
    $firstPart = substr($symbol, 0, -4);
    $secondPart = substr($symbol, -4);

    // Вывод разделенных частей с прочерком
    echo 'Symbol: ' . $firstPart . ' - ' . $secondPart . ', Price: ' . $price . '<br>';

    // Разделение цены на первую и вторую часть
    $priceParts = explode(' ', $price);
    $firstPartPrice = $priceParts[0]; // Цена первой части
    $secondPartPrice = $priceParts[1]; // Цена второй части

    // Вывод цен на первую и вторую часть пары
    echo 'First Part Price: ' . $firstPartPrice . '<br>';
    echo 'Second Part Price: ' . $secondPartPrice . '<br>';
}
 */












/* 

// Создание нового cURL ресурса
$ch = curl_init();

// Установка URL и других соответствующих параметров
curl_setopt($ch, CURLOPT_URL, 'https://api.binance.com/api/v3/ticker/price');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Выполнение запроса
$response = curl_exec($ch);

// Проверка на наличие ошибок в запросе
if ($response === false) {
    die('Ошибка выполнения запроса: ' . curl_error($ch));
}

// Закрытие cURL ресурса
curl_close($ch);

// Парсинг ответа в формате JSON
$data = json_decode($response, true);

// Вывод параметра symbol и price с разделением пары на две части
foreach ($data as $item) {
    $symbol = $item['symbol'];
    $price = $item['price'];

    // Разделение пары на две части, если есть символ "_"
    $parts = explode('', $symbol);

    // Проверка наличия двух частей
    if (count($parts) == 2) {
        $firstPart = $parts[0];
        $secondPart = $parts[1];

        // Вывод разделенных частей с прочерком
        echo 'Symbol: ' . $firstPart . ' - ' . $secondPart . ', Price: ' . $price . '<br>';

        // Разделение цены на первую и вторую часть
        $priceParts = explode(' ', $price);
        $firstPartPrice = $priceParts[0]; // Цена первой части
        $secondPartPrice = $priceParts[1]; // Цена второй части

        // Вывод цен на первую и вторую часть пары
        echo 'First Part Price: ' . $firstPartPrice . '<br>';
        echo 'Second Part Price: ' . $secondPartPrice . '<br>';
    }
}



 */

















/* 

// Создание нового cURL ресурса
$ch = curl_init();

// Установка URL и других соответствующих параметров
curl_setopt($ch, CURLOPT_URL, 'https://api.binance.com/api/v3/ticker/price');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Выполнение запроса
$response = curl_exec($ch);

// Закрытие cURL ресурса
curl_close($ch);

// Парсинг ответа в формате JSON
$data = json_decode($response, true);



// Установите желаемый лимит вывода записей
$limit = 10;
// Переменная для отслеживания количества выведенных записей
$count = 0;
// Вывод параметра symbol и price
foreach ($data as $item) {
	$count++;
	
	
	
	
    $baseCurrency = substr($item['symbol'], 0, -4); // Получение первой валюты
    $quoteCurrency = substr($item['symbol'], -4); // Получение второй валюты
    
    echo 'Symbol: '.$baseCurrency.'_'.$quoteCurrency.', Price: '.$item['price'].'<br>';
	
	
	if ($count >= $limit) {
	break;
    }
}





foreach ($data as $item) {
	$count++;
    $symbol = $item['symbol'];
    $price = $item['price'];

    // Разделение пары на две части, если есть символ "_"
    $parts = explode('_', $symbol);

    // Проверка наличия двух частей
    if (count($parts) == 2) {
        $firstPart = $parts[0];
        $secondPart = $parts[1];

        // Вывод разделенных частей с прочерком
        echo 'Symbol: ' . $firstPart . ' - ' . $secondPart . ', Price: ' . $price . '<br>';

        // Установка цен на первую и вторую часть пары
        $firstPartPrice = $item['price']; // Цена первой части
        $secondPartPrice = $item['price']; // Цена второй части

        // Вывод цен на первую и вторую часть пары
        echo 'First Part Price: ' . $firstPartPrice . '<br>';
        echo 'Second Part Price: ' . $secondPartPrice . '<br>';
    }
	
	
	
	if ($count >= $limit) {
	break;
    }
} */

















/* foreach ($data as $item) {
	$count++;
	
	
	
	
    $baseCurrency = substr($item['symbol'], 0, -4); // Получение первой валюты
    $quoteCurrency = substr($item['symbol'], -4); // Получение второй валюты
    
    echo 'Symbol: '.$baseCurrency.'_'.$quoteCurrency.', Price: '.$item['price'].'<br>';
	
	
	if ($count >= $limit) {
	break;
    }
} */

























?>