<?php
$title = 'Модификация танка';
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





$res = $mysqli->query('SELECT * FROM `users_tanks_modification` WHERE `user` = '.$ank['id'].' and `id_tank`  = "'.$tank['id'].'" LIMIT 1');
$users_tanks_modification = $res->fetch_assoc();


if($ank['id']!=$user['id']){$mb0 = 'mb0';}else{if($users_tanks_modification['1']<6){$mb0 = '';}else{$mb0 = 'mb1';}}
if($ank['id']!=$user['id']){$mb1 = 'mb0';}else{if($users_tanks_modification['2']<6){$mb1 = '';}else{$mb1 = 'mb1';}}
if($ank['id']!=$user['id']){$mb2 = 'mb0';}else{if($users_tanks_modification['3']<6){$mb2 = '';}else{$mb2 = 'mb1';}}
if($ank['id']!=$user['id']){$mb3 = 'mb0';}else{if($users_tanks_modification['4']<6){$mb3 = '';}else{$mb3 = 'mb1';}}
if($ank['id']!=$user['id']){$mb4 = 'mb0';}else{if($users_tanks_modification['5']<6){$mb4 = '';}else{$mb4 = 'mb1';}}
if($ank['id']!=$user['id']){$mb5 = 'mb0';}else{if($users_tanks_modification['6']<6){$mb5 = '';}else{$mb5 = 'mb1';}}





if($tank['tip'] != 3){
if($users_tanks_modification['1']==0){$param_mod = 0;$year = 1939;}
if($users_tanks_modification['1']==1){$param_mod = 5;$year = 1940;}
if($users_tanks_modification['1']==2){$param_mod = 10;$year = 1941;}
if($users_tanks_modification['1']==3){$param_mod = 15;$year = 1942;}
if($users_tanks_modification['1']==4){$param_mod = 20;$year = 1943;}
if($users_tanks_modification['1']==5){$param_mod = 25;$year = 1944;}
if($users_tanks_modification['1']==6){$param_mod = 30;$year = 1945;}
echo '<div class="trnt-block '.$mb0.'" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl w100"><div class="thumb fl"><img src="/images/modules/tower/y_'.$year.'.png?2"><span class="brd_'.$coun_tank_en.'"></span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Башня</span><br>+'.$param_mod.' ко всем параметрам<br>'.$year.' год</div><div class="clrb"></div></div>';
if($ank['id']==$user['id']){if($users_tanks_modification['1']<6){echo '<div class="bot"><a class="simple-but border" w:id="selectLink" href="/modselect/'.$ank['id'].'/1/"><span><span>Модификация модуля</span></span></a></div>';}}
echo '</div></div></div></div></div></div></div></div></div></div>';
}


if($tank['tip'] != 3){
if($users_tanks_modification['2']==0){$param_mod = 0;$year = 1939;}
if($users_tanks_modification['2']==1){$param_mod = 10;$year = 1940;}
if($users_tanks_modification['2']==2){$param_mod = 20;$year = 1941;}
if($users_tanks_modification['2']==3){$param_mod = 30;$year = 1942;}
if($users_tanks_modification['2']==4){$param_mod = 40;$year = 1943;}
if($users_tanks_modification['2']==5){$param_mod = 50;$year = 1944;}
if($users_tanks_modification['2']==6){$param_mod = 60;$year = 1945;}
}else{
if($users_tanks_modification['2']==0){$param_mod = 0;$year = 1939;}
if($users_tanks_modification['2']==1){$param_mod = 15;$year = 1940;}
if($users_tanks_modification['2']==2){$param_mod = 30;$year = 1941;}
if($users_tanks_modification['2']==3){$param_mod = 45;$year = 1942;}
if($users_tanks_modification['2']==4){$param_mod = 60;$year = 1943;}
if($users_tanks_modification['2']==5){$param_mod = 75;$year = 1944;}
if($users_tanks_modification['2']==6){$param_mod = 90;$year = 1945;}
}
echo '<div class="trnt-block '.$mb1.'" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl w100"><div class="thumb fl"><img src="/images/modules/cannon/y_'.$year.'.png?2"><span class="brd_'.$coun_tank_en.'"></span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Орудие</span><br>+'.$param_mod.' ко всем параметрам<br>'.$year.' год</div><div class="clrb"></div></div>';
if($ank['id']==$user['id']){if($users_tanks_modification['2']<6){echo '<div class="bot"><a class="simple-but border" w:id="selectLink" href="/modselect/'.$ank['id'].'/2/"><span><span>Модификация модуля</span></span></a></div>';}}
echo '</div></div></div></div></div></div></div></div></div></div>';




if($users_tanks_modification['3']==0){$param_mod = 0;$year = 1939;}
if($users_tanks_modification['3']==1){$param_mod = 5;$year = 1940;}
if($users_tanks_modification['3']==2){$param_mod = 10;$year = 1941;}
if($users_tanks_modification['3']==3){$param_mod = 15;$year = 1942;}
if($users_tanks_modification['3']==4){$param_mod = 20;$year = 1943;}
if($users_tanks_modification['3']==5){$param_mod = 25;$year = 1944;}
if($users_tanks_modification['3']==6){$param_mod = 30;$year = 1945;}
echo '<div class="trnt-block '.$mb2.'" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl w100"><div class="thumb fl"><img src="/images/modules/machinegun/y_'.$year.'.png?2"><span class="brd_'.$coun_tank_en.'"></span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Пулемет</span><br>+'.$param_mod.' ко всем параметрам<br>'.$year.' год</div><div class="clrb"></div></div>';
if($ank['id']==$user['id']){if($users_tanks_modification['3']<6){echo '<div class="bot"><a class="simple-but border" w:id="selectLink" href="/modselect/'.$ank['id'].'/3/"><span><span>Модификация модуля</span></span></a></div>';}}
echo '</div></div></div></div></div></div></div></div></div></div>';


if($users_tanks_modification['4']==0){$param_mod = 0;$year = 1939;}
if($users_tanks_modification['4']==1){$param_mod = 5;$year = 1940;}
if($users_tanks_modification['4']==2){$param_mod = 10;$year = 1941;}
if($users_tanks_modification['4']==3){$param_mod = 15;$year = 1942;}
if($users_tanks_modification['4']==4){$param_mod = 20;$year = 1943;}
if($users_tanks_modification['4']==5){$param_mod = 25;$year = 1944;}
if($users_tanks_modification['4']==6){$param_mod = 30;$year = 1945;}
echo '<div class="trnt-block '.$mb3.'" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl w100"><div class="thumb fl"><img src="/images/modules/frontalarmor/y_'.$year.'.png?2"><span class="brd_'.$coun_tank_en.'"></span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Лобовая броня</span><br>+'.$param_mod.' ко всем параметрам<br>'.$year.' год</div><div class="clrb"></div></div>';
if($ank['id']==$user['id']){if($users_tanks_modification['4']<6){echo '<div class="bot"><a class="simple-but border" w:id="selectLink" href="/modselect/'.$ank['id'].'/4/"><span><span>Модификация модуля</span></span></a></div>';}}
echo '</div></div></div></div></div></div></div></div></div></div>';


if($users_tanks_modification['5']==0){$param_mod = 0;$year = 1939;}
if($users_tanks_modification['5']==1){$param_mod = 5;$year = 1940;}
if($users_tanks_modification['5']==2){$param_mod = 10;$year = 1941;}
if($users_tanks_modification['5']==3){$param_mod = 15;$year = 1942;}
if($users_tanks_modification['5']==4){$param_mod = 20;$year = 1943;}
if($users_tanks_modification['5']==5){$param_mod = 25;$year = 1944;}
if($users_tanks_modification['5']==6){$param_mod = 30;$year = 1945;}
echo '<div class="trnt-block '.$mb4.'" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl w100"><div class="thumb fl"><img src="/images/modules/sidearmor/y_'.$year.'.png?2"><span class="brd_'.$coun_tank_en.'"></span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Боковая броня</span><br>+'.$param_mod.' ко всем параметрам<br>'.$year.' год</div><div class="clrb"></div></div>';
if($ank['id']==$user['id']){if($users_tanks_modification['5']<6){echo '<div class="bot"><a class="simple-but border" w:id="selectLink" href="/modselect/'.$ank['id'].'/5/"><span><span>Модификация модуля</span></span></a></div>';}}
echo '</div></div></div></div></div></div></div></div></div></div>';


if($users_tanks_modification['6']==0){$param_mod = 0;$year = 1939;}
if($users_tanks_modification['6']==1){$param_mod = 5;$year = 1940;}
if($users_tanks_modification['6']==2){$param_mod = 10;$year = 1941;}
if($users_tanks_modification['6']==3){$param_mod = 15;$year = 1942;}
if($users_tanks_modification['6']==4){$param_mod = 20;$year = 1943;}
if($users_tanks_modification['6']==5){$param_mod = 25;$year = 1944;}
if($users_tanks_modification['6']==6){$param_mod = 30;$year = 1945;}
echo '<div class="trnt-block '.$mb5.'" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl w100"><div class="thumb fl"><img src="/images/modules/caterpillar/y_'.$year.'.png?2"><span class="brd_'.$coun_tank_en.'"></span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Гусеницы</span><br>+'.$param_mod.' ко всем параметрам<br>'.$year.' год</div><div class="clrb"></div></div>';
if($ank['id']==$user['id']){if($users_tanks_modification['6']<6){echo '<div class="bot"><a class="simple-but border" w:id="selectLink" href="/modselect/'.$ank['id'].'/6/"><span><span>Модификация модуля</span></span></a></div>';}}
echo '</div></div></div></div></div></div></div></div></div></div>';













echo'<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">Улучшай параметры танка, чтобы повысить танковую мощь!</div>
</div></div></div></div></div></div></div></div></div>
</div>
<a class="simple-but border mb2" w:id="powerLink" href="/power/'.$ank['id'].'/"><span><span>Назад</span></span></a>';
require_once ('../system/footer.php');
?>