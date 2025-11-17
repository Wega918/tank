<?php
$title = 'Дивизии';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']) {
header('Location: /');
exit();
}
if($user['company']>0) {
header('Location: /company/'.$user['company'].'/');
exit();
}
$res = $mysqli->query('SELECT * FROM `company_zayavki` WHERE `user` = "'.$user['id'].'" and `ank` = "0" and `company`  = "0" ');
$company_zayavki = $res->fetch_assoc();


echo '<div class="p5">
<div class="green2 cntr bold sh_b small pb10 pt10">Дивизия - армейское соединение для ведения боевых действий.</div>


<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="white cntr bold sh_b small pb5">Подай заявку<br>и жди приглашения в дивизию</div>
<div class="bot"><a class="simple-but border gray mb5" href="?nocompany"><span><span>Подать заявку</span></span></a></div>
</div></div></div></div></div></div></div></div></div></div>';


if($company_zayavki['time']>time()){
echo '<div class="cntr small gray1 sh_b bold mb5">Обновление заявки через '._time($company_zayavki['time']-time()).'</div>';
}









$res1 = $mysqli->query('SELECT * FROM `settings` WHERE `id` = "1" ');
$sql = $res1->fetch_assoc();

/* $res_company = $mysqli->query('SELECT * FROM `company` WHERE `id` = 1 LIMIT 1');
$company = $res_company->fetch_assoc();
 */
$res = $mysqli->query('SELECT * FROM `company` WHERE `side` = '.$user['side'].' ORDER BY RAND() LIMIT 1 ');
$company = $res->fetch_assoc();


//$_SESSION['company']=$company['id'];
$mysqli->query('UPDATE `users` SET `company_add` = "'.$company['id'].'" WHERE `id` = '.$user['id'].'');



$res = $mysqli->query("SELECT COUNT(*) FROM `users` WHERE `company` = '".$company['id']."' ");
$c_c_u = $res->fetch_array(MYSQLI_NUM);

if($company['level']>=24){$company_mesta = 24;}else{$company_mesta = $company['level'];}








$res_company = $mysqli->query('SELECT * FROM `company_user` WHERE `company` = "'.$company['id'].'" and `company_rang` = "1" LIMIT 1');
$comdiv = $res_company->fetch_assoc();

$res1 = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$comdiv['user'].'" ');
$us = $res1->fetch_assoc();
$res2 = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$us['id'].'" ');
$traning = $res2->fetch_assoc();

if($us['side'] == 1){$side = 'federation';}else{$side = 'empire';}

if($us['viz'] > (time()-$sql['online'])){$viz = '';}else{$viz = '_off';}



if($company['level'] == 1){ $company_exp = 360;}
elseif($company['level'] == 2){ $company_exp = 600;}
elseif($company['level'] == 3){ $company_exp = 1400;}
elseif($company['level'] == 4){ $company_exp = 2500;}
elseif($company['level'] == 5){ $company_exp = 4000;}
elseif($company['level'] == 6){ $company_exp = 6000;}
elseif($company['level'] == 7){ $company_exp = 10000;}
elseif($company['level'] == 8){ $company_exp = 16000;}
elseif($company['level'] == 9){ $company_exp = 32000;}
elseif($company['level'] == 10){ $company_exp = 72000;}
elseif($company['level'] == 11){ $company_exp = 120000;}
elseif($company['level'] == 12){ $company_exp = 160000;}
elseif($company['level'] == 13){ $company_exp = 240000;}
elseif($company['level'] == 14){ $company_exp = 360000;}
elseif($company['level'] == 15){ $company_exp = 500000;}
elseif($company['level'] == 16){ $company_exp = 660000;}
elseif($company['level'] == 17){ $company_exp = 860000;}
elseif($company['level'] == 18){ $company_exp = 1000000;}
elseif($company['level'] == 19){ $company_exp = 1250000;}
elseif($company['level'] == 20){ $company_exp = 1750000;}
elseif($company['level'] == 21){ $company_exp = 2500000;}
elseif($company['level'] == 22){ $company_exp = 4000000;}
elseif($company['level'] == 23){ $company_exp = 6000000;}
elseif($company['level'] == 24){ $company_exp = 9000000;}
elseif($company['level'] == 25){ $company_exp = 13000000;}
elseif($company['level'] == 26){ $company_exp = 100000;}
elseif($company['level'] == 27){ $company_exp = 20000000;}
elseif($company['level'] == 28){ $company_exp = 30000000;}
elseif($company['level'] == 29){ $company_exp = 50000000;}
elseif($company['level'] == 30){ $company_exp = 80000000;}
elseif($company['level'] == 31){ $company_exp = 120000000;}
elseif($company['level'] == 32){ $company_exp = 170000000;}
elseif($company['level'] == 33){ $company_exp = 230000000;}
elseif($company['level'] == 34){ $company_exp = 300000000;}
elseif($company['level'] >= 35){ $company_exp = 100000000000000000000000000000000000000000000000000000000000000000000;}




$company_exp_prog = round(100/($company_exp/($company['exp']+1)));
if($company_exp_prog > 100) {$company_exp_prog = 100;}


echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="white cntr bold sh_b small">Не хочешь ждать,<br>вступай в случайную дивизию!</div>
</div></div></div></div></div></div></div></div></div></div>';

echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div>

<div class="small bold"><a href="/company/'.$company['id'].'/"><img height="14" width="14" src="/images/icons/victory.png"> <span class="green2">'.$company['name'].'</span></a>, 
<span class="white">комдив:</span> 
<a href="/profile/'.$us['id'].'/"><img class="" height="14" width="14" src="/images/side/'.$side.'/'.$traning['rang'].''.$viz.'.png?1"> <span class="yellow1">'.$us['login'].'</span></a></div>

<div class="mb5">
<div class="thumb fl"><img src="/images/avatar/clan/'.$company['avatar'].'.png" style="width:100%; border-radius: 9px;"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold">
Опыт: '.ceil($company['exp']).' из '.$company_exp.'<br>
Экипаж: '.$company['lvl_crew'].' из '.($c_c_u[0]*100).'<br>
</div>
<div class="clrb"></div>
</div>

<table class="rblock blue esmall mb5">
<tbody><tr>
<td><div class="value-block lh1"><span><span><img height="14" width="14" src="/images/icons/exp.png?2"> '.$company['level'].'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$company_exp_prog.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$company_exp_prog.'%</span></span></div></td>
</tr>
</tbody></table>
</div>
<div class="bot"><a class="simple-but border" href="?nocompany_"><span><span>Вступить в дивизию</span></span></a></div>

</div></div></div></div></div></div></div></div></div></div>';

$res = $mysqli->query('SELECT * FROM `company` WHERE `id` = '.$user['company_add'].' LIMIT 1 ');
$company = $res->fetch_assoc();


//echo ''.$company['id'].'';

if(isset($_GET['nocompany_'])){
if(!$company['id']){header('Location: ?');exit();}
if($company['side']!=$user['side']){header('Location: ?');exit();}
if($user['company']!=0){header('Location: ?');exit();}
if($c_c_u[0]>=$company_mesta){$_SESSION['err'] = 'В дивизии нет мест';header('Location: ?');exit();}


$res = mysqli_query($mysqli,'SELECT sum(rang) FROM crew_user WHERE `user`  = "'.$user['id'].'"');
if (FALSE === $res) die("Select sum failed: ".mysqli_error);
$row = mysqli_fetch_row($res);
$sum = $row[0];
$mysqli->query('UPDATE `company` SET `lvl_crew` = "'.($company['lvl_crew']+$sum).'" WHERE `id` = '.$company['id'].'');

/* $res_us_comp_ = $mysqli->query('SELECT * FROM `users` WHERE `company` = "'.$company['id'].'" LIMIT 1');
$us_comp_ = $res_us_comp_->fetch_assoc(); */

$mysqli->query('INSERT INTO `company_user` SET `company` = "'.$company['id'].'", `company_rang` = "6", `company_time` = "'.time().'", `user` = "'.$user['id'].'"  ');

$text = "<span class='green1'>принят в дивизию</span>";
$mysqli->query('INSERT INTO `company_log` SET `company` = "'.$company['id'].'", `text` = "'.$text.'", `time` = "'.time().'", `user` = "'.$user['id'].'" ');

$message = "<span class='white'>принят в дивизию</span>";
$mysqli->query('INSERT INTO `cchat` SET `company` = "'.$company['id'].'", `text` = "'.$message.'", `time` = "'.time().'", `user` = "'.$user['id'].'"');

$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user`  = "'.$user['id'].'" and `active`  = "1" limit 1');
$users_tanks = $res->fetch_assoc();
$mysqli->query('UPDATE `users_tanks` SET `a` = "'.($users_tanks['a']+$company['shtab_param']).'", `b` = "'.($users_tanks['b']+$company['shtab_param']).'", `t` = "'.($users_tanks['t']+$company['shtab_param']).'", `p` = "'.($users_tanks['p']+$company['shtab_param']).'" WHERE `id` = '.$users_tanks['id'].'');
if($company['polygon_time']>time() ){
$mysqli->query('UPDATE `users_tanks` SET `a` = "'.($users_tanks['a']+40).'", `b` = "'.($users_tanks['b']+40).'", `t` = "'.($users_tanks['t']+40).'", `p` = "'.($users_tanks['p']+40).'" WHERE `id` = '.$users_tanks['id'].'');
}
$mysqli->query('DELETE FROM `company_zayavki` WHERE `ank` = "'.$user['id'].'" ');
$mysqli->query('DELETE FROM `company_zayavki` WHERE `user` = "'.$user['id'].'" ');

$mysqli->query('UPDATE `users` SET `company` = "'.$company['id'].'" WHERE `id` = "'.$user['id'].'" LIMIT 1');
$mysqli->query('UPDATE `users` SET `company_add` = "'.$us['company_add'].'" WHERE `id` = "'.$user['id'].'" LIMIT 1');

$_SESSION['ses'] = '<div class="buy-place-block"><div class="feedbackPanelSUCCESS"><div class="line1"><span class="feedbackPanelSUCCESS">Вы вступили в дивизию!</span></div></div></div>';header('Location: ?');
header('Location: ?');
exit();
}

























echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="white cntr bold sh_b small pb10">Золото, потраченное на создание дивизии, будет переведено на счет дивизии</div>
<div class="bot"><a class="simple-but border gray" href="/new_company/"><span><span>Создать дивизию</span></span></a></div>
</div></div></div></div></div></div></div></div></div></div>
</div>';



if(isset($_GET['nocompany'])){
if(!$company_zayavki){
$mysqli->query('INSERT INTO `company_zayavki` SET `user` = '.$user['id'].', `time` = "'.(time()+3600).'" ');
}else{
if($company_zayavki['time']<time()){
$mysqli->query('UPDATE `company_zayavki` SET `time` = '.(time()+(3600)).' WHERE `id` = '.$company_zayavki['id'].'');
}
}
header('Location: ?');
exit();
}












require_once ('../system/footer.php');
?>