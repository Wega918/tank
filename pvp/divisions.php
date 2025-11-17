<?php
$title = 'Лучшие дивизии';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}
echo '<table><tbody><tr>
<td style="width:33%;padding:0 3px;"><a class="simple-but gray" href="/pvp/divisions/"><span><span>Все дивизии</span></span></a></td>
<td style="width:33%;padding:0 3px;"><a class="simple-but blue" href="/pvp/top/"><span><span>Танкисты</span></span></a></td>
<td style="width:33%;padding:0 3px;"><a class="simple-but blue" href="/pvp/at-division/"><span><span>В дивизии</span></span></a></td>
</tr></tbody></table>';


echo '<div class="medium bold mb0 cntr green1"><img src="/images/icons/victory.png"> Лучшие дивизии <img src="/images/icons/victory.png"></div>';



$res1 = $mysqli->query('SELECT * FROM `settings` WHERE `id` = "1" ');
$sql = $res1->fetch_assoc();



if($sql['time_pvp_rate']<time()){
$time_rate = $mysqli->query('SELECT * FROM `company` WHERE `id` ORDER BY `id` desc LIMIT 10000');
while ($t_r = $time_rate->fetch_array()){
$res = mysqli_query($mysqli,'SELECT sum(pvp_rate) FROM users WHERE `company`  = "'.$t_r['id'].'"');
if (FALSE === $res) die("Select sum failed: ".mysqli_error);
$row = mysqli_fetch_row($res);
$sum_rate = $row[0];
$c_c_us_ = $mysqli->query("SELECT COUNT(*) FROM `users` WHERE `company` = '".$t_r['id']."' ");
$c_c_us = $c_c_us_->fetch_array(MYSQLI_NUM);
$sum_rate = ($sum_rate/$c_c_us[0]);
if($sum_rate!=$t_r['pvp_rate']){
$mysqli->query('UPDATE `company` SET `pvp_rate` = "'.$sum_rate.'" WHERE `id` = "'.$t_r['id'].'" ');
}
}
$mysqli->query('UPDATE `settings` SET `time_pvp_rate` =  "'.(time()+300).'" WHERE `id` = "1" LIMIT 1');
}








if($user['company'] != 0){
echo '<div class="trnt-block mt1 mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini"><div class="mt5 mb5 white small bold cntr">';
$max = 100000;
$res = $mysqli->query("SELECT COUNT(*) FROM `company` WHERE `pvp_rate` >= '0' ");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$res = $mysqli->query('SELECT * FROM `company` WHERE `pvp_rate` >= "0"  ORDER BY `pvp_rate` desc LIMIT '.$start.','.$max.' ');
while ($company_1 = $res->fetch_array()){
$reyt = ''.$k_post[0]++.'';
if($user['company'] == $company_1['id']){
echo 'Ваше место в рейтинге: <span class="green1 bold" w:id="place">'.$reyt.'</span>';
}
}
echo '</div></div></div></div></div></div></div></div></div></div></div>';
}










$max = 10;
$res = $mysqli->query("SELECT COUNT(*) FROM `company` WHERE `pvp_rate` >= '0' ");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$res_company_2 = $mysqli->query('SELECT * FROM `company` WHERE `pvp_rate` >= "0" ORDER BY `pvp_rate` desc LIMIT '.$start.','.$max.' ');
while ($company_2 = $res_company_2->fetch_array()){


if($company_2['pvp_rate']<1749){$p_r = 0;$p_r_ = 1749;$img = 1;$pvp_name = 'кадетов';}
if($company_2['pvp_rate']>=1749 && $company_2['pvp_rate']<=1999){$p_r = 1750;$p_r_ = 1999;$img = 2;$pvp_name = 'рядовых';}
if($company_2['pvp_rate']>=1999 && $company_2['pvp_rate']<=2249){$p_r = 2000;$p_r_ = 2249;$img = 3;$pvp_name = 'сержантов';}
if($company_2['pvp_rate']>=2249 && $company_2['pvp_rate']<=2499){$p_r = 2250;$p_r_ = 2499;$img = 4;$pvp_name = 'лейтенантов';}
if($company_2['pvp_rate']>=2499 && $company_2['pvp_rate']<=2749){$p_r = 2500;$p_r_ = 2749;$img = 5;$pvp_name = 'старших лейтенантов';}
if($company_2['pvp_rate']>=2749 && $company_2['pvp_rate']<=2999){$p_r = 2750;$p_r_ = 2999;$img = 6;$pvp_name = 'капитанов';}
if($company_2['pvp_rate']>=2999 && $company_2['pvp_rate']<=3249){$p_r = 3000;$p_r_ = 3249;$img = 7;$pvp_name = 'майоров';}
if($company_2['pvp_rate']>=3249 && $company_2['pvp_rate']<=3499){$p_r = 3250;$p_r_ = 3499;$img = 8;$pvp_name = 'подполковников';}
if($company_2['pvp_rate']>=3499){$p_r = 3500;$p_r_ = 3749;$img = 9;$pvp_name = 'полковников';}


if($company_2['side'] == 1){$side = 'federation';}else{$side = 'empire';}
$reyt = ''.$k_post[0]++.'';


if($reyt % 2){
if($user['company'] == $company_2['id']){$test = 'odd my';}else{$test = 'even';}
}else{
if($user['company'] == $company_2['id']){$test = 'odd my';}else{$test = 'odd';}
}

echo '<table class="tlist white sh_b bold small mb0"><tbody><tr w:id="users" class="'.$test.'">
<td class="num">'.$reyt.'</td>
<td class="va_m usr w100"><a class="white" w:id="link" href="/company/'.$company_2['id'].'/"><img class="vb" src="/images/pvp/'.$img.'.png"> <span class="green2">'.$company_2['name'].'</span> - '.$company_2['pvp_rate'].' <br></a></td>
</tr></tbody></table>';
}
if ($k_page > 1) {
echo str('/pvp/divisions/?',$k_page,$page); // Вывод страниц
}





echo '<a class="simple-but gray mt5 mb10" w:id="pvpLink" href="/pvp/"><span><span>Вернуться в битву</span></span></a>';
require_once ('../system/footer.php');
?>