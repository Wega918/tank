<?php
//-----Подключаем функции-----//
require_once ('system/function.php');
require_once ('system/header.php');
//-----Переадресация для не зарегистрированных-----//
$title = 'Выход';
if(!$user['id']){
header('Location: /');
exit();
}
if(isset($_REQUEST['okda'])){
setcookie('uslog', '', time() - 86400*31);
setcookie('uspass', '', time() - 86400*31);
mysqli_close($mysqli);
header('location: /');
}
if(isset($_REQUEST['no'])){
if($user['start'] == 0){
header('location: /');
}else{
header('location: /');
}
}

echo '<div class="buy-place-block pt2 mb10">
<div class="medium bold white cntr sh_b mt5 mb5">Покинуть игру?</div>
<a class="simple-but border w50 mXa mb10" w:id="confirmLink" href="'.$HOME.'exit.php?okda"><span><span>да, подтверждаю</span></span></a>
<a class="simple-but border red w50 mXa" w:id="cancelLink" href="'.$HOME.'exit.php?no"><span><span>нет, отмена</span></span></a>
</div>';




require_once ('system/footer.php');
?>