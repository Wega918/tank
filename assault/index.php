<?php
$title = 'Дивизия';
require_once ('../system/function.php');
require_once ('../system/header.php');
if(!$user['id']){
header('Location: /');
exit();
}

echo '<div class="trnt-block mb2"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="wrap-content-mini">



<div class="cntr mt10">

<div class="bold green2">Локация  в разработке.</div>
<div class="small gray1 mt5">Пожалуйста, подождите.</div>

<div class="small white mt5">С уважением администрация '.$HOMIE.'!</div>

<div class="mt5"><a class="small gray1 td_u" href="?">обновить</a></div>

</div>

</div></div></div></div></div></div></div></div></div></div>';



require_once ('../system/footer.php');
?>