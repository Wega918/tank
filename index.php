<?php
$title = 'Танки';
require_once ('system/function.php');
require_once ('system/header.php');


//$mysqli->query('INSERT INTO `start` (`step`) VALUES (1) LIMIT 1');
//$mysqli->query('UPDATE `start` SET `step` = `step` + "1" WHERE `id` = "1" LIMIT 1');
//$users_tanks = mysqli_fetch_assoc(mysqli_query("SELECT * FROM `users_tanks` WHERE `user`  = '".$user['id']."' and `active`  = '1' "));

/*
$sql = "SELECT * FROM `start` WHERE `step` = "1"";
$result = $mysqli->query($sql);
$row = $result->fetch_array(MYSQLI_NUM);
echo $row[0]; // кол-во строк с значением `step` = "2"
*/

/*
$res = $mysqli->query('SELECT * FROM `users` WHERE `id` = "1" ');
$row = $res->fetch_assoc();
echo ''.$row['login'].''; // вывод переменной
*/

/*
$result = $mysqli->query("SELECT COUNT(*) FROM `users` WHERE `sex` = '1'");
$sex_m = $result->fetch_array(MYSQLI_NUM);

echo ''.$sex_m[0].' ';
*/







/* 
$res = $mysqli->query('SELECT * FROM `buildings_user` WHERE `id` ');
while ($build = $res->fetch_array()){
$pas = rand(1000000000,9000000000);
$pass = md5(md5(md5($pas)));
$login = 'Незнакомец';
$mysqli->query('INSERT INTO `users` (`side`, `login`, `passw`, `pass`, `datareg`, `sex` ) VALUES ("1", "'.$login.'", "'.$pas.'", "'.$pass.'", "'.time().'", "1" ) ');
$uid = rand(1000000000,9000000000);
$mysqli->query('INSERT INTO `traning` SET `user` = '.$uid.' ');
$mysqli->query('INSERT INTO `ammunition_users` SET `user` = '.$uid.' ');
$mysqli->query('INSERT INTO `buildings_user` SET `user` = '.$uid.' ');
$mysqli->query('INSERT INTO `battle` SET `user` = '.$uid.' ');
$mysqli->query('INSERT INTO `buildings_polygon` SET `user` = '.$uid.' ');
$mysqli->query('INSERT INTO `crew` SET `user` = '.$uid.' ');
$mysqli->query('INSERT INTO `missions_user` SET `user` = '.$uid.' ');
$mysqli->query('INSERT INTO `start` SET `user` = '.$uid.' ');
$mysqli->query('INSERT INTO `users` SET `user` = '.$uid.' ');
$mysqli->query('INSERT INTO `users_tanks` SET `user` = '.$uid.' ');
$mysqli->query('INSERT INTO `users_tanks_pimp` SET `user` = '.$uid.' ');
}
  */














if(!$user['id']) {
echo '<div class="cntr mb2"><img style="max-width:300px;width:100%;" w:id="logo" src="/images/logo3.jpg"><br></div>
<a class="simple-but border" style="max-width:300px;width:100%;margin-left:auto;margin-right:auto;" w:id="startLink" href="/start/"><span><span>Начать игру</span></span></a>
<a class="simple-but gray border" style="max-width:300px;width:100%;margin-left:auto;margin-right:auto;" w:id="showSigninLink" href="/login/"><span><span>Я уже играл</span></span></a>';
}else{



####################################################################################
$id_miss = 36;$prog_max = 5;
$res = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `id_miss` = "'.$id_miss.'" limit 1');
$miss = $res->fetch_assoc();
if(!$miss){
$mysqli->query('INSERT INTO `missions_user` SET `user` = '.$user['id'].', `tip` = "6" , `id_miss` = "'.$id_miss.'", `prog_max` = "'.$prog_max.'" ');
}
####################################################################################

if($user['level']>=3 and $miss['time']<time()){
$res1 = $mysqli->query('SELECT * FROM `missions` WHERE `id` = "'.$miss['id_miss'].'" LIMIT 1 ');
$m = $res1->fetch_assoc();

$rc_u_a = $mysqli->query('SELECT * FROM `company_user_assault` WHERE `user` = '.$user['id'].' LIMIT 1');
$c_u_a = $rc_u_a->fetch_assoc();

if($user['level']>=10 and $miss['prog']==0){
$mysqli->query('UPDATE `missions_user` SET `prog` = "1" WHERE `id` = '.$miss['id'].'');
}
if($user['company']!=0 and $miss['prog']==1){
$mysqli->query('UPDATE `missions_user` SET `prog` = "2" WHERE `id` = '.$miss['id'].'');
}
if($c_u_a['1_coll']!=0 and $miss['prog']==2){
$mysqli->query('UPDATE `missions_user` SET `prog` = "3" WHERE `id` = '.$miss['id'].'');
}


$width = round(100/($m['prog']/($miss['prog']+0.0000001)));
if($width > 100) {$width = 100;}

if($m['gold']>0){$gold = $m['gold'];$gold_ = '<img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> '.$gold.'';$gold__ = 'золота';}else{$gold = 0;$gold_ = '';$gold__ = '';}


echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="imgtxt bshd wht btxt">
<div class="thumb fl"><img src="/images/unit_data_block_image.jpg" alt="image" style="width:100%; border-radius: 9px;"><span class="mask1">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">'.$m['name'].'</span>
<br>';
if($miss['prog']==0){
echo '1. Получить <img class="vb"  height="14" width="14" src="/images/icons/exp.png"> 10 уровень.<br>';
}elsE{
echo '<img src="/images/ok.png" alt="image"> 1. <font color=grey><strike>Получить <img class="vb"  height="14" width="14" src="/images/icons/exp.png"> 10 уровень.</strike></font><br>';
}
if($miss['prog']<=1){
echo '2. Вступить в дивизию.<br>';
}elsE{
echo '<img src="/images/ok.png" alt="image"> 2. <font color=grey><strike>Вступить в дивизию.</strike></font><br>';
}
if($miss['prog']<=2){
echo '3. Пройти спецзадание в дивиизии.<br>';
}elsE{
echo '<img src="/images/ok.png" alt="image"> 3. <font color=grey><strike>Пройти спецзадание в дивиизии.</strike></font><br>';
}
if($miss['prog']<=3){
echo '4. Провести одно сражение.<br>';
}elsE{
echo '<img src="/images/ok.png" alt="image"> 4. <font color=grey><strike>Провести одно сражение.</strike></font><br>';
}
if($miss['prog']<=4){
echo '5. Поучаствовать в битвах.<br>';
}elsE{
echo '<img src="/images/ok.png" alt="image"> 5. <font color=grey><strike>Поучаствовать в битвах.</strike></font><br>';
}





echo '</div><div class="white cntr bold sh_b small pb2">';// '.$miss['id'].' '.$miss['id_miss'].'
if($miss['prog']>=0){
echo '<table class="rblock esmall mb0"><tbody><tr>
<td><div class="value-block lh1"><span><span>'.$miss['prog'].'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$width.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$m['prog'].'</span></span></div></td>
</tr></tbody></table>';
}
echo '<span class="gray1">награда:</span> <span class="green2"><span class="nwr"> '.$gold_.' '.$silver_.' '.$exp_.' '.$crewpoints_.' '.$fuel_.' '.$snaryad_.' '.$snaryad__.' </span></span><br>';

echo '</div>';
if($miss['prog']>=$m['prog']){
echo '<div class="bot">
<a class="simple-but border mb10" href="?'.$miss['id'].'"><span><span>Получить награду</span></span></a>
<div style="position:relative;"><span class="digit2 esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span></div>
</div>';
echo '<div class="trnt-block mb15"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"></div></div></div></div></div></div></div></div></div>';
}


if($miss['prog']<$m['prog']){
echo '<div class="dhr a_w50 mt5 mb5"></div>
<div class="mt5 mb5 small green1 cntr">Все условия командира необходимо выполнять по порядку!</div>';
}
echo '<div class="clrb"></div></div>

</div></div></div></div></div></div></div></div></div></div>';


if(isset($_GET[''.$miss['id'].''])){
if($miss['prog']<$m['prog']){header('Location: ?');exit();}
if($miss['time']>time()){header('Location: ?');exit();}
$mysqli->query('UPDATE `users` SET `gold` = `gold` + "'.$gold.'" WHERE `id` = '.$user['id'].'');
$mysqli->query('UPDATE `missions_user` SET `time` = "'.(2147399999).'", `prog` = "5" WHERE `id` = '.$miss['id'].'');
header('Location: ?');
$_SESSION['ok'] = '<div class="trnt-block mb6 cntr bold small">
<div class="green1 pb5">Командирское задание выполнено!</div>
<div class="white">'.$gold_.' '.$gold__.'  </div>
</div>';
exit();
}
}











$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user`  = "'.$user['id'].'" and `active`  = "1" limit 1');
$users_tanks = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `tanks` WHERE `id`  = "'.$users_tanks['tip'].'" limit 1');
$tank = $res->fetch_assoc();

if($tank['tip'] == 1){$tip_tank = 'average';$tip_tank_ru = 'СРЕДНИЙ ТАНК';} // СТ
if($tank['tip'] == 2){$tip_tank = 'heavy';$tip_tank_ru = 'ТЯЖЕЛЫЙ ТАНК';} // ТТ
if($tank['tip'] == 3){$tip_tank = 'SAU';$tip_tank_ru = 'ПТ-САУ';} // САУ

if($tank['country'] == 'GERMANY'){$count=1;$coun_tank = 'ГЕРМАНИЯ';$coun_tank_en = 'germany';}
if($tank['country'] == 'SSSR'){$count=2;$coun_tank = 'СССР';$coun_tank_en = 'ussr';}
if($tank['country'] == 'USA'){$count=3;$coun_tank = 'США';$coun_tank_en = 'usa';}






$userID = $user['id'];
$time = time();
$missions = array();

$countryData = array(
    1 => array(
        'countryName' => 'Германия',
        'conditionTip' => '1',
        'link' => 'selectGermany'
    ),
    2 => array(
        'countryName' => 'СССР',
        'conditionTip' => '2',
        'link' => 'selectUssr'
    ),
    3 => array(
        'countryName' => 'США',
        'conditionTip' => '3',
        'link' => 'selectUsa'
    ),
);

foreach ($countryData as $countryCode => $data) {
    $query = "SELECT * FROM `missions_user`
              WHERE `user` = ? AND `prog` >= `prog_max` AND `time` < ? AND `tip` <= '2' AND `country` = ?
              LIMIT 1";

    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("iii", $userID, $time, $countryCode);
        $stmt->execute();
        $result = $stmt->get_result();
        $mission = $result->fetch_assoc();

        if ($mission && $tanks['country'] !== $data['countryName']) {
            $missions[] = [
                'country' => $data['countryName'],
                'link' => $data['link'],
                'mission' => $mission
            ];
        }

        $stmt->close();
    } else {
        echo "Ошибка выполнения запроса: " . $mysqli->error;
    }
}

foreach ($missions as $missionData) {
    $country = $missionData['country'];
    $link = $missionData['link'];
    $mission = $missionData['mission'];

    if ($mission['country'] != $count) {
        echo '<div class="trnt-block mb10 mt5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content"><div class="imgtxt bshd wht btxt">
            <div class="thumb fl"><img src="/images/unit_data_block_image.jpg" alt="image" style="width:100%; border-radius: 9px;"><span class="mask1">&nbsp;</span><span class="digit"><span class="l">&nbsp;</span><span class="m">+</span></div>
            <div class="ml58 small white sh_b bold"><span class="green2">Командир</span><br>
            <font color="green1" style="opacity:0.7;">Миссия выполнена!</font><br>
            Страна: <font color="green1" style="opacity:0.7;">' . $country . '</font><br></div>
            <div class="clrb"></div>
            <div class="bot"><a class="simple-but border a_w50 mb10" href="/' . $link . '/"><span><span>Сменить танк</span></span></a></div>
        </div></div></div></div></div></div></div></div></div></div></div></div>
		<div class="mt5"></div><div class="dhr a_w50 mt20 mb10"></div>';
    }
}










/* 
$missions = array(
    1 => array('country' => 'Германия', 'link' => 'selectGermany'),
    2 => array('country' => 'СССР', 'link' => 'selectUssr'),
    3 => array('country' => 'США', 'link' => 'selectUsa'),
);

foreach ($missions as $countryCode => $missionData) {
    $res = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `prog` >= `prog_max` and `time` < '.time().' and `tip` = "3" and `country` = "'.$countryCode.'" limit 1');
    $mission = $res->fetch_assoc();

    if ($missions && $missions['country'] != $count) {
        echo '<div class="trnt-block mb10 mt5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content"><div class="imgtxt bshd wht btxt">
        <div class="thumb fl"><img src="/images/unit_data_block_image.jpg" alt="image" style="width:100%; border-radius: 9px;"><span class="mask1">&nbsp;</span></div>
        <div class="ml58 small white sh_b bold"><span class="green2">Командир</span><br>
        <font color="green1" style="opacity:0.7;">Миссия "Битвы" выполнена!</font><br>
        Страна: <font color="green1" style="opacity:0.7;">'.$missionData['country'].'</font><br></div>
        <div class="clrb"></div>
        <div class="bot"><a class="simple-but border a_w50 mb10" href="/'.$missionData['link'].'/"><span><span>Сменить танк</span></span></a></div>
    </div></div></div></div></div></div></div></div></div></div></div><div class="mt5"></div>';
    }
}

 */

















/* 


$res = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `prog` >= `prog_max` and `time` < '.time().' and `tip` = "3" and `country` = "1" limit 1');
$miss_1_ = $res->fetch_assoc();
$res = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `prog` >= `prog_max` and `time` < '.time().' and `tip` = "3" and `country` = "2" limit 1');
$miss_2_ = $res->fetch_assoc();
$res = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `prog` >= `prog_max` and `time` < '.time().' and `tip` = "3" and `country` = "3" limit 1');
$miss_3_ = $res->fetch_assoc();

if($miss_1_ and $tanks['country']!='GERMANY'){
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content"><div class="imgtxt bshd wht btxt">
<div class="thumb fl"><img src="/images/unit_data_block_image.jpg" alt="image" style="width:100%; border-radius: 9px;"><span class="mask1">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Командир</span><br>
<font color="green1" style="opacity:0.7;">Миссия "Битвы" выполнена!</font><br>
Страна: <font color="green1" style="opacity:0.7;">Германия</font><br></div>
<div class="clrb"></div>
<div class="bot"><a class="simple-but border a_w50 mb10" href="/selectGermany/"><span><span>Сменить танк</span></span></a></div>
</div></div></div></div></div></div></div></div></div></div></div><br>';
}
if($miss_2_ and $tanks['country']!='SSSR'){
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content"><div class="imgtxt bshd wht btxt">
<div class="thumb fl"><img src="/images/unit_data_block_image.jpg" alt="image" style="width:100%; border-radius: 9px;"><span class="mask1">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Командир</span><br>
<font color="green1" style="opacity:0.7;">Миссия "Битвы" выполнена!</font><br>
Страна: <font color="green1" style="opacity:0.7;">СССР</font><br></div>
<div class="clrb"></div>
<div class="bot"><a class="simple-but border a_w50 mb10" href="/selectUSSR/"><span><span>Сменить танк</span></span></a></div>
</div></div></div></div></div></div></div></div></div></div></div><br>';
}
if($miss_3_ and $tanks['country']!='USA'){
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content"><div class="imgtxt bshd wht btxt">
<div class="thumb fl"><img src="/images/unit_data_block_image.jpg" alt="image" style="width:100%; border-radius: 9px;"><span class="mask1">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Командир</span><br>
<font color="green1" style="opacity:0.7;">Миссия "Битвы" выполнена!</font><br>
Страна: <font color="green1" style="opacity:0.7;">США</font><br></div>
<div class="clrb"></div>
<div class="bot"><a class="simple-but border a_w50 mb10" href="/selectUSA/"><span><span>Сменить танк</span></span></a></div>
</div></div></div></div></div></div></div></div></div></div></div><br>';
}


 */























if($user['kill_tanks'] >= 3){
if($user['login'] == 'Незнакомец' and $user['level'] >= 2){
require_once ('save.php');
}
}







$res = $mysqli->query('SELECT * FROM `convoy_user` WHERE `user`  = "'.$user['id'].'" limit 1');
$c_user = $res->fetch_assoc();

if($user['fuel']<30){$coolor_knopka = 'simple-but gray border mb1';}else{$coolor_knopka = 'simple-but border mb1';}

if($c_user['time'] > time()){$plus_konvoy = '';}else{$plus_konvoy = '<span class="digit esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span>';}

$res = $mysqli->query("SELECT COUNT(*) FROM `buildings_user` WHERE `user` = ".$user['id']." and `level` > '0' and (`faste_build_time` > '0' and `faste_build_time` < '".time()."') limit 1");
$col_build_plus1 = $res->fetch_array(MYSQLI_NUM);
$res = $mysqli->query("SELECT COUNT(*) FROM `buildings_user` WHERE `user` = ".$user['id']." and `level` > '0' and (`time_production` < '".time()."' and `time_production` > '0') limit 1");
$col_build_plus2 = $res->fetch_array(MYSQLI_NUM);
if($col_build_plus[0]<=0 and $col_build_plus2[0]<=0){$plus_postroyki = '';}else{$plus_postroyki = '<span class="digit esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span>';}
if($user['kill_tanks'] >= 3){
echo '<table><tbody><tr>';
echo '<td style="width:33%;padding-right:4px;"><div style="position:relative;"><a class="simple-but border gray mb1" href="/convoy/"><span><span>Конвой</span></span></a>'.$plus_konvoy.'</div></td>';
echo '<td style="width:33%;padding:0 4px;"><div style="position:relative;"><a class="'.$coolor_knopka.'" href="/battle/"><span><span>В бой!</span></span></a></div></td>';
echo '<td style="width:33%;padding-left:4px;"><div style="position:relative;"><a class="simple-but gray border mb1" href="/buildings/"><span><span>База</span></span></a>'.$plus_postroyki.'</div></td>';
echo '</tr></tbody></table>';
}else{
echo '<table><tbody><tr>
<td style="width:33%;padding-right:4px;"><div style="position:relative;"></div></td>
<td style="width:33%;padding:0 4px;"><div style="position:relative;"><a class="simple-but border mb1" href="/battle/"><span><span>В бой!</span></span></a></div></td>
<td style="width:33%;padding-right:4px;"><div style="position:relative;"></div></td>
</tr></tbody></table>';
}

//<td style="width:33%;padding-right:4px;"><div style="position:relative;"><a class="simple-but border gray mb1" href="/convoy/"><span><span>Конвой</span></span></a>'.$plus_konvoy.'</div></td>






if($user['level']>=3){
$res = $mysqli->query("SELECT COUNT(*) FROM `pm` WHERE `ank` = '".$user['id']."' and `readlen` = '0' ");
$col_m = $res->fetch_array(MYSQLI_NUM);
if($col_m[0]>0){
echo '<div class="small white sh_b bold cntr mb5 pt5"><img class="vb" src="/images/mail.gif"> <a w:id="mailLink" href="/pm/"><span class="yellow1 td_u">Новая почта </span></a><br></div>';
}
}














if($user['kill_tanks'] >= 3){$b = 'trnt-block';}else{$b = 'trnt-block mb5';}
echo '<div class="'.$b.'"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content custombg angar_7">';
##############################################################################################################################

//$res = $mysqli->query('SELECT * FROM `buildings_polygon` WHERE `user` = '.$user['id'].' LIMIT 1');
//$buildings_polygon = $res->fetch_assoc();

if($buildings_polygon['a']==10){$param_a = 1;}if($buildings_polygon['a']==20){$param_a = 2;}if($buildings_polygon['a']==30){$param_a = 3;}if($buildings_polygon['a']==50){$param_a = 4;}if($buildings_polygon['a']==70){$param_a = 5;}
if($buildings_polygon['b']==10){$param_b = 1;}if($buildings_polygon['b']==20){$param_b = 2;}if($buildings_polygon['b']==30){$param_b = 3;}if($buildings_polygon['b']==50){$param_b = 4;}if($buildings_polygon['b']==70){$param_b = 5;}
if($buildings_polygon['t']==10){$param_t = 1;}if($buildings_polygon['t']==20){$param_t = 2;}if($buildings_polygon['t']==30){$param_t = 3;}if($buildings_polygon['t']==50){$param_t = 4;}if($buildings_polygon['t']==70){$param_t = 5;}
if($buildings_polygon['p']==10){$param_p = 1;}if($buildings_polygon['p']==20){$param_p = 2;}if($buildings_polygon['p']==30){$param_p = 3;}if($buildings_polygon['p']==50){$param_p = 4;}if($buildings_polygon['p']==70){$param_p = 5;}

echo '<div class="brunches-block"><div class="wrp1"><div class="wrp2"><table><tbody><tr>';

if($user['kill_tanks'] >= 3){
if($buildings_polygon['a']>0){
echo'<td><div class="image"><div class="in"><img width="23" height="23" src="/images/buffs/attack'.$param_a.'.png"  style="border-radius: 6px;" title="Атака" alt="Атака"></div></div></td>';
}else{
echo'<td><div class="image"><div class="in"><img width=23" height="23" src="/images/buffs/unit_data_block_image_mask_bg2.png"  style="border-radius: 6px;" title="Атака" alt="Атака"></div></div></td>';
}
if($buildings_polygon['b']>0){
echo'<td><div class="image"><div class="in"><img width="23" height="23" src="/images/buffs/armor'.$param_b.'.png"  style="border-radius: 6px;" title="Броня" alt="Броня"></div></div></td>';
}else{
echo'<td><div class="image"><div class="in"><img width=23" height="23" src="/images/buffs/unit_data_block_image_mask_bg2.png"  style="border-radius: 6px;" title="Броня" alt="Броня"></div></div></td>';
}
if($buildings_polygon['t']>0){
echo'<td><div class="image"><div class="in"><img width="23" height="23" src="/images/buffs/accuracy'.$param_t.'.png"  style="border-radius: 6px;" title="Точность" alt="Точность"></div></div></td>';
}else{
echo'<td><div class="image"><div class="in"><img width=23" height="23" src="/images/buffs/unit_data_block_image_mask_bg2.png"  style="border-radius: 6px;" title="Точность" alt="Точность"></div></div></td>';
}
if($buildings_polygon['p']>0){
echo'<td><div class="image"><div class="in"><img width="23" height="23" src="/images/buffs/durability'.$param_p.'.png"  style="border-radius: 6px;" title="Прочность" alt="Прочность"></div></div></td>';
}else{
echo'<td><div class="image"><div class="in"><img width=23" height="23" src="/images/buffs/unit_data_block_image_mask_bg2.png"  style="border-radius: 6px;" title="Прочность" alt="Прочность"></div></div></td>';
}
$res1 = $mysqli->query('SELECT * FROM `vip` WHERE `user` = "'.$user['id'].'" LIMIT 1');
$vip = $res1->fetch_assoc();
if($vip['time1']>time() or $vip['time2']>time() or $vip['time3']>time() or $vip['time4']>time()){
echo'<td><div class="image"><div class="in"><img width=23" height="23" src="/images/buffs/vip.png"  style="border-radius: 6px;" title="ViP" alt="ViP"></div></div></td>';
}else{
echo'<td><div class="image"><div class="in"><img width=23" height="23" src="/images/buffs/unit_data_block_image_mask_bg2.png"  style="border-radius: 6pxя;" title="ViP" alt="ViP"></div></div></td>';
}
}

echo'</td></tr></tbody></table></div></div></div><br><br>';
##############################################################################################################################












echo '<div class="cntr"><img class="tank-img" src="/images/tanks/'.$tip_tank.'/'.$tank['country'].'/'.$tank['name'].'.png" style="width:90%;"></div><br>';


echo '<center>
<div class="small bold va_m">
<img width="16" height="11" src="/images/flags/'.$coun_tank_en.'16x11.png"> <font size="1">Страна: <font color="green1" style="opacity:0.7;">'.$coun_tank.'</font></font>
<img width="20" height="20" src="/images/tanks/'.$tip_tank.'.png"><font size="1">Тип: <font color="green1" style="opacity:0.7;">'.$tip_tank_ru.'</font></font>
<img width="25" height="14" src="/images/tanks/'.$tip_tank.'/'.$tank['country'].'/'.$tank['name'].'.png"><font size="1">Танк: <font color="green1" style="opacity:0.7;">'.$tank['name'].'</font></font>
</div>
</center></div>';

if($user['kill_tanks'] >= 3){
echo '<div class="cntr"><div class="weapon-panel"><div class="wrp1"><div class="wrp2"><table><tbody><tr>';
echo '<td><div class="image"><div class="in"><center><img width="21" height="21" src="/images/attack1.png" title="Атака" alt="Атака" style="width: 21px;height: 21px;"></div><div class="mask" title="Атака">&nbsp;</div>
<div style="width:48; height:15; margin-top:3px; text-align:center; "><font size=2><span class="blue2">'.$users_tanks['a'].'</span></font></div></center></td>';
echo '<td><div class="image"><div class="in"><center><img src="/images/armor1.png" title="Броня" alt="Броня"></div><div class="mask" title="Броня">&nbsp;</div>
<div style="width:48; height:15; margin-top:3px; text-align:center; "><font size=2><span class="blue2">'.$users_tanks['b'].'</span></font></div></div></center></td>';
echo '<td><div class="image"><div class="in"><center><img width="21" height="21" src="/images/accuracy1.png" title="Точность" alt="Точность" style="width: 21px;height: 21px;"></div><div class="mask" title="Точность">&nbsp;</div>
<div style="width:48; height:15; margin-top:3px; text-align:center; "><font size=2><span class="blue2">'.$users_tanks['t'].'</span></font></div></div></center></td>';
echo '<td><div class="image"><div class="in"><center><img width="21" height="21" src="/images/durability1.png" title="Прочность" alt="Прочность" style="width: 21px;height: 21px;"></div><div class="mask" title="Прочность">&nbsp;</div>
<div style="width:48; height:15; margin-top:3px; text-align:center; "><font size=2><span class="blue2">'.$users_tanks['p'].'</span></font></div></div></center></td>';
echo '</tr></tbody></table></div></div></div></div>';
}
echo '</div></div></div></div></div></div></div></div></div>';














if($user['company']>0){
$href_company = '/company/'.$user['company'].'/';
$res_company = $mysqli->query('SELECT * FROM `company` WHERE `id` = '.$user['company'].' LIMIT 1');
$company = $res_company->fetch_assoc();
$img_company = ''.$company['avatar'].'';}else{$img_company = '0';$href_company = '/no_company/';}

//<span class="digit"><span class="l">&nbsp;</span><span class="m">+</span>


if($user['kill_tanks'] >= 3){

/* $res = $mysqli->query('SELECT * FROM `pve_user` WHERE `user` = '.$user['id'].' ');
$p_u = $res->fetch_assoc();

if($user['id'] == 1){
echo 'до начала '._time1($p['time']-time()).'';
}

if(!$p_u){$n_pve = '<span class="digit"><span class="l">&nbsp;</span><span class="m">+</span>';}
 */





$res = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `prog` >= `prog_max` and `time` < '.time().' 
and (`id_miss` != "28" and `id_miss` != "29" and `id_miss` != "30" and `id_miss` != "31")
and (`id_miss` != "32" and `id_miss` != "33" and `id_miss` != "34" and `id_miss` != "35")
limit 1');
$miss = $res->fetch_assoc();
if($miss){$n_miss = '<span class="digit"><span class="l">&nbsp;</span><span class="m">+</span>';}


$res = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `prog` >= `prog_max` and `time` < '.time().' 
and `id_miss` >= "28" and `id_miss` <= "35" 
limit 1');
$miss_pvp = $res->fetch_assoc();
if($miss_pvp){$n_pvp = '<span class="digit"><span class="l">&nbsp;</span><span class="m">+</span>';}


echo '<div class="brunches-block"><table><tbody>

<tr>

<td><a href="/pay/"><span class="image"><img src="/images/payment.png?1" alt="image" style="border-radius: 8px;"><span class="mask">&nbsp;</span>
<span class="r">&nbsp;</span></span></span>золото</a></td>

<td><a href="/missions/"><span class="image"><img src="/images/main_x2.png" alt="image" style="border-radius: 8px;"><span class="mask">&nbsp;</span>
'.$n_miss.'
<span class="r">&nbsp;</span></span></span>Миссии</a></td>

<td><a href="/pvp/"><span class="image"><img src="/images/pvp.png?1" alt="image" style="border-radius: 8px;"><span class="mask">&nbsp;</span>
'.$n_pvp.'
<span class="r">&nbsp;</span></span></span>Битвы</a></td>

<td><a href="/pve/"><span class="image"><img src="/images/pve.png?" alt="image" style="border-radius: 8px;"><span class="mask">&nbsp;</span>
'.$n_pve.'
<span class="r">&nbsp;</span></span></span>Сражения</a></td>


<tr>


<td><a href="/selectUssr/"><span class="image"><img src="/images/tanksmagazine.png?1" alt="image" style="border-radius: 8px;"><span class="mask">&nbsp;</span>
<span class="r">&nbsp;</span></span></span>Танки</a></td>

<td><a href="/rating/tanks/"><span class="image"><img src="/images/rating.png?1" alt="image" style="border-radius: 8px;"><span class="mask">&nbsp;</span>
<span class="r">&nbsp;</span></span></span>Рейтинг</a></td>

<td><a href="/cw/"><span class="image"><img src="/images/cw.png?1" alt="image" style="border-radius: 8px;"><span class="mask">&nbsp;</span>
<span class="r">&nbsp;</span></span></span>Война</a></td>

<td><a href="/dm/"><span class="image"><img src="/images/convoy.png?1" alt="image"><span class="mask">&nbsp;</span>
</span>Схватка</a></td>

</tr>


<tr>
<td></td>
<td><a href="/ammunation/"><span class="image"><img src="/images/ammunation.png" alt="image" style="border-radius: 8px;"><span class="mask">&nbsp;</span>
<span class="r">&nbsp;</span></span></span>Амуниция</a></td>
<td><a href="'.$href_company.'"><span class="image"><img src="/images/avatar/clan/'.$img_company.'.png" alt="image" style="border-radius: 10px;"><span class="mask">&nbsp;</span>
<span class="r">&nbsp;</span></span></span>Дивизия</a></td>
<td></td>
</tr>

</tbody></table></div>';
}








/* 



<td><a href="/ammunation/"><span class="image"><img src="/images/ammunation.png" alt="image" style="border-radius: 8px;"><span class="mask">&nbsp;</span>
<span class="r">&nbsp;</span></span></span>Амуниция</a></td>

<td><a href="/missions/"><span class="image"><img src="/images/main_x2.png" alt="image" style="border-radius: 8px;"><span class="mask">&nbsp;</span>
'.$n_miss.'
<span class="r">&nbsp;</span></span></span>Миссии</a></td>

<td><a href="/rating/tanks/"><span class="image"><img src="/images/rating.png?1" alt="image" style="border-radius: 8px;"><span class="mask">&nbsp;</span>
<span class="r">&nbsp;</span></span></span>Рейтинг</a></td>

<td><a href="'.$href_company.'"><span class="image"><img src="/images/avatar/clan/'.$img_company.'.png" alt="image" style="border-radius: 10px;"><span class="mask">&nbsp;</span>
<span class="r">&nbsp;</span></span></span>Дивизия</a></td>




<td><a href="/convoy/"><span class="image"><img src="/images/convoy.png?1" alt="image" style="border-radius: 8px;"><span class="mask">&nbsp;</span>
<span class="r">&nbsp;</span></span></span>Конвой</a></td>

<td><a href="/pve/"><span class="image"><img src="/images/pve.png?" alt="image" style="border-radius: 8px;"><span class="mask">&nbsp;</span>
'.$n_pve.'
<span class="r">&nbsp;</span></span></span>Сражения</a></td>

<td><a href="/cw/"><span class="image"><img src="/images/cw.png?1" alt="image" style="border-radius: 8px;"><span class="mask">&nbsp;</span>
<span class="r">&nbsp;</span></span></span>Война</a></td>

<td><a href="/pvp/"><span class="image"><img src="/images/pvp.png?1" alt="image" style="border-radius: 8px;"><span class="mask">&nbsp;</span>
<span class="r">&nbsp;</span></span></span>Битвы</a></td>
</tr>
 */












$arr_text = array(
1 => "Снаряды и ремкомплекты используются во время боя в битве и сражении",
2 => "Ресурсы требуются для постройки и улучшения некоторых зданий на базе",
3 => "Не забывайте выполнять миссии, за них дают хорошую награду",
4 => "<img class='vb pb2' height='14' width='14' src='/images/upgrades/starFull.png'> Танковая мощь: сумма всех параметров танка"); 
$rand_text = rand(1,4);


echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">'.$arr_text[$rand_text].'</div>
</div></div></div></div></div></div></div></div></div></div>';
}
require_once ('system/footer.php');
?>