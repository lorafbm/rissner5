<?php
if (isset($_POST['category'], $_POST['title'], $_POST['fulldesc'], $_POST['description'], $_POST['submit'])) {
    $errors = array();

    if (empty($_POST['fulldesc'])) {
        $errors['fulldesc'] = 'Заполните полное описание новости!';
    }
    if (empty($_POST['description'])) {
        $errors['description'] = 'Заполните краткое описание новости!';
    }
    if (empty($_POST['title'])) {
        $errors['title'] = 'Заполните заголовок новости!';
    }

    if (isset($_FILES['file'])) {

        if (!empty($_FILES['file']['tmp_name'])) {
            // проверяем, можно ли загружать изображение
            $check = LoadImg::can_upload($_FILES['file']);

            if ($check == 'OK') {

                LoadImg::make_upload($_FILES['file']['tmp_name']);

                $img = LoadImg::resize($_FILES['file']['tmp_name'], 200, 300);

            } else {
                $errors['img'] = $check;
            }
        }
    }


    if (!count($errors)) {//вставляем данные в БД*/
        q("
          UPDATE `news` SET
          `category`     = '" . res($_POST['category']) . "',
          `title`        = '" . res($_POST['title']) . "',
          `description`  = '" . res($_POST['description']) . "',
          `fulldesc`     = '" . res($_POST['fulldesc']) . "',
         " . ((isset($img)) ? "`img` = '" . res($img) . "'," : "") . "
          `date`         = NOW()
          WHERE `id`=" . (int)$_GET['id'] . "
        ");
        $_SESSION['info'] = 'Новость успешно отредактирована!';
        header("Location: /admin/news/main");
        exit();
    }

}
//выборка категорий
$res = q("  
  SELECT *
  FROM `news_cat`
  ORDER BY `id` 
  ");

$news = q("
  SELECT *
  FROM `news`
  WHERE `id`=" . (int)$_GET['id'] . "
  LIMIT 1
  ");
if (!$news->num_rows) {
    $_SESSION['info'] = 'Данной новости не существует !</p>';
    header("Location: /admin/news");
    exit();
}

$row = $news->fetch_assoc();
if (isset($_POST['category'], $_POST['title'], $_POST['fulldesc'], $_POST['description'], $_POST['submit'])) {
    $row['category'] = $_POST['category'];
    $row['title'] = $_POST['title'];
    $row['fulldesc'] = $_POST['fulldesc'];
    $row['description'] = $_POST['description'];

}











/*wtf($_FILES, 1);
wtf($_POST, 1);*/

