<?php
require_once ('../system/function.php');
if(!$user['id']) {
header('Location: /');
exit();
}
$id = abs(intval($_GET['id']));
$page = abs(intval($_GET['page']));

$res = $mysqli->query('SELECT * FROM `avatars` WHERE `id` = "'.$id.'" LIMIT 1 ');
$ava = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `avatars_user` WHERE `images` = "'.$ava['images'].'" and `user` = "'.$user['id'].'" ');
$ava_us = $res->fetch_assoc();

if(!$ava_us){$_SESSION['err'] = '1';header('Location: /avatars/?page='.$page.'');exit();}
if($ava['sex']!=$user['sex']){$_SESSION['err'] = '2';header('Location: /avatars/?page='.$page.'');exit();}

$mysqli->query('UPDATE `avatars_user` SET `act` = "0" WHERE `user` = '.$user['id'].' ');
$mysqli->query('UPDATE `avatars_user` SET `act` = "1" WHERE `id` = '.$ava_us['id'].' LIMIT 1');

//$_SESSION['err'] = '3';
header('Location: /avatars/?page='.$page.'');
exit();
?> 