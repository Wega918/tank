<?php
$title = 'База';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}
$id = abs(intval($_GET['id']));
$res = $mysqli->query('SELECT * FROM `buildings_user` WHERE `id` = '.$id.' and `user` = '.$user['id'].' LIMIT 1');
$buildings_user = $res->fetch_assoc();
if($buildings_user == 0){header('Location: /buildings/');exit();}
if($buildings_user['tip'] != 2 and $buildings_user['tip'] != 6){
if($buildings_user['time_production']>time()){header('Location: /buildings/');exit();}
}
if($buildings_user['build_time']>time()){header('Location: /buildings/');exit();}
if($buildings_user['level']==0){header('Location: /buildings/');exit();}
##############################################################################################################
##############################################################################################################
##############################################################################################################









########################################################################################################################################################
if($buildings_user['tip']==1){
if($buildings_user['level']>=1){
if($buildings_user['level']==1){$col1 = 1;$time1 = 20;}if($buildings_user['level']==2){$col1 = 1;$time1 = 20;}if($buildings_user['level']==3){$col1 = 2;$time1 = 30;}if($buildings_user['level']==4){$col1 = 2;$time1 = 30;}if($buildings_user['level']==5){$col1 = 2;$time1 = 30;}if($buildings_user['level']==6){$col1 = 2;$time1 = 30;}if($buildings_user['level']==7){$col1 = 3;$time1 = 30;}if($buildings_user['level']==8){$col1 = 3;$time1 = 30;}if($buildings_user['level']==9){$col1 = 3;$time1 = 30;}if($buildings_user['level']==10){$col1 = 3;$time1 = 30;}if($buildings_user['level']==11){$col1 = 3;$time1 = 30;}if($buildings_user['level']==12){$col1 = 3;$time1 = 30;}if($buildings_user['level']==13){$col1 = 3;$time1 = 30;}if($buildings_user['level']==14){$col1 = 6;$time1 = 60;}if($buildings_user['level']==15){$col1 = 6;$time1 = 60;}if($buildings_user['level']==16){$col1 = 6;$time1 = 60;}if($buildings_user['level']==17){$col1 = 6;$time1 = 60;}if($buildings_user['level']==18){$col1 = 6;$time1 = 60;}if($buildings_user['level']==19){$col1 = 6;$time1 = 60;}if($buildings_user['level']==20){$col1 = 6;$time1 = 54;}
echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/ore.jpg" alt="Руда" title="Руда" style="width:100%; border-radius: 10px;"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Руда</span><br>Кол-во: <span class="green2">'.$col1.'</span><br>Время <span class="green2">'.tl($time1*60).'</span></div>
<div class="clrb"></div></div><div class="bot"><a class="simple-but border" href="?go_production1'.$buildings_user['tip'].'_'.$buildings_user['level'].'"><span><span>Начать производство</span></span></a></div>
</div></div></div></div></div></div></div></div></div></div>';
}

if($buildings_user['level']>=5){
if($buildings_user['level']==5){$col2 = 1;$time2 = 60;}if($buildings_user['level']==6){$col2 = 1;$time2 = 60;}if($buildings_user['level']==7){$col2 = 1;$time2 = 60;}if($buildings_user['level']==8){$col2 = 1;$time2 = 60;}if($buildings_user['level']==9){$col2 = 1;$time2 = 60;}if($buildings_user['level']==10){$col2 = 1;$time2 = 60;}if($buildings_user['level']==11){$col2 = 1;$time2 = 60;}if($buildings_user['level']==12){$col2 = 2;$time2 = 60;}if($buildings_user['level']==13){$col2 = 2;$time2 = 60;}if($buildings_user['level']==14){$col2 = 2;$time2 = 60;}if($buildings_user['level']==15){$col2 = 2;$time2 = 60;}if($buildings_user['level']==16){$col2 = 2;$time2 = 60;}if($buildings_user['level']==17){$col2 = 2;$time2 = 60;}if($buildings_user['level']==18){$col2 = 2;$time2 = 60;}if($buildings_user['level']==19){$col2 = 5;$time2 = 120;}if($buildings_user['level']==20){$col2 = 5;$time2 = 108;}
echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/iron.jpg" alt="Железо" title="Железо" style="width:100%; border-radius: 10px;"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Железо</span><br>Кол-во: <span class="green2">'.$col2.'</span><br>Время <span class="green2">'.tl($time2*60).'</span></div>
<div class="clrb"></div></div><div class="bot"><a class="simple-but border" href="?go_production2'.$buildings_user['tip'].'_'.$buildings_user['level'].'"><span><span>Начать производство</span></span></a></div>
</div></div></div></div></div></div></div></div></div></div>';
}
if($buildings_user['level']>=10){
if($buildings_user['level']==10){$col3 = 1;$time3 = 240;}if($buildings_user['level']==11){$col3 = 1;$time3 = 240;}if($buildings_user['level']==12){$col3 = 1;$time3 = 240;}if($buildings_user['level']==13){$col3 = 1;$time3 = 240;}if($buildings_user['level']==14){$col3 = 1;$time3 = 240;}if($buildings_user['level']==15){$col3 = 1;$time3 = 240;}if($buildings_user['level']==16){$col3 = 1;$time3 = 240;}if($buildings_user['level']==17){$col3 = 2;$time3 = 120;}if($buildings_user['level']==18){$col3 = 2;$time3 = 120;}if($buildings_user['level']==19){$col3 = 2;$time3 = 120;}if($buildings_user['level']==20){$col3 = 2;$time3 = 108;}
echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/steel.jpg" alt="Сталь" title="Сталь" style="width:100%; border-radius: 10px;"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Сталь</span><br>Кол-во: <span class="green2">'.$col3.'</span><br>Время <span class="green2">'.tl($time3*60).'</span></div>
<div class="clrb"></div></div><div class="bot"><a class="simple-but border" href="?go_production3'.$buildings_user['tip'].'_'.$buildings_user['level'].'"><span><span>Начать производство</span></span></a></div>
</div></div></div></div></div></div></div></div></div></div>';
}
if($buildings_user['level']>=15 && $buildings_user['level']<=20){
if($buildings_user['level']==15){$col4 = 1;$time4 = 1200;}if($buildings_user['level']==16){$col4 = 1;$time4 = 1200;}if($buildings_user['level']==17){$col4 = 1;$time4 = 1200;}if($buildings_user['level']==18){$col4 = 1;$time4 = 1200;}if($buildings_user['level']==19){$col4 = 1;$time4 = 1200;}if($buildings_user['level']==20){$col4 = 1;$time4 = 1080;}
echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/plumbum.jpg" alt="Свинец" title="Свинец" style="width:100%; border-radius: 10px;"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Свинец</span><br>Кол-во: <span class="green2">'.$col4.'</span><br>Время <span class="green2">'.tl($time4*60).'</span></div>
<div class="clrb"></div></div><div class="bot"><a class="simple-but border" href="?go_production4'.$buildings_user['tip'].'_'.$buildings_user['level'].'"><span><span>Начать производство</span></span></a></div>
</div></div></div></div></div></div></div></div></div></div>';
}




if(isset($_GET['go_production1'.$buildings_user['tip'].'_'.$buildings_user['level'].''])){
if($buildings_user['build_time']>time()){header('Location: /buildings/');exit();}
if($buildings_user['time_production']>time()){header('Location: /buildings/');exit();}
if($buildings_user['level']==0){header('Location: /buildings/');exit();}
$mysqli->query('UPDATE `buildings_user` SET `time_production` = '.(time()+($time1*60)).', `tip_production` = "1" WHERE `id` = '.$buildings_user['id'].' LIMIT 1');
header('Location: /buildings/');
exit();
}
if(isset($_GET['go_production2'.$buildings_user['tip'].'_'.$buildings_user['level'].''])){
if($buildings_user['build_time']>time()){header('Location: /buildings/');exit();}
if($buildings_user['time_production']>time()){header('Location: /buildings/');exit();}
if($buildings_user['level']<5){header('Location: /buildings/');exit();}
$mysqli->query('UPDATE `buildings_user` SET `time_production` = '.(time()+($time2*60)).', `tip_production` = "2" WHERE `id` = '.$buildings_user['id'].' LIMIT 1');
header('Location: /buildings/');
exit();
}
if(isset($_GET['go_production3'.$buildings_user['tip'].'_'.$buildings_user['level'].''])){
if($buildings_user['build_time']>time()){header('Location: /buildings/');exit();}
if($buildings_user['time_production']>time()){header('Location: /buildings/');exit();}
if($buildings_user['level']<10){header('Location: /buildings/');exit();}
$mysqli->query('UPDATE `buildings_user` SET `time_production` = '.(time()+($time3*60)).', `tip_production` = "3" WHERE `id` = '.$buildings_user['id'].' LIMIT 1');
header('Location: /buildings/');
exit();
}
if(isset($_GET['go_production4'.$buildings_user['tip'].'_'.$buildings_user['level'].''])){
if($buildings_user['build_time']>time()){header('Location: /buildings/');exit();}
if($buildings_user['time_production']>time()){header('Location: /buildings/');exit();}
if($buildings_user['level']<15){header('Location: /buildings/');exit();}
$mysqli->query('UPDATE `buildings_user` SET `time_production` = '.(time()+($time4*60)).', `tip_production` = "4" WHERE `id` = '.$buildings_user['id'].' LIMIT 1');
header('Location: /buildings/');
exit();
}






}
########################################################################################################################################################


























########################################################################################################################################################
if($buildings_user['tip']==2){
$res = $mysqli->query('SELECT * FROM `buildings_polygon` WHERE `user` = '.$user['id'].' LIMIT 1');
$buildings_polygon = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user`  = "'.$user['id'].'" and `active`  = "1"');
$users_tanks = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `vip` WHERE `user` = "'.$user['id'].'" LIMIT 1');
$vip = $res->fetch_assoc();

if($buildings_user['level']>=1){
if($buildings_user['level']==1){$time_1 = 120;$p = 10;}if($buildings_user['level']==2){$time_1 = 120;$p = 10;}if($buildings_user['level']==3){$time_1 = 120;$p = 10;}if($buildings_user['level']==4){$time_1 = 120;$p = 10;}if($buildings_user['level']==5){$time_1 = 140;$p = 10;}if($buildings_user['level']==6){$time_1 = 140;$p = 20;}if($buildings_user['level']==7){$time_1 = 140;$p = 20;}if($buildings_user['level']==8){$time_1 = 140;$p = 20;}if($buildings_user['level']==9){$time_1 = 140;$p = 20;}if($buildings_user['level']==10){$time_1 = 160;$p = 20;}if($buildings_user['level']==11){$time_1 = 160;$p = 30;}if($buildings_user['level']==12){$time_1 = 160;$p = 30;}if($buildings_user['level']==13){$time_1 = 160;$p = 30;}if($buildings_user['level']==14){$time_1 = 160;$p = 30;}if($buildings_user['level']==15){$time_1 = 180;$p = 30;}if($buildings_user['level']==16){$time_1 = 180;$p = 50;}if($buildings_user['level']==17){$time_1 = 180;$p = 50;}if($buildings_user['level']==18){$time_1 = 180;$p = 50;}if($buildings_user['level']==19){$time_1 = 180;$p = 50;}if($buildings_user['level']==20){$time_1 = 240;$p = 50;}
if($vip['time4']>time()){if($p!=50){$p = ($p+10);}else{$p = ($p+20);}}else{$p = $p;}
echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/durability.png?1" style="width:100%; border-radius: 10px;" alt="Прочность" title="Прочность"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">увеличение прочности</span><br><span class="green2">+'.$p.' на '.$time_1.' мин.</span>';
if($buildings_polygon['p_time']>time()){echo '<br><span class="green2">Осталось: '._time($buildings_polygon['p_time']-time()).'</span>';}
echo '</div><div class="clrb"></div></div><div class="bot">';
if($buildings_polygon['p_time']==0){
if(($buildings_polygon['a_time']==0 and $buildings_polygon['b_time']==0 and $buildings_polygon['t_time']==0 and $buildings_polygon['p_time']==0) or $buildings_user['time_production']<time()){
echo '<a class="simple-but border" href="?go_production1'.$buildings_user['tip'].'_'.$buildings_user['level'].'"><span><span>Получить бесплатно</span></span></a><div style="position:relative;"><span class="digit2 esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span></div>';
}else{
echo '<a class="simple-but border" href="?go_production1'.$buildings_user['tip'].'_'.$buildings_user['level'].'"><span><span>Активировать за <img title="Золото" alt="Золото" src="/images/icons/gold.png?1"> 10</span></span></a>';
}
}else{
echo '<span class="simple-but gray border"><span><span>Активно</span></span></span>';
}
echo '</div></div></div></div></div></div></div></div></div></div></div>';
}

if($buildings_user['level']>=2){
if($buildings_user['level']==2){$time_2 = 120;$b = 10;}if($buildings_user['level']==3){$time_2 = 120;$b = 10;}if($buildings_user['level']==4){$time_2 = 120;$b = 10;}if($buildings_user['level']==5){$time_2 = 140;$b = 10;}if($buildings_user['level']==6){$time_2 = 140;$b = 10;}if($buildings_user['level']==7){$time_2 = 140;$b = 20;}if($buildings_user['level']==8){$time_2 = 140;$b = 20;}if($buildings_user['level']==9){$time_2 = 140;$b = 20;}if($buildings_user['level']==10){$time_2 = 160;$b = 20;}if($buildings_user['level']==11){$time_2 = 160;$b = 20;}if($buildings_user['level']==12){$time_2 = 160;$b = 30;}if($buildings_user['level']==13){$time_2 = 160;$b = 30;}if($buildings_user['level']==14){$time_2 = 160;$b = 30;}if($buildings_user['level']==15){$time_2 = 180;$b = 30;}if($buildings_user['level']==16){$time_2 = 180;$b = 30;}if($buildings_user['level']==17){$time_2 = 180;$b = 50;}if($buildings_user['level']==18){$time_2 = 180;$b = 50;}if($buildings_user['level']==19){$time_2 = 180;$b = 50;}if($buildings_user['level']==20){$time_2 = 240;$b = 50;}
if($vip['time4']>time()){if($b!=50){$b = ($b+10);}else{$b = ($b+20);}}else{$b = $b;}
echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/armor.png?1" style="width:100%; border-radius: 10px;" alt="Броня" title="Броня"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">увеличение брони </span><br><span class="green2">+'.$b.' на '.$time_2.' мин.</span>';
if($buildings_polygon['b_time']>time()){echo '<br><span class="green2">Осталось: '._time($buildings_polygon['b_time']-time()).'</span>';}
echo '</div><div class="clrb"></div></div><div class="bot">';
if($buildings_polygon['b_time']==0){
if(($buildings_polygon['a_time']==0 and $buildings_polygon['b_time']==0 and $buildings_polygon['t_time']==0 and $buildings_polygon['p_time']==0) or $buildings_user['time_production']<time()){
echo '<a class="simple-but border" href="?go_production2'.$buildings_user['tip'].'_'.$buildings_user['level'].'"><span><span>Получить бесплатно</span></span></a><div style="position:relative;"><span class="digit2 esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span></div>';
}else{
echo '<a class="simple-but border" href="?go_production2'.$buildings_user['tip'].'_'.$buildings_user['level'].'"><span><span>Активировать за <img title="Золото" alt="Золото" src="/images/icons/gold.png?1"> 10</span></span></a>';
}
}else{
echo '<span class="simple-but gray border"><span><span>Активно</span></span></span>';
}
echo '</div></div></div></div></div></div></div></div></div></div></div>';
}

if($buildings_user['level']>=3){
if($buildings_user['level']==3){$time_3 = 120;$t = 10;}if($buildings_user['level']==4){$time_3 = 120;$t = 10;}if($buildings_user['level']==5){$time_3 = 140;$t = 10;}if($buildings_user['level']==6){$time_3 = 140;$t = 10;}if($buildings_user['level']==7){$time_3 = 140;$t = 10;}if($buildings_user['level']==8){$time_3 = 140;$t = 20;}if($buildings_user['level']==9){$time_3 = 140;$t = 20;}if($buildings_user['level']==10){$time_3 = 160;$t = 20;}if($buildings_user['level']==11){$time_3 = 160;$t = 20;}if($buildings_user['level']==12){$time_3 = 160;$t = 20;}if($buildings_user['level']==13){$time_3 = 160;$t = 30;}if($buildings_user['level']==14){$time_3 = 160;$t = 30;}if($buildings_user['level']==15){$time_3 = 180;$t = 30;}if($buildings_user['level']==16){$time_3 = 180;$t = 30;}if($buildings_user['level']==17){$time_3 = 180;$t = 30;}if($buildings_user['level']==18){$time_3 = 180;$t = 50;}if($buildings_user['level']==19){$time_3 = 180;$t = 50;}if($buildings_user['level']==20){$time_3 = 240;$t = 50;}
if($vip['time4']>time()){if($t!=50){$t = ($t+10);}else{$t = ($t+20);}}else{$t = $t;}
echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/accuracy.png?1" style="width:100%; border-radius: 10px;" alt="Точность" title="Точность"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">увеличение точности   '._time($buildings_user['build_time']-time()).' </span><br><span class="green2">+'.$t.' на '.$time_3.' мин.</span>';
if($buildings_polygon['t_time']>time()){echo '<br><span class="green2">Осталось: '._time($buildings_polygon['t_time']-time()).'</span>';}
echo '</div><div class="clrb"></div></div><div class="bot">';
if($buildings_polygon['t_time']==0){
if(($buildings_polygon['a_time']==0 and $buildings_polygon['b_time']==0 and $buildings_polygon['t_time']==0 and $buildings_polygon['p_time']==0) or $buildings_user['time_production']<time()){
echo '<a class="simple-but border" href="?go_production3'.$buildings_user['tip'].'_'.$buildings_user['level'].'"><span><span>Получить бесплатно</span></span></a><div style="position:relative;"><span class="digit2 esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span></div>';
}else{
echo '<a class="simple-but border" href="?go_production3'.$buildings_user['tip'].'_'.$buildings_user['level'].'"><span><span>Активировать за <img title="Золото" alt="Золото" src="/images/icons/gold.png?1"> 10</span></span></a>';
}
}else{
echo '<span class="simple-but gray border"><span><span>Активно</span></span></span>';
}
echo '</div></div></div></div></div></div></div></div></div></div></div>';
}

if($buildings_user['level']>=4){
if($buildings_user['level']==4){$time_4 = 120;$a = 10;}if($buildings_user['level']==5){$time_4 = 140;$a = 10;}if($buildings_user['level']==6){$time_4 = 140;$a = 10;}if($buildings_user['level']==7){$time_4 = 140;$a = 10;}if($buildings_user['level']==8){$time_4 = 140;$a = 10;}if($buildings_user['level']==9){$time_4 = 140;$a = 20;}if($buildings_user['level']==10){$time_4 = 160;$a = 20;}if($buildings_user['level']==11){$time_4 = 160;$a = 20;}if($buildings_user['level']==12){$time_4 = 160;$a = 20;}if($buildings_user['level']==13){$time_4 = 160;$a = 20;}if($buildings_user['level']==14){$time_4 = 160;$a = 30;}if($buildings_user['level']==15){$time_4 = 180;$a = 30;}if($buildings_user['level']==16){$time_4 = 180;$a = 30;}if($buildings_user['level']==17){$time_4 = 180;$a = 30;}if($buildings_user['level']==18){$time_4 = 180;$a = 30;}if($buildings_user['level']==19){$time_4 = 180;$a = 50;}if($buildings_user['level']==20){$time_4 = 240;$a = 50;}
if($vip['time4']>time()){if($a!=50){$a = ($a+10);}else{$a = ($a+20);}}else{$a = $a;}
echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/attack.png?1" style="width:100%; border-radius: 10px;" alt="Атака" title="Атака"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">увеличение атаки  </span><br><span class="green2">+'.$a.' на '.$time_4.' мин.</span>';
if($buildings_polygon['a_time']>time()){echo '<br><span class="green2">Осталось: '._time($buildings_polygon['a_time']-time()).'</span>';}
echo '</div><div class="clrb"></div></div><div class="bot">';
if($buildings_polygon['a_time']==0){
if(($buildings_polygon['a_time']==0 and $buildings_polygon['b_time']==0 and $buildings_polygon['t_time']==0 and $buildings_polygon['p_time']==0) or $buildings_user['time_production']<time()){
echo '<a class="simple-but border" href="?go_production4'.$buildings_user['tip'].'_'.$buildings_user['level'].'"><span><span>Получить бесплатно</span></span></a><div style="position:relative;"><span class="digit2 esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span></div>';
}else{
echo '<a class="simple-but border" href="?go_production4'.$buildings_user['tip'].'_'.$buildings_user['level'].'"><span><span>Активировать за <img title="Золото" alt="Золото" src="/images/icons/gold.png?1"> 10</span></span></a>';
}
}else{
echo '<span class="simple-but gray border"><span><span>Активно</span></span></span>';
}
echo '</div></div></div></div></div></div></div></div></div></div></div>';
}


##############################


if(isset($_GET['go_production1'.$buildings_user['tip'].'_'.$buildings_user['level'].''])){
if($buildings_user['build_time']>time()){$_SESSION['err'] = "1";header('Location: /buildings/');exit();}
if($buildings_user['level']==0){$_SESSION['err'] = "2";header('Location: /buildings/');exit();}
if($buildings_polygon['p']>0){$_SESSION['err'] = "3";header('Location: /buildings/');exit();}
if(($buildings_polygon['a_time']==0 and $buildings_polygon['b_time']==0 and $buildings_polygon['t_time']==0 and $buildings_polygon['p_time']==0) or $buildings_user['time_production']<time()){
if($buildings_polygon){
$mysqli->query('UPDATE `buildings_polygon` SET `p` = '.$p.', `p_time` = '.(time()+($time_1*60)).' WHERE `id` = '.$buildings_polygon['id'].' LIMIT 1');
}else{
$mysqli->query('INSERT INTO `buildings_polygon` SET `user` = '.$user['id'].', `p` = "'.$p.'", `p_time` = '.(time()+($time_1*60)).' ');
}
}else{
if($user['gold']<10){$_SESSION['err'] = '<div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.(10-$user['gold']).' золота</div>';header('Location: ?');exit();}
$mysqli->query('UPDATE `buildings_polygon` SET `p` = '.$p.', `p_time` = '.(time()+($time_1*60)).' WHERE `id` = '.$buildings_polygon['id'].' LIMIT 1');
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-10).' WHERE `id` = '.$user['id'].' LIMIT 1');
}
if($buildings_user['time_production']<time()){
$mysqli->query('UPDATE `buildings_user` SET `time_production` = '.(time()+($time_1*60)).' WHERE `id` = '.$buildings_user['id'].' LIMIT 1');
}
$mysqli->query('UPDATE `users_tanks` SET `p` = '.($users_tanks['p']+$p).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
header('Location: ?');
exit();
}

if(isset($_GET['go_production2'.$buildings_user['tip'].'_'.$buildings_user['level'].''])){
if($buildings_user['build_time']>time()){$_SESSION['err'] = "1";header('Location: /buildings/');exit();}
if($buildings_user['level']==0){$_SESSION['err'] = "2";header('Location: /buildings/');exit();}
if($buildings_polygon['b']>0){$_SESSION['err'] = "3";header('Location: /buildings/');exit();}
if(($buildings_polygon['a_time']==0 and $buildings_polygon['b_time']==0 and $buildings_polygon['t_time']==0 and $buildings_polygon['p_time']==0) or $buildings_user['time_production']<time()){
if($buildings_polygon){
$mysqli->query('UPDATE `buildings_polygon` SET `b` = '.$b.', `b_time` = '.(time()+($time_2*60)).' WHERE `id` = '.$buildings_polygon['id'].' LIMIT 1');
}else{
$mysqli->query('INSERT INTO `buildings_polygon` SET `user` = '.$user['id'].', `b` = "'.$b.'", `b_time` = '.(time()+($time_2*60)).' ');
}
}else{
if($user['gold']<10){$_SESSION['err'] = '<div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.(10-$user['gold']).' золота</div>';header('Location: ?');exit();}
$mysqli->query('UPDATE `buildings_polygon` SET `b` = '.$b.', `b_time` = '.(time()+($time_2*60)).' WHERE `id` = '.$buildings_polygon['id'].' LIMIT 1');
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-10).' WHERE `id` = '.$user['id'].' LIMIT 1');
}
if($buildings_user['time_production']<time()){
$mysqli->query('UPDATE `buildings_user` SET `time_production` = '.(time()+($time_2*60)).' WHERE `id` = '.$buildings_user['id'].' LIMIT 1');
}
$mysqli->query('UPDATE `users_tanks` SET `b` = '.($users_tanks['b']+$b).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
header('Location: ?');
exit();
}

if(isset($_GET['go_production3'.$buildings_user['tip'].'_'.$buildings_user['level'].''])){
if($buildings_user['build_time']>time()){$_SESSION['err'] = "1";header('Location: /buildings/');exit();}
if($buildings_user['level']==0){$_SESSION['err'] = "2";header('Location: /buildings/');exit();}
if($buildings_polygon['t']>0){$_SESSION['err'] = "3";header('Location: /buildings/');exit();}
if(($buildings_polygon['a_time']==0 and $buildings_polygon['b_time']==0 and $buildings_polygon['t_time']==0 and $buildings_polygon['p_time']==0) or $buildings_user['time_production']<time()){
if($buildings_polygon){
$mysqli->query('UPDATE `buildings_polygon` SET `t` = '.$t.', `t_time` = '.(time()+($time_3*60)).' WHERE `id` = '.$buildings_polygon['id'].' LIMIT 1');
}else{
$mysqli->query('INSERT INTO `buildings_polygon` SET `user` = '.$user['id'].', `t` = "'.$t.'", `t_time` = '.(time()+($time_3*60)).' ');
}
}else{
if($user['gold']<10){$_SESSION['err'] = '<div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.(10-$user['gold']).' золота</div>';header('Location: ?');exit();}
$mysqli->query('UPDATE `buildings_polygon` SET `t` = '.$t.', `t_time` = '.(time()+($time_3*60)).' WHERE `id` = '.$buildings_polygon['id'].' LIMIT 1');
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-10).' WHERE `id` = '.$user['id'].' LIMIT 1');
}
if($buildings_user['time_production']<time()){
$mysqli->query('UPDATE `buildings_user` SET `time_production` = '.(time()+($time_3*60)).' WHERE `id` = '.$buildings_user['id'].' LIMIT 1');
}
$mysqli->query('UPDATE `users_tanks` SET `t` = '.($users_tanks['t']+$t).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
header('Location: ?');
exit();
}

if(isset($_GET['go_production4'.$buildings_user['tip'].'_'.$buildings_user['level'].''])){
if($buildings_user['build_time']>time()){$_SESSION['err'] = "1";header('Location: /buildings/');exit();}
if($buildings_user['level']==0){$_SESSION['err'] = "2";header('Location: /buildings/');exit();}
if($buildings_polygon['a']>0){$_SESSION['err'] = "3";header('Location: /buildings/');exit();}
if(($buildings_polygon['a_time']==0 and $buildings_polygon['b_time']==0 and $buildings_polygon['t_time']==0 and $buildings_polygon['p_time']==0) or $buildings_user['time_production']<time()){
if($buildings_polygon){
$mysqli->query('UPDATE `buildings_polygon` SET `a` = '.$a.', `a_time` = '.(time()+($time_4*60)).' WHERE `id` = '.$buildings_polygon['id'].' LIMIT 1');
}else{
$mysqli->query('INSERT INTO `buildings_polygon` SET `user` = '.$user['id'].', `a` = "'.$a.'", `a_time` = '.(time()+($time_4*60)).' ');
}
}else{
if($user['gold']<10){$_SESSION['err'] = '<div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.(10-$user['gold']).' золота</div>';header('Location: ?');exit();}
$mysqli->query('UPDATE `buildings_polygon` SET `a` = '.$a.', `a_time` = '.(time()+($time_4*60)).' WHERE `id` = '.$buildings_polygon['id'].' LIMIT 1');
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-10).' WHERE `id` = '.$user['id'].' LIMIT 1');
}
if($buildings_user['time_production']<time()){
$mysqli->query('UPDATE `buildings_user` SET `time_production` = '.(time()+($time_4*60)).' WHERE `id` = '.$buildings_user['id'].' LIMIT 1');
}
$mysqli->query('UPDATE `users_tanks` SET `a` = '.($users_tanks['a']+$a).' WHERE `id` = '.$users_tanks['id'].' LIMIT 1');
header('Location: ?');
exit();
}
}
########################################################################################################################################################















########################################################################################################################################################
if($buildings_user['tip']==3){
$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user` = '.$user['id'].' LIMIT 1');
$ammunition_users = $res->fetch_assoc();
echo'<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content"><div class="white small bold sh_b mb5 cntr">Моя амуниция<span class="gray1 cntr blck pt5">
<span class="nwr"><img class="rico vm" src="/images/shells/ArmorPiercing.png" alt="Бронебойный снаряд" title="Бронебойный снаряд"> '.$ammunition_users['b'].' &nbsp;&nbsp;</span>
<span class="nwr"><img class="rico vm" src="/images/shells/HighExplosive.png" alt="Фугасный снаряд" title="Фугасный снаряд"> '.$ammunition_users['f'].' &nbsp;&nbsp;</span>
<span class="nwr"><img class="rico vm" src="/images/shells/HollowCharge.png" alt="Кумулятивный снаряд" title="Кумулятивный снаряд"> '.$ammunition_users['k'].' &nbsp;&nbsp;</span>
<span class="nwr"><img class="rico vm" src="/images/shells/repairkit.png" alt="Ремкомплект" title="Ремкомплект"> '.$ammunition_users['rem'].' &nbsp;&nbsp;</span>
</span>
</div></div></div></div></div></div></div></div></div></div></div>';

if($buildings_user['level']>=1){
if($buildings_user['level']==1){$time_1 = 60;$col1 = 1;}if($buildings_user['level']==2){$time_1 = 60;$col1 = 1;}if($buildings_user['level']==3){$time_1 = 60;$col1 = 1;}if($buildings_user['level']==4){$time_1 = 60;$col1 = 1;}if($buildings_user['level']==5){$time_1 = 55;$col1 = 1;}if($buildings_user['level']==6){$time_1 = 55;$col1 = 2;}if($buildings_user['level']==7){$time_1 = 55;$col1 = 2;}if($buildings_user['level']==8){$time_1 = 55;$col1 = 2;}if($buildings_user['level']==9){$time_1 = 55;$col1 = 2;}if($buildings_user['level']==10){$time_1 = 55;$col1 = 2;}if($buildings_user['level']==11){$time_1 = 50;$col1 = 3;}if($buildings_user['level']==12){$time_1 = 50;$col1 = 3;}if($buildings_user['level']==13){$time_1 = 50;$col1 = 3;}if($buildings_user['level']==14){$time_1 = 50;$col1 = 3;}if($buildings_user['level']==15){$time_1 = 45;$col1 = 3;}if($buildings_user['level']==16){$time_1 = 45;$col1 = 4;}if($buildings_user['level']==17){$time_1 = 45;$col1 = 4;}if($buildings_user['level']==18){$time_1 = 45;$col1 = 4;}if($buildings_user['level']==19){$time_1 = 45;$col1 = 4;}if($buildings_user['level']==20){$time_1 = 40;$col1 = 4;}
echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/shells/repairKit.jpg" style="width:100%; border-radius: 10px;"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Ремкомплект</span><br>Кол-во: <span class="green2">'.$col1.'</span><br>Время <span class="green2">'.tl($time_1*60).'</span></div>
<div class="clrb"></div></div><div class="bot"><a class="simple-but border" href="?go_production1'.$buildings_user['tip'].'_'.$buildings_user['level'].'"><span><span>Начать производство</span></span></a></div>
</div></div></div></div></div></div></div></div></div></div>';
}
if($buildings_user['level']>=2){
if($buildings_user['level']==2){$time_2 = 60;$col2 = 1;}if($buildings_user['level']==3){$time_2 = 60;$col2 = 1;}if($buildings_user['level']==4){$time_2 = 60;$col2 = 1;}if($buildings_user['level']==5){$time_2 = 55;$col2 = 1;}if($buildings_user['level']==6){$time_2 = 55;$col2 = 2;}if($buildings_user['level']==7){$time_2 = 55;$col2 = 2;}if($buildings_user['level']==8){$time_2 = 55;$col2 = 2;}if($buildings_user['level']==9){$time_2 = 55;$col2 = 2;}if($buildings_user['level']==10){$time_2 = 50;$col2 = 2;}if($buildings_user['level']==11){$time_2 = 50;$col2 = 2;}if($buildings_user['level']==12){$time_2 = 50;$col2 = 3;}if($buildings_user['level']==13){$time_2 = 50;$col2 = 3;}if($buildings_user['level']==14){$time_2 = 50;$col2 = 3;}if($buildings_user['level']==15){$time_2 = 45;$col2 = 3;}if($buildings_user['level']==16){$time_2 = 45;$col2 = 3;}if($buildings_user['level']==17){$time_2 = 45;$col2 = 4;}if($buildings_user['level']==18){$time_2 = 45;$col2 = 4;}if($buildings_user['level']==19){$time_2 = 45;$col2 = 4;}if($buildings_user['level']==20){$time_2 = 40;$col2 = 4;}
echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/shells/shellHollowCharge.jpg" style="width:100%; border-radius: 10px;"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Кумулятный снаряд</span><br>Кол-во: <span class="green2">'.$col2.'</span><br>Время <span class="green2">'.tl($time_2*60).'</span></div>
<div class="clrb"></div></div><div class="bot"><a class="simple-but border" href="?go_production2'.$buildings_user['tip'].'_'.$buildings_user['level'].'"><span><span>Начать производство</span></span></a></div>
</div></div></div></div></div></div></div></div></div></div>';
}
if($buildings_user['level']>=3){
if($buildings_user['level']==3){$time_3 = 60;$col3 = 1;}if($buildings_user['level']==4){$time_3 = 60;$col3 = 1;}if($buildings_user['level']==5){$time_3 = 55;$col3 = 1;}if($buildings_user['level']==6){$time_3 = 55;$col3 = 1;}if($buildings_user['level']==7){$time_3 = 55;$col3 = 1;}if($buildings_user['level']==8){$time_3 = 55;$col3 = 2;}if($buildings_user['level']==9){$time_3 = 55;$col3 = 2;}if($buildings_user['level']==10){$time_3 = 50;$col3 = 2;}if($buildings_user['level']==11){$time_3 = 50;$col3 = 2;}if($buildings_user['level']==12){$time_3 = 50;$col3 = 2;}if($buildings_user['level']==13){$time_3 = 50;$col3 = 3;}if($buildings_user['level']==14){$time_3 = 45;$col3 = 3;}if($buildings_user['level']==15){$time_3 = 45;$col3 = 3;}if($buildings_user['level']==16){$time_3 = 45;$col3 = 3;}if($buildings_user['level']==17){$time_3 = 45;$col3 = 3;}if($buildings_user['level']==18){$time_3 = 45;$col3 = 3;}if($buildings_user['level']==19){$time_3 = 45;$col3 = 4;}if($buildings_user['level']==20){$time_3 = 40;$col3 = 4;}
echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/shells/shellHighExplosive.jpg" style="width:100%; border-radius: 10px;"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Фугасный снаряд</span><br>Кол-во: <span class="green2">'.$col3.'</span><br>Время <span class="green2">'.tl($time_3*60).'</span></div>
<div class="clrb"></div></div><div class="bot"><a class="simple-but border" href="?go_production3'.$buildings_user['tip'].'_'.$buildings_user['level'].'"><span><span>Начать производство</span></span></a></div>
</div></div></div></div></div></div></div></div></div></div>';
}
if($buildings_user['level']>=4){
if($buildings_user['level']==4){$time_4 = 60;$col4 = 1;}if($buildings_user['level']==5){$time_4 = 55;$col4 = 1;}if($buildings_user['level']==6){$time_4 = 55;$col4 = 1;}if($buildings_user['level']==7){$time_4 = 55;$col4 = 1;}if($buildings_user['level']==8){$time_4 = 55;$col4 = 1;}if($buildings_user['level']==9){$time_4 = 55;$col4 = 2;}if($buildings_user['level']==10){$time_4 = 50;$col4 = 2;}if($buildings_user['level']==11){$time_4 = 50;$col4 = 2;}if($buildings_user['level']==12){$time_4 = 50;$col4 = 2;}if($buildings_user['level']==13){$time_4 = 50;$col4 = 2;}if($buildings_user['level']==14){$time_4 = 50;$col4 = 3;}if($buildings_user['level']==15){$time_4 = 45;$col4 = 3;}if($buildings_user['level']==16){$time_4 = 45;$col4 = 3;}if($buildings_user['level']==17){$time_4 = 45;$col4 = 3;}if($buildings_user['level']==18){$time_4 = 45;$col4 = 4;}if($buildings_user['level']==19){$time_4 = 45;$col4 = 4;}if($buildings_user['level']==20){$time_4 = 40;$col4 = 4;}
echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/shells/shellArmorPiercing.jpg" style="width:100%; border-radius: 10px;"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Бронебойный снаряд</span><br>Кол-во: <span class="green2">'.$col4.'</span><br>Время <span class="green2">'.tl($time_4*60).'</span></div>
<div class="clrb"></div></div><div class="bot"><a class="simple-but border" href="?go_production4'.$buildings_user['tip'].'_'.$buildings_user['level'].'"><span><span>Начать производство</span></span></a></div>
</div></div></div></div></div></div></div></div></div></div>';
}


if(isset($_GET['go_production1'.$buildings_user['tip'].'_'.$buildings_user['level'].''])){
if($buildings_user['build_time']>time()){header('Location: /buildings/');exit();}
if($buildings_user['time_production']>time()){header('Location: /buildings/');exit();}
if($buildings_user['level']==0){header('Location: /buildings/');exit();}
$mysqli->query('UPDATE `buildings_user` SET `time_production` = '.(time()+($time_1*60)).', `tip_production` = "1" WHERE `id` = '.$buildings_user['id'].' LIMIT 1');
header('Location: /buildings/');
exit();
}
if(isset($_GET['go_production2'.$buildings_user['tip'].'_'.$buildings_user['level'].''])){
if($buildings_user['build_time']>time()){header('Location: /buildings/');exit();}
if($buildings_user['time_production']>time()){header('Location: /buildings/');exit();}
if($buildings_user['level']==0){header('Location: /buildings/');exit();}
$mysqli->query('UPDATE `buildings_user` SET `time_production` = '.(time()+($time_2*60)).', `tip_production` = "2" WHERE `id` = '.$buildings_user['id'].' LIMIT 1');
header('Location: /buildings/');
exit();
}
if(isset($_GET['go_production3'.$buildings_user['tip'].'_'.$buildings_user['level'].''])){
if($buildings_user['build_time']>time()){header('Location: /buildings/');exit();}
if($buildings_user['time_production']>time()){header('Location: /buildings/');exit();}
if($buildings_user['level']==0){header('Location: /buildings/');exit();}
$mysqli->query('UPDATE `buildings_user` SET `time_production` = '.(time()+($time_3*60)).', `tip_production` = "3" WHERE `id` = '.$buildings_user['id'].' LIMIT 1');
header('Location: /buildings/');
exit();
}
if(isset($_GET['go_production4'.$buildings_user['tip'].'_'.$buildings_user['level'].''])){
if($buildings_user['build_time']>time()){header('Location: /buildings/');exit();}
if($buildings_user['time_production']>time()){header('Location: /buildings/');exit();}
if($buildings_user['level']==0){header('Location: /buildings/');exit();}
$mysqli->query('UPDATE `buildings_user` SET `time_production` = '.(time()+($time_4*60)).', `tip_production` = "4" WHERE `id` = '.$buildings_user['id'].' LIMIT 1');
header('Location: /buildings/');
exit();
}


}
########################################################################################################################################################


















########################################################################################################################################################
if($buildings_user['tip']==4){
if($buildings_user['level']>=1){
$time_1 = 20;if($buildings_user['level']==1){$col1 = 2;}if($buildings_user['level']==2){$col1 = 2;}if($buildings_user['level']==3){$col1 = 4;}if($buildings_user['level']==4){$col1 = 4;}if($buildings_user['level']==5){$col1 = 6;}if($buildings_user['level']==6){$col1 = 6;}if($buildings_user['level']==7){$col1 = 9;}if($buildings_user['level']==8){$col1 = 9;}if($buildings_user['level']==9){$col1 = 11;}if($buildings_user['level']==10){$col1 = 11;}if($buildings_user['level']==11){$col1 = 13;}if($buildings_user['level']==12){$col1 = 13;}if($buildings_user['level']==13){$col1 = 15;}if($buildings_user['level']==14){$col1 = 15;}if($buildings_user['level']==15){$col1 = 18;}if($buildings_user['level']==16){$col1 = 20;}if($buildings_user['level']==17){$col1 = 20;}if($buildings_user['level']==18){$col1 = 20;}if($buildings_user['level']==19){$col1 = 23;}if($buildings_user['level']==20){$col1 = 23;}
echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/silver.jpg" style="width:100%; border-radius: 10px;"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Серебро</span><br>Кол-во: <span class="green2">'.$col1.'</span><br>Время <span class="green2">'.tl($time_1*60).'</span></div>
<div class="clrb"></div></div><div class="bot"><a class="simple-but border" href="?go_production1'.$buildings_user['tip'].'_'.$buildings_user['level'].'"><span><span>Начать производство</span></span></a></div>
</div></div></div></div></div></div></div></div></div></div>';
}
if($buildings_user['level']>=2){
$time_2 = 60;if($buildings_user['level']==2){$col2 = 5;}if($buildings_user['level']==3){$col2 = 5;}if($buildings_user['level']==4){$col2 = 9;}if($buildings_user['level']==5){$col2 = 9;}if($buildings_user['level']==6){$col2 = 13;}if($buildings_user['level']==7){$col2 = 13;}if($buildings_user['level']==8){$col2 = 17;}if($buildings_user['level']==9){$col2 = 17;}if($buildings_user['level']==10){$col2 = 20;}if($buildings_user['level']==11){$col2 = 20;}if($buildings_user['level']==12){$col2 = 22;}if($buildings_user['level']==13){$col2 = 22;}if($buildings_user['level']==14){$col2 = 30;}if($buildings_user['level']==15){$col2 = 30;}if($buildings_user['level']==16){$col2 = 30;}if($buildings_user['level']==17){$col2 = 38;}if($buildings_user['level']==18){$col2 = 42;}if($buildings_user['level']==19){$col2 = 42;}if($buildings_user['level']==20){$col2 = 45;}
echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/silver.jpg" style="width:100%; border-radius: 10px;"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">Серебро</span><br>Кол-во: <span class="green2">'.$col2.'</span><br>Время <span class="green2">'.tl($time_2*60).'</span></div>
<div class="clrb"></div></div><div class="bot"><a class="simple-but border" href="?go_production2'.$buildings_user['tip'].'_'.$buildings_user['level'].'"><span><span>Начать производство</span></span></a></div>
</div></div></div></div></div></div></div></div></div></div>';
}


if(isset($_GET['go_production1'.$buildings_user['tip'].'_'.$buildings_user['level'].''])){
if($buildings_user['build_time']>time()){header('Location: /buildings/');exit();}
if($buildings_user['time_production']>time()){header('Location: /buildings/');exit();}
if($buildings_user['level']==0){header('Location: /buildings/');exit();}
$mysqli->query('UPDATE `buildings_user` SET `time_production` = '.(time()+($time_1*60)).', `tip_production` = "1" WHERE `id` = '.$buildings_user['id'].' LIMIT 1');
header('Location: /buildings/');
exit();
}
if(isset($_GET['go_production2'.$buildings_user['tip'].'_'.$buildings_user['level'].''])){
if($buildings_user['build_time']>time()){header('Location: /buildings/');exit();}
if($buildings_user['time_production']>time()){header('Location: /buildings/');exit();}
if($buildings_user['level']==0){header('Location: /buildings/');exit();}
$mysqli->query('UPDATE `buildings_user` SET `time_production` = '.(time()+($time_2*60)).', `tip_production` = "2" WHERE `id` = '.$buildings_user['id'].' LIMIT 1');
header('Location: /buildings/');
exit();
}


}
########################################################################################################################################################







########################################################################################################################################################
if($buildings_user['tip']==5){
if($buildings_user['level']==1){$nextfuel = 330;}if($buildings_user['level']==2){$nextfuel = 345;}if($buildings_user['level']==3){$nextfuel = 360;}if($buildings_user['level']==4){$nextfuel = 405;}if($buildings_user['level']==5){$nextfuel = 420;}if($buildings_user['level']==6){$nextfuel = 435;}if($buildings_user['level']==7){$nextfuel = 450;}if($buildings_user['level']==8){$nextfuel = 465;}if($buildings_user['level']==9){$nextfuel = 510;}if($buildings_user['level']==10){$nextfuel = 525;}if($buildings_user['level']==11){$nextfuel = 540;}if($buildings_user['level']==12){$nextfuel = 555;}if($buildings_user['level']==13){$nextfuel = 570;}if($buildings_user['level']==14){$nextfuel = 615;}if($buildings_user['level']==15){$nextfuel = 630;}if($buildings_user['level']==16){$nextfuel = 645;}if($buildings_user['level']==17){$nextfuel = 660;}if($buildings_user['level']==18){$nextfuel = 675;}if($buildings_user['level']==19){$nextfuel = 720;}
echo '<div class="trnt-block mb6"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content"><div class="small bold sh_b mb5 cntr white">
Объём топливного бака: <span class="green2"><span class="nwr"><img class="ico vm" src="/images/icons/fuel.png" alt="Топливо" title="Топливо"> '.$user['fuel_max'].' топлива</span></span>';
if($buildings_user['level']<=19){
echo '<br>Объём на следующем уровне здания: <span class="green2"><span class="nwr"><img class="ico vm" src="/images/icons/fuel.png" alt="Топливо" title="Топливо"> '.$nextfuel.' топлива</span></span><br>';
}
echo '</div></div></div></div></div></div></div></div></div></div></div>';
}
########################################################################################################################################################












########################################################################################################################################################
if($buildings_user['tip']==6){
$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user` = '.$user['id'].' LIMIT 1');
$ammunition_users = $res->fetch_assoc();

if($buildings_user['tip']==6 and $buildings_user['time_production']<time() and $buildings_user['tip_production']>0){
$mysqli->query('UPDATE `buildings_user` SET `tip_production` = "0" WHERE `id` = '.$buildings_user['id'].' LIMIT 1');
}

if($buildings_user['tip_production']==0){$cost_silver = 10;}
if($buildings_user['tip_production']==1){$cost_silver = 50;}
if($buildings_user['tip_production']==2){$cost_silver = 100;}
if($buildings_user['tip_production']==3){$cost_silver = 500;}
if($buildings_user['tip_production']==4){$cost_silver = 1000;}
if($buildings_user['tip_production']==5){$cost_silver = 5000;}
if($buildings_user['tip_production']==6){$cost_silver = 10000;}
if($buildings_user['tip_production']==7){$cost_silver = 50000;}
if($buildings_user['tip_production']==8){$cost_silver = 100000;}
if($buildings_user['tip_production']==9){$cost_silver = 500000;}
if($buildings_user['tip_production']==10){$cost_silver = 1000000;}

echo'<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content"><div class="white small bold sh_b mb5 cntr">Мои ресурсы<span class="gray1 cntr blck pt5">
<span class="nwr"><img class="rico vm" src="/images/icons/ore.png" alt="Руда" title="Руда"> '.$ammunition_users['ore'].' &nbsp;&nbsp;</span>
<span class="nwr"><img class="rico vm" src="/images/icons/iron.png" alt="Железо" title="Железо"> '.$ammunition_users['iron'].' &nbsp;&nbsp;</span>
<span class="nwr"><img class="rico vm" src="/images/icons/steel.png" alt="Сталь" title="Сталь"> '.$ammunition_users['steel'].' &nbsp;&nbsp;</span>
<span class="nwr"><img class="rico vm" src="/images/icons/plumbum.png" alt="Свинец" title="Свинец"> '.$ammunition_users['plumbum'].' &nbsp;&nbsp;</span>
</span>
</div></div></div></div></div></div></div></div></div></div></div>';


echo '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="medium bold pb2 cntr white">Обмен серебра</div><div style="position:relative;">';
if($buildings_user['tip_production']<11 or $buildings_user['time_production']<time()){
echo '<a class="simple-but border mb5" href="?go_production1'.$buildings_user['tip'].'_'.$buildings_user['level'].'"><span><span>Получить <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> 1 за <img class="ico vm" src="/images/icons/silver.png" alt="Серебро" title="Серебро"> '.$cost_silver.'</span></span></a>';
}
if($buildings_user['time_production']<time()){
echo '<span class="digit esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span>';
}
echo '</div>';
if($buildings_user['time_production']>time()){
echo '<div class="small white cntr sh_b bold mb2">Минимальная цена через <span id="time_'.($buildings_user['time_production']-time()).'000">'._time($buildings_user['time_production']-time()).'</span></div>';
}
echo '</div></div></div></div></div></div></div></div></div></div>';

if(isset($_GET['go_production1'.$buildings_user['tip'].'_'.$buildings_user['level'].''])){
if($buildings_user['tip_production']>10){header('Location: ?');exit();}
if($buildings_user['build_time']>time()){header('Location: /buildings/');exit();}
if($buildings_user['level']==0){header('Location: /buildings/');exit();}
if($user['silver'] < $cost_silver){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.($cost_silver-$user['silver']).' серебра</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
if($buildings_user['time_production']<time()){
$mysqli->query('UPDATE `buildings_user` SET `time_production` = '.(time()+(3600*20)).', `tip_production` = "'.($buildings_user['tip_production']+1).'" WHERE `id` = '.$buildings_user['id'].' LIMIT 1');
}else{
$mysqli->query('UPDATE `buildings_user` SET `tip_production` = "'.($buildings_user['tip_production']+1).'" WHERE `id` = '.$buildings_user['id'].' LIMIT 1');
}
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']-$cost_silver).', `gold` = '.($user['gold']+1).' WHERE `id` = '.$user['id'].' LIMIT 1');
header('Location: ?');
exit();
}






if($buildings_user['level']>=1){
if($buildings_user['level']==1){$silver1 = 5;}if($buildings_user['level']==2){$silver1 = 6;}if($buildings_user['level']==3){$silver1 = 7;}if($buildings_user['level']>=4){$silver1 = 10;}
echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/ore.jpg" alt="Руда" title="Руда" style="width:100%; border-radius: 10px;"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold">
<span class="green2">Обмен руды на серебро</span><br><img title="Руда" alt="Руда" src="/images/icons/ore.png"> 1 на <img title="Серебро" alt="Серебро" src="/images/icons/silver.png"> '.$silver1.'</div>
<div class="clrb"></div></div>
<table><tbody><tr>
<td style="width:50%;padding-right:1px;"><div class="bot"><a class="simple-but border" href="?go_obmen_1'.$buildings_user['tip'].'_'.$buildings_user['level'].'"><span><span>обменять <img class="ico vm" src="/images/icons/ore.png" alt="Руда" title="Руда"> 1</span></span></a></div></td>
<td style="width:50%;padding-left:1px;"><div class="bot gray1"><a class="simple-but border" href="?go_obmen_1'.$buildings_user['tip'].'_'.$buildings_user['level'].'_"><span><span>обменять <img class="ico vm" src="/images/icons/ore.png" alt="Руда" title="Руда"> 5</span></span></a></div></td>
</tr></tbody></table>
</div></div></div></div></div></div></div></div></div></div>';
}
if($buildings_user['level']>=5){
if($buildings_user['level']==5){$silver2 = 10;}if($buildings_user['level']==6){$silver2 = 12;}if($buildings_user['level']==7){$silver2 = 14;}if($buildings_user['level']==8){$silver2 = 16;}if($buildings_user['level']>=9){$silver2 = 20;}
echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/iron.jpg" alt="Железо" title="Железо" style="width:100%; border-radius: 10px;"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold">
<span class="green2">Обмен железа на серебро</span><br><img title="Железо" alt="Железо" src="/images/icons/iron.png"> 1 на <img title="Серебро" alt="Серебро" src="/images/icons/silver.png"> '.$silver2.'</div>
<div class="clrb"></div></div>
<table><tbody><tr>
<td style="width:50%;padding-right:1px;"><div class="bot"><a class="simple-but border" href="?go_obmen_2'.$buildings_user['tip'].'_'.$buildings_user['level'].'"><span><span>обменять <img class="ico vm" src="/images/icons/iron.png" alt="Железо" title="Железо"> 1</span></span></a></div></td>
<td style="width:50%;padding-left:1px;"><div class="bot gray1"><a class="simple-but border" href="?go_obmen_2'.$buildings_user['tip'].'_'.$buildings_user['level'].'_"><span><span>обменять <img class="ico vm" src="/images/icons/iron.png" alt="Железо" title="Железо"> 5</span></span></a></div></td>
</tr></tbody></table>
</div></div></div></div></div></div></div></div></div></div>';
}
if($buildings_user['level']>=10){
if($buildings_user['level']==10){$silver3 = 20;}if($buildings_user['level']==11){$silver3 = 25;}if($buildings_user['level']==12){$silver3 = 30;}if($buildings_user['level']==13){$silver3 = 35;}if($buildings_user['level']>=14){$silver3 = 40;}
echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/steel.jpg" alt="Сталь" title="Сталь" style="width:100%; border-radius: 10px;"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold">
<span class="green2">Обмен стали на серебро</span><br><img title="Сталь" alt="Сталь" src="/images/icons/steel.png"> 1 на <img title="Серебро" alt="Серебро" src="/images/icons/silver.png"> '.$silver3.'</div>
<div class="clrb"></div></div>
<table><tbody><tr>
<td style="width:50%;padding-right:1px;"><div class="bot"><a class="simple-but border" href="?go_obmen_3'.$buildings_user['tip'].'_'.$buildings_user['level'].'"><span><span>обменять <img class="ico vm" src="/images/icons/steel.png" alt="Сталь" title="Сталь"> 1</span></span></a></div></td>
<td style="width:50%;padding-left:1px;"><div class="bot gray1"><a class="simple-but border" href="?go_obmen_3'.$buildings_user['tip'].'_'.$buildings_user['level'].'_"><span><span>обменять <img class="ico vm" src="/images/icons/steel.png" alt="Сталь" title="Сталь"> 5</span></span></a></div></td>
</tr></tbody></table>
</div></div></div></div></div></div></div></div></div></div>';
}
if($buildings_user['level']>=15){
if($buildings_user['level']==15){$silver4 = 50;}if($buildings_user['level']==16){$silver4 = 60;}if($buildings_user['level']==17){$silver4 = 70;}if($buildings_user['level']==18){$silver4 = 80;}if($buildings_user['level']==19){$silver4 = 90;}if($buildings_user['level']==20){$silver4 = 100;}
echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/plumbum.jpg" alt="Свинец" title="Свинец" style="width:100%; border-radius: 10px;"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold">
<span class="green2">Обмен свинца на серебро</span><br><img title="Свинец" alt="Свинец" src="/images/icons/plumbum.png"> 1 на <img title="Серебро" alt="Серебро" src="/images/icons/silver.png"> '.$silver4.'</div>
<div class="clrb"></div></div>
<table><tbody><tr>
<td style="width:50%;padding-right:1px;"><div class="bot"><a class="simple-but border" href="?go_obmen_4'.$buildings_user['tip'].'_'.$buildings_user['level'].'"><span><span>обменять <img class="ico vm" src="/images/icons/plumbum.png" alt="Свинец" title="Свинец"> 1</span></span></a></div></td>
<td style="width:50%;padding-left:1px;"><div class="bot gray1"><a class="simple-but border" href="?go_obmen_4'.$buildings_user['tip'].'_'.$buildings_user['level'].'_"><span><span>обменять <img class="ico vm" src="/images/icons/plumbum.png" alt="Свинец" title="Свинец"> 5</span></span></a></div></td>
</tr></tbody></table>
</div></div></div></div></div></div></div></div></div></div>';
}




if(isset($_GET['go_obmen_1'.$buildings_user['tip'].'_'.$buildings_user['level'].''])){
if($buildings_user['build_time']>time()){header('Location: /buildings/');exit();}
if($buildings_user['level']==0){header('Location: /buildings/');exit();}
if($ammunition_users['ore'] < 1){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/ore.png?1" alt="Руда" title="Руда"> '.(1-$ammunition_users['ore']).' руды</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
$mysqli->query('UPDATE `ammunition_users` SET `ore` = '.($ammunition_users['ore']-1).' WHERE `id` = '.$ammunition_users['id'].' LIMIT 1');
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']+$silver1).' WHERE `id` = '.$user['id'].' LIMIT 1');
header('Location: ?');
exit();
}
if(isset($_GET['go_obmen_1'.$buildings_user['tip'].'_'.$buildings_user['level'].'_'])){
if($buildings_user['build_time']>time()){header('Location: /buildings/');exit();}
if($buildings_user['level']==0){header('Location: /buildings/');exit();}
if($ammunition_users['ore'] < 5){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/ore.png?1" alt="Руда" title="Руда"> '.(5-$ammunition_users['ore']).' руды</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
$mysqli->query('UPDATE `ammunition_users` SET `ore` = '.($ammunition_users['ore']-5).' WHERE `id` = '.$ammunition_users['id'].' LIMIT 1');
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']+($silver1*5)).' WHERE `id` = '.$user['id'].' LIMIT 1');
header('Location: ?');
exit();
}

if(isset($_GET['go_obmen_2'.$buildings_user['tip'].'_'.$buildings_user['level'].''])){
if($buildings_user['build_time']>time()){header('Location: /buildings/');exit();}
if($buildings_user['level']<5){header('Location: /buildings/');exit();}
if($ammunition_users['iron'] < 1){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/iron.png?1" alt="Железо" title="Железо"> '.(1-$ammunition_users['iron']).' железа</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
$mysqli->query('UPDATE `ammunition_users` SET `iron` = '.($ammunition_users['iron']-1).' WHERE `id` = '.$ammunition_users['id'].' LIMIT 1');
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']+$silver2).' WHERE `id` = '.$user['id'].' LIMIT 1');
header('Location: ?');
exit();
}
if(isset($_GET['go_obmen_2'.$buildings_user['tip'].'_'.$buildings_user['level'].'_'])){
if($buildings_user['build_time']>time()){header('Location: /buildings/');exit();}
if($buildings_user['level']<5){header('Location: /buildings/');exit();}
if($ammunition_users['iron'] < 5){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/iron.png?1" alt="Железо" title="Железо"> '.(5-$ammunition_users['iron']).' железа</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
$mysqli->query('UPDATE `ammunition_users` SET `iron` = '.($ammunition_users['iron']-5).' WHERE `id` = '.$ammunition_users['id'].' LIMIT 1');
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']+($silver2*5)).' WHERE `id` = '.$user['id'].' LIMIT 1');
header('Location: ?');
exit();
}

if(isset($_GET['go_obmen_3'.$buildings_user['tip'].'_'.$buildings_user['level'].''])){
if($buildings_user['build_time']>time()){header('Location: /buildings/');exit();}
if($buildings_user['level']<10){header('Location: /buildings/');exit();}
if($ammunition_users['steel'] < 1){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/steel.png?1" alt="Сталь" title="Сталь"> '.(1-$ammunition_users['steel']).' стали</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
$mysqli->query('UPDATE `ammunition_users` SET `steel` = '.($ammunition_users['steel']-1).' WHERE `id` = '.$ammunition_users['id'].' LIMIT 1');
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']+$silver3).' WHERE `id` = '.$user['id'].' LIMIT 1');
header('Location: ?');
exit();
}
if(isset($_GET['go_obmen_3'.$buildings_user['tip'].'_'.$buildings_user['level'].'_'])){
if($buildings_user['build_time']>time()){header('Location: /buildings/');exit();}
if($buildings_user['level']<10){header('Location: /buildings/');exit();}
if($ammunition_users['steel'] < 5){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/steel.png?1" alt="Сталь" title="Сталь"> '.(5-$ammunition_users['steel']).' стали</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
$mysqli->query('UPDATE `ammunition_users` SET `steel` = '.($ammunition_users['steel']-5).' WHERE `id` = '.$ammunition_users['id'].' LIMIT 1');
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']+($silver3*5)).' WHERE `id` = '.$user['id'].' LIMIT 1');
header('Location: ?');
exit();
}

if(isset($_GET['go_obmen_4'.$buildings_user['tip'].'_'.$buildings_user['level'].''])){
if($buildings_user['build_time']>time()){header('Location: /buildings/');exit();}
if($buildings_user['level']<15){header('Location: /buildings/');exit();}
if($ammunition_users['plumbum'] < 1){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/plumbum.png?1" alt="Свинец" title="Свинец"> '.(1-$ammunition_users['plumbum']).' свинца</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
$mysqli->query('UPDATE `ammunition_users` SET `plumbum` = '.($ammunition_users['plumbum']-1).' WHERE `id` = '.$ammunition_users['id'].' LIMIT 1');
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']+$silver4).' WHERE `id` = '.$user['id'].' LIMIT 1');
header('Location: ?');
exit();
}
if(isset($_GET['go_obmen_4'.$buildings_user['tip'].'_'.$buildings_user['level'].'_'])){
if($buildings_user['build_time']>time()){header('Location: /buildings/');exit();}
if($buildings_user['level']<15){header('Location: /buildings/');exit();}
if($ammunition_users['plumbum'] < 5){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/plumbum.png?1" alt="Свинец" title="Свинец"> '.(5-$ammunition_users['plumbum']).' свинца</div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
$mysqli->query('UPDATE `ammunition_users` SET `plumbum` = '.($ammunition_users['plumbum']-5).' WHERE `id` = '.$ammunition_users['id'].' LIMIT 1');
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']+($silver4*5)).' WHERE `id` = '.$user['id'].' LIMIT 1');
header('Location: ?');
exit();
}
}
########################################################################################################################################################




























########################################################################################################################################################
if($buildings_user['tip']==7){
$res = $mysqli->query('SELECT * FROM `users_tanks_pimp` WHERE `user` = '.$user['id'].' LIMIT 1');
$users_tanks_pimp = $res->fetch_assoc();

if($buildings_user['level']>=1){
echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/slot/ShellBoxCover.png" alt="Защита боеукладки" title="Защита боеукладки"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold">
<span class="green2">Защита боеукладки</span><br>
<span class="white">Увеличивает запас прочности у вашего танка</span><br>
</div><div class="clrb"></div></div>';
if($users_tanks_pimp['8']==0){
echo '<div class="bot"><a class="simple-but border mb5" href="/pimp/'.$user['id'].'/"><span><span>Изучить</span></span></a></div>';
}else{
echo '<div class="bot"><a class="simple-but gray border"><span><span>изучено</span></span></a></div>';
}
echo '</div></div></div></div></div></div></div></div></div></div>';
}

if($buildings_user['level']>=2){
echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/slot/Stereoscope.png" alt="Стереотруба" title="Стереотруба"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold">
<span class="green2">Стереотруба</span><br>
<span class="white">Повышает вероятность критического урона по врагу</span><br>
</div><div class="clrb"></div></div>';
if($users_tanks_pimp['7']==0){
echo '<div class="bot"><a class="simple-but border mb5" href="/pimp/'.$user['id'].'/"><span><span>Изучить</span></span></a></div>';
}else{
echo '<div class="bot"><a class="simple-but gray border"><span><span>изучено</span></span></a></div>';
}
echo '</div></div></div></div></div></div></div></div></div></div>';
}

if($buildings_user['level']>=3){
echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/slot/SlopedArmour.png" alt="Наклонная броня" title="Наклонная броня"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold">
<span class="green2">Наклонная броня</span><br>
<span class="white">Уменьшает урон от выстрела врага</span><br>
</div><div class="clrb"></div></div>';
if($users_tanks_pimp['6']==0){
echo '<div class="bot"><a class="simple-but border mb5" href="/pimp/'.$user['id'].'/"><span><span>Изучить</span></span></a></div>';
}else{
echo '<div class="bot"><a class="simple-but gray border"><span><span>изучено</span></span></a></div>';
}
echo '</div></div></div></div></div></div></div></div></div></div>';
}

if($buildings_user['level']>=4){
echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/slot/GunRammer.png" alt="Орудийный досылатель" title="Орудийный досылатель"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold">
<span class="green2">Орудийный досылатель</span><br>
<span class="white">Увеличивает запас прочности у вашего танка</span><br>
</div><div class="clrb"></div></div>';
if($users_tanks_pimp['5']==0){
echo '<div class="bot"><a class="simple-but border mb5" href="/pimp/'.$user['id'].'/"><span><span>Изучить</span></span></a></div>';
}else{
echo '<div class="bot"><a class="simple-but gray border"><span><span>изучено</span></span></a></div>';
}
echo '</div></div></div></div></div></div></div></div></div></div>';
}





}
########################################################################################################################################################







































##############################################################################################################
##############################################################################################################
##############################################################################################################

$arr_text = array(
1 => "Платное ускорение строительства уменьшает время строительства на 6 часов",
2 => "Хорошо прокачанный полигон залог будущих побед. Полигон дает мощный бонус к параметрам танка",
3 => "Ресурсы нужны для постройки зданий",
4 => "Бесплатное ускорение строительства доступно раз в 30 минут. Оно уменьшает время строительства на 1 час",
5 => "Ресурсы произведенные в шахте, можно продать построив рынок"); 
$rand_text = rand(1,5);


echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">'.$arr_text[$rand_text].'</div>
</div></div></div></div></div></div></div></div></div></div>';
require_once ('../system/footer.php');
?>