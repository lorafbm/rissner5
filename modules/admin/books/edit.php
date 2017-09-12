<?php
if (isset($_POST['category'], $_POST['title'], $_POST['fulldesc'], $_POST['description'], $_POST['price'],$_POST['submit'])) {
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
    if (!isset($_POST['price'])) {
        $errors['price'] = 'Заполните цену книги!';
    }

    if (isset($_FILES['file'])) {

        if (!empty($_FILES['file']['tmp_name'])) {
            // проверяем, можно ли загружать изображение
            $check = LoadImg::can_upload($_FILES['file']);

            if ($check == 'OK') {
                if (!empty($_FILES['file']['tmp_name'])) {

                    LoadImg::make_upload($_FILES['file']['tmp_name']);

                    $img = LoadImg::resize($_FILES['file']['tmp_name'], 100, 100);

                }
            } else {
                $errors['img'] = $check;
            }
        }
    }
    if (!count($errors)) {//вставляем данные в БД*/
        q("
            UPDATE `books` SET
            `category`     = '" . res($_POST['category']) . "',
            `title`        = '" . res($_POST['title']) . "',
            `description`  = '" . res($_POST['description']) . "',
            `fulldesc`     = '" . res($_POST['fulldesc']) . "',
            `price`        =  " . (int)$_POST['price'] . "
            " . ((isset($img)) ? ",`img` = '" . res($img) . "'" : "") . "
            WHERE `id`=" . (int)$_GET['id'] . "
        ");
//удаление информации  из таблицы связей
        q("
           DELETE FROM `books2books_auth`
            WHERE `book_id`=" . (int)$_GET['id'] . "
         ");
//добавляем заново инфу в тбл связей
        $author = hsc($_POST['author']); // Принимаем массив данных с всех checkbox и заносим в переменную
        foreach ($author as $key => $value) {
            q("
                INSERT INTO `books2books_auth` (`auth_id`,`book_id` )
                VALUES (" . (int)$value . "," . (int)$_GET['id'] . ")
            ");
        }
        $_SESSION['info'] = 'Книга успешно отредактирована!';
        header("Location: /admin/books/main");
        exit();
    }
}
//вывод книг
$books = q("
    SELECT *
    FROM `books`
    WHERE `id`=" . (int)$_GET['id'] . "
    LIMIT 1
");
//выборка категорий
$res = q("  
    SELECT `name`
    FROM `books_cat`
    ORDER BY `id` 
");
//выборка авторов
$auth = q("  
    SELECT *
    FROM `books_auth`
    ORDER BY `id` 
");

//выборка связи автора с книгой
$link = q("  
    SELECT *
    FROM `books2books_auth`
    WHERE `book_id`=" . (int)$_GET['id'] . "
    ORDER BY `id`
");
$array = array();
while ($res5 = $link->fetch_assoc()) {
    $array[] = $res5['auth_id'];
}
if (!$books->num_rows) {
    $_SESSION['info'] = 'Данной книги не существует !</p>';
    header("Location: /admin/books");
    exit();
}

$row = $books->fetch_assoc();
if (isset($_POST['category'], $_POST['title'], $_POST['fulldesc'], $_POST['description'], $_POST['author'], $_POST['price'],$_POST['submit'])) {
    $row['category'] = $_POST['category'];
    $row['title'] = $_POST['title'];
    $row['fulldesc'] = $_POST['fulldesc'];
    $row['description'] = $_POST['description'];
    $row['author'] = $_POST['author'];
    $row['price'] = $_POST['price'];
}


/*wtf($_FILES, 1);
wtf($_POST, 1);*/


