<?php
$title = 'Топики';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}
$id = abs(intval($_GET['id']));
$res = $mysqli->query('SELECT * FROM `forum_razdel` WHERE `id` = '.$id.' LIMIT 1');
$razdel = $res->fetch_assoc();
if($razdel == 0){header('Location: /forum/');exit();}




$res = $mysqli->query('SELECT * FROM `settings` WHERE `id` = "1" limit 1');
$sql = $res->fetch_assoc();



echo '<div class="medium white bold cntr mt5 mb10">'.$razdel['name'].'</div>';

echo '<div class="mb5">
<img width="16" height="16" src="/images/forum_main.png"> <a class="medium white" w:id="boardLink" href="/forum/">Форум</a>
</div>';





$max = 10;
$res = $mysqli->query('SELECT COUNT(*) FROM `forum_topik` WHERE `razdel` = '.$razdel['id'].' ');
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$res = $mysqli->query('SELECT * FROM `forum_topik` WHERE `razdel` = '.$razdel['id'].' ORDER BY `status` desc, `id` desc LIMIT '.$start.','.$max.' ');
while ($topik = $res->fetch_array()){
$reyt = ''.$k_post[0]++.'';
if($reyt % 2){
$test = '';
}else{
$test = 'odd';
}

$res3 = $mysqli->query('SELECT COUNT(*) FROM `forum_msg` WHERE `topik` = '.$topik['id'].' and `text` is not NULL ');
$col_msg = $res3->fetch_array(MYSQLI_NUM);
$ress = $mysqli->query('SELECT * FROM `forum_fols` WHERE `topik` = '.$topik['id'].' and `user` = '.$user['id'].'');
$f_f = $ress->fetch_assoc();

if(!$f_f){
$img = '<img w:id="topicImage" width="16" height="16" src="/images/topic_new.png">';
}elseif($f_f['col_msg']!=$col_msg[0]){
$img = '<img w:id="topicImage" width="16" height="16" src="/images/topic_new.png">';
}elseif($f_f['col_msg']==$col_msg[0]){
$img = '<img w:id="topicImage" width="16" height="16" src="/images/topic_readed.png">';
}

if($topik['status']==1){
$bold = 'bold';
}else{
$bold = '';
}
echo '<div w:id="topic" class="'.$test.'">
<a class="blck p5 forum" w:id="topicLink" href="/topik/'.$razdel['id'].'/'.$topik['id'].'/">
<span class="medium yellow1 '.$bold.'" w:id="topicContainer">'.$img.' '.$topik['name'].'</span>
</a>
</div>';
}


if ($k_page > 1) {
echo str('/razdel/'.$id.'/?',$k_page,$page); // Вывод страниц
}















echo '<div class="dhr mt5 mb5"></div>';
echo '<a class="blck white small" w:id="markAllAsReadLink" href="?readwhere"><img alt="+" src="/images/topic_mark_all.png" width="16" height="16"> Отметить все как прочитанное</a>';
echo '<div class="mt5 mb5"></div>';



if(isset($_GET['readwhere'])){
$res = $mysqli->query('SELECT * FROM `forum_topik` WHERE `razdel` = '.$razdel['id'].' ORDER BY `id` desc');
while ($topik1 = $res->fetch_array()){
$ress1 = $mysqli->query('SELECT * FROM `forum_fols` WHERE `topik` = '.$topik1['id'].' and `user` = '.$user['id'].'');
$f_f1 = $ress1->fetch_assoc();
$res22 = $mysqli->query('SELECT COUNT(*) FROM `forum_msg` WHERE `topik` = '.$topik1['id'].' and `text` is not NULL');
$col_msg1 = $res22->fetch_array(MYSQLI_NUM);
if(!$f_f1){
$mysqli->query('INSERT INTO `forum_fols` SET `topik` = "'.$topik1['id'].'", `col_msg` = "'.$col_msg1[0].'", `user` = "'.$user['id'].'"');
}elseif($f_f1['col_msg']!=$col_msg1[0]){
$mysqli->query('UPDATE `forum_fols` SET `col_msg` = "'.$col_msg1[0].'" WHERE `id` = "'.$f_f1['id'].'" LIMIT 1');
}
}
header('location: /razdel/'.$razdel['id'].'/');
exit();
}





if($user['position']>=4){
?><span id="pokazat"><a onclick="document.getElementById('pokazat').style.display='none';document.getElementById('skryt').style.display='';return false;" href="#"><div class="dhr mt5 mb5"></div><div class="blck white small" w:id="createTopic" ><img alt="+" src="/images/topic_create.png" width="16" height="16"> Создать новый топик</div></a><div class="mt5 mb5"></div></span><?
}else{
if($razdel['name']!='Новости'){
?><span id="pokazat"><a onclick="document.getElementById('pokazat').style.display='none';document.getElementById('skryt').style.display='';return false;" href="#"><div class="dhr mt5 mb5"></div><div class="blck white small" w:id="createTopic" ><img alt="+" src="/images/topic_create.png" width="16" height="16"> Создать новый топик</div></a><div class="mt5 mb5"></div></span><?
}
}



?><span id="skryt" style="display:none"><a onclick="document.getElementById('skryt').style.display='none';document.getElementById('pokazat').style.display='';return false;" href="#"><div class="dhr mt5 mb5"></div><div class="blck white small" w:id="createTopic" ><img alt="+" src="/images/topic_create.png" width="16" height="16"> Отменить</div></a>
<div class="mt5"></div>
<div class="fight center">
<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5"></div><?



echo '<form class="pb10" w:id="newPmForm" id="id1" method="post" action="?submit"><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id1_hf_0" id="id1_hf_0"></div>
<div class="cntr mb5">';
echo '<div class="small bold cntr white sh_b mb5">
<input w:id="newLogin" type="text" placeholder="Заголовок" name="name" value="" class="fld-chng" size="25" maxlength="25"><br>
<textarea id="message" placeholder="Сообщение" rows="3" name="text" class="w90 p0 m0"></textarea></div>';
if($user['position'] >= 4){
echo '<p><input name="new" type="radio" value="1" checked> - оповещать в новостную ленту</p>
<p><input name="new" type="radio" value="2"> - не оповещать в новостную ленту</p>';
}



echo '</div>';
?><span id="pokazat_smyle">
<table><tbody><tr><td style="width:25%;padding-right:4px;"></td>
<td style="width:50%;"><div class="input-but border w100 m0a"><span><input class="w100" type="submit" w:message="value:MessagePage.send" value="Создать"></span></div></td>
<td style="width:33%;padding-left:5px;padding-top:5px;">
<a onclick="document.getElementById('pokazat_smyle').style.display='none';document.getElementById('skryt_smyle').style.display='';return false;" class="btni" style="height: 24px; width: 23px; padding: 2px 3px;box-shadow: inset 0px 1px 0px #;border: 1px solid #7dab2e;color:#FFFFFF;text-align: inherit;border-radius: 7px;border-radius: 4px;" href="#"><img style="vertical-align: sub;" src="/files/smile/smiles.png" width="20"></a>
</td></tr></tbody></table></span><?

?><span id="skryt_smyle" style="display:none">
<table><tbody><tr><td style="width:25%;padding-right:4px;"></td>
<td style="width:50%;"><div class="input-but border w100 m0a"><span><input class="w100" type="submit" w:message="value:MessagePage.send" value="Создать"></span></div></td>
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
$name = strong($_POST['name']);
$text = strong($_POST['text']);
$new = strong($_POST['new']);
$res = $mysqli->query('SELECT * FROM `ban` WHERE `ank` = '.$user['id'].' and `tip` = "1" and `time_end` >= '.time().' LIMIT 1');
$ignor = $res->fetch_assoc();
if($ignor){$_SESSION['err'] = "Запрет общения еще: "._time1($ignor['time_end']-time())."";header('location:?');exit();}
if($user['position'] == 0){
if($razdel['name']=='Новости' and $user['position']<4){header('location:?');exit();}
if($user['login'] == 'Незнакомец' and $user['level'] < $sql['level_msg']){$_SESSION['err'] = "Сохраните персонажа и наберите ".$sql['level_msg']." уровень, чтобы участвовать в чате";header('location:?');exit();}
if($user['login'] == 'Незнакомец' and $user['level'] >= $sql['level_msg']){$_SESSION['err'] = "Сохраните персонажа, чтобы участвовать в чате";header('location:?');exit();}
if($user['login'] != 'Незнакомец' and $user['level'] <$sql['level_msg']){$_SESSION['err'] = "Наберите ".$sql['level_msg']." уровень, чтобы участвовать в чате";header('location:?');exit();}
}
$res_text = $mysqli->query("SELECT COUNT(*) FROM `forum_topik` WHERE `name` = '".$name."' ");
$txt_povtor = $res_text->fetch_array(MYSQLI_NUM);
if($txt_povtor[0]>0){header('Location: ?');$_SESSION['err'] = "Топик с таким названием уже сужествует.";exit();}
if(empty($name)){header('location:?');$_SESSION['err'] = "Заголовок не может быть пустым";exit();}
if(empty($text)){header('location:?');$_SESSION['err'] = "Сообщение не может быть пустым";exit();}
if((mb_strlen($name)) > 39 or (mb_strlen($name))<1){header('Location: ?');$_SESSION['err'] = 'Заголовок должно быть не короче 1 и не длиннее 40';exit();}
if((mb_strlen($text)) > 5999 or (mb_strlen($text))<1){header('Location: ?');$_SESSION['err'] = 'Сообщение должен быть не короче 1 и не длиннее 5000';exit();}
$mysqli->query('INSERT INTO `forum_topik` SET `name` = "'.$name.'", `text` = "'.$text.'", `time` = "'.time().'", `razdel` = "'.$razdel['id'].'", `user` = "'.$user['id'].'"');
$uid = mysqli_insert_id($mysqli);

if($user['position'] >= 4){
if($new==1){
$res = $mysqli->query('SELECT * FROM `users` WHERE `viz` > '.(time()-(86400*7)).' ORDER BY `id` desc');
while ($uss = $res->fetch_array()){
$mysqli->query('INSERT INTO `forum_news` SET `name` = "'.$name.'", `topik` = "'.$uid.'", `time` = "'.(time()+(86400*3)).'", `user` = "'.$uss['id'].'"');
}
}
}

header('location: /topik/'.$razdel['id'].'/'.$uid.'/');
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





require_once ('../system/footer.php');
?>