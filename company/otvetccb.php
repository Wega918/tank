<?php
require_once ('../system/function.php');
if(!$user['id']){
header('Location: /');
exit();
}
$id = abs(intval($_GET['id']));
$page = abs(intval($_GET['page']));

$res1 = $mysqli->query('SELECT * FROM `cchat` WHERE `id` = '.$id.' LIMIT 1');
$cchat = $res1->fetch_assoc();
if(!$cchat){header('Location: /company/battle/?');exit();}
if($cchat == 0){header('Location: /company/battle/?');exit();}
if($cchat['user']==$user['id']){header('Location: /company/battle/?');exit();}

$res_user = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$cchat['user'].'" ');
$user_ = $res_user->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `cchat` WHERE `company` = "'.$user['company'].'" and `user` = "'.$user['id'].'" and `text` = "0"  LIMIT 1');
$cchat_text1 = $res->fetch_assoc();
if(!$cchat_text1){
$mysqli->query('INSERT INTO `cchat` SET `company` = "'.$user['company'].'", `user` = "'.$user['id'].'", `ank` = "'.$user_['id'].'", `time` = "'.(time()+60).'" ');
}else{
$mysqli->query('UPDATE `cchat` SET `ank` = "'.$user_['id'].'", `time` = "'.(time()+60).'" WHERE `id` = "'.$cchat_text1['id'].'" LIMIT 1');
}

header('Location: /company/battle/');
exit();
?>