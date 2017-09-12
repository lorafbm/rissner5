<?php
//выборка категорий для вывода в tpl
$res = q("  
    SELECT *
    FROM `books_cat`
    ORDER BY `id` 
");
//выборка авторов для вывода в tpl
$auth = q("  
    SELECT *
    FROM `books_auth`
    ORDER BY `id` 
");

if (isset($_POST['category'], $_POST['title'], $_POST['fulldesc'], $_POST['description'], $_POST['price'], $_POST['submit'])) {

    $errors = array();

    if (empty($_POST['fulldesc'])) {
        $errors['fulldesc'] = 'Заполните полное описание книги!';
    }
    if (empty($_POST['description'])) {
        $errors['description'] = 'Заполните краткое описание книги!';
    }
    if (empty($_POST['title'])) {
        $errors['title'] = 'Заполните заголовок книги!';
    }
    if (!isset($_POST['author'])) {
        $errors['author'] = 'Заполните автора книги!';
    }
    if (empty($_POST['price'])) {
        $errors['price'] = 'Заполните цену книги!';
    }

    if (isset($_FILES['file'])) {

        if (!empty($_FILES['file']['tmp_name'])) {
            // проверяем, можно ли загружать изображение
            $check = LoadImg::can_upload($_FILES['file']);

            if ($check == 'OK') {

                $check1 = LoadImg::make_upload($_FILES['file']['tmp_name']);

                if ($check1 == 'OK') {

                    $img = LoadImg::resize($_FILES['file']['tmp_name'], 100, 100);

                }else{
                    $errors['img'] = $check1;
                }

            } else {
                $errors['img'] = $check;
            }
        }/* else{//нельзя записать без фото
            $errors['img'] = 'Заполните изображение книги!';
        }*/
    }

    if (!count($errors)) {
        //вставляем книгу в БД
        q("
            INSERT INTO `books` SET
            `category`     = '" . res($_POST['category']) . "',
            `title`        = '" . res($_POST['title']) . "',
            `description`  = '" . res($_POST['description']) . "',
            `fulldesc`     = '" . res($_POST['fulldesc']) . "',
            `price`        =  " . (int)$_POST['price'] . "
            " . ((isset($img)) ? ",`img` = '" . res($img) . "'" : "") . "
        ");
    }
    $book_id = DB::_()->insert_id; // получаем id книги которая добавлена

    $author = hsc($_POST['author']); // Принимаем массив данных с всех checkbox и заносим в переменную

    foreach ($author as $key => $value) {

        if (!count($errors)) {
            q("
                INSERT INTO `books2books_auth` (`auth_id`,`book_id` )
                VALUES (" . (int)$value . "," . (int)$book_id . ")
            ");
        }

    }

    $_SESSION['info'] = 'Книга и связи с автором(и) успешно добавлена(ы)!';
    header("Location: /admin/books");
    exit();

}

DB::close();

/*wtf($_FILES, 1);
wtf($_POST, 1);*/
