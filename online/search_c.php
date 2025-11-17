<?php
$title = 'Поиск дивизий';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}

echo '<form w:id="searchForm" id="id3" method="post" action="?okey"><div style="width:0px;height:0px;position:absolute;left:-100px;top:-100px;overflow:hidden"><input type="hidden" name="id3_hf_0" id="id3_hf_0"></div>
<div class="trnt-block">
<div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content">
<div class="small bold cntr white sh_b mb5">
Название дивизии:<br>
<input w:id="name" type="text" name="name" value="" class="fld-chng" size="15" maxlength="20"><br>
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
$name = strong($_POST['name']);
if(empty($name) or mb_strlen($name) > 30) {
$_SESSION['err'] = '<font color=red>Ошибка ввода, макс. 30 симв.</font>';
header('Location: ?');
exit();
}

$res = $mysqli->query("SELECT COUNT(*) FROM `company` WHERE `name` like '%".$name."%' ");
$k_post1 = $res->fetch_array(MYSQLI_NUM);
if ($k_post1[0]==0){
$_SESSION['err'] = '<font color="red">По вашему запросу ничего не найдено</font>';
header('Location: ?');
exit();
}




$q = $mysqli->query('SELECT * FROM `company` WHERE `name` like "%'.$name.'%" ORDER BY level desc LIMIT 100');
while ($company = $q->fetch_array()){
if($company['side'] == 1){$side = 'federation';}else{$side = 'empire';}
$reyt = ''.++$k_post[0].'';

if($reyt % 2){
if($user['company'] == $company['id']){$test = 'odd my';}else{$test = 'odd';}
}else{
if($user['company'] == $company['id']){$test = 'odd my';}else{$test = 'even';}
}
echo '<table class="tlist white sh_b bold small mb0"><tbody><tr w:id="users" class="'.$test.'">
<td class="num">'.$reyt.'</td>
<td class="va_m usr w100"><a class="white" w:id="link" href="/company/'.$company['id'].'/"><img class="vb" src="/images/side/'.$side.'.png?1"> <span class="green2">'.$company['name'].'</span><br></a></td>
<td class="va_m nwr p5 ta_r"><img class="vb" height="14" width="14" src="/images/icons/exp.png"> '.$company['level'].'</td>
</tr></tbody></table>';
}
echo '<div class="mb10"></div>';
}



require_once ('../system/footer.php');
?>