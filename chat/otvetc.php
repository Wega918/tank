<?php
require_once ('../system/function.php');
if(!$user['id']){
header('Location: /');
exit();
}
$id = abs(intval($_GET['id']));
$page = abs(intval($_GET['page']));

$res1 = $mysqli->query('SELECT * FROM `chat` WHERE `id` = '.$id.' LIMIT 1');
$chat = $res1->fetch_assoc();
if(!$chat){header('Location: /chat/');exit();}
if($chat == 0){header('Location: /chat/?page='.$page.'');exit();}
if($chat['user']==$user['id']){header('Location: /chat/?page='.$page.'');exit();}

$res_user = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$chat['user'].'" ');
$user_ = $res_user->fetch_assoc();

$res_cc = $mysqli->query('SELECT * FROM `chat` WHERE `user` = "'.$user['id'].'" and `text` = "0"  LIMIT 1');
$cchat_text1 = $res_cc->fetch_assoc();
if(!$cchat_text1){
$mysqli->query('INSERT INTO `chat` SET `user` = "'.$user['id'].'", `ank` = "'.$user_['id'].'", `time` = "'.(time()+60).'" ');
}else{
$mysqli->query('UPDATE `chat` SET `ank` = "'.$user_['id'].'", `time` = "'.(time()+60).'" WHERE `id` = "'.$chat['id'].'" LIMIT 1');
}

header('Location: /chat/?page='.$page.'');
exit();
?>