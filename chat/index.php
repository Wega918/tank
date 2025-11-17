<?php
$title = 'Чат';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']) {
header('Location: /');
exit();
}

$res = $mysqli->query('SELECT * FROM `chat` WHERE `user` = "'.$user['id'].'" and `text` = "0" LIMIT 1');
$c_t = $res->fetch_assoc();


$res = $mysqli->query('SELECT * FROM `settings` WHERE `id` = "1" limit 1');
$sql = $res->fetch_assoc();

echo '<form class="pb10" w:id="newPmForm" id="id1" method="post" action="?submit"><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id1_hf_0" id="id1_hf_0"></div>
<div class="cntr mb5">';

if(!$c_t){
echo '<textarea id="message" placeholder="Написать сообщение" rows="3" name="message" class="w90 p0 m0 wfield"></textarea>';
}else{
$res_anks = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$c_t['ank'].'" ');
$anks_ = $res_anks->fetch_assoc();
echo '<textarea id="message" placeholder="Написать сообщение" rows="3" name="message" class="w90 p0 m0 wfield">'.$anks_['login'].', </textarea>';
}



echo '</div>';
?><span id="pokazat">
<table><tbody><tr><td style="width:25%;padding-right:4px;"></td>
<td style="width:50%;"><div class="input-but border w100 m0a"><span><input class="w100" type="submit" w:message="value:MessagePage.send" value="Отправить"></span></div></td>
<td style="width:33%;padding-left:5px;padding-top:5px;">
<a onclick="document.getElementById('pokazat').style.display='none';document.getElementById('skryt').style.display='';return false;" class="btni" style="height: 24px; width: 23px; padding: 2px 3px;box-shadow: inset 0px 1px 0px #;border: 1px solid #7dab2e;color:#FFFFFF;text-align: inherit;border-radius: 7px;border-radius: 4px;" href="#"><img style="vertical-align: sub;" src="/files/smile/smiles.png" width="20"></a>
</td></tr></tbody></table></span><?

?><span id="skryt" style="display:none">
<table><tbody><tr><td style="width:25%;padding-right:4px;"></td>
<td style="width:50%;"><div class="input-but border w100 m0a"><span><input class="w100" type="submit" w:message="value:MessagePage.send" value="Отправить"></span></div></td>
<td style="width:33%;padding-left:5px;padding-top:5px;">
<a onclick="document.getElementById('skryt').style.display='none';document.getElementById('pokazat').style.display='';return false;" class="btni" style="height: 24px; width: 23px; padding: 2px 3px;box-shadow: inset 0px 1px 0px #;border: 1px solid #7dab2e;color:#FFFFFF;text-align: inherit;border-radius: 7px;border-radius: 4px;" href="#"><img style="vertical-align: sub;" src="/files/smile/smiles.png" width="20"></a>
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
$message = strong($_POST['message']);
$res = $mysqli->query('SELECT * FROM `ban` WHERE `ank` = '.$user['id'].' and `tip` = "1" and `time_end` >= '.time().' LIMIT 1');
$ignor = $res->fetch_assoc();
if($ignor){$_SESSION['err'] = "Запрет общения еще: "._time1($ignor['time_end']-time())."";header('location:?');exit();}
if($user['login'] == 'Незнакомец' and $user['level'] < $sql['level_msg']){$_SESSION['err'] = "Сохраните персонажа и наберите ".$sql['level_msg']." уровень, чтобы участвовать в чате";header('location:?');exit();}
if($user['login'] == 'Незнакомец' and $user['level'] >= $sql['level_msg']){$_SESSION['err'] = "Сохраните персонажа, чтобы участвовать в чате";header('location:?');exit();}
if($user['login'] != 'Незнакомец' and $user['level'] <$sql['level_msg']){$_SESSION['err'] = "Наберите ".$sql['level_msg']." уровень, чтобы участвовать в чате";header('location:?');exit();}
if(empty($message)){header('location:?');$_SESSION['err'] = "Текст сообщения не может быть пустым";exit();}
if(!$message){header('location:?');$_SESSION['err'] = "Текст сообщения не может быть пустым";exit();}
if((mb_strlen($message)) > 249 or (mb_strlen($message))<1){header('Location: ?');$_SESSION['err'] = 'message должен быть не короче 1 и не длиннее 250';exit();}
$res_text = $mysqli->query("SELECT COUNT(*) FROM `chat` WHERE `user` = ".$user['id']." and `text` = '".$message."' and `time` > '".(time()-90)."' ");
$txt_povtor = $res_text->fetch_array(MYSQLI_NUM);
if($txt_povtor[0]>0){header('Location: ?');$_SESSION['err'] = "Ваше сообщение повторяется!";exit();}
if(!$c_t){
$mysqli->query('INSERT INTO `chat` SET `text` = "'.$message.'", `time` = "'.time().'", `user` = "'.$user['id'].'"');
}else{
$mysqli->query('UPDATE `chat` SET `text` = "'.$message.'", `time` = "'.time().'" WHERE `id` = "'.$c_t['id'].'" LIMIT 1');
}
header('location:?');
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








echo '<a w:id="refreshLink" class="simple-but gray mb2" href="/chat/"><span><span>Обновить</span></span></a>';






















$res = $mysqli->query('SELECT * FROM `settings` WHERE `id` = "1" limit 1');
$sql = $res->fetch_assoc();
$res = $mysqli->query("SELECT COUNT(*) FROM `chat` WHERE `text` != '0' ");
$k_post = $res->fetch_array(MYSQLI_NUM);
if($k_post[0]>0){
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content white bold small sh_b">';
$max = 25;
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$cchat_ = $mysqli->query('SELECT * FROM `chat` WHERE `text` != "0" ORDER BY `id` DESC LIMIT '.$start.','.$max.' ');
while ($chat = $cchat_->fetch_array()){
$res_user = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$chat['user'].'" ');
$user_ = $res_user->fetch_assoc();
$res_ank = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$chat['ank'].'" ');
$ank_ = $res_ank->fetch_assoc();

$res2 = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$user_['id'].'" ');
$traning = $res2->fetch_assoc();
if($user_['side'] == 1){$side = 'federation';}else{$side = 'empire';}
if($user_['viz'] > time()-$sql['online']){$viz = '';}else{$viz = '_off';}
if($chat['text']){
echo '<a class="yellow1" href="/profile/'.$user_['id'].'/"><img class="" height="14" width="14" src="/images/side/'.$side.'/'.$traning['rang'].''.$viz.'.png?1"> <span class="td_u">'.$user_['login'].'</span></a>';



if($chat['user']!=$user['id']){
$ishodnaya_str="".filter(smile(bb1($chat['text'])))."";
$format=str_replace(''.$user['login'].'','',$ishodnaya_str);
$the_string = "".filter(smile(bb1($chat['text'])))."";
$nick = "".$user['login']."";
if (strpos($the_string, $nick) !== false) {
echo ' <span class="green1">'.$nick.'</span>';
if($user_['position']==0){$position = '<span w:id="text" class="">'.$format.'</span>';}
if($user_['position']==1){$position = '<span class="grey" w:id="login">'.$format.'</span>';}
if($user_['position']==2){$position = '<span class="officer" w:id="login">'.$format.'</span>';}
if($user_['position']==3){$position = '<span class="general" w:id="login">'.$format.'</span>';}
if($user_['position']==4){$position = '<span class="green2" w:id="login">'.$format.'</span>';}
if($user_['position']==5){$position = '<font color="#ff3b3b">'.$format.'</font>';}
//echo '<span w:id="text" class="">'.$format.'</span> ';
echo ''.$position.'';
}else{
if($user_['position']==0){$position = '<span w:id="text" class="">'.$format.'</span>';}
if($user_['position']==1){$position = '<span class="grey" w:id="login">'.$format.'</span>';}
if($user_['position']==2){$position = '<span class="officer" w:id="login">'.$format.'</span>';}
if($user_['position']==3){$position = '<span class="general" w:id="login">'.$format.'</span>';}
if($user_['position']==4){$position = '<span class="green2" w:id="login">'.$format.'</span>';}
if($user_['position']==5){$position = '<font color="#ff3b3b" w:id="login">'.$format.'</font>';}
echo ' '.$position.'';
}


}else{
echo ' <span w:id="text" class="orange">'.filter(smile(bb1($chat['text']))).' </span> ';
}

//echo ' <span class="esmall gray1">'.vremja($chat['time']).'</span>';

if($chat['user']!=$user['id']){echo ' <a class="gray1" href="/otvetc/'.$chat['id'].'/'.$page.'/">[ответ]</a>';}
if($user['position'] >= 1){echo ' <a href="/cdel/'.$chat['id'].'/'.$page.'/"><img alt="+" src="/images/tresh1.png" width="16" height="16"></a>';}
echo '<br>';
}

/* if(isset($_GET['del_'.$chat['id'].''])){
if($user['position'] == 0){header('Location: ?');exit();}
$mysqli->query('DELETE FROM `chat` WHERE `id` = "'.$chat['id'].'" ');
header('Location: ?');
exit();
} */

/* if(isset($_GET['otvet_'.$chat['id'].''])){
if($chat['user']==$user['id']){header('Location: ?');exit();}
if(!$c_t){
$mysqli->query('INSERT INTO `chat` SET `user` = "'.$user['id'].'", `ank` = "'.$user_['id'].'", `time` = "'.(time()+60).'" ');
}else{
$mysqli->query('UPDATE `chat` SET `ank` = "'.$user_['id'].'", `time` = "'.(time()+60).'" WHERE `id` = "'.$c_t['id'].'" LIMIT 1');
}
header('Location: ?');
exit();
} */
}
echo '</div></div></div></div></div></div></div></div></div></div>';
if ($k_page > 1) {
echo str('/chat/?',$k_page,$page); // Вывод страниц
}
}else{
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content white bold small sh_b">';
echo '<center>Сообщений не найдено.</center>';
echo '</div></div></div></div></div></div></div></div></div></div>';
}










if(isset($_GET['clean'])){
if($user['position'] <= 1){header('Location: ?');exit();}
$mysqli->query('DELETE FROM `chat` WHERE `id` ');
header('Location: ?');
exit();
}


if($user['position'] >= 2 and $k_post[0]>0){
echo '<a class="simple-but gray mb5" href="?clean"><span><span>Очистить чат</span></span></a>';
}
echo '<a class="simple-but gray mb5" href="/moderators/"><span><span>Помощь модераторов</span></span></a>';
//echo '<a class="simple-but gray mb5" w:id="chatRulesLink" href="/forum/0/s/4/t/299188"><span><span>Правила чата</span></span></a>';




$mysqli->query('DELETE FROM `chat` WHERE `text` = "0" and `time` < "'.time().'"');
require_once ('../system/footer.php');
?>