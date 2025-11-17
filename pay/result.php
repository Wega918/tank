<?php
$merchant_id = '20695';
$merchant_secret = 'https://mtank.ru/';

  function getIP() {
    if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
    return $_SERVER['REMOTE_ADDR'];
  }

  if (!in_array(getIP(), array('168.119.157.136', '168.119.60.227', '138.201.88.124', '178.154.197.79'))) die("hacking attempt!");

  $sign = md5($merchant_id.':'.$_REQUEST['AMOUNT'].':'.$merchant_secret.':'.$_REQUEST['MERCHANT_ORDER_ID']);

  if ($sign != $_REQUEST['SIGN']) die('wrong sign');
//echo 'ok';
  //Так же, рекомендуется добавить проверку на сумму платежа и не была ли эта заявка уже оплачена или отменена

  //Оплата прошла успешно, можно проводить операцию.



$mysqli->query('UPDATE `users` SET `gold` = "1" WHERE `id` = "1" LIMIT 1');



die('YES');
?>