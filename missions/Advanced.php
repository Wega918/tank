<?php
$title = 'Миссии';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}
if($user['level']<7){
header('Location: /missions/');
exit();
}

//$mysqli->query('INSERT INTO `missions` SET  `tip` = "2" ');

$res = $mysqli->query('SELECT * FROM `traning` WHERE `user`  = "'.$user['id'].'" limit 1');
$traning = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user`  = "'.$user['id'].'" and `active`  = "1" limit 1');
$users_tanks = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `tanks` WHERE `id`  = "'.$users_tanks['tip'].'" limit 1');
$tanks = $res->fetch_assoc();

if($tanks['country']=='GERMANY'){$country = 1;}
if($tanks['country']=='SSSR'){$country = 2;}
if($tanks['country']=='USA'){$country = 3;}

$res = $mysqli->query("SELECT COUNT(*) FROM `missions_user` WHERE `user` = ".$user['id']." and `tip` = '3' and `country` = '".$country."' ");
$col = $res->fetch_array(MYSQLI_NUM);

$max_miss = 14;


//echo ''.$country.' | '.$limit.' | '.$col[0].' | '.$k_post2[0].'<hr>';


if($traning['rang']>=3){
if($col[0]<$max_miss){
$res = $mysqli->query('SELECT * FROM `missions` WHERE `tip` = "3" and `prog` > "0" ORDER BY `id` asc ');
while ($i = $res->fetch_array()){
$res2 = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = "'.$user['id'].'" and `id_miss` = "'.$i['id'].'" and (`id_miss` = "18" or `id_miss` = "19")');
$mii = $res2->fetch_assoc();
if(!$mii){
$res1 = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = "'.$user['id'].'" and `id_miss` = "'.$i['id'].'" and `country` = "'.$country.'"  ');
$mi = $res1->fetch_assoc();//
if(!$mi){//echo '1';
$mysqli->query('INSERT INTO `missions_user` SET `user` = '.$user['id'].', `tip` = "'.$i['tip'].'" , `id_miss` = "'.$i['id'].'", `prog_max` = "'.$i['prog'].'", `country` = "'.$country.'" ');
}
}
}
}
}


$res1 = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `prog` >= `prog_max` and `time` <= "'.time().'" and `tip` <= "2"
and (`id_miss` != "28" and `id_miss` != "29" and `id_miss` != "30" and `id_miss` != "31")
 limit 1'); // and `country` = "'.$country.'" 
$miss1 = $res1->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `prog` >= `prog_max` and `time` <= "'.time().'" and `tip` = "3"
and (`id_miss` != "32" and `id_miss` != "33" and `id_miss` != "34" and `id_miss` != "35")
 limit 1'); // and `country` = "'.$country.'" 
$miss2 = $res->fetch_assoc();


if($miss1){$n_miss1 = '<div style="position:relative;"><span class="digit2 esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span></div>';}
if($miss2){$n_miss2 = '<div style="position:relative;"><span class="digit2 esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span></div>';}




if($user['level']>=7){
echo '<table><tbody><tr>
<td style="width:50%;padding:0 3px;"><a class="simple-but border" w:id="simpleKlassLink" href="/missions/"><em><span><span>Простые</span></span></em></a>'.$n_miss1.'</td>
<td style="width:50%;padding:0 3px;"><a class="simple-but border gray" w:id="advancedKlassLink"><span><span>Сложные</span></span></a>'.$n_miss2.'</td>
</tr></tbody></table>';
}
if($traning['rang']<3){
echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="white small bold sh_b mb5 cntr">Сложные миссии доступны со званием <img src="/images/icons/victory.png"><span class="green2" w:id="requiredRank">Сержант</span><img src="/images/icons/victory.png"></div>
<div class="bot"><a class="simple-but border" w:id="trainingLink" href="/training/'.$user['id'].'/"><span><span>Получить звание</span></span></a></div>
</div></div></div></div></div></div></div></div></div></div>';
}else{





$max = 100;
$res = $mysqli->query("SELECT COUNT(*) FROM `missions_user` WHERE `user` = ".$user['id']." and `tip` = '3' and `time` <= ".time()." and `country` = '".$country."'
and (`id_miss` != '32' and `id_miss` != '33' and `id_miss` != '34' and `id_miss` != '35')
 ");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$res111 = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `tip` = "3" and `time` <= "'.time().'" and `country` = '.$country.' 
and (`id_miss` != "32" and `id_miss` != "33" and `id_miss` != "34" and `id_miss` != "35") 
ORDER BY `prog`>=`prog_max` desc, `prog` desc, `id` desc LIMIT '.$start.','.$max.' ');
while ($miss = $res111->fetch_array()){
$res1 = $mysqli->query('SELECT * FROM `missions` WHERE `id` = "'.$miss['id_miss'].'" LIMIT 1 ');
$m = $res1->fetch_assoc();

$width = round(100/($m['prog']/($miss['prog']+0.0000001)));
if($width > 100) {$width = 100;}

if($traning['rang']>=3){
$s = ($m['silver']*($traning['rang']*10)/100);
$e = ($m['exp']*($traning['exp']*10)/100);
}else{
$s = 0;
$e = 0;
}

$res_s7 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "7" and `user`  = "'.$user['id'].'" ');
$skills_7 = $res_s7->fetch_assoc(); // Инструктор Повышает личный заработанный опыт.
if($skills_7['bon']>0){$m['exp'] = ($m['exp']+($m['exp']*$skills_7['bon']/100));$e = ($e+($e*$skills_7['bon']/100));}else{$m['exp'] = $m['exp'];$e = $e;}

$res = $mysqli->query('SELECT * FROM `prom` WHERE `id` = "1" ');
$prom = $res->fetch_assoc();
if($prom['time_2']>time()){$m['exp'] = $m['exp']+($m['exp']*$prom['act_2']/100);$e = $e+($e*$prom['act_2']/100);}else{$m['exp'] = $m['exp'];$e = $e;}

if($prom['time_15']>time()){$m['gold'] = ceil($m['gold']+($m['gold']*$prom['act_15']/100));}else{$m['gold'] = $m['gold'];}

if($m['gold']>0){$gold = $m['gold'];$gold_ = '<img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> '.$gold.'';$gold__ = 'золота';}else{$gold = 0;$gold_ = '';$gold__ = '';}
if($m['silver']>0){$silver = ceil($m['silver']+$s);$silver_ = '<img class="ico vm" src="/images/icons/silver.png" alt="Серебро" title="Серебро"> '.$silver.'';$silver__ = 'серебра';}else{$silver = 0;$silver_ = '';$silver__ = '';}
if($m['exp']>0){$exp = ceil($m['exp']+$e);$exp_ = '<img class="ico vm" src="/images/icons/exp.png" alt="Опыт" title="Опыт"> '.$exp.'';$exp__ = 'опыта';}else{$exp = 0;$exp_ = '';$exp__ = '';}
if($m['crewpoints']>0){$crewpoints = $m['crewpoints'];$crewpoints_ = '<img class="ico vm" src="/images/icons/crewpoints.png" alt="Опыт экипажа" title="Опыт экипажа"> '.$crewpoints.'';$crewpoints__ = 'очков экипажа';}else{$crewpoints = 0;$crewpoints_ = '';$crewpoints__ = '';}
if($m['fuel']>0){$fuel = $m['fuel'];$fuel_ = '<img class="ico vm" src="/images/icons/fuel.png?2" alt="Топливо" title="Топливо"> '.$fuel.'';$fuel__ = 'топлива';}else{$fuel = 0;$fuel_ = '';$fuel__ = '';}
if($m['snaryad']>0){$snaryad = $m['snaryad'];$snaryad_ = '<span class="green2">'.$snaryad.'</span> ';$snaryad__ = 'снарядов';}else{$snaryad = 0;$snaryad_ = '';$snaryad__ = '';}





if(isset($_GET[''.$miss['id'].''])){
if($miss['prog']<$m['prog']){header('Location: ?');exit();}
if($miss['time']>time()){header('Location: ?');exit();}
$mysqli->query('UPDATE `users` SET `miss_col_` = `miss_col_` + "1", `gold` = `gold` + "'.$gold.'", `silver` = `silver` + "'.$silver.'", `exp` = `exp` + "'.$exp.'", `fuel` = `fuel` + "'.$fuel.'" WHERE `id` = '.$user['id'].'');
$mysqli->query('UPDATE `missions_user` SET `time` = "'.(time()+(3600*20)).'", `prog` = "0" WHERE `id` = '.$miss['id'].'');
$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user`  = "'.$user['id'].'" LIMIT 1');
$a_users = $res->fetch_assoc();
if($m['snaryad']>0){$rand = rand(1,3);if($rand==1){$mysqli->query("UPDATE `ammunition_users` SET `b` = `b` + '10' WHERE `id` = '".$a_users['id']."' LIMIT 1");}elseif($rand==2){$mysqli->query("UPDATE `ammunition_users` SET `k` = `k` + '10' WHERE `id` = '".$a_users['id']."' LIMIT 1");}elseif($rand==3){$mysqli->query("UPDATE `ammunition_users` SET `f` = `f` + '10' WHERE `id` = '".$a_users['id']."' LIMIT 1");}}
if($m['crewpoints']>0){$mysqli->query("UPDATE `ammunition_users` SET `crewpoints` = `crewpoints` + '".$m['crewpoints']."' WHERE `id` = '".$a_users['id']."' LIMIT 1");}

if($user['company']){
$res_company = $mysqli->query('SELECT * FROM `company` WHERE `id` = '.$user['company'].' limit 1');
$company = $res_company->fetch_assoc();
$res_company_user = $mysqli->query('SELECT * FROM `company_user` WHERE `user` = '.$user['id'].' and `company` = '.$company['id'].' LIMIT 1');
$company_user = $res_company_user->fetch_assoc();
$res_crew_user = $mysqli->query('SELECT * FROM `crew_user` WHERE `user` = '.$user['id'].' and `tip` = "1" limit 1');
$crew_user = $res_crew_user->fetch_assoc();
$res_s6 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "6" and `user`  = "'.$user['id'].'" ');
$skills_6 = $res_s6->fetch_assoc(); // Курсы офицеров Повышает заработанный опыт дивизии.
$exp_company = $exp+  ($exp*($crew_user['sposobn']+$skills_6['bon'])/100);
$mysqli->query('UPDATE `company_user` SET `company_exp` = '.($company_user['company_exp']+$exp_company).', `company_exp_stats` = '.($company_user['company_exp_stats']+$exp_company).' WHERE `id` = '.$company_user['id'].'');
$mysqli->query('UPDATE `company` SET `exp` = '.($company['exp']+$exp_company).' WHERE `id` = '.$company['id'].'');
}
header('Location: ?');
$_SESSION['ok'] = '<div class="trnt-block mb6 cntr bold small">
<div class="green1 pb5">Выполнена миссия "'.$m['name'].'"!</div>
<div class="white">'.$gold_.' '.$gold__.' '.$silver_.' '.$silver__.' '.$exp_.' '.$exp__.' '.$crewpoints_.' '.$crewpoints__.' '.$fuel_.' '.$fuel__.' '.$snaryad_.' '.$snaryad__.' </div>
<div class="gray1">Сложных миссий выполнено: '.($user['miss_col_']+1).'</div>
</div>';
exit();
}

echo '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">

<div class="white cntr bold sh_b small pb2">
<div class="small orange pb2">'.$m['name'].' </div>'.$m['text'].'<br>';//'.$miss['id_miss'].'
if($miss['prog']>0){
echo '<table class="rblock esmall mb0"><tbody><tr>
<td><div class="value-block lh1"><span><span>'.$miss['prog'].'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$width.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$m['prog'].'</span></span></div></td>
</tr></tbody></table>';
}
echo '<span class="gray1">награда:</span> <span class="green2"><span class="nwr"> '.$gold_.' '.$silver_.' '.$exp_.' '.$crewpoints_.' '.$fuel_.' '.$snaryad_.' '.$snaryad__.' </span></span><br>';

echo '</div>';
if($miss['prog']>=$m['prog']){
echo '<div class="bot">
<a class="simple-but border mb10" href="?'.$miss['id'].'"><span><span>Получить награду</span></span></a>
<div style="position:relative;"><span class="digit2 esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span></div>
</div>';
echo '<div class="trnt-block mb15"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"></div></div></div></div></div></div></div></div></div>';
}

//echo '<div class="small white cntr sh_b bold">Одна случайная часть трофея</div>';

if($m['id']==18){$href = '/pay/';
}elseif($m['id']==19){$href = '/pay/';
}elseif($m['id']==20){$href = '/battle/';
}elseif($m['id']==21){$href = '/battle/';
}elseif($m['id']==22){$href = '/crew/'.$user['id'].'/';
}elseif($m['id']==23){$href = '/buildings/';
}elseif($m['id']==24){$href = '/battle/';
}elseif($m['id']==25){$href = '/battle/';
}elseif($m['id']==26){$href = '/battle/';
}elseif($m['id']==27){$href = '/battle/';
}elseif($m['id']==32){$href = '/pvp/';
}elseif($m['id']==33){$href = '/pvp/';
}elseif($m['id']==34){$href = '/pvp/';
}elseif($m['id']==35){$href = '/pvp/';
}
if($miss['prog']<$m['prog']){echo '<div class="cntr"><a class="simple-but mt5 mb2 a_w50" href="'.$href.'"><span><span>Перейти к выполнению</span></span></a></div>';}
echo '</div></div></div></div></div></div></div></div></div></div>';




}

































$max = 1000;
$res = $mysqli->query("SELECT COUNT(*) FROM `missions_user` WHERE `user` = ".$user['id']." and `tip` = '3' and `time` < ".(time()+86400)." and `country` = '".$country."' ");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$res = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `tip` = "3" and `time` > "'.time().'" and `time` < "'.(time()+86400).'" and `country` = '.$country.' ORDER BY `time` desc LIMIT '.$start.','.$max.' ');
while ($miss_ = $res->fetch_array()){
$res1 = $mysqli->query('SELECT * FROM `missions` WHERE `id` = "'.$miss_['id_miss'].'" ');
$m1 = $res1->fetch_assoc();

echo '<div class="trnt-block mb2">

<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="cntr sh_b small gray1">
<div class="bold pb2">'.$m1['name'].'</div>
<div class="bold">'.$m1['text'].'</div>
Обновление через: '._time($miss_['time']-time()).'
</div>
</div>
</div></div></div></div></div></div></div></div>

</div>

';

}
}

require_once ('../system/footer.php');
?>