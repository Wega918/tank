<?php
$title = 'Танки';
require_once ('system/function.php');
require_once ('system/header.php');




?>
<?php
// Пример динамической установки стилей для второй картинки
$image2Width = '50%'; // Ширина второй картинки
$image2Top = ''.rand(0,35).'%';  // Отступ сверху
$image2Left = ''.rand(0,50).'%'; // Отступ слева

$image2Width1 = '50%'; // Ширина второй картинки
$image2Top1 = ''.rand(0,35).'%';  // Отступ сверху
$image2Left1 = ''.rand(0,50).'%'; // Отступ слева
?>


  <style>
.gif-container {
    position: relative;
    width: 100px; /* Задайте ширину и высоту контейнера в соответствии с размерами вашего GIF */
    height: 100px;
    overflow: hidden;
}

#animated-gif {
    width: 100%;
    height: 100%;
    opacity: 0; /* Устанавливаем начальное значение прозрачности на 0 */
    animation: fadeInOut 3s linear infinite; /* Анимация затухания и появления */
}

@keyframes fadeInOut {
    0%, 100% {
        opacity: 0.1; /* Устанавливаем минимальную прозрачность на уровне 10% */
    }
    50% {
        opacity: 0.9; /* Здесь прозрачность будет наибольшей (90%) */
    }
}

  </style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Плавное затухание и появление GIF</title>
</head>
<body>
    <div class="gif-container">
        <img src="/images/giphy1.gif" alt="Ваш GIF" id="animated-gif">
    </div>
</body>
</html>















    <style>
	#myCanvas {
    max-width: 212%;
    margin-bottom: -146%;
        }
        /* Общий контейнер для изображений */
        .image-container {
            position: relative; /* Позиционирование относительно этого контейнера */
        }

        /* Стили для первой картинки */
        .image1 {
            width: 100%; /* Ширина 100% от родительского контейнера */
            height: auto; /* Высота автоматически, чтобы сохранить пропорции */
            display: block; /* Блочный элемент (если это изображение внутри анкора) */
        }

        /* Стили для второй картинки с динамически установленными свойствами */
        .image2 {
            position: absolute; /* Позиционирование абсолютное */
            top: <?php echo $image2Top; ?>; /* Динамический отступ сверху */
            left: <?php echo $image2Left; ?>; /* Динамический отступ слева */
            width: <?php echo $image2Width; ?>; /* Динамическая ширина */
            height: auto; /* Высота автоматически, чтобы сохранить пропорции */
        }
		
		.image3 {
            width: 100%; /* Ширина 100% от родительского контейнера */
            height: auto; /* Высота автоматически, чтобы сохранить пропорции */
            display: block; /* Блочный элемент (если это изображение внутри анкора) */
        }

        /* Стили для второй картинки с динамически установленными свойствами */
        .image4 {
            position: absolute; /* Позиционирование абсолютное */
            top: <?php echo $image2Top1; ?>; /* Динамический отступ сверху */
            left: <?php echo $image2Left1; ?>; /* Динамический отступ слева */
            width: <?php echo $image2Width1; ?>; /* Динамическая ширина */
            height: auto; /* Высота автоматически, чтобы сохранить пропорции */
        }
    </style>


<?




echo '<table><tbody><tr>
<td class="w50 pr1">
<div class="trnt-block mb10"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="p5 cntr custombg boi_1" w:id="heroDiv">
<div class="small bold green1 sh_b mb10 mt5">Wega</div>
    <div class="image-container">
        <img src="/images/tanks/average/GERMANY/Leopard1_.png" alt="Изображение 1" class="image1">
        <img src="/images/tanks/2,2.png" alt="Изображение 2" class="image2" id="image2">
    </div>
<canvas id="myCanvas" width="1000" height="310"></canvas>

<table class="rblock esmall"><tbody><tr>
<td class="progr rate-block"><div class="scale-block"><div class="scale-next" style="width:100%;"><div class="scale" style="width:%;"><div class="in">&nbsp;</div></div></div><div class="mask"><div class="in">&nbsp;</div></div></div></td>
<td><div class="value-block lh1"><span><span></span></span></div></td>
</tr></tbody></table>

</div></div></div></div></div></div></div></div></div></div></td><td class="w50 pl1">
<div class="trnt-block mb10"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="p5 cntr custombg boi_1" w:id="targetDiv">
<div class="small bold red1 sh_b mb10 mt5">Wega</div>
    <div class="image-container">
        <img src="/images/tanks/heavy/SSSR/IS3.png" alt="Изображение 1" class="image3">
        <img src="/images/tanks/2,2.png" alt="Изображение 2" class="image4" id="image4">
    </div>

<table class="rblock esmall"><tbody><tr>
<td class="progr rate-block">
<div class="scale-block"><div class="scale-next" style="width:100%;"><div class="scale" style="width:%;"><div class="in">&nbsp;</div></div></div>
<div class="mask"><div class="in">&nbsp;</div></div></div>
</td>
<td><div class="value-block lh1"><span><span></span></span></div></td>
</tr></tbody></table>

</div></div></div></div></div></div></div></div></div></div>
</td>
</tr></tbody></table>';

















$butt = 'БРОНЕБОЙНЫЕ&nbsp;('.$a_users['b'].')';
$img = 'ArmorPiercing';
$href = 'attack'.$p_u_ank['id'].'_bb';

$res = $mysqli->query('SELECT * FROM `users_tanks` WHERE `user` = '.$user['id'].' and `active`  = "1" LIMIT 1');
$u_t = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `tanks` WHERE `id` = '.$u_t['tip'].' LIMIT 1');
$tank = $res->fetch_assoc();

if($tank['tip'] == 1){$tip_tank = 'average';$tip_tank_ru = 'СРЕДНИЙ ТАНК';} // СТ
if($tank['tip'] == 2){$tip_tank = 'heavy';$tip_tank_ru = 'ТЯЖЕЛЫЙ ТАНК';} // ТТ
if($tank['tip'] == 3){$tip_tank = 'SAU';$tip_tank_ru = 'ПТ-САУ';} // САУ







echo '<link href="https://fonts.googleapis.com/css?family=Exo+2:400,800" rel="stylesheet" type="text/css">';





echo '<table><tbody><tr>
<td class="w50 pr1">
<div class="trnt-block mb10"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="p5 cntr custombg boi_1" w:id="heroDiv">
<div class="small bold green1 sh_b mb10 mt5">'.$user['login'].'</div>

<img class="scale" class="tank-img" w:id="heroTankImg" src="/images/tanks/'.$tip_tank.'/'.$tank['country'].'/'.$tank['name'].''.$us_i.'.png" alt="'.$user['login'].'" style="width:88%;">

<canvas id="myCanvas" width="1000" height="310"></canvas>

';


echo '<table class="rblock esmall"><tbody><tr>
<td class="progr rate-block"><div class="scale-block"><div class="scale-next" style="width:100%;"><div class="scale" style="width:'.$usP.'%;"><div class="in">&nbsp;</div></div></div><div class="mask"><div class="in">&nbsp;</div></div></div></td>
<td><div class="value-block lh1"><span><span>'.$p_u['p_'].'</span></span></div></td>
</tr></tbody></table>
</div></div></div></div></div></div></div></div></div></div></td>';



if($usA>80){$ank_i = '';}
if($usA>60 && $usA<80){$ank_i = '/'.$ank_tank['name'].'_1';}
if($usA>30 && $usA<=60){$ank_i = '/'.$ank_tank['name'].'_2';}
if($usA<=5){$ank_i = '/'.$ank_tank['name'].'_3';}

if($p_u_ank['p_']<0){
$p_u_ank['p_'] = 0;
}

echo '<td class="w50 pl1">
<div class="trnt-block mb10"><div class="wrap1"><div class="wrap2"><div class="wrap3"><div class="wrap4"><div class="wrap5"><div class="wrap6"><div class="wrap7"><div class="wrap8"><div class="p5 cntr custombg boi_1" w:id="targetDiv">
<div class="small bold red1 sh_b mb10 mt5">'.$user['login'].'</div>
<img class="scale" w:id="heroTankImg" src="/images/tanks/heavy/SSSR/IS3.png" alt="Admin" style="width:88%;">
';

echo '<table class="rblock esmall"><tbody><tr>
<td class="progr rate-block">
<div class="scale-block"><div class="scale-next" style="width:100%;"><div class="scale" style="width:'.$usA.'%;"><div class="in">&nbsp;</div></div></div>
<div class="mask"><div class="in">&nbsp;</div></div></div>
</td>
<td><div class="value-block lh1"><span><span>'.$p_u_ank['p_'].'</span></span></div></td>
</tr></tbody></table>';

echo '</div></div></div></div></div></div></div></div></div></div>
</td>
</tr></tbody></table>';

echo '<table><tbody><tr>
<td class="w50 pr5"><a w:id="attackRegularShellLink" href="?attack'.$p_u_ank['id'].'" class="simple-but gray"><span><span>ОБЫЧНЫЕ</span></span></a></td>
<td class="w50 pl5"><a w:id="attackSpecialShellLink" href="?'.$href.'" class="simple-but"><span><span>'.$butt.'</span></span></a></td>
</tr></tbody></table>';

if($p_u['time_attack']<time()){
echo '<div id="submitButton1" class="progress-button" data-loading="Перезарядка.." data-finished="К выстрелу готов!" style="width: 100%">К выстрелу готов!<span class="tz-bar background-horizontal"></span></div>';
}else{
echo '<div id="submitButton" class="progress-button" data-loading="Перезарядка.." data-finished="К выстрелу готов!" style="width: 100%"><span class="tz-bar background-horizontal"></span></div>';
}


echo '<table><tbody><tr>';
if($p_u['time_rem']>time()){
echo '<td style="width:33%;padding-right:6px;"><a w:id="repairLink" href="?rem'.$p_u['id'].'" class="simple-but blue"><span><span>'.tls($p_u['time_rem']-time()).' сек</span></span></a></td>';
}else{
echo '<td style="width:33%;padding-right:6px;"><a w:id="repairLink" href="?rem'.$p_u['id'].'" class="simple-but blue"><span><span>Ремкомплект</span></span></a></td>';
}
if($p_u['time_manevr']>time()){
echo '<td style="width:33%;padding:0 2px;"><a w:id="maneuverLink" href="?manevr'.$p_u['id'].'" class="simple-but blue"><span><span>'.tls($p_u['time_manevr']-time()).' сек</span></span></a></td>';
}else{
echo '<td style="width:33%;padding:0 2px;"><a w:id="maneuverLink" href="?manevr'.$p_u['id'].'" class="simple-but blue"><span><span>Маневр</span></span></a></td>';
}
echo '<td style="width:33%;padding-left:6px;"><a w:id="changeTargetLink" href="?smena'.$p_u['id'].'" class="simple-but blue"><span><span>Сменить цель</span></span></a></td>
</tr></tbody></table>';
































echo '<br><br><br><br><br><hr>';







//<a id="submitButton" href="#" class="progress-button finished" data-loading="Перезарядка.." data-finished="К выстрелу готов!" style="width: 100%">ОБЫЧНЫЕ<span class="tz-bar background-horizontal" style=""></span><span class="tz-bar background-horizontal" style="width: 0%; display: none;"></span></a>

//progress-button
/* setTimeout(function(){
    $('.progress-button finished').click();
}, 500); */



/* setTimeout(function(){
    $('.progress-button').click();
}, 1); */

/* <a id="submitButton" href="?" class="progress-button" data-loading="Перезарядка.." data-finished="К выстрелу готов!" style="width: 100%">ОБЫЧНЫЕ<span class="tz-bar background-horizontal"></span><span class="tz-bar background-horizontal"></span></a>
 */


?>



















<style>

.demo-wrapper {
	width: 300px;
	margin: 30px auto 0;
}
.html5-progress-bar {
	padding: 15px 15px;
	border-radius: 3px;
	background-color: #fff;
	box-shadow:  0px 1px 2px 0px rgba(0, 0, 0, .2);
}
.html5-progress-bar progress {
	background-color: #f3f3f3;
	border: 0;
	width: 80%;
	height: 18px;
	border-radius: 9px;
}
.html5-progress-bar progress::-webkit-progress-bar {
	background-color: #f3f3f3;
	border-radius: 9px;
}
.html5-progress-bar progress::-webkit-progress-value {
	background: #cdeb8e;
	background: -moz-linear-gradient(top,  #cdeb8e 0%, #a5c956 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#cdeb8e), color-stop(100%,#a5c956));
	background: -webkit-linear-gradient(top,  #cdeb8e 0%,#a5c956 100%);
	background: -o-linear-gradient(top,  #cdeb8e 0%,#a5c956 100%);
	background: -ms-linear-gradient(top,  #cdeb8e 0%,#a5c956 100%);
	background: linear-gradient(to bottom,  #cdeb8e 0%,#a5c956 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cdeb8e', endColorstr='#a5c956',GradientType=0 );
	border-radius: 9px;
}
.html5-progress-bar progress::-moz-progress-bar {
	background: #cdeb8e;
	background: -moz-linear-gradient(top,  #cdeb8e 0%, #a5c956 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#cdeb8e), color-stop(100%,#a5c956));
	background: -webkit-linear-gradient(top,  #cdeb8e 0%,#a5c956 100%);
	background: -o-linear-gradient(top,  #cdeb8e 0%,#a5c956 100%);
	background: -ms-linear-gradient(top,  #cdeb8e 0%,#a5c956 100%);
	background: linear-gradient(to bottom,  #cdeb8e 0%,#a5c956 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cdeb8e', endColorstr='#a5c956',GradientType=0 );
	border-radius: 9px;
}
.html5-progress-bar .progress-value {
	padding: 0px 5px;
	line-height: 20px;
	margin-left: 5px;
	font-size: .8em;
	color: #555;
	height: 18px;
	float: right;
}

















/*! normalize.css v2.0.1 | MIT License | git.io/normalize */

/* ==========================================================================
   HTML5 display definitions
   ========================================================================== */

/*
 * Corrects `block` display not defined in IE 8/9.
 */

article,
aside,
details,
figcaption,
figure,
footer,
header,
hgroup,
nav,
section,
summary {
    display: block;
}

/*
 * Corrects `inline-block` display not defined in IE 8/9.
 */

audio,
canvas,
video {
    display: inline-block;
}

/*
 * Prevents modern browsers from displaying `audio` without controls.
 * Remove excess height in iOS 5 devices.
 */

audio:not([controls]) {
    display: none;
    height: 0;
}

/*
 * Addresses styling for `hidden` attribute not present in IE 8/9.
 */

[hidden] {
    display: none;
}

/* ==========================================================================
   Base
   ========================================================================== */

/*
 * 1. Sets default font family to sans-serif.
 * 2. Prevents iOS text size adjust after orientation change, without disabling
 *    user zoom.
 */

html {
    font-family: sans-serif; /* 1 */
    -webkit-text-size-adjust: 100%; /* 2 */
    -ms-text-size-adjust: 100%; /* 2 */
}

/*
 * Removes default margin.
 */

body {
    margin: 0;
}

/* ==========================================================================
   Links
   ========================================================================== */

/*
 * Addresses `outline` inconsistency between Chrome and other browsers.
 */

a:focus {
    outline: thin dotted;
}

/*
 * Improves readability when focused and also mouse hovered in all browsers.
 */

a:active,
a:hover {
    outline: 0;
}

/* ==========================================================================
   Typography
   ========================================================================== */

/*
 * Addresses `h1` font sizes within `section` and `article` in Firefox 4+,
 * Safari 5, and Chrome.
 */

h1 {
    font-size: 2em;
}

/*
 * Addresses styling not present in IE 8/9, Safari 5, and Chrome.
 */

abbr[title] {
    border-bottom: 1px dotted;
}

/*
 * Addresses style set to `bolder` in Firefox 4+, Safari 5, and Chrome.
 */

b,
strong {
    font-weight: bold;
}

/*
 * Addresses styling not present in Safari 5 and Chrome.
 */

dfn {
    font-style: italic;
}

/*
 * Addresses styling not present in IE 8/9.
 */

mark {
    background: #ff0;
    color: #000;
}


/*
 * Corrects font family set oddly in Safari 5 and Chrome.
 */

code,
kbd,
pre,
samp {
    font-family: monospace, serif;
    font-size: 1em;
}

/*
 * Improves readability of pre-formatted text in all browsers.
 */

pre {
    white-space: pre;
    white-space: pre-wrap;
    word-wrap: break-word;
}

/*
 * Sets consistent quote types.
 */

q {
    quotes: "\201C" "\201D" "\2018" "\2019";
}

/*
 * Addresses inconsistent and variable font size in all browsers.
 */

small {
    font-size: 80%;
}

/*
 * Prevents `sub` and `sup` affecting `line-height` in all browsers.
 */

sub,
sup {
    font-size: 75%;
    line-height: 0;
    position: relative;
    vertical-align: baseline;
}

sup {
    top: -0.5em;
}

sub {
    bottom: -0.25em;
}

/* ==========================================================================
   Embedded content
   ========================================================================== */

/*
 * Removes border when inside `a` element in IE 8/9.
 */

img {
    border: 0;
}

/*
 * Corrects overflow displayed oddly in IE 9.
 */

svg:not(:root) {
    overflow: hidden;
}

/* ==========================================================================
   Figures
   ========================================================================== */

/*
 * Addresses margin not present in IE 8/9 and Safari 5.
 */

figure {
    margin: 0;
}

/* ==========================================================================
   Forms
   ========================================================================== */

/*
 * Define consistent border, margin, and padding.
 */

fieldset {
    border: 1px solid #c0c0c0;
    margin: 0 2px;
    padding: 0.35em 0.625em 0.75em;
}

/*
 * 1. Corrects color not being inherited in IE 8/9.
 * 2. Remove padding so people aren't caught out if they zero out fieldsets.
 */

legend {
    border: 0; /* 1 */
    padding: 0; /* 2 */
}

/*
 * 1. Corrects font family not being inherited in all browsers.
 * 2. Corrects font size not being inherited in all browsers.
 * 3. Addresses margins set differently in Firefox 4+, Safari 5, and Chrome
 */

button,
input,
select,
textarea {
    font-family: inherit; /* 1 */
    font-size: 100%; /* 2 */
    margin: 0; /* 3 */
}

/*
 * Addresses Firefox 4+ setting `line-height` on `input` using `!important` in
 * the UA stylesheet.
 */

button,
input {
    line-height: normal;
}

/*
 * 1. Avoid the WebKit bug in Android 4.0.* where (2) destroys native `audio`
 *    and `video` controls.
 * 2. Corrects inability to style clickable `input` types in iOS.
 * 3. Improves usability and consistency of cursor style between image-type
 *    `input` and others.
 */

button,
html input[type="button"], /* 1 */
input[type="reset"],
input[type="submit"] {
    -webkit-appearance: button; /* 2 */
    cursor: pointer; /* 3 */
}

/*
 * Re-set default cursor for disabled elements.
 */

button[disabled],
input[disabled] {
    cursor: default;
}

/*
 * 1. Addresses box sizing set to `content-box` in IE 8/9.
 * 2. Removes excess padding in IE 8/9.
 */

input[type="checkbox"],
input[type="radio"] {
    box-sizing: border-box; /* 1 */
    padding: 0; /* 2 */
}

/*
 * 1. Addresses `appearance` set to `searchfield` in Safari 5 and Chrome.
 * 2. Addresses `box-sizing` set to `border-box` in Safari 5 and Chrome
 *    (include `-moz` to future-proof).
 */

input[type="search"] {
    -webkit-appearance: textfield; /* 1 */
    -moz-box-sizing: content-box;
    -webkit-box-sizing: content-box; /* 2 */
    box-sizing: content-box;
}

/*
 * Removes inner padding and search cancel button in Safari 5 and Chrome
 * on OS X.
 */

input[type="search"]::-webkit-search-cancel-button,
input[type="search"]::-webkit-search-decoration {
    -webkit-appearance: none;
}

/*
 * Removes inner padding and border in Firefox 4+.
 */

button::-moz-focus-inner,
input::-moz-focus-inner {
    border: 0;
    padding: 0;
}

/*
 * 1. Removes default vertical scrollbar in IE 8/9.
 * 2. Improves readability and alignment in all browsers.
 */

textarea {
    overflow: auto; /* 1 */
    vertical-align: top; /* 2 */
}

/* ==========================================================================
   Tables
   ========================================================================== */

/*
 * Remove most spacing between table cells.
 */

table {
    border-collapse: collapse;
    border-spacing: 0;
}


</style>









	<script src="jquery.js" type="text/javascript"></script>
	<script src="modernizr.js" type="text/javascript"></script>
	<script>
		$(document).ready(function() {
			if(!Modernizr.meter){
				alert('Извините, но Ваш браузер не поддерживает HTML5 прогресс бар!');
			} else {
				var progressbar = $('#progressbar'),
					max = progressbar.attr('max'),
					time = (1000/max)*5,	
			        value = progressbar.val();

			    var loading = function() {
			        value += 1;
			        addValue = progressbar.val(value);
			        
			        $('.progress-value').html(value + '%');

			        if (value == max) {
			            clearInterval(animate);			           
			        }
			    };

			    var animate = setInterval(function() {
			        loading();
			    }, time);
			};
		});
	</script>
	
	
	
	
	
	
	
	
	
	
	
	


	<div class="demo-wrapper html5-progress-bar">
		<div class="progress-bar-wrapper">
			<progress id="progressbar" value="0" max="100"></progress>
			<span class="progress-value">0%</span>
		</div>
	</div>


<?































?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
<link rel="apple-touch-icon.png" href="/images/apple-touch-icon.png">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="/favicon.ico">
<link rel="stylesheet" type="text/css" href="/images/style.css?v=84">
<title>Ангар</title>






/* <script type="text/javascript">
    var functionsContainer = [];
    var spellsCheckFunctionsContainer = [];
    var modalFunctionsContainer = [];
</script>

<script type="text/javascript">
    var isNY = "False".toLowerCase() === "true";
</script>
<script type="text/javascript" id="test_4" src="https://static.magi.mobi/dist/js/lib/lib.js?v=1.0.6888"></script>
<script type="text/javascript" id="test_5" src="https://static.magi.mobi/dist/js/js.js?v=1.0.6888"></script>
<script type="text/javascript">
    window.onload = function () {
        setGlobalCurrentVersion(globalLastVersion);
        for (var i = 0; i < functionsContainer.length; i++) {
            functionsContainer[i]();
        }
        setTimeout(function () { navigationModule.prepareAjaxPageElements(document.getElementsByTagName('body')[0]) });
                initializeFixedMainMenuLayout();
    }
</script> */
</head>





/* <div id="page_content" class="page_content rel h100" data-new-interface="true">


</div>
 */











































<head>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

 
<style>
/* 
.progress-button{
	#height:23px;
	margin-bottom:7px;
	#display:block;
	#border-radius:4px;
	#background:#0b9600 url('/images/art/simple_but_bg.png') repeat-x;
	#font-weight:bold;
	color:#d2d2d2;
	text-decoration:none;
	#text-shadow:#065400 -1px -1px 0;

	
    display: inline-block;
    font-size:70%;
    color:#c0c0c0 !important;
    text-decoration: none !important;
    padding:5px 10px;
    line-height:1;
    overflow: hidden;
    position:relative;
 
    box-shadow:0 1px 1px #474747;
    border-radius:4px;
 
    background-color: #4e4e4e;
    background-image:-webkit-linear-gradient(top, #4e4e4e, #393939);
    background-image:-moz-linear-gradient(top, #4e4e4e, #393939);
    background-image:linear-gradient(top, #4e4e4e, #393939);
}
 */
.progress-button{
    display: inline-block;
	margin-bottom:7px;
    font-size:70%;
    color:#d2d2d2 !important;
    font-weight: bold;
    text-decoration: none !important;
    #padding:5.5px 10px;
	#padding: 5px 10px 6px;
    line-height: 2 !important;
	text-align: center;
	height:23px;
    line-height:1;
    overflow: hidden;
    position:relative;
 
    box-shadow:0 1px 1px #474747;
    border-radius:4px;
 
    background-color: #4e4e4e;
    background-image:-webkit-linear-gradient(top, #4e4e4e, #393939);
    background-image:-moz-linear-gradient(top, #4e4e4e, #393939);
    background-image:linear-gradient(top, #4e4e4e, #393939);
}



 
/* Прячем исходный текст кнопок. При загрузке текст будет показан
   в псевдо-элементе :after. */
 
.progress-button.in-progress,
.progress-button.finished{
    color:transparent !important;
}
 
.progress-button.in-progress:after,
.progress-button.finished:after{
    position: absolute;
    z-index: 2;
    width: 100%;
    height: 100%;
    text-align: center;
    top: 0;
    padding-top: inherit;
    color: #c0c0c0 !important;
    left: 0;
}
 
/* Если кнопка имеет класс, показываем
   содержимое атрибута data-loading */
 
.progress-button.in-progress:after{
    content:attr(data-loading);
}
 
/* То же самое для класса .finished */
 
.progress-button.finished:after{
    content:attr(data-finished);
}
 
/* Цветной индикатор, заполняющий кнопку со временем */
 
.progress-button .tz-bar{
    background-color:#ff00006b;
    height:3px;
    bottom:0;
    left:0;
    width:0;
    position:absolute;
    z-index:1;
 
    border-radius:0 0 2px 2px;
 
    -webkit-transition: width 0.5s, height 0.5s;
    -moz-transition: width 0.5s, height 0.5s;
    transition: width 0.5s, height 0.5s;
}
 
/* Индикатор может быть вертикальным или горизонтальным */
 
.progress-button .tz-bar.background-horizontal{
    height:100%;
    border-radius:2px;
}
 
.progress-button .tz-bar.background-vertical{
    height:0;
    top:0;
    width:100%;
    border-radius:2px;
}
</style>



















<script>


/* 
$( "a" ).click(function( event ) {
  event.preventDefault();

    .append( "default " + event.type + " prevented" )
    .appendTo( "#log" );
}); */



















/* $('input[type=checkbox]').click(function () {
    $('input[value=submitButton]').click();
});  */









  
/* <input type="checkbox" onClick="getButtonByValue('Button').click();">Check the box to simulate a button click
<br>
<input type="button" name="theSubmitButton" id="theSubmitButton" value="Button" onClick="alert('The button was clicked.');">
 */







$(document).ready(function(){
	

    // Конвертация всех ссылок с классом progress-button
    // в кнопки с прогресс-баром.
    // Эту функцию надо вызвать один раз после загрузки страницы.

  $('.progress-button').progressInitialize();
   
    // Отслеживаем нажатия на кнопки и
    // запускаем анимацию
 
$('#submitButton').click(function(e){
// Эта функция показывает прогресс для заданного времени
$(this).progressTimed(25);
}); 
 
 
 
  /*    function codeAddress() {
            alert('ok');
        }
        window.onload = codeAddress;
 */

/* $(window).load(function() {
   $('#myTab a[href="#profile"]').tab('show')
}); */

 
 
/*     $('#actionButton').click(function(e){
        e.preventDefault();
        $(this).progressTimed(2);
    });
 
    $('#generateButton').one('click', function(e){
        e.preventDefault();
 
        // Можем передать колбэк
 
        var button = $(this);
        button.progressTimed(3, function(){
 
            // В этой функции можно указать ссылку на зугруженный файл
            // в атрибуте href кнопки. Для примера просто будем отслеживать
            // нажатие на кнопку
 
            button.click(function(){
                alert('https://mtank.ru/test.php');
            });
        });
    }); */
	
	
	
	
	
	
 
    // Управление прогрессом
/*  
    var controlButton = $('#controlButton');
 
    controlButton.click(function(e){
        e.preventDefault();
 
        // Вы также можете вызвать функцию progressStart.
        // Она будет имитировать активность каждые 2 секунды
        // если прогресс не увеличивается.
 
        controlButton.progressStart();
    }); */
 
/*     $('.command.increment').click(function(){
 
        // Увеличение прогресса на 10%.
        // Можно передать в функцию свой процент.
 
        controlButton.progressIncrement();
    });
 
    $('.command.set-to-1').click(function(){
 
        // Установить заданный прогресс
 
        controlButton.progressSet(1);
    });
 
    $('.command.set-to-50').click(function(){
        controlButton.progressSet(50);
    });
 
    $('.command.finish').click(function(){
 
        // Установить прогресс-бар в 100% положение.
        controlButton.progressFinish();
    });
  */
 
 
});
 
 
 
 
 
 
 
 
 
 	/* 
	 var progressbar = $('#progressbar'),
					max = progressbar.attr('max'),
					time = (1000/max)*5,	
			        value = progressbar.val();

			    var loading = function() {
			        value += 1;
			        addValue = progressbar.val(value);
			        
			        $('.progress-value').html(value + '%');

			        if (value == max) {
			            clearInterval(animate);			           
			        }
			    };

			    var animate = setInterval(function() {
			        loading();
			    },  */
 
 
 
 
 
(function($){
 
    // Инициализация прогресс-бара
 
    $.fn.progressInitialize = function(){



				
				
        // Эта функция создает необходимую разметку
        // и отслеживает некоторые события.
 
        // цикл по всем кнопкам:
 
        return this.each(function(){
 
            var button = $(this),
                progress = 0;
 
            // Выделение data-* атрибутов в опции.
            // Если они не указаны - используются дефолтные значения
 
            var options = $.extend({
                type:'background-horizontal',
                loading: 'Перезарядка..',
                finished: 'К выстрелу готов!'
            }, button.data());
 
            button.attr({'data-loading': options.loading, 'data-finished': options.finished});
 
            // Добавим необходимую разметку
            var bar = $('<span class="tz-bar ' + options.type + '">').appendTo(button);
 
 
 





            // Событие progress для обновления прогресса
            button.on('progress', function(e, val, absolute, finish){
 
                if(!button.hasClass('in-progress')){
 
                    // Инициализация или повторный запуск прогресс-бара
                    // и удаление классов, которые могли остаться посел предыдущего запуска.
 
                    bar.show();
                    progress = 0;
                    button.removeClass('finished').addClass('in-progress')
                }
 
                // val, absolute и finish - передаются функциями progressIncrement
                // и progressSet, которые вы увидите ниже.
 
                if(absolute){
                    progress = val;
                }else{
                    progress += val;
                }
 
                if(progress >= 100){
                    progress = 100;
                }
 
                if(finish){
 
                    button.removeClass('in-progress').addClass('finished');
 
                    bar.delay(500).fadeOut(function(){
 
                        // Вызываем событие progress-finish
                        button.trigger('progress-finish');
                        setProgress(0);
                    });
 
                }
 
                setProgress(progress);
            });
 
            function setProgress(percentage){
                bar.filter('.background-horizontal,.background-bar').width(percentage+'%');
                bar.filter('.background-vertical').height(percentage+'%');
            }
 
        });
 
    };
	
	
	
	
	
	
	
	

                 

	
	
 /* 
    $.fn.progressStart = function(){

        var button = this.first(),
            last_progress = new Date().getTime();
 
       if(button.hasClass('in-progress')){
             return this;
        }
 
        button.on('progress', function(){
            last_progress = new Date().getTime();
        });
 
        // Каждые полсекунды проверяем изменился прогресс
        // в течение последних 2х секунд
 
        var interval = window.setInterval(function(){
 
            if( new Date().getTime() > 2000+last_progress){
 
                // Не было активности последние 2 секунды. Увеличиваем прогресс
                button.progressIncrement(5);
            }
 
        }, 500);
 
        button.on('progress-finish',function(){
            window.clearInterval(interval);
        });
		 return button.progressIncrement(10);
	};
	 */
	
	
	


	
	
			   var progressbar = $('#progressbar'),
					max = progressbar.attr('max'),
					time = (1000/max)*5,	
			        value = progressbar.val();

			        var loading = function() { // эта функция срабатыывает после обновления стр

//alert('https://mtank.ru/test.php');



			        value += 1;
					button.progressIncrement(5);
			        addValue = progressbar.val(value);
			        
			        $('.progress-value').html(value + '%');

			        if (value == max) {
			            clearInterval(animate);							
			        }
			        };

			    var animate = setInterval(function() {					
			        loading();
			    }, time);
	
	
	
	
 // эта функция обнуляет прогресс когда он доходит до конца
    $.fn.progressFinish = function(){
        return this.first().progressSet(100);
    };
 
/*$.fn.progressIncrement = function(val){ // исправляет баг с вечной надписью перезарядки
        val = val || 10; 
        var button = this.first();
        button.trigger('progress',[val])
        return this;
}; */
 
    $.fn.progressSet = function(val){
		//alert('https://mtank.ru/test.php');
        val = val || 10;
 
        var finish = false;
        if(val >= 100){
            finish = true;
        }
 
        return this.first().trigger('progress',[val, true, finish]);
    };
 
    // Функция создает прогресс-бар
    // и заполняет его за указанное время
 
    $.fn.progressTimed = function(seconds, cb){
 
        var button = this.first(),
            bar = button.find('.tz-bar');
 
        if(button.is('.in-progress')){
            return this;
        }
 
        // Устанавливаем свойство transition в зависимости от времени.
        // анимация будет создана силами CSS.
 
        bar.css('transition', seconds+'s linear');
        button.progressSet(99);
 
        window.setTimeout(function(){
            bar.css('transition','');
            button.progressFinish();
 
            if($.isFunction(cb)){
                cb();
            }
 
        }, seconds*1000);
    };
 
 
 
 
 

 
 
 
 
 
 
 
 
 
})(jQuery);








</script>


</head>



















 
 <body>
 






<script type="text/javascript">

/* 
$('input[type=checkbox]').click(function () {
    $('input[value=submitButton]').click();
});  */


/*     function getButtonByValue(value) {
        var els = document.getElementsByTagName('a');

        for (var i = 0, length = els.length; i < length; i++) {
            var el = els[i];

            if (el.type.toLowerCase() == 'submitButton' && el.value.toLowerCase() == value.toLowerCase()) {
                return el;
                break;
            }
        }
    } */
	
	
/* function clickButton(val){
var buttons = document.getElementsByTagName('a');
      for(var i = 0; i < buttons.length; i++) 
      {
         if(buttons[i].type == 'submitButton' && buttons[i].value == val) 
         {
              buttons[i].click();
              break; //this will exit for loop, but if you want to click every button with the value button then comment this line
         }
      }
} */


</script>  
















<script>
window.onload = function() {
$('.progress-button').click();
}
</script> 


</body>
<?


































?>
<a class="blck p5 forum"></a>
<a href="#vrag" onClick="document.getElementById('pokazat1').style.display='none';document.getElementById('skryt1').style.display='';return false;"><center><span style="color:lawngreen;"><u>Виды врагов</u></span></a> / <a href="#" onClick="document.getElementById('skryt').style.display='none';document.getElementById('pokazat').style.display='';return false;">Закрыть</center></a><br>
</div><?
///###############################################################################################################################################









///###############################################################################################################################################
?>
<div id="pokazat1"></div>





<div id="skryt1" style="display:none">

<br>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/Infantry.png"><br><br>Пехота (30 хп) - награда: <img border="0" src="/images/icons/glory.png"> 2 славы<br></center>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/Detachment.png"><br><br>Минометный расчет (60 хп)- награда: <img border="0" src="/images/icons/glory.png"> 3 славы<br></center>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/Tractor.png"><br><br>Тягач (90 хп) - награда: <img border="0" src="/images/icons/glory.png"> 3 славы<br></center>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/Radar.png"><br><br>РЛУ (135 хп) - награда: <img border="0" src="/images/icons/glory.png"> 4 славы<br></center>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/Bike.png"><br><br>Мотоцикл (180 хп) - награда: <img border="0" src="/images/icons/glory.png"> 4 славы<br></center>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/AntiTankGun.png"><br><br>Противотанковая установка(240 хп)- награда: <img border="0" src="/images/icons/glory.png"> 5 славы<br></center>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/Jeep.png"><br><br>Военный джип (300 хп) - награда: <img border="0" src="/images/icons/glory.png"> 6 славы<br></center>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/AntiAirCraft.png"><br><br>Мобильная зенитка(400 хп) - награда: <img border="0" src="/images/icons/glory.png"> 7 славы<br></center>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/BTR.png"><br><br>БТР (500 хп) - награда: <img border="0" src="/images/icons/glory.png"> 8 славы<br></center>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/ChemicalTank.png"><br><br>Химический танк(650 хп) - награда: <img border="0" src="/images/icons/glory.png"> 9 славы<br></center>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/RocketLaunchers.png"><br><br>Реактивные миномёты(800 хп) - награда: <img border="0" src="/images/icons/glory.png"> 9 славы<br></center>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/SAU.png"><br><br>САУ (1000 хп) - награда: <img border="0" src="/images/icons/glory.png"> 10 славы<br></center>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/Tank.png"><br><br>Танк (1200 хп) - награда: <img border="0" src="/images/icons/glory.png"> 10 славы<br></center>
<a class="blck p5 forum"></a>
<center><img border="0" src="/images/convoy/ArmoredTrain.png"><br><br>Бронепоезд (1600хп) - награда: <img border="0" src="/images/icons/glory.png"> 11 славы<br></center>

<br><a class="blck p5 forum"></a><a href="#vrag" onClick="document.getElementById('skryt1').style.display='none';document.getElementById('pokazat1').style.display='';return false;"><center>Закрыть</center></center></a><br>

</div><?
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////





echo '<table><tbody><tr>
 <td class="w50 pl5" ><a w:id="attackSpecialShellLink" href="?attack10375_bb" class="simple-but gray" style="width: 100%"><span><span>ОБЫЧНЫЕ</span></span></a></td>
 <td class="w50 pl5" ><a w:id="attackSpecialShellLink" href="?attack10375_bb" class="simple-but" style="width: 100%"><span><span>БРОНЕБОЙНЫЕ&nbsp;(58)</span></span></a></td>
</tr></tbody></table>';





echo '<div id="submitButton" class="progress-button" data-loading="Перезарядка.." data-finished="К выстрелу готов!" style="width: 100%"><span class="tz-bar background-horizontal"></span></div>';

























/* <style>
#myCanvas
{
  height:200px;
  width:1600px;
  max-width:99%;
  min-width:800px;
  position:absolute;
  bottom:0;
  
}
body
{
  background:black url(https://s.cdpn.io/16327/texture_bg.jpg) no-repeat 50% 0px;
}
div
{  
  font-family: 'Exo 2', sans-serif;
  font-size:24px;
  text-align:center;
  color:white;
  
  position:absolute;
  
  height:100px;
  width:200px;
  
  top:50%;
  left:50%;
  
  margin-top:-50px;
  margin-left:-100px;    
}
div p
{
  font-size:15px;  //the subtitle is smaller
}
</style>
 */


?>
<style>
#myCanvas {
    /* max-width: 212%; */
    width: 215%;
    height: 13%;
    max-width: 212%;
    /* margin: -4%; */
    margin-top: -65%;
    margin-right: 0%;
    margin-bottom: -146%;
    margin-left: -3%;
    position: relative;
}
</style>







<script>
console.clear();

canvasWidth = 1600;
canvasHeight = 200;

pCount = 0;


pCollection = new Array();

var puffs = 1;
var particlesPerPuff = 2000;
var img = 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/85280/smoke2.png';

var smokeImage = new Image();
smokeImage.src = img;

for (var i1 = 0 ; i1 < puffs; i1++)
{
  var puffDelay = i1 * 300; //300 ms between puffs

  for (var i2 = 0 ; i2 < particlesPerPuff; i2++)
  {
    addNewParticle((i2*350) + puffDelay);   // больше число меньше дыма 
  }
}


draw(new Date().getTime(), 10000)



function addNewParticle(delay)
{

  var p = {};
  p.top = canvasHeight;
  p.left = randBetween(-200,800); // расширяет дым, становится меньше

  p.start = new Date().getTime() + delay;
  p.life = 8000;
  p.speedUp = 10;


  p.speedRight = randBetween(0,20);

  p.rot = randBetween(-1,1);
  p.red = Math.floor(randBetween(0,255));
  p.blue = Math.floor(randBetween(0,255));
  p.green = Math.floor(randBetween(0,255));


  p.startOpacity = .3
  p.newTop = p.top;
  p.newLeft = p.left;
  p.size = 200; // меньше дыма
  p.growth = 10;  // меньше дыма

  pCollection[pCount] = p;
  pCount++;


}

function draw(startT, totalT)
{
  //Timing
  var timeDelta = new Date().getTime() - startT;
  var stillAlive = false;

  //Grab and clear the canvas
  var c=document.getElementById("myCanvas");
  var ctx=c.getContext("2d");
  ctx.clearRect(0, 0, c.width, c.height);
  c.width = c.width;

  //Loop through particles
  for (var i= 0; i < pCount; i++)
  {    
    //Grab the particle
    var p = pCollection[i];

    //Timing
    var td = new Date().getTime() - p.start;
    var frac = td/p.life

    if (td > 0)
    {
      if (td <= p.life )
      { stillAlive = true; }

      //attributes that change over time
      var newTop = p.top - (p.speedUp * (td/200));
      var newLeft = p.left + (p.speedRight * (td/150));
      var newOpacity = Math.max(p.startOpacity * (1-frac),0);

      var newSize = p.size + (p.growth * (td/150));
      p.newTop = newTop;
      p.newLeft = newLeft;

      //Draw!
      ctx.fillStyle = 'rgba(150,150,150,' + newOpacity + ')';      
      ctx.globalAlpha  = newOpacity;
      ctx.drawImage(smokeImage, newLeft, newTop, newSize, newSize);
    }
  }



  //Repeat if there's still a living particle
  if (stillAlive)
  {
    requestAnimationFrame(function(){draw(startT,totalT);}); 
  }
  else
  {
    clog(timeDelta + ": stopped");
  }
}

function randBetween(n1,n2)
{
  var r = (Math.random() * (n2 - n1)) + n1;
  return r;
}

function randOffset(n, variance)
{
  //e.g. variance could be 0.1 to go between 0.9 and 1.1
  var max = 1 + variance;
  var min = 1 - variance;
  var r = Math.random() * (max - min) + min;
  return n * r;
}

function clog(s)
{  
  console.log(s);
}
</script>












<?



















require_once ('system/footer.php');
?>