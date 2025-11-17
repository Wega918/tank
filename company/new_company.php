<?php
$title = 'Cоздание Дивизии';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']) {
header('Location: /');
exit();
}
if($user['company']>0) {
header('Location: /company/'.$user['company'].'/');
exit();
}




if(isset($_POST['name'])){
$name = strong($_POST['name']);
if($user['company']>0) {
header('Location: /company/'.$user['company'].'/');
exit();
}

$res = $mysqli->query("SELECT COUNT(*) FROM `company` WHERE `name` = '".$name."' ");
$k_post = $res->fetch_array(MYSQLI_NUM);
if($k_post[0]>0){
header("Location: /new_company/");
$_SESSION['err'] = 'Дивизия с таким названием уже существует!';
exit;
}
if(mb_strlen($name) > 30 or mb_strlen($name) < 5){
header('Location: '.$HOME.'');
$_SESSION['err'] = 'Длина названия должна быть в пределах 5 - 30 символов';
exit();
}
if($user['gold'] < 2500){
$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.(2500-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}



$res = mysqli_query($mysqli,'SELECT sum(rang) FROM crew_user WHERE `user`  = "'.$user['id'].'"');
if (FALSE === $res) die("Select sum failed: ".mysqli_error);
$row = mysqli_fetch_row($res);
$sum = $row[0];


$mysqli->query('INSERT INTO `company` SET `time_obnul_gold` = "'.(time()).'", `time_obnul_exp` = "'.(time()).'", `lvl_crew` = "'.$sum.'", `user` = "'.$user['id'].'", `time` = "'.(time()).'", `name` = "'.$name.'", `side` = "'.$user['side'].'" ');
$uid = mysqli_insert_id($mysqli);

if($user['side'] == 1){$side = 'federation';}else{$side = 'empire';}
if($user['viz'] > time()-$sql['online']){$viz = '';}else{$viz = '_off';}

$mysqli->query('DELETE FROM `company_zayavki` WHERE `user` = "'.$user['id'].'" ');
$mysqli->query('DELETE FROM `company_zayavki` WHERE `ank` = "'.$user['id'].'" ');
$mysqli->query('DELETE FROM `company_user` WHERE `user` = "'.$user['id'].'" ');
$text ="<span class='yellow1' w:id='text'>Дивизия Создана!</span>";
$mysqli->query('INSERT INTO `company_log` SET `company` = "'.$uid.'", `text` = "'.$text.'", `time` = "'.time().'", `user` = "'.$user['id'].'" ');
$mysqli->query('INSERT INTO `company_user` SET `company` = "'.$uid.'", `company_rang` = "1", `company_time` = "'.time().'", `user` = "'.$user['id'].'"  ');
$mysqli->query('INSERT INTO `company_add` SET `company` = "'.$uid.'", `text` = "'.$text.'", `time` = "'.time().'", `user` = "'.$user['id'].'" ');
$uid1 = mysqli_insert_id($mysqli);
$mysqli->query('UPDATE `users` SET `gold` = "'.($user['gold']-2500).'", `company_add` = "'.$uid1.'", `company` = "'.$uid.'"  WHERE `id` = "'.$user['id'].'" LIMIT 1');
header("Location: /company/".$uid."/");
exit;
}








echo '<form w:id="inputForm" id="id7" method="post" action=""><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id7_hf_0" id="id7_hf_0"></div>
<div class="trnt-block" style="margin-bottom:25px;">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="cntr white sh_b bold small pb10">
Введите название дивизии:<br>
<input placeholder="Введите название" type="text" name="name" value="" class="fld-chng" size="20" maxlength="32"><br>
<div class="nwr mt5">Цена: <img title="Золото" alt="Золото" src="/images/icons/gold.png?1"> 2500 золота</div>
</div>
<div class="bot"><span class="input-but border"><span><input class="w100" type="submit" w:message="value:CreateClanPage.submit" value="Создать"></span></span></div>
</div>
</div></div></div></div></div></div></div></div>
</div>
</form>';



require_once ('../system/footer.php');
?>