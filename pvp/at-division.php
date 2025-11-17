<?php
$title = 'Лучшие танкисты дивизии';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}
echo '<table><tbody><tr>
<td style="width:33%;padding:0 3px;"><a class="simple-but blue" href="/pvp/divisions/"><span><span>Все дивизии</span></span></a></td>
<td style="width:33%;padding:0 3px;"><a class="simple-but blue" href="/pvp/top/"><span><span>Танкисты</span></span></a></td>
<td style="width:33%;padding:0 3px;"><a class="simple-but gray" href="/pvp/at-division/"><span><span>В дивизии</span></span></a></td>
</tr></tbody></table>';

echo '<div class="medium bold mb0 cntr green1"><img src="/images/icons/victory.png"> Лучшие танкисты дивизии <img src="/images/icons/victory.png"></div>';



echo '<div class="trnt-block mt1 mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini"><div class="mt5 mb5 white small bold cntr">';
$max = 100;
$res = $mysqli->query("SELECT COUNT(*) FROM `users` WHERE `company` = '".$user['company']."' and `id` in (select user from users_tanks) ");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$res = $mysqli->query('SELECT * FROM `users` WHERE `company` = '.$user['company'].' and `id` in (select user from users_tanks) ORDER BY `pvp_rate` desc LIMIT '.$start.','.$max.' ');
while ($company_1 = $res->fetch_array()){
$reyt = ''.$k_post[0]++.'';
if($user['id'] == $company_1['id']){
echo 'Ваше место в рейтинге: <span class="green1 bold" w:id="place">'.$reyt.'</span>';
}
}
echo '</div></div></div></div></div></div></div></div></div></div></div>';










$max = 10;
$res = $mysqli->query("SELECT COUNT(*) FROM `users` WHERE `company` = '".$user['company']."' and `id` in (select user from users_tanks) ");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$res_company_2 = $mysqli->query('SELECT * FROM `users` WHERE `company` = '.$user['company'].' and `id` in (select user from users_tanks) ORDER BY `pvp_rate` desc LIMIT '.$start.','.$max.' ');
while ($us = $res_company_2->fetch_array()){
if($us['pvp_rate']<1749){$p_r = 0;$p_r_ = 1749;$img = 1;$pvp_name = 'кадетов';}
if($us['pvp_rate']>=1749 && $us['pvp_rate']<=1999){$p_r = 1750;$p_r_ = 1999;$img = 2;$pvp_name = 'рядовых';}
if($us['pvp_rate']>=1999 && $us['pvp_rate']<=2249){$p_r = 2000;$p_r_ = 2249;$img = 3;$pvp_name = 'сержантов';}
if($us['pvp_rate']>=2249 && $us['pvp_rate']<=2499){$p_r = 2250;$p_r_ = 2499;$img = 4;$pvp_name = 'лейтенантов';}
if($us['pvp_rate']>=2499 && $us['pvp_rate']<=2749){$p_r = 2500;$p_r_ = 2749;$img = 5;$pvp_name = 'старших лейтенантов';}
if($us['pvp_rate']>=2749 && $us['pvp_rate']<=2999){$p_r = 2750;$p_r_ = 2999;$img = 6;$pvp_name = 'капитанов';}
if($us['pvp_rate']>=2999 && $us['pvp_rate']<=3249){$p_r = 3000;$p_r_ = 3249;$img = 7;$pvp_name = 'майоров';}
if($us['pvp_rate']>=3249 && $us['pvp_rate']<=3499){$p_r = 3250;$p_r_ = 3499;$img = 8;$pvp_name = 'подполковников';}
if($us['pvp_rate']>=3499){$p_r = 3500;$p_r_ = 3749;$img = 9;$pvp_name = 'полковников';}
$reyt = ''.$k_post[0]++.'';
if($reyt % 2){
if($user['id'] == $us['id']){$test = 'odd my';}else{$test = 'even';}
}else{
if($user['id'] == $us['id']){$test = 'odd my';}else{$test = 'odd';}
}
echo '<table class="tlist white sh_b bold small mb0"><tbody><tr w:id="users" class="'.$test.'">
<td class="num">'.$reyt.'</td>
<td class="va_m usr w100"><a class="white" w:id="profileLink" href="/profile/'.$us['id'].'/"><img class="vb" height="14" width="14" src="/images/pvp/'.$img.'.png"> <span class="green2" w:id="login">'.$us['login'].'</span> - '.$us['pvp_rate'].'<br></td>
</tr></tbody></table>';
}
if ($k_page > 1) {
echo str('/pvp/at-division/?',$k_page,$page); // Вывод страниц
}






require_once ('../system/footer.php');
?>