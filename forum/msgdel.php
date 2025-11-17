<?php
require_once ('../system/function.php');
if(!$user['id']){
header('Location: /');
exit();
}
$id = abs(intval($_GET['id']));
$page = abs(intval($_GET['page']));

$res1 = $mysqli->query('SELECT * FROM `forum_msg` WHERE `id` = '.$id.' LIMIT 1');
$msg = $res1->fetch_assoc();
if($msg == 0){header('Location: /forum/');exit();}

$res2 = $mysqli->query('SELECT * FROM `forum_topik` WHERE `id` = '.$msg['topik'].' LIMIT 1');
$topik = $res2->fetch_assoc();
if($topik == 0){header('Location: /topik/'.$topik['razdel'].'/');exit();}

$res1 = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$msg['user'].'" ');
$us = $res1->fetch_assoc();

if($user['position']<=3 ){
if($user['position']>0 and $us['position']<4 ){
$mysqli->query('DELETE FROM `forum_msg` WHERE `id` = "'.$id.'" ');
}
}else{
$mysqli->query('DELETE FROM `forum_msg` WHERE `id` = "'.$id.'" ');
}

header('Location: /topik/'.$topik['razdel'].'/'.$topik['id'].'/?page='.$page.'');
exit();
?>