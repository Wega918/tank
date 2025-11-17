<?php
$title = 'Турнир';
//-----Подключаем функции-----//
require_once ('../system/function.php');
//-----Подключаем вверх-----//
require_once ('../system/header.php');
//-----Если гость,то...----//
if(!$user['id']) {
header('Location: /');
exit();
}
/* if($prom['time_19']<time()){
header('Location: /');
exit();
} */

$id = abs(intval($_GET['id']));
if($id<=0 or $id>2){
header('Location: /');
exit();
}

/* $res = $mysqli->query('SELECT * FROM `prom` WHERE `id` = "1" limit 1');
$prom = $res->fetch_assoc();
if($prom['time_19']<time()){
header('Location: /');
exit();
} */


/* $res112 = $mysqli->query('SELECT * FROM `users` WHERE `id` ORDER BY `id` desc LIMIT 50');
while ($us = $res112->fetch_array()){
$snowball = rand(1000,5000000);
$snowball_b = rand(1,1000);
$mysqli->query('INSERT INTO `dm_year_turnir` SET `user` = "'.$us['id'].'", `snowball` = "'.$snowball.'" , `snowball_b` = "'.$snowball_b.'" ');
}  */

if($id==1){
echo '<table><tbody><tr>
<td style="width:50%;padding:0 3px;"><a class="simple-but gray" href="/dm_year/turnir/1/"><span><span>Белые снежки</span></span></a></td>
<td style="width:50%;padding:0 3px;"><a class="simple-but blue" href="/dm_year/turnir/2/"><span><span>Голубые снежки</span></span></a></td>
</tr></tbody></table>';





echo '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">';
echo '<div class="green2 mt10 sh_b bold">Турнир белых снежок:</div>';
echo '<table class="mt5 ta_l"><tbody>';
$max = 10;
$res = $mysqli->query("SELECT COUNT(*) FROM `dm_year_turnir` WHERE `user` != '0' ");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$res11 = $mysqli->query('SELECT * FROM `dm_year_turnir` WHERE `user` != "0" ORDER BY `snowball` desc LIMIT '.$start.','.$max.' ');
while ($log = $res11->fetch_array()){
$format_c=str_replace('green2','yellow1',nick($log['user']));
echo '<tr w:id="lucks"><td class="va_m w100">'.$format_c.'</td><td class="small bold va_m white nwr pl5 ta_r">
 <img height="20" width="20" title="Белые снежки" alt="Белые снежки" src="/images/snowball.png"> '.$log['snowball'].'';
//if($user['position']>=4){
echo ' | <img title="Серебро" alt="Серебро" src="/images/icons/silver.png"> '.floor($log['snowball']/10).'';
//}
echo '</td></tr>';
}

echo '</tr></tbody></table>';
if ($k_page > 1) {
echo str('/dm_year/turnir/1/?',$k_page,$page); // Вывод страниц
}
echo '</div></div></div></div></div></div></div></div></div></div>';












}else{
echo '<table><tbody><tr>
<td style="width:50%;padding:0 3px;"><a class="simple-but blue" href="/dm_year/turnir/1/"><span><span>Белые снежки</span></span></a></td>
<td style="width:50%;padding:0 3px;"><a class="simple-but gray" href="/dm_year/turnir/2/"><span><span>Голубые снежки</span></span></a></td>
</tr></tbody></table>';





echo '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">';
echo '<div class="green2 mt10 sh_b bold">Турнир синих снежок:</div>';
echo '<table class="mt5 ta_l"><tbody>';
$max = 10;
$res = $mysqli->query("SELECT COUNT(*) FROM `dm_year_turnir` WHERE `user` != '0' ");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$res11 = $mysqli->query('SELECT * FROM `dm_year_turnir` WHERE `user` != "0" ORDER BY `snowball_b` desc LIMIT '.$start.','.$max.' ');
while ($log = $res11->fetch_array()){
$format_c=str_replace('green2','yellow1',nick($log['user']));
echo '<tr w:id="lucks"><td class="va_m w100">'.$format_c.'</td><td class="small bold va_m white nwr pl5 ta_r">
<img height="20" width="20" title="Голубые снежки" alt="Голубые снежки" src="/images/snowball_b.png"> '.$log['snowball_b'].' ';
//if($user['position']>=4){
echo '| <img title="Золото" alt="Золото" src="/images/icons/gold.png?1"> '.floor($log['snowball_b']/2).'';
//}
echo '</td></tr>';
}

echo '</tr></tbody></table>';
if ($k_page > 1) {
echo str('/dm_year/turnir/2/?',$k_page,$page); // Вывод страниц
}
echo '</div></div></div></div></div></div></div></div></div></div>';

}





?>
<a class="simple-but gray mb5" w:id="chatRulesLink" href="#vrag" onClick="document.getElementById('pokazat1').style.display='none';document.getElementById('skryt1').style.display='';return false;"><span><span>Правила турниров</span></span></a>
<?
///###############################################################################################################################################


///###############################################################################################################################################
?>
<div id="pokazat1"></div>


<div id="skryt1" style="display:none">

 
<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">Правила турниров:</div><div class="dhr a_w50 mt5 mb5"></div>
<div class="small white pb5"> 
&nbsp; - Во время акции "Игра в снежки" проводятся 2 турнира.<br><div class="mt5"></div>
&nbsp; - Для участия вам необходимо "играть в снежки", наносить урон и убивать врагов.<br><div class="mt5"></div>
&nbsp; - Весь нанесенный урон и кол-во убитых врагов будет суммироваться до конца акции.<br><div class="mt5"></div>
&nbsp; - По итогам акции участники получат <img title="Серебро" alt="Серебро" src="/images/icons/silver.png"> серебро и <img title="Золото" alt="Золото" src="/images/icons/gold.png?1"> золото 
по соотношениям:<br>
100 <img height="20" width="20" title="Белые снежки" alt="Белые снежки" src="/images/snowball.png"> белых снежок = 1 <img title="Серебро" alt="Серебро" src="/images/icons/silver.png"> серебра<br>
5 <img height="20" width="20" title="Голубые снежки" alt="Голубые снежки" src="/images/snowball_b.png"> голубых снежок = 1 <img title="Золото" alt="Золото" src="/images/icons/gold.png?1"> золота
<div class="mt5"></div>
</div>
</div></div></div></div></div></div></div></div></div></div>

<a class="simple-but gray mb5" w:id="chatRulesLink" href="#vrag" onClick="document.getElementById('skryt1').style.display='none';document.getElementById('pokazat1').style.display='';return false;"><span><span>Скрыть</span></span></a>
</div><?
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////




echo '<a w:id="backToPve" class="simple-but gray mt5" href="/dm_year/"><span><span>Назад к сражениям</span></span></a>';
require_once ('../system/footer.php');
?>