<?php
$title = 'Золото';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}
$res = $mysqli->query('SELECT * FROM `prom` WHERE `id` = 1 LIMIT 1');
$prom = $res->fetch_assoc();

echo'<div class="medium white bold cntr mb2">Купить золото</div>
<div class="white small bold cntr mb5">
<span class="nwr"><img class="ico vm" height="14" width="14" src="/images/icons/gold.png"> 100 золота = 10 рублей</span>
</div>';

//<a class="white" w:id="trainingLink" href="/"><img class="thumb" src="/images/xsolla.jpg">Xsolla</a>
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="small green2 sh_b bold cntr mb10">Способы оплаты:</div>';




echo '<table class="tlist white sh_b bold small mb0"><tbody>

<tr w:id="users" class="">
<td class="va_m usr w100"> Карта ВТБ <font color=grey>(руб)</font></td>
<td class="va_m nwr p5 ta_r"> 6769 0700 7822 8633</td>
</tr>

<tr w:id="users" class="">
<td class="va_m usr w100"> Карта Приват <font color=grey>(грн)</font></td>
<td class="va_m nwr p5 ta_r"> 5168 7453 0371 5699</td>
</tr>

<tr w:id="users" class="">
<td class="va_m usr w100"> Qiwi кошелек</td>
<td class="va_m nwr p5 ta_r"> +79123875983</td>
</tr>

</tbody></table>';


/* 
echo '<table class="small">
<tbody><tr>
<table class="prf-btns esmall bold">
<tbody><tr>
<td></td>
<td><a class="white" w:id="crewLink" href="'.$HOME.'worldkassa/buy.php"><img class="thumb" src="/images/worldkassa.jpg">Worldkassa</a></td>
</tr></tbody></table></tr>

</tbody></table>'; */
echo '</div></div></div></div></div></div></div></div></div></div>';









$max = 6;
$res = $mysqli->query("SELECT COUNT(*) FROM `tanks` WHERE `id` ");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$res = $mysqli->query('SELECT * FROM `tanks` WHERE `id` ORDER BY `id` asc LIMIT '.$start.','.$max.' ');
while ($r = $res->fetch_array()){
if($r['id']==1){$key = 100;$value = 10;$bonus = 3;}
if($r['id']==2){$key = 200;$value = 20;$bonus = 5;}
if($r['id']==3){$key = 500;$value = 50;$bonus = 25;}
if($r['id']==4){$key = 1000;$value = 100;$bonus = 75;}
if($r['id']==5){$key = 5000;$value = 500;$bonus = 500;}
if($r['id']==6){$key = 10000;$value = 1000;$bonus = 1250;}
/* if($prom['time_1'] > time()){
$act = '<div class="ml58 pt1"><span class="white"><span class="nwr">
<img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> '.$key.' золота | '.$value.' руб</span></span>
<div class="green1 pt2"><span class="nwr"><img class="ico vm" height="14" width="14" src="/images/icons/gold.png?1"> +'.$bonus.' в подарок!</span></div>
<div class="green1 pt2"><span class="nwr"><img class="ico vm" height="14" width="14" src="/images/icons/gold.png?1"> +'.($key*$prom['act_1']/100).' в подарок по акции!</span></div>';
}elseif($prom['time_1'] > time() and $prom['time_4'] > time()){
$act = '<div class="ml58 pt1"><span class="white"><span class="nwr">
<img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> '.$key.' золота | '.$value.' руб</span></span>
<div class="green1 pt2"><span class="nwr"><img class="ico vm" height="14" width="14" src="/images/icons/gold.png?1"> +'.$bonus.' в подарок!</span></div>
<div class="green1 pt2"><span class="nwr"><img class="ico vm" height="14" width="14" src="/images/icons/silver.png?1"> +'.($key*$prom['act_4']/100).' в подарок по акции!</span></div>';
}elseif($prom['time_4'] > time()){
$act = '<div class="ml58 pt1"><span class="white"><span class="nwr">
<img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> '.$key.' золота | '.$value.' руб</span></span>
<div class="green1 pt2"><span class="nwr"><img class="ico vm" height="14" width="14" src="/images/icons/gold.png?1"> +'.$bonus.' в подарок!</span></div>
<div class="green1 pt2"><span class="nwr"><img class="ico vm" height="14" width="14" src="/images/icons/silver.png?1"> +'.($key*$prom['act_4']/100).' в подарок по акции!</span></div>';
}else{
$act = '<div class="ml58 pt5"><span class="white"><span class="nwr">
<img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> '.$key.' золота | '.$value.' руб</span></span>
<div class="green1 pt5"><span class="nwr"><img class="ico vm" height="14" width="14" src="/images/icons/gold.png?1"> +'.$bonus.' в подарок!</span></div>';
}
 */




echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr bold">
<div class="inbl ta_l mb5 nwr small pt2"><img class="fl" width="50" height="50" src="/images/gold-bonus/'.$r['id'].'.png" style="border-radius: 10px;">';

echo '<div class="ml58 pt1"><span class="white"><span class="nwr">
<img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> '.$key.' золота  | '.$value.' руб</span></span>
<div class="green1 pt2"><span class="nwr"><img class="ico vm" height="14" width="14" src="/images/icons/gold.png?1"> +'.$bonus.' в подарок!</span></div>';

if($prom['time_1'] > time()){echo '<div class="green1 pt2"><span class="nwr"><img class="ico vm" height="14" width="14" src="/images/icons/gold.png?1"> +'.($key*$prom['act_1']/100).' в подарок по акции!</span></div>';}
if($prom['time_4'] > time()){echo '<div class="green1 pt2"><span class="nwr"><img class="ico vm" height="14" width="14" src="/images/icons/silver.png?1"> +'.($key*$prom['act_4']/100).' в подарок по акции!</span></div>';}

echo '</div>
<div class="clrb"></div></div>

</div></div></div></div></div></div></div></div></div></div>';
}//<a class="simple-but border mb2" target="_blank" href="/worldkassa/index.php?gold='.$key.'"><span><span>Купить за '.$value.' руб</span></span></a>





echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">';

echo '<div class="medium cntr mb2"><div class="yellow1" href="/forum/">
<font size=2%>Выбрав способ оплаты, необходимо вручную перевести средства на выбранный кошелек и сообщить <a href="https://mtank.ru/profile/1/">администратору</a> время и сумму перевода. 
<br>
Платеж будет обработан в течении 1 часа в рабочее время.</font>
</div> </div>';
echo '</div></div></div></div></div></div></div></div></div></div>';






echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">По вопросам оплаты с других стран, или по другим способам оплаты, пишите <a href="https://mtank.ru/profile/1/">сюда</a></div>
</div></div></div></div></div></div></div></div></div></div>';

/* echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">По вопросам оплаты с других стран, или по другим способам оплаты, пишите <a href="https://mtank.ru/profile/1/">сюда</a></div>
</div></div></div></div></div></div></div></div></div></div>'; */
require_once ('../system/footer.php');
?>