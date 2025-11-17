<?php
require_once ('system/function.php');
require_once ('system/header.php');
if($user['id']){
header('Location: /');
exit();
}

//https://mtank.ru/autolog.php?ulog=Нежная Ярость&upas=197645


if (empty($_GET['ulog']) and empty($_GET['upas'])){
$login = strong($_POST['login']);//фильтрируем
$pass = md5(md5(md5(strong($_POST['pass'])))); //фильтрируем
} else {
$login = strong($_GET['ulog']);
$pass = md5(md5(md5(strong($_GET['upas']))));
}


$res = $mysqli->query(' SELECT `login`,`pass` FROM `users` WHERE `login` = "'.$login.'" and `pass`= "'.$pass.'" LIMIT 1 ');
$dbsql = $res->fetch_assoc();



//$sql = mysql_query("SELECT `login` FROM `users` WHERE `login` = '".$login."' and `pass` = '".$pass."'  LIMIT 1");

if(($dbsql)){
$ip = $_SERVER['REMOTE_ADDR'];
setcookie('uslog', $dbsql['login'], time()+160704000, '/');
setcookie('uspass', $pass, time()+160704000, '/');
header('Location: /');
exit();
}else{



if(empty($login)){
header('Location: /');
$_SESSION['err'] = 'Поле "Ник" обязательно для ввода.';
exit();
}
if(empty($pass)){
header('Location: /');
$_SESSION['err'] = 'Поле "Пароль" обязательно для ввода.';
exit();
}
if(!preg_match("#^([A-zА-я0-9\-\_\ ])+$#ui", $login)){
header('Location: /');
$_SESSION['err'] = 'Запрещённые символы в поле "Ник".';
exit();
}
if(!preg_match("#^([A-zА-я0-9\-\_\ ])+$#ui", $pass)){
header('Location: /');
$_SESSION['err'] = 'Запрещенные символы в поле "Пароль".';
exit();
}
if(!empty($login) && !empty($pass)) if($dbsql==0) {
header('Location: /');
$_SESSION['err'] = 'Ошибка ввода.';
exit();
}

}

?>