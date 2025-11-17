<?php
$title = 'Прошедшие сражения';
//-----Подключаем функции-----//
require_once ('../system/function.php');
//-----Подключаем вверх-----//
require_once ('../system/header.php');
//-----Если гость,то...----//
if(!$user['id']) {
header('Location: /');
exit();
}
$res1 = $mysqli->query('SELECT * FROM `settings` WHERE `id` = "1" ');
$sql = $res1->fetch_assoc();


$res1 = $mysqli->query('SELECT * FROM `dm` WHERE `time_end` != "0" ORDER BY `time_end` DESC LIMIT 8');
while ($p_end = $res1->fetch_array()){
/* if($p_end['tip']==1){$tipB = 'Оборонительная операция';}else{$tipB = 'Наступательная операция';}
 */
echo '<div class="trnt-block mb5"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content">
<div class="mb5 inbl"><div class="thumb fl"><img src="/images/battles/dm/batt'.$p_end['dm_id'].'.jpg" style="width:100%; border-radius: 9px;"><span class="mask2">&nbsp;</span></div>
<div class="ml58 small white sh_b bold"><span class="green2">'.$p_end['name'].'</span><br><span><span>закончилась '.time_last($p_end['time_end']).'</span></span><br><span class="gray1">'.$tipB.'</span></div>
<div class="clrb"></div></div>

<div class="small bold cntr gray1 sh_b mt2"><div class="white">';


if($p_end['pobeda']==1){echo '<span class="green1">Кончилось время</span><br>';}
if($p_end['pobeda']==2){echo '<span class="green1">Выжили лучшие</span><br>';}
/* if($p_end['pobeda']==3){echo '<span class="red1">Победу одержали противники.</span>';echo '<br><span class="gray1">Все союзники убиты</span><br>';}
if($p_end['pobeda']==4){echo '<span class="green1">Победу одержали союзники!</span>';echo '<br><span class="gray1">Закончилось время</span><br>';}
if($p_end['pobeda']==5){echo '<span class="green1">Победу одержали союзники!</span>';echo '<br><span class="gray1">Все враги убиты</span><br>';}
if($p_end['pobeda']==6){echo '<span class="red1">Победу одержали противники.</span>';echo '<br><span class="gray1">Все союзники убиты</span><br>';}
 */
 
 
/*  
if($p_end['pobeda']==1){echo '<span class="green1">Победу одержали союзники!</span>';echo '<br><span class="gray1">Закончилось время</span><br>';}
if($p_end['pobeda']==2){echo '<span class="green1">Победу одержали союзники!</span>';echo '<br><span class="gray1">Все враги убиты</span><br>';}
if($p_end['pobeda']==3){echo '<span class="red1">Победу одержали противники.</span>';echo '<br><span class="gray1">Все союзники убиты</span><br>';}
if($p_end['pobeda']==4){echo '<span class="green1">Победу одержали союзники!</span>';echo '<br><span class="gray1">Закончилось время</span><br>';}
if($p_end['pobeda']==5){echo '<span class="green1">Победу одержали союзники!</span>';echo '<br><span class="gray1">Все враги убиты</span><br>';}
if($p_end['pobeda']==6){echo '<span class="red1">Победу одержали противники.</span>';echo '<br><span class="gray1">Все союзники убиты</span><br>';}

 */
$res = $mysqli->query('SELECT * FROM `dm_results` WHERE `user` = "'.$user['id'].'" and `dm_id` = "'.$p_end['dm_id'].'" ');
$res_us = $res->fetch_assoc();
if($res_us['id']){
echo '<br>
<span class="green2">Мои достижения:</span><br>
<span class="yellow1">Награда</span>: <br>
<span>
<span class="nwr"><img class="ico vm" src="/images/icons/exp.png" alt="опыт" title="опыт"> '.$res_us['exp'].' опыта </span> 
<span class="nwr"><img class="ico vm" src="/images/icons/silver.png?2" alt="Серебро" title="Серебро"> '.$res_us['silver'].' серебра </span>';
if($res_us['crewpoints']>0){
echo '<span class="nwr"><img class="ico vm" src="/images/icons/crewpoints.png" alt="Опыт экипажа" title="Опыт экипажа"> '.$res_us['crewpoints'].' очков экипажа</span>';
}
if($res_us['fuel']>0){
echo '<span class="nwr"><img title="Топливо" alt="Топливо" src="/images/icons/fuel.png"> '.$res_us['fuel'].' топлива </span>';
}
if($res_us['gold']>0){
echo '<span class="nwr"><img title="Золото" alt="Золото" src="/images/icons/gold.png"> '.$res_us['gold'].' золота </span>';
}

if($res_us['number_kill']>0){$number_kill = '('.$res_us['number_kill'].' место)';}
if($res_us['number_uron']>0){$number_uron = '('.$res_us['number_uron'].' место)';}
echo '</span><br>
<span class="yellow1">Подбито танков</span>: '.$res_us['kill'].' '.$number_kill.'<br>
<span class="yellow1">Нанесено урона</span>: '.$res_us['uron'].' '.$number_uron.'<br>';
}

/* echo '<br><span class="green2">Лучшие по убийствам</span><br>';
$res2 = $mysqli->query('SELECT * FROM `dm_results` WHERE `dm_id` = "'.$p_end['dm_id'].'" and `kill` > "0" ORDER BY `kill` DESC LIMIT 3');
while ($top_kill = $res2->fetch_array()){
$res1_us = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$top_kill['user'].'" ');
$us1 = $res1_us->fetch_assoc();
$res_tr = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$us1['id'].'" ');
$traning1 = $res_tr->fetch_assoc();
if($us1['side'] == 1){$side = 'federation';}else{$side = 'empire';}
if($us1['viz'] > (time()-$sql['online'])){$viz = '';}else{$viz = '_off';}
echo '<a href="/profile/'.$top_kill['user'].'/"><img class="vb" height="14" width="14" src="/images/side/'.$side.'/'.$traning1['rang'].''.$viz.'.png?1"> <span class="yellow1">'.$top_kill['nick'].'</span></a>: '.$top_kill['kill'].' врагов<br>';
} */

echo '<br><span class="green2">Лучшие (урон и убийства)</span><br>';
$res3 = $mysqli->query('SELECT * FROM `dm_results` WHERE `dm_id` = "'.$p_end['dm_id'].'" and `uron` > "0" ORDER BY `dm_id` DESC, `uron` DESC LIMIT 3');
while ($top_uron = $res3->fetch_array()){
$res_us1 = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$top_uron['user'].'" ');
$us2 = $res_us1->fetch_assoc();
$res_tr1 = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$us2['id'].'" ');
$traning2 = $res_tr1->fetch_assoc();
if($us2['side'] == 1){$side = 'federation';}else{$side = 'empire';}
if($us2['viz'] > (time()-$sql['online'])){$viz = '';}else{$viz = '_off';}
echo ' <img class="vb" height="14" width="14" src="/images/side/'.$side.'/'.$traning2['rang'].''.$viz.'.png?1"> <span class="yellow1">'.$top_uron['nick'].'</span>: '.$top_uron['uron'].' + '.$top_uron['kill'].' <br>';
}
/* '.$top_uron['id'].' '.$top_uron['dm_id'].' '.vremja($top_uron['time']).' */
echo '</div><br>
Сражались: <span class="green1">'.$p_end['where_user'].'</span> | Выжили: <span class="red1">'.$p_end['survived_user'].'</span><br>
</div></div></div></div></div></div></div></div></div></div></div>';
}



/* 
if($user['id']==1){
$res34 = $mysqli->query('SELECT * FROM `dm_results` WHERE `id` and `uron` > "0" ORDER BY `time` DESC LIMIT 10000');
while ($top_uron4 = $res34->fetch_array()){
$res_us1 = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$top_uron4['user'].'" ');
$us2 = $res_us1->fetch_assoc();
$res_tr1 = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$us2['id'].'" ');
$traning2 = $res_tr1->fetch_assoc();
if($us2['side'] == 1){$side = 'federation';}else{$side = 'empire';}
if($us2['viz'] > (time()-$sql['online'])){$viz = '';}else{$viz = '_off';}

echo ''.$top_uron4['id'].' '.$top_uron4['dm_id'].' '.time_last($top_uron4['time']).' <img class="vb" height="14" width="14" src="/images/side/'.$side.'/'.$traning2['rang'].''.$viz.'.png?1"> <span class="yellow1">'.$top_uron4['nick'].'</span>: '.$top_uron4['uron'].' + '.$top_uron4['kill'].' <br>';


}
} */





echo '<a w:id="backToPve" class="simple-but gray mt10" href="/dm/"><span><span>Назад к сражениям</span></span></a>';
require_once ('../system/footer.php');
?>