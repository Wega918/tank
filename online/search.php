<?php
$title = 'Поиск';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}


$res1 = $mysqli->query('SELECT * FROM `settings` WHERE `id` = "1" ');
$sql = $res1->fetch_assoc();

echo '<table><tbody><tr>
<td class="tab4" w:id="td"><a class="simple-but blue" w:id="link" href="/online/"><span><span><img w:id="image" src="/images/icons/online.png"><b> Онлайн</b></span></span></a></td>
<td class="tab4" w:id="td"><a class="simple-but blue" w:id="link" href="/NotInClan/"><span><span><img w:id="image" src="/images/icons/offline.png"><b> Без дивизии</b></span></span></a></td>
<td class="tab4 active" w:id="td"><a class="simple-but blue selected" w:id="link" href="/search/"><span><span><img w:id="image" src="/images/icons/accuracy.jpg" style="width:auto; border-radius: 9px;"><b> Поиск</b></span></span></a></td>
</tr></tbody></table>';





echo '<form w:id="searchForm" id="id3" method="post" action="?okey"><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id3_hf_0" id="id3_hf_0"></div>
<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="small bold cntr white sh_b mb5">
Имя:<br>
<input w:id="name" type="text" name="login" value="" class="fld-chng" size="15" maxlength="20"><br>
</div>
<div class="bot a_w200px">
<span class="input-but green border"><span><input class="w100" type="submit" w:message="value:OnlineUsersPage.Search" value="Поиск"></span></span>
</div>
</div>
</div></div></div></div></div></div></div></div>
</div>
</form>




<table class="tlist white sh_b bold small mb10"></table>';



















if (isset($_REQUEST['okey'])){
$login = strong($_POST['login']);
if(empty($login) or mb_strlen($login) > 20) {
$_SESSION['err'] = '<font color=red>Ошибка ввода, макс. 20 симв.</font>';
header('Location: ?');
exit();
}

$res = $mysqli->query("SELECT COUNT(*) FROM `users` WHERE `login` like '%".$login."%' ");
$k_post1 = $res->fetch_array(MYSQLI_NUM);
if ($k_post1[0]==0){
$_SESSION['err'] = '<font color="red">По вашему запросу ничего не найдено</font>';
header('Location: ?');
exit();
}



$max = 50;
$res = $mysqli->query("SELECT COUNT(*) FROM `users` WHERE `login` like '%".$login."%' and `id` in (select user from users_tanks)  ");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$q = $mysqli->query('SELECT * FROM `users` WHERE `login` like "%'.$login.'%" and `id` in (select user from users_tanks) ORDER BY level desc LIMIT '.$start.','.$max.' ');

while ($ank = $q->fetch_array()){
$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = '.$ank['id'].' and `active`  = "1" LIMIT 1');
$users_tanks = $res->fetch_assoc();
$res2 = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$ank['id'].'" ');
$traning = $res2->fetch_assoc();
$params = ($users_tanks['a']+$users_tanks['b']+$users_tanks['t']+$users_tanks['p']);
$reyt = ''.$k_post[0]++.'';
if($ank['side'] == 1){$side = 'federation';}else{$side = 'empire';}
if($ank['viz'] > time()-$sql['online']){$viz = '';}else{$viz = '_off';}
if($reyt % 2){
if($ank['id'] == $user['id']){$test = 'odd my';}else{$test = 'even';}
}else{
if($ank['id'] == $user['id']){$test = 'odd my';}else{$test = 'odd';}
}
echo '<table class="tlist white sh_b bold small mb0"><tbody><tr w:id="users" class="'.$test.'">
<td class="num">'.$reyt.'</td>
<td class="va_m usr w100"><a class="white" w:id="profileLink" href="/profile/'.$ank['id'].'/"><img class="vb" height="14" width="14" src="/images/side/'.$side.'/'.$traning['rang'].''.$viz.'.png?1"> <span class="green2" w:id="login">'.$ank['login'].'</span> <br></td>
<td class="va_m nwr p5 ta_r"><img class="vb" height="14" width="14" src="/images/upgrades/starFull.png"> '.$params.'</td>
</tr></tbody></table>';
}
}



require_once ('../system/footer.php');
?>