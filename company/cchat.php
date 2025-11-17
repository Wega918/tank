<?php
$title = 'Чат';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']) {
header('Location: /');
exit();
}

if($user['company']<=0) {header('Location: /');exit();}

$res_company = $mysqli->query('SELECT * FROM `company` WHERE `id` = '.$user['company'].' LIMIT 1');
$company = $res_company->fetch_assoc();

$res_company_user = $mysqli->query('SELECT * FROM `company_user` WHERE `user` = '.$user['id'].' and `company` = '.$company['id'].' LIMIT 1');
$company_user = $res_company_user->fetch_assoc();

$res_cchat_col = $mysqli->query("SELECT COUNT(*) FROM `cchat` WHERE `company` = ".$company['id']." ");
$cchat_coll = $res_cchat_col->fetch_array(MYSQLI_NUM);
if($cchat_coll[0]!=$company_user['cchat_coll']){
$mysqli->query('UPDATE `company_user` SET `cchat_coll` = "'.$cchat_coll[0].'" WHERE `id` = "'.$company_user['id'].'" LIMIT 1');
}





$res_cchat_text = $mysqli->query('SELECT * FROM `cchat` WHERE `company` = "'.$company['id'].'" and `user` = "'.$user['id'].'" and `text` = "0" LIMIT 1');
$cchat_text = $res_cchat_text->fetch_assoc();



$res = $mysqli->query('SELECT * FROM `settings` WHERE `id` = "1" limit 1');
$sql = $res->fetch_assoc();

echo '<a class="simple-but gray mt5" href="/cchat/"><span><span>Обновить</span></span></a>';

echo '<form class="pb10" w:id="newPmForm" id="id1" method="post" action="?submit"><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id1_hf_0" id="id1_hf_0"></div>
<div class="cntr mb5">';

if(!$cchat_text){
echo '<textarea id="message" placeholder="Написать сообщение" rows="3" name="message" class="w90 p0 m0 wfield"></textarea>';
}else{
$res_anks = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$cchat_text['ank'].'" ');
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
$res_text = $mysqli->query("SELECT COUNT(*) FROM `cchat` WHERE `user` = ".$user['id']." and `company` = '".$company['id']."' and `text` = '".$message."' and `time` > '".(time()-90)."' ");
$txt_povtor = $res_text->fetch_array(MYSQLI_NUM);
if($txt_povtor[0]>0){header('Location: ?');$_SESSION['err'] = "Ваше сообщение повторяется!";exit();}
if(!$cchat_text){
$mysqli->query('INSERT INTO `cchat` SET `company` = "'.$company['id'].'", `text` = "'.$message.'", `time` = "'.time().'", `user` = "'.$user['id'].'"');
}else{
$mysqli->query('UPDATE `cchat` SET `text` = "'.$message.'", `time` = "'.time().'" WHERE `id` = "'.$cchat_text['id'].'" LIMIT 1');
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












$res = $mysqli->query("SELECT COUNT(*) FROM `cchat` WHERE `company` = ".$company['id']." and `text` != '0' ");
$k_post = $res->fetch_array(MYSQLI_NUM);
if($k_post[0]>0){
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content white bold small sh_b">';
$max = 10;
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$cchat_ = $mysqli->query('SELECT * FROM `cchat` WHERE `company` = '.$company['id'].' and `text` != "0" ORDER BY `id` DESC LIMIT '.$start.','.$max.' ');
while ($cchat = $cchat_->fetch_array()){
$res_user = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$cchat['user'].'" ');
$user_ = $res_user->fetch_assoc();
$res_ank = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$cchat['ank'].'" ');
$ank_ = $res_ank->fetch_assoc();
$res_company_user = $mysqli->query('SELECT * FROM `company_user` WHERE `user` = '.$cchat['user'].' and `company` = '.$company['id'].' LIMIT 1');
$company_user_ = $res_company_user->fetch_assoc();
$res2 = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$user_['id'].'" ');
$traning = $res2->fetch_assoc();
if($user_['side'] == 1){$side = 'federation';}else{$side = 'empire';}
if($user_['viz'] > time()-$sql['online']){$viz = '';}else{$viz = '_off';}

if($cchat['text']){
echo '<a class="yellow1" href="/profile/'.$user_['id'].'/"><img class="" height="14" width="14" src="/images/side/'.$side.'/'.$traning['rang'].''.$viz.'.png?1"> <span class="td_u">'.$user_['login'].'</span></a>';








if($cchat['user']!=$user['id']){

$ishodnaya_str="".filter(smile(bb1($cchat['text'])))."";
$format=str_replace(''.$user['login'].'','',$ishodnaya_str);
$the_string = "".filter(smile(bb1($cchat['text'])))."";
$nick = "".$user['login']."";


if (strpos($the_string, $nick) !== false) {
echo ' <font color="#fff800">'.$nick.'</font>';
if($company_user_['company_rang'] == 1){echo '<span class="leader">'.$format.'</span>';}
if($company_user_['company_rang'] == 2){echo '<span class="leader">'.$format.'</span>';}
if($company_user_['company_rang'] == 3){echo '<span class="general">'.$format.'</span>';}
if($company_user_['company_rang'] == 4){echo '<span class="officer">'.$format.'</span>';}
if($company_user_['company_rang'] == 5){echo '<span class="">'.$format.'</span>';}
if($company_user_['company_rang'] == 6){echo '<span class="">'.$format.'</span>';}
if(!$company_user_){echo ' <span class="">'.$format.'</span>';}
}else{
if($company_user_['company_rang'] == 1){echo ' <span class="leader">'.$format.'</span>';}
if($company_user_['company_rang'] == 2){echo ' <span class="leader">'.$format.'</span>';}
if($company_user_['company_rang'] == 3){echo ' <span class="general">'.$format.'</span>';}
if($company_user_['company_rang'] == 4){echo ' <span class="officer">'.$format.'</span>';}
if($company_user_['company_rang'] == 5){echo ' <span class="">'.$format.'</span>';}
if($company_user_['company_rang'] == 6){echo ' <span class="">'.$format.'</span>';}
if(!$company_user_){echo ' <span class="">'.$format.'</span>';}
}




}else{
echo ' <span class="orange"> '.filter(smile(bb1($cchat['text']))).' </span>';
}

echo ' <span class="esmall gray1">'.vremja($cchat['time']).'</span>';

if($cchat['user']!=$user['id']){echo ' <a class="gray1" href="/otvetcc/'.$cchat['id'].'/'.$page.'/">[ответ]</a>';}
if($company_user['company_rang'] <= 2){echo ' <a href="/ccdel/'.$cchat['id'].'/'.$page.'/"><img alt="+" src="/images/tresh1.png" width="16" height="16"></a>';}
echo '<br>';
}

}
if ($k_page > 1) {
echo str(''.$HOME.'cchat/?',$k_page,$page); // Вывод страниц
}
echo '</div></div></div></div></div></div></div></div></div></div>';
}else{
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content white bold small sh_b">';
echo '<center>Сообщений не найдено.</center>';
echo '</div></div></div></div></div></div></div></div></div></div>';
}







$mysqli->query('DELETE FROM `cchat` WHERE `text` = "0" and `time` < "'.time().'"');
require_once ('../system/footer.php');
?>