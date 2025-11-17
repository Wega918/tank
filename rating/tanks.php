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


$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `active` = "1" ORDER BY `a` + `b` + `t` + `p` desc LIMIT 100000');
while ($t_r = $res->fetch_array()){
$params = ($t_r['a']+$t_r['b']+$t_r['t']+$t_r['p']);
$reyt = ''.++$k_post[0].'';
if($t_r['user'] == $user['id']){
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<table class="white sh_b bold small mb0"><tbody><tr>
<td class="va_m usr w100 pl5">'.$reyt.' '.nick($t_r['user']).'</td>
<td class="va_m nwr p5 ta_r"><img class="vb" height="14" width="14" src="/images/upgrades/starFull.png"> '.$params.'</td>
</tr></tbody></table>
</div></div></div></div></div></div></div></div></div></div>';
}
}



echo '<div class="white medium cntr bold mb2">Лучшие танкисты</div>';




$max = 10;
$res = $mysqli->query("SELECT COUNT(*) FROM `users_tanks` WHERE `active` = '1' ");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `active` = "1" ORDER BY `a` + `b` + `t` + `p` desc LIMIT '.$start.','.$max.' ');
while ($t_r = $res->fetch_array()){
$reyt = ''.$k_post[0]++.'';
$format_c=str_replace('green2','small green2 sh_b mb5',nick($t_r['user']));

$res_t = $mysqli->query('SELECT * FROM `tanks` WHERE `id`  = "'.$t_r['tip'].'" limit 1');
$tank = $res_t->fetch_assoc();

if($tank['tip'] == 1){$tip_tank = 'average';$tip_tank_ru = 'СРЕДНИЙ ТАНК';} // СТ
if($tank['tip'] == 2){$tip_tank = 'heavy';$tip_tank_ru = 'ТЯЖЕЛЫЙ ТАНК';} // ТТ
if($tank['tip'] == 3){$tip_tank = 'SAU';$tip_tank_ru = 'ПТ-САУ';} // САУ

if($tank['country'] == 'GERMANY'){$coun_tank = 'ГЕРМАНИЯ';$coun_tank_en = 'germany';}
if($tank['country'] == 'SSSR'){$coun_tank = 'СССР';$coun_tank_en = 'ussr';}
if($tank['country'] == 'USA'){$coun_tank = 'США';$coun_tank_en = 'usa';}

$params = ($t_r['a']+$t_r['b']+$t_r['t']+$t_r['p']);



if($reyt==1){
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr white bold">
<a href="/profile/'.$t_r['user'].'/">'.$format_c.'
<div class="mt10"></div>
<table><tbody><tr><td class="cntr"><img class="tank-img" alt="tank" src="/images/tanks/'.$tip_tank.'/'.$tank['country'].'/'.$tank['name'].'.png"></td></tr></tbody></table>
<div class="small bold va_m">
<img width="16" height="11" src="/images/flags/'.$coun_tank_en.'16x11.png"> <font size="1">Страна: <font color="green1" style="opacity:0.7;">'.$coun_tank.'</font></font>
<img width="20" height="20" src="/images/tanks/'.$tip_tank.'.png"><font size="1">Тип: <font color="green1" style="opacity:0.7;">'.$tip_tank_ru.'</font></font>
<img width="25" height="14" src="/images/tanks/'.$tip_tank.'/'.$tank['country'].'/'.$tank['name'].'.png"><font size="1">Танк: <font color="green1" style="opacity:0.7;">'.$tank['name'].'</font></font>
</div><span class="blck cntr small bold mb2 pb0"><img src="/images/upgrades/starFull.png" height="14" width="14"> <span class="green2">Танковая мощь: '.$params.'</span></span>
</a></div></div></div></div></div></div></div></div></div></div>';
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
</a></div></div></div></div></div></div></div></div></div></div>';
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
</a></div></div></div></div></div></div></div></div></div></div></span></span></span></span></span></span></span>';
}


if($reyt>3){
if($reyt % 2){
if($t_r['user'] == $user['id']){$test = 'odd my';}else{$test = 'odd';}
}else{
if($t_r['user'] == $user['id']){$test = 'odd my';}else{$test = 'even';}
}
echo '<table class="tlist white sh_b bold small mb0"><tbody><tr w:id="users" class="'.$test.'">
<td class="num">'.$reyt.'</td><td class="va_m usr w100">'.$format_c.'</td>
<td class="va_m nwr p5 ta_r"><img class="vb" height="14" width="14" src="/images/upgrades/starFull.png"> '.$params.'</td>
</tr></tbody></table>';
}
}
if ($k_page > 1) {
echo str('/rating/tanks/?',$k_page,$page); // Вывод страниц
}








echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<a class="simple-but mt5 mb5 a_w50" w:id="searchLink" href="/search/"><span><span>Поиск танкиста</span></span></a></div></div></div></div></div></div></div></div></div></div>';

echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini ml10"><div class="mt5 mb5 small bold">
<img height="14" width="14" src="/images/upgrades/starFull.png"> <a class="orange" w:id="filterExp" href="/rating/tanks/"><span><span>Лучшие по параметрам</span></span></a><br>
</div></div></div></div></div></div></div></div></div></div></div>';

echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini ml10"><div class="mt5 mb5 small bold">
<img height="14" width="14" src="/images/icons/exp.png"> <a class="green2" w:id="filterExp" href="/rating/users/"><span><span>Лучшие по опыту</span></span></a><br>
</div></div></div></div></div></div></div></div></div></div></div>';

echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini cntr">
<div class="mt5 mb5 small green1"><img class="vb" height="14" width="14" src="/images/upgrades/starFull.png"> Танковая мощь: сумма всех параметров танка</div></div></div></div></div></div></div></div></div></div></div>';

require_once ('../system/footer.php');
?>