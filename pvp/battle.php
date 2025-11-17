<?php
$title = 'Битвы';
require_once ('../system/function.php');
//require_once ('../system/header.php');
/* <meta http-equiv="Refresh" content="15" /> */
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="Keywords" content="Танки, игры, RPG, MMORPG, онлайн игра, онлайн, wap, бесплатно, играть онлайн, ролевые игры, лучшие онлайн игры, браузерная игра, сражения, бои, турниры, задания, битвы, поле боя">
<meta name="google" content="notranslate">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Танки">
<meta property="og:title" content="Танки">
<meta property="og:description" content="Погрузись в мир танков, учавствуй в легендарных сражениях, покажи на что ты способен!">
<meta property="og:url" content="https://mtank.ru/?">
<meta property="og:locale" content="ru_RU">
<meta property="og:image" content="/images/logo.jpg">
<meta property="og:image:width" content="2560">
<meta property="og:image:height" content="1024">

<link rel="icon" href="/favicon.ico" type="image/png">
<link rel="stylesheet" type="text/css" href="/diz.css"><title>Танки</title>
<style>
      .scale {
        transform: scale(-1, 1);
      }
</style>
<head>

<?
if(!$user['id']){
header('Location: /');
exit();
}


##############################################################################################################
########################################### СИСТЕМА АВТОНАЧИСЛЕНИЯ ###########################################
##############################################################################################################
$kolvo = (time()-$user['viz']);
$sec = 7;
if(($user['fuel'])<$user['fuel_max']){
if($kolvo>=$sec){
$f = ceil($kolvo/$sec);
if(($f+$user['fuel'])<=$user['fuel_max']){
$mysqli->query("UPDATE `users` SET `fuel` = '".($user['fuel']+$f)."', `fuel_time` = '".time()."' WHERE `id` = '".$user['id']."' LIMIT 1");
}else{
$mysqli->query("UPDATE `users` SET `fuel` = '".$user['fuel_max']."', `fuel_time` = '".time()."' WHERE `id` = '".$user['id']."' LIMIT 1");
}
}else{
if(($user['fuel_time']+$sec) < time()){
if((1+$user['fuel'])<=$user['fuel_max']){
$mysqli->query("UPDATE `users` SET `fuel` = '".($user['fuel']+1)."', `fuel_time` = '".time()."' WHERE `id` = '".$user['id']."' LIMIT 1");
}else{
$mysqli->query("UPDATE `users` SET `fuel` = '".$user['fuel_max']."', `fuel_time` = '".time()."' WHERE `id` = '".$user['id']."' LIMIT 1");
}
}
}
}
##############################################################################################################
##############################################################################################################
##############################################################################################################




//$site = microtime(1);
//$ttt = microtime(1);




$res11 = $mysqli->query('SELECT * FROM `pvp_user` WHERE `user` = "'.$user['id'].'" ');
$p_u = $res11->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `pvp` WHERE `id` = "'.$p_u['pvp_id'].'" ');
$p = $res->fetch_assoc();

if(!$p){header('Location: /pvp/');exit();}
if(!$p_u){header('Location: /pvp/');exit();}

$res = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$user['id'].'" ');
$traning = $res->fetch_assoc();

$res_t = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = "'.$user['id'].'" and `active`  = "1" LIMIT 1');
$us_tank = $res_t->fetch_assoc();



################### Подготовленные запросы ###################

### создаем логи
$stmtl = $mysqli->prepare("INSERT INTO pvp_log (time, text, pvp_id, user, ank) VALUES (?, ?, ?, ?, ?)");
$stmtl->bind_param("sssss", $time, $text, $pvp_id, $user_res, $ank);

### создаем один запрос к pvp_user на все случаи жизни
$stmt = $mysqli->prepare ("UPDATE `pvp_user` SET `time_rem` =  ?, `time_manevr` =  ?, `time_attack` =  ?, `goal` =  ?, `p` = ? WHERE `id` = ? LIMIT 1");
$stmt->bind_param("ssssss", $time_rem, $time_manevr, $time_attack, $goal, $hp, $id);

### подбор противника
$stmt_g = $mysqli->prepare('SELECT t.id FROM pvp_user as t,
            (SELECT ROUND((SELECT MAX(id) FROM pvp_user) * rand()) as rnd FROM pvp_user) tmp
            WHERE t.id >= (rnd) and `user` != ? and `user` != ? and `pvp_id` = ? and `p` > ? 
			ORDER BY camouflage asc 
			LIMIT 1');
$stmt_g->bind_param("ssss", $user_res,$user_ank,$pvp_id,$hp_ank);

### выполняем миссии
$stmt_mis = $mysqli->prepare("UPDATE `missions_user` SET `prog` = `prog` + ? WHERE `user` = ? and `id_miss` =  ? and `prog` < ? and `time` < ? and `country` = ? LIMIT 1");
$stmt_mis->bind_param("ssssss", $prog, $user_m, $id_miss, $prog_max, $time, $country);






$res = $mysqli->query('SELECT * FROM `pvp_user` WHERE `pvp_id` = "'.$p_u['pvp_id'].'" and `id` = "'.$p_u['goal'].'" LIMIT 1');
$p_u_ank = $res->fetch_assoc();

if(($p_u_ank['p']<=0 ) or $p_u['goal']<=0){// and $p_u['goal']==$p_u_ank['id']
$user_res = $user['id'];$user_ank = $user['id'];$pvp_id = $p_u['pvp_id'];$hp_ank = 0;$stmt_g->execute();$stmt_g = $stmt_g->get_result();$goal = $stmt_g->fetch_assoc(); // подбираем противника тем у кого его нету 
$mysqli->query("UPDATE `pvp_user` SET `goal` = '".$goal['id']."' WHERE `id` = '".$p_u['id']."' ");
/* header('Location: ?');
exit(); */
}

$res = $mysqli->query('SELECT id, login, pvp_rate FROM `users` WHERE `id` = "'.$p_u_ank['user'].'" ');
$us_ank = $res->fetch_assoc();






if($p['time_battle']<time() and $p['time_battle']>0){
$mysqli->query('DELETE FROM `pvp` WHERE `id` = "'.$p_u['pvp_id'].'" ');
$mysqli->query('DELETE FROM `pvp_log` WHERE `pvp_id` = "'.$p_u['pvp_id'].'" ');
$mysqli->query('DELETE FROM `pvp_user` WHERE `pvp_id` = "'.$p_u['pvp_id'].'" ');
header('Location: /pvp/');
exit();
//echo 'КОНЕЦ КОНЕЦ КОНЕЦ КОНЕЦ КОНЕЦ КОНЕЦ КОНЕЦ ';
}














$resb_s = $mysqli->query('SELECT tip, bon_col FROM `boevaya_sila` WHERE `user` = "'.$user['id'].'" and `local` = "1" limit 1');
$b_s = $resb_s->fetch_assoc();
if($b_s['tip']==1){$param = 50;}elseif($b_s['tip']==2){$param = 100;}elseif($b_s['tip']==3){$param = 150;}
if($b_s['bon_col'] >0 ){
$us_tank['a'] = ($us_tank['a']+$param);$us_tank['b'] = ($us_tank['b']+$param);$us_tank['t'] = ($us_tank['t']+$param);$us_tank['p'] = ($us_tank['p']+$param);
}else{
$us_tank['a'] = $us_tank['a'];$us_tank['b'] = $us_tank['b'];$us_tank['t'] = $us_tank['t'];$us_tank['p'] = $us_tank['p'];
}

$res = $mysqli->query('SELECT country, tip, name FROM `tanks` WHERE `id` = '.$us_tank['tip'].' LIMIT 1');
$tank = $res->fetch_assoc();

if($tank['country']=='GERMANY'){$country_us = 1;}
if($tank['country']=='SSSR'){$country_us = 2;}
if($tank['country']=='USA'){$country_us = 3;}

if($tank['tip'] == 1){$tip_tank = 'average';$tip_tank_ru = 'СРЕДНИЙ ТАНК';} // СТ
if($tank['tip'] == 2){$tip_tank = 'heavy';$tip_tank_ru = 'ТЯЖЕЛЫЙ ТАНК';} // ТТ
if($tank['tip'] == 3){$tip_tank = 'SAU';$tip_tank_ru = 'ПТ-САУ';} // САУ






//скорее всего можно исправить поставив условие на переменную данного запросп на кол-во танков оставшихся в бою так как ошибка выскочила при подведении итогов и анк не определился (после обновлении страницы ошибка не пропала)
$resat = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = "'.$us_ank['id'].'" and `active`  = "1" LIMIT 1');
$ank_tank = $resat->fetch_assoc();

$resb_s = $mysqli->query('SELECT tip, bon_col FROM `boevaya_sila` WHERE `user` = "'.$us_ank['id'].'" and `local` = "1" limit 1');
$b_s_ank = $resb_s->fetch_assoc();

if($b_s_ank['tip']==1){$param_ank = 50;}elseif($b_s_ank['tip']==2){$param_ank = 100;}elseif($b_s_ank['tip']==3){$param_ank = 150;}
if($b_s_ank['bon_col'] >0 ){
$ank_tank['a'] = ($ank_tank['a']+$param_ank);$ank_tank['b'] = ($ank_tank['b']+$param_ank);$ank_tank['t'] = ($ank_tank['t']+$param_ank);$ank_tank['p'] = ($ank_tank['p']+$param_ank);
}else{
$ank_tank['a'] = $ank_tank['a'];$ank_tank['b'] = $ank_tank['b'];$ank_tank['t'] = $ank_tank['t'];$ank_tank['p'] = $ank_tank['p'];
}

$res = $mysqli->query('SELECT tip, name, country FROM `tanks` WHERE `id` = "'.$ank_tank['tip'].'" LIMIT 1');
$tank_ = $res->fetch_assoc();

if($tank_['tip'] == 1){$tip_tank_ = 'average';$tip_tank_ru_ = 'СРЕДНИЙ ТАНК';} // СТ
if($tank_['tip'] == 2){$tip_tank_ = 'heavy';$tip_tank_ru_ = 'ТЯЖЕЛЫЙ ТАНК';} // ТТ
if($tank_['tip'] == 3){$tip_tank_ = 'SAU';$tip_tank_ru_ = 'ПТ-САУ';} // САУ

$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user`  = "'.$user['id'].'" LIMIT 1');
$a_users = $res->fetch_assoc();


$usP = round(100/(($us_tank['p']*2)/(($p_u['p'])+0.00001)));
if($usP > 100) {$usP = 100;}
$usA = round(100/((($ank_tank['p']*2)/(($p_u_ank['p'])+0.00001))+0.00001));
if($usA > 100) {$usA = 100;}














echo '<div class="p5" id="p5">';



if($p_u['p']>0){

if($tank_['tip']==1){
$butt = 'БРОНЕБОЙНЫЕ&nbsp;('.$a_users['b'].')';
$img = 'ArmorPiercing';
$href = 'attack'.$p_u_ank['id'].'_bb';
}elseif($tank_['tip']==2){
$butt = 'КУМУЛЯТИВНЫЕ&nbsp;('.$a_users['k'].')';
$img = 'HollowCharge';
$href = 'attack'.$p_u_ank['id'].'_k';
}elseif($tank_['tip']==3){
$butt = 'ФУГАСНЫЕ&nbsp;('.$a_users['f'].')';
$img = 'HighExplosive';
$href = 'attack'.$p_u_ank['id'].'_f';
}

if($usP>75){$us_i = '';}
if($usP>40 && $usP<=75){$us_i = '/'.$tank['name'].'_1';}
if($usP>15 && $usP<=40){$us_i = '/'.$tank['name'].'_2';}
if($usP<=15){$us_i = '/'.$tank['name'].'_3';}

if($usA>75){$ank_i = '';}
if($usA>40 && $usA<=75){$ank_i = '/'.$tank_['name'].'_1';}
if($usA>15 && $usA<=40){$ank_i = '/'.$tank_['name'].'_2';}
if($usA<=15){$ank_i = '/'.$tank_['name'].'_3';}

echo '<table><tbody><tr>
<td class="w50 pr1">
<div class="trnt-block mb10"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="p5 cntr custombg boi_1" w:id="heroDiv">
<div class="small bold green1 sh_b mb10 mt5">'.$user['login'].'</div>
<img class="scale" class="tank-img" w:id="heroTankImg" src="/images/tanks/'.$tip_tank.'/'.$tank['country'].'/'.$tank['name'].''.$us_i.'.png" alt="'.$user['login'].'" style="width:88%;">';


echo '<table class="rblock esmall"><tbody><tr>
<td class="progr rate-block"><div class="scale-block"><div class="scale-next" style="width:100%;"><div class="scale" style="width:'.$usP.'%;"><div class="in">&nbsp;</div></div></div><div class="mask"><div class="in">&nbsp;</div></div></div></td>
<td><div class="value-block lh1"><span><span>'.$p_u['p'].'</span></span></div></td>
</tr></tbody></table>
</div></div></div></div></div></div></div></div></div></div></td>';





echo '<td class="w50 pl1">
<div class="trnt-block mb10"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="p5 cntr custombg boi_1" w:id="targetDiv">
<div class="small bold red1 sh_b mb10 mt5">'.$us_ank['login'].'</div><img class="tank-img" w:id="targetTankImg" src="/images/tanks/'.$tip_tank_.'/'.$tank_['country'].'/'.$tank_['name'].''.$ank_i.'.png" alt="'.$us_ank['login'].'" style="width:88%;">';

echo '<table class="rblock esmall"><tbody><tr>
<td class="progr rate-block">
<div class="scale-block"><div class="scale-next" style="width:100%;"><div class="scale" style="width:'.$usA.'%;"><div class="in">&nbsp;</div></div></div>
<div class="mask"><div class="in">&nbsp;</div></div></div>
</td>
<td><div class="value-block lh1"><span><span>'.$p_u_ank['p'].'</span></span></div></td>
</tr></tbody></table>';

echo '</div></div></div></div></div></div></div></div></div></div>
</td>
</tr></tbody></table>';

echo '<table><tbody><tr>
<td class="w50 pr5"><a w:id="attackRegularShellLink" href="?attack'.$p_u_ank['id'].'" class="simple-but gray"><span><span>ОБЫЧНЫЕ</span></span></a></td>
<td class="w50 pl5"><a w:id="attackSpecialShellLink" href="?'.$href.'" class="simple-but"><span><span>'.$butt.'</span></span></a></td>
</tr></tbody></table>';

/* 
if($p_u['time_attack']<time()){
echo '<div id="submitButton1" class="progress-button" data-loading="Перезарядка.." data-finished="К выстрелу готов!" style="width: 100%">К выстрелу готов!<span class="tz-bar background-horizontal"></span></div>';
}else{
echo '<div id="submitButton" class="progress-button" data-loading="Перезарядка.." data-finished="К выстрелу готов!" style="width: 100%"><span class="tz-bar background-horizontal"></span></div>';
} */



echo '<table><tbody><tr>';
if($p_u['time_rem']>time()){
echo '<td style="width:33%;padding-right:6px;"><a w:id="repairLink" href="?rem" class="simple-but blue"><span><span>'.tls($p_u['time_rem']-time()).' сек</span></span></a></td>';
}else{
echo '<td style="width:33%;padding-right:6px;"><a w:id="repairLink" href="?rem" class="simple-but blue"><span><span>Ремкомплект</span></span></a></td>';
}
if($p_u['time_manevr']>time()){
echo '<td style="width:33%;padding:0 2px;"><a w:id="maneuverLink" href="?manevr" class="simple-but blue"><span><span>'.tls($p_u['time_manevr']-time()).' сек</span></span></a></td>';
}else{
echo '<td style="width:33%;padding:0 2px;"><a w:id="maneuverLink" href="?manevr" class="simple-but blue"><span><span>Маневр</span></span></a></td>';
}
echo '<td style="width:33%;padding-left:6px;"><a w:id="changeTargetLink" href="?smena'.$p_u['id'].'" class="simple-but blue"><span><span>Сменить цель</span></span></a></td>
</tr></tbody></table>';


}elsE{
echo '<a w:id="refreshLink" href="?" class="simple-but"><span><span>Обновить</span></span></a>';
}

//echo '<br><hr>ШАПКА '.round(microtime(1) - $ttt, 4).' сек<br>';



































//$ttt2 = microtime(1);
###########################################################################################################################################
###########################################################################################################################################
###########################################################################################################################################
if(isset($_GET['rem'])){ // ремка
if($p['time_battle']<time()){header('Location: ?');exit();}
if(!$p_u){header('Location: ?');exit();}
if(!$p){header('Location: ?');exit();}
if($p_u['time_rem']>time()){header('Location: ?');exit();}
if($p_u['p']<=0){header('Location: ?');exit();}
if($a_users['rem']<=0){$text = "<span class='gray1'>У вас нет ремкомплекта</span>";$time = time();$text = $text;$pvp_id = $p['id'];$user_res = $user['id'];$ank = 0;$stmtl->execute();header('Location: ?');exit();}
$mysqli->query("UPDATE `ammunition_users` SET `rem` = '".($a_users['rem']-1)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
$res = $mysqli->query('SELECT * FROM `skills_user` WHERE `user` = "'.$p_u['user'].'" and `tip` = "4" LIMIT 1');
$skills_u = $res->fetch_assoc();
$time_rem = (time()+$skills_u['bon']);$time_manevr = $p_u['time_manevr'];$time_attack = $p_u['time_attack'];$goal = $p_u['goal'];$hp = (($us_tank['p']*2));$id = $p_u['id'];$stmt->execute();// применили ремку, обновили таймер и свое хп
$text = "<span class='yellow1 td_u'>".$user['login']."</span> <span class='blue2'>использовал ремкомплект</span>";
$time = time();$text = $text;$pvp_id = $p['id'];$user_res = 0;$ank = 0;$stmtl->execute();
header('Location: ?');
exit();
}
###########################################################################################################################################
###########################################################################################################################################
###########################################################################################################################################








###########################################################################################################################################
###########################################################################################################################################
###########################################################################################################################################
if(isset($_GET['manevr'])){ // маневр
if($p['time_battle']<time()){header('Location: /pvp/battle/');exit();}
if($p_u['time_manevr']>time()){header('Location: /pvp/battle/');exit();}
if(!$p_u){header('Location: /pvp/battle/');exit();}
if(!$p){header('Location: /pvp/battle/');exit();}
if($p_u['p']<=0){header('Location: /pvp/battle/');exit();}
if($p['col_user']>2){
$c_u_m_i_ = $mysqli->query('SELECT id FROM `pvp_user` WHERE `goal` = "'.$p_u['id'].'" ');
while ($c_u_m_i = $c_u_m_i_->fetch_array()){
$user_res = $user['id'];$user_ank = $user['id'];$pvp_id = $p_u['pvp_id'];$hp_ank = 0;$stmt_g->execute();$res_g = $stmt_g->get_result();$goal_a = $res_g->fetch_assoc(); // подбираем врагу другого противника
$time_rem = $p_u['time_rem'];$time_manevr = $p_u['time_manevr'];$time_attack = $p_u['time_attack'];$goal = $goal_a['id'];$hp = $p_u['p'];$id = $c_u_m_i['id'];$stmt->execute();
}
}
$time_rem = $p_u['time_rem'];$time_manevr = (time()+20);$time_attack = $p_u['time_attack'];$goal = $p_u['goal'];$hp = $p_u['p'];$id = $p_u['id'];$stmt->execute();
$text = "<span class='yellow1 td_u'>".$user['login']."</span> <span class='blue2'>применил маневр</span>";
$time = time();$text = $text;$pvp_id = $p['id'];$user_res = 0;$ank = 0;$stmtl->execute(); // создаем логи боя
header('Location: /pvp/battle/');
exit();
}
###########################################################################################################################################
###########################################################################################################################################
###########################################################################################################################################










###########################################################################################################################################
###########################################################################################################################################
###########################################################################################################################################
for ($i = 1; $i <= 5; $i++) {
if($i==1){$get = 'smena'.$p_u['id'].'';}
if($i==2){$get = 'attack'.$p_u_ank['id'].'';}
if($i==3){$get = 'attack'.$p_u_ank['id'].'_bb';}
if($i==4){$get = 'attack'.$p_u_ank['id'].'_k';}
if($i==5){$get = 'attack'.$p_u_ank['id'].'_f';}
if(isset($_GET[''.$get.''])){
if($p['time_battle']<time()){header('Location: ?');exit();}
if(!$p_u){header('Location: ?');exit();}
if(!$p){header('Location: ?');exit();}
if($p_u['p']<=0){header('Location: ?');exit();}
if($p_u_ank['p']<=0){header('Location: ?');exit();} // можно сделать вместо переадресации удар по новому противнику, или назначить нового противника
if($i==3){if($a_users['b']<=0){$text = "<span class='gray1'>У вас нет такого снаряда</span>";$time = time();$text = $text;$pvp_id = $p['id'];$user_res = $user['id'];$ank = 0;$stmtl->execute();header('Location: ?');exit();}}
if($i==4){if($a_users['k']<=0){$text = "<span class='gray1'>У вас нет такого снаряда</span>";$time = time();$text = $text;$pvp_id = $p['id'];$user_res = $user['id'];$ank = 0;$stmtl->execute();header('Location: ?');exit();}}
if($i==5){if($a_users['f']<=0){$text = "<span class='gray1'>У вас нет такого снаряда</span>";$time = time();$text = $text;$pvp_id = $p['id'];$user_res = $user['id'];$ank = 0;$stmtl->execute();header('Location: ?');exit();}}
if(($p_u['time_attack']-time()) >= 3){$text = "<span class='gray1'>Снаряд ещё не заряжен</span>";$time = time();$text = $text;$pvp_id = $p['id'];$user_res = $user['id'];$ank = 0;$stmtl->execute();header('Location: ?');exit();}

if($i==1){ // смена цели для первой кнопки
if($p['col_user']>2){ // если нас только двое, значит мне ненакого сменить
$user_res = $user['id'];$user_ank = $p_u_ank['user'];$pvp_id = $p_u['pvp_id'];$hp_ank = 0;$stmt_g->execute();$res = $stmt_g->get_result();$goal_1 = $res->fetch_assoc(); // подбираем врагу другого противника
$time_rem = $p_u['time_rem'];$time_manevr = $p_u['time_manevr'];$time_attack = $p_u['time_attack'];$goal = $goal_1['id'];$hp = $p_u['p'];$id = $p_u['id'];$stmt->execute(); // назначаем себе другого противника
$res = $mysqli->query('SELECT user, p FROM `pvp_user` WHERE `pvp_id` = "'.$p_u['pvp_id'].'" and `id` = "'.$goal_1['id'].'" LIMIT 1');
$p_u_ank = $res->fetch_assoc();#########
$res = $mysqli->query('SELECT id, login, pvp_rate FROM `users` WHERE `id` = "'.$p_u_ank['user'].'" LIMIT 1');
$us_ank = $res->fetch_assoc();#########
$res = $mysqli->query('SELECT b, tip_tank FROM `users_tanks` WHERE `user` = '.$us_ank['id'].' and `active`  = "1" LIMIT 1');
$ank_tank = $res->fetch_assoc();#########
}elseif($p['col_user']<=2){
$goal_1['id'] = $p_u['goal'];
}
}elseif($i>1){
$goal_1['id'] = $p_u['goal'];
}

#####################################################################################
#####################################################################################
#####################################################################################
if($p_u_ank['p']<=0){header('Location: ?');exit();}
if($ank_tank['b']<500){$armor = ($ank_tank['b']/10);}else{$armor = ($ank_tank['b']/40);}
$attack = (($us_tank['a']/4) -(($us_tank['a']/4)*$armor/100) );
##################################################################################### умения
$res_s3 = $mysqli->query('SELECT bon FROM `skills_user` WHERE `tip`  = "3" and `user`  = "'.$user['id'].'" LIMIT 1');
$skills_3 = $res_s3->fetch_assoc(); // Слабые места
$res_s2 = $mysqli->query('SELECT bon FROM `skills_user` WHERE `tip`  = "2" and `user`  = "'.$p_u_ank['user'].'" LIMIT 1');
$skills_2 = $res_s2->fetch_assoc(); // Рикошет
$res_s5 = $mysqli->query('SELECT bon FROM `skills_user` WHERE `tip`  = "5" and `user`  = "'.$user['id'].'" LIMIT 1');
$skills_5 = $res_s5->fetch_assoc(); // Снайпер
$rand_s2 = rand(1,100); // Рикошет
$rand_s3 = rand(1,100); // Слабые места
if($rand_s3 <= $skills_3['bon']){if($skills_5['bon']>0){$attack = floor($attack+($attack*(rand($skills_5['bon'],($skills_5['bon']+50)))/100));$txt_krit = '<span class="red1">(крит)</span>';}elsE{$attack = $attack;$txt_krit = '';}}

if(($p_u['time_attack']-time()) >= 3){
$attack = 0;
}elseif(($p_u['time_attack']-time()) == 2){
$attack = ($attack*20/100);
}elseif(($p_u['time_attack']-time()) == 1){
$attack = ($attack*60/100);
}elseif(($p_u['time_attack']-time()) <= 0){
$attack = $attack;
}

$res = $mysqli->query('SELECT id, o_, b_, k_, f_, o, b, k, f FROM `shellskills` WHERE `user` = "'.$user['id'].'" LIMIT 1');
$shell_s = $res->fetch_assoc();
if($i==1){$imag = 'Regular';$navik = $shell_s['o'];}if($i==2){$imag = 'Regular';$navik = $shell_s['o'];}if($i==3){$imag = 'ArmorPiercing';$navik = $shell_s['b'];}if($i==4){$imag = 'HollowCharge';$navik = $shell_s['k'];}if($i==5){$imag = 'HighExplosive';$navik = $shell_s['f'];}
if($i>=3){$bonus_sh = 50;$razbros = 5;}else{$bonus_sh = 0;$razbros = 10;}

$res = $mysqli->query('SELECT time1, time3, time4 FROM `vip` WHERE `user` = "'.$user['id'].'" LIMIT 1');
$vip = $res->fetch_assoc();

if($vip['time1']>time()){$v1 = 25;}elsE{$v1 = 0;}
if($vip['time3']>time()){$v3 = 50;}elsE{$v3 = 0;}
if($vip['time4']>time()){$v4 = 50;}elsE{$v4 = 0;}
$attack = ($attack+ ($attack*($navik+$bonus_sh+$v1+$v3+$v4)/100));
$attack = ($attack- ($attack*rand(0.1,$razbros)/100));
if($attack>=$p_u_ank['p']){$attack = ceil($p_u_ank['p']);}else{$attack = ceil($attack);}
##################################################################################################
##################################################################################################

##############
if($user['pvp_tip']==3){$mnog = 4;}else{$mnog = 2;}
if($user['pvp_rate']<=$us_ank['pvp_rate']){
$rate = ceil((sqrt( (($us_ank['pvp_rate']-($user['pvp_rate']-$us_ank['pvp_rate']))*100/$user['pvp_rate'])  *  ((($us_ank['pvp_rate']-$user['pvp_rate']))*100/$user['pvp_rate']) ))/$mnog);
}else{
$rate = ceil((sqrt( (($user['pvp_rate']-($user['pvp_rate']-$us_ank['pvp_rate']))*100/$us_ank['pvp_rate'])  -  ((($user['pvp_rate']-$us_ank['pvp_rate']))*100/$us_ank['pvp_rate']) ))/$mnog);
}
if(is_nan($rate)==true){$rate = 0;}//if(is_nan($rate)=='NAN'){$rate = 0;}
##############

if($rand_s2 <= $skills_2['bon']){ // Рикошет
$text = "<span class='blue1'>РИКОШЕТ: </span><span class='yellow1 td_u'>".$user['login']."</span> <img src='/images/shells/".$imag.".png'> выстрелил в <span class='yellow1 td_u'>".$us_ank['login']."</span> на <span class='red1'>0 урона ".$txt_krit." </span>";
$time = time();$text = $text;$pvp_id = $p['id'];$user_res = $user['id'];$ank = $us_ank['id'];$stmtl->execute(); // логи
$mysqli->query("UPDATE `pvp_user` SET `time_attack` = '".(time()+5)."' WHERE `id` = '".$p_u['id']."' ");
header('Location: ?');
exit();
}else{
$text = "<span class='yellow1 td_u'>".$user['login']."</span> <img src='/images/shells/".$imag.".png'> выстрелил в <span class='yellow1 td_u'>".$us_ank['login']."</span> на <span class='red1'>".$attack." урона ".$txt_krit." </span>";
$time = time();$text = $text;$pvp_id = $p['id'];$user_res = $user['id'];$ank = $us_ank['id'];$stmtl->execute(); // логи
$mysqli->query("UPDATE `pvp_user` SET `time_attack` = '".(time()+5)."' WHERE `id` = '".$p_u['id']."' ");
################################################
$mysqli->query("UPDATE `pvp_user` SET `p` = `p` - '".($attack)."' WHERE `id` = '".$p_u['goal']."' ");
if($i==1){$mysqli->query("UPDATE `shellskills` SET `o_` = '".($shell_s['o_']+1)."' WHERE `id` = '".$shell_s['id']."' LIMIT 1");}
if($i==2){$mysqli->query("UPDATE `shellskills` SET `o_` = '".($shell_s['o_']+1)."' WHERE `id` = '".$shell_s['id']."' LIMIT 1");}
if($i==3){$mysqli->query("UPDATE `ammunition_users` SET `b` = '".($a_users['b']-1)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");$mysqli->query("UPDATE `shellskills` SET `b_` = '".($shell_s['b_']+1)."' WHERE `id` = '".$shell_s['id']."' LIMIT 1");}
if($i==4){$mysqli->query("UPDATE `ammunition_users` SET `k` = '".($a_users['k']-1)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");$mysqli->query("UPDATE `shellskills` SET `k_` = '".($shell_s['k_']+1)."' WHERE `id` = '".$shell_s['id']."' LIMIT 1");}
if($i==5){$mysqli->query("UPDATE `ammunition_users` SET `f` = '".($a_users['f']-1)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");$mysqli->query("UPDATE `shellskills` SET `f_` = '".($shell_s['f_']+1)."' WHERE `id` = '".$shell_s['id']."' LIMIT 1");}
################################################
if($attack>=$p_u_ank['p']){// последний удар.. считаем рейт и завершаем битву
$text = "<span class='orange'><span class='yellow1 td_u'>".$user['login']."</span> уничтожил <span class='yellow1 td_u'>".$us_ank['login']."</span></span>";
$time = time();$text = $text;$pvp_id = $p['id'];$user_res = 0;$ank = 0;$stmtl->execute(); // логи
$mysqli->query("UPDATE `pvp` SET `col_user` = `col_user` - '1' WHERE `id` = '".$p['id']."' LIMIT 1");
################################################
if($p['col_user']>2){ // убиваю противника, в бою еще более 2 чел, выдаю рейт, назначаю себе нового противника, продолжаем...
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + ".-($rate/2).", `number` = ".($p['col_user'])." WHERE `pvp_id` = ".$p_u['pvp_id']." and `user` = ".$p_u_ank['user']." LIMIT 1");### выдаем рейт убитому
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + ".$rate." WHERE `pvp_id` = ".$p_u['pvp_id']." and `user` = ".$p_u['user']."  LIMIT 1");### выдаем рейт себе
}else{
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + ".-($rate/2).", `number` = '2' WHERE `pvp_id` = ".$p_u['pvp_id']." and `user` = ".$p_u_ank['user']." LIMIT 1");### выдаем рейт убитому
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + ".$rate.", `number` = '1' WHERE `pvp_id` = ".$p_u['pvp_id']." and `user` = ".$p_u['user']."  LIMIT 1");### выдаем рейт себе
}
$c_u_m_i_ = $mysqli->query('SELECT id, user FROM `pvp_user` WHERE `pvp_id` = "'.$p['id'].'" and `user` != "'.$p_u['user'].'" and `goal` = "'.$p_u['goal'].'" and `p` > "0" '); // все у кого тот же противник что и у меня
while ($c_u_m_i = $c_u_m_i_->fetch_array()){ // назначаем другого противникау всем у кого мой противник
$user_res = $c_u_m_i['user'];$user_ank = $p_u_ank['user'];$pvp_id = $p_u['pvp_id'];$hp_ank = 0;$stmt_g->execute();$res = $stmt_g->get_result();$goal_ = $res->fetch_assoc(); // подбираем себе другого противника
$mysqli->query("UPDATE `pvp_user` SET `goal` = '".$goal_['id']."' WHERE `id` = '".$c_u_m_i['id']."' ");
}
################################################ МИССИИ
if($ank_tank['tip_tank']==1){
$prog = 1;$user_m = $user['id'];$id_miss = 30;$prog_max = 10;$time = time();$country = $country_us;$stmt_mis->execute();// 
$prog = 1;$user_m = $user['id'];$id_miss = 33;$prog_max = 50;$time = time();$country = $country_us;$stmt_mis->execute();// 
}
if($ank_tank['tip_tank']==2){
$prog = 1;$user_m = $user['id'];$id_miss = 31;$prog_max = 10;$time = time();$country = $country_us;$stmt_mis->execute();// 
$prog = 1;$user_m = $user['id'];$id_miss = 34;$prog_max = 50;$time = time();$country = $country_us;$stmt_mis->execute();// 
}
if($ank_tank['tip_tank']==3){
$prog = 1;$user_m = $user['id'];$id_miss = 29;$prog_max = 10;$time = time();$country = $country_us;$stmt_mis->execute();// 
$prog = 1;$user_m = $user['id'];$id_miss = 32;$prog_max = 50;$time = time();$country = $country_us;$stmt_mis->execute();// 
}
################################################ МИССИИ

}
header('Location: ?');
exit();
}



/* header('Location: ?');
exit(); */
}

}
###########################################################################################################################################
###########################################################################################################################################
###########################################################################################################################################
//echo '<br><hr>КНОПКИ '.round(microtime(1) - $ttt2, 4).' сек<br>';








//$ttt1 = microtime(1);
###########################################################################################################################################
###########################################################################################################################################
###########################################################################################################################################
echo '<div class="medium bold white cntr mb5">Танков в бою: '.$p['col_user'].'</div>';
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content small white">';
$res1 = $mysqli->query('SELECT * FROM `pvp_log` WHERE `pvp_id` = '.$p['id'].' and (`user` = '.$user['id'].' or `user` = 0 or `ank` = '.$user['id'].') ORDER BY `id` desc LIMIT 20');
while ($t_r1 = $res1->fetch_array()){
if($t_r1['user']==$user['id'] or $t_r1['ank']==$user['id']){
echo ''.$t_r1['text'].'<br>';
}else{
if($t_r1['user']==0){
echo ''.$t_r1['text'].'<br>';
}
}
}
echo '</div></div></div></div></div></div></div></div></div></div>';
//echo '<a w:id="escapeLink" href="pvp?1-37.ILinkListener-escapeLink" class="simple-but gray"><span><span>Покинуть бой</span></span></a>';
echo '<div class="footer"></div>';

###########################################################################################################################################
###########################################################################################################################################
###########################################################################################################################################
//echo '<br><hr>ЛОГИ '.round(microtime(1) - $ttt1, 4).' сек<br>';

echo '</div>';































$col_u_ = $mysqli->query("SELECT COUNT(*) FROM `pvp_user` WHERE `pvp_id` = ".$p_u['pvp_id']." and `p` > '0' ");
$col_u = $col_u_->fetch_array(MYSQLI_NUM);
if($p['col_user']<=1 or $col_u[0]<=1 and $p['user']!=0){
$mysqli->query("UPDATE `pvp` SET `user` = '0' WHERE `id` = '".$p['id']."' LIMIT 1"); 
}



###########################################################################################################################################
###########################################################################################################################################
###########################################################################################################################################
if($p['user']==0){
//$ttt5 = microtime(1);
$mysqli->query("UPDATE `pvp` SET `user` = '1' WHERE `id` = '".$p['id']."' LIMIT 1"); 
//echo '<br><hr>UPDATE 1 - '.round(microtime(1) - $ttt5, 4).' сек';


//$ttt3 = microtime(1);
##########################################################################################################################################################
// ИТОГИ 
##########################################################################################################################################################

if($p['col_user']<=1 or $col_u[0]<=1){

$res1 = $mysqli->query('SELECT * FROM `pvp_results` WHERE `pvp_id` = '.$p_u['pvp_id'].' ORDER BY `number` desc LIMIT 10');
while ($pu = $res1->fetch_array()){

if($pu['bot']==0){
$resb_s = $mysqli->query('SELECT id, bon_col FROM `boevaya_sila` WHERE `user` = "'.$pu['user'].'" and `local` = "1" limit 1');
$b_s = $resb_s->fetch_assoc();
if($b_s['bon_col']>0){
$mysqli->query("UPDATE `boevaya_sila` SET `bon_col` = `bon_col` - '1' WHERE `id` = '".$b_s['id']."' LIMIT 1");
}
}

$mysqli->query("UPDATE `pvp_results` SET `time` = '".(time()+60)."' WHERE `id` = '".$pu['id']."' LIMIT 1");

$res = $mysqli->query('SELECT tip FROM `users_tanks` WHERE `user`  = "'.$pu['user'].'" and `active`  = "1" limit 1');
$users_tanks = $res->fetch_assoc();

$res = $mysqli->query('SELECT country, tip FROM `tanks` WHERE `id`  = "'.$users_tanks['tip'].'" limit 1');
$tanks = $res->fetch_assoc();

if($tanks['country']=='GERMANY'){$country = 1;}
if($tanks['country']=='SSSR'){$country = 2;}
if($tanks['country']=='USA'){$country = 3;}

if($user['pvp_tip']==1 and $pu['number']==1 and $pu['act']==0){$rand = (rand(1,2));$rate = ($pu['rate']+$rand);
if($pu['bot']==0){
$mysqli->query("UPDATE `users` SET `pvp_rate` = `pvp_rate` + '".($rate)."' WHERE `id` = '".$pu['user']."' LIMIT 1");
}
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + '".($rand)."', `act` = '1' WHERE `id` = '".$pu['id']."' LIMIT 1");
}
if($user['pvp_tip']==1 and $pu['number']==2 and $pu['act']==0){$rand = (rand(-3,0));$rate = ($pu['rate']+$rand);
if($pu['bot']==0){
$mysqli->query("UPDATE `users` SET `pvp_rate` = `pvp_rate` + '".($rate)."' WHERE `id` = '".$pu['user']."' LIMIT 1");
}
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + '".($rand)."', `act` = '1' WHERE `id` = '".$pu['id']."' LIMIT 1");
}


if($user['pvp_tip']==2 and $pu['number']==1 and $pu['act']==0){$rand = (rand(5,10));$rate = ($pu['rate']+$rand);
if($pu['bot']==0){
$mysqli->query("UPDATE `users` SET `pvp_rate` = `pvp_rate` + '".($rate)."' WHERE `id` = '".$pu['user']."' LIMIT 1");
}
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + '".($rand)."', `act` = '1' WHERE `id` = '".$pu['id']."' LIMIT 1");
}
if($user['pvp_tip']==2 and $pu['number']==2 and $pu['act']==0){$rand = (rand(0,5));$rate = ($pu['rate']+$rand);
if($pu['bot']==0){
$mysqli->query("UPDATE `users` SET `pvp_rate` = `pvp_rate` + '".($rate)."' WHERE `id` = '".$pu['user']."' LIMIT 1");
}
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + '".($rand)."', `act` = '1' WHERE `id` = '".$pu['id']."' LIMIT 1");
}
if($user['pvp_tip']==2 and $pu['number']==3 and $pu['act']==0){$rand = (rand(-3,2));$rate = ($pu['rate']+$rand);
if($pu['bot']==0){
$mysqli->query("UPDATE `users` SET `pvp_rate` = `pvp_rate` + '".($rate)."' WHERE `id` = '".$pu['user']."' LIMIT 1");
}
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + '".($rand)."', `act` = '1' WHERE `id` = '".$pu['id']."' LIMIT 1");
}
if($user['pvp_tip']==2 and $pu['number']==4 and $pu['act']==0){$rand = (rand(-10,-5));$rate = ($pu['rate']+$rand);
if($pu['bot']==0){
$mysqli->query("UPDATE `users` SET `pvp_rate` = `pvp_rate` + '".($rate)."' WHERE `id` = '".$pu['user']."' LIMIT 1");
}
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + '".($rand)."', `act` = '1' WHERE `id` = '".$pu['id']."' LIMIT 1");
}
if($user['pvp_tip']==2 and $pu['number']==5 and $pu['act']==0){$rand = (rand(-20,-10));$rate = ($pu['rate']+$rand);
if($pu['bot']==0){
$mysqli->query("UPDATE `users` SET `pvp_rate` = `pvp_rate` + '".($rate)."' WHERE `id` = '".$pu['user']."' LIMIT 1");
}
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + '".($rand)."', `act` = '1' WHERE `id` = '".$pu['id']."' LIMIT 1");
}



if($user['pvp_tip']==3 and $pu['number']==1 and $pu['act']==0){$rand = (rand(8,10));$rate = ($pu['rate']+$rand);
if($pu['bot']==0){
$mysqli->query("UPDATE `users` SET `pvp_rate` = `pvp_rate` + '".($rate)."' WHERE `id` = '".$pu['user']."' LIMIT 1");
}
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + '".($rand)."', `act` = '1' WHERE `id` = '".$pu['id']."' LIMIT 1");
}
if($user['pvp_tip']==3 and $pu['number']==2 and $pu['act']==0){$rand = (rand(6,8));$rate = ($pu['rate']+$rand);
if($pu['bot']==0){
$mysqli->query("UPDATE `users` SET `pvp_rate` = `pvp_rate` + '".($rate)."' WHERE `id` = '".$pu['user']."' LIMIT 1");
}
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + '".($rand)."', `act` = '1' WHERE `id` = '".$pu['id']."' LIMIT 1");
}
if($user['pvp_tip']==3 and $pu['number']==3){$rand = (rand(4,6));$rate = ($pu['rate']+$rand);
if($pu['bot']==0){
$mysqli->query("UPDATE `users` SET `pvp_rate` = `pvp_rate` + '".($rate)."' WHERE `id` = '".$pu['user']."' LIMIT 1");
}
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + '".($rand)."', `act` = '1' WHERE `id` = '".$pu['id']."' LIMIT 1");
}
if($user['pvp_tip']==3 and $pu['number']==4 and $pu['act']==0){$rand = (rand(2,4));$rate = ($pu['rate']+$rand);
if($pu['bot']==0){
$mysqli->query("UPDATE `users` SET `pvp_rate` = `pvp_rate` + '".($rate)."' WHERE `id` = '".$pu['user']."' LIMIT 1");
}
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + '".($rand)."', `act` = '1' WHERE `id` = '".$pu['id']."' LIMIT 1");
}
if($user['pvp_tip']==3 and $pu['number']==5 and $pu['act']==0){$rand = (rand(1,2));$rate = ($pu['rate']+$rand);
if($pu['bot']==0){
$mysqli->query("UPDATE `users` SET `pvp_rate` = `pvp_rate` + '".($rate)."' WHERE `id` = '".$pu['user']."' LIMIT 1");
}
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + '".($rand)."', `act` = '1' WHERE `id` = '".$pu['id']."' LIMIT 1");
}
if($user['pvp_tip']==3 and $pu['number']==6 and $pu['act']==0){$rand = (rand(-5,1));$rate = ($pu['rate']+$rand);
if($pu['bot']==0){
$mysqli->query("UPDATE `users` SET `pvp_rate` = `pvp_rate` + '".($rate)."' WHERE `id` = '".$pu['user']."' LIMIT 1");
}
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + '".($rand)."', `act` = '1' WHERE `id` = '".$pu['id']."' LIMIT 1");
}
if($user['pvp_tip']==3 and $pu['number']==7 and $pu['act']==0){$rand = (rand(-15,-10));$rate = ($pu['rate']+$rand);
if($pu['bot']==0){
$mysqli->query("UPDATE `users` SET `pvp_rate` = `pvp_rate` + '".($rate)."' WHERE `id` = '".$pu['user']."' LIMIT 1");
}
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + '".($rand)."', `act` = '1' WHERE `id` = '".$pu['id']."' LIMIT 1");
}
if($user['pvp_tip']==3 and $pu['number']==8 and $pu['act']==0){$rand = (rand(-20,-15));$rate = ($pu['rate']+$rand);
if($pu['bot']==0){
$mysqli->query("UPDATE `users` SET `pvp_rate` = `pvp_rate` + '".($rate)."' WHERE `id` = '".$pu['user']."' LIMIT 1");
}
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + '".($rand)."', `act` = '1' WHERE `id` = '".$pu['id']."' LIMIT 1");
}
if($user['pvp_tip']==3 and $pu['number']==9 and $pu['act']==0){$rand = (rand(-25,-20));$rate = ($pu['rate']+$rand);
if($pu['bot']==0){
$mysqli->query("UPDATE `users` SET `pvp_rate` = `pvp_rate` + '".($rate)."' WHERE `id` = '".$pu['user']."' LIMIT 1");
}
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + '".($rand)."', `act` = '1' WHERE `id` = '".$pu['id']."' LIMIT 1");
}
if($user['pvp_tip']==3 and $pu['number']==10 and $pu['act']==0){$rand = (rand(-30,-25));$rate = ($pu['rate']+$rand);
if($pu['bot']==0){
$mysqli->query("UPDATE `users` SET `pvp_rate` = `pvp_rate` + '".($rate)."' WHERE `id` = '".$pu['user']."' LIMIT 1");
}
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + '".($rand)."', `act` = '1' WHERE `id` = '".$pu['id']."' LIMIT 1");
}

$res = $mysqli->query('SELECT * FROM `prom` WHERE `id` = "1" ');
$prom = $res->fetch_assoc();
if($prom['time_20']>time()){
$res = $mysqli->query('SELECT * FROM `bz_user` WHERE `user` = "'.$pu['user'].'" and `tip` = "'.$prom['tip_20'].'"');
$bz_user = $res->fetch_assoc();
if($bz_user['step']==10 and $bz_user['prog_']<$bz_user['prog']){
$mysqli->query('UPDATE `bz_user` SET `prog_` = `prog_` + "'.$rate.'" WHERE `id` = '.$bz_user['id'].'');
}
}

#################################################################################### МИССИИ
if($pu['number']==1){
$prog = 1;$user_m = $pu['user'];$id_miss = 28;$prog_max = 3;$time = time();$country = $country;$stmt_mis->execute();
$prog = 1;$user_m = $pu['user'];$id_miss = 35;$prog_max = 15;$time = time();$country = $country;$stmt_mis->execute();
}
$mysqli->query('UPDATE `missions_user` SET `prog` = "5" WHERE `user` = '.$pu['user'].' and `id_miss` = "36" and `prog` = "4"  limit 1');
#################################################################################### МИССИИ


}
$mysqli->query('DELETE FROM `pvp` WHERE `id` = "'.$p_u['pvp_id'].'" ');
$mysqli->query('DELETE FROM `pvp_log` WHERE `pvp_id` = "'.$p_u['pvp_id'].'" ');
header('Location: /pvp/');
exit();
}
##########################################################################################################################################################
// ИТОГИ 
##########################################################################################################################################################
//echo '<br><hr>ИТОГИ '.round(microtime(1) - $ttt3, 4).' сек<br>';

























/* 
##########################################################################################################################################################
// АРТ УДАРЫ 
##########################################################################################################################################################
$t = microtime(1);
if($p['time_attack_assault']<=time()){
$cikl = $mysqli->query('SELECT * FROM `pvp_user` WHERE `p` > "0" and `pvp_id` = "'.$p_u['pvp_id'].'" ORDER BY `p` asc LIMIT 10');
while ($cik = $cikl->fetch_array()){
$a_a = 10;
$for = ceil((time()-$p['time_attack_assault']));
if($for>=5){$for = 5;}else{$for = $for;}
if(($a_a*$for)>=$cik['p']){$for=ceil($cik['p']/$a_a);}else{if($for==0){$for=1;}else{$for=$for;}}

$res_ank_ = $mysqli->query('SELECT * FROM `pvp_user` WHERE `pvp_id` = "'.$cik['pvp_id'].'" and `p` <= "'.($for*$a_a).'" and `p` > "0" ');
$qwq = $res_ank_->fetch_assoc();

$res_ank_ = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$qwq['user'].'" LIMIT 1');
$ank_1 = $res_ank_->fetch_assoc();

if($p['col_user']<=2){
$res = $mysqli->query('SELECT * FROM `pvp_results` WHERE `pvp_id` = "'.$cik['pvp_id'].'" and `user` = "'.$qwq['user'].'" ');
$pvp_r1 = $res->fetch_assoc();
}

$res = $mysqli->query('SELECT * FROM `pvp_results` WHERE `pvp_id` = "'.$cik['pvp_id'].'" and `user` = "'.$cik['user'].'" ');
$pvp_r = $res->fetch_assoc();

$res_ank_ = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$cik['user'].'" LIMIT 1');
$ank_ = $res_ank_->fetch_assoc();


$ttt = $mysqli->query('SELECT * FROM `tanks` WHERE `id` ORDER BY `id` asc LIMIT '.$for.'');
while ($tt = $ttt->fetch_array()){
$mysqli->query("UPDATE `pvp_user` SET `p` = `p` - '".$a_a."' WHERE `id` = '".$cik['id']."' LIMIT 1");
$text = "Артиллерийский обстрел нанёс <span class='red1'>".$a_a." урона</span>";
$mysqli->query('INSERT INTO `pvp_log` SET `time` = "'.time().'", `text` = "'.$text.'", `pvp_id` = "'.$cik['pvp_id'].'"');



###################################################
if($p['tip']==1 and $p['col_user']==2 and $qwq!=0){
$rate = rand(3,5);
$rate1 = rand(-8,-3);
if(!$pvp_r){
$mysqli->query('INSERT INTO `pvp_results` SET `user` = "'.$cik['user'].'", `rate` = "'.$rate.'", `number` = "1", `pvp_id` = "'.$cik['pvp_id'].'", `time` = "'.time().'" ');
$mysqli->query('INSERT INTO `pvp_results` SET `user` = "'.$qwq['user'].'", `rate` = "'.$rate1.'", `number` = "2", `pvp_id` = "'.$cik['pvp_id'].'", `time` = "'.time().'" ');
}
break;
exit;
}
###################################################

###################################################
if($p['tip']==2 and $p['col_user']>2 and $qwq!=0){
if($p['col_user']==1){$rate = rand(5,10);}
if($p['col_user']==2){$rate = rand(0,5);}
if($p['col_user']==3){$rate = rand(-3,2);}
if($p['col_user']==4){$rate = rand(-10,-5);}
if($p['col_user']==5){$rate = rand(-20,-10);}
if(!$pvp_r){
$mysqli->query('INSERT INTO `pvp_results` SET `user` = "'.$qwq['user'].'", `rate` = "'.$rate.'", `number` = "'.$p['col_user'].'", `pvp_id` = "'.$cik['pvp_id'].'", `time` = "'.time().'" ');
}else{
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + ".$rate.", `number` = '".$p['col_user']."' WHERE `id` = '".$pvp_r['id']."' LIMIT 1");
}
$mysqli->query('UPDATE `pvp_user` SET `p` = "0" WHERE `id` = '.$qwq['id'].' LIMIT 1');
$text1 = "Артиллерийский обстрел <span class='orange'>уничтожил</span> <span class='yellow1 td_u'>".$ank_1['login']."</span>";
$mysqli->query('INSERT INTO `pvp_log` SET `time` = "'.time().'", `text` = "'.$text1.'", `pvp_id` = "'.$cik['pvp_id'].'"');
$mysqli->query('UPDATE `pvp` SET `col_user` = `col_user` - "1" WHERE `id` = '.$p['id'].' LIMIT 1');
break;
exit;
}
###################################################
###################################################
if($p['tip']==2 and $p['col_user']==2 and $qwq!=0){
$rate = rand(10,15);
$rate1 = rand(5,10);
if(!$pvp_r){
$mysqli->query('INSERT INTO `pvp_results` SET `user` = "'.$cik['user'].'", `rate` = "'.$rate.'", `number` = "1", `pvp_id` = "'.$cik['pvp_id'].'", `time` = "'.time().'" ');
}else{
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + ".$rate.", `number` = '1' WHERE `id` = '".$pvp_r['id']."' LIMIT 1");
}
if(!$pvp_r1){
$mysqli->query('INSERT INTO `pvp_results` SET `user` = "'.$qwq['user'].'", `rate` = "'.$rate1.'", `number` = "2", `pvp_id` = "'.$cik['pvp_id'].'", `time` = "'.time().'" ');
}else{
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + ".$rate1.", `number` = '2' WHERE `id` = '".$pvp_r1['id']."' LIMIT 1");
}
$text1 = "Артиллерийский обстрел <span class='orange'>уничтожил</span> <span class='yellow1 td_u'>".$ank_1['login']."</span>";
$mysqli->query('INSERT INTO `pvp_log` SET `time` = "'.time().'", `text` = "'.$text1.'", `pvp_id` = "'.$cik['pvp_id'].'"');
$mysqli->query('UPDATE `pvp` SET `col_user` = `col_user` - "1" WHERE `id` = '.$p['id'].' LIMIT 1');
break;
exit;
}
###################################################

###################################################
if($p['tip']==3 and $p['col_user']>2 and $qwq!=0){
if($p['col_user']==1){$rate = rand(8,10);}
if($p['col_user']==2){$rate = rand(6,8);}
if($p['col_user']==3){$rate = rand(4,6);}
if($p['col_user']==4){$rate = rand(2,4);}
if($p['col_user']==5){$rate = rand(1,2);}
if($p['col_user']==6){$rate = rand(-5,1);}
if($p['col_user']==7){$rate = rand(-15,-10);}
if($p['col_user']==8){$rate = rand(-20,-15);}
if($p['col_user']==9){$rate = rand(-25,-20);}
if($p['col_user']==10){$rate = rand(-30,-25);}
if(!$pvp_r){
$mysqli->query('INSERT INTO `pvp_results` SET `user` = "'.$qwq['user'].'", `rate` = "'.$rate.'", `number` = "'.$p['col_user'].'", `pvp_id` = "'.$cik['pvp_id'].'", `time` = "'.time().'" ');
}else{
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + ".$rate.", `number` = '".$p['col_user']."' WHERE `id` = '".$pvp_r['id']."' LIMIT 1");
}
$mysqli->query('UPDATE `pvp_user` SET `p` = "0" WHERE `id` = '.$qwq['id'].' LIMIT 1');
$text1 = "Артиллерийский обстрел <span class='orange'>уничтожил</span> <span class='yellow1 td_u'>".$ank_1['login']."</span>";
$mysqli->query('INSERT INTO `pvp_log` SET `time` = "'.time().'", `text` = "'.$text1.'", `pvp_id` = "'.$cik['pvp_id'].'"');
$mysqli->query('UPDATE `pvp` SET `col_user` = `col_user` - "1" WHERE `id` = '.$p['id'].' LIMIT 1');
break;
exit;
}
###################################################
###################################################
if($p['tip']==3 and $p['col_user']==2 and $qwq!=0){
$rate = rand(8,10);
$rate1 = rand(6,8);
if(!$pvp_r){
$mysqli->query('INSERT INTO `pvp_results` SET `user` = "'.$cik['user'].'", `rate` = "'.$rate.'", `number` = "1", `pvp_id` = "'.$cik['pvp_id'].'", `time` = "'.time().'" ');
}else{
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + ".$rate.", `number` = '1' WHERE `id` = '".$pvp_r['id']."' LIMIT 1");
}
if(!$pvp_r1){
$mysqli->query('INSERT INTO `pvp_results` SET `user` = "'.$qwq['user'].'", `rate` = "'.$rate1.'", `number` = "2", `pvp_id` = "'.$cik['pvp_id'].'", `time` = "'.time().'" ');
}else{
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + ".$rate1.", `number` = '2' WHERE `id` = '".$pvp_r1['id']."' LIMIT 1");
}
$text1 = "Артиллерийский обстрел <span class='orange'>уничтожил</span> <span class='yellow1 td_u'>".$ank_1['login']."</span>";
$mysqli->query('INSERT INTO `pvp_log` SET `time` = "'.time().'", `text` = "'.$text1.'", `pvp_id` = "'.$cik['pvp_id'].'"');
$mysqli->query('UPDATE `pvp` SET `col_user` = `col_user` - "1" WHERE `id` = '.$p['id'].' LIMIT 1');
break;
exit;
}
###################################################

}
if($qwq!=0){break;exit;}
}

$mysqli->query("UPDATE `pvp` SET `time_attack_assault` = '".(time()+1)."' WHERE `id` = '".$p['id']."' LIMIT 1");
}
//echo '1 - '.round(microtime(1) - $t, 3).' сек<hr>';
##########################################################################################################################################################
// АРТ УДАРЫ 
##########################################################################################################################################################
 */












##########################################################################################################################################################
// АТАКА БОТОВ
##########################################################################################################################################################
//$t_atack = microtime(1);
$attack_bot = $mysqli->query('SELECT user, goal, pvp_id, id, p, time_attack FROM `pvp_user` WHERE `pvp_id` = "'.$p['id'].'" and `p` > "0" and `bot` >= "1" and `time_attack` < "'.time().'" ORDER BY `id` asc LIMIT 10');
while ($a_b = $attack_bot->fetch_array()){
$res = $mysqli->query('SELECT user, p, id, pvp_id, goal, time_rem, time_manevr, time_attack FROM `pvp_user` WHERE `id` = "'.$a_b['goal'].'" ');
$p_u_anks = $res->fetch_assoc(); // тот по кому стреляет

if($p_u_anks['p']<=0 or !$p_u_anks['id'] or $a_b['goal']<=0 or $a_b['goal']==$a_b['id']){
$user_res = $a_b['user'];$user_ank = $a_b['user'];$pvp_id = $p['id'];$hp_ank = 0;$stmt_g->execute();$res = $stmt_g->get_result();$goal_ = $res->fetch_assoc(); // подбираем себе другого противника
$mysqli->query("UPDATE `pvp_user` SET `goal` = '".$goal_['id']."' WHERE `id` = '".$a_b['id']."' ");
}else{

/* if(!$p_u_anks['id'] and $p_u_anks['p']<=0){break;}
if($a_b['p']<=0){break;} */

$res = $mysqli->query('SELECT pvp_rate, id, login FROM `users` WHERE `id` = "'.$a_b['user'].'" ');
$users = $res->fetch_assoc(); // тот кто стреляет

$res = $mysqli->query('SELECT pvp_rate, id, login FROM `users` WHERE `id` = "'.$p_u_anks['user'].'" ');
$uss_ank = $res->fetch_assoc();

$res = $mysqli->query('SELECT b FROM `users_tanks` WHERE `user` = "'.$uss_ank['id'].'" and `active`  = "1" ');
$ank_tanks = $res->fetch_assoc();

$res = $mysqli->query('SELECT time1, time3, time4 FROM `vip` WHERE `user` = "'.$a_b['user'].'" ');
$vip = $res->fetch_assoc();

$res_s3 = $mysqli->query('SELECT bon FROM `skills_user` WHERE `tip`  = "3" and `user`  = "'.$a_b['user'].'" ');
$skills_3 = $res_s3->fetch_assoc(); // Слабые места

$res_s2 = $mysqli->query('SELECT bon FROM `skills_user` WHERE `tip`  = "2" and `user`  = "'.$p_u_anks['user'].'" ');
$skills_2 = $res_s2->fetch_assoc(); // Рикошет

$res_s5 = $mysqli->query('SELECT bon FROM `skills_user` WHERE `tip`  = "5" and `user`  = "'.$a_b['user'].'" ');
$skills_5 = $res_s5->fetch_assoc(); // Снайпер



##############
if($user['pvp_tip']==3){$mnog = 4;}else{$mnog = 2;}
if($users['pvp_rate']<=$uss_ank['pvp_rate']){
$rate = ceil((sqrt( (($uss_ank['pvp_rate']-($users['pvp_rate']-$uss_ank['pvp_rate']))*100/$users['pvp_rate'])  *  ((($uss_ank['pvp_rate']-$users['pvp_rate']))*100/$users['pvp_rate']) ))/$mnog);
}else{
$rate = ceil((sqrt( (($users['pvp_rate']-($users['pvp_rate']-$uss_ank['pvp_rate']))*100/$uss_ank['pvp_rate'])  -  ((($users['pvp_rate']-$uss_ank['pvp_rate']))*100/$uss_ank['pvp_rate']) ))/$mnog);
}
if(is_nan($rate)==true){$rate = 0;}//if(is_nan($rate)=='NAN'){$rate = 0;}
##############

##############################################################################################################
if($ank_tanks['b']<500){$armor = ($ank_tanks['b']/10);}else{$armor = ($ank_tanks['b']/40);}
$attack = (($us_tank['a']/4) -(($us_tank['a']/4)*$armor/100) );

$rand_s2 = rand(1,100); // Рикошет
$rand_s3 = rand(1,100); // Слабые места
if($rand_s3 <= $skills_3['bon']){if($skills_5['bon']>0){$attack = floor($attack+($attack*(rand($skills_5['bon'],($skills_5['bon']+50)))/100));$txt_krit = '<span class="red1">(крит)</span>';}elsE{$attack = $attack;$txt_krit = '';}}//если выпал крит смотрим как прокачан снайпер и увеличиваем урон

if(($a_b['time_attack']-time()) >= 3){
$attack = 0;
}elseif(($a_b['time_attack']-time()) == 2){
$attack = ($attack*20/100);
}elseif(($a_b['time_attack']-time()) == 1){
$attack = ($attack*60/100);
}elseif(($a_b['time_attack']-time()) <= 0){
$attack = $attack;
}

if($vip['time1']>time()){$v1 = 25;}elsE{$v1 = 0;}
if($vip['time3']>time()){$v3 = 50;}elsE{$v3 = 0;}
if($vip['time4']>time()){$v4 = 50;}elsE{$v4 = 0;}
$attack = ($attack+ ($attack*($shell_s['o']+$v1+$v3+$v4)/100));
$attack = ($attack- ($attack*rand(0.1,10)/100));
if($attack>=$p_u_anks['p']){$attack = ceil($p_u_anks['p']);}else{$attack = ceil($attack);}
##############################################################################################################


if($rand_s2 <= $skills_2['bon']){ // Рикошет
$text = "<span class='blue1'>РИКОШЕТ: </span><span class='yellow1 td_u'>".$users['login']."</span> <img src='/images/shells/Regular.png'> выстрелил в <span class='yellow1 td_u'>".$uss_ank['login']."</span> на <span class='red1'>0 урона ".$txt_krit." </span>";
$time = time();$text = $text;$pvp_id = $p['id'];$user_res = $users['id'];$ank = $uss_ank['id'];$stmtl->execute(); // логи
$mysqli->query("UPDATE `pvp_user` SET `time_attack` = '".(time()+rand(5,10))."' WHERE `id` = '".$a_b['id']."' ");
}else{
$text = "<span class='yellow1 td_u'>".$users['login']."</span> <img src='/images/shells/Regular.png'> выстрелил в <span class='yellow1 td_u'>".$uss_ank['login']."</span> на <span class='red1'>".$attack." урона ".$txt_krit." </span>";
$time = time();$text = $text;$pvp_id = $p['id'];$user_res = $users['id'];$ank = $uss_ank['id'];$stmtl->execute(); // логи
$mysqli->query("UPDATE `pvp_user` SET `time_attack` = '".(time()+rand(5,10))."' WHERE `id` = '".$a_b['id']."' ");
################################################
if($attack>=$p_u_anks['p']){// последний удар.. считаем рейт и завершаем битву
$text = "<span class='orange'><span class='yellow1 td_u'>".$users['login']."</span> уничтожил <span class='yellow1 td_u'>".$uss_ank['login']."</span></span>";
$time = time();$text = $text;$pvp_id = $p['id'];$user_res = 0;$ank = 0;$stmtl->execute();
$mysqli->query("UPDATE `pvp` SET `col_user` = `col_user` - '1' WHERE `id` = '".$p['id']."' LIMIT 1");
################################################
if($p['col_user']>2){ // убиваю противника, в бою еще более 2 чел, выдаю рейт, назначаю себе нового противника, продолжаем...
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + ".-($rate/2).", `number` = ".($p['col_user'])." WHERE `pvp_id` = ".$a_b['pvp_id']." and `user` = ".$p_u_anks['user']." LIMIT 1");### выдаем рейт убитому
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + ".$rate." WHERE `pvp_id` = ".$a_b['pvp_id']." and `user` = ".$a_b['user']."  LIMIT 1");### выдаем рейт себе
}elseif($p['col_user']<=2){
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + ".-($rate/2).", `number` = '2' WHERE `pvp_id` = ".$a_b['pvp_id']." and `user` = ".$p_u_anks['user']." LIMIT 1");### выдаем рейт убитому
$mysqli->query("UPDATE `pvp_results` SET `rate` = `rate` + ".$rate.", `number` = '1' WHERE `pvp_id` = ".$a_b['pvp_id']." and `user` = ".$a_b['user']."  LIMIT 1");### выдаем рейт себе
}
/* $c_u_m_i_1 = $mysqli->query('SELECT id, user FROM `pvp_user` WHERE `id` != "'.$a_b['goal'].'" and `p` > "0"'); // все у кого тот же противник что и у меня
while ($c_u_m_i = $c_u_m_i_1->fetch_array()){ // назначаем другого противникау всем у кого мой противник
$stmt_g->bind_param("ssss", $user_res,$user_ank,$pvp_id,$hp_ank);
$user_res = $c_u_m_i['user'];$user_ank = $p_u_anks['user'];$pvp_id = $p['id'];$hp_ank = 0;$stmt_g->execute();$res_ga = $stmt_g->get_result();$goal_ff = $res_ga->fetch_assoc(); // подбираем себе другого противника
$mysqli->query("UPDATE `pvp_user` SET `goal` = '".$goal_ff['id']."' WHERE `id` = '".$c_u_m_i['id']."' ");
} */
$mysqli->query("UPDATE `pvp_user` SET `p` = `p` - '".($attack)."' WHERE `id` = '".$p_u_anks['id']."' ");
break;
exit;
}else{
$mysqli->query("UPDATE `pvp_user` SET `p` = `p` - '".($attack)."' WHERE `id` = '".$p_u_anks['id']."' ");
}
################################################
}
}
}
//echo '<br><hr>АТАКА БОТОВ '.round(microtime(1) - $t_atack, 3).' сек';




//$ttt4 = microtime(1);
$mysqli->query("UPDATE `pvp` SET `user` = '0' WHERE `id` = '".$p['id']."' LIMIT 1"); 
//echo '<br><hr>UPDATE 0 - '.round(microtime(1) - $ttt4, 4).' сек';


}
###########################################################################################################################################
###########################################################################################################################################
###########################################################################################################################################

//echo '<hr>Время обработки страницы '.round(microtime(1) - $site, 3).' сек';
//echo '<hr>Время обработки ВСЕХ страниц '.round(microtime(1) - $t_s, 3).' сек';

ob_end_flush();


//ob_end_flush();
//ob_get_contents();
/* $res = $mysqli->query('SELECT * FROM `pvp_user` WHERE `bot` = "0" and `pvp_id` = "'.$p['id'].'" and `time_attack` >= "'.(time()-5).'" ORDER BY RAND() LIMIT 1 ');
$randus = $res->fetch_assoc();
$mysqli->query("UPDATE `pvp` SET `user` = '".$randus['user']."' WHERE `id` = '".$p['id']."' LIMIT 1");
 */
/* }elsE{
$res = $mysqli->query('SELECT * FROM `pvp_user` WHERE `bot` = "0" and `pvp_id` = "'.$p['id'].'" and `time_attack` >= "'.(time()-5).'" ORDER BY RAND() LIMIT 1 ');
$randus = $res->fetch_assoc();
$mysqli->query("UPDATE `pvp` SET `user` = '".$randus['user']."' WHERE `id` = '".$p['id']."' LIMIT 1");
} */
//echo '1 - '.round(microtime(1) - $t_atack, 3).' сек';
##########################################################################################################################################################
// АТАКА БОТОВ
##########################################################################################################################################################
?>