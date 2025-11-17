<?
$title = 'Без дивизии';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']) {
header('Location: /');
exit();
} 

echo '<table><tbody><tr>
<td class="tab4" w:id="td"><a class="simple-but blue" w:id="link" href="/online/"><span><span><img w:id="image" src="/images/icons/online.png"><b> Онлайн</b></span></span></a></td>
<td class="tab4 active" w:id="td"><a class="simple-but blue selected" w:id="link" href="/NotInClan/"><span><span><img w:id="image" src="/images/icons/offline.png"><b> Без дивизии</b></span></span></a></td>
<td class="tab4" w:id="td"><a class="simple-but blue" w:id="link" href="/search/"><span><span><img w:id="image" src="/images/icons/accuracy.jpg" style="width:auto; border-radius: 9px;"><b> Поиск</b></span></span></a></td>
</tr></tbody></table>';





$res1 = $mysqli->query('SELECT * FROM `settings` WHERE `id` = "1" ');
$sql = $res1->fetch_assoc();




$res = $mysqli->query("SELECT COUNT(*) FROM `company_zayavki` WHERE `time` >= ".time()." and `ank` = '0' and `user` in (select user from users_tanks) ");
$k_post1 = $res->fetch_array(MYSQLI_NUM);
if($k_post1[0]>0){
echo '<div class="small bold white sh_b mb2 cntr">Хотят в дивизию</div>';
$max = 10;
$res = $mysqli->query("SELECT COUNT(*) FROM `company_zayavki` WHERE `time` >= ".time()." and `ank` = '0' and `user` in (select user from users_tanks) ");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$res = $mysqli->query('SELECT * FROM `company_zayavki` WHERE `time` >= '.time().' and `ank` = "0" and `user` in (select user from users_tanks) ORDER BY `time` desc LIMIT '.$start.','.$max.' ');
while ($t_r = $res->fetch_array()){
$res2 = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$t_r['user'].'" ');
$traning = $res2->fetch_assoc();
$res1 = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$t_r['user'].'" ');
$us = $res1->fetch_assoc();
$reyt = ''.$k_post[0]++.'';
if($us['side'] == 1){$side = 'federation';}else{$side = 'empire';}
if($us['viz'] > time()-$sql['online']){$viz = '';}else{$viz = '_off';}
if($reyt % 2){
if($us['id'] == $user['id']){$test = 'odd my';}else{$test = 'even';}
}else{
if($us['id'] == $user['id']){$test = 'odd my';}else{$test = 'odd';}
}
echo '<table class="tlist white sh_b bold small mb0"><tbody><tr w:id="users" class="'.$test.'">
<td class="num">'.$reyt.'</td>
<td class="va_m usr w100"><a class="white" w:id="profileLink" href="/profile/'.$us['id'].'/"><img class="vb" height="14" width="14" src="/images/side/'.$side.'/'.$traning['rang'].''.$viz.'.png?1"> <span class="green2" w:id="login">'.$us['login'].'</span> <br></td>
<td class="va_m nwr p5 ta_r"><img class="vb" height="14" width="14" src="/images/icons/exp.png"> '.$us['level'].'</td>
</tr></tbody></table>';
}

if ($k_page > 1) {
echo str(''.$HOME.'NotInClan/?',$k_page,$page); // Вывод страниц
}
echo '<br>';
}



















echo '<div class="small bold white sh_b mb2 cntr">Без дивизии</div>';
$res = $mysqli->query("SELECT COUNT(*) FROM `users` WHERE `company` <= '0' and `id` in (select user from users_tanks) ");
$k_post1 = $res->fetch_array(MYSQLI_NUM);
if($k_post1[0]>0){
$max = 10;
$res = $mysqli->query("SELECT COUNT(*) FROM `users` WHERE `company` <= '0' and `id` in (select user from users_tanks)");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$res = $mysqli->query('SELECT * FROM `users` WHERE `company` <= "0" and `id` in (select user from users_tanks) ORDER BY `level` desc LIMIT '.$start.','.$max.' ');
while ($t_r = $res->fetch_array()){
$res2 = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$t_r['id'].'" ');
$traning = $res2->fetch_assoc();

if(!$traning){
$traning = 1;
}


$res1 = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$t_r['id'].'" ');
$us = $res1->fetch_assoc();
$reyt = ''.$k_post[0]++.'';
if($us['side'] == 1){$side = 'federation';}else{$side = 'empire';}
if($us['viz'] > time()-$sql['online']){$viz = '';}else{$viz = '_off';}
if($reyt % 2){
if($us['id'] == $user['id']){$test = 'odd my';}else{$test = 'even';}
}else{
if($us['id'] == $user['id']){$test = 'odd my';}else{$test = 'odd';}
}
echo '<table class="tlist white sh_b bold small mb0"><tbody><tr w:id="users" class="'.$test.'">
<td class="num">'.$reyt.'</td>
<td class="va_m usr w100"><a class="white" w:id="profileLink" href="/profile/'.$us['id'].'/"><img class="vb" height="14" width="14" src="/images/side/'.$side.'/'.$traning['rang'].''.$viz.'.png?1"> <span class="green2" w:id="login">'.$us['login'].'</span> <br></td>
<td class="va_m nwr p5 ta_r"><img class="vb" height="14" width="14" src="/images/icons/exp.png"> '.$us['level'].'</td>
</tr></tbody></table>';
}

if ($k_page > 1) {
echo str('/NotInClan/?',$k_page,$page); // Вывод страниц
}
}







require_once ('../system/footer.php');
?>