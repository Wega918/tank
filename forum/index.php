<?php
$title = 'Форум';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}


echo '<div class="medium white bold cntr mt5 mb10">Форум</div>';



$max = 10;
$res = $mysqli->query("SELECT COUNT(*) FROM `forum_razdel` WHERE `id` ");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$res = $mysqli->query('SELECT * FROM `forum_razdel` WHERE `id` ORDER BY `id` asc LIMIT '.$start.','.$max.' ');
while ($razdel = $res->fetch_array()){
/* $res1 = $mysqli->query('SELECT * FROM `missions` WHERE `id` = "'.$miss_['id_miss'].'" ');
$m1 = $res1->fetch_assoc(); */
$reyt = ''.$k_post[0]++.'';
if($reyt % 2){
$test = '';
}else{
$test = 'odd';
}

echo '<div w:id="forum" class="'.$test.'"><a class="blck p6 forum" w:id="forumLink" href="/razdel/'.$razdel['id'].'/">
<span class="medium bold yellow1"><img src="/images/forum.png" width="16" height="16" alt=""> '.$razdel['name'].'</span>';
//echo '<div class="fr" href="?"><img src="/images/icons/settings.png" width="16" height="16" alt=""></div>';
echo '<br>
<div class="mt2"></div>
<span class="small white">'.$razdel['text'].'</span></a>
</div>';





/* if(isset($_GET['act'.$razdel['id'].''])){

$_SESSION['ses'] = '
<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5"></div>
<form w:id="loginForm" id="id2" method="post" action=""><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id2_hf_0" id="id2_hf_0"></div>
<div class="small bold cntr white sh_b mb5">
<input w:id="newLogin" type="text" placeholder="Название" name="name" value="" class="fld-chng" size="25" maxlength="25"><br>
<textarea id="message" placeholder="Описание" rows="3" name="text" class="w90 p0 m0"></textarea></div>
<center><input type="submit" name="new_razdel" value="Добавить"></center>
<div class="mt5"></div></form>
</div></div></div></div></div></div></div></div></div></div>

';
 
header('Location: ?');
exit();
}
*/




}



//$mysqli->query('INSERT INTO `forum_razdel` SET `name` = "1" ');







echo '<a class="simple-but gray mb5" href="../moderators/"><span><span>Помощь модераторов</span></span></a>';
echo '<a class="simple-but gray mb5" w:id="forumRulesLink" href="/forum/0/s/4/t/299188"><span><span>Правила форума</span></span></a>';






if($user['position']>=4){
?><span id="pokazat"><a onclick="document.getElementById('pokazat').style.display='none';document.getElementById('skryt').style.display='';return false;" href="#"><div class="simple-but red mb5" w:id="forumRulesLink" ><span><span>Добавить раздел</span></span></div></a></span><?

?><span id="skryt" style="display:none"><a onclick="document.getElementById('skryt').style.display='none';document.getElementById('pokazat').style.display='';return false;" href="#"><div class="simple-but red mb5" w:id="forumRulesLink" ><span><span>Отменить</span></span></div></a>

<div class="fight center">
<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5"></div>
<form w:id="loginForm" id="id2" method="post" action=""><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id2_hf_0" id="id2_hf_0"></div>
<div class="small bold cntr white sh_b mb5">
<input w:id="newLogin" type="text" placeholder="Название" name="name" value="" class="fld-chng" size="25" maxlength="25"><br>
<textarea id="message" placeholder="Описание" rows="3" name="text" class="w90 p0 m0"></textarea></div>
<center><input type="submit" name="new_razdel" value="Добавить"></center>
<div class="mt5"></div></form>
</div></div></div></div></div></div></div></div></div></div>
</div></span><?


if(isset($_REQUEST['new_razdel'])) {
$name = strong($_POST['name']);
$text = strong($_POST['text']);
if($user['position']<4){header('location:?');exit();}
if(empty($name)){header('location:?');$_SESSION['err'] = "Название не может быть пустым";exit();}
if(empty($text)){header('location:?');$_SESSION['err'] = "Описание не может быть пустым";exit();}
if((mb_strlen($name)) > 24 or (mb_strlen($name))<1){header('Location: ?');$_SESSION['err'] = 'Название должно быть не короче 1 и не длиннее 25';exit();}
if((mb_strlen($text)) > 249 or (mb_strlen($text))<1){header('Location: ?');$_SESSION['err'] = 'Описание должно быть не короче 1 и не длиннее 250';exit();}
$mysqli->query('INSERT INTO `forum_razdel` SET `text` = "'.$text.'", `name` = "'.$name.'" ');
header('location:?');
exit();
}
}




require_once ('../system/footer.php');
?>