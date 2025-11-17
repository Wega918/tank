<?php
$title = 'Топик';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}
$id_razdel = abs(intval($_GET['id_razdel']));
$id_topik = abs(intval($_GET['id_topik']));
$res = $mysqli->query('SELECT * FROM `forum_razdel` WHERE `id` = '.$id_razdel.' LIMIT 1');
$razdel = $res->fetch_assoc();
$res1 = $mysqli->query('SELECT * FROM `forum_topik` WHERE `id` = '.$id_topik.' LIMIT 1');
$topik = $res1->fetch_assoc();
if($razdel == 0){header('Location: /forum/');exit();}
if($topik['razdel'] != $razdel['id']){header('Location: /forum/');exit();}

echo '<div class="medium white bold cntr mt5 mb10">'.$topik['name'].'</div>';
echo '<div class="mb5">
<img width="16" height="16" src="/images/forum_main.png"> <a class="medium white" w:id="boardLink" href="/forum/">Форум</a> / <a class="medium white" w:id="boardLink" href="/razdel/'.$razdel['id'].'/">'.$razdel['name'].'</a>
</div>';




$res1 = $mysqli->query('SELECT * FROM `settings` WHERE `id` = "1" ');
$sql = $res1->fetch_assoc();
$res1 = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$topik['user'].'" ');
$us = $res1->fetch_assoc();
$res2 = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$topik['user'].'" ');
$traning = $res2->fetch_assoc();
if($us['side'] == 1){$side = 'federation';}else{$side = 'empire';}
if($us['viz'] > (time()-$sql['online'])){$viz = '';}else{$viz = '_off';}

if($us['position'] >=4){
$admin = 'admin';
}elsE{
$admin = '';
}


echo '<a class="yellow1 sndr blck" w:id="authorLink" href="/profile/'.$topik['user'].'/"><img class="" height="14" width="14" src="/images/side/'.$side.'/'.$traning['rang'].''.$viz.'.png?1"> '.$us['login'].'
<span class="small fr pt2 gray1" w:id="time">'.time_last($topik['time']).'</span></a>';

echo '<div class="medium ovh m5 white '.$admin.'" w:id="message"><p>'.filter(bb(bb1(smile($topik['text'])))).'</p></div>';
//echo '<center><br>'.filter(bb(smile($topik['text']))).'</center>';

$res = $mysqli->query('SELECT COUNT(*) FROM `forum_msg` WHERE `topik` = '.$topik['id'].' and `text` != "NULL" ');
$col_msg = $res->fetch_array(MYSQLI_NUM);
echo '<div class="small gray1 m5">Комментариев: '.$col_msg[0].'</div>';
echo '<div class="dhr mt5 mb5"></div>';



if($topik['open']==1){
echo '<div class="pb5"><div class="small bold sh_b cntr green2 mt5" w:id="topicClosed">топик закрыт</div></div>';
}else{


echo '<div class="pb5"></div>';
echo '<form class="pb10" w:id="newPmForm" id="id1" method="post" action="?submit"><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id1_hf_0" id="id1_hf_0"></div>
<div class="cntr mb5">';










echo '<form class="pb10" w:id="newPmForm" id="id1" method="post" action="?submit"><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id1_hf_0" id="id1_hf_0"></div>
<div class="cntr mb5">';



$res = $mysqli->query('SELECT * FROM `forum_msg` WHERE `user` = "'.$user['id'].'" and `text` is NULL');
$msg_ = $res->fetch_assoc();

if(!$msg_){
echo '<div class="small bold cntr white sh_b mb5">Комментарий<br><textarea id="message" placeholder="Комментарий" rows="3" name="text" class="w90 p0 m0 wfield"></textarea></div>';
}else{
$res_anks = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$msg_['ank'].'" ');
$ank = $res_anks->fetch_assoc();
echo '<div class="small bold cntr white sh_b mb5">Комментарий<br><textarea id="message" placeholder="Комментарий" rows="3" name="text" class="w90 p0 m0 wfield">'.$ank['login'].', </textarea></div>';
}


//echo '<div class="small bold cntr white sh_b mb5">Комментарий<br><textarea id="message" placeholder="Комментарий" rows="3" name="text" class="w90 p0 m0"></textarea></div>';


?><span id="pokazat_smyle">
<table><tbody><tr><td style="width:25%;padding-right:4px;"></td>
<td style="width:50%;"><div class="input-but border w100 m0a"><span><input class="w100" type="submit" w:message="value:MessagePage.send" value="Отправить"></span></div></td>
<td style="width:33%;padding-left:5px;padding-top:5px;">
<a onclick="document.getElementById('pokazat_smyle').style.display='none';document.getElementById('skryt_smyle').style.display='';return false;" class="btni" style="height: 24px; width: 23px; padding: 2px 3px;box-shadow: inset 0px 1px 0px #;border: 1px solid #7dab2e;color:#FFFFFF;text-align: inherit;border-radius: 7px;border-radius: 4px;" href="#"><img style="vertical-align: sub;" src="/files/smile/smiles.png" width="20"></a>
</td></tr></tbody></table></span><?

?><span id="skryt_smyle" style="display:none">
<table><tbody><tr><td style="width:25%;padding-right:4px;"></td>
<td style="width:50%;"><div class="input-but border w100 m0a"><span><input class="w100" type="submit" w:message="value:MessagePage.send" value="Отправить"></span></div></td>
<td style="width:33%;padding-left:5px;padding-top:5px;">
<a onclick="document.getElementById('skryt_smyle').style.display='none';document.getElementById('pokazat_smyle').style.display='';return false;" class="btni" style="height: 24px; width: 23px; padding: 2px 3px;box-shadow: inset 0px 1px 0px #;border: 1px solid #7dab2e;color:#FFFFFF;text-align: inherit;border-radius: 7px;border-radius: 4px;" href="#"><img style="vertical-align: sub;" src="/files/smile/smiles.png" width="20"></a>
</td></tr></tbody></table>
<div class="fight center">
<?
$sm = $mysqli->query('SELECT * FROM `smile` WHERE `papka` = "1" ORDER BY `id` ASC');
while ($s = $sm->fetch_array()){
?><a onclick="pasteSmile(' <?=$s['name']?> ')"><img src="<?=$HOME?>files/smile/<?=$s['icon']?>" alt="<?=$s['name']?>" title="<?=$s['name']?>"></a><?
}
?>
</div></span><?
echo '</form>';



if(isset($_REQUEST['submit'])) {
$text = strong($_POST['text']);
if($topik['open']==1){header('location:?');exit();}
if(empty($text)){header('location:?');$_SESSION['err'] = "Сообщение не может быть пустым";exit();}
if((mb_strlen($text)) > 999 or (mb_strlen($text))<1){header('Location: ?');$_SESSION['err'] = 'Сообщение должен быть не короче 1 и не длиннее 1000';exit();}
$res_text = $mysqli->query("SELECT COUNT(*) FROM `forum_msg` WHERE `user` = ".$user['id']." and `text` = '".$text."' and `time` > '".(time()-90)."' ");
$txt_povtor = $res_text->fetch_array(MYSQLI_NUM);
if($txt_povtor[0]>0){header('Location: ?');$_SESSION['err'] = "Ваше сообщение повторяется!";exit();}
$res = $mysqli->query('SELECT * FROM `ban` WHERE `ank` = '.$user['id'].' and `tip` = "1" and `time_end` >= '.time().' LIMIT 1');
$ignor = $res->fetch_assoc();
if($ignor){$_SESSION['err'] = "Запрет общения еще: "._time1($ignor['time_end']-time())."";header('location:?');exit();}
if($user['position'] == 0){
if($user['login'] == 'Незнакомец' and $user['level'] < $sql['level_msg']){$_SESSION['err'] = "Сохраните персонажа и наберите ".$sql['level_msg']." уровень, чтобы участвовать в чате";header('location:?');exit();}
if($user['login'] == 'Незнакомец' and $user['level'] >= $sql['level_msg']){$_SESSION['err'] = "Сохраните персонажа, чтобы участвовать в чате";header('location:?');exit();}
if($user['login'] != 'Незнакомец' and $user['level'] <$sql['level_msg']){$_SESSION['err'] = "Наберите ".$sql['level_msg']." уровень, чтобы участвовать в чате.";header('location:?');exit();}
}
if(!$msg_){
$mysqli->query('INSERT INTO `forum_msg` SET `text` = "'.$text.'", `time` = "'.time().'", `topik` = "'.$topik['id'].'", `user` = "'.$user['id'].'"');
}else{
$mysqli->query('UPDATE `forum_msg` SET `text` = "'.$text.'", `time` = "'.time().'", `topik` = "'.$topik['id'].'", `user` = "'.$user['id'].'" WHERE `id` = "'.$msg_['id'].'"');
}
header('location: /topik/'.$razdel['id'].'/'.$topik['id'].'/');
exit();
}



?>
<script>
function showSmiles(){
document.getElementById("smiles").style.display = "block";
}
function  pasteSmile(smile){
message = document.getElementById("message");
message.value = message.value + smile;
message.focus();
message.selectionStart = message.value.length;
}
</script> 
<?



?>
</div></div></div></div></div></div></div></div></div></div>
</div></span><?
}














$max = 10;
$res = $mysqli->query('SELECT COUNT(*) FROM `forum_msg` WHERE `topik` = '.$topik['id'].' and `text` != "NULL"');
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$res = $mysqli->query('SELECT * FROM `forum_msg` WHERE `topik` = '.$topik['id'].' and `text` != "NULL" ORDER BY `time` desc LIMIT '.$start.','.$max.' ');
while ($msg = $res->fetch_array()){

$res1 = $mysqli->query('SELECT * FROM `settings` WHERE `id` = "1" ');
$sql = $res1->fetch_assoc();
$res1 = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$msg['user'].'" ');
$us = $res1->fetch_assoc();
$res2 = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$msg['user'].'" ');
$traning = $res2->fetch_assoc();
if($us['side'] == 1){$side = 'federation';}else{$side = 'empire';}
if($us['viz'] > (time()-$sql['online'])){$viz = '';}else{$viz = '_off';}



echo '<a class="yellow1 sndr blck" w:id="authorLink" href="/profile/'.$msg['user'].'/"><img class="" height="14" width="14" src="/images/side/'.$side.'/'.$traning['rang'].''.$viz.'.png?1"> '.$us['login'].'
<span class="small fr pt2 gray1" w:id="time">'.time_last($msg['time']).'</span></a>';

if($user['position']<=3 ){
if($user['position']>0 and $us['position']<4 ){
$del = '<a href="/msgdel/'.$msg['id'].'/"><img class="price_img_2"  src="/images/tresh1.png" width="16" height="16"></a>';
}else{
$del = '';
}
}else{
$del = '<a href="/msgdel/'.$msg['id'].'/'.$page.'/"><img class="price_img_2"  src="/images/tresh1.png" width="16" height="16"></a>';
}

if($msg['user']!=$user['id']){
$ishodnaya_str="".filter(bb(bb1(smile($msg['text']))))."";
$format=str_replace(''.$user['login'].'','',$ishodnaya_str);
$the_string = "".filter(bb(bb1(smile($msg['text']))))."";
$nick = "".$user['login']."";
if (strpos($the_string, $nick) !== false) {
echo ' <div class="medium ovh mb5 mt5 white" w:id="message"><p><span class="green1">'.$nick.'</span>';
if($us['position']==0){$position = '<span w:id="text" class="">'.$format.'</span>';}
if($us['position']==1){$position = '<span class="grey" w:id="login">'.$format.'</span>';}
if($us['position']==2){$position = '<span class="officer" w:id="login">'.$format.'</span>';}
if($us['position']==3){$position = '<span class="general" w:id="login">'.$format.'</span>';}
if($us['position']==4){$position = '<span class="green2" w:id="login">'.$format.'</span>';}
if($us['position']==5){$position = '<font color="#ff3b3b">'.$format.'</font>';}
echo ''.$del.' '.$position.'</p></div>';
}else{
if($us['position']==0){$position = '<span w:id="text" class="">'.$format.'</span></p></div>';}
if($us['position']==1){$position = '<span class="grey" w:id="login">'.$format.'</span></p></div>';}
if($us['position']==2){$position = '<span class="officer" w:id="login">'.$format.'</span></p></div>';}
if($us['position']==3){$position = '<span class="general" w:id="login">'.$format.'</span></p></div>';}
if($us['position']==4){$position = '<span class="green2" w:id="login">'.$format.'</span></p></div>';}
if($us['position']==5){$position = '<font color="#ff3b3b" w:id="login">'.$format.'</font></p></div>';}
echo '<div class="medium ovh mb5 mt5 white" w:id="message"><p>'.$del.' '.$position.'</p></div>';
}

}else{
echo '<div class="medium ovh mb5 mt5 orange" w:id="message"><p>'.$del.' '.filter(bb(bb1(smile($msg['text'])))).'</p></div>';
}



if ($msg['user'] != $user['id']) {
if($topik['open']==0){
echo '<div class="pb5"><a class="small gray1" w:id="replyLink" href="/otvet/'.$msg['id'].'/'.$page.'/">[ответить]</a></div>';
}
}









}

if ($k_page > 1) {
echo str('/topik/'.$razdel['id'].'/'.$topik['id'].'/?',$k_page,$page); // Вывод страниц
}












if($user['position']>=3){
echo '<div class="dhr mt5 mb5"></div>';
if($user['position']>=4){
echo '<a class="blck white small" w:id="markAllAsReadLink" href="/redact/'.$topik['id'].'/"><img class="price_img_2" height="14" width="14" src="/images/icons/settings.png?"> Редактировать топик</a>';
}
if($topik['status']==1){
echo '<a class="blck white small" w:id="markAllAsReadLink" href="?status"><img class="price_img_1" src="/images/topic_new_status.png" width="14" height="14"> Открепить топик</a>';
}elsE{
echo '<a class="blck white small" w:id="markAllAsReadLink" href="?status"><img class="price_img_1" src="/images/topic_new_status.png" width="14" height="14"> Закрепить топик</a>';
}
if($topik['open']==1){
echo '<a class="blck white small" w:id="markAllAsReadLink" href="?red"><img class="price_img_1" src="/images/ok.png" width="14" height="14"> Открыть топик</a>';
}elsE{
echo '<a class="blck white small" w:id="markAllAsReadLink" href="?red"><img class="price_img_1" src="/images/err.png" width="14" height="14"> Закрыть топик</a>';
}
echo '<a class="blck white small" w:id="markAllAsReadLink" href="?del"><img class="price_img_1" src="/images/tresh1.png" width="14" height="14"> Удалить топик</a>';
echo '<div class="dhr mt5 mb5"></div>';



if(isset($_GET['status'])){
if($user['position'] <3){header('Location: ?');exit();}
if($topik['status']==1){
$mysqli->query('UPDATE `forum_topik` SET `status` = "0" WHERE `id` = "'.$topik['id'].'" LIMIT 1');
}else{
$mysqli->query('UPDATE `forum_topik` SET `status` = "1" WHERE `id` = "'.$topik['id'].'" LIMIT 1');
}
header('Location: ?');
exit();
}

if(isset($_GET['red'])){
if($user['position'] <3){header('Location: ?');exit();}
if($topik['open']==1){
$mysqli->query('UPDATE `forum_topik` SET `open` = "0" WHERE `id` = "'.$topik['id'].'" LIMIT 1');
}else{
$mysqli->query('UPDATE `forum_topik` SET `open` = "1" WHERE `id` = "'.$topik['id'].'" LIMIT 1');
}
header('Location: ?');
exit();
}


if(isset($_GET['del'])){
if($user['position'] <3){header('Location: ?');exit();}
$_SESSION['ses'] = '<div class="buy-place-block pt2 mb10">
<div class="medium bold white cntr sh_b mt5 mb5">Удалить топик?</div>
<a class="simple-but border w50 mXa mb10" w:id="confirmLink" href="?del_"><span><span>да, подтверждаю</span></span></a>
<a class="simple-but border red w50 mXa" w:id="cancelLink" href="?"><span><span>нет, отмена</span></span></a></div>';
header('Location: ?');
exit();
}
if(isset($_GET['del_'])){
if($user['position'] <3){header('Location: ?');exit();}
$mysqli->query('DELETE FROM `forum_msg` WHERE `topik` = "'.$topik['id'].'" ');
$mysqli->query('DELETE FROM `forum_fols` WHERE `topik` = "'.$topik['id'].'" ');
$mysqli->query('DELETE FROM `forum_news` WHERE `topik` = "'.$topik['id'].'" ');
$mysqli->query('DELETE FROM `forum_topik` WHERE `id` = "'.$topik['id'].'" ');
header('Location: /razdel/'.$razdel['id'].'/');
exit();
}



}



$ress = $mysqli->query('SELECT * FROM `forum_fols` WHERE `topik` = '.$topik['id'].' and `user` = '.$user['id'].'');
$f_f = $ress->fetch_assoc();
if(!$f_f){
$mysqli->query('INSERT INTO `forum_fols` SET `topik` = "'.$topik['id'].'", `col_msg` = "'.$col_msg[0].'", `user` = "'.$user['id'].'"');
}elseif($f_f['col_msg']!=$col_msg[0]){
$mysqli->query('UPDATE `forum_fols` SET `col_msg` = "'.$col_msg[0].'" WHERE `id` = "'.$f_f['id'].'" LIMIT 1');
}


$res = $mysqli->query('SELECT * FROM `forum_news` WHERE `topik` = '.$topik['id'].' and `user` = '.$user['id'].'');
$f_n = $res->fetch_assoc();
if($f_n){
$mysqli->query('DELETE FROM `forum_news` WHERE `id` = "'.$f_n['id'].'" ');
} 

$mysqli->query('DELETE FROM `forum_news` WHERE `time` < "'.time().'" ');
$mysqli->query('DELETE FROM `forum_fols` WHERE `time` < "'.time().'" and `text` is NULL ');
$mysqli->query('DELETE FROM `forum_msg` WHERE `time` < "'.time().'" and `text` is NULL ');
require_once ('../system/footer.php');
?>