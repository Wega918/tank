<?php
require ('../system/function.php');
require ('../system/header.php');

$mysqli->query("UPDATE `users_bonus` SET `day` = '1' WHERE `act` = '0'");
$mysqli->query("UPDATE `users_bonus` SET `day` = `day` + '1' WHERE `act` = '1' and `day` < '5'");
$mysqli->query("UPDATE `users_bonus` SET `act` = '0' WHERE `id` ");

$res = $mysqli->query('SELECT * FROM `users` WHERE `id` ORDER BY `id` asc LIMIT 100000');
while ($user = $res->fetch_array()){

$res_users_tanks = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = '.$user['id'].' and `active`  = "1" ');
$users_tanks = $res_users_tanks->fetch_assoc();

$res_tank = $mysqli->query('SELECT * FROM `tanks` WHERE `id`  = "'.$users_tanks['tip'].'" ');
$tank = $res_tank->fetch_assoc();

##################################
$res_a = mysqli_query($mysqli,'SELECT sum(sposobn) FROM crew_user WHERE `user`  = "'.$user['id'].'" and `tip` >= "5" and `tip` <= "6" ');
if (FALSE === $res_a) die("Select sum failed: ".mysqli_error);
$row = mysqli_fetch_row($res_a);
$crew_sum_a = $row[0];

$res_b = mysqli_query($mysqli,'SELECT sum(sposobn) FROM crew_user WHERE `user`  = "'.$user['id'].'" and `tip` >= "7" and `tip` <= "8" ');
if (FALSE === $res_b) die("Select sum failed: ".mysqli_error);
$row = mysqli_fetch_row($res_b);
$crew_sum_b = $row[0];

$res_t = mysqli_query($mysqli,'SELECT sum(sposobn) FROM crew_user WHERE `user`  = "'.$user['id'].'" and `tip` >= "3" and `tip` <= "4" ');
if (FALSE === $res_t) die("Select sum failed: ".mysqli_error);
$row = mysqli_fetch_row($res_t);
$crew_sum_t = $row[0];

$res_p = mysqli_query($mysqli,'SELECT sum(sposobn) FROM crew_user WHERE `user`  = "'.$user['id'].'" and `tip` >= "9" and `tip` <= "10" ');
if (FALSE === $res_p) die("Select sum failed: ".mysqli_error);
$row = mysqli_fetch_row($res_p);
$crew_sum_p = $row[0];
##################################


##################################
$res_traning = $mysqli->query('SELECT * FROM `traning` WHERE `user`  = "'.$user['id'].'" ');
$traning = $res_traning->fetch_assoc();
##################################


$res_users_tanks_new = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = '.$user['id'].' and `tip`  = "'.$tank['id'].'" ');
$users_tanks_new = $res_users_tanks_new->fetch_assoc();







$res_users_tanks_modification = $mysqli->query('SELECT * FROM `users_tanks_modification` WHERE `user` = '.$user['id'].' and `id_tank` = '.$tank['id'].' ');
$users_tanks_modification = $res_users_tanks_modification->fetch_assoc();

$res_users_tanks_pimp = $mysqli->query('SELECT * FROM `users_tanks_pimp` WHERE `user` = '.$user['id'].' and `tip_tank` = '.$tank['tip'].' ');
$users_tanks_pimp = $res_users_tanks_pimp->fetch_assoc();

$res_users_tanks_upgrade = $mysqli->query('SELECT * FROM `users_tanks_upgrade` WHERE `user` = '.$user['id'].' and `tip_tank` = '.$tank['tip'].' ');
$users_tanks_upgrade = $res_users_tanks_upgrade->fetch_assoc();

$res_b_p = $mysqli->query('SELECT * FROM `buildings_polygon` WHERE `user` = '.$user['id'].' ');
$b_p = $res_b_p->fetch_assoc();



$res1 = $mysqli->query('SELECT * FROM `vip` WHERE `user` = "'.$user['id'].'" ');
$vip = $res1->fetch_assoc();
if($vip['time1']>time()){$v_p = 100;}elsE{$v_p = 0;}




$res_company = $mysqli->query('SELECT * FROM `company` WHERE `id` = '.$user['company'].' ');
$company = $res_company->fetch_assoc();

if($user['company']){
$res_company_user = $mysqli->query('SELECT * FROM `company_user` WHERE `user` = '.$user['id'].' and `company` = '.$company['id'].' ');
$company_user = $res_company_user->fetch_assoc();
}

if($user['company']>0){
if($company['shtab_param']>0){$shtab_param = $company['shtab_param'];}else{$shtab_param = 0;}
if($company['polygon_time']>time()){$polygon_param = 40;}else{$polygon_param = 0;}
if($company_user['polygon_time']>time()){$us_polygon_param = 40;}else{$us_polygon_param = 0;}
}else{
$polygon_param = 0;
$us_polygon_param = 0;
}


if(!$users_tanks_new){
$res_col_tip_tank_1 = $mysqli->query("SELECT COUNT(*) FROM `users_tanks` WHERE `user` = '".$user['id']."' and `tip_tank` = '1' ");
$col_tip_tank_1 = $res_col_tip_tank_1->fetch_array(MYSQLI_NUM);

$res_col_tip_tank_2 = $mysqli->query("SELECT COUNT(*) FROM `users_tanks` WHERE `user` = '".$user['id']."' and `tip_tank` = '2' ");
$col_tip_tank_2 = $res_col_tip_tank_2->fetch_array(MYSQLI_NUM);

$res_col_tip_tank_3 = $mysqli->query("SELECT COUNT(*) FROM `users_tanks` WHERE `user` = '".$user['id']."' and `tip_tank` = '3' ");
$col_tip_tank_3 = $res_col_tip_tank_3->fetch_array(MYSQLI_NUM);

if(($tank['tip']==1 and $col_tip_tank_1[0]>0) or ($tank['tip']==2 and $col_tip_tank_2[0]>0) or ($tank['tip']==3 and $col_tip_tank_3[0]>0)){
$param_a = $tank['a']+$crew_sum_a+$traning['a_level']+$users_tanks_pimp['a']+$users_tanks_upgrade['a']+($user['level']-1)+$shtab_param+$polygon_param+$us_polygon_param+$b_p['a']+$v_p;
$param_b = $tank['b']+$crew_sum_b+$traning['b_level']+$users_tanks_pimp['b']+$users_tanks_upgrade['b']+($user['level']-1)+$shtab_param+$polygon_param+$us_polygon_param+$b_p['b']+$v_p;
$param_t = $tank['t']+$crew_sum_t+$traning['t_level']+$users_tanks_pimp['t']+$users_tanks_upgrade['t']+($user['level']-1)+$shtab_param+$polygon_param+$us_polygon_param+$b_p['t']+$v_p;
$param_p = $tank['p']+$crew_sum_p+$traning['p_level']+$users_tanks_pimp['p']+$users_tanks_upgrade['p']+($user['level']-1)+$shtab_param+$polygon_param+$us_polygon_param+$b_p['p']+$v_p;
}else{
$param_a = $tank['a']+$crew_sum_a+$traning['a_level']+($user['level']-1)+$shtab_param+$polygon_param+$us_polygon_param+$b_p['a']+$v_p;
$param_b = $tank['b']+$crew_sum_b+$traning['b_level']+($user['level']-1)+$shtab_param+$polygon_param+$us_polygon_param+$b_p['b']+$v_p;
$param_t = $tank['t']+$crew_sum_t+$traning['t_level']+($user['level']-1)+$shtab_param+$polygon_param+$us_polygon_param+$b_p['t']+$v_p;
$param_p = $tank['p']+$crew_sum_p+$traning['p_level']+($user['level']-1)+$shtab_param+$polygon_param+$us_polygon_param+$b_p['p']+$v_p;
}



}else{
$res_col_tip_tank_1 = $mysqli->query("SELECT COUNT(*) FROM `users_tanks` WHERE `user` = '".$user['id']."' and `tip_tank` = '1' ");
$col_tip_tank_1 = $res_col_tip_tank_1->fetch_array(MYSQLI_NUM);

$res_col_tip_tank_2 = $mysqli->query("SELECT COUNT(*) FROM `users_tanks` WHERE `user` = '".$user['id']."' and `tip_tank` = '2' ");
$col_tip_tank_2 = $res_col_tip_tank_2->fetch_array(MYSQLI_NUM);

$res_col_tip_tank_3 = $mysqli->query("SELECT COUNT(*) FROM `users_tanks` WHERE `user` = '".$user['id']."' and `tip_tank` = '3' ");
$col_tip_tank_3 = $res_col_tip_tank_3->fetch_array(MYSQLI_NUM);

if(($tank['tip']==1 and $col_tip_tank_1[0]>0) or ($tank['tip']==2 and $col_tip_tank_2[0]>0) or ($tank['tip']==3 and $col_tip_tank_3[0]>0)){//echo '2.1';
$param_a = $tank['a']+$crew_sum_a+$traning['a_level']+$users_tanks_modification['a']+$users_tanks_pimp['a']+$users_tanks_upgrade['a']+($user['level']-1)+$shtab_param+$polygon_param+$us_polygon_param+$b_p['a']+$v_p;
$param_b = $tank['b']+$crew_sum_b+$traning['b_level']+$users_tanks_modification['b']+$users_tanks_pimp['b']+$users_tanks_upgrade['b']+($user['level']-1)+$shtab_param+$polygon_param+$us_polygon_param+$b_p['b']+$v_p;
$param_t = $tank['t']+$crew_sum_t+$traning['t_level']+$users_tanks_modification['t']+$users_tanks_pimp['t']+$users_tanks_upgrade['t']+($user['level']-1)+$shtab_param+$polygon_param+$us_polygon_param+$b_p['t']+$v_p;
$param_p = $tank['p']+$crew_sum_p+$traning['p_level']+$users_tanks_modification['p']+$users_tanks_pimp['p']+$users_tanks_upgrade['p']+($user['level']-1)+$shtab_param+$polygon_param+$us_polygon_param+$b_p['p']+$v_p;
}else{//echo '2.2';
$param_a = $tank['a']+$crew_sum_a+$traning['a_level']+($user['level']-1)+$shtab_param+$polygon_param+$us_polygon_param+$b_p['a']+$v_p;
$param_b = $tank['b']+$crew_sum_b+$traning['b_level']+($user['level']-1)+$shtab_param+$polygon_param+$us_polygon_param+$b_p['b']+$v_p;
$param_t = $tank['t']+$crew_sum_t+$traning['t_level']+($user['level']-1)+$shtab_param+$polygon_param+$us_polygon_param+$b_p['t']+$v_p;
$param_p = $tank['p']+$crew_sum_p+$traning['p_level']+($user['level']-1)+$shtab_param+$polygon_param+$us_polygon_param+$b_p['p']+$v_p;
}
}

$sum_param = $param_a+$param_b+$param_t+$param_p;

if($users_tanks['tip'] == $tank['id']){
if($users_tanks['a'] != $param_a or $users_tanks['b'] != $param_b or $users_tanks['t'] != $param_t or $users_tanks['p'] != $param_p){
$mysqli->query('UPDATE `users_tanks` SET `a` = '.$param_a.', `b` = '.$param_b.', `t` = '.$param_t.', `p` = '.$param_p.' WHERE `id` = '.$users_tanks['id'].'');
}
}


}






//$mysqli->query("UPDATE `users_bonus` SET `day` = '5' WHERE `id` ");

/* $res_company_zayavki = $mysqli->query('SELECT * FROM `company_zayavki` WHERE `time` >= '.time().' and `ank` = '.$user['id'].' and `company` != "0" ORDER BY `time` desc LIMIT '.$start.','.$max.' ');
while ($c_z = $res_company_zayavki->fetch_array()){
if($ussss['day_vhod'] >= 5){
$mysqli->query("UPDATE `users_bonus` SET `day` = '5' WHERE `id` = ".$ussss['id']." ");
}else{
$mysqli->query("UPDATE `users_bonus` SET `day` = `day` + '1' WHERE `id` = ".$ussss['id']." ");
}
} */
?>