<?php
$title = 'Спецзадание';
require_once ('../../system/function.php');
require_once ('../../system/header.php');
if(!$user['id']) {header('Location: /');exit();}
if($user['company']<=0) {header('Location: /');exit();}
//echo 'Ошибка запроса: ' . mysqli_error($mysqli) . '<br>';
/* 
$rc_u_a = $mysqli->query('SELECT * FROM `company_user_assault` WHERE `user` = '.$user['id'].' order by `time` desc LIMIT 1');
$c_u_a = $rc_u_a->fetch_assoc();

echo ''.$c_u_a['id'].'';
 */

$rc_u_a = $mysqli->query('SELECT * FROM `company_user_assault` WHERE `user` = '.$user['id'].' LIMIT 1');
$c_u_a = $rc_u_a->fetch_assoc();
if(!$c_u_a){
$mysqli->query('INSERT INTO `company_user_assault` SET `user` = "'.$user['id'].'" ');
}

$rc_b_a = $mysqli->query('SELECT * FROM `company_battle_assault` WHERE `id` = '.$c_u_a['id_battle'].' LIMIT 1');
$c_b_a = $rc_b_a->fetch_assoc();


if($c_u_a['id_battle']!=0 and $c_b_a) {header('Location: /company/battle/');exit();}






echo '<div class="medium white bold cntr mb2">Спецзадание</div>';


if($c_u_a['1_coll']<=0){
$limit = 1;
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">';
echo '<div class="small white cntr sh_b bold mb2"><img src="/images/icons/victory.png"> Уничтожьте блиндаж <img src="/images/icons/victory.png"><br>
Особая награда - <span class="nwr"><img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> 25 золота</span></div>';
echo '</div></div></div></div></div></div></div></div></div></div>';
}elseif($c_u_a['1_coll']>0 and $c_u_a['2_coll']<=0){
$limit = 2;
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">';
echo '<div class="small white cntr sh_b bold mb2"><img src="/images/icons/victory.png"> Уничтожьте блокпост <img src="/images/icons/victory.png"><br>
Особая награда - <span class="nwr"><img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> 50 золота</span></div>';
echo '</div></div></div></div></div></div></div></div></div></div>';
}elseif($c_u_a['2_coll']>0 and $c_u_a['3_coll']<=0){
$limit = 3;
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">';
echo '<div class="small white cntr sh_b bold mb2"><img src="/images/icons/victory.png"> Уничтожьте дот <img src="/images/icons/victory.png"><br>
Особая награда - <span class="nwr"><img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> 100 золота</span></div>';
echo '</div></div></div></div></div></div></div></div></div></div>';
}elseif($c_u_a['3_coll']>0 and $c_u_a['4_coll']<=0){
$limit = 4;
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">';
echo '<div class="small white cntr sh_b bold mb2"><img src="/images/icons/victory.png"> Уничтожьте бункер <img src="/images/icons/victory.png"><br>
Особая награда - <span class="nwr"><img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> 125 золота</span></div>';
echo '</div></div></div></div></div></div></div></div></div></div>';
}elseif($c_u_a['4_coll']>0 and $c_u_a['5_coll']<=0){
$limit = 5;
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">';
echo '<div class="small white cntr sh_b bold mb2"><img src="/images/icons/victory.png"> Уничтожьте военную базу <img src="/images/icons/victory.png"><br>
Особая награда - <span class="nwr"><img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> 250 золота</span></div>';
echo '</div></div></div></div></div></div></div></div></div></div>';
}elseif($c_u_a['5_coll']>0 and $c_u_a['6_coll']<=0){
$limit = 6;
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">';
echo '<div class="small white cntr sh_b bold mb2"><img src="/images/icons/victory.png"> Уничтожьте крепость <img src="/images/icons/victory.png"><br>
Особая награда - <span class="nwr"><img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> 500 золота</span></div>';
echo '</div></div></div></div></div></div></div></div></div></div>';
}













/* Награда:
За уничтожение блиндажа -  4 золота;
блокпоста - 6 золота;
дота - 9 золота;
бункера - 10 золота;
Военной базы - 12
крепости - 13 золота.

Бонусная награда: половина танкистов (округление в меньшую сторону) с самым большим уроном получат +50% к золоту.

+1 золото, тому кто уничтожил цель.

За прохождение цели в первый раз награда: блиндаж - 25 золота;
блокпост - 50 золота;
дот - 100 золота;
бункер - 125 золота;
военная база - 250 золота;
крепость -  400 золота.
P.S.Если у вас не открыта цель, то пройдите предыдущий вид спецзадания. */



//$mysqli->query('INSERT INTO `assault` SET `p` = "1" ');



//$assault = $mysqli->query('SELECT * FROM `assault` WHERE `id` ORDER BY `id` desc LIMIT '.((5+$limit)-$limit).','.$limit.'');
$assault = $mysqli->query('SELECT * FROM `assault` WHERE `id` ORDER BY `id` asc LIMIT '.$limit.'');
while ($ass = $assault->fetch_array()){
$c_b_a_ = $mysqli->query('SELECT * FROM `company_battle_assault` WHERE `id_assault` = "'.$ass['id'].'" and `company` = "'.$user['company'].'" and `time` = "0" LIMIT 1');
$c_b_a = $c_b_a_->fetch_assoc();
if($c_b_a){
$col_u_ = $mysqli->query("SELECT COUNT(*) FROM `company_battle_user_assault` WHERE `id_battle` = ".$c_b_a['id']." ");
$col_u = $col_u_->fetch_array(MYSQLI_NUM);/* '.$c_u_a[''.$ass['id'].'_coll'].' */
}else{
$col_u[0]=0;
}
echo '<div class="trnt-block mb15"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="small white cntr sh_b bold mb2">'.$ass['name'].' - '.$col_u[0].'</div>
<div class="cntr"><img width="160" height="100" src="/images/assault/'.$ass['id'].'.png"></div>
<div class="small white cntr sh_b bold mb2"></div>';

if($c_b_a){
$c_u_ = $mysqli->query('SELECT * FROM `company_battle_user_assault` LEFT JOIN `company_user` USING (user) WHERE `company_battle_user_assault`.`id_battle` = "'.$c_b_a['id'].'" ORDER BY `company_user`.`company_rang` asc, `company_user`.`company_exp` desc LIMIT 1');
while ($c_u = $c_u_->fetch_array()){
if($c_u['user']){
echo '<div class="small white cntr sh_b bold mb2"><span class="green1">Идет сбор</span><br>Старший: '.nick($c_u['user']).'</div>';
}
}
}

if($c_u_a['time_restart']>time()){
echo '<div class="bot"><a class="simple-but gray border " href="?assault'.$ass['id'].'"><span><span>Войти</span></span></a></div>';
}else{
echo '<div class="bot"><a class="simple-but border" href="?assault'.$ass['id'].'"><span><span>Войти</span></span></a></div>';
}

echo '<div class="clrb"></div>
</div></div></div></div></div></div></div></div></div></div>';


if(isset($_GET['assault'.$ass['id'].''])){
$res_users_tanks = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = '.$user['id'].' and `active`  = "1" LIMIT 1');
$users_tanks = $res_users_tanks->fetch_assoc();
if($c_u_a['time_restart']>time()){header('Location: ?');exit();}
if($col_u[0]>=10){header('Location: ?');exit();}
$c_b_u_a_ = $mysqli->query('SELECT * FROM `company_battle_user_assault` WHERE `user` = "'.$user['id'].'" LIMIT 1');
$c_b_u_a = $c_b_u_a_->fetch_assoc();
if($c_b_u_a){header('Location: ?');exit();}
if(($ass['id']==2 and $c_u_a['1_coll']<=0) or ($ass['id']==3 and $c_u_a['2_coll']<=0) or ($ass['id']==4 and $c_u_a['3_coll']<=0) or ($ass['id']==5 and $c_u_a['4_coll']<=0) or ($ass['id']==6 and $c_u_a['5_coll']<=0)){header('Location: ?');exit();}


$resb_s = $mysqli->query('SELECT * FROM `boevaya_sila` WHERE `user` = "'.$user['id'].'" and `local` = "4" limit 1');
$b_s = $resb_s->fetch_assoc();
if($b_s['tip']==1){$param = 50;}elseif($b_s['tip']==2){$param = 100;}elseif($b_s['tip']==3){$param = 150;}
if($b_s['bon_col'] >0 ){
$users_tanks['a'] = ($users_tanks['a']+$param);$users_tanks['b'] = ($users_tanks['b']+$param);$users_tanks['t'] = ($users_tanks['t']+$param);$users_tanks['p'] = ($users_tanks['p']+$param);
}else{
$users_tanks['a'] = $users_tanks['a'];$users_tanks['b'] = $users_tanks['b'];$users_tanks['t'] = $users_tanks['t'];$users_tanks['p'] = $users_tanks['p'];
}


if(!$c_b_a){
$images = rand(1,24);
$projectile = rand(1,3);
$mysqli->query('INSERT INTO `company_battle_assault` SET `images` = "'.$images.'", `projectile` = "'.$projectile.'", `id_assault` = "'.$ass['id'].'", `company` = "'.$user['company'].'", `p` = "'.$ass['p'].'" ');
$uid = mysqli_insert_id($mysqli);
$mysqli->query('INSERT INTO `company_battle_user_assault` SET `time_attack_assault` = "'.(time()+17).'", `id_battle` = "'.$uid.'", `user` = "'.$user['id'].'", `a` = "'.($users_tanks['a']).'", `b` = "'.($users_tanks['b']).'", `t` = "'.($users_tanks['t']).'", `p` = "'.($users_tanks['p']*2).'", `p_` = "'.($users_tanks['p']*2).'" ');
$mysqli->query("UPDATE `company_user_assault` SET `time_restart` = '1', `id_battle_end` = '".$uid."', `id_battle` = '".$uid."' WHERE `user` = '".$user['id']."' LIMIT 1");
}else{
$mysqli->query('INSERT INTO `company_battle_user_assault` SET `time_attack_assault` = "'.(time()+17).'", `id_battle` = "'.$c_b_a['id'].'", `user` = "'.$user['id'].'", `a` = "'.($users_tanks['a']).'", `b` = "'.($users_tanks['b']).'", `t` = "'.($users_tanks['t']).'", `p` = "'.($users_tanks['p']*2).'", `p_` = "'.($users_tanks['p']*2).'" ');
$mysqli->query("UPDATE `company_user_assault` SET `time_restart` = '1', `id_battle_end` = '".$c_b_a['id']."', `id_battle` = '".$c_b_a['id']."' WHERE `user` = '".$user['id']."' LIMIT 1");
}

$_SESSION['ses'] = '<span class="feedbackPanelSUCCESS"><font size=2%><b>Цель выбрана!</b></font></span>';
header('Location: /company/battle/');
exit();
}




}

















echo '<div class="pt5"><a w:id="past" class="simple-but gray" href="/company/pastassaults/"><span><span>Прошедшие спецзадания</span></span></a></div>';




$arr_text = array(
1 => "За уничтожение объекта все получают золото",
2 => "Старший взвода - это игрок с самым высоким званием и дивизионным опытом"); 
$rand_text = rand(1,2);
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">'.$arr_text[$rand_text].'</div>
</div></div></div></div></div></div></div></div></div></div>';

require_once ('../../system/footer.php');
?>