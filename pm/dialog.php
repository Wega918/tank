<?php
$title = 'Почта';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}
$d = abs(intval($_GET['d'])); //dialog
$ank_ = abs(intval($_GET['ank_']));

if($d==0){header('Location: /pm/');exit();}


$res = $mysqli->query('SELECT * FROM `dialog` WHERE `id` = '.$d.' and ((`user` = '.$user['id'].') or (`ank` = '.$user['id'].')) ');
$dialog = $res->fetch_assoc();
if(!$dialog){header('Location: /pm/');exit();}



if($dialog['user']!=$ank_ && $dialog['ank']!=$ank_){
header('Location: /pm/');
exit();
} 





if(!$dialog){
$res = $mysqli->query('SELECT * FROM `users` WHERE `id`  = "'.$ank_.'" LIMIT 1');
$ank = $res->fetch_assoc();
$mysqli->query('INSERT INTO `dialog` SET `user` = "'.$user['id'].'", `ank` = "'.$ank_.'" ');
}else{ 
if($dialog['user']==$user['id']){
$res = $mysqli->query('SELECT * FROM `users` WHERE `id`  = "'.$dialog['ank'].'" LIMIT 1');
$ank = $res->fetch_assoc();
}else{
$res = $mysqli->query('SELECT * FROM `users` WHERE `id`  = "'.$dialog['user'].'" LIMIT 1');
$ank = $res->fetch_assoc();
}
}


if($ank['id']==$user['id']){
header('Location: /pm/');
exit();
} 

//echo ''.$dialog['user'].' '.$dialog['ank'].' '.$dialog['id'].' '.$d.'';


$res = $mysqli->query('SELECT * FROM `settings` WHERE `id` = "1" limit 1');
$sql = $res->fetch_assoc();

$res2 = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$ank['id'].'" ');
$traning = $res2->fetch_assoc();

if($ank['side'] == 1){$side = 'federation';}else{$side = 'empire';}
if($ank['viz'] > time()-$sql['online']){$viz = '';}else{$viz = '_off';}
echo '<div class="small white bold cntr mb5">Диалог с <a class="yellow1" w:id="targetLink" href="/profile/'.$ank['id'].'/"><img class="vb" height="14" width="14" src="/images/side/'.$side.'/'.$traning['rang'].''.$viz.'.png?1"> '.$ank['login'].'</a></div>';








/* $res = $mysqli->query('SELECT * FROM `users` WHERE `id` = '.$id.' ');
$us = $res->fetch_assoc();
if(!$us){header('Location: /pm/');exit();}
if($us['id']==$user['id']){header('Location: /pm/');exit();}
 */
/* 

$res = $mysqli->query('SELECT * FROM `dialog` WHERE (`user` = '.$id.' and `ank` = '.$user['id'].') or (`user` = '.$user['id'].' and `ank` = '.$id.')');
$d = $res->fetch_assoc();

if(!$d){
$res = $mysqli->query('SELECT * FROM `users` WHERE `id`  = "'.$id.'" LIMIT 1');
$ank = $res->fetch_assoc();
$mysqli->query('INSERT INTO `dialog` SET `user` = "'.$user['id'].'", `ank` = "'.$id.'" ');
}else{
if($user['id']==$d['user']){
$res = $mysqli->query('SELECT * FROM `users` WHERE `id`  = "'.$d['ank'].'" LIMIT 1');
$ank = $res->fetch_assoc();
}else{
$res = $mysqli->query('SELECT * FROM `users` WHERE `id`  = "'.$d['user'].'" LIMIT 1');
$ank = $res->fetch_assoc();
}
}
 */











$res = $mysqli->query("SELECT COUNT(*) FROM `pm` WHERE `dialog` = '".$d."' ");
$k_post = $res->fetch_array(MYSQLI_NUM);
if($k_post[0]>0){
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content white bold small sh_b">';
$max = 25;
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$d1 = $mysqli->query('SELECT * FROM `pm` WHERE `dialog` = '.$d.' ORDER BY `time` desc LIMIT '.$start.','.$max.' ');
while ($pm = $d1->fetch_array()){
if($user['id'] == $pm['ank']) {
$mysqli->query('UPDATE `pm` SET `readlen` = "1" WHERE `id` = "'.$pm['id'].'" LIMIT 1');
}
if($pm['user']==$user['id']){
$us = ''.$user['login'].'';
$color = '';
}elsE{
$us = ''.$ank['login'].'';
$color = 'green1';
}



echo '<div class="">
<span class="yellow1 td_u">'.$us.'</span>, <span class="esmall gray1">'.vremja($pm['time']).'</span>
<span class="'.$color.'"><p>'.filter(bb1(smile($pm['text']))).'</p></span>
</div>
';
}
echo '</div></div></div></div></div></div></div></div></div></div>';
}else{
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content white bold small sh_b">';
echo '<center>Сообщений не найдено.</center>';
echo '</div></div></div></div></div></div></div></div></div></div>';
}














echo '<form class="pb10" w:id="newPmForm" id="id1" method="post" action="?submit"><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id1_hf_0" id="id1_hf_0"></div>
<div class="cntr mb5"><textarea id="message" rows="3" name="message" class="w90 p0 m0 wfield"></textarea></div>';
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
if($user['position'] == 0 or $ank['position'] == 0){
if($user['login'] == 'Незнакомец' and $user['level'] < $sql['level_msg']){$_SESSION['err'] = "Сохраните персонажа и наберите ".$sql['level_msg']." уровень, чтобы участвовать в чате";header('location:?');exit();}
if($user['login'] == 'Незнакомец' and $user['level'] >= $sql['level_msg']){$_SESSION['err'] = "Сохраните персонажа, чтобы участвовать в чате";header('location:?');exit();}
if($user['login'] != 'Незнакомец' and $user['level'] <$sql['level_msg']){$_SESSION['err'] = "Наберите ".$sql['level_msg']." уровень, чтобы участвовать в чате.";header('location:?');exit();}
}
if(empty($message)){header('location:?');$_SESSION['err'] = "".$message."Поле 'message' обязательно";exit();}
if(!$message){header('location:?');$_SESSION['err'] = "Поле 'message' обязательно";exit();}
if((mb_strlen($message)) > 512 or (mb_strlen($message))<1){header('Location: ?');$_SESSION['err'] = 'message должен быть не короче 1 и не длиннее 512';exit();}
$res_text = $mysqli->query("SELECT COUNT(*) FROM `pm` WHERE `user` = ".$user['id']." and `text` = '".$message."' and `time` > '".(time()-90)."' ");
$txt_povtor = $res_text->fetch_array(MYSQLI_NUM);
if($txt_povtor[0]>0){header('Location: ?');$_SESSION['err'] = "Ваше сообщение повторяется!";exit();}
$res = $mysqli->query('SELECT * FROM `dialog` WHERE `user` = '.$user['id'].' or `ank` = '.$user['id'].' ');
$d = $res->fetch_assoc();

$mysqli->query('INSERT INTO `pm` SET `dialog` = "'.$dialog['id'].'", `text` = "'.$message.'", `time` = "'.time().'", `user` = "'.$user['id'].'", `ank` = "'.$ank['id'].'" ');
$mysqli->query('INSERT INTO `pm_copy` SET `dialog` = "'.$dialog['id'].'", `text` = "'.$message.'", `time` = "'.time().'", `user` = "'.$user['id'].'", `ank` = "'.$ank['id'].'" ');
$mysqli->query('UPDATE `dialog` SET `time` = "'.time().'" WHERE `id` = "'.$dialog['id'].'" LIMIT 1');

//$_SESSION['ok'] = "Сообщение отправлено";
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



echo '<a w:id="mailLink" class="simple-but gray mt10" href="/pm/"><span><span>Вернуться в почту</span></span></a>';
require_once ('../system/footer.php');
?>