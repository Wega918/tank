<?
$title = 'Онлайн';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']) {
header('Location: /');
exit();
} 


echo '<table><tbody><tr>
<td class="tab4 active" w:id="td"><a class="simple-but blue selected" w:id="link" href="/online/"><span><span><img w:id="image" src="/images/icons/online.png"><b> Онлайн</b></span></span></a></td>
<td class="tab4" w:id="td"><a class="simple-but blue" w:id="link" href="/NotInClan/"><span><span><img w:id="image" src="/images/icons/offline.png"><b> Без дивизии</b></span></span></a></td>
<td class="tab4" w:id="td"><a class="simple-but blue" w:id="link" href="/search/"><span><span><img w:id="image" src="/images/icons/accuracy.jpg" style="width:auto; border-radius: 9px;"><b> Поиск</b></span></span></a></td>
</tr></tbody></table>';







$res1 = $mysqli->query('SELECT * FROM `settings` WHERE `id` = "1" ');
$sql = $res1->fetch_assoc();



$max = 10;
$res = $mysqli->query("SELECT COUNT(*) FROM `users` WHERE `viz` > ".(time()-$sql['online'])." and `id` in (select user from users_tanks)  ");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
if($user['position'] >= 5){
$res = $mysqli->query('SELECT * FROM `users` WHERE `viz` > '.(time()-$sql['online']).' and `id` in (select user from users_tanks) ORDER BY `viz` desc LIMIT '.$start.','.$max.' ');
}else{
$res = $mysqli->query('SELECT * FROM `users` WHERE `viz` > '.(time()-$sql['online']).' and `id` in (select user from users_tanks) ORDER BY `level` desc LIMIT '.$start.','.$max.' ');
}
while ($t_r = $res->fetch_array()){
$res2 = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$t_r['id'].'" ');
$traning = $res2->fetch_assoc();

$reyt = ''.$k_post[0]++.'';
if($t_r['side'] == 1){$side = 'federation';}else{$side = 'empire';}
if($t_r['viz'] > time()-$sql['online']){$viz = '';}else{$viz = '_off';}
if($reyt % 2){
if($t_r['id'] == $user['id']){$test = 'odd my';}else{$test = 'even';}
}else{
if($t_r['id'] == $user['id']){$test = 'odd my';}else{$test = 'odd';}
}

if($user['position'] >= 5){
$timer = '<td class="num1">'.time_last($t_r['viz']).'</td>';
}else{
$timer = '';
}

echo '<table class="tlist white sh_b bold small mb0"><tbody><tr w:id="users" class="'.$test.'">
'.$timer.'
<td class="num">'.$reyt.'</td>
<td class="va_m usr w100"><a class="white" w:id="profileLink" href="/profile/'.$t_r['id'].'/"><img class="vb" height="14" width="14" src="/images/side/'.$side.'/'.$traning['rang'].''.$viz.'.png?1"> <span class="green2" w:id="login">'.$t_r['login'].'</span> <br></td>
<td class="va_m nwr p5 ta_r"><img class="vb" height="14" width="14" src="/images/upgrades/starFull.png"> '.$t_r['level'].'</td>
</tr></tbody></table>';
}
if ($k_page > 1) {
echo str('/online/?',$k_page,$page); // Вывод страниц
}


require_once ('../system/footer.php');
?>