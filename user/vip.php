<?php
$title = 'Усиления';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}
echo '<div class="p5"><div class="medium white bold cntr mb2">Усиления</div></div>';

$res = $mysqli->query('SELECT * FROM `vip` WHERE `user` = "'.$user['id'].'" LIMIT 1');
$vip = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = '.$user['id'].' and `active`  = "1" LIMIT 1');
$u_t = $res->fetch_assoc();


/* $mysqli->query("UPDATE `vip` SET `time1` = '1' WHERE `time1` > '".time()."' ");
$mysqli->query("UPDATE `vip` SET `time2` = '1' WHERE `time2` > '".time()."' ");
$mysqli->query("UPDATE `vip` SET `time3` = '1' WHERE `time3` > '".time()."' ");
$mysqli->query("UPDATE `vip` SET `time4` = '1' WHERE `time4` > '".time()."' ");
 */

$cost1 = 500;
$cost2 = 50;
$cost3 = 50;
$cost4 = 50;

$time1 = 480;
$time2 = 72;
$time3 = 72;
$time4 = 72;



$res1 = $mysqli->query('SELECT * FROM `prom` WHERE `id` = "1" ');
$prom = $res1->fetch_assoc();
if($prom['time_12']>time()){$cost1 = ceil($cost1-($cost1*$prom['act_12']/100));}else{$cost1 = $cost1;}
if($prom['time_12']>time()){$cost2 = ceil($cost2-($cost2*$prom['act_12']/100));}else{$cost2 = $cost2;}
if($prom['time_12']>time()){$cost3 = ceil($cost3-($cost3*$prom['act_12']/100));}else{$cost3 = $cost3;}
if($prom['time_12']>time()){$cost4 = ceil($cost4-($cost4*$prom['act_12']/100));}else{$cost4 = $cost4;}





echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="small cntr white bold sh_b">
<img src="/images/icons/exp.png"> <span class="green2">Вера в победу</span> <img src="/images/icons/exp.png"><br>
<span class="green1">+100</span> к параметрам<br>
<span class="green1">+50%</span> к опыту экипажа<br>
<span class="green1">+25%</span> к навыку снарядов<br>
<div class="pt5 pb5">Длительность: 480 часа</div>';
if($vip['time1']>time()){
echo '<div class="pt5 pb5">Истекает через <span class="green1">'._time($vip['time1']-time()).'</span></div>';
}else{
echo '<div class="pt5 pb5">Усиление <span class="red1">не активно</span></div>';
}
echo '</div>';

echo '<div class="bot">';
if($vip['time1']>time()){
echo '<a class="simple-but border mb5" href="?vip1"><span><span>Продлить за <img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> '.$cost1.'</span></span></a>';
}elsE{
echo '<a class="simple-but border mb5" href="?vip1"><span><span>Активировать за <img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> '.$cost1.'</span></span></a>';
}
echo '</div>
</div></div></div></div></div></div></div></div></div></div>';

if($vip['time1']>time()){$t = 'Продлить усиление?';}elsE{$t = 'Активировать усиление?';}
if(isset($_GET['vip1'])){
$_SESSION['ses'] = '<div class="buy-place-block pt2 mb10">
<div class="medium bold white cntr sh_b mt5 mb5">'.$t.'</div>
<div class="line1">Цена: <span class="nwr"><img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> '.($cost1).' золота</span></div>
<a class="simple-but border w50 mXa mb10" w:id="confirmLink" href="?vip1_"><span><span>да, подтверждаю</span></span></a>
<a class="simple-but border red w50 mXa" w:id="cancelLink" href="?"><span><span>нет, отмена</span></span></a></div>';
header('Location: ?');
exit();
}

if(isset($_GET['vip1_'])){
if($user['gold'] < $cost1){
$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost1-$user['gold']).' золота</div>
<div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div>
</div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}
if($vip['time1']>time()){
$mysqli->query("UPDATE `vip` SET `time1` = '".($vip['time1']+($time1*3600))."' WHERE `id` = '".$vip['id']."' LIMIT 1");
}else{
if(!$vip){
$mysqli->query('INSERT INTO `vip` SET `time1` = "'.(time()+($time1*3600)).'", `user` = "'.$user['id'].'"');
}else{
$mysqli->query("UPDATE `vip` SET `time1` = ".(time()+($time1*3600))." WHERE `id` = '".$vip['id']."' LIMIT 1");
}
$mysqli->query('UPDATE `users_tanks` SET `a` = '.($u_t['a']+100).', `b` = '.($u_t['b']+100).', `t` = '.($u_t['t']+100).', `p` = '.($u_t['p']+100).' WHERE `id` = '.$u_t['id'].' LIMIT 1');
$mysqli->query("UPDATE `vip` SET `time1` = '".(time()+($time1*3600))."' WHERE `id` = '".$vip['id']."' LIMIT 1");
}
$mysqli->query("UPDATE `users` SET `gold` = '".($user['gold']-$cost1)."' WHERE `id` = '".$user['id']."' LIMIT 1");
header('Location: ?');
exit();   
}






















echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="small cntr white bold sh_b">
<img src="/images/icons/exp.png"> <span class="green2">Передовое снабжение</span> <img src="/images/icons/exp.png"><br>
<span class="green1">+50%</span> к опыту<br>
<span class="green1">+25%</span> к серебру<br>
<div class="pt5 pb5">Длительность: 72 часа</div>';
if($vip['time2']>time()){
echo '<div class="pt5 pb5">Истекает через <span class="green1">'._time($vip['time2']-time()).'</span></div>';
}else{
echo '<div class="pt5 pb5">Усиление <span class="red1">не активно</span></div>';
}
echo '</div>';

echo '<div class="bot">';
if($vip['time2']>time()){
echo '<a class="simple-but border mb5" href="?vip2"><span><span>Продлить за <img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> '.$cost2.'</span></span></a>';
}elsE{
echo '<a class="simple-but border mb5" href="?vip2"><span><span>Активировать за <img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> '.$cost2.'</span></span></a>';
}
echo '</div>
</div></div></div></div></div></div></div></div></div></div>';

if($vip['time2']>time()){$t = 'Продлить усиление?';}elsE{$t = 'Активировать усиление?';}
if(isset($_GET['vip2'])){
$_SESSION['ses'] = '<div class="buy-place-block pt2 mb10">
<div class="medium bold white cntr sh_b mt5 mb5">'.$t.'</div>
<div class="line1">Цена: <span class="nwr"><img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> '.($cost2).' золота</span></div>
<a class="simple-but border w50 mXa mb10" w:id="confirmLink" href="?vip2_"><span><span>да, подтверждаю</span></span></a>
<a class="simple-but border red w50 mXa" w:id="cancelLink" href="?"><span><span>нет, отмена</span></span></a></div>';
header('Location: ?');
exit();
}

if(isset($_GET['vip2_'])){
if($user['gold'] < $cost2){
$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost2-$user['gold']).' золота</div>
<div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div>
</div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}
if($vip['time2']>time()){
$mysqli->query("UPDATE `vip` SET `time2` = '".($vip['time2']+($time2*3600))."' WHERE `id` = '".$vip['id']."' LIMIT 1");
}else{
if(!$vip){
$mysqli->query('INSERT INTO `vip` SET `time2` = "'.(time()+($time2*3600)).'", `user` = "'.$user['id'].'"');
}else{
$mysqli->query("UPDATE `vip` SET `time2` = '".(time()+($time2*3600))."' WHERE `id` = '".$vip['id']."' LIMIT 1");
}
}
$mysqli->query("UPDATE `users` SET `gold` = '".($user['gold']-$cost2)."' WHERE `id` = '".$user['id']."' LIMIT 1");
header('Location: ?');
exit();   
}

























echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="small cntr white bold sh_b">
<img src="/images/icons/exp.png"> <span class="green2">Армейское братство</span> <img src="/images/icons/exp.png"><br>
<span class="green1">+100%</span> к опыту экипажа<br>
<span class="green1">+50%</span> к навыку снарядов<br>
<div class="pt5 pb5">Длительность: 72 часа</div>';
if($vip['time3']>time()){
echo '<div class="pt5 pb5">Истекает через <span class="green1">'._time($vip['time3']-time()).'</span></div>';
}else{
echo '<div class="pt5 pb5">Усиление <span class="red1">не активно</span></div>';
}
echo '</div>';

echo '<div class="bot">';
if($vip['time3']>time()){
echo '<a class="simple-but border mb5" href="?vip3"><span><span>Продлить за <img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> '.$cost3.'</span></span></a>';
}elsE{
echo '<a class="simple-but border mb5" href="?vip3"><span><span>Активировать за <img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> '.$cost3.'</span></span></a>';
}
echo '</div>
</div></div></div></div></div></div></div></div></div></div>';

if($vip['time3']>time()){$t = 'Продлить усиление?';}elsE{$t = 'Активировать усиление?';}
if(isset($_GET['vip3'])){
$_SESSION['ses'] = '<div class="buy-place-block pt2 mb10">
<div class="medium bold white cntr sh_b mt5 mb5">'.$t.'</div>
<div class="line1">Цена: <span class="nwr"><img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> '.($cost3).' золота</span></div>
<a class="simple-but border w50 mXa mb10" w:id="confirmLink" href="?vip3_"><span><span>да, подтверждаю</span></span></a>
<a class="simple-but border red w50 mXa" w:id="cancelLink" href="?"><span><span>нет, отмена</span></span></a></div>';
header('Location: ?');
exit();
}

if(isset($_GET['vip3_'])){
if($user['gold'] < $cost3){
$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost3-$user['gold']).' золота</div>
<div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div>
</div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}
if($vip['time3']>time()){
$mysqli->query("UPDATE `vip` SET `time3` = '".($vip['time3']+($time3*3600))."' WHERE `id` = '".$vip['id']."' LIMIT 1");
}else{
if(!$vip){
$mysqli->query('INSERT INTO `vip` SET `time3` = "'.(time()+($time3*3600)).'", `user` = "'.$user['id'].'"');
}else{
$mysqli->query("UPDATE `vip` SET `time3` = '".(time()+($time3*3600))."' WHERE `id` = '".$vip['id']."' LIMIT 1");
}
}
$mysqli->query("UPDATE `users` SET `gold` = '".($user['gold']-$cost3)."' WHERE `id` = '".$user['id']."' LIMIT 1");
header('Location: ?');
exit();   
}



















echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="small cntr white bold sh_b">
<img src="/images/icons/exp.png"> <span class="green2">Экспериментальное оборудование</span> <img src="/images/icons/exp.png"><br>
<span class="green1">+50%</span> к опыту<br>
<span class="green1">+50%</span> к навыку снарядов<br>
Повышает усиления полигона на 1 пункт<br>
<div class="pt5 pb5">Длительность: 72 часа</div>';
if($vip['time4']>time()){
echo '<div class="pt5 pb5">Истекает через <span class="green1">'._time($vip['time4']-time()).'</span></div>';
}else{
echo '<div class="pt5 pb5">Усиление <span class="red1">не активно</span></div>';
}
echo '</div>';

echo '<div class="bot">';
if($vip['time4']>time()){
echo '<a class="simple-but border mb5" href="?vip4"><span><span>Продлить за <img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> '.$cost4.'</span></span></a>';
}elsE{
echo '<a class="simple-but border mb5" href="?vip4"><span><span>Активировать за <img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> '.$cost4.'</span></span></a>';
}
echo '</div>
</div></div></div></div></div></div></div></div></div></div>';

if($vip['time4']>time()){$t = 'Продлить усиление?';}elsE{$t = 'Активировать усиление?';}
if(isset($_GET['vip4'])){
$_SESSION['ses'] = '<div class="buy-place-block pt2 mb10">
<div class="medium bold white cntr sh_b mt5 mb5">'.$t.'</div>
<div class="line1">Цена: <span class="nwr"><img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> '.($cost4).' золота</span></div>
<a class="simple-but border w50 mXa mb10" w:id="confirmLink" href="?vip4_"><span><span>да, подтверждаю</span></span></a>
<a class="simple-but border red w50 mXa" w:id="cancelLink" href="?"><span><span>нет, отмена</span></span></a></div>';
header('Location: ?');
exit();
}

if(isset($_GET['vip4_'])){
if($user['gold'] < $cost4){
$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost4-$user['gold']).' золота</div>
<div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div>
</div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}
if($vip['time4']>time()){
$mysqli->query("UPDATE `vip` SET `time4` = '".($vip['time4']+($time4*3600))."' WHERE `id` = '".$vip['id']."' LIMIT 1");
}else{
if(!$vip){
$mysqli->query('INSERT INTO `vip` SET `time4` = "'.(time()+($time4*3600)).'", `user` = "'.$user['id'].'"');
}else{
$mysqli->query("UPDATE `vip` SET `time4` = '".(time()+($time4*3600))."' WHERE `id` = '".$vip['id']."' LIMIT 1");
}
}
$mysqli->query("UPDATE `users` SET `gold` = '".($user['gold']-$cost4)."' WHERE `id` = '".$user['id']."' LIMIT 1");


$res = $mysqli->query('SELECT * FROM `buildings_polygon` WHERE `user` = '.$user['id'].' LIMIT 1');
$b_polygon = $res->fetch_assoc();
if($b_polygon){
if($b_polygon['a_time']>time()){
if($b_polygon['a']!=50){
$mysqli->query("UPDATE `buildings_polygon` SET `a` = '".($b_polygon['a']+10)."' WHERE `id` = '".$b_polygon['id']."' LIMIT 1");
$mysqli->query('UPDATE `users_tanks` SET `a` = '.($u_t['a']+10).' WHERE `id` = '.$u_t['id'].' LIMIT 1');
}else{
$mysqli->query("UPDATE `buildings_polygon` SET `a` = '".($b_polygon['a']+20)."' WHERE `id` = '".$b_polygon['id']."' LIMIT 1");
$mysqli->query('UPDATE `users_tanks` SET `a` = '.($u_t['a']+20).' WHERE `id` = '.$u_t['id'].' LIMIT 1');
}
}
if($b_polygon['b_time']>time() ){
if($b_polygon['b']!=50){
$mysqli->query("UPDATE `buildings_polygon` SET `b` = '".($b_polygon['b']+10)."' WHERE `id` = '".$b_polygon['id']."' LIMIT 1");
$mysqli->query('UPDATE `users_tanks` SET `b` = '.($u_t['b']+10).' WHERE `id` = '.$u_t['id'].' LIMIT 1');
}else{
$mysqli->query("UPDATE `buildings_polygon` SET `b` = '".($b_polygon['b']+20)."' WHERE `id` = '".$b_polygon['id']."' LIMIT 1");
$mysqli->query('UPDATE `users_tanks` SET `b` = '.($u_t['b']+20).' WHERE `id` = '.$u_t['id'].' LIMIT 1');
}
}
if($b_polygon['t_time']>time() ){
if($b_polygon['t']!=50){
$mysqli->query("UPDATE `buildings_polygon` SET `t` = '".($b_polygon['t']+10)."' WHERE `id` = '".$b_polygon['id']."' LIMIT 1");
$mysqli->query('UPDATE `users_tanks` SET `t` = '.($u_t['t']+10).' WHERE `id` = '.$u_t['id'].' LIMIT 1');
}else{
$mysqli->query("UPDATE `buildings_polygon` SET `t` = '".($b_polygon['t']+20)."' WHERE `id` = '".$b_polygon['id']."' LIMIT 1");
$mysqli->query('UPDATE `users_tanks` SET `t` = '.($u_t['t']+20).' WHERE `id` = '.$u_t['id'].' LIMIT 1');
}
}
if($b_polygon['p_time']>time() ){
if($b_polygon['p']!=50){
$mysqli->query("UPDATE `buildings_polygon` SET `p` = '".($b_polygon['p']+10)."' WHERE `id` = '".$b_polygon['id']."' LIMIT 1");
$mysqli->query('UPDATE `users_tanks` SET `p` = '.($u_t['p']+10).' WHERE `id` = '.$u_t['id'].' LIMIT 1');
}else{
$mysqli->query("UPDATE `buildings_polygon` SET `p` = '".($b_polygon['p']+20)."' WHERE `id` = '".$b_polygon['id']."' LIMIT 1");
$mysqli->query('UPDATE `users_tanks` SET `p` = '.($u_t['p']+20).' WHERE `id` = '.$u_t['id'].' LIMIT 1');
}
}
}

header('Location: ?');
exit();   
}






































echo'<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">Бонусы купленных усилений суммируются</div>
</div></div></div></div></div></div></div></div></div></div>';
require_once ('../system/footer.php');
?>