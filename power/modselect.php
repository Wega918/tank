<?php
$title = 'Модификация танка';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}
$id = abs(intval($_GET['id']));
$tip = abs(intval($_GET['tip']));
$res = $mysqli->query('SELECT * FROM `users` WHERE `id`  = "'.$id.'" LIMIT 1');
$ank = $res->fetch_assoc();


if($ank <= 0){header('Location: /');exit();}
if($tip <= 0){header('Location: /');exit();}
if($ank['id']!=$user['id']){header('Location: /');exit();}

$res1 = $mysqli->query('SELECT * FROM `prom` WHERE `id` = "1" ');
$prom = $res1->fetch_assoc();


if($ank['id']!=$user['id']){
echo '<div class="medium bold white cntr sh_b mb5"><div>'.$title.' '.nick($ank['id']).'</div></div>';
}else{
echo '<div class="medium bold white cntr sh_b mb5"><div>'.$title.'</div></div>';
}



$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = '.$ank['id'].' and `active`  = "1" LIMIT 1');
$users_tanks = $res->fetch_assoc();
$res = $mysqli->query('SELECT * FROM `tanks` WHERE `id`  = "'.$users_tanks['tip'].'" LIMIT 1');
$tank = $res->fetch_assoc();





if($tank['tip'] == 1){$tip_tank = 'average';$tip_tank_ru = 'СРЕДНИЙ ТАНК';} // СТ
if($tank['tip'] == 2){$tip_tank = 'heavy';$tip_tank_ru = 'ТЯЖЕЛЫЙ ТАНК';} // ТТ
if($tank['tip'] == 3){$tip_tank = 'SAU';$tip_tank_ru = 'ПТ-САУ';} // САУ

if($tank['country'] == 'GERMANY'){$coun_tank = 'ГЕРМАНИЯ';$coun_tank_en = 'germany';$angar = 'bg_germany flag_short';}
if($tank['country'] == 'SSSR'){$coun_tank = 'СССР';$coun_tank_en = 'ussr';$angar = 'bg_ussr flag_short';}
if($tank['country'] == 'USA'){$coun_tank = 'США';$coun_tank_en = 'usa';$angar = 'bg_usa flag_short';}

if($ank['side'] == 1){$side = 'empire';}else{$side = 'federation';}
$sum_param = $users_tanks['a']+$users_tanks['b']+$users_tanks['t']+$users_tanks['p'];
if($tank['tip'] == 3){if($tip == 1){header('Location: /');exit();}}


$res = $mysqli->query('SELECT * FROM `users_tanks_modification` WHERE `user` = '.$ank['id'].' and `id_tank`  = "'.$tank['id'].'" LIMIT 1');
$users_tanks_modification = $res->fetch_assoc();




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







if($tip == 1){
if($tank['tip'] != 3){
if($users_tanks_modification['1']==0){$param_mod = 5;$year = 1940;$gold = 10;}
if($users_tanks_modification['1']==1){$param_mod = 5;$year = 1941;$gold = 50;}
if($users_tanks_modification['1']==2){$param_mod = 5;$year = 1942;$gold = 100;}
if($users_tanks_modification['1']==3){$param_mod = 5;$year = 1943;$gold = 250;}
if($users_tanks_modification['1']==4){$param_mod = 5;$year = 1944;$gold = 500;}
if($users_tanks_modification['1']==5){$param_mod = 5;$year = 1945;$gold = 1000;}
if($users_tanks_modification['1']==6){$mb0 = 'mb0';}else{$mb0 = 'mb1';}

if($prom['time_11']>time()){$gold = ceil($gold-($gold*$prom['act_11']/100));}else{$gold = $gold;}

if(isset($_GET['mod'.$gold.''.$tip.''])){
if($users_tanks_modification['1']>=6){header('Location: ?');exit();}
if($user['gold'] < $gold){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($gold-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
if(!$users_tanks_modification){
$mysqli->query('INSERT INTO `users_tanks_modification` SET `user` = '.$user['id'].', `1` = "1", `a` = '.$param_mod.', `b` = '.$param_mod.', `t` = '.$param_mod.', `p` = '.$param_mod.', `id_tank` = '.$tank['id'].' ');
}else{
$mysqli->query('UPDATE `users_tanks_modification` SET `1` = '.($users_tanks_modification['1']+1).', `a` = '.($users_tanks_modification['a']+$param_mod).', `b` = '.($users_tanks_modification['b']+$param_mod).', `t` = '.($users_tanks_modification['t']+$param_mod).', `p` = '.($users_tanks_modification['p']+$param_mod).' WHERE `id` = '.$users_tanks_modification['id'].' LIMIT 1');
}
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$gold).' WHERE `id` = '.$user['id'].' LIMIT 1');
$mysqli->query('UPDATE `users_tanks` SET `a` = '.($users_tanks['a']+$param_mod).', `b` = '.($users_tanks['b']+$param_mod).', `t` = '.($users_tanks['t']+$param_mod).', `p` = '.($users_tanks['p']+$param_mod).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="medium bold pb5 green1"><img src="/images/icons/victory.png"> Установлен новый модуль <img src="/images/icons/victory.png"></div>
<div class="mb5 inbl ta_l"><div class="thumb fl"><img src="/images/modules/tower/y_'.$year.'.png?2"><span class="brd_'.$coun_tank_en.'"></span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Башня</span><br><span class="green1">+'.$param_mod.' ко всем параметрам</span><br>'.$year.' год</div>
<div class="clrb"></div></div></div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}

if($users_tanks_modification['1']<6){
echo '<div class="small bold green2 cntr sh_b mb5">Новый модуль для танка</div>';
echo '<div class="trnt-block '.$mb0.'" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl w100"><div class="thumb fl"><img src="/images/modules/tower/y_'.$year.'.png?2"><span class="brd_'.$coun_tank_en.'"></span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Башня</span><br><span class="green1">+'.$param_mod.' ко всем параметрам</span></span><br>'.$year.' год</div><div class="clrb"></div></div>';
if($users_tanks_modification['1']<6){echo '<div class="bot"><a class="simple-but border" w:id="selectLink" href="?mod'.$gold.''.$tip.'"><span><span>Модификация за <img title="Золото" alt="Золото" src="/images/icons/gold.png?1"> '.$gold.'</span></span></a></div>';}
echo '</div></div></div></div></div></div></div></div></div></div><br>';
}else{
echo '<div class="small bold green2 cntr sh_b mb5">Сейчас на танке</div>';
echo '<div class="trnt-block mb0" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl w100"><div class="thumb fl"><img src="/images/modules/tower/y_1945.png?2"><span class="brd_'.$coun_tank_en.'"></span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Башня</span><br><span class="green">+30 ко всем параметрам</span><br>1945 год</div><div class="clrb"></div></div>';
echo '</div></div></div></div></div></div></div></div></div></div>';
}
}
}


if($tip == 2){
if($tank['tip'] != 3){
if($users_tanks_modification['2']==0){$param_mod = 10;$year = 1940;$gold = 20;}
if($users_tanks_modification['2']==1){$param_mod = 10;$year = 1941;$gold = 100;}
if($users_tanks_modification['2']==2){$param_mod = 10;$year = 1942;$gold = 200;}
if($users_tanks_modification['2']==3){$param_mod = 10;$year = 1943;$gold = 500;}
if($users_tanks_modification['2']==4){$param_mod = 10;$year = 1944;$gold = 1000;}
if($users_tanks_modification['2']>=5){$param_mod = 10;$year = 1945;$gold = 2000;}
$sum = $param_mod+$param_mod+$param_mod+$param_mod+$param_mod+$param_mod;
}else{
if($users_tanks_modification['2']==0){$param_mod = 15;$year = 1940;$gold = 30;}
if($users_tanks_modification['2']==1){$param_mod = 15;$year = 1941;$gold = 150;}
if($users_tanks_modification['2']==2){$param_mod = 15;$year = 1942;$gold = 300;}
if($users_tanks_modification['2']==3){$param_mod = 15;$year = 1943;$gold = 750;}
if($users_tanks_modification['2']==4){$param_mod = 15;$year = 1944;$gold = 1500;}
if($users_tanks_modification['2']>=5){$param_mod = 15;$year = 1945;$gold = 3000;}
$sum = $param_mod+$param_mod+$param_mod+$param_mod+$param_mod+$param_mod;
}
if($users_tanks_modification['2']==6){$mb0 = 'mb0';}else{$mb0 = 'mb1';}


if($prom['time_11']>time()){$gold = ceil($gold-($gold*$prom['act_11']/100));}else{$gold = $gold;}


if(isset($_GET['mod'.$gold.''.$tip.''])){
if($users_tanks_modification['2']>=6){header('Location: ?');exit();}
if($user['gold'] < $gold){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($gold-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
if(!$users_tanks_modification){
$mysqli->query('INSERT INTO `users_tanks_modification` SET `user` = '.$user['id'].', `2` = "1", `a` = '.$param_mod.', `b` = '.$param_mod.', `t` = '.$param_mod.', `p` = '.$param_mod.', `id_tank` = '.$tank['id'].' ');
}else{
$mysqli->query('UPDATE `users_tanks_modification` SET `2` = '.($users_tanks_modification['2']+1).', `a` = '.($users_tanks_modification['a']+$param_mod).', `b` = '.($users_tanks_modification['b']+$param_mod).', `t` = '.($users_tanks_modification['t']+$param_mod).', `p` = '.($users_tanks_modification['p']+$param_mod).' WHERE `id` = '.$users_tanks_modification['id'].' LIMIT 1');
}
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$gold).' WHERE `id` = '.$user['id'].' LIMIT 1');
$mysqli->query('UPDATE `users_tanks` SET `a` = '.($users_tanks['a']+$param_mod).', `b` = '.($users_tanks['b']+$param_mod).', `t` = '.($users_tanks['t']+$param_mod).', `p` = '.($users_tanks['p']+$param_mod).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="medium bold pb5 green1"><img src="/images/icons/victory.png"> Установлен новый модуль <img src="/images/icons/victory.png"></div>
<div class="mb5 inbl ta_l"><div class="thumb fl"><img src="/images/modules/cannon/y_'.$year.'.png?2"><span class="brd_'.$coun_tank_en.'"></span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Орудие</span><br><span class="green1">+'.$param_mod.' ко всем параметрам</span><br>'.$year.' год</div>
<div class="clrb"></div></div></div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}

if($users_tanks_modification['2']<6){
echo '<div class="small bold green2 cntr sh_b mb5">Новый модуль для танка</div>';
echo '<div class="trnt-block '.$mb0.'" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl w100"><div class="thumb fl"><img src="/images/modules/cannon/y_'.$year.'.png?2"><span class="brd_'.$coun_tank_en.'"></span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Орудие</span><br><span class="green1">+'.$param_mod.' ко всем параметрам</span><br>'.$year.' год</div><div class="clrb"></div></div>';
if($users_tanks_modification['2']<6){echo '<div class="bot"><a class="simple-but border" w:id="selectLink" href="?mod'.$gold.''.$tip.'"><span><span>Модификация за <img title="Золото" alt="Золото" src="/images/icons/gold.png?1"> '.$gold.'</span></span></a></div>';}
echo '</div></div></div></div></div></div></div></div></div></div><br>';
}else{
echo '<div class="small bold green2 cntr sh_b mb5">Сейчас на танке</div>';
echo '<div class="trnt-block mb0" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl w100"><div class="thumb fl"><img src="/images/modules/cannon/y_1945.png?2"><span class="brd_'.$coun_tank_en.'"></span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Орудие</span><br><span class="green">+'.$sum.' ко всем параметрам</span><br>1945 год</div><div class="clrb"></div></div>';
echo '</div></div></div></div></div></div></div></div></div></div>';
}
}



if($tip == 3){
if($users_tanks_modification['3']==0){$param_mod = 5;$year = 1940;$gold = 10;}
if($users_tanks_modification['3']==1){$param_mod = 5;$year = 1941;$gold = 50;}
if($users_tanks_modification['3']==2){$param_mod = 5;$year = 1942;$gold = 100;}
if($users_tanks_modification['3']==3){$param_mod = 5;$year = 1943;$gold = 250;}
if($users_tanks_modification['3']==4){$param_mod = 5;$year = 1944;$gold = 500;}
if($users_tanks_modification['3']==5){$param_mod = 5;$year = 1945;$gold = 1000;}
if($users_tanks_modification['3']==6){$mb0 = 'mb0';}else{$mb0 = 'mb1';}


if($prom['time_11']>time()){$gold = ceil($gold-($gold*$prom['act_11']/100));}else{$gold = $gold;}


if(isset($_GET['mod'.$gold.''.$tip.''])){
if($users_tanks_modification['3']>=6){header('Location: ?');exit();}
if($user['gold'] < $gold){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($gold-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
if(!$users_tanks_modification){
$mysqli->query('INSERT INTO `users_tanks_modification` SET `user` = '.$user['id'].', `3` = "1", `a` = '.$param_mod.', `b` = '.$param_mod.', `t` = '.$param_mod.', `p` = '.$param_mod.', `id_tank` = '.$tank['id'].' ');
}else{
$mysqli->query('UPDATE `users_tanks_modification` SET `3` = '.($users_tanks_modification['3']+1).', `a` = '.($users_tanks_modification['a']+$param_mod).', `b` = '.($users_tanks_modification['b']+$param_mod).', `t` = '.($users_tanks_modification['t']+$param_mod).', `p` = '.($users_tanks_modification['p']+$param_mod).' WHERE `id` = '.$users_tanks_modification['id'].' LIMIT 1');
}
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$gold).' WHERE `id` = '.$user['id'].' LIMIT 1');
$mysqli->query('UPDATE `users_tanks` SET `a` = '.($users_tanks['a']+$param_mod).', `b` = '.($users_tanks['b']+$param_mod).', `t` = '.($users_tanks['t']+$param_mod).', `p` = '.($users_tanks['p']+$param_mod).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="medium bold pb5 green1"><img src="/images/icons/victory.png"> Установлен новый модуль <img src="/images/icons/victory.png"></div>
<div class="mb5 inbl ta_l"><div class="thumb fl"><img src="/images/modules/machinegun/y_'.$year.'.png?2"><span class="brd_'.$coun_tank_en.'"></span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Пулемет</span><br><span class="green1">+'.$param_mod.' ко всем параметрам</span><br>'.$year.' год</div>
<div class="clrb"></div></div></div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}

if($users_tanks_modification['3']<6){
echo '<div class="small bold green2 cntr sh_b mb5">Новый модуль для танка</div>';
echo '<div class="trnt-block '.$mb0.'" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl w100"><div class="thumb fl"><img src="/images/modules/machinegun/y_'.$year.'.png?2"><span class="brd_'.$coun_tank_en.'"></span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Пулемет</span><br><span class="green1">+'.$param_mod.' ко всем параметрам</span><br>'.$year.' год</div><div class="clrb"></div></div>';
if($users_tanks_modification['3']<6){echo '<div class="bot"><a class="simple-but border" w:id="selectLink" href="?mod'.$gold.''.$tip.'"><span><span>Модификация за <img title="Золото" alt="Золото" src="/images/icons/gold.png?1"> '.$gold.'</span></span></a></div>';}
echo '</div></div></div></div></div></div></div></div></div></div><br>';
}else{
echo '<div class="small bold green2 cntr sh_b mb5">Сейчас на танке</div>';
echo '<div class="trnt-block mb0" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl w100"><div class="thumb fl"><img src="/images/modules/machinegun/y_1945.png?2"><span class="brd_'.$coun_tank_en.'"></span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Пулемет</span><br><span class="green">+30 ко всем параметрам</span><br>1945 год</div><div class="clrb"></div></div>';
echo '</div></div></div></div></div></div></div></div></div></div>';
}
}



if($tip == 4){
if($users_tanks_modification['4']==0){$param_mod = 5;$year = 1940;$gold = 10;}
if($users_tanks_modification['4']==1){$param_mod = 5;$year = 1941;$gold = 50;}
if($users_tanks_modification['4']==2){$param_mod = 5;$year = 1942;$gold = 100;}
if($users_tanks_modification['4']==3){$param_mod = 5;$year = 1943;$gold = 250;}
if($users_tanks_modification['4']==4){$param_mod = 5;$year = 1944;$gold = 500;}
if($users_tanks_modification['4']==5){$param_mod = 5;$year = 1945;$gold = 1000;}
if($users_tanks_modification['4']==6){$mb0 = 'mb0';}else{$mb0 = 'mb1';}


if($prom['time_11']>time()){$gold = ceil($gold-($gold*$prom['act_11']/100));}else{$gold = $gold;}


if(isset($_GET['mod'.$gold.''.$tip.''])){
if($users_tanks_modification['4']>=6){header('Location: ?');exit();}
if($user['gold'] < $gold){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($gold-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
if(!$users_tanks_modification){
$mysqli->query('INSERT INTO `users_tanks_modification` SET `user` = '.$user['id'].', `4` = "1", `a` = '.$param_mod.', `b` = '.$param_mod.', `t` = '.$param_mod.', `p` = '.$param_mod.', `id_tank` = '.$tank['id'].' ');
}else{
$mysqli->query('UPDATE `users_tanks_modification` SET `4` = '.($users_tanks_modification['4']+1).', `a` = '.($users_tanks_modification['a']+$param_mod).', `b` = '.($users_tanks_modification['b']+$param_mod).', `t` = '.($users_tanks_modification['t']+$param_mod).', `p` = '.($users_tanks_modification['p']+$param_mod).' WHERE `id` = '.$users_tanks_modification['id'].' LIMIT 1');
}
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$gold).' WHERE `id` = '.$user['id'].' LIMIT 1');
$mysqli->query('UPDATE `users_tanks` SET `a` = '.($users_tanks['a']+$param_mod).', `b` = '.($users_tanks['b']+$param_mod).', `t` = '.($users_tanks['t']+$param_mod).', `p` = '.($users_tanks['p']+$param_mod).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="medium bold pb5 green1"><img src="/images/icons/victory.png"> Установлен новый модуль <img src="/images/icons/victory.png"></div>
<div class="mb5 inbl ta_l"><div class="thumb fl"><img src="/images/modules/frontalarmor/y_'.$year.'.png?2"><span class="brd_'.$coun_tank_en.'"></span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Лобовая броня</span><br><span class="green1">+'.$param_mod.' ко всем параметрам</span><br>'.$year.' год</div>
<div class="clrb"></div></div></div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}

if($users_tanks_modification['4']<6){
echo '<div class="small bold green2 cntr sh_b mb5">Новый модуль для танка</div>';
echo '<div class="trnt-block '.$mb0.'" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl w100"><div class="thumb fl"><img src="/images/modules/frontalarmor/y_'.$year.'.png?2"><span class="brd_'.$coun_tank_en.'"></span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Лобовая броня</span><br><span class="green1">+'.$param_mod.' ко всем параметрам</span><br>'.$year.' год</div><div class="clrb"></div></div>';
if($users_tanks_modification['4']<6){echo '<div class="bot"><a class="simple-but border" w:id="selectLink" href="?mod'.$gold.''.$tip.'"><span><span>Модификация за <img title="Золото" alt="Золото" src="/images/icons/gold.png?1"> '.$gold.'</span></span></a></div>';}
echo '</div></div></div></div></div></div></div></div></div></div><br>';
}else{
echo '<div class="small bold green2 cntr sh_b mb5">Сейчас на танке</div>';
echo '<div class="trnt-block mb0" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl w100"><div class="thumb fl"><img src="/images/modules/frontalarmor/y_1945.png?2"><span class="brd_'.$coun_tank_en.'"></span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Лобовая броня</span><br><span class="green">+30 ко всем параметрам</span><br>1945 год</div><div class="clrb"></div></div>';
echo '</div></div></div></div></div></div></div></div></div></div>';
}
}



if($tip == 5){
if($users_tanks_modification['5']==0){$param_mod = 5;$year = 1940;$gold = 10;}
if($users_tanks_modification['5']==1){$param_mod = 5;$year = 1941;$gold = 50;}
if($users_tanks_modification['5']==2){$param_mod = 5;$year = 1942;$gold = 100;}
if($users_tanks_modification['5']==3){$param_mod = 5;$year = 1943;$gold = 250;}
if($users_tanks_modification['5']==4){$param_mod = 5;$year = 1944;$gold = 500;}
if($users_tanks_modification['5']==5){$param_mod = 5;$year = 1945;$gold = 1000;}
if($users_tanks_modification['5']==6){$mb0 = 'mb0';}else{$mb0 = 'mb1';}


if($prom['time_11']>time()){$gold = ceil($gold-($gold*$prom['act_11']/100));}else{$gold = $gold;}


if(isset($_GET['mod'.$gold.''.$tip.''])){
if($users_tanks_modification['5']>=6){header('Location: ?');exit();}
if($user['gold'] < $gold){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($gold-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
if(!$users_tanks_modification){
$mysqli->query('INSERT INTO `users_tanks_modification` SET `user` = '.$user['id'].', `5` = "1", `a` = '.$param_mod.', `b` = '.$param_mod.', `t` = '.$param_mod.', `p` = '.$param_mod.', `id_tank` = '.$tank['id'].' ');
}else{
$mysqli->query('UPDATE `users_tanks_modification` SET `5` = '.($users_tanks_modification['5']+1).', `a` = '.($users_tanks_modification['a']+$param_mod).', `b` = '.($users_tanks_modification['b']+$param_mod).', `t` = '.($users_tanks_modification['t']+$param_mod).', `p` = '.($users_tanks_modification['p']+$param_mod).' WHERE `id` = '.$users_tanks_modification['id'].' LIMIT 1');
}
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$gold).' WHERE `id` = '.$user['id'].' LIMIT 1');
$mysqli->query('UPDATE `users_tanks` SET `a` = '.($users_tanks['a']+$param_mod).', `b` = '.($users_tanks['b']+$param_mod).', `t` = '.($users_tanks['t']+$param_mod).', `p` = '.($users_tanks['p']+$param_mod).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="medium bold pb5 green1"><img src="/images/icons/victory.png"> Установлен новый модуль <img src="/images/icons/victory.png"></div>
<div class="mb5 inbl ta_l"><div class="thumb fl"><img src="/images/modules/sidearmor/y_'.$year.'.png?2"><span class="brd_'.$coun_tank_en.'"></span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Боковая броня</span><br><span class="green1">+'.$param_mod.' ко всем параметрам</span><br>'.$year.' год</div>
<div class="clrb"></div></div></div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}

if($users_tanks_modification['5']<6){
echo '<div class="small bold green2 cntr sh_b mb5">Новый модуль для танка</div>';
echo '<div class="trnt-block '.$mb0.'" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl w100"><div class="thumb fl"><img src="/images/modules/sidearmor/y_'.$year.'.png?2"><span class="brd_'.$coun_tank_en.'"></span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Боковая броня</span><br><span class="green1">+'.$param_mod.' ко всем параметрам</span><br>'.$year.' год</div><div class="clrb"></div></div>';
if($users_tanks_modification['5']<6){echo '<div class="bot"><a class="simple-but border" w:id="selectLink" href="?mod'.$gold.''.$tip.'"><span><span>Модификация за <img title="Золото" alt="Золото" src="/images/icons/gold.png?1"> '.$gold.'</span></span></a></div>';}
echo '</div></div></div></div></div></div></div></div></div></div><br>';
}else{
echo '<div class="small bold green2 cntr sh_b mb5">Сейчас на танке</div>';
echo '<div class="trnt-block mb0" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl w100"><div class="thumb fl"><img src="/images/modules/sidearmor/y_1945.png?2"><span class="brd_'.$coun_tank_en.'"></span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Боковая броня</span><br><span class="green">+30 ко всем параметрам</span><br>1945 год</div><div class="clrb"></div></div>';
echo '</div></div></div></div></div></div></div></div></div></div>';
}
}



if($tip == 6){
if($users_tanks_modification['6']==0){$param_mod = 5;$year = 1940;$gold = 10;}
if($users_tanks_modification['6']==1){$param_mod = 5;$year = 1941;$gold = 50;}
if($users_tanks_modification['6']==2){$param_mod = 5;$year = 1942;$gold = 100;}
if($users_tanks_modification['6']==3){$param_mod = 5;$year = 1943;$gold = 250;}
if($users_tanks_modification['6']==4){$param_mod = 5;$year = 1944;$gold = 500;}
if($users_tanks_modification['6']==5){$param_mod = 5;$year = 1945;$gold = 1000;}
if($users_tanks_modification['6']==6){$mb0 = 'mb0';}else{$mb0 = 'mb1';}


if($prom['time_11']>time()){$gold = ceil($gold-($gold*$prom['act_11']/100));}else{$gold = $gold;}


if(isset($_GET['mod'.$gold.''.$tip.''])){
if($users_tanks_modification['6']>=6){header('Location: ?');exit();}
if($user['gold'] < $gold){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($gold-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
if(!$users_tanks_modification){
$mysqli->query('INSERT INTO `users_tanks_modification` SET `user` = '.$user['id'].', `6` = "1", `a` = '.$param_mod.', `b` = '.$param_mod.', `t` = '.$param_mod.', `p` = '.$param_mod.', `id_tank` = '.$tank['id'].' ');
}else{
$mysqli->query('UPDATE `users_tanks_modification` SET `6` = '.($users_tanks_modification['6']+1).', `a` = '.($users_tanks_modification['a']+$param_mod).', `b` = '.($users_tanks_modification['b']+$param_mod).', `t` = '.($users_tanks_modification['t']+$param_mod).', `p` = '.($users_tanks_modification['p']+$param_mod).' WHERE `id` = '.$users_tanks_modification['id'].' LIMIT 1');
}
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-$gold).' WHERE `id` = '.$user['id'].' LIMIT 1');
$mysqli->query('UPDATE `users_tanks` SET `a` = '.($users_tanks['a']+$param_mod).', `b` = '.($users_tanks['b']+$param_mod).', `t` = '.($users_tanks['t']+$param_mod).', `p` = '.($users_tanks['p']+$param_mod).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="medium bold pb5 green1"><img src="/images/icons/victory.png"> Установлен новый модуль <img src="/images/icons/victory.png"></div>
<div class="mb5 inbl ta_l"><div class="thumb fl"><img src="/images/modules/caterpillar/y_'.$year.'.png?2"><span class="brd_'.$coun_tank_en.'"></span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Гусеницы</span><br><span class="green1">+'.$param_mod.' ко всем параметрам</span><br>'.$year.' год</div>
<div class="clrb"></div></div></div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}

if($users_tanks_modification['6']<6){
echo '<div class="small bold green2 cntr sh_b mb5">Новый модуль для танка</div>';
echo '<div class="trnt-block '.$mb0.'" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl w100"><div class="thumb fl"><img src="/images/modules/caterpillar/y_'.$year.'.png?2"><span class="brd_'.$coun_tank_en.'"></span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Гусеницы</span><br><span class="green1">+'.$param_mod.' ко всем параметрам</span><br>'.$year.' год</div><div class="clrb"></div></div>';
if($users_tanks_modification['6']<6){echo '<div class="bot"><a class="simple-but border" w:id="selectLink" href="?mod'.$gold.''.$tip.'"><span><span>Модификация за <img title="Золото" alt="Золото" src="/images/icons/gold.png?1"> '.$gold.'</span></span></a></div>';}
echo '</div></div></div></div></div></div></div></div></div></div><br>';
}else{
echo '<div class="small bold green2 cntr sh_b mb5">Сейчас на танке</div>';
echo '<div class="trnt-block mb0" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl w100"><div class="thumb fl"><img src="/images/modules/caterpillar/y_1945.png?2"><span class="brd_'.$coun_tank_en.'"></span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Гусеницы</span><br><span class="green">+30 ко всем параметрам</span><br>1945 год</div><div class="clrb"></div></div>';
echo '</div></div></div></div></div></div></div></div></div></div>';
}
}



























echo'<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">Улучшай параметры танка, чтобы повысить танковую мощь!</div>
</div></div></div></div></div></div></div></div></div>
</div>
<a class="simple-but border mb2" w:id="powerLink" href="/modification/'.$ank['id'].'/"><span><span>Назад</span></span></a>';
require_once ('../system/footer.php');
?>