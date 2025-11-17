<?php
$title = 'Танки';
require_once ('system/function.php');
require_once ('system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}


if($user['login'] == 'Незнакомец'){
require_once ('save.php');
}else{




/* $res = $mysqli->query('SELECT * FROM `nick_history` WHERE `user` = '.$user['id'].' ');
$n_h = $res->fetch_assoc();
 */
 
 
$res = $mysqli->query("SELECT COUNT(*) FROM `nick_history` WHERE `user` = ".$user['id']." ");
$n_h_c = $res->fetch_array(MYSQLI_NUM);
if($n_h_c[0]==0){
$bespl = 2;
}elseif($n_h_c[0]==1){
$bespl = 1;
}elseif($n_h_c[0]>=2){
$bespl = 0;
}


$res = $mysqli->query("SELECT COUNT(*) FROM `sex_history` WHERE `user` = ".$user['id']." ");
$s_h_c = $res->fetch_array(MYSQLI_NUM);
if($s_h_c[0]==0){
$bespl_s = 2;
}elseif($s_h_c[0]==1){
$bespl_s = 1;
}elseif($s_h_c[0]>=2){
$bespl_s = 0;
}


$res = $mysqli->query("SELECT COUNT(*) FROM `side_history` WHERE `user` = ".$user['id']." ");
$si_h_c = $res->fetch_array(MYSQLI_NUM);
if($si_h_c[0]==0){
$bespl_si = 2;
}elseif($si_h_c[0]==1){
$bespl_si = 1;
}elseif($si_h_c[0]>=2){
$bespl_si = 0;
}


$res = $mysqli->query('SELECT * FROM `avatars_user` WHERE `user` = "'.$user['id'].'" and `act` = "1" ');
$ava_us_ = $res->fetch_assoc();

echo '<div class="small bold cntr orange sh_b mb5">Основная информация</div>';
echo '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="small bold white sh_b mb5">Ваш портрет</div>


<center><div class="thumb"><a w:id="avatarStoreLink" href="/avatars/"><img alt="avatar" w:id="avatarImage" src="/images/avatar/'.$ava_us_['images'].'" style="width:100%; border-radius: 9px;"><span class="mask1">&nbsp;</span></a></div></center>

</div></div></div></div></div></div></div></div></div></div>';
//<div><a class="green1 small bold td_u" w:id="changeAvatarLink" href="avatars">Сменить портрет</a></div>








echo '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="small bold white sh_b">Ваше имя: '.$user['login'].'</div>';


?><span id="pokazat"><a onclick="document.getElementById('pokazat').style.display='none';document.getElementById('skryt').style.display='';return false;" href="#"><div class="green1 small bold td_u">Сменить имя</div></a></span><?

?><span id="skryt" style="display:none"><a onclick="document.getElementById('skryt').style.display='none';document.getElementById('pokazat').style.display='';return false;" href="#"></a>

<div class="fight center">

<form w:id="loginForm" id="id2" method="post" action=""><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id2_hf_0" id="id2_hf_0"></div>
<div class="small bold cntr white sh_b mb5"><div class="mb5">Бесплатных смен: <?=$bespl?></div>Новое имя:<br><input w:id="newLogin" type="text" name="login" value="" class="fld-chng" size="20" maxlength="32"><br></div>
<div class="bot"><span class="input-but border red"><span><input class="w100" type="submit" name="submit" w:message="value:SettingsPage.changeName" value="Сменить имя"></span></span></div>
</form>

<br>
<div class="wrap-content-mini small green1 cntr"><div class="mt5">Первые две смены бесплатно.<br>Каждая последующая смена - <img class="ico vm" src="/images/icons/gold.png?1"> 250 золота</div></div>
</div></span><?




if(isset($_REQUEST['submit'])) {
$login = strong($_POST['login']);

$res = $mysqli->query('SELECT * FROM `users` WHERE `login`  = "'.$login.'" ');
$sql1 = $res->fetch_assoc();

if($bespl<=0){if($user['gold']<250){
$_SESSION['err'] = '<div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.(250-$user['gold']).' золота</div>';
header('Location: ?');
exit();
}}
if(empty($login)){
header('Location: ?');
$_SESSION['err'] = 'Поле "Новый ник" обязательно';
exit();
}
if($sql1['id']){
header('Location: ?');
$_SESSION['err'] = 'Такое имя уже существует.';
exit();
}
if(mb_strlen($login) > 29 or mb_strlen($login) < 5){
header('Location: ?');
$_SESSION['err'] = 'Минимум 5 максимум 30 символов.';
exit();
}
if( !preg_match("#^([A-zА-я0-9\-\_\ ])+$#ui", $login)){
header('Location: ?');
$_SESSION['err'] = 'Ошибка символов';
exit();
}

$mysqli->query('INSERT INTO `nick_history` SET `user` = "'.$user['id'].'", `nick_c` = "'.$login.'", `nick_old` = "'.$user['login'].'", `time` = "'.time().'" ');

if($bespl>0){
$mysqli->query('UPDATE `users` SET `login` = "'.$login.'" WHERE `id` = '.$user['id'].' LIMIT 1');
}else{
$mysqli->query('UPDATE `users` SET `login` = "'.$login.'", `gold` = "'.($user['gold']-250).'" WHERE `id` = '.$user['id'].' LIMIT 1');
}

setcookie('uslog', $login, time()+86400*31, '/');
$_SESSION['ses'] = '<div class="green1 small bold">Настройки успешно сохранены!</div>';
header('Location: ?');
exit();
}


echo '</div></div></div></div></div></div></div></div></div></div>';

























if($user['sex']==1){$sex = 'Мужской';}else{$sex = 'Женский';}
echo '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="small bold white sh_b">Ваш пол: '.$sex.'</div>';


?><span id="sex"><a onclick="document.getElementById('sex').style.display='none';document.getElementById('sex_').style.display='';return false;" href="#"><div class="green1 small bold td_u">Сменить пол</div></a></span><?
?><span id="sex_" style="display:none"><a onclick="document.getElementById('sex_').style.display='none';document.getElementById('sex').style.display='';return false;" href="#"></a>

<div class="fight center">

<form w:id="sexForm" id="id2" method="post" action="?sex"><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id2_hf_0" id="id2_hf_0"></div>
<div class="small bold cntr white sh_b mb5"><div class="mb5">Бесплатных смен: <?=$bespl_s?></div></div>
<div class="bot"><span class="input-but border red"><span><input class="w100" type="submit" w:message="value:SettingsPage.changeSex" value="Сменить пол"></span></span></div>
</form>

<br>
<div class="wrap-content-mini small green1 cntr"><div class="mt5">Первые две смены бесплатно.<br>Каждая последующая смена - <img class="ico vm" src="/images/icons/gold.png?1"> 250 золота</div></div>
</div></span><?




if(isset($_GET['sex'])){
if($bespl_s<=0){if($user['gold']<250){
$_SESSION['err'] = '<div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.(250-$user['gold']).' золота</div>';
header('Location: ?');
exit();
}}
if($user['sex']==2){
$res = $mysqli->query('SELECT * FROM `avatars_user` WHERE `images` = "1.jpg" and `user` = "'.$user['id'].'"');
$ava_us = $res->fetch_assoc();
if(!$ava_us){
$mysqli->query('UPDATE `avatars_user` SET `act` = "0" WHERE `user` = '.$user['id'].' ');
$mysqli->query('INSERT INTO `avatars_user` SET `user` = "'.$user['id'].'", `sex` = "1", `images` = "1.jpg", `act` = "1" ');
}else{
$mysqli->query('UPDATE `avatars_user` SET `act` = "0" WHERE `user` = '.$user['id'].' ');
$mysqli->query('UPDATE `avatars_user` SET `act` = "1" WHERE `user` = '.$user['id'].' and `images` = "1.jpg" and `sex` = "1" LIMIT 1');
}
$mysqli->query('INSERT INTO `sex_history` SET `user` = "'.$user['id'].'", `sex_c` = "1", `sex_old` = "'.$user['sex'].'", `time` = "'.time().'" ');
if($bespl_s>0){
$mysqli->query('UPDATE `users` SET `sex` = "1" WHERE `id` = '.$user['id'].' LIMIT 1');
}else{
$mysqli->query('UPDATE `users` SET `sex` = "1", `gold` = "'.($user['gold']-250).'" WHERE `id` = '.$user['id'].' LIMIT 1');
}
}else{
$res = $mysqli->query('SELECT * FROM `avatars_user` WHERE `images` = "2.jpg" and `user` = "'.$user['id'].'"');
$ava_us = $res->fetch_assoc();
if(!$ava_us){
$mysqli->query('UPDATE `avatars_user` SET `act` = "0" WHERE `user` = '.$user['id'].' ');
$mysqli->query('INSERT INTO `avatars_user` SET `user` = "'.$user['id'].'", `sex` = "2", `images` = "2.jpg", `act` = "1" ');
}else{
$mysqli->query('UPDATE `avatars_user` SET `act` = "0" WHERE `user` = '.$user['id'].' ');
$mysqli->query('UPDATE `avatars_user` SET `act` = "1" WHERE `user` = '.$user['id'].' and `images` = "2.jpg" and `sex` = "2" LIMIT 1');
}
$mysqli->query('INSERT INTO `sex_history` SET `user` = "'.$user['id'].'", `sex_c` = "2", `sex_old` = "'.$user['sex'].'", `time` = "'.time().'" ');
if($bespl_s>0){
$mysqli->query('UPDATE `users` SET `sex` = "2" WHERE `id` = '.$user['id'].' LIMIT 1');
}else{
$mysqli->query('UPDATE `users` SET `sex` = "2", `gold` = "'.($user['gold']-250).'" WHERE `id` = '.$user['id'].' LIMIT 1');
}
}





$_SESSION['ses'] = '<div class="green1 small bold">Настройки успешно сохранены!</div>';
header('Location: ?');
exit();
}
echo '</div></div></div></div></div></div></div></div></div></div>';

























echo '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="small bold white sh_b">Ваш пароль: *</div>';


?><span id="pass"><a onclick="document.getElementById('pass').style.display='none';document.getElementById('pass_').style.display='';return false;" href="#"><div class="green1 small bold td_u">Сменить пароль</div></a></span><?
?><span id="pass_" style="display:none"><a onclick="document.getElementById('pass_').style.display='none';document.getElementById('pass').style.display='';return false;" href="#"></a>

<div class="fight center">

<form w:id="sexForm" id="id2" method="post" action="?pass"><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id2_hf_0" id="id2_hf_0"></div>
<div class="small bold cntr white sh_b mb5">
Текущий пароль:<br>
<input w:id="currentPassword" type="text" name="p" value="" class="fld-chng" size="20" maxlength="32"><br>
Новый пароль:<br>
<input w:id="newPassword" type="text" name="np" value="" class="fld-chng" size="20" maxlength="32"><br>
</div>
<div class="bot">
<span class="input-but border red"><span><input class="w100" type="submit" w:message="value:SettingsPage.submitNewPassword" value="Изменить"></span></span>
</div>
</form>
<br>

</div></span><?

if(isset($_GET['pass'])){
$p = strong($_POST['p']);
$np = strong($_POST['np']);
if(empty($p)){header('Location: ?');$_SESSION['err'] = 'Поле "Текущий пароль" обязательно для ввода.';exit();}
if(empty($np)){header('Location: ?');$_SESSION['err'] = 'Поле "Новый пароль" обязательно для ввода.';exit();}
if($user['passw']!=$p){header('Location: ?');$_SESSION['err'] = 'Ошибка! Текущий пароль не совпадает.';exit();}
if(mb_strlen($p) < 5){header('Location: ?');$_SESSION['err'] = 'Ошибка! Введите пароль больше 5 символов.';exit();}
if(mb_strlen($np) < 5){header('Location: ?');$_SESSION['err'] = 'Ошибка! Введите пароль больше 5 символов.';exit();}
if( !preg_match("#^([A-zА-я0-9\-\_\ ])+$#ui", $np)){header('Location: ?');$_SESSION['err'] = 'Ошибка символов.';exit();}
$mysqli->query('UPDATE `users` SET `pass` = "'.md5(md5(md5($np))).'", `passw` = "'.$np.'" WHERE `id` = '.$user['id'].' LIMIT 1');
setcookie('uspass', md5(md5(md5($np))), time()+86400*31, '/');
$_SESSION['ses'] = '<div class="green1 small bold">Настройки успешно сохранены!<hr>
Новый пароль: <b>'.$np.'</b></div>';
header('Location: ?');
exit();
}
echo '</div></div></div></div></div></div></div></div></div></div>';











echo '<div class="small bold cntr orange sh_b mb5">Дополнительная информация</div>';


echo '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="small bold white sh_b">Дата регистрации: '.vremja($user['datareg']).'</div>
<div class="small bold white sh_b">ID вашего танка: '.($user['id']).'</div>';





/* $res = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `id_miss` = "9" limit 1');
$miss = $res->fetch_assoc();
if($miss['prog']<$miss['prog_max'] and $miss['time']<time()){
 */
if($user['email'] != '0'){
$email = $user['email'];
$length = strpos($email, '@') - 3;
$asterisk = '.';
for($i = 1; $i < $length; $i++)
$asterisk .= '.'; 
$email = substr_replace($email, $asterisk, 3, $length);



echo '<div class="small bold white sh_b">Ваш email: '.$email.'</div>';
}elseif($user['email_code'] == '0' and $user['email'] == '0'){
echo '<hr><form w:id="sexForm" id="id2" method="post" action="?email"><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id2_hf_0" id="id2_hf_0"></div>
<div class="small bold cntr white sh_b mb5">Введите E-mail:<br><input w:id="currentPassword" type="text" name="email" value="" class="fld-chng" size="20" maxlength="32"><br></div>
<div class="bot"><span class="input-but border red"><span><input class="w100" type="submit" w:message="value:SettingsPage.submitNewPassword" value="Изменить"></span></span></div>
</form><br>';
if(isset($_GET['email'])){
$email = strong($_POST['email']);
if(empty($email)){
header('Location: ?');
$_SESSION['err'] = ' Поле "Email" обязательно для ввода. ';
exit();
}
if (!preg_match('/[0-9a-z_\-]+@[0-9a-z_\-^\.]+\.[a-z]{2,6}/i', $email)) {
$_SESSION['err'] = "<font color=red>Формат e-mail введён неверно!</font>";
header('Location: ?');
exit();
}
$res = $mysqli->query('SELECT * FROM `users` WHERE `email`  = "'.$email.'" ');
$sqlemail = $res->fetch_assoc();
if($sql1['id']){
$_SESSION['err'] = "<font color=red>Такой e-mail уже существует!</font>";
header('Location: ?');
exit();
}
function make_password($num_chars){
if ((is_numeric($num_chars)) && ($num_chars > 0) && (!is_null($num_chars))){
$password = ""; 
$accepted_chars="abcGdefghHiFXZBVNPERRGjklmnUopqGGFGrstHuvwKxyzl234567890"; 
if (necessary.srand(((int)((double)microtime()*100000000000003)))); 
for ($i= 0; $i < $num_chars; $i++){ 
$random_number = rand(0, (strlen($accepted_chars)-1)); $password .= $accepted_chars[$random_number]; 
} 
return $password; 
} 
} 
$dlina=8; //количество символов в пароле 
$email_code = make_password($dlina); 

$mysqli->query('UPDATE `users` SET `email_code` = "'.$email_code.'", `email_` = "'.$email.'" WHERE `id` = '.$user['id'].' LIMIT 1');
$title = 'От support@mtank.ru';
$msg = 'Здравствуйте, '.$user['login'].'!
Вами (или нет) была произведена операция по подтверждению адреса электронной почты на сайте '.$HOME.'

Введите данный код на странице '.$HOME.'settings/
-------------------------
Код подтверждения: '.$email_code.'
-------------------------

С Уважением, Танки онлайн!
Служба поддержки: support@mtank.ru


Время заявки: '.date("Y-m-d H:i:s").'
Устройство: '.strong($_SERVER['HTTP_USER_AGENT']).'
IP: '.strong($_SERVER['REMOTE_ADDR']).' ';

$subject = 'Подтверждения почты';
mail($email, $subject, $msg, 'From: support@mtank.ru');

$_SESSION['ses'] = "<div class='green1 small bold'>На указанный Email ".$email."  было выслано письмо с кодом подтверждения. <br> <font color=white>(Проверяйте также папку Спам!) </div>";
header('Location: ?');
exit();
}




}elseif($user['email_code'] != '0' and $user['email'] == '0'){
echo '<hr><form w:id="sexForm" id="id2" method="post" action="?code"><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id2_hf_0" id="id2_hf_0"></div>
<div class="small bold cntr white sh_b mb5">Введите код подтверждения:<br><input w:id="currentPassword" type="text" name="code" value="" class="fld-chng" size="20" maxlength="32"><br></div>
<div class="bot"><span class="input-but border red"><span><input class="w100" type="submit" w:message="value:SettingsPage.submitNewPassword" value="Подтвердить"></span></span></div>
</form><br>
<div class="small cntr mt10"><a class="gray1" href="?exit" w:id="remindEmail">Отменить операцию</a></div>';

if(isset($_GET['exit'])){
$mysqli->query('UPDATE `users` SET `email_code` = "0" WHERE `id` = '.$user['id'].' LIMIT 1');
header('Location: ?');
exit();
}


//  fmElX9dR


if(isset($_GET['code'])){
$code = strong($_POST['code']);
if($user['email_code'] == $code){
$mysqli->query('UPDATE `users` SET `email` = "'.$user['email_'].'" WHERE `id` = '.$user['id'].' LIMIT 1');
####################################################################################
$res = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `id_miss` = "9" limit 1');
$miss = $res->fetch_assoc();
if($miss['prog']<$miss['prog_max'] and $miss['time']<time()){
$mysqli->query('UPDATE `missions_user` SET `prog` = `prog` + "1" WHERE `user` = '.$user['id'].' and `id_miss` = "9" and `prog` < "1" and `time` < "'.time().'" limit 1');
$_SESSION['miss'] = 1;
}
####################################################################################
$_SESSION['ses'] = "<div class='green1 small bold'>Вы успешно поддтвердили E-mail адрес.</div>";
header('Location: ?');
exit();
}
}
}
//}

echo '</div></div></div></div></div></div></div></div></div></div>';







if($user['side']==1){$side = 'Федерация';}else{$side = 'Империя';}
echo '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="small bold white sh_b">Ваша армия: '.$side.'</div>';

?><span id="side"><a onclick="document.getElementById('side').style.display='none';document.getElementById('side_').style.display='';return false;" href="#"><div class="green1 small bold td_u">Сменить армию</div></a></span><?
?><span id="side_" style="display:none"><a onclick="document.getElementById('side_').style.display='none';document.getElementById('side').style.display='';return false;" href="#"></a>

<div class="fight center">

<form w:id="sexForm" id="id2" method="post" action="?side"><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id2_hf_0" id="id2_hf_0"></div>
<div class="small bold cntr white sh_b mb5"><div class="mb5">Бесплатных смен: <?=$bespl_si?></div></div>
<div class="bot"><span class="input-but border red"><span><input class="w100" type="submit" w:message="value:SettingsPage.changeSex" value="Сменить армию"></span></span></div>
</form>

<br>
<div class="wrap-content-mini small green1 cntr"><div class="mt5">Первые две смены бесплатно.<br>Каждая последующая смена - <img class="ico vm" src="/images/icons/gold.png?1"> 500 золота</div></div>
</div></span><?




if(isset($_GET['side'])){
if($user['company']!=0){
$_SESSION['err'] = 'Вы не можете сменить армию, пока находитесь в дивизии';
header('Location: ?');
exit();
}
if($bespl_si<=0){if($user['gold']<500){
$_SESSION['err'] = '<div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.(500-$user['gold']).' золота</div>';
header('Location: ?');
exit();
}}
if($user['side']==2){
$mysqli->query('INSERT INTO `side_history` SET `user` = "'.$user['id'].'", `side_c` = "1", `side_old` = "'.$user['side'].'", `time` = "'.time().'" ');
if($bespl_si>0){
$mysqli->query('UPDATE `users` SET `side` = "1" WHERE `id` = '.$user['id'].' LIMIT 1');
}else{
$mysqli->query('UPDATE `users` SET `side` = "1", `gold` = "'.($user['gold']-500).'" WHERE `id` = '.$user['id'].' LIMIT 1');
}
}else{
$mysqli->query('INSERT INTO `side_history` SET `user` = "'.$user['id'].'", `side_c` = "2", `side_old` = "'.$user['side'].'", `time` = "'.time().'" ');
if($bespl_si>0){
$mysqli->query('UPDATE `users` SET `side` = "2" WHERE `id` = '.$user['id'].' LIMIT 1');
}else{
$mysqli->query('UPDATE `users` SET `side` = "2", `gold` = "'.($user['gold']-500).'" WHERE `id` = '.$user['id'].' LIMIT 1');
}
}
$_SESSION['ses'] = '<div class="green1 small bold">Настройки успешно сохранены!</div>';
header('Location: ?');
exit();
}
echo '</div></div></div></div></div></div></div></div></div></div>';










$res = $mysqli->query("SELECT COUNT(*) FROM `ref` WHERE `user` = ".$user['id']." ");
$ref = $res->fetch_array(MYSQLI_NUM);
echo '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">';



?><span id="ref_open"><a onclick="document.getElementById('ref_open').style.display='none';document.getElementById('ref_cloce').style.display='';return false;" href="#">
<div class="small bold white sh_b">Приглашено друзей: <?=$ref[0]?></div>
<div><div class="small bold td_u green1" w:id="affiliatePageLink">Пригласить друзей</div></div></a></span><?


?><span id="ref_cloce" style="display:none"><a onclick="document.getElementById('ref_cloce').style.display='none';document.getElementById('ref_open').style.display='';return false;" href="#"></a>

<div class="fight center">


<div class="imgtxt bshd wht btxt">
<div class="thumb fl"><img src="/images/unit_data_block_image.jpg" alt="image"><span class="mask1">&nbsp;</span></div>
<div class="ml58 small white sh_b bold blck">
<span class="green2">Приглашай друзей в игру и получай игровое золото!</span><br>
</div>
<div class="clrb"></div>
</div>

<hr>


<div class="small white sh_b bold">
<img src="/images/icons/star.png"> При достижении 20 уровня другом, ты получишь бонус 100 золота!<br>
<img src="/images/icons/star.png"> <span class="green1">20%</span> купленного другом золота будет попадать тебе.<br>
<img src="/images/icons/star.png"> Золото выдается из наших резервов, а не за счет друга.<br>
</div>
<br>
<div class="cntr green2 small bold">
Скопируйте ссылку и отправьте другу:
<div class="yellow1 mt2"><?=$HOME?>start/<?=$user['id']?>/</div>
</div>






</div></span><?


echo '</div></div></div></div></div></div></div></div></div></div>';


/* <hr>
<div class="cntr green2 small bold">
Пригласил: 0<br>
Ваш бонус: <img height="14" width="14" src="/images/icons/gold.png?2"> 0
</div> */







/* 
echo '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="small bold white sh_b">Фон ангара: включен</div>
<div><a class="green1 small bold td_u" w:id="changeBgStatusLink" href="settings?26-1.ILinkListener-changeBgStatusLink">Отключить фон ангара</a></div>
</div></div></div></div></div></div></div></div></div></div>';


echo '<div class="trnt-block mb5">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content cntr">
<div class="small bold white sh_b">Подсказки: включены</div>
<div><a class="green1 small bold td_u" w:id="changeHintStatusLink" href="settings?26-1.ILinkListener-changeHintStatusLink">Выключить подсказки</a></div>
</div>
</div></div></div></div></div></div></div></div>
</div>';


echo '<div class="trnt-block mb5">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content cntr">
<div class="small bold white sh_b">Журнал боя: 20 строк</div>
<div><a class="green1 small bold td_u" w:id="changeLogSizeLink" href="setting/log">Изменить количество</a></div>
</div>
</div></div></div></div></div></div></div></div>
</div>';


echo '<div class="trnt-block mb5">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content cntr">
<div class="small bold white sh_b">Приглашено друзей: 0</div>
<div><a class="small bold td_u green1" w:id="affiliatePageLink" href="invfriends">Пригласить друзей</a></div>
</div>
</div></div></div></div></div></div></div></div>
</div>';


echo '<a w:id="remindPassword" class="simple-but gray" href="remindpassword"><span><span>Забыли пароль?</span></span></a>';





echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">'.$arr_text[$rand_text].'</div>
</div></div></div></div></div></div></div></div></div></div>'; */



}
require_once ('system/footer.php');
?>