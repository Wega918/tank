<?php
$title = 'Апгрейд танка';
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

$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = '.$ank['id'].' and `active`  = "1" LIMIT 1');
$users_tanks = $res->fetch_assoc();
$res = $mysqli->query('SELECT * FROM `tanks` WHERE `id`  = "'.$users_tanks['tip'].'" LIMIT 1');
$tank = $res->fetch_assoc();


$res1 = $mysqli->query('SELECT * FROM `prom` WHERE `id` = "1" ');
$prom = $res1->fetch_assoc();


if($tank['tip'] == 1){$tip_tank = 'average';$tip_tank_ru = 'СРЕДНИЙ ТАНК';} // СТ
if($tank['tip'] == 2){$tip_tank = 'heavy';$tip_tank_ru = 'ТЯЖЕЛЫЙ ТАНК';} // ТТ
if($tank['tip'] == 3){$tip_tank = 'SAU';$tip_tank_ru = 'ПТ-САУ';} // САУ

if($tank['country'] == 'GERMANY'){$coun_tank = 'ГЕРМАНИЯ';$coun_tank_en = 'germany';$angar = 'bg_germany flag_short';}
if($tank['country'] == 'SSSR'){$coun_tank = 'СССР';$coun_tank_en = 'ussr';$angar = 'bg_ussr flag_short';}
if($tank['country'] == 'USA'){$coun_tank = 'США';$coun_tank_en = 'usa';$angar = 'bg_usa flag_short';}

if($ank['side'] == 1){$side = 'empire';}else{$side = 'federation';}

$sum_param = $users_tanks['a']+$users_tanks['b']+$users_tanks['t']+$users_tanks['p'];





echo '<div class="medium bold white cntr sh_b mb5"><div>'.$title.'</div></div>';




if($users_tanks['user']!=$user['id']){

$res = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$ank['id'].'" LIMIT 1');
$traning = $res->fetch_assoc();

if($ank['company']){
$res = $mysqli->query('SELECT * FROM `company` WHERE `id` = "'.$ank['company'].'" LIMIT 1');
$company = $res->fetch_assoc();
}

if($traning['rang']==1){$rang = 'Кадет';}
if($traning['rang']==2){$rang = 'Рядовой';}
if($traning['rang']==3){$rang = 'Сержан';}
if($traning['rang']==4){$rang = 'Лейтинант';}
if($traning['rang']==5){$rang = 'Старший лейтенант';}
if($traning['rang']==6){$rang = 'Капитан';}
if($traning['rang']==7){$rang = 'Майор';}
if($traning['rang']==8){$rang = 'Подполковник';}
if($traning['rang']==9){$rang = 'Полковник';}

$res = $mysqli->query('SELECT * FROM `avatars_user` WHERE `user` = "'.$ank['id'].'" and `act` = "1" ');
$ava_us_ = $res->fetch_assoc();

echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="imgtxt bshd wht btxt">
<div class="thumb fl"><img alt="avatar" src="/images/avatar/'.$ava_us_['images'].'" style="width:100%; border-radius: 9px;"><><span class="mask1">&nbsp;</span></div>
<div class="ml58 small white sh_b bold">
<span class="green2">'.nick($ank['id']).'</span>';
if($ank['company']!=0){echo ' (Дивизия <a href="/company/'.$ank['company'].'"><span class="green2">'.$company['name'].'</span></a>)';}
echo '<br>
<img src="/images/icons/victory.png"> Звание: <span>'.$rang.'</span><br>
<img src="/images/icons/exp.png"> Уровень: '.$ank['level'].'<br>
</div>
<div class="clrb"></div>
</div>
</div>
</div></div></div></div></div></div></div></div></div>';
}






echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content custombg '.$angar.'">';
echo '<div class="cntr small bold green2 pb5"><img src="/images/upgrades/starFull.png" height="14" width="14"> Танковая мощь: '.$sum_param.'</div>';
echo '<br><br><div class="cntr"><img class="tank-img" src="/images/tanks/'.$tip_tank.'/'.$tank['country'].'/'.$tank['name'].'.png" style="width:90%;"></div><br>';
echo '<center>
<div class="small bold va_m">
<img width="16" height="11" src="/images/flags/'.$coun_tank_en.'16x11.png"> <font size="1">Страна: <font color="green1" style="opacity:0.7;">'.$coun_tank.'</font></font>
<img width="20" height="20" src="/images/tanks/'.$tip_tank.'.png"><font size="1">Тип: <font color="green1" style="opacity:0.7;">'.$tip_tank_ru.'</font></font>
<img width="25" height="14" src="/images/tanks/'.$tip_tank.'/'.$tank['country'].'/'.$tank['name'].'.png"><font size="1">Танк: <font color="green1" style="opacity:0.7;">'.$tank['name'].'</font></font>
</div>
</center>';
echo '</div><div class="cntr"><div class="weapon-panel"><div class="wrp1"><div class="wrp2"><table><tbody><tr>';
echo '<td><div class="image"><div class="in"><center><img width="21" height="21" src="/images/attack1.png" title="Атака" alt="Атака" style="width: 21px;height: 21px;"></div><div class="mask" title="Атака">&nbsp;</div>
<div style="width:48; height:15; margin-top:3px; text-align:center; "><font size=2><span class="blue2">'.$users_tanks['a'].'</span></font></div></center></td>';
echo '<td><div class="image"><div class="in"><center><img src="/images/armor1.png" title="Броня" alt="Броня"></div><div class="mask" title="Броня">&nbsp;</div>
<div style="width:48; height:15; margin-top:3px; text-align:center; "><font size=2><span class="blue2">'.$users_tanks['b'].'</span></font></div></div></center></td>';
echo '<td><div class="image"><div class="in"><center><img width="21" height="21" src="/images/accuracy1.png" title="Точность" alt="Точность" style="width: 21px;height: 21px;"></div><div class="mask" title="Точность">&nbsp;</div>
<div style="width:48; height:15; margin-top:3px; text-align:center; "><font size=2><span class="blue2">'.$users_tanks['t'].'</span></font></div></div></center></td>';
echo '<td><div class="image"><div class="in"><center><img width="21" height="21" src="/images/durability1.png" title="Прочность" alt="Прочность" style="width: 21px;height: 21px;"></div><div class="mask" title="Прочность">&nbsp;</div>
<div style="width:48; height:15; margin-top:3px; text-align:center; "><font size=2><span class="blue2">'.$users_tanks['p'].'</span></font></div></div></center></td>';
echo '</tr></tbody></table></div></div></div></div>';
echo '</div></div></div></div></div></div></div></div></div>';












$res = $mysqli->query('SELECT * FROM `users_tanks_upgrade` WHERE `user` = '.$ank['id'].' and `tip_tank` = '.$tank['tip'].' LIMIT 1');
$users_tanks_upgrade = $res->fetch_assoc();

##############################################################################################################################
##############################################################################################################################
$users_tanks_upgrade_A = 5;
if($users_tanks_upgrade['1']==0){$cost_a = 100;}if($users_tanks_upgrade['1']==1){$cost_a = 50;}if($users_tanks_upgrade['1']==2){$cost_a = 200;}if($users_tanks_upgrade['1']==3){$cost_a = 100;}if($users_tanks_upgrade['1']==4){$cost_a = 400;}if($users_tanks_upgrade['1']==5){$cost_a = 200;}if($users_tanks_upgrade['1']==6){$cost_a = 800;}if($users_tanks_upgrade['1']==7){$cost_a = 400;}if($users_tanks_upgrade['1']==8){$cost_a = 1600;}if($users_tanks_upgrade['1']==9){$cost_a = 800;}


if($prom['time_10']>time()){$cost_a = ceil($cost_a-($cost_a*$prom['act_10']/100));}else{$cost_a = $cost_a;}


if(isset($_GET['act_a'.$users_tanks_upgrade['1'].''])){
if($users_tanks_upgrade['1'] >= 10){header('Location: ?');exit();}
if($users_tanks_upgrade['1']==1 or $users_tanks_upgrade['1']==3 or $users_tanks_upgrade['1']==5 or $users_tanks_upgrade['1']==7 or $users_tanks_upgrade['1']==9){
if($user['gold'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_a-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}else{
if($user['silver'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.($cost_a-$user['silver']).' серебра</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}
if(!$users_tanks_upgrade){
$mysqli->query('INSERT INTO `users_tanks_upgrade` SET `user` = '.$user['id'].', `1` = "1", `a` = '.$users_tanks_upgrade_A.', `tip_tank` = '.$tank['tip'].' ');
}else{
$mysqli->query('UPDATE `users_tanks_upgrade` SET `1` = '.($users_tanks_upgrade['1']+1).', `a` = '.($users_tanks_upgrade['a']+$users_tanks_upgrade_A).' WHERE `id` = '.$users_tanks_upgrade['id'].' LIMIT 1');
}
if($users_tanks_upgrade['1']==1 or $users_tanks_upgrade['1']==3 or $users_tanks_upgrade['1']==5 or $users_tanks_upgrade['1']==7 or $users_tanks_upgrade['1']==9){
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}else{
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}
$mysqli->query('UPDATE `users_tanks` SET `a` = '.($users_tanks['a']+$users_tanks_upgrade_A).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb2"><div class="medium bold cntr green1"><img height="14" width="14" src="/images/icons/victory.png"> Улучшена атака танка! <img height="14" width="14" src="/images/icons/victory.png"></div></div>';
header('Location: ?');
exit();
}
if($users_tanks_upgrade['1'] < 10 and $users_tanks['user']==$user['id']){$mb2 = '';}else{$mb2 = 'mb2';}
echo '<div class="trnt-block '.$mb2.'"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/slot/Gun.png" alt="Орудие" title="Орудие"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Орудие</span><br>
<img width="14" height="14" src="/images/attack1.png?1" alt="Атака" title="Атака"> Атака: '.($users_tanks_upgrade['1']*5).'';
if($users_tanks['user']==$user['id']){if($users_tanks_upgrade['1'] < 10){echo '<span class="green1">+'.$users_tanks_upgrade_A.'</span>';}}echo '<br>';
if($users_tanks_upgrade['1']<1){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['1']>=1 && $users_tanks_upgrade['1']<2){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['1']>=2){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['1']<3){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['1']>=3 && $users_tanks_upgrade['1']<4){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['1']>=4){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['1']<5){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['1']>=5 && $users_tanks_upgrade['1']<6){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['1']>=6){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['1']<7){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['1']>=7 && $users_tanks_upgrade['1']<8){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['1']>=8){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['1']<9){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['1']>=9 && $users_tanks_upgrade['1']<10){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['1']>=10){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
echo '</div><div class="clrb"></div></div>';
if($users_tanks['user']==$user['id']){
if($users_tanks_upgrade['1'] < 10){
if($users_tanks_upgrade['1']==1 or $users_tanks_upgrade['1']==3 or $users_tanks_upgrade['1']==5 or $users_tanks_upgrade['1']==7 or $users_tanks_upgrade['1']==9){
echo '<div class="bot"><a class="simple-but border mb5" href="?act_a'.$users_tanks_upgrade['1'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.$cost_a.'</span></span></a></div>';
}else{
echo '<div class="bot"><a class="simple-but border mb5" href="?act_a'.$users_tanks_upgrade['1'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.$cost_a.'</span></span></a></div>';
}
}
}
echo '</div></div></div></div></div></div></div></div></div></div>';
##############################################################################################################################
##############################################################################################################################


if($users_tanks_upgrade['1']>=2){
##############################################################################################################################
##############################################################################################################################
$users_tanks_upgrade_A = 5;
if($users_tanks_upgrade['2']==0){$cost_a = 100;}if($users_tanks_upgrade['2']==1){$cost_a = 50;}if($users_tanks_upgrade['2']==2){$cost_a = 200;}if($users_tanks_upgrade['2']==3){$cost_a = 100;}if($users_tanks_upgrade['2']==4){$cost_a = 400;}if($users_tanks_upgrade['2']==5){$cost_a = 200;}if($users_tanks_upgrade['2']==6){$cost_a = 800;}if($users_tanks_upgrade['2']==7){$cost_a = 400;}if($users_tanks_upgrade['2']==8){$cost_a = 1600;}if($users_tanks_upgrade['2']==9){$cost_a = 800;}

if($prom['time_10']>time()){$cost_a = ceil($cost_a-($cost_a*$prom['act_10']/100));}else{$cost_a = $cost_a;}


if(isset($_GET['act_b'.$users_tanks_upgrade['2'].''])){
if($users_tanks_upgrade['1']<2){header('Location: ?');exit();}
if($users_tanks_upgrade['2'] >= 10){header('Location: ?');exit();}
if($users_tanks_upgrade['2']==1 or $users_tanks_upgrade['2']==3 or $users_tanks_upgrade['2']==5 or $users_tanks_upgrade['2']==7 or $users_tanks_upgrade['2']==9){
if($user['gold'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_a-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}else{
if($user['silver'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.($cost_a-$user['silver']).' серебра</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}
if(!$users_tanks_upgrade){
$mysqli->query('INSERT INTO `users_tanks_upgrade` SET `user` = '.$user['id'].', `2` = "1", `b` = '.$users_tanks_upgrade_A.' ');
}else{
$mysqli->query('UPDATE `users_tanks_upgrade` SET `2` = '.($users_tanks_upgrade['2']+1).', `b` = '.($users_tanks_upgrade['b']+$users_tanks_upgrade_A).' WHERE `id` = '.$users_tanks_upgrade['id'].' LIMIT 1');
}
if($users_tanks_upgrade['2']==1 or $users_tanks_upgrade['2']==3 or $users_tanks_upgrade['2']==5 or $users_tanks_upgrade['2']==7 or $users_tanks_upgrade['2']==9){
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}else{
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}
$mysqli->query('UPDATE `users_tanks` SET `b` = '.($users_tanks['b']+$users_tanks_upgrade_A).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb2"><div class="medium bold cntr green1"><img height="14" width="14" src="/images/icons/victory.png"> Улучшена броня танка! <img height="14" width="14" src="/images/icons/victory.png"></div></div>';
header('Location: ?');
exit();
}
if($users_tanks_upgrade['2'] < 10 and $users_tanks['user']==$user['id']){$mb2 = '';}else{$mb2 = 'mb2';}
echo '<div class="trnt-block '.$mb2.'"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/slot/FragShield.png" alt="Противоосколочный подбой" title="Противоосколочный подбой"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Противоосколочный подбой</span><br>
<img width="14" height="14" src="/images/armor1.png?1" alt="Броня" title="Броня"> Броня: '.($users_tanks_upgrade['2']*5).'';
if($users_tanks['user']==$user['id']){if($users_tanks_upgrade['2'] < 10){echo '<span class="green1">+'.$users_tanks_upgrade_A.'</span>';}}echo '<br>';
if($users_tanks_upgrade['2']<1){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['2']>=1 && $users_tanks_upgrade['2']<2){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['2']>=2){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['2']<3){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['2']>=3 && $users_tanks_upgrade['2']<4){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['2']>=4){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['2']<5){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['2']>=5 && $users_tanks_upgrade['2']<6){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['2']>=6){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['2']<7){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['2']>=7 && $users_tanks_upgrade['2']<8){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['2']>=8){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['2']<9){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['2']>=9 && $users_tanks_upgrade['2']<10){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['2']>=10){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
echo '</div><div class="clrb"></div></div>';
if($users_tanks['user']==$user['id']){
if($users_tanks_upgrade['2'] < 10){
if($users_tanks_upgrade['2']==1 or $users_tanks_upgrade['2']==3 or $users_tanks_upgrade['2']==5 or $users_tanks_upgrade['2']==7 or $users_tanks_upgrade['2']==9){
echo '<div class="bot"><a class="simple-but border mb5" href="?act_b'.$users_tanks_upgrade['2'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.$cost_a.'</span></span></a></div>';
}else{
echo '<div class="bot"><a class="simple-but border mb5" href="?act_b'.$users_tanks_upgrade['2'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.$cost_a.'</span></span></a></div>';
}
}
}
echo '</div></div></div></div></div></div></div></div></div></div>';
##############################################################################################################################
##############################################################################################################################
}


if($users_tanks_upgrade['2']>=2){
##############################################################################################################################
##############################################################################################################################
$users_tanks_upgrade_A = 5;
if($users_tanks_upgrade['3']==0){$cost_a = 100;}if($users_tanks_upgrade['3']==1){$cost_a = 50;}if($users_tanks_upgrade['3']==2){$cost_a = 200;}if($users_tanks_upgrade['3']==3){$cost_a = 100;}if($users_tanks_upgrade['3']==4){$cost_a = 400;}if($users_tanks_upgrade['3']==5){$cost_a = 200;}if($users_tanks_upgrade['3']==6){$cost_a = 800;}if($users_tanks_upgrade['3']==7){$cost_a = 400;}if($users_tanks_upgrade['3']==8){$cost_a = 1600;}if($users_tanks_upgrade['3']==9){$cost_a = 800;}

if($prom['time_10']>time()){$cost_a = ceil($cost_a-($cost_a*$prom['act_10']/100));}else{$cost_a = $cost_a;}


if(isset($_GET['act_t'.$users_tanks_upgrade['3'].''])){
if($users_tanks_upgrade['2']<2){header('Location: ?');exit();}
if($users_tanks_upgrade['3'] >= 10){header('Location: ?');exit();}
if($users_tanks_upgrade['3']==1 or $users_tanks_upgrade['3']==3 or $users_tanks_upgrade['3']==5 or $users_tanks_upgrade['3']==7 or $users_tanks_upgrade['3']==9){
if($user['gold'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_a-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}else{
if($user['silver'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.($cost_a-$user['silver']).' серебра</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}
if(!$users_tanks_upgrade){
$mysqli->query('INSERT INTO `users_tanks_upgrade` SET `user` = '.$user['id'].', `3` = "1", `t` = '.$users_tanks_upgrade_A.' ');
}else{
$mysqli->query('UPDATE `users_tanks_upgrade` SET `3` = '.($users_tanks_upgrade['3']+1).', `t` = '.($users_tanks_upgrade['t']+$users_tanks_upgrade_A).' WHERE `id` = '.$users_tanks_upgrade['id'].' LIMIT 1');
}
if($users_tanks_upgrade['3']==1 or $users_tanks_upgrade['3']==3 or $users_tanks_upgrade['3']==5 or $users_tanks_upgrade['3']==7 or $users_tanks_upgrade['3']==9){
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}else{
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}
$mysqli->query('UPDATE `users_tanks` SET `t` = '.($users_tanks['t']+$users_tanks_upgrade_A).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb2"><div class="medium bold cntr green1"><img height="14" width="14" src="/images/icons/victory.png"> Улучшена точность танка! <img height="14" width="14" src="/images/icons/victory.png"></div></div>';
header('Location: ?');
exit();
}
if($users_tanks_upgrade['3'] < 10 and $users_tanks['user']==$user['id']){$mb2 = '';}else{$mb2 = 'mb2';}
echo '<div class="trnt-block '.$mb2.'"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/slot/Optronics.png" alt="Оптика" title="Оптика"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Оптика</span><br>
<img width="14" height="14" src="/images/accuracy1.png?1" alt="Точность" title="Точность"> Точность: '.($users_tanks_upgrade['3']*5).'';
if($users_tanks['user']==$user['id']){if($users_tanks_upgrade['3'] < 10){echo '<span class="green1">+'.$users_tanks_upgrade_A.'</span>';}}echo '<br>';
if($users_tanks_upgrade['3']<1){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['3']>=1 && $users_tanks_upgrade['3']<2){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['3']>=2){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['3']<3){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['3']>=3 && $users_tanks_upgrade['3']<4){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['3']>=4){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['3']<5){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['3']>=5 && $users_tanks_upgrade['3']<6){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['3']>=6){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['3']<7){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['3']>=7 && $users_tanks_upgrade['3']<8){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['3']>=8){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['3']<9){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['3']>=9 && $users_tanks_upgrade['3']<10){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['3']>=10){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
echo '</div><div class="clrb"></div></div>';
if($users_tanks['user']==$user['id']){
if($users_tanks_upgrade['3'] < 10){
if($users_tanks_upgrade['3']==1 or $users_tanks_upgrade['3']==3 or $users_tanks_upgrade['3']==5 or $users_tanks_upgrade['3']==7 or $users_tanks_upgrade['3']==9){
echo '<div class="bot"><a class="simple-but border mb5" href="?act_t'.$users_tanks_upgrade['3'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.$cost_a.'</span></span></a></div>';
}else{
echo '<div class="bot"><a class="simple-but border mb5" href="?act_t'.$users_tanks_upgrade['3'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.$cost_a.'</span></span></a></div>';
}
}
}
echo '</div></div></div></div></div></div></div></div></div></div>';
##############################################################################################################################
##############################################################################################################################
}


if($users_tanks_upgrade['3']>=2){
##############################################################################################################################
##############################################################################################################################
$users_tanks_upgrade_A = 5;
if($users_tanks_upgrade['4']==0){$cost_a = 100;}if($users_tanks_upgrade['4']==1){$cost_a = 50;}if($users_tanks_upgrade['4']==2){$cost_a = 200;}if($users_tanks_upgrade['4']==3){$cost_a = 100;}if($users_tanks_upgrade['4']==4){$cost_a = 400;}if($users_tanks_upgrade['4']==5){$cost_a = 200;}if($users_tanks_upgrade['4']==6){$cost_a = 800;}if($users_tanks_upgrade['4']==7){$cost_a = 400;}if($users_tanks_upgrade['4']==8){$cost_a = 1600;}if($users_tanks_upgrade['4']==9){$cost_a = 800;}

if($prom['time_10']>time()){$cost_a = ceil($cost_a-($cost_a*$prom['act_10']/100));}else{$cost_a = $cost_a;}


if(isset($_GET['act_p'.$users_tanks_upgrade['4'].''])){
if($users_tanks_upgrade['3']<2){header('Location: ?');exit();}
if($users_tanks_upgrade['4'] >= 10){header('Location: ?');exit();}
if($users_tanks_upgrade['4']==1 or $users_tanks_upgrade['4']==3 or $users_tanks_upgrade['4']==5 or $users_tanks_upgrade['4']==7 or $users_tanks_upgrade['4']==9){
if($user['gold'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_a-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}else{
if($user['silver'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.($cost_a-$user['silver']).' серебра</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}
if(!$users_tanks_upgrade){
$mysqli->query('INSERT INTO `users_tanks_upgrade` SET `user` = '.$user['id'].', `4` = "1", `p` = '.$users_tanks_upgrade_A.' ');
}else{
$mysqli->query('UPDATE `users_tanks_upgrade` SET `4` = '.($users_tanks_upgrade['4']+1).', `p` = '.($users_tanks_upgrade['p']+$users_tanks_upgrade_A).' WHERE `id` = '.$users_tanks_upgrade['id'].' LIMIT 1');
}
if($users_tanks_upgrade['4']==1 or $users_tanks_upgrade['4']==3 or $users_tanks_upgrade['4']==5 or $users_tanks_upgrade['4']==7 or $users_tanks_upgrade['4']==9){
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}else{
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}
$mysqli->query('UPDATE `users_tanks` SET `p` = '.($users_tanks['p']+$users_tanks_upgrade_A).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb2"><div class="medium bold cntr green1"><img height="14" width="14" src="/images/icons/victory.png"> Улучшена прочность танка! <img height="14" width="14" src="/images/icons/victory.png"></div></div>';
header('Location: ?');
exit();
}
if($users_tanks_upgrade['4'] < 10 and $users_tanks['user']==$user['id']){$mb2 = '';}else{$mb2 = 'mb2';}
echo '<div class="trnt-block '.$mb2.'"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/slot/Frame.png" alt="Корпус" title="Корпус"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Корпус</span><br>
<img width="14" height="14" src="/images/durability1.png?1" alt="Прочность" title="Прочность"> Прочность: '.($users_tanks_upgrade['4']*5).'';
if($users_tanks['user']==$user['id']){if($users_tanks_upgrade['4'] < 10){echo '<span class="green1">+'.$users_tanks_upgrade_A.'</span>';}}echo '<br>';
if($users_tanks_upgrade['4']<1){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['4']>=1 && $users_tanks_upgrade['4']<2){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['4']>=2){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['4']<3){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['4']>=3 && $users_tanks_upgrade['4']<4){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['4']>=4){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['4']<5){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['4']>=5 && $users_tanks_upgrade['4']<6){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['4']>=6){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['4']<7){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['4']>=7 && $users_tanks_upgrade['4']<8){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['4']>=8){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['4']<9){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['4']>=9 && $users_tanks_upgrade['4']<10){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['4']>=10){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
echo '</div><div class="clrb"></div></div>';
if($users_tanks['user']==$user['id']){
if($users_tanks_upgrade['4'] < 10){
if($users_tanks_upgrade['4']==1 or $users_tanks_upgrade['4']==3 or $users_tanks_upgrade['4']==5 or $users_tanks_upgrade['4']==7 or $users_tanks_upgrade['4']==9){
echo '<div class="bot"><a class="simple-but border mb5" href="?act_p'.$users_tanks_upgrade['4'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.$cost_a.'</span></span></a></div>';
}else{
echo '<div class="bot"><a class="simple-but border mb5" href="?act_p'.$users_tanks_upgrade['4'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.$cost_a.'</span></span></a></div>';
}
}
}
echo '</div></div></div></div></div></div></div></div></div></div>';
##############################################################################################################################
##############################################################################################################################
}





##############################################################################################################################
##############################################################################################################################
##############################################################################################################################
##############################################################################################################################
##############################################################################################################################
##############################################################################################################################
##############################################################################################################################
##############################################################################################################################
##############################################################################################################################
##############################################################################################################################





$res = $mysqli->query('SELECT * FROM `buildings_user` WHERE `tip` = "7" and `user` = '.$ank['id'].' LIMIT 1');
$buildings_user = $res->fetch_assoc();


if($users_tanks_upgrade['4']>=2 and $buildings_user['level']>=1){
##############################################################################################################################
##############################################################################################################################
$users_tanks_upgrade_A = 5;
if($users_tanks_upgrade['5']==0){$cost_a = 100;}if($users_tanks_upgrade['5']==1){$cost_a = 50;}if($users_tanks_upgrade['5']==2){$cost_a = 200;}if($users_tanks_upgrade['5']==3){$cost_a = 100;}if($users_tanks_upgrade['5']==4){$cost_a = 400;}if($users_tanks_upgrade['5']==5){$cost_a = 200;}if($users_tanks_upgrade['5']==6){$cost_a = 800;}if($users_tanks_upgrade['5']==7){$cost_a = 400;}if($users_tanks_upgrade['5']==8){$cost_a = 1600;}if($users_tanks_upgrade['5']==9){$cost_a = 800;}

if($prom['time_10']>time()){$cost_a = ceil($cost_a-($cost_a*$prom['act_10']/100));}else{$cost_a = $cost_a;}


if(isset($_GET['act_a1_'.$users_tanks_upgrade['5'].''])){
if($users_tanks_upgrade['4']<2 and $buildings_user['level']<1){header('Location: ?');exit();}
if($users_tanks_upgrade['5'] >= 10){header('Location: ?');exit();}
if($users_tanks_upgrade['5']==1 or $users_tanks_upgrade['5']==3 or $users_tanks_upgrade['5']==5 or $users_tanks_upgrade['5']==7 or $users_tanks_upgrade['5']==9){
if($user['gold'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_a-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}else{
if($user['silver'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.($cost_a-$user['silver']).' серебра</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}
if(!$users_tanks_upgrade){
$mysqli->query('INSERT INTO `users_tanks_upgrade` SET `user` = '.$user['id'].', `5` = "1", `a` = '.$users_tanks_upgrade_A.' ');
}else{
$mysqli->query('UPDATE `users_tanks_upgrade` SET `5` = '.($users_tanks_upgrade['5']+1).', `a` = '.($users_tanks_upgrade['a']+$users_tanks_upgrade_A).' WHERE `id` = '.$users_tanks_upgrade['id'].' LIMIT 1');
}
if($users_tanks_upgrade['5']==1 or $users_tanks_upgrade['5']==3 or $users_tanks_upgrade['5']==5 or $users_tanks_upgrade['5']==7 or $users_tanks_upgrade['5']==9){
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}else{
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}
$mysqli->query('UPDATE `users_tanks` SET `a` = '.($users_tanks['a']+$users_tanks_upgrade_A).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb2"><div class="medium bold cntr green1"><img height="14" width="14" src="/images/icons/victory.png"> Улучшена атака танка! <img height="14" width="14" src="/images/icons/victory.png"></div></div>';
header('Location: ?');
exit();
}
if($users_tanks_upgrade['5'] < 10){$mb2 = '';}else{$mb2 = 'mb2';}
echo '<div class="trnt-block '.$mb2.'"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/slot/GunRammer.png" alt="Орудийный досылатель" title="Орудийный досылатель"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Орудийный досылатель</span><br>
<img width="14" height="14" src="/images/attack1.png?1" alt="Атака" title="Атака"> Атака: '.($users_tanks_upgrade['5']*5).'';
if($users_tanks['user']==$user['id']){if($users_tanks_upgrade['5'] < 10){echo '<span class="green1">+'.$users_tanks_upgrade_A.'</span>';}}echo '<br>';
if($users_tanks_upgrade['5']<1){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['5']>=1 && $users_tanks_upgrade['5']<2){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['5']>=2){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['5']<3){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['5']>=3 && $users_tanks_upgrade['5']<4){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['5']>=4){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['5']<5){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['5']>=5 && $users_tanks_upgrade['5']<6){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['5']>=6){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['5']<7){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['5']>=7 && $users_tanks_upgrade['5']<8){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['5']>=8){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['5']<9){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['5']>=9 && $users_tanks_upgrade['5']<10){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['5']>=10){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
echo '</div><div class="clrb"></div></div>';
if($users_tanks['user']==$user['id']){
if($users_tanks_upgrade['5'] < 10){
if($users_tanks_upgrade['5']==1 or $users_tanks_upgrade['5']==3 or $users_tanks_upgrade['5']==5 or $users_tanks_upgrade['5']==7 or $users_tanks_upgrade['5']==9){
echo '<div class="bot"><a class="simple-but border mb5" href="?act_a1_'.$users_tanks_upgrade['5'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.$cost_a.'</span></span></a></div>';
}else{
echo '<div class="bot"><a class="simple-but border mb5" href="?act_a1_'.$users_tanks_upgrade['5'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.$cost_a.'</span></span></a></div>';
}
}
}
echo '</div></div></div></div></div></div></div></div></div></div>';
##############################################################################################################################
##############################################################################################################################
}






if($users_tanks_upgrade['5']>=2 and $buildings_user['level']>=2){
##############################################################################################################################
##############################################################################################################################
$users_tanks_upgrade_A = 5;
if($users_tanks_upgrade['6']==0){$cost_a = 100;}if($users_tanks_upgrade['6']==1){$cost_a = 50;}if($users_tanks_upgrade['6']==2){$cost_a = 200;}if($users_tanks_upgrade['6']==3){$cost_a = 100;}if($users_tanks_upgrade['6']==4){$cost_a = 400;}if($users_tanks_upgrade['6']==5){$cost_a = 200;}if($users_tanks_upgrade['6']==6){$cost_a = 800;}if($users_tanks_upgrade['6']==7){$cost_a = 400;}if($users_tanks_upgrade['6']==8){$cost_a = 1600;}if($users_tanks_upgrade['6']==9){$cost_a = 800;}

if($prom['time_10']>time()){$cost_a = ceil($cost_a-($cost_a*$prom['act_10']/100));}else{$cost_a = $cost_a;}


if(isset($_GET['act_b1_'.$users_tanks_upgrade['6'].''])){
if($users_tanks_upgrade['5']<2 and $buildings_user['level']<2){header('Location: ?');exit();}
if($users_tanks_upgrade['6'] >= 10){header('Location: ?');exit();}
if($users_tanks_upgrade['6']==1 or $users_tanks_upgrade['6']==3 or $users_tanks_upgrade['6']==5 or $users_tanks_upgrade['6']==7 or $users_tanks_upgrade['6']==9){
if($user['gold'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_a-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}else{
if($user['silver'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.($cost_a-$user['silver']).' серебра</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}
if(!$users_tanks_upgrade){
$mysqli->query('INSERT INTO `users_tanks_upgrade` SET `user` = '.$user['id'].', `6` = "1", `b` = '.$users_tanks_upgrade_A.' ');
}else{
$mysqli->query('UPDATE `users_tanks_upgrade` SET `6` = '.($users_tanks_upgrade['6']+1).', `b` = '.($users_tanks_upgrade['b']+$users_tanks_upgrade_A).' WHERE `id` = '.$users_tanks_upgrade['id'].' LIMIT 1');
}
if($users_tanks_upgrade['6']==1 or $users_tanks_upgrade['6']==3 or $users_tanks_upgrade['6']==5 or $users_tanks_upgrade['6']==7 or $users_tanks_upgrade['6']==9){
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}else{
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}
$mysqli->query('UPDATE `users_tanks` SET `b` = '.($users_tanks['b']+$users_tanks_upgrade_A).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb2"><div class="medium bold cntr green1"><img height="14" width="14" src="/images/icons/victory.png"> Улучшена броня танка! <img height="14" width="14" src="/images/icons/victory.png"></div></div>';
header('Location: ?');
exit();
}
if($users_tanks_upgrade['6'] < 10){$mb2 = '';}else{$mb2 = 'mb2';}
echo '<div class="trnt-block '.$mb2.'"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/slot/SlopedArmour.png" alt="Наклонная броня" title="Наклонная броня"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Наклонная броня</span><br>
<img width="14" height="14" src="/images/armor1.png?1" alt="Броня" title="Броня"> Броня: '.($users_tanks_upgrade['6']*5).'';
if($users_tanks['user']==$user['id']){if($users_tanks_upgrade['6'] < 10){echo '<span class="green1">+'.$users_tanks_upgrade_A.'</span>';}}echo '<br>';
if($users_tanks_upgrade['6']<1){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['6']>=1 && $users_tanks_upgrade['6']<2){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['6']>=2){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['6']<3){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['6']>=3 && $users_tanks_upgrade['6']<4){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['6']>=4){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['6']<5){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['6']>=5 && $users_tanks_upgrade['6']<6){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['6']>=6){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['6']<7){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['6']>=7 && $users_tanks_upgrade['6']<8){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['6']>=8){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['6']<9){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['6']>=9 && $users_tanks_upgrade['6']<10){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['6']>=10){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
echo '</div><div class="clrb"></div></div>';
if($users_tanks['user']==$user['id']){
if($users_tanks_upgrade['6'] < 10){
if($users_tanks_upgrade['6']==1 or $users_tanks_upgrade['6']==3 or $users_tanks_upgrade['6']==5 or $users_tanks_upgrade['6']==7 or $users_tanks_upgrade['6']==9){
echo '<div class="bot"><a class="simple-but border mb5" href="?act_b1_'.$users_tanks_upgrade['6'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.$cost_a.'</span></span></a></div>';
}else{
echo '<div class="bot"><a class="simple-but border mb5" href="?act_b1_'.$users_tanks_upgrade['6'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.$cost_a.'</span></span></a></div>';
}
}
}
echo '</div></div></div></div></div></div></div></div></div></div>';
##############################################################################################################################
##############################################################################################################################
}









if($users_tanks_upgrade['6']>=2 and $buildings_user['level']>=3){
##############################################################################################################################
##############################################################################################################################
$users_tanks_upgrade_A = 5;
if($users_tanks_upgrade['7']==0){$cost_a = 100;}if($users_tanks_upgrade['7']==1){$cost_a = 50;}if($users_tanks_upgrade['7']==2){$cost_a = 200;}if($users_tanks_upgrade['7']==3){$cost_a = 100;}if($users_tanks_upgrade['7']==4){$cost_a = 400;}if($users_tanks_upgrade['7']==5){$cost_a = 200;}if($users_tanks_upgrade['7']==6){$cost_a = 800;}if($users_tanks_upgrade['7']==7){$cost_a = 400;}if($users_tanks_upgrade['7']==8){$cost_a = 1600;}if($users_tanks_upgrade['7']==9){$cost_a = 800;}

if($prom['time_10']>time()){$cost_a = ceil($cost_a-($cost_a*$prom['act_10']/100));}else{$cost_a = $cost_a;}


if(isset($_GET['act_t1_'.$users_tanks_upgrade['7'].''])){
if($users_tanks_upgrade['6']<2 and $buildings_user['level']<3){header('Location: ?');exit();}
if($users_tanks_upgrade['7'] >= 10){header('Location: ?');exit();}
if($users_tanks_upgrade['7']==1 or $users_tanks_upgrade['7']==3 or $users_tanks_upgrade['7']==5 or $users_tanks_upgrade['7']==7 or $users_tanks_upgrade['7']==9){
if($user['gold'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_a-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}else{
if($user['silver'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.($cost_a-$user['silver']).' серебра</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}
if(!$users_tanks_upgrade){
$mysqli->query('INSERT INTO `users_tanks_upgrade` SET `user` = '.$user['id'].', `7` = "1", `t` = '.$users_tanks_upgrade_A.' ');
}else{
$mysqli->query('UPDATE `users_tanks_upgrade` SET `7` = '.($users_tanks_upgrade['7']+1).', `t` = '.($users_tanks_upgrade['t']+$users_tanks_upgrade_A).' WHERE `id` = '.$users_tanks_upgrade['id'].' LIMIT 1');
}
if($users_tanks_upgrade['7']==1 or $users_tanks_upgrade['7']==3 or $users_tanks_upgrade['7']==5 or $users_tanks_upgrade['7']==7 or $users_tanks_upgrade['7']==9){
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}else{
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}
$mysqli->query('UPDATE `users_tanks` SET `t` = '.($users_tanks['t']+$users_tanks_upgrade_A).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb2"><div class="medium bold cntr green1"><img height="14" width="14" src="/images/icons/victory.png"> Улучшена точность танка! <img height="14" width="14" src="/images/icons/victory.png"></div></div>';
header('Location: ?');
exit();
}
if($users_tanks_upgrade['7'] < 10){$mb2 = '';}else{$mb2 = 'mb2';}
echo '<div class="trnt-block '.$mb2.'"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/slot/Stereoscope.png" alt="Стереотруба" title="Стереотруба"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Стереотруба</span><br>
<img width="14" height="14" src="/images/accuracy1.png?1" alt="Точность" title="Точность"> Точность: '.($users_tanks_upgrade['7']*5).'';
if($users_tanks['user']==$user['id']){if($users_tanks_upgrade['7'] < 10){echo '<span class="green1">+'.$users_tanks_upgrade_A.'</span>';}}echo '<br>';
if($users_tanks_upgrade['7']<1){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['7']>=1 && $users_tanks_upgrade['7']<2){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['7']>=2){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['7']<3){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['7']>=3 && $users_tanks_upgrade['7']<4){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['7']>=4){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['7']<5){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['7']>=5 && $users_tanks_upgrade['7']<6){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['7']>=6){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['7']<7){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['7']>=7 && $users_tanks_upgrade['7']<8){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['7']>=8){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['7']<9){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['7']>=9 && $users_tanks_upgrade['7']<10){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['7']>=10){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
echo '</div><div class="clrb"></div></div>';
if($users_tanks['user']==$user['id']){
if($users_tanks_upgrade['7'] < 10){
if($users_tanks_upgrade['7']==1 or $users_tanks_upgrade['7']==3 or $users_tanks_upgrade['7']==5 or $users_tanks_upgrade['7']==7 or $users_tanks_upgrade['7']==9){
echo '<div class="bot"><a class="simple-but border mb5" href="?act_t1_'.$users_tanks_upgrade['7'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.$cost_a.'</span></span></a></div>';
}else{
echo '<div class="bot"><a class="simple-but border mb5" href="?act_t1_'.$users_tanks_upgrade['7'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.$cost_a.'</span></span></a></div>';
}
}
}
echo '</div></div></div></div></div></div></div></div></div></div>';
##############################################################################################################################
##############################################################################################################################
}




if($users_tanks_upgrade['7']>=2 and $buildings_user['level']>=4){
##############################################################################################################################
##############################################################################################################################
$users_tanks_upgrade_A = 5;
if($users_tanks_upgrade['8']==0){$cost_a = 100;}if($users_tanks_upgrade['8']==1){$cost_a = 50;}if($users_tanks_upgrade['8']==2){$cost_a = 200;}if($users_tanks_upgrade['8']==3){$cost_a = 100;}if($users_tanks_upgrade['8']==4){$cost_a = 400;}if($users_tanks_upgrade['8']==5){$cost_a = 200;}if($users_tanks_upgrade['8']==6){$cost_a = 800;}if($users_tanks_upgrade['8']==7){$cost_a = 400;}if($users_tanks_upgrade['8']==8){$cost_a = 1600;}if($users_tanks_upgrade['8']==9){$cost_a = 800;}

if($prom['time_10']>time()){$cost_a = ceil($cost_a-($cost_a*$prom['act_10']/100));}else{$cost_a = $cost_a;}


if(isset($_GET['act_p1_'.$users_tanks_upgrade['8'].''])){
if($users_tanks_upgrade['7']<2 and $buildings_user['level']<4){header('Location: ?');exit();}
if($users_tanks_upgrade['8'] >= 10){header('Location: ?');exit();}
if($users_tanks_upgrade['8']==1 or $users_tanks_upgrade['8']==3 or $users_tanks_upgrade['8']==5 or $users_tanks_upgrade['8']==7 or $users_tanks_upgrade['8']==9){
if($user['gold'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_a-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}else{
if($user['silver'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.($cost_a-$user['silver']).' серебра</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}
if(!$users_tanks_upgrade){
$mysqli->query('INSERT INTO `users_tanks_upgrade` SET `user` = '.$user['id'].', `8` = "1", `p` = '.$users_tanks_upgrade_A.' ');
}else{
$mysqli->query('UPDATE `users_tanks_upgrade` SET `8` = '.($users_tanks_upgrade['8']+1).', `p` = '.($users_tanks_upgrade['p']+$users_tanks_upgrade_A).' WHERE `id` = '.$users_tanks_upgrade['id'].' LIMIT 1');
}
if($users_tanks_upgrade['8']==1 or $users_tanks_upgrade['8']==3 or $users_tanks_upgrade['8']==5 or $users_tanks_upgrade['8']==7 or $users_tanks_upgrade['8']==9){
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}else{
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}
$mysqli->query('UPDATE `users_tanks` SET `p` = '.($users_tanks['p']+$users_tanks_upgrade_A).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb2"><div class="medium bold cntr green1"><img height="14" width="14" src="/images/icons/victory.png"> Улучшена прочность танка! <img height="14" width="14" src="/images/icons/victory.png"></div></div>';
header('Location: ?');
exit();
}
if($users_tanks_upgrade['8'] < 10){$mb2 = '';}else{$mb2 = 'mb2';}
echo '<div class="trnt-block '.$mb2.'"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/slot/ShellBoxCover.png" alt="Защита боеукладки" title="Защита боеукладки"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Защита боеукладки</span><br>
<img width="14" height="14" src="/images/durability1.png?1" alt="Прочность" title="Прочность"> Прочность: '.($users_tanks_upgrade['8']*5).'';
if($users_tanks['user']==$user['id']){if($users_tanks_upgrade['8'] < 10){echo '<span class="green1">+'.$users_tanks_upgrade_A.'</span>';}}echo '<br>';
if($users_tanks_upgrade['8']<1){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['8']>=1 && $users_tanks_upgrade['8']<2){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['8']>=2){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['8']<3){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['8']>=3 && $users_tanks_upgrade['8']<4){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['8']>=4){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['8']<5){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['8']>=5 && $users_tanks_upgrade['8']<6){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['8']>=6){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['8']<7){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['8']>=7 && $users_tanks_upgrade['8']<8){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['8']>=8){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_upgrade['8']<9){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_upgrade['8']>=9 && $users_tanks_upgrade['8']<10){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_upgrade['8']>=10){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
echo '</div><div class="clrb"></div></div>';
if($users_tanks['user']==$user['id']){
if($users_tanks_upgrade['8'] < 10){
if($users_tanks_upgrade['8']==1 or $users_tanks_upgrade['8']==3 or $users_tanks_upgrade['8']==5 or $users_tanks_upgrade['8']==7 or $users_tanks_upgrade['8']==9){
echo '<div class="bot"><a class="simple-but border mb5" href="?act_p1_'.$users_tanks_upgrade['8'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.$cost_a.'</span></span></a></div>';
}else{
echo '<div class="bot"><a class="simple-but border mb5" href="?act_p1_'.$users_tanks_upgrade['8'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.$cost_a.'</span></span></a></div>';
}
}
}
echo '</div></div></div></div></div></div></div></div></div></div>';
##############################################################################################################################
##############################################################################################################################
}





echo'<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">Улучшай параметры танка, чтобы повысить танковую мощь!</div>
</div></div></div></div></div></div></div></div></div>
</div>
<a class="simple-but border mb2" w:id="powerLink" href="/power/'.$ank['id'].'/"><span><span>Назад</span></span></a>';
require_once ('../system/footer.php');
?>