<?php
$title = 'Администрация';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']) {
header('Location: /');
exit();
}
echo '<div class="medium white bold cntr mb5">'.$title.'</div>';


echo '<table class="mb5"><tbody>';
$res1 = $mysqli->query('SELECT * FROM `settings` WHERE `id` = "1" ');
$sql = $res1->fetch_assoc();
$max = 1000;
$res = $mysqli->query("SELECT COUNT(*) FROM `users` WHERE `position` > '0' ");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$res = $mysqli->query('SELECT * FROM `users` WHERE `position` > "0" ORDER BY `position` desc LIMIT '.$start.','.$max.' ');
while ($t_r = $res->fetch_array()){

if($t_r['position']==1){$position = '<span class="grey" w:id="login">Мл. Модератор</span>';}//удаление смс и игнор
if($t_r['position']==2){$position = '<span class="officer" w:id="login">Модератор</span>';}//удаление смс  игнор и бан
if($t_r['position']==3){$position = '<span class="general" w:id="login">Ст. Модератор</span>';}//удаление смс  игнор и бан, открытие закрытие и удаление топиков
if($t_r['position']==4){$position = '<span class="green2" w:id="login">Администратор</span>';}//создание и редактирование форума
if($t_r['position']==5){$position = '<span class="red1" w:id="login">Разработчик</span>';}//может все

$res2 = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$t_r['id'].'" ');
$traning = $res2->fetch_assoc();
$reyt = ''.$k_post[0]++.'';
if($t_r['side'] == 1){$side = 'federation';}else{$side = 'empire';}
if($t_r['viz'] > time()-$sql['online']){$viz = '';}else{$viz = '_off';}
if($reyt % 2){
$test = '';
}else{
$test = 'odd-bg';
}

echo '<tr class="hr '.$test.'" w:id="users">
<td class="va_m w100 pl5"><a href="/profile/'.$t_r['id'].'/"><img class="" height="14" width="14" src="/images/side/'.$side.'/'.$traning['rang'].''.$viz.'.png?1"> <span class="yellow1" w:id="login">'.$t_r['login'].'</span></a> <font size=2%>'.$position.'</font></td>
<td class="va_m nwr p5 ta_r"><a class="simple-but mb0 inbl" w:id="writePmLink" href="?mail'.$t_r['id'].'"><span><span>Написать</span></span></a></td>
</tr>';


if(isset($_GET['mail'.$t_r['id'].''])){
$res = $mysqli->query('SELECT * FROM `dialog` WHERE (`ank` = '.$t_r['id'].' and `user` = '.$user['id'].') or (`ank` = '.$user['id'].' and `user` = '.$t_r['id'].')');
$dialog = $res->fetch_assoc();
if($t_r['id']!=$user['id']){
if(!$dialog){
$mysqli->query('INSERT INTO `dialog` SET `user` = "'.$user['id'].'", `ank` = "'.$t_r['id'].'" ');
$uid = mysqli_insert_id($mysqli);
header('Location: /dialog/'.$uid.'/'.$t_r['id'].'/');
}else{
header('Location: /dialog/'.$dialog['id'].'/'.$dialog['ank'].'/');
}
}elsE{
header('Location: /pm/');
}
exit();
}



}
echo '</tbody></table>';













require_once ('../system/footer.php');
?>