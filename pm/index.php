<?php
$title = 'Почта';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}
echo '<div class="medium white bold cntr mb5">Личная почта</div>';


echo '<table class="tlist small bold white sh_b mb5"><tbody>';







$res = $mysqli->query('SELECT * FROM `settings` WHERE `id` = "1" limit 1');
$sql = $res->fetch_assoc();





$res = $mysqli->query("SELECT COUNT(*) FROM `dialog` WHERE (`user` = ".$user['id']." or `ank` = ".$user['id'].")  ");// and `time` > '0'
$k_post = $res->fetch_array(MYSQLI_NUM);
//echo $k_post[0];
if($k_post[0]>0){
$max = 10;
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$d = $mysqli->query('SELECT * FROM `dialog` WHERE (`user` = "'.$user['id'].'" or `ank` = "'.$user['id'].'") 

 ORDER BY `time` DESC LIMIT '.$start.','.$max.' ');//and `time` > "0" and `id` in (select dialog from pm)
while ($dialog = $d->fetch_array()){

$res = $mysqli->query("SELECT COUNT(*) FROM `pm` WHERE `dialog` = ".$dialog['id']." ");//and `time` >= "'.$dialog['time'].'"
$c_pm = $res->fetch_array(MYSQLI_NUM);

//echo ''.$dialog['id'].' - '.$c_pm[0].'';
if($c_pm[0]<=0){
$mysqli->query('DELETE FROM `dialog` WHERE `id` = "'.$dialog['id'].'" ');
}

if($c_pm[0]>0){

$res = $mysqli->query('SELECT * FROM `pm` WHERE `dialog` = "'.$dialog['id'].'" and `time` >= "'.($dialog['time']-5).'" ');//and `time` >= "'.$dialog['time'].'"
$pm = $res->fetch_assoc();










if($user['id'] == $pm['user']){
$res_user = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$pm['user'].'" ');
$user_ = $res_user->fetch_assoc();
$res_ank = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$pm['ank'].'" ');
$ank_ = $res_ank->fetch_assoc();
$res2 = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$ank_['id'].'" ');
$traning = $res2->fetch_assoc();
if($ank_['side'] == 1){$side = 'federation';}else{$side = 'empire';}
if($ank_['viz'] > time()-$sql['online']){$viz = '';}else{$viz = '_off';}
//echo 1;
}else{
$res_user = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$pm['user'].'" ');
$user_ = $res_user->fetch_assoc();
$res_ank = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$pm['user'].'" ');
$ank_ = $res_ank->fetch_assoc();
$res2 = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$user_['id'].'" ');
$traning = $res2->fetch_assoc();
if($user_['side'] == 1){$side = 'federation';}else{$side = 'empire';}
if($user_['viz'] > time()-$sql['online']){$viz = '';}else{$viz = '_off';}
//echo k_post;
}




if($pm['readlen'] == 1){$color= 'gray';$readlen = '';$dark = 'dark';}else{if($pm['user'] != $user['id']){$color= 'green1';$readlen = '<span class="green1">(+)</span>';$dark = '';}else{$color= 'gray';$readlen = '';$dark = '';}}
if($pm['user'] == $user['id']){$img = '/images/pm/out.png';}else{$img = '/images/pm/in.png';}

echo '<tr class="'.$dark.'"><td class="usr w100"><a href="/dialog/'.$dialog['id'].'/'.$ank_['id'].'/" class="white">'.$readlen.'
<img src="'.$img.'" title="Входящее/Исходящее" alt="Входящее/Исходящее">
<img class="vb" height="14" width="14" src="/images/side/'.$side.'/'.$traning['rang'].''.$viz.'.png?1"> '.$ank_['login'].' <span class="gray1">'.vremja($dialog['time']).'</span><br>
<span class="'.$color.'">'.filter(bb1(smile($pm['text']))).'</span>
</a></td></tr>';
}
}
if ($k_page > 1) {
echo str('/pm/?',$k_page,$page); // Вывод страниц
}




}else{
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content white bold small sh_b">';
echo '<center>Диалогов не найдено.</center>';
echo '</div></div></div></div></div></div></div></div></div></div>';
}




echo '</tbody></table>';








if(isset($_GET['readlen'])){
$mysqli->query('UPDATE `pm` SET `readlen` = "1" WHERE `ank` = "'.$user['id'].'" ');
header('Location: ?');
exit();
}

//echo '<a w:id="deleteAllRead" class="simple-but gray" href="pm?16-1.ILinkListener-deleteAllRead"><span><span>Удалить все прочитанные</span></span></a>';
echo '<a w:id="markReadAllUnread" class="simple-but gray" href="?readlen"><span><span>Отметить все как прочитанные</span></span></a>';

echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">Сообщения старше 30 дней автоматически удаляются</div>
</div></div></div></div></div></div></div></div></div></div>';
require_once ('../system/footer.php');
?>