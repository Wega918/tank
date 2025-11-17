<?php
$title = 'База';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}

$res = $mysqli->query('SELECT * FROM `ammunition_users` WHERE `user` = '.$user['id'].' LIMIT 1');
$ammunition_users = $res->fetch_assoc();


$res = $mysqli->query('SELECT * FROM `traning` WHERE `user`  = "'.$user['id'].'" limit 1');
$traning = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `prom` WHERE `id` = "1" ');
$prom = $res->fetch_assoc();






echo'<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8">
<div class="wrap-content"><div class="white small bold sh_b mb5 cntr">Мои ресурсы<span class="gray1 cntr blck pt5">
<span class="nwr"><img class="rico vm" src="/images/icons/ore.png" alt="Руда" title="Руда"> '.$ammunition_users['ore'].' &nbsp;&nbsp;</span>
<span class="nwr"><img class="rico vm" src="/images/icons/iron.png" alt="Железо" title="Железо"> '.$ammunition_users['iron'].' &nbsp;&nbsp;</span>
<span class="nwr"><img class="rico vm" src="/images/icons/steel.png" alt="Сталь" title="Сталь"> '.$ammunition_users['steel'].' &nbsp;&nbsp;</span>
<span class="nwr"><img class="rico vm" src="/images/icons/plumbum.png" alt="Свинец" title="Свинец"> '.$ammunition_users['plumbum'].' &nbsp;&nbsp;</span>
</span>
</div></div></div></div></div></div></div></div></div></div></div>';






if($user['level']<3){$limit = 2;
}elseif($user['level']>=3 && $user['level']<5){$limit = 3;
}elseif($user['level']>=5 && $user['level']<7){$limit = 4;
}elseif($user['level']>=7 && $user['level']<11){$limit = 5;
}elseif($user['level']>=11 && $user['level']<13){$limit = 6;
}elseif($user['level']>=13){$limit = 7;}

$res = $mysqli->query('SELECT * FROM `buildings_user` WHERE `user` = "'.$user['id'].'" ORDER BY `tip` LIMIT '.$limit.'');
while ($build = $res->fetch_array()){
$res1 = $mysqli->query('SELECT * FROM `buildings` WHERE `id` = "'.$build['tip'].'" ');
$buildings_ = $res1->fetch_assoc();

if($build['tip']==6 and $build['time_production']<time() and $build['tip_production']>0){
$mysqli->query('UPDATE `buildings_user` SET `tip_production` = "0" WHERE `id` = '.$build['id'].' LIMIT 1');
}




if($build['tip']!=7){
$max_level = 20;
if($build['level']==0){$prog_time = (1*3600);$cost_gold = 0;$cost_silver = 100;$cost_ore = 0;$cost_iron = 0;$cost_steel = 0;$cost_plumbum = 0;}
if($build['level']==1){$prog_time = (3*3600);$cost_gold = 0;$cost_silver = 200;$cost_ore = 2;$cost_iron = 0;$cost_steel = 0;$cost_plumbum = 0;}
if($build['level']==2){$prog_time = (12*3600);$cost_gold = 0;$cost_silver = 300;$cost_ore = 6;$cost_iron = 0;$cost_steel = 0;$cost_plumbum = 0;}
if($build['level']==3){$prog_time = (16*3600);$cost_gold = 0;$cost_silver = 500;$cost_ore = 12;$cost_iron = 0;$cost_steel = 0;$cost_plumbum = 0;}
if($build['level']==4){$prog_time = (24*3600);$cost_gold = 40;$cost_silver = 0;$cost_ore = 20;$cost_iron = 0;$cost_steel = 0;$cost_plumbum = 0;}
if($build['level']==5){$prog_time = (32*3600);$cost_gold = 0;$cost_silver = 1400;$cost_ore = 15;$cost_iron = 2;$cost_steel = 0;$cost_plumbum = 0;}
if($build['level']==6){$prog_time = (40*3600);$cost_gold = 0;$cost_silver = 1800;$cost_ore = 30;$cost_iron = 6;$cost_steel = 0;$cost_plumbum = 0;}
if($build['level']==7){$prog_time = (48*3600);$cost_gold = 0;$cost_silver = 2000;$cost_ore = 40;$cost_iron = 10;$cost_steel = 0;$cost_plumbum = 0;}
if($build['level']==8){$prog_time = (56*3600);$cost_gold = 0;$cost_silver = 2400;$cost_ore = 45;$cost_iron = 12;$cost_steel = 0;$cost_plumbum = 0;}
if($build['level']==9){$prog_time = (64*3600);$cost_gold = 200;$cost_silver = 0;$cost_ore = 40;$cost_iron = 20;$cost_steel = 0;$cost_plumbum = 0;}
if($build['level']==10){$prog_time = (72*3600);$cost_gold = 0;$cost_silver = 2000;$cost_ore = 25;$cost_iron = 15;$cost_steel = 1;$cost_plumbum = 0;}
if($build['level']==11){$prog_time = (80*3600);$cost_gold = 0;$cost_silver = 2400;$cost_ore = 35;$cost_iron = 20;$cost_steel = 2;$cost_plumbum = 0;}
if($build['level']==12){$prog_time = (88*3600);$cost_gold = 0;$cost_silver = 2800;$cost_ore = 45;$cost_iron = 20;$cost_steel = 3;$cost_plumbum = 0;}
if($build['level']==13){$prog_time = (96*3600);$cost_gold = 0;$cost_silver = 3000;$cost_ore = 55;$cost_iron = 25;$cost_steel = 5;$cost_plumbum = 0;}
if($build['level']==14){$prog_time = (104*3600);$cost_gold = 600;$cost_silver = 0;$cost_ore = 60;$cost_iron = 10;$cost_steel = 5;$cost_plumbum = 0;}
if($build['level']==15){$prog_time = (112*3600);$cost_gold = 0;$cost_silver = 3000;$cost_ore = 15;$cost_iron = 15;$cost_steel = 6;$cost_plumbum = 1;}
if($build['level']==16){$prog_time = (120*3600);$cost_gold = 0;$cost_silver = 3500;$cost_ore = 20;$cost_iron = 20;$cost_steel = 7;$cost_plumbum = 2;}
if($build['level']==17){$prog_time = (128*3600);$cost_gold = 0;$cost_silver = 4000;$cost_ore = 25;$cost_iron = 25;$cost_steel = 8;$cost_plumbum = 3;}
if($build['level']==18){$prog_time = (136*3600);$cost_gold = 0;$cost_silver = 5000;$cost_ore = 30;$cost_iron = 30;$cost_steel = 10;$cost_plumbum = 4;}
if($build['level']==19){$prog_time = (150*3600);$cost_gold = 1000;$cost_silver = 0;$cost_ore = 50;$cost_iron = 50;$cost_steel = 25;$cost_plumbum = 5;}
}else{
$max_level = 4;
if($build['level']==0){$prog_time = (80*3600);$cost_gold = 0;$cost_silver = 2400;$cost_ore = 25;$cost_iron = 20;$cost_steel = 2;$cost_plumbum = 0;}
if($build['level']==1){$prog_time = (88*3600);$cost_gold = 0;$cost_silver = 2800;$cost_ore = 30;$cost_iron = 20;$cost_steel = 20;$cost_plumbum = 3;}
if($build['level']==2){$prog_time = (96*3600);$cost_gold = 0;$cost_silver = 3000;$cost_ore = 35;$cost_iron = 25;$cost_steel = 5;$cost_plumbum = 0;}
if($build['level']==3){$prog_time = (104*3600);$cost_gold = 600;$cost_silver = 0;$cost_ore = 20;$cost_iron = 10;$cost_steel = 5;$cost_plumbum = 0;}
}



if($build['tip']==1){
if($build['tip_production']==1){if($build['level']>=1){if($build['level']==1){$col1 = 1;$time1 = 20;}if($build['level']==2){$col1 = 1;$time1 = 20;}if($build['level']==3){$col1 = 2;$time1 = 30;}if($build['level']==4){$col1 = 2;$time1 = 30;}if($build['level']==5){$col1 = 2;$time1 = 30;}if($build['level']==6){$col1 = 2;$time1 = 30;}if($build['level']==7){$col1 = 3;$time1 = 30;}if($build['level']==8){$col1 = 3;$time1 = 30;}if($build['level']==9){$col1 = 3;$time1 = 30;}if($build['level']==10){$col1 = 3;$time1 = 30;}if($build['level']==11){$col1 = 3;$time1 = 30;}if($build['level']==12){$col1 = 3;$time1 = 30;}if($build['level']==13){$col1 = 3;$time1 = 30;}if($build['level']==14){$col1 = 6;$time1 = 60;}if($build['level']==15){$col1 = 6;$time1 = 60;}if($build['level']==16){$col1 = 6;$time1 = 60;}if($build['level']==17){$col1 = 6;$time1 = 60;}if($build['level']==18){$col1 = 6;$time1 = 60;}if($build['level']==19){$col1 = 6;$time1 = 60;}if($build['level']==20){$col1 = 6;$time1 = 54;}if($build['time_production']>time()){$prog = round((($time1*60)-($build['time_production']-time()))*100/($time1*60));if($prog > 100) {$prog = 100;}}}}
if($build['tip_production']==2){if($build['level']>=5){if($build['level']==5){$col2 = 1;$time2 = 60;}if($build['level']==6){$col2 = 1;$time2 = 60;}if($build['level']==7){$col2 = 1;$time2 = 60;}if($build['level']==8){$col2 = 1;$time2 = 60;}if($build['level']==9){$col2 = 1;$time2 = 60;}if($build['level']==10){$col2 = 1;$time2 = 60;}if($build['level']==11){$col2 = 1;$time2 = 60;}if($build['level']==12){$col2 = 2;$time2 = 60;}if($build['level']==13){$col2 = 2;$time2 = 60;}if($build['level']==14){$col2 = 2;$time2 = 60;}if($build['level']==15){$col2 = 2;$time2 = 60;}if($build['level']==16){$col2 = 2;$time2 = 60;}if($build['level']==17){$col2 = 2;$time2 = 60;}if($build['level']==18){$col2 = 2;$time2 = 60;}if($build['level']==19){$col2 = 5;$time2 = 120;}if($build['level']==20){$col2 = 5;$time2 = 108;}if($build['time_production']>time()){$prog = round((($time2*60)-($build['time_production']-time()))*100/($time2*60));if($prog > 100) {$prog = 100;}}}}
if($build['tip_production']==3){if($build['level']>=10){if($build['level']==10){$col3 = 1;$time3 = 240;}if($build['level']==11){$col3 = 1;$time3 = 240;}if($build['level']==12){$col3 = 1;$time3 = 240;}if($build['level']==13){$col3 = 1;$time3 = 240;}if($build['level']==14){$col3 = 1;$time3 = 240;}if($build['level']==15){$col3 = 1;$time3 = 240;}if($build['level']==16){$col3 = 1;$time3 = 240;}if($build['level']==17){$col3 = 2;$time3 = 120;}if($build['level']==18){$col3 = 2;$time3 = 120;}if($build['level']==19){$col3 = 2;$time3 = 120;}if($build['level']==20){$col3 = 2;$time3 = 108;}if($build['time_production']>time()){$prog = round((($time3*60)-($build['time_production']-time()))*100/($time3*60));if($prog > 100) {$prog = 100;}}}}
if($build['tip_production']==4){if($build['level']>=15 && $build['level']<=20){if($build['level']==15){$col4 = 1;$time4 = 1200;}if($build['level']==16){$col4 = 1;$time4 = 1200;}if($build['level']==17){$col4 = 1;$time4 = 1200;}if($build['level']==18){$col4 = 1;$time4 = 1200;}if($build['level']==19){$col4 = 1;$time4 = 1200;}if($build['level']==20){$col4 = 1;$time4 = 1080;}if($build['time_production']>time()){$prog = round((($time4*60)-($build['time_production']-time()))*100/($time4*60));if($prog > 100) {$prog = 100;}}}}
}
if($build['tip']==3){
if($build['tip_production']==1){if($build['level']==1){$time_1 = 60;$col1 = 1;}if($build['level']==2){$time_1 = 60;$col1 = 1;}if($build['level']==3){$time_1 = 60;$col1 = 1;}if($build['level']==4){$time_1 = 60;$col1 = 1;}if($build['level']==5){$time_1 = 55;$col1 = 1;}if($build['level']==6){$time_1 = 55;$col1 = 2;}if($build['level']==7){$time_1 = 55;$col1 = 2;}if($build['level']==8){$time_1 = 55;$col1 = 2;}if($build['level']==9){$time_1 = 55;$col1 = 2;}if($build['level']==10){$time_1 = 55;$col1 = 2;}if($build['level']==11){$time_1 = 50;$col1 = 3;}if($build['level']==12){$time_1 = 50;$col1 = 3;}if($build['level']==13){$time_1 = 50;$col1 = 3;}if($build['level']==14){$time_1 = 50;$col1 = 3;}if($build['level']==15){$time_1 = 45;$col1 = 3;}if($build['level']==16){$time_1 = 45;$col1 = 4;}if($build['level']==17){$time_1 = 45;$col1 = 4;}if($build['level']==18){$time_1 = 45;$col1 = 4;}if($build['level']==19){$time_1 = 45;$col1 = 4;}if($build['level']==20){$time_1 = 40;$col1 = 4;}if($build['time_production']>time()){$prog = round((($time_1*60)-($build['time_production']-time()))*100/($time_1*60));if($prog > 100) {$prog = 100;}}}
if($build['tip_production']==2){if($build['level']==2){$time_1 = 60;$col1 = 1;}if($build['level']==3){$time_1 = 60;$col1 = 1;}if($build['level']==4){$time_1 = 60;$col1 = 1;}if($build['level']==5){$time_1 = 55;$col1 = 1;}if($build['level']==6){$time_1 = 55;$col1 = 2;}if($build['level']==7){$time_1 = 55;$col1 = 2;}if($build['level']==8){$time_1 = 55;$col1 = 2;}if($build['level']==9){$time_1 = 55;$col1 = 2;}if($build['level']==10){$time_1 = 50;$col1 = 2;}if($build['level']==11){$time_1 = 50;$col1 = 2;}if($build['level']==12){$time_1 = 50;$col1 = 3;}if($build['level']==13){$time_1 = 50;$col1 = 3;}if($build['level']==14){$time_1 = 50;$col1 = 3;}if($build['level']==15){$time_1 = 45;$col1 = 3;}if($build['level']==16){$time_1 = 45;$col1 = 3;}if($build['level']==17){$time_1 = 45;$col1 = 4;}if($build['level']==18){$time_1 = 45;$col1 = 4;}if($build['level']==19){$time_1 = 45;$col1 = 4;}if($build['level']==20){$time_1 = 40;$col1 = 4;}if($build['time_production']>time()){$prog = round((($time_1*60)-($build['time_production']-time()))*100/($time_1*60));if($prog > 100) {$prog = 100;}}}
if($build['tip_production']==3){if($build['level']==3){$time_1 = 60;$col1 = 1;}if($build['level']==4){$time_1 = 60;$col1 = 1;}if($build['level']==5){$time_1 = 55;$col1 = 1;}if($build['level']==6){$time_1 = 55;$col1 = 1;}if($build['level']==7){$time_1 = 55;$col1 = 1;}if($build['level']==8){$time_1 = 55;$col1 = 2;}if($build['level']==9){$time_1 = 55;$col1 = 2;}if($build['level']==10){$time_1 = 50;$col1 = 2;}if($build['level']==11){$time_1 = 50;$col1 = 2;}if($build['level']==12){$time_1 = 50;$col1 = 2;}if($build['level']==13){$time_1 = 50;$col1 = 3;}if($build['level']==14){$time_1 = 45;$col1 = 3;}if($build['level']==15){$time_1 = 45;$col1 = 3;}if($build['level']==16){$time_1 = 45;$col1 = 3;}if($build['level']==17){$time_1 = 45;$col1 = 3;}if($build['level']==18){$time_1 = 45;$col1 = 3;}if($build['level']==19){$time_1 = 45;$col1 = 4;}if($build['level']==20){$time_1 = 40;$col1 = 4;}if($build['time_production']>time()){$prog = round((($time_1*60)-($build['time_production']-time()))*100/($time_1*60));if($prog > 100) {$prog = 100;}}}
if($build['tip_production']==4){if($build['level']==4){$time_1 = 60;$col1 = 1;}if($build['level']==5){$time_1 = 55;$col1 = 1;}if($build['level']==6){$time_1 = 55;$col1 = 1;}if($build['level']==7){$time_1 = 55;$col1 = 1;}if($build['level']==8){$time_1 = 55;$col1 = 1;}if($build['level']==9){$time_1 = 55;$col1 = 2;}if($build['level']==10){$time_1 = 50;$col1 = 2;}if($build['level']==11){$time_1 = 50;$col1 = 2;}if($build['level']==12){$time_1 = 50;$col1 = 2;}if($build['level']==13){$time_1 = 50;$col1 = 2;}if($build['level']==14){$time_1 = 50;$col1 = 3;}if($build['level']==15){$time_1 = 45;$col1 = 3;}if($build['level']==16){$time_1 = 45;$col1 = 3;}if($build['level']==17){$time_1 = 45;$col1 = 3;}if($build['level']==18){$time_1 = 45;$col1 = 4;}if($build['level']==19){$time_1 = 45;$col1 = 4;}if($build['level']==20){$time_1 = 40;$col1 = 4;}if($build['time_production']>time()){$prog = round((($time_1*60)-($build['time_production']-time()))*100/($time_1*60));if($prog > 100) {$prog = 100;}}}
}
if($build['tip']==4){
if($build['tip_production']==1){$time_1 = 20;if($buildings_user['level']==1){$col1 = 2;}if($buildings_user['level']==2){$col1 = 2;}if($buildings_user['level']==3){$col1 = 4;}if($buildings_user['level']==4){$col1 = 4;}if($buildings_user['level']==5){$col1 = 6;}if($buildings_user['level']==6){$col1 = 6;}if($buildings_user['level']==7){$col1 = 9;}if($buildings_user['level']==8){$col1 = 9;}if($buildings_user['level']==9){$col1 = 11;}if($buildings_user['level']==10){$col1 = 11;}if($buildings_user['level']==11){$col1 = 13;}if($buildings_user['level']==12){$col1 = 13;}if($buildings_user['level']==13){$col1 = 15;}if($buildings_user['level']==14){$col1 = 15;}if($buildings_user['level']==15){$col1 = 18;}if($buildings_user['level']==16){$col1 = 20;}if($buildings_user['level']==17){$col1 = 20;}if($buildings_user['level']==18){$col1 = 20;}if($buildings_user['level']==19){$col1 = 23;}if($buildings_user['level']==20){$col1 = 23;}if($build['time_production']>time()){$prog = round((($time_1*60)-($build['time_production']-time()))*100/($time_1*60));if($prog > 100) {$prog = 100;}}}
if($build['tip_production']==2){$time_2 = 60;if($buildings_user['level']==2){$col1 = 5;}if($buildings_user['level']==3){$col1 = 5;}if($buildings_user['level']==4){$col1 = 9;}if($buildings_user['level']==5){$col1 = 9;}if($buildings_user['level']==6){$col1 = 13;}if($buildings_user['level']==7){$col1 = 13;}if($buildings_user['level']==8){$col1 = 17;}if($buildings_user['level']==9){$col1 = 17;}if($buildings_user['level']==10){$col1 = 20;}if($buildings_user['level']==11){$col1 = 20;}if($buildings_user['level']==12){$col1 = 22;}if($buildings_user['level']==13){$col1 = 22;}if($buildings_user['level']==14){$col1 = 30;}if($buildings_user['level']==15){$col1 = 30;}if($buildings_user['level']==16){$col1 = 30;}if($buildings_user['level']==17){$col1 = 38;}if($buildings_user['level']==18){$col1 = 42;}if($buildings_user['level']==19){$col1 = 42;}if($buildings_user['level']==20){$col1 = 45;}if($build['time_production']>time()){$prog = round((($time_2*60)-($build['time_production']-time()))*100/($time_2*60));if($prog > 100) {$prog = 100;}}}
}




if($build['build_time']>time()){$prog = round(($prog_time-($build['build_time']-time()))*100/$prog_time);if($prog > 100) {$prog = 100;}}




if($build['build_time']>0 and $build['build_time']<=time()){
if($build['tip']==5){
if($build['level']==1){$nextfuel = 330;}if($build['level']==2){$nextfuel = 345;}if($build['level']==3){$nextfuel = 360;}if($build['level']==4){$nextfuel = 405;}if($build['level']==5){$nextfuel = 420;}if($build['level']==6){$nextfuel = 435;}if($build['level']==7){$nextfuel = 450;}if($build['level']==8){$nextfuel = 465;}if($build['level']==9){$nextfuel = 510;}if($build['level']==10){$nextfuel = 525;}if($build['level']==11){$nextfuel = 540;}if($build['level']==12){$nextfuel = 555;}if($build['level']==13){$nextfuel = 570;}if($build['level']==14){$nextfuel = 615;}if($build['level']==15){$nextfuel = 630;}if($build['level']==16){$nextfuel = 645;}if($build['level']==17){$nextfuel = 660;}if($build['level']==18){$nextfuel = 675;}if($build['level']==19){$nextfuel = 720;}
$mysqli->query('UPDATE `users` SET `fuel_max` = '.$nextfuel.' WHERE `id` = '.$user['id'].' LIMIT 1');
}
if($build['tip']==7){
$mysqli->query('UPDATE `buildings_user` SET `faste_build_time` = "0", `build_time` = "0", `tip_production` = '.($build['tip_production']+1).', `level` = '.($build['level']+1).' WHERE `id` = '.$build['id'].' LIMIT 1');
}else{
$mysqli->query('UPDATE `buildings_user` SET `faste_build_time` = "0", `build_time` = "0", `level` = '.($build['level']+1).' WHERE `id` = '.$build['id'].' LIMIT 1');
}

}









if($prom['time_5'] > time()){ //скидка на базу
$cost_gold = ceil($cost_gold-($cost_gold*$prom['act_5']/100));
$cost_silver = ceil($cost_silver-($cost_silver*$prom['act_5']/100));
$cost_ore = ceil($cost_ore-($cost_ore*$prom['act_5']/100));
$cost_iron = ceil($cost_iron-($cost_iron*$prom['act_5']/100));
$cost_steel =ceil( $cost_steel-($cost_steel*$prom['act_5']/100));
$cost_plumbum = ceil($cost_plumbum-($cost_plumbum*$prom['act_5']/100));
}else{
$cost_gold = ceil($cost_gold);
$cost_silver = ceil($cost_silver);
$cost_ore = ceil($cost_ore);
$cost_iron = ceil($cost_iron);
$cost_steel = ceil($cost_steel);
$cost_plumbum = ceil($cost_plumbum);
}






if(isset($_GET['app_build_'.$build['tip'].''])){
if($cost_gold>0){$gold = '<img class="ico vm" src="/images/icons/gold.png" alt="Золото" title="Золото"> '.$cost_gold.'';}
if($cost_silver>0){$silver = '<img class="ico vm" src="/images/icons/silver.png" alt="Серебро" title="Серебро"> '.$cost_silver.'';}
if($cost_ore>0){$ore = '<img class="ico vm" src="/images/icons/ore.png" alt="Руда" title="Руда"> '.$cost_ore.'';}
if($cost_iron>0){$iron = '<img class="ico vm" src="/images/icons/iron.png" alt="Железо" title="Железо"> '.$cost_iron.'';}
if($cost_steel>0){$steel = '<img class="ico vm" src="/images/icons/steel.png" alt="Сталь" title="Сталь"> '.$cost_steel.'';}
if($cost_plumbum>0){$plumbum = '<img class="ico vm" src="/images/icons/plumbum.png" alt="Свинец" title="Свинец"> '.$cost_plumbum.'';}
if($build['level']>0){$txt = 'Улучшение ';$txt1 = 'Улучшить';}else{$txt = 'Постройка';$txt1 = 'Построить';}
if($build['build_time']>time()){header('Location: ?');exit();}
if($build['level']>=$max_level){header('Location: ?');exit();}
if($build['tip']!=6){
if($build['time_production']>time()){header('Location: ?');exit();}
}
$_SESSION['ses'] = '<div class="medium white bold cntr mb5">'.$txt.' здания: '.$buildings_['name'].'</div>
<div class="cntr white mb5">Цена: '.$gold.' '.$silver.' '.$ore.' '.$iron.' '.$steel.' '.$plumbum.'</div>
<div class="a_w50"><a class="simple-but border mb5" href="?go_app_build_'.$build['tip'].'_'.$build['level'].'"><span><span>'.$txt1.'</span></span></a></div>';
header('Location: ?');
exit();
}

if(isset($_GET['go_app_build_'.$build['tip'].'_'.$build['level'].''])){
if($build['build_time']>time()){header('Location: ?');exit();}
if($build['level']>=$max_level){header('Location: ?');exit();}
if($build['tip']!=6){
if($build['time_production']>time()){header('Location: ?');exit();}
}
if($user['gold']<$cost_gold){$cost1 = '<div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.($cost_gold-$user['gold']).' золота</div>';}
if($user['silver']<$cost_silver){$cost2 = '<div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/silver.png?1" alt="Серебро" title="Серебро"> '.($cost_silver-$user['silver']).' серебра</div>';}
if($ammunition_users['ore']<$cost_ore){$cost3 = '<div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/ore.png?1" alt="Руда" title="Руда"> '.($cost_ore-$ammunition_users['ore']).' руды</div>';}
if($ammunition_users['iron']<$cost_iron){$cost4 = '<div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/iron.png?1" alt="Железо" title="Железо"> '.($cost_iron-$ammunition_users['iron']).' железа</div>';}
if($ammunition_users['steel']<$cost_steel){$cost5 = '<div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/steel.png?1" alt="Сталь" title="Сталь"> '.($cost_steel-$ammunition_users['steel']).' стали</div>';}
if($ammunition_users['plumbum']<$cost_plumbum){$cost6 = '<div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/plumbum.png?1" alt="Свинец" title="Свинец"> '.($cost_plumbum-$ammunition_users['plumbum']).' свинца</div>';}
if($user['gold']<$cost_gold or $user['silver']<$cost_silver or $ammunition_users['ore']<$cost_ore or $ammunition_users['iron']<$cost_iron or $ammunition_users['steel']<$cost_steel or $ammunition_users['plumbum']<$cost_plumbum){$_SESSION['err'] = ''.$cost1.' '.$cost2.' '.$cost3.' '.$cost4.' '.$cost5.' '.$cost6.'';header('Location: ?');exit();}
$mysqli->query('UPDATE `buildings_user` SET `build_time` = '.(time()+$prog_time).' WHERE `id` = '.$build['id'].' LIMIT 1');
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']-$cost_silver).', `gold` = '.($user['gold']-$cost_gold).' WHERE `id` = '.$user['id'].' LIMIT 1');
$mysqli->query('UPDATE `ammunition_users` SET `ore` = '.($ammunition_users['ore']-$cost_ore).', `iron` = '.($ammunition_users['iron']-$cost_iron).', `steel` = '.($ammunition_users['steel']-$cost_steel).', `plumbum` = '.($ammunition_users['plumbum']-$cost_plumbum).' WHERE `id` = '.$ammunition_users['id'].' LIMIT 1');
header('Location: ?');
exit();
}

if(isset($_GET['speed_'.$build['tip'].'_'.$build['level'].''])){
if($build['build_time']<time()){header('Location: ?');exit();}
if($build['tip']!=6){
if($build['time_production']>time()){header('Location: ?');exit();}
}
if($build['faste_build_time']>time()){
$_SESSION['ses'] = '<div class="medium white  cntr mb5">Ускорить строительство на 6 часов?</div>
<div class="cntr white mb5">Здание: '.$buildings_['name'].'</div>
<div class="cntr white mb5">Цена: <img title="Золото" alt="Золото" src="/images/icons/gold.png?1"> 20</div>
<div class="a_w50"><a class="simple-but border mb5" href="?gold_speed_'.$build['tip'].'_'.$build['level'].'"><span><span>Подтверждаю</span></span></a></div>
<div class="a_w50"><a class="simple-but border red mb5" href="?"><span><span>Отмена</span></span></a></div>';
}else{
$mysqli->query('UPDATE `buildings_user` SET `build_time` = '.($build['build_time']-3600).' WHERE `id` = '.$build['id'].' LIMIT 1');
$mysqli->query('UPDATE `buildings_user` SET `faste_build_time` = '.(time()+1800).' WHERE `user` = '.$user['id'].' ');
}
header('Location: ?');
exit();
}

if(isset($_GET['gold_speed_'.$build['tip'].'_'.$build['level'].''])){
if($build['build_time']<time()){header('Location: ?');exit();}
if($build['faste_build_time']<time()){header('Location: ?');exit();}
if($build['tip']!=6){
if($build['time_production']>time()){header('Location: ?');exit();}
}
if($user['gold'] < 20){$_SESSION['err'] = '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content cntr"><div class="red1">У вас не хватает <img class="ico vm" src="/images/icons/gold.png?1" alt="Золото" title="Золото"> '.(20-$user['gold']).' золота</div><div class="bot"><a class="simple-but w50 mXa medium m5" href="'.$HOME.'payments/"><span><span>Купить золото</span></span></a></div></div></div></div></div></div></div></div></div></div></div>';header('Location: ?');exit();}
$mysqli->query('UPDATE `buildings_user` SET `build_time` = '.($build['build_time']-(3600*6)).' WHERE `id` = '.$build['id'].' LIMIT 1');
$mysqli->query('UPDATE `users` SET `gold` = '.($user['gold']-20).' WHERE `id` = '.$user['id'].' LIMIT 1');
header('Location: ?');
exit();
}





if(isset($_GET['production_'.$build['tip'].'_'.$build['level'].''])){
if($build['build_time']>time()){header('Location: ?');exit();}
if($build['time_production']>time()){header('Location: ?');exit();}
if($build['time_production']==0){header('Location: ?');exit();}

if($build['tip']==1){
if($build['tip_production']==1){$tip_production = 'ore';if($build['level']==1){$col = 1;}if($build['level']==2){$col = 1;}if($build['level']==3){$col = 2;}if($build['level']==4){$col = 2;}if($build['level']==5){$col = 2;}if($build['level']==6){$col = 2;}if($build['level']==7){$col = 3;}if($build['level']==8){$col = 3;}if($build['level']==9){$col = 3;}if($build['level']==10){$col = 3;}if($build['level']==11){$col = 3;}if($build['level']==12){$col = 3;}if($build['level']==13){$col = 3;}if($build['level']==14){$col = 6;}if($build['level']==15){$col = 6;}if($build['level']==16){$col = 6;}if($build['level']==17){$col = 6;}if($build['level']==18){$col = 6;}if($build['level']==19){$col = 6;}if($build['level']==20){$col = 6;}}
if($build['tip_production']==2){$tip_production = 'iron';if($build['level']==1){$col = 0;}if($build['level']==2){$col = 0;}if($build['level']==3){$col = 0;}if($build['level']==4){$col = 0;}if($build['level']==5){$col = 1;}if($build['level']==6){$col = 1;}if($build['level']==7){$col = 1;}if($build['level']==8){$col = 1;}if($build['level']==9){$col = 1;}if($build['level']==10){$col = 1;}if($build['level']==11){$col = 2;}if($build['level']==12){$col = 2;}if($build['level']==13){$col = 2;}if($build['level']==14){$col = 2;}if($build['level']==15){$col = 2;}if($build['level']==16){$col = 2;}if($build['level']==17){$col = 2;}if($build['level']==18){$col = 2;}if($build['level']==19){$col = 5;}if($build['level']==20){$col = 5;}}
if($build['tip_production']==3){$tip_production = 'steel';if($build['level']==1){$col = 0;}if($build['level']==2){$col = 0;}if($build['level']==3){$col = 0;}if($build['level']==4){$col = 0;}if($build['level']==5){$col = 0;}if($build['level']==6){$col = 0;}if($build['level']==7){$col = 0;}if($build['level']==8){$col = 0;}if($build['level']==9){$col = 0;}if($build['level']==10){$col = 1;}if($build['level']==11){$col = 1;}if($build['level']==12){$col = 1;}if($build['level']==13){$col = 1;}if($build['level']==14){$col = 1;}if($build['level']==15){$col = 1;}if($build['level']==16){$col = 1;}if($build['level']==17){$col = 2;}if($build['level']==18){$col = 2;}if($build['level']==19){$col = 2;}if($build['level']==20){$col = 2;}}
if($build['tip_production']==4){$tip_production = 'plumbum';if($build['level']==1){$col = 0;}if($build['level']==2){$col = 0;}if($build['level']==3){$col = 0;}if($build['level']==4){$col = 0;}if($build['level']==5){$col = 0;}if($build['level']==6){$col = 0;}if($build['level']==7){$col = 0;}if($build['level']==8){$col = 0;}if($build['level']==9){$col = 0;}if($build['level']==10){$col = 0;}if($build['level']==11){$col = 0;}if($build['level']==12){$col = 0;}if($build['level']==13){$col = 0;}if($build['level']==14){$col = 0;}if($build['level']==15){$col = 1;}if($build['level']==16){$col = 1;}if($build['level']==17){$col = 1;}if($build['level']==18){$col = 1;}if($build['level']==19){$col = 1;}if($build['level']==20){$col = 1;}}
$mysqli->query('UPDATE `buildings_user` SET `tip_production` = "0", `time_production` = "0" WHERE `id` = '.$build['id'].' LIMIT 1');
$mysqli->query('UPDATE `ammunition_users` SET `'.$tip_production.'` = '.($ammunition_users[''.$tip_production.'']+$col).' WHERE `id` = '.$ammunition_users['id'].' LIMIT 1');
####################################################################################
$res = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `id_miss` = "7" and `prog` < "10" limit 1');
$miss = $res->fetch_assoc();
if($miss['prog']<$miss['prog_max'] and $miss['time']<time()){
$mysqli->query('UPDATE `missions_user` SET `prog` = `prog` + "'.$col.'" WHERE `user` = '.$user['id'].' and `id_miss` = "7" and `prog` < "10" and `time` < "'.time().'" limit 1');
if($miss['prog']>=($miss['prog_max']-$col) and $miss['time']<time()){$_SESSION['miss'] = 1;}
}
####################################################################################

####################################################################################
if($traning['rang']>=3 and $user['level']>=7){
$res = $mysqli->query('SELECT * FROM `missions_user` WHERE `user` = '.$user['id'].' and `id_miss` = "23" and `prog` < "50" limit 1');
$miss = $res->fetch_assoc();
if($miss['prog']<$miss['prog_max'] and $miss['time']<time()){
$mysqli->query('UPDATE `missions_user` SET `prog` = `prog` + "'.$col.'" WHERE `user` = '.$user['id'].' and `id_miss` = "23" and `prog` < "50" and `time` < "'.time().'" limit 1');
if($miss['prog']>=($miss['prog_max']-$col) and $miss['time']<time()){$_SESSION['miss'] = 1;}
}
}
####################################################################################

}
if($build['tip']==3){
if($build['tip_production']==1){$tip_production = 'repairkit';$tip_ = 'rem';if($build['level']==1){$time_1 = 60;$col1 = 1;}if($build['level']==2){$time_1 = 60;$col1 = 1;}if($build['level']==3){$time_1 = 60;$col1 = 1;}if($build['level']==4){$time_1 = 60;$col1 = 1;}if($build['level']==5){$time_1 = 55;$col1 = 1;}if($build['level']==6){$time_1 = 55;$col1 = 2;}if($build['level']==7){$time_1 = 55;$col1 = 2;}if($build['level']==8){$time_1 = 55;$col1 = 2;}if($build['level']==9){$time_1 = 55;$col1 = 2;}if($build['level']==10){$time_1 = 55;$col1 = 2;}if($build['level']==11){$time_1 = 50;$col1 = 3;}if($build['level']==12){$time_1 = 50;$col1 = 3;}if($build['level']==13){$time_1 = 50;$col1 = 3;}if($build['level']==14){$time_1 = 50;$col1 = 3;}if($build['level']==15){$time_1 = 45;$col1 = 3;}if($build['level']==16){$time_1 = 45;$col1 = 4;}if($build['level']==17){$time_1 = 45;$col1 = 4;}if($build['level']==18){$time_1 = 45;$col1 = 4;}if($build['level']==19){$time_1 = 45;$col1 = 4;}if($build['level']==20){$time_1 = 40;$col1 = 4;}}
if($build['tip_production']==2){$tip_production = 'HollowCharge';$tip_ = 'k';if($build['level']==2){$time_1 = 60;$col1 = 1;}if($build['level']==3){$time_1 = 60;$col1 = 1;}if($build['level']==4){$time_1 = 60;$col1 = 1;}if($build['level']==5){$time_1 = 55;$col1 = 1;}if($build['level']==6){$time_1 = 55;$col1 = 2;}if($build['level']==7){$time_1 = 55;$col1 = 2;}if($build['level']==8){$time_1 = 55;$col1 = 2;}if($build['level']==9){$time_1 = 55;$col1 = 2;}if($build['level']==10){$time_1 = 50;$col1 = 2;}if($build['level']==11){$time_1 = 50;$col1 = 2;}if($build['level']==12){$time_1 = 50;$col1 = 3;}if($build['level']==13){$time_1 = 50;$col1 = 3;}if($build['level']==14){$time_1 = 50;$col1 = 3;}if($build['level']==15){$time_1 = 45;$col1 = 3;}if($build['level']==16){$time_1 = 45;$col1 = 3;}if($build['level']==17){$time_1 = 45;$col1 = 4;}if($build['level']==18){$time_1 = 45;$col1 = 4;}if($build['level']==19){$time_1 = 45;$col1 = 4;}if($build['level']==20){$time_1 = 40;$col1 = 4;}}
if($build['tip_production']==3){$tip_production = 'HighExplosive';$tip_ = 'f';if($build['level']==3){$time_1 = 60;$col1 = 1;}if($build['level']==4){$time_1 = 60;$col1 = 1;}if($build['level']==5){$time_1 = 55;$col1 = 1;}if($build['level']==6){$time_1 = 55;$col1 = 1;}if($build['level']==7){$time_1 = 55;$col1 = 1;}if($build['level']==8){$time_1 = 55;$col1 = 2;}if($build['level']==9){$time_1 = 55;$col1 = 2;}if($build['level']==10){$time_1 = 50;$col1 = 2;}if($build['level']==11){$time_1 = 50;$col1 = 2;}if($build['level']==12){$time_1 = 50;$col1 = 2;}if($build['level']==13){$time_1 = 50;$col1 = 3;}if($build['level']==14){$time_1 = 45;$col1 = 3;}if($build['level']==15){$time_1 = 45;$col1 = 3;}if($build['level']==16){$time_1 = 45;$col1 = 3;}if($build['level']==17){$time_1 = 45;$col1 = 3;}if($build['level']==18){$time_1 = 45;$col1 = 3;}if($build['level']==19){$time_1 = 45;$col1 = 4;}if($build['level']==20){$time_1 = 40;$col1 = 4;}}
if($build['tip_production']==4){$tip_production = 'ArmorPiercing';$tip_ = 'b';if($build['level']==4){$time_1 = 60;$col1 = 1;}if($build['level']==5){$time_1 = 55;$col1 = 1;}if($build['level']==6){$time_1 = 55;$col1 = 1;}if($build['level']==7){$time_1 = 55;$col1 = 1;}if($build['level']==8){$time_1 = 55;$col1 = 1;}if($build['level']==9){$time_1 = 55;$col1 = 2;}if($build['level']==10){$time_1 = 50;$col1 = 2;}if($build['level']==11){$time_1 = 50;$col1 = 2;}if($build['level']==12){$time_1 = 50;$col1 = 2;}if($build['level']==13){$time_1 = 50;$col1 = 2;}if($build['level']==14){$time_1 = 50;$col1 = 3;}if($build['level']==15){$time_1 = 45;$col1 = 3;}if($build['level']==16){$time_1 = 45;$col1 = 3;}if($build['level']==17){$time_1 = 45;$col1 = 3;}if($build['level']==18){$time_1 = 45;$col1 = 4;}if($build['level']==19){$time_1 = 45;$col1 = 4;}if($build['level']==20){$time_1 = 40;$col1 = 4;}}
$mysqli->query('UPDATE `buildings_user` SET `tip_production` = "0", `time_production` = "0" WHERE `id` = '.$build['id'].' LIMIT 1');
$mysqli->query('UPDATE `ammunition_users` SET `'.$tip_.'` = '.($ammunition_users[''.$tip_.'']+$col1).' WHERE `id` = '.$ammunition_users['id'].' LIMIT 1');
}
if($build['tip']==4){
if($build['tip_production']==1){if($build['level']==1){$col1 = 2;}if($build['level']==2){$col1 = 2;}if($build['level']==3){$col1 = 4;}if($build['level']==4){$col1 = 4;}if($build['level']==5){$col1 = 6;}if($build['level']==6){$col1 = 6;}if($build['level']==7){$col1 = 9;}if($build['level']==8){$col1 = 9;}if($build['level']==9){$col1 = 11;}if($build['level']==10){$col1 = 11;}if($build['level']==11){$col1 = 13;}if($build['level']==12){$col1 = 13;}if($build['level']==13){$col1 = 15;}if($build['level']==14){$col1 = 15;}if($build['level']==15){$col1 = 18;}if($build['level']==16){$col1 = 20;}if($build['level']==17){$col1 = 20;}if($build['level']==18){$col1 = 20;}if($build['level']==19){$col1 = 23;}if($build['level']==20){$col1 = 23;}}
if($build['tip_production']==2){if($build['level']==2){$col1 = 5;}if($build['level']==3){$col1 = 5;}if($build['level']==4){$col1 = 9;}if($build['level']==5){$col1 = 9;}if($build['level']==6){$col1 = 13;}if($build['level']==7){$col1 = 13;}if($build['level']==8){$col1 = 17;}if($build['level']==9){$col1 = 17;}if($build['level']==10){$col1 = 20;}if($build['level']==11){$col1 = 20;}if($build['level']==12){$col1 = 22;}if($build['level']==13){$col1 = 22;}if($build['level']==14){$col1 = 30;}if($build['level']==15){$col1 = 30;}if($build['level']==16){$col1 = 30;}if($build['level']==17){$col1 = 38;}if($build['level']==18){$col1 = 42;}if($build['level']==19){$col1 = 42;}if($build['level']==20){$col1 = 45;}}
$mysqli->query('UPDATE `buildings_user` SET `tip_production` = "0", `time_production` = "0" WHERE `id` = '.$build['id'].' LIMIT 1');
$mysqli->query('UPDATE `users` SET `silver` = '.($user['silver']+$col1).' WHERE `id` = '.$user['id'].' LIMIT 1');
}


header('Location: /production/'.$build['id'].'/');
exit();
}





















if($build['build_time']>0 and $build['build_time']<=time()){$lvl = ($build['level']+1);}else{$lvl = $build['level'];}
echo '<div class="trnt-block"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl w100">
<div class="thumb fl"><img src="/images/building/'.$build['tip'].'.jpg" alt="" style="width:100%; border-radius: 10px;"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">'.$buildings_['name'].' - '.$lvl.'</span><br>'.$buildings_['text'].'<br></div>
<div class="clrb"></div></div><div class="bot"><table><tbody><tr>';

if($buildings_['level']>$user['level']){
echo '<span class="simple-but gray border"><span><span>Требуется '.$buildings_['level'].' уровень</span></span></span>';
}else{



if($build['level']==0){
if($build['build_time']>time()){
echo '<table class="rblock mt5 esmall"><tbody><tr>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.($prog).'%;">&nbsp;</div><div class="mask">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'._time($build['build_time']-time()).'</span></span></span></div></td>
</tr></tbody></table>';
if($build['faste_build_time']>time()){
echo '<td style="width:50%;padding-right:1px;"><div style="position:relative;">';
echo '<a class="simple-but border" href="?speed_'.$build['tip'].'_'.$build['level'].'"><span><span>Ускорить за <img title="Золото" alt="Золото" src="/images/icons/gold.png?1"> 20</span></span></a>';
echo '</div></td>';
}else{
echo '<td style="width:50%;padding-right:1px;"><div style="position:relative;">';
echo '<a class="simple-but border" href="?speed_'.$build['tip'].'_'.$build['level'].'"><span><span>Ускорить бесплатно</span></span></a>';
echo '<span class="digit esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span>';
echo '</div></td>';
}
}elseif($build['build_time']==0){
echo '<td style="width:50%;padding-right:1px;"><div style="position:relative;">';
echo '<a class="simple-but border" href="?app_build_'.$build['tip'].'"><span><span>Построить</span></span></a>';
echo '</div></td>';
}elseif($build['build_time']<time() and $build['build_time']>0){
if($build['tip']!=5){
echo '<td style="width:50%;padding-right:1px;"><div style="position:relative;">';
echo '<a class="simple-but border" href="/production/'.$build['id'].'/"><span><span>Производство</span></span></a>';
echo '<span class="digit esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span>';
echo '</div></td>';
if($build['level']<$max_level){
echo '<td style="width:50%;padding-right:1px;"><div style="position:relative;">';
echo '<a class="simple-but border" href="?app_build_'.$build['tip'].'"><span><span>Улучшить</span></span></a>';
echo '</div></td>';
}
}else{
echo '<td style="width:50%;padding-right:1px;"><div style="position:relative;">';
echo '<a class="simple-but border" href="/production/'.$build['id'].'/"><span><span>Подробности</span></span></a>';
echo '</div></td>';
}
}





}else{






if($build['build_time']>time()){
echo '<table class="rblock mt5 esmall"><tbody><tr>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.($prog).'%;">&nbsp;</div><div class="mask">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'._time($build['build_time']-time()).'</span></span></span></div></td>
</tr></tbody></table>';
if($build['faste_build_time']>time()){
echo '<td style="width:50%;padding-right:1px;"><div style="position:relative;">';
echo '<a class="simple-but border" href="?speed_'.$build['tip'].'_'.$build['level'].'"><span><span>Ускорить за <img title="Золото" alt="Золото" src="/images/icons/gold.png?1"> 20</span></span></a>';
echo '</div></td>';
}else{
echo '<td style="width:50%;padding-right:1px;"><div style="position:relative;">';
echo '<a class="simple-but border" href="?speed_'.$build['tip'].'_'.$build['level'].'"><span><span>Ускорить бесплатно</span></span></a>';
echo '<span class="digit esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span>';
echo '</div></td>';
}
}else{




if($build['time_production']==0 and $build['tip_production']==0){
if($build['tip']!=5 and $build['tip']!=7){
echo '<td style="width:50%;padding-right:1px;"><div style="position:relative;">';
echo '<a class="simple-but border" href="/production/'.$build['id'].'/"><span><span>Производство</span></span></a>';
echo '<span class="digit esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span>';
echo '</div></td>';
}elseif($build['tip']==6){
echo '<td style="width:50%;padding-right:1px;"><div style="position:relative;">';
echo '<a class="simple-but border" href="/production/'.$build['id'].'/"><span><span>Обмен</span></span></a>';
echo '<span class="digit esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span>';
echo '</div></td>';
}else{
echo '<td style="width:50%;padding-right:1px;"><div style="position:relative;">';
echo '<a class="simple-but border" href="/production/'.$build['id'].'/"><span><span>Подробности</span></span></a>';
echo '</div></td>';
}
if($build['level']<$max_level){
echo '<td style="width:50%;padding-right:1px;"><div style="position:relative;">';
echo '<a class="simple-but border" href="?app_build_'.$build['tip'].'"><span><span>Улучшить</span></span></a>';
echo '</div></td>';
}
}elseif($build['time_production']>time()){
if($build['tip']==1){
if($build['tip_production']==1){$tip_production = 'ore';if($build['level']==1){$col = 1;}if($build['level']==2){$col = 1;}if($build['level']==3){$col = 2;}if($build['level']==4){$col = 2;}if($build['level']==5){$col = 2;}if($build['level']==6){$col = 2;}if($build['level']==7){$col = 3;}if($build['level']==8){$col = 3;}if($build['level']==9){$col = 3;}if($build['level']==10){$col = 3;}if($build['level']==11){$col = 3;}if($build['level']==12){$col = 3;}if($build['level']==13){$col = 3;}if($build['level']==14){$col = 6;}if($build['level']==15){$col = 6;}if($build['level']==16){$col = 6;}if($build['level']==17){$col = 6;}if($build['level']==18){$col = 6;}if($build['level']==19){$col = 6;}if($build['level']==20){$col = 6;}}
if($build['tip_production']==2){$tip_production = 'iron';if($build['level']==1){$col = 0;}if($build['level']==2){$col = 0;}if($build['level']==3){$col = 0;}if($build['level']==4){$col = 0;}if($build['level']==5){$col = 1;}if($build['level']==6){$col = 1;}if($build['level']==7){$col = 1;}if($build['level']==8){$col = 1;}if($build['level']==9){$col = 1;}if($build['level']==10){$col = 1;}if($build['level']==11){$col = 2;}if($build['level']==12){$col = 2;}if($build['level']==13){$col = 2;}if($build['level']==14){$col = 2;}if($build['level']==15){$col = 2;}if($build['level']==16){$col = 2;}if($build['level']==17){$col = 2;}if($build['level']==18){$col = 2;}if($build['level']==19){$col = 5;}if($build['level']==20){$col = 5;}}
if($build['tip_production']==3){$tip_production = 'steel';if($build['level']==1){$col = 0;}if($build['level']==2){$col = 0;}if($build['level']==3){$col = 0;}if($build['level']==4){$col = 0;}if($build['level']==5){$col = 0;}if($build['level']==6){$col = 0;}if($build['level']==7){$col = 0;}if($build['level']==8){$col = 0;}if($build['level']==9){$col = 0;}if($build['level']==10){$col = 1;}if($build['level']==11){$col = 1;}if($build['level']==12){$col = 1;}if($build['level']==13){$col = 1;}if($build['level']==14){$col = 1;}if($build['level']==15){$col = 1;}if($build['level']==16){$col = 1;}if($build['level']==17){$col = 2;}if($build['level']==18){$col = 2;}if($build['level']==19){$col = 2;}if($build['level']==20){$col = 2;}}
if($build['tip_production']==4){$tip_production = 'plumbum';if($build['level']==1){$col = 0;}if($build['level']==2){$col = 0;}if($build['level']==3){$col = 0;}if($build['level']==4){$col = 0;}if($build['level']==5){$col = 0;}if($build['level']==6){$col = 0;}if($build['level']==7){$col = 0;}if($build['level']==8){$col = 0;}if($build['level']==9){$col = 0;}if($build['level']==10){$col = 0;}if($build['level']==11){$col = 0;}if($build['level']==12){$col = 0;}if($build['level']==13){$col = 0;}if($build['level']==14){$col = 0;}if($build['level']==15){$col = 1;}if($build['level']==16){$col = 1;}if($build['level']==17){$col = 1;}if($build['level']==18){$col = 1;}if($build['level']==19){$col = 1;}if($build['level']==20){$col = 1;}}
echo '<table class="rblock blue esmall"><tbody><tr>
<td><div class="value-block lh1"><span><span><img height="14" width="14" src="/images/icons/'.$tip_production.'.png"> '.$col.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.($prog).'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'._time($build['time_production']-time()).'</span></span></div></td>
</tr></tbody></table>';
echo '<table class="rblock mt10 esmall"><tbody><tr></tr></tbody></table>';
}
if($build['tip']==3){
if($build['tip_production']==1){$tip_production = 'repairkit';if($build['level']==1){$time_1 = 60;$col1 = 1;}if($build['level']==2){$time_1 = 60;$col1 = 1;}if($build['level']==3){$time_1 = 60;$col1 = 1;}if($build['level']==4){$time_1 = 60;$col1 = 1;}if($build['level']==5){$time_1 = 55;$col1 = 1;}if($build['level']==6){$time_1 = 55;$col1 = 2;}if($build['level']==7){$time_1 = 55;$col1 = 2;}if($build['level']==8){$time_1 = 55;$col1 = 2;}if($build['level']==9){$time_1 = 55;$col1 = 2;}if($build['level']==10){$time_1 = 55;$col1 = 2;}if($build['level']==11){$time_1 = 50;$col1 = 3;}if($build['level']==12){$time_1 = 50;$col1 = 3;}if($build['level']==13){$time_1 = 50;$col1 = 3;}if($build['level']==14){$time_1 = 50;$col1 = 3;}if($build['level']==15){$time_1 = 45;$col1 = 3;}if($build['level']==16){$time_1 = 45;$col1 = 4;}if($build['level']==17){$time_1 = 45;$col1 = 4;}if($build['level']==18){$time_1 = 45;$col1 = 4;}if($build['level']==19){$time_1 = 45;$col1 = 4;}if($build['level']==20){$time_1 = 40;$col1 = 4;}}
if($build['tip_production']==2){$tip_production = 'HollowCharge';if($build['level']==2){$time_1 = 60;$col1 = 1;}if($build['level']==3){$time_1 = 60;$col1 = 1;}if($build['level']==4){$time_1 = 60;$col1 = 1;}if($build['level']==5){$time_1 = 55;$col1 = 1;}if($build['level']==6){$time_1 = 55;$col1 = 2;}if($build['level']==7){$time_1 = 55;$col1 = 2;}if($build['level']==8){$time_1 = 55;$col1 = 2;}if($build['level']==9){$time_1 = 55;$col1 = 2;}if($build['level']==10){$time_1 = 50;$col1 = 2;}if($build['level']==11){$time_1 = 50;$col1 = 2;}if($build['level']==12){$time_1 = 50;$col1 = 3;}if($build['level']==13){$time_1 = 50;$col1 = 3;}if($build['level']==14){$time_1 = 50;$col1 = 3;}if($build['level']==15){$time_1 = 45;$col1 = 3;}if($build['level']==16){$time_1 = 45;$col1 = 3;}if($build['level']==17){$time_1 = 45;$col1 = 4;}if($build['level']==18){$time_1 = 45;$col1 = 4;}if($build['level']==19){$time_1 = 45;$col1 = 4;}if($build['level']==20){$time_1 = 40;$col1 = 4;}}
if($build['tip_production']==3){$tip_production = 'HighExplosive';if($build['level']==3){$time_1 = 60;$col1 = 1;}if($build['level']==4){$time_1 = 60;$col1 = 1;}if($build['level']==5){$time_1 = 55;$col1 = 1;}if($build['level']==6){$time_1 = 55;$col1 = 1;}if($build['level']==7){$time_1 = 55;$col1 = 1;}if($build['level']==8){$time_1 = 55;$col1 = 2;}if($build['level']==9){$time_1 = 55;$col1 = 2;}if($build['level']==10){$time_1 = 50;$col1 = 2;}if($build['level']==11){$time_1 = 50;$col1 = 2;}if($build['level']==12){$time_1 = 50;$col1 = 2;}if($build['level']==13){$time_1 = 50;$col1 = 3;}if($build['level']==14){$time_1 = 45;$col1 = 3;}if($build['level']==15){$time_1 = 45;$col1 = 3;}if($build['level']==16){$time_1 = 45;$col1 = 3;}if($build['level']==17){$time_1 = 45;$col1 = 3;}if($build['level']==18){$time_1 = 45;$col1 = 3;}if($build['level']==19){$time_1 = 45;$col1 = 4;}if($build['level']==20){$time_1 = 40;$col1 = 4;}}
if($build['tip_production']==4){$tip_production = 'ArmorPiercing';if($build['level']==4){$time_1 = 60;$col1 = 1;}if($build['level']==5){$time_1 = 55;$col1 = 1;}if($build['level']==6){$time_1 = 55;$col1 = 1;}if($build['level']==7){$time_1 = 55;$col1 = 1;}if($build['level']==8){$time_1 = 55;$col1 = 1;}if($build['level']==9){$time_1 = 55;$col1 = 2;}if($build['level']==10){$time_1 = 50;$col1 = 2;}if($build['level']==11){$time_1 = 50;$col1 = 2;}if($build['level']==12){$time_1 = 50;$col1 = 2;}if($build['level']==13){$time_1 = 50;$col1 = 2;}if($build['level']==14){$time_1 = 50;$col1 = 3;}if($build['level']==15){$time_1 = 45;$col1 = 3;}if($build['level']==16){$time_1 = 45;$col1 = 3;}if($build['level']==17){$time_1 = 45;$col1 = 3;}if($build['level']==18){$time_1 = 45;$col1 = 4;}if($build['level']==19){$time_1 = 45;$col1 = 4;}if($build['level']==20){$time_1 = 40;$col1 = 4;}}
echo '<table class="rblock blue esmall"><tbody><tr>
<td><div class="value-block lh1"><span><span><img height="14" width="14" src="/images/shells/'.$tip_production.'.png"> '.$col1.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.($prog).'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'._time($build['time_production']-time()).'</span></span></div></td>
</tr></tbody></table>';
echo '<table class="rblock mt10 esmall"><tbody><tr></tr></tbody></table>';
}
if($build['tip']==4){
if($build['tip_production']==1){if($build['level']==1){$col1 = 2;}if($build['level']==2){$col1 = 2;}if($build['level']==3){$col1 = 4;}if($build['level']==4){$col1 = 4;}if($build['level']==5){$col1 = 6;}if($build['level']==6){$col1 = 6;}if($build['level']==7){$col1 = 9;}if($build['level']==8){$col1 = 9;}if($build['level']==9){$col1 = 11;}if($build['level']==10){$col1 = 11;}if($build['level']==11){$col1 = 13;}if($build['level']==12){$col1 = 13;}if($build['level']==13){$col1 = 15;}if($build['level']==14){$col1 = 15;}if($build['level']==15){$col1 = 18;}if($build['level']==16){$col1 = 20;}if($build['level']==17){$col1 = 20;}if($build['level']==18){$col1 = 20;}if($build['level']==19){$col1 = 23;}if($build['level']==20){$col1 = 23;}}
if($build['tip_production']==2){if($build['level']==2){$col1 = 5;}if($build['level']==3){$col1 = 5;}if($build['level']==4){$col1 = 9;}if($build['level']==5){$col1 = 9;}if($build['level']==6){$col1 = 13;}if($build['level']==7){$col1 = 13;}if($build['level']==8){$col1 = 17;}if($build['level']==9){$col1 = 17;}if($build['level']==10){$col1 = 20;}if($build['level']==11){$col1 = 20;}if($build['level']==12){$col1 = 22;}if($build['level']==13){$col1 = 22;}if($build['level']==14){$col1 = 30;}if($build['level']==15){$col1 = 30;}if($build['level']==16){$col1 = 30;}if($build['level']==17){$col1 = 38;}if($build['level']==18){$col1 = 42;}if($build['level']==19){$col1 = 42;}if($build['level']==20){$col1 = 45;}}
echo '<table class="rblock blue esmall"><tbody><tr>
<td><div class="value-block lh1"><span><span><img height="14" width="14" src="/images/icons/silver.png"> '.$col1.'</span></span></div></td>
<td class="progr"><div class="scale-block"><div class="scale" style="width:'.($prog).'%;">&nbsp;</div></div></td>
<td><div class="value-block lh1"><span><span>'._time($build['time_production']-time()).'</span></span></div></td>
</tr></tbody></table>';
echo '<table class="rblock mt10 esmall"><tbody><tr></tr></tbody></table>';
}
if($build['tip']==6){
echo '<td style="width:50%;padding-right:1px;"><div style="position:relative;">';
echo '<a class="simple-but border" href="/production/'.$build['id'].'/"><span><span>Обмен</span></span></a>';
echo '</div></td>';
if($build['level']<$max_level){
echo '<td style="width:50%;padding-right:1px;"><div style="position:relative;">';
echo '<a class="simple-but border" href="?app_build_'.$build['tip'].'"><span><span>Улучшить</span></span></a>';
echo '</div></td>';
}
}
if($build['tip']==2){
echo '<td style="width:50%;padding-right:1px;"><div style="position:relative;">';
echo '<a class="simple-but border" href="/production/'.$build['id'].'/"><span><span>Производство</span></span></a>';
echo '</div></td>';
/* if($build['level']<$max_level){
echo '<td style="width:50%;padding-right:1px;"><div style="position:relative;">';
echo '<a class="simple-but border" href="?app_build_'.$build['tip'].'"><span><span>Улучшить</span></span></a>';
echo '</div></td>';
} */
}
}elseif($build['time_production']<time()){
if($build['tip']==2){
echo '<td style="width:50%;padding-right:1px;"><div style="position:relative;">';
echo '<a class="simple-but border" href="/production/'.$build['id'].'/"><span><span>Производство</span></span></a>';
echo '<span class="digit esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span>';
echo '</div></td>';
if($build['level']<$max_level){
echo '<td style="width:50%;padding-right:1px;"><div style="position:relative;">';
echo '<a class="simple-but border" href="?app_build_'.$build['tip'].'"><span><span>Улучшить</span></span></a>';
echo '</div></td>';
}
}elseif($build['tip']==6){
echo '<td style="width:50%;padding-right:1px;"><div style="position:relative;">';
echo '<a class="simple-but border" href="/production/'.$build['id'].'/"><span><span>Обмен</span></span></a>';
echo '<span class="digit esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span>';
echo '</div></td>';
if($build['level']<$max_level){
echo '<td style="width:50%;padding-right:1px;"><div style="position:relative;">';
echo '<a class="simple-but border" href="?app_build_'.$build['tip'].'"><span><span>Улучшить</span></span></a>';
echo '</div></td>';
}
}else{
if($build['tip']==7){
echo '<td style="width:50%;padding-right:1px;"><div style="position:relative;">';
echo '<a class="simple-but border" href="/production/'.$build['id'].'/"><span><span>Подробности</span></span></a>';
echo '</div></td>';
if($build['level']<$max_level){
echo '<td style="width:50%;padding-right:1px;"><div style="position:relative;">';
echo '<a class="simple-but border" href="?app_build_'.$build['tip'].'"><span><span>Улучшить</span></span></a>';
echo '</div></td>';
}
}else{
echo '<td style="width:50%;padding-right:1px;"><div style="position:relative;">';
echo '<a class="simple-but border" href="?production_'.$build['tip'].'_'.$build['level'].'"><span><span>Забрать</span></span></a>';
echo '<span class="digit esmall"><span class="l">&nbsp;</span><span class="m">+</span><span class="r">&nbsp;</span></span>';
echo '</div></td>';
}
}
}
}


}
}










echo '</tr></tbody></table></div></div></div></div></div></div></div></div></div></div></div>';
}
































$arr_text = array(
1 => "Платное ускорение строительства уменьшает время строительства на 6 часов",
2 => "Хорошо прокачанный полигон залог будущих побед. Полигон дает мощный бонус к параметрам танка",
3 => "Ресурсы нужны для постройки зданий",
4 => "Бесплатное ускорение строительства доступно раз в 30 минут. Оно уменьшает время строительства на 1 час",
5 => "Ресурсы нужны для постройки зданий <br> Железо <img src='/images/icons/iron.png'> доступно с 5 уровня шахты",
6 => "Ресурсы произведенные в шахте, можно продать построив рынок"); 
$rand_text = rand(1,6);

echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">
<div class="mt5 mb5 small green1 cntr">'.$arr_text[$rand_text].'</div>
</div></div></div></div></div></div></div></div></div></div>';
require_once ('../system/footer.php');
?>