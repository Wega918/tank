<?php
$title = 'Авторизация';
require_once ('../system/function.php');
require_once ('../system/header.php');
if($user['id']){
header('Location: /');
exit();
}
##############################
####### Главная #############
##############################


if (isset($_SESSION['okpass'])){
?>
<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini cntr">
<?=$_SESSION['okpass']?>
</div></div></div></div></div></div></div></div></div></div>
<?php
unset($_SESSION['okpass']);
}


if (isset($_SESSION['err_pass'])){
?>
<div class="buy-place-block"><div class="feedbackPanelERROR"><div class="line1"><span class="feedbackPanelERROR">
<?=$_SESSION['err_pass']?>
</span></div></div></div>
<?php
unset($_SESSION['err_pass']);
}




echo '
<form id="id2" method="post" action=""><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id2_hf_0" id="id2_hf_0"></div>
<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="small white bold cntr sh_b mb5">
Введите email, который указывали при регистрации:<br>
<input type="text" name="email" value="" class="fld-chng mt5" size="20" maxlength="32"><br>
</div>
<div class="bot">
<span class="input-but red border"><span><input class="w100" type="submit" name="submit" value="Восстановить пароль"></span></span>
</div>
</div>
</div></div></div></div></div></div></div></div>
</div>
</form>';





if(isset($_REQUEST['submit'])){
$email = ($_POST['email']);

if(empty($email)){
header('Location: /pass/');
$_SESSION['err_pass'] = ' Поле "Email" обязательно для ввода. ';
exit();
}
if (!preg_match('/[0-9a-z_\-]+@[0-9a-z_\-^\.]+\.[a-z]{2,6}/i', $email)) {
header('Location: /pass/');
$_SESSION['err_pass'] = 'Поле "Email" заполнено не верно.';
exit();
}
$sqldb_email = mysql_fetch_array(mysql_query("SELECT `email` FROM `users` WHERE `email`='".$email."' LIMIT 1"));
if(!empty($email)) if($sqldb_email == 0){
header('Location: /pass/');
$_SESSION['err_pass'] = ' Пользователь с таким Email-адресом не найден. <hr>'.$email.'';
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
$rou = make_password($dlina); 


mysql_query("UPDATE `users` SET `passw` = '".$rou."', `pass` = '".md5(md5(md5($rou)))."' WHERE `login` = '".$login."'");

$title = 'От support@tank.mobi';
$msg = 'Здравствуйте, '.$login.'!
Вами (или нет) была произведена операция по восстановлению пароля на сайте /

Ваши новые данные для авторизации:
-------------------------
Логин: '.$login.'
Пароль: '.$rou.'
-------------------------

С Уважением, '.$NameGame.' !
Служба поддержки: support@airbizz.mobi


Время заявки: '.date("Y-m-d H:i:s").'
Устройство: '.strong($_SERVER['HTTP_USER_AGENT']).'
IP устройства: '.strong($_SERVER['REMOTE_ADDR']).' ';

$subject = 'Восстановление доступа';
mail($email, $subject, $msg, 'From: support@mtank.ru');
/*
<?php 
mail("testfozzy.testfozzy@outlook.com", "My Subject", "Line 1\nLine 2\nLine 3"); 
?>
*/
//mail($email,$subject,$msg,"From: '.$NameGame.'");
header('Location: /pass/');
$_SESSION['okpass'] = 'На указанный Email-адрес  '.$email.'  было выслано письмо с Вашими новыми регистрациоными данными. <br> <font color=black>(Проверяйте так же папку "Спам"!) ';
exit();
}

echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">
Техподдержка: <b>lovekent5246@gmail.com</b>
</div>
</div></div></div></div></div></div></div></div></div></div>';


echo '<a class="simple-but gray mb10" href="/"><span><span>На главную</span></span></a>';


//require_once ('../system/footer.php');
?>