<?php
$title = 'Лучшие танкисты';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}

echo '<table><tbody><tr>
<td style="width:50%;padding:0 3px;"><a class="simple-but gray" href="/rating/bz_eggs/"><span><span>Пасхальные яйца</span></span></a></td>
<td style="width:50%;padding:0 3px;"><a class="simple-but blue" href="/rating/bz_miss/"><span><span>Выполненные задания</span></span></a></td>
</tr></tbody></table>';



$res = $mysqli->query('SELECT * FROM `bz_user` WHERE `id` ORDER BY `eggs` desc LIMIT 100000');
while ($usr = $res->fetch_array()){
$reyt = ''.++$k_post[0].'';
if($usr['user'] == $user['id']){
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<table class="white sh_b bold small mb0"><tbody><tr>
<td class="va_m usr w100 pl5">'.$reyt.' '.nick($usr['user']).'</td>
<td class="va_m nwr p5 ta_r"><img class="vb" height="14" width="20" src="/images/paska_.png"> '.$usr['eggs'].'</td>
</tr></tbody></table>
</div></div></div></div></div></div></div></div></div></div>';
}
}





echo '<div class="white medium cntr bold mb2">Лучшие по собранным пасхальным яйцам</div>';





$max = 10;
$res = $mysqli->query("SELECT COUNT(*) FROM `bz_user` WHERE `id` ");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$res = $mysqli->query('SELECT * FROM `bz_user` WHERE `id` ORDER BY `eggs` desc LIMIT '.$start.','.$max.' ');
while ($usr = $res->fetch_array()){
$reyt = ''.$k_post[0]++.'';
$format_c=str_replace('green2','small green2 sh_b mb5',nick($usr['user']));

if($reyt % 2){
if($usr['user'] == $user['id']){$test = 'odd my';}else{$test = 'odd';}
}else{
if($usr['user'] == $user['id']){$test = 'odd my';}else{$test = 'even';}
}
echo '<table class="tlist white sh_b bold small mb0"><tbody><tr w:id="users" class="'.$test.'">
<td class="num">'.$reyt.'</td>
<td class="va_m usr w100">'.$format_c.'</td>
<td class="va_m nwr p5 ta_r"><img class="vb" height="14" width="20" src="/images/paska_.png"> '.$usr['eggs'].'</td>
</tr></tbody></table>';


}
if ($k_page > 1) {
echo str('/rating/bz_eggs/?',$k_page,$page); // Вывод страниц
}

echo '<a w:id="backToPve" class="simple-but gray mt10" href="/xprom/20/"><span><span>Назад</span></span></a>';
require_once ('../system/footer.php');
?>