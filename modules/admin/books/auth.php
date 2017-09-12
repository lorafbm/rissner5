<?php
Core:: $JS[] =  '<script type = text/javascript src="/skins/default/js/scripts_v1.js"></script>';
// удаление группы авторов из БД
if (isset($_POST['delete'])) {
    if (isset($_POST['ids'])) {
        foreach ($_POST['ids'] as $k => $v) {
            $_POST['ids'][$k] = (int)$v;
        }
        $ids = implode(',', $_POST['ids']);
        q("
            DELETE FROM `books_auth`
            WHERE `id` IN (" . $ids . ")
        ");
        // удаление связей
        q("
            DELETE FROM `books2books_auth`
            WHERE `auth_id` IN (" . $ids . ")
        ");

        $_SESSION['info'] = '<p class="gamel">Авторы были удалены!</p>';
        header("Location: /admin/books/auth");
        exit();
    }else {
        $_SESSION['info'] = '<p class="gamel"> Не выбраны авторы для удаления!</p>';
        header("Location: /admin/books/auth");
        exit();
    }
}
if (isset ($_GET['action']) && $_GET['action'] == 'delete') { // удаление одного автора из БД
    q("
        DELETE FROM `books_auth`
        WHERE `id`=" . (int)$_GET['id'] . "
    ");
    //удаление информации  из таблицы связей
    q("
        DELETE FROM `books2books_auth`
        WHERE `auth_id`=" . (int)$_GET['id'] . "
    ");

    $_SESSION['info'] = '<p class="gamel">Автор был удален!</p>';
    header("Location: /admin/books/auth");
    exit();
}

//выборка авторов
$auth = q("  
    SELECT *
    FROM `books_auth`
    ORDER BY `id` 
");
//поиск авторов
if (isset($_POST['serchname'])){
    $auth = q(" 
        SELECT *
        FROM `books_auth` 
        WHERE `name` LIKE '%" . res($_POST['name']) . "%' 
     ");
}


// Добавление автора
if (isset($_POST['submit'], $_POST['add'])) {

    if (empty($_POST['add'])) {
        $error = '<p class="gamel">Заполните поле добавить автора!</p>';
    } else {
        // запрос в БД на проверку автора
        $res = q("
            SELECT `id`
            FROM `books_auth`
            WHERE `name`= '" . res($_POST['add']) . "'
              LIMIT 1
        ");
        if ($res->num_rows) {
            $_SESSION['info'] = '<p class="gamel"> Такой автор уже существует!</p>';
            header("Location: /admin/books/auth");
            exit();
        }
        //вставляем данные в БД
        q("
          INSERT INTO `books_auth` SET
          `name`     = '" . res($_POST['add']) . "'
        ");
        $_SESSION['info'] = '<p class="gamel">Автор успешно добавлен!</p>';
        header("Location: /admin/books/auth");
        exit();
    }
}

if (isset ($_SESSION['info'])) {
    $inf = $_SESSION['info'];
    unset ($_SESSION['info']);
}

/*wtf($_POST, 1);
wtf($_FILES, 1);*/
