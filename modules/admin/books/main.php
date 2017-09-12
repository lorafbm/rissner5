<?php
Core:: $JS[] = '<script type = text/javascript src="/skins/default/js/scripts_v1.js"></script>';
// удаление группы книг из БД
if (isset($_POST['delete'])) {
    if (isset($_POST['ids'])) {
        foreach ($_POST['ids'] as $k => $v) {
            $_POST['ids'][$k] = (int)$v;
        }
        $ids = implode(',', $_POST['ids']);
// удаление книг
        q("
            DELETE FROM `books`
            WHERE `id` IN (" . $ids . ")
        ");
// удаление связей
        q("
            DELETE FROM `books2books_auth`
            WHERE `book_id` IN (" . $ids . ")
        ");

        $_SESSION['info'] = '<p class="gamel">Книги были удалены!</p>';
        header("Location: /admin/books");
        exit();
    } else {
        $_SESSION['info'] = '<p class="gamel"> Не выбраны книги для удаления!</p>';
        header("Location: /admin/books");
        exit();
    }
}
if (isset ($_GET['action']) && $_GET['action'] == 'delete') {
    // удаление одной книги из БД
    q("
        DELETE FROM `books`
        WHERE `id`=" . (int)$_GET['id'] . "
    ");
    //удаление информации  из таблицы связей
    q("
       DELETE FROM `books2books_auth`
       WHERE `book_id`=" . (int)$_GET['id'] . "
     ");

    $_SESSION['info'] = '<p class="gamel">Книга была удалена!</p>';
    header("Location: /admin/books");
    exit();
}

//выборка категорий из БД для вывода списка в tpl
$ress = q("  
    SELECT *
    FROM `books_cat`
    ORDER BY `id` 
");

// получаем список нужных книг для вывода их количества всего по категории или без
$booksq = q("
    SELECT COUNT(*)
    FROM `books`
    " . ((isset($_POST['category'])) ? " WHERE `category` = '" . res($_POST['category']) . "'" : "") . "
");
$tnum = $booksq->fetch_row();
$num = $tnum[0];

//выборка категорий (один ко многим)
if (isset($_POST['selectcat'])) {
    //1. получаем список нужных книг
    $list = q("
      SELECT *
      FROM `books` 
      WHERE `category` = '" . res($_POST['category']) . "'
      ORDER BY `id` DESC
    ");
} else {
    // выборка книг из БД
    $list = q("
      SELECT *
      FROM `books`
      ORDER BY `id` DESC
    ");
}

$books = array();

while ($row = $list->fetch_assoc()) {

    $row['author'] = array();
    $books[$row['id']] = $row;
    $id[] = $row['id'];
}

$bookid = implode(",", $id);

//вывод автора(ов):
// 1.выборка связей книги-авторы
$res = q("
    SELECT *
    FROM `books2books_auth`
    WHERE `book_id` IN(" . $bookid . ")
    ORDER BY `book_id`
");

while ($row1 = $res->fetch_assoc()) {
    $books[$row1['book_id']]['author'][] = $row1['auth_id'];
    $iid[] = $row1['auth_id'];
}
$aid = implode(",", $iid);

$avtor = q("
    SELECT *
    FROM `books_auth`
    WHERE `id` IN (" . $aid . ")
    ORDER BY `id` 
");

while ($auth = $avtor->fetch_assoc()) {
    $a[] = $auth['name'];
}


if (isset ($_SESSION['info'])) {
    $inf = $_SESSION['info'];
    unset ($_SESSION['info']);
}

/*wtf($_POST, 1);
wtf($_FILES, 1);
wtf($_GET, 1);*/