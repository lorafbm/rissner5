<?php
$cat = q("  
    SELECT *
    FROM `goods_cat`
    ORDER BY `id` 
");

$row = $cat->fetch_assoc();
//Редактирование
if (isset($_POST['submit'],$_POST['edit'])) {
    if (!empty($_POST['edit'])) {
        q("
            UPDATE `goods_cat` SET
            `name`     = '" . res($_POST['edit']) . "'
            WHERE `id`=" . (int)$_GET['id'] . "
        ");
        $_SESSION['info'] = 'Категория успешно отредактирована!';
        header("Location: /admin/goods/cat");
        exit();
    } else {
        $_SESSION['info'] = 'Заполните категорию !';
    }
    if (isset($_POST['edit'], $_POST['submit'])) {
        $row['name'] = $_POST['edit'];
    }
}
/*DB::close();*/


if (isset ($_SESSION['info'])) {
    $inf = $_SESSION['info'];
    unset ($_SESSION['info']);
}

/*wtf($_POST, 1);
wtf($_FILES, 1);*/
