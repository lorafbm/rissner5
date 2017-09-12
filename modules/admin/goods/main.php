<?php
Core:: $META['title']='наш ассортимент';
Core:: $JS[] =  '<script type = text/javascript src="/skins/default/js/scripts_v1.js"></script>';
// удаление группы товаров из БД
if (isset($_POST['delete'])) {
    if (isset($_POST['ids'])) {
        foreach ($_POST['ids'] as $k => $v) {
            $_POST['ids'][$k] = (int)$v;
        }
        $ids = implode(',', $_POST['ids']);
        q("
            DELETE FROM `goods`
            WHERE `id` IN (" . $ids . ")
        ");
        $_SESSION['info'] = '<p class="gamel">Товары были удалены!</p>';
        header("Location: /admin/goods");
        exit();
    }else {
        $_SESSION['info'] = '<p class="gamel"> Не выбраны товары для удаления!</p>';
        header("Location: /admin/goods");
        exit();
    }
}
if (isset ($_GET['action'],$_GET['id']) && $_GET['action'] == 'delete') { // удаление одного товара из БД
    q("
        DELETE FROM `goods`
        WHERE `id`=" . (int)$_GET['id'] . "
    ");
    $_SESSION['info'] = '<p class="gamel">Товар был удален!</p>';
    header("Location: /admin/goods");
    exit();
}

//выборка категорий
$res = q("  
    SELECT *
    FROM `goods_cat`
    ORDER BY `id` 
");

if (isset($_POST['selectcat'])) {
    // получаем список нужных товаров
    $goods = q("
      SELECT *
      FROM `goods` 
      WHERE `category` = '" . res($_POST['category']) . "'
      ORDER BY `id` DESC 
     ");
}else{
    // выборка товаров из БД
    $goods = q("  
      SELECT *
      FROM `goods`
      ORDER BY `id` DESC
");
}

if (isset ($_SESSION['info'])) {
    $infoo = $_SESSION['info'];
    unset ($_SESSION['info']);
}
/*wtf($_FILES, 1);
wtf($_POST, 1);*/


