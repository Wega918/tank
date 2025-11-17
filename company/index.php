<?php
$title = 'Дивизия';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}

//$mysqli->query('UPDATE `company` SET `lvl_crew` =  "0" WHERE `id` ');

/* $dsd = $mysqli->query('SELECT * FROM `users` WHERE `company` != "0" ');
while ($us = $dsd->fetch_array()){
$res = $mysqli->query('SELECT * FROM `company` WHERE `id` = "'.$us['company'].'" ');
$comp = $res->fetch_assoc();

$res = mysqli_query($mysqli,'SELECT sum(rang) FROM crew_user WHERE `user`  = "'.$us['id'].'"');
if (FALSE === $res) die("Select sum failed: ".mysqli_error);
$row = mysqli_fetch_row($res);
$sum = $row[0];

$mysqli->query('UPDATE `company` SET `lvl_crew` = `lvl_crew` + "'.$sum.'" WHERE `id` = '.$comp['id'].'');
} */





$id = abs(intval($_GET['id']));
$res_company = $mysqli->query('SELECT * FROM `company` WHERE `id` = '.$id.' LIMIT 1');
$company = $res_company->fetch_assoc();
if($company == 0){
header('Location: /');
$_SESSION['err'] = 'Такой дивизии не существует!';
exit();
}

			   
$res_company_user = $mysqli->query('SELECT * FROM `company_user` WHERE `user` = '.$user['id'].' and `company` = '.$company['id'].' LIMIT 1');
$company_user = $res_company_user->fetch_assoc();

$r_c_u_a = $mysqli->query('SELECT * FROM `company_user_assault` WHERE `user` = '.$user['id'].' LIMIT 1');
$c_u_a = $r_c_u_a->fetch_assoc();
if(!$c_u_a){
$mysqli->query('INSERT INTO `company_user_assault` SET `user` = "'.$user['id'].'" ');
}




if($company_user['company_gold_time']<time() and $company_user['company_gold_time'] > 0){ // обнуление пополнений игрока в штаб
$mysqli->query("UPDATE `company_user` SET `company_gold` = '0', `company_gold_time` = '0' WHERE `id` = '".$company_user['id']."' LIMIT 1");
}
if($company_user['polygon_time']<time() and $company_user['polygon_time'] > 0){ // отключение личного бонуса к парам
$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user`  = "'.$user['id'].'" and `active`  = "1" limit 1');
$users_tanks = $res->fetch_assoc();
$mysqli->query('UPDATE `users_tanks` SET `a` = "'.($users_tanks['a']-40).'", `b` = "'.($users_tanks['b']-40).'", `t` = "'.($users_tanks['t']-40).'", `p` = "'.($users_tanks['p']-40).'" WHERE `id` = '.$users_tanks['id'].'');
$mysqli->query("UPDATE `company_user` SET `polygon_time` = '0' WHERE `id` = '".$company_user['id']."' LIMIT 1");
}
if($company['polygon_time']<time() and $company['polygon_time'] > 0){ // отключение бонкома
$res_reit_us1 = $mysqli->query('SELECT * FROM `company_user` WHERE `company` = '.$company['id'].' ORDER BY `company_rang` asc, `company_exp` DESC ');
while ($us1 = $res_reit_us1->fetch_array()){
$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user`  = "'.$us1['user'].'" and `active`  = "1" limit 1');
$users_tanks_company = $res->fetch_assoc();
$mysqli->query('UPDATE `users_tanks` SET `a` = "'.($users_tanks_company['a']-40).'", `b` = "'.($users_tanks_company['b']-40).'", `t` = "'.($users_tanks_company['t']-40).'", `p` = "'.($users_tanks_company['p']-40).'" WHERE `id` = '.$users_tanks_company['id'].'');
}
$mysqli->query("UPDATE `company` SET `polygon_time` = '0' WHERE `id` = '".$company['id']."' LIMIT 1");
}
















if($company['level'] == 1){ $company_exp = 360;}
elseif($company['level'] == 2){ $company_exp = 600;}
elseif($company['level'] == 3){ $company_exp = 1400;}
elseif($company['level'] == 4){ $company_exp = 2500;}
elseif($company['level'] == 5){ $company_exp = 4000;}
elseif($company['level'] == 6){ $company_exp = 6000;}
elseif($company['level'] == 7){ $company_exp = 10000;}
elseif($company['level'] == 8){ $company_exp = 16000;}
elseif($company['level'] == 9){ $company_exp = 32000;}
elseif($company['level'] == 10){ $company_exp = 72000;}
elseif($company['level'] == 11){ $company_exp = 120000;}
elseif($company['level'] == 12){ $company_exp = 160000;}
elseif($company['level'] == 13){ $company_exp = 240000;}
elseif($company['level'] == 14){ $company_exp = 360000;}
elseif($company['level'] == 15){ $company_exp = 500000;}
elseif($company['level'] == 16){ $company_exp = 660000;}
elseif($company['level'] == 17){ $company_exp = 860000;}
elseif($company['level'] == 18){ $company_exp = 1000000;}
elseif($company['level'] == 19){ $company_exp = 1250000;}
elseif($company['level'] == 20){ $company_exp = 1750000;}
elseif($company['level'] == 21){ $company_exp = 2500000;}
elseif($company['level'] == 22){ $company_exp = 4000000;}
elseif($company['level'] == 23){ $company_exp = 6000000;}
elseif($company['level'] == 24){ $company_exp = 9000000;}
elseif($company['level'] == 25){ $company_exp = 13000000;}
elseif($company['level'] == 26){ $company_exp = 100000;}
elseif($company['level'] == 27){ $company_exp = 20000000;}
elseif($company['level'] == 28){ $company_exp = 30000000;}
elseif($company['level'] == 29){ $company_exp = 50000000;}
elseif($company['level'] == 30){ $company_exp = 80000000;}
elseif($company['level'] == 31){ $company_exp = 120000000;}
elseif($company['level'] == 32){ $company_exp = 170000000;}
elseif($company['level'] == 33){ $company_exp = 230000000;}
elseif($company['level'] == 34){ $company_exp = 300000000;}
elseif($company['level'] >= 35){ $company_exp = 100000000000000000000000000000000000000000000000000000000000000000000;}




if($company['exp'] >= $company_exp){
$mysqli->query("UPDATE `company` SET `exp` = `exp` - '".$company_exp."', `gold` = '".($company['gold'] + ((100+(10*($company['level']+1)))/2))."', `gold_` = '".($company['gold_'] + ((100+(10*($company['level']+1)))/2))."', `level` = '".($company['level'] + 1)."' WHERE `id` = '".$company['id']."' LIMIT 1");
$text ="<span class='yellow1' w:id='text'>Дивизия получила ".($company['level'] + 1)." уровень!</span><br>
<span class='yellow3'>Штаб дивизии пополнен на <img title='Золото' alt='Золото' src='/images/icons/gold.png?1'> ".(100+(10*($company['level']+1)))." золота!</span>";
$mysqli->query('INSERT INTO `company_log` SET `company` = "'.$company['id'].'", `text` = "'.$text.'", `time` = "'.time().'" ');
$mysqli->query('INSERT INTO `company_add` SET `company` = "'.$company['id'].'", `text` = "'.$text.'", `time` = "'.time().'" ');
$uid = mysqli_insert_id($mysqli);
$mysqli->query('UPDATE `users` SET `company_add` = "'.$uid.'" WHERE `company` = "'.$company['id'].'" ');
header('Location: ?');
exit();
}















if($company['side'] == 1){$side = 'federation';}else{$side = 'empire';}
echo '<div class="medium white bold cntr mb2 mt5">Дивизия <img class="price_img_" src="/images/side/'.$side.'.png?1"> <span class="green2" w:id="name">'.$company['name'].'</span></div>';



echo '<div class="cntr mb6 mt5">';
if($company['shtab_param']<1){
echo '<img class="mlr3" height="15" width="15" src="/images/upgrades/starEmpty.png"> ';
}elseif($company['shtab_param']>=1 && $company['shtab_param']<2){
echo '<img class="mlr3" height="15" width="15" src="/images/upgrades/starHalf.png"> ';
}elseif($company['shtab_param']>=2){echo '<img class="mlr3" height="15" width="15" src="/images/upgrades/starFull.png"> ';
}

if($company['shtab_param']<=2){
echo '<img class="mlr3" height="15" width="15" src="/images/upgrades/starEmpty.png"> ';
}if($company['shtab_param']>2 && $company['shtab_param']<6){
echo '<img class="mlr3" height="15" width="15" src="/images/upgrades/starHalf.png"> ';
}elseif($company['shtab_param']>=6){
echo '<img class="mlr3" height="15" width="15" src="/images/upgrades/starFull.png"> ';
}

if($company['shtab_param']<=6){
echo '<img class="mlr3" height="15" width="15" src="/images/upgrades/starEmpty.png"> ';
}if($company['shtab_param']>6 && $company['shtab_param']<14){
echo '<img class="mlr3" height="15" width="15" src="/images/upgrades/starHalf.png"> ';
}elseif($company['shtab_param']>=14){
echo '<img class="mlr3" height="15" width="15" src="/images/upgrades/starFull.png"> ';
}

if($company['shtab_param']<=14){
echo '<img class="mlr3" height="15" width="15" src="/images/upgrades/starEmpty.png"> ';
}if($company['shtab_param']>14 && $company['shtab_param']<30){
echo '<img class="mlr3" height="15" width="15" src="/images/upgrades/starHalf.png"> ';
}elseif($company['shtab_param']>=30){
echo '<img class="mlr3" height="15" width="15" src="/images/upgrades/starFull.png"> ';
}

if($company['shtab_param']<=30){
echo '<img class="mlr3" height="15" width="15" src="/images/upgrades/starEmpty.png"> ';
}if($company['shtab_param']>30 && $company['shtab_param']<62){
echo '<img class="mlr3" height="15" width="15" src="/images/upgrades/starHalf.png"> ';
}elseif($company['shtab_param']>=62){
echo '<img class="mlr3" height="15" width="15" src="/images/upgrades/starFull.png"> ';
}

if($company['shtab_param']<=62){
echo '<img class="mlr3" height="15" width="15" src="/images/upgrades/starEmpty.png"> ';
}if($company['shtab_param']>62 && $company['shtab_param']<102){
echo '<img class="mlr3" height="15" width="15" src="/images/upgrades/starHalf.png"> ';
}elseif($company['shtab_param']>=102){
echo '<img class="mlr3" height="15" width="15" src="/images/upgrades/starFull.png"> ';
}

if($company['shtab_param']<=102){
echo '<img class="mlr3" height="15" width="15" src="/images/upgrades/starEmpty.png"> ';
}if($company['shtab_param']>102 && $company['shtab_param']<160){
echo '<img class="mlr3" height="15" width="15" src="/images/upgrades/starHalf.png"> ';
}elseif($company['shtab_param']>=160){
echo '<img class="mlr3" height="15" width="15" src="/images/upgrades/starFull.png"> ';
}
echo '</div>';







$res_company_col_us = $mysqli->query("SELECT COUNT(*) FROM `users` WHERE `company` = '".$company['id']."' ");
$company_col_us = $res_company_col_us->fetch_array(MYSQLI_NUM);

$company_exp_prog = round(100/($company_exp/($company['exp']+1)));
if($company_exp_prog > 100) {$company_exp_prog = 100;}
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="thumb fl"><span w:id="avatarStoreLink"><em><img w:id="avatar" src="/images/avatar/clan/'.$company['avatar'].'.png" style="width:100%; border-radius: 9px;"><span class="mask2">&nbsp;</span></em></span></div>
<div class="ml58 small white sh_b bold">
Опыт: '.($company['exp']).' из '.($company_exp).'<br>
Экипаж: '.$company['lvl_crew'].' из '.($company_col_us[0]*100).'<br>

</div>
<table class="rblock blue esmall">
<tbody><tr>
<td><div class="value-block lh1"><span><span><img height="14" width="14" src="/images/icons/exp.png"> '.$company['level'].'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" w:id="percentDiv" style="width:'.$company_exp_prog.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span w:id="percent">'.$company_exp_prog.'%</span></span></div></td>
</tr>
</tbody></table>
<div class="clrb"></div>

</div></div></div></div></div></div></div></div></div></div>';















if($company['id']==$user['company']){

if($c_u_a['time_restart']>time()){
echo '<div style="position:relative;"><a class="simple-but gray border mb2" w:id="bitvaLink" href="/company/assault/"><span><span>Спецзадание</span></span></a></div>';
echo '<div class="cntr small red1 sh_b bold mb5">Спецзадание недоступно: '._time($c_u_a['time_restart']-time()).'</div>';
}else{
echo '<div style="position:relative;"><a class="simple-but border mb2" w:id="bitvaLink" href="/company/assault/"><span><span>Спецзадание</span></span></a></div>';
}


if(($company_user['company_time']+72000)<time()){
if($company_user['company_gold_time']<time()){
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">В штабе дивизии доступно пополение</div>
</div></div></div></div></div></div></div></div></div></div>';
}elseif($company_user['barracks_time']==0){
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">В казарме дивизии доступно обучение</div>
</div></div></div></div></div></div></div></div></div></div>';
}elseif($company_user['barracks_time']<time() and $company_user['barracks_time']>0){
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">В казарме дивизии завершилось обучение</div>
</div></div></div></div></div></div></div></div></div></div>';
}elseif($company_user['fuelDepot_time']==0){
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">В топливном складе запустите производство топлива</div>
</div></div></div></div></div></div></div></div></div></div>';
}elseif($company_user['fuelDepot_time']<time() and $company_user['fuelDepot_time']>0){
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">В топливном складе завершилось производство топлива</div>
</div></div></div></div></div></div></div></div></div></div>';
}
}




echo '<div class="cntr fs0 mb0">
<a w:id="hqLink" class="thumb inbl m3" href="/hq/"><img width="50" height="50" src="/images/clan/hq.png"style="width:100%; border-radius: 9px;"><span class="mask1">&nbsp;</span></a>
<div class="inbl prel medium"><a w:id="barracksLink" class="thumb inbl m3" href="/barracks/"><img width="50" height="50" src="/images/clan/barracks.png"style="width:100%; border-radius: 9px;"><span class="mask1">&nbsp;</span></a></div>
<div class="inbl prel medium"><a w:id="fuelDepotLink" class="thumb inbl m3" href="/fuelDepot/"><img width="50" height="50" src="/images/clan/fuelDepot.png"style="width:100%; border-radius: 9px;"><span class="mask1">&nbsp;</span></a></div>
<a w:id="polygonLink" class="thumb inbl m3" href="/polygon/"><img width="50" height="50" src="/images/clan/polygon.png"style="width:100%; border-radius: 9px;"><span class="mask1">&nbsp;</span></a>
</div>';


echo '<table><tbody><tr>';
//echo '<td class="w50 p1"><div class="prel"><a class="simple-but border" w:id="clanBoard" href="../forum/27987"><span><span>Форум</span></span></a></div></td>';
$res_cchat_col = $mysqli->query("SELECT COUNT(*) FROM `cchat` WHERE `company` = ".$company['id']." ");
$cchat_coll = $res_cchat_col->fetch_array(MYSQLI_NUM);
if($cchat_coll[0]!=$company_user['cchat_coll']){
$cchat_plus = '<span class="digit esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span>';
}else{$cchat_plus = '';}
echo '<td class="w50 p1"><div class="prel"><a class="simple-but border" w:id="clanChat" href="/cchat/"><span><span>Чат</span></span></a>'.$cchat_plus.'</div></td>';
echo '</tr></tbody></table>';

}







$res = $mysqli->query('SELECT * FROM `settings` WHERE `id` = "1" limit 1');
$sql = $res->fetch_assoc();


$res_company_onl = $mysqli->query("SELECT COUNT(*) FROM `users` WHERE `company` = ".($company['id'])." and `viz` > ".(time()-$sql['online'])." ");
$company_onl = $res_company_onl->fetch_array(MYSQLI_NUM);

if($company['level']>=24){$company_mesta = 24;}else{$company_mesta = $company['level'];}

echo '<div class="white medium cntr bold mb5"><div class="mb0"><img height="14" width="14" src="/images/icons/online.png">Танкистов: '.$company_col_us[0].' из '.$company_mesta.'<span class="green1"> ('.$company_onl[0].')</span></div></div>';

if($company_user['company_rang']>0 and $company_user['company_rang']<=3){echo '<center><div class="mb5"><a class="gray1 small bold td_u" w:id="findStaffLink" href="/NotInClan/">Найти танкистов</a></div></center>';}
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$number = 999999;
echo n_f($number);

 */

echo '<table class="tlist white sh_b bold small mb10"><tbody>';
$max = 10;
$res = $mysqli->query("SELECT COUNT(*) FROM `company_user` WHERE `company` = ".$company['id']." ");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$res_reit_us = $mysqli->query('SELECT * FROM `company_user` WHERE `company` = '.$company['id'].' ORDER BY `company_rang` asc, `company_exp` DESC LIMIT '.$start.','.$max.' ');
while ($us = $res_reit_us->fetch_array()){
$res2 = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$us['user'].'" LIMIT 1');
$traning = $res2->fetch_assoc();
$res_user = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$us['user'].'" LIMIT 1');
$us_ = $res_user->fetch_assoc();

$reyt = ''.$k_post[0]++.'';
if($us_['side'] == 1){$side = 'federation';}else{$side = 'empire';}
if($us_['viz'] > time()-$sql['online']){$viz = '';}else{$viz = '_off';}

if($us['company_rang'] == 1){$company_rang = '<span class="leader" w:id="rank">комдив</span>';}
if($us['company_rang'] == 2){$company_rang = '<span class="leader" w:id="rank">замкомдив</span>';}
if($us['company_rang'] == 3){$company_rang = '<span class="general" w:id="rank">генерал</span>';}
if($us['company_rang'] == 4){$company_rang = '<span class="officer" w:id="rank">офицер</span>';}
if($us['company_rang'] == 5){$company_rang = '<span class="" w:id="rank">рядовой</span>';}
if($us['company_rang'] == 6){$company_rang = '<span class="" w:id="rank">новичок</span>';}

echo '<tr w:id="members"><td class="usr w100">
<div class="fl"><a class="white" w:id="profileLink" href="/profile/'.$us_['id'].'/"><img class="price_img_" height="14" width="14" src="/images/side/'.$side.'/'.$traning['rang'].''.$viz.'.png?1"> '.$us_['login'].', '.$company_rang.', <img class="ico vm" src="/images/icons/exp.png" alt="опыт" title="опыт"> '.n_f($us['company_exp']).'</a></div>';

if($company_user['company_rang']>0 and $company_user['company_rang']<=3){
echo '<div class="fr"><a href="/usset/'.$us['user'].'/"><img class="price_img" height="14" width="15" src="/images/icons/settings.png"  style="border-radius: 4px;"></a></div>';
}

echo '</td></tr>';
}
if ($k_page > 1) {
echo str('/company/'.$company['id'].'/?',$k_page,$page); // Вывод страниц
}
echo '</tbody></table>';









if($company['id']==$user['company']){
echo '<a class="simple-but gray mb5" w:id="statsLink" href="/companystats/"><span><span>Статистика</span></span></a>';
echo '<a class="simple-but gray mb5" w:id="eventsLink" href="/companyevents/"><span><span>Журнал</span></span></a>';
echo '<div class="mb5">
<a class="simple-but gray" w:id="leaveClanLink" href="?exit"><span><span>Покинуть дивизию</span></span></a>';
if(($company_user['company_time']+72000)>time()){
echo '<div class="cntr small gray1">Покинуть дивизию через '._time(($company_user['company_time']+72000)-time()).'</div>';
}
echo '</div>';



if(isset($_GET['exit'])){
if(($company_user['company_time']+72000)>time()){header('Location: ?');exit();}
if($company_user['company_rang'] == 1){
if($company_col_us[0]>1){
$_SESSION['err'] = 'Чтобы покинуть дивизию, необходимо исключить всех участников дивизии.';
}else{
$_SESSION['ses'] = '<div class="buy-place-block pt2 mb10">
<div class="medium bold white cntr sh_b mt5 mb5">Удалить дивизию?<br>
<font size=2% color=red>Это действие отменить будет невозможно!</font></div>
<a class="simple-but border w50 mXa mb10" w:id="confirmLink" href="?okda"><span><span>да, подтверждаю</span></span></a>
<a class="simple-but border red w50 mXa" w:id="cancelLink" href="?"><span><span>нет, отмена</span></span></a>
</div>';
}
}else{
$_SESSION['ses'] = '<div class="buy-place-block pt2 mb10">
<div class="medium bold white cntr sh_b mt5 mb5">Покинуть дивизию?</div>
<a class="simple-but border w50 mXa mb10" w:id="confirmLink" href="?okda"><span><span>да, подтверждаю</span></span></a>
<a class="simple-but border red w50 mXa" w:id="cancelLink" href="?"><span><span>нет, отмена</span></span></a>
</div>';
}
header('Location: ?');
exit();
}


if(isset($_GET['okda'])){
if(($company_user['company_time']+72000)>time()){header('Location: ?');exit();}
if($company_user['company_rang'] == 1){
if($company_col_us[0]>1){
$_SESSION['err'] = 'Чтобы покинуть дивизию, необходимо исключить всех участников дивизии.';
}else{
$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user`  = "'.$user['id'].'" and `active`  = "1" limit 1');
$users_tanks = $res->fetch_assoc();
$mysqli->query('UPDATE `users_tanks` SET `a` = "'.($users_tanks['a']-$company['shtab_param']).'", `b` = "'.($users_tanks['b']-$company['shtab_param']).'", `t` = "'.($users_tanks['t']-$company['shtab_param']).'", `p` = "'.($users_tanks['p']-$company['shtab_param']).'" WHERE `id` = '.$users_tanks['id'].'');
if($company_user['polygon_time']>time() ){
$mysqli->query('UPDATE `users_tanks` SET `a` = "'.($users_tanks['a']-40).'", `b` = "'.($users_tanks['b']-40).'", `t` = "'.($users_tanks['t']-40).'", `p` = "'.($users_tanks['p']-40).'" WHERE `id` = '.$users_tanks['id'].'');
}
if($company['polygon_time']>time() ){
$mysqli->query('UPDATE `users_tanks` SET `a` = "'.($users_tanks['a']-40).'", `b` = "'.($users_tanks['b']-40).'", `t` = "'.($users_tanks['t']-40).'", `p` = "'.($users_tanks['p']-40).'" WHERE `id` = '.$users_tanks['id'].'');
}

$mysqli->query('DELETE FROM `company_log` WHERE `company` = "'.$company['id'].'" ');
$mysqli->query('DELETE FROM `company_add` WHERE `company` = "'.$company['id'].'" ');
$mysqli->query('DELETE FROM `company_zayavki` WHERE `company` = "'.$company['id'].'" ');
$mysqli->query('DELETE FROM `company_zayavki` WHERE `user` = "'.$user['id'].'" ');
$mysqli->query('DELETE FROM `company_zayavki` WHERE `ank` = "'.$user['id'].'" ');
$mysqli->query('DELETE FROM `company_user` WHERE `company` = "'.$company['id'].'" ');
$mysqli->query('DELETE FROM `company` WHERE `id` = "'.$company['id'].'" ');
$mysqli->query('UPDATE `users` SET `company` = "0", `company_add` = "0" WHERE `company` = '.$company['id'].'');
}
}else{
if($company_user['barracks_time']>time()){
if($company['level']>=1 && $company['level']<=10){$cost_silver = ($company['level']*25);}elseif($company['level']>10 && $company['level']<=20){$cost_silver = ($company['level']*50);}elseif($company['level']>20 && $company['level']<=30){$cost_silver = ($company['level']*75);}elseif($company['level']>30){$cost_silver = ($company['level']*75);}
$mysqli->query("UPDATE `users` SET `silver` = '".($user['silver']+$cost_silver)."' WHERE `id` = '".$user['id']."' LIMIT 1");
$_SESSION['err'] = 'В казарме дивизии было отменено обучение экипажа! <br>
<div class="green1 sh_b mb2">Возврат средств: <img class="ico vm" src="/images/icons/silver.png" alt="Серебро" title="Серебро"> +'.$cost_silver.'</div>';
}

$text ="<span class='red1'>покинул дивизию</span>";
$mysqli->query('INSERT INTO `company_log` SET `company` = "'.$company['id'].'", `text` = "'.$text.'", `time` = "'.time().'", `ank` = "'.$user['id'].'" ');

$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user`  = "'.$user['id'].'" and `active`  = "1" limit 1');
$users_tanks = $res->fetch_assoc();
$mysqli->query('UPDATE `users_tanks` SET `a` = "'.($users_tanks['a']-$company['shtab_param']).'", `b` = "'.($users_tanks['b']-$company['shtab_param']).'", `t` = "'.($users_tanks['t']-$company['shtab_param']).'", `p` = "'.($users_tanks['p']-$company['shtab_param']).'" WHERE `id` = '.$users_tanks['id'].'');
if($company_user['polygon_time']>time() ){
$mysqli->query('UPDATE `users_tanks` SET `a` = "'.($users_tanks['a']-40).'", `b` = "'.($users_tanks['b']-40).'", `t` = "'.($users_tanks['t']-40).'", `p` = "'.($users_tanks['p']-40).'" WHERE `id` = '.$users_tanks['id'].'');
}
if($company['polygon_time']>time() ){
$mysqli->query('UPDATE `users_tanks` SET `a` = "'.($users_tanks['a']-40).'", `b` = "'.($users_tanks['b']-40).'", `t` = "'.($users_tanks['t']-40).'", `p` = "'.($users_tanks['p']-40).'" WHERE `id` = '.$users_tanks['id'].'');
}
$res = mysqli_query($mysqli,'SELECT sum(rang) FROM crew_user WHERE `user`  = "'.$user['id'].'"');
if (FALSE === $res) die("Select sum failed: ".mysqli_error);
$row = mysqli_fetch_row($res);
$sum = $row[0];
$mysqli->query('UPDATE `company` SET `lvl_crew` = "'.($company['lvl_crew']-$sum).'" WHERE `id` = '.$company['id'].'');
$mysqli->query('UPDATE `users` SET `company` = "0", `company_add` = "0" WHERE `id` = "'.$user['id'].'" ');
$mysqli->query('DELETE FROM `company_zayavki` WHERE `user` = "'.$user['id'].'" ');
$mysqli->query('DELETE FROM `company_zayavki` WHERE `ank` = "'.$user['id'].'" ');
$mysqli->query('DELETE FROM `company_user` WHERE `user` = "'.$user['id'].'" ');
$mysqli->query('DELETE FROM `company_battle_user_assault` WHERE `user` = "'.$user['id'].'" ');
}
header('Location: /');
exit();
}

}















/* if($company['id']!=$user['company']){

} */







require_once ('../system/footer.php');
?>