<?php
require_once ('system/function.php');
//require_once ('system/taimers.php');
//require_once ('system/level_user.php');
if(!$user['id']){
header('Location: /');
exit();
}
$ban = mysql_fetch_array(mysql_query('SELECT * FROM `ban` WHERE `user` = "'.$user['id'].'"'));
if(!$ban){
header('Location: /');
exit();
}

/* 
<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="small white sh_b bold cntr">
<span class="medium red1">Доступ запрещён</span><br>
<span class="yellow1">Причина:</span>
<p>.</p>
</div>

</div>
</div></div></div></div></div></div></div></div>
</div> */




$sql = mysql_fetch_assoc(mysql_query("SELECT * FROM `settings` WHERE `id` = '1'"));
$t = microtime(1);
$today[1] = date("H:i:s"); 
$NameGame = 'Авиа Бизнесмены';


?>
<head>
<meta name="megakassa" content="c148fcb2062" />
<meta name="yandex-verification" content="65507a26594b008b" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="Keywords" content="Авиа Бизнесмены, игры, RPG, MMORPG, бизнес игра, онлайн, wap, бесплатно, бизнес, играть онлайн, ролевые игры, лучшие онлайн игры, браузерная игра, самолёты, авикомпания, город, турниры, задания, авиа, аэропорт">
<meta name="google" content="notranslate">

<meta property="og:type" content="website">
<meta property="og:site_name" content="<?=$NameGame?>">
<meta property="og:title" content="<?=$NameGame?>">
<meta property="og:description" content="Построй свой виртуальный бизнес. Управляй целой Авиакомпанией из десятков самолётов, строй аэропорт мечты!">
<meta property="og:url" content="<?=$HOME?>">
<meta property="og:locale" content="ru_RU">
<meta property="og:image" content="<?=$HOME?>images/logo.jpg">
<meta property="og:image:width" content="2560">
<meta property="og:image:height" content="1024">

<link rel="icon" href="/favicon.ico" type="image/png">
<link rel="stylesheet" type="text/css" href="/diz.css"><title><?=$NameGame?></title>
 


<script type="text/javascript">
var secS ='с';var secM =' сек';var minS ='м:';var minM ='мин';var hourS ='ч:';var hourM ='час';var dayS ='д:';var dayM ='дн';var detailOut = false;var readyLink = '1'+(detailOut?secS:'' + secM );
</script>


<script type="text/javascript" data-persistent="true" src="<?=$HOME?>js/t.js"></script>

</head>
<?php

echo '<div class="ovh"></div><div class="hdr">';
echo '<span class="stat"><img class="price_img" src="/images/coin.png" alt="">'.n_f($user['coin']).'</span>';
echo '<span class="stat"><img class="price_img" src="/images/baks.png" alt="">'.n_f($user['baks']).'</span>';
if($users_b_5){
echo '<span class="stat"><img class="price_img" src="/images/fuel.png" alt="">'.n_f($users_b_5['sposobn']).'</span>';
}
if($users_b_1){
echo '<span class="stat"><img class="price_img" src="/images/passengers.png" alt="">'.n_f($users_b_1['sposobn']).'</span>';
}
echo '</div>';











#######################################################################
if($user['level'] == 1){ $exp = 250;}
elseif($user['level'] == 2){ $exp = 500;}
elseif($user['level'] == 3){ $exp = 1000;}
elseif($user['level'] == 4){ $exp = 1750;}
elseif($user['level'] == 5){ $exp = 2500;}
elseif($user['level'] == 6){ $exp = 5000;}
elseif($user['level'] == 7){ $exp = 10000;}
elseif($user['level'] == 8){ $exp = 20000;}
elseif($user['level'] == 9){ $exp = 25000;}
elseif($user['level'] == 10){ $exp = 50000;}
elseif($user['level'] == 11){ $exp = 75000;}
elseif($user['level'] == 12){ $exp = 100000;}
elseif($user['level'] == 13){ $exp = 125000;}
elseif($user['level'] == 14){ $exp = 175000;}
elseif($user['level'] == 15){ $exp = 225000;}
elseif($user['level'] == 16){ $exp = 275000;}
elseif($user['level'] == 17){ $exp = 325000;}
elseif($user['level'] == 18){ $exp = 375000;}
elseif($user['level'] == 19){ $exp = 450000;}
elseif($user['level'] == 20){ $exp = 525000;}
elseif($user['level'] == 21){ $exp = 600000;}
elseif($user['level'] == 22){ $exp = 675000;}
elseif($user['level'] == 23){ $exp = 750000;}
elseif($user['level'] == 24){ $exp = 850000;}
elseif($user['level'] == 25){ $exp = 950000;}
elseif($user['level'] == 26){ $exp = 1050000;}
elseif($user['level'] == 27){ $exp = 1150000;}
elseif($user['level'] == 28){ $exp = 1250000;}
elseif($user['level'] == 29){ $exp = 1400000;} //+150k
elseif($user['level'] == 30){ $exp = 1550000;}
elseif($user['level'] == 31){ $exp = 1700000;}
elseif($user['level'] == 32){ $exp = 1850000;}
elseif($user['level'] == 33){ $exp = 2000000;}
elseif($user['level'] == 34){ $exp = 2150000;} //+300k
elseif($user['level'] == 35){ $exp = 2450000;}
elseif($user['level'] == 36){ $exp = 2750000;}
elseif($user['level'] == 37){ $exp = 3050000;}
elseif($user['level'] == 38){ $exp = 3350000;}
elseif($user['level'] == 39){ $exp = 3900000;} //+500k
elseif($user['level'] == 40){ $exp = 4400000;}
elseif($user['level'] == 41){ $exp = 4900000;}
elseif($user['level'] == 42){ $exp = 5400000;}
elseif($user['level'] == 43){ $exp = 5900000;}
elseif($user['level'] == 44){ $exp = 7000000;}
elseif($user['level'] == 45){ $exp = 10000000;}
elseif($user['level'] == 46){ $exp = 15000000;}
elseif($user['level'] == 47){ $exp = 25000000;}
elseif($user['level'] == 48){ $exp = 40000000;}
elseif($user['level'] == 49){ $exp = 65000000;}
elseif($user['level'] >= 50){ $exp = 100000000;}

if($user['level'] < 15){
$exp1 = ($exp);
}elseif($user['level'] >= 15 && $user['level'] < 20){
$exp1 = ($exp*2);
}elseif($user['level'] >= 20 && $user['level'] < 21){
$exp1 = ($exp*4);
}elseif($user['level'] >= 21 && $user['level'] < 25){
$exp1 = ($exp*10);
}elseif($user['level'] >= 25 && $user['level'] < 30){
$exp1 = ($exp*20);
}elseif($user['level'] >= 30 && $user['level'] < 35){
$exp1 = ($exp*100);
}elseif($user['level'] >= 35 && $user['level'] < 40){
$exp1 = ($exp*500);
}elseif($user['level'] >= 40 && $user['level'] < 45){
$exp1 = ($exp*2000);
}elseif($user['level'] >= 45 && $user['level'] < 50){
$exp1 = ($exp*5000);
}elseif($user['level'] >= 50 && $user['level'] < 100){
$exp1 = ($exp*(100*($user['level']*10)));
}

$exp_progress = round(100/($exp1/$user['exp']));
if($exp_progress > 100) {$exp_progress = 100;}





echo '<a href="'.$HOME.'"><div class="msg mrg_msg3 mt9 c_brown"><div class="wr_bg"><div class="wr_c1"><div class="wr_c2"><div class="wr_c3"><div class="wr_c4"><span class="green_dark bold">
<table class="small h24 bold"><tbody><tr>
<td class="vm plr5 c_brown3 nwr pt2"><img class="vm mb3" src="/images/ico16-up.png" height="18" width="17" alt="">'.$user['level'].'</td>
<td class="vm w100"><div class="prg"><div class="end"><div class="rate" style="width:'.$exp_progress.'%;"><div class="rr"><div class="rl"></div></div></div></div></div></td>
<td class="vm plr5 c_brown3">'.$exp_progress.'%</td>
</tr></tbody></table>
</span></div></div></div></div></div></div></a>'; // прогресс уровня


$pm_col_st_0 = mysql_result(mysql_query('SELECT COUNT(*) FROM `pm_msg` WHERE `ank` = "'.$user['id'].'" and `status` = "0" '),0);
if($pm_col_st_0>0){
echo '<div class="msg mrg_msg1 mt5 c_brown"><div class="wr_bg"><div class="wr_c1"><div class="wr_c2"><div class="wr_c3"><div class="wr_c4"><span class="darkgreen_link"><div class="bordered"><div class="mt4 center">
<img class="price_img" src="/images/mail.gif"><a href="'.$HOME.'pm/"><span class="green_text">Новое сообщение</span></a> <font color=red>(+'.$pm_col_st_0.')</font>
</div></div></span></div></div></div></div></div></div>';
//echo '<center><img class="price_img" src="/images/mail.gif"><span class="green_text">Новое сообщение</span> <font color=red>+'.$pm_col_st_0.'</font></center>';
}




echo '<div class="ttl-m lblue mrg_ttl mt10 mb10"><div class="tr"><div class="tc"><font size=3 color=red>Ваш аккаунт заблокирован!</font></div></div></div>';



echo '<div class="msg mrg_msg1 mt10 c_brown4">
<div class="wr_bg"><div class="wr_c1"><div class="wr_c2"><div class="wr_c3"><div class="wr_c4">
<div class="left font_14 pet_profile_stat">';
echo '<div class="stat_item"><font color=black>Причина:</font> '.$ban['prich'].' </div>';
echo '<div class="stat_item"><font color=black>Закончится через:</font> <img class="price_img" src="/images/clock.png"> <span id="time_'.($ban['time_end']-time()).'000">'._time($ban['time_end']-time()).'</span></div>';
echo '</div></div></div></div></div></div></div>';
echo'</div></div></div></div></div></div></div>'; 




echo '<div class="marea mt10"><div class="wr_bg"><div class="wr_c1"><div class="wr_c2"><div class="wr_c3"><div class="wr_c4">
		<div class="mbtn"><div class="mb_r"><div class="mb_c"><a href="'.$HOME.'ban.php" class="mb_ttl back">Обновить</a></div></div></div>
</div></div></div></div></div></div>';
require_once ('system/footer.php');
?> 