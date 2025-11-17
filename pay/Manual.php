<?php
$title = 'Дивизия';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}


echo '<div class="content angels"><table style="width:100%;" cellspacing="0" cellpadding="0"><tbody>
<div class="white bold cntr mb5">Ручная покупка</div>
<tr><td style="text-align: left;" class="angels_draw"><span><font size=2>Приват Банк <font size=2 color=yellow>(Украина)</font></font> </span></td><td style="text-align: right;width:-1px;"> <font size=2>( 5168 7554 1564 3424 )</font> </td></tr>
<tr><td style="text-align: left;" class="angels_draw"><span><font size=2>LifeCell <font size=2 color=yellow>(Украина)</font></font> </span></td><td style="text-align: right;width:-1px;"> <font size=2>( +38093 600 7827 )</font> </td></tr>
<tr><td style="text-align: left;" class="angels_draw"><span><font size=2>Киевстар <font size=2 color=yellow>(Украина)</font> </font> </span></td><td style="text-align: right;width:-1px;"> <font size=2>( +38097 315 7633 )</font> </td></tr>
<tr><td style="text-align: left;" class="angels_draw"><span><font size=2>Qiwi <font size=2 color=green>(Все страны)</font></font> </span></td><td style="text-align: right;width:-1px;"> <font size=2>( +38093 600 7827 )</font> </td></tr>
<tr><td style="text-align: left;" class="angels_draw"><span><font size=2>WMR <font size=2 color=green>(Все страны)</font> </font> </span></td><td style="text-align: right;width:-1px;"> <font size=2>( R669159761094 )</font> </td></tr>
<tr><td style="text-align: left;" class="angels_draw"><span><font size=2>WMU <font size=2 color=green>(Все страны)</font> </font> </span></td><td style="text-align: right;width:-1px;"> <font size=2>( U804101436086 )</font> </td></tr>
<tr><td style="text-align: left;" class="angels_draw"><span><font size=2>Яндекс Деньги <font size=2 color=green>(Все страны)</font> </font> </span></td><td style="text-align: right;width:-1px;"> <font size=2>( 410013853106204 )</font> </td></tr>
</tbody></table>
<br>';


echo '<hr> <font color=>
После перевода средств, <a href="'.$HOME.'user/plategi.php"><b>создайте платеж</b>.</a></font>';

echo '</center></div>';


echo '<a class="btnk mt4" href="'.$HOME.'user/plategi.php"><img src="/images/settings2.png" width="24" height="24" alt=""> Создать платеж <img src="/images/settings2.png" width="24" height="24" alt=""></a>


<center><font size=2 color=red>По Тех-причинам обращайтесь в <a href="'.$HOME.'tikets">службу поддержки</a>, на номера прозьба не звонить.</center></font></div>';

require_once ('../system/footer.php');
?>