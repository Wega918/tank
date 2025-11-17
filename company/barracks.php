<?php
$title = 'Казарма дивизии';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']) {
header('Location: /');
exit();
}
if($user['company']<=0) {header('Location: /');exit();}

$res_company = $mysqli->query('SELECT * FROM `company` WHERE `id` = '.$user['company'].' LIMIT 1');
$company = $res_company->fetch_assoc();

$res_company_user = $mysqli->query('SELECT * FROM `company_user` WHERE `user` = '.$user['id'].' and `company` = '.$company['id'].' LIMIT 1');
$company_user = $res_company_user->fetch_assoc();


/* if($company_user['barracks_time']<time() and $company_user['barracks_time'] > 0){
$mysqli->query("UPDATE `company_user` SET `company_gold` = '0', `barracks_time` = '0' WHERE `id` = '".$company_user['id']."' LIMIT 1");
} */


if($company['level']>=1 && $company['level']<=10){
$cost_silver = ($company['level']*25);
$crewpoints = 1;
}elseif($company['level']>10 && $company['level']<=20){
$cost_silver = ($company['level']*50);
$crewpoints = 2;
}elseif($company['level']>20 && $company['level']<=30){
$cost_silver = ($company['level']*75);
$crewpoints = 3;
}elseif($company['level']>30){
$cost_silver = ($company['level']*75);
$crewpoints = 3;
}



echo '<div class="medium white bold cntr mb2">Казарма дивизии</div>
<div class="trnt-block mb2">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="thumb fl"><img width="50" height="50" src="/images/clan/barracks.png" style="width:100%; border-radius: 9px;"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold">
<span class="green2">Личный состав</span><br>
Длительность обучения: <span class="green1">'.$company['level'].'ч.</span>
<div class="">Бонус: <img class="price_img_" src="/images/icons/crewpoints.png"> <span class="green1">'.$crewpoints.' в час.</span></div>
</div></div>';
if($company_user['barracks_time']==0){
if(($company_user['company_time']+72000)>time()){
echo '<div class="cntr red1 mt5 mb2"><font size=2%><b>Станет доступно через: '._time(($company_user['company_time']+72000)-time()).'</b></font></div><br>';
}else{
echo '<div class="bot">
<a class="simple-but border mb5" href="?barracks"><span><span>Начать обучение за <img class="ico vm" src="/images/icons/silver.png" alt="Серебро" title="Серебро"> '.$cost_silver.'</span></span></a>
<div style="position:relative;"><span class="digit2 esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span></div>
</div>';
}
}elseif($company_user['barracks_time']<time() and $company_user['barracks_time']>0){
echo '<div class="bot">
<a class="simple-but border mb5" href="?act_barracks"><span><span>Забрать очки экипажа</span></span></a>
<div style="position:relative;"><span class="digit2 esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span></div>
</div>';
}elseif($company_user['barracks_time']>time()){
$prog = round((($company['level']*3600)-($company_user['barracks_time']-time()))*100/($company['level']*3600));if($prog > 100) {$prog = 100;}
echo '<table class="rblock mt5 mb5 esmall"><tbody><tr>
<td class="vam"><div class="nwr pr5 gray1"><img class="price_img_" src="/images/icons/crewpoints.png" alt="" w:id="image">&nbsp;'.($crewpoints*$company['level']).'</div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$prog.'%;" w:id="widthPercent">&nbsp;</div><div class="mask">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span w:id="remainingTime">'._time($company_user['barracks_time']-time()).'</span></span></div></td>
</tr></tbody></table>';
}
echo '</div></div></div></div></div></div></div></div></div></div>';

echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">Чем выше уровень дивизии, тем больше очков экипажа вы получите</div>
</div></div></div></div></div></div></div></div></div></div>';





##################################################################################################################
##################################################################################################################
##################################################################################################################
if(isset($_GET['act_barracks'])){
if($company_user['barracks_time']==0){header('Location: ?');exit();}
if($company_user['barracks_time']>time()){header('Location: ?');exit();}
$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user`  = "'.$user['id'].'" LIMIT 1');
$ammunition_users = $res->fetch_assoc();
$mysqli->query("UPDATE `ammunition_users` SET `crewpoints` = '".($ammunition_users['crewpoints']+($crewpoints*$company['level']))."' WHERE `id` = '".$ammunition_users['id']."' LIMIT 1");
$mysqli->query("UPDATE `company_user` SET `barracks_time` = '0' WHERE `id` = '".$company_user['id']."' LIMIT 1");
####################################################################################
$res = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `id_miss` = "13" limit 1');
$miss = $res->fetch_assoc();
if($miss['prog']<$miss['prog_max'] and $miss['time']<time()){
$mysqli->query('UPDATE `missions_user` SET `prog` = `prog` + "1" WHERE `user` = '.$user['id'].' and `id_miss` = "13" and `prog` < "1" and `time` < "'.time().'" limit 1');
if($miss['prog']>=($miss['prog_max']-1) and $miss['time']<time()){$_SESSION['miss'] = 1;}
}
####################################################################################
$_SESSION['err'] = '<div class="green1 sh_b mb2">Получены очки экипажа <img class="price_img_" src="/images/icons/crewpoints.png" alt="" w:id="image">&nbsp;'.($crewpoints*$company['level']).' </div>';
header('Location: ?');
exit();
}
##################################################################################################################
##################################################################################################################
##################################################################################################################



##################################################################################################################
##################################################################################################################
##################################################################################################################
if(isset($_GET['barracks'])){
if(($company_user['company_time']+72000)>time()){header('Location: ?');exit();}
if($user['silver'] < $cost_silver){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.($cost_silver-$user['silver']).' серебра</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
if($company_user['barracks_time']>time()){header('Location: ?');exit();}
if($company_user['barracks_time']<time() and $company_user['barracks_time']>0){header('Location: ?');exit();}
$mysqli->query("UPDATE `users` SET `silver` = '".($user['silver']-$cost_silver)."' WHERE `id` = '".$user['id']."' LIMIT 1");
$mysqli->query("UPDATE `company_user` SET `barracks_time` = '".(time()+($company['level']*3600))."' WHERE `id` = '".$company_user['id']."' LIMIT 1");
$_SESSION['err'] = '<div class="green1 sh_b mb2"><img height="14" width="14" src="/images/icons/victory.png"> Началось обучение экипажа! <img height="14" width="14" src="/images/icons/victory.png"></div>';
header('Location: ?');
exit();
}
##################################################################################################################
##################################################################################################################
##################################################################################################################

require_once ('../system/footer.php');
?>