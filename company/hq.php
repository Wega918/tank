<?php
$title = 'Штаб Дивизии';
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


if($company_user['company_gold_time']<time() and $company_user['company_gold_time'] > 0){
$mysqli->query("UPDATE `company_user` SET `company_gold` = '0', `company_gold_time` = '0' WHERE `id` = '".$company_user['id']."' LIMIT 1");
}


if($company['shtab_param']<30){
$cost_shtab = 800;
}elseif($company['shtab_param']>=30 && $company['shtab_param']<60){
$cost_shtab = 2400;
}elseif($company['shtab_param']>=60 && $company['shtab_param']<90){
$cost_shtab = 4800;
}elseif($company['shtab_param']>=90 && $company['shtab_param']<120){
$cost_shtab = 8000;
}elseif($company['shtab_param']>=120 && $company['shtab_param']<150){
$cost_shtab = 16000;
}elseif($company['shtab_param']>=150){
$cost_shtab = 32000;
}

$res1 = $mysqli->query('SELECT * FROM `prom` WHERE `id` = "1" ');
$prom = $res1->fetch_assoc();

if($prom['time_14']>time()){$cost_shtab = ceil($cost_shtab-($cost_shtab*$prom['act_14']/100));}else{$cost_shtab = $cost_shtab;}



echo '<div class="medium white bold cntr mb2">Штаб дивизии</div>
<div class="trnt-block mb2">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="thumb fl"><img width="50" height="50" src="/images/clan/hq.png" style="width:100%; border-radius: 9px;"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold">
<span class="green2">Военное управление</span><br>
Бонус дивизии: <span class="green1">+'.$company['shtab_param'].'</span> к параметрам
<div class="">Прогресс: '.$company['shtab_param'].' из 160</div>
</div></div>';
if($company_user['company_rang']<=2){
if($company['shtab_param'] < 160){
echo '<div class="bot"><a class="simple-but border" w:id="link" href="?app_ahtab"><span><span>Увеличить бонус +1 за <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.$cost_shtab.'</span></span></a></div>';
}
}
echo '</div>
</div></div></div></div></div></div></div></div>
</div>











<div class="trnt-block" w:id="hq"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content"><div class="white cntr bold sh_b small">

<div class="medium yellow1 pb5">Золотой запас дивизии:</div>
<table><tbody><tr>
<td style="width:50%;border-right:1px solid #D2D2D2;"><center><font color=white size=2%><b>На улучшения<br><img src="/images/icons/gold.png"> '.$company['gold'].'</b></font></center></td>
<td style="width:50%;"><center><font color=white size=2%><b>На усиления<br><img src="/images/icons/gold.png"> '.$company['gold_'].'</b></font></center></td>
</tr></tbody></table>
</div>';

if(($company_user['company_time']+72000)<time()){
if($company_user['company_gold_time']<time()){
echo '<div class="bot"><a class="simple-but border" w:id="link" href="?donate"><span><span>Пополнить на <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> 10</span></span></a></div>';
}else{
echo '<div class="cntr red1 mt5 mb2"><font size=2%><b>Новое пополнение через: '._time($company_user['company_gold_time']-time()).'</b></font></div>';
}
}else{
echo '<div class="cntr red1 mt5 mb2"><font size=2%><b>Новое пополнение через: '._time(($company_user['company_time']+72000)-time()).'</b></font></div>';
}
echo '</div></div></div></div></div></div></div></div></div></div>';




















echo '<a class="simple-but gray mb5" w:id="donateStatsLink" href="/hqstats/"><span><span>Статистика</span></span></a>';
if($company_user['company_rang']<=1){
echo '<a class="simple-but gray mb5" w:id="donateStatsLink" href="?name_company"><span><span>Название дивизии</span></span></a>';
}
if($company_user['company_rang']<=3){
echo '<a class="simple-but gray mb5" w:id="donateStatsLink" href="?new_add"><span><span>Дать объявление</span></span></a>';
}

echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">Пополняя свой счет, вы помогаете дивизии становиться сильнее</div>
</div></div></div></div></div></div></div></div></div></div>';





































##################################################################################################################
##################################################################################################################
##################################################################################################################
if(isset($_GET['donate'])){
if(($company_user['company_time']+72000)>time()){header('Location: ?');exit();}
if($user['gold'] < 10){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.(10-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
if($company_user['company_gold_time']>time()){header('Location: ?');exit();}

$res = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$user['id'].'" LIMIT 1');
$traning = $res->fetch_assoc();
if($traning['rang']<=2){$gold = 10;}elseif($traning['rang']==3){$gold = 20;}elseif($traning['rang']>3){$gold = 30;}

$mysqli->query("UPDATE `company` SET `gold` = '".($company['gold']+5)."', `gold_` = '".($company['gold_']+5)."' WHERE `id` = '".$company['id']."' LIMIT 1");
if(($company_user['company_gold']+10)>=($gold)){
$mysqli->query("UPDATE `company_user` SET `company_gold` = '".($company_user['company_gold']+10)."',  `company_gold_where` = '".($company_user['company_gold_where']+10)."',  `company_gold_time` = '".(time()+72000)."' WHERE `id` = '".$company_user['id']."' LIMIT 1");
}else{
$mysqli->query("UPDATE `company_user` SET `company_gold` = '".($company_user['company_gold']+10)."',  `company_gold_where` = '".($company_user['company_gold_where']+10)."' WHERE `id` = '".$company_user['id']."' LIMIT 1");
}

$_SESSION['err'] = '<div class="trnt-block mb1"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="green1 sh_b mb2">Золотой запас увеличен!</div>
</div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}
##################################################################################################################
##################################################################################################################
##################################################################################################################







##################################################################################################################
##################################################################################################################
##################################################################################################################
if($company_user['company_rang']<=2){
if(isset($_GET['app_ahtab'])){
if($company_user['company_rang']>2){header('Location: ?');exit();}
if($company['gold'] < $cost_shtab){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">Не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_shtab-$company['gold']).' золота</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
if($company['shtab_param'] >= 160){header('Location: ?');exit();}

$mysqli->query("UPDATE `company` SET `gold` = '".($company['gold']-$cost_shtab)."', `shtab_param` = '".($company['shtab_param']+1)."' WHERE `id` = '".$company['id']."' LIMIT 1");

$us_where_company = $mysqli->query('SELECT * FROM `users` WHERE `company` = '.$company['id'].' ');
while ($u_w_c = $us_where_company->fetch_array()){
$res_users_tanks__ = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user`  = "'.$u_w_c['id'].'" and `active`  = "1" limit 1');
$users_tanks__ = $res_users_tanks__->fetch_assoc();
$mysqli->query('UPDATE `users_tanks` SET `a` = "'.($users_tanks__['a']+1).'", `b` = "'.($users_tanks__['b']+1).'", `t` = "'.($users_tanks__['t']+1).'", `p` = "'.($users_tanks__['p']+1).'" WHERE `id` = '.$users_tanks__['id'].'');
}

$text ="<span class='yellow1' w:id='text'>Штаб дивизии улучшен. Бонус ко всем параметрам увеличен.</span>";
$mysqli->query('INSERT INTO `company_add` SET `company` = "'.$company['id'].'", `text` = "'.$text.'", `time` = "'.time().'", `user` = "'.$user['id'].'" ');
$uid1 = mysqli_insert_id($mysqli);
$mysqli->query('UPDATE `users` SET `company_add` = "'.$uid1.'" WHERE `company` = "'.$company['id'].'" ');
$mysqli->query('INSERT INTO `company_log` SET `company` = "'.$company['id'].'", `text` = "'.$text.'", `time` = "'.time().'", `user` = "'.$user['id'].'" ');

$_SESSION['err'] = '<div class="trnt-block mb1"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="green1 sh_b mb2">Военное управление: Штаб дивизии улучшен. Бонус ко всем параметрам увеличен.</div>
</div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}
}
##################################################################################################################
##################################################################################################################
##################################################################################################################








##################################################################################################################
##################################################################################################################
##################################################################################################################
$cost_name = 1000;
if($company_user['company_rang']<=1){
if(isset($_GET['name_company'])){
if($company_user['company_rang']>1){header('Location: ?');exit();}
if($user['gold'] < $cost_name){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_name-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
$_SESSION['err'] = '<div class="small bold cntr orange sh_b mb5">Смена названия дивизии</div>
<div class="mt2 mb2">Стоимость - <img class="ico vm" src="/images/icons/gold.png"> 1000 золота c личного счета.</div>
<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content-mini">
<form w:id="loginForm" id="id2" method="post" action="?submit"><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id2_hf_0" id="id2_hf_0"></div>
<div class="small bold cntr white sh_b mb5">
<div class="mb5">Название дивизии: '.$company['name'].'</div>
Новое название:<br>
<input w:id="newName" type="text" name="newName" value="" class="fld-chng" size="20" maxlength="32"><br>
</div>
<div class="bot">
<span class="input-but border red"><span><input class="w100" type="submit" w:message="value:SettingsPage.changeName" value="СМЕНИТЬ НАЗВАНИЕ"></span></span>
</div>
</form>
</div>
</div></div></div></div></div></div></div></div>
</div>

';
header('Location: ?');
exit();
}


if (isset($_REQUEST['submit'])){
$newName = strong($_POST['newName']);
$res_coll = $mysqli->query("SELECT COUNT(*) FROM `company` WHERE `name` = ".$newName." ");
$res_company_name = $mysqli->query('SELECT * FROM `company` WHERE `name` = "'.$newName.'" ');
$company_name = $res_company_name->fetch_assoc();
if($company_user['company_rang']>1){header('Location: ?');exit();}
if($user['gold'] < $cost_name){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_name-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}

if(empty($newName)){
header('Location: ?');
$_SESSION['err'] = 'Поле "Название дивизии" обязательно для ввода.';
exit();
}
if($company_name['name']){
header('Location: ?');
$_SESSION['err'] = '<font color=red>Такое название дивизии уже существует.</font>';
exit();
}
if($res_coll[0]>0){
header('Location: ?');
$_SESSION['err'] = '<font color=red>Такое название дивизии уже существует.</font>';
exit();
}
if(mb_strlen($newName) > 22 or mb_strlen($newName) < 3){
header('Location: ?');
$_SESSION['err'] = '<font color=red>Минимум 3 Максимум 22 символа.</font>';
exit();
}
/* if( !preg_match("#^([A-zА-я0-9\-\_\ ])+$#ui", $login)){
header('Location: ?');
$_SESSION['err'] = '<font color=red>Ошибка символов</font>';
exit();
} */

$mysqli->query("UPDATE `company` SET `name` = '".$newName."' WHERE `id` = '".$company['id']."' LIMIT 1");
$mysqli->query("UPDATE `users` SET `gold` = '".($user['gold']-$cost_name)."' WHERE `id` = '".$user['id']."' LIMIT 1");

$text ="<span class='yellow1' w:id='text'>Изменено название дивизии!</span>";
$mysqli->query('INSERT INTO `company_add` SET `company` = "'.$company['id'].'", `text` = "'.$text.'", `time` = "'.time().'", `user` = "'.$user['id'].'" ');
$uid1 = mysqli_insert_id($mysqli);
$mysqli->query('UPDATE `users` SET `company_add` = "'.$uid1.'" WHERE `company` = "'.$company['id'].'" ');
$mysqli->query('INSERT INTO `company_log` SET `company` = "'.$company['id'].'", `text` = "'.$text.'", `time` = "'.time().'", `user` = "'.$user['id'].'" ');
$_SESSION['err'] = '<div class="trnt-block mb1"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="green1 sh_b mb2">Название дивизии успешно изменено!</div>
</div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}


}
##################################################################################################################
##################################################################################################################
##################################################################################################################























##################################################################################################################
##################################################################################################################
##################################################################################################################
if($company_user['company_rang']<=3){
if(isset($_GET['new_add'])){
if($company_user['company_rang']>3){header('Location: ?');exit();}
$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">

<form w:id="loginForm" id="id2" method="post" action="?submit1"><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id2_hf_0" id="id2_hf_0"></div>


<font color=white>Введите текст объявления:</font><br>
<form class="pb10" w:id="newPmForm" id="id2" method="post" action="?submit1"><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id2_hf_0" id="id2_hf_0"></div>
<div class="cntr mb5"><textarea w:id="message" rows="3" name="add" class="w90 p0 m0"></textarea></div>
<div class="bot"><div class="input-but border w50 m0a"><span><input class="w100" type="submit" w:message="value:MessagePage.send" value="Отправить"></span></div></div>
</form>

</form>
</div></div></div></div></div></div></div></div></div></div><br>';
header('Location: ?');
exit();
}


if (isset($_REQUEST['submit1'])){
$add = strong($_POST['add']);
if($company_user['company_rang']>3){header('Location: ?');exit();}
if(empty($add)){
header('Location: ?');
$_SESSION['err'] = 'Поле "Объявление" обязательно для ввода.';
exit();
}
if(mb_strlen($add) > 300 or mb_strlen($add) < 1){
header('Location: ?');
$_SESSION['err'] = '<font color=red>Минимум 1 Максимум 300 символов.</font>';
exit();
}

$text ="<span class='yellow1' w:id='text'>".$add."</span>";
$mysqli->query('INSERT INTO `company_add` SET `company` = "'.$company['id'].'", `text` = "'.$text.'", `time` = "'.time().'", `user` = "'.$user['id'].'" ');
$uid1 = mysqli_insert_id($mysqli);
$mysqli->query('UPDATE `users` SET `company_add` = "'.$uid1.'" WHERE `company` = "'.$company['id'].'" ');
$mysqli->query('INSERT INTO `company_log` SET `company` = "'.$company['id'].'", `text` = "'.$text.'", `time` = "'.time().'", `user` = "'.$user['id'].'" ');

header('Location: ?');
exit();
}


}
##################################################################################################################
##################################################################################################################
##################################################################################################################







require_once ('../system/footer.php');
?>