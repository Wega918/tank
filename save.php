<?php
if($user['login'] == 'Незнакомец'){
echo '<div class="trnt-block" style="margin-bottom:5px;"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">

<div class="cntr white sh_b bold small pb10"><div class="bold green1">Сохрани игру и получи</div>
<div class="yellow1"><img src="/images/icons/fuel.png"> 300 топлива <img src="/images/icons/gold.png"> 1000 золота</div><br>
<form method="POST" action="">
Введите ник:<br>
<input type="text" name="login" value="" class="fld-chng" size="20" maxlength="16"><br>

Введите пароль:<br>
<input type="text" name="password" value="" class="fld-chng" size="20" maxlength="32"><br>

Выберите пол<br><select style="width: 50%;" name="sex">
<option selected="selected" value="1">Мужской</option>
<option value="2">Женский</option>
</select><br>

</div>

<center><input type="submit" name="reg" value="Сохранить"></center></form>

</div></div></div></div></div></div></div></div></div></div>';


//-----Если жмут submit(кнопку)-----//
if(isset($_REQUEST['reg'])){

$login = strong($_POST['login']);
$password = strong($_POST['password']);
$sex = strong($_POST['sex']);

if(empty($login)){
header('Location: ?');
$_SESSION['err'] = 'Поле "Ник" обязательно.';
exit();
}
if(empty($password)){
header('Location: ?');
$_SESSION['err'] = 'Поле "Пароль" обязательно.';
exit();
}
if (!preg_match("#^([A-zА-я0-9\-\_\ ])+$#ui", $password)){
header('Location: '.$HOME.'');
$_SESSION['err'] = '<font color=red>Пароль должен содердать только Русские или Английские буквы, цифры!</font>';
exit();
}
if(mb_strlen($password) > 25 or mb_strlen($password) < 5){
header('Location: '.$HOME.'');
$_SESSION['err'] = 'Введите пароль от 5 до 25 символов!</font>';
exit();
}
if (!preg_match("#^([A-zА-я0-9\-\_\ ])+$#ui", $login)){
header('Location: '.$HOME.'');
$_SESSION['err'] = '<font color=red>Только Русские или Английские буквы, цифры!</font>';
exit();
}
if(mb_strlen($login) > 16 or mb_strlen($login) < 3){
header('Location: '.$HOME.'');
$_SESSION['err'] = '<font color=red>Введите ник от 3 до 15 символов!</font>';
exit();
}

$res = $mysqli->query(' SELECT `login`,`pass` FROM `users` WHERE `login` = "'.$login.'"');
$col_login = $res->fetch_assoc();
if($col_login!=0){
header('Location: '.$HOME.'');
$_SESSION['err'] = '<font color=red>Такой ник уже существует!</font>';
exit();
}


$mysqli->query("UPDATE `users` SET `passw` = '".$password."', `gold` = '".($user['gold']+1000)."', `fuel` = '".($user['fuel']+300)."', `login` = '".$login."', `pass` = '".(md5(md5(md5($password))))."', `sex` = '".$sex."' WHERE `id` = '".$user['id']."' LIMIT 1");

$res = $mysqli->query('SELECT * FROM `avatars_user` WHERE `images` = "'.$sex.'.jpg" and `user` = "'.$user['id'].'" ');
$ava_us = $res->fetch_assoc();
if(!$ava_us){
$mysqli->query('UPDATE `avatars_user` SET `act` = "0" WHERE `user` = '.$user['id'].' ');
$mysqli->query('INSERT INTO `avatars_user` SET `user` = "'.$user['id'].'", `sex` = "'.$sex.'", `images` = "'.$sex.'.jpg", `act` = "1" ');
}

setcookie('uslog', '',time()+86400*365,'/');
setcookie('uspass', '',time()+86400*365,'/');

setcookie('uslog',$login,time()+86400*365,'/');
setcookie('uspass',(md5(md5(md5($password)))),time()+86400*365,'/');
header('Location: ?');
$_SESSION['err'] = '<center><div class="green1"><b>Ура! Ваши данные сохранены!</b></div>
<div class="white">Ваш логин: <font color="red1">'.$login.'</font></div>
<div class="white">Ваш пароль: <font color="red1">'.$password.'</font></div></center>';
require_once ('system/footer.php');
}


}else{
header('Location: /');
exit();
}
?> 