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
if(!$chat){header('Location: /chat/?page='.$page.'');exit();}
if($chat == 0){header('Location: /chat/?page='.$page.'');exit();}
if($user['position'] == 0){header('Location: /chat/?page='.$page.'');exit();}

$mysqli->query('DELETE FROM `chat` WHERE `id` = "'.$chat['id'].'" ');

header('Location: /chat/?page='.$page.'');
exit();
?>