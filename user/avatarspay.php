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

$_SESSION['ses'] = '<div class="buy-place-block pt2 mb10">
<div class="thumb m0a pb2"><img alt="avatar" src="/images/avatar/'.$ava['images'].'" style="width:100%; border-radius: 9px;"><span class="mask2">&nbsp;</span></div>
<div class="medium bold white cntr sh_b mt5 mb5">Купить новый аватар?</div>
<div class="line1">Цена: <span class="nwr"><img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> '.$ava['gold'].' золота</span></div>
<a class="simple-but border w50 mXa mb10" w:id="confirmLink" href="/avatarspayok/'.$ava['id'].'/'.$page.'/"><span><span>да, подтверждаю</span></span></a>
<a class="simple-but border red w50 mXa" w:id="cancelLink" href="/avatars/?page='.$page.'"><span><span>нет, отмена</span></span></a></div>';

//$_SESSION['err'] = 'Успешно!';
header('Location: /avatars/?page='.$page.'');
exit();
?> 