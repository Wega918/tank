<?php
$title = 'Сопровождение';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}
/* if($user['id'] != 1){
header('Location: /');
exit();
}
 */
$res = $mysqli->query('SELECT * FROM `convoy_user` WHERE `user`  = "'.$user['id'].'" limit 1');
$c_user = $res->fetch_assoc();

if(!$c_user){
$mysqli->query('INSERT INTO `convoy_user` SET `level` = "1", `user` = "'.$user['id'].'"');
}

if($c_user['vrag'] >0){
header('Location: /convoy/boy/');
exit();
}

echo '<div class="trnt-block" w:id="root"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">';
if($c_user['time'] < time()){
echo '<div class="small white cntr sh_b bold mb5" w:id="nop">Танк готов к сопровождению!</div>';
echo '<div class="cntr"><a w:id="actLink" href="?start"><img w:id="pic" src="/images/convoy/logo.png"></a></div>';
//echo '<div class="small white cntr sh_b bold mb5" w:id="nop">отправляйтесь в бой</div>';
echo '<div class="bot"><a class="simple-but border" w:id="findEnemy" href="?start"><span><span>Начать разведку</span></span></a></div>';
}else{
$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user`  = "'.$user['id'].'" LIMIT 1');
$a_users = $res->fetch_assoc();
echo '<div w:id="event"><div class="small white cntr sh_b bold">Ваш танк обнаружен<br>Применение маскировки<div class="dhr mt5 mb5"></div></div></div>';
echo '<div class="small white cntr sh_b bold mb2">Слава — <img class="ico vm" src="/images/icons/glory.png" alt="Слава" title="Слава"> '.$a_users['glory'].'</div>';
echo '<div class="cntr"><a w:id="actLink" href="?start"><img w:id="pic" src="/images/convoy/logo.png"></a></div>';
echo '<div class="small white cntr sh_b bold p5">Полная маскировка через <span id="time_'.($c_user['time']-time()).'000">'._time($c_user['time']-time()).'</span></div>';
echo '<div class="bot"><a class="simple-but border gray" w:id="refresh" href="/convoy/"><span><span>Обновить</span></span></a></div>';
}
echo '</div></div></div></div></div></div></div></div></div></div></div>';

echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini"><div class="mt5 mb5 small green1 cntr">Чем сильнее враг, тем выше награда за его уничтожение</div></div></div></div></div></div></div></div></div></div></div>';

echo '<div class="bot"><a class="simple-but border gray mb2" href="/"><span><span>Вернуться в ангар</span></span></a></div>';




#################################################################################################################################################################################################################
if(isset($_GET['start'])){
if($c_user['time'] > time()){header('Location: ?');exit();}
if($c_user['level'] == 1){$rand = rand(1,3);$rand2 = rand(1,3);}
if($c_user['level'] == 2){$rand = rand(2,6);$rand2 = rand(2,6);}
if($c_user['level'] == 3){$rand = rand(3,9);$rand2 = rand(3,9);}
if($c_user['level'] == 4){$rand = rand(4,12);$rand2 = rand(4,12);}
if($c_user['level'] >= 5){$rand = rand(5,14);$rand2 = rand(5,14);}

if($c_user['level']>=8){
$mysqli->query("UPDATE `convoy_user` SET `level` = '1', `atack` = '0', `vrag` = '".($rand)."', `vrag2` = '".($rand2)."' WHERE `id` = '".$c_user['id']."' LIMIT 1");
}else{
$mysqli->query("UPDATE `convoy_user` SET `atack` = '0', `vrag` = '".($rand)."', `vrag2` = '".($rand2)."' WHERE `id` = '".$c_user['id']."' LIMIT 1");
}

header('Location: /convoy/boy/');
exit();
}




///###############################################################################################################################################
?>
<div id="pokazat"> 
<a href="#" onClick="document.getElementById('pokazat').style.display='none';document.getElementById('skryt').style.display='';return false;"><center><font size=2>Подробная информация</font></center></a>
</div> 


<div id="skryt" style="display:none"><?

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////





///<img width="16" height="16" alt="Коллекционный предмет" src="/images/colections/34.png" title="Коллекционный предмет">

/* Во время Cопровождения можно найти ценные ресурсы для постройки зданий Базы и Золото.
<br><br> */
echo '<a class="blck p5 forum">
<font size=2 color=green>
Конвой - это место, где можно добыть боевую славу, которая даст мощный + к параметрам! 
<br><br>
Вам предстоит провести 5 боёв по 2 врага. <br>
Между боями перерыв - 40 минут. 
<br><br>

На битву с врагами вам отведено по 3 выстрела. <br>
Если вы не уничтожили врага, вам засчитывается поражение, врагу - бегство, 
а ваша награда уменьшается в 2 раза (с округлением в большую сторону).
<br><br>
После проведения 5 боёв, с момента открытия первого конвоя, время и счётчик конвоя будут обнулены (время ожидания следующего сопровождения 3 часа). 
</font></a>';

?>
<a class="blck p5 forum"></a>
<a href="#vrag" onClick="document.getElementById('pokazat1').style.display='none';document.getElementById('skryt1').style.display='';return false;"><center><span style="color:lawngreen;"><u>Виды врагов</u></span></a> / <a href="#" onClick="document.getElementById('skryt').style.display='none';document.getElementById('pokazat').style.display='';return false;">Закрыть</center></a><br>
</div><?
///###############################################################################################################################################









///###############################################################################################################################################
?>
<div id="pokazat1"></div>





<div id="skryt1" style="display:none">

<br>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/Infantry.png"><br><br>Пехота (30 хп) - награда: <img border="0" src="/images/icons/glory.png"> 2 славы<br></center>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/Detachment.png"><br><br>Минометный расчет (60 хп)- награда: <img border="0" src="/images/icons/glory.png"> 3 славы<br></center>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/Tractor.png"><br><br>Тягач (90 хп) - награда: <img border="0" src="/images/icons/glory.png"> 3 славы<br></center>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/Radar.png"><br><br>РЛУ (135 хп) - награда: <img border="0" src="/images/icons/glory.png"> 4 славы<br></center>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/Bike.png"><br><br>Мотоцикл (180 хп) - награда: <img border="0" src="/images/icons/glory.png"> 4 славы<br></center>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/AntiTankGun.png"><br><br>Противотанковая установка(240 хп)- награда: <img border="0" src="/images/icons/glory.png"> 5 славы<br></center>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/Jeep.png"><br><br>Военный джип (300 хп) - награда: <img border="0" src="/images/icons/glory.png"> 6 славы<br></center>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/AntiAirCraft.png"><br><br>Мобильная зенитка(400 хп) - награда: <img border="0" src="/images/icons/glory.png"> 7 славы<br></center>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/BTR.png"><br><br>БТР (500 хп) - награда: <img border="0" src="/images/icons/glory.png"> 8 славы<br></center>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/ChemicalTank.png"><br><br>Химический танк(650 хп) - награда: <img border="0" src="/images/icons/glory.png"> 9 славы<br></center>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/RocketLaunchers.png"><br><br>Реактивные миномёты(800 хп) - награда: <img border="0" src="/images/icons/glory.png"> 9 славы<br></center>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/SAU.png"><br><br>САУ (1000 хп) - награда: <img border="0" src="/images/icons/glory.png"> 10 славы<br></center>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/Tank.png"><br><br>Танк (1200 хп) - награда: <img border="0" src="/images/icons/glory.png"> 10 славы<br></center>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/ArmoredTrain.png"><br><br>Бронепоезд (1600хп) - награда: <img border="0" src="/images/icons/glory.png"> 11 славы<br></center>

<br><a class="blck p5 forum"></a><a href="#vrag" onClick="document.getElementById('skryt1').style.display='none';document.getElementById('pokazat1').style.display='';return false;"><center>Закрыть</center></center></a><br>

</div><?
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//require_once ('../system/footer.php');
?>