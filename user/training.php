<?php
$title = 'Тренировка';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}

$id = abs(intval($_GET['id']));
$res = $mysqli->query('SELECT * FROM `users` WHERE `id`  = "'.$id.'" LIMIT 1');
$ank = $res->fetch_assoc();
if($ank <= 0){header('Location: /');exit();}


$res = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$ank['id'].'" LIMIT 1');
$traning = $res->fetch_assoc();
$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user`  = "'.$ank['id'].'" and `active`  = "1" LIMIT 1');
$users_tanks = $res->fetch_assoc();

if($ank['side'] == 1){$side = 'empire';}else{$side = 'federation';}

if($traning['rang'] == 1){$level_kach = 12;$name_rang = 'Кадет';}
if($traning['rang'] == 2){$level_kach = 25;$name_rang = 'Рядовой ';}
if($traning['rang'] == 3){$level_kach = 37;$name_rang = 'Сержант';}
if($traning['rang'] == 4){$level_kach = 49;$name_rang = 'Лейтенант';}
if($traning['rang'] == 5){$level_kach = 61;$name_rang = 'Старший лейтенант';}
if($traning['rang'] == 6){$level_kach = 73;$name_rang = 'Капитан';}
if($traning['rang'] == 7){$level_kach = 85;$name_rang = 'Майор';}
if($traning['rang'] == 8){$level_kach = 100;$name_rang = 'Подполковник';}
if($traning['rang'] == 9){$level_kach = 100;$name_rang = 'Полковник';}


if($traning['a_level'] >= 12 and $traning['b_level'] >= 12 and $traning['t_level'] >= 12 and $traning['p_level'] >= 12 and $traning['rang'] == 1 ) {
$mysqli->query('UPDATE `traning` SET `rang` = "2" WHERE `id` = '.$traning['id'].' LIMIT 1');
$_SESSION['err'] = '<font color=green>Поздравляем! Звание повышено.</font>';
header('Location: ?');
exit();
}
if($traning['a_level'] >= 25 and $traning['b_level'] >= 25 and $traning['t_level'] >= 25 and $traning['p_level'] >= 25 and $traning['rang'] == 2 ) {
$mysqli->query('UPDATE `traning` SET `rang` = "3" WHERE `id` = '.$traning['id'].' LIMIT 1');
$_SESSION['err'] = '<font color=green>Поздравляем! Звание повышено.</font>';
header('Location: ?');
exit();
}
if($traning['a_level'] >= 37 and $traning['b_level'] >= 37 and $traning['t_level'] >= 37 and $traning['p_level'] >= 37 and $traning['rang'] == 3 ) {
$mysqli->query('UPDATE `traning` SET `rang` = "4" WHERE `id` = '.$traning['id'].' LIMIT 1');
$_SESSION['err'] = '<font color=green>Поздравляем! Звание повышено.</font>';
header('Location: ?');
exit();
}
if($traning['a_level'] >= 49 and $traning['b_level'] >= 49 and $traning['t_level'] >= 49 and $traning['p_level'] >= 49 and $traning['rang'] == 4 ) {
$mysqli->query('UPDATE `traning` SET `rang` = "5" WHERE `id` = '.$traning['id'].' LIMIT 1');
$_SESSION['err'] = '<font color=green>Поздравляем! Звание повышено.</font>';
header('Location: ?');
exit();
}
if($traning['a_level'] >= 61 and $traning['b_level'] >= 61 and $traning['t_level'] >= 61 and $traning['p_level'] >= 61 and $traning['rang'] == 5 ) {
$mysqli->query('UPDATE `traning` SET `rang` = "6" WHERE `id` = '.$traning['id'].' LIMIT 1');
$_SESSION['err'] = '<font color=green>Поздравляем! Звание повышено.</font>';
header('Location: ?');
exit();
}
if($traning['a_level'] >= 73 and $traning['b_level'] >= 73 and $traning['t_level'] >= 73 and $traning['p_level'] >= 73 and $traning['rang'] == 6 ) {
$mysqli->query('UPDATE `traning` SET `rang` = "7" WHERE `id` = '.$traning['id'].' LIMIT 1');
$_SESSION['err'] = '<font color=green>Поздравляем! Звание повышено.</font>';
header('Location: ?');
exit();
}
if($traning['a_level'] >= 85 and $traning['b_level'] >= 85 and $traning['t_level'] >= 85 and $traning['p_level'] >= 85 and $traning['rang'] == 7 ) {
$mysqli->query('UPDATE `traning` SET `rang` = "8" WHERE `id` = '.$traning['id'].' LIMIT 1');
$_SESSION['err'] = '<font color=green>Поздравляем! Звание повышено.</font>';
header('Location: ?');
exit();
}
if($traning['a_level'] >= 100 and $traning['b_level'] >= 100 and $traning['t_level'] >= 100 and $traning['p_level'] >= 100 and $traning['rang'] == 8 ) {
$mysqli->query('UPDATE `traning` SET `rang` = "9" WHERE `id` = '.$traning['id'].' LIMIT 1');
$_SESSION['err'] = '<font color=green>Поздравляем! Звание повышено.</font>';
header('Location: ?');
exit();
}

/* <div class="small cntr mt10 mb10">
<a class="simple-but medium w80 mXa m5" w:id="nextRankLink" href="?7-10.ILinkListener-nextRankLink"><span><span>Получить звание Рядовой</span></span></a>
</div> */







if($traning['a_level'] == 4){$cost_a = 5;}elseif($traning['a_level'] == 9){$cost_a = 10;
}elseif($traning['a_level'] == 14){$cost_a = 20;}elseif($traning['a_level'] == 19){$cost_a = 40;
}elseif($traning['a_level'] == 24){$cost_a = 80;}elseif($traning['a_level'] == 29){$cost_a = 150;
}elseif($traning['a_level'] == 34){$cost_a = 300;}elseif($traning['a_level'] == 39){$cost_a = 500;
}elseif($traning['a_level'] == 44){$cost_a = 800;}elseif($traning['a_level'] == 49){$cost_a = 1000;
}elseif($traning['a_level'] == 54){$cost_a = 1400;}elseif($traning['a_level'] == 59){$cost_a = 1800;
}elseif($traning['a_level'] == 64){$cost_a = 2300;}elseif($traning['a_level'] == 69){$cost_a = 2800;
}elseif($traning['a_level'] == 74){$cost_a = 3500;}elseif($traning['a_level'] == 79){$cost_a = 4500;
}elseif($traning['a_level'] == 84){$cost_a = 7000;}elseif($traning['a_level'] == 89){$cost_a = 9000;
}elseif($traning['a_level'] == 94){$cost_a = 15000;}elseif($traning['a_level'] == 99){$cost_a = 20000;
}else{
if($traning['a_level']>=0 && $traning['a_level']<=11){
$cost_a = (($traning['a_level']+1)*25);
}elseif($traning['a_level']>11 && $traning['a_level']<=24){
$cost_a = (($traning['a_level']+1)*50);
}elseif($traning['a_level']>24 && $traning['a_level']<=36){
$cost_a = (($traning['a_level']+1)*100);
}elseif($traning['a_level']>36 && $traning['a_level']<=48){
$cost_a = (($traning['a_level']+1)*200);
}elseif($traning['a_level']>48 && $traning['a_level']<=60){
$cost_a = (($traning['a_level']+1)*500);
}elseif($traning['a_level']>60 && $traning['a_level']<=72){
$cost_a = (($traning['a_level']+1)*750);
}elseif($traning['a_level']>72 && $traning['a_level']<=84){
$cost_a = (($traning['a_level']+1)*1000);
}elseif($traning['a_level']>84 && $traning['a_level']<=100){
$cost_a = (($traning['a_level']+1)*1500);
}
}


if($traning['b_level'] == 4){$cost_b = 5;}elseif($traning['b_level'] == 9){$cost_b = 10;
}elseif($traning['b_level'] == 14){$cost_b = 20;}elseif($traning['b_level'] == 19){$cost_b = 40;
}elseif($traning['b_level'] == 24){$cost_b = 80;}elseif($traning['b_level'] == 29){$cost_b = 150;
}elseif($traning['b_level'] == 34){$cost_b = 300;}elseif($traning['b_level'] == 39){$cost_b = 500;
}elseif($traning['b_level'] == 44){$cost_b = 800;}elseif($traning['b_level'] == 49){$cost_b = 1000;
}elseif($traning['b_level'] == 54){$cost_b = 1400;}elseif($traning['b_level'] == 59){$cost_b = 1800;
}elseif($traning['b_level'] == 64){$cost_b = 2300;}elseif($traning['b_level'] == 69){$cost_b = 2800;
}elseif($traning['b_level'] == 74){$cost_b = 3500;}elseif($traning['b_level'] == 79){$cost_b = 4500;
}elseif($traning['b_level'] == 84){$cost_b = 7000;}elseif($traning['b_level'] == 89){$cost_b = 9000;
}elseif($traning['b_level'] == 94){$cost_b = 15000;}elseif($traning['b_level'] == 99){$cost_b = 20000;
}else{
if($traning['b_level']>=0 && $traning['b_level']<=11){
$cost_b = (($traning['b_level']+1)*25);
}elseif($traning['b_level']>11 && $traning['b_level']<=24){
$cost_b = (($traning['b_level']+1)*50);
}elseif($traning['b_level']>24 && $traning['b_level']<=36){
$cost_b = (($traning['b_level']+1)*100);
}elseif($traning['b_level']>36 && $traning['b_level']<=48){
$cost_b = (($traning['b_level']+1)*200);
}elseif($traning['b_level']>48 && $traning['b_level']<=60){
$cost_b = (($traning['b_level']+1)*500);
}elseif($traning['b_level']>60 && $traning['b_level']<=72){
$cost_b = (($traning['b_level']+1)*750);
}elseif($traning['b_level']>72 && $traning['b_level']<=84){
$cost_b = (($traning['b_level']+1)*1000);
}elseif($traning['b_level']>84 && $traning['b_level']<=100){
$cost_b = (($traning['b_level']+1)*1500);
}
}


if($traning['t_level'] == 4){$cost_t = 5;}elseif($traning['t_level'] == 9){$cost_t = 10;
}elseif($traning['t_level'] == 14){$cost_t = 20;}elseif($traning['t_level'] == 19){$cost_t = 40;
}elseif($traning['t_level'] == 24){$cost_t = 80;}elseif($traning['t_level'] == 29){$cost_t = 150;
}elseif($traning['t_level'] == 34){$cost_t = 300;}elseif($traning['t_level'] == 39){$cost_t = 500;
}elseif($traning['t_level'] == 44){$cost_t = 800;}elseif($traning['t_level'] == 49){$cost_t = 1000;
}elseif($traning['t_level'] == 54){$cost_t = 1400;}elseif($traning['t_level'] == 59){$cost_t = 1800;
}elseif($traning['t_level'] == 64){$cost_t = 2300;}elseif($traning['t_level'] == 69){$cost_t = 2800;
}elseif($traning['t_level'] == 74){$cost_t = 3500;}elseif($traning['t_level'] == 79){$cost_t = 4500;
}elseif($traning['t_level'] == 84){$cost_t = 7000;}elseif($traning['t_level'] == 89){$cost_t = 9000;
}elseif($traning['t_level'] == 94){$cost_t = 15000;}elseif($traning['t_level'] == 99){$cost_t = 20000;
}else{
if($traning['t_level']>=0 && $traning['t_level']<=11){
$cost_t = (($traning['t_level']+1)*25);
}elseif($traning['t_level']>11 && $traning['t_level']<=24){
$cost_t = (($traning['t_level']+1)*50);
}elseif($traning['t_level']>24 && $traning['t_level']<=36){
$cost_t = (($traning['t_level']+1)*100);
}elseif($traning['t_level']>36 && $traning['t_level']<=48){
$cost_t = (($traning['t_level']+1)*200);
}elseif($traning['t_level']>48 && $traning['t_level']<=60){
$cost_t = (($traning['t_level']+1)*500);
}elseif($traning['t_level']>60 && $traning['t_level']<=72){
$cost_t = (($traning['t_level']+1)*750);
}elseif($traning['t_level']>72 && $traning['t_level']<=84){
$cost_t = (($traning['t_level']+1)*1000);
}elseif($traning['t_level']>84 && $traning['t_level']<=100){
$cost_t = (($traning['t_level']+1)*1500);
}
}


if($traning['p_level'] == 4){$cost_p = 5;}elseif($traning['p_level'] == 9){$cost_p = 10;
}elseif($traning['p_level'] == 14){$cost_p = 20;}elseif($traning['p_level'] == 19){$cost_p = 40;
}elseif($traning['p_level'] == 24){$cost_p = 80;}elseif($traning['p_level'] == 29){$cost_p = 150;
}elseif($traning['p_level'] == 34){$cost_p = 300;}elseif($traning['p_level'] == 39){$cost_p = 500;
}elseif($traning['p_level'] == 44){$cost_p = 800;}elseif($traning['p_level'] == 49){$cost_p = 1000;
}elseif($traning['p_level'] == 54){$cost_p = 1400;}elseif($traning['p_level'] == 59){$cost_p = 1800;
}elseif($traning['p_level'] == 64){$cost_p = 2300;}elseif($traning['p_level'] == 69){$cost_p = 2800;
}elseif($traning['p_level'] == 74){$cost_p = 3500;}elseif($traning['p_level'] == 79){$cost_p = 4500;
}elseif($traning['p_level'] == 84){$cost_p = 7000;}elseif($traning['p_level'] == 89){$cost_p = 9000;
}elseif($traning['p_level'] == 94){$cost_p = 15000;}elseif($traning['p_level'] == 99){$cost_p = 20000;
}else{
if($traning['p_level']>=0 && $traning['p_level']<=11){
$cost_p = (($traning['p_level']+1)*25);
}elseif($traning['p_level']>11 && $traning['p_level']<=24){
$cost_p = (($traning['p_level']+1)*50);
}elseif($traning['p_level']>24 && $traning['p_level']<=36){
$cost_p = (($traning['p_level']+1)*100);
}elseif($traning['p_level']>36 && $traning['p_level']<=48){
$cost_p = (($traning['p_level']+1)*200);
}elseif($traning['p_level']>48 && $traning['p_level']<=60){
$cost_p = (($traning['p_level']+1)*500);
}elseif($traning['p_level']>60 && $traning['p_level']<=72){
$cost_p = (($traning['p_level']+1)*750);
}elseif($traning['p_level']>72 && $traning['p_level']<=84){
$cost_p = (($traning['p_level']+1)*1000);
}elseif($traning['p_level']>84 && $traning['p_level']<=100){
$cost_p = (($traning['p_level']+1)*1500);
}
}


$res = $mysqli->query('SELECT * FROM `prom` WHERE `id` = "1" ');
$prom = $res->fetch_assoc();

if($prom['time_3']>time()){
$cost_a = $cost_a-($cost_a*$prom['act_3']/100);
}else{
$cost_a = $cost_a;
}

if($prom['time_3']>time()){
$cost_b = $cost_b-($cost_b*$prom['act_3']/100);
}else{
$cost_b = $cost_b;
}

if($prom['time_3']>time()){
$cost_t = $cost_t-($cost_t*$prom['act_3']/100);
}else{
$cost_t = $cost_t;
}

if($prom['time_3']>time()){
$cost_p = $cost_p-($cost_p*$prom['act_3']/100);
}else{
$cost_p = $cost_p;
}

#####################################################################################################################
#####################################################################################################################
#####################################################################################################################




if(isset($_GET['a'.$traning['a_level'].''])){
if($traning['a_level'] >= 100){header('Location: ?');exit();}
if($traning['a_level'] != 4 and $traning['a_level'] != 9 and $traning['a_level'] != 14 and $traning['a_level'] != 19 and $traning['a_level'] != 24 and $traning['a_level'] != 29 and $traning['a_level'] != 34 and $traning['a_level'] != 39 and $traning['a_level'] != 44 and $traning['a_level'] != 49 and $traning['a_level'] != 54 and $traning['a_level'] != 59 and $traning['a_level'] != 64 and $traning['a_level'] != 69 and $traning['a_level'] != 74 and $traning['a_level'] != 79 and $traning['a_level'] != 84 and $traning['a_level'] != 89 and $traning['a_level'] != 94 and $traning['a_level'] != 99){
if($user['silver'] < $cost_a){
$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.($cost_a-$user['silver']).' серебра</div></div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');exit();}
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
$mysqli->query('UPDATE `traning` SET `a_level` = '.($traning['a_level']+1).' WHERE `id` = '.$traning['id'].' LIMIT 1');
$mysqli->query('UPDATE `users_tanks` SET `a` = '.($users_tanks['a']+1).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
}else{
if($user['gold'] < $cost_a){
$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_a-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');exit();
}
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
$mysqli->query('UPDATE `traning` SET `a_level` = '.($traning['a_level']+1).' WHERE `id` = '.$traning['id'].' LIMIT 1');
$mysqli->query('UPDATE `users_tanks` SET `a` = '.($users_tanks['a']+1).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
}
header('Location: ?');
exit();
}


if(isset($_GET['b'.$traning['b_level'].''])){
if($traning['b_level'] >= 100){header('Location: ?');exit();}
if($traning['b_level'] != 4 and $traning['b_level'] != 9 and $traning['b_level'] != 14 and $traning['b_level'] != 19 and $traning['b_level'] != 24 and $traning['b_level'] != 29 and $traning['b_level'] != 34 and $traning['b_level'] != 39 and $traning['b_level'] != 44 and $traning['b_level'] != 49 and $traning['b_level'] != 54 and $traning['b_level'] != 59 and $traning['b_level'] != 64 and $traning['b_level'] != 69 and $traning['b_level'] != 74 and $traning['b_level'] != 79 and $traning['b_level'] != 84 and $traning['b_level'] != 89 and $traning['b_level'] != 94 and $traning['b_level'] != 99){
if($user['silver'] < $cost_b){
$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.($cost_b-$user['silver']).' серебра</div></div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');exit();}
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']-$cost_b).' WHERE `id` = '.$user['id'].' LIMIT 1');
$mysqli->query('UPDATE `traning` SET `b_level` = '.($traning['b_level']+1).' WHERE `id` = '.$traning['id'].' LIMIT 1');
$mysqli->query('UPDATE `users_tanks` SET `b` = '.($users_tanks['b']+1).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
}else{
if($user['gold'] < $cost_b){
$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_b-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');exit();
}
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$cost_b).' WHERE `id` = '.$user['id'].' LIMIT 1');
$mysqli->query('UPDATE `traning` SET `b_level` = '.($traning['b_level']+1).' WHERE `id` = '.$traning['id'].' LIMIT 1');
$mysqli->query('UPDATE `users_tanks` SET `b` = '.($users_tanks['b']+1).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
}
header('Location: ?');
exit();
}


if(isset($_GET['t'.$traning['t_level'].''])){
if($traning['t_level'] >= 100){header('Location: ?');exit();}
if($traning['t_level'] != 4 and $traning['t_level'] != 9 and $traning['t_level'] != 14 and $traning['t_level'] != 19 and $traning['t_level'] != 24 and $traning['t_level'] != 29 and $traning['t_level'] != 34 and $traning['t_level'] != 39 and $traning['t_level'] != 44 and $traning['t_level'] != 49 and $traning['t_level'] != 54 and $traning['t_level'] != 59 and $traning['t_level'] != 64 and $traning['t_level'] != 69 and $traning['t_level'] != 74 and $traning['t_level'] != 79 and $traning['t_level'] != 84 and $traning['t_level'] != 89 and $traning['t_level'] != 94 and $traning['t_level'] != 99){
if($user['silver'] < $cost_t){
$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.($cost_t-$user['silver']).' серебра</div></div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');exit();}
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']-$cost_t).' WHERE `id` = '.$user['id'].' LIMIT 1');
$mysqli->query('UPDATE `traning` SET `t_level` = '.($traning['t_level']+1).' WHERE `id` = '.$traning['id'].' LIMIT 1');
$mysqli->query('UPDATE `users_tanks` SET `t` = '.($users_tanks['t']+1).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
}else{
if($user['gold'] < $cost_t){
$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_t-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');exit();
}
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$cost_t).' WHERE `id` = '.$user['id'].' LIMIT 1');
$mysqli->query('UPDATE `traning` SET `t_level` = '.($traning['t_level']+1).' WHERE `id` = '.$traning['id'].' LIMIT 1');
$mysqli->query('UPDATE `users_tanks` SET `t` = '.($users_tanks['t']+1).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
}
header('Location: ?');
exit();
}


if(isset($_GET['p'.$traning['p_level'].''])){
if($traning['p_level'] >= 100){header('Location: ?');exit();}
if($traning['p_level'] != 4 and $traning['p_level'] != 9 and $traning['p_level'] != 14 and $traning['p_level'] != 19 and $traning['p_level'] != 24 and $traning['p_level'] != 29 and $traning['p_level'] != 34 and $traning['p_level'] != 39 and $traning['p_level'] != 44 and $traning['p_level'] != 49 and $traning['p_level'] != 54 and $traning['p_level'] != 59 and $traning['p_level'] != 64 and $traning['p_level'] != 69 and $traning['p_level'] != 74 and $traning['p_level'] != 79 and $traning['p_level'] != 84 and $traning['p_level'] != 89 and $traning['p_level'] != 94 and $traning['p_level'] != 99){
if($user['silver'] < $cost_p){
$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.($cost_p-$user['silver']).' серебра</div></div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');exit();}
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']-$cost_p).' WHERE `id` = '.$user['id'].' LIMIT 1');
$mysqli->query('UPDATE `traning` SET `p_level` = '.($traning['p_level']+1).' WHERE `id` = '.$traning['id'].' LIMIT 1');
$mysqli->query('UPDATE `users_tanks` SET `p` = '.($users_tanks['p']+1).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
}else{
if($user['gold'] < $cost_p){
$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_p-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');exit();
}
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$cost_p).' WHERE `id` = '.$user['id'].' LIMIT 1');
$mysqli->query('UPDATE `traning` SET `p_level` = '.($traning['p_level']+1).' WHERE `id` = '.$traning['id'].' LIMIT 1');
$mysqli->query('UPDATE `users_tanks` SET `p` = '.($users_tanks['p']+1).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
}
header('Location: ?');
exit();
}





if($ank['id'] != $user['id']){
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$prog_a = round((($traning['a_level']*100)/100));
if($prog_a > 100) {$prog_a = 100;}
$prog_b = round((($traning['b_level']*100)/100));
if($prog_b > 100) {$prog_b = 100;}
$prog_t= round((($traning['t_level']*100)/100));
if($prog_t > 100) {$prog_t = 100;}
$prog_p= round((($traning['p_level']*100)/100));
if($prog_p > 100) {$prog_p = 100;}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}else{
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$prog_a = round((($traning['a_level']*100)/$level_kach));
if($prog_a > 100) {$prog_a = 100;}
$prog_b = round((($traning['b_level']*100)/$level_kach));
if($prog_b > 100) {$prog_b = 100;}
$prog_t= round((($traning['t_level']*100)/$level_kach));
if($prog_t > 100) {$prog_t = 100;}
$prog_p= round((($traning['p_level']*100)/$level_kach));
if($prog_p > 100) {$prog_p = 100;}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
#####################################################################################################################
#####################################################################################################################
#####################################################################################################################




echo '</div>';



echo '<div class="medium white bold cntr mb5">Тренировка </div>';
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="white small bold sh_b mb2 cntr">Текущее звание: <img class="vb" src="/images/side/'.$side.'/'.$traning['rang'].'.png"> <span class="green2">'.$name_rang.'</span><br>';

echo '<div class="white small bold sh_b mb5 cntr">
Бонус звания:<br>
<span class="nwr">
<img class="ico vm" src="/images/icons/exp.png" alt="опыт" title="опыт"> '.$traning['rang'].'
 опыта</span><span class="nwr">
<img class="ico vm" src="/images/icons/silver.png" alt="Серебро" title="Серебро"> '.$traning['rang'].'
 серебра</span>
</div>';

if($traning['rang'] >= 1){echo ' <img class="vb" src="/images/side/'.$side.'/1.png?1">';}else{echo ' <img class="vb" src="/images/side/'.$side.'/1_off.png?1">';}
if($traning['rang'] >= 2){echo ' <img class="vb" src="/images/side/'.$side.'/2.png?1">';}else{echo ' <img class="vb" src="/images/side/'.$side.'/2_off.png?1">';}
if($traning['rang'] >= 3){echo ' <img class="vb" src="/images/side/'.$side.'/3.png?1">';}else{echo ' <img class="vb" src="/images/side/'.$side.'/3_off.png?1">';}
if($traning['rang'] >= 4){echo ' <img class="vb" src="/images/side/'.$side.'/4.png?1">';}else{echo ' <img class="vb" src="/images/side/'.$side.'/4_off.png?1">';}
if($traning['rang'] >= 5){echo ' <img class="vb" src="/images/side/'.$side.'/5.png?1">';}else{echo ' <img class="vb" src="/images/side/'.$side.'/5_off.png?1">';}
if($traning['rang'] >= 6){echo ' <img class="vb" src="/images/side/'.$side.'/6.png?1">';}else{echo ' <img class="vb" src="/images/side/'.$side.'/6_off.png?1">';}
if($traning['rang'] >= 7){echo ' <img class="vb" src="/images/side/'.$side.'/7.png?1">';}else{echo ' <img class="vb" src="/images/side/'.$side.'/7_off.png?1">';}
if($traning['rang'] >= 8){echo ' <img class="vb" src="/images/side/'.$side.'/8.png?1">';}else{echo ' <img class="vb" src="/images/side/'.$side.'/8_off.png?1">';}
if($traning['rang'] >= 9){echo ' <img class="vb" src="/images/side/'.$side.'/9.png?1">';}else{echo ' <img class="vb" src="/images/side/'.$side.'/9_off.png?1">';}
echo '</div>
</div></div></div></div></div></div></div></div></div></div></div>';




if($ank['id'] != $user['id']){$mb5 = 'mb5';}
echo '<div class="trnt-block '.$mb5.'">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">

<div class="white cntr bold sh_b small pb0">';
if($ank['id'] == $user['id']){
echo '<div class="medium green2 pb5"><img height="14" width="14" src="/images/attack1.png?1" alt="Атака" title="Атака"> Атака: '.$traning['a_level'].' из '.$level_kach.'</div>';
}else{
echo '<div class="medium green2 pb5"><img height="14" width="14" src="/images/attack1.png?1" alt="Атака" title="Атака"> Атака: '.$traning['a_level'].' из 100</div>';
}
echo '<div class="rate-block mb0">
<div class="scale-block">
<div class="scale-next" style="width:100%;">
<div class="scale" style="width:'.$prog_a.'%;"><div class="in">&nbsp;</div></div>
</div>
<div class="mask"><div class="in">&nbsp;</div></div>
</div></div></div>';

if($ank['id'] == $user['id']){
if($traning['a_level'] == 100){
echo '<div class="bot"><a class="simple-but gray border"><span><span>максимально</span></span></a></div></div>';
}else{
if($traning['a_level'] != 4 and $traning['a_level'] != 9 and $traning['a_level'] != 14 and $traning['a_level'] != 19 and $traning['a_level'] != 24 and $traning['a_level'] != 29 and $traning['a_level'] != 34 and $traning['a_level'] != 39 and $traning['a_level'] != 44 and $traning['a_level'] != 49 and $traning['a_level'] != 54 and $traning['a_level'] != 59 and $traning['a_level'] != 64 and $traning['a_level'] != 69 and $traning['a_level'] != 74 and $traning['a_level'] != 79 and $traning['a_level'] != 84 and $traning['a_level'] != 89 and $traning['a_level'] != 94 and $traning['a_level'] != 99){
echo '<div class="bot"><a class="simple-but border mb5" href="?a'.$traning['a_level'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/silver.png" alt="Серебро" title="Серебро"> '.$cost_a.'</span></span></a></div></div>';
}else{
echo '<div class="bot"><a class="simple-but border mb5" href="?a'.$traning['a_level'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/gold.png" alt="Золото" title="Золото"> '.$cost_a.'</span></span></a></div></div>';
}
}
}
echo '</div></div></div></div></div></div></div></div></div></div>';




if($ank['id'] != $user['id']){$mb5 = 'mb5';}
echo '<div class="trnt-block '.$mb5.'">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">

<div class="white cntr bold sh_b small pb0">';
if($ank['id'] == $user['id']){
echo '<div class="medium green2 pb5"><img height="14" width="14" src="/images/armor1.png?1" alt="Броня" title="Броня"> Броня: '.$traning['b_level'].' из '.$level_kach.'</div>';
}else{
echo '<div class="medium green2 pb5"><img height="14" width="14" src="/images/armor1.png?1" alt="Броня" title="Броня"> Броня: '.$traning['b_level'].' из 100</div>';
}
echo '<div class="rate-block mb0">
<div class="scale-block">
<div class="scale-next" style="width:100%;">
<div class="scale" style="width:'.$prog_b.'%;"><div class="in">&nbsp;</div></div>
</div>
<div class="mask"><div class="in">&nbsp;</div></div>
</div></div></div>';
if($ank['id'] == $user['id']){
if($traning['b_level'] == 100){
echo '<div class="bot"><a class="simple-but gray border"><span><span>максимально</span></span></a></div></div>';
}else{
if($traning['b_level'] != 4 and $traning['b_level'] != 9 and $traning['b_level'] != 14 and $traning['b_level'] != 19 and $traning['b_level'] != 24 and $traning['b_level'] != 29 and $traning['b_level'] != 34 and $traning['b_level'] != 39 and $traning['b_level'] != 44 and $traning['b_level'] != 49 and $traning['b_level'] != 54 and $traning['b_level'] != 59 and $traning['b_level'] != 64 and $traning['b_level'] != 69 and $traning['b_level'] != 74 and $traning['b_level'] != 79 and $traning['b_level'] != 84 and $traning['b_level'] != 89 and $traning['b_level'] != 94 and $traning['b_level'] != 99){
echo '<div class="bot"><a class="simple-but border mb5" href="?b'.$traning['b_level'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/silver.png" alt="Серебро" title="Серебро"> '.$cost_b.'</span></span></a></div></div>';
}else{
echo '<div class="bot"><a class="simple-but border mb5" href="?b'.$traning['b_level'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/gold.png" alt="Золото" title="Золото"> '.$cost_b.'</span></span></a></div></div>';
}
}
}
echo '</div></div></div></div></div></div></div></div></div></div>';




if($ank['id'] != $user['id']){$mb5 = 'mb5';}
echo '<div class="trnt-block '.$mb5.'">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="white cntr bold sh_b small pb0">';
if($ank['id'] == $user['id']){
echo '<div class="medium green2 pb5"><img height="14" width="14" src="/images/accuracy1.png?1" alt="Точность" title="Точность"> Точность: '.$traning['t_level'].' из '.$level_kach.'</div>';
}else{
echo '<div class="medium green2 pb5"><img height="14" width="14" src="/images/accuracy1.png?1" alt="Точность" title="Точность"> Точность: '.$traning['t_level'].' из 100</div>';
}
echo '<div class="rate-block mb0">
<div class="scale-block">
<div class="scale-next" style="width:100%;">
<div class="scale" style="width:'.$prog_t.'%;"><div class="in">&nbsp;</div></div>
</div>
<div class="mask"><div class="in">&nbsp;</div></div>
</div></div></div>';
if($ank['id'] == $user['id']){
if($traning['t_level'] == 100){
echo '<div class="bot"><a class="simple-but gray border"><span><span>максимально</span></span></a></div></div>';
}else{
if($traning['t_level'] != 4 and $traning['t_level'] != 9 and $traning['t_level'] != 14 and $traning['t_level'] != 19 and $traning['t_level'] != 24 and $traning['t_level'] != 29 and $traning['t_level'] != 34 and $traning['t_level'] != 39 and $traning['t_level'] != 44 and $traning['t_level'] != 49 and $traning['t_level'] != 54 and $traning['t_level'] != 59 and $traning['t_level'] != 64 and $traning['t_level'] != 69 and $traning['t_level'] != 74 and $traning['t_level'] != 79 and $traning['t_level'] != 84 and $traning['t_level'] != 89 and $traning['t_level'] != 94 and $traning['t_level'] != 99){
echo '<div class="bot"><a class="simple-but border mb5" href="?t'.$traning['t_level'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/silver.png" alt="Серебро" title="Серебро"> '.$cost_t.'</span></span></a></div></div>';
}else{
echo '<div class="bot"><a class="simple-but border mb5" href="?t'.$traning['t_level'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/gold.png" alt="Золото" title="Золото"> '.$cost_t.'</span></span></a></div></div>';
}
}
}
echo '</div></div></div></div></div></div></div></div></div></div>';




if($ank['id'] != $user['id']){$mb5 = 'mb5';}
echo '<div class="trnt-block '.$mb5.'">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="white cntr bold sh_b small pb0">';
if($ank['id'] == $user['id']){
echo '<div class="medium green2 pb5"><img height="14" width="14" src="/images/durability1.png?1" alt="Прочность" title="Прочность"> Прочность: '.$traning['p_level'].' из '.$level_kach.'</div>';
}else{
echo '<div class="medium green2 pb5"><img height="14" width="14" src="/images/durability1.png?1" alt="Прочность" title="Прочность"> Прочность: '.$traning['p_level'].' из 100</div>';
}
echo '<div class="rate-block mb0">
<div class="scale-block">
<div class="scale-next" style="width:100%;">
<div class="scale" style="width:'.$prog_p.'%;"><div class="in">&nbsp;</div></div>
</div>
<div class="mask"><div class="in">&nbsp;</div></div>
</div></div></div>';
if($ank['id'] == $user['id']){
if($traning['p_level'] == 100){
echo '<div class="bot"><a class="simple-but gray border"><span><span>максимально</span></span></a></div></div>';
}else{
if($traning['p_level'] != 4 and $traning['p_level'] != 9 and $traning['p_level'] != 14 and $traning['p_level'] != 19 and $traning['p_level'] != 24 and $traning['p_level'] != 29 and $traning['p_level'] != 34 and $traning['p_level'] != 39 and $traning['p_level'] != 44 and $traning['p_level'] != 49 and $traning['p_level'] != 54 and $traning['p_level'] != 59 and $traning['p_level'] != 64 and $traning['p_level'] != 69 and $traning['p_level'] != 74 and $traning['p_level'] != 79 and $traning['p_level'] != 84 and $traning['p_level'] != 89 and $traning['p_level'] != 94 and $traning['p_level'] != 99){
echo '<div class="bot"><a class="simple-but border mb5" href="?p'.$traning['p_level'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/silver.png" alt="Серебро" title="Серебро"> '.$cost_p.'</span></span></a></div></div>';
}else{
echo '<div class="bot"><a class="simple-but border mb5" href="?p'.$traning['p_level'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/gold.png" alt="Золото" title="Золото"> '.$cost_p.'</span></span></a></div></div>';
}
}
}
echo '</div></div></div></div></div></div></div></div></div></div>';


echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">Чем выше звание, тем больше бонус к награде. Каждое улучшение увеличивает параметры на 1.</div>
</div></div></div></div></div></div></div></div></div></div>';

echo '<div class="bot"><a class="simple-but border mb5" href="/power/'.$ank['id'].'/"><span><span>Назад</span></span></a></div></div>';

require_once ('../system/footer.php');
?>