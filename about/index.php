<?php
$title = 'Об игре';
require_once ('../system/function.php');

?>
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta name="viewport" content="minimum-scale=1.0, width=device-width, maximum-scale=1.0"><title>Танки</title>
<link rel="stylesheet" href="/diz.css" type="text/css">
<link rel="icon" href="/favicon.ico" type="image/x-icon"></head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
echo '<body><div class="p5">';
echo '<div class="cntr mb5">
<img w:id="logo" style="max-width:300px;width:100%;" src="/images/logo.jpg">
</div>
<div class="bot">
<a class="simple-but border" w:id="agreementLink" href="'.$HOME.'agreement/"><span><span>Соглашение</span></span></a>
<a class="simple-but border" w:id="rulesOfGameLink" href="'.$HOME.'rules/"><span><span>Правила игры</span></span></a>
<a class="simple-but border" w:id="rulesOfCommunicationLink" href="'.$HOME.'communication/"><span><span>Правила общения</span></span></a>
</div>
<a class="simple-but gray mb10" href="/"><span><span>На главную</span></span></a>';


echo '</div><body>';
?>