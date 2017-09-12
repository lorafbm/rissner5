<?php
function wtf($array, $stop = false)
{ // вывод массива
    echo '<pre>' . print_r($array, 1) . '</pre>';
    if (!$stop) {
        exit();
    }
}
function __autoload($class){
    $class = './libs/class_'.$class.'.php';
    if (file_exists($class)){
        include $class;
    }else {
        exit('нет класса с именем' .$class);
    }

}

function hsc($el)
{  // обработка вывод на экран : Преобразует специальные символы в HTML сущности
    if (!is_array($el)) {
        $el = htmlspecialchars($el);
    } else {
        $el = array_map('hsc', $el);
    }
    return $el;
}

/*function res($el)
{     //  Экранирует специальные символы в строке для использования в SQL выражении, используя текущий набор символов соединения
    global $link;
    if (!is_array($el)) {
        $el = mysqli_real_escape_string($link, $el);

    } else {
        $el = array_map('res', $el);
    }
    return $el;
}*/
function res($el,$key=0){
    return DB::_($key)->real_escape_string($el);
}



// запрос в БД
function q($query,$key=0)
{
    $res = DB::_($key)-> query($query);
    if ($res === false) {
        $info = debug_backtrace();
        $error = "QUERY: " . $query ."<br>\n".
            "error: " . DB::_($key)-> error ."<br>\n".
            "the error in file:" . $info[0]['file'] ."<br>\n".
            "on the line: " . $info[0]['line'] ."<br>\n".
            "date: " . date("Y-m-d H-i-s")."<br>\n".
        "=======================================================";


        file_put_contents('./logs/mysql.log', strip_tags($error) . "\n\n", FILE_APPEND);
        echo $error;        exit();
    } else {
        return $res;
    }
}


function trimAll($el)
{ // обработка на удаление пробелов
    if (!is_array($el)) {
        $el = trim($el);
    } else {
        $el = array_map('trimAll', $el);
    }
    return $el;
}

function myInt($el)
{  //  обработка приведения к типу int
    if (!is_array($el)) {
        $el = (int)($el);
    } else {
        $el = array_map('myInt', $el);
    }
    return $el;
}

function myFloat($el)
{  //  обработка приведения к типу float
    if (!is_array($el)) {
        $el = (float)($el);
    } else {
        $el = array_map('myFloat', $el);
    }
    return $el;
}

function MyHash($var)
{
    $salt = 'ABC';
    $salt2 = 'CBA';
    $var = crypt(md5($var . $salt), $salt2);
    return $var;

}
function random_color()
{
    return sprintf( '#%02X%02X%02X', rand(0, 255), rand(0, 255), rand(0, 255) );
}

/*echo '<span style="background: ' . random_html_color() . '">test</span>';*/


