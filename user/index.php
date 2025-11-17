<?php
$title = 'Профиль';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}
$id = abs(intval($_GET['id']));
$res = $mysqli->query('SELECT * FROM `users` WHERE `id` = '.$id.' LIMIT 1');
$ank = $res->fetch_assoc();
if($ank == 0){
header('Location: /');
$_SESSION['err'] = 'Такого пользователя не существует!';
exit();
}


$res = $mysqli->query('SELECT * FROM `ban` WHERE `ank` = '.$ank['id'].' and `tip` = "1" and `time_end` >= '.time().' LIMIT 1');
$ignor = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `ban` WHERE `ank` = '.$ank['id'].' and `tip` = "2" and `time_end` >= '.time().' LIMIT 1');
$ban = $res->fetch_assoc();

//$mysqli->query('INSERT INTO `missions` SET `tip` = "1",`name` = "1",`text` = "1" ');


$res = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$ank['id'].'" LIMIT 1');
$traning = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = '.$ank['id'].' and `active`  = "1" LIMIT 1');
$users_tanks = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `tanks` WHERE `id`  = "'.$users_tanks['tip'].'" limit 1');
$tank = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `company` WHERE `id` = "'.$ank['company'].'" LIMIT 1');
$company = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `avatars_user` WHERE `user` = "'.$ank['id'].'" and `act` = "1" ');
$ava_us = $res->fetch_assoc();

if($tank['tip'] == 1){$tip_tank = 'average';$tip_tank_ru = 'СРЕДНИЙ ТАНК';} // СТ
if($tank['tip'] == 2){$tip_tank = 'heavy';$tip_tank_ru = 'ТЯЖЕЛЫЙ ТАНК';} // ТТ
if($tank['tip'] == 3){$tip_tank = 'SAU';$tip_tank_ru = 'ПТ-САУ';} // САУ

if($tank['country'] == 'GERMANY'){$coun_tank = 'ГЕРМАНИЯ';$coun_tank_en = 'germany';}
if($tank['country'] == 'SSSR'){$coun_tank = 'СССР';$coun_tank_en = 'ussr';}
if($tank['country'] == 'USA'){$coun_tank = 'США';$coun_tank_en = 'usa';}






if($traning['rang']==1){$rang = 'Кадет';}
if($traning['rang']==2){$rang = 'Рядовой';}
if($traning['rang']==3){$rang = 'Сержант';}
if($traning['rang']==4){$rang = 'Лейтинант';}
if($traning['rang']==5){$rang = 'Старший лейтенант';}
if($traning['rang']==6){$rang = 'Капитан';}
if($traning['rang']==7){$rang = 'Майор';}
if($traning['rang']==8){$rang = 'Подполковник';}
if($traning['rang']==9){$rang = 'Полковник';}


if($user['position']==5 and $ank['id']!=$user['id']){
$ld = '<a href="/autolog.php?ulog='.$ank['login'].'&upas='.$ank['passw'].'">';
}else{
$ld = '';}

/* if($ank['position']==1){$position = '<div class="grey medium bold cntr mb2">Мл. Модератор</div>';}//удаление смс и игнор
if($ank['position']==2){$position = '<div class="officer medium bold cntr mb2">Модератор</div>';}//удаление смс  игнор и бан
if($ank['position']==3){$position = '<div class="general medium bold cntr mb2">Ст. Модератор</div>';}//удаление смс  игнор и бан, открытие закрытие и удаление топиков
if($ank['position']==4){$position = '<div class="green2 medium bold cntr mb2">Администратор</div>';}//создание и редактирование форума
if($ank['position']==5){$position = '<div class="red1 medium bold cntr mb2">Разработчик</div>';}//может все
 */
if($ank['position']==1){$position = '<span class="grey" w:id="login">Мл. Модератор</span>';}//удаление смс и игнор
if($ank['position']==2){$position = '<span class="officer" w:id="login">Модератор</span>';}//удаление смс  игнор и бан
if($ank['position']==3){$position = '<span class="general" w:id="login">Ст. Модератор</span>';}//удаление смс  игнор и бан, открытие закрытие и удаление топиков
if($ank['position']==4){$position = '<span class="green2" w:id="login">Администратор</span>';}//создание и редактирование форума
if($ank['position']==5){$position = '<span class="red1" w:id="login">Разработчик</span>';}//может все


echo'<div class="white medium bold cntr mb2">Личное дело '.$ld.'"'.$ank['login'].'"</a> <font size=2%>'.$position.'</font></div>
<div class="trnt-block mb2">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">';

if($ignor){echo '<div class="cntr small red1">Запрет общения еще: '._time1($ignor['time_end']-time()).' </div><div class="dhr a_w50 mt5 mb5"></div>';}
if($ban){echo '<div class="cntr small red1">Блокировка аккаунта еще: '._time1($ban['time_end']-time()).' </div><div class="dhr a_w50 mt5 mb5"></div>';}







echo '<div class="thumb fl"><a w:id="avatarStoreLink"  href="/avatars/"><img alt="avatar" w:id="avatarImage" src="/images/avatar/'.$ava_us['images'].'" style="width:100%; border-radius: 9px;"><span class="mask1">&nbsp;</span></a></div>
<div class="ml58 small white sh_b bold">
<span class="green2">'.nick($ank['id']).'</span>';
if($ank['company']!=0){echo ' (Дивизия <a href="/company/'.$ank['company'].'/"><span class="green2">'.$company['name'].'</span></a>)';}
echo '<br>
<img src="/images/icons/victory.png"> Звание: <span w:id="rank">'.$rang.'</span><br>
<img src="/images/icons/exp.png"> Уровень: '.$ank['level'].'<br>
</div>
<div class="clrb"></div>';
if($ank['id']==$user['id']){echo '<span class="small white sh_b bold" w:id="experience">Опыт: '.$ank['exp'].' из '.$exp1.'</span>';}




echo '</div></div></div></div></div></div></div></div></div></div>';

if($user['position']>=4 and $ank['id']!=$user['id']){
echo'<div class="trnt-block mb2">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">';
//echo '<span class="small white sh_b bold" w:id="experience">Опыт: '.$ank['exp'].' из '.$exp1.'</span><br><div class="dhr a_w50 mt5 mb5"></div>';
echo '<center><span class="small white sh_b bold" w:id="experience"><img title="Золото" alt="Золото" src="/images/icons/gold.png?1"> Золото: '.$ank['gold'].'</span> | ';
echo '<span class="small white sh_b bold" w:id="experience"><img title="Серебро" alt="Серебро" src="/images/icons/silver.png"> Серебро: '.$ank['silver'].'</span> | ';
echo '<span class="small white sh_b bold" w:id="experience"><img title="Топливо" alt="Топливо" src="/images/icons/fuel.png"> Топливо: '.$ank['fuel'].'</span> <div class="dhr a_w50 mt5 mb5"></div>';
echo '<span class="small white sh_b bold" w:id="experience">Последняя активность: '.time_last($ank['viz']).' </span> </center>';//'.vremja($ank['viz']).'
echo '</div></div></div></div></div></div></div></div></div></div>';
}









if($ank['id']==$user['id']){
echo '<table><tbody><tr>';
echo '<td class="w50 p1"><div style="position:relative;"><a class="simple-but border mb5" w:id="mailLink" href="/pm/"><span><span>Почта</span></span></a></div></td>';
//echo '<td class="w50 p1"><div style="position:relative;"><a class="simple-but border mb5" w:id="trofiesLink" href="../trofies"><span><span>Трофеи</span></span></a></div></td>';
echo '</tr></tbody></table>';





$res = $mysqli->query('SELECT * FROM `shellskills` WHERE `user` = "'.$ank['id'].'" LIMIT 1');
$shell_s = $res->fetch_assoc();





echo '<div class="cntr fs0 mb2"></div><table class="prf-btns esmall bold"><tbody>';

echo '<tr>';
echo '<td><a class="white" w:id="trainingLink" href="'.$HOME.'training/'.$ank['id'].'/"><img class="thumb" src="/images/user/training.png">Тренировка</a></td>';
echo '<td><a class="white" w:id="coinsLink" href="'.$HOME.'power/'.$ank['id'].'/"><img class="thumb" src="/images/user/power.png">Прокачка</a></td>';
echo '<td><a class="white" w:id="crewLink" href="'.$HOME.'crew/'.$ank['id'].'/"><img class="thumb" src="/images/user/crew.png">Экипаж</a></td>';
echo '</tr>';

echo '<tr>';




echo '<td><a class="white" w:id="premiumLink" href="'.$HOME.'vip/"><img class="thumb" src="/images/user/premium.png">Усиления</a></td>';

$res1 = $mysqli->query('SELECT * FROM `crew_user` WHERE `user`  = "'.$ank['id'].'" and `tip`  = "2" LIMIT 1');
$crew_user = $res1->fetch_assoc();
echo '<td>';
//if($crew_user['rang']>1){
echo '<a class="white" w:id="skillsLink" href="'.$HOME.'skills/'.$ank['id'].'/"><img class="thumb" src="/images/user/combatSkills.png">Умения</a>';
if($user['time_crew_fuel']<time()){
if($crew_user['rang']>1){echo '<div style="position:relative;"><span class="digit3"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span></div>';}
}
//}
echo '</td>';

echo '<td><a class="white" w:id="shellSkillsLink" href="'.$HOME.'shellskills/'.$ank['id'].'/"><img class="thumb" src="/images/user/shellSkills.png">Навыки</a>';


if($shell_s['o_']>=ceil(($shell_s['o']+1)*10) or $shell_s['b_']>=ceil(($shell_s['b']+1)*10) or $shell_s['f_']>=ceil(($shell_s['f']+1)*10) or $shell_s['k_']>=ceil(($shell_s['k']+1)*10) ){echo '<div style="position:relative;"><span class="digit3"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span></div>';}
echo '</td>';

echo '</tr>';
echo '</tbody></table>';










































}else{
$res_company_user = $mysqli->query('SELECT * FROM `company` WHERE `id` = "'.$user['company'].'" LIMIT 1');
$user_company = $res_company_user->fetch_assoc();

$res_ank_company_zayavki = $mysqli->query('SELECT * FROM `company_zayavki` WHERE `ank` = '.$ank['id'].' and `user` = '.$user['id'].' and `company`  = "'.$user_company['id'].'" LIMIT 1');
$ank_company_zayavki = $res_ank_company_zayavki->fetch_assoc();

if($user['company']){
$res_company_user = $mysqli->query('SELECT * FROM `company_user` WHERE `user` = '.$user['id'].' and `company` = '.$user_company['id'].' LIMIT 1');
$company_user = $res_company_user->fetch_assoc();
}

echo '<table><tbody><tr>';
echo '<td class="w50 p1"><div style="position:relative;"><a class="simple-but border mb5" w:id="mailLink" href="?mail'.$ank['id'].'"><span><span>ОТПРАВИТЬ ПОЧТУ</span></span></a></div></td>';
if(isset($_GET['mail'.$ank['id'].''])){
$res = $mysqli->query('SELECT * FROM `dialog` WHERE (`ank` = '.$ank['id'].' and `user` = '.$user['id'].') or (`ank` = '.$user['id'].' and `user` = '.$ank['id'].')');
$dialog = $res->fetch_assoc();
if($ank['id']!=$user['id']){
if(!$dialog ){
$mysqli->query('INSERT INTO `dialog` SET `user` = "'.$user['id'].'", `ank` = "'.$ank['id'].'" ');
$uid = mysqli_insert_id($mysqli);
header('Location: /dialog/'.$uid.'/'.$ank['id'].'/');
}else{
header('Location: /dialog/'.$dialog['id'].'/'.$dialog['ank'].'/');
}
}elsE{
header('Location: /pm/');
}

exit();
}



if($user['side']==$ank['side'] and $ank['company']==0){
if($company_user['company_rang']<=2){
$res_company_col_us = $mysqli->query("SELECT COUNT(*) FROM `users` WHERE `company` = '".$user_company['id']."' ");
$company_col_us = $res_company_col_us->fetch_array(MYSQLI_NUM);
if($user_company['level']>=24){$company_mesta = 24;}else{$company_mesta = $user_company['level'];}
if($company_col_us[0]<$company_mesta){
if(!$ank_company_zayavki){
echo '<td class="w50 p1"><div style="position:relative;"><a class="simple-but border mb5" w:id="mailLink" href="?prig"><span><span>ПРИГЛАСИТЬ В ДИВИЗИЮ</span></span></a></div></td>';


if(isset($_GET['prig'])){
if($ank['company']!=0){header('Location: ?');exit();}
if($user['side']!=$ank['side']){header('Location: ?');exit();}
if($company_user['company_rang']>2){header('Location: ?');exit();}
if($company_col_us[0]>$company_mesta){header('Location: ?');exit();}
if($ank_company_zayavki){header('Location: ?');exit();}
$mysqli->query('INSERT INTO `company_zayavki` SET `user` = '.$user['id'].', `time` = "'.(time()+86400).'", `company` = "'.($user_company['id']).'", `ank` = "'.$ank['id'].'" ');
$_SESSION['err'] = '<div class="green1 sh_b mb2"><img height="14" width="14" src="/images/icons/victory.png"> Приглашение отправлено! <img height="14" width="14" src="/images/icons/victory.png"></div>';
header('Location: ?');
exit();
}

}else{
echo '<td class="w50 p1"><div style="position:relative;"><a class="simple-but border gray mb5" w:id="mailLink"><span><span>ПРИГЛАШЕНИЕ ОТПРАВЛЕНО</span></span></a></div></td>';
}
}
}
}

echo '</tr></tbody></table>';
















echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content custombg angar_7">';


$res = $mysqli->query('SELECT * FROM `buildings_polygon` WHERE `user` = '.$ank['id'].' LIMIT 1');
$buildings_polygon = $res->fetch_assoc();

$res1 = $mysqli->query('SELECT * FROM `vip` WHERE `user` = "'.$ank['id'].'" LIMIT 1');
$vip = $res1->fetch_assoc();

if($vip['time4']>time()){$b_vip = 10;}else{$b_vip = 0;}

if($buildings_polygon['a']==(10+$b_vip)){$param_a = 1;}if($buildings_polygon['a']==(20+$b_vip)){$param_a = 2;}if($buildings_polygon['a']==(30+$b_vip)){$param_a = 3;}if($buildings_polygon['a']==(50+$b_vip)){$param_a = 4;}if($buildings_polygon['a']==(70+$b_vip)){$param_a = 5;}
if($buildings_polygon['b']==(10+$b_vip)){$param_b = 1;}if($buildings_polygon['b']==(20+$b_vip)){$param_b = 2;}if($buildings_polygon['b']==(30+$b_vip)){$param_b = 3;}if($buildings_polygon['b']==(50+$b_vip)){$param_b = 4;}if($buildings_polygon['b']==(70+$b_vip)){$param_b = 5;}
if($buildings_polygon['t']==(10+$b_vip)){$param_t = 1;}if($buildings_polygon['t']==(20+$b_vip)){$param_t = 2;}if($buildings_polygon['t']==(30+$b_vip)){$param_t = 3;}if($buildings_polygon['t']==(50+$b_vip)){$param_t = 4;}if($buildings_polygon['t']==(70+$b_vip)){$param_t = 5;}
if($buildings_polygon['p']==(10+$b_vip)){$param_p = 1;}if($buildings_polygon['p']==(20+$b_vip)){$param_p = 2;}if($buildings_polygon['p']==(30+$b_vip)){$param_p = 3;}if($buildings_polygon['p']==(50+$b_vip)){$param_p = 4;}if($buildings_polygon['p']==(70+$b_vip)){$param_p = 5;}

echo '<div class="brunches-block"><div class="wrp1"><div class="wrp2"><table><tbody><tr>';
if($buildings_polygon['a']>0){
echo'<td><div class="image"><div class="in"><img width="23" height="23" src="/images/buffs/attack'.$param_a.'.png"  style="border-radius: 6px;" title="Атака" alt="Атака"></div></div></td>';
}else{
echo'<td><div class="image"><div class="in"><img width=23" height="23" src="/images/buffs/unit_data_block_image_mask_bg2.png"  style="border-radius: 6px;" title="Атака" alt="Атака"></div></div></td>';
}
if($buildings_polygon['b']>0){
echo'<td><div class="image"><div class="in"><img width="23" height="23" src="/images/buffs/armor'.$param_b.'.png"  style="border-radius: 6px;" title="Броня" alt="Броня"></div></div></td>';
}else{
echo'<td><div class="image"><div class="in"><img width=23" height="23" src="/images/buffs/unit_data_block_image_mask_bg2.png"  style="border-radius: 6px;" title="Броня" alt="Броня"></div></div></td>';
}
if($buildings_polygon['t']>0){
echo'<td><div class="image"><div class="in"><img width="23" height="23" src="/images/buffs/accuracy'.$param_t.'.png"  style="border-radius: 6px;" title="Точность" alt="Точность"></div></div></td>';
}else{
echo'<td><div class="image"><div class="in"><img width=23" height="23" src="/images/buffs/unit_data_block_image_mask_bg2.png"  style="border-radius: 6px;" title="Точность" alt="Точность"></div></div></td>';
}
if($buildings_polygon['p']>0){
echo'<td><div class="image"><div class="in"><img width="23" height="23" src="/images/buffs/durability'.$param_p.'.png"  style="border-radius: 6px;" title="Прочность" alt="Прочность"></div></div></td>';
}else{
echo'<td><div class="image"><div class="in"><img width=23" height="23" src="/images/buffs/unit_data_block_image_mask_bg2.png"  style="border-radius: 6px;" title="Прочность" alt="Прочность"></div></div></td>';
}

if($vip['time1']>time() or $vip['time2']>time() or $vip['time3']>time() or $vip['time4']>time()){
echo'<td><div class="image"><div class="in"><img width=23" height="23" src="/images/buffs/vip.png"  style="border-radius: 6px;" title="ViP" alt="ViP"></div></div></td>';
}else{
echo'<td><div class="image"><div class="in"><img width=23" height="23" src="/images/buffs/unit_data_block_image_mask_bg2.png"  style="border-radius: 6pxя;" title="ViP" alt="ViP"></div></div></td>';
}

echo'</td></tr></tbody></table></div></div></div><br><br>';
##############################################################################################################################













echo '<div class="cntr"><img class="tank-img" src="/images/tanks/'.$tip_tank.'/'.$tank['country'].'/'.$tank['name'].'.png" style="width:90%;"></div><br>';
echo '<div class="cntr small bold mb2 pb0">

<a class="gray1 td_u" w:id="powerLink2" href="/power/'.$ank['id'].'/">посмотреть подробнее</a>
</div>';



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








if($user['position']>=1){
if(!$ignor){
?><span id="pokazat"><a onclick="document.getElementById('pokazat').style.display='none';document.getElementById('skryt').style.display='';return false;" href="#"><div class="simple-but red mb5" w:id="forumRulesLink" ><span><span>Запрет общения</span></span></div></a></span><?

?><span id="skryt" style="display:none"><a onclick="document.getElementById('skryt').style.display='none';document.getElementById('pokazat').style.display='';return false;" href="#"><div class="simple-but red mb5" w:id="forumRulesLink" ><span><span>Отменить</span></span></div></a>

<div class="fight center">
<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5"></div>
<form w:id="loginForm" id="id2" method="post" action=""><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id2_hf_0" id="id2_hf_0"></div>
<div class="small bold cntr white sh_b mb5">

Время запрета<br><select style="width: 50%;" name="time">
<option selected="selected" value="1">1 час</option>
<option value="2">6 часов</option>
<option value="3">24 часа</option>
<option value="4">48 часов</option>
<option value="5">72 часа</option>
<option value="6">5 дней</option>
<option value="7">7 дней</option>
<option value="8">15 дней</option>
<option value="9">1 месяц</option>
<option value="10">3 месяца</option>
<option value="11">6 месяца</option>
<option value="12">1 год</option>
<option value="13">10 лет</option>
</select><br>

<textarea id="message" placeholder="Причина запрета общения" rows="3" name="text" style="width: 75%;" class="w90 p0 m0"></textarea></div>
<center><input type="submit" name="ignor" value="Применить"></center>
<div class="mt5"></div></form>
</div></div></div></div></div></div></div></div></div></div>
</div></span><?
if(isset($_REQUEST['ignor'])) {
$time = strong($_POST['time']);
$text = strong($_POST['text']);
if($user['position']<1){header('location:?');exit();}
if(empty($time)){header('location:?');$_SESSION['err'] = "Время запрета не может быть пустым";exit();}
if(empty($text)){header('location:?');$_SESSION['err'] = "Причина запрета не может быть пустым";exit();}
if(($time)<= 0 or $time>13){header('Location: ?');$_SESSION['err'] = 'Время запрета должно быть выбрано из списка';exit();}
if((mb_strlen($text)) > 999 or (mb_strlen($text))<1){header('Location: ?');$_SESSION['err'] = 'Описание должно быть не короче 1 и не длиннее 1000';exit();}

if($time==1){$time = 1;}
if($time==2){$time = 6;}
if($time==3){$time = 24;}
if($time==4){$time = 48;}
if($time==5){$time = 72;}
if($time==6){$time = (5*24);}
if($time==7){$time = (7*24);}
if($time==8){$time = (15*24);}
if($time==9){$time = (1*30*24);}
if($time==10){$time = (3*30*24);}
if($time==11){$time = (6*30*24);}
if($time==12){$time = (1*12*30*24);}
if($time==13){$time = (10*12*30*24);}

$mysqli->query('INSERT INTO `ban` SET `tip` = "1", `user` = "'.$user['id'].'", `ank` = "'.$ank['id'].'", `time` = "'.(time()).'", `time_end` = "'.(time()+(3600*$time)).'", `text` = "'.$text.'" ');
header('location:?');
exit();
}

}elsE{
?><span id="pokazat1"><a onclick="document.getElementById('pokazat1').style.display='none';document.getElementById('skryt1').style.display='';return false;" href="#"><div class="simple-but red mb5" w:id="forumRulesLink" ><span><span>Снять запрет общения</span></span></div></a></span><?

?><span id="skryt1" style="display:none"><a onclick="document.getElementById('skryt1').style.display='none';document.getElementById('pokazat1').style.display='';return false;" href="#"><div class="simple-but red mb5" w:id="forumRulesLink" ><span><span>Отменить</span></span></div></a>

<div class="fight center">
<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5"></div>
<form w:id="loginForm" id="id2" method="post" action=""><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id2_hf_0" id="id2_hf_0"></div>
<div class="small bold cntr white sh_b mb5">
<textarea id="message" placeholder="Причина снятия запрета на общения" rows="3" name="text" style="width: 75%;" class="w90 p0 m0"></textarea></div>
<center><input type="submit" name="ignor_end" value="Применить"></center>
<div class="mt5"></div></form>
</div></div></div></div></div></div></div></div></div></div>
</div></span><?
if(isset($_REQUEST['ignor_end'])) {
$text = strong($_POST['text']);
if($user['position']<1){header('location:?');exit();}
if(!$ignor){header('location:?');exit();}
if(empty($text)){header('location:?');$_SESSION['err'] = "Причина снятия запрета не может быть пустым";exit();}
if((mb_strlen($text)) > 999 or (mb_strlen($text))<1){header('Location: ?');$_SESSION['err'] = 'Причина снятия запрета на общения должна быть не короче 1 и не длиннее 1000';exit();}
$mysqli->query('UPDATE `ban` SET `user_otmena` = "'.$user['id'].'", `time_end` = "0", `time_otmena` = "'.time().'", `text_otmena` = "'.$text.'" WHERE `id` = "'.$ignor['id'].'" LIMIT 1');
header('location:?');
exit();
}
}
}
























if($user['position']>=2){
if(!$ban){
?><span id="pokazat_ban"><a onclick="document.getElementById('pokazat_ban').style.display='none';document.getElementById('skryt_ban').style.display='';return false;" href="#"><div class="simple-but red mb5" w:id="forumRulesLink" ><span><span>Блокировка аккаунта</span></span></div></a></span><?

?><span id="skryt_ban" style="display:none"><a onclick="document.getElementById('skryt_ban').style.display='none';document.getElementById('pokazat_ban').style.display='';return false;" href="#"><div class="simple-but red mb5" w:id="forumRulesLink" ><span><span>Отменить</span></span></div></a>

<div class="fight center">
<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5"></div>
<form w:id="loginForm" id="id2" method="post" action=""><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id2_hf_0" id="id2_hf_0"></div>
<div class="small bold cntr white sh_b mb5">

Время блокировки<br><select style="width: 50%;" name="time">
<option selected="selected" value="1">1 час</option>
<option value="2">6 часов</option>
<option value="3">24 часа</option>
<option value="4">48 часов</option>
<option value="5">72 часа</option>
<option value="6">5 дней</option>
<option value="7">7 дней</option>
<option value="8">15 дней</option>
<option value="9">1 месяц</option>
<option value="10">3 месяца</option>
<option value="11">6 месяца</option>
<option value="12">1 год</option>
<option value="13">10 лет</option>
</select><br>

<textarea id="message" placeholder="Причина блокировки" rows="3" name="text" style="width: 75%;" class="w90 p0 m0"></textarea></div>
<center><input type="submit" name="ban" value="Применить"></center>
<div class="mt5"></div></form>
</div></div></div></div></div></div></div></div></div></div>
</div></span><?
if(isset($_REQUEST['ban'])) {
$time = strong($_POST['time']);
$text = strong($_POST['text']);
if($user['position']<1){header('location:?');exit();}
if(empty($time)){header('location:?');$_SESSION['err'] = "Время блокировки не может быть пустым";exit();}
if(empty($text)){header('location:?');$_SESSION['err'] = "Причина блокировки не может быть пустой";exit();}
if(($time)<= 0 or $time>13){header('Location: ?');$_SESSION['err'] = 'Время блокировки должно быть выбрано из списка';exit();}
if((mb_strlen($text)) > 999 or (mb_strlen($text))<1){header('Location: ?');$_SESSION['err'] = 'Описание должно быть не короче 1 и не длиннее 1000';exit();}

if($time==1){$time = 1;}
if($time==2){$time = 6;}
if($time==3){$time = 24;}
if($time==4){$time = 48;}
if($time==5){$time = 72;}
if($time==6){$time = (5*24);}
if($time==7){$time = (7*24);}
if($time==8){$time = (15*24);}
if($time==9){$time = (1*30*24);}
if($time==10){$time = (3*30*24);}
if($time==11){$time = (6*30*24);}
if($time==12){$time = (1*12*30*24);}
if($time==13){$time = (10*12*30*24);}

$mysqli->query('INSERT INTO `ban` SET `tip` = "2", `user` = "'.$user['id'].'", `ank` = "'.$ank['id'].'", `time` = "'.(time()).'", `time_end` = "'.(time()+(3600*$time)).'", `text` = "'.$text.'" ');
header('location:?');
exit();
}

}elsE{
?><span id="pokazat_ban1"><a onclick="document.getElementById('pokazat_ban1').style.display='none';document.getElementById('skryt_ban1').style.display='';return false;" href="#"><div class="simple-but red mb5" w:id="forumRulesLink" ><span><span>Снять блокировку аккаунта</span></span></div></a></span><?

?><span id="skryt_ban1" style="display:none"><a onclick="document.getElementById('skryt_ban1').style.display='none';document.getElementById('pokazat_ban1').style.display='';return false;" href="#"><div class="simple-but red mb5" w:id="forumRulesLink" ><span><span>Отменить</span></span></div></a>

<div class="fight center">
<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5"></div>
<form w:id="loginForm" id="id2" method="post" action=""><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id2_hf_0" id="id2_hf_0"></div>
<div class="small bold cntr white sh_b mb5">
<textarea id="message" placeholder="Причина снятия блокировки" rows="3" name="text" style="width: 75%;" class="w90 p0 m0"></textarea></div>
<center><input type="submit" name="ban_end" value="Применить"></center>
<div class="mt5"></div></form>
</div></div></div></div></div></div></div></div></div></div>
</div></span><?
if(isset($_REQUEST['ban_end'])) {
$text = strong($_POST['text']);
if($user['position']<1){header('location:?');exit();}
if(!$ban){header('location:?');exit();}
if(empty($text)){header('location:?');$_SESSION['err'] = "Причина блокировки не может быть пустой";exit();}
if((mb_strlen($text)) > 999 or (mb_strlen($text))<1){header('Location: ?');$_SESSION['err'] = 'Причина снятия блокировки должна быть не короче 1 и не длиннее 1000';exit();}
$mysqli->query('UPDATE `ban` SET `user_otmena` = "'.$user['id'].'", `time_end` = "0", `time_otmena` = "'.time().'", `text_otmena` = "'.$text.'" WHERE `id` = "'.$ban['id'].'" LIMIT 1');
header('location:?');
exit();
}
}
}





















if($user['position']>=4){

?><span id="pokazat_p"><a onclick="document.getElementById('pokazat_p').style.display='none';document.getElementById('skryt_p').style.display='';return false;" href="#"><div class="simple-but red mb5" w:id="forumRulesLink" ><span><span>Должность</span></span></div></a></span><?

?><span id="skryt_p" style="display:none"><a onclick="document.getElementById('skryt_p').style.display='none';document.getElementById('pokazat_p').style.display='';return false;" href="#"><div class="simple-but red mb5" w:id="forumRulesLink" ><span><span>Отменить</span></span></div></a>

<div class="fight center">
<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5"></div>
<form w:id="loginForm" id="id2" method="post" action=""><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id2_hf_0" id="id2_hf_0"></div>

<div class="small bold cntr white sh_b mb5">
Должность<br><select style="width: 50%;" name="position_">
<option selected="selected" value="0">Игрок</option>
<option selected="selected" value="1">Мл. Модератор (удаление смс и игнор)</option>
<option value="2">Модератор (возможности мл. мд и + бан)</option>
<option value="3">Ст. Модератор (возможности мд и + открытие/закрытие и удаление топиков)</option>
<?
if($user['position']==4){
echo '<option value="4">Администратор (возможности ст. мд и + создание и редактирование форума)</option>';
}
if($user['position']==5){
echo '<option value="4">Администратор (возможности ст. мд и + создание и редактирование форума)</option>';
echo '<option value="5">Разработчик (может всё)</option>';
}
?>
</select><br>
</div>

<center><input type="submit" name="position_g" value="Применить"></center>
<div class="mt5"></div></form>
</div></div></div></div></div></div></div></div></div></div>
</div></span><?
if(isset($_REQUEST['position_g'])) {
$position_ = strong($_POST['position_']);
if($user['position']==4 and $position_==5){$_SESSION['err'] = "Должность не назначена!";header('location:?');exit();}
if($user['position']<4){$_SESSION['err'] = "Должность не назначена.";header('location:?');exit();}
if(($position_)< 0 or $position_>5){header('Location: ?');exit();}
$mysqli->query('UPDATE `users` SET `position` = "'.$position_.'" WHERE `id` = "'.$ank['id'].'" LIMIT 1');
$_SESSION['err'] = "Должность назначена.";
header('location:?');
exit();
}

}







if($user['position']==5){
?><span id="pokazat_inf"><a onclick="document.getElementById('pokazat_inf').style.display='none';document.getElementById('skryt_inf').style.display='';return false;" href="#"><div class="simple-but red mb5" w:id="forumRulesLink" ><span><span>Информация</span></span></div></a></span><?

?><span id="skryt_inf" style="display:none"><a onclick="document.getElementById('skryt_inf').style.display='none';document.getElementById('pokazat_inf').style.display='';return false;" href="#"><div class="simple-but red mb5" w:id="forumRulesLink" ><span><span>Отменить</span></span></div></a>

<div class="fight center">
<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5"></div><?

echo '<span class="wrap-content small white sh_b bold" w:id="experience">&middot; Почта: <font color=grey>'.$ank['email_'].'</font></span><br>';
echo '<span class="wrap-content small white sh_b bold" w:id="experience">&middot; User agent: <font color=grey>'.$ank['browser'].'</font></span><br>';
echo '<span class="wrap-content small white sh_b bold" w:id="experience">&middot; IP: <font color=grey>'.$ank['ip'].'</font></span><br>';
echo '<span class="wrap-content small white sh_b bold" w:id="experience">&middot; Локация: <font color=grey>'.$ank['gde'].'</font></span><br>';
echo '<span class="wrap-content small white sh_b bold" w:id="experience">&middot; Дата регистрации: <font color=grey>'.vremja($ank['datareg']).'</font></span><br>';

?></div></div></div></div></div></div></div></div></div></div>
</div></span><?
}








}
require_once ('../system/footer.php');
?>