<?php
if (isset($_POST['category'], $_POST['name'], $_POST['kod'], $_POST['avalible'], $_POST['description'], $_POST['transport'], $_POST['garantee'], $_POST['price'], $_POST['submit'])) {

    $errors = array();

    if (empty($_POST['name'])) {
        $errors['name'] = 'Заполните наименование товара!';
    }
    if (empty($_POST['description'])) {
        $errors['description'] = 'Заполните описание товара!';
    }
    if (empty($_POST['transport'])) {
        $errors['transport'] = 'Заполните доставку товара!';
    }
    if (empty($_POST['garantee'])) {
        $errors['garantee'] = 'Заполните гарантию товара!';
    }
    if (empty($_POST['price'])) {
        $errors['price'] = 'Заполните цену товара!';
    }
    if (empty($_POST['kod'])) {
        $errors['kod'] = 'Заполните код товара!';
    }
    if (empty($_POST['avalible'])) {
        $errors['avalible'] = 'Заполните наличие товара!';
    }

    if (isset($_FILES['file'])) {

        if (!empty($_FILES['file']['tmp_name'])) {
            // проверяем, можно ли загружать изображение
            $check = LoadImg::can_upload($_FILES['file']);

            if ($check == 'OK') {
                if (!empty($_FILES['file']['tmp_name'])) {

                    LoadImg::make_upload($_FILES['file']['tmp_name']);

                    $img1 = LoadImg::resize($_FILES['file']['tmp_name'], 200, 300);
                    $img2 = LoadImg::resize($_FILES['file']['tmp_name'], 100, 150);
                }
            } else {
                $errors['img'] = $check;
            }
        }/*else{// нельзя записать без фото
            $errors['img'] = 'Заполните изображение товара!';
        }*/
    }

if (!count($errors)) {//вставляем данные в БД*/
    q("
        INSERT INTO `goods` SET
        `category`     = '" . res($_POST['category']) . "',
        `name`         = '" . res($_POST['name']) . "',
        `description`  = '" . res($_POST['description']) . "',
        `transport`    = '" . res($_POST['transport']) . "',
        `garantee`     = '" . res($_POST['garantee']) . "',
        `avalible`     = '" . res($_POST['avalible']) . "',
        `price`        =  " . (float)$_POST['price'] . ",
        `kod`          =  " . (int)$_POST['kod'] . "
         " . ((isset($img1)) ? ",`img1` = '" . res($img1) . "'" : "") . "
         " . ((isset($img2)) ? ",`img2` = '" . res($img2) . "'" : "") . "
    ");
    $_SESSION['info'] = 'Товар успешно добавлен!';
    header("Location: /admin/goods");
    exit();
}

}
//выборка категорий
$res = q("  
    SELECT *
    FROM `goods_cat`
    ORDER BY `id` 
");

DB::close();


/*wtf($_FILES, 1);
wtf($_POST, 1);
wtf($temp,1);*/