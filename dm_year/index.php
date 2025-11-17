<?php
$title = 'Игра в снежки';
//-----Подключаем функции-----//
require_once ('../system/function.php');
//-----Подключаем вверх-----//
require_once ('../system/header.php');
//-----Если гость,то...----//
/* ?>
<meta http-equiv="Refresh" content="1" />
<? */
if(!$user['id']) {
header('Location: /');
exit();
}
if($prom['time_19']<time()){
header('Location: /');
exit();
}
####################################################################################################################
$res = $mysqli->query('SELECT * FROM `dm_year` WHERE `time_dm_year` != "0" LIMIT 1');
$p1 = $res->fetch_assoc();
if($p1){
$res = $mysqli->query('SELECT * FROM `dm_year` WHERE `id` ORDER BY `time_dm_year` desc LIMIT 1');
$p = $res->fetch_assoc();
}else{
$res = $mysqli->query('SELECT * FROM `dm_year` WHERE `id` ORDER BY `time` asc LIMIT 1');
$p = $res->fetch_assoc();
}
$res1 = $mysqli->query('SELECT * FROM `settings` WHERE `id` = "1" LIMIT 1');
$sql = $res1->fetch_assoc();
$res = $mysqli->query('SELECT * FROM `dm_year` WHERE `time_end` != "0" ORDER BY `time_end` desc LIMIT 1');
$p_end = $res->fetch_assoc();
$resb_s = $mysqli->query('SELECT * FROM `boevaya_sila` WHERE `user` = "'.$user['id'].'" and `local` = "5" limit 1');
$b_s = $resb_s->fetch_assoc();
####################################################################################################################



####################################################################################################################
if($p and $p['time']<=(time()+1) and $p['time_dm_year']==0){ // старт сражи
$mysqli->query('UPDATE `dm_year` SET `time_dm_year` = "'.(time()+310).'" WHERE `id` = "'.$p['id'].'" LIMIT 1');
}
if($p['time_dm_year']>=time() && $p['time_dm_year']<=(time()+310) and $p['time_dm_year']>=(time()+300)){
echo '<div class="buy-place-block"><div class="feedbackPanelINFO"><div class="line1"><span class="feedbackPanelINFO">До начала боя: '.tls($p['time_dm_year']-(time()+300)).' секунд</span></div></div></div>';
}
####################################################################################################################



####################################################################################################################
if($p['time_dm_year']>=time() && $p['time_dm_year']<=(time()+310) and $p['time_dm_year']>=(time()+300) or $p1){
//if(($p['time_dm_year']>=time() && $p['time_dm_year']<=(time()+300)) or ($p['time_dm_year']>=time() && $p['time_dm_year']<=(time()+time()))){ // бой начинается, распределяем врагов кому еще не распределило
//if($p['time_dm_year']>=time() && $p['time_dm_year']<=(time()+300)){ // бой начинается, распределяем врагов кому еще не распределило
$pvp_us = $mysqli->query('SELECT * FROM `dm_year_user` WHERE `dm_year_id` = "'.$p['dm_year_id'].'" ORDER BY `id` desc');
while ($pvu = $pvp_us->fetch_array()){

if($pvu['goal']==0){
### подбор противника
$stmt_g = $mysqli->prepare('SELECT t.id FROM dm_year_user as t,
            (SELECT ROUND((SELECT MAX(id) FROM dm_year_user) * rand()) as rnd FROM dm_year_user) tmp
            WHERE t.id >= (rnd) and `nick` != ? and `dm_year_id` = ? and `p_` > ? 
			ORDER BY camouflage asc 
			LIMIT 1');
$stmt_g->bind_param("sss", $nick,$dm_year_id,$hp);
$nick = $pvu['nick'];$dm_year_id = $p['dm_year_id'];$hp = 0;$stmt_g->execute();$res = $stmt_g->get_result();$goal = $res->fetch_assoc(); 
### UPDATE
$stmt = $mysqli->prepare ("UPDATE `dm_year_user` SET `goal` =  ? WHERE `id` = ? LIMIT 1");
$stmt->bind_param("ss", $goal, $id);$goal = $goal['id'];$id = $pvu['id'];$stmt->execute();
//echo ' '.$goal['id'].'<hr>';
}
if($pvu['bot']==1){
$mysqli->query('UPDATE `dm_year_user` SET `time_attack` = "'.rand(5,10).'" WHERE `id` = '.$pvu['id'].' ');
}
}
header('Location: /dm_year/battle/');
exit();
}
####################################################################################################################



####################################################################################################################
for ($i = 1; $i<4; $i++){ // обновление сраж
$res = $mysqli->query('SELECT * FROM `dm_year` WHERE `dm_year_id` = '.$i.' ');
$p_ = $res->fetch_assoc();
if($i==1){$nameBattle = '<font size=4% color=#00ccff>&#10052;</font> Игра в снежки';$tipBattle = 1;$date =  strtotime('09:40');}//11:00
if($i==2){$nameBattle = '<font size=4% color=#00ccff>&#10052;</font> Игра в снежки';$tipBattle = 2;$date =  strtotime('17:00');}//17:00
if($i==3){$nameBattle = '<font size=4% color=#00ccff>&#10052;</font> Игра в снежки';$tipBattle = 1;$date =  strtotime('22:00');}//22:00
if($date<=time()){$dateStart = ($date+86400);}else{$dateStart = ($date);}
if(!$p_){
$mysqli->query('INSERT INTO `dm_year` SET `time` = '.$dateStart.' , `dm_year_id` = '.$i.' , `tip` = '.$tipBattle.' , `name` = "'.$nameBattle.'" ');
}elseif($p_ and $p_['time']!=$dateStart){
$mysqli->query('UPDATE `dm_year` SET `time` = "'.$dateStart.'" WHERE `id` = '.$i.' LIMIT 1');
}elseif($p_ and $p_['tip']!=$tipBattle){
$mysqli->query('UPDATE `dm_year` SET `tip` = "'.$tipBattle.'" WHERE `id` = '.$i.' LIMIT 1');
}elseif($p_ and $p_['name']!=$nameBattle){
$mysqli->query('UPDATE `dm_year` SET `name` = "'.$nameBattle.'" WHERE `id` = '.$i.' LIMIT 1');
}elseif($p_ and $p_['dm_year_id']!=$i){
$mysqli->query('UPDATE `dm_year` SET `dm_year_id` = "'.$i.'" WHERE `id` = '.$i.' LIMIT 1');
}
}
####################################################################################################################



####################################################################################################################
if($p and $p['time_bot']<=time() and $p['time_dm_year']< time()){ // генерируем ботов на сражу 
# выборка юзера
$stmt = $mysqli->prepare('SELECT t.id, login FROM users as t,
            (SELECT ROUND((SELECT MAX(id) FROM users) * rand()) as rnd FROM users) tmp
            WHERE t.id >= (rnd) and `level` >= ? and `viz` <= ? and `id` not in (select user from dm_year_user)
			LIMIT 1');
$stmt->bind_param("ss", $level, $viz);
$level = 3;$viz = (time()-(86400*2));$stmt->execute();$res = $stmt->get_result();$rnd_us = $res->fetch_assoc();
# выборка противника юзеру
$stmt_g = $mysqli->prepare('SELECT t.id FROM dm_year_user as t,
            (SELECT ROUND((SELECT MAX(id) FROM dm_year_user) * rand()) as rnd FROM dm_year_user) tmp
            WHERE t.id >= (rnd) and `nick` != ? and `dm_year_id` = ? and `p_` > ? 
			ORDER BY camouflage asc 
			LIMIT 1');
$stmt_g->bind_param("sss", $nick, $dm_year_id, $hp);
$nick = $rnd_us['login'];$dm_year_id = $p['dm_year_id'];$hp = 0;$stmt_g->execute();$res = $stmt_g->get_result();$goal = $res->fetch_assoc(); 
if($rnd_us){
$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = '.$rnd_us['id'].' and `active`  = "1" LIMIT 1');
$u_t = $res->fetch_assoc();
$res = $mysqli->query('SELECT * FROM `tanks` WHERE `id`  = "'.$u_t['tip'].'" LIMIT 1');
$tank = $res->fetch_assoc();
$res_s1 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "1" and `user`  = "'.$rnd_us['id'].'" ');
$skills_1 = $res_s1->fetch_assoc();if(!$skills_1){$skills_1['bon'] = 0;} // маскировка
$res_s2 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "2" and `user`  = "'.$rnd_us['id'].'" ');
$skills_2 = $res_s2->fetch_assoc();if(!$skills_2){$skills_2['bon'] = 0;} // рикошет
$res_s3 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "3" and `user`  = "'.$rnd_us['id'].'" ');
$skills_3 = $res_s3->fetch_assoc();if(!$skills_3){$skills_3['bon'] = 0;} // Слабые места
$res_s4 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "4" and `user`  = "'.$rnd_us['id'].'" ');
$skills_4 = $res_s4->fetch_assoc();if(!$skills_4){$skills_4['bon'] = 0;} // Ремонт
$res_s5 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "5" and `user`  = "'.$rnd_us['id'].'" ');
$skills_5 = $res_s5->fetch_assoc();if(!$skills_5){$skills_5['bon'] = 0;} // Снайпер
if(!$goal['id']){$goal['id'] = 0;}
$mysqli->query('INSERT INTO `dm_year_user` SET `camouflage` = "'.($skills_1['bon']+0.1).'", `ricochet` = "'.$skills_2['bon'].'", 
`weaknessdetection` = "'.$skills_3['bon'].'", `repairs` = "'.$skills_4['bon'].'", `sniper` = "'.$skills_5['bon'].'", 
`nick` = "'.$rnd_us['login'].'", `goal` = '.$goal['id'].', `tank_id` = '.$tank['id'].', 
`a` = '.($u_t['a']).', `b` = '.($u_t['b']).', `t` = '.($u_t['t']).', `p` = '.($u_t['p']*2).', `p_` = '.($u_t['p']*2).', 
`bot` = "1", `dm_year_id` = '.$p['dm_year_id'].', `user` = '.$rnd_us['id'].' ');
$mysqli->query('INSERT INTO `dm_year_results` SET `user` = "'.$rnd_us['id'].'", `nick` = "'.$rnd_us['login'].'", `dm_year_id` = "'.$p['dm_year_id'].'", `time` = "'.time().'" ');
$mysqli->query('UPDATE `dm_year` SET `time_bot` = "'.(time()+rand(30,300)).'" WHERE `id` = "'.$p['id'].'" LIMIT 1');
}
}
####################################################################################################################

















####################################################################################################################
if($p_end['time_end']>=(time()-30)){ // вывод итогов
echo '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/battles/dm_year/dm_year'.$p_end['dm_year_id'].'.jpg" style="width:100%; border-radius: 9px;"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">'.$p_end['name'].'</span><br><span><span>закончилась '.time_last($p_end['time_end']).'</span></span><br><span class="gray1">'.$tipB.'</span></div>
<div class="clrb"></div></div>
<div class="small bold cntr gray1 sh_b mt2"><div class="white">';

if($p_end['pobeda']==1){echo '<span class="green1">Кончилось время</span><br>';}
if($p_end['pobeda']==2){echo '<span class="green1">Выжили лучшие</span><br>';}

$res = $mysqli->query('SELECT * FROM `dm_year_results` WHERE `user` = "'.$user['id'].'" and `dm_year_id` = "'.$p_end['dm_year_id'].'" LIMIT 1');
$res_us = $res->fetch_assoc();
if($res_us['id']){
echo '<br><span class="green2">Мои достижения:</span><br><span class="yellow1">Награда</span>: <br><span>
<span class="nwr"><img class="ico vm" src="/images/icons/exp.png" alt="опыт" title="опыт"> '.$res_us['exp'].' опыта </span> 
<span class="nwr"><img class="ico vm" src="/images/icons/silver.png?2" alt="Серебро" title="Серебро"> '.$res_us['silver'].' серебра </span>';
if($res_us['crewpoints']>0){echo '<span class="nwr"><img class="ico vm" src="/images/icons/crewpoints.png" alt="Опыт экипажа" title="Опыт экипажа"> '.$res_us['crewpoints'].' очков экипажа</span>';}
if($res_us['fuel']>0){echo '<span class="nwr"><img title="Топливо" alt="Топливо" src="/images/icons/fuel.png"> '.$res_us['fuel'].' топлива </span>';}
if($res_us['gold']>0){echo '<span class="nwr"><img title="Золото" alt="Золото" src="/images/icons/gold.png"> '.$res_us['gold'].' золота </span>';}
if($res_us['number_kill']>0){$number_kill = '('.$res_us['number_kill'].' место)';}
if($res_us['number_uron']>0){$number_uron = '('.$res_us['number_uron'].' место)';}
echo '</span><br><span class="yellow1">Подбито танков</span>: '.$res_us['kill'].' '.$number_kill.'<br>
<span class="yellow1">Нанесено урона</span>: '.$res_us['uron'].' '.$number_uron.'<br>';
}

echo '<br><span class="green2">Лучшие (урон и убийства)</span><br>';
$res = $mysqli->query('SELECT * FROM `dm_year_results` WHERE `dm_year_id` = "'.$p_end['dm_year_id'].'" and `uron` > "0" ORDER BY `uron` DESC LIMIT 3');
while ($top_uron = $res->fetch_array()){
$res1 = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$top_uron['user'].'" ');
$us = $res1->fetch_assoc();
$res2 = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$us['id'].'" ');
$traning = $res2->fetch_assoc();
if($us['side'] == 1){$side = 'federation';}else{$side = 'empire';}
if($us['viz'] > (time()-$sql['online'])){$viz = '';}else{$viz = '_off';}
echo '<img class="vb" height="14" width="14" src="/images/side/'.$side.'/'.$traning['rang'].''.$viz.'.png?1"> <span class="yellow1">'.$top_uron['nick'].'</span>: '.$top_uron['uron'].' + '.$top_uron['kill'].' <br>';
}

echo '</div><br>Сражались: <span class="green1">'.$p_end['where_user'].'</span> | Выжили: <span class="red1">'.$p_end['survived_user'].'</span><br>
</div></div></div></div></div></div></div></div></div></div></div>';
####################################################################################################################
}else{
####################################################################################################################
//if(!$p1){
if($p['time']<(time()+(300))){$_SESSION['dm_year']=777;}else{$_SESSION['dm_year']=0;}
if($p['time_dm_year']!=0 and (time()-$p['time_dm_year']>(300))){$mysqli->query('UPDATE `dm_year` SET `time_dm_year` = "0" WHERE `id` = '.$p['id'].' ');}
$res = $mysqli->query('SELECT * FROM `dm_year_user` WHERE `user` = '.$user['id'].' and `dm_year_id` = '.$p['dm_year_id'].' ');
$p_u = $res->fetch_assoc();
$col_u_ = $mysqli->query("SELECT COUNT(*) FROM `dm_year_user` WHERE `dm_year_id` = ".$p['dm_year_id']." ");
$col_us = $col_u_->fetch_array(MYSQLI_NUM);
echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">';
echo '<div class="white medium cntr bold mb2"><span class="green1">'.$p['name'].'</span>';
echo '<span class="small"><div class="small white sh_b bold">';
if($p1){
if($p1['time_dm_year']>=time() && $p1['time_dm_year']>=(time()+301)){
echo '<span><span>до начала боя '.tls($p1['time_dm_year']-(time()+300)).' секунд ('.$col_us[0].' заявок)</span></span>';
}
if($p1['time_dm_year']>=time() && $p1['time_dm_year']<=(time()+300)){
if((300-($p1['time_dm_year']-time()))  >= 60  ){
$m = floor((300-($p1['time_dm_year']-time()))/60);
$s = (floor((300-($p1['time_dm_year']-time())))-(floor((300-($p1['time_dm_year']-time()))/60)*60));
if((floor((300-($p1['time_dm_year']-time())))-(floor((300-($p1['time_dm_year']-time()))/60)*60))<10){$ss = 0;}
$time = '0'.$m.':'.$ss.''.(floor((300-($p1['time_dm_year']-time())))-(floor((300-($p1['time_dm_year']-time()))/60)*60)).'';
}else{
$s = (floor((300-($p1['time_dm_year']-time())))-(floor((300-($p1['time_dm_year']-time()))/60)*60));
if((floor((300-($p1['time_dm_year']-time())))-(floor((300-($p1['time_dm_year']-time()))/60)*60))<10){$ss = 0;}
$time = '00:'.$ss.''.(floor((300-($p1['time_dm_year']-time())))-(floor((300-($p1['time_dm_year']-time()))/60)*60)).'';
}
echo '<span><span>Идёт уже '.$time.' </span></span>';
}
}else{
echo '<span><span>до начала '._time1($p['time']-time()).' ('.$col_us[0].' заявок)</span></span>';
}
echo '<br></div><div class="clrb"></div></div>';
echo '</span><img width="100%" src="/images/war2'.$p['id'].'.png">';
if(!$p_u and $p['time_dm_year']==0){
echo '<div class="bot"><a class="simple-but border" href="?start"><span><span>Каждый сам за себя!</span></span></a><div style="position:relative;"><span class="digit2 esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span></div></div>';
}elseif($p_u['id']){
echo '<div class="white medium cntr bold mt5">Вы в рядах участников</div>';
}elseif($p['time_dm_year']!=0 and !$p_u){
echo '<div class="white medium cntr bold mt5">Вы не успели на это сражение</div>';
}
echo '</div></div></div></div></div></div></div></div></div></div>';
}
//}
echo '<a w:id="refresh" href="/dm_year/" class="simple-but gray"><span><span>Обновить</span></span></a>';
####################################################################################################################








####################################################################################################################
if(isset($_GET['start'])){
if($p_u){header('Location: ?');exit();}if($p['time_dm_year']!=0){header('Location: ?');exit();}
$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = '.$user['id'].' and `active`  = "1" LIMIT 1');
$u_t = $res->fetch_assoc();
if($b_s['tip']==1){$param = 50;}elseif($b_s['tip']==2){$param = 100;}elseif($b_s['tip']==3){$param = 150;}
if($b_s['bon_col'] >0){
$u_t['a'] = ($u_t['a']+$param);$u_t['b'] = ($u_t['b']+$param);$u_t['t'] = ($u_t['t']+$param);$u_t['p'] = ($u_t['p']+$param);
}else{
$u_t['a'] = $u_t['a'];$u_t['b'] = $u_t['b'];$u_t['t'] = $u_t['t'];$u_t['p'] = $u_t['p'];
}
$res = $mysqli->query('SELECT * FROM `tanks` WHERE `id`  = "'.$u_t['tip'].'" LIMIT 1');
$tank = $res->fetch_assoc();
$res_s1 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "1" and `user`  = "'.$user['id'].'" ');
$skills_1 = $res_s1->fetch_assoc(); // маскировка
$res_s2 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "2" and `user`  = "'.$user['id'].'" ');
$skills_2 = $res_s2->fetch_assoc(); // рикошет
$res_s3 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "3" and `user`  = "'.$user['id'].'" ');
$skills_3 = $res_s3->fetch_assoc(); // Слабые места
$res_s4 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "4" and `user`  = "'.$user['id'].'" ');
$skills_4 = $res_s4->fetch_assoc(); // Ремонт
$res_s5 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "5" and `user`  = "'.$user['id'].'" ');
$skills_5 = $res_s5->fetch_assoc(); // Снайпер
# выборка противника юзеру
$stmt_g = $mysqli->prepare('SELECT t.id FROM dm_year_user as t,
            (SELECT ROUND((SELECT MAX(id) FROM dm_year_user) * rand()) as rnd FROM dm_year_user) tmp
            WHERE t.id >= (rnd) and `nick` != ? and `dm_year_id` = ? and `p_` > ? 
			ORDER BY camouflage asc 
			LIMIT 1');
$stmt_g->bind_param("sss", $nick, $dm_year_id, $hp);
$nick = $user['login'];$dm_year_id = $p['dm_year_id'];$hp = 0;$stmt_g->execute();$res = $stmt_g->get_result();$goal = $res->fetch_assoc();
if(!$goal['id']){$goal['id'] = 0;} 
$mysqli->query('INSERT INTO `dm_year_user` SET `camouflage` = "'.($skills_1['bon']+0.1).'", `ricochet` = "'.$skills_2['bon'].'", 
`weaknessdetection` = "'.$skills_3['bon'].'", `repairs` = "'.$skills_4['bon'].'", `sniper` = "'.$skills_5['bon'].'", 
`nick` = "'.$user['login'].'", `goal` = '.$goal['id'].', `tank_id` = '.$tank['id'].', 
`a` = '.($u_t['a']).', `b` = '.($u_t['b']).', `t` = '.($u_t['t']).', `p` = '.($u_t['p']*2).', `p_` = '.($u_t['p']*2).', 
`dm_year_id` = '.$p['dm_year_id'].', `user` = '.$user['id'].' ');
$mysqli->query('INSERT INTO `dm_year_results` SET `exp` = "10", `silver` = "10", `user` = "'.$user['id'].'", `nick` = "'.$user['login'].'", `dm_year_id` = "'.$p['dm_year_id'].'", `time` = "'.time().'" ');
$_SESSION['err'] = '<div class="buy-place-block"><div class="feedbackPanelINFO"><div class="line1"><span class="feedbackPanelINFO">Вы зарегистрированы. Готовьтесь к бою.</span></div></div></div>';
header('Location: ?');
exit();
}
####################################################################################################################







####################################################################################################################
echo '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">';
if($b_s['bon_col']<=0){
echo '<div class="medium cntr pb5 white"><span class="bold">Боевая сила: не активна</span><br>Активировать бонус к параметрам</div>
<table class="ta_c"><tbody><tr>
<td class="w33"><a class="simple-but border mb5" href="?bs1"><span><span>+50</span></span></a><img class="ico vm" src="/images/icons/glory.png?2" alt="Слава" title="Слава"> 100</td>
<td class="w33"><a class="simple-but border mb5" href="?bs2"><span><span>+100</span></span></a><img class="ico vm" src="/images/icons/glory.png?2" alt="Слава" title="Слава"> 200</td>
<td class="w33"><a class="simple-but border mb5" href="?bs3"><span><span>+150</span></span></a><img class="ico vm" src="/images/icons/glory.png?2" alt="Слава" title="Слава"> 500</td>
</tr></tbody></table>';
}else{
if($b_s['tip']==1){$param = 50;}elseif($b_s['tip']==2){$param = 100;}elseif($b_s['tip']==3){$param = 150;}
echo '<div class="small cntr pb2 white">Боевая сила: '.$b_s['tip'].' уровень
<div><span class="green1">+'.$param.'</span> к параметрам в следующей битве</div>
<div>Действие: '.$b_s['bon_col'].' битв(ы)</div></div>';
}
echo '</div></div></div></div></div></div></div></div></div></div>'; 
####################################################################################################################
if(isset($_GET['bs1'])){
$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user`  = "'.$user['id'].'" LIMIT 1');
$a_users = $res->fetch_assoc();
if($b_s['bon_col']>0){header('Location: ?');exit();}
if($a_users['glory']<100){$_SESSION['err'] = '<div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/glory.png" alt="Слава" title="Слава"> '.(100-$a_users['glory']).' славы</div>';header('Location: ?');exit();}
if(!$b_s){
$mysqli->query('INSERT INTO `boevaya_sila` SET `user` = '.$user['id'].', `local` = "5", `bon_col` = "1", `tip` = "1" ');
}else{
$mysqli->query("UPDATE `boevaya_sila` SET `local` = '5', `bon_col` = '1', `tip` = '1' WHERE `id` = '".$b_s['id']."' LIMIT 1");
}
if($p_u['id']){
$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = '.$user['id'].' and `active`  = "1" LIMIT 1');
$u_t = $res->fetch_assoc();
if($b_s['tip']==1){$param = 50;}elseif($b_s['tip']==2){$param = 100;}elseif($b_s['tip']==3){$param = 150;}
$u_t['a'] = ($u_t['a']+$param);$u_t['b'] = ($u_t['b']+$param);$u_t['t'] = ($u_t['t']+$param);$u_t['p'] = ($u_t['p']+$param);
$mysqli->query('UPDATE `dm_year_user` SET `a` = '.($u_t['a']).', `b` = '.($u_t['b']).', `t` = '.($u_t['t']).', `p` = '.($u_t['p']*2).', `p_` = '.($u_t['p']*2).' WHERE `id` = '.$p_u['id'].' LIMIT 1');
$mysqli->query("UPDATE `ammunition_users` SET `glory` = '".($a_users['glory']-100)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
}
header('Location: ?');
exit();
}
####################################################################################################################

####################################################################################################################
if(isset($_GET['bs2'])){
$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user`  = "'.$user['id'].'" LIMIT 1');
$a_users = $res->fetch_assoc();
if($b_s['bon_col']>0){header('Location: ?');exit();}
if($a_users['glory']<200){$_SESSION['err'] = '<div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/glory.png" alt="Слава" title="Слава"> '.(200-$a_users['glory']).' славы</div>';header('Location: ?');exit();}
if(!$b_s){
$mysqli->query('INSERT INTO `boevaya_sila` SET `user` = '.$user['id'].', `local` = "5", `bon_col` = "1", `tip` = "2" ');
}else{
$mysqli->query("UPDATE `boevaya_sila` SET `local` = '5', `bon_col` = '1', `tip` = '2' WHERE `id` = '".$b_s['id']."' LIMIT 1");
}
if($p_u['id']){
$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = '.$user['id'].' and `active`  = "1" LIMIT 1');
$u_t = $res->fetch_assoc();
if($b_s['tip']==1){$param = 50;}elseif($b_s['tip']==2){$param = 100;}elseif($b_s['tip']==3){$param = 150;}
$u_t['a'] = ($u_t['a']+$param);$u_t['b'] = ($u_t['b']+$param);$u_t['t'] = ($u_t['t']+$param);$u_t['p'] = ($u_t['p']+$param);
$mysqli->query('UPDATE `dm_year_user` SET `a` = '.($u_t['a']).', `b` = '.($u_t['b']).', `t` = '.($u_t['t']).', `p` = '.($u_t['p']*2).', `p_` = '.($u_t['p']*2).' WHERE `id` = '.$p_u['id'].' LIMIT 1');
$mysqli->query("UPDATE `ammunition_users` SET `glory` = '".($a_users['glory']-200)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
}
header('Location: ?');
exit();
}
####################################################################################################################

####################################################################################################################
if(isset($_GET['bs3'])){
$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user`  = "'.$user['id'].'" LIMIT 1');
$a_users = $res->fetch_assoc();
if($b_s['bon_col']>0){header('Location: ?');exit();}
if($a_users['glory']<500){$_SESSION['err'] = '<div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/glory.png" alt="Слава" title="Слава"> '.(500-$a_users['glory']).' славы</div>';header('Location: ?');exit();}
if(!$b_s){
$mysqli->query('INSERT INTO `boevaya_sila` SET `user` = '.$user['id'].', `local` = "5", `bon_col` = "1", `tip` = "3" ');
}else{
$mysqli->query("UPDATE `boevaya_sila` SET `local` = '5', `bon_col` = '1', `tip` = '3' WHERE `id` = '".$b_s['id']."' LIMIT 1");
}
if($p_u['id']){
$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = '.$user['id'].' and `active`  = "1" LIMIT 1');
$u_t = $res->fetch_assoc();
if($b_s['tip']==1){$param = 50;}elseif($b_s['tip']==2){$param = 100;}elseif($b_s['tip']==3){$param = 150;}
$u_t['a'] = ($u_t['a']+$param);$u_t['b'] = ($u_t['b']+$param);$u_t['t'] = ($u_t['t']+$param);$u_t['p'] = ($u_t['p']+$param);
$mysqli->query('UPDATE `dm_year_user` SET `a` = '.($u_t['a']).', `b` = '.($u_t['b']).', `t` = '.($u_t['t']).', `p` = '.($u_t['p']*2).', `p_` = '.($u_t['p']*2).' WHERE `id` = '.$p_u['id'].' LIMIT 1');
$mysqli->query("UPDATE `ammunition_users` SET `glory` = '".($a_users['glory']-500)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
}
header('Location: ?');
exit();
}
####################################################################################################################










####################################################################################################################
echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="white medium cntr bold mb5">Все сражения</div>';
$res = $mysqli->query('SELECT * FROM `dm_year` WHERE `time_dm_year` > "'.time().'"  LIMIT 1');
$p_e1 = $res->fetch_assoc();
if($p_e1){
$res = $mysqli->query('SELECT * FROM `dm_year` WHERE `id` and `time_dm_year` = "0" ORDER BY `time` asc LIMIT 7');
}elsE{
$res = $mysqli->query('SELECT * FROM `dm_year` WHERE `id` ORDER BY `time` asc LIMIT 1,7');
}
while ($p_e = $res->fetch_array()){
echo '<div class="mb5 inbl"><div class="thumb fl"><img src="/images/battles/dm_year/dm_year'.$p_e['id'].'.jpg" style="width:100%; border-radius: 9px;"><span class="mask2">&nbsp;</span></div><div class="ml58 small white sh_b bold">
<span class="green2">'.$p_e['name'].'</span><br>
<span><span>до начала '._time1($p_e['time']-time()).'</span></span><br>
<span class="gray1">'.$tipB.'</span></div><div class="clrb"></div></div>';
}
echo '<div class="bot"><a w:id="past" class="simple-but gray border" href="/dm_year/dm_yearpast/"><span><span>Прошедшие сражения</span></span></a></div>';
echo '</div></div></div></div></div></div></div></div></div></div>';

echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">Чем больше танков врага уничтожите, тем больше награда</div>';
echo '</div></div></div></div></div></div></div></div></div></div>';
####################################################################################################################






?>
<a class="simple-but gray mt5 mb5" w:id="chatRulesLink" href="#vrag" onClick="document.getElementById('pokazat1').style.display='none';document.getElementById('skryt1').style.display='';return false;"><span><span>Правила игры</span></span></a>
<?
####################################################################################################################

####################################################################################################################
?>
<div id="pokazat1"></div>

<div id="skryt1" style="display:none">

<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">Правила игры:</div><div class="dhr a_w50 mt5 mb5"></div>
<div class="small white pb5">
&nbsp; - Сражение проводится 5 минут в режиме "каждый сам за себя".<br><div class="mt5"></div>
&nbsp; - В сражении также участвуют боты, которые могут выступать в роли противников как игрокам, так и ботам.<br><div class="mt5"></div>
&nbsp; - Всем участникам предоставляется возможность 3-м бесплатным возрождением после их уничтожения.<br><div class="mt5"></div>
Все последующие возрождения стоят <img title="Серебро" alt="Серебро" src="/images/icons/silver.png"> 500 серебра.<br><div class="mt5"></div>
После возрождения вы продолжаете атаковать противника который был выбран до вашего уничтожения, при этом все противники теряют вас из виду.
&nbsp; - Игра завершается в случае нехватки времени, или когда не остается противников.<br><div class="mt5"></div>
&nbsp; - В награду все получают <img class="ico vm" src="/images/icons/exp.png" alt="опыт" title="опыт"> опыт, <img title="Серебро" alt="Серебро" src="/images/icons/silver.png"> серебро и только топ-3 игрока получают <img title="Топливо" alt="Топливо" src="/images/icons/fuel.png"> топливо и <img title="Золото" alt="Золото" src="/images/icons/gold.png?1"> золото.<br><div class="mt5"></div>
&nbsp; - Дополнительная награда: за нанесенный урон выдаются <img height="20" width="20" title="Белые снежки" alt="Белые снежки" src="/images/snowball.png"> белые снежки, за убитых врагов <img  height="20" width="20" title="Голубые снежки" alt="Голубые снежки" src="/images/snowball_b.png"> голубые.<br><div class="mt5"></div>
&nbsp; - Снежки необходимы для участия в новогоднем турнире.<div class="mt5"></div>
</div>
</div></div></div></div></div></div></div></div></div></div>
 
<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">Правила турниров:</div><div class="dhr a_w50 mt5 mb5"></div>
<div class="small white pb5"> 
&nbsp; - Во время акции "Игра в снежки" проводятся 2 турнира.<br><div class="mt5"></div>
&nbsp; - Для участия вам необходимо "играть в снежки", наносить урон и убивать врагов.<br><div class="mt5"></div>
&nbsp; - Весь нанесенный урон и кол-во убитых врагов будет суммироваться до конца акции.<br><div class="mt5"></div>
&nbsp; - По итогам акции участники получат <img title="Серебро" alt="Серебро" src="/images/icons/silver.png"> серебро и <img title="Золото" alt="Золото" src="/images/icons/gold.png?1"> золото 
по соотношениям:<br>
100 <img height="20" width="20" title="Белые снежки" alt="Белые снежки" src="/images/snowball.png"> белых снежок = 1 <img title="Серебро" alt="Серебро" src="/images/icons/silver.png"> серебра<br>
5 <img height="20" width="20" title="Голубые снежки" alt="Голубые снежки" src="/images/snowball_b.png"> голубых снежок = 1 <img title="Золото" alt="Золото" src="/images/icons/gold.png?1"> золота
<div class="mt5"></div>
</div>
</div></div></div></div></div></div></div></div></div></div>

<a class="simple-but gray mb5" w:id="chatRulesLink" href="#vrag" onClick="document.getElementById('skryt1').style.display='none';document.getElementById('pokazat1').style.display='';return false;"><span><span>Скрыть</span></span></a>
</div><?
####################################################################################################################

echo '<a class="simple-but gray mb5" w:id="chatRulesLink" href="/dm_year/turnir/1/"><span><span>Турнир</span></span></a>';
$res = $mysqli->query('SELECT * FROM `prom` WHERE `id` = "1" ');
$prom = $res->fetch_assoc();

echo '<div class="cntr mt10"><div class="white small bold mb5">До завершения акции: <span>'._time($prom['time_19']-time()).'</span></div></div>';

$mysqli->query('DELETE FROM `dm_year_results` WHERE `time` < "'.(time()-(3600*20)).'" ');
require_once ('../system/footer.php');
?>