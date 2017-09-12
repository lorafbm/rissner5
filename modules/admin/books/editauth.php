<?php
$auth = q("  
    SELECT *
    FROM `books_auth`
    WHERE `id`= " . (int)$_GET['id'] . "
");

$row = $auth->fetch_assoc();
//Редактирование
if (isset($_POST['submit'],$_POST['edit'])) {


    if (!empty($_POST['edit'])) {
        q("
            UPDATE `books_auth` SET
            `name`     = '" . res($_POST['edit']) . "'
            WHERE `id`=" . (int)$_GET['id'] . "
        ");
        $_SESSION['info'] = 'Автор успешно отредактирован!';
        header("Location: /admin/books/auth");
        exit();
    } else {
        $_SESSION['info'] = 'Заполните автора !';
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
