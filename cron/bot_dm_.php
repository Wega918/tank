<?php
require ('../system/function.php');
require ('../system/header.php');
$res = $mysqli->query('SELECT * FROM `users` WHERE `login` = "Wegas" and `pass` = "6ed87eba39ae19079167460119eed26b" LIMIT 1 ');
$user = $res->fetch_assoc();
setcookie('uslog', '', time() - 86400*365);
setcookie('uspass', '', time() - 86400*365);
$mysqli->query('UPDATE `users` SET `viz`="'.time().'", `ip` = "'.$_SERVER['REMOTE_ADDR'].'", `browser` = "'.$_SERVER['HTTP_USER_AGENT'].'", `gde` = "'.$_SERVER['REQUEST_URI'].'" WHERE `id` = '.$user['id'].' LIMIT 1');
//require ('../system/header.php');
require ('../dm/index.php');
?>