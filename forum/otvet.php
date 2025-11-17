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
if(!$msg){header('Location: /forum/');exit();}
if($msg == 0){header('Location: /forum/');exit();}

$res2 = $mysqli->query('SELECT * FROM `forum_topik` WHERE `id` = '.$msg['topik'].' LIMIT 1');
$topik = $res2->fetch_assoc();
if($topik == 0){header('Location: /topik/'.$topik['razdel'].'/');exit();}

if($msg['user']==$user['id']){header('Location: /topik/'.$topik['razdel'].'/'.$topik['id'].'/');exit();}



$res = $mysqli->query('SELECT * FROM `forum_msg` WHERE `user` = "'.$user['id'].'" and `text` is NULL ');
$msg_ = $res->fetch_assoc();
if(!$msg_){
$mysqli->query('INSERT INTO `forum_msg` SET `topik` = "'.$topik['id'].'", `user` = "'.$user['id'].'", `ank` = "'.$msg['user'].'", `time` = "'.(time()+60).'" ');
}else{
$mysqli->query('UPDATE `forum_msg` SET `topik` = "'.$topik['id'].'", `ank` = "'.$msg['user'].'", `time` = "'.(time()+60).'" WHERE `id` = "'.$msg_['id'].'" LIMIT 1');
}
header('Location: /topik/'.$topik['razdel'].'/'.$topik['id'].'/?page='.$page.'');
exit();
?>