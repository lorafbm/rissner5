<?php
// выборка книг из БД
$books = q("
    SELECT *
    FROM `books`
    WHERE `id`=" . (int)$_GET['key2'] . "
        LIMIT 1
");
//вывод автора(ов):
// 1.выборка связей книги-авторы
$res = q("  
    SELECT `auth_id`
    FROM `books2books_auth`
    WHERE `book_id`=" . (int)$_GET['key2'] . "
    ORDER BY `id`
");
while ($row1 = $res->fetch_assoc()) {
    $array[] = $row1['auth_id'];
    $v = implode(",", $array);
}
//2.выборка списка нужных авторов
$auth = q("
    SELECT *
    FROM `books_auth`
    WHERE  `id`  IN (" . $v . ")
    ORDER BY `id` DESC
");

if (isset ($_SESSION['info'])) {
    $inf = $_SESSION['info'];
    unset ($_SESSION['info']);
}



