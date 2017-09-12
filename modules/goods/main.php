<?php
// выборка товаров из БД
$goods = q("  
    SELECT *
    FROM `goods`
    ORDER BY `id` DESC
");
//выборка категорий
$res = q("  
    SELECT *
    FROM `goods_cat`
    ORDER BY `id` 
");
if (isset($_POST['selectcat'])) {
// получаем id категории соласно запрошенной пользователем
    $cat = q(" 
        SELECT `name`
        FROM `goods_cat` 
        WHERE `name` = '" . res($_POST['category']) . "'
    ");
    $row = $cat->fetch_assoc();
    // получаем список нужных товаров
    $goods = q("
        SELECT *
        FROM `goods` 
        WHERE `category` = '" . res($row['name']) . "'
        ORDER BY `id` DESC 
    ");
}

if (isset ($_SESSION['info'])) {
    $infoo = $_SESSION['info'];
    unset ($_SESSION['info']);
}

