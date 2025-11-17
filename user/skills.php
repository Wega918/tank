<?php
$title = 'Умения';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}
$id = abs(intval($_GET['id']));
$res = $mysqli->query('SELECT * FROM `users` WHERE `id`  = "'.$id.'" LIMIT 1');
$ank = $res->fetch_assoc();
if($ank <= 0){header('Location: /');exit();}
if(!$ank){header('Location: /');exit();}


if($ank['id']!=$user['id']){
echo '<div class="medium bold white cntr sh_b mb5"><div>'.$title.' '.nick($ank['id']).'</div></div>';
}else{
echo '<div class="medium bold white cntr sh_b mb5"><div>'.$title.'</div></div>';
}







$res1 = $mysqli->query('SELECT * FROM `crew_user` WHERE `user`  = "'.$ank['id'].'" and `tip`  = "2" LIMIT 1');
$crew_user = $res1->fetch_assoc();
if($crew_user['rang'] == 1){$rang = 'рядовой';}if($crew_user['rang'] == 2){$rang = 'сержант';}if($crew_user['rang'] == 3){$rang = 'старшина';}if($crew_user['rang'] == 4){$rang = 'младший лейтенант';}if($crew_user['rang'] == 5){$rang = 'лейтенант';}if($crew_user['rang'] == 6){$rang = 'старший лейтенант';}if($crew_user['rang'] == 7){$rang = 'капитан';}if($crew_user['rang'] == 8){$rang = 'майор';}if($crew_user['rang'] == 9){$rang = 'подполковник';}if($crew_user['rang'] == 10){$rang = 'полковник';}
if($ank['id'] == $user['id'] and $crew_user['rang']>1){

if($user['time_crew_fuel']<time()){
echo '<div class="trnt-block" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">';
}elsE{
echo '<div class="trnt-block mb5" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">';
}

echo '<div class="mb5 inbl w100"><div class="thumb fl"><img w:id="image" src="/images/crew/1.png" style="width:100%; border-radius: 9px;"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2" w:id="name">Механик-водитель</span><br>звание: '.$rang.'<br><img class="ico vm" w:id="fuelIcon" src="/images/icons/fuel.png">'.$crew_user['sposobn'].' топлива раз в 20 часов<br></div>
<div class="clrb"></div></div>';

if($user['time_crew_fuel']<time()){
echo '<div class="bot"><a class="simple-but border" w:id="takeFuelLink" href="?act_fuel'.$crew_user['sposobn'].'"><span><span>Забрать топливо</span></span></a><div style="position:relative;"><span class="digit2 esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span></div></div>';
if(isset($_GET['act_fuel'.$crew_user['sposobn'].''])){
if($user['time_crew_fuel']>time()){header('Location: ?');exit();}
if($crew_user['rang']<2){header('Location: ?');exit();}
$mysqli->query('UPDATE `users` SET `time_crew_fuel` = '.(time()+(3600*20)).', `fuel` = '.($user['fuel']+$crew_user['sposobn']).' WHERE `id` = '.$user['id'].'');
$_SESSION['err'] = '<div class="trnt-block mb1"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="green1 sh_b mb2"><img height="14" width="14" src="/images/icons/victory.png"> Топливо получено! <img height="14" width="14" src="/images/icons/victory.png"></div>
</div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}
}else{
if($user['time_crew_fuel']>time()){$prog = round(((3600*20)-($user['time_crew_fuel']-time()))*100/(3600*20));if($prog > 100) {$prog = 100;}}
echo '<table class="rblock blue esmall mb5"><tbody><tr>
<td><div class="value-block lh1"><span><span><img class="vico vm" w:id="fuelIcon" src="/images/icons/fuel.png"> '.$crew_user['sposobn'].'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$prog.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'._time($user['time_crew_fuel']-time()).'</span></span></div></td>
</tr></tbody></table>';
}
}
echo '</div></div></div></div></div></div></div></div></div></div>';















//if($user['id']==1){

/* $rand = rand(1,100);
echo ''.$rand.'';  шанс рикошета*/

/* $rand = ceil(rand(0,($skills_u['bon']/2)));
echo ''.$rand.'';  шанс крита*/





$max = 7;
$res = $mysqli->query("SELECT COUNT(*) FROM `skills` WHERE `id` ");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$res = $mysqli->query('SELECT * FROM `skills` WHERE `id` ORDER BY `id` asc LIMIT '.$start.','.$max.' ');
while ($skills = $res->fetch_array()){
$res1 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "'.$skills['id'].'" and `user`  = "'.$ank['id'].'" ');
$skills_u = $res1->fetch_assoc();
if(!$skills_u){
if($skills['id']==4 ){ // Ремонт 90 сек
$bon = 90;
}elseif($skills['id']==5){ // максимальный урон от крита от 25 до 75% (каждый уровень +1 (26 76 и т.д.))
$bon = 25; 
}else{
$bon = 0; 
}
$mysqli->query('INSERT INTO `skills_user` SET `bon` = "'.$bon.'", `user` = "'.$ank['id'].'", `tip` = "'.$skills['id'].'" ');
header('refresh: 1');
}


// $skills_u['tip']==1 маскировка       с 50 по 75 ур +0,5    = 62,5%
// $skills_u['tip']==2 Рикошет       с 50 по 75 ур +0,3    = 37,5%
// $skills_u['tip']==4 Ремонт       с 40 по 65 ур +1,5    = 27,5 сек

if($skills_u['tip']==2 ){
$bon_t = ''.$skills_u['bon'].'%';
$app = '+0,6%';
$app_ = 0.6; // с 50 по 75 ур +0,3
$max_lvl = 50;
}elseif($skills_u['tip']==4){
$bon_t = ''.$skills_u['bon'].' сек';
$app = '-1 сек';
$app_ = -1; // с 40 по 65 ур +1,5
$max_lvl = 40;
}elseif($skills_u['tip']==5){
$bon_t = 'от '.(25+$skills_u['level']).' до '.(75+$skills_u['level']).'%';
$app = '+1%';
$app_ = 1;
$max_lvl = 45;
}elseif($skills_u['tip']==6){
$bon_t = ''.$skills_u['bon'].'%';
$app = '+2%';
$app_ = 2;
$max_lvl = 50;
}elseif($skills_u['tip']==7){
$bon_t = ''.$skills_u['bon'].'%';
$app = '+2%';
$app_ = 2;
$max_lvl = 50;
}else{
$bon_t = ''.$skills_u['bon'].'%';
$app = '+1%';
$app_ = 1;
$max_lvl = 50;
}




if($skills_u['level'] == 0){$price = 100;}
if($skills_u['level'] == 1){$price = 150;}
if($skills_u['level'] == 2){$price = 250;}
if($skills_u['level'] == 3){$price = 500;}
if($skills_u['level'] == 4){$price = 1000;}
if($skills_u['level'] == 5){$price = 30;}
if($skills_u['level'] == 6){$price = 40;}
if($skills_u['level'] == 7){$price = 50;}
if($skills_u['level'] == 8){$price = 60;}
if($skills_u['level'] == 9){$price = 70;}
if($skills_u['level'] == 10){$price = 60;}
if($skills_u['level'] == 11){$price = 80;}
if($skills_u['level'] == 12){$price = 100;}
if($skills_u['level'] == 13){$price = 120;}
if($skills_u['level'] == 14){$price = 140;}
if($skills_u['level'] == 15){$price = 300;}
if($skills_u['level'] == 16){$price = 400;}
if($skills_u['level'] == 17){$price = 500;}
if($skills_u['level'] == 18){$price = 600;}
if($skills_u['level'] == 19){$price = 700;}
if($skills_u['level'] == 20){$price = 1500;}
if($skills_u['level'] == 21){$price = 2000;}
if($skills_u['level'] == 22){$price = 2500;}
if($skills_u['level'] == 23){$price = 3000;}
if($skills_u['level'] == 24){$price = 3500;}
if($skills_u['level'] == 25){$price = 3000;}//
if($skills_u['level'] == 26){$price = 4000;}
if($skills_u['level'] == 27){$price = 5000;}
if($skills_u['level'] == 28){$price = 6000;}
if($skills_u['level'] == 29){$price = 7000;}
if($skills_u['level'] == 30){$price = 3000;}
if($skills_u['level'] == 31){$price = 4000;}
if($skills_u['level'] == 32){$price = 5000;}
if($skills_u['level'] == 33){$price = 6000;}
if($skills_u['level'] == 34){$price = 7000;}
if($skills_u['level'] == 35){$price = 3000;}
if($skills_u['level'] == 36){$price = 4000;}
if($skills_u['level'] == 37){$price = 5000;}
if($skills_u['level'] == 38){$price = 6000;}
if($skills_u['level'] == 39){$price = 7000;}
if($skills_u['level'] == 40){$price = 3000;}
if($skills_u['level'] == 41){$price = 4000;}
if($skills_u['level'] == 42){$price = 5000;}
if($skills_u['level'] == 43){$price = 6000;}
if($skills_u['level'] == 44){$price = 7000;}
if($skills_u['level'] == 45){$price = 3000;}
if($skills_u['level'] == 46){$price = 4000;}
if($skills_u['level'] == 47){$price = 5000;}
if($skills_u['level'] == 48){$price = 6000;}
if($skills_u['level'] == 49){$price = 7000;}



$res1 = $mysqli->query('SELECT * FROM `prom` WHERE `id` = "1" ');
$prom = $res1->fetch_assoc();

if($prom['time_6']>time()){
$price = ceil($price-($price*$prom['act_6']/100));
}else{
$price = $price;
}





if($skills_u['level'] < 5){
$img = '<img class="ico vm" src="/images/icons/silver.png?2" alt="Серебро" title="Серебро">';
$price_ = 'серебра';
}else{
$img = '<img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото">';
$price_ = 'золота';
}


if($skills_u['tip'] == 1){$img_ = 'camouflage';}
if($skills_u['tip'] == 2){$img_ = 'ricochet';}
if($skills_u['tip'] == 3){$img_ = 'weaknessdetection';}
if($skills_u['tip'] == 4){$img_ = 'repairs';}
if($skills_u['tip'] == 5){$img_ = 'sniper';}
if($skills_u['tip'] == 6){$img_ = 'officers';}
if($skills_u['tip'] == 7){$img_ = 'instructor';}


$img_d = ''.floor(($skills_u['level'])/5).'';








if(isset($_GET['app'.$skills_u['id'].''])){
if($ank['id'] != $user['id']){header('Location: ?');exit();}
if($skills_u['level']>=$max_lvl){header('Location: ?');exit();}

if($skills_u['level'] < 5){
if($user['silver'] < $price){
$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.($price-$user['silver']).' серебра</div></div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');exit();}
}else{
if($user['gold'] < $price){
$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($price-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');exit();}
}

if($skills_u['level'] < 5){
$mysqli->query('UPDATE `users` SET `silver` = `silver` - '.$price.' WHERE `id` = '.$user['id'].'');
}else{
$mysqli->query('UPDATE `users` SET `gold` = `gold` - '.$price.' WHERE `id` = '.$user['id'].'');
}
$mysqli->query('UPDATE `skills_user` SET `bon` = `bon` + "'.($app_).'", `level` = `level` + "1" WHERE `id` = '.$skills_u['id'].'');

$_SESSION['ses'] = '<div class="green1 sh_b mb2"><img height="14" width="14" src="/images/icons/victory.png"> Умение улучшено! <img height="14" width="14" src="/images/icons/victory.png"></div>
<div class="fs0 mt5 mb5 cD2"><span class="nwr small plr4"><img class="va_m" width="50" height="50" src="/images/skills/'.$img_.'/'.$img_d.'.png"></span></div>
<div class="small green2">'.$skills['name'].'</div>';
header('Location: ?');
exit();
}















if($skills_u['level']<$max_lvl and $ank['id'] == $user['id']){
echo '<div class="trnt-block" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">';
}elsE{
echo '<div class="trnt-block mb5" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">';
}



echo '<div class="mb5 inbl w100"><div class="thumb fl"><img w:id="image" src="/images/skills/'.$img_.'/'.$img_d.'.png" style="width:100%; border-radius: 9px;"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2" w:id="name">'.$skills['name'].'</span>
<br>Текущий бонус: <span class="yellow1">'.$bon_t.'</span>';


if($skills_u['level']<$max_lvl and $ank['id'] == $user['id']){
echo '<br>Цена: <span class="yellow1"> '.$img.' '.$price.' '.$price_.'</span>';
}

echo '<br><div class="small gray1 sh_b mt5">'.$skills['text'].'</div></div><div class="clrb"></div></div>';

if($skills_u['level']<$max_lvl and $ank['id'] == $user['id']){
echo '<div class="bot"><a class="simple-but border" w:id="takeFuelLink" href="?app'.$skills_u['id'].'"><span><span>Улучшить '.$app.'</span></span></a><div style="position:relative;"></div></div>';
}
echo '</div></div></div></div></div></div></div></div></div></div>';


}















//}





echo '<div class="trnt-block mb2">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">Хорошо прокачанные умения, сделают вас асом на полях сражений!</div>

</div>
</div></div></div></div></div></div></div></div>
</div>';

if($ank['id'] == $user['id'] ){
echo '<a class="simple-but border mb2" w:id="powerLink" href="/profile/'.$ank['id'].'/"><span><span>Назад</span></span></a>';
}else{
echo '<a class="simple-but border mb2" w:id="powerLink" href="/power/'.$ank['id'].'/"><span><span>Назад</span></span></a>';
}
require_once ('../system/footer.php');
?>