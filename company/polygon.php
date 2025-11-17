<?php
$title = 'Дивизионный полигон';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']) {
header('Location: /');
exit();
}
if($user['company']<=0) {header('Location: /');exit();}

$res_company = $mysqli->query('SELECT * FROM `company` WHERE `id` = '.$user['company'].' LIMIT 1');
$company = $res_company->fetch_assoc();

$res_company_user = $mysqli->query('SELECT * FROM `company_user` WHERE `user` = '.$user['id'].' and `company` = '.$company['id'].' LIMIT 1');
$company_user = $res_company_user->fetch_assoc();


if($company_user['polygon_time']<time() and $company_user['polygon_time'] > 0){
$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user`  = "'.$user['id'].'" and `active`  = "1" limit 1');
$users_tanks = $res->fetch_assoc();
$mysqli->query('UPDATE `users_tanks` SET `a` = "'.($users_tanks['a']-40).'", `b` = "'.($users_tanks['b']-40).'", `t` = "'.($users_tanks['t']-40).'", `p` = "'.($users_tanks['p']-40).'" WHERE `id` = '.$users_tanks['id'].'');
$mysqli->query("UPDATE `company_user` SET `polygon_time` = '0' WHERE `id` = '".$company_user['id']."' LIMIT 1");
}

if($company['polygon_time']<time() and $company['polygon_time'] > 0){
$res_reit_us1 = $mysqli->query('SELECT * FROM `company_user` WHERE `company` = '.$company['id'].' ORDER BY `company_rang` asc, `company_exp` DESC ');
while ($us1 = $res_reit_us1->fetch_array()){
$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user`  = "'.$us1['user'].'" and `active`  = "1" limit 1');
$users_tanks_company = $res->fetch_assoc();
$mysqli->query('UPDATE `users_tanks` SET `a` = "'.($users_tanks_company['a']-40).'", `b` = "'.($users_tanks_company['b']-40).'", `t` = "'.($users_tanks_company['t']-40).'", `p` = "'.($users_tanks_company['p']-40).'" WHERE `id` = '.$users_tanks_company['id'].'');
}
$mysqli->query("UPDATE `company` SET `polygon_time` = '0' WHERE `id` = '".$company['id']."' LIMIT 1");
}



$res1 = $mysqli->query('SELECT * FROM `prom` WHERE `id` = "1" ');
$prom = $res1->fetch_assoc();

$cost_gold = ($company['level']*40);
$cost_gold1 = (50);
if($prom['time_13']>time()){$cost_gold = ceil($cost_gold-($cost_gold*$prom['act_13']/100));}else{$cost_gold = $cost_gold;}
if($prom['time_13']>time()){$cost_gold1 = ceil($cost_gold1-($cost_gold1*$prom['act_13']/100));}else{$cost_gold1 = $cost_gold1;}






echo '<div class="medium white bold cntr mb2">Дивизионный полигон</div>
<div class="trnt-block mb2">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="thumb fl"><img width="50" height="50" src="/images/clan/polygon.png" style="width:100%; border-radius: 9px;"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold">
<span class="green2">Боевая подготовка</span><br>
<div class="">Длительность: сутки</div><br>
</div></div>';
echo '</div></div></div></div></div></div></div></div></div></div>';








echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="white cntr bold sh_b small pb10"><div class="yellow1 pb5"><img src="/images/icons/victory.png"> Личный бонус полигона <img src="/images/icons/victory.png"></div>';
if($company_user['polygon_time']>time()){
echo 'Бонус активен: <span class="green2">'._time($company_user['polygon_time']-time()).'</span><br>';
}
echo '<span class="green1">+40</span> ко всем параметрам на 24 часа</div>';
if($company_user['polygon_time']<time()){
echo '<div class="bot"><a class="simple-but border mb5" href="?user_polygon"><span><span>Активировать за <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.$cost_gold1.'</span></span></a></div>';
}elseif($company_user['polygon_time']>time()){
echo '<div class="bot"><a class="simple-but border mb5" href="?user_polygon"><span><span>Продлить за <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.$cost_gold1.'</span></span></a></div>';
}
echo '</div></div></div></div></div></div></div></div></div></div>';







echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="white cntr bold sh_b small pb10">
<div class="yellow1 pb5"><img src="/images/icons/victory.png"> Бонус комдива <img src="/images/icons/victory.png"></div>';
if($company['polygon_time']>time()){
echo 'Бонус активен: <span class="green2">'._time($company['polygon_time']-time()).'</span><br>';
}
echo '<span class="green1">+40</span> ко всем параметрам на 24 часа</div>';
if($company_user['company_rang']<=2){
if($company['polygon_time']<time()){
echo '<div class="bot"><a class="simple-but border mb5" href="?company_polygon"><span><span>Активировать за <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.$cost_gold.'</span></span></a></div>';
}
}
echo '</div></div></div></div></div></div></div></div></div></div>';







echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">Активировать бонус комдива может только комдив или замкомдив. Стоимость активации: <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.$cost_gold.' золота</div>
</div></div></div></div></div></div></div></div></div></div>';





##################################################################################################################
##################################################################################################################
##################################################################################################################
if(isset($_GET['company_polygon'])){
if($company_user['company_rang']>2){header('Location: ?');exit();}
if($company['gold_'] < $cost_gold){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">Не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_gold-$company['gold']).' золота</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
if($company['polygon_time']>time()){header('Location: ?');exit();}
$_SESSION['ses'] = '<div class="buy-place-block pt2 mb10">
<div class="medium bold white cntr sh_b mt5 mb5">Активировать бонус комдива на 24 часа?</div>
<a class="simple-but border w50 mXa mb10" w:id="confirmLink" href="?company_polygon_"><span><span>да, подтверждаю</span></span></a>
<a class="simple-but border red w50 mXa" w:id="cancelLink" href="?"><span><span>нет, отмена</span></span></a>
</div>';
header('Location: ?');
exit();
}
if(isset($_GET['company_polygon_'])){
if($company_user['company_rang']>2){header('Location: ?');exit();}
if($company['polygon_time']>time()){header('Location: ?');exit();}
if($company['gold_'] < $cost_gold){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">Не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_gold-$company['gold_']).' золота</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
$res_reit_us = $mysqli->query('SELECT * FROM `company_user` WHERE `company` = '.$company['id'].' ORDER BY `company_rang` asc, `company_exp` DESC ');
while ($us = $res_reit_us->fetch_array()){
$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user`  = "'.$us['user'].'" and `active`  = "1" limit 1');
$users_tanks_company = $res->fetch_assoc();
$mysqli->query('UPDATE `users_tanks` SET `a` = "'.($users_tanks_company['a']+40).'", `b` = "'.($users_tanks_company['b']+40).'", `t` = "'.($users_tanks_company['t']+40).'", `p` = "'.($users_tanks_company['p']+40).'" WHERE `id` = '.$users_tanks_company['id'].'');
}
$mysqli->query("UPDATE `company` SET `gold_` = '".($company['gold_']-$cost_gold)."', `polygon_time` = '".(time()+86400)."' WHERE `id` = '".$company['id']."' LIMIT 1");
$text = "<span class='yellow1'>Командир дивизии активировал бонус комдива, +40 ко всем параметрам.</span>";
$mysqli->query('INSERT INTO `company_log` SET `company` = "'.$company['id'].'", `text` = "'.$text.'", `time` = "'.time().'", `user` = "'.$user['id'].'" ');
$mysqli->query('INSERT INTO `company_add` SET `company` = "'.$company['id'].'", `text` = "'.$text.'", `time` = "'.time().'", `user` = "'.$user['id'].'" ');
$uid1 = mysqli_insert_id($mysqli);
$mysqli->query('UPDATE `users` SET `company_add` = "'.$uid1.'" WHERE `company` = "'.$company['id'].'" ');

$_SESSION['err'] = '<div class="green1 sh_b mb2">Бонус комдива активирован!</div>';
header('Location: ?');
exit();
}
##################################################################################################################
##################################################################################################################
##################################################################################################################





















##################################################################################################################
##################################################################################################################
##################################################################################################################
if(isset($_GET['user_polygon'])){
if($user['gold'] < $cost_gold1){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.(50-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
if($company_user['polygon_time']>time()){
$_SESSION['ses'] = '<div class="buy-place-block pt2 mb10">
<div class="medium bold white cntr sh_b mt5 mb5">Продлить личный бонус полигона на 24 часа?</div>
<a class="simple-but border w50 mXa mb10" w:id="confirmLink" href="?user_polygon_"><span><span>да, подтверждаю</span></span></a>
<a class="simple-but border red w50 mXa" w:id="cancelLink" href="?"><span><span>нет, отмена</span></span></a>
</div>';
}else{
$_SESSION['ses'] = '<div class="buy-place-block pt2 mb10">
<div class="medium bold white cntr sh_b mt5 mb5">Активировать личный бонус полигона на 24 часа?</div>
<a class="simple-but border w50 mXa mb10" w:id="confirmLink" href="?user_polygon_"><span><span>да, подтверждаю</span></span></a>
<a class="simple-but border red w50 mXa" w:id="cancelLink" href="?"><span><span>нет, отмена</span></span></a>
</div>';
}
header('Location: ?');
exit();
}
if(isset($_GET['user_polygon_'])){
if($user['gold'] < $cost_gold1){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.(50-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
if($company_user['polygon_time']>time()){
$mysqli->query("UPDATE `company_user` SET `polygon_time` = '".($company_user['polygon_time']+86400)."' WHERE `id` = '".$company_user['id']."' LIMIT 1");
}else{
$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user`  = "'.$user['id'].'" and `active`  = "1" limit 1');
$users_tanks = $res->fetch_assoc();
$mysqli->query("UPDATE `company_user` SET `polygon_time` = '".(time()+86400)."' WHERE `id` = '".$company_user['id']."' LIMIT 1");
$mysqli->query('UPDATE `users_tanks` SET `a` = "'.($users_tanks['a']+40).'", `b` = "'.($users_tanks['b']+40).'", `t` = "'.($users_tanks['t']+40).'", `p` = "'.($users_tanks['p']+40).'" WHERE `id` = '.$users_tanks['id'].'');
}
$mysqli->query("UPDATE `users` SET `gold` = '".($user['gold']-$cost_gold1)."' WHERE `id` = '".$user['id']."' LIMIT 1");
$_SESSION['err'] = '<div class="green1 sh_b mb2">Личный бонус полигона активирован!</div>';
header('Location: ?');
exit();
}
##################################################################################################################
##################################################################################################################
##################################################################################################################










require_once ('../system/footer.php');
?>