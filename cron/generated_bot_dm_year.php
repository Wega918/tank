<?php
require ('../system/function.php');
require ('../system/header.php');
$res = $mysqli->query('SELECT * FROM `prom` WHERE `id` = "1" ');
$prom = $res->fetch_assoc();


if($prom['time_19']>time()){
$res = $mysqli->query('SELECT * FROM `dm_year` WHERE `id` ORDER BY `time` asc LIMIT 1');
$p = $res->fetch_assoc();

if($p['time_bot']<=time() and $p['time_dm_year']< time()){ // генерируем ботов на сражу 
# выборка юзера
$stmt = $mysqli->prepare('SELECT t.id, login FROM users as t,
            (SELECT ROUND((SELECT MAX(id) FROM users) * rand()) as rnd FROM users) tmp
            WHERE t.id >= (rnd) and `level` >= ? and `viz` <= ? and `id` not in (select user from dm_year_user)
			LIMIT 1');
$stmt->bind_param("ss", $level, $viz);
$level = 3;$viz = (time()-(86400*2));$stmt->execute();$res = $stmt->get_result();$rnd_us = $res->fetch_assoc();
# выборка противника юзеру
$stmt_g = $mysqli->prepare('SELECT t.id FROM dm_year_user as t,
            (SELECT ROUND((SELECT MAX(id) FROM dm_year_user) * rand()) as rnd FROM dm_year_user) tmp
            WHERE t.id >= (rnd) and `nick` != ? and `dm_year_id` = ? and `p` > ? 
			ORDER BY camouflage asc 
			LIMIT 1');
$stmt_g->bind_param("sss", $nick, $dm_year_id, $hp);
$nick = $rnd_us['login'];$dm_year_id = $p['dm_year_id'];$hp = 0;$stmt_g->execute();$res = $stmt_g->get_result();$goal = $res->fetch_assoc(); 
if($rnd_us){
$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = '.$rnd_us['id'].' and `active`  = "1" LIMIT 1');
$u_t = $res->fetch_assoc();
$res = $mysqli->query('SELECT * FROM `tanks` WHERE `id`  = "'.$u_t['tip'].'" LIMIT 1');
$tank = $res->fetch_assoc();
$res_s1 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "1" and `user`  = "'.$rnd_us['id'].'" ');
$skills_1 = $res_s1->fetch_assoc();if(!$skills_1){$skills_1['bon'] = 0;} // маскировка
$res_s2 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "2" and `user`  = "'.$rnd_us['id'].'" ');
$skills_2 = $res_s2->fetch_assoc();if(!$skills_2){$skills_2['bon'] = 0;} // рикошет
$res_s3 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "3" and `user`  = "'.$rnd_us['id'].'" ');
$skills_3 = $res_s3->fetch_assoc();if(!$skills_3){$skills_3['bon'] = 0;} // Слабые места
$res_s4 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "4" and `user`  = "'.$rnd_us['id'].'" ');
$skills_4 = $res_s4->fetch_assoc();if(!$skills_4){$skills_4['bon'] = 0;} // Ремонт
$res_s5 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "5" and `user`  = "'.$rnd_us['id'].'" ');
$skills_5 = $res_s5->fetch_assoc();if(!$skills_5){$skills_5['bon'] = 0;} // Снайпер
if(!$goal['id']){$goal['id'] = 0;}
$mysqli->query('INSERT INTO `dm_year_user` SET `camouflage` = "'.($skills_1['bon']+0.1).'", `ricochet` = "'.$skills_2['bon'].'", 
`weaknessdetection` = "'.$skills_3['bon'].'", `repairs` = "'.$skills_4['bon'].'", `sniper` = "'.$skills_5['bon'].'", 
`nick` = "'.$rnd_us['login'].'", `goal` = '.$goal['id'].', `tank_id` = '.$tank['id'].', 
`a` = '.($u_t['a']).', `b` = '.($u_t['b']).', `t` = '.($u_t['t']).', `p` = '.($u_t['p']*2).', `p_` = '.($u_t['p']*2).', 
`dm_year_id` = '.$p['dm_year_id'].', `user` = '.$rnd_us['id'].' ');
$mysqli->query('INSERT INTO `dm_year_results` SET `user` = "'.$rnd_us['id'].'", `nick` = "'.$rnd_us['login'].'", `dm_year_id` = "'.$p['dm_year_id'].'", `time` = "'.time().'" ');
$mysqli->query('UPDATE `dm_year` SET `time_bot` = "'.(time()+rand(30,300)).'" WHERE `id` = "'.$p['id'].'" LIMIT 1');
}
}
}
















$res = $mysqli->query('SELECT * FROM `pve` WHERE `id` ORDER BY `time` asc LIMIT 1');
$p = $res->fetch_assoc();
####################################################################################################################
if($p and $p['time_bot']<=time() and $p['time_pve']< time()){ // генерируем ботов на сражу 
# выборка юзера
$stmt = $mysqli->prepare('SELECT t.id, login FROM users as t,
            (SELECT ROUND((SELECT MAX(id) FROM users) * rand()) as rnd FROM users) tmp
            WHERE t.id >= (rnd) and `level` >= ? and `viz` <= ? and `id` not in (select user from pve_user)
			LIMIT 1');
$stmt->bind_param("ss", $level, $viz);
$level = 3;$viz = (time()-(86400*2));$stmt->execute();$res = $stmt->get_result();$rnd_us = $res->fetch_assoc();
# выборка противника юзеру
$stmt_g = $mysqli->prepare('SELECT t.id FROM pve_user as t,
            (SELECT ROUND((SELECT MAX(id) FROM pve_user) * rand()) as rnd FROM pve_user) tmp
            WHERE t.id >= (rnd) and `nick` != ? and `pve_id` = ? and `p_` > ? 
			ORDER BY camouflage asc 
			LIMIT 1');
$stmt_g->bind_param("sss", $nick, $pve_id, $hp);
$nick = $rnd_us['login'];$pve_id = $p['pve_id'];$hp = 0;$stmt_g->execute();$res = $stmt_g->get_result();$goal = $res->fetch_assoc(); 
if($rnd_us){
$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = '.$rnd_us['id'].' and `active`  = "1" LIMIT 1');
$u_t = $res->fetch_assoc();
$res = $mysqli->query('SELECT * FROM `tanks` WHERE `id`  = "'.$u_t['tip'].'" LIMIT 1');
$tank = $res->fetch_assoc();
$res_s1 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "1" and `user`  = "'.$rnd_us['id'].'" ');
$skills_1 = $res_s1->fetch_assoc();if(!$skills_1){$skills_1['bon'] = 0;} // маскировка
$res_s2 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "2" and `user`  = "'.$rnd_us['id'].'" ');
$skills_2 = $res_s2->fetch_assoc();if(!$skills_2){$skills_2['bon'] = 0;} // рикошет
$res_s3 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "3" and `user`  = "'.$rnd_us['id'].'" ');
$skills_3 = $res_s3->fetch_assoc();if(!$skills_3){$skills_3['bon'] = 0;} // Слабые места
$res_s4 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "4" and `user`  = "'.$rnd_us['id'].'" ');
$skills_4 = $res_s4->fetch_assoc();if(!$skills_4){$skills_4['bon'] = 0;} // Ремонт
$res_s5 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "5" and `user`  = "'.$rnd_us['id'].'" ');
$skills_5 = $res_s5->fetch_assoc();if(!$skills_5){$skills_5['bon'] = 0;} // Снайпер
if(!$goal['id']){$goal['id'] = 0;}
$mysqli->query('INSERT INTO `pve_user` SET `camouflage` = "'.($skills_1['bon']+0.1).'", `ricochet` = "'.$skills_2['bon'].'", 
`weaknessdetection` = "'.$skills_3['bon'].'", `repairs` = "'.$skills_4['bon'].'", `sniper` = "'.$skills_5['bon'].'", 
`nick` = "'.$rnd_us['login'].'", `goal` = '.$goal['id'].', `tank_id` = '.$tank['id'].', 
`a` = '.($u_t['a']).', `b` = '.($u_t['b']).', `t` = '.($u_t['t']).', `p` = '.($u_t['p']*2).', `p_` = '.($u_t['p']*2).', 
`bot` = "1", `pve_id` = '.$p['pve_id'].', `user` = '.$rnd_us['id'].' ');
$mysqli->query('INSERT INTO `pve_results` SET `bot` = "1", `time` = "'.time().'", `nick` = "'.$rnd_us['login'].'", `exp` = "10", `silver` = "10", `pve_id` = '.$p['pve_id'].', `user` = '.$rnd_us['id'].' ');
$mysqli->query('UPDATE `pve` SET `time_bot` = "'.(time()+rand(30,150)).'" WHERE `id` = "'.$p['id'].'" LIMIT 1');
echo '2';
}
}
####################################################################################################################


















$res = $mysqli->query('SELECT * FROM `dm` WHERE `id` ORDER BY `time` asc LIMIT 1');
$p = $res->fetch_assoc();
####################################################################################################################
if($p and $p['time_bot']<=time() and $p['time_dm']< time()){ // генерируем ботов на сражу 
# выборка юзера
$stmt = $mysqli->prepare('SELECT t.id, login FROM users as t,
            (SELECT ROUND((SELECT MAX(id) FROM users) * rand()) as rnd FROM users) tmp
            WHERE t.id >= (rnd) and `level` >= ? and `viz` <= ? and `id` not in (select user from dm_user)
			LIMIT 1');
$stmt->bind_param("ss", $level, $viz);
$level = 3;$viz = (time()-(86400*2));$stmt->execute();$res = $stmt->get_result();$rnd_us = $res->fetch_assoc();
# выборка противника юзеру
$stmt_g = $mysqli->prepare('SELECT t.id FROM dm_user as t,
            (SELECT ROUND((SELECT MAX(id) FROM dm_user) * rand()) as rnd FROM dm_user) tmp
            WHERE t.id >= (rnd) and `nick` != ? and `dm_id` = ? and `p_` > ? 
			ORDER BY camouflage asc 
			LIMIT 1');
$stmt_g->bind_param("sss", $nick, $dm_id, $hp);
$nick = $rnd_us['login'];$dm_id = $p['dm_id'];$hp = 0;$stmt_g->execute();$res = $stmt_g->get_result();$goal = $res->fetch_assoc(); 
if($rnd_us){
$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = '.$rnd_us['id'].' and `active`  = "1" LIMIT 1');
$u_t = $res->fetch_assoc();
$res = $mysqli->query('SELECT * FROM `tanks` WHERE `id`  = "'.$u_t['tip'].'" LIMIT 1');
$tank = $res->fetch_assoc();
$res_s1 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "1" and `user`  = "'.$rnd_us['id'].'" ');
$skills_1 = $res_s1->fetch_assoc();if(!$skills_1){$skills_1['bon'] = 0;} // маскировка
$res_s2 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "2" and `user`  = "'.$rnd_us['id'].'" ');
$skills_2 = $res_s2->fetch_assoc();if(!$skills_2){$skills_2['bon'] = 0;} // рикошет
$res_s3 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "3" and `user`  = "'.$rnd_us['id'].'" ');
$skills_3 = $res_s3->fetch_assoc();if(!$skills_3){$skills_3['bon'] = 0;} // Слабые места
$res_s4 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "4" and `user`  = "'.$rnd_us['id'].'" ');
$skills_4 = $res_s4->fetch_assoc();if(!$skills_4){$skills_4['bon'] = 0;} // Ремонт
$res_s5 = $mysqli->query('SELECT * FROM `skills_user` WHERE `tip`  = "5" and `user`  = "'.$rnd_us['id'].'" ');
$skills_5 = $res_s5->fetch_assoc();if(!$skills_5){$skills_5['bon'] = 0;} // Снайпер
if(!$goal['id']){$goal['id'] = 0;}
$mysqli->query('INSERT INTO `dm_user` SET `camouflage` = "'.($skills_1['bon']+0.1).'", `ricochet` = "'.$skills_2['bon'].'", 
`weaknessdetection` = "'.$skills_3['bon'].'", `repairs` = "'.$skills_4['bon'].'", `sniper` = "'.$skills_5['bon'].'", 
`nick` = "'.$rnd_us['login'].'", `goal` = '.$goal['id'].', `tank_id` = '.$tank['id'].', 
`a` = '.($u_t['a']).', `b` = '.($u_t['b']).', `t` = '.($u_t['t']).', `p` = '.($u_t['p']*2).', `p_` = '.($u_t['p']*2).', 
`bot` = "1", `dm_id` = '.$p['dm_id'].', `user` = '.$rnd_us['id'].'  ');
$mysqli->query('INSERT INTO `dm_results` SET `time` = "'.time().'", `nick` = "'.$rnd_us['login'].'", `exp` = "10", `silver` = "10", `dm_id` = '.$p['dm_id'].', `user` = '.$rnd_us['id'].' ');
$mysqli->query('UPDATE `dm` SET `time_bot` = "'.(time()+rand(30,150)).'" WHERE `id` = "'.$p['id'].'" LIMIT 1');
}
}
####################################################################################################################







?>