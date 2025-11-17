<?php
$title = 'Улучшения танка';
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












$res = $mysqli->query('SELECT * FROM `users_tanks_pimp` WHERE `user` = '.$ank['id'].' and `tip_tank` = '.$tank['tip'].' LIMIT 1');
$users_tanks_pimp = $res->fetch_assoc();

##############################################################################################################################
##############################################################################################################################
if($users_tanks_pimp['1']==0){$users_tanks_pimp_A = 0;}if($users_tanks_pimp['1']==1){$users_tanks_pimp_A = 1;}if($users_tanks_pimp['1']==2){$users_tanks_pimp_A = 4;}if($users_tanks_pimp['1']==3){$users_tanks_pimp_A = 6;}if($users_tanks_pimp['1']==4){$users_tanks_pimp_A = 10;}if($users_tanks_pimp['1']==5){$users_tanks_pimp_A = 11;}if($users_tanks_pimp['1']==6){$users_tanks_pimp_A = 14;}if($users_tanks_pimp['1']==7){$users_tanks_pimp_A = 16;}if($users_tanks_pimp['1']==8){$users_tanks_pimp_A = 20;}if($users_tanks_pimp['1']==9){$users_tanks_pimp_A = 21;}if($users_tanks_pimp['1']==10){$users_tanks_pimp_A = 24;}if($users_tanks_pimp['1']==11){$users_tanks_pimp_A = 26;}if($users_tanks_pimp['1']==12){$users_tanks_pimp_A = 30;}if($users_tanks_pimp['1']==13){$users_tanks_pimp_A = 31;}if($users_tanks_pimp['1']==14){$users_tanks_pimp_A = 34;}if($users_tanks_pimp['1']==15){$users_tanks_pimp_A = 36;}if($users_tanks_pimp['1']==16){$users_tanks_pimp_A = 40;}if($users_tanks_pimp['1']==17){$users_tanks_pimp_A = 41;}if($users_tanks_pimp['1']==18){$users_tanks_pimp_A = 44;}if($users_tanks_pimp['1']==19){$users_tanks_pimp_A = 46;}if($users_tanks_pimp['1']==20){$users_tanks_pimp_A = 50;}if($users_tanks_pimp['1']==21){$users_tanks_pimp_A = 51;}if($users_tanks_pimp['1']==22){$users_tanks_pimp_A = 54;}if($users_tanks_pimp['1']==23){$users_tanks_pimp_A = 56;}if($users_tanks_pimp['1']==24){$users_tanks_pimp_A = 60;}if($users_tanks_pimp['1']==25){$users_tanks_pimp_A = 61;}if($users_tanks_pimp['1']==26){$users_tanks_pimp_A = 64;}if($users_tanks_pimp['1']==27){$users_tanks_pimp_A = 66;}if($users_tanks_pimp['1']==28){$users_tanks_pimp_A = 70;}if($users_tanks_pimp['1']==29){$users_tanks_pimp_A = 71;}if($users_tanks_pimp['1']==30){$users_tanks_pimp_A = 74;}if($users_tanks_pimp['1']==31){$users_tanks_pimp_A = 76;}if($users_tanks_pimp['1']==32){$users_tanks_pimp_A = 80;}if($users_tanks_pimp['1']==33){$users_tanks_pimp_A = 81;}if($users_tanks_pimp['1']==34){$users_tanks_pimp_A = 84;}if($users_tanks_pimp['1']==35){$users_tanks_pimp_A = 86;}if($users_tanks_pimp['1']==36){$users_tanks_pimp_A = 90;}if($users_tanks_pimp['1']==37){$users_tanks_pimp_A = 91;}if($users_tanks_pimp['1']==38){$users_tanks_pimp_A = 94;}if($users_tanks_pimp['1']==39){$users_tanks_pimp_A = 96;}if($users_tanks_pimp['1']==40){$users_tanks_pimp_A = 100;}
if($users_tanks_pimp['1']==0){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['1']==1){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['1']==2){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['1']==3){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['1']==4){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['1']==5){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['1']==6){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['1']==7){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['1']==8){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['1']==9){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['1']==10){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['1']==11){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['1']==12){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['1']==13){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['1']==14){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['1']==15){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['1']==16){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['1']==17){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['1']==18){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['1']==19){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['1']==20){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['1']==21){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['1']==22){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['1']==23){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['1']==24){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['1']==25){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['1']==26){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['1']==27){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['1']==28){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['1']==29){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['1']==30){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['1']==31){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['1']==32){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['1']==33){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['1']==34){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['1']==35){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['1']==36){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['1']==37){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['1']==38){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['1']==39){$users_tanks_pimp_A_ = 4;}
if($users_tanks_pimp['1']==0){$cost_a = 6;}if($users_tanks_pimp['1']==1){$cost_a = 12;}if($users_tanks_pimp['1']==2){$cost_a = 15;}if($users_tanks_pimp['1']==3){$cost_a = 15;}if($users_tanks_pimp['1']==4){$cost_a = 18;}if($users_tanks_pimp['1']==5){$cost_a = 36;}if($users_tanks_pimp['1']==6){$cost_a = 45;}if($users_tanks_pimp['1']==7){$cost_a = 30;}if($users_tanks_pimp['1']==8){$cost_a = 30;}if($users_tanks_pimp['1']==9){$cost_a = 60;}if($users_tanks_pimp['1']==10){$cost_a = 75;}if($users_tanks_pimp['1']==11){$cost_a = 45;}if($users_tanks_pimp['1']==12){$cost_a = 42;}if($users_tanks_pimp['1']==13){$cost_a = 84;}if($users_tanks_pimp['1']==14){$cost_a = 105;}if($users_tanks_pimp['1']==15){$cost_a = 60;}if($users_tanks_pimp['1']==16){$cost_a = 54;}if($users_tanks_pimp['1']==17){$cost_a = 108;}if($users_tanks_pimp['1']==18){$cost_a = 135;}if($users_tanks_pimp['1']==19){$cost_a = 75;}if($users_tanks_pimp['1']==20){$cost_a = 90;}if($users_tanks_pimp['1']==21){$cost_a = 180;}if($users_tanks_pimp['1']==22){$cost_a = 225;}if($users_tanks_pimp['1']==23){$cost_a = 90;}if($users_tanks_pimp['1']==24){$cost_a = 120;}if($users_tanks_pimp['1']==25){$cost_a = 240;}if($users_tanks_pimp['1']==26){$cost_a = 300;}if($users_tanks_pimp['1']==27){$cost_a = 150;}if($users_tanks_pimp['1']==28){$cost_a = 150;}if($users_tanks_pimp['1']==29){$cost_a = 300;}if($users_tanks_pimp['1']==30){$cost_a = 375;}if($users_tanks_pimp['1']==31){$cost_a = 120;}if($users_tanks_pimp['1']==32){$cost_a = 180;}if($users_tanks_pimp['1']==33){$cost_a = 360;}if($users_tanks_pimp['1']==34){$cost_a = 450;}if($users_tanks_pimp['1']==35){$cost_a = 135;}if($users_tanks_pimp['1']==36){$cost_a = 240;}if($users_tanks_pimp['1']==37){$cost_a = 480;}if($users_tanks_pimp['1']==38){$cost_a = 600;}if($users_tanks_pimp['1']==39){$cost_a = 150;}


if($prom['time_9']>time()){$cost_a = ceil($cost_a-($cost_a*$prom['act_9']/100));}else{$cost_a = $cost_a;}


if(isset($_GET['act_a'.$users_tanks_pimp['1'].''])){
if($users_tanks_pimp['1'] >= 40){header('Location: ?');exit();}
if($users_tanks_pimp['1']==3 or $users_tanks_pimp['1']==7 or $users_tanks_pimp['1']==11 or $users_tanks_pimp['1']==15 or $users_tanks_pimp['1']==19 or $users_tanks_pimp['1']==23 or $users_tanks_pimp['1']==27 or $users_tanks_pimp['1']==31 or $users_tanks_pimp['1']==35 or $users_tanks_pimp['1']==39){
if($user['gold'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_a-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}else{
if($user['silver'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.($cost_a-$user['silver']).' серебра</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}
if(!$users_tanks_pimp){
$mysqli->query('INSERT INTO `users_tanks_pimp` SET `user` = '.$user['id'].', `1` = "1", `a` = '.$users_tanks_pimp_A_.', `tip_tank` = '.$tank['tip'].' ');
}else{
$mysqli->query('UPDATE `users_tanks_pimp` SET `1` = '.($users_tanks_pimp['1']+1).', `a` = '.($users_tanks_pimp['a']+$users_tanks_pimp_A_).' WHERE `id` = '.$users_tanks_pimp['id'].' LIMIT 1');
}
if($users_tanks_pimp['1']==3 or $users_tanks_pimp['1']==7 or $users_tanks_pimp['1']==11 or $users_tanks_pimp['1']==15 or $users_tanks_pimp['1']==19 or $users_tanks_pimp['1']==23 or $users_tanks_pimp['1']==27 or $users_tanks_pimp['1']==31 or $users_tanks_pimp['1']==35 or $users_tanks_pimp['1']==39){
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}else{
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}
$mysqli->query('UPDATE `users_tanks` SET `a` = '.($users_tanks['a']+$users_tanks_pimp_A_).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb2"><div class="medium bold cntr green1"><img height="14" width="14" src="/images/icons/victory.png"> Улучшена атака танка! <img height="14" width="14" src="/images/icons/victory.png"></div></div>';
header('Location: ?');
exit();
}
if($users_tanks_pimp['1'] < 40 and $users_tanks['user']==$user['id']){$mb2 = '';}else{$mb2 = 'mb2';}
echo '<div class="trnt-block '.$mb2.'"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/slot/Gun.png" alt="Орудие" title="Орудие"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Орудие</span><br>
<img width="14" height="14" src="/images/attack1.png?1" alt="Атака" title="Атака"> Атака: '.$users_tanks_pimp_A.'';
if($users_tanks['user']==$user['id']){if($users_tanks_pimp['1'] < 40){echo '<span class="green1">+'.$users_tanks_pimp_A_.'</span>';}}echo '<br>';
if($users_tanks_pimp['1']<4){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['1']>=4 && $users_tanks_pimp['1']<8){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['1']>=8){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['1']<12){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['1']>=12 && $users_tanks_pimp['1']<16){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['1']>=16){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['1']<20){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['1']>=20 && $users_tanks_pimp['1']<24){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['1']>=24){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['1']<28){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['1']>=28 && $users_tanks_pimp['1']<32){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['1']>=32){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['1']<36){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['1']>=36 && $users_tanks_pimp['1']<40){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['1']>=40){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
echo '</div><div class="clrb"></div></div>';
if($users_tanks['user']==$user['id']){
if($users_tanks_pimp['1'] < 40){
if($users_tanks_pimp['1']==3 or $users_tanks_pimp['1']==7 or $users_tanks_pimp['1']==11 or $users_tanks_pimp['1']==15 or $users_tanks_pimp['1']==19 or $users_tanks_pimp['1']==23 or $users_tanks_pimp['1']==27 or $users_tanks_pimp['1']==31 or $users_tanks_pimp['1']==35 or $users_tanks_pimp['1']==39){
echo '<div class="bot"><a class="simple-but border mb5" href="?act_a'.$users_tanks_pimp['1'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.$cost_a.'</span></span></a></div>';
}else{
echo '<div class="bot"><a class="simple-but border mb5" href="?act_a'.$users_tanks_pimp['1'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.$cost_a.'</span></span></a></div>';
}
}
}
echo '</div></div></div></div></div></div></div></div></div></div>';
##############################################################################################################################
##############################################################################################################################


if($users_tanks_pimp['1']>=7){
##############################################################################################################################
##############################################################################################################################
if($users_tanks_pimp['2']==0){$users_tanks_pimp_B = 0;}if($users_tanks_pimp['2']==1){$users_tanks_pimp_B = 1;}if($users_tanks_pimp['2']==2){$users_tanks_pimp_B = 4;}if($users_tanks_pimp['2']==3){$users_tanks_pimp_B = 6;}if($users_tanks_pimp['2']==4){$users_tanks_pimp_B = 10;}if($users_tanks_pimp['2']==5){$users_tanks_pimp_B = 11;}if($users_tanks_pimp['2']==6){$users_tanks_pimp_B = 14;}if($users_tanks_pimp['2']==7){$users_tanks_pimp_B = 16;}if($users_tanks_pimp['2']==8){$users_tanks_pimp_B = 20;}if($users_tanks_pimp['2']==9){$users_tanks_pimp_B = 21;}if($users_tanks_pimp['2']==10){$users_tanks_pimp_B = 24;}if($users_tanks_pimp['2']==11){$users_tanks_pimp_B = 26;}if($users_tanks_pimp['2']==12){$users_tanks_pimp_B = 30;}if($users_tanks_pimp['2']==13){$users_tanks_pimp_B = 31;}if($users_tanks_pimp['2']==14){$users_tanks_pimp_B = 34;}if($users_tanks_pimp['2']==15){$users_tanks_pimp_B = 36;}if($users_tanks_pimp['2']==16){$users_tanks_pimp_B = 40;}if($users_tanks_pimp['2']==17){$users_tanks_pimp_B = 41;}if($users_tanks_pimp['2']==18){$users_tanks_pimp_B = 44;}if($users_tanks_pimp['2']==19){$users_tanks_pimp_B = 46;}if($users_tanks_pimp['2']==20){$users_tanks_pimp_B = 50;}if($users_tanks_pimp['2']==21){$users_tanks_pimp_B = 51;}if($users_tanks_pimp['2']==22){$users_tanks_pimp_B = 54;}if($users_tanks_pimp['2']==23){$users_tanks_pimp_B = 56;}if($users_tanks_pimp['2']==24){$users_tanks_pimp_B = 60;}if($users_tanks_pimp['2']==25){$users_tanks_pimp_B = 61;}if($users_tanks_pimp['2']==26){$users_tanks_pimp_B = 64;}if($users_tanks_pimp['2']==27){$users_tanks_pimp_B = 66;}if($users_tanks_pimp['2']==28){$users_tanks_pimp_B = 70;}if($users_tanks_pimp['2']==29){$users_tanks_pimp_B = 71;}if($users_tanks_pimp['2']==30){$users_tanks_pimp_B = 74;}if($users_tanks_pimp['2']==31){$users_tanks_pimp_B = 76;}if($users_tanks_pimp['2']==32){$users_tanks_pimp_B = 80;}if($users_tanks_pimp['2']==33){$users_tanks_pimp_B = 81;}if($users_tanks_pimp['2']==34){$users_tanks_pimp_B = 84;}if($users_tanks_pimp['2']==35){$users_tanks_pimp_B = 86;}if($users_tanks_pimp['2']==36){$users_tanks_pimp_B = 90;}if($users_tanks_pimp['2']==37){$users_tanks_pimp_B = 91;}if($users_tanks_pimp['2']==38){$users_tanks_pimp_B = 94;}if($users_tanks_pimp['2']==39){$users_tanks_pimp_B = 96;}if($users_tanks_pimp['2']==40){$users_tanks_pimp_B = 100;}
if($users_tanks_pimp['2']==0){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['2']==1){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['2']==2){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['2']==3){$users_tanks_pimp_B_ = 4;}if($users_tanks_pimp['2']==4){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['2']==5){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['2']==6){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['2']==7){$users_tanks_pimp_B_ = 4;}if($users_tanks_pimp['2']==8){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['2']==9){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['2']==10){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['2']==11){$users_tanks_pimp_B_ = 4;}if($users_tanks_pimp['2']==12){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['2']==13){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['2']==14){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['2']==15){$users_tanks_pimp_B_ = 4;}if($users_tanks_pimp['2']==16){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['2']==17){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['2']==18){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['2']==19){$users_tanks_pimp_B_ = 4;}if($users_tanks_pimp['2']==20){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['2']==21){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['2']==22){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['2']==23){$users_tanks_pimp_B_ = 4;}if($users_tanks_pimp['2']==24){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['2']==25){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['2']==26){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['2']==27){$users_tanks_pimp_B_ = 4;}if($users_tanks_pimp['2']==28){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['2']==29){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['2']==30){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['2']==31){$users_tanks_pimp_B_ = 4;}if($users_tanks_pimp['2']==32){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['2']==33){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['2']==34){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['2']==35){$users_tanks_pimp_B_ = 4;}if($users_tanks_pimp['2']==36){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['2']==37){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['2']==38){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['2']==39){$users_tanks_pimp_B_ = 4;}
if($users_tanks_pimp['2']==0){$cost_a = 6;}if($users_tanks_pimp['2']==1){$cost_a = 12;}if($users_tanks_pimp['2']==2){$cost_a = 15;}if($users_tanks_pimp['2']==3){$cost_a = 15;}if($users_tanks_pimp['2']==4){$cost_a = 18;}if($users_tanks_pimp['2']==5){$cost_a = 36;}if($users_tanks_pimp['2']==6){$cost_a = 45;}if($users_tanks_pimp['2']==7){$cost_a = 30;}if($users_tanks_pimp['2']==8){$cost_a = 30;}if($users_tanks_pimp['2']==9){$cost_a = 60;}if($users_tanks_pimp['2']==10){$cost_a = 75;}if($users_tanks_pimp['2']==11){$cost_a = 45;}if($users_tanks_pimp['2']==12){$cost_a = 42;}if($users_tanks_pimp['2']==13){$cost_a = 84;}if($users_tanks_pimp['2']==14){$cost_a = 105;}if($users_tanks_pimp['2']==15){$cost_a = 60;}if($users_tanks_pimp['2']==16){$cost_a = 54;}if($users_tanks_pimp['2']==17){$cost_a = 108;}if($users_tanks_pimp['2']==18){$cost_a = 135;}if($users_tanks_pimp['2']==19){$cost_a = 75;}if($users_tanks_pimp['2']==20){$cost_a = 90;}if($users_tanks_pimp['2']==21){$cost_a = 180;}if($users_tanks_pimp['2']==22){$cost_a = 225;}if($users_tanks_pimp['2']==23){$cost_a = 90;}if($users_tanks_pimp['2']==24){$cost_a = 120;}if($users_tanks_pimp['2']==25){$cost_a = 240;}if($users_tanks_pimp['2']==26){$cost_a = 300;}if($users_tanks_pimp['2']==27){$cost_a = 150;}if($users_tanks_pimp['2']==28){$cost_a = 150;}if($users_tanks_pimp['2']==29){$cost_a = 300;}if($users_tanks_pimp['2']==30){$cost_a = 375;}if($users_tanks_pimp['2']==31){$cost_a = 120;}if($users_tanks_pimp['2']==32){$cost_a = 180;}if($users_tanks_pimp['2']==33){$cost_a = 360;}if($users_tanks_pimp['2']==34){$cost_a = 450;}if($users_tanks_pimp['2']==35){$cost_a = 135;}if($users_tanks_pimp['2']==36){$cost_a = 240;}if($users_tanks_pimp['2']==37){$cost_a = 480;}if($users_tanks_pimp['2']==38){$cost_a = 600;}if($users_tanks_pimp['2']==39){$cost_a = 150;}

if($prom['time_9']>time()){$cost_a = ceil($cost_a-($cost_a*$prom['act_9']/100));}else{$cost_a = $cost_a;}


if(isset($_GET['act_b'.$users_tanks_pimp['2'].''])){
if($users_tanks_pimp['1']<7){header('Location: ?');exit();}
if($users_tanks_pimp['2'] >= 40){header('Location: ?');exit();}
if($users_tanks_pimp['2']==3 or $users_tanks_pimp['2']==7 or $users_tanks_pimp['2']==11 or $users_tanks_pimp['2']==15 or $users_tanks_pimp['2']==19 or $users_tanks_pimp['2']==23 or $users_tanks_pimp['2']==27 or $users_tanks_pimp['2']==31 or $users_tanks_pimp['2']==35 or $users_tanks_pimp['2']==39){
if($user['gold'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_a-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}else{
if($user['silver'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.($cost_a-$user['silver']).' серебра</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}
if(!$users_tanks_pimp){
$mysqli->query('INSERT INTO `users_tanks_pimp` SET `user` = '.$user['id'].', `2` = "1", `b` = '.$users_tanks_pimp_B_.' ');
}else{
$mysqli->query('UPDATE `users_tanks_pimp` SET `2` = '.($users_tanks_pimp['2']+1).', `b` = '.($users_tanks_pimp['b']+$users_tanks_pimp_B_).' WHERE `id` = '.$users_tanks_pimp['id'].' LIMIT 1');
}
if($users_tanks_pimp['2']==3 or $users_tanks_pimp['2']==7 or $users_tanks_pimp['2']==11 or $users_tanks_pimp['2']==15 or $users_tanks_pimp['2']==19 or $users_tanks_pimp['2']==23 or $users_tanks_pimp['2']==27 or $users_tanks_pimp['2']==31 or $users_tanks_pimp['2']==35 or $users_tanks_pimp['2']==39){
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}else{
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}
$mysqli->query('UPDATE `users_tanks` SET `b` = '.($users_tanks['b']+$users_tanks_pimp_B_).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb2"><div class="medium bold cntr green1"><img height="14" width="14" src="/images/icons/victory.png"> Улучшена броня танка! <img height="14" width="14" src="/images/icons/victory.png"></div></div>';
header('Location: ?');
exit();
}
if($users_tanks_pimp['2'] < 40 and $users_tanks['user']==$user['id']){$mb2 = '';}else{$mb2 = 'mb2';}
echo '<div class="trnt-block '.$mb2.'"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/slot/FragShield.png" alt="Противоосколочный подбой" title="Противоосколочный подбой"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Противоосколочный подбой</span><br>
<img width="14" height="14" src="/images/armor1.png?1" alt="Броня" title="Броня"> Броня: '.$users_tanks_pimp_B.'';
if($users_tanks['user']==$user['id']){if($users_tanks_pimp['2'] < 40){echo '<span class="green1">+'.$users_tanks_pimp_B_.'</span>';}}echo '<br>';
if($users_tanks_pimp['2']<4){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['2']>=4 && $users_tanks_pimp['2']<8){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['2']>=8){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['2']<12){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['2']>=12 && $users_tanks_pimp['2']<16){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['2']>=16){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['2']<20){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['2']>=20 && $users_tanks_pimp['2']<24){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['2']>=24){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['2']<28){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['2']>=28 && $users_tanks_pimp['2']<32){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['2']>=32){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['2']<36){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['2']>=36 && $users_tanks_pimp['2']<40){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['2']>=40){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
echo '</div><div class="clrb"></div></div>';
if($users_tanks['user']==$user['id']){
if($users_tanks_pimp['2'] < 40){
if($users_tanks_pimp['2']==3 or $users_tanks_pimp['2']==7 or $users_tanks_pimp['2']==11 or $users_tanks_pimp['2']==15 or $users_tanks_pimp['2']==19 or $users_tanks_pimp['2']==23 or $users_tanks_pimp['2']==27 or $users_tanks_pimp['2']==31 or $users_tanks_pimp['2']==35 or $users_tanks_pimp['2']==39){
echo '<div class="bot"><a class="simple-but border mb5" href="?act_b'.$users_tanks_pimp['2'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.$cost_a.'</span></span></a></div>';
}else{
echo '<div class="bot"><a class="simple-but border mb5" href="?act_b'.$users_tanks_pimp['2'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.$cost_a.'</span></span></a></div>';
}
}
}
echo '</div></div></div></div></div></div></div></div></div></div>';
##############################################################################################################################
##############################################################################################################################
}


if($users_tanks_pimp['2']>=7){
##############################################################################################################################
##############################################################################################################################
if($users_tanks_pimp['3']==0){$users_tanks_pimp_B = 0;}if($users_tanks_pimp['3']==1){$users_tanks_pimp_B = 1;}if($users_tanks_pimp['3']==2){$users_tanks_pimp_B = 4;}if($users_tanks_pimp['3']==3){$users_tanks_pimp_B = 6;}if($users_tanks_pimp['3']==4){$users_tanks_pimp_B = 10;}if($users_tanks_pimp['3']==5){$users_tanks_pimp_B = 11;}if($users_tanks_pimp['3']==6){$users_tanks_pimp_B = 14;}if($users_tanks_pimp['3']==7){$users_tanks_pimp_B = 16;}if($users_tanks_pimp['3']==8){$users_tanks_pimp_B = 20;}if($users_tanks_pimp['3']==9){$users_tanks_pimp_B = 21;}if($users_tanks_pimp['3']==10){$users_tanks_pimp_B = 24;}if($users_tanks_pimp['3']==11){$users_tanks_pimp_B = 26;}if($users_tanks_pimp['3']==12){$users_tanks_pimp_B = 30;}if($users_tanks_pimp['3']==13){$users_tanks_pimp_B = 31;}if($users_tanks_pimp['3']==14){$users_tanks_pimp_B = 34;}if($users_tanks_pimp['3']==15){$users_tanks_pimp_B = 36;}if($users_tanks_pimp['3']==16){$users_tanks_pimp_B = 40;}if($users_tanks_pimp['3']==17){$users_tanks_pimp_B = 41;}if($users_tanks_pimp['3']==18){$users_tanks_pimp_B = 44;}if($users_tanks_pimp['3']==19){$users_tanks_pimp_B = 46;}if($users_tanks_pimp['3']==20){$users_tanks_pimp_B = 50;}if($users_tanks_pimp['3']==21){$users_tanks_pimp_B = 51;}if($users_tanks_pimp['3']==22){$users_tanks_pimp_B = 54;}if($users_tanks_pimp['3']==23){$users_tanks_pimp_B = 56;}if($users_tanks_pimp['3']==24){$users_tanks_pimp_B = 60;}if($users_tanks_pimp['3']==25){$users_tanks_pimp_B = 61;}if($users_tanks_pimp['3']==26){$users_tanks_pimp_B = 64;}if($users_tanks_pimp['3']==27){$users_tanks_pimp_B = 66;}if($users_tanks_pimp['3']==28){$users_tanks_pimp_B = 70;}if($users_tanks_pimp['3']==29){$users_tanks_pimp_B = 71;}if($users_tanks_pimp['3']==30){$users_tanks_pimp_B = 74;}if($users_tanks_pimp['3']==31){$users_tanks_pimp_B = 76;}if($users_tanks_pimp['3']==32){$users_tanks_pimp_B = 80;}if($users_tanks_pimp['3']==33){$users_tanks_pimp_B = 81;}if($users_tanks_pimp['3']==34){$users_tanks_pimp_B = 84;}if($users_tanks_pimp['3']==35){$users_tanks_pimp_B = 86;}if($users_tanks_pimp['3']==36){$users_tanks_pimp_B = 90;}if($users_tanks_pimp['3']==37){$users_tanks_pimp_B = 91;}if($users_tanks_pimp['3']==38){$users_tanks_pimp_B = 94;}if($users_tanks_pimp['3']==39){$users_tanks_pimp_B = 96;}if($users_tanks_pimp['3']==40){$users_tanks_pimp_B = 100;}
if($users_tanks_pimp['3']==0){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['3']==1){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['3']==2){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['3']==3){$users_tanks_pimp_B_ = 4;}if($users_tanks_pimp['3']==4){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['3']==5){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['3']==6){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['3']==7){$users_tanks_pimp_B_ = 4;}if($users_tanks_pimp['3']==8){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['3']==9){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['3']==10){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['3']==11){$users_tanks_pimp_B_ = 4;}if($users_tanks_pimp['3']==12){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['3']==13){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['3']==14){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['3']==15){$users_tanks_pimp_B_ = 4;}if($users_tanks_pimp['3']==16){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['3']==17){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['3']==18){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['3']==19){$users_tanks_pimp_B_ = 4;}if($users_tanks_pimp['3']==20){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['3']==21){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['3']==22){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['3']==23){$users_tanks_pimp_B_ = 4;}if($users_tanks_pimp['3']==24){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['3']==25){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['3']==26){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['3']==27){$users_tanks_pimp_B_ = 4;}if($users_tanks_pimp['3']==28){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['3']==29){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['3']==30){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['3']==31){$users_tanks_pimp_B_ = 4;}if($users_tanks_pimp['3']==32){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['3']==33){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['3']==34){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['3']==35){$users_tanks_pimp_B_ = 4;}if($users_tanks_pimp['3']==36){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['3']==37){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['3']==38){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['3']==39){$users_tanks_pimp_B_ = 4;}
if($users_tanks_pimp['3']==0){$cost_a = 6;}if($users_tanks_pimp['3']==1){$cost_a = 12;}if($users_tanks_pimp['3']==2){$cost_a = 15;}if($users_tanks_pimp['3']==3){$cost_a = 15;}if($users_tanks_pimp['3']==4){$cost_a = 18;}if($users_tanks_pimp['3']==5){$cost_a = 36;}if($users_tanks_pimp['3']==6){$cost_a = 45;}if($users_tanks_pimp['3']==7){$cost_a = 30;}if($users_tanks_pimp['3']==8){$cost_a = 30;}if($users_tanks_pimp['3']==9){$cost_a = 60;}if($users_tanks_pimp['3']==10){$cost_a = 75;}if($users_tanks_pimp['3']==11){$cost_a = 45;}if($users_tanks_pimp['3']==12){$cost_a = 42;}if($users_tanks_pimp['3']==13){$cost_a = 84;}if($users_tanks_pimp['3']==14){$cost_a = 105;}if($users_tanks_pimp['3']==15){$cost_a = 60;}if($users_tanks_pimp['3']==16){$cost_a = 54;}if($users_tanks_pimp['3']==17){$cost_a = 108;}if($users_tanks_pimp['3']==18){$cost_a = 135;}if($users_tanks_pimp['3']==19){$cost_a = 75;}if($users_tanks_pimp['3']==20){$cost_a = 90;}if($users_tanks_pimp['3']==21){$cost_a = 180;}if($users_tanks_pimp['3']==22){$cost_a = 225;}if($users_tanks_pimp['3']==23){$cost_a = 90;}if($users_tanks_pimp['3']==24){$cost_a = 120;}if($users_tanks_pimp['3']==25){$cost_a = 240;}if($users_tanks_pimp['3']==26){$cost_a = 300;}if($users_tanks_pimp['3']==27){$cost_a = 150;}if($users_tanks_pimp['3']==28){$cost_a = 150;}if($users_tanks_pimp['3']==29){$cost_a = 300;}if($users_tanks_pimp['3']==30){$cost_a = 375;}if($users_tanks_pimp['3']==31){$cost_a = 120;}if($users_tanks_pimp['3']==32){$cost_a = 180;}if($users_tanks_pimp['3']==33){$cost_a = 360;}if($users_tanks_pimp['3']==34){$cost_a = 450;}if($users_tanks_pimp['3']==35){$cost_a = 135;}if($users_tanks_pimp['3']==36){$cost_a = 240;}if($users_tanks_pimp['3']==37){$cost_a = 480;}if($users_tanks_pimp['3']==38){$cost_a = 600;}if($users_tanks_pimp['3']==39){$cost_a = 150;}

if($prom['time_9']>time()){$cost_a = ceil($cost_a-($cost_a*$prom['act_9']/100));}else{$cost_a = $cost_a;}


if(isset($_GET['act_t'.$users_tanks_pimp['3'].''])){
if($users_tanks_pimp['2']<7){header('Location: ?');exit();}
if($users_tanks_pimp['3'] >= 40){header('Location: ?');exit();}
if($users_tanks_pimp['3']==3 or $users_tanks_pimp['3']==7 or $users_tanks_pimp['3']==11 or $users_tanks_pimp['3']==15 or $users_tanks_pimp['3']==19 or $users_tanks_pimp['3']==23 or $users_tanks_pimp['3']==27 or $users_tanks_pimp['3']==31 or $users_tanks_pimp['3']==35 or $users_tanks_pimp['3']==39){
if($user['gold'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_a-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}else{
if($user['silver'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.($cost_a-$user['silver']).' серебра</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}
if(!$users_tanks_pimp){
$mysqli->query('INSERT INTO `users_tanks_pimp` SET `user` = '.$user['id'].', `3` = "1", `t` = '.$users_tanks_pimp_B_.' ');
}else{
$mysqli->query('UPDATE `users_tanks_pimp` SET `3` = '.($users_tanks_pimp['3']+1).', `t` = '.($users_tanks_pimp['t']+$users_tanks_pimp_B_).' WHERE `id` = '.$users_tanks_pimp['id'].' LIMIT 1');
}
if($users_tanks_pimp['3']==3 or $users_tanks_pimp['3']==7 or $users_tanks_pimp['3']==11 or $users_tanks_pimp['3']==15 or $users_tanks_pimp['3']==19 or $users_tanks_pimp['3']==23 or $users_tanks_pimp['3']==27 or $users_tanks_pimp['3']==31 or $users_tanks_pimp['3']==35 or $users_tanks_pimp['3']==39){
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}else{
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}
$mysqli->query('UPDATE `users_tanks` SET `t` = '.($users_tanks['t']+$users_tanks_pimp_B_).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb2"><div class="medium bold cntr green1"><img height="14" width="14" src="/images/icons/victory.png"> Улучшена точность танка! <img height="14" width="14" src="/images/icons/victory.png"></div></div>';
header('Location: ?');
exit();
}
if($users_tanks_pimp['3'] < 40 and $users_tanks['user']==$user['id']){$mb2 = '';}else{$mb2 = 'mb2';}
echo '<div class="trnt-block '.$mb2.'"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/slot/Optronics.png" alt="Оптика" title="Оптика"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Оптика</span><br>
<img width="14" height="14" src="/images/accuracy1.png?1" alt="Точность" title="Точность"> Точность: '.$users_tanks_pimp_B.'';
if($users_tanks['user']==$user['id']){if($users_tanks_pimp['3'] < 40){echo '<span class="green1">+'.$users_tanks_pimp_B_.'</span>';}}echo '<br>';
if($users_tanks_pimp['3']<4){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['3']>=4 && $users_tanks_pimp['3']<8){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['3']>=8){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['3']<12){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['3']>=12 && $users_tanks_pimp['3']<16){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['3']>=16){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['3']<20){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['3']>=20 && $users_tanks_pimp['3']<24){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['3']>=24){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['3']<28){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['3']>=28 && $users_tanks_pimp['3']<32){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['3']>=32){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['3']<36){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['3']>=36 && $users_tanks_pimp['3']<40){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['3']>=40){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
echo '</div><div class="clrb"></div></div>';
if($users_tanks['user']==$user['id']){
if($users_tanks_pimp['3'] < 40){
if($users_tanks_pimp['3']==3 or $users_tanks_pimp['3']==7 or $users_tanks_pimp['3']==11 or $users_tanks_pimp['3']==15 or $users_tanks_pimp['3']==19 or $users_tanks_pimp['3']==23 or $users_tanks_pimp['3']==27 or $users_tanks_pimp['3']==31 or $users_tanks_pimp['3']==35 or $users_tanks_pimp['3']==39){
echo '<div class="bot"><a class="simple-but border mb5" href="?act_t'.$users_tanks_pimp['3'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.$cost_a.'</span></span></a></div>';
}else{
echo '<div class="bot"><a class="simple-but border mb5" href="?act_t'.$users_tanks_pimp['3'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.$cost_a.'</span></span></a></div>';
}
}
}
echo '</div></div></div></div></div></div></div></div></div></div>';
##############################################################################################################################
##############################################################################################################################
}


if($users_tanks_pimp['3']>=7){
##############################################################################################################################
##############################################################################################################################
if($users_tanks_pimp['4']==0){$users_tanks_pimp_B = 0;}if($users_tanks_pimp['4']==1){$users_tanks_pimp_B = 1;}if($users_tanks_pimp['4']==2){$users_tanks_pimp_B = 4;}if($users_tanks_pimp['4']==3){$users_tanks_pimp_B = 6;}if($users_tanks_pimp['4']==4){$users_tanks_pimp_B = 10;}if($users_tanks_pimp['4']==5){$users_tanks_pimp_B = 11;}if($users_tanks_pimp['4']==6){$users_tanks_pimp_B = 14;}if($users_tanks_pimp['4']==7){$users_tanks_pimp_B = 16;}if($users_tanks_pimp['4']==8){$users_tanks_pimp_B = 20;}if($users_tanks_pimp['4']==9){$users_tanks_pimp_B = 21;}if($users_tanks_pimp['4']==10){$users_tanks_pimp_B = 24;}if($users_tanks_pimp['4']==11){$users_tanks_pimp_B = 26;}if($users_tanks_pimp['4']==12){$users_tanks_pimp_B = 30;}if($users_tanks_pimp['4']==13){$users_tanks_pimp_B = 31;}if($users_tanks_pimp['4']==14){$users_tanks_pimp_B = 34;}if($users_tanks_pimp['4']==15){$users_tanks_pimp_B = 36;}if($users_tanks_pimp['4']==16){$users_tanks_pimp_B = 40;}if($users_tanks_pimp['4']==17){$users_tanks_pimp_B = 41;}if($users_tanks_pimp['4']==18){$users_tanks_pimp_B = 44;}if($users_tanks_pimp['4']==19){$users_tanks_pimp_B = 46;}if($users_tanks_pimp['4']==20){$users_tanks_pimp_B = 50;}if($users_tanks_pimp['4']==21){$users_tanks_pimp_B = 51;}if($users_tanks_pimp['4']==22){$users_tanks_pimp_B = 54;}if($users_tanks_pimp['4']==23){$users_tanks_pimp_B = 56;}if($users_tanks_pimp['4']==24){$users_tanks_pimp_B = 60;}if($users_tanks_pimp['4']==25){$users_tanks_pimp_B = 61;}if($users_tanks_pimp['4']==26){$users_tanks_pimp_B = 64;}if($users_tanks_pimp['4']==27){$users_tanks_pimp_B = 66;}if($users_tanks_pimp['4']==28){$users_tanks_pimp_B = 70;}if($users_tanks_pimp['4']==29){$users_tanks_pimp_B = 71;}if($users_tanks_pimp['4']==30){$users_tanks_pimp_B = 74;}if($users_tanks_pimp['4']==31){$users_tanks_pimp_B = 76;}if($users_tanks_pimp['4']==32){$users_tanks_pimp_B = 80;}if($users_tanks_pimp['4']==33){$users_tanks_pimp_B = 81;}if($users_tanks_pimp['4']==34){$users_tanks_pimp_B = 84;}if($users_tanks_pimp['4']==35){$users_tanks_pimp_B = 86;}if($users_tanks_pimp['4']==36){$users_tanks_pimp_B = 90;}if($users_tanks_pimp['4']==37){$users_tanks_pimp_B = 91;}if($users_tanks_pimp['4']==38){$users_tanks_pimp_B = 94;}if($users_tanks_pimp['4']==39){$users_tanks_pimp_B = 96;}if($users_tanks_pimp['4']==40){$users_tanks_pimp_B = 100;}
if($users_tanks_pimp['4']==0){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['4']==1){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['4']==2){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['4']==3){$users_tanks_pimp_B_ = 4;}if($users_tanks_pimp['4']==4){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['4']==5){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['4']==6){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['4']==7){$users_tanks_pimp_B_ = 4;}if($users_tanks_pimp['4']==8){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['4']==9){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['4']==10){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['4']==11){$users_tanks_pimp_B_ = 4;}if($users_tanks_pimp['4']==12){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['4']==13){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['4']==14){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['4']==15){$users_tanks_pimp_B_ = 4;}if($users_tanks_pimp['4']==16){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['4']==17){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['4']==18){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['4']==19){$users_tanks_pimp_B_ = 4;}if($users_tanks_pimp['4']==20){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['4']==21){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['4']==22){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['4']==23){$users_tanks_pimp_B_ = 4;}if($users_tanks_pimp['4']==24){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['4']==25){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['4']==26){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['4']==27){$users_tanks_pimp_B_ = 4;}if($users_tanks_pimp['4']==28){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['4']==29){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['4']==30){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['4']==31){$users_tanks_pimp_B_ = 4;}if($users_tanks_pimp['4']==32){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['4']==33){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['4']==34){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['4']==35){$users_tanks_pimp_B_ = 4;}if($users_tanks_pimp['4']==36){$users_tanks_pimp_B_ = 1;}if($users_tanks_pimp['4']==37){$users_tanks_pimp_B_ = 3;}if($users_tanks_pimp['4']==38){$users_tanks_pimp_B_ = 2;}if($users_tanks_pimp['4']==39){$users_tanks_pimp_B_ = 4;}
if($users_tanks_pimp['4']==0){$cost_a = 6;}if($users_tanks_pimp['4']==1){$cost_a = 12;}if($users_tanks_pimp['4']==2){$cost_a = 15;}if($users_tanks_pimp['4']==3){$cost_a = 15;}if($users_tanks_pimp['4']==4){$cost_a = 18;}if($users_tanks_pimp['4']==5){$cost_a = 36;}if($users_tanks_pimp['4']==6){$cost_a = 45;}if($users_tanks_pimp['4']==7){$cost_a = 30;}if($users_tanks_pimp['4']==8){$cost_a = 30;}if($users_tanks_pimp['4']==9){$cost_a = 60;}if($users_tanks_pimp['4']==10){$cost_a = 75;}if($users_tanks_pimp['4']==11){$cost_a = 45;}if($users_tanks_pimp['4']==12){$cost_a = 42;}if($users_tanks_pimp['4']==13){$cost_a = 84;}if($users_tanks_pimp['4']==14){$cost_a = 105;}if($users_tanks_pimp['4']==15){$cost_a = 60;}if($users_tanks_pimp['4']==16){$cost_a = 54;}if($users_tanks_pimp['4']==17){$cost_a = 108;}if($users_tanks_pimp['4']==18){$cost_a = 135;}if($users_tanks_pimp['4']==19){$cost_a = 75;}if($users_tanks_pimp['4']==20){$cost_a = 90;}if($users_tanks_pimp['4']==21){$cost_a = 180;}if($users_tanks_pimp['4']==22){$cost_a = 225;}if($users_tanks_pimp['4']==23){$cost_a = 90;}if($users_tanks_pimp['4']==24){$cost_a = 120;}if($users_tanks_pimp['4']==25){$cost_a = 240;}if($users_tanks_pimp['4']==26){$cost_a = 300;}if($users_tanks_pimp['4']==27){$cost_a = 150;}if($users_tanks_pimp['4']==28){$cost_a = 150;}if($users_tanks_pimp['4']==29){$cost_a = 300;}if($users_tanks_pimp['4']==30){$cost_a = 375;}if($users_tanks_pimp['4']==31){$cost_a = 120;}if($users_tanks_pimp['4']==32){$cost_a = 180;}if($users_tanks_pimp['4']==33){$cost_a = 360;}if($users_tanks_pimp['4']==34){$cost_a = 450;}if($users_tanks_pimp['4']==35){$cost_a = 135;}if($users_tanks_pimp['4']==36){$cost_a = 240;}if($users_tanks_pimp['4']==37){$cost_a = 480;}if($users_tanks_pimp['4']==38){$cost_a = 600;}if($users_tanks_pimp['4']==39){$cost_a = 150;}

if($prom['time_9']>time()){$cost_a = ceil($cost_a-($cost_a*$prom['act_9']/100));}else{$cost_a = $cost_a;}


if(isset($_GET['act_p'.$users_tanks_pimp['4'].''])){
if($users_tanks_pimp['3']<7){header('Location: ?');exit();}
if($users_tanks_pimp['4'] >= 40){header('Location: ?');exit();}
if($users_tanks_pimp['4']==3 or $users_tanks_pimp['4']==7 or $users_tanks_pimp['4']==11 or $users_tanks_pimp['4']==15 or $users_tanks_pimp['4']==19 or $users_tanks_pimp['4']==23 or $users_tanks_pimp['4']==27 or $users_tanks_pimp['4']==31 or $users_tanks_pimp['4']==35 or $users_tanks_pimp['4']==39){
if($user['gold'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_a-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}else{
if($user['silver'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.($cost_a-$user['silver']).' серебра</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}
if(!$users_tanks_pimp){
$mysqli->query('INSERT INTO `users_tanks_pimp` SET `user` = '.$user['id'].', `4` = "1", `p` = '.$users_tanks_pimp_B_.' ');
}else{
$mysqli->query('UPDATE `users_tanks_pimp` SET `4` = '.($users_tanks_pimp['4']+1).', `p` = '.($users_tanks_pimp['p']+$users_tanks_pimp_B_).' WHERE `id` = '.$users_tanks_pimp['id'].' LIMIT 1');
}
if($users_tanks_pimp['4']==3 or $users_tanks_pimp['4']==7 or $users_tanks_pimp['4']==11 or $users_tanks_pimp['4']==15 or $users_tanks_pimp['4']==19 or $users_tanks_pimp['4']==23 or $users_tanks_pimp['4']==27 or $users_tanks_pimp['4']==31 or $users_tanks_pimp['4']==35 or $users_tanks_pimp['4']==39){
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}else{
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}
$mysqli->query('UPDATE `users_tanks` SET `p` = '.($users_tanks['p']+$users_tanks_pimp_B_).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb2"><div class="medium bold cntr green1"><img height="14" width="14" src="/images/icons/victory.png"> Улучшена прочность танка! <img height="14" width="14" src="/images/icons/victory.png"></div></div>';
header('Location: ?');
exit();
}
if($users_tanks_pimp['4'] < 40 and $users_tanks['user']==$user['id']){$mb2 = '';}else{$mb2 = 'mb2';}
echo '<div class="trnt-block '.$mb2.'"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/slot/Frame.png" alt="Корпус" title="Корпус"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Корпус</span><br>
<img width="14" height="14" src="/images/durability1.png?1" alt="Прочность" title="Прочность"> Прочность: '.$users_tanks_pimp_B.'';
if($users_tanks['user']==$user['id']){if($users_tanks_pimp['4'] < 40){echo '<span class="green1">+'.$users_tanks_pimp_B_.'</span>';}}echo '<br>';
if($users_tanks_pimp['4']<4){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['4']>=4 && $users_tanks_pimp['4']<8){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['4']>=8){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['4']<12){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['4']>=12 && $users_tanks_pimp['4']<16){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['4']>=16){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['4']<20){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['4']>=20 && $users_tanks_pimp['4']<24){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['4']>=24){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['4']<28){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['4']>=28 && $users_tanks_pimp['4']<32){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['4']>=32){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['4']<36){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['4']>=36 && $users_tanks_pimp['4']<40){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['4']>=40){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
echo '</div><div class="clrb"></div></div>';
if($users_tanks['user']==$user['id']){
if($users_tanks_pimp['4'] < 40){
if($users_tanks_pimp['4']==3 or $users_tanks_pimp['4']==7 or $users_tanks_pimp['4']==11 or $users_tanks_pimp['4']==15 or $users_tanks_pimp['4']==19 or $users_tanks_pimp['4']==23 or $users_tanks_pimp['4']==27 or $users_tanks_pimp['4']==31 or $users_tanks_pimp['4']==35 or $users_tanks_pimp['4']==39){
echo '<div class="bot"><a class="simple-but border mb5" href="?act_p'.$users_tanks_pimp['4'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.$cost_a.'</span></span></a></div>';
}else{
echo '<div class="bot"><a class="simple-but border mb5" href="?act_p'.$users_tanks_pimp['4'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.$cost_a.'</span></span></a></div>';
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


if($users_tanks_pimp['4']>=7 and $buildings_user['level']>=1){
##############################################################################################################################
##############################################################################################################################
if($users_tanks_pimp['5']==0){$users_tanks_pimp_A = 0;}if($users_tanks_pimp['5']==1){$users_tanks_pimp_A = 1;}if($users_tanks_pimp['5']==2){$users_tanks_pimp_A = 4;}if($users_tanks_pimp['5']==3){$users_tanks_pimp_A = 6;}if($users_tanks_pimp['5']==4){$users_tanks_pimp_A = 10;}if($users_tanks_pimp['5']==5){$users_tanks_pimp_A = 11;}if($users_tanks_pimp['5']==6){$users_tanks_pimp_A = 14;}if($users_tanks_pimp['5']==7){$users_tanks_pimp_A = 16;}if($users_tanks_pimp['5']==8){$users_tanks_pimp_A = 20;}if($users_tanks_pimp['5']==9){$users_tanks_pimp_A = 21;}if($users_tanks_pimp['5']==10){$users_tanks_pimp_A = 24;}if($users_tanks_pimp['5']==11){$users_tanks_pimp_A = 26;}if($users_tanks_pimp['5']==12){$users_tanks_pimp_A = 30;}if($users_tanks_pimp['5']==13){$users_tanks_pimp_A = 31;}if($users_tanks_pimp['5']==14){$users_tanks_pimp_A = 34;}if($users_tanks_pimp['5']==15){$users_tanks_pimp_A = 36;}if($users_tanks_pimp['5']==16){$users_tanks_pimp_A = 40;}if($users_tanks_pimp['5']==17){$users_tanks_pimp_A = 41;}if($users_tanks_pimp['5']==18){$users_tanks_pimp_A = 44;}if($users_tanks_pimp['5']==19){$users_tanks_pimp_A = 46;}if($users_tanks_pimp['5']==20){$users_tanks_pimp_A = 50;}if($users_tanks_pimp['5']==21){$users_tanks_pimp_A = 51;}if($users_tanks_pimp['5']==22){$users_tanks_pimp_A = 54;}if($users_tanks_pimp['5']==23){$users_tanks_pimp_A = 56;}if($users_tanks_pimp['5']==24){$users_tanks_pimp_A = 60;}if($users_tanks_pimp['5']==25){$users_tanks_pimp_A = 61;}if($users_tanks_pimp['5']==26){$users_tanks_pimp_A = 64;}if($users_tanks_pimp['5']==27){$users_tanks_pimp_A = 66;}if($users_tanks_pimp['5']==28){$users_tanks_pimp_A = 70;}if($users_tanks_pimp['5']==29){$users_tanks_pimp_A = 71;}if($users_tanks_pimp['5']==30){$users_tanks_pimp_A = 74;}if($users_tanks_pimp['5']==31){$users_tanks_pimp_A = 76;}if($users_tanks_pimp['5']==32){$users_tanks_pimp_A = 80;}if($users_tanks_pimp['5']==33){$users_tanks_pimp_A = 81;}if($users_tanks_pimp['5']==34){$users_tanks_pimp_A = 84;}if($users_tanks_pimp['5']==35){$users_tanks_pimp_A = 86;}if($users_tanks_pimp['5']==36){$users_tanks_pimp_A = 90;}if($users_tanks_pimp['5']==37){$users_tanks_pimp_A = 91;}if($users_tanks_pimp['5']==38){$users_tanks_pimp_A = 94;}if($users_tanks_pimp['5']==39){$users_tanks_pimp_A = 96;}if($users_tanks_pimp['5']==40){$users_tanks_pimp_A = 100;}
if($users_tanks_pimp['5']==0){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['5']==1){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['5']==2){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['5']==3){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['5']==4){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['5']==5){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['5']==6){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['5']==7){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['5']==8){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['5']==9){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['5']==10){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['5']==11){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['5']==12){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['5']==13){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['5']==14){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['5']==15){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['5']==16){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['5']==17){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['5']==18){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['5']==19){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['5']==20){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['5']==21){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['5']==22){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['5']==23){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['5']==24){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['5']==25){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['5']==26){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['5']==27){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['5']==28){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['5']==29){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['5']==30){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['5']==31){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['5']==32){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['5']==33){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['5']==34){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['5']==35){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['5']==36){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['5']==37){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['5']==38){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['5']==39){$users_tanks_pimp_A_ = 4;}
if($users_tanks_pimp['5']==0){$cost_a = 300;}if($users_tanks_pimp['5']==1){$cost_a = 600;}if($users_tanks_pimp['5']==2){$cost_a = 750;}if($users_tanks_pimp['5']==3){$cost_a = 45;}if($users_tanks_pimp['5']==4){$cost_a = 450;}if($users_tanks_pimp['5']==5){$cost_a = 900;}if($users_tanks_pimp['5']==6){$cost_a = 1125;}if($users_tanks_pimp['5']==7){$cost_a = 90;}if($users_tanks_pimp['5']==8){$cost_a = 600;}if($users_tanks_pimp['5']==9){$cost_a = 1200;}if($users_tanks_pimp['5']==10){$cost_a = 1500;}if($users_tanks_pimp['5']==11){$cost_a = 135;}if($users_tanks_pimp['5']==12){$cost_a = 750;}if($users_tanks_pimp['5']==13){$cost_a = 1500;}if($users_tanks_pimp['5']==14){$cost_a = 1875;}if($users_tanks_pimp['5']==15){$cost_a = 180;}if($users_tanks_pimp['5']==16){$cost_a = 900;}if($users_tanks_pimp['5']==17){$cost_a = 1800;}if($users_tanks_pimp['5']==18){$cost_a = 2250;}if($users_tanks_pimp['5']==19){$cost_a = 225;}if($users_tanks_pimp['5']==20){$cost_a = 1200;}if($users_tanks_pimp['5']==21){$cost_a = 2400;}if($users_tanks_pimp['5']==22){$cost_a = 3000;}if($users_tanks_pimp['5']==23){$cost_a = 270;}if($users_tanks_pimp['5']==24){$cost_a = 1500;}if($users_tanks_pimp['5']==25){$cost_a = 3000;}if($users_tanks_pimp['5']==26){$cost_a = 3750;}if($users_tanks_pimp['5']==27){$cost_a = 315;}if($users_tanks_pimp['5']==28){$cost_a = 1800;}if($users_tanks_pimp['5']==29){$cost_a = 3600;}if($users_tanks_pimp['5']==30){$cost_a = 4500;}if($users_tanks_pimp['5']==31){$cost_a = 360;}if($users_tanks_pimp['5']==32){$cost_a = 2100;}if($users_tanks_pimp['5']==33){$cost_a = 4200;}if($users_tanks_pimp['5']==34){$cost_a = 5250;}if($users_tanks_pimp['5']==35){$cost_a = 405;}if($users_tanks_pimp['5']==36){$cost_a = 3000;}if($users_tanks_pimp['5']==37){$cost_a = 6000;}if($users_tanks_pimp['5']==38){$cost_a = 7500;}if($users_tanks_pimp['5']==39){$cost_a = 450;}

if($prom['time_9']>time()){$cost_a = ceil($cost_a-($cost_a*$prom['act_9']/100));}else{$cost_a = $cost_a;}


if(isset($_GET['act_a1'.$users_tanks_pimp['5'].''])){
if($users_tanks_pimp['4']<7 and $buildings_user['level']<1){header('Location: ?');exit();}
if($users_tanks_pimp['5'] >= 40){header('Location: ?');exit();}
if($users_tanks_pimp['5']==3 or $users_tanks_pimp['5']==7 or $users_tanks_pimp['5']==11 or $users_tanks_pimp['5']==15 or $users_tanks_pimp['5']==19 or $users_tanks_pimp['5']==23 or $users_tanks_pimp['5']==27 or $users_tanks_pimp['5']==31 or $users_tanks_pimp['5']==35 or $users_tanks_pimp['5']==39){
if($user['gold'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_a-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}else{
if($user['silver'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.($cost_a-$user['silver']).' серебра</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}
if(!$users_tanks_pimp){
$mysqli->query('INSERT INTO `users_tanks_pimp` SET `user` = '.$user['id'].', `5` = "1", `a` = '.$users_tanks_pimp_A_.' ');
}else{
$mysqli->query('UPDATE `users_tanks_pimp` SET `5` = '.($users_tanks_pimp['5']+1).', `a` = '.($users_tanks_pimp['a']+$users_tanks_pimp_A_).' WHERE `id` = '.$users_tanks_pimp['id'].' LIMIT 1');
}
if($users_tanks_pimp['5']==3 or $users_tanks_pimp['5']==7 or $users_tanks_pimp['5']==11 or $users_tanks_pimp['5']==15 or $users_tanks_pimp['5']==19 or $users_tanks_pimp['5']==23 or $users_tanks_pimp['5']==27 or $users_tanks_pimp['5']==31 or $users_tanks_pimp['5']==35 or $users_tanks_pimp['5']==39){
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}else{
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}
$mysqli->query('UPDATE `users_tanks` SET `a` = '.($users_tanks['a']+$users_tanks_pimp_A_).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb2"><div class="medium bold cntr green1"><img height="14" width="14" src="/images/icons/victory.png"> Улучшена атака танка! <img height="14" width="14" src="/images/icons/victory.png"></div></div>';
header('Location: ?');
exit();
}
if($users_tanks_pimp['5'] < 40){$mb2 = '';}else{$mb2 = 'mb2';}
echo '<div class="trnt-block '.$mb2.'"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/slot/GunRammer.png" alt="Орудийный досылатель" title="Орудийный досылатель"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Орудийный досылатель</span><br>
<img width="14" height="14" src="/images/attack1.png?1" alt="Атака" title="Атака"> Атака: '.$users_tanks_pimp_A.'';
if($users_tanks['user']==$user['id']){if($users_tanks_pimp['5'] < 40){echo '<span class="green1">+'.$users_tanks_pimp_A_.'</span>';}}echo '<br>';
if($users_tanks_pimp['5']<4){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['5']>=4 && $users_tanks_pimp['5']<8){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['5']>=8){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['5']<12){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['5']>=12 && $users_tanks_pimp['5']<16){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['5']>=16){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['5']<20){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['5']>=20 && $users_tanks_pimp['5']<24){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['5']>=24){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['5']<28){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['5']>=28 && $users_tanks_pimp['5']<32){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['5']>=32){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['5']<36){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['5']>=36 && $users_tanks_pimp['5']<40){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['5']>=40){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
echo '</div><div class="clrb"></div></div>';
if($users_tanks['user']==$user['id']){
if($users_tanks_pimp['5'] < 40){
if($users_tanks_pimp['5']==3 or $users_tanks_pimp['5']==7 or $users_tanks_pimp['5']==11 or $users_tanks_pimp['5']==15 or $users_tanks_pimp['5']==19 or $users_tanks_pimp['5']==23 or $users_tanks_pimp['5']==27 or $users_tanks_pimp['5']==31 or $users_tanks_pimp['5']==35 or $users_tanks_pimp['5']==39){
echo '<div class="bot"><a class="simple-but border mb5" href="?act_a1'.$users_tanks_pimp['5'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.$cost_a.'</span></span></a></div>';
}else{
echo '<div class="bot"><a class="simple-but border mb5" href="?act_a1'.$users_tanks_pimp['5'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.$cost_a.'</span></span></a></div>';
}
}
}
echo '</div></div></div></div></div></div></div></div></div></div>';
##############################################################################################################################
##############################################################################################################################
}






if($users_tanks_pimp['5']>=7 and $buildings_user['level']>=2){
##############################################################################################################################
##############################################################################################################################
if($users_tanks_pimp['6']==0){$users_tanks_pimp_A = 0;}if($users_tanks_pimp['6']==1){$users_tanks_pimp_A = 1;}if($users_tanks_pimp['6']==2){$users_tanks_pimp_A = 4;}if($users_tanks_pimp['6']==3){$users_tanks_pimp_A = 6;}if($users_tanks_pimp['6']==4){$users_tanks_pimp_A = 10;}if($users_tanks_pimp['6']==5){$users_tanks_pimp_A = 11;}if($users_tanks_pimp['6']==6){$users_tanks_pimp_A = 14;}if($users_tanks_pimp['6']==7){$users_tanks_pimp_A = 16;}if($users_tanks_pimp['6']==8){$users_tanks_pimp_A = 20;}if($users_tanks_pimp['6']==9){$users_tanks_pimp_A = 21;}if($users_tanks_pimp['6']==10){$users_tanks_pimp_A = 24;}if($users_tanks_pimp['6']==11){$users_tanks_pimp_A = 26;}if($users_tanks_pimp['6']==12){$users_tanks_pimp_A = 30;}if($users_tanks_pimp['6']==13){$users_tanks_pimp_A = 31;}if($users_tanks_pimp['6']==14){$users_tanks_pimp_A = 34;}if($users_tanks_pimp['6']==15){$users_tanks_pimp_A = 36;}if($users_tanks_pimp['6']==16){$users_tanks_pimp_A = 40;}if($users_tanks_pimp['6']==17){$users_tanks_pimp_A = 41;}if($users_tanks_pimp['6']==18){$users_tanks_pimp_A = 44;}if($users_tanks_pimp['6']==19){$users_tanks_pimp_A = 46;}if($users_tanks_pimp['6']==20){$users_tanks_pimp_A = 50;}if($users_tanks_pimp['6']==21){$users_tanks_pimp_A = 51;}if($users_tanks_pimp['6']==22){$users_tanks_pimp_A = 54;}if($users_tanks_pimp['6']==23){$users_tanks_pimp_A = 56;}if($users_tanks_pimp['6']==24){$users_tanks_pimp_A = 60;}if($users_tanks_pimp['6']==25){$users_tanks_pimp_A = 61;}if($users_tanks_pimp['6']==26){$users_tanks_pimp_A = 64;}if($users_tanks_pimp['6']==27){$users_tanks_pimp_A = 66;}if($users_tanks_pimp['6']==28){$users_tanks_pimp_A = 70;}if($users_tanks_pimp['6']==29){$users_tanks_pimp_A = 71;}if($users_tanks_pimp['6']==30){$users_tanks_pimp_A = 74;}if($users_tanks_pimp['6']==31){$users_tanks_pimp_A = 76;}if($users_tanks_pimp['6']==32){$users_tanks_pimp_A = 80;}if($users_tanks_pimp['6']==33){$users_tanks_pimp_A = 81;}if($users_tanks_pimp['6']==34){$users_tanks_pimp_A = 84;}if($users_tanks_pimp['6']==35){$users_tanks_pimp_A = 86;}if($users_tanks_pimp['6']==36){$users_tanks_pimp_A = 90;}if($users_tanks_pimp['6']==37){$users_tanks_pimp_A = 91;}if($users_tanks_pimp['6']==38){$users_tanks_pimp_A = 94;}if($users_tanks_pimp['6']==39){$users_tanks_pimp_A = 96;}if($users_tanks_pimp['6']==40){$users_tanks_pimp_A = 100;}
if($users_tanks_pimp['6']==0){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['6']==1){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['6']==2){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['6']==3){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['6']==4){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['6']==5){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['6']==6){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['6']==7){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['6']==8){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['6']==9){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['6']==10){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['6']==11){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['6']==12){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['6']==13){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['6']==14){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['6']==15){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['6']==16){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['6']==17){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['6']==18){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['6']==19){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['6']==20){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['6']==21){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['6']==22){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['6']==23){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['6']==24){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['6']==25){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['6']==26){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['6']==27){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['6']==28){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['6']==29){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['6']==30){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['6']==31){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['6']==32){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['6']==33){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['6']==34){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['6']==35){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['6']==36){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['6']==37){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['6']==38){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['6']==39){$users_tanks_pimp_A_ = 4;}
if($users_tanks_pimp['6']==0){$cost_a = 300;}if($users_tanks_pimp['6']==1){$cost_a = 600;}if($users_tanks_pimp['6']==2){$cost_a = 750;}if($users_tanks_pimp['6']==3){$cost_a = 45;}if($users_tanks_pimp['6']==4){$cost_a = 450;}if($users_tanks_pimp['6']==5){$cost_a = 900;}if($users_tanks_pimp['6']==6){$cost_a = 1125;}if($users_tanks_pimp['6']==7){$cost_a = 90;}if($users_tanks_pimp['6']==8){$cost_a = 600;}if($users_tanks_pimp['6']==9){$cost_a = 1200;}if($users_tanks_pimp['6']==10){$cost_a = 1500;}if($users_tanks_pimp['6']==11){$cost_a = 135;}if($users_tanks_pimp['6']==12){$cost_a = 750;}if($users_tanks_pimp['6']==13){$cost_a = 1500;}if($users_tanks_pimp['6']==14){$cost_a = 1875;}if($users_tanks_pimp['6']==15){$cost_a = 180;}if($users_tanks_pimp['6']==16){$cost_a = 900;}if($users_tanks_pimp['6']==17){$cost_a = 1800;}if($users_tanks_pimp['6']==18){$cost_a = 2250;}if($users_tanks_pimp['6']==19){$cost_a = 225;}if($users_tanks_pimp['6']==20){$cost_a = 1200;}if($users_tanks_pimp['6']==21){$cost_a = 2400;}if($users_tanks_pimp['6']==22){$cost_a = 3000;}if($users_tanks_pimp['6']==23){$cost_a = 270;}if($users_tanks_pimp['6']==24){$cost_a = 1500;}if($users_tanks_pimp['6']==25){$cost_a = 3000;}if($users_tanks_pimp['6']==26){$cost_a = 3750;}if($users_tanks_pimp['6']==27){$cost_a = 315;}if($users_tanks_pimp['6']==28){$cost_a = 1800;}if($users_tanks_pimp['6']==29){$cost_a = 3600;}if($users_tanks_pimp['6']==30){$cost_a = 4500;}if($users_tanks_pimp['6']==31){$cost_a = 360;}if($users_tanks_pimp['6']==32){$cost_a = 2100;}if($users_tanks_pimp['6']==33){$cost_a = 4200;}if($users_tanks_pimp['6']==34){$cost_a = 5250;}if($users_tanks_pimp['6']==35){$cost_a = 405;}if($users_tanks_pimp['6']==36){$cost_a = 3000;}if($users_tanks_pimp['6']==37){$cost_a = 6000;}if($users_tanks_pimp['6']==38){$cost_a = 7500;}if($users_tanks_pimp['6']==39){$cost_a = 450;}

if($prom['time_9']>time()){$cost_a = ceil($cost_a-($cost_a*$prom['act_9']/100));}else{$cost_a = $cost_a;}


if(isset($_GET['act_b1'.$users_tanks_pimp['6'].''])){
if($users_tanks_pimp['5']<7 and $buildings_user['level']<2){header('Location: ?');exit();}
if($users_tanks_pimp['6'] >= 40){header('Location: ?');exit();}
if($users_tanks_pimp['6']==3 or $users_tanks_pimp['6']==7 or $users_tanks_pimp['6']==11 or $users_tanks_pimp['6']==15 or $users_tanks_pimp['6']==19 or $users_tanks_pimp['6']==23 or $users_tanks_pimp['6']==27 or $users_tanks_pimp['6']==31 or $users_tanks_pimp['6']==35 or $users_tanks_pimp['6']==39){
if($user['gold'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_a-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}else{
if($user['silver'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.($cost_a-$user['silver']).' серебра</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}
if(!$users_tanks_pimp){
$mysqli->query('INSERT INTO `users_tanks_pimp` SET `user` = '.$user['id'].', `6` = "1", `b` = '.$users_tanks_pimp_A_.' ');
}else{
$mysqli->query('UPDATE `users_tanks_pimp` SET `6` = '.($users_tanks_pimp['6']+1).', `b` = '.($users_tanks_pimp['b']+$users_tanks_pimp_A_).' WHERE `id` = '.$users_tanks_pimp['id'].' LIMIT 1');
}
if($users_tanks_pimp['6']==3 or $users_tanks_pimp['6']==7 or $users_tanks_pimp['6']==11 or $users_tanks_pimp['6']==15 or $users_tanks_pimp['6']==19 or $users_tanks_pimp['6']==23 or $users_tanks_pimp['6']==27 or $users_tanks_pimp['6']==31 or $users_tanks_pimp['6']==35 or $users_tanks_pimp['6']==39){
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}else{
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}
$mysqli->query('UPDATE `users_tanks` SET `b` = '.($users_tanks['b']+$users_tanks_pimp_A_).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb2"><div class="medium bold cntr green1"><img height="14" width="14" src="/images/icons/victory.png"> Улучшена броня танка! <img height="14" width="14" src="/images/icons/victory.png"></div></div>';
header('Location: ?');
exit();
}
if($users_tanks_pimp['6'] < 40){$mb2 = '';}else{$mb2 = 'mb2';}
echo '<div class="trnt-block '.$mb2.'"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/slot/SlopedArmour.png" alt="Наклонная броня" title="Наклонная броня"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Наклонная броня</span><br>
<img width="14" height="14" src="/images/armor1.png?1" alt="Броня" title="Броня"> Броня: '.$users_tanks_pimp_A.'';
if($users_tanks['user']==$user['id']){if($users_tanks_pimp['6'] < 40){echo '<span class="green1">+'.$users_tanks_pimp_A_.'</span>';}}echo '<br>';
if($users_tanks_pimp['6']<4){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['6']>=4 && $users_tanks_pimp['6']<8){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['6']>=8){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['6']<12){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['6']>=12 && $users_tanks_pimp['6']<16){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['6']>=16){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['6']<20){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['6']>=20 && $users_tanks_pimp['6']<24){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['6']>=24){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['6']<28){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['6']>=28 && $users_tanks_pimp['6']<32){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['6']>=32){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['6']<36){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['6']>=36 && $users_tanks_pimp['6']<40){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['6']>=40){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
echo '</div><div class="clrb"></div></div>';
if($users_tanks['user']==$user['id']){
if($users_tanks_pimp['6'] < 40){
if($users_tanks_pimp['6']==3 or $users_tanks_pimp['6']==7 or $users_tanks_pimp['6']==11 or $users_tanks_pimp['6']==15 or $users_tanks_pimp['6']==19 or $users_tanks_pimp['6']==23 or $users_tanks_pimp['6']==27 or $users_tanks_pimp['6']==31 or $users_tanks_pimp['6']==35 or $users_tanks_pimp['6']==39){
echo '<div class="bot"><a class="simple-but border mb5" href="?act_b1'.$users_tanks_pimp['6'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.$cost_a.'</span></span></a></div>';
}else{
echo '<div class="bot"><a class="simple-but border mb5" href="?act_b1'.$users_tanks_pimp['6'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.$cost_a.'</span></span></a></div>';
}
}
}
echo '</div></div></div></div></div></div></div></div></div></div>';
##############################################################################################################################
##############################################################################################################################
}









if($users_tanks_pimp['6']>=7 and $buildings_user['level']>=3){
##############################################################################################################################
##############################################################################################################################
if($users_tanks_pimp['7']==0){$users_tanks_pimp_A = 0;}if($users_tanks_pimp['7']==1){$users_tanks_pimp_A = 1;}if($users_tanks_pimp['7']==2){$users_tanks_pimp_A = 4;}if($users_tanks_pimp['7']==3){$users_tanks_pimp_A = 6;}if($users_tanks_pimp['7']==4){$users_tanks_pimp_A = 10;}if($users_tanks_pimp['7']==5){$users_tanks_pimp_A = 11;}if($users_tanks_pimp['7']==6){$users_tanks_pimp_A = 14;}if($users_tanks_pimp['7']==7){$users_tanks_pimp_A = 16;}if($users_tanks_pimp['7']==8){$users_tanks_pimp_A = 20;}if($users_tanks_pimp['7']==9){$users_tanks_pimp_A = 21;}if($users_tanks_pimp['7']==10){$users_tanks_pimp_A = 24;}if($users_tanks_pimp['7']==11){$users_tanks_pimp_A = 26;}if($users_tanks_pimp['7']==12){$users_tanks_pimp_A = 30;}if($users_tanks_pimp['7']==13){$users_tanks_pimp_A = 31;}if($users_tanks_pimp['7']==14){$users_tanks_pimp_A = 34;}if($users_tanks_pimp['7']==15){$users_tanks_pimp_A = 36;}if($users_tanks_pimp['7']==16){$users_tanks_pimp_A = 40;}if($users_tanks_pimp['7']==17){$users_tanks_pimp_A = 41;}if($users_tanks_pimp['7']==18){$users_tanks_pimp_A = 44;}if($users_tanks_pimp['7']==19){$users_tanks_pimp_A = 46;}if($users_tanks_pimp['7']==20){$users_tanks_pimp_A = 50;}if($users_tanks_pimp['7']==21){$users_tanks_pimp_A = 51;}if($users_tanks_pimp['7']==22){$users_tanks_pimp_A = 54;}if($users_tanks_pimp['7']==23){$users_tanks_pimp_A = 56;}if($users_tanks_pimp['7']==24){$users_tanks_pimp_A = 60;}if($users_tanks_pimp['7']==25){$users_tanks_pimp_A = 61;}if($users_tanks_pimp['7']==26){$users_tanks_pimp_A = 64;}if($users_tanks_pimp['7']==27){$users_tanks_pimp_A = 66;}if($users_tanks_pimp['7']==28){$users_tanks_pimp_A = 70;}if($users_tanks_pimp['7']==29){$users_tanks_pimp_A = 71;}if($users_tanks_pimp['7']==30){$users_tanks_pimp_A = 74;}if($users_tanks_pimp['7']==31){$users_tanks_pimp_A = 76;}if($users_tanks_pimp['7']==32){$users_tanks_pimp_A = 80;}if($users_tanks_pimp['7']==33){$users_tanks_pimp_A = 81;}if($users_tanks_pimp['7']==34){$users_tanks_pimp_A = 84;}if($users_tanks_pimp['7']==35){$users_tanks_pimp_A = 86;}if($users_tanks_pimp['7']==36){$users_tanks_pimp_A = 90;}if($users_tanks_pimp['7']==37){$users_tanks_pimp_A = 91;}if($users_tanks_pimp['7']==38){$users_tanks_pimp_A = 94;}if($users_tanks_pimp['7']==39){$users_tanks_pimp_A = 96;}if($users_tanks_pimp['7']==40){$users_tanks_pimp_A = 100;}
if($users_tanks_pimp['7']==0){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['7']==1){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['7']==2){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['7']==3){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['7']==4){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['7']==5){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['7']==6){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['7']==7){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['7']==8){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['7']==9){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['7']==10){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['7']==11){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['7']==12){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['7']==13){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['7']==14){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['7']==15){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['7']==16){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['7']==17){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['7']==18){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['7']==19){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['7']==20){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['7']==21){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['7']==22){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['7']==23){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['7']==24){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['7']==25){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['7']==26){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['7']==27){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['7']==28){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['7']==29){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['7']==30){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['7']==31){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['7']==32){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['7']==33){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['7']==34){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['7']==35){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['7']==36){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['7']==37){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['7']==38){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['7']==39){$users_tanks_pimp_A_ = 4;}
if($users_tanks_pimp['7']==0){$cost_a = 300;}if($users_tanks_pimp['7']==1){$cost_a = 600;}if($users_tanks_pimp['7']==2){$cost_a = 750;}if($users_tanks_pimp['7']==3){$cost_a = 45;}if($users_tanks_pimp['7']==4){$cost_a = 450;}if($users_tanks_pimp['7']==5){$cost_a = 900;}if($users_tanks_pimp['7']==6){$cost_a = 1125;}if($users_tanks_pimp['7']==7){$cost_a = 90;}if($users_tanks_pimp['7']==8){$cost_a = 600;}if($users_tanks_pimp['7']==9){$cost_a = 1200;}if($users_tanks_pimp['7']==10){$cost_a = 1500;}if($users_tanks_pimp['7']==11){$cost_a = 135;}if($users_tanks_pimp['7']==12){$cost_a = 750;}if($users_tanks_pimp['7']==13){$cost_a = 1500;}if($users_tanks_pimp['7']==14){$cost_a = 1875;}if($users_tanks_pimp['7']==15){$cost_a = 180;}if($users_tanks_pimp['7']==16){$cost_a = 900;}if($users_tanks_pimp['7']==17){$cost_a = 1800;}if($users_tanks_pimp['7']==18){$cost_a = 2250;}if($users_tanks_pimp['7']==19){$cost_a = 225;}if($users_tanks_pimp['7']==20){$cost_a = 1200;}if($users_tanks_pimp['7']==21){$cost_a = 2400;}if($users_tanks_pimp['7']==22){$cost_a = 3000;}if($users_tanks_pimp['7']==23){$cost_a = 270;}if($users_tanks_pimp['7']==24){$cost_a = 1500;}if($users_tanks_pimp['7']==25){$cost_a = 3000;}if($users_tanks_pimp['7']==26){$cost_a = 3750;}if($users_tanks_pimp['7']==27){$cost_a = 315;}if($users_tanks_pimp['7']==28){$cost_a = 1800;}if($users_tanks_pimp['7']==29){$cost_a = 3600;}if($users_tanks_pimp['7']==30){$cost_a = 4500;}if($users_tanks_pimp['7']==31){$cost_a = 360;}if($users_tanks_pimp['7']==32){$cost_a = 2100;}if($users_tanks_pimp['7']==33){$cost_a = 4200;}if($users_tanks_pimp['7']==34){$cost_a = 5250;}if($users_tanks_pimp['7']==35){$cost_a = 405;}if($users_tanks_pimp['7']==36){$cost_a = 3000;}if($users_tanks_pimp['7']==37){$cost_a = 6000;}if($users_tanks_pimp['7']==38){$cost_a = 7500;}if($users_tanks_pimp['7']==39){$cost_a = 450;}

if($prom['time_9']>time()){$cost_a = ceil($cost_a-($cost_a*$prom['act_9']/100));}else{$cost_a = $cost_a;}


if(isset($_GET['act_t1'.$users_tanks_pimp['7'].''])){
if($users_tanks_pimp['6']<7 and $buildings_user['level']<3){header('Location: ?');exit();}
if($users_tanks_pimp['7'] >= 40){header('Location: ?');exit();}
if($users_tanks_pimp['7']==3 or $users_tanks_pimp['7']==7 or $users_tanks_pimp['7']==11 or $users_tanks_pimp['7']==15 or $users_tanks_pimp['7']==19 or $users_tanks_pimp['7']==23 or $users_tanks_pimp['7']==27 or $users_tanks_pimp['7']==31 or $users_tanks_pimp['7']==35 or $users_tanks_pimp['7']==39){
if($user['gold'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_a-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}else{
if($user['silver'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.($cost_a-$user['silver']).' серебра</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}
if(!$users_tanks_pimp){
$mysqli->query('INSERT INTO `users_tanks_pimp` SET `user` = '.$user['id'].', `7` = "1", `t` = '.$users_tanks_pimp_A_.' ');
}else{
$mysqli->query('UPDATE `users_tanks_pimp` SET `7` = '.($users_tanks_pimp['7']+1).', `t` = '.($users_tanks_pimp['t']+$users_tanks_pimp_A_).' WHERE `id` = '.$users_tanks_pimp['id'].' LIMIT 1');
}
if($users_tanks_pimp['7']==3 or $users_tanks_pimp['7']==7 or $users_tanks_pimp['7']==11 or $users_tanks_pimp['7']==15 or $users_tanks_pimp['7']==19 or $users_tanks_pimp['7']==23 or $users_tanks_pimp['7']==27 or $users_tanks_pimp['7']==31 or $users_tanks_pimp['7']==35 or $users_tanks_pimp['7']==39){
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}else{
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}
$mysqli->query('UPDATE `users_tanks` SET `t` = '.($users_tanks['t']+$users_tanks_pimp_A_).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb2"><div class="medium bold cntr green1"><img height="14" width="14" src="/images/icons/victory.png"> Улучшена точность танка! <img height="14" width="14" src="/images/icons/victory.png"></div></div>';
header('Location: ?');
exit();
}
if($users_tanks_pimp['7'] < 40){$mb2 = '';}else{$mb2 = 'mb2';}
echo '<div class="trnt-block '.$mb2.'"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/slot/Stereoscope.png" alt="Стереотруба" title="Стереотруба"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Стереотруба</span><br>
<img width="14" height="14" src="/images/accuracy1.png?1" alt="Точность" title="Точность"> Точность: '.$users_tanks_pimp_A.'';
if($users_tanks['user']==$user['id']){if($users_tanks_pimp['7'] < 40){echo '<span class="green1">+'.$users_tanks_pimp_A_.'</span>';}}echo '<br>';
if($users_tanks_pimp['7']<4){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['7']>=4 && $users_tanks_pimp['7']<8){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['7']>=8){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['7']<12){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['7']>=12 && $users_tanks_pimp['7']<16){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['7']>=16){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['7']<20){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['7']>=20 && $users_tanks_pimp['7']<24){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['7']>=24){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['7']<28){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['7']>=28 && $users_tanks_pimp['7']<32){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['7']>=32){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['7']<36){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['7']>=36 && $users_tanks_pimp['7']<40){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['7']>=40){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
echo '</div><div class="clrb"></div></div>';
if($users_tanks['user']==$user['id']){
if($users_tanks_pimp['7'] < 40){
if($users_tanks_pimp['7']==3 or $users_tanks_pimp['7']==7 or $users_tanks_pimp['7']==11 or $users_tanks_pimp['7']==15 or $users_tanks_pimp['7']==19 or $users_tanks_pimp['7']==23 or $users_tanks_pimp['7']==27 or $users_tanks_pimp['7']==31 or $users_tanks_pimp['7']==35 or $users_tanks_pimp['7']==39){
echo '<div class="bot"><a class="simple-but border mb5" href="?act_t1'.$users_tanks_pimp['7'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.$cost_a.'</span></span></a></div>';
}else{
echo '<div class="bot"><a class="simple-but border mb5" href="?act_t1'.$users_tanks_pimp['7'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.$cost_a.'</span></span></a></div>';
}
}
}
echo '</div></div></div></div></div></div></div></div></div></div>';
##############################################################################################################################
##############################################################################################################################
}




if($users_tanks_pimp['7']>=7 and $buildings_user['level']>=4){
##############################################################################################################################
##############################################################################################################################
if($users_tanks_pimp['8']==0){$users_tanks_pimp_A = 0;}if($users_tanks_pimp['8']==1){$users_tanks_pimp_A = 1;}if($users_tanks_pimp['8']==2){$users_tanks_pimp_A = 4;}if($users_tanks_pimp['8']==3){$users_tanks_pimp_A = 6;}if($users_tanks_pimp['8']==4){$users_tanks_pimp_A = 10;}if($users_tanks_pimp['8']==5){$users_tanks_pimp_A = 11;}if($users_tanks_pimp['8']==6){$users_tanks_pimp_A = 14;}if($users_tanks_pimp['8']==7){$users_tanks_pimp_A = 16;}if($users_tanks_pimp['8']==8){$users_tanks_pimp_A = 20;}if($users_tanks_pimp['8']==9){$users_tanks_pimp_A = 21;}if($users_tanks_pimp['8']==10){$users_tanks_pimp_A = 24;}if($users_tanks_pimp['8']==11){$users_tanks_pimp_A = 26;}if($users_tanks_pimp['8']==12){$users_tanks_pimp_A = 30;}if($users_tanks_pimp['8']==13){$users_tanks_pimp_A = 31;}if($users_tanks_pimp['8']==14){$users_tanks_pimp_A = 34;}if($users_tanks_pimp['8']==15){$users_tanks_pimp_A = 36;}if($users_tanks_pimp['8']==16){$users_tanks_pimp_A = 40;}if($users_tanks_pimp['8']==17){$users_tanks_pimp_A = 41;}if($users_tanks_pimp['8']==18){$users_tanks_pimp_A = 44;}if($users_tanks_pimp['8']==19){$users_tanks_pimp_A = 46;}if($users_tanks_pimp['8']==20){$users_tanks_pimp_A = 50;}if($users_tanks_pimp['8']==21){$users_tanks_pimp_A = 51;}if($users_tanks_pimp['8']==22){$users_tanks_pimp_A = 54;}if($users_tanks_pimp['8']==23){$users_tanks_pimp_A = 56;}if($users_tanks_pimp['8']==24){$users_tanks_pimp_A = 60;}if($users_tanks_pimp['8']==25){$users_tanks_pimp_A = 61;}if($users_tanks_pimp['8']==26){$users_tanks_pimp_A = 64;}if($users_tanks_pimp['8']==27){$users_tanks_pimp_A = 66;}if($users_tanks_pimp['8']==28){$users_tanks_pimp_A = 70;}if($users_tanks_pimp['8']==29){$users_tanks_pimp_A = 71;}if($users_tanks_pimp['8']==30){$users_tanks_pimp_A = 74;}if($users_tanks_pimp['8']==31){$users_tanks_pimp_A = 76;}if($users_tanks_pimp['8']==32){$users_tanks_pimp_A = 80;}if($users_tanks_pimp['8']==33){$users_tanks_pimp_A = 81;}if($users_tanks_pimp['8']==34){$users_tanks_pimp_A = 84;}if($users_tanks_pimp['8']==35){$users_tanks_pimp_A = 86;}if($users_tanks_pimp['8']==36){$users_tanks_pimp_A = 90;}if($users_tanks_pimp['8']==37){$users_tanks_pimp_A = 91;}if($users_tanks_pimp['8']==38){$users_tanks_pimp_A = 94;}if($users_tanks_pimp['8']==39){$users_tanks_pimp_A = 96;}if($users_tanks_pimp['8']==40){$users_tanks_pimp_A = 100;}
if($users_tanks_pimp['8']==0){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['8']==1){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['8']==2){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['8']==3){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['8']==4){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['8']==5){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['8']==6){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['8']==7){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['8']==8){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['8']==9){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['8']==10){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['8']==11){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['8']==12){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['8']==13){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['8']==14){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['8']==15){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['8']==16){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['8']==17){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['8']==18){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['8']==19){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['8']==20){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['8']==21){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['8']==22){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['8']==23){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['8']==24){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['8']==25){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['8']==26){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['8']==27){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['8']==28){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['8']==29){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['8']==30){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['8']==31){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['8']==32){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['8']==33){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['8']==34){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['8']==35){$users_tanks_pimp_A_ = 4;}if($users_tanks_pimp['8']==36){$users_tanks_pimp_A_ = 1;}if($users_tanks_pimp['8']==37){$users_tanks_pimp_A_ = 3;}if($users_tanks_pimp['8']==38){$users_tanks_pimp_A_ = 2;}if($users_tanks_pimp['8']==39){$users_tanks_pimp_A_ = 4;}
if($users_tanks_pimp['8']==0){$cost_a = 300;}if($users_tanks_pimp['8']==1){$cost_a = 600;}if($users_tanks_pimp['8']==2){$cost_a = 750;}if($users_tanks_pimp['8']==3){$cost_a = 45;}if($users_tanks_pimp['8']==4){$cost_a = 450;}if($users_tanks_pimp['8']==5){$cost_a = 900;}if($users_tanks_pimp['8']==6){$cost_a = 1125;}if($users_tanks_pimp['8']==7){$cost_a = 90;}if($users_tanks_pimp['8']==8){$cost_a = 600;}if($users_tanks_pimp['8']==9){$cost_a = 1200;}if($users_tanks_pimp['8']==10){$cost_a = 1500;}if($users_tanks_pimp['8']==11){$cost_a = 135;}if($users_tanks_pimp['8']==12){$cost_a = 750;}if($users_tanks_pimp['8']==13){$cost_a = 1500;}if($users_tanks_pimp['8']==14){$cost_a = 1875;}if($users_tanks_pimp['8']==15){$cost_a = 180;}if($users_tanks_pimp['8']==16){$cost_a = 900;}if($users_tanks_pimp['8']==17){$cost_a = 1800;}if($users_tanks_pimp['8']==18){$cost_a = 2250;}if($users_tanks_pimp['8']==19){$cost_a = 225;}if($users_tanks_pimp['8']==20){$cost_a = 1200;}if($users_tanks_pimp['8']==21){$cost_a = 2400;}if($users_tanks_pimp['8']==22){$cost_a = 3000;}if($users_tanks_pimp['8']==23){$cost_a = 270;}if($users_tanks_pimp['8']==24){$cost_a = 1500;}if($users_tanks_pimp['8']==25){$cost_a = 3000;}if($users_tanks_pimp['8']==26){$cost_a = 3750;}if($users_tanks_pimp['8']==27){$cost_a = 315;}if($users_tanks_pimp['8']==28){$cost_a = 1800;}if($users_tanks_pimp['8']==29){$cost_a = 3600;}if($users_tanks_pimp['8']==30){$cost_a = 4500;}if($users_tanks_pimp['8']==31){$cost_a = 360;}if($users_tanks_pimp['8']==32){$cost_a = 2100;}if($users_tanks_pimp['8']==33){$cost_a = 4200;}if($users_tanks_pimp['8']==34){$cost_a = 5250;}if($users_tanks_pimp['8']==35){$cost_a = 405;}if($users_tanks_pimp['8']==36){$cost_a = 3000;}if($users_tanks_pimp['8']==37){$cost_a = 6000;}if($users_tanks_pimp['8']==38){$cost_a = 7500;}if($users_tanks_pimp['8']==39){$cost_a = 450;}

if($prom['time_9']>time()){$cost_a = ceil($cost_a-($cost_a*$prom['act_9']/100));}else{$cost_a = $cost_a;}


if(isset($_GET['act_p1'.$users_tanks_pimp['8'].''])){
if($users_tanks_pimp['7']<7 and $buildings_user['level']<3){header('Location: ?');exit();}
if($users_tanks_pimp['8'] >= 40){header('Location: ?');exit();}
if($users_tanks_pimp['8']==3 or $users_tanks_pimp['8']==7 or $users_tanks_pimp['8']==11 or $users_tanks_pimp['8']==15 or $users_tanks_pimp['8']==19 or $users_tanks_pimp['8']==23 or $users_tanks_pimp['8']==27 or $users_tanks_pimp['8']==31 or $users_tanks_pimp['8']==35 or $users_tanks_pimp['8']==39){
if($user['gold'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_a-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}else{
if($user['silver'] < $cost_a){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.($cost_a-$user['silver']).' серебра</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
}
if(!$users_tanks_pimp){
$mysqli->query('INSERT INTO `users_tanks_pimp` SET `user` = '.$user['id'].', `8` = "1", `p` = '.$users_tanks_pimp_A_.' ');
}else{
$mysqli->query('UPDATE `users_tanks_pimp` SET `8` = '.($users_tanks_pimp['8']+1).', `p` = '.($users_tanks_pimp['p']+$users_tanks_pimp_A_).' WHERE `id` = '.$users_tanks_pimp['id'].' LIMIT 1');
}
if($users_tanks_pimp['8']==3 or $users_tanks_pimp['8']==7 or $users_tanks_pimp['8']==11 or $users_tanks_pimp['8']==15 or $users_tanks_pimp['8']==19 or $users_tanks_pimp['8']==23 or $users_tanks_pimp['8']==27 or $users_tanks_pimp['8']==31 or $users_tanks_pimp['8']==35 or $users_tanks_pimp['8']==39){
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}else{
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']-$cost_a).' WHERE `id` = '.$user['id'].' LIMIT 1');
}
$mysqli->query('UPDATE `users_tanks` SET `p` = '.($users_tanks['p']+$users_tanks_pimp_A_).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb2"><div class="medium bold cntr green1"><img height="14" width="14" src="/images/icons/victory.png"> Улучшена прочность танка! <img height="14" width="14" src="/images/icons/victory.png"></div></div>';
header('Location: ?');
exit();
}
if($users_tanks_pimp['8'] < 40){$mb2 = '';}else{$mb2 = 'mb2';}
echo '<div class="trnt-block '.$mb2.'"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/slot/ShellBoxCover.png" alt="Защита боеукладки" title="Защита боеукладки"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Защита боеукладки</span><br>
<img width="14" height="14" src="/images/durability1.png?1" alt="Прочность" title="Прочность"> Прочность: '.$users_tanks_pimp_A.'';
if($users_tanks['user']==$user['id']){if($users_tanks_pimp['8'] < 40){echo '<span class="green1">+'.$users_tanks_pimp_A_.'</span>';}}echo '<br>';
if($users_tanks_pimp['8']<4){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['8']>=4 && $users_tanks_pimp['8']<8){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['8']>=8){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['8']<12){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['8']>=12 && $users_tanks_pimp['8']<16){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['8']>=16){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['8']<20){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['8']>=20 && $users_tanks_pimp['8']<24){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['8']>=24){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['8']<28){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['8']>=28 && $users_tanks_pimp['8']<32){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['8']>=32){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($users_tanks_pimp['8']<36){echo ' <img src="/images/upgrades/starEmpty.png" height="14" width="14">';}elseif($users_tanks_pimp['8']>=36 && $users_tanks_pimp['8']<40){echo ' <img src="/images/upgrades/starHalf.png" height="14" width="14">';}elseif($users_tanks_pimp['8']>=40){echo ' <img src="/images/upgrades/starFull.png" height="14" width="14">';}
echo '</div><div class="clrb"></div></div>';
if($users_tanks['user']==$user['id']){
if($users_tanks_pimp['8'] < 40){
if($users_tanks_pimp['8']==3 or $users_tanks_pimp['8']==7 or $users_tanks_pimp['8']==11 or $users_tanks_pimp['8']==15 or $users_tanks_pimp['8']==19 or $users_tanks_pimp['8']==23 or $users_tanks_pimp['8']==27 or $users_tanks_pimp['8']==31 or $users_tanks_pimp['8']==35 or $users_tanks_pimp['8']==39){
echo '<div class="bot"><a class="simple-but border mb5" href="?act_p1'.$users_tanks_pimp['8'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.$cost_a.'</span></span></a></div>';
}else{
echo '<div class="bot"><a class="simple-but border mb5" href="?act_p1'.$users_tanks_pimp['8'].'"><span><span>Улучшить за <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.$cost_a.'</span></span></a></div>';
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