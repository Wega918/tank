<?php
$title = 'Журнал';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']) {header('Location: /');exit();}
if($user['company']<=0) {header('Location: /');exit();}



$res = $mysqli->query('SELECT * FROM `settings` WHERE `id` = "1" limit 1');
$sql = $res->fetch_assoc();


$res = $mysqli->query("SELECT COUNT(*) FROM `company_log` WHERE `company` = '".$user['company']."' ");
$k_post1 = $res->fetch_array(MYSQLI_NUM);
if($k_post1[0]>0){
echo '<div class="white medium cntr bold mb5">Журнал дивизии</div>';
$max = 10;
$res = $mysqli->query("SELECT COUNT(*) FROM `company_log` WHERE `company` = '".$user['company']."' ");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$res = $mysqli->query('SELECT * FROM `company_log` WHERE `company` = '.$user['company'].' ORDER BY `id` desc LIMIT '.$start.','.$max.' ');
while ($t_r = $res->fetch_array()){
echo '<div class="white">';



if($t_r['ank']){
$res2 = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$t_r['ank'].'" ');
$traning = $res2->fetch_assoc();
$res_user = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$t_r['ank'].'" ');
$us_ = $res_user->fetch_assoc();
if($us_['side'] == 1){$side = 'federation';}else{$side = 'empire';}
if($us_['viz'] > time()-$sql['online']){$viz = '';}else{$viz = '_off';}
echo '<a href="/profile/'.$t_r['ank'].'/"><img class="vb" height="14" width="14" src="/images/side/'.$side.'/'.$traning['rang'].''.$viz.'.png?1">  <span class="yellow1">'.$us_['login'].'</span></a>';




}elseif($t_r['text']=="<span class='green1'>принят в дивизию</span>"){
$res2 = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$t_r['user'].'" ');
$traning = $res2->fetch_assoc();
$res_user = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$t_r['user'].'" ');
$us_ = $res_user->fetch_assoc();
if($us_['side'] == 1){$side = 'federation';}else{$side = 'empire';}
if($us_['viz'] > time()-$sql['online']){$viz = '';}else{$viz = '_off';}
echo '<a href="/profile/'.$t_r['user'].'/"><img class="vb" height="14" width="14" src="/images/side/'.$side.'/'.$traning['rang'].''.$viz.'.png?1">  <span class="yellow1">'.$us_['login'].'</span></a>';


//echo '<font color=white>Объявление:</font>';
}else{
echo '<font color=white>Объявление:</font>';
}




echo ' '.$t_r['text'].'<br>';
if($t_r['user']){echo ''.nick($t_r['user']).', ';} echo '<span class="gray esmall">'.vremja($t_r['time']).'</span>
</div>
<div class="dhr mt5 mb5"></div>';
}
}else{
echo '<div class="white medium cntr bold mb5">Журнал дивизии</div>';
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">Записей не найдено.</div>
</div></div></div></div></div></div></div></div></div></div>';
}


if ($k_page > 1) {
echo str('/companyevents/?',$k_page,$page); // Вывод страниц
}


require_once ('../system/footer.php');
?>