<?php
$title = 'Лучшие танкисты';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}

echo '<table><tbody><tr>
<td style="width:50%;padding:0 3px;"><a class="simple-but gray" href="/rating/tanks/"><span><span>Танкисты</span></span></a></td>
<td style="width:50%;padding:0 3px;"><a class="simple-but blue" href="/rating/company/"><span><span>Дивизии</span></span></a></td>
</tr></tbody></table>';



$res = $mysqli->query('SELECT * FROM `users` WHERE `id` ORDER BY `level` desc, `exp` desc LIMIT 100000');
while ($usr = $res->fetch_array()){
$reyt = ''.++$k_post[0].'';
if($usr['id'] == $user['id']){
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<table class="white sh_b bold small mb0"><tbody><tr>
<td class="va_m usr w100 pl5">'.$reyt.' '.nick($usr['id']).'</td>
<td class="va_m nwr p5 ta_r"><img class="vb" height="14" width="14" src="/images/icons/exp.png"> '.$usr['level'].'</td>
</tr></tbody></table>
</div></div></div></div></div></div></div></div></div></div>';
}
}





echo '<div class="white medium cntr bold mb2">Лучшие танкисты по опыту</div>';





$max = 10;
$res = $mysqli->query("SELECT COUNT(*) FROM `users` WHERE `id` ");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$res = $mysqli->query('SELECT * FROM `users` WHERE `id` ORDER BY `level` desc, `exp` desc LIMIT '.$start.','.$max.' ');
while ($usr = $res->fetch_array()){
$reyt = ''.$k_post[0]++.'';
$format_c=str_replace('green2','small green2 sh_b mb5',nick($usr['id']));

$res_ut = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user`  = "'.$usr['id'].'" and `active`  = "1" limit 1');
$u_t = $res_ut->fetch_assoc();

$res_t = $mysqli->query('SELECT * FROM `tanks` WHERE `id`  = "'.$u_t['tip'].'" limit 1');
$tank = $res_t->fetch_assoc();

if($tank['tip'] == 1){$tip_tank = 'average';$tip_tank_ru = 'СРЕДНИЙ ТАНК';} // СТ
if($tank['tip'] == 2){$tip_tank = 'heavy';$tip_tank_ru = 'ТЯЖЕЛЫЙ ТАНК';} // ТТ
if($tank['tip'] == 3){$tip_tank = 'SAU';$tip_tank_ru = 'ПТ-САУ';} // САУ

if($tank['country'] == 'GERMANY'){$coun_tank = 'ГЕРМАНИЯ';$coun_tank_en = 'germany';}
if($tank['country'] == 'SSSR'){$coun_tank = 'СССР';$coun_tank_en = 'ussr';}
if($tank['country'] == 'USA'){$coun_tank = 'США';$coun_tank_en = 'usa';}

$params = ($u_t['a']+$u_t['b']+$u_t['t']+$u_t['p']);


if($usr['level'] == 1){ $exp = 4;}
elseif($usr['level'] == 2){ $exp = 9;}
elseif($usr['level'] == 3){ $exp = 15;}
elseif($usr['level'] == 4){ $exp = 35;}
elseif($usr['level'] == 5){ $exp = 60;}
elseif($usr['level'] == 6){ $exp = 95;}
elseif($usr['level'] == 7){ $exp = 150;}
elseif($usr['level'] == 8){ $exp = 250;}
elseif($usr['level'] == 9){ $exp = 400;}
elseif($usr['level'] == 10){ $exp = 650;}
elseif($usr['level'] == 11){ $exp = 900;}
elseif($usr['level'] == 12){ $exp = 1200;}
elseif($usr['level'] == 13){ $exp = 1500;}
elseif($usr['level'] == 14){ $exp = 2000;}
elseif($usr['level'] == 15){ $exp = 3000;}
elseif($usr['level'] == 16){ $exp = 4500;}
elseif($usr['level'] == 17){ $exp = 6000;}
elseif($usr['level'] == 18){ $exp = 7500;}
elseif($usr['level'] == 19){ $exp = 9500;}
elseif($usr['level'] == 20){ $exp = 11500;}
elseif($usr['level'] == 21){ $exp = 12000;}
elseif($usr['level'] == 22){ $exp = 15000;}
elseif($usr['level'] == 23){ $exp = 22000;}
elseif($usr['level'] == 24){ $exp = 35000;}
elseif($usr['level'] == 25){ $exp = 60000;}
elseif($usr['level'] == 26){ $exp = 100000;}
elseif($usr['level'] == 27){ $exp = 160000;}
elseif($usr['level'] == 28){ $exp = 240000;}
elseif($usr['level'] == 29){ $exp = 400000;}
elseif($usr['level'] == 30){ $exp = 600000;}
elseif($usr['level'] == 31){ $exp = 800000;}
elseif($usr['level'] == 32){ $exp = 1000000;}
elseif($usr['level'] == 33){ $exp = 1200000;}
elseif($usr['level'] == 34){ $exp = 1400000;}
elseif($usr['level'] == 35){ $exp = 1600000;}
elseif($usr['level'] == 36){ $exp = 1800000;}
elseif($usr['level'] == 37){ $exp = 2200000;}
elseif($usr['level'] == 38){ $exp = 2500000;}
elseif($usr['level'] == 39){ $exp = 3500000;}
elseif($usr['level'] == 40){ $exp = 5000000;}
elseif($usr['level'] == 41){ $exp = 7500000;}
elseif($usr['level'] == 42){ $exp = 10000000;}
elseif($usr['level'] == 43){ $exp = 12500000;}
elseif($usr['level'] == 44){ $exp = 15000000;}
elseif($usr['level'] == 45){ $exp = 20000000;}
elseif($usr['level'] == 46){ $exp = 25000000;}
elseif($usr['level'] == 47){ $exp = 35000000;}
elseif($usr['level'] == 48){ $exp = 50000000;}
elseif($usr['level'] == 49){ $exp = 60000000;}
elseif($usr['level'] == 50){ $exp = 90000000;}
elseif($usr['level'] == 51){ $exp = 125000000;}
elseif($usr['level'] == 52){ $exp = 170000000;}
elseif($usr['level'] == 53){ $exp = 225000000;}
elseif($usr['level'] == 54){ $exp = 300000000;}
elseif($usr['level'] >= 55){ $exp = 100000000000000000000000000000000000000000000000000000000000000000000;}



$exp1 = ($exp*5);
$exp_progress = round(100/($exp1/($usr['exp']+1)));
if($exp_progress > 100) {$exp_progress = 100;}


if($reyt==1){
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr white bold">
<a href="/profile/'.$usr['id'].'/">'.$format_c.'
<div class="mt10"></div>
<table><tbody><tr><td class="cntr"><img class="tank-img" alt="tank" src="/images/tanks/'.$tip_tank.'/'.$tank['country'].'/'.$tank['name'].'.png"></td></tr></tbody></table>
<div class="small bold va_m">
<img width="16" height="11" src="/images/flags/'.$coun_tank_en.'16x11.png"> <font size="1">Страна: <font color="green1" style="opacity:0.7;">'.$coun_tank.'</font></font>
<img width="20" height="20" src="/images/tanks/'.$tip_tank.'.png"><font size="1">Тип: <font color="green1" style="opacity:0.7;">'.$tip_tank_ru.'</font></font>
<img width="25" height="14" src="/images/tanks/'.$tip_tank.'/'.$tank['country'].'/'.$tank['name'].'.png"><font size="1">Танк: <font color="green1" style="opacity:0.7;">'.$tank['name'].'</font></font>
</div><span class="blck cntr small bold mb2 pb0"><img src="/images/upgrades/starFull.png" height="14" width="14"> <span class="green2">Танковая мощь: '.$params.'</span></span>
</a>
<table class="rblock blue esmall"><tbody><tr>
<td><div class="value-block lh1"><span><span><img class="vb" height="14" width="14" src="/images/icons/exp.png">'.$usr['level'].'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$exp_progress.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$exp_progress.'%</span></span></div></td>
</tr></tbody></table>
</div></div></div></div></div></div></div></div></div></div></span></span></span></span></span></span></span>';
}

if($reyt==2){
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr white bold">
<a href="/profile/'.$t_r['user'].'/">'.$format_c.'
<div class="mt10"></div>
<table><tbody><tr><td class="cntr"><img class="tank-img" alt="tank" src="/images/tanks/'.$tip_tank.'/'.$tank['country'].'/'.$tank['name'].'.png"></td></tr></tbody></table>
<div class="small bold va_m">
<img width="16" height="11" src="/images/flags/'.$coun_tank_en.'16x11.png"> <font size="1">Страна: <font color="green1" style="opacity:0.7;">'.$coun_tank.'</font></font>
<img width="20" height="20" src="/images/tanks/'.$tip_tank.'.png"><font size="1">Тип: <font color="green1" style="opacity:0.7;">'.$tip_tank_ru.'</font></font>
<img width="25" height="14" src="/images/tanks/'.$tip_tank.'/'.$tank['country'].'/'.$tank['name'].'.png"><font size="1">Танк: <font color="green1" style="opacity:0.7;">'.$tank['name'].'</font></font>
</div><span class="blck cntr small bold mb2 pb0"><img src="/images/upgrades/starFull.png" height="14" width="14"> <span class="green2">Танковая мощь: '.$params.'</span></span>
</a>
<table class="rblock blue esmall"><tbody><tr>
<td><div class="value-block lh1"><span><span><img class="vb" height="14" width="14" src="/images/icons/exp.png">'.$usr['level'].'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$exp_progress.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$exp_progress.'%</span></span></div></td>
</tr></tbody></table>
</div></div></div></div></div></div></div></div></div></div></span></span></span></span></span></span></span>';
}

if($reyt==3){
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr white bold">
<a href="/profile/'.$t_r['user'].'/">'.$format_c.'
<div class="mt10"></div>
<table><tbody><tr><td class="cntr"><img class="tank-img" alt="tank" src="/images/tanks/'.$tip_tank.'/'.$tank['country'].'/'.$tank['name'].'.png"></td></tr></tbody></table>
<div class="small bold va_m">
<img width="16" height="11" src="/images/flags/'.$coun_tank_en.'16x11.png"> <font size="1">Страна: <font color="green1" style="opacity:0.7;">'.$coun_tank.'</font></font>
<img width="20" height="20" src="/images/tanks/'.$tip_tank.'.png"><font size="1">Тип: <font color="green1" style="opacity:0.7;">'.$tip_tank_ru.'</font></font>
<img width="25" height="14" src="/images/tanks/'.$tip_tank.'/'.$tank['country'].'/'.$tank['name'].'.png"><font size="1">Танк: <font color="green1" style="opacity:0.7;">'.$tank['name'].'</font></font>
</div><span class="blck cntr small bold mb2 pb0"><img src="/images/upgrades/starFull.png" height="14" width="14"> <span class="green2">Танковая мощь: '.$params.'</span></span>
</a>
<table class="rblock blue esmall"><tbody><tr>
<td><div class="value-block lh1"><span><span><img class="vb" height="14" width="14" src="/images/icons/exp.png">'.$usr['level'].'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$exp_progress.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$exp_progress.'%</span></span></div></td>
</tr></tbody></table>
</div></div></div></div></div></div></div></div></div></div></span></span></span></span></span></span></span>';
}






if($reyt>3){
if($reyt % 2){
if($usr['id'] == $user['id']){$test = 'odd my';}else{$test = 'odd';}
}else{
if($usr['id'] == $user['id']){$test = 'odd my';}else{$test = 'even';}
}
echo '<table class="tlist white sh_b bold small mb0"><tbody><tr w:id="users" class="'.$test.'">
<td class="num">'.$reyt.'</td>
<td class="va_m usr w100">'.$format_c.'</td>
<td class="va_m nwr p5 ta_r"><img class="vb" height="14" width="14" src="/images/icons/exp.png"> '.$usr['level'].'</td>
</tr></tbody></table>';
}
/* 
<td class="va_m usr w100"> <img class="vb" height="15" width="15" src="/images/side/federation/3.png"> <a href="/profile/723/"><span class="small green2 sh_b mb5">Газпромбайтер</span></a></td>
<td class="va_m usr w100"> <a class="white" w:id="link" href="/company/3/"><img class="vb" src="/images/side/empire.png?1"> <span class="green2">Супертанки</span><br></a></td>
<td class="va_m usr w100"> <a class="white" w:id="profileLink" href="profile/27600550"><img class="vb" height="14" width="14" src="/images/side/federation/11.png?1"> <span class="green2" w:id="login">Net Cerberus</span><br></a></td>
 */
}
if ($k_page > 1) {
echo str('/rating/users/?',$k_page,$page); // Вывод страниц
}








echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<a class="simple-but mt5 mb5 a_w50" w:id="searchLink" href="/search/"><span><span>Поиск танкиста</span></span></a></div></div></div></div></div></div></div></div></div></div>';

echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini ml10"><div class="mt5 mb5 small bold">
<img height="14" width="14" src="/images/upgrades/starFull.png"> <a class="green2" w:id="filterExp" href="/rating/tanks/"><span><span>Лучшие по параметрам</span></span></a><br>
</div></div></div></div></div></div></div></div></div></div></div>';

echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini ml10"><div class="mt5 mb5 small bold">
<img height="14" width="14" src="/images/icons/exp.png"> <a class="orange" w:id="filterExp" href="/rating/users/"><span><span>Лучшие по опыту</span></span></a><br>
</div></div></div></div></div></div></div></div></div></div></div>';

echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini cntr">
<div class="mt5 mb5 small green1"><img class="vb" height="14" width="14" src="/images/upgrades/starFull.png"> Танковая мощь: сумма всех параметров танка</div></div></div></div></div></div></div></div></div></div></div>';
require_once ('../system/footer.php');
?>