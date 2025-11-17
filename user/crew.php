<?php
$title = 'Экипаж';
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
if(!$ank){header('Location: /');exit();}



$res = mysqli_query($mysqli,'SELECT sum(rang) FROM crew_user WHERE `user`  = "'.$id.'"');
if (FALSE === $res) die("Select sum failed: ".mysqli_error);
$row = mysqli_fetch_row($res);
$sum = $row[0];


$res = $mysqli->query('SELECT * FROM `traning` WHERE `user`  = "'.$user['id'].'" limit 1');
$traning = $res->fetch_assoc();


$res1 = $mysqli->query('SELECT * FROM `prom` WHERE `id` = "1" ');
$prom = $res1->fetch_assoc();

$price = 50; // сток цена
if($prom['time_8']>time()){$price = ceil($price-($price*$prom['act_8']/100));}else{$price = $price;}

//$mysqli->query('INSERT INTO `crew_user` SET `user` = "2", `tip` = "1", `sposobn` = "10" ');

/* 
Командир танка +15% к опыту дивизии
Механик-водитель +45 топлива ежедневно
Наводчик орудия +6 к точности
Заряжающий +6 к атаке
Заряжающий-2 +6 к атаке
Пулемётчик +6 к броне
Радист-пулемётчик +6 к прочности
 */


if($ank['id']==$user['id']){
$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user`  = "'.$user['id'].'" LIMIT 1');
$ammunition_users = $res->fetch_assoc();

echo '<div class="medium white bold cntr mb5">Экипаж '.$sum.' уровень</div>';
echo '<div class="trnt-block mb5 mt2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="green2 small bold sh_b mb2 cntr">Доступных очков экипажа: <span class="nwr white"><img class="ico vm" src="/images/icons/crewpoints.png" alt="Опыт экипажа" title="Опыт экипажа"> '.$ammunition_users['crewpoints'].'</span>
</div></div></div></div></div></div></div></div></div></div></div>';

$max = 10;
$res = $mysqli->query("SELECT COUNT(*) FROM `crew` WHERE `id` ");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$res = $mysqli->query('SELECT * FROM `crew` WHERE `id` ORDER BY `id` asc LIMIT '.$start.','.$max.' ');
while ($crew = $res->fetch_array()){
if($ank['level']>=$crew['level']){
$res1 = $mysqli->query('SELECT * FROM `crew_user` WHERE `user`  = "'.$ank['id'].'" and `tip`  = "'.$crew['id'].'" LIMIT 1');
$crew_user = $res1->fetch_assoc();

if($crew_user['rang']==1){$cost_app = 50;$crewpoints = 10;}
if($crew_user['rang']==2){$cost_app = 100;$crewpoints = 50;}
if($crew_user['rang']==3){$cost_app = 250;$crewpoints = 100;}
if($crew_user['rang']==4){$cost_app = 50;$crewpoints = 500;}
if($crew_user['rang']==5){$cost_app = 100;$crewpoints = 1000;}
if($crew_user['rang']==6){$cost_app = 250;$crewpoints = 5000;}
if($crew_user['rang']==7){$cost_app = 500;$crewpoints = 10000;}
if($crew_user['rang']==8){$cost_app = 1000;$crewpoints = 50000;}
if($crew_user['rang']==9){$cost_app = 5000;$crewpoints = 100000;}
if($crew_user['rang']==10){$cost_app = 5000;$crewpoints = 100000;}

if($crew_user['crewpoints']>=$crewpoints){$crewp = $crewpoints;}else{$crewp = $crew_user['crewpoints'];}
if($crew_user['rang']>=4){$cost_crewp = 100;}else{$cost_crewp = 10;}

echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/crew/'.$crew['id'].'.png" style="width:100%; border-radius: 9px;"><span class="mask2">&nbsp;</span></div><div class="ml58 small white sh_b bold"><span class="green2">'.$crew['name'].'</span><br>';

if(!$crew_user){
echo '<span class="small">'.$crew['text'].'</span><br></div>';
echo '<div class="clrb"></div></div>';
echo '<div class="bot"><a class="simple-but border mb5" href="?act_new'.$crew['id'].'"><span><span>Нанять за <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> 10</span></span></a></div>';
}else{
if($crew['id'] == 1){$text = '+'.$crew_user['sposobn'].'% к опыту дивизии';}
if($crew['id'] == 2){$text = '+'.$crew_user['sposobn'].' топлива ежедневно';}
if($crew['id'] == 3){$text = '+'.$crew_user['sposobn'].'к точности';}
if($crew['id'] == 4){$text = '+'.$crew_user['sposobn'].'к точности';}
if($crew['id'] == 5){$text = '+'.$crew_user['sposobn'].' к атаке';}
if($crew['id'] == 6){$text = '+'.$crew_user['sposobn'].' к атаке';}
if($crew['id'] == 7){$text = '+'.$crew_user['sposobn'].' к броне';}
if($crew['id'] == 8){$text = '+'.$crew_user['sposobn'].' к броне';}
if($crew['id'] == 9){$text = '+'.$crew_user['sposobn'].' к прочности';}
if($crew['id'] == 10){$text = '+'.$crew_user['sposobn'].' к прочности';}

if($crew_user['rang'] == 1){$rang = 'рядовой';}
if($crew_user['rang'] == 2){$rang = 'сержант';}
if($crew_user['rang'] == 3){$rang = 'старшина';}
if($crew_user['rang'] == 4){$rang = 'младший лейтенант';}
if($crew_user['rang'] == 5){$rang = 'лейтенант';}
if($crew_user['rang'] == 6){$rang = 'старший лейтенант';}
if($crew_user['rang'] == 7){$rang = 'капитан';}
if($crew_user['rang'] == 8){$rang = 'майор';}
if($crew_user['rang'] == 9){$rang = 'подполковник';}
if($crew_user['rang'] == 10){$rang = 'полковник';}

echo '<span class="small">звание: '.$rang.'</span><br>';
echo '<span class="small">'.$text.'</span><br></div></div>';

$prog = round(100/($crewpoints/($crew_user['crewpoints']+0.0001)));
if($prog > 100) {$prog = 100;}
if($crew_user['rang'] < 10){
echo '<table class="rblock blue esmall mb5"><tbody><tr>
<td><div class="value-block lh1"><span><span>'.$crewp.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$prog.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$crewpoints.'</span></span></div></td>
</tr></tbody></table>';

if($crew_user['crewpoints']<$crewpoints){
echo '<div class="bot"><table><tbody><tr>
<td class="w50 pl1"><a class="simple-but border mb5" href="?app_crewpoints'.$crew_user['crewpoints'].''.$crew_user['id'].'"><span><span>Обучение за <img class="ico vm" src="/images/icons/crewpoints.png" alt="Опыт экипажа" title="Опыт экипажа"> '.$cost_crewp.'</span></span></a></td>
<td class="w50 pr1"><a class="simple-but border mb5" href="?app_gold'.$crew_user['crewpoints'].''.$crew_user['id'].'"><span><span>Обучение за <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.$price.'</span></span></a></td>
</tr></tbody></table></div>';
}else{
if($crew_user['rang']<4){
echo '<div class="bot"><a class="simple-but border mb5" href="?app_rang'.$crew_user['rang'].''.$crew_user['id'].'"><span><span>Повысить звание за <img class="ico vm" src="/images/icons/silver.png" alt="Серебро" title="Серебро"> '.$cost_app.'</span></span></a></div>';
}else{
echo '<div class="bot"><a class="simple-but border mb5" href="?app_rang'.$crew_user['rang'].''.$crew_user['id'].'"><span><span>Повысить звание за <img class="ico vm" src="/images/icons/gold.png" alt="Золото" title="Золото"> '.$cost_app.'</span></span></a></div>';
}
}
}else{
echo '<div class="bot"><a class="simple-but gray  border mb5"><span><span>Максимально</span></span></a></div>';
}
}

echo '</div></div></div></div></div></div></div></div></div></div>';
}




if(isset($_GET['app_crewpoints'.$crew_user['crewpoints'].''.$crew_user['id'].''])){ // ПРОКАЧКА ЭКИПАЖА
if($crew_user['rang'] >= 10){header('Location: ?');exit();}
if($crew_user['crewpoints'] >= $crewpoints){header('Location: ?');exit();}
if($ammunition_users['crewpoints']<=0){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/crewpoints.png" alt="Опыт экипажа" title="Опыт экипажа"> очков экипажа</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
if($ammunition_users['crewpoints'] < $cost_crewp){ // если на балансе меньше чем 100

if(($crew_user['crewpoints']+$ammunition_users['crewpoints']) > $crewpoints){ // если в сумме (баланс оэ+баланс экипажа) больше чем необходимо для полной прокачки экипажа, то прокачиваем на необходимое до максимума число и отнимаем сколько необходимо было до максимальной прокачки
$mysqli->query('UPDATE `ammunition_users` SET `crewpoints` = "'.($ammunition_users['crewpoints']-($crewpoints-$crew_user['crewpoints'])).'" WHERE `id` = '.$ammunition_users['id'].' LIMIT 1');
$mysqli->query('UPDATE `crew_user` SET `crewpoints` = '.$crewpoints.' WHERE `id` = '.$crew_user['id'].' LIMIT 1');
####################################################################################
$mysqli->query('UPDATE `missions_user` SET `prog` = `prog` + "'.$crewpoints.'" WHERE `user` = '.$user['id'].' and `id_miss` = "6" and `prog` < "100" and `time` < "'.time().'" limit 1');
$res = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `id_miss` = "6" limit 1');
$miss = $res->fetch_assoc();
if($miss['prog']>=100 and $miss['time']<time()){$_SESSION['miss'] = 1;}
####################################################################################

####################################################################################
if($traning['rang']>=3 and $user['level']>=7){
$mysqli->query('UPDATE `missions_user` SET `prog` = `prog` + "'.$crewpoints.'" WHERE `user` = '.$user['id'].' and `id_miss` = "22" and `prog` < "1000" and `time` < "'.time().'" limit 1');
$res = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `id_miss` = "22" limit 1');
$miss = $res->fetch_assoc();
if($miss['prog']>=1000 and $miss['time']<time()){$_SESSION['miss'] = 1;}
}
####################################################################################
}else{
$mysqli->query('UPDATE `crew_user` SET `crewpoints` = '.($crew_user['crewpoints']+$ammunition_users['crewpoints']).' WHERE `id` = '.$crew_user['id'].' LIMIT 1');
$mysqli->query('UPDATE `ammunition_users` SET `crewpoints` = "0" WHERE `id` = '.$ammunition_users['id'].' LIMIT 1');
####################################################################################
$mysqli->query('UPDATE `missions_user` SET `prog` = `prog` + "'.$ammunition_users['crewpoints'].'" WHERE `user` = '.$user['id'].' and `id_miss` = "6" and `prog` < "100" and `time` < "'.time().'" limit 1');
$res = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `id_miss` = "6" limit 1');
$miss = $res->fetch_assoc();
if($miss['prog']>=100 and $miss['time']<time()){$_SESSION['miss'] = 1;}
####################################################################################

####################################################################################
if($traning['rang']>=3 and $user['level']>=7){
$mysqli->query('UPDATE `missions_user` SET `prog` = `prog` + "'.$ammunition_users['crewpoints'].'" WHERE `user` = '.$user['id'].' and `id_miss` = "22" and `prog` < "1000" and `time` < "'.time().'" limit 1');
$res = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `id_miss` = "22" limit 1');
$miss = $res->fetch_assoc();
if($miss['prog']>=1000 and $miss['time']<time()){$_SESSION['miss'] = 1;}
}
####################################################################################
}
}else{ // если на балансе больше чем 100
if(($crew_user['crewpoints']+$cost_crewp) > $crewpoints){ // если в сумме (100+баланс экипажа) больше чем необходимо для полной прокачки экипажа, то прокачиваем на необходимое до максимума число и отнимаем сколько необходимо было до максимальной прокачки
$mysqli->query('UPDATE `ammunition_users` SET `crewpoints` = "'.($ammunition_users['crewpoints']-($crewpoints-$crew_user['crewpoints'])).'" WHERE `id` = '.$ammunition_users['id'].' LIMIT 1');
$mysqli->query('UPDATE `crew_user` SET `crewpoints` = '.$crewpoints.' WHERE `id` = '.$crew_user['id'].' LIMIT 1');
####################################################################################
$mysqli->query('UPDATE `missions_user` SET `prog` = `prog` + "'.$crewpoints.'" WHERE `user` = '.$user['id'].' and `id_miss` = "6" and `prog` < "100" and `time` < "'.time().'" limit 1');
$res = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `id_miss` = "6" limit 1');
$miss = $res->fetch_assoc();
if($miss['prog']>=100 and $miss['time']<time()){$_SESSION['miss'] = 1;}
####################################################################################

####################################################################################
if($traning['rang']>=3 and $user['level']>=7){
$mysqli->query('UPDATE `missions_user` SET `prog` = `prog` + "'.$crewpoints.'" WHERE `user` = '.$user['id'].' and `id_miss` = "22" and `prog` < "1000" and `time` < "'.time().'" limit 1');
$res = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `id_miss` = "22" limit 1');
$miss = $res->fetch_assoc();
if($miss['prog']>=1000 and $miss['time']<time()){$_SESSION['miss'] = 1;}
}
####################################################################################
}else{
$mysqli->query('UPDATE `crew_user` SET `crewpoints` = '.($crew_user['crewpoints']+$cost_crewp).' WHERE `id` = '.$crew_user['id'].' LIMIT 1');
$mysqli->query('UPDATE `ammunition_users` SET `crewpoints` = "'.($ammunition_users['crewpoints']-$cost_crewp).'" WHERE `id` = '.$ammunition_users['id'].' LIMIT 1');
####################################################################################
$mysqli->query('UPDATE `missions_user` SET `prog` = `prog` + "'.$cost_crewp.'" WHERE `user` = '.$user['id'].' and `id_miss` = "6" and `prog` < "100" and `time` < "'.time().'" limit 1');
$res = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `id_miss` = "6" limit 1');
$miss = $res->fetch_assoc();
if($miss['prog']>=100 and $miss['time']<time()){$_SESSION['miss'] = 1;}
####################################################################################

####################################################################################
if($traning['rang']>=3 and $user['level']>=7){
$mysqli->query('UPDATE `missions_user` SET `prog` = `prog` + "'.$cost_crewp.'" WHERE `user` = '.$user['id'].' and `id_miss` = "22" and `prog` < "1000" and `time` < "'.time().'" limit 1');
$res = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `id_miss` = "22" limit 1');
$miss = $res->fetch_assoc();
if($miss['prog']>=1000 and $miss['time']<time()){$_SESSION['miss'] = 1;}
}
####################################################################################
}
}

$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="green1 sh_b mb2"><img height="14" width="14" src="/images/icons/victory.png"> '.$crew['name'].' обучен <img height="14" width="14" src="/images/icons/victory.png"></div>
</div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}











if(isset($_GET['app_gold'.$crew_user['crewpoints'].''.$crew_user['id'].''])){ // ПРОКАЧКА ЭКИПАЖА
if($crew_user['rang'] >= 10){header('Location: ?');exit();}
if($crew_user['crewpoints'] >= $crewpoints){header('Location: ?');exit();}
if($user['gold'] < $price){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($price-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
if(($crew_user['crewpoints']+$cost_crewp) > $crewpoints){ // если в сумме (100+баланс экипажа) больше чем необходимо для полной прокачки экипажа, то прокачиваем на необходимое до максимума число и отнимаем сколько необходимо было до максимальной прокачки
$mysqli->query('UPDATE `crew_user` SET `crewpoints` = '.$crewpoints.' WHERE `id` = '.$crew_user['id'].' LIMIT 1');
####################################################################################
$mysqli->query('UPDATE `missions_user` SET `prog` = `prog` + "'.$crewpoints.'" WHERE `user` = '.$user['id'].' and `id_miss` = "6" and `prog` < "100" and `time` < "'.time().'" limit 1');
$res = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `id_miss` = "6" limit 1');
$miss = $res->fetch_assoc();
if($miss['prog']>=100 and $miss['time']<time()){$_SESSION['miss'] = 1;}
####################################################################################

####################################################################################
if($traning['rang']>=3 and $user['level']>=7){
$mysqli->query('UPDATE `missions_user` SET `prog` = `prog` + "'.$crewpoints.'" WHERE `user` = '.$user['id'].' and `id_miss` = "22" and `prog` < "1000" and `time` < "'.time().'" limit 1');
$res = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `id_miss` = "22" limit 1');
$miss = $res->fetch_assoc();
if($miss['prog']>=1000 and $miss['time']<time()){$_SESSION['miss'] = 1;}
}
####################################################################################
}else{
$mysqli->query('UPDATE `crew_user` SET `crewpoints` = '.($crew_user['crewpoints']+$cost_crewp).' WHERE `id` = '.$crew_user['id'].' LIMIT 1');
####################################################################################
$mysqli->query('UPDATE `missions_user` SET `prog` = `prog` + "'.$cost_crewp.'" WHERE `user` = '.$user['id'].' and `id_miss` = "6" and `prog` < "100" and `time` < "'.time().'" limit 1');
$res = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `id_miss` = "6" limit 1');
$miss = $res->fetch_assoc();
if($miss['prog']>=100 and $miss['time']<time()){$_SESSION['miss'] = 1;}
####################################################################################

####################################################################################
if($traning['rang']>=3 and $user['level']>=7){
$mysqli->query('UPDATE `missions_user` SET `prog` = `prog` + "'.$cost_crewp.'" WHERE `user` = '.$user['id'].' and `id_miss` = "22" and `prog` < "1000" and `time` < "'.time().'" limit 1');
$res = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `id_miss` = "22" limit 1');
$miss = $res->fetch_assoc();
if($miss['prog']>=1000 and $miss['time']<time()){$_SESSION['miss'] = 1;}
}
####################################################################################
}
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$price).' WHERE `id` = '.$user['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="green1 sh_b mb2"><img height="14" width="14" src="/images/icons/victory.png"> '.$crew['name'].' обучен <img height="14" width="14" src="/images/icons/victory.png"></div>
</div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}



if(isset($_GET['app_rang'.$crew_user['rang'].''.$crew_user['id'].''])){ // ПОВЫШЕНИЕ ЭКИПАЖА
if($crew_user['rang'] >= 10){header('Location: ?');exit();}
if($crew_user['crewpoints'] < $crewpoints){header('Location: ?');exit();}
#######
if($crew_user['tip']==1){if($crew_user['rang']>=1 && $crew_user['rang']<=1){$sposobn = 10;}if($crew_user['rang']>=2 && $crew_user['rang']<=5){$sposobn = 5;}if($crew_user['rang']>5 && $crew_user['rang']<=7){$sposobn = 10;}if($crew_user['rang']>7 && $crew_user['rang']<=8){$sposobn = 20;}if($crew_user['rang']>8 && $crew_user['rang']<=9){$sposobn = 30;}}
if($crew_user['tip']==2){if($crew_user['rang']==1){$sposobn = 30;}if($crew_user['rang']>=2 && $crew_user['rang']<=5){$sposobn = 15;}if($crew_user['rang']>5 && $crew_user['rang']<=7){$sposobn = 30;}if($crew_user['rang']>7 && $crew_user['rang']<=8){$sposobn = 60;}if($crew_user['rang']>8 && $crew_user['rang']<=9){$sposobn = 90;}}
//echo ''.$sposobn.'';
if($crew_user['tip']>=3){if($crew_user['rang']>=1 && $crew_user['rang']<=2){$sposobn = 3;}if($crew_user['rang']==3){$sposobn = 4;}if($crew_user['rang']>3 && $crew_user['rang']<=7){$sposobn = 5;}if($crew_user['rang']>7 && $crew_user['rang']<=8){$sposobn = 20;}if($crew_user['rang']>8 && $crew_user['rang']<=9){$sposobn = 50;}}
#######

if($crew_user['rang']<4){
if($user['silver'] < $cost_app){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.($cost_app-$user['silver']).' серебра</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']-$cost_app).' WHERE `id` = '.$user['id'].' LIMIT 1');
}else{
if($user['gold'] < $cost_app){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_app-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$cost_app).' WHERE `id` = '.$user['id'].' LIMIT 1');
}

$mysqli->query('UPDATE `crew_user` SET `crewpoints` = "0", `rang` = "'.($crew_user['rang']+1).'", `sposobn` = "'.($crew_user['sposobn']+$sposobn).'" WHERE `id` = '.$crew_user['id'].' LIMIT 1');
if($user['company']!=0){$mysqli->query('UPDATE `company` SET `lvl_crew` = `lvl_crew` + "1" WHERE `id` = '.$user['company'].' LIMIT 1');}

$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user`  = "'.$user['id'].'" and `active`  = "1" LIMIT 1');
$users_tanks = $res->fetch_assoc();
if($crew_user['tip']==3 or $crew_user['tip']==4){
$mysqli->query('UPDATE `users_tanks` SET `t` = '.($users_tanks['t']+$sposobn).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
}
if($crew_user['tip']==5 or $crew_user['tip']==6){
$mysqli->query('UPDATE `users_tanks` SET `a` = '.($users_tanks['a']+$sposobn).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
}
if($crew_user['tip']==7 or $crew_user['tip']==8){
$mysqli->query('UPDATE `users_tanks` SET `b` = '.($users_tanks['b']+$sposobn).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
}
if($crew_user['tip']==9 or $crew_user['tip']==10){
$mysqli->query('UPDATE `users_tanks` SET `p` = '.($users_tanks['p']+$sposobn).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
}

$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="green1 sh_b mb2"><img height="14" width="14" src="/images/icons/victory.png"> '.$crew['name'].' повышен в звании <img height="14" width="14" src="/images/icons/victory.png"></div>
</div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}



$cost_app = 10;

if(isset($_GET['act_new'.$crew['id'].''])){ // НАНЯТЬ НОВОГО ЧЛЕНА ЭКИПАЖА
if($crew_user){header('Location: ?');exit();}
if($user['gold'] < $cost_app){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_app-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-10).' WHERE `id` = '.$user['id'].' LIMIT 1');
$mysqli->query('INSERT INTO `crew_user` SET `user` = '.$user['id'].', `tip` = "'.$crew['id'].'", `sposobn` = "0", `rang` = "1" ');
$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="green1 sh_b mb2"><img height="14" width="14" src="/images/icons/victory.png"> '.$crew['name'].' успешно нанят <img height="14" width="14" src="/images/icons/victory.png"></div>
</div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}



}










}else{
echo '<div class="medium white bold cntr mb5">Экипаж '.nick($ank['id']).' '.$sum.' уровень</div>';
$max = 10;
$res11 = $mysqli->query("SELECT COUNT(*) FROM `crew` WHERE `id` ");
$k_post5 = $res11->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post5[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post5[0] = $start+1;
$res22 = $mysqli->query('SELECT * FROM `crew` WHERE `id` ORDER BY `id` asc LIMIT '.$start.','.$max.' ');
while ($crew = $res22->fetch_array()){
if($ank['level']>=$crew['level']){
$res33 = $mysqli->query('SELECT * FROM `crew_user` WHERE `user`  = "'.$ank['id'].'" and `tip`  = "'.$crew['id'].'" LIMIT 1');
$crew_user = $res33->fetch_assoc();
if($crew_user){
echo '<div class="trnt-block mb1"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/crew/'.$crew['id'].'.png" style="width:100%; border-radius: 9px;"><span class="mask2">&nbsp;</span></div><div class="ml58 small white sh_b bold"><span class="green2">'.$crew['name'].'</span><br>';

if($crew['id'] == 1){$text = '+'.$crew_user['sposobn'].'% к опыту дивизии';}
if($crew['id'] == 2){$text = '+'.$crew_user['sposobn'].' топлива ежедневно';}
if($crew['id'] == 3){$text = '+'.$crew_user['sposobn'].'к точности';}
if($crew['id'] == 4){$text = '+'.$crew_user['sposobn'].'к точности';}
if($crew['id'] == 5){$text = '+'.$crew_user['sposobn'].' к атаке';}
if($crew['id'] == 6){$text = '+'.$crew_user['sposobn'].' к атаке';}
if($crew['id'] == 7){$text = '+'.$crew_user['sposobn'].' к броне';}
if($crew['id'] == 8){$text = '+'.$crew_user['sposobn'].' к броне';}
if($crew['id'] == 9){$text = '+'.$crew_user['sposobn'].' к прочности';}
if($crew['id'] == 10){$text = '+'.$crew_user['sposobn'].' к прочности';}

if($crew_user['rang'] == 1){$rang = 'рядовой';}
if($crew_user['rang'] == 2){$rang = 'сержант';}
if($crew_user['rang'] == 3){$rang = 'старшина';}
if($crew_user['rang'] == 4){$rang = 'младший лейтенант';}
if($crew_user['rang'] == 5){$rang = 'лейтенант';}
if($crew_user['rang'] == 6){$rang = 'старший лейтенант';}
if($crew_user['rang'] == 7){$rang = 'капитан';}
if($crew_user['rang'] == 8){$rang = 'майор';}
if($crew_user['rang'] == 9){$rang = 'подполковник';}
if($crew_user['rang'] == 10){$rang = 'полковник';}


echo '<span class="small">звание: '.$rang.'</span><br>';
echo '<span class="small">'.$text.'</span><br></div>';

echo '<div class="clrb"></div></div>';
echo '</div></div></div></div></div></div></div></div></div></div>';
}
}
}
}





echo'<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">Уровень экипажа складывается из званий всего экипажа</div>
</div></div></div></div></div></div></div></div></div></div>';

if($ank['id']==$user['id']){
echo '<a class="simple-but border mb2" w:id="powerLink" href="/profile/'.$ank['id'].'/"><span><span>Назад</span></span></a>';
}elsE{
echo '<a class="simple-but border mb2" w:id="powerLink" href="/power/'.$ank['id'].'/"><span><span>Назад</span></span></a>';
}
require_once ('../system/footer.php');
?>