<?php
// получаем список нужных книг для вывода их количества всего по категории или без
$booksq = q("
    SELECT COUNT(*)
    FROM `books`
    " . ((isset($_POST['category'])) ? " WHERE `category` = '" . res($_POST['category']) . "'" : "") . "
");
$tnum = $booksq->fetch_row();
$num = $tnum[0];


//выборка категорий из БД для вывода списка в tpl
$ress = q("  
  SELECT *
  FROM `books_cat`
  ORDER BY `id` 
  ");

//выборка категорий (один ко многим)
if (isset($_POST['selectcat'])) {

// 1. получаем id категории соласно запрошенной пользователем
    $cat = q(" 
        SELECT `name`
        FROM `books_cat` 
        WHERE `name` = '" . res($_POST['category']) . "'
          
    ");
    $row3 = $cat->fetch_assoc();
    //2. получаем список нужных книг
    $list = q("
        SELECT *
        FROM `books` 
        WHERE `category` = '" . res($row3['name']) . "'
        ORDER BY `id` DESC
    ");
}else{
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
    ORDER BY `id`
");

while ($row1 = $res->fetch_assoc()) {
    $books[$row1['book_id']]['author'][] = $row1['auth_id'];
    $iid[] = $row1['auth_id'];
}
$aid=implode(",", $iid);

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