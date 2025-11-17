<?php
$title = 'Акция';
require_once ('system/function.php');
require_once ('system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}
$id = abs(intval($_GET['id']));
$res = $mysqli->query('SELECT * FROM `prom` WHERE `id` = "1" ');
$prom = $res->fetch_assoc();
if($prom['time_'.$id.''] < time()){
header('Location: /');
exit();
}

?>

  <style>
   .mirrorY { transform: scale(-1, 1); }
  </style>
<?


if($id==1){
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content admin medium sh_b">
<p></p><div class="cntr mt10"><span style="color:lawngreen;"><b>Акция на покупку золота!</b></span></div><br>
<div class="cntr"><img border="0" src="/images/war13.png"></div>
<br><div class="hr"></div>
<br>
<div class="cntr"><span style="color:yellow;">Купите любое колличество золота и получите <b>+'.$prom['act_'.$id.''].'%</b> в подарок!</span></div>
<br>
<div class="hr"></div>
<br>
<div class="cntr">
<table><tbody><tr><td style="width:33%;padding-right:4px;"></td>
<td style="width:33%;padding:0 4px;"><div style="position:relative;"><a class="simple-but border mb1" href="/pay/"><span><span>Купить золото!</span></span></a></div></td>
<td style="width:33%;padding-left:4px;"></td></tr></tbody></table>
</div>
<br>
<div class="hr"></div><br><div class="cntr mb10"><span style="color:grey;">Акция закончится через <span>'._time($prom['time_'.$id.'']-time()).'</span></span></div><p></p>
</div></div></div></div></div></div></div></div></div></div>';
}

if($id==2){
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content admin medium sh_b">
<p></p><div class="cntr mt10"><span style="color:lawngreen;"><b>Бунусный опыт!</b></span></div><br><div class="hr"></div>
<br>
<div class="cntr"><span style="color:yellow;">Во время действия акции вы будете получать на <b>'.$prom['act_'.$id.''].'%</b> больше опыта!</span></div>
<br>
<div class="hr"></div>
<br>
<div class="cntr">
<table><tbody><tr><td style="width:33%;padding-right:4px;"></td>
<td style="width:33%;padding:0 4px;"><div style="position:relative;"><a class="simple-but border mb1" href="/battle/"><span><span>В бой!</span></span></a></div></td>
<td style="width:33%;padding-left:4px;"></td></tr></tbody></table>
</div>
<br>
<div class="hr"></div><br><div class="cntr mb10"><span style="color:grey;">Акция закончится через <span>'._time($prom['time_'.$id.'']-time()).'</span></span></div><p></p>
</div></div></div></div></div></div></div></div></div></div>';
}

if($id==3){
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content admin medium sh_b">
<p></p><div class="cntr mt10"><span style="color:lawngreen;"><b>Скидка на тренировку!</b></span></div><br><div class="hr"></div>
<br>
<div class="cntr"><span style="color:yellow;">Уникальная скидка <b>'.$prom['act_'.$id.''].'%</b> на прокачку звания!</span></div>
<br>
<div class="hr"></div>
<br>
<div class="cntr">
<table><tbody><tr><td style="width:33%;padding-right:4px;"></td>
<td style="width:33%;padding:0 4px;"><div style="position:relative;"><a class="simple-but border mb1" href="/training/'.$user['id'].'/"><span><span>Тренироваться!</span></span></a></div></td>
<td style="width:33%;padding-left:4px;"></td></tr></tbody></table>
</div>
<br>
<div class="hr"></div><br><div class="cntr mb10"><span style="color:grey;">Акция закончится через <span>'._time($prom['time_'.$id.'']-time()).'</span></span></div><p></p>
</div></div></div></div></div></div></div></div></div></div>';
}

if($id==4){
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content admin medium sh_b">
<p></p><div class="cntr mt10"><span style="color:lawngreen;"><b>Бонус серебра!</b></span></div><br><div class="hr"></div>
<br>
<div class="cntr"><span style="color:yellow;">Купите любое колличество золота и получите <b>+'.$prom['act_'.$id.''].'%</b> <img title="Серебро" alt="Серебро" src="/images/icons/silver.png"> серебра в подарок!</span></div>
<br>
<div class="hr"></div>
<br>
<div class="cntr">
<table><tbody><tr><td style="width:33%;padding-right:4px;"></td>
<td style="width:33%;padding:0 4px;"><div style="position:relative;"><a class="simple-but border mb1" href="/pay/"><span><span>Купить золото</span></span></a></div></td>
<td style="width:33%;padding-left:4px;"></td></tr></tbody></table>
</div>
<br>
<div class="hr"></div><br><div class="cntr mb10"><span style="color:grey;">Акция закончится через <span>'._time($prom['time_'.$id.'']-time()).'</span></span></div><p></p>
</div></div></div></div></div></div></div></div></div></div>';
}

if($id==5){
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content admin medium sh_b">
<p></p><div class="cntr mt10"><span style="color:lawngreen;"><b>Скидка на улучшение базы!</b></span></div><br><div class="hr"></div>
<br>
<div class="cntr"><span style="color:yellow;">Уникальная скидка <b>'.$prom['act_'.$id.''].'%</b> на улучшение зданий базы!</span></div>
<br>
<div class="hr"></div>
<br>
<div class="cntr">
<table><tbody><tr><td style="width:33%;padding-right:4px;"></td>
<td style="width:33%;padding:0 4px;"><div style="position:relative;"><a class="simple-but border mb1" href="/buildings/"><span><span>Улучшить!</span></span></a></div></td>
<td style="width:33%;padding-left:4px;"></td></tr></tbody></table>
</div>
<br>
<div class="hr"></div><br><div class="cntr mb10"><span style="color:grey;">Акция закончится через <span>'._time($prom['time_'.$id.'']-time()).'</span></span></div><p></p>
</div></div></div></div></div></div></div></div></div></div>';
}





if($id==6){
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content admin medium sh_b">
<p></p><div class="cntr mt10"><span style="color:lawngreen;"><b>Скидка на прокачку умений!</b></span></div><br><div class="hr"></div>
<br>
<div class="cntr"><span style="color:yellow;">Уникальная скидка <b>'.$prom['act_'.$id.''].'%</b> на прокачку умений!</span></div>
<br>
<div class="hr"></div>
<br>
<div class="cntr">
<table><tbody><tr><td style="width:33%;padding-right:4px;"></td>
<td style="width:33%;padding:0 4px;"><div style="position:relative;"><a class="simple-but border mb1" href="/skills/'.$user['id'].'/"><span><span>Улучшить!</span></span></a></div></td>
<td style="width:33%;padding-left:4px;"></td></tr></tbody></table>
</div>
<br>
<div class="hr"></div><br><div class="cntr mb10"><span style="color:grey;">Акция закончится через <span>'._time($prom['time_'.$id.'']-time()).'</span></span></div><p></p>
</div></div></div></div></div></div></div></div></div></div>';
}




if($id==7){
if($user['level'] < 2){
header('Location: /');
exit();
}
$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = '.$user['id'].' and `active`  = "1" LIMIT 1');
$users_tanks = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `tanks` WHERE `id`  = "'.$users_tanks['tip'].'" limit 1');
$tank = $res->fetch_assoc();

if($tank['tip'] == 1){$tip_tank = 'average';$tip_tank_ru = 'СРЕДНИЙ ТАНК';} // СТ
if($tank['tip'] == 2){$tip_tank = 'heavy';$tip_tank_ru = 'ТЯЖЕЛЫЙ ТАНК';} // ТТ
if($tank['tip'] == 3){$tip_tank = 'SAU';$tip_tank_ru = 'ПТ-САУ';} // САУ

$res = $mysqli->query('SELECT * FROM `prom_elka_user` WHERE `user` = "'.$user['id'].'" ');
$p_e_u = $res->fetch_assoc();
echo '<div class="cntr mt10"><span style="color:lawngreen;"><b>Новогодняя Ёлка!</b></span></div>
<div class="cntr mt10"><div class="white small bold mb5">Получайте новогодние подарки!<br>До завершения акции: <span>'._time($prom['time_'.$id.'']-time()).'</span></div></div>
<br><div class="cntr">';
echo '<div class="wrap-content ny"><br><br><div class="cntr"><img class="tank-img" src="/images/tanks/'.$tip_tank.'/'.$tank['country'].'/'.$tank['name'].'.png" style="width:90%;"></div><br></div><br>';
echo '<div class="mb2">';
if($p_e_u['coll']==0){echo '<img src="/images/upgrades/starEmpty.png" height="14" width="14">';}else{echo '<img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($p_e_u['coll']<=1){echo '<img src="/images/upgrades/starEmpty.png" height="14" width="14">';}else{echo '<img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($p_e_u['coll']<=2){echo '<img src="/images/upgrades/starEmpty.png" height="14" width="14">';}else{echo '<img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($p_e_u['coll']<=3){echo '<img src="/images/upgrades/starEmpty.png" height="14" width="14">';}else{echo '<img src="/images/upgrades/starFull.png" height="14" width="14">';}
if($p_e_u['coll']<=4){echo '<img src="/images/upgrades/starEmpty.png" height="14" width="14">';}else{echo '<img src="/images/upgrades/starFull.png" height="14" width="14">';}
echo '</div>';echo '<div class="small white mb2">1 подарок – 1 звезда</div>';
if($p_e_u['time']<time()){
echo '<table><tbody><tr><td style="width:33%;padding-right:4px;"></td>
<td style="width:33%;padding:0 4px;"><div style="position:relative;"><a class="simple-but border mb1" href="?bon"><span><span>Открыть подарок</span></span></a></div></td>
<td style="width:33%;padding-left:4px;"></td></tr></tbody></table>';
}else{
echo '<div class="cntr"><div class="small gray1 sh_b bold mb5">Новый подарок через: '._time($p_e_u['time']-time()).'</div></div>';
echo '<table><tbody><tr><td style="width:33%;padding-right:4px;"></td>
<td style="width:33%;padding:0 4px;"><div style="position:relative;"><a class="simple-but border mb2 gray"><span><span>Открыть подарок</span></span></a></div></td>
<td style="width:33%;padding-left:4px;"></td></tr></tbody></table>';
}
echo '</div>';

echo '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">Каждый день вас ждёт необычный подарок под ёлкой!</div>
</div></div></div></div></div></div></div></div></div></div>';
echo '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">Получите 5 подарков под ёлкой, чтобы забрать особый подарок от нашего Деда Мороза :)</div>
</div></div></div></div></div></div></div></div></div></div>';

if($user['position']>=4){
echo '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">';
echo '<div class="green2 mt10 sh_b bold">Удачливые танкисты:</div>';
echo '<table class="mt5 ta_l"><tbody>';
$max = 10;
$res = $mysqli->query("SELECT COUNT(*) FROM `prom_elka_log` WHERE `id` ");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$res11 = $mysqli->query('SELECT * FROM `prom_elka_log` WHERE `id` ORDER BY `id` desc LIMIT '.$start.','.$max.' ');
while ($log = $res11->fetch_array()){
$format=str_replace('Награда: ','',$log['text']);
$format_c=str_replace('green2','yellow1',nick($log['user']));
echo '<tr w:id="lucks"><td class="va_m w100">'.$format_c.'</td><td class="small bold va_m white nwr pl5 ta_r">'.$format.'</td></tr>';
}

echo '</tr></tbody></table>';
if ($k_page > 1) {
echo str('/xprom/7/?',$k_page,$page); // Вывод страниц
}
echo '</div></div></div></div></div></div></div></div></div></div>';
}

$rand_p = rand(1,11);
if($rand_p==1){$txt = 'Пусть вам этот Новый год<br>Много счастья принесёт,<br>Много радости, добра<br>Без печали и без зла.';}
if($rand_p==2){$txt = 'Пусть исполнятся мечты<br>И желания, и сны.<br>Пусть сияют ваши глазки,<br>Будет жизнь пускай, как в сказке!<br>';}
if($rand_p==3){$txt = 'Желаем в новом вам году<br>Поймать удачу на ходу.<br>Всех удивлять, все успевать,<br>Смеяться и не унывать.<br>';}
if($rand_p==4){$txt = 'Любить, надеяться и верить<br>И счастье на себя примерить,<br>И никогда вам не тужить,<br>И просто интересно жить!<br>';}
if($rand_p==5){$txt = 'Счастье, радость и веселье<br>Пусть подарит Новый год!<br>И удачи пусть под елку<br>Вам побольше принесет.<br>';}
if($rand_p==6){$txt = 'Пусть этот праздник принесет<br>Всё то, что в жизни много значит!<br>Желаем в светлый Новый год<br>Добра, здоровья и удачи!<br>';}
if($rand_p==7){$txt = 'Пускай веселый смех звучит,<br>А сердце — счастье заполняет,<br>Ведь дед Мороз осуществит<br>Всё, что душа твоя желает!<br>';}
if($rand_p==8){$txt = 'Вот приходит Новый год<br>И с собой он пусть несет<br>Много счастья, много смеха,<br>В жизни и в делах — успеха.';}
if($rand_p==9){$txt = 'С Новым годом поздравляем<br>И от всей души желаем,<br>Чтоб сбывались все мечты,<br>В праздник зимней красоты!';}
if($rand_p==10){$txt = 'Пусть новогодние огни<br>Поднимут настроение.<br>Пусть в дом уверенно войдут<br>Достаток и везение!<br>';}
if($rand_p==11){$txt = 'Любви, добра и красоты,<br>Успехов и подарков!<br>И пусть счастливым будет год —<br>Богатым, добрым, ярким!<br>';}


if(isset($_GET['bon'])){
if($p_e_u['time']>time()){header('Location: ?');exit();}
$r_podarok = rand(1,16);

#############################
if($p_e_u['coll']==5){
$r = 2023;
$mysqli->query("UPDATE `prom_elka_user` SET `coll` = '0', `time` = '".((time()+(3600*20)))."' WHERE `user` = '".$user['id']."' ");
$mysqli->query("UPDATE `users` SET `gold` = `gold` + '".$r."' WHERE `id` = '".$user['id']."' ");
$nagrada = "<div class='small white sh_b bold'>Награда: <span class='nwr'><img class='ico vm' src='/images/icons/gold.png' alt='Золото' title='Золото'> ".$r." золота</span></div>";
$mysqli->query('INSERT INTO `prom_elka_log` SET `time` = "'.time().'", `user` = "'.$user['id'].'", `text` = "'.$nagrada.'"');
}else{
#############################
if($r_podarok==1){ //золото
$r = rand(23,223);
$mysqli->query("UPDATE `prom_elka_user` SET `coll` = `coll` + '1', `time` = '".((time()+(3600*20)))."' WHERE `user` = '".$user['id']."' ");
$mysqli->query("UPDATE `users` SET `gold` = `gold` + '".$r."' WHERE `id` = '".$user['id']."' ");
$nagrada = "<div class='small white sh_b bold'>Награда: <span class='nwr'><img class='ico vm' src='/images/icons/gold.png' alt='Золото' title='Золото'> ".$r." золота</span></div>";
$mysqli->query('INSERT INTO `prom_elka_log` SET `time` = "'.time().'", `user` = "'.$user['id'].'", `text` = "'.$nagrada.'"');
}
#############################
if($r_podarok==2){ //серебро
$r = rand(5023,30023);
$mysqli->query("UPDATE `prom_elka_user` SET `coll` = `coll` + '1', `time` = '".((time()+(3600*20)))."' WHERE `user` = '".$user['id']."' ");
$mysqli->query("UPDATE `users` SET `silver` = `silver` + '".$r."' WHERE `id` = '".$user['id']."' ");
$nagrada = "<div class='small white sh_b bold'>Награда: <span class='nwr'><img class='ico vm' src='/images/icons/silver.png' alt='Серебро' title='Серебро'> ".$r." серебра</span></div>";
$mysqli->query('INSERT INTO `prom_elka_log` SET `time` = "'.time().'", `user` = "'.$user['id'].'", `text` = "'.$nagrada.'"');
}
#############################
if($r_podarok==3){ //ОЭ
$r = rand(2023,20023);
$mysqli->query("UPDATE `prom_elka_user` SET `coll` = `coll` + '1', `time` = '".((time()+(3600*20)))."' WHERE `user` = '".$user['id']."' ");
$mysqli->query('UPDATE `ammunition_users` SET `crewpoints` = `crewpoints` + "'.$r.'" WHERE `user` = '.$user['id'].'');
$nagrada = "<div class='small white sh_b bold'>Награда: <span class='nwr'><img class='ico vm' src='/images/icons/crewpoints.png' alt='Очки экипажа' title='Очки экипажа'> ".$r." очков экипажа</span></div>";
$mysqli->query('INSERT INTO `prom_elka_log` SET `time` = "'.time().'", `user` = "'.$user['id'].'", `text` = "'.$nagrada.'"');
}
#############################
if($r_podarok==4){ //Топливо
$r = rand(2023,20023);
$mysqli->query("UPDATE `prom_elka_user` SET `coll` = `coll` + '1', `time` = '".((time()+(3600*20)))."' WHERE `user` = '".$user['id']."' ");
$mysqli->query("UPDATE `users` SET `fuel` = `fuel` + '".$r."' WHERE `id` = '".$user['id']."' ");
$nagrada = "<div class='small white sh_b bold'>Награда: <span class='nwr'><img class='ico vm' src='/images/icons/fuel.png' alt='Топливо' title='Топливо'> ".$r." топлива</span></div>";
$mysqli->query('INSERT INTO `prom_elka_log` SET `time` = "'.time().'", `user` = "'.$user['id'].'", `text` = "'.$nagrada.'"');
}
#############################
if($r_podarok==5){ //Вера в победу
$res = $mysqli->query('SELECT * FROM `vip` WHERE `user` = "'.$user['id'].'" LIMIT 1');
$vip = $res->fetch_assoc();
$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = '.$user['id'].' and `active`  = "1" LIMIT 1');
$u_t = $res->fetch_assoc();
$r = rand(23,223);
$mysqli->query("UPDATE `prom_elka_user` SET `coll` = `coll` + '1', `time` = '".((time()+(3600*20)))."' WHERE `user` = '".$user['id']."' ");
if($vip['time1']>time()){
$mysqli->query("UPDATE `vip` SET `time1` = '".($vip['time1']+($r*3600))."' WHERE `id` = '".$vip['id']."' LIMIT 1");
}else{
if(!$vip){
$mysqli->query('INSERT INTO `vip` SET `time1` = "'.(time()+($r*3600)).'", `user` = "'.$user['id'].'"');
$mysqli->query('UPDATE `users_tanks` SET `a` = '.($u_t['a']+100).', `b` = '.($u_t['b']+100).', `t` = '.($u_t['t']+100).', `p` = '.($u_t['p']+100).' WHERE `id` = '.$u_t['id'].' LIMIT 1');
}else{
$mysqli->query("UPDATE `vip` SET `time1` = '".(time()+($r*3600))."' WHERE `id` = '".$vip['id']."' LIMIT 1");
}
}
$nagrada = "<div class='small white sh_b bold'>Награда: <span class='nwr'><img height='14' width='14' src='/images/icons/exp.png'> 'Вера в победу' на ".$r."ч.</span></div>";
$mysqli->query('INSERT INTO `prom_elka_log` SET `time` = "'.time().'", `user` = "'.$user['id'].'", `text` = "'.$nagrada.'"');
}
#############################
if($r_podarok==6){ //Передовое снабжение
$res = $mysqli->query('SELECT * FROM `vip` WHERE `user` = "'.$user['id'].'" LIMIT 1');
$vip = $res->fetch_assoc();
$r = rand(23,223);
$mysqli->query("UPDATE `prom_elka_user` SET `coll` = `coll` + '1', `time` = '".((time()+(3600*20)))."' WHERE `user` = '".$user['id']."' ");
if($vip['time2']>time()){
$mysqli->query("UPDATE `vip` SET `time2` = '".($vip['time2']+($r*3600))."' WHERE `id` = '".$vip['id']."' LIMIT 1");
}else{
if(!$vip){
$mysqli->query('INSERT INTO `vip` SET `time2` = "'.(time()+($r*3600)).'", `user` = "'.$user['id'].'"');
}else{
$mysqli->query("UPDATE `vip` SET `time2` = '".(time()+($r*3600))."' WHERE `id` = '".$vip['id']."' LIMIT 1");
}
}
$nagrada = "<div class='small white sh_b bold'>Награда: <span class='nwr'><img height='14' width='14' src='/images/icons/exp.png'> 'Передовое снабжение' на ".$r."ч.</span></div>";
$mysqli->query('INSERT INTO `prom_elka_log` SET `time` = "'.time().'", `user` = "'.$user['id'].'", `text` = "'.$nagrada.'"');
}
#############################
if($r_podarok==7){ //Армейское братство
$res = $mysqli->query('SELECT * FROM `vip` WHERE `user` = "'.$user['id'].'" LIMIT 1');
$vip = $res->fetch_assoc();
$r = rand(23,223);
$mysqli->query("UPDATE `prom_elka_user` SET `coll` = `coll` + '1', `time` = '".((time()+(3600*20)))."' WHERE `user` = '".$user['id']."' ");
if($vip['time3']>time()){
$mysqli->query("UPDATE `vip` SET `time3` = '".($vip['time3']+($r*3600))."' WHERE `id` = '".$vip['id']."' LIMIT 1");
}else{
if(!$vip){
$mysqli->query('INSERT INTO `vip` SET `time3` = "'.(time()+($r*3600)).'", `user` = "'.$user['id'].'"');
}else{
$mysqli->query("UPDATE `vip` SET `time3` = '".(time()+($r*3600))."' WHERE `id` = '".$vip['id']."' LIMIT 1");
}
}
$nagrada = "<div class='small white sh_b bold'>Награда: <span class='nwr'><img height='14' width='14' src='/images/icons/exp.png'> 'Армейское братство' на ".$r."ч.</span></div>";
$mysqli->query('INSERT INTO `prom_elka_log` SET `time` = "'.time().'", `user` = "'.$user['id'].'", `text` = "'.$nagrada.'"');
}
#############################
if($r_podarok==8){ //Экспериментальное оборудование
$res = $mysqli->query('SELECT * FROM `vip` WHERE `user` = "'.$user['id'].'" LIMIT 1');
$vip = $res->fetch_assoc();
$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = '.$user['id'].' and `active`  = "1" LIMIT 1');
$u_t = $res->fetch_assoc();
$res = $mysqli->query('SELECT * FROM `buildings_polygon` WHERE `user` = '.$user['id'].' LIMIT 1');
$b_polygon = $res->fetch_assoc();
$r = rand(23,223);
$mysqli->query("UPDATE `prom_elka_user` SET `coll` = `coll` + '1', `time` = '".((time()+(3600*20)))."' WHERE `user` = '".$user['id']."' ");
if($vip['time4']>time()){
$mysqli->query("UPDATE `vip` SET `time4` = '".($vip['time4']+($vip_4*3600))."' WHERE `id` = '".$vip['id']."' LIMIT 1");
}else{
if(!$vip){
$mysqli->query('INSERT INTO `vip` SET `time4` = "'.(time()+($vip_4*3600)).'", `user` = "'.$user['id'].'"');
}else{
$mysqli->query("UPDATE `vip` SET `time4` = '".(time()+($vip_4*3600))."' WHERE `id` = '".$vip['id']."' LIMIT 1");
}
}
if($b_polygon){
if($b_polygon['a_time']>time()){
if($b_polygon['a']!=50){
$mysqli->query("UPDATE `buildings_polygon` SET `a` = '".($b_polygon['a']+10)."' WHERE `id` = '".$b_polygon['id']."' LIMIT 1");
$mysqli->query('UPDATE `users_tanks` SET `a` = '.($u_t['a']+10).' WHERE `id` = '.$u_t['id'].' LIMIT 1');
}else{
$mysqli->query("UPDATE `buildings_polygon` SET `a` = '".($b_polygon['a']+20)."' WHERE `id` = '".$b_polygon['id']."' LIMIT 1");
$mysqli->query('UPDATE `users_tanks` SET `a` = '.($u_t['a']+20).' WHERE `id` = '.$u_t['id'].' LIMIT 1');
}
}
if($b_polygon['b_time']>time() ){
if($b_polygon['b']!=50){
$mysqli->query("UPDATE `buildings_polygon` SET `b` = '".($b_polygon['b']+10)."' WHERE `id` = '".$b_polygon['id']."' LIMIT 1");
$mysqli->query('UPDATE `users_tanks` SET `b` = '.($u_t['b']+10).' WHERE `id` = '.$u_t['id'].' LIMIT 1');
}else{
$mysqli->query("UPDATE `buildings_polygon` SET `b` = '".($b_polygon['b']+20)."' WHERE `id` = '".$b_polygon['id']."' LIMIT 1");
$mysqli->query('UPDATE `users_tanks` SET `b` = '.($u_t['b']+20).' WHERE `id` = '.$u_t['id'].' LIMIT 1');
}
}
if($b_polygon['b_time']>time() ){
if($b_polygon['t']!=50){
$mysqli->query("UPDATE `buildings_polygon` SET `t` = '".($b_polygon['t']+10)."' WHERE `id` = '".$b_polygon['id']."' LIMIT 1");
$mysqli->query('UPDATE `users_tanks` SET `t` = '.($u_t['t']+10).' WHERE `id` = '.$u_t['id'].' LIMIT 1');
}else{
$mysqli->query("UPDATE `buildings_polygon` SET `t` = '".($b_polygon['t']+20)."' WHERE `id` = '".$b_polygon['id']."' LIMIT 1");
$mysqli->query('UPDATE `users_tanks` SET `t` = '.($u_t['t']+20).' WHERE `id` = '.$u_t['id'].' LIMIT 1');
}
}
if($b_polygon['b_time']>time() ){
if($b_polygon['p']!=50){
$mysqli->query("UPDATE `buildings_polygon` SET `p` = '".($b_polygon['p']+10)."' WHERE `id` = '".$b_polygon['id']."' LIMIT 1");
$mysqli->query('UPDATE `users_tanks` SET `p` = '.($u_t['p']+10).' WHERE `id` = '.$u_t['id'].' LIMIT 1');
}else{
$mysqli->query("UPDATE `buildings_polygon` SET `p` = '".($b_polygon['p']+20)."' WHERE `id` = '".$b_polygon['id']."' LIMIT 1");
$mysqli->query('UPDATE `users_tanks` SET `p` = '.($u_t['p']+20).' WHERE `id` = '.$u_t['id'].' LIMIT 1');
}
}
}
$nagrada = "<div class='small white sh_b bold'>Награда: <span class='nwr'><img height='14' width='14' src='/images/icons/exp.png'> 'Экспериментальное оборудование' на ".$r."ч.</span></div>";
$mysqli->query('INSERT INTO `prom_elka_log` SET `time` = "'.time().'", `user` = "'.$user['id'].'", `text` = "'.$nagrada.'"');
}
#############################
if($r_podarok==9){ //Бронебойный снаряд
$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user`  = "'.$user['id'].'" LIMIT 1');
$a_users = $res->fetch_assoc();
$r = rand(100,500);
$mysqli->query("UPDATE `prom_elka_user` SET `coll` = `coll` + '1', `time` = '".((time()+(3600*20)))."' WHERE `user` = '".$user['id']."' ");
if(!$a_users){
$mysqli->query('INSERT INTO `ammunition_users` SET `b` = "'.($r).'", `user` = "'.$user['id'].'"');
}else{
$mysqli->query("UPDATE `ammunition_users` SET `b` = '".($a_users['b']+$r)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
}
$nagrada = "<div class='small white sh_b bold'>Награда: <span class='nwr'><img class='ico vm' src='/images/shells/ArmorPiercing.png' alt='Бронебойный снаряд' title='Бронебойный снаряд'> ".$r." бронебойных снарядов</span></div>";
$mysqli->query('INSERT INTO `prom_elka_log` SET `time` = "'.time().'", `user` = "'.$user['id'].'", `text` = "'.$nagrada.'"');
}
#############################
if($r_podarok==10){ //Фугасный снаряд
$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user`  = "'.$user['id'].'" LIMIT 1');
$a_users = $res->fetch_assoc();
$r = rand(100,500);
$mysqli->query("UPDATE `prom_elka_user` SET `coll` = `coll` + '1', `time` = '".((time()+(3600*20)))."' WHERE `user` = '".$user['id']."' ");
if(!$a_users){
$mysqli->query('INSERT INTO `ammunition_users` SET `f` = "'.($r).'", `user` = "'.$user['id'].'"');
}else{
$mysqli->query("UPDATE `ammunition_users` SET `f` = '".($a_users['f']+$r)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
}
$nagrada = "<div class='small white sh_b bold'>Награда: <span class='nwr'><img class='ico vm' src='/images/shells/HighExplosive.png' alt='Фугасный снаряд' title='Фугасный снаряд'> ".$r." фугасных снарядов</span></div>";
$mysqli->query('INSERT INTO `prom_elka_log` SET `time` = "'.time().'", `user` = "'.$user['id'].'", `text` = "'.$nagrada.'"');
}
#############################
if($r_podarok==11){ //Кумулятивный снаряд
$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user`  = "'.$user['id'].'" LIMIT 1');
$a_users = $res->fetch_assoc();
$r = rand(100,500);
$mysqli->query("UPDATE `prom_elka_user` SET `coll` = `coll` + '1', `time` = '".((time()+(3600*20)))."' WHERE `user` = '".$user['id']."' ");
if(!$a_users){
$mysqli->query('INSERT INTO `ammunition_users` SET `k` = "'.($r).'", `user` = "'.$user['id'].'"');
}else{
$mysqli->query("UPDATE `ammunition_users` SET `k` = '".($a_users['k']+$r)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
}
$nagrada = "<div class='small white sh_b bold'>Награда: <span class='nwr'><img class='ico vm' src='/images/shells/HollowCharge.png' alt='Кумулятивный снаряд' title='Кумулятивный снаряд'> ".$r." кумулятивных снарядов</span></div>";
$mysqli->query('INSERT INTO `prom_elka_log` SET `time` = "'.time().'", `user` = "'.$user['id'].'", `text` = "'.$nagrada.'"');
}
#############################
if($r_podarok==12){ //Ремкомплект
$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user`  = "'.$user['id'].'" LIMIT 1');
$a_users = $res->fetch_assoc();
$r = rand(50,223);
$mysqli->query("UPDATE `prom_elka_user` SET `coll` = `coll` + '1', `time` = '".((time()+(3600*20)))."' WHERE `user` = '".$user['id']."' ");
if(!$a_users){
$mysqli->query('INSERT INTO `ammunition_users` SET `rem` = "'.($r).'", `user` = "'.$user['id'].'"');
}else{
$mysqli->query("UPDATE `ammunition_users` SET `rem` = '".($a_users['rem']+$r)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
}
$nagrada = "<div class='small white sh_b bold'>Награда: <span class='nwr'><img class='ico vm' src='/images/shells/repairkit.png' alt='Ремкомплект' title='Ремкомплект'> ".$r." ремкомплектов</span></div>";
$mysqli->query('INSERT INTO `prom_elka_log` SET `time` = "'.time().'", `user` = "'.$user['id'].'", `text` = "'.$nagrada.'"');
}
#############################
if($r_podarok==13){ //Руда
$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user`  = "'.$user['id'].'" LIMIT 1');
$a_users = $res->fetch_assoc();
$r = rand(223,2023);
$mysqli->query("UPDATE `prom_elka_user` SET `coll` = `coll` + '1', `time` = '".((time()+(3600*20)))."' WHERE `user` = '".$user['id']."' ");
if(!$a_users){
$mysqli->query('INSERT INTO `ammunition_users` SET `ore` = "'.($r).'", `user` = "'.$user['id'].'"');
}else{
$mysqli->query("UPDATE `ammunition_users` SET `ore` = '".($a_users['ore']+$r)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
}
$nagrada = "<div class='small white sh_b bold'>Награда: <span class='nwr'><img class='ico vm' src='/images/icons/ore.png' alt='Руда' title='Руда'> ".$r." руды</span></div>";
$mysqli->query('INSERT INTO `prom_elka_log` SET `time` = "'.time().'", `user` = "'.$user['id'].'", `text` = "'.$nagrada.'"');
}
#############################
if($r_podarok==14){ //Железо
$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user`  = "'.$user['id'].'" LIMIT 1');
$a_users = $res->fetch_assoc();
$r = rand(150,500);
$mysqli->query("UPDATE `prom_elka_user` SET `coll` = `coll` + '1', `time` = '".((time()+(3600*20)))."' WHERE `user` = '".$user['id']."' ");
if(!$a_users){
$mysqli->query('INSERT INTO `ammunition_users` SET `iron` = "'.($r).'", `user` = "'.$user['id'].'"');
}else{
$mysqli->query("UPDATE `ammunition_users` SET `iron` = '".($a_users['iron']+$r)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
}
$nagrada = "<div class='small white sh_b bold'>Награда: <span class='nwr'><img class='ico vm' src='/images/icons/iron.png' alt='Железо' title='Железо'> ".$r." железа</span></div>";
$mysqli->query('INSERT INTO `prom_elka_log` SET `time` = "'.time().'", `user` = "'.$user['id'].'", `text` = "'.$nagrada.'"');
}
#############################
if($r_podarok==15){ //Сталь
$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user`  = "'.$user['id'].'" LIMIT 1');
$a_users = $res->fetch_assoc();
$r = rand(100,300);
$mysqli->query("UPDATE `prom_elka_user` SET `coll` = `coll` + '1', `time` = '".((time()+(3600*20)))."' WHERE `user` = '".$user['id']."' ");
if(!$a_users){
$mysqli->query('INSERT INTO `ammunition_users` SET `steel` = "'.($r).'", `user` = "'.$user['id'].'"');
}else{
$mysqli->query("UPDATE `ammunition_users` SET `steel` = '".($a_users['steel']+$r)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
}
$nagrada = "<div class='small white sh_b bold'>Награда: <span class='nwr'><img class='ico vm' src='/images/icons/steel.png' alt='Сталь' title='Сталь'> ".$r." стали</span></div>";
$mysqli->query('INSERT INTO `prom_elka_log` SET `time` = "'.time().'", `user` = "'.$user['id'].'", `text` = "'.$nagrada.'"');
}
#############################
if($r_podarok==16){ //Свинец
$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user`  = "'.$user['id'].'" LIMIT 1');
$a_users = $res->fetch_assoc();
$r = rand(50,223);
$mysqli->query("UPDATE `prom_elka_user` SET `coll` = `coll` + '1', `time` = '".((time()+(3600*20)))."' WHERE `user` = '".$user['id']."' ");
if(!$a_users){
$mysqli->query('INSERT INTO `ammunition_users` SET `plumbum` = "'.($r).'", `user` = "'.$user['id'].'"');
}else{
$mysqli->query("UPDATE `ammunition_users` SET `plumbum` = '".($a_users['plumbum']+$r)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
}
$nagrada = "<div class='small white sh_b bold'>Награда: <span class='nwr'><img class='ico vm' src='/images/icons/plumbum.png' alt='Свинец' title='Свинец'> ".$r." свинца</span></div>";
$mysqli->query('INSERT INTO `prom_elka_log` SET `time` = "'.time().'", `user` = "'.$user['id'].'", `text` = "'.$nagrada.'"');
}
#############################
}

if($p_e_u['coll']==5){
$_SESSION['ses'] = '<br><div class="orange"><b>Особый подарок от Деда Мороза :)</b></div><img class="tank-img" src="/images/giphy.gif" style="width:20%;"> <span class="green1"><b>С новым годом!</b></span> <img class="mirrorY" src="/images/giphy.gif" style="width:20%;"><br><div class="small bold admin mb5">'.$txt.'</div><br>'.$nagrada.'';
}else{
$_SESSION['ses'] = '<img class="tank-img" src="/images/giphy.gif" style="width:20%;"> <span class="green1"><b>С новым годом!</b></span> <img class="mirrorY" src="/images/giphy.gif" style="width:20%;"><br><div class="small bold admin mb5">'.$txt.'</div><br>'.$nagrada.'';
}
header('Location: ?');
exit();
}
}










if($id==8){
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content admin medium sh_b">
<p></p><div class="cntr mt10"><span style="color:lawngreen;"><b>Скидка на прокачку экипажа!</b></span></div><br><div class="hr"></div>
<br>
<div class="cntr"><span style="color:yellow;">Уникальная скидка <b>'.$prom['act_'.$id.''].'%</b> на прокачку экипажа за золото!</span></div>
<br>
<div class="hr"></div>
<br>
<div class="cntr">
<table><tbody><tr><td style="width:33%;padding-right:4px;"></td>
<td style="width:33%;padding:0 4px;"><div style="position:relative;"><a class="simple-but border mb1" href="/crew/'.$user['id'].'/"><span><span>Прокачать!</span></span></a></div></td>
<td style="width:33%;padding-left:4px;"></td></tr></tbody></table>
</div>
<br>
<div class="hr"></div><br><div class="cntr mb10"><span style="color:grey;">Акция закончится через <span>'._time($prom['time_'.$id.'']-time()).'</span></span></div><p></p>
</div></div></div></div></div></div></div></div></div></div>';
}




if($id==9){
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content admin medium sh_b">
<p></p><div class="cntr mt10"><span style="color:lawngreen;"><b>Скидка на улучшение танка!</b></span></div><br><div class="hr"></div>
<br>
<div class="cntr"><span style="color:yellow;">Уникальная скидка <b>'.$prom['act_'.$id.''].'%</b> на улучшение танка!</span></div>
<br>
<div class="hr"></div>
<br>
<div class="cntr">
<table><tbody><tr><td style="width:33%;padding-right:4px;"></td>
<td style="width:33%;padding:0 4px;"><div style="position:relative;"><a class="simple-but border mb1" href="/pimp/'.$user['id'].'/"><span><span>Улучшить!</span></span></a></div></td>
<td style="width:33%;padding-left:4px;"></td></tr></tbody></table>
</div>
<br>
<div class="hr"></div><br><div class="cntr mb10"><span style="color:grey;">Акция закончится через <span>'._time($prom['time_'.$id.'']-time()).'</span></span></div><p></p>
</div></div></div></div></div></div></div></div></div></div>';
}




if($id==10){
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content admin medium sh_b">
<p></p><div class="cntr mt10"><span style="color:lawngreen;"><b>Скидка на апгрейд танка!</b></span></div><br><div class="hr"></div>
<br>
<div class="cntr"><span style="color:yellow;">Уникальная скидка <b>'.$prom['act_'.$id.''].'%</b> на апгрейд танка!</span></div>
<br>
<div class="hr"></div>
<br>
<div class="cntr">
<table><tbody><tr><td style="width:33%;padding-right:4px;"></td>
<td style="width:33%;padding:0 4px;"><div style="position:relative;"><a class="simple-but border mb1" href="/upgrade/'.$user['id'].'/"><span><span>Улучшить!</span></span></a></div></td>
<td style="width:33%;padding-left:4px;"></td></tr></tbody></table>
</div>
<br>
<div class="hr"></div><br><div class="cntr mb10"><span style="color:grey;">Акция закончится через <span>'._time($prom['time_'.$id.'']-time()).'</span></span></div><p></p>
</div></div></div></div></div></div></div></div></div></div>';
}




if($id==11){
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content admin medium sh_b">
<p></p><div class="cntr mt10"><span style="color:lawngreen;"><b>Скидка на модификацию танка!</b></span></div><br><div class="hr"></div>
<br>
<div class="cntr"><span style="color:yellow;">Уникальная скидка <b>'.$prom['act_'.$id.''].'%</b> на модификацию танка!</span></div>
<br>
<div class="hr"></div>
<br>
<div class="cntr">
<table><tbody><tr><td style="width:33%;padding-right:4px;"></td>
<td style="width:33%;padding:0 4px;"><div style="position:relative;"><a class="simple-but border mb1" href="/modification/'.$user['id'].'/"><span><span>Модифицировать!</span></span></a></div></td>
<td style="width:33%;padding-left:4px;"></td></tr></tbody></table>
</div>
<br>
<div class="hr"></div><br><div class="cntr mb10"><span style="color:grey;">Акция закончится через <span>'._time($prom['time_'.$id.'']-time()).'</span></span></div><p></p>
</div></div></div></div></div></div></div></div></div></div>';
}




if($id==12){
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content admin medium sh_b">
<p></p><div class="cntr mt10"><span style="color:lawngreen;"><b>Скидка на усиления!</b></span></div><br><div class="hr"></div>
<br>
<div class="cntr"><span style="color:yellow;">Уникальная скидка <b>'.$prom['act_'.$id.''].'%</b> на активацию усиления!</span></div>
<br>
<div class="hr"></div>
<br>
<div class="cntr">
<table><tbody><tr><td style="width:33%;padding-right:4px;"></td>
<td style="width:33%;padding:0 4px;"><div style="position:relative;"><a class="simple-but border mb1" href="/vip/"><span><span>Активировать усиления!</span></span></a></div></td>
<td style="width:33%;padding-left:4px;"></td></tr></tbody></table>
</div>
<br>
<div class="hr"></div><br><div class="cntr mb10"><span style="color:grey;">Акция закончится через <span>'._time($prom['time_'.$id.'']-time()).'</span></span></div><p></p>
</div></div></div></div></div></div></div></div></div></div>';
}




if($id==13){
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content admin medium sh_b">
<p></p><div class="cntr mt10"><span style="color:lawngreen;"><b>Скидка на боевую подготовку!!</b></span></div><br><div class="hr"></div>
<br>
<div class="cntr"><span style="color:yellow;">Уникальная скидка <b>'.$prom['act_'.$id.''].'%</b> на активацию боевой подготовки!</span></div>
<br>
<div class="hr"></div>
<br>
<div class="cntr">
<table><tbody><tr><td style="width:33%;padding-right:4px;"></td>
<td style="width:33%;padding:0 4px;"><div style="position:relative;"><a class="simple-but border mb1" href="/polygon/"><span><span>Активировать!</span></span></a></div></td>
<td style="width:33%;padding-left:4px;"></td></tr></tbody></table>
</div>
<br>
<div class="hr"></div><br><div class="cntr mb10"><span style="color:grey;">Акция закончится через <span>'._time($prom['time_'.$id.'']-time()).'</span></span></div><p></p>
</div></div></div></div></div></div></div></div></div></div>';
}




if($id==14){
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content admin medium sh_b">
<p></p><div class="cntr mt10"><span style="color:lawngreen;"><b>Скидка на военное управление!</b></span></div><br><div class="hr"></div>
<br>
<div class="cntr"><span style="color:yellow;">Уникальная скидка <b>'.$prom['act_'.$id.''].'%</b> на улучшение военного управления!</span></div>
<br>
<div class="hr"></div>
<br>
<div class="cntr">
<table><tbody><tr><td style="width:33%;padding-right:4px;"></td>
<td style="width:33%;padding:0 4px;"><div style="position:relative;"><a class="simple-but border mb1" href="/hq/"><span><span>Улучшить!</span></span></a></div></td>
<td style="width:33%;padding-left:4px;"></td></tr></tbody></table>
</div>
<br>
<div class="hr"></div><br><div class="cntr mb10"><span style="color:grey;">Акция закончится через <span>'._time($prom['time_'.$id.'']-time()).'</span></span></div><p></p>
</div></div></div></div></div></div></div></div></div></div>';
}




if($id==15){
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content admin medium sh_b">
<p></p><div class="cntr mt10"><span style="color:lawngreen;"><b>Больше золота за миссии!</b></span></div><br><div class="hr"></div>
<br>
<div class="cntr"><span style="color:yellow;">Уникальная акция увеличивает награду золотом на <b>'.$prom['act_'.$id.''].'%</b> за выполнение любых миссий!</span></div>
<br>
<div class="hr"></div>
<br>
<div class="cntr">
<table><tbody><tr><td style="width:33%;padding-right:4px;"></td>
<td style="width:33%;padding:0 4px;"><div style="position:relative;"><a class="simple-but border mb1" href="/missions/"><span><span>К миссиям!</span></span></a></div></td>
<td style="width:33%;padding-left:4px;"></td></tr></tbody></table>
</div>
<br>
<div class="hr"></div><br><div class="cntr mb10"><span style="color:grey;">Акция закончится через <span>'._time($prom['time_'.$id.'']-time()).'</span></span></div><p></p>
</div></div></div></div></div></div></div></div></div></div>';
}




if($id==16){
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content admin medium sh_b">
<p></p><div class="cntr mt10"><span style="color:lawngreen;"><b>Бонусные баки топлива!</b></span></div><br><div class="hr"></div>
<br>
<div class="cntr"><span style="color:blue1;">
Цистерна с топливом восстанавливается 3 часа.<br>
По окончанию вы сможите забрать <b>'.ceil($user['fuel_max']+($user['fuel_max']*$prom['act_'.$id.'']/100)).'</b> топлива бесплатно!
</span></div>
<br>
<div class="hr"></div>
<br>

<div class="wrap-content custombg angar_3"><div class="brunches-block"><div class="wrp1"><div class="wrp2"></div></div></div>
<br><div class="cntr"><img class="tank-img" src="/images/cisterna.png" style="width:90%;"></div></div><br><div class="cntr">';
if($user['time_prom16_fuel']<time()){
echo '<table><tbody><tr><td style="width:33%;padding-right:4px;"></td>
<td style="width:33%;padding:0 4px;"><div style="position:relative;"><a class="simple-but border mb1" href="?fuel"><span><span>Забрать топливо!</span></span></a></div></td>
<td style="width:33%;padding-left:4px;"></td></tr></tbody></table>';
}else{
$prog_time = (3*3600);
$prog = round(($prog_time-($user['time_prom16_fuel']-time()))*100/$prog_time);
if($prog > 100) {$prog = 100;}
echo '<table class="rblock mt5 esmall"><tbody><tr>
<td><div class="value-block lh1"><span><span><img height="14" width="14" src="/images/icons/fuel.png">'.ceil($user['fuel_max']+($user['fuel_max']*$prom['act_'.$id.'']/100)).'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.($prog).'%;">&nbsp;</div><div class="mask">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'._time($user['time_prom16_fuel']-time()).'</span></span></span></div></td>
</tr></tbody></table>';
}
echo '</div><br>
<div class="hr"></div><br><div class="cntr mb10"><span style="color:grey;">Акция закончится через <span>'._time($prom['time_'.$id.'']-time()).'</span></span></div><p></p>
</div></div></div></div></div></div></div></div></div></div>';

if(isset($_GET['fuel'])){
if($user['fuel'] >= $user['fuel_max']){
$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас полный бак.<br>Израсходуйте имеющееся топливо!</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'battle/"><span><span>В бой!</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');exit();}
if($user['time_prom16_fuel'] > time()){header('Location: ?');exit();}
$mysqli->query("UPDATE `users` SET `time_prom16_fuel` = '".(time()+(3600*3))."', `fuel` = `fuel` + '".ceil($user['fuel_max']+($user['fuel_max']*$prom['act_'.$id.'']/100))."' WHERE `id` = '".$user['id']."' ");

$_SESSION['err'] = '
<div class="medium bold pb5 cntr green1"><img height="14" width="14" src="/images/icons/victory.png"> <span>Поздравляем!</span> <img height="14" width="14" src="/images/icons/victory.png"></div>
<div class="small white cntr sh_b bold">
<span class="nwr">Получено <img class="ico vm" src="/images/icons/fuel.png" alt="топливо" title="топливо"> '.ceil($user['fuel_max']+($user['fuel_max']*$prom['act_'.$id.'']/100)).' топлива!</span>
</div>';
header('Location: ?');
exit();
}
}





if($id==17){
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content admin medium sh_b">
<p></p><div class="cntr mt10"><span style="color:lawngreen;"><b>Больше опыта в бою!</b></span></div><br><div class="hr"></div>
<br>
<div class="cntr"><span style="color:yellow;">Уникальная акция увеличивает получаемый опыт в бою на '.$prom['act_'.$id.''].'%</span></div>
<br>
<div class="hr"></div>
<br>
<div class="cntr">
<table><tbody><tr><td style="width:33%;padding-right:4px;"></td>
<td style="width:33%;padding:0 4px;"><div style="position:relative;"><a class="simple-but border mb1" href="/battle/"><span><span>В бой!</span></span></a></div></td>
<td style="width:33%;padding-left:4px;"></td></tr></tbody></table>
</div>
<br>
<div class="hr"></div><br><div class="cntr mb10"><span style="color:grey;">Акция закончится через <span>'._time($prom['time_'.$id.'']-time()).'</span></span></div><p></p>
</div></div></div></div></div></div></div></div></div></div>';
}




if($id==18){
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content admin medium sh_b">
<p></p><div class="cntr mt10"><span style="color:lawngreen;"><b>Больше серебра в бою!</b></span></div><br><div class="hr"></div>
<br>
<div class="cntr"><span style="color:yellow;">Уникальная акция увеличивает получаемое серебро в бою на '.$prom['act_'.$id.''].'%</span></div>
<br>
<div class="hr"></div>
<br>
<div class="cntr">
<table><tbody><tr><td style="width:33%;padding-right:4px;"></td>
<td style="width:33%;padding:0 4px;"><div style="position:relative;"><a class="simple-but border mb1" href="/battle/"><span><span>В бой!</span></span></a></div></td>
<td style="width:33%;padding-left:4px;"></td></tr></tbody></table>
</div>
<br>
<div class="hr"></div><br><div class="cntr mb10"><span style="color:grey;">Акция закончится через <span>'._time($prom['time_'.$id.'']-time()).'</span></span></div><p></p>
</div></div></div></div></div></div></div></div></div></div>';
}








if($id==20){
$res = $mysqli->query('SELECT * FROM `bz_user` WHERE `user` = "'.$user['id'].'" and `tip` = "'.$prom['tip_20'].'"');
$bz_user = $res->fetch_assoc();

echo '<div class="medium bold mb0 cntr bia"><img width="7%" src="/images/paska_.png"> Праздничная боевая задача <img width="7%" src="/images/paska_.png"></div>
<div class="mt0 mb5 small grey1 cntr">Акция закончится через <span>'._time($prom['time_'.$id.'']-time()).'</span></div>
<center><img width="100%" src="/images/paskatest.png" style="border-radius: 8px;"></center>';


if(!$bz_user){
echo '<div class="trnt-block mb5 mt5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<table><tbody><tr><td style="width:33%;padding-right:4px;"></td>
<td style="width:33%;padding:0 4px;"><div style="position:relative;"><a class="simple-but border mb1" href="?go"><span><span>Участвовать</span></span></a></div></td>
<td style="width:33%;padding-left:4px;"></td></tr></tbody></table>
</div></div></div></div></div></div></div></div></div></div>';
}else{
if($bz_user['step']==1){$text = 'Заработать '.$bz_user['prog'].' опыта (опыт засчитывается только на Сражении и в Схватке)';$href = '/pve/';}
if($bz_user['step']==2){$text = 'Уничтожить '.$bz_user['prog'].' танков в бою';$href = '/battle/';}
if($bz_user['step']==3){$text = 'Уничтожить '.$bz_user['prog'].' ПТ-САУ на Сражении';$href = '/pve/';}
if($bz_user['step']==4){$text = 'Уничтожить '.$bz_user['prog'].' Тяжелых танков на Сражении';$href = '/pve/';}
if($bz_user['step']==5){$text = 'Уничтожить '.$bz_user['prog'].' Средних танков на Сражении';$href = '/pve/';}
if($bz_user['step']==6){$text = 'Заработать '.$bz_user['prog'].' опыта в бою';$href = '/battle/';}
if($bz_user['step']==7){$text = 'Уничтожить '.$bz_user['prog'].' ПТ-САУ в Схватке';$href = '/dm/';}
if($bz_user['step']==8){$text = 'Уничтожить '.$bz_user['prog'].' Тяжелых танков в Схватке';$href = '/dm/';}
if($bz_user['step']==9){$text = 'Уничтожить '.$bz_user['prog'].' Средних танков в Схватке';$href = '/dm/';}
if($bz_user['step']==10){$text = 'Заработать '.$bz_user['prog'].' рейтинга в Битвах';$href = '/pvp/';}
if($bz_user['step']==11){$text = 'Уничтожить '.$bz_user['prog'].' врагов в Конвое';$href = '/convoy/';}
if($bz_user['step']==12){$text = 'Пройти любое Спецзадание';$href = '/company/assault/';}
if($bz_user['step']==13){$text = 'Выполнить '.$bz_user['prog'].' простых миссий';$href = '/missions/';}
$width = round(100/($bz_user['prog']/($bz_user['prog_']+0.0000001)));
if($width > 100) {$width = 100;}
echo '<div class="trnt-block mb5 mt5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="white cntr bold sh_b small pb2">
'.$text.'<br><table class="rblock esmall mb0"><tbody><tr>
<td><div class="value-block lh1"><span><span>'.$bz_user['prog_'].'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$width.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$bz_user['prog'].'</span></span></div></td>
</tr></tbody></table>
<span class="gray1">одня случайная награда:</span> <br> <span class="green2"><span class="nwr"> 
<img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото">  &nbsp;
<img class="ico vm" src="/images/icons/silver.png" alt="Серебро" title="Серебро">   &nbsp;
<img class="ico vm" src="/images/icons/ore.png" alt="Руда" title="Руда">   &nbsp;
<img class="ico vm" src="/images/icons/iron.png" alt="Железо" title="Железо">  &nbsp;
<img class="ico vm" src="/images/icons/steel.png" alt="Сталь" title="Сталь">  &nbsp;
<img class="ico vm" src="/images/icons/plumbum.png" alt="Свинец" title="Свинец"> 
</span></span>
<br></div>';

if($bz_user['prog_']>=$bz_user['prog']){$mt = 15;
echo '<div class="bot">
<a class="simple-but border mb10" href="?nagrada'.$bz_user['step'].'"><span><span>Получить награду</span></span></a>
<div style="position:relative;"><span class="digit2 esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span></div>
</div>';
}else{$mt = 5;
echo '<div class="cntr"><a class="simple-but mt5 mb2 a_w50" href="'.$href.'"><span><span>Перейти к выполнению</span></span></a></div>';
}
echo '</div></div></div></div></div></div></div></div></div></div>';
}
echo '<div class="trnt-block mt'.$mt.' mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">В уникальной праздничной Боевой задачи доступно неограниченное количество заданий для выполнения.
	<br>За каждое выполненное задание игрок получает от <img class="vb" width="20" height="14" src="/images/paska_.png"> 1 до <img class="vb" width="20" height="14" src="/images/paska_.png"> 5 пасхальных яиц (случайно), 
	а также золото, серебро и ресурсы для построек базы (случайно).
	<br>По итогам Боевой задачи все получат <img class="vb" width="14" height="14" src="/images/icons/gold.png?1"> 1 золота за <img class="vb" width="20" height="14" src="/images/paska_.png"> 1 пасхальное яйцо, также топ-3 игрока по собранным пасхальным яйцам, и топ-3 игрока по количеству выполненных заданий получат '.smile(':мани').' дополнительную награду.
</div>
</div></div></div></div></div></div></div></div></div></div>';

if(isset($_GET['go'])){
if($bz_user){header('Location: ?');exit();}
$rand_s = rand(1,13);
if($rand_s==1){$prog = rand(2500,10000);}//Заработать 10000 опыта (опыт засчитывается только в Сражениях и Схватках)
if($rand_s==2){$prog = rand(10,50);}//Уничтожить 50 танков в бою
if($rand_s==3){$prog = rand(5,20);}//Уничтожить 15 ПТ-САУ в Сражениях
if($rand_s==4){$prog = rand(2,20);}//Уничтожить 15 Тяжелых танков в Сражениях
if($rand_s==5){$prog = rand(2,20);}//Уничтожить 15 Средних танков в Сражениях
if($rand_s==6){$prog = rand(1000,5000);}//Заработать 5000 опыта в бою
if($rand_s==7){$prog = rand(5,20);}//Уничтожить 15 ПТ-САУ в Схватках
if($rand_s==8){$prog = rand(5,20);}//Уничтожить 15 Тяжелых танков в Схватках
if($rand_s==9){$prog = rand(5,20);}//Уничтожить 15 Средних танков в Схватках
if($rand_s==10){$prog = rand(250,1000);}//Заработать 1000 рейтинга в Битвах
if($rand_s==11){$prog = rand(5,20);}//Уничтожить 20 врагов в Конвое
if($rand_s==12){$prog = rand(1,1);}//Пройти любое Спецзадание
if($rand_s==13){$prog = rand(5,20);}//Выполнить 20 простых миссий
$mysqli->query('INSERT INTO `bz_user` SET `user` = "'.$user['id'].'" , `tip` = "'.$prom['tip_20'].'" , `prog` = "'.$prog.'" , `step` = "'.$rand_s.'" ');
header('Location: ?');
exit();
}





if(isset($_GET['nagrada'.$bz_user['step'].''])){
if(!$bz_user){header('Location: ?');exit();}
if($bz_user['prog_']<$bz_user['prog']){header('Location: ?');exit();}
$rand_r = rand(1,6);
$rand_у = rand(1,5);
if($rand_у==1){$txt = 'пасхальное яйцо';}if($rand_у==2){$txt = 'пасхальных яйца';}if($rand_у==3){$txt = 'пасхальных яйца';}if($rand_у==4){$txt = 'пасхальных яйца';}if($rand_у==5){$txt = 'пасхальных яиц';}
if($rand_r==1){$gold = rand((5*$prom['act_20']),(20*$prom['act_20']));$gold_ = '<img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> '.$gold.' золота';}else{$gold = 0;$gold_ = '';}
if($rand_r==2){$silver = rand((250*$prom['act_20']),(1000*$prom['act_20']));$silver_ = '<img class="ico vm" src="/images/icons/silver.png?2" alt="Серебро" title="Серебро"> '.$silver.' серебра';}else{$silver = 0;$silver_ = '';}
if($rand_r==3){$ore = rand((20*$prom['act_20']),(50*$prom['act_20']));$ore_ = '<img class="ico vm" src="/images/icons/ore.png?2" alt="Руда" title="Руда"> '.$ore.' руды';}else{$ore = 0;$ore_ = '';}
if($rand_r==4){$iron = rand((10*$prom['act_20']),(20*$prom['act_20']));$iron_ = '<img class="ico vm" src="/images/icons/iron.png?2" alt="Железо" title="Железо"> '.$iron.' железа';}else{$iron = 0;$iron_ = '';}
if($rand_r==5){$steel = rand((5*$prom['act_20']),(10*$prom['act_20']));$steel_ = '<img class="ico vm" src="/images/icons/steel.png?2" alt="Сталь" title="Сталь"> '.$steel.' стали';}else{$steel = 0;$steel_ = '';}
if($rand_r==6){$plumbum = rand((1*$prom['act_20']),(5*$prom['act_20']));$plumbum_ = '<img class="ico vm" src="/images/icons/plumbum.png?2" alt="Свинец" title="Свинец"> '.$plumbum.' свинца';}else{$plumbum = 0;$plumbum_ = '';}

$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user`  = "'.$user['id'].'" LIMIT 1');
$a_users = $res->fetch_assoc();
#############################
if($rand_r==1){ //золото
$mysqli->query("UPDATE `users` SET `gold` = `gold` + '".$gold."' WHERE `id` = '".$user['id']."' ");
}
#############################
if($rand_r==2){ //серебро
$mysqli->query("UPDATE `users` SET `silver` = `silver` + '".$silver."' WHERE `id` = '".$user['id']."' ");
}
#############################
if($rand_r==3){ //Руда
if(!$a_users){
$mysqli->query('INSERT INTO `ammunition_users` SET `ore` = "'.($ore).'", `user` = "'.$user['id'].'"');
}else{
$mysqli->query("UPDATE `ammunition_users` SET `ore` = '".($a_users['ore']+$ore)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
}
}
#############################
if($rand_r==4){ //Железо
if(!$a_users){
$mysqli->query('INSERT INTO `ammunition_users` SET `iron` = "'.($iron).'", `user` = "'.$user['id'].'"');
}else{
$mysqli->query("UPDATE `ammunition_users` SET `iron` = '".($a_users['iron']+$iron)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
}
}
#############################
if($rand_r==5){ //Сталь
if(!$a_users){
$mysqli->query('INSERT INTO `ammunition_users` SET `steel` = "'.($steel).'", `user` = "'.$user['id'].'"');
}else{
$mysqli->query("UPDATE `ammunition_users` SET `steel` = '".($a_users['steel']+$steel)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
}
}
#############################
if($rand_r==6){ //Свинец
if(!$a_users){
$mysqli->query('INSERT INTO `ammunition_users` SET `plumbum` = "'.($plumbum).'", `user` = "'.$user['id'].'"');
}else{
$mysqli->query("UPDATE `ammunition_users` SET `plumbum` = '".($a_users['plumbum']+$plumbum)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
}
}
#############################
$rand_s = rand(1,13);
if($rand_s==1){$prog = rand(2500,10000);}//Заработать 10000 опыта (опыт засчитывается только в Сражениях и Схватках)
if($rand_s==2){$prog = rand(10,50);}//Уничтожить 50 танков в бою
if($rand_s==3){$prog = rand(5,20);}//Уничтожить 15 ПТ-САУ в Сражениях
if($rand_s==4){$prog = rand(2,20);}//Уничтожить 15 Тяжелых танков в Сражениях
if($rand_s==5){$prog = rand(2,20);}//Уничтожить 15 Средних танков в Сражениях
if($rand_s==6){$prog = rand(1000,5000);}//Заработать 5000 опыта в бою
if($rand_s==7){$prog = rand(5,20);}//Уничтожить 15 ПТ-САУ в Схватках
if($rand_s==8){$prog = rand(5,20);}//Уничтожить 15 Тяжелых танков в Схватках
if($rand_s==9){$prog = rand(5,20);}//Уничтожить 15 Средних танков в Схватках
if($rand_s==10){$prog = rand(250,1000);}//Заработать 1000 рейтинга в Битвах
if($rand_s==11){$prog = rand(5,20);}//Уничтожить 20 врагов в Конвое
if($rand_s==12){$prog = rand(1,1);}//Пройти любое Спецзадание
if($rand_s==13){$prog = rand(5,20);}//Выполнить 20 простых миссий
$mysqli->query("UPDATE `bz_user` SET `eggs` = `eggs` + '".$rand_у."' , `miss` = `miss` + '1' , `prog` = ".$prog." , `prog_` = '0' , `step` = ".$rand_s." WHERE `id` = '".$bz_user['id']."' ");
$_SESSION['ses'] = '<div class="trnt-block mb6 cntr bold small"><div class="green1 pb5 mt5"><img src="/images/icons/victory.png"> Задание выполнено! <img src="/images/icons/victory.png"></div>
<div class="dhr a_w50 mt5 mb5"></div><img class="tank-img" src="/images/paska_.png" style="width:20%;"><br>Получено <div class="yellow1">'.$rand_у.' '.$txt.' </div><div class="dhr a_w50 mt5 mb5"></div>
<div class="white">Награда: '.$gold_.' '.$silver_.' '.$ore_.' '.$iron_.' '.$steel_.' '.$plumbum_.'</div>
<div class="gray1">Простых миссий выполнено: '.($bz_user['miss']+1).'</div></div>';
header('Location: ?');
exit();
}

echo '<a w:id="backToPve" class="simple-but gray mt10" href="/rating/bz_eggs/"><span><span>Рейтинг</span></span></a>';
}




require_once ('system/footer.php');
?> 