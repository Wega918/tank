<?php
$title = 'Амуниция';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}
$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user`  = "'.$user['id'].'" LIMIT 1');
$ammunition_users = $res->fetch_assoc();




if(isset($_GET['bb1'])){
if($user['gold'] < 1){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.(1-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-1).' WHERE `id` = '.$user['id'].' LIMIT 1');
$mysqli->query('UPDATE `ammunition_users` SET `b` = "'.($ammunition_users['b']+1).'" WHERE `id` = '.$ammunition_users['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb1"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="green1 sh_b mb2"><img height="14" width="14" src="/images/icons/victory.png"> Снаряд куплен! <img height="14" width="14" src="/images/icons/victory.png"></div>
</div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}
if(isset($_GET['bb10'])){
if($user['gold'] < 9){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.(1-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-9).' WHERE `id` = '.$user['id'].' LIMIT 1');
$mysqli->query('UPDATE `ammunition_users` SET `b` = "'.($ammunition_users['b']+10).'" WHERE `id` = '.$ammunition_users['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb1"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="green1 sh_b mb2"><img height="14" width="14" src="/images/icons/victory.png"> Снаряды куплены! <img height="14" width="14" src="/images/icons/victory.png"></div>
</div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}



if(isset($_GET['f1'])){
if($user['gold'] < 1){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.(1-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-1).' WHERE `id` = '.$user['id'].' LIMIT 1');
$mysqli->query('UPDATE `ammunition_users` SET `f` = "'.($ammunition_users['f']+1).'" WHERE `id` = '.$ammunition_users['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb1"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="green1 sh_b mb2"><img height="14" width="14" src="/images/icons/victory.png"> Снаряд куплен! <img height="14" width="14" src="/images/icons/victory.png"></div>
</div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}
if(isset($_GET['f10'])){
if($user['gold'] < 9){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.(1-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-9).' WHERE `id` = '.$user['id'].' LIMIT 1');
$mysqli->query('UPDATE `ammunition_users` SET `f` = "'.($ammunition_users['f']+10).'" WHERE `id` = '.$ammunition_users['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb1"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="green1 sh_b mb2"><img height="14" width="14" src="/images/icons/victory.png"> Снаряды куплены! <img height="14" width="14" src="/images/icons/victory.png"></div>
</div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}



if(isset($_GET['k1'])){
if($user['gold'] < 1){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.(1-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-1).' WHERE `id` = '.$user['id'].' LIMIT 1');
$mysqli->query('UPDATE `ammunition_users` SET `k` = "'.($ammunition_users['k']+1).'" WHERE `id` = '.$ammunition_users['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb1"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="green1 sh_b mb2"><img height="14" width="14" src="/images/icons/victory.png"> Снаряд куплен! <img height="14" width="14" src="/images/icons/victory.png"></div>
</div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}
if(isset($_GET['k10'])){
if($user['gold'] < 9){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.(1-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-9).' WHERE `id` = '.$user['id'].' LIMIT 1');
$mysqli->query('UPDATE `ammunition_users` SET `k` = "'.($ammunition_users['k']+10).'" WHERE `id` = '.$ammunition_users['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb1"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="green1 sh_b mb2"><img height="14" width="14" src="/images/icons/victory.png"> Снаряды куплены! <img height="14" width="14" src="/images/icons/victory.png"></div>
</div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}






if(isset($_GET['rem1'])){
if($user['gold'] < 2){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.(1-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-2).' WHERE `id` = '.$user['id'].' LIMIT 1');
$mysqli->query('UPDATE `ammunition_users` SET `rem` = "'.($ammunition_users['rem']+1).'" WHERE `id` = '.$ammunition_users['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb1"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="green1 sh_b mb2"><img height="14" width="14" src="/images/icons/victory.png"> Ремкомплект куплен! <img height="14" width="14" src="/images/icons/victory.png"></div>
</div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}
if(isset($_GET['rem10'])){
if($user['gold'] < 18){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.(1-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-18).' WHERE `id` = '.$user['id'].' LIMIT 1');
$mysqli->query('UPDATE `ammunition_users` SET `rem` = "'.($ammunition_users['rem']+10).'" WHERE `id` = '.$ammunition_users['id'].' LIMIT 1');
$_SESSION['err'] = '<div class="trnt-block mb1"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr">
<div class="green1 sh_b mb2"><img height="14" width="14" src="/images/icons/victory.png"> Ремкомплекты куплены! <img height="14" width="14" src="/images/icons/victory.png"></div>
</div></div></div></div></div></div></div></div></div></div>';
header('Location: ?');
exit();
}















echo'<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="white small bold sh_b mb5 cntr">
Мои амуниция
<span class="gray1 cntr blck pt5">
<span class="nwr"><img class="rico vm" src="/images/shells/ArmorPiercing.png" alt="Бронебойный снаряд" title="Бронебойный снаряд"> '.$ammunition_users['b'].' &nbsp;&nbsp;</span>
<span class="nwr"><img class="rico vm" src="/images/shells/HighExplosive.png" alt="Фугасный снаряд" title="Фугасный снаряд"> '.$ammunition_users['f'].' &nbsp;&nbsp;</span>
<span class="nwr"><img class="rico vm" src="/images/shells/HollowCharge.png" alt="Кумулятивный снаряд" title="Кумулятивный снаряд"> '.$ammunition_users['k'].' &nbsp;&nbsp;</span>
<span class="nwr"><img class="rico vm" src="/images/shells/repairkit.png"> '.$ammunition_users['rem'].' &nbsp;&nbsp;</span>
</span>
</div></div></div></div></div></div></div></div></div></div></div>';




echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="thumb fl"><img src="/images/shells/shellArmorPiercing.jpg" style="width:100%; border-radius: 9px;"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold">
<span class="green2">Бронебойный снаряд</span><br>
Цена 1шт: <span class="yellow1"><img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> 1</span><br>
Цена 10шт: <span class="yellow1"><img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> 9</span>
</div>
<div class="clrb"></div><div class="esmall gray1 sh_b mt1 mb2 cntr">эффективен против тяжёлых танков</div>
<div class="bot"><table><tbody><tr>
<td class="w50 pr1"><a class="simple-but border" href="?bb1"><span><span>Купить 1шт</span></span></a></td>
<td class="w50 pl1"><a class="simple-but border" href="?bb10"><span><span>Купить 10шт</span></span></a></td>
</tr></tbody></table></div>
</div></div></div></div></div></div></div></div></div></div>';



echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="thumb fl"><img src="/images/shells/shellHighExplosive.jpg" style="width:100%; border-radius: 9px;"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold">
<span class="green2">Фугасный  снаряд</span><br>
Цена 1шт: <span class="yellow1"><img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> 1</span><br>
Цена 10шт: <span class="yellow1"><img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> 9</span>
</div>
<div class="clrb"></div><div class="esmall gray1 sh_b mt1 mb2 cntr">эффективен против ПТ-САУ</div>
<div class="bot"><table><tbody><tr>
<td class="w50 pr1"><a class="simple-but border" href="?f1"><span><span>Купить 1шт</span></span></a></td>
<td class="w50 pl1"><a class="simple-but border" href="?f10"><span><span>Купить 10шт</span></span></a></td>
</tr></tbody></table></div>
</div></div></div></div></div></div></div></div></div></div>';


echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="thumb fl"><img src="/images/shells/shellHollowCharge.jpg" style="width:100%; border-radius: 9px;"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold">
<span class="green2">Кумулятивный  снаряд</span><br>
Цена 1шт: <span class="yellow1"><img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> 1</span><br>
Цена 10шт: <span class="yellow1"><img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> 9</span>
</div>
<div class="clrb"></div><div class="esmall gray1 sh_b mt1 mb2 cntr">эффективен против средних танков</div>
<div class="bot"><table><tbody><tr>
<td class="w50 pr1"><a class="simple-but border" href="?k1"><span><span>Купить 1шт</span></span></a></td>
<td class="w50 pl1"><a class="simple-but border" href="?k10"><span><span>Купить 10шт</span></span></a></td>
</tr></tbody></table></div>
</div></div></div></div></div></div></div></div></div></div>';


echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="thumb fl"><img src="/images/shells/repairKit.jpg" style="width:100%; border-radius: 9px;"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold">
<span class="green2">Ремкомплект</span><br>
Цена 1шт: <span class="yellow1"><img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> 2</span><br>
Цена 10шт: <span class="yellow1"><img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> 18</span>
</div>
<div class="clrb"></div><div class="esmall gray1 sh_b mt1 mb2 cntr">устраняет повреждения вашего танка</div>
<div class="bot"><table><tbody><tr>
<td class="w50 pr1"><a class="simple-but border" href="?rem1"><span><span>Купить 1шт</span></span></a></td>
<td class="w50 pl1"><a class="simple-but border" href="?rem10"><span><span>Купить 10шт</span></span></a></td>
</tr></tbody></table></div>
</div></div></div></div></div></div></div></div></div></div>';


require_once ('../system/footer.php');
?>