<?php
$title = 'Прошедшие спецзадания';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']) {header('Location: /');exit();}
if($user['company']<=0) {header('Location: /');exit();}

 
$rc_u_a = $mysqli->query('SELECT * FROM `company_user_assault` WHERE `user` = '.$user['id'].' LIMIT 1');
$c_u_a = $rc_u_a->fetch_assoc();


$max = 5;
$res = $mysqli->query("SELECT COUNT(*) FROM `company_pastassaults` WHERE `company` = '".$user['company']."' ");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$c_pu_ = $mysqli->query('SELECT * FROM `company_pastassaults` WHERE `company` = '.$user['company'].' ORDER BY `time` desc LIMIT '.$start.','.$max.' ');
while ($c_pu = $c_pu_->fetch_array()){
$a_ = $mysqli->query('SELECT * FROM `assault` WHERE `id` = '.$c_pu['assault'].' LIMIT 1');
$a = $a_->fetch_assoc();

$c_p_u_ = $mysqli->query('SELECT * FROM `company_pastassaults_user` WHERE `id_battle` = "'.$c_pu['id_battle'].'" and `user` = "'.$user['id'].'" LIMIT 1');
$c_p_u = $c_p_u_->fetch_assoc();

$col_u_ = $mysqli->query("SELECT COUNT(*) FROM `company_pastassaults_user` WHERE `id_battle` = ".$c_pu['id_battle']." ");
$col_u = $col_u_->fetch_array(MYSQLI_NUM);

$col_u_d_ = $mysqli->query("SELECT COUNT(*) FROM `company_pastassaults_user` WHERE `id_battle` = ".$c_pu['id_battle']." and `dead` = '0' ");
$col_u_d = $col_u_d_->fetch_array(MYSQLI_NUM);

echo '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">

<div class="small bold cntr gray1 sh_b mt2">
<div class="white">
<div class="mb5">Закончилось '.time_last($c_pu['time']).'</div>';



if($c_pu['pobeda']!=0){
echo '<img src="/images/icons/victory.png"> <span class="green1">'.$a['name'].' уничтожен!</span> <img src="/images/icons/victory.png">';
}else{
echo '<img src="/images/icons/defeat.png"> <span class="red1">'.$a['name'].' НЕ уничтожен!</span> <img src="/images/icons/defeat.png">';
}


echo '<div><img src="/images/assault/'.$a['id'].'.png"></div><div class="white">';




if($c_p_u){
if($c_pu['pobeda']==0){
echo '<div>Уничтожено всего: '.($c_u_a[''.$c_pu['assault'].'_coll']).'</div>';
}
echo '<span class="yellow1">Мой урон </span>: '.$c_p_u['uron'].'<br>';
if($c_pu['pobeda']!=0){
echo '<span class="yellow1">Награда</span>: <span class="nwr"><img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> '.$c_p_u['gold'].' золота</span>';
}
}


echo '</div><br>';







$c_pu_1 = $mysqli->query('SELECT * FROM `company_pastassaults_user` WHERE `id_battle` = '.$c_pu['id_battle'].' and `user` != '.$user['id'].' ORDER BY `uron` desc LIMIT 10');
while ($c_pu1 = $c_pu_1->fetch_array()){
$us_ = $mysqli->query('SELECT * FROM `users` WHERE `id` = '.$c_pu1['user'].' LIMIT 1');
$usr = $us_->fetch_assoc();
if($c_pu['pobeda']!=0){
$g = '<img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> '.$c_pu1['gold'].'';
}
echo '<span class="yellow1">'.$usr['login'].'</span> <span class="nwr">'.$g.' ('.$c_pu1['uron'].')</span><br>';
}








if($c_pu['pobeda']!=0){
if($c_pu['pobeda']==$user['id']){
echo '<br><span class="yellow1">Вы добили '.$a['name'].'</span> <span class="nwr"><img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> 1</span>';
}else{
$us__ = $mysqli->query('SELECT * FROM `users` WHERE `id` = '.$c_pu['pobeda'].' LIMIT 1');
$u_s = $us__->fetch_assoc();
echo '<br><span class="yellow1">'.$u_s['login'].'</span> <span class="nwr">добил '.$a['name'].' <img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> 1</span>';
}
}








if($c_pu['pobeda']!=0){echo '<br>';}
echo '<span class="gray1">Сражались: <span class="green1">'.$col_u[0].'</span> | Выжили: <span class="red1">'.$col_u_d[0].'</span></span>';
if($c_pu['pobeda']!=0){
echo '<br><span class="gray1">Победа!</span>';
}else{
if($col_u_d[0]<=0){echo '<br><span class="gray1">Взвод уничтожен</span>';}else{echo '<br><span class="gray1">Вышло время!</span>';}
}










echo '</div>
</div></div></div></div></div></div></div></div></div></div></div>';





}


echo '<a w:id="backToAssault" class="simple-but gray mt10" href="/company/assault/"><span><span>Назад</span></span></a>';


require_once ('../system/footer.php');
?>