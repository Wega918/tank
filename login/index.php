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
switch($_GET['act']){
default:
echo '
<div class="cntr mb2"><img style="max-width:300px;width:100%;" w:id="logo" src="/images/logo3.jpg"><br></div>
<a class="simple-but border" style="max-width:300px;width:100%;margin-left:auto;margin-right:auto;" w:id="startLink" href="'.$HOME.'start/"><span><span>Начать игру</span></span></a>


<form w:id="loginForm" id="id1" method="post" action="?act=true"><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id1_hf_0" id="id1_hf_0"></div>
<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="cntr white small sh_b bold mb10">
Вход для зарегистрированных<br><br>
Имя танка:<br>
<input type="text" name="login" value="" class="fld-chng" size="20" maxlength="32" w:id="login"><br>
Пароль:<br>
<input type="password" name="password" value="" class="fld-chng" size="20" maxlength="32" w:id="password">
</div>
<div class="bot mXa w200px">
<span class="input-but border"><span><input class="w100" type="submit" w:message="value:LoginPage.submit" value="Войти"></span></span>
</div>
</div>
</div></div></div></div></div></div></div></div>
</div>
</form>
<div class="small cntr mb10"><a class="gray1" href="/pass/" w:id="remindPassword">Забыли пароль?</a></div>';

break;
##############################
####### Кейс проверки ########
##############################
case 'true':

$login = strong($_POST['login']);
$password = strong($_POST['password']);
$pass = md5(md5(md5(strong($_POST['password']))));

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

$res = $mysqli->query(' SELECT `login`,`pass` FROM `users` WHERE `login` = "'.$login.'" and `pass`= "'.$pass.'" LIMIT 1 ');
$dbsql = $res->fetch_assoc();
if(!empty($login) && !empty($pass)) if($dbsql==0){
header('Location: ?');
$_SESSION['err'] = 'Поле "Ник", или "Пароль" неверны.';
exit();
}

setcookie('uslog', $dbsql['login'], time()+86400*365, '/');
setcookie('uspass', $pass, time()+86400*365, '/');
header('location: /');
exit();
break;
}

require_once ('../system/footer.php');
?>