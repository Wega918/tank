<?php
$title = 'Топик';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}
$id = abs(intval($_GET['id']));
$res1 = $mysqli->query('SELECT * FROM `forum_topik` WHERE `id` = '.$id.' LIMIT 1');
$topik = $res1->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `forum_razdel` WHERE `id` = '.$topik['razdel'].' LIMIT 1');
$razdel = $res->fetch_assoc();

if($user['position']<4){
header('location: /topik/'.$razdel['id'].'/'.$topik['id'].'/');
exit();
}

if($razdel['name']=='Новости' and $user['position']<4){
header('location: /topik/'.$razdel['id'].'/'.$topik['id'].'/');
exit();
}



if(!$razdel){header('Location: /forum/');exit();}
if($razdel == 0){header('Location: /forum/');exit();}

if(!$topik){header('Location: /forum/');exit();}
if($topik == 0){header('Location: /forum/');exit();}


if($topik['razdel'] != $razdel['id']){header('Location: /forum/');exit();}





echo '<div class="medium white bold cntr mt5 mb10">Редактирвание</div>';
echo '<div class="mb5">
<img width="16" height="16" src="/images/forum_main.png"> <a class="medium white" w:id="boardLink" href="/forum/">Форум</a> / <a class="medium white" w:id="boardLink" href="/razdel/'.$razdel['id'].'/">'.$razdel['name'].'</a> / <a class="medium white" w:id="boardLink" href="/topik/'.$razdel['id'].'/'.$topik['id'].'/">'.$topik['name'].'</a>
</div>';

















echo '<div class="fight center">
<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5"></div>

<form w:id="loginForm" id="id2" method="post" action=""><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id2_hf_0" id="id2_hf_0"></div>
<div class="small bold cntr white sh_b mb5">
<input w:id="newLogin" type="text" placeholder="Заголовок" name="name" value="'.$topik['name'].'" class="fld-chng" size="25" maxlength="25"><br>
<textarea id="message" placeholder="Сообщение" rows="3" name="text" class="w90 p0 m0">'.$topik['text'].'</textarea></div>';





?>
<span id="pokazat_smyle1">
<table><tbody><tr><td style="width:25%;padding-right:4px;"></td>
<td style="width:50%;"><div class="input-but border w100 m0a"><span><input class="w100" type="submit" name="redact" w:message="value:MessagePage.send" value="Изменить"></span></div></td>
<td style="width:33%;padding-left:5px;padding-top:5px;">
<a onclick="document.getElementById('pokazat_smyle1').style.display='none';document.getElementById('skryt_smyle1').style.display='';return false;" class="btni" style="height: 24px; width: 23px; padding: 2px 3px;box-shadow: inset 0px 1px 0px #;border: 1px solid #7dab2e;color:#FFFFFF;text-align: inherit;border-radius: 7px;border-radius: 4px;" href="#"><img style="vertical-align: sub;" src="/files/smile/smiles.png" width="20"></a>
</td></tr></tbody></table></span><?

?>
<span id="skryt_smyle1" style="display:none">
<table><tbody><tr><td style="width:25%;padding-right:4px;"></td>
<td style="width:50%;"><div class="input-but border w100 m0a"><span><input class="w100" type="submit" name="redact" w:message="value:MessagePage.send" value="Изменить"></span></div></td>
<td style="width:33%;padding-left:5px;padding-top:5px;">
<a onclick="document.getElementById('skryt_smyle1').style.display='none';document.getElementById('pokazat_smyle1').style.display='';return false;" class="btni" style="height: 24px; width: 23px; padding: 2px 3px;box-shadow: inset 0px 1px 0px #;border: 1px solid #7dab2e;color:#FFFFFF;text-align: inherit;border-radius: 7px;border-radius: 4px;" href="#"><img style="vertical-align: sub;" src="/files/smile/smiles.png" width="20"></a>
</td></tr></tbody></table>
<div class="fight center">
<?
$sm = $mysqli->query('SELECT * FROM `smile` WHERE `papka` = "1" ORDER BY `id` ASC');
while ($s = $sm->fetch_array()){
?><a onclick="pasteSmile(' <?=$s['name']?> ')"><img src="<?=$HOME?>files/smile/<?=$s['icon']?>" alt="<?=$s['name']?>" title="<?=$s['name']?>"></a><?
}

echo '</div></span>



<div class="mt5"></div></form>
</div></div></div></div></div></div></div></div></div></div>
</div>';



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






if(isset($_REQUEST['redact'])) {
$name = strong($_POST['name']);
$text = strong($_POST['text']);
if($razdel['name']=='Новости' and $user['position']<4){header('location:?');exit();}
if(empty($name)){header('location:?');$_SESSION['err'] = "Заголовок не может быть пустым";exit();}
if(empty($text)){header('location:?');$_SESSION['err'] = "Сообщение не может быть пустым";exit();}
if($topik['name'] != $name){
$res_text = $mysqli->query("SELECT COUNT(*) FROM `forum_topik` WHERE `name` = '".$name."' ");
$txt_povtor = $res_text->fetch_array(MYSQLI_NUM);
if($txt_povtor[0]>0){header('Location: ?');$_SESSION['err'] = "Топик с таким названием уже сужествует.";exit();}
}
if((mb_strlen($name)) > 39 or (mb_strlen($name))<1){header('Location: ?');$_SESSION['err'] = 'Заголовок должно быть не короче 1 и не длиннее 40';exit();}
if((mb_strlen($text)) > 4999 or (mb_strlen($text))<1){header('Location: ?');$_SESSION['err'] = 'Сообщение должен быть не короче 1 и не длиннее 5000';exit();}
$mysqli->query('UPDATE `forum_topik` SET `name` = "'.$name.'", `text` = "'.$text.'" WHERE `id` = "'.$topik['id'].'" LIMIT 1');
header('location: /topik/'.$razdel['id'].'/'.$topik['id'].'/');
exit();
}









require_once ('../system/footer.php');
?>