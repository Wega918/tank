<?php
$title = 'Сопровождение';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}
$res = $mysqli->query('SELECT * FROM `convoy_user` WHERE `user`  = "'.$user['id'].'" limit 1');
$c_user = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user`  = "'.$user['id'].'" LIMIT 1');
$a_users = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = '.$user['id'].' and `active`  = "1" LIMIT 1');
$u_t = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `shellskills` WHERE `user` = "'.$user['id'].'" LIMIT 1');
$shell_s = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `vip` WHERE `user` = "'.$user['id'].'" LIMIT 1');
$vip = $res->fetch_assoc();

//if($c_user['vrag']<=0){header('Location: /convoy/');exit();}
if($c_user['time'] > time()){header('Location: /convoy/');exit();}

/* if($c_user['hp'] >0){
header('Location: /convoy/boy/');
exit();
} */




if(($c_user['vrag'] == 1 and $c_user['shag'] == 0) or ($c_user['vrag2'] == 1 and $c_user['shag'] == 1)){
$vrag_name = 'Пехота';$name_1 = 'Пехоту';$name_2 = 'Пехоте';
$vrag_h = 30;$vrag_a = floor($vrag_h/6);
$vrag_nagrada = 2; // слава
$images = 'Infantry';
}

if(($c_user['vrag'] == 2 and $c_user['shag'] == 0) or ($c_user['vrag2'] == 2 and $c_user['shag'] == 1)){
$vrag_name = 'Минометный расчёт';$name_1 = 'Пехоту';$name_2 = 'Минометному расчёту';
$vrag_h = 60;$vrag_a = floor($vrag_h/6);
$vrag_nagrada = 3; // слава
$images = 'Detachment';
}

if(($c_user['vrag'] == 3 and $c_user['shag'] == 0) or ($c_user['vrag2'] == 3 and $c_user['shag'] == 1)){
$vrag_name = 'Тягач';$name_1 = 'Пехоту';$name_2 = 'Тягачу';
$vrag_h = 90;$vrag_a = floor($vrag_h/6);
$vrag_nagrada = 3; // слава
$images = 'Tractor';
}

if(($c_user['vrag'] == 4 and $c_user['shag'] == 0) or ($c_user['vrag2'] == 4 and $c_user['shag'] == 1)){
$vrag_name = 'РЛУ';$name_1 = 'Пехоту';$name_2 = 'РЛУ';
$vrag_h = 135;$vrag_a = floor($vrag_h/6);
$vrag_nagrada = 4; // слава
$images = 'Radar';
}

if(($c_user['vrag'] == 5 and $c_user['shag'] == 0) or ($c_user['vrag2'] == 5 and $c_user['shag'] == 1)){
$vrag_name = 'Мотоцикл';$name_1 = 'Пехоту';$name_2 = 'Мотоциклу';
$vrag_h = 180;$vrag_a = floor($vrag_h/6);
$vrag_nagrada = 4; // слава
$images = 'Bike';
}

if(($c_user['vrag'] == 6 and $c_user['shag'] == 0) or ($c_user['vrag2'] == 6 and $c_user['shag'] == 1)){
$vrag_name = 'Противотанковая установка';$name_1 = 'Пехоту';$name_2 = 'Противотанковой установке';
$vrag_h = 240;$vrag_a = floor($vrag_h/6);
$vrag_nagrada = 5; // слава
$images = 'AntiTankGun';
}

if(($c_user['vrag'] == 7 and $c_user['shag'] == 0) or ($c_user['vrag2'] == 7 and $c_user['shag'] == 1)){
$vrag_name = 'Военный джип';$name_1 = 'Пехоту';$name_2 = 'Военному джипу';
$vrag_h = 300;$vrag_a = floor($vrag_h/6);
$vrag_nagrada = 6; // слава
$images = 'Jeep';
}

if(($c_user['vrag'] == 8 and $c_user['shag'] == 0) or ($c_user['vrag2'] == 8 and $c_user['shag'] == 1)){
$vrag_name = 'Мобильная зенитка';$name_1 = 'Пехоту';$name_2 = 'Мобильной зенитке';
$vrag_h = 400;$vrag_a = floor($vrag_h/6);
$vrag_nagrada = 7; // слава
$images = 'AntiAirCraft';
}

if(($c_user['vrag'] == 9 and $c_user['shag'] == 0) or ($c_user['vrag2'] == 9 and $c_user['shag'] == 1)){
$vrag_name = 'БТР';$name_1 = 'Пехоту';$name_2 = 'БТР';
$vrag_h = 500;$vrag_a = floor($vrag_h/6);
$vrag_nagrada = 8; // слава
$images = 'BTR';
}

if(($c_user['vrag'] == 10 and $c_user['shag'] == 0) or ($c_user['vrag2'] == 10 and $c_user['shag'] == 1)){
$vrag_name = 'Химический танк';$name_1 = 'Пехоту';$name_2 = 'Химическому танку';
$vrag_h = 650;$vrag_a = floor($vrag_h/6);
$vrag_nagrada = 9; // слава
$images = 'ChemicalTank';
}

if(($c_user['vrag'] == 11 and $c_user['shag'] == 0) or ($c_user['vrag2'] == 11 and $c_user['shag'] == 1)){
$vrag_name = 'Реактивные миномёты';$name_1 = 'Пехоту';$name_2 = 'Реактивному миномёту';
$vrag_h = 800;$vrag_a = floor($vrag_h/6);
$vrag_nagrada = 9; // слава
$images = 'RocketLaunchers';
}

if(($c_user['vrag'] == 12 and $c_user['shag'] == 0) or ($c_user['vrag2'] == 12 and $c_user['shag'] == 1)){
$vrag_name = 'САУ';$name_1 = 'Пехоту';$name_2 = 'САУ';
$vrag_h = 1000;$vrag_a = floor($vrag_h/6);
$vrag_nagrada = 10; // слава
$images = 'SAU';
}

if(($c_user['vrag'] == 13 and $c_user['shag'] == 0) or ($c_user['vrag2'] == 13 and $c_user['shag'] == 1)){
$vrag_name = 'Танк';$name_1 = 'Пехоту';$name_2 = 'Танку';
$vrag_h = 1200;$vrag_a = floor($vrag_h/6);
$vrag_nagrada = 10; // слава
$images = 'Tank';
}

if(($c_user['vrag'] == 14 and $c_user['shag'] == 0) or ($c_user['vrag2'] == 14 and $c_user['shag'] == 1)){
$vrag_name = 'Бронепоезд';$name_1 = 'Пехоту';$name_2 = 'Бронепоезду';
$vrag_h = 1600;$vrag_a = floor($vrag_h/6);
$vrag_nagrada = 11; // слава
$images = 'ArmoredTrain';
}

if($c_user['tip']==1){
$butt = 'БРОНЕБОЙНЫЕ&nbsp;('.$a_users['b'].')';
$img = 'ArmorPiercing';
$href = 'attack'.$c_user['hp'].'_bb';
}elseif($c_user['tip']==2){
$butt = 'КУМУЛЯТИВНЫЕ&nbsp;('.$a_users['k'].')';
$img = 'HollowCharge';
$href = 'attack'.$c_user['hp'].'_k';
}elseif($c_user['tip']==3){
$butt = 'ФУГАСНЫЕ&nbsp;('.$a_users['f'].')';
$img = 'HighExplosive';
$href = 'attack'.$c_user['hp'].'_f';
}

$usP = round(100/((($u_t['p']*2)+0.00001)/($c_user['hp_user']+0.00001)));
if($usP > 100) {$usP = 100;}
$usA = round(100/(($vrag_h+0.00001)/(($c_user['hp'])+0.00001)));
if($usA > 100) {$usA = 100;}

//<img w:id="pic" src="/images/convoy/e/ArmoredTrain.png"> color=indianred

//echo ''.$vrag_name.'';

########################################################################################################################
if($c_user['shag']<=1 and $c_user['hp']==0 and $c_user['hp_user']==0){ // начало
echo '<div class="trnt-block" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">';
echo '<div w:id="event"><div class="small white cntr sh_b bold">Вы обнаружили <span class="medium orange">'.$vrag_name.'</span> врага<br></div><div class="dhr mt5 mb5"></div></div>';
echo '<div class="cntr"><a w:id="actLink" href="?start"><img w:id="pic" src="/images/convoy/'.$images.'.png"></a></div>';
echo '<div class="bot"><a class="simple-but border red" w:id="startFight" href="?start"><span><span>В БОЙ!</span></span></a></div>';
echo '</div></div></div></div></div></div></div></div></div></div></div>';
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini"><div class="mt5 mb5 small green1 cntr">Чем сильнее враг, тем выше награда за его уничтожение</div></div></div></div></div></div></div></div></div></div></div>';
echo '<div class="bot"><a class="simple-but border gray mb2" href="/"><span><span>Вернуться в ангар</span></span></a></div>';
if(isset($_GET['start'])){
if($c_user['time'] > time()){header('Location: /convoy/');exit();}
if($c_user['vrag'] <= 0){header('Location: /convoy/');exit();}
if($c_user['atack'] > 0){header('Location: /convoy/');exit();}
$tip = rand(1,3);
$mysqli->query("UPDATE `convoy_user` SET `tip` = '".($tip)."', `hp` = '".($vrag_h)."', `hp_user` = '".($u_t['p']*2)."' WHERE `id` = '".$c_user['id']."' LIMIT 1");
header('Location: ?');exit();
}
}
########################################################################################################################
if($c_user['hp']>0 and $c_user['hp_user']>0 and $c_user['atack']<3){ // бой..
echo '<div class="trnt-block mb2" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">';
echo '<div class="cntr"><div class="small bold orange mb5">'.$vrag_name.'</div><a href="?atack'.$c_user['id'].'"><img src="/images/convoy/'.$images.'.png"></a><div class="small white mt2">Выбери тип снаряда и атакуй</div></div>';
echo '<table class="rblock esmall mb0"><tbody><tr>
<td><div class="value-block lh1"><span><span>'.($c_user['hp']).'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$usA.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.($vrag_h).'</span></span></div></td>
</tr></tbody></table>';
echo '<table><tbody><tr>
<td class="w50 pr5"><a href="?atack'.$c_user['id'].'" class="simple-but gray"><span><span>ОБЫЧНЫЕ</span></span></a></td>
<td class="w50 pl5"><a href="?'.$href.'" class="simple-but"><span><span>'.$butt.'</span></span></a></td>
</tr></tbody></table>';echo '<div class="small white cntr">Моя прочность</div>';
echo '<table class="rblock esmall mb0"><tbody><tr>
<td><div class="value-block lh1"><span><span>'.($c_user['hp_user']).'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$usP.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.($u_t['p']*2).'</span></span></div></td>
</tr></tbody></table>';
$res1 = $mysqli->query('SELECT * FROM `convoy_log` WHERE `convoy_id` = "'.$c_user['id'].'" ORDER BY `id` desc LIMIT 20');//or `user_nick` is NULL
while ($t_r1 = $res1->fetch_array()){echo '<div class="small p5">'.$t_r1['text'].'</div>';}
echo '</div></div></div></div></div></div></div></div></div></div></div>';
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini"><div class="mt5 mb5 small green1 cntr">Специальные (зеленые) снаряды наносят на 25% больше урона чем обычные</div></div></div></div></div></div></div></div></div></div></div>';
echo '<div class="bot"><a class="simple-but border gray mb2" href="/"><span><span>Вернуться в ангар</span></span></a></div>';












if(isset($_GET['atack'.$c_user['id'].''])){ // обычный
if($c_user['time']>time()){header('Location: /convoy/');exit();}
if($c_user['vrag']<=0){header('Location: /convoy/');exit();}
if($c_user['atack']>2){header('Location: /convoy/');exit();}
if($c_user['hp']<1){header('Location: /convoy/');exit();}
if($c_user['hp_user']<1){header('Location: /convoy/');exit();}
$attack = (($u_t['a']/4) );
##################################################################################### умения
$res_s2 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "2" and `user`  = "'.$user['id'].'" ');
$skills_2 = $res_s2->fetch_assoc(); // рикошет

$res_s3 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "3" and `user`  = "'.$user['id'].'" ');
$skills_3 = $res_s3->fetch_assoc(); // Слабые места

$res_s5 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "5" and `user`  = "'.$user['id'].'" ');
$skills_5 = $res_s5->fetch_assoc(); // Снайпер

$rand_s2 = rand(1,100); // Рикошет
$rand_s3 = rand(1,100); // Слабые места
if($rand_s3 <= $skills_3['bon']){if($skills_5['bon']>0){$attack = floor($attack+($attack*(rand($skills_5['bon'],($skills_5['bon']+50)))/100));$txt_krit = "<span class='red1'>(крит)</span>";}elsE{$attack = $attack;$txt_krit = '';}}//если выпал крит смотрим как прокачан снайпер и увеличиваем урон
##################################################################################### умения
if($u_t['t']<500){$tochnost = ($u_t['t']/10);}else{$tochnost = ($u_t['t']/40);}
$toch = ((($u_t['a']/4)*$tochnost/100) );
if($vip['time1']>time()){$v1 = 25;}elsE{$v1 = 0;}
if($vip['time3']>time()){$v3 = 50;}elsE{$v3 = 0;}
if($vip['time4']>time()){$v4 = 50;}elsE{$v4 = 0;}
$attack = ($attack+ ($attack*($shell_s['o']+$v1+$v3+$v4)/100));
$attack = floor($attack+$toch);
if($attack>=$c_user['hp']){$attack = ceil($c_user['hp']);}else{$attack = ceil($attack);}

$text = "<div><span class='green1'>Вы нанесли</span> <img src='/images/shells/Regular.png'> <span class='red1'>".$attack."</span> урона ".$txt_krit." <span class='yellow1 td_u'>".$name_2."</span></div>";

if($rand_s2 <= $skills_2['bon']){
$text_ank = "<div><span class='blue1'>РИКОШЕТ: </span> <span class='yellow1 td_u'>".$vrag_name."</span> <span class='red1'>нанёс вам</span> <img src='/images/shells/Regular.png'> <span class='red1'>0</span> урона</div>";
}else{
$text_ank = "<div><span class='yellow1 td_u'>".$vrag_name."</span> <span class='red1'>нанёс вам</span> <img src='/images/shells/Regular.png'> <span class='red1'>".$vrag_a."</span> урона</div>";
}

$mysqli->query("UPDATE `shellskills` SET `o_` = '".($shell_s['o_']+1)."' WHERE `id` = '".$shell_s['id']."' LIMIT 1");
if($attack>=$c_user['hp']){ // если последний удар убивает противника - победа
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text.'", `convoy_id` = "'.$c_user['id'].'" ');
$mysqli->query("UPDATE `convoy_user` SET `hp` = '0', `atack` = `atack` + '1', `kill` = `kill` + '1' WHERE `id` = '".$c_user['id']."' LIMIT 1");
$mysqli->query("UPDATE `ammunition_users` SET `glory` = '".($a_users['glory']+($vrag_nagrada))."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
$res = $mysqli->query('SELECT * FROM `prom` WHERE `id` = "1" ');
$prom = $res->fetch_assoc();
if($prom['time_20']>time()){
$res = $mysqli->query('SELECT * FROM `bz_user` WHERE `user` = "'.$user['id'].'" and `tip` = "'.$prom['tip_20'].'"');
$bz_user = $res->fetch_assoc();
if($bz_user['step']==11 and $bz_user['prog_']<$bz_user['prog']){
$mysqli->query('UPDATE `bz_user` SET `prog_` = `prog_` + "1" WHERE `id` = '.$bz_user['id'].'');
}
}
$_SESSION['err'] = '<div w:id="event"><div class="small white cntr sh_b bold"><div class="medium"><img src="/images/icons/victory.png"> <span class="green1">Боевая техника уничтожена!</span> <img src="/images/icons/victory.png"></div>Награда: <img class="ico vm" src="/images/icons/glory.png?2" alt="Слава" title="Слава"> '.($vrag_nagrada).' славы<br><div class="small gray1 cntr sh_b bold">Врагов уничтожено '.($c_user['kill']+1).'</div></div></div>'; 
}elseif($attack<$c_user['hp'] and $vrag_a>=$c_user['hp_user']){ // если последний удар убивает игрока - поражение
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text.'", `convoy_id` = "'.$c_user['id'].'" ');
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text_ank.'", `convoy_id` = "'.$c_user['id'].'" ');
$mysqli->query("UPDATE `convoy_user` SET `hp_user` = '0', `atack` = `atack` + '1' WHERE `id` = '".$c_user['id']."' LIMIT 1");
$mysqli->query("UPDATE `ammunition_users` SET `glory` = '".($a_users['glory']+ceil($vrag_nagrada/2))."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
$_SESSION['err'] = '<div w:id="event"><div class="small white cntr sh_b bold"><div class="medium"><img src="/images/icons/defeat.png"> <span class="red1">Противник отступил!</span> <img src="/images/icons/defeat.png"></div>Награда: <img class="ico vm" src="/images/icons/glory.png?2" alt="Слава" title="Слава"> '.ceil($vrag_nagrada/2).' славы<br><div class="small gray1 cntr sh_b bold">Врагов уничтожено '.($c_user['kill']).'</div></div></div>';
}elseif($c_user['atack']==2 and $attack<$c_user['hp'] and $vrag_a<$c_user['hp_user']){ // последний удар никто никого не убил - поражение
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text.'", `convoy_id` = "'.$c_user['id'].'" ');
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text_ank.'", `convoy_id` = "'.$c_user['id'].'" ');
if($rand_s2 <= $skills_2['bon']){
$mysqli->query("UPDATE `convoy_user` SET `hp` = `hp` - '".$attack."', `atack` = '3' WHERE `id` = '".$c_user['id']."' LIMIT 1");
}else{
$mysqli->query("UPDATE `convoy_user` SET `hp` = `hp` - '".$attack."', `hp_user` = `hp_user` - '".$vrag_a."', `atack` = '3' WHERE `id` = '".$c_user['id']."' LIMIT 1");
}
$mysqli->query("UPDATE `ammunition_users` SET `glory` = '".($a_users['glory']+ceil($vrag_nagrada/2))."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
$_SESSION['err'] = '<div w:id="event"><div class="small white cntr sh_b bold"><div class="medium"><img src="/images/icons/defeat.png"> <span class="red1">Противник отступил!</span> <img src="/images/icons/defeat.png"></div>Награда: <img class="ico vm" src="/images/icons/glory.png?2" alt="Слава" title="Слава"> '.ceil($vrag_nagrada/2).' славы<br><div class="small gray1 cntr sh_b bold">Врагов уничтожено '.($c_user['kill']).'</div></div></div>';
}elseif($c_user['atack']<2 and $attack<$c_user['hp'] and $vrag_a<$c_user['hp_user']){ // 1 или 2 удар никто никого не убил - продолжаем
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text.'", `convoy_id` = "'.$c_user['id'].'" ');
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text_ank.'", `convoy_id` = "'.$c_user['id'].'" ');
if($rand_s2 <= $skills_2['bon']){
$mysqli->query("UPDATE `convoy_user` SET `hp` = `hp` - '".$attack."', `atack` = `atack` + '1' WHERE `id` = '".$c_user['id']."' LIMIT 1");
}else{
$mysqli->query("UPDATE `convoy_user` SET `hp` = `hp` - '".$attack."', `hp_user` = `hp_user` - '".$vrag_a."', `atack` = `atack` + '1' WHERE `id` = '".$c_user['id']."' LIMIT 1");
}
}
header('Location: ?');
exit();
}
















if(isset($_GET['attack'.$c_user['hp'].'_bb'])){ // бб
if($c_user['time']>time()){header('Location: /convoy/');exit();}
if($c_user['vrag']<=0){header('Location: /convoy/');exit();}
if($c_user['atack']>2){header('Location: /convoy/');exit();}
if($c_user['hp']<1){header('Location: /convoy/');exit();}
if($c_user['hp_user']<1){header('Location: /convoy/');exit();}
if($a_users['b']<=0){$text = "<span class='gray1'>У вас нет такого снаряда</span>";$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text.'", `convoy_id` = "'.$c_user['id'].'" ');header('Location: ?');exit();}

$attack = (($u_t['a']/4) );
##################################################################################### умения
$res_s2 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "2" and `user`  = "'.$user['id'].'" ');
$skills_2 = $res_s2->fetch_assoc(); // рикошет

$res_s3 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "3" and `user`  = "'.$user['id'].'" ');
$skills_3 = $res_s3->fetch_assoc(); // Слабые места

$res_s5 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "5" and `user`  = "'.$user['id'].'" ');
$skills_5 = $res_s5->fetch_assoc(); // Снайпер

$rand_s2 = rand(1,100); // Рикошет
$rand_s3 = rand(1,100); // Слабые места
if($rand_s3 <= $skills_5['bon']){if($skills_5['bon']>0){$attack = floor($attack+($attack*(rand($skills_5['bon'],($skills_5['bon']+50)))/100));$txt_krit = "<span class='red1'>(крит)</span>";}elsE{$attack = $attack;$txt_krit = '';}}//если выпал крит смотрим как прокачан снайпер и увеличиваем урон
##################################################################################### умения
if($u_t['t']<500){$tochnost = ($u_t['t']/10);}else{$tochnost = ($u_t['t']/40);}
$toch = ((($u_t['a']/4)*$tochnost/100) );
if($vip['time1']>time()){$v1 = 25;}elsE{$v1 = 0;}
if($vip['time3']>time()){$v3 = 50;}elsE{$v3 = 0;}
if($vip['time4']>time()){$v4 = 50;}elsE{$v4 = 0;}
$attack = ($attack+ ($attack*($shell_s['b']+$v1+$v3+$v4)/100));
$attack = floor($attack+$toch);
if($attack>=$c_user['hp']){$attack = ceil($c_user['hp']);}else{$attack = ceil($attack);}

$text = "<div><span class='green1'>Вы нанесли</span> <img src='/images/shells/".$img.".png'> <span class='red1'>".$attack."</span> урона ".$txt_krit." <span class='yellow1 td_u'>".$name_2."</span></div>";
if($rand_s2 <= $skills_2['bon']){
$text_ank = "<div><span class='blue1'>РИКОШЕТ: </span> <span class='yellow1 td_u'>".$vrag_name."</span> <span class='red1'>нанёс вам</span> <img src='/images/shells/ArmorPiercing.png'> <span class='red1'>0</span> урона</div>";
}else{
$text_ank = "<div><span class='yellow1 td_u'>".$vrag_name."</span> <span class='red1'>нанёс вам</span> <img src='/images/shells/ArmorPiercing.png'> <span class='red1'>".$vrag_a."</span> урона</div>";
}
$mysqli->query("UPDATE `shellskills` SET `b_` = '".($shell_s['b_']+1)."' WHERE `id` = '".$shell_s['id']."' LIMIT 1");
if($attack>=$c_user['hp']){ // если последний удар убивает противника - победа
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text.'", `convoy_id` = "'.$c_user['id'].'" ');
$mysqli->query("UPDATE `convoy_user` SET `hp` = '0', `atack` = `atack` + '1', `kill` = `kill` + '1' WHERE `id` = '".$c_user['id']."' LIMIT 1");
$mysqli->query("UPDATE `ammunition_users` SET `b` = '".($a_users['b']-1)."', `glory` = '".($a_users['glory']+($vrag_nagrada))."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
$res = $mysqli->query('SELECT * FROM `prom` WHERE `id` = "1" ');
$prom = $res->fetch_assoc();
if($prom['time_20']>time()){
$res = $mysqli->query('SELECT * FROM `bz_user` WHERE `user` = "'.$user['id'].'" and `tip` = "'.$prom['tip_20'].'"');
$bz_user = $res->fetch_assoc();
if($bz_user['step']==11 and $bz_user['prog_']<$bz_user['prog']){
$mysqli->query('UPDATE `bz_user` SET `prog_` = `prog_` + "1" WHERE `id` = '.$bz_user['id'].'');
}
}
$_SESSION['err'] = '<div w:id="event"><div class="small white cntr sh_b bold"><div class="medium"><img src="/images/icons/victory.png"> <span class="green1">Боевая техника уничтожена!</span> <img src="/images/icons/victory.png"></div>Награда: <img class="ico vm" src="/images/icons/glory.png?2" alt="Слава" title="Слава"> '.($vrag_nagrada).' славы<br><div class="small gray1 cntr sh_b bold">Врагов уничтожено '.($c_user['kill']+1).'</div></div></div>'; 
}elseif($attack<$c_user['hp'] and $vrag_a>=$c_user['hp_user']){ // если последний удар убивает игрока - поражение
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text.'", `convoy_id` = "'.$c_user['id'].'" ');
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text_ank.'", `convoy_id` = "'.$c_user['id'].'" ');
$mysqli->query("UPDATE `convoy_user` SET `hp_user` = '0', `atack` = `atack` + '1' WHERE `id` = '".$c_user['id']."' LIMIT 1");
$mysqli->query("UPDATE `ammunition_users` SET `b` = '".($a_users['b']-1)."', `glory` = '".($a_users['glory']+ceil($vrag_nagrada/2))."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
$_SESSION['err'] = '<div w:id="event"><div class="small white cntr sh_b bold"><div class="medium"><img src="/images/icons/defeat.png"> <span class="red1">Противник отступил!</span> <img src="/images/icons/defeat.png"></div>Награда: <img class="ico vm" src="/images/icons/glory.png?2" alt="Слава" title="Слава"> '.ceil($vrag_nagrada/2).' славы<br><div class="small gray1 cntr sh_b bold">Врагов уничтожено '.($c_user['kill']).'</div></div></div>';
}elseif($c_user['atack']==2 and $attack<$c_user['hp'] and $vrag_a<$c_user['hp_user']){ // последний удар никто никого не убил - поражение
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text.'", `convoy_id` = "'.$c_user['id'].'" ');
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text_ank.'", `convoy_id` = "'.$c_user['id'].'" ');
if($rand_s2 <= $skills_2['bon']){
$mysqli->query("UPDATE `convoy_user` SET `hp` = `hp` - '".$attack."', `atack` = '3' WHERE `id` = '".$c_user['id']."' LIMIT 1");
}else{
$mysqli->query("UPDATE `convoy_user` SET `hp` = `hp` - '".$attack."', `hp_user` = `hp_user` - '".$vrag_a."', `atack` = '3' WHERE `id` = '".$c_user['id']."' LIMIT 1");
}
$mysqli->query("UPDATE `ammunition_users` SET `b` = '".($a_users['b']-1)."', `glory` = '".($a_users['glory']+ceil($vrag_nagrada/2))."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
$_SESSION['err'] = '<div w:id="event"><div class="small white cntr sh_b bold"><div class="medium"><img src="/images/icons/defeat.png"> <span class="red1">Противник отступил!</span> <img src="/images/icons/defeat.png"></div>Награда: <img class="ico vm" src="/images/icons/glory.png?2" alt="Слава" title="Слава"> '.ceil($vrag_nagrada/2).' славы<br><div class="small gray1 cntr sh_b bold">Врагов уничтожено '.($c_user['kill']).'</div></div></div>';
}elseif($c_user['atack']<2 and $attack<$c_user['hp'] and $vrag_a<$c_user['hp_user']){ // 1 или 2 удар никто никого не убил - продолжаем
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text.'", `convoy_id` = "'.$c_user['id'].'" ');
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text_ank.'", `convoy_id` = "'.$c_user['id'].'" ');
if($rand_s2 <= $skills_2['bon']){
$mysqli->query("UPDATE `convoy_user` SET `hp` = `hp` - '".$attack."', `atack` = `atack` + '1' WHERE `id` = '".$c_user['id']."' LIMIT 1");
}else{
$mysqli->query("UPDATE `convoy_user` SET `hp` = `hp` - '".$attack."', `hp_user` = `hp_user` - '".$vrag_a."', `atack` = `atack` + '1' WHERE `id` = '".$c_user['id']."' LIMIT 1");
}
$mysqli->query("UPDATE `ammunition_users` SET `b` = '".($a_users['b']-1)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
}
header('Location: ?');
exit();
}









if(isset($_GET['attack'.$c_user['hp'].'_k'])){ // комуль
if($c_user['time']>time()){header('Location: /convoy/');exit();}
if($c_user['vrag']<=0){header('Location: /convoy/');exit();}
if($c_user['atack']>2){header('Location: /convoy/');exit();}
if($c_user['hp']<1){header('Location: /convoy/');exit();}
if($c_user['hp_user']<1){header('Location: /convoy/');exit();}
if($a_users['k']<=0){$text = "<span class='gray1'>У вас нет такого снаряда</span>";$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text.'", `convoy_id` = "'.$c_user['id'].'" ');header('Location: ?');exit();}

$attack = (($u_t['a']/4) );
##################################################################################### умения
$res_s2 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "2" and `user`  = "'.$user['id'].'" ');
$skills_2 = $res_s2->fetch_assoc(); // рикошет

$res_s3 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "3" and `user`  = "'.$user['id'].'" ');
$skills_3 = $res_s3->fetch_assoc(); // Слабые места

$res_s5 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "5" and `user`  = "'.$user['id'].'" ');
$skills_5 = $res_s5->fetch_assoc(); // Снайпер

$rand_s2 = rand(1,100); // Рикошет
$rand_s3 = rand(1,100); // Слабые места
if($rand_s3 <= $skills_5['bon']){if($skills_5['bon']>0){$attack = floor($attack+($attack*(rand($skills_5['bon'],($skills_5['bon']+50)))/100));$txt_krit = "<span class='red1'>(крит)</span>";}elsE{$attack = $attack;$txt_krit = '';}}//если выпал крит смотрим как прокачан снайпер и увеличиваем урон
##################################################################################### умения
if($u_t['t']<500){$tochnost = ($u_t['t']/10);}else{$tochnost = ($u_t['t']/40);}
$toch = ((($u_t['a']/4)*$tochnost/100) );
if($vip['time1']>time()){$v1 = 25;}elsE{$v1 = 0;}
if($vip['time3']>time()){$v3 = 50;}elsE{$v3 = 0;}
if($vip['time4']>time()){$v4 = 50;}elsE{$v4 = 0;}
$attack = ($attack+ ($attack*($shell_s['k']+$v1+$v3+$v4)/100));
$attack = floor($attack+$toch);
if($attack>=$c_user['hp']){$attack = ceil($c_user['hp']);}else{$attack = ceil($attack);}

$text = "<div><span class='green1'>Вы нанесли</span> <img src='/images/shells/".$img.".png'> <span class='red1'>".$attack."</span> урона ".$txt_krit." <span class='yellow1 td_u'>".$name_2."</span></div>";
if($rand_s2 <= $skills_2['bon']){
$text_ank = "<div><span class='blue1'>РИКОШЕТ: </span> <span class='yellow1 td_u'>".$vrag_name."</span> <span class='red1'>нанёс вам</span> <img src='/images/shells/HollowCharge.png'> <span class='red1'>0</span> урона</div>";
}else{
$text_ank = "<div><span class='yellow1 td_u'>".$vrag_name."</span> <span class='red1'>нанёс вам</span> <img src='/images/shells/HollowCharge.png'> <span class='red1'>".$vrag_a."</span> урона</div>";
}
$mysqli->query("UPDATE `shellskills` SET `k_` = '".($shell_s['k_']+1)."' WHERE `id` = '".$shell_s['id']."' LIMIT 1");
if($attack>=$c_user['hp']){ // если последний удар убивает противника - победа
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text.'", `convoy_id` = "'.$c_user['id'].'" ');
$mysqli->query("UPDATE `convoy_user` SET `hp` = '0', `atack` = `atack` + '1', `kill` = `kill` + '1' WHERE `id` = '".$c_user['id']."' LIMIT 1");
$mysqli->query("UPDATE `ammunition_users` SET `k` = '".($a_users['k']-1)."', `glory` = '".($a_users['glory']+($vrag_nagrada))."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
$res = $mysqli->query('SELECT * FROM `prom` WHERE `id` = "1" ');
$prom = $res->fetch_assoc();
if($prom['time_20']>time()){
$res = $mysqli->query('SELECT * FROM `bz_user` WHERE `user` = "'.$user['id'].'" and `tip` = "'.$prom['tip_20'].'"');
$bz_user = $res->fetch_assoc();
if($bz_user['step']==11 and $bz_user['prog_']<$bz_user['prog']){
$mysqli->query('UPDATE `bz_user` SET `prog_` = `prog_` + "1" WHERE `id` = '.$bz_user['id'].'');
}
}
$_SESSION['err'] = '<div w:id="event"><div class="small white cntr sh_b bold"><div class="medium"><img src="/images/icons/victory.png"> <span class="green1">Боевая техника уничтожена!</span> <img src="/images/icons/victory.png"></div>Награда: <img class="ico vm" src="/images/icons/glory.png?2" alt="Слава" title="Слава"> '.($vrag_nagrada).' славы<br><div class="small gray1 cntr sh_b bold">Врагов уничтожено '.($c_user['kill']+1).'</div></div></div>'; 
}elseif($attack<$c_user['hp'] and $vrag_a>=$c_user['hp_user']){ // если последний удар убивает игрока - поражение
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text.'", `convoy_id` = "'.$c_user['id'].'" ');
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text_ank.'", `convoy_id` = "'.$c_user['id'].'" ');
$mysqli->query("UPDATE `convoy_user` SET `hp_user` = '0', `atack` = `atack` + '1' WHERE `id` = '".$c_user['id']."' LIMIT 1");
$mysqli->query("UPDATE `ammunition_users` SET `k` = '".($a_users['k']-1)."', `glory` = '".($a_users['glory']+ceil($vrag_nagrada/2))."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
$_SESSION['err'] = '<div w:id="event"><div class="small white cntr sh_b bold"><div class="medium"><img src="/images/icons/defeat.png"> <span class="red1">Противник отступил!</span> <img src="/images/icons/defeat.png"></div>Награда: <img class="ico vm" src="/images/icons/glory.png?2" alt="Слава" title="Слава"> '.ceil($vrag_nagrada/2).' славы<br><div class="small gray1 cntr sh_b bold">Врагов уничтожено '.($c_user['kill']).'</div></div></div>';
}elseif($c_user['atack']==2 and $attack<$c_user['hp'] and $vrag_a<$c_user['hp_user']){ // последний удар никто никого не убил - поражение
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text.'", `convoy_id` = "'.$c_user['id'].'" ');
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text_ank.'", `convoy_id` = "'.$c_user['id'].'" ');
if($rand_s2 <= $skills_2['bon']){
$mysqli->query("UPDATE `convoy_user` SET `hp` = `hp` - '".$attack."', `atack` = '3' WHERE `id` = '".$c_user['id']."' LIMIT 1");
}else{
$mysqli->query("UPDATE `convoy_user` SET `hp` = `hp` - '".$attack."', `hp_user` = `hp_user` - '".$vrag_a."', `atack` = '3' WHERE `id` = '".$c_user['id']."' LIMIT 1");
}
$mysqli->query("UPDATE `ammunition_users` SET `k` = '".($a_users['k']-1)."', `glory` = '".($a_users['glory']+ceil($vrag_nagrada/2))."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
$_SESSION['err'] = '<div w:id="event"><div class="small white cntr sh_b bold"><div class="medium"><img src="/images/icons/defeat.png"> <span class="red1">Противник отступил!</span> <img src="/images/icons/defeat.png"></div>Награда: <img class="ico vm" src="/images/icons/glory.png?2" alt="Слава" title="Слава"> '.ceil($vrag_nagrada/2).' славы<br><div class="small gray1 cntr sh_b bold">Врагов уничтожено '.($c_user['kill']).'</div></div></div>';
}elseif($c_user['atack']<2 and $attack<$c_user['hp'] and $vrag_a<$c_user['hp_user']){ // 1 или 2 удар никто никого не убил - продолжаем
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text.'", `convoy_id` = "'.$c_user['id'].'" ');
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text_ank.'", `convoy_id` = "'.$c_user['id'].'" ');
if($rand_s2 <= $skills_2['bon']){
$mysqli->query("UPDATE `convoy_user` SET `hp` = `hp` - '".$attack."', `atack` = `atack` + '1' WHERE `id` = '".$c_user['id']."' LIMIT 1");
}else{
$mysqli->query("UPDATE `convoy_user` SET `hp` = `hp` - '".$attack."', `hp_user` = `hp_user` - '".$vrag_a."', `atack` = `atack` + '1' WHERE `id` = '".$c_user['id']."' LIMIT 1");
}
$mysqli->query("UPDATE `ammunition_users` SET `k` = '".($a_users['k']-1)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
}
header('Location: ?');
exit();
}





if(isset($_GET['attack'.$c_user['hp'].'_f'])){ // фугас
if($c_user['time']>time()){header('Location: /convoy/');exit();}
if($c_user['vrag']<=0){header('Location: /convoy/');exit();}
if($c_user['atack']>2){header('Location: /convoy/');exit();}
if($c_user['hp']<1){header('Location: /convoy/');exit();}
if($c_user['hp_user']<1){header('Location: /convoy/');exit();}
if($a_users['f']<=0){$text = "<span class='gray1'>У вас нет такого снаряда</span>";$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text.'", `convoy_id` = "'.$c_user['id'].'" ');header('Location: ?');exit();}

$attack = (($u_t['a']/4) );
##################################################################################### умения
$res_s2 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "2" and `user`  = "'.$user['id'].'" ');
$skills_2 = $res_s2->fetch_assoc(); // рикошет

$res_s3 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "3" and `user`  = "'.$user['id'].'" ');
$skills_3 = $res_s3->fetch_assoc(); // Слабые места

$res_s5 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "5" and `user`  = "'.$user['id'].'" ');
$skills_5 = $res_s5->fetch_assoc(); // Снайпер

$rand_s2 = rand(1,100); // Рикошет
$rand_s3 = rand(1,100); // Слабые места
if($rand_s3 <= $skills_5['bon']){if($skills_5['bon']>0){$attack = floor($attack+($attack*(rand($skills_5['bon'],($skills_5['bon']+50)))/100));$txt_krit = "<span class='red1'>(крит)</span>";}elsE{$attack = $attack;$txt_krit = '';}}//если выпал крит смотрим как прокачан снайпер и увеличиваем урон
##################################################################################### умения
if($u_t['t']<500){$tochnost = ($u_t['t']/10);}else{$tochnost = ($u_t['t']/40);}
$toch = ((($u_t['a']/4)*$tochnost/100) );
if($vip['time1']>time()){$v1 = 25;}elsE{$v1 = 0;}
if($vip['time3']>time()){$v3 = 50;}elsE{$v3 = 0;}
if($vip['time4']>time()){$v4 = 50;}elsE{$v4 = 0;}
$attack = ($attack+ ($attack*($shell_s['b']+$v1+$v3+$v4)/100));
$attack = floor($attack+$toch);
if($attack>=$c_user['hp']){$attack = ceil($c_user['hp']);}else{$attack = ceil($attack);}

$text = "<div><span class='green1'>Вы нанесли</span> <img src='/images/shells/".$img.".png'> <span class='red1'>".$attack."</span> урона ".$txt_krit." <span class='yellow1 td_u'>".$name_2."</span></div>";
if($rand_s2 <= $skills_2['bon']){
$text_ank = "<div><span class='blue1'>РИКОШЕТ: </span> <span class='yellow1 td_u'>".$vrag_name."</span> <span class='red1'>нанёс вам</span> <img src='/images/shells/HighExplosive.png'> <span class='red1'>0</span> урона</div>";
}else{
$text_ank = "<div><span class='yellow1 td_u'>".$vrag_name."</span> <span class='red1'>нанёс вам</span> <img src='/images/shells/HighExplosive.png'> <span class='red1'>".$vrag_a."</span> урона</div>";
}
$mysqli->query("UPDATE `shellskills` SET `f_` = '".($shell_s['f_']+1)."' WHERE `id` = '".$shell_s['id']."' LIMIT 1");
if($attack>=$c_user['hp']){ // если последний удар убивает противника - победа
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text.'", `convoy_id` = "'.$c_user['id'].'" ');
$mysqli->query("UPDATE `convoy_user` SET `hp` = '0', `atack` = `atack` + '1', `kill` = `kill` + '1' WHERE `id` = '".$c_user['id']."' LIMIT 1");
$mysqli->query("UPDATE `ammunition_users` SET `f` = '".($a_users['f']-1)."', `glory` = '".($a_users['glory']+($vrag_nagrada))."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
$res = $mysqli->query('SELECT * FROM `prom` WHERE `id` = "1" ');
$prom = $res->fetch_assoc();
if($prom['time_20']>time()){
$res = $mysqli->query('SELECT * FROM `bz_user` WHERE `user` = "'.$user['id'].'" and `tip` = "'.$prom['tip_20'].'"');
$bz_user = $res->fetch_assoc();
if($bz_user['step']==11 and $bz_user['prog_']<$bz_user['prog']){
$mysqli->query('UPDATE `bz_user` SET `prog_` = `prog_` + "1" WHERE `id` = '.$bz_user['id'].'');
}
}
$_SESSION['err'] = '<div w:id="event"><div class="small white cntr sh_b bold"><div class="medium"><img src="/images/icons/victory.png"> <span class="green1">Боевая техника уничтожена!</span> <img src="/images/icons/victory.png"></div>Награда: <img class="ico vm" src="/images/icons/glory.png?2" alt="Слава" title="Слава"> '.($vrag_nagrada).' славы<br><div class="small gray1 cntr sh_b bold">Врагов уничтожено '.($c_user['kill']+1).'</div></div></div>'; 
}elseif($attack<$c_user['hp'] and $vrag_a>=$c_user['hp_user']){ // если последний удар убивает игрока - поражение
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text.'", `convoy_id` = "'.$c_user['id'].'" ');
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text_ank.'", `convoy_id` = "'.$c_user['id'].'" ');
$mysqli->query("UPDATE `convoy_user` SET `hp_user` = '0', `atack` = `atack` + '1' WHERE `id` = '".$c_user['id']."' LIMIT 1");
$mysqli->query("UPDATE `ammunition_users` SET `f` = '".($a_users['f']-1)."', `glory` = '".($a_users['glory']+ceil($vrag_nagrada/2))."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
$_SESSION['err'] = '<div w:id="event"><div class="small white cntr sh_b bold"><div class="medium"><img src="/images/icons/defeat.png"> <span class="red1">Противник отступил!</span> <img src="/images/icons/defeat.png"></div>Награда: <img class="ico vm" src="/images/icons/glory.png?2" alt="Слава" title="Слава"> '.ceil($vrag_nagrada/2).' славы<br><div class="small gray1 cntr sh_b bold">Врагов уничтожено '.($c_user['kill']).'</div></div></div>';
}elseif($c_user['atack']==2 and $attack<$c_user['hp'] and $vrag_a<$c_user['hp_user']){ // последний удар никто никого не убил - поражение
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text.'", `convoy_id` = "'.$c_user['id'].'" ');
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text_ank.'", `convoy_id` = "'.$c_user['id'].'" ');
if($rand_s2 <= $skills_2['bon']){
$mysqli->query("UPDATE `convoy_user` SET `hp` = `hp` - '".$attack."', `atack` = '3' WHERE `id` = '".$c_user['id']."' LIMIT 1");
}else{
$mysqli->query("UPDATE `convoy_user` SET `hp` = `hp` - '".$attack."', `hp_user` = `hp_user` - '".$vrag_a."', `atack` = '3' WHERE `id` = '".$c_user['id']."' LIMIT 1");
}
$mysqli->query("UPDATE `ammunition_users` SET `f` = '".($a_users['f']-1)."', `glory` = '".($a_users['glory']+ceil($vrag_nagrada/2))."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
$_SESSION['err'] = '<div w:id="event"><div class="small white cntr sh_b bold"><div class="medium"><img src="/images/icons/defeat.png"> <span class="red1">Противник отступил!</span> <img src="/images/icons/defeat.png"></div>Награда: <img class="ico vm" src="/images/icons/glory.png?2" alt="Слава" title="Слава"> '.ceil($vrag_nagrada/2).' славы<br><div class="small gray1 cntr sh_b bold">Врагов уничтожено '.($c_user['kill']).'</div></div></div>';
}elseif($c_user['atack']<2 and $attack<$c_user['hp'] and $vrag_a<$c_user['hp_user']){ // 1 или 2 удар никто никого не убил - продолжаем
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text.'", `convoy_id` = "'.$c_user['id'].'" ');
$mysqli->query('INSERT INTO `convoy_log` SET `time` = "'.time().'", `text` = "'.$text_ank.'", `convoy_id` = "'.$c_user['id'].'" ');
if($rand_s2 <= $skills_2['bon']){
$mysqli->query("UPDATE `convoy_user` SET `hp` = `hp` - '".$attack."', `atack` = `atack` + '1' WHERE `id` = '".$c_user['id']."' LIMIT 1");
}else{
$mysqli->query("UPDATE `convoy_user` SET `hp` = `hp` - '".$attack."', `hp_user` = `hp_user` - '".$vrag_a."', `atack` = `atack` + '1' WHERE `id` = '".$c_user['id']."' LIMIT 1");
}
$mysqli->query("UPDATE `ammunition_users` SET `f` = '".($a_users['f']-1)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
}
header('Location: ?');
exit();
}




























}
########################################################################################################################
if($c_user['hp']>0 and $c_user['hp_user']>0 and $c_user['atack']>=3){ // поражение не хватило ударов
echo '<div class="trnt-block" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">';
echo '<div class="cntr"><div class="small bold orange mb5">'.$vrag_name.'</div><a href="?next"><img src="/images/convoy/'.$images.'.png"></a><div class="small white mt2">Выбери тип снаряда и атакуй</div></div>';
echo '<table class="rblock esmall mb0"><tbody><tr>
<td><div class="value-block lh1"><span><span>'.($c_user['hp']).'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$usA.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.($vrag_h).'</span></span></div></td>
</tr></tbody></table>';
echo '<table><tbody><tr>
<td class="w50 pr5"><a href="?atack'.$c_user['id'].'" class="simple-but gray"><span><span>ОБЫЧНЫЕ</span></span></a></td>
<td class="w50 pl5"><a href="?'.$href.'" class="simple-but"><span><span>'.$butt.'</span></span></a></td>
</tr></tbody></table>';echo '<div class="small white cntr">Моя прочность</div>';
echo '<table class="rblock esmall mb0"><tbody><tr>
<td><div class="value-block lh1"><span><span>'.($c_user['hp_user']).'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$usP.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.($u_t['p']*2).'</span></span></div></td>
</tr></tbody></table>';
$res1 = $mysqli->query('SELECT * FROM `convoy_log` WHERE `convoy_id` = "'.$c_user['id'].'" ORDER BY `id` desc LIMIT 20');//or `user_nick` is NULL
while ($t_r1 = $res1->fetch_array()){echo '<div class="small p5">'.$t_r1['text'].'</div>';}
if($c_user['shag']<1){
echo '<div class="bot"><a class="simple-but border" w:id="findNewEnemy" href="?next"><span><span>Новый противник</span></span></a></div>';
}else{
echo '<div class="bot"><a class="simple-but border" w:id="findNewEnemy" href="?next"><span><span>Завершить сопровождение</span></span></a></div>';
}
echo '</div></div></div></div></div></div></div></div></div></div></div>';
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini"><div class="mt5 mb5 small green1 cntr">Специальные (зеленые) снаряды наносят на 25% больше урона чем обычные</div></div></div></div></div></div></div></div></div></div></div>';
echo '<div class="bot"><a class="simple-but border gray mb2" href="/"><span><span>Вернуться в ангар</span></span></a></div>';
if(isset($_GET['next'])){
if($c_user['time']>time()){header('Location: /convoy/');exit();}
if($c_user['vrag']<1){header('Location: /convoy/');exit();}
if($c_user['atack']<1){header('Location: /convoy/');exit();}
if($c_user['shag']==0){ // если остался еще один противник - продолжаем
$mysqli->query("UPDATE `convoy_user` SET `shag` = '1', `atack` = '0', `hp` = '0', `hp_user` = '0' WHERE `id` = '".$c_user['id']."' LIMIT 1");
}else{
if($c_user['level']<8){$time = 2400;}else{$time = 10800;}
$mysqli->query("UPDATE `convoy_user` SET `time` = '".(time()+$time)."', `level` = `level` + '1', `vrag` = '0', `vrag2` = '0', `shag` = '0', `atack` = '0', `hp` = '0', `hp_user` = '0' WHERE `id` = '".$c_user['id']."' LIMIT 1");
}
$mysqli->query('DELETE FROM `convoy_log` WHERE `convoy_id` = "'.$c_user['id'].'" ');
header('Location: ?');
exit();
}
}
########################################################################################################################
if($c_user['hp']>0 and $c_user['hp_user']<=0){ // поражение игрок убит
echo '<div class="trnt-block" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">';
echo '<div class="cntr"><div class="small bold orange mb5">'.$vrag_name.'</div><a href="?next"><img src="/images/convoy/'.$images.'.png"></a><div class="small white mt2">Выбери тип снаряда и атакуй</div></div>';
echo '<table class="rblock esmall mb0"><tbody><tr>
<td><div class="value-block lh1"><span><span>'.($c_user['hp']).'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$usA.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.($vrag_h).'</span></span></div></td>
</tr></tbody></table>';
echo '<table><tbody><tr>
<td class="w50 pr5"><a href="?atack'.$c_user['id'].'" class="simple-but gray"><span><span>ОБЫЧНЫЕ</span></span></a></td>
<td class="w50 pl5"><a href="?'.$href.'" class="simple-but"><span><span>'.$butt.'</span></span></a></td>
</tr></tbody></table>';echo '<div class="small white cntr">Моя прочность</div>';
echo '<table class="rblock esmall mb0"><tbody><tr>
<td><div class="value-block lh1"><span><span>'.($c_user['hp_user']).'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$usP.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.($u_t['p']*2).'</span></span></div></td>
</tr></tbody></table>';
$res1 = $mysqli->query('SELECT * FROM `convoy_log` WHERE `convoy_id` = "'.$c_user['id'].'" ORDER BY `id` desc LIMIT 20');//or `user_nick` is NULL
while ($t_r1 = $res1->fetch_array()){echo '<div class="small p5">'.$t_r1['text'].'</div>';}
if($c_user['shag']<1){
echo '<div class="bot"><a class="simple-but border" w:id="findNewEnemy" href="?next"><span><span>Новый противник</span></span></a></div>';
}else{
echo '<div class="bot"><a class="simple-but border" w:id="findNewEnemy" href="?next"><span><span>Завершить сопровождение</span></span></a></div>';
}
echo '</div></div></div></div></div></div></div></div></div></div></div>';
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini"><div class="mt5 mb5 small green1 cntr">Специальные (зеленые) снаряды наносят на 25% больше урона чем обычные</div></div></div></div></div></div></div></div></div></div></div>';
echo '<div class="bot"><a class="simple-but border gray mb2" href="/"><span><span>Вернуться в ангар</span></span></a></div>';
if(isset($_GET['next'])){
if($c_user['time']>time()){header('Location: /convoy/');exit();}
if($c_user['vrag']<1){header('Location: /convoy/');exit();}
if($c_user['atack']<1){header('Location: /convoy/');exit();}
if($c_user['shag']==0){ // если остался еще один противник - продолжаем
$mysqli->query("UPDATE `convoy_user` SET `shag` = '1', `atack` = '0', `hp` = '0', `hp_user` = '0' WHERE `id` = '".$c_user['id']."' LIMIT 1");
}else{
if($c_user['level']<8){$time = 2400;}else{$time = 10800;}
$mysqli->query("UPDATE `convoy_user` SET `time` = '".(time()+$time)."', `level` = `level` + '1', `vrag` = '0', `vrag2` = '0', `shag` = '0', `atack` = '0', `hp` = '0', `hp_user` = '0' WHERE `id` = '".$c_user['id']."' LIMIT 1");
}
$mysqli->query('DELETE FROM `convoy_log` WHERE `convoy_id` = "'.$c_user['id'].'" ');
header('Location: ?');
exit();
}
}
########################################################################################################################
if($c_user['hp']<=0 and $c_user['hp_user']>0){ // победа враг убит
echo '<div class="trnt-block" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">';
echo '<div class="cntr"><div class="small bold orange mb5">'.$vrag_name.'</div><a href="?next"><img src="/images/convoy/'.$images.'-d.png"></a><div class="small white mt2">Выбери тип снаряда и атакуй</div></div>';
echo '<table class="rblock esmall mb0"><tbody><tr>
<td><div class="value-block lh1"><span><span>'.($c_user['hp']).'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$usA.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.($vrag_h).'</span></span></div></td>
</tr></tbody></table>';
echo '<table><tbody><tr>
<td class="w50 pr5"><a href="?atack'.$c_user['id'].'" class="simple-but gray"><span><span>ОБЫЧНЫЕ</span></span></a></td>
<td class="w50 pl5"><a href="?'.$href.'" class="simple-but"><span><span>'.$butt.'</span></span></a></td>
</tr></tbody></table>';echo '<div class="small white cntr">Моя прочность</div>';
echo '<table class="rblock esmall mb0"><tbody><tr>
<td><div class="value-block lh1"><span><span>'.($c_user['hp_user']).'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$usP.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.($u_t['p']*2).'</span></span></div></td>
</tr></tbody></table>';
$res1 = $mysqli->query('SELECT * FROM `convoy_log` WHERE `convoy_id` = "'.$c_user['id'].'" ORDER BY `id` desc LIMIT 20');//or `user_nick` is NULL
while ($t_r1 = $res1->fetch_array()){echo '<div class="small p5">'.$t_r1['text'].'</div>';}
if($c_user['shag']<1){
echo '<div class="bot"><a class="simple-but border" w:id="findNewEnemy" href="?next"><span><span>Новый противник</span></span></a></div>';
}else{
echo '<div class="bot"><a class="simple-but border" w:id="findNewEnemy" href="?next"><span><span>Завершить сопровождение</span></span></a></div>';
}
echo '</div></div></div></div></div></div></div></div></div></div></div>';
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini"><div class="mt5 mb5 small green1 cntr">Специальные (зеленые) снаряды наносят на 25% больше урона чем обычные</div></div></div></div></div></div></div></div></div></div></div>';
echo '<div class="bot"><a class="simple-but border gray mb2" href="/"><span><span>Вернуться в ангар</span></span></a></div>';
if(isset($_GET['next'])){
if($c_user['time']>time()){header('Location: /convoy/');exit();}
if($c_user['vrag']<1){header('Location: /convoy/');exit();}
if($c_user['atack']<1){header('Location: /convoy/');exit();}
if($c_user['shag']==0){ // если остался еще один противник - продолжаем
$mysqli->query("UPDATE `convoy_user` SET `shag` = '1', `atack` = '0', `hp` = '0', `hp_user` = '0' WHERE `id` = '".$c_user['id']."' LIMIT 1");
}else{
if($c_user['level']<8){$time = 2400;}else{$time = 10800;}
$mysqli->query("UPDATE `convoy_user` SET `time` = '".(time()+$time)."', `vrag` = '0', `level` = `level` + '1', `vrag2` = '0', `shag` = '0', `atack` = '0', `hp` = '0', `hp_user` = '0' WHERE `id` = '".$c_user['id']."' LIMIT 1");
}
$mysqli->query('DELETE FROM `convoy_log` WHERE `convoy_id` = "'.$c_user['id'].'" ');
header('Location: ?');
exit();
}
}

########################################################################################################################




















//require_once ('../system/footer.php');
?>