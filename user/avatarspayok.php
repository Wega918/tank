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


if($user['gold'] < $ava['gold']){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($ava['gold']-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="/payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: /avatars/?page='.$page.'');exit();}
if($ava_us){$_SESSION['err'] = '1';header('Location: /avatars/?page='.$page.'');exit();}
if($ava['sex']!=$user['sex']){$_SESSION['err'] = '2';header('Location: /avatars/?page='.$page.'');exit();}


$mysqli->query('INSERT INTO `avatars_user` SET `sex` = "'.$user['sex'].'", `images` = "'.$ava['images'].'" , `user` = "'.$user['id'].'" ');
$mysqli->query('UPDATE `users` SET `gold` = `gold` - "'.$ava['gold'].'" WHERE `id` = '.$user['id'].' ');

//$_SESSION['err'] = 'Успешно!';
header('Location: /avatars/?page='.$page.'');
exit();
?> 