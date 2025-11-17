<script>
function getSymbol(n) {
  let i = 1;
  for (let j = 1; j <= n; j++) {
    i *= 10;
  }

  let b = "";
  let l = Math.log10(i);
  if (l >= 310) {
    b = "aa";
  } else if (l >= 309) {
    b = "ab";
  }

  return b;
}
</script>

<script src="https://github.com/node-fetch/node-fetch/releases/latest/download/node-fetch.js"></script>

<script>
    // Подключаем библиотеку Node.js

    // Получаем результат от функции на JavaScript
    const result = await fetch("https://vipmars.ru/getSymbol?n=100000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000");
    const data = await result.json();
</script>
  
<?
    // Выводим результат
    echo $data.b;

?>
  
  
  
  
  
  
  
  
  
  
  <?php
$title = 'Танки';
require_once ('system/function.php');
require_once ('system/header.php');

error_reporting(E_ALL);








/* $n = 1000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000;
echo get_symbol($n);

 */


/* $res = $mysqli->query('SELECT * FROM `dm` WHERE `id` ORDER BY `time` asc LIMIT 1');
$p = $res->fetch_assoc();
echo ''.$p['id'].'';
 */


//$mysqli->query('DELETE FROM `pve_results` WHERE `time` < "'.(time()-(3600*2)).'" ');
/* 
$wqwqw1 = microtime(1);
$max = 10000;
$res = $mysqli->query("SELECT COUNT(*) FROM `users` WHERE `id` ");
$k_post = $res->fetch_array(MYSQLI_NUM);
$k_page = k_page($k_post[0],$max);
$page = page($k_page);
$start = $max*$page-$max;
$k_post[0] = $start+1;
$res_dm = $mysqli->query('SELECT * FROM `users` WHERE `id` ORDER BY `id` DESC LIMIT '.$start.','.$max.' ');
while ($ress = $res_dm->fetch_array()){
$num1 = $k_post1[0]++;
echo ''.$num1.'<br>';
}
echo '<hr>'.round(microtime(1) - $wqwqw1, 4).' +';//0.0051 +661



$wqwqw2 = microtime(1);
$res_dm = $mysqli->query('SELECT * FROM `users` WHERE `id` ORDER BY `id` DESC LIMIT 10000');
while ($ress = $res_dm->fetch_array()){
$num2 = $k_post2[0]++;
echo ''.$num2.'<br>';
}
echo '<hr>'.round(microtime(1) - $wqwqw2, 4).' +';//0.0046





$wqwqw3 = microtime(1);
$res_dm = $mysqli->query('SELECT * FROM `users` WHERE `id` ORDER BY `id` DESC ');
while ($ress = $res_dm->fetch_array()){
$num3 = $k_post3[0]++;
echo ''.$num3.'<br>';
}
echo '<hr>'.round(microtime(1) - $wqwqw3, 4).' +';//0.0043

 */





/* $wqwqw3 = microtime(1);
$res_dm3 = $mysqli->query('SELECT * FROM `users` WHERE `id` ORDER BY `id` DESC ');
while ($ress3 = $res_dm3->fetch_array()){
$num3 = $k_post3[0]++;
$res2 = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$ress3['id'].'" limit 1');
$traning = $res2->fetch_assoc();
echo ''.$num3.' - '.$ress3['id'].' - '.$traning['user'].'<br>';
}
echo '<hr>'.round(microtime(1) - $wqwqw3, 4).' +'; //0.0666 +

$wqwqw4 = microtime(1);
$res_dm = $mysqli->query('SELECT * FROM `users` WHERE `id` ORDER BY `id` DESC ');
while ($ress4 = $res_dm->fetch_array()){
$num44 = $k_post44[0]++;
$res4 = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$ress4['id'].'" ');
$traning4 = $res4->fetch_assoc(); 
echo ''.$num44.' - '.$ress4['id'].' - '.$traning4['user'].'<br>';
}
echo '<hr>'.round(microtime(1) - $wqwqw4, 4).' +'; //0.1044
*/







/* $wqwqw3 = microtime(1);
$res_dm3 = $mysqli->query('SELECT * FROM `users` WHERE `id` ORDER BY `id` DESC ');
while ($ress3 = $res_dm3->fetch_array()){
$num3 = $k_post3[0]++;
$mysqli->query('UPDATE `users` SET `test` = "'.$ress3['id'].'" WHERE `id` = '.$ress3['id'].' ');
echo ''.$num3.'<br>';
}
echo '<hr>'.round(microtime(1) - $wqwqw3, 4).' +'; //0.0437
 */



/* $wqwqw4 = microtime(1);
$res_dm = $mysqli->query('SELECT * FROM `users` WHERE `id` ORDER BY `id` DESC ');
while ($ress4 = $res_dm->fetch_array()){
$num44 = $k_post44[0]++;
$mysqli->query('UPDATE `users` SET `test` = "'.$ress4['id'].'" WHERE `id` = '.$ress4['id'].' LIMIT 1');
echo ''.$num44.'<br>';
}
echo '<hr>'.round(microtime(1) - $wqwqw4, 4).' +'; //0.13
 */




//$mysqli->query('UPDATE `users` SET `test` = "0" WHERE `id`');











/* 
if($user['id']==1){

$res = $mysqli->query('SELECT user, time FROM `convoy_user` WHERE `time` > "'.time().'" and `user` = "'.$user['id'].'" limit 1');
$gggggg1 = $res->fetch_assoc();

if($gggggg1['time'] > time()){
echo '______';
}

echo '<hr>'.$gggggg1['user'].'<hr>';
}
 */
 




/* эффект взрыва
?>
<script>
document.addEventListener("DOMContentLoaded",() => {
	let button = new ExplosiveButton("button");
});

class ExplosiveButton {
	constructor(el) {
		this.element = document.querySelector(el);
		this.width = 0;
		this.height = 0;
		this.centerX = 0;
		this.centerY = 0;
		this.pieceWidth = 0;
		this.pieceHeight = 0;
		this.piecesX = 9;
		this.piecesY = 4;
		this.duration = 1000;

		this.updateDimensions();
		window.addEventListener("resize",this.updateDimensions.bind(this));

		if (document.body.animate)
			this.element.addEventListener("click",this.explode.bind(this,this.duration));
	}
	updateDimensions() {
		this.width = pxToEm(this.element.offsetWidth);
		this.height = pxToEm(this.element.offsetHeight);
		this.centerX = this.width / 2;
		this.centerY = this.height / 2;
		this.pieceWidth = this.width / this.piecesX;
		this.pieceHeight = this.height / this.piecesY;
	}
	explode(duration) {
		let explodingState = "exploding";

		if (!this.element.classList.contains(explodingState)) {
			this.element.classList.add(explodingState);

			this.createParticles("fire",25,duration);
			this.createParticles("debris",this.piecesX * this.piecesY,duration);
		}
	}
	createParticles(kind,count,duration) {
		for (let c = 0; c < count; ++c) {
			let r = randomFloat(0.25,0.5),
				diam = r * 2,
				xBound = this.centerX - r,
				yBound = this.centerY - r,
				easing = "cubic-bezier(0.15,0.5,0.5,0.85)";

			if (kind == "fire") {
				let x = this.centerX + randomFloat(-xBound,xBound),
					y = this.centerY + randomFloat(-yBound,yBound),
					a = calcAngle(this.centerX,this.centerY,x,y),
					dist = randomFloat(1,5);

				new FireParticle(this.element,x,y,diam,diam,a,dist,duration,easing);

			} else if (kind == "debris") {
				let x = (this.pieceWidth / 2) + this.pieceWidth * (c % this.piecesX),
					y = (this.pieceHeight / 2) + this.pieceHeight * Math.floor(c / this.piecesX),
					a = calcAngle(this.centerX,this.centerY,x,y),
					dist = randomFloat(4,7);

				new DebrisParticle(this.element,x,y,this.pieceWidth,this.pieceHeight,a,dist,duration,easing);
			}
		}
	}
}
class Particle {
	constructor(parent,x,y,w,h,angle,distance = 1,className2 = "") {
		let width = `${w}em`,
			height = `${h}em`,
			adjustedAngle = angle + Math.PI/2;

		this.div = document.createElement("div");
		this.div.className = "particle";

		if (className2)
			this.div.classList.add(className2);

		this.div.style.width = width;
		this.div.style.height = height;

		parent.appendChild(this.div);

		this.s = {
			x: x - w/2,
			y: y - h/2
		};
		this.d = {
			x: this.s.x + Math.sin(adjustedAngle) * distance,
			y: this.s.y - Math.cos(adjustedAngle) * distance
		};
	}
	runSequence(el,keyframesArray,duration = 1e3,easing = "linear",delay = 0) {
		let animation = el.animate(keyframesArray, {
				duration: duration,
				easing: easing,
				delay: delay
			}
		);
		animation.onfinish = () => {
			let parentCL = el.parentElement.classList;

			el.remove();

			if (!document.querySelector(".particle"))
				parentCL.remove(...parentCL);
		};
	}
}
class DebrisParticle extends Particle {
	constructor(parent,x,y,w,h,angle,distance,duration,easing) {
		super(parent,x,y,w,h,angle,distance,"particle--debris");
		
		let maxAngle = 1080,
			rotX = randomInt(0,maxAngle),
			rotY = randomInt(0,maxAngle),
			rotZ = randomInt(0,maxAngle);

		this.runSequence(this.div,[
			{
				opacity: 1,
				transform: `translate(${this.s.x}em,${this.s.y}em) rotateX(0) rotateY(0) rotateZ(0)`
			},
			{
				opacity: 1,
			},
			{
				opacity: 1,
			},
			{
				opacity: 1,
			},
			{
				opacity: 0,
				transform: `translate(${this.d.x}em,${this.d.y}em) rotateX(${rotX}deg) rotateY(${rotY}deg) rotateZ(${rotZ}deg)`
			}
		],randomInt(duration/2,duration),easing);
	}
}
class FireParticle extends Particle {
	constructor(parent,x,y,w,h,angle,distance,duration,easing) {
		super(parent,x,y,w,h,angle,distance,"particle--fire");

		let sx = this.s.x,
			sy = this.s.y,
			dx = this.d.x,
			dy = this.d.y;

		this.runSequence(this.div,[
			{
				background: "hsl(60,100%,100%)",
				transform: `translate(${sx}em,${sy}em) scale(1)`
			},
			{
				background: "hsl(183, 100%, 80%)",//hsl(60,100%,80%)
				transform: `translate(${sx + (dx - sx)*0.25}em,${sy + (dy - sy)*0.25}em) scale(4)`
			},
			{
				background: "hsl(206, 100%, 60%)",//hsl(40,100%,60%)
				transform: `translate(${sx + (dx - sx)*0.5}em,${sy + (dy - sy)*0.5}em) scale(7)`
			},
			{
				background: "hsl(194, 100%, 64%)"//hsl(20,100%,40%)
			},
			{
				background: "hsl(0, 0%, 100%)",// hsl(0,0%,20%)
				transform: `translate(${dx}em,${dy}em) scale(0)`
			}
		],randomInt(duration/2,duration),easing);
	}
}
function calcAngle(x1,y1,x2,y2) {
	let opposite = y2 - y1,
		adjacent = x2 - x1,
		angle = Math.atan(opposite / adjacent);

	if (adjacent < 0)
		angle += Math.PI;

	if (isNaN(angle))
		angle = 0;

	return angle;
}
function propertyUnitsStripped(el,property,unit) {
	let cs = window.getComputedStyle(el),
		valueRaw = cs.getPropertyValue(property),
		value = +valueRaw.substr(0,valueRaw.indexOf(unit));

	return value;
}
function pxToEm(px) {
	let el = document.querySelector(":root");
	return px / propertyUnitsStripped(el,"font-size","px");
}
function randomFloat(min,max) {
	return Math.random() * (max - min) + min;
}
function randomInt(min,max) {
	return Math.round(Math.random() * (max - min)) + min;
}
</script>


<style>

body, button {
	font: 1em/1.5 "Hind", sans-serif;
}

button {
	background: #255ff4;
	border-radius: 0.2em;
	color: #fff;
	cursor: pointer;
	margin: auto;
	padding: 0.5em 1em;
	transition: background .15s linear, color .15s linear;
}
button:focus, button:hover {
	background: #0b46da;
}
button:focus {
	outline: transparent;
}
button::-moz-focus-inner {
	border: 0;
}
button:active {
	transform: translateY(0.1em);
}
.exploding, .exploding:focus, .exploding:hover {
	background: transparent;
	color: transparent;
}
.exploding {
	pointer-events: none;
	position: relative;
	will-change: transform;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
}
.particle {
	position: absolute;
	top: 0;
	left: 0;
}
.particle--debris {
	background: #255ff4;
}
.particle--fire {
	border-radius: 50%;
}

@media (prefers-color-scheme: dark) {
	body {
		background: #17181c;
	}
}
</style>



<button type="button">Атаковать</button>

<?

 */
























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





<div id="page_content" class="page_content rel h100" data-new-interface="true">


</div>












































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





$(document).ready(function(){

    // Конвертация всех ссылок с классом progress-button
    // в кнопки с прогресс-баром.
    // Эту функцию надо вызвать один раз после загрузки страницы.

  $('.progress-button').progressInitialize();
   
    // Отслеживаем нажатия на кнопки и
    // запускаем анимацию
 
    $('#submitButton').click(function(e){


        // Эта функция показывает прогресс для заданного времени
 
        $(this).progressTimed(5);

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
                alert('Showing how a callback works!');
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
 
 
 
 
function progress(){
var i=0;
var width= document.getElementById('progressBar').parentNode.clientWidth;
var id=setInterval(grow, 24)

function grow(){
if(i<width){
i+=1;
if(!document.getElementById('progressBar').setAttribute("style","width: "+i+"px;"))
document.getElementById('progressBar').style.width = i;
}else{
}
}
}




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
                }
                else{
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
 
    $.fn.progressFinish = function(){
        return this.first().progressSet(100);
    };
 
    $.fn.progressIncrement = function(val){
 
        val = val || 10;
 
        var button = this.first();
 
        button.trigger('progress',[val])
 
        return this;
    };
 
    $.fn.progressSet = function(val){
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
 












<table><tbody><tr>
 <td class="w50 pr5" ><a id="submitButton" href="#" class="progress-button" data-loading="Перезарядка.." data-finished="К выстрелу готов!" style="width: 100%">ОБЫЧНЫЕ<span class="tz-bar background-horizontal"></span></a></td>
 <td class="w50 pl5" ><a w:id="attackSpecialShellLink" href="?attack10375_bb" class="simple-but" style="width: 100%"><span><span>БРОНЕБОЙНЫЕ&nbsp;(58)</span></span></a></td>
</tr></tbody></table>









</body>









<?




require_once ('system/footer.php');
?>