<?php
//выборка книг по выбранному автору (многие ко многим)

//1.создаем и заполняем массив авторов для вывода на странице
    $avtor = q("
        SELECT *
        FROM `books_auth`
        ORDER BY `id` 
    ");

    while ($auth1 = $avtor->fetch_assoc()) {
        $a[] = $auth1['name'];
    }

//  2.получаем id автора согласно запроса
    $author = q("
        SELECT `id`
        FROM `books_auth`
        WHERE `name` = '" . res($_GET['keya']) . "'
         LIMIT 1
    ");
    $row2 = $author->fetch_assoc();

// 3. выборка связей книги-авторы
    $res = q("
        SELECT `book_id`
        FROM `books2books_auth`
        WHERE `auth_id`=" . (int)$row2['id'] . "
        ORDER BY `id`
   ");
    $array = array();
    while ($row1 = $res->fetch_assoc()) {
        $array[] = $row1['book_id'];
        $v = implode(",", $array);
    }

//4. выборка списка нужных книг
    $list = q("
        SELECT *
        FROM `books`
        WHERE  `id`  IN (" . $v . ")
        ORDER BY `id`
    ");

    $books = array();

    while ($row = $list->fetch_assoc()) {
        $row['author'] = array();
        $books[$row['id']] = $row;
        $id[] = $row['id'];
    }

    $bookid = implode(",", $id);// id книг нужного автора

    // выборка связей книги-авторы для вывода авторов
    $res1 = q("
        SELECT *
        FROM `books2books_auth`
        WHERE `book_id` IN (" . $bookid . ")
        ORDER BY `id`
    ");

    $array1 = array();
    while ($row2 = $res1->fetch_assoc()) {
        $books[$row2['book_id']]['author'][] = $row2['auth_id'];//массив авторов
    }




if (isset ($_SESSION['info'])) {
    $inf = $_SESSION['info'];
    unset ($_SESSION['info']);
}


/*wtf($_POST, 1);

wtf($_GET, 1);*/