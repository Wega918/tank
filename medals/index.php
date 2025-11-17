<?php
$title = 'Медали';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$res = $mysqli->query('SELECT * FROM `medals_user` WHERE `user`  = "'.$user['id'].'" and `medals_id` = "1"  limit 1');
$medals_1 = $res->fetch_assoc();
if(!$medals_1){
$mysqli->query('INSERT INTO `medals_user` SET `user` = '.$user['id'].', `time` = "'.time().'" , `medals_id` = "1" , `name` = "Медаль разведчика" ');
}







echo '<div class="cntr bold green1 mb5">Медали</div>';
$res = $mysqli->query('SELECT * FROM `medals_user` WHERE `user` = '.$user['id'].' and `done` != "1" ORDER BY `medals_id` desc LIMIT 1');
while ($medals = $res->fetch_array()){
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="thumb inbl m3"><img width="50" height="50" src="/images/medals/'.$medals['medals_id'].'.png?2"><span class="mask2">&nbsp;</span></div>
<div class="small white sh_b bold"><span class="green1 medium">'.$medals['name'].'</span><br>Бонус медали:<br>+10% опыта и серебра</div>
<div class="clrb"></div>
</div></div></div></div></div></div></div></div></div></div>';


############################ 1
if($medals['medals_id']==1){
$res = $mysqli->query('SELECT * FROM `buildings_user` WHERE `user` = "'.$user['id'].'" and `tip` = "1" ');
$buildings = $res->fetch_assoc();
if($user['kill_tanks']>=15 and $buildings['level']>=1){
echo '<a class="simple-but border" href="?current'.$medals['medals_id'].'"><span><span>Получить медаль</span></span></a><div style="position:relative;"><span class="digit2 esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span></div>';
}
echo '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">';

$new = $user['kill_tanks'];
$max = 15;
$proc = round(100/($max/($new+0.0000001)));if($proc > 100) {$proc = 100;}
if($new>=$max){echo '<div class="bold sh_b small pb2 gray1">Уничтожь '.$max.' танков в бою: выполнено!</div>';}else{
echo '<div class="bold sh_b small pb2 gray1">Уничтожь '.$max.' танков в бою: '.$new.' / '.$max.'</div>';
echo '<table class="rblock esmall mb0 blue"><tbody><tr><td><div class="value-block lh1"><span><span>'.$new.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$proc.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$max.'</span></span></div></td></tr></tbody></table>';
echo '<a class="simple-but mt5 mb2 a_w50" href="/battle/"><span><span>Перейти к выполнению</span></span></a>';
}

$new = $buildings['level'];
$max = 1;
$proc = round(100/($max/($new+0.0000001)));if($proc > 100) {$proc = 100;}
if($new>=$max){echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Построй шахту на базе: выполнено!</div>';}else{
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Построй шахту на базе: '.$new.' / '.$max.'</div>';
echo '<table class="rblock esmall mb0 blue"><tbody><tr><td><div class="value-block lh1"><span><span>'.$new.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$proc.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$max.'</span></span></div></td></tr></tbody></table>';
echo '<a class="simple-but mt5 mb2 a_w50" href="/buildings/"><span><span>Перейти к выполнению</span></span></a>';
}
}
############################ 2
if($medals['medals_id']==2){
$res = $mysqli->query('SELECT * FROM `buildings_user` WHERE `user` = "'.$user['id'].'" and `tip` = "2" ');
$buildings = $res->fetch_assoc();
$res = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$user['id'].'" LIMIT 1');
$traning = $res->fetch_assoc();
$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = '.$user['id'].' and `active`  = "1" LIMIT 1');
$users_tanks = $res->fetch_assoc();
$res = $mysqli->query('SELECT * FROM `tanks` WHERE `id`  = "'.$users_tanks['tip'].'" LIMIT 1');
$tank = $res->fetch_assoc();
$res = $mysqli->query('SELECT * FROM `users_tanks_pimp` WHERE `user` = '.$user['id'].' and `tip_tank` = '.$tank['tip'].' LIMIT 1');
$users_tanks_pimp = $res->fetch_assoc();

if($buildings['level']>=1 and $traning['a_level']>=12 and $medals['prog_pvp']>=3 and $users_tanks_pimp['a']>=5 and $users_tanks_pimp['p']>=5 and $user['login']!='Незнакомец'){
echo '<a class="simple-but border" href="?current'.$medals['medals_id'].'"><span><span>Получить медаль</span></span></a><div style="position:relative;"><span class="digit2 esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span></div>';
}
echo '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">';

$new = $buildings['level'];
$max = 1;
$proc = round(100/($max/($new+0.0000001)));if($proc > 100) {$proc = 100;}
if($new>=$max){echo '<div class="bold sh_b small pb2 gray1">Построй полигон на базе: выполнено!</div>';}else{
echo '<div class="bold sh_b small pb2 gray1">Построй полигон на базе: '.$new.' / '.$max.'</div>';
echo '<table class="rblock esmall mb0 blue"><tbody><tr><td><div class="value-block lh1"><span><span>'.$new.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$proc.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$max.'</span></span></div></td></tr></tbody></table>';
echo '<a class="simple-but mt5 mb2 a_w50" href="/buildings/"><span><span>Перейти к выполнению</span></span></a>';
}

$new = $traning['a_level'];
$max = 12;
$proc = round(100/($max/($new+0.0000001)));if($proc > 100) {$proc = 100;}
if($new>=$max){echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Повысь атаку в тренировке до '.$max.': выполнено!</div>';}else{
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Повысь атаку в тренировке до '.$max.': '.$new.' / '.$max.'</div>';
echo '<table class="rblock esmall mb0 blue"><tbody><tr><td><div class="value-block lh1"><span><span>'.$new.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$proc.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$max.'</span></span></div></td></tr></tbody></table>';
echo '<a class="simple-but mt5 mb2 a_w50" href="/training/'.$user['id'].'/"><span><span>Перейти к выполнению</span></span></a>';
}

$new = $medals['prog_pvp'];
$max = 3;
$proc = round(100/($max/($new+0.0000001)));if($proc > 100) {$proc = 100;}
if($new>=$max){echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Проведи '.$max.' битвы: выполнено!</div>';}else{
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Проведи '.$max.' битвы: '.$new.' / '.$max.'</div>';
echo '<table class="rblock esmall mb0 blue"><tbody><tr><td><div class="value-block lh1"><span><span>'.$new.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$proc.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$max.'</span></span></div></td></tr></tbody></table>';
echo '<a class="simple-but mt5 mb2 a_w50" href="/pvp/"><span><span>Перейти к выполнению</span></span></a>';
}

$new = $users_tanks_pimp['1'];
$max = 5;
$proc = round(100/($max/($new+0.0000001)));if($proc > 100) {$proc = 100;}
if($new>=$max){echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Улучши орудие танка на '.$max.': выполнено!</div>';}else{
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Улучши орудие танка на '.$max.': '.$new.' / '.$max.'</div>';
echo '<table class="rblock esmall mb0 blue"><tbody><tr><td><div class="value-block lh1"><span><span>'.$new.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$proc.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$max.'</span></span></div></td></tr></tbody></table>';
echo '<a class="simple-but mt5 mb2 a_w50" href="/pimp/'.$user['id'].'/"><span><span>Перейти к выполнению</span></span></a>';
}

$new = $users_tanks_pimp['4'];
$max = 5;
$proc = round(100/($max/($new+0.0000001)));if($proc > 100) {$proc = 100;}
if($new>=$max){echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Улучши корпус танка на '.$max.': выполнено!</div>';}else{
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Улучши корпус танка на '.$max.': '.$new.' / '.$max.'</div>';
echo '<table class="rblock esmall mb0 blue"><tbody><tr><td><div class="value-block lh1"><span><span>'.$new.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$proc.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$max.'</span></span></div></td></tr></tbody></table>';
echo '<a class="simple-but mt5 mb2 a_w50" href="/pimp/'.$user['id'].'/"><span><span>Перейти к выполнению</span></span></a>';
}

if($user['login']=='Незнакомец'){$new = 0;}else{$new = 1;}
$max = 1;
$proc = round(100/($max/($new+0.0000001)));if($proc > 100) {$proc = 100;}
if($new>=$max){echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Сохрани танк: выполнено!</div>';}else{
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Сохрани танк: '.$new.' / '.$max.'</div>';
echo '<table class="rblock esmall mb0 blue"><tbody><tr><td><div class="value-block lh1"><span><span>'.$new.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$proc.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$max.'</span></span></div></td></tr></tbody></table>';
echo '<a class="simple-but mt5 mb2 a_w50" href="/save.php"><span><span>Перейти к выполнению</span></span></a>';
}
}
############################ 3
if($medals['medals_id']==3){
$res = $mysqli->query('SELECT * FROM `buildings_user` WHERE `user` = "'.$user['id'].'" and `tip` = "3" ');
$buildings = $res->fetch_assoc();
$res = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$user['id'].'" LIMIT 1');
$traning = $res->fetch_assoc();
$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = '.$user['id'].' and `active`  = "1" LIMIT 1');
$users_tanks = $res->fetch_assoc();
$res = $mysqli->query('SELECT * FROM `tanks` WHERE `id`  = "'.$users_tanks['tip'].'" LIMIT 1');
$tank = $res->fetch_assoc();
$res = $mysqli->query('SELECT * FROM `users_tanks_pimp` WHERE `user` = '.$user['id'].' and `tip_tank` = '.$tank['tip'].' LIMIT 1');
$users_tanks_pimp = $res->fetch_assoc();
$res = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$user['id'].'" LIMIT 1');
$traning = $res->fetch_assoc();

if($users_tanks_pimp['3']>=15 and $medals['prog_pvp']>=10 and $traning['rang']>=2 and $buildings['level']>=1 and $user['miss_col']>=12 and $traning['a_level']>=16){
echo '<a class="simple-but border" href="?current'.$medals['medals_id'].'"><span><span>Получить медаль</span></span></a><div style="position:relative;"><span class="digit2 esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span></div>';
}
echo '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">';

$new = $users_tanks_pimp['3'];
$max = 15;
$proc = round(100/($max/($new+0.0000001)));if($proc > 100) {$proc = 100;}
if($new>=$max){echo '<div class="bold sh_b small pb2 gray1">Улучши оптику танка на '.$max.': выполнено!</div>';}else{
echo '<div class="bold sh_b small pb2 gray1">Улучши оптику танка на '.$new.' / '.$max.'</div>';
echo '<table class="rblock esmall mb0 blue"><tbody><tr><td><div class="value-block lh1"><span><span>'.$new.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$proc.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$max.'</span></span></div></td></tr></tbody></table>';
echo '<a class="simple-but mt5 mb2 a_w50" href="/pimp/'.$user['id'].'/"><span><span>Перейти к выполнению</span></span></a>';
}

$new = $medals['prog_pvp'];
$max = 10;
$proc = round(100/($max/($new+0.0000001)));if($proc > 100) {$proc = 100;}
if($new>=$max){echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Проведи '.$max.' битв: выполнено!</div>';}else{
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Проведи '.$max.' битв: '.$new.' / '.$max.'</div>';
echo '<table class="rblock esmall mb0 blue"><tbody><tr><td><div class="value-block lh1"><span><span>'.$new.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$proc.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$max.'</span></span></div></td></tr></tbody></table>';
echo '<a class="simple-but mt5 mb2 a_w50" href="/pvp/"><span><span>Перейти к выполнению</span></span></a>';
}

$new = $traning['rang'];
$max = 2;
$proc = round(100/($max/($new+0.0000001)));if($proc > 100) {$proc = 100;}
if($new>=$max){echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Получи звание рядовой: выполнено!</div>';}else{
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Получи звание рядовой: '.$new.' / '.$max.'</div>';
echo '<table class="rblock esmall mb0 blue"><tbody><tr><td><div class="value-block lh1"><span><span>'.$new.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$proc.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$max.'</span></span></div></td></tr></tbody></table>';
echo '<a class="simple-but mt5 mb2 a_w50" href="/pvp/"><span><span>Перейти к выполнению</span></span></a>';
}

$new = $buildings['level'];
$max = 1;
$proc = round(100/($max/($new+0.0000001)));if($proc > 100) {$proc = 100;}
if($new>=$max){echo '<div class="bold sh_b small pb2 gray1">Построй оружейную на базе: выполнено!</div>';}else{
echo '<div class="bold sh_b small pb2 gray1">Построй оружейную на базе: '.$new.' / '.$max.'</div>';
echo '<table class="rblock esmall mb0 blue"><tbody><tr><td><div class="value-block lh1"><span><span>'.$new.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$proc.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$max.'</span></span></div></td></tr></tbody></table>';
echo '<a class="simple-but mt5 mb2 a_w50" href="/buildings/"><span><span>Перейти к выполнению</span></span></a>';
}

$new = $user['miss_col'];
$max = 12;
$proc = round(100/($max/($new+0.0000001)));if($proc > 100) {$proc = 100;}
if($new>=$max){echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Выполни '.$max.' простых миссий: выполнено!</div>';}else{
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Выполни '.$max.' простых миссий: '.$new.' / '.$max.'</div>';
echo '<table class="rblock esmall mb0 blue"><tbody><tr><td><div class="value-block lh1"><span><span>'.$new.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$proc.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$max.'</span></span></div></td></tr></tbody></table>';
echo '<a class="simple-but mt5 mb2 a_w50" href="/missions/"><span><span>Перейти к выполнению</span></span></a>';
}

$new = $traning['a_level'];
$max = 16;
$proc = round(100/($max/($new+0.0000001)));if($proc > 100) {$proc = 100;}
if($new>=$max){echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Повысь атаку в тренировке до '.$max.': выполнено!</div>';}else{
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Повысь атаку в тренировке до '.$max.': '.$new.' / '.$max.'</div>';
echo '<table class="rblock esmall mb0 blue"><tbody><tr><td><div class="value-block lh1"><span><span>'.$new.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$proc.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$max.'</span></span></div></td></tr></tbody></table>';
echo '<a class="simple-but mt5 mb2 a_w50" href="/training/'.$user['id'].'/"><span><span>Перейти к выполнению</span></span></a>';
}
}
############################











/* if($medals['medals_id']==3){
echo '<div class="bold sh_b small pb2 gray1">Улучши оптику танка на 15: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Улучши противоосколочный подбой танка на 15: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Проведи 10 битв: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Получи звание рядовой: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Построй оружейную на базе: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Выполни 12 простых миссий: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Повысь атаку в тренировке до 16: выполнено!</div>';
} */












if(isset($_GET['current'.$medals['medals_id'].''])){
if($medals['medals_id']==1 and ($user['kill_tanks']<15 or $buildings['level']<1)){header('Location: ?');exit();}
if($medals['medals_id']==2 and ($buildings['level']<1 and $traning['a_level']<12 and $medals['prog_pvp']>=3 and $users_tanks_pimp['a']<5 and $users_tanks_pimp['p']<5 and $user['login']=='Незнакомец')){header('Location: ?');exit();}
if($medals['medals_id']==3 and ($users_tanks_pimp['3']<15 and $medals['prog_pvp']<10 and $traning['rang']<2 and $buildings['level']<1 and $user['miss_col']<12 and $traning['a_level']<16)){header('Location: ?');exit();}


$mysqli->query('UPDATE `medals_user` SET `done` = "1" WHERE `id` = '.$medals['id'].' LIMIT 1');
if($medals['medals_id']<16){
$res = $mysqli->query('SELECT * FROM `medals` WHERE `id`  = "'.($medals['medals_id']+1).'" limit 1');
$medal = $res->fetch_assoc();
$mysqli->query('INSERT INTO `medals_user` SET `user` = '.$user['id'].', `time` = "'.time().'" , `medals_id` = "'.($medals['medals_id']+1).'" , `name` = "'.$medal['name'].'" ');
}
$_SESSION['ses'] = '<div class="wrap-content pt2"><div class="wrap-content-mini cntr">
<div class="green1 sh_b mb5 bold">Вы получили медаль!</div>
<div class="thumb inbl m3"><img width="50" height="50" src="/images/medals/'.$medals['medals_id'].'.png?2"><span class="mask2">&nbsp;</span></div>
<div class="small white sh_b bold"><span class="green1 medium">'.$medals['name'].'</span><br><span class="green2 small">+10% опыта, +10% серебра</span><br></div>
<div class="clrb"></div></div></div>';
header('Location: ?');
exit();
}








/* 
if($medals['medals_id']==1){
if($medals['prog']>=15){$prog = 'выполнено!';}else{$prog = ''.$medals['prog'].' / '.$medals['prog_max'].'';}
echo '<div class="bold sh_b small pb2 gray1">Уничтожь 15 танков в бою: '.$prog.'</div>';
if($medals['prog']>=1){$prog = 'выполнено!';}else{$prog = ''.$medals['prog'].' / '.$medals['prog_max'].'';}
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Построй шахту на базе: '.$prog.'</div>';
}

if($medals['medals_id']==2){
if($medals['prog']>=1){$prog = 'выполнено!';}else{$prog = ''.$medals['prog'].' / '.$medals['prog_max'].'';}
echo '<div class="bold sh_b small pb2 gray1">Построй полигон на базе: '.$prog.'</div>';
if($medals['prog']>=12){$prog = 'выполнено!';}else{$prog = ''.$medals['prog'].' / '.$medals['prog_max'].'';}
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Повысь атаку в тренировке до 12: '.$prog.'</div>';
if($medals['prog']>=3){$prog = 'выполнено!';}else{$prog = ''.$medals['prog'].' / '.$medals['prog_max'].'';}
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Проведи 3 битвы: '.$prog.'</div>';
if($medals['prog']>=5){$prog = 'выполнено!';}else{$prog = ''.$medals['prog'].' / '.$medals['prog_max'].'';}
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Улучши орудие танка на 5: '.$prog.'</div>';
if($medals['prog']>=5){$prog = 'выполнено!';}else{$prog = ''.$medals['prog'].' / '.$medals['prog_max'].'';}
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Улучши корпус танка на 5: '.$prog.'</div>';
if($medals['prog']>=1){$prog = 'выполнено!';}else{$prog = ''.$medals['prog'].' / '.$medals['prog_max'].'';}
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Сохрани танк: '.$prog.'</div>';
}

if($medals['medals_id']==3){
echo '<div class="bold sh_b small pb2 gray1">Улучши оптику танка на 15: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Улучши противоосколочный подбой танка на 15: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Проведи 10 битв: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Получи звание рядовой: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Построй оружейную на базе: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Выполни 12 простых миссий: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Повысь атаку в тренировке до 16: выполнено!</div>';
}
if($medals['medals_id']==4){
echo '<div class="bold sh_b small pb2 gray1">Проведи 3 схватки: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Поучаствуй в 3 исторических сражениях: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Проведи 15 битв: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Вступи в дивизию: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Выполни 30 простых миссий: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Повысь весь экипаж танка до звания сержант: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Повысь атаку в тренировке до 24: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Повысь броню в тренировке до 24: выполнено!</div>';
}
if($medals['medals_id']==5){
echo '<div class="bold sh_b small pb2 gray1">Улучши апгрейд оптики танка на 2 звезды: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Выполни 75 простых миссий: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Выполни 1 сложную миссию: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Проведи 3 схватки: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Поучаствуй в 3 исторических сражениях: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Уничтожь 250 танков в бою: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Получи звание сержант: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Проведи 20 битв: выполнено!</div>';
}
if($medals['medals_id']==6){
echo '<div class="bold sh_b small pb2 gray1">Улучши орудие на 40: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Улучши противосколочный подбой на 40: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Выполни 100 простых мисий: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Выполни 3 сложные миссии: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Повысь атаку в тренировке до 36: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Проведи 25 битв: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Набери 1750 рейтинга битв: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Уничтожь 300 танков в бою: выполнено!</div>';
}
if($medals['medals_id']==7){
echo '<div class="bold sh_b small pb2 gray1">Улучши полигон на базе до 10 уровня: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Уничтожь 500 танков в бою: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Выполни 125 простых миссий: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Выполни 5 сложных миссий: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Проведи 30 битв: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Улучши стереотрубу в апгрейде на 4 звезды: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Набери 2000 рейтинга битв: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Уничтожь 1 блиндаж: выполнено!</div>';
}
if($medals['medals_id']==8){
echo '<div class="bold sh_b small pb2 gray1">Улучши весь экипаж до звания капитан: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Уничтожь 1000 танков в бою: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Выполни 150 простых миссий: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Выполни 10 сложных миссий: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Поучаствуй в 5 исторических сражениях: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Проведи 35 битв: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Набери 2100 рейтинга битв: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Уничтожь 10 блиндажей: выполнено!</div>';
}
if($medals['medals_id']==9){
echo '<div class="bold sh_b small pb2 gray1">Получи звание лейтенант: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Уничтожь 1 блокпост: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Улучши наклонную броню в апгрейде на 4 звезды: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Уничтожь 1000 танков в бою: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Выполни 200 простых миссий: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Выполни 15 сложных миссий: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Проведи 40 битв: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Набери 2200 рейтинга битв: выполнено!</div>';
}
if($medals['medals_id']==10){
echo '<div class="bold sh_b small pb2 gray1">Улучши полигон на базе до 20 уровня: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Уничтожь 1500 танков в бою: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Выполни 250 простых миссий: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Выполни 20 сложных миссий: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Проведи 45 битв: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Улучши оптику танка до 100: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Набери 2300 рейтинга битв: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Уничтожь 3 блокпоста: выполнено!</div>';
}
if($medals['medals_id']==11){
echo '<div class="bold sh_b small pb2 gray1">Уничтожь 2000 танков в бою: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Повысь атаку в тренировке до 46: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Повысь броню в тренировке до 46: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Улучши шахту на базе до 20 уровня: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Выполни 300 простых миссий: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Выполни 25 сложных миссий: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Проведи 50 битв: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Уничтожь 5 блокпостов: выполнено!</div>';
}
if($medals['medals_id']==12){
echo '<div class="bold sh_b small pb2 gray1">Уничтожь 2500 танков в бою: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Повысь точность в тренировке до 46: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Повысь прочность в тренировке до 46: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Улучши оружейную на базе до 20 уровня: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Выполни 350 простых миссий: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Выполни 30 сложных миссий: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Проведи 50 битв: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Проведи 5 схваток: выполнено!</div>';
}
if($medals['medals_id']==13){
echo '<div class="bold sh_b small pb2 gray1">Улучши апгрейд корпуса танка до 5 звезд: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Улучши апгрейд наклонной брони танка до 5 звезд: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Повысь атаку в тренировке до 54: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Выполни 400 простых миссий: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Выполни 35 сложных миссий: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Проведи 50 битв: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Нанесите 5000 урона в историческом сражении за 1 бой: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Проведи 10 схваток: выполнено!</div>';
}
if($medals['medals_id']==14){
echo '<div class="bold sh_b small pb2 gray1">Улучши склад топлива до 20 уровня: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Получи звание майор: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Выполни 500 простых миссий: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Выполни 50 сложных миссий: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Набери 2500 рейтинга битв: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Улучши умение рикошет до 12%: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Обменяй 50 трофеев: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Уничтожь дот: выполнено!</div>';
}
if($medals['medals_id']==15){
echo '<div class="bold sh_b small pb2 gray1">Уничтожь 10000 танков в бою: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Активируй 10 раз усиление Вера в победу: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Получи звание подполковник: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Улучши умение маскировка до 35%: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Улучши умение рикошет до 21%: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Набери 3000 рейтинга битв: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Попади в тройку лучших в историческом сражении: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Обменяй 100 трофеев: выполнено!</div>';
}
if($medals['medals_id']==16){
echo '<div class="bold sh_b small pb2 gray1">Получи звание полковник: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Улучши умение маскировка до 40%: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Улучши умение рикошет до 24%: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Улучши весь экипаж до звания полковник: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Набери 3500 рейтинга битв: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Активируй 25 раз усиление Вера в победу: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Выиграй в трофеях 5000 золота: выполнено!</div>';
echo '<div class="dhr mt10 mb10"></div><div class="bold sh_b small pb2 gray1">Полностью прокачай базу: выполнено!</div>';
} */
#Всем танкистам с 12 и более старыми медалями, доступны задания для новых медалей!




echo '</div></div></div></div></div></div></div></div></div></div>';
}













$res_с = $mysqli->query("SELECT COUNT(*) FROM `medals_user` WHERE `user` = '".$user['id']."' and `done` = '1' ");
$col_medals = $res_с->fetch_array(MYSQLI_NUM);
if($col_medals[0]>0){
echo '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="cntr fs'.$col_medals[0].' mb2">';

$k_post = 1; // Инициализация переменной
$res = $mysqli->query('SELECT * FROM `medals_user` WHERE `user` = "'.$user['id'].'" and `done` = "1" ORDER BY `medals_id` asc LIMIT 16');

while ($medals_user = $res->fetch_array()){
    $post = $k_post++;
    if ($post % 4 == 1) {
        echo '<div class="row">'; // Начинаем новый ряд для каждой первой медали
    }
    echo '<span><em><img class="m3" src="/images/medals/'.$medals_user['medals_id'].'.png?2" alt="'.$medals_user['name'].'" title="'.$medals_user['name'].'"></em></span>';
    if ($post % 4 == 0 || $post == 16) {
        echo '</div>'; // Закрываем ряд после четвертой медали или если это последняя медаль
    }
}
echo '</div></div>
<div class="mt5 mb5 small green2 cntr">Бонус твоих обычных медалей: <br><span class="bold">+'.($col_medals[0]*10).'%</span>  к опыту и <span class="bold">+'.($col_medals[0]*10).'%</span>  к серебру</div>
</div></div></div></div></div></div></div></div></div></div>';
}





echo '<a class="simple-but gray mb5" w:id="missionsLink" href="/missions/"><span><span>Вернуться к миссиям</span></span></a>';



echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">Бонус за обычную медаль: +10% к опыту и +10% к серебру</div>
</div></div></div></div></div></div></div></div></div></div>';

require_once ('../system/footer.php');
?>