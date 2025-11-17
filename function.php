<?php

ob_start();
session_start();
$t_s = microtime(1);
###############################
####### Подключаем БД #########
###############################



/* define("DB_HOST", "localhost");
define("DB_USER", "mtankru_us");
define("DB_PASSWORD", "j2eJeQLj8QkkF");
define("DB_DATABASE", "mtankru_bd");

$mysqli = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
 */
 
/* $servername = 'localhost';
$username = 'mtankru_us';
$password = 'j2eJeQLj8QkkF';

$mysqli = mysqli_connect($servername, $username, $password, 'mtankru_bd');
if (!$mysqli) {
printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
exit;
} */







$mysqli = mysqli_connect(
'localhost',  // Хост, к которому мы подключаемся 
'sorehov960_mtank',       // Имя пользователя 
'j2eJeQLj8QkkF1',   // Используемый пароль 
'sorehov960_mtank');    // База данных для запросов по умолчанию  
if (!$mysqli) {
printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
exit;
} 


/* $mysqli = mysqli_connect(
'localhost',  // Хост, к которому мы подключаемся 
'wartank',       // Имя пользователя 
'wartank',   // Используемый пароль 
'wartank');    // База данных для запросов по умолчанию  
if (!$mysqli) {
printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
exit;
}  */





$HOME = 'http://mtank.ru/';






class AntiHack {

     private $getarr = ''; // Ключ для распознавания массива
   
     private $input = array(); // Массив для фильтрации

     private $arraykey = 256; // максимальное количество символов в ключе массива

     private $arrayvalue = 100000; // максимальное количество символов в значении массива

     // Ключи для удаления из массива _SERVER
     private $arrayserverkey = 'COMSPEC;SYSTEMROOT;PATHEXT;UNIQUE_ID;PATH;GATEWAY_INTERFACE;SERVER_SIGNATURE;SERVER_ADMIN;PERL5LIB';


   function __construct()
   {
      $this->filter($this ->input, $this->getarr);
   }


   private function __cleaning($input, $keyss, $getarr)
   {
                 if (!empty($input) && $keyss == 'value' && $getarr != 'post')$input = urldecode($input);
                 
/******                 $input = str_replace(array("\n", "\r", "\t"), null, trim($input));******/

                 $charset = mb_detect_encoding($input);
                 
                 $input = (($charset != 'UTF-8')?iconv((($charset === 'ASCII')?'WINDOWS-1251':$charset), 'UTF-8', $input):$input);
                              
                 if (!empty($input) && $keyss === 'key')
                 {
                  $input = preg_replace('#[^a-z0-9-_]+#i', null, $input);
                  $input = (string)strip_tags($input);
                 
                 }
                 elseif (($getarr === 'get' || !empty($input)) && $keyss === 'value')
                 {

                 if ($getarr === 'get') 
                 {
                 $input = preg_replace('#[^(a-z0-9-_\(\)\&\=\?\;\:\.\/\]\[)|(\x7F-\xFF)|(\s)]+#is', null, $input );

                  $input = str_replace('../', '', $input);      
                 }
                 elseif ($getarr === 'post')
                 { 
                      $input = str_replace("‮",'',$input);
                      $input = str_ireplace('javascript', 'jаvаsсriрt', $input);
                      $input = str_ireplace('data', 'dаtа', $input);
                      $input = str_ireplace('base64', 'bаsе64', $input);
                      $input = htmlentities($input, ENT_QUOTES, 'UTF-8');
                      $input = addslashes($input);
                       
                 }
                 elseif ($getarr === 'files')
                 {
                      if (!is_string($input)) 
                      {
                      $input = intval($input);
                      }
                      else
                      {
                      $input = preg_replace('#[^(a-zа-я0-9-_\(\)\&\=\?\;\:\.\/)|(\x7F-\xFF)|(\s)]+#is', null, $input );
                      }
                  
                 }
                 elseif ($getarr === 'cookie')
                 {
                 $input = preg_replace('#[^a-z0-9-_]+#i', null, $input);
                 }
                 elseif ($getarr === 'server')
                 {
                 $input = str_replace('\\', '/', $input);
                 $input = preg_replace('#[^a-z0-9-_\/\.\s\:\;\,\?\=\@]+#i', null, $input);
                 }
                 elseif ($getarr === 'request')
                 {
                      if (!is_string($input))
                      {
                      $input = intval($input);
                      }
                      else
                      {
                      $input = htmlentities($input, ENT_QUOTES, 'UTF-8');
                      }
                  
                 }
                 else
                 {
                 $input = (string)htmlentities( $input, ENT_QUOTES, 'UTF-8');
                 $input = strip_tags($input);
                 }
            }
            /*else
            {
            $input = null;
            }*/
       
       return ( $input );
       }



   private function __sorting($input, $getarr)
   {
      if (!is_array($input))return(null);
      
      $arr_delete = explode(';', $this->arrayserverkey);

      foreach($input as $key => $value)
     {
              
             if ($getarr === 'server') 
             {
             $key = strtoupper($key);
                  for ($i = 0; $i < count($arr_delete); $i++) 
                  {
                        if (strnatcasecmp($key, $arr_delete[$i]) === 0)$value = null;
                  }
            }

             if ((!$key || $key == '' || $value === null || isset($key{$this->arraykey})) || ($getarr === 'files' && !is_uploaded_file($input[$key]['tmp_name'])))continue;
              
             if (!is_array($value)) {
                   if (isset($value{$this->arrayvalue}))continue;
                    
                   $result[$this->__cleaning($key, 'key', $getarr)] = $this->__cleaning($value, 'value', $getarr);
             }
             else {
                   foreach($value as $item => $field) {
                          if ($field === '' || $field === null || isset($item{$this->arraykey}) || isset($field{$this -> arrayvalue}))continue;
                          
                          $value[$this->__cleaning($item, 'key', $getarr)] = $this->__cleaning($field, 'value', $getarr);
                   }
                   $result[$this->__cleaning($key, 'key', $getarr)] = $value;
             }
       }
       return ((isset($result) ? $result : null));
   }



   function filter($input, $getarr)
   {
      if (count($input) === 0) {
             return(null);
      }
             $getarr = strtolower($getarr);
             $getarr = str_replace(' ', null, trim($getarr ));
             return ($this->__sorting($input, $getarr));
   }



}




















###############################
######## Фильтрация ###########
###############################
function strip_data($text){
$quotes = array ("alert", "xss", '"', "'", "`", "<!", "<", ">" );
$goodquotes = array ("-", "+", "#" );
$repquotes = array ("\-", "\+", "\#" );
$text = trim( strip_tags( $text ) );
$text = str_replace( $quotes, '', $text );
$text = str_replace( $goodquotes, $repquotes, $text );
$text = ereg_replace(" +", " ", $text);
return $text;
}

function strong2($msg){
$msg = strip_data($msg);
$msg = htmlspecialchars($msg);
$msg = mysql_real_escape_string($msg);
return $msg;
}
function strong($msg){
$msg = trim($msg);
$msg = htmlspecialchars($msg);
$msg = ($msg);
return $msg;
}
function num($var){
return abs(intval($var));
}

function text($m){
global $db;
$m = htmlspecialchars($m);
$m = $db -> real_escape_string($m);
return $m;
}






foreach($_GET as $ad){
if(is_numeric($ad)){
$ad = abs(intval($ad));}
if(preg_match('/\include|asc|--|select|union|update|from|where|eval|glob|include|require|script|shell|BENCHMARK|CONCAT|INSERT\b/i', $ad)){
$time = time();
$timer = date("j M Y в H:i", $time);
$source = '
Запрос: '.htmlspecialchars($_SERVER['REQUEST_URI']).', IP хакера: '.$_SERVER['REMOTE_ADDR'].', Дополнительный IP: '.$_SERVER['HTTP_X_FORWARDED_FOR'].', Софт: '.$_SERVER['HTTP_USER_AGENT'].', Время: '.$timer.'';
$file = htmlspecialchars($_SERVER['DOCUMENT_ROOT']).'/data/log627.txt';
$Saved_File = fopen($file, 'a+');
fwrite($Saved_File, $source);
fclose($Saved_File);
header("Location: /");
exit();
}
$ad = htmlspecialchars(($ad));
}

foreach($_POST as $ad){
if(is_numeric($ad)){
$ad = abs(intval($ad));
}else{
$ad = htmlspecialchars(($ad));
}
}

foreach($_SESSION as $ad){
$ad = htmlspecialchars(($ad));
}

foreach($_COOKIE as $ad){
$ad = htmlspecialchars(($ad));
}

foreach($_GET as $key=>$value){
$_GET[$key]=(stripcslashes(htmlspecialchars($value)));
}

foreach($_GET as $key=>$value){
$_GET[$key]=(stripcslashes(htmlspecialchars($value)));
}

if (isset($_GET['isset']) && $_GET['isset'] == 403){
echo 'Доступ запрещен #1 (Asadal)';
exit();
} 
elseif (isset($_GET['isset']) && $_GET['isset'] == 404){
echo 'Ошибка #2 (Asadal)';
exit();
}

if (isset($_COOKIE['MAGIC_COOKIE'])) {
}elseif (isset($_GET['MAGIC_COOKIE']) || isset($_POST['MAGIC_COOKIE'])) {
echo 'Ошибка #3 (Asadal)';
exit();
}else{
}

function antihack(&$var){
if(is_array($var)){
array_walk($var, 'antihack'); 
}
} 

foreach(array('_SERVER', '_GET', '_POST', '_COOKIE', '_REQUEST') as $v){ 
if(!empty(${$v})) array_walk(${$v}, 'antihack'); 
}









###############################
############ Куки #############
###############################
if (isset($_COOKIE['uslog']) and isset($_COOKIE['uspass'])) {
$uslog = strong($_COOKIE['uslog']);
$uspass = strong($_COOKIE['uspass']);

$res = $mysqli->query('SELECT * FROM `users` WHERE `login` = "'.$uslog.'" and `pass` = "'.$uspass.'" LIMIT 1 ');
$user = $res->fetch_assoc();

/* if($user['id']==1){
ini_set('display_errors',1);
error_reporting(E_ALL);
}
 */
if (isset($user['id'])) {
if ($user['login'] != $uslog or $user['pass'] != $uspass) {
setcookie('uslog', '', time() - 86400*365);
setcookie('uspass', '', time() - 86400*365);
}
}

$mysqli->query('UPDATE `users` SET `viz`="'.time().'", `ip` = "'.$_SERVER['REMOTE_ADDR'].'", `browser` = "'.$_SERVER['HTTP_USER_AGENT'].'", `gde` = "'.$_SERVER['REQUEST_URI'].'" WHERE `id` = '.$user['id'].' LIMIT 1');

//echo ''.$users['id'].'';






}






###############################
###############################
######### Функция ника ########
###############################
function nick($id){
$mysqli = mysqli_connect(
'localhost',  // Хост, к которому мы подключаемся 
'sorehov960_mtank',       // Имя пользователя 
'j2eJeQLj8QkkF1',   // Используемый пароль 
'sorehov960_mtank');    // База данных для запросов по умолчанию  
if (!$mysqli) {
printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
exit;
} 
$res = $mysqli->query('SELECT * FROM `users` WHERE `id` = "'.$id.'" limit 1');
$users = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `traning` WHERE `user` = "'.$id.'" limit 1');
$traning = $res->fetch_assoc();

$res = $mysqli->query('SELECT * FROM `settings` WHERE `id` = "1" limit 1');
$sql = $res->fetch_assoc();

if($users['side'] == 1){$side = 'federation';}else{$side = 'empire';}
if($users['viz'] > time()-$sql['online']){$viz = '';}else{$viz = '_off';}
if($users['side'] == 1){
$p = '<img class="vb" height="15" width="15" src="/images/side/'.$side.'/'.$traning['rang'].''.$viz.'.png">';
}else{
$p = '<img class="vb" height="15" width="15" src="/images/side/'.$side.'/'.$traning['rang'].''.$viz.'.png">';
}
return (empty($users)?'[Удален]':'  <a class="white" w:id="profileLink" href="/profile/'.$users['id'].'/">'.$p.' <span class="green2" w:id="login">'.$users['login'].'</span></a>');
}







$time = time();
$bad_words = "UNION SELECT UPDATE INSERT schemata r57shell remview config= OUTFILE%20 passwd wget cmd= union javascript: echr( esystem( INSERT%20INTO '$_REQUEST FROM DROP TRUNCATE <script> </script> javascript group_access document.cookie alert() eval() system() OUTFILE INTO";
$bad_list = explode(' ', $bad_words);
$line = $_POST?implode(" ", $_POST):$_SERVER['QUERY_STRING'];
$Gde=$_SERVER['SCRIPT_NAME'];
$Site=$_SERVER['SERVER_NAME'];
$Ip = $_SERVER['REMOTE_ADDR'];
$Cuseragent = $_SERVER['HTTP_USER_AGENT'];
$Querry=$_SERVER['QUERY_STRING'];

/* if( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) { 
  // your code here
} else {
  if( isset( $_SERVER['REMOTE_ADDR'] ) ) 
     return $_SERVER['REMOTE_ADDR'];
  else  
    return FALSE;
}  */

foreach ($bad_list as $re) {
$msghack=''.$user['login'].' Попытался нашколохакерить, 
(взломать сайт) <font color=8B0000> запросом: <br><b>'.$Site.''.$Gde.'?'.$Querry.'</b></font><br>
<font color=green>IP: '.$Ip.' , Софт: '.$Cuseragent.'</font> 
';

$re = preg_quote($re, '/');
if (preg_match("/$re/i", $line)) {
/*
$con = mysql_result(mysql_query("SELECT COUNT(id) FROM `message_c` WHERE `kogo` = '1' and `kto` = '2' LIMIT 1"),0);
if($con == 0) {
mysql_query("INSERT INTO `message_c` SET `kto` = '2', `kogo` = '1', `time` = '".time()."', `posl_time` = '".time()."'");
mysql_query("INSERT INTO `message_c` SET `kto` = '1', `kogo` = '2', `time` = '".time()."', `posl_time` = '".time()."'");
}
mysql_query("UPDATE `message_c` SET `posl_time`='".time()."' WHERE `kogo` = '2' and `kto`='1' limit 1");
mysql_query("UPDATE `message_c` SET `posl_time`='".time()."' WHERE `kto` = '2' and `kogo`='1' limit 1");
mysql_query("INSERT INTO `message` SET `text` = '".$msghack."', `kto` = '2', `komy` = '1', `time` = '".time()."', `readlen` = '0'");
*/
die("".header("Location: /index.php")."");


} }






###############################
########## фильтрация ##########
###############################
function filter($msg){
$mysqli = mysqli_connect(
'localhost',  // Хост, к которому мы подключаемся 
'sorehov960_mtank',       // Имя пользователя 
'j2eJeQLj8QkkF1',   // Используемый пароль 
'sorehov960_mtank');    // База данных для запросов по умолчанию  
if (!$mysqli) {
printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
exit;
} 
global $HOME;
$msg = trim($msg);
$si = $mysqli->query('SELECT * FROM `mat` ORDER BY `id` DESC');
while ($smi = $si->fetch_array()){
$msg = str_replace($smi['name'],' '.$smi['zamena'].' ',$msg);
}
return $msg;
}




###############################
############ Смайлы ############
###############################
function smile($msg){
$mysqli = mysqli_connect(
'localhost',  // Хост, к которому мы подключаемся 
'sorehov960_mtank',       // Имя пользователя 
'j2eJeQLj8QkkF1',   // Используемый пароль 
'sorehov960_mtank');    // База данных для запросов по умолчанию  
if (!$mysqli) {
printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
exit;
} 
global $HOME;
$msg = trim($msg);
$s = $mysqli->query('SELECT * FROM `smile` ORDER BY `id` DESC');
while ($smile = $s->fetch_array()){
$msg = str_replace($smile['name'],' <img src="'.$HOME.'/files/smile/'.$smile['icon'].'" alt="'.$smile['name'].'"/> ',$msg);
}
return $msg;
}







###############################
########### BB Коды ###########
###############################
function bb($mes){
$mes = stripslashes($mes);
$mes=preg_replace("/\[hr]/Usi","<hr>",$mes);
$mes = str_replace("\r\n","<br/>",$mes);
$mes = preg_replace('#\[cit\](.*?)\[/cit\]#si', '<div class="cit">\1</div>', $mes);
$mes = preg_replace('#\[b\](.*?)\[/b\]#si', '<span style="font-weight: bold;"> \1 </span>', $mes);
$mes = preg_replace('/\[url\s?=\s?([\'"]?)(?:http:\/\/)?(.*?)\1\](.*?)\[\/url\]/', ' <a href="http://$2"> $3 </a> ', $mes);
$mes = preg_replace("#\[img=(?:http:\/\/)?(.*?)(.gif|.png|.jpeg|.jpg)\]#",'<a href="http://\1\2"><img src="http://\1\2" alt="im" style="max-width: 120px; max-height: 80px;"/></a>', $mes);
$mes = preg_replace("#\[img\][\s]*([\S]+)[\s]*\[\/img\]#isU",'<img src="\\1" alt="" />',$mes);
$mes = preg_replace('#\[teal\](.*?)\[\/teal\]#si', '<span style="color: teal">\1</span>', $mes);
$mes = preg_replace('#\[blue\](.*?)\[\/blue\]#si', '<span style="color: blue">\1</span>', $mes);
$mes = preg_replace('#\[orange\](.*?)\[\/orange\]#si', '<span style="color: orange">\1</span>', $mes);
$mes = preg_replace('#\[purple\](.*?)\[\/purple\]#si', '<span style="color: purple">\1</span>', $mes);
$mes = preg_replace('#\[gold\](.*?)\[\/gold\]#si', '<span style="color: gold">\1</span>', $mes);
$mes = preg_replace('#\[yellow\](.*?)\[\/yellow\]#si', '<span style="color: yellow">\1</span>', $mes);
$mes = preg_replace('#\[magenta\](.*?)\[\/magenta\]#si', '<span style="color: magenta">\1</span>', $mes);
$mes = preg_replace('#\[navy\](.*?)\[\/navy\]#si', '<span style="color: navy">\1</span>', $mes);
$mes = preg_replace('#\[grey\](.*?)\[\/grey\]#si', '<span style="color: grey">\1</span>', $mes);
$mes = preg_replace('#\[white\](.*?)\[\/white\]#si', '<span style="color: white">\1</span>', $mes);
$mes = preg_replace('#\[black\](.*?)\[\/black\]#si', '<span style="color: black">\1</span>', $mes);
$mes = preg_replace('#\[LimeGreen\](.*?)\[\/LimeGreen\]#si', '<span style="color: LimeGreen">\1</span>', $mes);

$mes = preg_replace('#\[black\](.*?)\[\/black\]#si', '<span style="color:#000000;">\1</span>', $mes);
$mes = preg_replace('#\[i\](.*?)\[\/i\]#si', '<i>\1</i>', $mes);
$mes = preg_replace('#\[tt\](.*?)\[\/tt\]#si', '<tt>\1</tt>', $mes);
$mes = preg_replace('#\[u\](.*?)\[\/u\]#si', '<u>\1</u>', $mes);
$mes = preg_replace('#\[s\](.*?)\[\/s\]#si', '<s>\1</s>', $mes);
$mes = preg_replace('#\[red\](.*?)\[\/red\]#si', '<span style="color: indianred">\1</span>', $mes);
$mes = preg_replace('#\[green\](.*?)\[\/green\]#si', '<span style="color: lightgreen">\1</span>', $mes);
$mes = preg_replace('#\[lblue\](.*?)\[\/lblue\]#si', '<span style="color: lightblue">\1</span>', $mes);
$mes = preg_replace('#\[grey\](.*?)\[\/grey\]#si', '<span style="color: grey">\1</span>', $mes);
$mes1 = preg_replace("~(^|\s|-|:| |\()(http(s?)://|(www\.))((\S{25})(\S{5,})(\S{15})([^\<\s.,>)\];'\"!?]))~i", "\\1<a href=\"http\\3://\\4\\5\">\\4\\6...\\8\\9</a>", $mes);
$mes1 = preg_replace("~(^|\s|-|:|\(| |\xAB)(http(s?)://|(www\.))((\S+)([^\<\s.,>)\];'\"!?]))~i", "\\1<a href=\"http\\3://\\4\\5\">\\4\\5</a>", $mes);

$mes = preg_replace('#\[center\](.*?)\[\/center\]#si', '<center>\1</center>', $mes);
$mes = preg_replace('#\[br\](.*?)\[\/br\]#si', '<br>\1</br>', $mes);

//$mes = preg_replace("/\[img=([0-9]+)=([0-9]+)\](.+)\[\/img\]/isU",'<img src="$3" style="width: $1px; heigth: $2px;" />',$mes);
$mes = preg_replace("/\[img=(.+)\](.+)\[\/img\]/isU",'<img src="$2" style="width: $1px;" />',$mes);
//$mes['/\[img=(.+)\](.+)\[\/img\]/isU'] = '<img src="$2" style="width: $1px;" />';
//$mes['/\[img=([0-9]+)=([0-9]+)\](.+)\[\/img\]/isU'] = '<img src="$3" style="width: $1px; heigth: $2px;" />';

return $mes; 
}



function bb1($mes1){
$mes1 = preg_replace('#\[b\](.*?)\[/b\]#si', '<span style="font-weight: bold;"> \1 </span>', $mes1);
$mes1 = preg_replace("~(^|\s|-|:| |\()(http(s?)://|(www\.))((\S{25})(\S{5,})(\S{15})([^\<\s.,>)\];'\"!?]))~i", "\\1Реклама", $mes1);
$mes1 = preg_replace("~(^|\s|-|:|\(| |\xAB)(http(s?)://|(www\.))((\S+)([^\<\s.,>)\];'\"!?]))~i", "\\1Реклама", $mes1);
return $mes1; 
}








###############################
########### Листинг ###########
###############################
function page($k_page=1) {
$page = 1;
$page = strong($page);
$k_page = strong($k_page);
if(isset($_GET['page'])) {
if ($_GET['page']=='top')
$page = strong(intval($k_page));
elseif(is_numeric($_GET['page'])) 
$page = strong(intval($_GET['page']));
}
if ($page<1)$page=1;
if ($page>$k_page)$page=$k_page;
return $page;
}

// Определяем кол-во страниц
function k_page($k_post = 0,$k_p_str = 10) {
if ($k_post != 0) {
$v_pages = ceil($k_post/$k_p_str);
return $v_pages;
}
else return 1;
}










function str($link='?',$k_page=1,$page=1){
echo '<div class="pgn mt10">';
if ($page<1)$page=1;
$page = strong($page);
$k_page = strong($k_page);
if ($page>1){
echo '<a class="simple-but gray" href="'.$link.'page=1" title="Go to page &lt;&lt;"><span><span>&lt;&lt;</span></span></a>'; // <<
}else{ 
echo '<a class="simple-but gray" href="'.$link.'page=1" title="Go to page &lt;&lt;"><span><span>&lt;&lt;</span></span></a>'; // <<
}
if ($page<$k_page){
}else{
}
if ($page != 1){
echo '<a class="simple-but gray" href="'.$link.'page=1" title="Go to page 1"><span><span>1</span></span></a>'; // 1
}else{
echo '<span class="simple-but gray" title="Go to page 1"><em><span><span>1</span></span></em></span>'; // 1
}
for ($ot=-3; $ot<=3; $ot++){
if ($page+$ot>1 && $page+$ot<$k_page){
if ($ot!=0){
echo '<a class="simple-but gray" href="'.$link.'page='.($page+$ot).'" title="Go to page '.($page+$ot).'"><span><span>'.($page+$ot).'</span></span></a>'; // 2-3-4
}else{
echo '<span class="simple-but gray" title="Go to page '.($page+$ot).'"><em><span><span>'.($page+$ot).'</span></span></em></span>'; // 2-3-4
}
}
}
if ($page!=$k_page){
echo '<a class="simple-but gray" href="'.$link.'page=top" title="Go to page &gt;&gt;"><span><span>&gt;&gt;</span></span></a>'; // >>
}elseif ($page == $k_page){
echo '<span class="simple-but gray" title="Go to page &gt;&gt;"><em><span><span>&gt;&gt;</span></span></em></span>'; // >>
}elseif ($k_page>1){
echo '<a class="simple-but gray" '.$k_page.'"><span><span>'.$k_page.'</span></span></a>'; // >>
}
echo '</div>';
}






###############################
############ Время ############
###############################
function vremja($time = NULL){
global $tim;
if($time == NULL)
$time = time();
if(isset($tim))
$time = $time + $tim['set_timesdvig']*60*60;
$timep = date("j M Y в H:i", $time);
$time_p[0] = date("j n Y", $time);
$time_p[1] = date("H:i", $time);
if($time_p[0] == date("j n Y"))
$timep = date("H:i:s", $time);
if(isset($tim))
{
if($time_p[0] == date("j n Y", time() + $tim['set_timesdvig']*60*60))
$timep = date("H:i:s", $time);
if($time_p[0] == date("j n Y", time()-60*60*(24-$tim['set_timesdvig'])))
$timep = "Вчера в $time_p[1]";
} else {
if ($time_p[0] == date("j n Y"))
$timep = date("H:i:s", $time);
if($time_p[0] == date("j n Y", time()-60*60*24))
$timep = "Вчера в $time_p[1]";
}
$timep = strtr($timep, array ("Jan" => "Янв","Feb" => "Фев","Mar" => "Марта","May" => "Мая","Apr" => "Апр","Jun" => "Июня","Jul" => "Июля","Aug" => "Авг","Sep" => "Сент","Oct" => "Окт","Nov" => "Ноября","Dec" => "Дек",));
return $timep;
}



function _time($i) {
$h  = floor(($i / 3600) - $d * 24); 
$m  = floor(($i - $h * 3600 - $d * 86400) / 60); 
$s  = $i - ($m * 60 + $h * 3600 + $d * 86400);
return ($h > 0 ? ($h < 10 ? '':'').$h.'ч:':'').($m > 0 ? ($m < 10 ? '':'').$m.'м:':'00:').($s > 0 ? ($s < 10 ? '0':'').$s.'с':'00');
}


function _time1($i) {
$h  = floor(($i / 3600) - $d * 24); 
$m  = floor(($i - $h * 3600 - $d * 86400) / 60); 
$s  = $i - ($m * 60 + $h * 3600 + $d * 86400);
return ($h > 0 ? ($h < 10 ? '0':'').$h.':':'').($m > 0 ? ($m < 10 ? '0':'').$m.':':'00:').($s > 0 ? ($s < 10 ? '0':'').$s.'':'00');
}


function tls($tls){
$d=3600*24;
$day=floor($tls/$d);
$tls=$tls-($d*$day);
$hour=floor($tls/3600);
$tls=$tls-(3600*$hour);
$minute=floor($tls/60);
$tls=$tls-(60*$minute);
$second=floor($tls);
$tlss=(($hour*3600)+($minute*60))+$second; 
$dayt="".($day>0?"".$day." д. ":null)."";
$hourt="".($hour>0?"".$hour." ч. ":null)."";
$minutet="".($minute>0?"".$minute." м. ":null)."";
$secondt="".($second>0?"".$second." с. ":null)."";

if($day>0){
$minutet=NULL;
$secondt=NULL;
}
if($hour>0 && $day==0){
$secondt=NULL;
$dayt=NULL;
}
return "".$tlss."";
} /* Вывод оставшегося времени в секундах */





function times($time){
if(!$time)
$time = time(); 
$data = date('j.n.y', $time); 
if ($data == date('j.n.y')) 
$res = ''.date('G:i:s', $time); 
else{
$res = date('j.m.Y', $time); 
} 
return $res; 
}




function time_last($time){
$sec = time()-$time;
if($sec < 60) $_time = $sec." сек. назад";
if($sec >= 60 && $sec < (60*60)) $_time = round($sec/60)." мин. назад";
if($sec >= (60*60) && $sec < ((60*60)*6))$_time = "Сегодня в ".date("H:i",$time);
if($sec >= ((60*60)*6) && $sec < ((60*60)*24)) $_time = round($sec/(60*60))." час. назад";
if($sec >= ((60*60)*24) && $sec < (((60*60)*24)*2)) $_time = "Вчера в ".date("H:i",$time);

if($sec >= (((60*60)*24)*2)){
$__time = date("d F Y в H:i", $time);
$__time = str_replace("January","января",$__time);
$__time = str_replace("February","февраля",$__time);
$__time = str_replace("March","марта",$__time);
$__time = str_replace("April","апреля",$__time);
$__time = str_replace("May","мая",$__time);
$__time = str_replace("June","июня",$__time);
$__time = str_replace("July","июля",$__time);
$__time = str_replace("August","августа",$__time);
$__time = str_replace("September","сентября",$__time);
$__time = str_replace("October","октября",$__time);
$__time = str_replace("November","ноября",$__time);
$__time = str_replace("December","декабря",$__time);
$_time = $__time;
}
return $_time;
}


function tl($tl){
	$d=3600*24;
	$day=floor($tl/$d);
	$tl=$tl-($d*$day);

	$hour=floor($tl/3600);
	$tl=$tl-(3600*$hour);

	$minute=floor($tl/60);
	$tl=$tl-(60*$minute);

	$second=floor($tl);

	$dayt="".($day>0?"".$day."д. ":null)."";
	$hourt="".($hour>0?"".$hour."ч. ":null)."";
	$minutet="".($minute>0?"".$minute."м. ":null)."";
	$secondt="".($second>0?"".$second."с. ":null)."";
	
	if($day>0){
		$minutet=NULL;
		$secondt=NULL;
	}
	if($hour>0 && $day==0){
		$secondt=NULL;
		$dayt=NULL;
	}
	
	return "$dayt$hourt$minutet$secondt";
} /* Вывод оставшегося времени */















function n_f($i) {
	
if($i <0){
$i = 0;
$b = NULL;
}
	
if($i >= 0 && $i < 1){
$i = number_format($i, 0, '', '.');
$i = round($i,1).'';
$b = NULL;
}
if($i >= 1 && $i < 1000) {
$i = number_format($i, 0, '', '.');
$i = round($i,1).'';
$b = NULL;
}
if($i >= 1000 && $i < 1000000) {
$i = number_format($i, 0, '', '.');  
$i = round($i,1).'';
$b = 'k';
}
if($i >= 1000000 && $i < 1000000000) {
$i = number_format($i, 0, '', '.');  
$i = round($i,1).'';
$b = 'm';
}
if($i >= 1000000000 && $i < 1000000000000) {
$i = number_format($i, 0, '', '.');  
$i = round($i,1).'';
$b = 'b';
}
if($i >= 1000000000000 && $i < 1000000000000000) {
$i = number_format($i, 0, '', '.');  
$i = round($i,1).'';
$b = 't';
}
if($i >= 1000000000000000 && $i < 1000000000000000000) {
$i = number_format($i, 0, '', '.');  
$i = round($i,1).'';
$b = 'q';
}
if($i >= 1000000000000000000 && $i < 1000000000000000000000) {
$i = number_format($i, 0, '', '.');  
$i = round($i,1).'';
$b = 'u';
}
if($i >= 1000000000000000000000 && $i < 1000000000000000000000000) {
$i = number_format($i, 0, '', '.');  
$i = round($i,1).'';
$b = 'x';
}
if($i >= 1000000000000000000000000 && $i < 1000000000000000000000000000) {
$i = number_format($i, 0, '', '.');  
$i = round($i,1).'';
$b = 'y';
}
if($i >= 1000000000000000000000000000 && $i < 1000000000000000000000000000000) {
$i = number_format($i, 0, '', '.');  
$i = round($i,1).'';
$b = 'h';
}
if($i >= 1000000000000000000000000000000 && $i < 1000000000000000000000000000000000) {
$i = number_format($i, 0, '', '.');  
$i = round($i,1).'';
$b = 's';
}
if($i >= 1000000000000000000000000000000000 && $i < 1000000000000000000000000000000000000) {
$i = number_format($i, 0, '', '.');  
$i = round($i,1).'';
$b = 'd';
}
if($i >= 1000000000000000000000000000000000000 && $i < 1000000000000000000000000000000000000000) {
$i = number_format($i, 0, '', '.');  
$i = round($i,1).'';
$b = 'v';
}

if ($i == 1000)$i =1;
return $i.$b;
}




?>