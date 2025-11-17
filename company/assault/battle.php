<?php
$title = 'Спецзадание';
require_once ('../../system/function.php');
if(!$user['id']) {header('Location: /');exit();}
if($user['company']<=0) {header('Location: /');exit();}


$res = $mysqli->query('SELECT * FROM `settings` WHERE `id` = "1" limit 1');
$sql = $res->fetch_assoc();

$rc_u_a = $mysqli->query('SELECT * FROM `company_user_assault` WHERE `user` = '.$user['id'].' LIMIT 1');
$c_u_a = $rc_u_a->fetch_assoc();

$c_b_a_ = $mysqli->query('SELECT * FROM `company_battle_assault` WHERE `id` = "'.$c_u_a['id_battle'].'" and `company` = "'.$user['company'].'" LIMIT 1');
$c_b_a = $c_b_a_->fetch_assoc();

$c_b_u_a_ = $mysqli->query('SELECT * FROM `company_battle_user_assault` WHERE `user` = "'.$user['id'].'" LIMIT 1');
$c_b_u_a = $c_b_u_a_->fetch_assoc();

$c_u__1 = $mysqli->query("SELECT COUNT(*) FROM `company_battle_user_assault` WHERE `id_battle` = ".$c_u_a['id_battle']."  and `p_` > '0' ");
$c_uu___ = $c_u__1->fetch_array(MYSQLI_NUM);

if(!$c_b_a){
$past_a_ = $mysqli->query('SELECT * FROM `company_pastassaults` WHERE `id_battle` = "'.$c_u_a['id_battle_end'].'" LIMIT 1');
$past_a = $past_a_->fetch_assoc();
}

if(($c_u_a['time_restart']+(3600*20))<time() and $c_u_a['time_restart']>1){
header('Location: /company/assault/');exit();
}

if(!$c_b_a and $c_u_a['time_restart']==1){
header('Location: /company/assault/');exit();
}

if (isset($_SESSION['ses'])){
?>
<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini cntr">
<?=$_SESSION['ses']?>
</div></div></div></div></div></div></div></div></div></div>
<?php
unset($_SESSION['ses']);
}

if( (time()-($c_u_a['time_restart']-(3600*20)))>30 and $c_u_a['time_restart']>time()){
if(!$c_b_u_a) {header('Location: /company/assault/');exit();}
if(!$c_b_a) {header('Location: /company/assault/');exit();}
if($c_u_a['id_battle']<=0) {header('Location: /company/assault/');exit();}
}elseif($c_u_a['time_restart']==0 and ((time()-$past_a['time'])>=30)){
if(!$c_b_u_a) {header('Location: /company/assault/');exit();}
if(!$c_b_a) {header('Location: /company/assault/');exit();}
if($c_u_a['id_battle']<=0) {header('Location: /company/assault/');exit();}
}

if($c_b_a) {
$a_ = $mysqli->query('SELECT * FROM `assault` WHERE `id` = '.$c_b_a['id_assault'].' LIMIT 1');
$a = $a_->fetch_assoc();
}else{
$a_ = $mysqli->query('SELECT * FROM `assault` WHERE `id` = '.$c_u_a['id_battle_end'].' LIMIT 1');
$a = $a_->fetch_assoc();
}


if( (time()-($c_u_a['time_restart']-(3600*20)))>30 and $c_u_a['time_restart']>time()){header('Location: /company/assault/');exit();}


$res = $mysqli->query('SELECT * FROM `skills_user` WHERE `user` = "'.$user['id'].'" and `tip` = "4" LIMIT 1');
$skills_u = $res->fetch_assoc();







/* текст блиндаж уничтожил вас
корректировака урона блина в зависимости от брони юзера
корректировака урона блина в зависимости от оставшегося хп танка
почему то урон по мочнее цели становится больше
 */






/* $col_u__ = $mysqli->query("SELECT COUNT(*) FROM `company_battle_user_assault` WHERE `id_battle` = ".$c_u_a['id_battle']." and `p` > '0' ");
$col_uu = $col_u__->fetch_array(MYSQLI_NUM); */

if(($c_b_a['time']<=time() and $c_b_a['time']>0) or $c_b_a['p']<=0 or $c_uu___[0]<=0){ // ИТОГИ             or $col_uu[0]<=0 
$c_u__1 = $mysqli->query('SELECT * FROM `company_battle_user_assault` LEFT JOIN `company_user` USING (user) WHERE `company_battle_user_assault`.`id_battle` = "'.$c_b_a['id'].'" ORDER BY `company_battle_user_assault`.`uron` asc, `company_user`.`company_rang` asc, `company_user`.`company_exp` desc LIMIT 10');
while ($c_uu = $c_u__1->fetch_array()){
$rc_u_a = $mysqli->query('SELECT * FROM `company_user_assault` WHERE `user` = '.$c_uu['user'].' LIMIT 1');
$c_u_a_ = $rc_u_a->fetch_assoc();
if($c_uu['p_']<=0){$dead_us = 1;}else{$dead_us = 0;}
if($c_b_a['p']<=0){$dead = 1;}else{$dead = 0;}

if($c_b_a['id_assault']==1 and $c_u_a_['1_coll']==0){$gold_ = 25;}else
if($c_b_a['id_assault']==2 and $c_u_a_['2_coll']==0){$gold_ = 50;}else
if($c_b_a['id_assault']==3 and $c_u_a_['3_coll']==0){$gold_ = 100;}else
if($c_b_a['id_assault']==4 and $c_u_a_['4_coll']==0){$gold_ = 125;}else
if($c_b_a['id_assault']==5 and $c_u_a_['5_coll']==0){$gold_ = 250;}else
if($c_b_a['id_assault']==6 and $c_u_a_['6_coll']==0){$gold_ = 400;}else{$gold_ = 0;}

if($c_b_a['id_assault']==1){$gold = (4);}elseif($c_b_a['id_assault']==2){$gold = (6);}elseif($c_b_a['id_assault']==3){$gold = (9);}elseif($c_b_a['id_assault']==4){$gold = (10);}elseif($c_b_a['id_assault']==5){$gold = (12);}elseif($c_b_a['id_assault']==6){$gold = (15);}

$c_u__ = $mysqli->query("SELECT COUNT(*) FROM `company_battle_user_assault` WHERE `id_battle` = ".$c_u_a['id_battle']." and `uron` > '0' ");
$c_uu__ = $c_u__->fetch_array(MYSQLI_NUM);
if($c_uu__[0]==1){
$bonus = floor($gold/2);
}elseif($c_uu__[0]==2){
if($K_post++ == 1){$bonus = floor($gold/2);}
}elseif($c_uu__[0]==3){
if($K_post++ == 1){$bonus = floor($gold/2);}if($K_post++ > 1){$bonus = 0;}
}elseif($c_uu__[0]==4){
if($K_post++ == 1){$bonus = floor($gold/2);}if($K_post++ == 2){$bonus = floor($gold/2);}if($K_post++ > 2){$bonus = 0;}
}elseif($c_uu__[0]==5){
if($K_post++ == 1){$bonus = floor($gold/2);}if($K_post++ == 2){$bonus = floor($gold/2);}if($K_post++ > 2){$bonus = 0;}
}elseif($c_uu__[0]==6){
if($K_post++ == 1){$bonus = floor($gold/2);}if($K_post++ == 2){$bonus = floor($gold/2);}if($K_post++ == 3){$bonus = floor($gold/2);}if($K_post++ > 3){$bonus = 0;}
}elseif($c_uu__[0]==7){
if($K_post++ == 1){$bonus = floor($gold/2);}if($K_post++ == 2){$bonus = floor($gold/2);}if($K_post++ == 3){$bonus = floor($gold/2);}if($K_post++ > 3){$bonus = 0;}
}elseif($c_uu__[0]==8){
if($K_post++ == 1){$bonus = floor($gold/2);}if($K_post++ == 2){$bonus = floor($gold/2);}if($K_post++ == 3){$bonus = floor($gold/2);}if($K_post++ == 4){$bonus = floor($gold/2);}if($K_post++ > 4){$bonus = 0;}
}elseif($c_uu__[0]==9){
if($K_post++ == 1){$bonus = floor($gold/2);}if($K_post++ == 2){$bonus = floor($gold/2);}if($K_post++ == 3){$bonus = floor($gold/2);}if($K_post++ == 4){$bonus = floor($gold/2);}if($K_post++ > 4){$bonus = 0;}
}elseif($c_uu__[0]==10){
if($K_post++ == 1){$bonus = floor($gold/2);}if($K_post++ == 2){$bonus = floor($gold/2);}if($K_post++ == 3){$bonus = floor($gold/2);}if($K_post++ == 4){$bonus = floor($gold/2);}if($K_post++ == 5){$bonus = floor($gold/2);}if($K_post++ > 5){$bonus = 0;}
}

if($dead==1){
$whereG = ($gold+$gold_+$bonus);
}else{
$whereG = 0;
}


if($c_uu['user']==$user['id']){
$mysqli->query('INSERT INTO `company_pastassaults_user` SET `gold` = "'.($whereG+$dead).'", `id_battle` = "'.$c_u_a['id_battle'].'", `user` = "'.$c_uu['user'].'", `uron` = "'.$c_uu['uron'].'", `dead` = "'.$dead_us.'" ');
}else{
$mysqli->query('INSERT INTO `company_pastassaults_user` SET `gold` = "'.$whereG.'", `id_battle` = "'.$c_u_a['id_battle'].'", `user` = "'.$c_uu['user'].'", `uron` = "'.$c_uu['uron'].'", `dead` = "'.$dead_us.'" ');
}



if($c_b_a['p']<=0){
$time_restart = (time()+(3600*20));

$res = $mysqli->query('SELECT * FROM `prom` WHERE `id` = "1" ');
$prom = $res->fetch_assoc();
if($prom['time_20']>time()){
$res = $mysqli->query('SELECT * FROM `bz_user` WHERE `user` = "'.$c_uu['user'].'" and `tip` = "'.$prom['tip_20'].'"');
$bz_user = $res->fetch_assoc();
if($bz_user['step']==12 and $bz_user['prog_']<$bz_user['prog']){
$mysqli->query('UPDATE `bz_user` SET `prog_` = `prog_` + "1" WHERE `id` = '.$bz_user['id'].'');
}
}



}else{
$time_restart = 0;
}
$mysqli->query("UPDATE `company_user_assault` SET `".$c_b_a['id_assault']."_coll` = '".($c_u_a_[''.$c_b_a['id_assault'].'_coll']+$dead)."', `id_battle_end` = '".$c_b_a['id']."', `id_battle` = '0', `time_restart` = '".$time_restart."' WHERE `user` = '".$c_uu['user']."' LIMIT 1");
$mysqli->query('DELETE FROM `company_battle_user_assault` WHERE `user` = "'.$c_uu['user'].'" ');
//$mysqli->query('DELETE FROM `company_battle_log` WHERE `id_assault` = "'.$c_b_a['id'].'" ');


if($dead==1){
$u_ = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$c_uu['user'].'" LIMIT 1');
$us = $u_->fetch_assoc();
if($c_uu['user']==$user['id']){
$mysqli->query("UPDATE `users` SET `gold` = '".($us['gold']+($whereG+$dead))."' WHERE `id` = '".$us['id']."' LIMIT 1");
}else{
$mysqli->query("UPDATE `users` SET `gold` = '".($us['gold']+$whereG)."' WHERE `id` = '".$us['id']."' LIMIT 1");
}
}

}






if($c_b_a['p']<=0){$pobeda = $user['id'];}else{$pobeda = 0;}
if($c_b_a['id']!=0){
$mysqli->query('INSERT INTO `company_pastassaults` SET `company` = "'.$user['company'].'", `id_battle` = "'.$c_b_a['id'].'", `time` = "'.time().'", `assault` = "'.$c_b_a['id_assault'].'", `pobeda` = "'.$pobeda.'" ');
//echo '1';
}
$mysqli->query('DELETE FROM `company_battle_assault` WHERE `id` = "'.$c_b_a['id'].'" ');
}









if($c_b_a['id'] and $c_b_a['time']==0){
require_once ('../../system/header.php');
##################################################################################################################1
##################################################################################################################1
##################################################################################################################1
echo '<div class="medium white bold cntr mb2">Спецзадание</div>';
echo '<div class="trnt-block mb10"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="small white cntr sh_b bold mb2">
Цель: '.$a['name'].'<br><div class="cntr"><img width="35%" src="/images/assault/'.$a['id'].'.png"></div>';

$c_u__ = $mysqli->query('SELECT * FROM `company_battle_user_assault` LEFT JOIN `company_user` USING (user) WHERE `company_battle_user_assault`.`id_battle` = "'.$c_u_a['id_battle'].'" ORDER BY `company_user`.`company_rang` asc, `company_user`.`company_exp` desc LIMIT 1');
while ($c_uu1 = $c_u__->fetch_array()){
echo '<div class="small white cntr sh_b bold mb2">Старший взвода: '.nick($c_uu1['user']).'</div>';
}
$col_u_ = $mysqli->query("SELECT COUNT(*) FROM `company_battle_user_assault` WHERE `id_battle` = ".$c_u_a['id_battle']." ");
$col_u = $col_u_->fetch_array(MYSQLI_NUM);
echo 'Танкистов: '.$col_u[0].' из 10</div>';

echo '<table class="tlist cntr white sh_b bold small mb10"><tbody><tr><center>';
$c_u__1 = $mysqli->query('SELECT * FROM `company_battle_user_assault` LEFT JOIN `company_user` USING (user) WHERE `company_battle_user_assault`.`id_battle` = "'.$c_u_a['id_battle'].'" ORDER BY `company_user`.`company_rang` asc, `company_user`.`company_exp` desc LIMIT 1,10');
while ($c_uu = $c_u__1->fetch_array()){
$c_u_ = $mysqli->query('SELECT * FROM `company_user` WHERE `user` = '.$c_uu['user'].' and `company` = '.$user['company'].' LIMIT 1');
$c_u = $c_u_->fetch_assoc();
if($c_u['company_rang'] == 1){$company_rang = '<span class="leader" w:id="rank">комдив</span>';}
if($c_u['company_rang'] == 2){$company_rang = '<span class="leader" w:id="rank">замкомдив</span>';}
if($c_u['company_rang'] == 3){$company_rang = '<span class="general" w:id="rank">генерал</span>';}
if($c_u['company_rang'] == 4){$company_rang = '<span class="officer" w:id="rank">офицер</span>';}
if($c_u['company_rang'] == 5){$company_rang = '<span class="" w:id="rank">рядовой</span>';}
if($c_u['company_rang'] == 6){$company_rang = '<span class="" w:id="rank">новичок</span>';}
echo '<font size=2%>'.nick($c_uu['user']).', '.$company_rang.', <img class="ico vm" src="/images/icons/exp.png" alt="опыт" title="опыт"> <font color=white>'.n_f($c_u['company_exp']).'</font></font><br>';
}
echo '</center></tr></tbody></table>';

echo '<a class="simple-but border green" href="?"><span><span>Обновить</span></span></a>';
$c_u__ = $mysqli->query('SELECT * FROM `company_battle_user_assault` LEFT JOIN `company_user` USING (user) WHERE `company_battle_user_assault`.`id_battle` = "'.$c_u_a['id_battle'].'" ORDER BY `company_user`.`company_rang` asc, `company_user`.`company_exp` desc LIMIT 1');
while ($c_uu1 = $c_u__->fetch_array()){
if($c_uu1['user']==$user['id']){echo '<a class="simple-but border red" href="?start"><span><span>Начать бой!</span></span></a>';
}
}

echo '<a class="simple-but gray" href="?exit"><span><span>Отказаться от задания</span></span></a>';

echo '<div class="clrb"></div>
</div></div></div></div></div></div></div></div></div></div>';

if(isset($_GET['start'])){
if($c_b_a['time']!=0){header('Location: ?');exit();}

$c_u__ = $mysqli->query('SELECT * FROM `company_battle_user_assault` LEFT JOIN `company_user` USING (user) WHERE `company_battle_user_assault`.`id_battle` = "'.$c_u_a['id_battle'].'" ORDER BY `company_user`.`company_rang` asc, `company_user`.`company_exp` desc LIMIT 1');
while ($c_uu1 = $c_u__->fetch_array()){

$resb_s = $mysqli->query('SELECT * FROM `boevaya_sila` WHERE `user` = "'.$c_uu1['user'].'" and `local` = "4" limit 1');
$b_s = $resb_s->fetch_assoc();
if($b_s['bon_col']>0){
$mysqli->query("UPDATE `boevaya_sila` SET `bon_col` = `bon_col` - '1' WHERE `id` = '".$b_s['id']."' LIMIT 1");
}

$mysqli->query("UPDATE `company_battle_user_assault` SET `time_attack_assault` = ".(time()+17)." WHERE `id_battle` = '".$c_b_a['id']."' ");
if($c_uu1['user']!=$user['id']){header('Location: ?');exit();}
}
//$mysqli->query("UPDATE `company_battle_user_assault` SET `time_attack_assault` = ".(time()+17)." WHERE `id_battle` = '".$c_b_a['id']."' LIMIT 1");
$mysqli->query("UPDATE `company_battle_assault` SET `time` = '".(time()+307)."' WHERE `id` = '".$c_b_a['id']."' LIMIT 1");
header('Location: /company/assault/');
exit();
}

if(isset($_GET['exit'])){
$_SESSION['ses'] = '<div class="buy-place-block pt2 mb10">
<div class="medium bold white cntr sh_b mt5 mb5">Вы действительно хотите покинуть бой?</div>
<a class="simple-but border w50 mXa mb10" w:id="confirmLink" href="?okda"><span><span>да, подтверждаю</span></span></a>
<a class="simple-but border red w50 mXa" w:id="cancelLink" href="?"><span><span>нет, отмена</span></span></a></div>';
$_SESSION['EXIT'] = 1;
header('Location: ?');
exit();
}

if(isset($_GET['okda'])){
//if(!$c_b_u_a){header('Location: /company/assault/');exit();}
if($_SESSION['EXIT']==0){header('Location: /company/assault/');exit();}
//if(!$c_b_a){header('Location: ?');exit();}
//if($c_uu___[0]<=0 ){header('Location: ?');exit();}
//if($c_u_a['id_battle']==0){header('Location: ?');exit();}

if($c_b_a['time']!=0){header('Location: ?');exit();}
if($col_u[0]<=1){$mysqli->query('DELETE FROM `company_battle_assault` WHERE `id` = "'.$c_b_u_a['id_battle'].'" ');}
$mysqli->query('DELETE FROM `company_battle_user_assault` WHERE `user` = "'.$user['id'].'" ');
$mysqli->query("UPDATE `company_user_assault` SET `id_battle` = '0' WHERE `user` = '".$user['id']."' LIMIT 1");
$_SESSION['EXIT'] = 0;
header('Location: /company/assault/');
exit();
}
##################################################################################################################1
##################################################################################################################1
##################################################################################################################1






















##################################################################################################################чат
##################################################################################################################чат
##################################################################################################################чат
echo '<div class="small white cntr sh_b bold mb2">Чат дивизии</div>';


$res_cchat_col = $mysqli->query("SELECT COUNT(*) FROM `cchat` WHERE `company` = ".$user['company']." ");
$cchat_coll = $res_cchat_col->fetch_array(MYSQLI_NUM);
if($cchat_coll[0]!=$company_user['cchat_coll']){
$mysqli->query('UPDATE `company_user` SET `cchat_coll` = "'.$cchat_coll[0].'" WHERE `id` = "'.$company_user['id'].'" LIMIT 1');
}





$res_cchat_text = $mysqli->query('SELECT * FROM `cchat` WHERE `company` = "'.$user['company'].'" and `user` = "'.$user['id'].'" and `text` = "0" LIMIT 1');
$cchat_text = $res_cchat_text->fetch_assoc();

$res_cchat_col = $mysqli->query("SELECT COUNT(*) FROM `cchat` WHERE `company` = ".$user['company']." ");
$cchat_coll = $res_cchat_col->fetch_array(MYSQLI_NUM);
if($cchat_coll[0]!=$company_user['cchat_coll']){
$mysqli->query('UPDATE `company_user` SET `cchat_coll` = "'.$cchat_coll[0].'" WHERE `id` = "'.$company_user['id'].'" LIMIT 1');
}



echo '<br><form class="pb10" w:id="newPmForm" id="id1" method="post" action="?submit"><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id1_hf_0" id="id1_hf_0"></div>
<div class="cntr mb5">';

if(!$cchat_text){
echo '<textarea id="message" placeholder="Написать сообщение" rows="3" name="message" class="w90 p0 m0"></textarea>';
}else{
$res_anks = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$cchat_text['ank'].'" ');
$anks_ = $res_anks->fetch_assoc();
echo '<textarea id="message" placeholder="Написать сообщение" rows="3" name="message" class="w90 p0 m0">'.$anks_['login'].', </textarea>';
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
$res_text = $mysqli->query("SELECT COUNT(*) FROM `cchat` WHERE `user` = ".$user['id']." and `company` = '".$user['company']."' and `text` = '".$message."' and `time` > '".(time()-90)."' ");
$txt_povtor = $res_text->fetch_array(MYSQLI_NUM);
if($txt_povtor[0]>0){header('Location: ?');$_SESSION['err'] = "Ваше сообщение повторяется!";exit();}
if(!$cchat_text){
$mysqli->query('INSERT INTO `cchat` SET `company` = "'.$user['company'].'", `text` = "'.$message.'", `time` = "'.time().'", `user` = "'.$user['id'].'"');
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












$res = $mysqli->query("SELECT COUNT(*) FROM `cchat` WHERE `company` = ".$user['company']." and `text` != '0' ");
$k_post = $res->fetch_array(MYSQLI_NUM);
if($k_post[0]>0){
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content white bold small sh_b">';
$max = 10;
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$cchat_ = $mysqli->query('SELECT * FROM `cchat` WHERE `company` = '.$user['company'].' and `text` != "0" ORDER BY `id` DESC LIMIT '.$start.','.$max.' ');
while ($cchat = $cchat_->fetch_array()){
$res_user = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$cchat['user'].'" ');
$user_ = $res_user->fetch_assoc();
$res_ank = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$cchat['ank'].'" ');
$ank_ = $res_ank->fetch_assoc();
$res_company_user = $mysqli->query('SELECT * FROM `company_user` WHERE `user` = '.$cchat['user'].' and `company` = '.$user['company'].' LIMIT 1');
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

if($cchat['user']!=$user['id']){echo ' <a class="gray1" href="/otvetccb/'.$cchat['id'].'/'.$page.'/">[ответ]</a>';}
if($company_user['company_rang'] <= 2){echo ' <a href="/ccdelb/'.$cchat['id'].'/'.$page.'/"><img alt="+" src="/images/tresh1.png" width="16" height="16"></a>';}
echo '<br>';
}

}
if ($k_page > 1) {
echo str(''.$HOME.'company/battle/?',$k_page,$page); // Вывод страниц
}
echo '</div></div></div></div></div></div></div></div></div></div>';
}else{
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content white bold small sh_b">';
echo '<center>Сообщений не найдено.</center>';
echo '</div></div></div></div></div></div></div></div></div></div>';
}







$mysqli->query('DELETE FROM `cchat` WHERE `text` = "0" and `time` < "'.time().'"');













$resb_s = $mysqli->query('SELECT * FROM `boevaya_sila` WHERE `user` = "'.$user['id'].'" and `local` = "4" limit 1');
$b_s = $resb_s->fetch_assoc();

echo '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">';
if($b_s['bon_col']<=0){
echo '<div class="medium cntr pb5 white"><span class="bold">Боевая сила: не активна</span><br>Активировать бонус к параметрам</div>
<table class="ta_c"><tbody><tr>
<td class="w33"><a class="simple-but border mb5" href="?bs1"><span><span>+50</span></span></a><img class="ico vm" src="/images/icons/glory.png?2" alt="Слава" title="Слава"> 100</td>
<td class="w33"><a class="simple-but border mb5" href="?bs2"><span><span>+100</span></span></a><img class="ico vm" src="/images/icons/glory.png?2" alt="Слава" title="Слава"> 200</td>
<td class="w33"><a class="simple-but border mb5" href="?bs3"><span><span>+150</span></span></a><img class="ico vm" src="/images/icons/glory.png?2" alt="Слава" title="Слава"> 500</td>
</tr></tbody></table>';
}else{
if($b_s['tip']==1){$param = 50;}elseif($b_s['tip']==2){$param = 100;}elseif($b_s['tip']==3){$param = 150;}
echo '<div class="small cntr pb2 white">Боевая сила: '.$b_s['tip'].' уровень
<div><span class="green1">+'.$param.'</span> к параметрам в следующей битве</div>
<div>Действие: '.$b_s['bon_col'].' битв(ы)</div></div>';
}
echo '</div></div></div></div></div></div></div></div></div></div>'; 



if(isset($_GET['bs1'])){
$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user`  = "'.$user['id'].'" LIMIT 1');
$a_users = $res->fetch_assoc();

if($b_s['bon_col']>0){header('Location: ?');exit();}
if($a_users['glory']<100){$_SESSION['err'] = '<div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/glory.png" alt="Слава" title="Слава"> '.(100-$a_users['glory']).' славы</div>';header('Location: ?');exit();}


if(!$b_s){
$mysqli->query('INSERT INTO `boevaya_sila` SET `user` = '.$user['id'].', `local` = "4", `bon_col` = "2", `tip` = "1" ');
}else{
$mysqli->query("UPDATE `boevaya_sila` SET `local` = '4', `bon_col` = 21', `tip` = '1' WHERE `id` = '".$b_s['id']."' LIMIT 1");
}

$res_users_tanks = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = '.$user['id'].' and `active`  = "1" LIMIT 1');
$users_tanks = $res_users_tanks->fetch_assoc();$param = 50;
$users_tanks['a'] = ($users_tanks['a']+$param);$users_tanks['b'] = ($users_tanks['b']+$param);$users_tanks['t'] = ($users_tanks['t']+$param);$users_tanks['p'] = ($users_tanks['p']+$param);
$mysqli->query('UPDATE `company_battle_user_assault` SET `a` = "'.($users_tanks['a']).'", `b` = "'.($users_tanks['b']).'", `t` = "'.($users_tanks['t']).'", `p` = "'.($users_tanks['p']*2).'", `p_` = "'.($users_tanks['p']*2).'" WHERE `id` = "'.$c_b_u_a['id'].'" LIMIT 1');

$mysqli->query("UPDATE `ammunition_users` SET `glory` = '".($a_users['glory']-100)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
header('Location: ?');
exit();
}

if(isset($_GET['bs2'])){
$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user`  = "'.$user['id'].'" LIMIT 1');
$a_users = $res->fetch_assoc();
if($b_s['bon_col']>0){header('Location: ?');exit();}
if($a_users['glory']<200){$_SESSION['err'] = '<div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/glory.png" alt="Слава" title="Слава"> '.(200-$a_users['glory']).' славы</div>';header('Location: ?');exit();}
if(!$b_s){
$mysqli->query('INSERT INTO `boevaya_sila` SET `user` = '.$user['id'].', `local` = "4", `bon_col` = "2", `tip` = "2" ');
}else{
$mysqli->query("UPDATE `boevaya_sila` SET `local` = '4', `bon_col` = '2', `tip` = '2' WHERE `id` = '".$b_s['id']."' LIMIT 1");
}

$res_users_tanks = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = '.$user['id'].' and `active`  = "1" LIMIT 1');
$users_tanks = $res_users_tanks->fetch_assoc();$param = 100;
$users_tanks['a'] = ($users_tanks['a']+$param);$users_tanks['b'] = ($users_tanks['b']+$param);$users_tanks['t'] = ($users_tanks['t']+$param);$users_tanks['p'] = ($users_tanks['p']+$param);
$mysqli->query('UPDATE `company_battle_user_assault` SET `a` = "'.($users_tanks['a']).'", `b` = "'.($users_tanks['b']).'", `t` = "'.($users_tanks['t']).'", `p` = "'.($users_tanks['p']*2).'", `p_` = "'.($users_tanks['p']*2).'" WHERE `id` = "'.$c_b_u_a['id'].'" LIMIT 1');

$mysqli->query("UPDATE `ammunition_users` SET `glory` = '".($a_users['glory']-200)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
header('Location: ?');
exit();
}

if(isset($_GET['bs3'])){
$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user`  = "'.$user['id'].'" LIMIT 1');
$a_users = $res->fetch_assoc();
if($b_s['bon_col']>0){header('Location: ?');exit();}
if($a_users['glory']<500){$_SESSION['err'] = '<div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/glory.png" alt="Слава" title="Слава"> '.(500-$a_users['glory']).' славы</div>';header('Location: ?');exit();}
if(!$b_s){
$mysqli->query('INSERT INTO `boevaya_sila` SET `user` = '.$user['id'].', `local` = "4", `bon_col` = "2", `tip` = "3" ');
}else{
$mysqli->query("UPDATE `boevaya_sila` SET `local` = '4', `bon_col` = '2', `tip` = '3' WHERE `id` = '".$b_s['id']."' LIMIT 1");
}

$res_users_tanks = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = '.$user['id'].' and `active`  = "1" LIMIT 1');
$users_tanks = $res_users_tanks->fetch_assoc();$param = 150;
$users_tanks['a'] = ($users_tanks['a']+$param);$users_tanks['b'] = ($users_tanks['b']+$param);$users_tanks['t'] = ($users_tanks['t']+$param);$users_tanks['p'] = ($users_tanks['p']+$param);
$mysqli->query('UPDATE `company_battle_user_assault` SET `a` = "'.($users_tanks['a']).'", `b` = "'.($users_tanks['b']).'", `t` = "'.($users_tanks['t']).'", `p` = "'.($users_tanks['p']*2).'", `p_` = "'.($users_tanks['p']*2).'" WHERE `id` = "'.$c_b_u_a['id'].'" LIMIT 1');

$mysqli->query("UPDATE `ammunition_users` SET `glory` = '".($a_users['glory']-500)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
header('Location: ?');
exit();
}










##################################################################################################################чат
##################################################################################################################чат
##################################################################################################################чат
require_once ('../../system/footer.php');
}else























	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	



if($c_b_a['time']>=(time()+301)){
##################################################################################################################НАЧАЛО
##################################################################################################################НАЧАЛО
##################################################################################################################НАЧАЛО
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="Keywords" content="Танки, игры, RPG, MMORPG, онлайн игра, онлайн, wap, бесплатно, играть онлайн, ролевые игры, лучшие онлайн игры, браузерная игра, сражения, бои, турниры, задания, битвы, поле боя">
<meta name="google" content="notranslate">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Танки">
<meta property="og:title" content="Танки">
<meta property="og:description" content="Погрузись в мир танков, учавствуй в легендарных сражениях, покажи на что ты способен!">
<meta property="og:url" content="<?=$HOME?>">
<meta property="og:locale" content="ru_RU">
<meta property="og:image" content="/images/logo.jpg">
<meta property="og:image:width" content="2560">
<meta property="og:image:height" content="1024">
<link rel="icon" href="/favicon.ico" type="image/png">
<link rel="stylesheet" type="text/css" href="/diz.css"><title>Танки</title>
</head>
<body><div class="mt5">
<?
echo '<div class="medium white bold cntr mb2">Спецзадание</div>';

if($c_b_a['time']>=(time()+306) && $c_b_a['time']<=(time()+307)){
echo '<div class="buy-place-block"><div class="line1">Сражение начинается</div></div>';
}elseif($c_b_a['time']>=time() && $c_b_a['time']<=(time()+306)){
echo '<div class="buy-place-block"><div class="line1">До начала сражения: '.tls($c_b_a['time']-(time()+300)).' секунд</div></div>';
}

echo '<img width="100%" class="mb5" src="/images/war'.$c_b_a['images'].'.png">';
echo '<a href="?" class="simple-but"><span><span>Обновить</span></span></a>';
##################################################################################################################НАЧАЛО
##################################################################################################################НАЧАЛО
##################################################################################################################НАЧАЛО
}else
	






































if($c_b_a['time']>=time() && $c_b_a['time']<=(time()+300) and ($c_b_u_a or !$past_a or $c_u_a) and $c_b_u_a['p_']>0 ){
##################################################################################################################БОЙ
##################################################################################################################БОЙ
##################################################################################################################БОЙ
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="Keywords" content="Танки, игры, RPG, MMORPG, онлайн игра, онлайн, wap, бесплатно, играть онлайн, ролевые игры, лучшие онлайн игры, браузерная игра, сражения, бои, турниры, задания, битвы, поле боя">
<meta name="google" content="notranslate">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Танки">
<meta property="og:title" content="Танки">
<meta property="og:description" content="Погрузись в мир танков, учавствуй в легендарных сражениях, покажи на что ты способен!">
<meta property="og:url" content="<?=$HOME?>">
<meta property="og:locale" content="ru_RU">
<meta property="og:image" content="/images/logo.jpg">
<meta property="og:image:width" content="2560">
<meta property="og:image:height" content="1024">
<link rel="icon" href="/favicon.ico" type="image/png">
<link rel="stylesheet" type="text/css" href="/diz.css"><title>Танки</title>
</head>
<body>
<?

/* $res_users_tanks = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = '.$user['id'].' and `active`  = "1" LIMIT 1');
$users_tanks = $res_users_tanks->fetch_assoc();
 */

$col_u_ = $mysqli->query("SELECT COUNT(*) FROM `company_battle_user_assault` WHERE `id_battle` = ".$c_b_a['id']." and `p_` > '0' ");
$col_u = $col_u_->fetch_array(MYSQLI_NUM);

$res = $mysqli->query('SELECT * FROM `shellskills` WHERE `user` = "'.$user['id'].'" LIMIT 1');
$shell_s = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `vip` WHERE `user` = "'.$user['id'].'" LIMIT 1');
$vip = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user`  = "'.$user['id'].'" LIMIT 1');
$a_users = $res->fetch_assoc();


if($c_b_a['projectile']==1){
$butt = 'БРОНЕБОЙНЫЕ&nbsp;('.$a_users['b'].')';
$img = 'ArmorPiercing';
$href = 'attack'.$c_b_a['id'].'_bb';
}elseif($c_b_a['projectile']==2){
$butt = 'ФУГАСНЫЕ&nbsp;('.$a_users['f'].')';
$img = 'HighExplosive';
$href = 'attack'.$c_b_a['id'].'_f';
}elseif($c_b_a['projectile']==3){
$butt = 'КУМУЛЯТИВНЫЕ&nbsp;('.$a_users['k'].')';
$img = 'HollowCharge';
$href = 'attack'.$c_b_a['id'].'_k';
}

if($c_b_a['p']>0){
$assaultP = round(100/($a['p']/($c_b_a['p'])));
if($assaultP > 100) {$assaultP = 100;}
}else{$assaultP = 0;}

$usP = round(100/($c_b_u_a['p']/($c_b_u_a['p_']+0.00001)));
if($usP > 100) {$usP = 100;}






if(isset($_GET['attack'.$c_b_a['id'].''])){ // обычный
if($past_a){header('Location: ?');exit();}
if($c_b_a['time']<time()){header('Location: ?');exit();}
if(!$c_b_u_a){header('Location: ?');exit();}
if($c_b_u_a['p_']<=0){header('Location: ?');exit();}
if($c_u_a['time_restart']==0){header('Location: ?');exit();}
if($a['b']<500){$armor = ($a['b']/10);}else{$armor = ($a['b']/40);}
$attack = (($c_b_u_a['a']/4) -(($c_b_u_a['a']/4)*$armor/100) );

##################################################################################### умения
$res_s3 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "3" and `user`  = "'.$user['id'].'" ');
$skills_3 = $res_s3->fetch_assoc(); // Слабые места

$res_s5 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "5" and `user`  = "'.$user['id'].'" ');
$skills_5 = $res_s5->fetch_assoc(); // Снайпер

$rand_s3 = rand(1,100); // Слабые места
if($rand_s3 <= $skills_3['bon']){if($skills_5['bon']>0){$attack = floor($attack+($attack*(rand($skills_5['bon'],($skills_5['bon']+50)))/100));$txt_krit = "<span class='red1'>(крит)</span>";}elsE{$attack = $attack;$txt_krit = "";}}//если выпал крит смотрим как прокачан снайпер и увеличиваем урон
##################################################################################### умения

if(($c_u_a['time_attack']-time()) >= 3){
$attack = 0;
}elseif(($c_u_a['time_attack']-time()) == 2){
$attack = ($attack*20/100);
}elseif(($c_u_a['time_attack']-time()) == 1){
$attack = ($attack*60/100);
}elseif(($c_u_a['time_attack']-time()) <= 0){
$attack = $attack;
}

if($vip['time1']>time()){$v1 = 25;}elsE{$v1 = 0;}
if($vip['time3']>time()){$v3 = 50;}elsE{$v3 = 0;}
if($vip['time4']>time()){$v4 = 50;}elsE{$v4 = 0;}
$attack = ($attack+ ($attack*($shell_s['o']+$v1+$v3+$v4)/100));
$attack = ($attack- ($attack*rand(0.1,10)/100));
if($attack>$c_b_a['p']){$attack = ceil($c_b_a['p']);}else{$attack = ceil($attack);}


if(($c_u_a['time_attack']-time()) >= 3){
$text = "<span class='gray1'>Снаряд ещё не заряжен</span>";
$mysqli->query('INSERT INTO `company_battle_log` SET `time` = "'.time().'", `text` = "'.$text.'", `id_assault` = "'.$c_b_a['id'].'", `user` = "'.$user['id'].'"');
}else{
$text = "<span class='yellow1 td_u'>".$user['login']."</span> <img src='/images/shells/Regular.png'> выстрелил в <span class='yellow1 td_u'>".$a['name']."</span> на <span class='red1'>".$attack." урона ".$txt_krit."</span>";
$mysqli->query("UPDATE `company_user_assault` SET `time_attack` = '".(time()+5)."' WHERE `id` = '".$c_u_a['id']."' LIMIT 1");
}

$mysqli->query('INSERT INTO `company_battle_log` SET `time` = "'.time().'", `text` = "'.$text.'", `id_assault` = "'.$c_b_a['id'].'"');
$mysqli->query("UPDATE `company_battle_user_assault` SET `uron` = '".($c_b_u_a['uron']+$attack)."' WHERE `id` = '".$c_b_u_a['id']."' LIMIT 1");
$mysqli->query("UPDATE `company_battle_assault` SET `p` = '".($c_b_a['p']-$attack)."' WHERE `id` = '".$c_b_a['id']."' LIMIT 1");
$mysqli->query("UPDATE `shellskills` SET `o_` = '".($shell_s['o_']+1)."' WHERE `id` = '".$shell_s['id']."' LIMIT 1");
//$_SESSION['ses'] = 'INSERT INTO `company_battle_log` SET `time` = "'.time().'", `text` = "'.$text.'", `id_assault` = "'.$c_b_a['id'].'"';
header('Location: ?');
exit();
}


if(isset($_GET['attack'.$c_b_a['id'].'_bb'])){ // бб
if($c_b_a['time']<time()){header('Location: ?');exit();}
if($past_a){header('Location: ?');exit();}
if($a_users['b']<=0){$text = "<span class='gray1'>У вас нет такого снаряда</span>";$mysqli->query('INSERT INTO `company_battle_log` SET `time` = "'.time().'", `text` = "'.$text.'", `id_assault` = "'.$c_b_a['id'].'", `user` = "'.$user['id'].'"');header('Location: ?');exit();}
if(!$c_b_u_a){header('Location: ?');exit();}
if($c_b_u_a['p_']<=0){header('Location: ?');exit();}
if($c_u_a['time_restart']==0){header('Location: ?');exit();}
if($a['b']<500){$armor = ($a['b']/10);}else{$armor = ($a['b']/40);}
$uron = (($c_b_u_a['a']/4)*1/100);
$attack = ((($c_b_u_a['a']/4)+$uron) -((($c_b_u_a['a']/4)+$uron)*$armor/100) );

##################################################################################### умения
$res_s3 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "3" and `user`  = "'.$user['id'].'" ');
$skills_3 = $res_s3->fetch_assoc(); // Слабые места

$res_s5 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "5" and `user`  = "'.$user['id'].'" ');
$skills_5 = $res_s5->fetch_assoc(); // Снайпер

$rand_s3 = rand(1,100); // Слабые места
if($rand_s3 <= $skills_3['bon']){if($skills_5['bon']>0){$attack = floor($attack+($attack*(rand($skills_5['bon'],($skills_5['bon']+50)))/100));$txt_krit = "<span class='red1'>(крит)</span>";}elsE{$attack = $attack;$txt_krit = "";}}//если выпал крит смотрим как прокачан снайпер и увеличиваем урон
##################################################################################### умения

if(($c_u_a['time_attack']-time()) >= 3){
$attack = 0;
}elseif(($c_u_a['time_attack']-time()) == 2){
$attack = ($attack*20/100);
}elseif(($c_u_a['time_attack']-time()) == 1){
$attack = ($attack*60/100);
}elseif(($c_u_a['time_attack']-time()) <= 0){
$attack = $attack;
}

if($vip['time1']>time()){$v1 = 25;}elsE{$v1 = 0;}
if($vip['time3']>time()){$v3 = 50;}elsE{$v3 = 0;}
if($vip['time4']>time()){$v4 = 50;}elsE{$v4 = 0;}
$attack = ($attack+ ($attack*($shell_s['b']+50+$v1+$v3+$v4)/100));
$attack = ($attack- ($attack*rand(0.1,5)/100));
if($attack>$c_b_a['p']){$attack = ceil($c_b_a['p']);}else{$attack = ceil($attack);}
if(($c_u_a['time_attack']-time()) >= 3){
$text = "<span class='gray1'>Снаряд ещё не заряжен</span>";
$mysqli->query('INSERT INTO `company_battle_log` SET `time` = "'.time().'", `text` = "'.$text.'", `id_assault` = "'.$c_b_a['id'].'", `user` = "'.$user['id'].'"');
}else{
$text = "<span class='yellow1 td_u'>".$user['login']."</span> <img src='/images/shells/".$img .".png'> выстрелил в <span class='yellow1 td_u'>".$a['name']."</span> на <span class='red1'>".$attack." урона ".$txt_krit."</span>";
$mysqli->query("UPDATE `company_user_assault` SET `time_attack` = '".(time()+5)."' WHERE `id` = '".$c_u_a['id']."' LIMIT 1");
$mysqli->query('INSERT INTO `company_battle_log` SET `time` = "'.time().'", `text` = "'.$text.'", `id_assault` = "'.$c_b_a['id'].'"');
$mysqli->query("UPDATE `ammunition_users` SET `b` = '".($a_users['b']-1)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
$mysqli->query("UPDATE `company_battle_user_assault` SET `uron` = '".($c_b_u_a['uron']+$attack)."' WHERE `id` = '".$c_b_u_a['id']."' LIMIT 1");
$mysqli->query("UPDATE `company_battle_assault` SET `p` = '".($c_b_a['p']-$attack)."' WHERE `id` = '".$c_b_a['id']."' LIMIT 1");
$mysqli->query("UPDATE `shellskills` SET `b_` = '".($shell_s['b_']+1)."' WHERE `id` = '".$shell_s['id']."' LIMIT 1");
}
header('Location: ?');
exit();
}


if(isset($_GET['attack'.$c_b_a['id'].'_k'])){ // к
if($c_b_a['time']<time()){header('Location: ?');exit();}
if($past_a){header('Location: ?');exit();}
if($a_users['k']<=0){$text = "<span class='gray1'>У вас нет такого снаряда</span>";$mysqli->query('INSERT INTO `company_battle_log` SET `time` = "'.time().'", `text` = "'.$text.'", `id_assault` = "'.$c_b_a['id'].'", `user` = "'.$user['id'].'"');header('Location: ?');exit();}
if(!$c_b_u_a){header('Location: ?');exit();}
if($c_b_u_a['p_']<=0){header('Location: ?');exit();}
if($c_u_a['time_restart']==0){header('Location: ?');exit();}
if($a['b']<500){$armor = ($a['b']/10);}else{$armor = ($a['b']/40);}
$uron = (($c_b_u_a['a']/4)*1/100);
$attack = ((($c_b_u_a['a']/4)+$uron) -((($c_b_u_a['a']/4)+$uron)*$armor/100) );

##################################################################################### умения
$res_s3 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "3" and `user`  = "'.$user['id'].'" ');
$skills_3 = $res_s3->fetch_assoc(); // Слабые места

$res_s5 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "5" and `user`  = "'.$user['id'].'" ');
$skills_5 = $res_s5->fetch_assoc(); // Снайпер

$rand_s3 = rand(1,100); // Слабые места
if($rand_s3 <= $skills_3['bon']){if($skills_5['bon']>0){$attack = floor($attack+($attack*(rand($skills_5['bon'],($skills_5['bon']+50)))/100));$txt_krit = "<span class='red1'>(крит)</span>";}elsE{$attack = $attack;$txt_krit = "";}}//если выпал крит смотрим как прокачан снайпер и увеличиваем урон
##################################################################################### умения

if(($c_u_a['time_attack']-time()) >= 3){
$attack = 0;
}elseif(($c_u_a['time_attack']-time()) == 2){
$attack = ($attack*20/100);
}elseif(($c_u_a['time_attack']-time()) == 1){
$attack = ($attack*60/100);
}elseif(($c_u_a['time_attack']-time()) <= 0){
$attack = $attack;
}

if($vip['time1']>time()){$v1 = 25;}elsE{$v1 = 0;}
if($vip['time3']>time()){$v3 = 50;}elsE{$v3 = 0;}
if($vip['time4']>time()){$v4 = 50;}elsE{$v4 = 0;}
$attack = ($attack+ ($attack*($shell_s['k']+50+$v1+$v3+$v4)/100));
$attack = ($attack- ($attack*rand(0.1,5)/100));
if($attack>$c_b_a['p']){$attack = ceil($c_b_a['p']);}else{$attack = ceil($attack);}
if(($c_u_a['time_attack']-time()) >= 3){
$text = "<span class='gray1'>Снаряд ещё не заряжен</span>";
$mysqli->query('INSERT INTO `company_battle_log` SET `time` = "'.time().'", `text` = "'.$text.'", `id_assault` = "'.$c_b_a['id'].'", `user` = "'.$user['id'].'"');
}else{
$text = "<span class='yellow1 td_u'>".$user['login']."</span> <img src='/images/shells/".$img .".png'> выстрелил в <span class='yellow1 td_u'>".$a['name']."</span> на <span class='red1'>".$attack." урона ".$txt_krit."</span>";
$mysqli->query("UPDATE `company_user_assault` SET `time_attack` = '".(time()+5)."' WHERE `id` = '".$c_u_a['id']."' LIMIT 1");
$mysqli->query('INSERT INTO `company_battle_log` SET `time` = "'.time().'", `text` = "'.$text.'", `id_assault` = "'.$c_b_a['id'].'"');
$mysqli->query("UPDATE `ammunition_users` SET `k` = '".($a_users['k']-1)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
$mysqli->query("UPDATE `company_battle_user_assault` SET `uron` = '".($c_b_u_a['uron']+$attack)."' WHERE `id` = '".$c_b_u_a['id']."' LIMIT 1");
$mysqli->query("UPDATE `company_battle_assault` SET `p` = '".($c_b_a['p']-$attack)."' WHERE `id` = '".$c_b_a['id']."' LIMIT 1");
$mysqli->query("UPDATE `shellskills` SET `k_` = '".($shell_s['k_']+1)."' WHERE `id` = '".$shell_s['id']."' LIMIT 1");
}
header('Location: ?');
exit();
}


if(isset($_GET['attack'.$c_b_a['id'].'_f'])){ // f
if($c_b_a['time']<time()){header('Location: ?');exit();}
if($past_a){header('Location: ?');exit();}
if($a_users['f']<=0){$text = "<span class='gray1'>У вас нет такого снаряда</span>";$mysqli->query('INSERT INTO `company_battle_log` SET `time` = "'.time().'", `text` = "'.$text.'", `id_assault` = "'.$c_b_a['id'].'", `user` = "'.$user['id'].'"');header('Location: ?');exit();}
if(!$c_b_u_a){header('Location: ?');exit();}
if($c_b_u_a['p_']<=0){header('Location: ?');exit();}
if($c_u_a['time_restart']==0){header('Location: ?');exit();}
if($a['b']<500){$armor = ($a['b']/10);}else{$armor = ($a['b']/40);}
$uron = (($c_b_u_a['a']/4)*1/100);
$attack = ((($c_b_u_a['a']/4)+$uron) -((($c_b_u_a['a']/4)+$uron)*$armor/100) );

##################################################################################### умения
$res_s3 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "3" and `user`  = "'.$user['id'].'" ');
$skills_3 = $res_s3->fetch_assoc(); // Слабые места

$res_s5 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "5" and `user`  = "'.$user['id'].'" ');
$skills_5 = $res_s5->fetch_assoc(); // Снайпер

$rand_s3 = rand(1,100); // Слабые места
if($rand_s3 <= $skills_3['bon']){if($skills_5['bon']>0){$attack = floor($attack+($attack*(rand($skills_5['bon'],($skills_5['bon']+50)))/100));$txt_krit = "<span class='red1'>(крит)</span>";}elsE{$attack = $attack;$txt_krit = "";}}//если выпал крит смотрим как прокачан снайпер и увеличиваем урон
##################################################################################### умения

if(($c_u_a['time_attack']-time()) >= 3){
$attack = 0;
}elseif(($c_u_a['time_attack']-time()) == 2){
$attack = ($attack*20/100);
}elseif(($c_u_a['time_attack']-time()) == 1){
$attack = ($attack*60/100);
}elseif(($c_u_a['time_attack']-time()) <= 0){
$attack = $attack;
}

if($vip['time1']>time()){$v1 = 25;}elsE{$v1 = 0;}
if($vip['time3']>time()){$v3 = 50;}elsE{$v3 = 0;}
if($vip['time4']>time()){$v4 = 50;}elsE{$v4 = 0;}
$attack = ($attack+ ($attack*($shell_s['f']+50+$v1+$v3+$v4)/100));
$attack = ($attack- ($attack*rand(0.1,5)/100));
if($attack>$c_b_a['p']){$attack = ceil($c_b_a['p']);}else{$attack = ceil($attack);}
if(($c_u_a['time_attack']-time()) >= 3){
$text = "<span class='gray1'>Снаряд ещё не заряжен</span>";
$mysqli->query('INSERT INTO `company_battle_log` SET `time` = "'.time().'", `text` = "'.$text.'", `id_assault` = "'.$c_b_a['id'].'", `user` = "'.$user['id'].'"');
}else{
$text = "<span class='yellow1 td_u'>".$user['login']."</span> <img src='/images/shells/".$img .".png'> выстрелил в <span class='yellow1 td_u'>".$a['name']."</span> на <span class='red1'>".$attack." урона ".$txt_krit."</span>";
$mysqli->query("UPDATE `company_user_assault` SET `time_attack` = '".(time()+5)."' WHERE `id` = '".$c_u_a['id']."' LIMIT 1");
$mysqli->query('INSERT INTO `company_battle_log` SET `time` = "'.time().'", `text` = "'.$text.'", `id_assault` = "'.$c_b_a['id'].'"');
$mysqli->query("UPDATE `ammunition_users` SET `f` = '".($a_users['f']-1)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
$mysqli->query("UPDATE `company_battle_user_assault` SET `uron` = '".($c_b_u_a['uron']+$attack)."' WHERE `id` = '".$c_b_u_a['id']."' LIMIT 1");
$mysqli->query("UPDATE `company_battle_assault` SET `p` = '".($c_b_a['p']-$attack)."' WHERE `id` = '".$c_b_a['id']."' LIMIT 1");
$mysqli->query("UPDATE `shellskills` SET `f_` = '".($shell_s['f_']+1)."' WHERE `id` = '".$shell_s['id']."' LIMIT 1");
}
header('Location: ?');
exit();
}



if(isset($_GET['rem'.$c_b_a['id'].''])){ // ремка
if($c_b_a['time']<time()){header('Location: ?');exit();}
if($past_a){header('Location: ?');exit();}
if(!$c_b_u_a){header('Location: ?');exit();}
if($c_b_u_a['p_']<=0){header('Location: ?');exit();}
if($c_u_a['time_restart']==0){header('Location: ?');exit();}
if($c_u_a['time_rem']>time()){header('Location: ?');exit();}
if($a_users['rem']<=0){$text = "<span class='gray1'>У вас нет ремкомплекта</span>";$mysqli->query('INSERT INTO `company_battle_log` SET `time` = "'.time().'", `text` = "'.$text.'", `id_assault` = "'.$c_b_a['id'].'", `user` = "'.$user['id'].'"');header('Location: ?');exit();}
$mysqli->query("UPDATE `ammunition_users` SET `rem` = '".($a_users['rem']-1)."' WHERE `id` = '".$a_users['id']."' LIMIT 1");
$mysqli->query("UPDATE `company_battle_user_assault` SET `p_` = '".$c_b_u_a['p']."' WHERE `id` = '".$c_b_u_a['id']."' LIMIT 1");
$mysqli->query("UPDATE `company_user_assault` SET `time_rem` = '".(time()+$skills_u['bon'])."' WHERE `id` = '".$c_u_a['id']."' LIMIT 1");
$text = "<span class='yellow1 td_u'>".$user['login']."</span> <span class='gray'>использовал ремкомплект</span>";
$mysqli->query('INSERT INTO `company_battle_log` SET `time` = "'.time().'", `text` = "'.$text.'", `id_assault` = "'.$c_b_a['id'].'"');
header('Location: ?');
exit();
}



echo '<div class="p5">
<div class="medium white bold cntr mb2">Спецзадание</div>
<div class="buy-place-block"><div class="line1"></div></div>

<table><tbody><tr>

<td class="w100 pl1">
<div class="trnt-block mb10"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="p5 cntr">
<div class="small bold red1 sh_b mb5 mt5">'.$a['name'].'</div>
<img class="tank-img" src="/images/assault/'.$c_b_a['id_assault'].'.png" alt="'.$a['name'].'">
<table class="rblock blue esmall"><tbody><tr>
<td class="progr">
<div class="scale-block"><div class="scale" style="width:'.$assaultP.'%;"><div class="in">&nbsp;</div></div><div class="mask"><div class="in">&nbsp;</div></div></div></td>
<td><div class="value-block lh1"><span><span>'.$assaultP.'%</span></span></div></td>
</tr></tbody></table>
</div></div></div></div></div></div></div></div></div></div>
</td></tr></tbody></table>

<table><tbody><tr>
<td class="w50 pr5"><a href="?attack'.$c_b_a['id'].'" class="simple-but gray"><span><span>ОБЫЧНЫЕ</span></span></a></td>
<td class="w50 pl5"><a href="?'.$href.'" class="simple-but"><span><span>'.$butt.'</span></span></a></td>
</tr></tbody></table>';

/* 
if($c_u_a['time_attack']<time()){
echo '<div id="submitButton1" class="progress-button" data-loading="Перезарядка.." data-finished="К выстрелу готов!" style="width: 100%">К выстрелу готов!<span class="tz-bar background-horizontal"></span></div>';
}else{
echo '<div id="submitButton" class="progress-button" data-loading="Перезарядка.." data-finished="К выстрелу готов!" style="width: 100%"><span class="tz-bar background-horizontal"></span></div>';
}
 */


echo '<table><tbody><tr>';
if($c_u_a['time_rem']>time()){
echo '<td class="w33 pr4"><a href="?rem'.$c_b_a['id'].'" class="simple-but blue"><span><span>'.tls($c_u_a['time_rem']-time()).' сек</span></span></a></td>';
}else{
echo '<td class="w33 pr4"><a href="?rem'.$c_b_a['id'].'" class="simple-but blue"><span><span>Ремкомплект</span></span></a></td>';
}



if($c_b_u_a['p_']<=0){
$p_ = 0;
}else{
$p_ = $c_b_u_a['p_'];
}

echo '<td class="w33 plr4"></td>
</tr></tbody></table>

<div class="trnt-block mb10"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="p5 cntr">
<table class="rblock esmall"><tbody><tr>



<td class="progr rate-block">
<div class="scale-block"><div class="scale" style="width:'.$usP.'%;"><div class="in">&nbsp;</div></div>
<div class="mask"><div class="in">&nbsp;</div></div></div>
</td>


<td><div class="value-block lh1"><span><span>'.$p_.'</span></span></div></td>
</tr></tbody></table>
</div></div></div></div></div></div></div></div></div></div>';

if($c_b_a){
echo '<div class="medium bold white cntr mb6">Танков в строю: '.$col_u[0].'</div>';
}




echo '<div class="trnt-block mb10"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content small white">';

$past_a_ = $mysqli->query('SELECT * FROM `company_pastassaults` WHERE `id_battle` = "'.$c_u_a['id_battle'].'" LIMIT 1');
$past_a = $past_a_->fetch_assoc();


//echo ''.$past_a['id'].' '.$c_u_a['id_battle'].' '.$c_u_a['id'].' ';


if($past_a['pobeda']!=0){
if($past_a['pobeda']==$user['id']){
echo '<span class="orange">Вы уничтожили <span class="yellow1 td_u">'.$a['name'].'</span></span><br>';
}else{
$res_ank = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$past_a['pobeda'].'" LIMIT 1');
$ank = $res_ank->fetch_assoc();
echo '<span class="yellow1 td_u">'.$ank['login'].'</span> <span class="orange">уничтожил <span class="yellow1 td_u">'.$a['name'].'</span></span><br>';
}
}


$res1 = $mysqli->query('SELECT * FROM `company_battle_log` WHERE `id_assault` = '.$c_u_a['id_battle'].' and (`user` = '.$user['id'].' or `user` = 0) ORDER BY `id` desc LIMIT 10');
while ($t_r1 = $res1->fetch_array()){
if($t_r1['user']==$user['id']){
echo ''.$t_r1['text'].'<br>';
}else{
if($t_r1['user']==0){
echo ''.$t_r1['text'].'<br>';
}
}
}

echo '</div></div></div></div></div></div></div></div></div></div>';





echo '<div class="footer"></div>
</div>';





/* echo ''._time($c_b_a['time']-time()).'';
echo '<a href="?" class="simple-but"><span>Обновить</span></a>';
 */






$r_c_b_u_a = $mysqli->query('SELECT * FROM `company_battle_user_assault` WHERE `time_attack_assault` <= "'.time().'" and `time_attack_assault` > "0" and `p_` > "0" ORDER BY `time_attack_assault` DESC LIMIT 10');
while ($c_b_u_a_ = $r_c_b_u_a->fetch_array()){
if($c_b_u_a_['time_attack_assault']<=time()){
$res_ank_ = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$c_b_u_a_['user'].'" LIMIT 1');
$ank_ = $res_ank_->fetch_assoc();
if($c_b_a['id_assault']==1){$rand_p = rand(0,25);$a_a = ceil((250 - (250*$rand_p/100))/$c_uu___[0]);}elseif($c_b_a['id_assault']==2){$rand_p = rand(0,25);$a_a = ceil((777 - (777*$rand_p/100))/$c_uu___[0]);}elseif($c_b_a['id_assault']==3){$rand_p = rand(0,25);$a_a = ceil((1000 - (1000*$rand_p/100))/$c_uu___[0]);}elseif($c_b_a['id_assault']==4){$rand_p = rand(0,25);$a_a = ceil((1500 - (1500*$rand_p/100))/$c_uu___[0]);}elseif($c_b_a['id_assault']==5){$rand_p = rand(0,25);$a_a = ceil((2000 - (2000*$rand_p/100))/$c_uu___[0]);}elseif($c_b_a['id_assault']==6){$rand_p = rand(0,25);$a_a = ceil((2500 - (2500*$rand_p/100))/$c_uu___[0]);}
$for = ceil((time()-$c_b_u_a_['time_attack_assault'])/10);
if(($a_a*$for)>=$c_b_u_a_['p_']){
$for=ceil($c_b_u_a_['p_']/$a_a);
}else{
if($for==0){$for=1;}else{$for=$for;}
}

if($c_b_u_a_['b']<500){$armor = ($c_b_u_a_['b']/10);}else{$armor = ($c_b_u_a_['b']/40);}
$a_a = ceil(($a_a) -(($a_a)*$armor/100) );

for ($i = 1; $i <= $for; $i++) {
if($a_a>=$c_b_u_a_['p_']){
$a_a=$c_b_u_a_['p_'];
$qwq = 1;
$rrr = 1;
}elseif(($a_a*$i)>=$c_b_u_a_['p_']){
$a_a=($c_b_u_a_['p_']-($a_a*($i-1)));
$qwq = 2;
$rrr = 2;
}else{
$rrr = 3;
$a_a=$a_a;
}

$res_s2 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "2" and `user`  = "'.$c_b_u_a_['user'].'" ');
$skills_2 = $res_s2->fetch_assoc(); // рикошет
$rand_s2 = rand(1,100); // Рикошет

if($rand_s2 <= $skills_2['bon']){ // Рикошет
$text = "<span class='blue1'>РИКОШЕТ: </span>".$a['name']." нанёс вам урон <span class='red1'>0</span>";
$mysqli->query('INSERT INTO `company_battle_log` SET `time` = "'.time().'", `text` = "'.$text.'", `id_assault` = "'.$c_b_u_a_['id_battle'].'", `user` = "'.$c_b_u_a_['user'].'"');
}else{
$mysqli->query("UPDATE `company_battle_user_assault` SET `p_` = `p_` - '".$a_a."' WHERE `id` = '".$c_b_u_a_['id']."' LIMIT 1");
$text = "".$a['name']." нанёс вам урон <span class='red1'>".$a_a."</span>";
$mysqli->query('INSERT INTO `company_battle_log` SET `time` = "'.time().'", `text` = "'.$text.'", `id_assault` = "'.$c_b_u_a_['id_battle'].'", `user` = "'.$c_b_u_a_['user'].'"');
}

if(($qwq==1 or $qwq==2) and $rand_s2 > $skills_2['bon']){
$text1 = "".$a['name']." <span class='orange'>уничтожил</span> <span class='yellow1 td_u'>".$ank_['login']."</span>";
$mysqli->query('INSERT INTO `company_battle_log` SET `time` = "'.time().'", `text` = "'.$text1.'", `id_assault` = "'.$c_b_u_a_['id_battle'].'"');
break;
}
/* if($qwq==2){
$text1 = "".$a['name']." <span class='orange'>уничтожил</span> <span class='yellow1 td_u'>".$ank_['login']."</span>";
$mysqli->query('INSERT INTO `company_battle_log` SET `time` = "'.time().'", `text` = "'.$text1.'", `id_assault` = "'.$c_b_u_a_['id_battle'].'"');
break;
} */
}
$mysqli->query("UPDATE `company_battle_user_assault` SET `time_attack_assault` = '".(time()+10)."' WHERE `id` = '".$c_b_u_a_['id']."' LIMIT 1");
}
if($qwq==1){
break;
}
if($qwq==2){
break;
}
}
##################################################################################################################БОЙ
##################################################################################################################БОЙ
##################################################################################################################БОЙ
}else
	




/* 
$past_a_ = $mysqli->query('SELECT * FROM `company_pastassaults` WHERE `id_battle` = "'.$c_u_a['id_battle_end'].'" LIMIT 1');
$past_a = $past_a_->fetch_assoc();


echo '
1 '.$c_b_a['time'].'<Br>
2 '.$c_b_u_a['p_'].'<Br>
3 '.$past_a['time'].'<Br>
4 '.$c_u_a['id'].'<Br>
5 '.$c_uu___[0].'<Br>
6 '.(time()).'<Br>
7 '.(time()-$past_a['time']).'<Br>
';
 */


if(

(time()-($past_a['time'])) >= 0 and (time()-($past_a['time']))<= 5   // если хп комнаты закончилось, я выиграл
or  $c_uu___[0]<=0
){  

/* echo '
1 '.$c_b_a['time'].'<Br>
2 '.$c_b_u_a['p_'].'<Br>
3 '.$past_a['time'].'<Br>
4 '.$c_u_a['id'].'<Br>
4 '.$c_uu___[0].'<Br>
';


1 1649511366
2 0
3
4 5
4 0 */



/* if(
( (($c_b_a['time']<time() and $c_b_a['time']>0)) and (!$past_a or (((time()-$past_a['time'])>=0) and ((time()-$past_a['time'])<5))) ) // если истекло время боя
or
( ($c_b_u_a['p_']<=0 and $c_uu___[0]<=0) and ((((time()-$past_a['time'])>=0) and ((time()-$past_a['time'])<5)) or !$past_a) ) // если я умер и никого больше нету
or
( (($c_b_a['time']>=time() && $c_b_a['time']<=(time()+300)) and $c_b_u_a['p_']<=0 and $c_uu___[0]>0) or (((time()-$past_a['time'])>=0) and ((time()-$past_a['time'])<5)) ) // если я умер но бой идет
or
( ($c_b_a['p']<=0) and (((time()-$past_a['time'])>=0) and ((time()-$past_a['time'])<5)) ) // если хп комнаты закончилось, я выиграл
){ */
##################################################################################################################ИТОГ 3 сек
##################################################################################################################ИТОГ 3 сек
##################################################################################################################ИТОГ 3 сек
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="Keywords" content="Танки, игры, RPG, MMORPG, онлайн игра, онлайн, wap, бесплатно, играть онлайн, ролевые игры, лучшие онлайн игры, браузерная игра, сражения, бои, турниры, задания, битвы, поле боя">
<meta name="google" content="notranslate">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Танки">
<meta property="og:title" content="Танки">
<meta property="og:description" content="Погрузись в мир танков, учавствуй в легендарных сражениях, пока на что ты способен!">
<meta property="og:url" content="<?=$HOME?>">
<meta property="og:locale" content="ru_RU">
<meta property="og:image" content="/images/logo.jpg">
<meta property="og:image:width" content="2560">
<meta property="og:image:height" content="1024">
<link rel="icon" href="/favicon.ico" type="image/png">
<link rel="stylesheet" type="text/css" href="/diz.css"><title>Танки</title>
</head>
<body><div class="mt5">
<?

if( ((time()-$past_a['time'])>=0 and ((time()-$past_a['time'])<=30))){
$a_ = $mysqli->query('SELECT * FROM `assault` WHERE `id` = '.$past_a['assault'].' LIMIT 1');
$a = $a_->fetch_assoc();
}

echo '<div class="medium white bold cntr mb2">Спецзадание</div>';
//if( ((time()-$past_a['time'])>=0 and ((time()-$past_a['time'])<=30))){
/* if( $c_b_a['time']<=time() or $c_uu___[0]<=0 ){
//if(!$c_b_u_a){header('Location: /company/assault/');exit();}
//if($c_u_a['id_battle']==0){header('Location: /company/assault/');exit();}
echo '<div class="buy-place-block"><div class="line1">Подсчитывается результат</div></div>';

if(!$c_b_u_a){
//echo '1';
}

} */
echo '<img width="100%" class="mb5" src="/images/war'.$a['id'].'.png">';
if($c_uu___[0]>0 and $c_b_a['time']>=time() ){
echo '<div class="medium bold white cntr mb6">Танков в строю: '.$c_uu___[0].'</div>';
}
echo '<a href="?" class="simple-but"><span><span>Обновить</span></span></a>';

echo '<div class="trnt-block mb10"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content small white">';
if($past_a['pobeda']!=0){
if($past_a['pobeda']==$user['id']){
echo '<span class="orange">Вы уничтожили <span class="yellow1 td_u">'.$a['name'].'</span></span><br>';
}else{
$res_ank = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$past_a['pobeda'].'" LIMIT 1');
$ank = $res_ank->fetch_assoc();
echo '<span class="yellow1 td_u">'.$ank['login'].'</span> <span class="orange">уничтожил <span class="yellow1 td_u">'.$a['name'].'</span></span><br>';
}
}

$res1 = $mysqli->query('SELECT * FROM `company_battle_log` WHERE `id_assault` = '.$c_u_a['id_battle_end'].' and (`user` = '.$user['id'].' or `user` = 0) ORDER BY `id` desc LIMIT 10');
while ($t_r1 = $res1->fetch_array()){
if($t_r1['user']==$user['id']){
echo ''.$t_r1['text'].'<br>';
}else{
if($t_r1['user']==0){
echo ''.$t_r1['text'].'<br>';
}
}
}

echo '</div></div></div></div></div></div></div></div></div></div>';
if( $c_b_a['time']<=time() or $c_uu___[0]<=0 ){
header('Location: /company/assault/');
}
##################################################################################################################ИТОГ 3 сек
##################################################################################################################ИТОГ 3 сек
##################################################################################################################ИТОГ 3 сек
}else
	





























if(  ((time()-$past_a['time'])>=5) and ((time()-$past_a['time'])<=30 )){
##################################################################################################################ИТОГ 5 сек
##################################################################################################################ИТОГ 5 сек
##################################################################################################################ИТОГ 5 сек


$c_p_u_ = $mysqli->query('SELECT * FROM `company_pastassaults_user` WHERE `id_battle` = "'.$past_a['id_battle'].'" and `user` = "'.$user['id'].'" LIMIT 1');
$c_p_u = $c_p_u_->fetch_assoc();

$a_ = $mysqli->query('SELECT * FROM `assault` WHERE `id` = '.$past_a['assault'].' LIMIT 1');
$a = $a_->fetch_assoc();

$col_u_ = $mysqli->query("SELECT COUNT(*) FROM `company_pastassaults_user` WHERE `id_battle` = ".$past_a['id_battle']." ");
$col_u = $col_u_->fetch_array(MYSQLI_NUM);

$col_u_d_ = $mysqli->query("SELECT COUNT(*) FROM `company_pastassaults_user` WHERE `id_battle` = ".$past_a['id_battle']." and `dead` = '0' ");
$col_u_d = $col_u_d_->fetch_array(MYSQLI_NUM);

?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="Keywords" content="Танки, игры, RPG, MMORPG, онлайн игра, онлайн, wap, бесплатно, играть онлайн, ролевые игры, лучшие онлайн игры, браузерная игра, сражения, бои, турниры, задания, битвы, поле боя">
<meta name="google" content="notranslate">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Танки">
<meta property="og:title" content="Танки">
<meta property="og:description" content="Погрузись в мир танков, учавствуй в легендарных сражениях, пока на что ты способен!">
<meta property="og:url" content="<?=$HOME?>">
<meta property="og:locale" content="ru_RU">
<meta property="og:image" content="/images/logo.jpg">
<meta property="og:image:width" content="2560">
<meta property="og:image:height" content="1024">
<link rel="icon" href="/favicon.ico" type="image/png">
<link rel="stylesheet" type="text/css" href="/diz.css"><title>Танки</title>
</head>
<body><div class="mt5">
<?




echo '<div class="medium white bold cntr mb2">Спецзадание</div>';
echo '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="small bold cntr gray1 sh_b mt2">

<div class="white">';
if($past_a['pobeda']==0){
echo '<img src="/images/icons/defeat.png"> <span class="red1">'.$a['name'].' НЕ уничтожен!</span> <img src="/images/icons/defeat.png">';
}else{
echo '<img src="/images/icons/victory.png"> <span class="green1">'.$a['name'].' уничтожен!</span> <img src="/images/icons/victory.png">';
}
echo '<div><div class="cntr"><img width="42%" src="/images/assault/'.$a['id'].'.png"></div>';
if($past_a['pobeda']==0){
echo '<div>Уничтожено всего: '.($c_u_a[''.$past_a['assault'].'_coll']).'</div>';
}else{
echo '<div>Уничтожено всего: '.($c_u_a[''.$past_a['assault'].'_coll']+1).'</div>';
}

echo '<span class="yellow1">Мой урон </span>: '.$c_p_u['uron'].'<br>';
if($past_a['pobeda']!=0){
echo '<span class="yellow1">Награда</span>: <span class="nwr"><img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> '.$c_p_u['gold'].' золота</span>';
}
echo '</div><br>';


$c_pu_ = $mysqli->query('SELECT * FROM `company_pastassaults_user` LEFT JOIN `company_user` USING (user) WHERE `company_pastassaults_user`.`id_battle` = "'.$c_u_a['id_battle_end'].'" and `company_pastassaults_user`.`user` != "'.$user['id'].'" ORDER BY `company_pastassaults_user`.`uron` desc, `company_user`.`company_rang` desc LIMIT 10');
while ($c_pu = $c_pu_->fetch_array()){
$us_ = $mysqli->query('SELECT * FROM `users` WHERE `id` = '.$c_pu['user'].' LIMIT 1');
$usr = $us_->fetch_assoc();
if($past_a['pobeda']!=0){
$g = '<img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> '.$c_pu['gold'].'';
}
echo '<span class="yellow1">'.$usr['login'].'</span> <span class="nwr"> '.$g.' ('.$c_pu['uron'].')</span><br>';
}


if($past_a['pobeda']!=0){
if($past_a['pobeda']==$user['id']){
echo '<br><span class="yellow1">Вы добили '.$a['name'].'</span> <span class="nwr"><img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> 1</span>';
}else{
$us__ = $mysqli->query('SELECT * FROM `users` WHERE `id` = '.$past_a['pobeda'].' LIMIT 1');
$u_s = $us__->fetch_assoc();
echo '<br><span class="yellow1">'.$u_s['login'].'</span> <span class="nwr">добил '.$a['name'].' <img class="ico vm" src="/images/icons/gold.png?2" alt="Золото" title="Золото"> 1</span>';
}
//$c = 1;
//echo '<br><br><span class="gray1">Уничтожено: '.($c_u_a[''.$past_a['assault'].'_coll']+$c).'</span>';
}


if($past_a['pobeda']!=0){echo '<br>';}
echo '<span class="gray1">Сражались: <span class="green1">'.$col_u[0].'</span> | Выжили: <span class="red1">'.$col_u_d[0].'</span></span>';
if($past_a['pobeda']!=0){
echo '<br><span class="gray1">Победа!</span>';
}else{
if($col_u_d[0]<=0){echo '<br><span class="gray1">Взвод уничтожен</span>';}else{echo '<br><span class="gray1">Вышло время!</span>';}
}
echo '</div>
<a class="simple-but green mt5 mb5" href="?"><span><span>Обновить</span></span></a>
</div></div></div></div></div></div></div></div></div></div>';




echo '<div class="pt5"><a w:id="past" class="simple-but gray" href="/company/pastassaults/"><span><span>Прошедшие спецзадания</span></span></a></div>';


$arr_text = array(
1 => "За уничтожение объекта все получают золото",
2 => "Старший взвода - это игрок с самым высоким званием и дивизионным опытом"); 
$rand_text = rand(1,2);
echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">'.$arr_text[$rand_text].'</div>
</div></div></div></div></div></div></div></div></div></div></div>';
require_once ('../../system/footer.php');
##################################################################################################################ИТОГ 5 сек
##################################################################################################################ИТОГ 5 сек
##################################################################################################################ИТОГ 5 сек
}



/* echo '
1 '.$c_b_a['time'].'<Br>
2 '.$c_b_u_a['p_'].'<Br>
3 '.$past_a['time'].'<Br>
4 '.$c_u_a['id'].'<Br>
4 '.$c_uu___[0].'<Br>
';

 */





?>