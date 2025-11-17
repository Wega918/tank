<?php
$title = 'Штаб Дивизии';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']) {
header('Location: /');
exit();
}
if($user['company']<=0) {header('Location: /');exit();}
$id = abs(intval($_GET['id']));
$res_company_ank = $mysqli->query('SELECT * FROM `company_user` WHERE `user` = '.$id.' and `company` = '.$user['company'].' LIMIT 1');
$company_ank = $res_company_ank->fetch_assoc();
if($company_ank == 0){header('Location: /');exit();}
if(!$company_ank){header('Location: /');exit();}
if($company_ank['company']!=$user['company']){header('Location: /');exit();}


$res_company_user = $mysqli->query('SELECT * FROM `company_user` WHERE `user` = '.$user['id'].' and `company` = '.$user['company'].' LIMIT 1');
$company_user = $res_company_user->fetch_assoc();
if($company_user['company_rang']>3){header('Location: /');exit();}

$res_company = $mysqli->query('SELECT * FROM `company` WHERE `id` = '.$user['company'].' LIMIT 1');
$company = $res_company->fetch_assoc();

$res_user_ank = $mysqli->query('SELECT * FROM `users` WHERE `id` = '.$company_ank['user'].' LIMIT 1');
$ank = $res_user_ank->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$ank['id'].'" LIMIT 1');
$traning = $res->fetch_assoc();










if($traning['rang']==1){$rang = 'Кадет';}
if($traning['rang']==2){$rang = 'Рядовой';}
if($traning['rang']==3){$rang = 'Сержан';}
if($traning['rang']==4){$rang = 'Лейтинант';}
if($traning['rang']==5){$rang = 'Старший лейтенант';}
if($traning['rang']==6){$rang = 'Капитан';}
if($traning['rang']==7){$rang = 'Майор';}
if($traning['rang']==8){$rang = 'Подполковник';}
if($traning['rang']==9){$rang = 'Полковник';}


if($company_ank['company_rang'] == 1){$company_rang = '<span class="leader" w:id="rank">комдив</span>';}
if($company_ank['company_rang'] == 2){$company_rang = '<span class="leader" w:id="rank">замкомдив</span>';}
if($company_ank['company_rang'] == 3){$company_rang = '<span class="general" w:id="rank">генерал</span>';}
if($company_ank['company_rang'] == 4){$company_rang = '<span class="officer" w:id="rank">офицер</span>';}
if($company_ank['company_rang'] == 5){$company_rang = '<span class="" w:id="rank">рядовой</span>';}
if($company_ank['company_rang'] == 6){$company_rang = '<span class="" w:id="rank">новичок</span>';}


if($company['side'] == 1){$side = 'federation';}else{$side = 'empire';}

$res = $mysqli->query('SELECT * FROM `avatars_user` WHERE `user` = "'.$ank['id'].'" and `act` = "1" ');
$ava_us_ = $res->fetch_assoc();

echo'<div class="white medium bold cntr mb2">Личное дело "'.$ank['login'].'"</div>
<div class="trnt-block mb2">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="thumb fl"><a w:id="avatarStoreLink"><img alt="avatar" w:id="avatarImage" src="/images/avatar/'.$ava_us_['images'].'" style="width:100%; border-radius: 9px;"><span class="mask1">&nbsp;</span></a></div>
<div class="ml58 small white sh_b bold">
<span class="green2">'.nick($ank['id']).'</span>';
echo ' (Дивизия <a href="/company/'.$ank['company'].'/"><span class="green2">'.$company['name'].'</span></a>)';
echo '<br>
<img src="/images/icons/victory.png"> Звание: <span w:id="rank">'.$rang.'</span><br>
<img src="/images/icons/exp.png"> Уровень: '.$ank['level'].'<br>
<img src="/images/icons/victory.png"> Звание в дивизии: <span w:id="rank">'.$company_rang.'</span><br>
<img src="/images/side/'.$side.'.png?1"> Дней в дивизии: '.floor((time()-$company_ank['company_time'])/86400).'<br>
<img src="/images/side/'.$side.'.png?1"> Дата вступления: '.vremja($company_ank['company_time']).'<br>
<img src="/images/icons/exp.png"> Опыт дивизии: '.n_f($company_ank['company_exp']).'<br>
<img src="/images/icons/exp.png"> Опыт после обнуления: '.n_f($company_ank['company_exp_stats']).'<br>
</div>
<div class="clrb"></div>';



if($company_ank['company_rang'] > $company_user['company_rang']){
if($company_ank['user'] != $company_user['user']){
echo '<hr><center><form action="" method="POST">
Звание: <select name="company_rang" style="width: 30%;">';
if($company_user['company_rang']==1){
echo '<option value="1">комдив</option>
<option value="2">замкомдив</option>
<option value="3">генерал</option>
<option value="4">офицер</option>
<option value="5">рядовой</option>
<option value="6">новичок</option>';
}
if($company_user['company_rang']==2){
echo '<option value="3">генерал</option>
<option value="4">офицер</option>
<option value="5">рядовой</option>
<option value="6">новичок</option>';
}
if($company_user['company_rang']==3){
echo '<option value="4">офицер</option>
<option value="5">рядовой</option>
<option value="6">новичок</option>';
}
echo '</select>
<input type="submit" name="ok" value="Изменить">
</form></center>';
}
}




















echo '<hr><table><tbody><tr>';



if($company_user['company_rang']<=3 and $company_ank['company_rang']>$company_user['company_rang']){
if(($company_ank['company_time']+72000)>time()){
echo '<div class="cntr small gray1">Исключить из дивизии '._time(($company_ank['company_time']+72000)-time()).'</div>';
echo '<td class="w50 p1"><div style="position:relative;"><a class="simple-but border red mb5" w:id="trofiesLink" href="?del_'.$company_ank['user'].'"><span><span>Исключить за <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> 100 </span></span></a></div></td>';
}else{
echo '<td class="w50 p1"><div style="position:relative;"><a class="simple-but border red mb5" w:id="trofiesLink" href="?del_'.$company_ank['user'].'"><span><span>Исключить</span></span></a></div></td>';
}
}

echo '</tr></tbody></table>';




if(isset($_GET['del_'.$company_ank['user'].''])){
if($company_user['company_rang']>3 and $company_ank['company_rang']<=$company_user['company_rang']){header('Location: ?');exit();}
if(($company_ank['company_time']+72000)>time()){
$_SESSION['ses'] = '<div class="buy-place-block pt2 mb10">
<div class="medium bold white cntr sh_b mt5 mb5">Исключить игрока из дивизии за <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> 100 золота с личного счета?</div>
<a class="simple-but border w50 mXa mb10" w:id="confirmLink" href="?del_'.$company_ank['user'].'_"><span><span>да, подтверждаю</span></span></a>
<a class="simple-but border red w50 mXa" w:id="cancelLink" href="?"><span><span>нет, отмена</span></span></a>
</div>';
}else{
$_SESSION['ses'] = '<div class="buy-place-block pt2 mb10">
<div class="medium bold white cntr sh_b mt5 mb5">Исключить игрока из дивизии?</div>
<a class="simple-but border w50 mXa mb10" w:id="confirmLink" href="?del_'.$company_ank['user'].'_"><span><span>да, подтверждаю</span></span></a>
<a class="simple-but border red w50 mXa" w:id="cancelLink" href="?"><span><span>нет, отмена</span></span></a>
</div>';
}
header('Location: ?');
exit();
}



if(isset($_GET['del_'.$company_ank['user'].'_'])){
if($company_user['company_rang']>3 and $company_ank['company_rang']<=$company_user['company_rang']){header('Location: ?');exit();}

if(($company_ank['company_time']+72000)>time()){
if($user['gold'] < 100){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.(100-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
$mysqli->query("UPDATE `users` SET `gold` = '".($user['gold']-100)."' WHERE `id` = '".$user['id']."' LIMIT 1");
}

$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user`  = "'.$ank['id'].'" and `active`  = "1" limit 1');
$users_tanks = $res->fetch_assoc();
$mysqli->query('UPDATE `users_tanks` SET `a` = "'.($users_tanks['a']-$company['shtab_param']).'", `b` = "'.($users_tanks['b']-$company['shtab_param']).'", `t` = "'.($users_tanks['t']-$company['shtab_param']).'", `p` = "'.($users_tanks['p']-$company['shtab_param']).'" WHERE `id` = '.$users_tanks['id'].'');
if($company_ank['polygon_time']>time() ){
$mysqli->query('UPDATE `users_tanks` SET `a` = "'.($users_tanks['a']-40).'", `b` = "'.($users_tanks['b']-40).'", `t` = "'.($users_tanks['t']-40).'", `p` = "'.($users_tanks['p']-40).'" WHERE `id` = '.$users_tanks['id'].'');
}
$res = mysqli_query($mysqli,'SELECT sum(rang) FROM crew_user WHERE `user`  = "'.$ank['id'].'"');
if (FALSE === $res) die("Select sum failed: ".mysqli_error);
$row = mysqli_fetch_row($res);
$sum = $row[0];
$mysqli->query('UPDATE `company` SET `lvl_crew` = "'.($company['lvl_crew']-$sum).'" WHERE `id` = '.$company['id'].'');
$mysqli->query('UPDATE `users` SET `company` = "0", `company_add` = "0" WHERE `id` = '.$ank['id'].'');
$mysqli->query('DELETE FROM `company_zayavki` WHERE `user` = "'.$ank['id'].'" ');
$mysqli->query('DELETE FROM `company_zayavki` WHERE `ank` = "'.$ank['id'].'" ');
$mysqli->query('DELETE FROM `company_user` WHERE `user` = "'.$ank['id'].'" '); #########

$text = "<span class='red1'>исключен из дивизию</span>";
$mysqli->query('INSERT INTO `company_log` SET `company` = "'.$company['id'].'", `text` = "'.$text.'", `time` = "'.time().'", `ank` = "'.$ank['id'].'", `user` = "'.$user['id'].'" ');
$_SESSION['err'] = 'Игрок исключен из дивизии!';
header('Location: /company/'.$company['id'].'/');
exit();
}
















echo '</div></div></div></div></div></div></div></div></div></div>';









$res_us_rang_2 = $mysqli->query('SELECT * FROM `company_user` WHERE `company_rang`  = "2" and `company` = '.$user['company'].' LIMIT 1');
$us_rang_2 = $res_us_rang_2->fetch_assoc();
###################################################################################################################################
if(isset($_REQUEST['ok'])){
$company_rang = strong($_POST['company_rang']);
if($company_rang>6){header('Location: ?');exit();}
if($company_rang<=0){header('Location: ?');exit();}
if($company_user['company_rang']>3){header('Location: ?');exit();}

if($company_rang==1){
if($company_user['company_rang']!=1){$_SESSION['err'] = 'Вы не можете повысить этого игрока до комдива.';header('Location: ?');exit();}
if((floor((time()-$company_ank['company_time'])/86400))<30){$_SESSION['err'] = 'Чтобы повысить до комдива, этот игрок должен провести в дивизии 30 дней и более.';header('Location: ?');exit();}
$_SESSION['ses'] = '<div class="buy-place-block pt2 mb10">
<div class="medium bold white cntr sh_b mt5 mb5">Передать комдива этому игроку?</div>
<a class="simple-but border w50 mXa mb10" w:id="confirmLink" href="?ok_komdiv"><span><span>да, подтверждаю</span></span></a>
<a class="simple-but border red w50 mXa" w:id="cancelLink" href="?"><span><span>нет, отмена</span></span></a>
</div>';

}

if($company_rang==2){
if($company_user['company_rang']!=1){$_SESSION['err'] = 'Вы не можете повысить этого игрока до замкомдива.';header('Location: ?');exit();}
if($us_rang_2){$_SESSION['err'] = 'В дивизии может быть только один замкомдив.';header('Location: ?');exit();}
if($company_ank['company_rang']<2){
$text ="<span class='red1'>понижен в звании</span>: <span class='leader' w:id='rank'>замкомдив</span>";
}else{
$text ="<span class='green1'>повышен в звании</span>: <span class='leader' w:id='rank'>замкомдив</span>";
}
$mysqli->query('INSERT INTO `company_log` SET `company` = "'.$company['id'].'", `text` = "'.$text.'", `time` = "'.time().'", `ank` = "'.$ank['id'].'", `user` = "'.$user['id'].'" ');
$mysqli->query('UPDATE `company_user` SET `company_rang` = "2" WHERE `id` = "'.$company_ank['id'].'" LIMIT 1');
}

if($company_rang==3){
if($company_user['company_rang']>=3){$_SESSION['err'] = 'Вы не можете повысить этого игрока до генерала.';header('Location: ?');exit();}
if($company_ank['company_rang']<3){
$text ="<span class='red1'>понижен в звании</span>: <span class='general' w:id='rank'>генерал</span>";
}else{
$text ="<span class='green1'>повышен в звании</span>: <span class='general' w:id='rank'>генерал</span>";
}
$mysqli->query('INSERT INTO `company_log` SET `company` = "'.$company['id'].'", `text` = "'.$text.'", `time` = "'.time().'", `ank` = "'.$ank['id'].'", `user` = "'.$user['id'].'" ');
$mysqli->query('UPDATE `company_user` SET `company_rang` = "3" WHERE `id` = "'.$company_ank['id'].'" LIMIT 1');
}

if($company_rang==4){
if($company_user['company_rang']>=$company_ank['company_rang']){$_SESSION['err'] = 'Действие невозможно.';header('Location: ?');exit();}
if($company_ank['company_rang']<4){
$text ="<span class='red1'>понижен в звании</span>: <span class='officer' w:id='rank'>офицер</span>";
}else{
$text ="<span class='green1'>повышен в звании</span>: <span class='officer' w:id='rank'>офицер</span>";
}
$mysqli->query('INSERT INTO `company_log` SET `company` = "'.$company['id'].'", `text` = "'.$text.'", `time` = "'.time().'", `ank` = "'.$ank['id'].'", `user` = "'.$user['id'].'" ');
$mysqli->query('UPDATE `company_user` SET `company_rang` = "4" WHERE `id` = "'.$company_ank['id'].'" LIMIT 1');
}

if($company_rang==5){
if($company_user['company_rang']>=$company_ank['company_rang']){$_SESSION['err'] = 'Действие невозможно.';header('Location: ?');exit();}
if($company_ank['company_rang']<5){
$text ="<span class='red1'>понижен в звании</span>: <span class='' w:id='rank'>рядовой</span>";
}else{
$text ="<span class='green1'>повышен в звании</span>: <span class='' w:id='rank'>рядовой</span>";
}
$mysqli->query('INSERT INTO `company_log` SET `company` = "'.$company['id'].'", `text` = "'.$text.'", `time` = "'.time().'", `ank` = "'.$ank['id'].'", `user` = "'.$user['id'].'" ');
$mysqli->query('UPDATE `company_user` SET `company_rang` = "5" WHERE `id` = "'.$company_ank['id'].'" LIMIT 1');
}

if($company_rang==6){
if($company_user['company_rang']>=$company_ank['company_rang']){$_SESSION['err'] = 'Действие невозможно.';header('Location: ?');exit();}
$text ="<span class='red1'>понижен в звании</span>: <span class='' w:id='rank'>новичок</span>";
$mysqli->query('INSERT INTO `company_log` SET `company` = "'.$company['id'].'", `text` = "'.$text.'", `time` = "'.time().'", `ank` = "'.$ank['id'].'", `user` = "'.$user['id'].'" ');
$mysqli->query('UPDATE `company_user` SET `company_rang` = "6" WHERE `id` = "'.$company_ank['id'].'" LIMIT 1');
}

header('Location: ?');
exit();
}
###################################################################################################################################


if(isset($_GET['ok_komdiv'])){
if($company_user['company_rang']!=1){$_SESSION['err'] = 'Вы не можете повысить этого игрока до комдива.';header('Location: ?');exit();}
if((floor((time()-$company_ank['company_time'])/86400))<30){$_SESSION['err'] = 'Чтобы повысить до комдива, этот игрок должен провести в дивизии 30 дней и более.';header('Location: ?');exit();}
$text ="<span class='green1'>повышен в звании</span>: <span class='leader' w:id='rank'>комдив</span>";
$mysqli->query('INSERT INTO `company_log` SET `company` = "'.$company['id'].'", `text` = "'.$text.'", `time` = "'.time().'", `ank` = "'.$ank['id'].'", `user` = "'.$user['id'].'" ');
$text ="<span class='red1'>понижен в звании</span>: <span class='general' w:id='rank'>генерал</span>";
$mysqli->query('INSERT INTO `company_log` SET `company` = "'.$company['id'].'", `text` = "'.$text.'", `time` = "'.time().'", `ank` = "'.$user['id'].'", `user` = "'.$ank['id'].'" ');
$mysqli->query('UPDATE `company_user` SET `company_rang` = "1" WHERE `id` = "'.$company_ank['id'].'" LIMIT 1');
$mysqli->query('UPDATE `company_user` SET `company_rang` = "3" WHERE `id` = "'.$company_user['id'].'" LIMIT 1');
header('Location: ?');
exit();
}
















$arr_text = array(
1 => "Передать лидерство можно участнику дивизии, пробывшему в ней не менее 30 дней"); 
$rand_text = rand(1,1);
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">'.$arr_text[$rand_text].'</div>
</div></div></div></div></div></div></div></div></div></div>';





require_once ('../system/footer.php');
?>