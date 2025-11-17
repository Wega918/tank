<?php
$title = 'Статистика';
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

$res_company_sum_gold = mysqli_query($mysqli,'SELECT sum(company_gold_where) FROM company_user WHERE `company` = "'.$company['id'].'" ');
if (FALSE === $res_company_sum_gold) die("Select sum failed: ".mysqli_error);
$row = mysqli_fetch_row($res_company_sum_gold);
$sum_gold = $row[0];

echo '<div class="trnt-block mb6">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="white small bold sh_b mb5 cntr">
Время обнуления статистики: <span class="green2" w:id="resetTime">'.vremja($company['time_obnul_gold']).'</span><br>
Всего золота после обнуления: <img class="price_img_" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.$sum_gold.'

</div>
</div>
</div></div></div></div></div></div></div></div>
</div>';









$res = $mysqli->query('SELECT * FROM `settings` WHERE `id` = "1" limit 1');
$sql = $res->fetch_assoc();

echo '<table class="tlist white sh_b bold small mb10"><tbody>';
$max = 50;
$res = $mysqli->query("SELECT COUNT(*) FROM `company_user` WHERE `company` = ".$company['id']." ");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$res_reit_us = $mysqli->query('SELECT * FROM `company_user` WHERE `company` = '.$company['id'].' ORDER BY `company_gold_where` desc LIMIT '.$start.','.$max.' ');
while ($us = $res_reit_us->fetch_array()){
$res2 = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$us['user'].'" ');
$traning = $res2->fetch_assoc();
$res_user = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$us['user'].'" ');
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
<a class="white" w:id="profileLink" href="/profile/'.$us_['id'].'"><img class="vb" height="14" width="14" src="/images/side/'.$side.'/'.$traning['rang'].''.$viz.'.png?1"> '.$us_['login'].', '.$company_rang.', <img class="ico vm" src="/images/icons/gold.png" alt="Золото" title="Золото"> '.n_f($us['company_gold_where']).'</a>
</td></tr>';
}

echo '</tbody></table>';




if($company_user['company_rang'] <= 2){
echo '<a class="simple-but gray mb5" w:id="donateStatsLink" href="?obnul"><span><span>Обнулить статистику</span></span></a>';
}
if(isset($_GET['obnul'])){
if($company_user['company_rang'] > 2){header('Location: ?');exit();}
$mysqli->query('UPDATE `company_user` SET `company_gold_where` = "0" WHERE `company` = '.$company['id'].'');
$mysqli->query('UPDATE `company` SET `time_obnul_gold` = "'.time().'" WHERE `id` = '.$company['id'].'');
header('Location: ?');
exit();
}












require_once ('../system/footer.php');
?>