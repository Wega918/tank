<?php
$title = 'Лучшие дивизии';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}

echo '<table><tbody><tr>
<td style="width:50%;padding:0 3px;"><a class="simple-but blue" href="/rating/tanks/"><span><span>Танкисты</span></span></a></td>
<td style="width:50%;padding:0 3px;"><a class="simple-but gray" href="/rating/company//"><span><span>Дивизии</span></span></a></td>
</tr></tbody></table>';






if($user['company']){
$res = $mysqli->query('SELECT * FROM `company` WHERE `id` = '.$user['company'].' ORDER BY `level` desc LIMIT 100000');
while ($company_1 = $res->fetch_array()){
if($company_1['side'] == 1){$side = 'federation';}else{$side = 'empire';}
$reyt = ''.++$k_post[0].'';

if($user['company'] == $company_1['id']){
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<table class="white sh_b bold small mb0"><tbody><tr>
<td class="va_m usr w100 pl5">'.$reyt.' <img class="vb" src="/images/side/'.$side.'.png?1"><a href="/company/'.$company_1['id'].'/"> <span class="yellow1">'.$company_1['name'].'</span></a></td>
<td class="va_m nwr p5 ta_r"><img class="vb" height="14" width="14" src="/images/icons/exp.png"> '.$company_1['level'].'</td>
</tr></tbody></table>
</div></div></div></div></div></div></div></div></div></div>';
}
}
}




echo '<div class="white medium cntr bold mb2">Лучшие дивизии по опыту</div>';





$max = 10;
$res = $mysqli->query("SELECT COUNT(*) FROM `company` WHERE `id` ");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$r_c_2 = $mysqli->query('SELECT * FROM `company` WHERE `id` ORDER BY `level` desc, `exp` desc LIMIT '.$start.','.$max.' ');
while ($company = $r_c_2->fetch_array()){
$res1 = $mysqli->query('SELECT * FROM `company_user` WHERE `company` = "'.$company['id'].'" and `company_rang` = "1" ');
$usr = $res1->fetch_assoc();

if($company['side'] == 1){$side = 'federation';}else{$side = 'empire';}
$reyt = ''.$k_post[0]++.'';

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

$r_c_u = $mysqli->query("SELECT COUNT(*) FROM `users` WHERE `company` = '".$company['id']."' ");
$c_c = $r_c_u->fetch_array(MYSQLI_NUM);

$company_exp_prog = round(100/($company_exp/($company['exp']+1)));
if($company_exp_prog > 100) {$company_exp_prog = 100;}





if($reyt==1){
echo '<div class="trnt-block mb2">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="small bold cntr"><a href="/company/'.$company['id'].'/"><img height="14" width="14" src="/images/icons/victory.png"> <span class="green2">'.$company['name'].'</span></a>, <span class="white">комдив:</span> '.nick($usr['user']).'</div>';

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

echo '<div class="thumb fl"><span w:id="avatarStoreLink"><em><img w:id="avatar" src="/images/avatar/clan/'.$company['avatar'].'.png" style="width:100%; border-radius: 9px;"><span class="mask2">&nbsp;</span></em></span></div>
<div class="ml58 small white sh_b bold">Опыт: '.n_f($company['exp']).'<br>Экипаж: '.$company['lvl_crew'].' из '.($c_c[0]*100).'<br></div>
<table class="rblock blue esmall"><tbody><tr>
<td><div class="value-block lh1"><span><span><img height="14" width="14" src="/images/icons/exp.png"> '.$company['level'].'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" w:id="percentDiv" style="width:'.$company_exp_prog.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span w:id="percent">'.$company_exp_prog.'%</span></span></div></td>
</tr></tbody></table><div class="clrb"></div></div></div></div></div></div></div></div></div></div></div>';
}

if($reyt==2){
echo '<div class="trnt-block mb2">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="small bold cntr"><a href="/company/'.$company['id'].'/"><img height="14" width="14" src="/images/icons/victory.png"> <span class="green2">'.$company['name'].'</span></a>, <span class="white">комдив:</span> '.nick($usr['user']).'</div>';

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


echo '<div class="thumb fl"><span w:id="avatarStoreLink"><em><img w:id="avatar" src="/images/avatar/clan/'.$company['avatar'].'.png" style="width:100%; border-radius: 9px;"><span class="mask2">&nbsp;</span></em></span></div>
<div class="ml58 small white sh_b bold">Опыт: '.n_f($company['exp']).'<br>Экипаж: '.$company['lvl_crew'].' из '.($c_c[0]*100).'<br></div>
<table class="rblock blue esmall"><tbody><tr>
<td><div class="value-block lh1"><span><span><img height="14" width="14" src="/images/icons/exp.png"> '.$company['level'].'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" w:id="percentDiv" style="width:'.$company_exp_prog.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span w:id="percent">'.$company_exp_prog.'%</span></span></div></td>
</tr></tbody></table><div class="clrb"></div></div></div></div></div></div></div></div></div></div></div>';
}

if($reyt==3){
echo '<div class="trnt-block mb2">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="small bold cntr"><a href="/company/'.$company['id'].'/"><img height="14" width="14" src="/images/icons/victory.png"> <span class="green2">'.$company['name'].'</span></a>, <span class="white">комдив:</span> '.nick($usr['user']).'</div>';

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

echo '<div class="thumb fl"><span w:id="avatarStoreLink"><em><img w:id="avatar" src="/images/avatar/clan/'.$company['avatar'].'.png" style="width:100%; border-radius: 9px;"><span class="mask2">&nbsp;</span></em></span></div>
<div class="ml58 small white sh_b bold">Опыт: '.n_f($company['exp']).'<br>Экипаж: '.$company['lvl_crew'].' из '.($c_c[0]*100).'<br></div>
<table class="rblock blue esmall"><tbody><tr>
<td><div class="value-block lh1"><span><span><img height="14" width="14" src="/images/icons/exp.png"> '.$company['level'].'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" w:id="percentDiv" style="width:'.$company_exp_prog.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span w:id="percent">'.$company_exp_prog.'%</span></span></div></td>
</tr></tbody></table><div class="clrb"></div></div></div></div></div></div></div></div></div></div></div>';
}










if($reyt>3){
if($reyt % 2){
if($user['company'] == $company['id']){$test = 'odd my';}else{$test = 'odd';}
}else{
if($user['company'] == $company['id']){$test = 'odd my';}else{$test = 'even';}
}
echo '<table class="tlist white sh_b bold small mb0"><tbody><tr w:id="users" class="'.$test.'">
<td class="num">'.$reyt.'</td>
<td class="va_m usr w100"><a class="white" w:id="link" href="/company/'.$company['id'].'/"><img class="vb" src="/images/side/'.$side.'.png?1"> <span class="green2">'.$company['name'].'</span><br></a></td>
<td class="va_m nwr p5 ta_r"><img class="vb" height="14" width="14" src="/images/icons/exp.png"> '.$company['level'].'</td>
</tr></tbody></table>';
}
}
if ($k_page > 1) {
echo str('/rating/company/?',$k_page,$page); // Вывод страниц
echo '<div class="trnt-block mb2">';
}else{
echo '<div class="trnt-block mb2 mt10">';

}




echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<a class="simple-but mt5 mb5 a_w50" w:id="searchLink" href="/search_c/"><span><span>Поиск дивизии</span></span></a>
</div></div></div></div></div></div></div></div></div></div></div>';

echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini ml10"><div class="mt5 mb5 small bold">
<img height="14" width="14" src="/images/icons/exp.png"> <a class="orange" w:id="filterExp" href="/rating/company/"><span><span>Лучшие по опыту</span></span></a><br>
</div></div></div></div></div></div></div></div></div></div></div>';

require_once ('../system/footer.php');
?>