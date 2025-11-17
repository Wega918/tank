<?php
$title = 'Аватарки';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}
echo '<div class="p5"><div class="medium white bold cntr mb2">'.$title.'</div></div>';

echo '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<table><tbody>';

//$mysqli->query('INSERT INTO `avatars` SET `sex` = "2",`images` = "1" ');


$max = 10;
$res = $mysqli->query("SELECT COUNT(*) FROM `avatars` WHERE `sex` = ".$user['sex']." ");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$res = $mysqli->query('SELECT * FROM `avatars` WHERE `sex` = "'.$user['sex'].'" ORDER BY `images` asc, `id` asc LIMIT '.$start.','.$max.' ');
while ($ava = $res->fetch_array()){

$res1 = $mysqli->query('SELECT * FROM `avatars_user` WHERE `images` = "'.$ava['images'].'" and `user` = "'.$user['id'].'" ');
$ava_us = $res1->fetch_assoc();

$reyt = ''.$k_post[0]++.'';

if($reyt==1 or $reyt==3 or $reyt==5 or $reyt==7 or $reyt==9 or $reyt==11 or $reyt==13 or $reyt==15 or $reyt==17 or $reyt==19 or $reyt==21 or $reyt==23 or $reyt==25 or $reyt==27 or $reyt==29
or $reyt==31 or $reyt==33 or $reyt==35 or $reyt==37 or $reyt==39 or $reyt==41 or $reyt==43 or $reyt==45 or $reyt==47 or $reyt==49){
echo '<tr w:id="twoAvatars">';
}
echo '<td class="pr5 pt2 pb5 w50">
<div class="thumb m0a pb2"><img alt="avatar" src="/images/avatar/'.$ava['images'].'" style="width:100%; border-radius: 9px;"><span class="mask2">&nbsp;</span></div>';

if(!$ava_us){
echo '<a class="simple-but mb2" href="/avatarspay/'.$ava['id'].'/'.$page.'/"><span><span>Купить </span></span></a>';
}elseif($ava_us['act']==0){
echo '<a class="simple-but gray" href="/avatarsact/'.$ava['id'].'/'.$page.'/"><span><span>Установить</span></span></a>';
}elseif($ava_us['act']==1){
echo '<a class="simple-but gray" ><span><span>Активен</span></span></a>';
}

echo '<div class="small bold sh_b gray1 cntr">Цена <img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> '.$ava['gold'].'</div>
</td>';
if($reyt==2 or $reyt==4 or $reyt==6 or $reyt==8 or $reyt==10 or $reyt==12 or $reyt==14 or $reyt==16 or $reyt==18 or $reyt==20 or $reyt==22 or $reyt==24 or $reyt==26 or $reyt==28 or $reyt==30
or $reyt==32 or $reyt==34 or $reyt==36 or $reyt==38 or $reyt==40 or $reyt==42 or $reyt==44 or $reyt==46 or $reyt==48 or $reyt==50){
echo '</tr>';
}












}
echo '</tbody></table></div></div></div></div></div></div></div></div></div></div>';

if ($k_page > 1) {
echo str('/avatars/?',$k_page,$page); // Вывод страниц
}

echo '<a class="simple-but gray mb5" href="/profile/'.$user['id'].'/"><span><span>Вернуться в личное дело</span></span></a>';
require_once ('../system/footer.php');
?>