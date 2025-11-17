<?php
$title = 'Навыки';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}
$id = abs(intval($_GET['id']));
$res = $mysqli->query('SELECT * FROM `users` WHERE `id`  = "'.$id.'" LIMIT 1');
$ank = $res->fetch_assoc();
if($ank <= 0){header('Location: /');exit();}

$res = $mysqli->query('SELECT * FROM `shellskills` WHERE `user` = "'.$ank['id'].'" LIMIT 1');
$shell_s = $res->fetch_assoc();

if(!$shell_s){
$mysqli->query('INSERT INTO `shellskills` SET `user` = '.$ank['id'].' ');
}

$o = ceil(($shell_s['o']+1)*10);
$b = ceil(($shell_s['b']+1)*10);
$f = ceil(($shell_s['f']+1)*10);
$k = ceil(($shell_s['k']+1)*10);

$o_ = $shell_s['o_'];if($o_>$o){$o_ = $o;}
$b_ = $shell_s['b_'];if($b_>$b){$b_ = $b;}
$f_ = $shell_s['f_'];if($f_>$f){$f_ = $f;}
$k_ = $shell_s['k_'];if($k_>$k){$k_ = $k;}

$prog_o = round(100/($o/($shell_s['o_']+0.0001)));if($prog_o > 100) {$prog_o = 100;}
$prog_b = round(100/($b/($shell_s['b_']+0.0001)));if($prog_b > 100) {$prog_b = 100;}
$prog_f = round(100/($f/($shell_s['f_']+0.0001)));if($prog_f > 100) {$prog_f = 100;}
$prog_k = round(100/($k/($shell_s['k_']+0.0001)));if($prog_k > 100) {$prog_k = 100;}





##################################################################################
##################################################################################
##################################################################################
if($ank['id']==$user['id']){
echo'<div class="medium white bold cntr mb5">Навыки стрельбы </div>';
}elsE{
echo'<div class="medium white bold cntr mb5">Навыки стрельбы '.nick($ank['id']).'</div>';
}
##################################################################################
##################################################################################
##################################################################################
echo'<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content"><img class="img36 fl" alt="ammo" src="/images/shellRegular.jpg">
<div class="small ml44 white sh_b bold"><span class="green2">Обычный снаряд</span><br>+'.$shell_s['o'].'% к урону</div>
<div class="clrb"></div>';
if($shell_s['o']<50){echo '<table class="rblock blue esmall mb2 mt5"><tbody><tr>
<td><div class="value-block lh1"><span><span>'.$o_.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$prog_o.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$prog_o.'%</span></span></div></td>
</tr></tbody></table>';}
if($shell_s['o_']<$o){
echo '<div class="cntr small bold mb2">выстрелов: '.$o_.' из '.$o.'</div></div>';
}elsE{
if($ank['id']==$user['id']){
if($shell_s['o']>=50){echo '<div class="cntr small bold mb2">Прокачан по максимуму</div></div>';
}elsE{
echo '<div class="bot"><a class="simple-but border" href="?up_o"><span><span>Улучшить навык</span></span></a><div style="position:relative;"><span class="digit2 esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span></div></div>';
}
}elsE{
echo '<div class="cntr small bold mb2">выстрелов: '.$o_.' из '.$o.'</div></div>';
}
}
echo '</div></div></div></div></div></div></div></div></div>';
if($ank['id']==$user['id'])if($shell_s['o_']>=$o and $shell_s['o']<50){echo '<br>';}
##################################################################################
##################################################################################
##################################################################################
echo'<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<img class="img36 fl" alt="ammo" src="/images/shellArmorPiercing.jpg">
<div class="small ml44 white sh_b bold"><span class="green2">Бронебойный снаряд</span><br>+'.$shell_s['b'].'% к урону против тяжелых танков</div>
<div class="clrb"></div>';
if($shell_s['b']<50){echo '<table class="rblock blue esmall mb2 mt5"><tbody><tr>
<td><div class="value-block lh1"><span><span>'.$b_.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$prog_b.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$prog_b.'%</span></span></div></td>
</tr></tbody></table>';}
if($shell_s['b_']<$b){
echo '<div class="cntr small bold mb2">выстрелов: '.$b_.' из '.$b.'</div></div>';
}elsE{
if($ank['id']==$user['id']){
if($shell_s['b']>=50){echo '<div class="cntr small bold mb2">Прокачан по максимуму</div></div>';
}elsE{
echo '<div class="bot"><a class="simple-but border" href="?up_b"><span><span>Улучшить навык</span></span></a><div style="position:relative;"><span class="digit2 esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span></div></div>';
}
}elsE{
echo '<div class="cntr small bold mb2">выстрелов: '.$b_.' из '.$b.'</div></div>';
}
}
echo '</div></div></div></div></div></div></div></div></div>';
if($ank['id']==$user['id'])if($shell_s['b_']>=$b and $shell_s['b']<50){echo '<br>';}
##################################################################################
##################################################################################
##################################################################################
echo'<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<img class="img36 fl" alt="ammo" src="/images/shellHighExplosive.jpg">
<div class="small ml44 white sh_b bold"><span class="green2">Фугасный снаряд</span><br>+'.$shell_s['f'].'% к урону против истребителей</div>
<div class="clrb"></div>';
if($shell_s['f']<50){echo '<table class="rblock blue esmall mb2 mt5"><tbody><tr>
<td><div class="value-block lh1"><span><span>'.$f_.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$prog_f.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$prog_f.'%</span></span></div></td>
</tr></tbody></table>';}
if($shell_s['f_']<$f){
echo '<div class="cntr small bold mb2">выстрелов: '.$f_.' из '.$f.'</div></div>';
}elsE{
if($ank['id']==$user['id']){
if($shell_s['f']>=50){echo '<div class="cntr small bold mb2">Прокачан по максимуму</div></div>';
}elsE{
echo '<div class="bot"><a class="simple-but border" href="?up_f"><span><span>Улучшить навык</span></span></a><div style="position:relative;"><span class="digit2 esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span></div></div>';
}
}elsE{
echo '<div class="cntr small bold mb2">выстрелов: '.$f_.' из '.$f.'</div></div>';
}
}
echo '</div></div></div></div></div></div></div></div></div>';
if($ank['id']==$user['id'])if($shell_s['f_']>=$f and $shell_s['f']<50){echo '<br>';}
##################################################################################
##################################################################################
##################################################################################
echo'<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<img class="img36 fl" alt="ammo" src="/images/shellHollowCharge.jpg">
<div class="small ml44 white sh_b bold"><span class="green2">Кумулятивный снаряд</span><br>+'.$shell_s['k'].'% к урону против средних танков</div>
<div class="clrb"></div>';
if($shell_s['k']<50){echo '<table class="rblock blue esmall mb2 mt5"><tbody><tr>
<td><div class="value-block lh1"><span><span>'.$k_.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.$prog_k.'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'.$prog_k.'%</span></span></div></td>
</tr></tbody></table>';}
if($shell_s['k_']<$k){
echo '<div class="cntr small bold mb2">выстрелов: '.$k_.' из '.$k.'</div></div>';
}elsE{
if($ank['id']==$user['id']){
if($shell_s['k']>=50){echo '<div class="cntr small bold mb2">Прокачан по максимуму</div></div>';
}elsE{
echo '<div class="bot"><a class="simple-but border" href="?up_k"><span><span>Улучшить навык</span></span></a><div style="position:relative;"><span class="digit2 esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span></div></div>';
}
}elsE{
echo '<div class="cntr small bold mb2">выстрелов: '.$k_.' из '.$k.'</div></div>';
}
}
echo '</div></div></div></div></div></div></div></div></div>';
if($ank['id']==$user['id'])if($shell_s['k_']>=$k){echo '<br>';}
##################################################################################
##################################################################################
##################################################################################














if(isset($_GET['up_o'])){
if($shell_s['o_']<$o){header('Location: ?');exit();}
if($shell_s['o']>=50){header('Location: ?');exit();}
$mysqli->query("UPDATE `shellskills` SET `o` = '".($shell_s['o']+1)."', `o_` = '".($shell_s['o_']-$o)."' WHERE `id` = '".$shell_s['id']."' LIMIT 1");

####################################################################################
$mysqli->query('UPDATE `missions_user` SET `prog` = `prog` + "1" WHERE `user` = '.$user['id'].' and `id_miss` = "8" and `prog` < "1" and `time` < "'.time().'" limit 1');
$_SESSION['miss'] = 1;
####################################################################################

$_SESSION['err'] = '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr white bold">
<div class="medium green1"><img height="14" width="14" src="/images/icons/victory.png"> Улучшен навык стрельбы! <img height="14" width="14" src="/images/icons/victory.png"></div>
+'.($shell_s['o']+1).'% к урону
</div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}

if(isset($_GET['up_b'])){
if($shell_s['b_']<$b){header('Location: ?');exit();}
if($shell_s['b']>=50){header('Location: ?');exit();}
$mysqli->query("UPDATE `shellskills` SET `b` = '".($shell_s['b']+1)."', `b_` = '".($shell_s['b_']-$b)."' WHERE `id` = '".$shell_s['id']."' LIMIT 1");

####################################################################################
$mysqli->query('UPDATE `missions_user` SET `prog` = `prog` + "1" WHERE `user` = '.$user['id'].' and `id_miss` = "8" and `prog` < "1" and `time` < "'.time().'" limit 1');
$_SESSION['miss'] = 1;
####################################################################################

$_SESSION['err'] = '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr white bold">
<div class="medium green1"><img height="14" width="14" src="/images/icons/victory.png"> Улучшен навык стрельбы! <img height="14" width="14" src="/images/icons/victory.png"></div>
+'.($shell_s['b']+1).'% к урону против тяжелых танков
</div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}

if(isset($_GET['up_f'])){
if($shell_s['f_']<$f){header('Location: ?');exit();}
if($shell_s['f']>=50){header('Location: ?');exit();}
$mysqli->query("UPDATE `shellskills` SET `f` = '".($shell_s['f']+1)."', `f_` = '".($shell_s['f_']-$f)."' WHERE `id` = '".$shell_s['id']."' LIMIT 1");
####################################################################################
$mysqli->query('UPDATE `missions_user` SET `prog` = `prog` + "1" WHERE `user` = '.$user['id'].' and `id_miss` = "8" and `prog` < "1" and `time` < "'.time().'" limit 1');
$_SESSION['miss'] = 1;
####################################################################################
$_SESSION['err'] = '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr white bold">
<div class="medium green1"><img height="14" width="14" src="/images/icons/victory.png"> Улучшен навык стрельбы! <img height="14" width="14" src="/images/icons/victory.png"></div>
+'.($shell_s['f']+1).'% к урону против истребителей
</div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}

if(isset($_GET['up_k'])){
if($shell_s['k_']<$k){header('Location: ?');exit();}
if($shell_s['k']>=50){header('Location: ?');exit();}
$mysqli->query("UPDATE `shellskills` SET `k` = '".($shell_s['k']+1)."', `k_` = '".($shell_s['k_']-$k)."' WHERE `id` = '".$shell_s['id']."' LIMIT 1");
####################################################################################
$mysqli->query('UPDATE `missions_user` SET `prog` = `prog` + "1" WHERE `user` = '.$user['id'].' and `id_miss` = "8" and `prog` < "1" and `time` < "'.time().'" limit 1');
$_SESSION['miss'] = 1;
####################################################################################
$_SESSION['err'] = '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr white bold">
<div class="medium green1"><img height="14" width="14" src="/images/icons/victory.png"> Улучшен навык стрельбы! <img height="14" width="14" src="/images/icons/victory.png"></div>
+'.($shell_s['k']+1).'% к урону против средних танков
</div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}














echo'<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content small green1 cntr blck">
Максимальный навык стрельбы +50%.<br>
Навыки улучшаются при использовании снарядов.
</div></div></div></div></div></div></div></div></div></div>
<a class="simple-but border mb2" w:id="buyShellsLink" href="/ammunation/"><span><span>Купить снаряды</span></span></a>';


if($ank['id']==$user['id']){
echo '<a class="simple-but border mb2" w:id="powerLink" href="/profile/'.$ank['id'].'/"><span><span>Назад</span></span></a>';
}elsE{
echo '<a class="simple-but border mb2" w:id="powerLink" href="/power/'.$ank['id'].'/"><span><span>Назад</span></span></a>';
}


require_once ('../system/footer.php');
?>