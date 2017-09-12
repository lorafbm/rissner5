<?php
// выборка товаров из БД
$goods = q("  
    SELECT *
    FROM `goods`
    WHERE `id`=" . (int)$_GET['key1'] . "
        LIMIT 1
 ");

if (isset ($_SESSION['info'])) {
    $infoo = $_SESSION['info'];
    unset ($_SESSION['info']);
}


