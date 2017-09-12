<?php
error_reporting(-1);
ini_set('display_errors',1);
header ('Content type: text/html; charset=utf-8');


function wtf($array, $stop = false) {
    echo '<pre>'.print_r($array,1).'</pre>';
    if(!$stop) {
        exit();
    }
}

/*$arr = array(
    0=>'a',
    1=>'b',
    2=>'c',
    3=>'d');
foreach ($arr as $value) {
    wtf($arr[2]);
}*/

$arr = array(
    0=> array (0=>'aa',1=>'ab',2=>'bb'),
    1=>'b',
    2=>'c',
    3=>'d');
foreach ($arr as $value) {
    wtf($arr[0][1]);
}
