<?php
error_reporting(-1);
ini_set('display_errors', 1);
header('Content-type: text/html; charset=utf-8');
session_start();
/*константы,функции,переменные*/


include_once './config.php';
include_once './libs/default.php';

/*  проверка соединения с БД $res=q("SELECT NOW()");
while ($row = $res->fetch_assoc()){
    wtf($row,1);
}
$res->close();
DB::close();
echo 'OK!';
exit();*/

/*$link = mysqli_connect(Core::$DB_LOCAL, Core::$DB_LOGIN, Core::$DB_PASS, Core::$DB_NAME);
mysqli_set_charset($link, 'utf-8');*/

include_once './varibles.php';



/*роутер*/
ob_start();
    include './'. Core::$CONT .'/allpages.php';
    if(!file_exists('./'. Core::$CONT .'/' . $_GET['module'] . '/' . $_GET['page'] . '.php') || !file_exists('./skins/' . Core::$SKIN .'/'.$_GET['module'].'/'.$_GET['page'].'.tpl')){
        header("Location: /404");
        exit();
    }
    include './'. Core::$CONT .'/' . $_GET['module'] . '/' . $_GET['page'] . '.php';

    include './skins/' . Core::$SKIN .'/'.$_GET['module'].'/'.$_GET['page'].'.tpl';

    $content = ob_get_contents();
ob_end_clean();

if(isset($_GET['ajax'])){
    echo $content;
    exit;
}

include './skins/' . Core::$SKIN . '/index.tpl';


