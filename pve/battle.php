<?php
$title = 'Сражения';
require_once ('../system/function.php');
//require_once ('../system/header.php');
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
<meta property="og:url" content="<?=$HOME?>">
<meta property="og:locale" content="ru_RU">
<meta property="og:image" content="/images/logo.jpg">
<meta property="og:image:width" content="2560">
<meta property="og:image:height" content="1024">

<meta http-equiv="Refresh" content="15" />

<link rel="icon" href="/favicon.ico" type="image/png">
<link rel="stylesheet" type="text/css" href="/diz.css"><title>Танки</title>
<style>
      .scale {
        transform: scale(-1, 1);
      }
</style>







<?
if(!$user['id']){
header('Location: /');
exit();
}

$res = $mysqli->query('SELECT * FROM `pve` WHERE `time_pve` != "0"  LIMIT 1');
$p = $res->fetch_assoc();

if(!$p){
header('Location: /pve/');
exit();
}

$res = $mysqli->query("SELECT COUNT(*) FROM `pve_user` WHERE `pve_id` = ".$p['pve_id']." and `p_` > '0' and `bot` = '1' ");
$col_4 = $res->fetch_array(MYSQLI_NUM);


/* 540 ошибка

кидает мне настоящих игроков

и не отображает уничтожение артой игроков
 */
































if($p['user']==0){
$mysqli->query("UPDATE `pve` SET `user` = '1' WHERE `pve_id` = '".$p['pve_id']."' LIMIT 1");
//echo '2';










##############################################################################################################################
##############################################################################################################################
##############################################################################################################################
$res = $mysqli->query("SELECT COUNT(*) FROM `pve_user` WHERE `pve_id` = ".$p['pve_id']." and `bot` = '0' ");
$col_1 = $res->fetch_array(MYSQLI_NUM);
$res = $mysqli->query("SELECT COUNT(*) FROM `pve_user` WHERE `pve_id` = ".$p['pve_id']." and `bot` = '1' ");
$col_2 = $res->fetch_array(MYSQLI_NUM);
$res = $mysqli->query("SELECT COUNT(*) FROM `pve_user` WHERE `pve_id` = ".$p['pve_id']." and `p_` > '0' and `bot` = '0' ");
$col_3 = $res->fetch_array(MYSQLI_NUM);



if(
($p['time_pve']<=time() and $p['time_pve']>0) // закончилось время
or
($col_3[0]<=0 or $col_4[0]<=0) // убиты все союзники, или противники
){ 

//echo '1';

if(!$p){
header('Location: /pve/');
exit();
}
if($p['time_pve']==0){
header('Location: /pve/');
exit();
}


###########################################################
$res_pve_k = $mysqli->query('SELECT * FROM `pve_results` WHERE `pve_id` = "'.$p['pve_id'].'" and `bot` = "0" and `kill` > "0" ORDER BY `kill` DESC ');
while ($ress_k = $res_pve_k->fetch_array()){
$num1 = ++$k_post1[0];
if($num1==1){$gold = 3;$fuel = 300;}elseif($num1==2){$gold = 2;$fuel = 200;}elseif($num1==3){$gold = 1;$fuel = 100;}else{$fuel = 0;}
if($num1<=3){
$mysqli->query('UPDATE `pve_results` SET `fuel` = `fuel` + '.$fuel.', `number_kill` = '.$num1.', `gold` = `gold` + '.$gold.' WHERE `id` = '.$ress_k['id'].' LIMIT 1');
$mysqli->query('UPDATE `users` SET `fuel` = `fuel` + '.$fuel.', `gold` = `gold` + '.$gold.' WHERE `id` = '.$ress_k['user'].' LIMIT 1');
}elseif($num1<=3){
$mysqli->query('UPDATE `pve_results` SET `number_kill` = '.$num1.' WHERE `id` = '.$ress_k['id'].' LIMIT 1');
}
}
###########################################################

###########################################################
$res_pve = $mysqli->query('SELECT * FROM `pve_results` WHERE `pve_id` = "'.$p['pve_id'].'" and `bot` = "0" ORDER BY `uron` DESC');
while ($ress = $res_pve->fetch_array()){
$num = ++$k_post[0];
$res2 = $mysqli->query('SELECT * FROM `pve_user` WHERE `user` = "'.$ress['user'].'" LIMIT 1');
$pve_us = $res2->fetch_assoc();

###########################################################
$res2 = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$ress['user'].'" LIMIT 1');
$traning = $res2->fetch_assoc();
$res1 = $mysqli->query('SELECT * FROM `vip` WHERE `user` = "'.$ress['user'].'" LIMIT 1');
$vip = $res1->fetch_assoc();
$res1 = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$ress['user'].'" LIMIT 1');
$users = $res1->fetch_assoc();
$resb_s = $mysqli->query('SELECT * FROM `boevaya_sila` WHERE `user` = "'.$ress['user'].'" and `local` = "2" limit 1');
$b_s = $resb_s->fetch_assoc();
if($b_s['bon_col']>0){
$mysqli->query("UPDATE `boevaya_sila` SET `bon_col` = `bon_col` - '1' WHERE `id` = '".$b_s['id']."' LIMIT 1");
}
###########################################################
if($p['tip']==1){ // оборонительная
$exp = ($ress['exp']); // при победе в стоке примерно 17 | на другом стоковом аке дало 7
$silver = ($ress['silver']); // при победе в стоке примерно 9 | на другом стоковом аке дало 7
}elsE{ // наступательная
$exp = ($ress['exp']); // при поражении в стоке примерно 7
$silver = ($ress['silver']); // при поражении в стоке примерно 4
}

if($ress['uron']<=0){
$exp = ($exp*$traning['rang']);
$silver = ($silver*$traning['rang']);
}elsE{
$e = ($ress['uron']/1000)+(3*$ress['kill']);
$s = ($ress['uron']/1000)+(2*$ress['kill']);
$exp = (($exp+$e)*$traning['rang']);
$silver = (($silver+$e)*$traning['rang']);
}

if($vip['time2']>time()){$v2s = 25;$v2e = 50;}elsE{$v2s = 0;$v2e = 0;}
if($vip['time4']>time()){$v4e = 50;}elsE{$v4e = 0;}
if($vip['time1']>time()){$v1 = 0.5;}elsE{$v1 = 0;}
if($vip['time3']>time()){$v3 = 1;}elsE{$v3 = 0;}

$res = $mysqli->query('SELECT * FROM `prom` WHERE `id` = "1" limit 1');
$prom = $res->fetch_assoc();
if($prom['time_2']>time()){$pr = $prom['act_2'];}else{$pr = 0;}

$res_s7 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "7" and `user`  = "'.$ress['user'].'" LIMIT 1');
$skills_7 = $res_s7->fetch_assoc(); // Инструктор Повышает личный заработанный опыт.

$silver = ceil($silver+ ($silver*($v2s)/100));
$exp = ceil($exp+ ($exp*($v2e+$v4e+$pr+$skills_7['bon'])/100));
$crewpoints = ceil($ress['kill']*($v1+$v3));

if($ress['uron']>0){
if($num==1){$gold = 3;$fuel = 300;}elseif($num==2){$gold = 2;$fuel = 200;}elseif($num==3){$gold = 1;$fuel = 100;}else{$gold = 0;$fuel = 0;}
}else{
$gold = 0;$fuel = 0;
}
###########################################################


####################################################################################
$id_miss = 36;
$res = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$users['id'].' and `id_miss` = "'.$id_miss.'" and `time` < '.time().' limit 1');
$miss = $res->fetch_assoc();
if($miss['prog']==3 and $miss['time']<time()){$mysqli->query('UPDATE `missions_user` SET `prog` = "4" WHERE `user` = '.$users['id'].' and `id_miss` = "'.$id_miss.'"  ');}
####################################################################################


###########################################################
###########################################################
//echo ''.$num.'UPDATE `pve_results` SET `number_uron` = '.$num.', `gold` = `gold` + '.$gold.', `silver` = '.$silver.', `exp` = '.$exp.', `fuel` = `fuel` + '.$fuel.', `crewpoints` = '.$crewpoints.' WHERE `id` = '.$ress['id'].'<hr>';
$mysqli->query('UPDATE `pve_results` SET `number_uron` = '.$num.', `gold` = `gold` + '.$gold.', `silver` = '.$silver.', `exp` = '.$exp.', `fuel` = `fuel` + '.$fuel.', `crewpoints` = '.$crewpoints.' WHERE `id` = '.$ress['id'].' LIMIT 1');
###########################################################
###########################################################



###########################################################
if($prom['time_20']>time()){
$res = $mysqli->query('SELECT * FROM `bz_user` WHERE `user` = "'.$users['id'].'" and `tip` = "'.$prom['tip_20'].'"');
$bz_user = $res->fetch_assoc();
if($bz_user['step']==1 and $bz_user['prog_']<$bz_user['prog']){
$mysqli->query('UPDATE `bz_user` SET `prog_` = `prog_` + '.$exp.' WHERE `id` = '.$bz_user['id'].'');
}
}
$mysqli->query('UPDATE `users` SET `silver` = '.($users['silver']+$silver).', `gold` = `gold` + '.$gold.', `exp` = '.($users['exp']+$exp).', `fuel` = '.($users['fuel']+$fuel).' WHERE `id` = '.$users['id'].' LIMIT 1');
###########################################################
if($users['company']){
$res_company = $mysqli->query('SELECT * FROM `company` WHERE `id` = '.$users['company'].' LIMIT 1');
$company = $res_company->fetch_assoc();
$res_company_user = $mysqli->query('SELECT * FROM `company_user` WHERE `user` = '.$users['id'].' and `company` = '.$company['id'].' LIMIT 1');
$company_user = $res_company_user->fetch_assoc();
$res_crew_user = $mysqli->query('SELECT * FROM `crew_user` WHERE `user` = '.$users['id'].' and `tip` = "1" LIMIT 1');
$crew_user = $res_crew_user->fetch_assoc();
$res_s6 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "6" and `user`  = "'.$ress['user'].'" LIMIT 1');
$skills_6 = $res_s6->fetch_assoc(); // Курсы офицеров Повышает заработанный опыт дивизии.
$exp_company = $exp+  ($exp*($crew_user['sposobn']+$skills_6['bon'])/100);
$mysqli->query('UPDATE `company_user` SET `company_exp` = '.($company_user['company_exp']+$exp_company).', `company_exp_stats` = '.($company_user['company_exp_stats']+$exp_company).' WHERE `id` = '.$company_user['id'].' LIMIT 1');
$mysqli->query('UPDATE `company` SET `exp` = '.($company['exp']+$exp_company).' WHERE `id` = '.$company['id'].' LIMIT 1');
}
###########################################################
$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user`  = "'.$ress['user'].'" LIMIT 1');
$a_u = $res->fetch_assoc();
$mysqli->query('UPDATE `ammunition_users` SET `crewpoints` = '.($a_u['crewpoints']+$crewpoints).' WHERE `id` = '.$a_u['id'].' LIMIT 1');
###########################################################




}




if($p['time_pve']<=time() and $p['time_pve']>0 and $p['tip']==1 and $col_4[0]>0){
$pobeda = 1; // закончилось время оборонительной операции и остались живие реальные игроки >> то есть победа и закончилось время
}
if($p['time_pve']>time() and $p['tip']==1 and $col_4[0]<=0 and $col_3[0]>0){
$pobeda = 2; // оборонительная операция , все боты убиты >> то есть победа , мы сдержали оборону
}
if($p['time_pve']>time() and $p['tip']==1 and $col_4[0]>0 and $col_3[0]<=0){
$pobeda = 3; // оборонительная операция , все игроки убиты >> то есть поражение , мы не сдержали оборону
}


if($p['time_pve']<=time() and $p['time_pve']>0 and $p['tip']==2 and $col_4[0]>0 and $col_3[0]>0){
$pobeda = 4; // закончилось время наступателньой операции и остались живие реальные игроки и боты >> то есть поражение и закончилось время
}
if($p['time_pve']>time() and $p['tip']==2 and $col_4[0]<=0 and $col_3[0]>0){
$pobeda = 5; // наступательная операция , все боты убиты >> то есть победа , мы убили всех противников
}
if($p['time_pve']>time() and $p['tip']==2 and $col_4[0]>0 and $col_3[0]<=0){
$pobeda = 6; // наступательная операция , все игроки убиты >> то есть поражение , боты убили всех игроков
}


$mysqli->query('UPDATE `pve` SET `user` = "0", `where_user` = "'.$col_1[0].'", `where_ank` = "'.$col_2[0].'", `survived_user` = "'.$col_3[0].'", `survived_ank` = "'.$col_4[0].'", `time_pve` = "0", `time_end` = "'.time().'", `pobeda` = "'.$pobeda.'" WHERE `pve_id` = '.$p['pve_id'].' ');
$mysqli->query('TRUNCATE TABLE pve_log ');
$mysqli->query('TRUNCATE TABLE pve_user ');

header('Location: /pve/');
exit();
}
##############################################################################################################################
##############################################################################################################################
##############################################################################################################################
















############ АТАКА БОТОВ
##############################################################################################################################
$attack_bot = $mysqli->query('SELECT * FROM `pve_user` WHERE `pve_id` = "'.$p['pve_id'].'" and `bot` = "1" and `time_attack` < "'.time().'" ORDER BY `id` asc LIMIT 50');
while ($p_u_ = $attack_bot->fetch_array()){

$res = $mysqli->query('SELECT * FROM `pve_user` WHERE `id` = '.$p_u_['goal'].' and `pve_id` = '.$p['pve_id'].' LIMIT 1');
$p_u_ank_ = $res->fetch_assoc();

if($p_u_ank_['p_']<=0 or !$p_u_ank_['id'] or $p_u_['goal']<=0 or $p_u_['goal']==$p_u_['id']){
$stmt_g = $mysqli->prepare('SELECT t.id FROM pve_user as t,
            (SELECT ROUND((SELECT MAX(id) FROM pve_user) * rand()) as rnd FROM pve_user) tmp
            WHERE t.id >= (rnd) and `nick` != ? and `pve_id` = ? and `p_` > ? 
			ORDER BY camouflage asc 
			LIMIT 1');
$stmt_g->bind_param("sss", $nick, $pve_id, $hp);
$nick = $p_u_['nick'];$pve_id = $p['pve_id'];$hp = 0;$stmt_g->execute();$res = $stmt_g->get_result();$goal = $res->fetch_assoc(); 
$mysqli->query('UPDATE `pve_user` SET `goal` = "'.$goal['id'].'" WHERE `id` = '.$p_u_['id'].' ');
} 


if($p['time_pve']<time()){continue;}
if(!$p_u_){continue;}
if(!$p){continue;}
if($p_u_['p_']<=0){continue;}
if($p_u_ank_['p_']<=0){continue;}
if($p_u_['goal']<=0){continue;}


if($p_u_ank_['b']<500){$armor = ($p_u_ank_['b']/10);}else{$armor = ($p_u_ank_['b']/40);}
$attack = (($p_u_['a']/4) -(($p_u_['a']/4)*$armor/100) );

$rand_s2 = rand(1,100); // Рикошет
$rand_s3 = rand(1,100); // Слабые места
if($rand_s3 <= $p_u_['weaknessdetection']){if($p_u_['sniper']>0){$attack = floor($attack+($attack*(rand($p_u_['sniper'],($p_u_['sniper']+50)))/100));$txt_krit = '(крит)';}elsE{$attack = $attack;$txt_krit = '';}}//если выпал крит смотрим как прокачан снайпер и увеличиваем урон

if($p_u_['t']<500){$tochnost = ($p_u_['t']/10);}else{$tochnost = ($p_u_['t']/40);}
$toch = ((($p_u_['a']/4)*$tochnost/100) );

if(($p_u_['time_attack']-time()) >= 3){
$attack = 0;
}elseif(($p_u_['time_attack']-time()) == 2){
$attack = ($attack*20/100);
}elseif(($p_u_['time_attack']-time()) == 1){
$attack = ($attack*60/100);
}elseif(($p_u_['time_attack']-time()) <= 0){
$attack = $attack;
}

if($vip['time1']>time()){$v1 = 25;}elsE{$v1 = 0;}
if($vip['time3']>time()){$v3 = 50;}elsE{$v3 = 0;}
if($vip['time4']>time()){$v4 = 50;}elsE{$v4 = 0;}
$attack = ($attack+ ($attack*($shell_s['o']+$v1+$v3+$v4)/100));
$attack = ($attack- ($attack*rand(0.1,10)/100));
$attack = floor($attack+$toch);
if($attack>=$p_u_ank_['p_']){$attack = ceil($p_u_ank_['p_']);}else{$attack = ceil($attack);}

$l = $mysqli->query('SELECT * FROM `pve_user` WHERE `pve_id` = "'.$p['pve_id'].'" and `bot` = "0" and (`goal` = "'.$p_u_['id'].'" or `id` = "'.$p_u_['goal'].'") ORDER BY `id` asc');

if(($p_u_['time_attack']-time()) >= 3){
}elseif($rand_s2 <= $p_u_ank_['ricochet']){ // Рикошет
$text = "<span class='blue1'>РИКОШЕТ: </span><span class='yellow1 td_u'>".$p_u_['nick']."</span> <img src='/images/shells/Regular.png'> выстрелил в <span class='yellow1 td_u'>".$p_u_ank_['nick']."</span> на <span class='red1'>0 урона ".$txt_krit." </span>";
$mysqli->query("UPDATE `pve_user` SET `time_attack` = '".(time()+rand(5,10))."' WHERE `id` = '".$p_u_['id']."' ");
while ($log = $l->fetch_array()){
$mysqli->query('INSERT INTO `pve_log` SET `time` = "'.time().'", `text` = "'.$text.'", `pve_id` = "'.$p['pve_id'].'", `user` = "'.$log['user'].'" ');
}
}else{
$text = "<span class='yellow1 td_u'>".$p_u_['nick']."</span> <img src='/images/shells/Regular.png'> выстрелил в <span class='yellow1 td_u'>".$p_u_ank_['nick']."</span> на <span class='red1'>".$attack." урона ".$txt_krit."</span>";
$mysqli->query("UPDATE `pve_user` SET `time_attack` = '".(time()+rand(5,10))."' WHERE `id` = '".$p_u_['id']."' ");
while ($log = $l->fetch_array()){
$mysqli->query('INSERT INTO `pve_log` SET `time` = "'.time().'", `text` = "'.$text.'", `pve_id` = "'.$p['pve_id'].'", `user` = "'.$log['user'].'" ');
}
if($attack>=$p_u_ank_['p_']){
$text = "<span class='orange'><span class='yellow1 td_u'>".$p_u_['nick']."</span> уничтожил <span class='yellow1 td_u'>".$p_u_ank_['nick']."</span></span>";
while ($log = $l->fetch_array()){
$mysqli->query('INSERT INTO `pve_log` SET `time` = "'.time().'", `text` = "'.$text.'", `pve_id` = "'.$p['pve_id'].'", `user` = "'.$log['user'].'" ');
}
$res = $mysqli->query('SELECT f.id FROM pve_user f
      JOIN ( SELECT RAND() * (SELECT MAX(id) FROM pve_user) AS max_id ) AS m
      WHERE f.id >= m.max_id and `nick` != "'.$p_u_['nick'].'" and `pve_id` = "'.$p['pve_id'].'" and `p_` > "0"
      ORDER BY f.camouflage ASC LIMIT 1');
$goal = $res->fetch_assoc();
$mysqli->query('UPDATE `pve_user` SET `goal` = "'.$goal['id'].'" WHERE `id` = '.$p_u_['id'].'');
$mysqli->query("UPDATE `pve_results` SET `kill` = `kill` + '1', `uron` = `uron` + '".$attack."', `time` = '".time()."' WHERE `user` = '".$p_u_['user']."' and `pve_id` = '".$p['pve_id']."' ");
}else{
$mysqli->query("UPDATE `pve_results` SET `uron` = `uron` + '".$attack."', `time` = '".time()."' WHERE `user` = '".$p_u_['user']."' and `pve_id` = '".$p['pve_id']."' ");
}
$mysqli->query("UPDATE `pve_user` SET `p_` = '".($p_u_ank_['p_']-$attack)."' WHERE `id` = '".$p_u_ank_['id']."' ");
}
}
##############################################################################################################################











/* 







$attack_bot = $mysqli->query('SELECT * FROM `pve_user` WHERE `pve_id` = "'.$p['pve_id'].'" and `p_` > "0" and `bot` = "1" and `time_attack` < "'.time().'" ORDER BY `id` asc LIMIT 50');
while ($p_u_ = $attack_bot->fetch_array()){
//echo '1';
$res = $mysqli->query('SELECT * FROM `pve_user` WHERE `id` = '.$p_u_['goal'].' and `pve_id` = '.$p['pve_id'].' ');
$p_u_ank_ = $res->fetch_assoc();




if($p_u_ank_['p_']<=0 or $p_u_['goal']<=0 ){ // сомнительно то что боты не могут бить ботов $p_u_ank_['user']==0 $p_u_ank_['bot']==1
$res = $mysqli->query('SELECT f.id FROM pve_user f
      JOIN ( SELECT RAND() * (SELECT MAX(id) FROM pve_user) AS max_id ) AS m
      WHERE f.id >= m.max_id and `nick` != "'.$p_u_['nick'].'" and `nick` is not NULL and `pve_id` = "'.$p['pve_id'].'" and `p_` > "0"
      ORDER BY f.camouflage ASC LIMIT 1');
$goal = $res->fetch_assoc();
$mysqli->query('UPDATE `pve_user` SET `goal` = "'.$goal['id'].'" WHERE `id` = '.$p_u_['id'].' LIMIT 1');
}


if($p['time_pve']<time()){break;exit();}
if(!$p_u_){break;exit();}
if(!$p){break;exit();}
if($p_u_['p_']<=0){break;exit();}
if($p_u_ank_['p_']<=0){break;exit();}
if($p_u_['goal']<=0){break;exit();}// or $p_u_ank_['bot']==1




if($p_u_ank_['b']<500){$armor = ($p_u_ank_['b']/10);}else{$armor = ($p_u_ank_['b']/40);}
$attack = (($p_u_['a']/4) -(($p_u_['a']/4)*$armor/100) );

$rand_s2 = rand(1,100); // Рикошет
$rand_s3 = rand(1,100); // Слабые места
if($rand_s3 <= $p_u_['weaknessdetection']){if($p_u_['sniper']>0){$attack = floor($attack+($attack*(rand($p_u_['sniper'],($p_u_['sniper']+50)))/100));$txt_krit = '(крит)';}elsE{$attack = $attack;$txt_krit = '';}}//если выпал крит смотрим как прокачан снайпер и увеличиваем урон

if($p_u_['t']<500){$tochnost = ($p_u_['t']/10);}else{$tochnost = ($p_u_['t']/40);}
$toch = ((($p_u_['a']/4)*$tochnost/100) );

if(($p_u_['time_attack']-time()) >= 3){
$attack = 0;
}elseif(($p_u_['time_attack']-time()) == 2){
$attack = ($attack*20/100);
}elseif(($p_u_['time_attack']-time()) == 1){
$attack = ($attack*60/100);
}elseif(($p_u_['time_attack']-time()) <= 0){
$attack = $attack;
}

if($vip['time1']>time()){$v1 = 25;}elsE{$v1 = 0;}
if($vip['time3']>time()){$v3 = 50;}elsE{$v3 = 0;}
if($vip['time4']>time()){$v4 = 50;}elsE{$v4 = 0;}
$attack = ($attack+ ($attack*($shell_s['o']+$v1+$v3+$v4)/100));
$attack = ($attack- ($attack*rand(0.1,10)/100));
$attack = floor($attack+$toch);
if($attack>=$p_u_ank_['p_']){$attack = ceil($p_u_ank_['p_']);}else{$attack = ceil($attack);}


if(($p_u_['time_attack']-time()) >= 3){
}elseif($rand_s2 <= $p_u_ank_['ricochet']){ // Рикошет
$text = "<span class='blue1'>РИКОШЕТ: </span><span class='yellow1 td_u'>".$p_u_['nick']."</span> <img src='/images/shells/Regular.png'> выстрелил в <span class='yellow1 td_u'>".$p_u_ank_['nick']."</span> на <span class='red1'>0 урона ".$txt_krit." </span>";
$mysqli->query("UPDATE `pve_user` SET `time_attack` = '".(time()+10)."' WHERE `id` = '".$p_u_['id']."' LIMIT 1");
$mysqli->query('INSERT INTO `pve_log` SET `time` = "'.time().'", `text` = "'.$text.'", `pve_id` = "'.$p['pve_id'].'", `ank_nick` = "'.$p_u_ank_['nick'].'", `user_nick` = "'.$p_u_['nick'].'"');
}else{
$text = "<span class='yellow1 td_u'>".$p_u_['nick']."</span> <img src='/images/shells/Regular.png'> выстрелил в <span class='yellow1 td_u'>".$p_u_ank_['nick']."</span> на <span class='red1'>".$attack." урона ".$txt_krit."</span>";
$mysqli->query("UPDATE `pve_user` SET `time_attack` = '".(time()+10)."' WHERE `id` = '".$p_u_['id']."' LIMIT 1");
$mysqli->query('INSERT INTO `pve_log` SET `time` = "'.time().'", `text` = "'.$text.'", `pve_id` = "'.$p['pve_id'].'", `ank_nick` = "'.$p_u_ank_['nick'].'", `user_nick` = "'.$p_u_['nick'].'"');

if($attack>=$p_u_ank_['p_']){
$text = "<span class='orange'><span class='yellow1 td_u'>".$p_u_['nick']."</span> уничтожил <span class='yellow1 td_u'>".$p_u_ank_['nick']."</span></span>";
$mysqli->query('INSERT INTO `pve_log` SET `ank_nick` = "'.$p_u_ank_['nick'].'", `user_nick` = "'.$p_u_['nick'].'", `time` = "'.time().'", `text` = "'.$text.'", `pve_id` = "'.$p['id'].'"');

$res = $mysqli->query('SELECT f.id FROM pve_user f
      JOIN ( SELECT RAND() * (SELECT MAX(id) FROM pve_user) AS max_id ) AS m
      WHERE f.id >= m.max_id and `nick` != "'.$p_u_['nick'].'" and `nick` is not NULL and `pve_id` = "'.$p['pve_id'].'" and `p_` > "0"
      ORDER BY f.camouflage ASC LIMIT 1');
$goal = $res->fetch_assoc();
$mysqli->query('UPDATE `pve_user` SET `goal` = "'.$goal['id'].'" WHERE `id` = '.$p_u_['id'].' LIMIT 1');
}

$mysqli->query("UPDATE `pve_user` SET `p_` = '".($p_u_ank_['p_']-$attack)."' WHERE `id` = '".$p_u_ank_['id']."' LIMIT 1");
}
}

 */








/* if($p['time_attack_assault']<=time()){
$cikl = $mysqli->query('SELECT * FROM `pve_user` WHERE `p_` > "0" and `pve_id` = "'.$p['pve_id'].'" ORDER BY `id` desc LIMIT 1000');
while ($cik = $cikl->fetch_array()){
if($p['time_pve']<time()){break;exit();}
if(!$p){break;exit();}

$res = $mysqli->query('SELECT * FROM `pve_user` WHERE `id` = '.$cik['goal'].' and `pve_id` = '.$p['pve_id'].' ');
$ank = $res->fetch_assoc();

$attack = rand(10,50);

$mysqli->query("UPDATE `pve_user` SET `p_` = '".($cik['p_']-$attack)."' WHERE `id` = '".$cik['id']."' ");
$text = "Разрыв артиллерийского снаряда нанёс вам урон <span class='red1'>".$attack." урона </span>";
$mysqli->query('INSERT INTO `pve_log` SET `time` = "'.time().'", `text` = "'.$text.'", `pve_id` = "'.$p['pve_id'].'", `user_nick` = "'.$cik['nick'].'" '); 

if($attack>=$cik['p_']){
$mysqli->query('UPDATE `pvp_user` SET `p` = "0" WHERE `id` = '.$cik['id'].' LIMIT 1');
$text1 = "Артиллерийский обстрел <span class='orange'>уничтожил</span> <span class='yellow1 td_u'>".$cik['nick']."</span>";
$mysqli->query('INSERT INTO `pve_log` SET `user_nick` = "'.$cik['nick'].'", `ank_nick` = "'.$ank['nick'].'", `time` = "'.time().'", `text` = "'.$text1.'", `pve_id` = "'.$p['pve_id'].'"');
break;
exit;
}
}
$mysqli->query("UPDATE `pve` SET `time_attack_assault` = '".(time()+10)."' WHERE `pve_id` = '".$p['pve_id']."' LIMIT 1");
} */
//echo '1 - '.round(microtime(1) - $t, 3).' сек<hr>';
##########################################################################################################################################################
// АРТ УДАРЫ 
##########################################################################################################################################################
















$mysqli->query("UPDATE `pve` SET `user` = '0' WHERE `pve_id` = '".$p['pve_id']."' LIMIT 1");
}



























echo '<div class="buy-place-block"><div class="feedbackPanelINFO"><div class="line1"><span class="feedbackPanelINFO">До конца боя: '._time($p['time_pve']-time()).' </span></div></div></div>';
echo '<div class="p5">';






$col_u_ = $mysqli->query("SELECT COUNT(*) FROM `pve_user` WHERE `pve_id` = ".$p['pve_id']." and `p_` > '0' ");
$col_us = $col_u_->fetch_array(MYSQLI_NUM);

$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user`  = "'.$user['id'].'" LIMIT 1');
$a_users = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `shellskills` WHERE `user` = "'.$user['id'].'" LIMIT 1');
$shell_s = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `vip` WHERE `user` = "'.$user['id'].'" LIMIT 1');
$vip = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `skills_user` WHERE `user` = "'.$user['id'].'" and `tip` = "4" LIMIT 1');
$skills_u = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `pve_user` WHERE `nick` = "'.$user['login'].'" and `pve_id` = '.$p['pve_id'].' LIMIT 1');
$p_u = $res->fetch_assoc();


if(!$p_u){
header('Location: /pve/');
exit();
}


$res = $mysqli->query('SELECT * FROM `pve_user` WHERE `id` = '.$p_u['goal'].' and `pve_id` = '.$p['pve_id'].' LIMIT 1');
$p_u_ank = $res->fetch_assoc();



if($p_u_ank['p_']<=0 or $p_u['goal']==0){
/* $res = $mysqli->query('SELECT f.id FROM pve_user f
      JOIN ( SELECT RAND() * (SELECT MAX(id) FROM pve_user) AS max_id ) AS m
      WHERE f.id >= m.max_id and `nick` != "'.$user['login'].'" and `pve_id` = "'.$p['pve_id'].'" and `p_` > "0" and `bot` = "1"
      ORDER BY f.camouflage ASC LIMIT 1');
$goal = $res->fetch_assoc();
if($goal){$mysqli->query('UPDATE `pve_user` SET `goal` = "'.$goal['id'].'" WHERE `id` = '.$p_u['id'].' LIMIT 1');} */
$stmt_g = $mysqli->prepare('SELECT t.id FROM pve_user as t,
            (SELECT ROUND((SELECT MAX(id) FROM pve_user) * rand()) as rnd FROM pve_user) tmp
            WHERE t.id >= (rnd) and `nick` != ? and `pve_id` = ? and `p_` > ?  and `bot` = ?
			ORDER BY camouflage asc 
			LIMIT 1');
$stmt_g->bind_param("ssss", $nick, $pve_id, $hp, $bot);
$nick = $p_u['nick'];$pve_id = $p['pve_id'];$hp = 0;$bot = 1;$stmt_g->execute();$res = $stmt_g->get_result();$goal = $res->fetch_assoc(); 
//echo ''.$goal['id'].'';

if($goal){$mysqli->query('UPDATE `pve_user` SET `goal` = "'.$goal['id'].'" WHERE `id` = '.$p_u['id'].' LIMIT 1');}
$p_u['goal']=$p_u['goal'];
}











$res = $mysqli->query('SELECT * FROM `tanks` WHERE `id` = '.$p_u['tank_id'].' LIMIT 1');
$tank = $res->fetch_assoc();

if($p_u_ank){
$res = $mysqli->query('SELECT * FROM `tanks` WHERE `id` = '.$p_u_ank['tank_id'].' LIMIT 1');
$ank_tank = $res->fetch_assoc();
}

if($tank['tip'] == 1){$tip_tank = 'average';$tip_tank_ru = 'СРЕДНИЙ ТАНК';} // СТ
if($tank['tip'] == 2){$tip_tank = 'heavy';$tip_tank_ru = 'ТЯЖЕЛЫЙ ТАНК';} // ТТ
if($tank['tip'] == 3){$tip_tank = 'SAU';$tip_tank_ru = 'ПТ-САУ';} // САУ

if($ank_tank['tip'] == 1){$tip_tank_ = 'average';$tip_tank_ru_ = 'СРЕДНИЙ ТАНК';} // СТ
if($ank_tank['tip'] == 2){$tip_tank_ = 'heavy';$tip_tank_ru_ = 'ТЯЖЕЛЫЙ ТАНК';} // ТТ
if($ank_tank['tip'] == 3){$tip_tank_ = 'SAU';$tip_tank_ru_ = 'ПТ-САУ';} // САУ


$usP = round(100/(($p_u['p']+0.00001)/(($p_u['p_'])+0.00001)));
if($usP > 100) {$usP = 100;}
$usA = round(100/(($p_u_ank['p']+0.00001)/(($p_u_ank['p_'])+0.00001)));
if($usA > 100) {$usA = 100;}

if($usP>75){$us_i = '';}
if($usP>40 && $usP<=75){$us_i = '/'.$tank['name'].'_1';}
if($usP>15 && $usP<=40){$us_i = '/'.$tank['name'].'_2';}
if($usP<=15){$us_i = '/'.$tank['name'].'_3';}

if($usA>75){$ank_i = '';}
if($usA>40 && $usA<=75){$ank_i = '/'.$ank_tank['name'].'_1';}
if($usA>15 && $usA<=40){$ank_i = '/'.$ank_tank['name'].'_2';}
if($usA<=15){$ank_i = '/'.$ank_tank['name'].'_3';}



if($p_u['p_']>0){

if($ank_tank['tip']==1){
$butt = 'БРОНЕБОЙНЫЕ&nbsp;('.$a_users['b'].')';
$img = 'ArmorPiercing';
$href = 'attack'.$p_u_ank['id'].'_bb';
}elseif($ank_tank['tip']==2){
$butt = 'КУМУЛЯТИВНЫЕ&nbsp;('.$a_users['k'].')';
$img = 'HollowCharge';
$href = 'attack'.$p_u_ank['id'].'_k';
}elseif($ank_tank['tip']==3){
$butt = 'ФУГАСНЫЕ&nbsp;('.$a_users['f'].')';
$img = 'HighExplosive';
$href = 'attack'.$p_u_ank['id'].'_f';
}

echo '<table><tbody><tr>
<td class="w50 pr1">
<div class="trnt-block mb10"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="p5 cntr custombg boi_1" w:id="heroDiv">
<div class="small bold green1 sh_b mb10 mt5">'.$user['login'].'</div>
<img class="scale" class="tank-img" w:id="heroTankImg" src="/images/tanks/'.$tip_tank.'/'.$tank['country'].'/'.$tank['name'].''.$us_i.'.png" alt="'.$user['login'].'" style="width:88%;">';


echo '<table class="rblock esmall"><tbody><tr>
<td class="progr rate-block"><div class="scale-block"><div class="scale-next" style="width:100%;"><div class="scale" style="width:'.$usP.'%;"><div class="in">&nbsp;</div></div></div><div class="mask"><div class="in">&nbsp;</div></div></div></td>
<td><div class="value-block lh1"><span><span>'.$p_u['p_'].'</span></span></div></td>
</tr></tbody></table>
</div></div></div></div></div></div></div></div></div></div></td>';





if($p_u_ank['p_']<0){$p_u_ank['p_'] = 0;}

echo '<td class="w50 pl1">
<div class="trnt-block mb10"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="p5 cntr custombg boi_1" w:id="targetDiv">
<div class="small bold red1 sh_b mb10 mt5">'.$p_u_ank['nick'].'</div><img class="tank-img" w:id="targetTankImg" src="/images/tanks/'.$tip_tank_.'/'.$ank_tank['country'].'/'.$ank_tank['name'].''.$ank_i.'.png" alt="'.$p_u_ank['nick'].'" style="width:88%;">';


echo '<table class="rblock esmall"><tbody><tr>
<td class="progr rate-block">
<div class="scale-block"><div class="scale-next" style="width:100%;"><div class="scale" style="width:'.$usA.'%;"><div class="in">&nbsp;</div></div></div>
<div class="mask"><div class="in">&nbsp;</div></div></div>
</td>
<td><div class="value-block lh1"><span><span>'.$p_u_ank['p_'].'</span></span></div></td>
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
echo '<td style="width:33%;padding-right:6px;"><a w:id="repairLink" href="?rem'.$p_u['id'].'" class="simple-but blue"><span><span>'.tls($p_u['time_rem']-time()).' сек</span></span></a></td>';
}else{
echo '<td style="width:33%;padding-right:6px;"><a w:id="repairLink" href="?rem'.$p_u['id'].'" class="simple-but blue"><span><span>Ремкомплект</span></span></a></td>';
}
if($p_u['time_manevr']>time()){
echo '<td style="width:33%;padding:0 2px;"><a w:id="maneuverLink" href="?manevr'.$p_u['id'].'" class="simple-but blue"><span><span>'.tls($p_u['time_manevr']-time()).' сек</span></span></a></td>';
}else{
echo '<td style="width:33%;padding:0 2px;"><a w:id="maneuverLink" href="?manevr'.$p_u['id'].'" class="simple-but blue"><span><span>Маневр</span></span></a></td>';
}
echo '<td style="width:33%;padding-left:6px;"><a w:id="changeTargetLink" href="?smena'.$p_u['id'].'" class="simple-but blue"><span><span>Сменить цель</span></span></a></td>
</tr></tbody></table>';

}elsE{
echo '<div class="buy-place-block"><div class="line1">Ваш танк подбит. Ожидайте окончания сражения.</div></div>';
echo '<a w:id="refreshLink" href="?" class="simple-but"><span><span>Обновить</span></span></a>';
}





















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
if($p['time_pve']<time()){header('Location: ?');exit();}
if(!$p_u){header('Location: ?');exit();}
if(!$p){header('Location: ?');exit();}
if($p_u['p_']<=0){header('Location: ?');exit();}
if($p_u_ank['p_']<=0){header('Location: ?');exit();} // можно сделать вместо переадресации удар по новому противнику, или назначить нового противника
if($i==3){if($a_users['b']<=0){$text = "<span class='gray1'>У вас нет такого снаряда</span>";$mysqli->query('INSERT INTO `pve_log` SET `user` = "'.$user['id'].'", `time` = "'.time().'", `text` = "'.$text.'", `pve_id` = "'.$p['pve_id'].'" ');header('Location: ?');exit();}}
if($i==4){if($a_users['k']<=0){$text = "<span class='gray1'>У вас нет такого снаряда</span>";$mysqli->query('INSERT INTO `pve_log` SET `user` = "'.$user['id'].'", `time` = "'.time().'", `text` = "'.$text.'", `pve_id` = "'.$p['pve_id'].'" ');header('Location: ?');exit();}}
if($i==5){if($a_users['f']<=0){$text = "<span class='gray1'>У вас нет такого снаряда</span>";$mysqli->query('INSERT INTO `pve_log` SET `user` = "'.$user['id'].'", `time` = "'.time().'", `text` = "'.$text.'", `pve_id` = "'.$p['pve_id'].'" ');header('Location: ?');exit();}}
if(($p_u['time_attack']-time()) >= 3){$text = "<span class='gray1'>Снаряд ещё не заряжен</span>";$mysqli->query('INSERT INTO `pve_log` SET `user` = "'.$user['id'].'", `time` = "'.time().'", `text` = "'.$text.'", `pve_id` = "'.$p['pve_id'].'" ');header('Location: ?');exit();}

if($i==1){ // смена цели для первой кнопки
if($col_us[0]>2){ // если нас только двое, значит мне ненакого сменить
$stmt_g = $mysqli->prepare('SELECT t.id FROM pve_user as t,
            (SELECT ROUND((SELECT MAX(id) FROM pve_user) * rand()) as rnd FROM pve_user) tmp
            WHERE t.id >= (rnd) and `nick` != ? and `pve_id` = ? and `p_` > ? 
			ORDER BY camouflage asc 
			LIMIT 1');
$stmt_g->bind_param("sss", $nick, $pve_id, $hp);
$nick = $p_u['nick'];$pve_id = $p['pve_id'];$hp = 0;$stmt_g->execute();$res = $stmt_g->get_result();$goal = $res->fetch_assoc(); 
$mysqli->query('UPDATE `pve_user` SET `goal` = "'.$goal['id'].'" WHERE `id` = '.$p_u['id'].' ');
$res = $mysqli->query('SELECT user, p_ FROM `pve_user` WHERE `pve_id` = "'.$p_u['pve_id'].'" and `id` = "'.$goal['id'].'" LIMIT 1');
$p_u_ank = $res->fetch_assoc();#########
}elseif($col_us[0]<=2){
$goal['id'] = $p_u['goal'];
}
}elseif($i>1){
$goal['id'] = $p_u['goal'];
}

#####################################################################################
#####################################################################################
#####################################################################################
if($p_u_ank['p_']<=0){header('Location: ?');exit();}
if($p_u_ank['b']<500){$armor = ($p_u_ank['b']/10);}else{$armor = ($p_u_ank['b']/40);}
$attack = (($p_u['a']/4) -(($p_u['a']/4)*$armor/100) );
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


if($i==1){$imag = 'Regular';$navik = $shell_s['o'];}if($i==2){$imag = 'Regular';$navik = $shell_s['o'];}if($i==3){$imag = 'ArmorPiercing';$navik = $shell_s['b'];}if($i==4){$imag = 'HollowCharge';$navik = $shell_s['k'];}if($i==5){$imag = 'HighExplosive';$navik = $shell_s['f'];}
if($i>=3){$bonus_sh = 50;$razbros = 5;}else{$bonus_sh = 0;$razbros = 10;}

if($vip['time1']>time()){$v1 = 25;}elsE{$v1 = 0;}
if($vip['time3']>time()){$v3 = 50;}elsE{$v3 = 0;}
if($vip['time4']>time()){$v4 = 50;}elsE{$v4 = 0;}
$attack = ($attack+ ($attack*($navik+$bonus_sh+$v1+$v3+$v4)/100));
$attack = ($attack- ($attack*rand(0.1,$razbros)/100));
if($attack>=$p_u_ank['p_']){$attack = ceil($p_u_ank['p_']);}else{$attack = ceil($attack);}
################################################

################################################
if($rand_s2 <= $skills_2['bon']){ // Рикошет
$text = "<span class='blue1'>РИКОШЕТ: </span><span class='yellow1 td_u'>".$user['login']."</span> <img src='/images/shells/ArmorPiercing.png'> выстрелил в <span class='yellow1 td_u'>".$p_u_ank['nick']."</span> на <span class='red1'>0 урона ".$txt_krit." </span>";
$l = $mysqli->query('SELECT * FROM `pve_user` WHERE `pve_id` = "'.$p['pve_id'].'" and `bot` = "0" and (`goal` = "'.$p_u['id'].'" or `id` = "'.$p_u['id'].'") ORDER BY `id` asc');
while ($log = $l->fetch_array()){$mysqli->query('INSERT INTO `pve_log` SET `time` = "'.time().'", `text` = "'.$text.'", `pve_id` = "'.$p['pve_id'].'", `user` = "'.$log['user'].'" ');}
$mysqli->query("UPDATE `pve_user` SET `time_attack` = '".(time()+5)."' WHERE `id` = '".$p_u['id']."' LIMIT 1");
}else{
$text = "<span class='yellow1 td_u'>".$user['login']."</span> <img src='/images/shells/HollowCharge.png'> выстрелил в <span class='yellow1 td_u'>".$p_u_ank['nick']."</span> на <span class='red1'>".$attack." урона ".$txt_krit."</span>";
$mysqli->query("UPDATE `pve_user` SET `time_attack` = '".(time()+5)."' WHERE `id` = '".$p_u['id']."' LIMIT 1");
$l = $mysqli->query('SELECT * FROM `pve_user` WHERE `pve_id` = "'.$p['pve_id'].'" and `bot` = "0" and (`goal` = "'.$p_u['id'].'" or `id` = "'.$p_u['id'].'") ORDER BY `id` asc');
while ($log = $l->fetch_array()){$mysqli->query('INSERT INTO `pve_log` SET `time` = "'.time().'", `text` = "'.$text.'", `pve_id` = "'.$p['pve_id'].'", `user` = "'.$log['user'].'" ');}
if($attack>=$p_u_ank['p_']){
$text = "<span class='orange'><span class='yellow1 td_u'>".$user['login']."</span> уничтожил <span class='yellow1 td_u'>".$p_u_ank['nick']."</span></span>";
$l = $mysqli->query('SELECT * FROM `pve_user` WHERE `pve_id` = "'.$p['pve_id'].'" and `bot` = "0" and (`goal` = "'.$p_u['id'].'" or `id` = "'.$p_u['id'].'") ORDER BY `id` asc');
while ($log = $l->fetch_array()){$mysqli->query('INSERT INTO `pve_log` SET `time` = "'.time().'", `text` = "'.$text.'", `pve_id` = "'.$p['pve_id'].'", `user` = "'.$log['user'].'" ');}
$mysqli->query("UPDATE `pve_results` SET `kill` = `kill` + '1', `uron` = `uron` + '".$attack."', `time` = '".time()."' WHERE `user` = '".$p_u['user']."' and `pve_id` = '".$p['pve_id']."' LIMIT 1");
################################################
$res = $mysqli->query('SELECT * FROM `prom` WHERE `id` = "1" limit 1');
$prom = $res->fetch_assoc();
if($prom['time_20']>time()){
$res = $mysqli->query('SELECT * FROM `bz_user` WHERE `user` = "'.$p_u['user'].'" and `tip` = "'.$prom['tip_20'].'"');
$bz_user = $res->fetch_assoc();
if($ank_tank['tip']==1 and $bz_user['step']==4 and $bz_user['prog_']<$bz_user['prog']){
$mysqli->query('UPDATE `bz_user` SET `prog_` = `prog_` + "1" WHERE `id` = '.$bz_user['id'].'');
}
if($ank_tank['tip']==2 and $bz_user['step']==5 and $bz_user['prog_']<$bz_user['prog']){
$mysqli->query('UPDATE `bz_user` SET `prog_` = `prog_` + "1" WHERE `id` = '.$bz_user['id'].'');
}
if($ank_tank['tip']==3 and $bz_user['step']==3 and $bz_user['prog_']<$bz_user['prog']){
$mysqli->query('UPDATE `bz_user` SET `prog_` = `prog_` + "1" WHERE `id` = '.$bz_user['id'].'');
}
}
################################################
}else{
$mysqli->query("UPDATE `pve_results` SET `uron` = `uron` + '".$attack."', `time` = '".time()."' WHERE `user` = '".$p_u['user']."' and `pve_id` = '".$p['pve_id']."' LIMIT 1");
}
$mysqli->query("UPDATE `pve_user` SET `p_` = `p_` - '".($attack)."' WHERE `id` = '".$p_u['goal']."' ");
################################################
if($i==1){$mysqli->query("UPDATE `shellskills` SET `o_` = '".($shell_s['o_']+1)."' WHERE `id` = '".$shell_s['id']."' LIMIT 1");}
if($i==2){$mysqli->query("UPDATE `shellskills` SET `o_` = '".($shell_s['o_']+1)."' WHERE `id` = '".$shell_s['id']."' LIMIT 1");}
if($i==3){$mysqli->query("UPDATE `ammunition_users` SET `b` = '".($a_users['b']-1)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");$mysqli->query("UPDATE `shellskills` SET `b_` = '".($shell_s['b_']+1)."' WHERE `id` = '".$shell_s['id']."' LIMIT 1");}
if($i==4){$mysqli->query("UPDATE `ammunition_users` SET `k` = '".($a_users['k']-1)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");$mysqli->query("UPDATE `shellskills` SET `k_` = '".($shell_s['k_']+1)."' WHERE `id` = '".$shell_s['id']."' LIMIT 1");}
if($i==5){$mysqli->query("UPDATE `ammunition_users` SET `f` = '".($a_users['f']-1)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");$mysqli->query("UPDATE `shellskills` SET `f_` = '".($shell_s['f_']+1)."' WHERE `id` = '".$shell_s['id']."' LIMIT 1");}
################################################
}
header('Location: ?');
exit();
}
}
###########################################################################################################################################
###########################################################################################################################################
###########################################################################################################################################


/* 


if(isset($_GET['attack'.$p_u_ank['id'].''])){ // обычный
if($p['time_pve']<time()){header('Location: ?');exit();}
if(!$p_u){header('Location: ?');exit();}
if(!$p){header('Location: ?');exit();}
if($p_u['p_']<=0){header('Location: ?');exit();}
if($p_u_ank['p_']<=0){header('Location: ?');exit();}
if($p_u_ank['b']<500){$armor = ($p_u_ank['b']/10);}else{$armor = ($p_u_ank['b']/40);}
$attack = (($p_u['a']/4) -(($p_u['a']/4)*$armor/100) );

$rand_s2 = rand(1,100); // Рикошет
$rand_s3 = rand(1,100); // Слабые места
if($rand_s3 <= $p_u['weaknessdetection']){if($p_u['sniper']>0){$attack = floor($attack+($attack*(rand($p_u['sniper'],($p_u['sniper']+50)))/100));$txt_krit = '(крит)';}elsE{$attack = $attack;$txt_krit = '';}}//если выпал крит смотрим как прокачан снайпер и увеличиваем урон

if($p_u['t']<500){$tochnost = ($p_u['t']/10);}else{$tochnost = ($p_u['t']/40);}
//$tochnost = ($p_u['t']/50);
$toch = ((($p_u['a']/4)*$tochnost/100) );

if(($p_u['time_attack']-time()) >= 3){
$attack = 0;
}elseif(($p_u['time_attack']-time()) == 2){
$attack = ($attack*20/100);
}elseif(($p_u['time_attack']-time()) == 1){
$attack = ($attack*60/100);
}elseif(($p_u['time_attack']-time()) <= 0){
$attack = $attack;
}

if($vip['time1']>time()){$v1 = 25;}elsE{$v1 = 0;}
if($vip['time3']>time()){$v3 = 50;}elsE{$v3 = 0;}
if($vip['time4']>time()){$v4 = 50;}elsE{$v4 = 0;}
$attack = ($attack+ ($attack*($shell_s['o']+$v1+$v3+$v4)/100));
$attack = ($attack- ($attack*rand(0.1,10)/100));
$attack = floor($attack+$toch);
if($attack>=$p_u_ank['p_']){$attack = ceil($p_u_ank['p_']);}else{$attack = ceil($attack);}



if(($p_u['time_attack']-time()) >= 3){
$text = "<span class='gray1'>Снаряд ещё не заряжен</span>";
$mysqli->query('INSERT INTO `pve_log` SET `time` = "'.time().'", `text` = "'.$text.'", `pve_id` = "'.$p['id'].'", `user_nick` = "'.$user['login'].'" ');
}elseif($rand_s2 <= $p_u_ank['ricochet']){ // Рикошет
$text = "<span class='blue1'>РИКОШЕТ: </span><span class='yellow1 td_u'>".$user['login']."</span> <img src='/images/shells/Regular.png'> выстрелил в <span class='yellow1 td_u'>".$p_u_ank['nick']."</span> на <span class='red1'>0 урона ".$txt_krit." </span>";
$mysqli->query('INSERT INTO `pve_log` SET `time` = "'.time().'", `text` = "'.$text.'", `pve_id` = "'.$p['id'].'", `user_nick` = "'.$user['login'].'" ');
$mysqli->query("UPDATE `pve_user` SET `time_attack` = '".(time()+5)."' WHERE `id` = '".$p_u['id']."' LIMIT 1");
}else{
$text = "<span class='yellow1 td_u'>".$user['login']."</span> <img src='/images/shells/Regular.png'> выстрелил в <span class='yellow1 td_u'>".$p_u_ank['nick']."</span> на <span class='red1'>".$attack." урона ".$txt_krit."</span>";
$mysqli->query("UPDATE `pve_user` SET `time_attack` = '".(time()+5)."' WHERE `id` = '".$p_u['id']."' LIMIT 1");
$mysqli->query('INSERT INTO `pve_log` SET `time` = "'.time().'", `text` = "'.$text.'", `pve_id` = "'.$p['id'].'", `ank_nick` = "'.$p_u_ank['nick'].'", `user_nick` = "'.$user['login'].'"');

$res = $mysqli->query('SELECT * FROM `pve_results` WHERE `pve_id` = "'.$p['pve_id'].'" and `nick` = "'.$user['login'].'" LIMIT 1');
$pve_r = $res->fetch_assoc();

if($attack>=$p_u_ank['p_']){
$text = "<span class='orange'><span class='yellow1 td_u'>".$user['login']."</span> уничтожил <span class='yellow1 td_u'>".$p_u_ank['nick']."</span></span>";
$mysqli->query('INSERT INTO `pve_log` SET `ank_nick` = "'.$p_u_ank['nick'].'", `user_nick` = "'.$user['login'].'", `time` = "'.time().'", `text` = "'.$text.'", `pve_id` = "'.$p['pve_id'].'"');
if(!$pve_r){
$mysqli->query('INSERT INTO `pve_results` SET `user` = "'.$user['id'].'", `nick` = "'.$user['login'].'", `kill` = "1", `pve_id` = "'.$p['pve_id'].'", `time` = "'.time().'" ');
}elsE{
$mysqli->query("UPDATE `pve_results` SET `kill` = '".($pve_r['kill']+1)."', `pve_id` = '".$p['pve_id']."', `time` = '".time()."' WHERE `id` = '".$pve_r['id']."' LIMIT 1");
}
}

if(!$pve_r){
$mysqli->query('INSERT INTO `pve_results` SET `user` = "'.$user['id'].'", `nick` = "'.$user['login'].'", `uron` = "'.$attack.'", `pve_id` = "'.$p['pve_id'].'", `time` = "'.time().'" ');
}elsE{
$mysqli->query("UPDATE `pve_results` SET `uron` = `uron` + '".$attack."', `time` = '".time()."' WHERE `id` = '".$pve_r['id']."' LIMIT 1");
}

$mysqli->query("UPDATE `pve_user` SET `p_` = '".($p_u_ank['p_']-$attack)."' WHERE `id` = '".$p_u_ank['id']."' LIMIT 1");
$mysqli->query("UPDATE `shellskills` SET `o_` = '".($shell_s['o_']+1)."' WHERE `id` = '".$shell_s['id']."' LIMIT 1");
}
header('Location: ?');
exit();
}
*/






if(isset($_GET['rem'.$p_u['id'].''])){ // ремка
if($p['time_pve']<time()){header('Location: ?');exit();}
if(!$p_u){header('Location: ?');exit();}
if(!$p){header('Location: ?');exit();}
if($p_u['time_rem']>time()){header('Location: ?');exit();}
if($p_u['p_']<=0){header('Location: ?');exit();}
if($a_users['rem']<=0){$text = "<span class='gray1'>У вас нет ремкомплекта</span>";$mysqli->query('INSERT INTO `pve_log` SET `user` = "0", `time` = "'.time().'", `text` = "'.$text.'", `pve_id` = "'.$p['pve_id'].'" ');header('Location: ?');exit();}
$mysqli->query("UPDATE `ammunition_users` SET `rem` = '".($a_users['rem']-1)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
$mysqli->query("UPDATE `pve_user` SET `time_rem` = '".(time()+$skills_u['bon'])."', `p_` = '".($p_u['p'])."' WHERE `id` = '".$p_u['id']."' LIMIT 1");
$text = "<span class='yellow1 td_u'>".$user['login']."</span> <span class='blue2'>использовал ремкомплект</span>";
$l = $mysqli->query('SELECT * FROM `pve_user` WHERE `pve_id` = "'.$p['pve_id'].'" and `bot` = "0" and (`goal` = "'.$p_u['id'].'" or `id` = "'.$p_u['id'].'") ORDER BY `id` asc LIMIT 50');
while ($log = $l->fetch_array()){
$mysqli->query('INSERT INTO `pve_log` SET `time` = "'.time().'", `text` = "'.$text.'", `pve_id` = "'.$p['pve_id'].'", `user` = "'.$log['user'].'" ');
}
header('Location: ?');
exit();
}



if(isset($_GET['manevr'.$p_u['id'].''])){ // маневр
if($p['time_pve']<time()){header('Location: ?');exit();}
if($p_u['time_manevr']>time()){header('Location: ?');exit();}
if(!$p_u){header('Location: ?');exit();}
if(!$p){header('Location: ?');exit();}
if($p_u['p_']<=0){header('Location: ?');exit();}

if($col_us[0]>2){
$c_u_m_i_ = $mysqli->query('SELECT id FROM `pve_user` WHERE `goal` = "'.$p_u['id'].'" ');
while ($c_u_m_i = $c_u_m_i_->fetch_array()){
# выборка противника моим противникам
$stmt_g = $mysqli->prepare('SELECT t.id FROM pve_user as t,
            (SELECT ROUND((SELECT MAX(id) FROM pve_user) * rand()) as rnd FROM pve_user) tmp
            WHERE t.id >= (rnd) and `nick` != ? and `pve_id` = ? and `p_` > ? 
			ORDER BY camouflage asc 
			LIMIT 1');
$stmt_g->bind_param("sss", $nick, $pve_id, $hp);
$nick = $p_u['nick'];$pve_id = $p['pve_id'];$hp = 0;$stmt_g->execute();$res = $stmt_g->get_result();$goal = $res->fetch_assoc(); 
$mysqli->query("UPDATE `pve_user` SET `goal` = '".$goal['id']."' WHERE `id` = '".$c_u_m_i['id']."' ");
}
}
$mysqli->query("UPDATE `pve_user` SET `time_manevr` = '".(time()+20)."' WHERE `id` = '".$p_u['id']."' LIMIT 1");
$text = "<span class='yellow1 td_u'>".$p_u['nick']."</span> <span class='blue2'>применил маневр</span>";
$l = $mysqli->query('SELECT * FROM `pve_user` WHERE `pve_id` = "'.$p['pve_id'].'" and `bot` = "0" and (`goal` = "'.$p_u['id'].'" or `id` = "'.$p_u['id'].'") ORDER BY `id` asc LIMIT 50');
while ($log = $l->fetch_array()){
$mysqli->query('INSERT INTO `pve_log` SET `time` = "'.time().'", `text` = "'.$text.'", `pve_id` = "'.$p['pve_id'].'", `user` = "'.$log['user'].'" ');
}


/* if($col_us[0]==2){
$res = $mysqli->query('SELECT * FROM `pve_user` WHERE `nick` != "'.$p_u_ank['nick'].'", `pve_id` = "'.$p['pve_id'].'" and `p_` > "0" limit 1');
$goal = $res->fetch_assoc();
}else{
$res = $mysqli->query('SELECT f.id FROM pve_user f
      JOIN ( SELECT RAND() * (SELECT MAX(id) FROM pve_user) AS max_id ) AS m
      WHERE f.id >= m.max_id and `nick` != "'.$user['login'].'" and `user` = "0" and `id` != "'.$p_u['goal'].'" and `pve_id` = "'.$p['pve_id'].'" and `p_` > "0"
      ORDER BY f.camouflage ASC LIMIT 1');
$goal = $res->fetch_assoc();
} 

$mysqli->query("UPDATE `pve_user` SET `goal` = '".$goal['id']."' WHERE `goal` = '".$p_u['id']."'");
$mysqli->query("UPDATE `pve_user` SET `time_manevr` = '".(time()+20)."' WHERE `id` = '".$p_u['id']."' LIMIT 1");
$text = "<span class='yellow1 td_u'>".$user['login']."</span> <span class='blue2'>применил маневр</span>";
$mysqli->query('INSERT INTO `pve_log` SET `user_nick` = "'.$user['login'].'", `ank_nick` = "'.$p_u_ank['nick'].'", `time` = "'.time().'", `text` = "'.$text.'", `pve_id` = "'.$p['pve_id'].'"');
*/

header('Location: ?');
exit();
}





if(isset($_GET['smena'.$p_u['id'].''])){ // смена
if($p['time_pve']<time()){header('Location: ?');exit();}
if(!$p_u){header('Location: ?');exit();}
if(!$p){header('Location: ?');exit();}
if($p_u['p_']<=0){header('Location: ?');exit();}

if(($col_us[0]>2) or $p_u_ank['p_']<=0 ){ // если нас только двое, значит мне ненакого сменить
# выборка противника юзеру
$stmt_g = $mysqli->prepare('SELECT t.id FROM pve_user as t,
            (SELECT ROUND((SELECT MAX(id) FROM pve_user) * rand()) as rnd FROM pve_user) tmp
            WHERE t.id >= (rnd) and `nick` != ? and `nick` != ? and `pve_id` = ? and `p_` > ? and `bot` = ? 
			ORDER BY camouflage asc 
			LIMIT 1');
$stmt_g->bind_param("sssss", $nick_us, $nick_ank, $pve_id, $hp, $bot);
$nick_us = $user['login'];$nick_ank = $p_u_ank['nick'];$pve_id = $p['pve_id'];$hp = 0;$bot = 1;$stmt_g->execute();$res = $stmt_g->get_result();$goal = $res->fetch_assoc(); 
$mysqli->query("UPDATE `pve_user` SET `goal` = '".$goal['id']."' WHERE `id` = '".$p_u['id']."' ");
$res = $mysqli->query('SELECT * FROM `pve_user` WHERE `pve_id` = "'.$p['pve_id'].'" and `id` = "'.$goal['id'].'" LIMIT 1');
$p_u_ank = $res->fetch_assoc();######### user, p_, b, id, goal, nick
}

/* if($col_us[0]==2){
$res = $mysqli->query('SELECT * FROM `pve_user` WHERE `nick` != "'.$user['login'].'" and `user` = "0" and `pve_id` = "'.$p['pve_id'].'" and `p_` > "0" limit 1');
$goal = $res->fetch_assoc();
}else{
$res = $mysqli->query('SELECT f.id FROM pve_user f
      JOIN ( SELECT RAND() * (SELECT MAX(id) FROM pve_user) AS max_id ) AS m
      WHERE f.id >= m.max_id and `nick` != "'.$user['login'].'" and `user` = "0" and `id` != "'.$p_u['goal'].'" and `pve_id` = "'.$p['pve_id'].'" and `p_` > "0"
      ORDER BY f.camouflage ASC LIMIT 1');
$goal = $res->fetch_assoc();
}
$mysqli->query("UPDATE `pve_user` SET `goal` = '".$goal['id']."' WHERE `id` = '".$p_u['id']."' LIMIT 1");
 */
header('Location: ?');
exit();
}




























$res = $mysqli->query("SELECT COUNT(*) FROM `pve_user` WHERE `pve_id` = ".$p['pve_id']." and `p_` > '0' and `bot` = '0' ");
$col_3 = $res->fetch_array(MYSQLI_NUM);



echo '<div class="medium bold white cntr mb5">Союзников: '.$col_3[0].' | Врагов: '.$col_4[0].'</div>';
##############################################################################################################################
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content small white">';
$res1 = $mysqli->query('SELECT * FROM `pve_log` WHERE `pve_id` = "'.$p['pve_id'].'" and (`user` = "'.$user['id'].'" or `user` = "0") ORDER BY `id` desc LIMIT 20');//or `user_nick` is NULL
while ($t_r1 = $res1->fetch_array()){echo ''.$t_r1['text'].'<br>';}
echo '</div></div></div></div></div></div></div></div></div></div>';
##############################################################################################################################
echo '<div class="footer"></div>';
echo '</div>';


if($p['time_pve']<=time()){
header('Location: /pve/');
exit();
}
?>