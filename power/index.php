<?php
$title = 'Прокачка танка';
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





if($tank['tip'] == 1){$tip_tank = 'average';$tip_tank_ru = 'СРЕДНИЙ ТАНК';} // СТ
if($tank['tip'] == 2){$tip_tank = 'heavy';$tip_tank_ru = 'ТЯЖЕЛЫЙ ТАНК';} // ТТ
if($tank['tip'] == 3){$tip_tank = 'SAU';$tip_tank_ru = 'ПТ-САУ';} // САУ

if($tank['country'] == 'GERMANY'){$coun_tank = 'ГЕРМАНИЯ';$coun_tank_en = 'germany';$angar = 'bg_germany flag_short';}
if($tank['country'] == 'SSSR'){$coun_tank = 'СССР';$coun_tank_en = 'ussr';$angar = 'bg_ussr flag_short';}
if($tank['country'] == 'USA'){$coun_tank = 'США';$coun_tank_en = 'usa';$angar = 'bg_usa flag_short';}

if($ank['side'] == 1){$side = 'empire';}else{$side = 'federation';}

$sum_param = $users_tanks['a']+$users_tanks['b']+$users_tanks['t']+$users_tanks['p'];










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
















if($users_tanks['user']!=$user['id']){$viev = 'Посмотреть';}else{$viev = 'Улучшить';}

$res = $mysqli->query('SELECT * FROM `users_tanks_pimp` WHERE `user` = '.$ank['id'].' and `tip_tank` = '.$tank['tip'].' LIMIT 1');
$users_tanks_pimp = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `users_tanks_upgrade` WHERE `user` = '.$ank['id'].' and `tip_tank` = '.$tank['tip'].' LIMIT 1');
$users_tanks_upgrade = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `users_tanks_modification` WHERE `user` = '.$ank['id'].' and `id_tank` = '.$tank['id'].' LIMIT 1');
$users_tanks_modification = $res->fetch_assoc();






if(!$users_tanks_pimp){$sup_pimp = 0;}else{$sup_pimp = $users_tanks_pimp['a']+$users_tanks_pimp['b']+$users_tanks_pimp['t']+$users_tanks_pimp['p'];}
$sup_pimp_prog = round(100/(800/($sup_pimp+0.0000001)));
if($sup_pimp_prog > 100) {$sup_pimp_prog = 100;}
echo'<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="inbl"><div class="thumb fl"><img width="14" height="14" w:id="img" src="/images/power/Improvement.jpg"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Улучшение танка</span><br>Прогресс: '.$sup_pimp.' из 800</div>';
echo '<table class="rblock blue esmall"><tbody><tr>
<td><div class="value-block lh1"><span><span>'.$sup_pimp.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$sup_pimp_prog.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$sup_pimp_prog.'%</span></span></div></td>
</tr></tbody></table>
<div class="clrb"></div></div>
<div class="bot a_w50"><a class="simple-but border" w:id="link" href="/pimp/'.$ank['id'].'/"><span><span>'.$viev.'</span></span></a></div>
</div></div></div></div></div></div></div></div></div></div>';




if(!$users_tanks_upgrade){$sup_upgrade = 0;}else{$sup_upgrade = $users_tanks_upgrade['a']+$users_tanks_upgrade['b']+$users_tanks_upgrade['t']+$users_tanks_upgrade['p'];}
$sup_upgrade_prog = round(100/(400/($sup_upgrade+0.0000001)));
if($sup_upgrade_prog > 100) {$sup_upgrade_prog = 100;}
echo'<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="inbl"><div class="thumb fl"><img width="14" height="14" w:id="img" src="/images/power/Upgrade.jpg"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Апгрейд танка</span><br>Прогресс: '.$sup_upgrade.' из 400</div>';
echo '<table class="rblock blue esmall"><tbody><tr>
<td><div class="value-block lh1"><span><span>'.$sup_upgrade.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$sup_upgrade_prog.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$sup_upgrade_prog.'%</span></span></div></td>
</tr></tbody></table>
<div class="clrb"></div></div>
<div class="bot a_w50"><a class="simple-but border" w:id="link" href="/upgrade/'.$ank['id'].'/"><span><span>'.$viev.'</span></span></a></div>
</div></div></div></div></div></div></div></div></div></div>';




if(!$users_tanks_modification){$sup_mod = 0;}else{$sup_mod = $users_tanks_modification['a'];}
$sup_mod_prog = round(100/(210/($sup_mod+0.0000001)));
if($sup_mod_prog > 100) {$sup_mod_prog = 100;}
echo'<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="inbl"><div class="thumb fl"><img width="14" height="14" w:id="img" src="/images/power/Modification.jpg"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Модификация танка</span><br>Прогресс: '.$sup_mod.' из 210</div>';
echo '<table class="rblock blue esmall"><tbody><tr>
<td><div class="value-block lh1"><span><span>'.$sup_mod.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$sup_mod_prog.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$sup_mod_prog.'%</span></span></div></td>
</tr></tbody></table>
<div class="clrb"></div></div>
<div class="bot a_w50"><a class="simple-but border" w:id="link" href="/modification/'.$ank['id'].'/"><span><span>'.$viev.'</span></span></a></div>
</div></div></div></div></div></div></div></div></div></div>';























if($users_tanks['user']!=$user['id']){
$res = $mysqli->query('SELECT * FROM `traning` WHERE `user` = '.$ank['id'].' LIMIT 1');
$traning = $res->fetch_assoc();

if(!$traning){$sup_train = 0;}else{$sup_train = ($traning['a_level']+$traning['b_level']+$traning['t_level']+$traning['p_level']);}
$sup_train_prog = round(100/(400/($sup_train+0.0000001)));
if($sup_train_prog > 100) {$sup_train_prog = 100;}
echo'<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="inbl"><div class="thumb fl"><img width="14" height="14" w:id="img" src="/images/power/Training.jpg"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Тренировка звания</span><br>Прогресс: '.$sup_train.' из 400</div>';
echo '<table class="rblock blue esmall"><tbody><tr>
<td><div class="value-block lh1"><span><span>'.$sup_train.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$sup_train_prog.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$sup_train_prog.'%</span></span></div></td>
</tr></tbody></table>
<div class="clrb"></div></div>
<div class="bot a_w50"><a class="simple-but border" w:id="link" href="/training/'.$ank['id'].'/"><span><span>'.$viev.'</span></span></a></div>
</div></div></div></div></div></div></div></div></div></div>';




$res_sum_crew = mysqli_query($mysqli,'SELECT sum(rang) FROM crew_user WHERE `user`  = "'.$ank['id'].'"');
if (FALSE === $res_sum_crew) die("Select sum failed: ".mysqli_error);
$row = mysqli_fetch_row($res_sum_crew);
$sum_crew = $row[0];



if($sum_crew<=0){$sup_crew = 0;}else{$sup_crew = $sum_crew;}
$sup_train_prog = round(100/(100/($sup_crew+0.0000001)));
if($sup_train_prog > 100) {$sup_train_prog = 100;}
echo'<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="inbl"><div class="thumb fl"><img width="14" height="14" w:id="img" src="/images/power/Crew.jpg"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Обучение экипажа</span><br>Прогресс: '.$sup_crew.' из 100</div>';
echo '<table class="rblock blue esmall"><tbody><tr>
<td><div class="value-block lh1"><span><span>'.$sup_crew.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$sup_train_prog.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$sup_train_prog.'%</span></span></div></td>
</tr></tbody></table>
<div class="clrb"></div></div>
<div class="bot a_w50"><a class="simple-but border" w:id="link" href="/crew/'.$ank['id'].'/"><span><span>'.$viev.'</span></span></a></div>
</div></div></div></div></div></div></div></div></div></div>';










$res = $mysqli->query('SELECT * FROM `shellskills` WHERE `user` = "'.$ank['id'].'" LIMIT 1');
$shell_s = $res->fetch_assoc();
$sum_ss = ($shell_s['o']+$shell_s['b']+$shell_s['f']+$shell_s['k']);

if($sum_ss<=0){$sum_ss = 0;}else{$sum_ss = $sum_ss;}
$sum_ss_prog = round(100/(200/($sum_ss+0.0000001)));
if($sum_ss_prog > 100) {$sum_ss_prog = 100;}
echo'<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="inbl"><div class="thumb fl"><img width="14" height="14" w:id="img" src="/images/power/ShellSkills.jpg"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Навыки стрельбы</span><br>Прогресс: '.$sum_ss.' из 200</div>';
echo '<table class="rblock blue esmall"><tbody><tr>
<td><div class="value-block lh1"><span><span>'.$sum_ss.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$sum_ss_prog.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$sum_ss_prog.'%</span></span></div></td>
</tr></tbody></table>
<div class="clrb"></div></div>
<div class="bot a_w50"><a class="simple-but border" w:id="link" href="/shellskills/'.$ank['id'].'/"><span><span>'.$viev.'</span></span></a></div>
</div></div></div></div></div></div></div></div></div></div>';





$res_sum_crew = mysqli_query($mysqli,'SELECT sum(level) FROM skills_user WHERE `user`  = "'.$ank['id'].'"');
if (FALSE === $res_sum_crew) die("Select sum failed: ".mysqli_error);
$row = mysqli_fetch_row($res_sum_crew);
$sum_s = $row[0];

if($sum_s<=0){$sum_s = 0;}else{$sum_s = $sum_s;}
$sum_s_prog = round(100/(335/($sum_s+0.0000001)));
if($sum_s_prog > 100) {$sum_s_prog = 100;}
echo'<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="inbl"><div class="thumb fl"><img width="14" height="14" w:id="img" src="/images/power/Skills1.jpg"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Изучение умений</span><br>Прогресс: '.$sum_s.' из 335</div>';
echo '<table class="rblock blue esmall"><tbody><tr>
<td><div class="value-block lh1"><span><span>'.$sum_s.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$sum_s_prog.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$sum_s_prog.'%</span></span></div></td>
</tr></tbody></table>
<div class="clrb"></div></div>
<div class="bot a_w50"><a class="simple-but border" w:id="link" href="/skills/'.$ank['id'].'/"><span><span>'.$viev.'</span></span></a></div>
</div></div></div></div></div></div></div></div></div></div>';



}











echo'<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr"><img class="vb pb2" height="14" width="14" src="/images/upgrades/starFull.png"> Танковая мощь: сумма всех параметров танка</div>
</div></div></div></div></div></div></div></div></div></div>';
require_once ('../system/footer.php');
?>