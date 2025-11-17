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
if(!$cchat){header('Location: /company/battle/?page='.$page.'');exit();}
if($cchat == 0){header('Location: /company/battle/?page='.$page.'');exit();}
if($user['position'] == 0){header('Location: /company/battle/?page='.$page.'');exit();}


$res_company_user = $mysqli->query('SELECT * FROM `company_user` WHERE `user` = '.$user['id'].' and `company` = '.$user['company'].' LIMIT 1');
$company_user = $res_company_user->fetch_assoc();


if($user['position'] == 0){
if($cchat['company'] != $user['company']){header('Location: /company/battle/?page='.$page.'');}
if($company_user['company_rang'] > 2){header('Location: /company/battle/?page='.$page.'');}
}

$mysqli->query('DELETE FROM `cchat` WHERE `id` = "'.$cchat['id'].'" ');






header('Location: /company/battle/?page='.$page.'');
exit();
?>