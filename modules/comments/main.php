<?php
if (isset($_POST['name'], $_POST['age'], $_POST['email'], $_POST['comments'])) {
    $errors = array();
    if (empty($_POST['name'])) {
        $errors['name'] = '<p class="game">Заполните имя!</p>';
    }
    if (empty($_POST['age'])) {
        $errors['age'] = '<p class="game">Заполните возраст!</p>';
    }
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = '<p class="game">Заполните e-mail!</p>';
    }
    if (empty($_POST['comments'])) {
        $errors['comments'] = '<p class="game">Заполните комментарий!</p>';
    }

    foreach ($errors as $k => $v) {
        $msg['status'] = $v;
        echo json_encode($msg);
        exit();
    }

    if (!count($errors)) {//вставляем данные в БД
        q("
            INSERT INTO `comments` SET 
            `name`    ='" . res($_POST['name']) . "',
            `age`     =" . (int)$_POST['age'] . ",
            `email`   ='" . res($_POST['email']) . "',
            `comments`='" . res($_POST['comments']) . "'
        ");
        /*$_SESSION['ok'] = 'ок!';*/
        /* header("Location: /comments");*/

    }

    // получаем список комментариев для вывода их количества на js
    $com = q("
        SELECT COUNT(*)
        FROM `comments`
    ");
    $tnum = $com->fetch_row();
    $num = $tnum[0];


    $msg['status'] = 'ok';
    $msg['comments'] = $_POST['comments'];
    $msg['name'] = $_POST['name'];
    $msg['age'] = $_POST['age'];
    $msg['email'] = $_POST['email'];
    $msg['data'] = date(" j F Y  h:i:s");
    $msg['num']=$num;
    echo json_encode($msg);
    exit();

}
$res = q("
        SELECT * ,DATE_FORMAT( date,  '%d %M %Y %T'  ) as date
        FROM `comments` ORDER BY `id` DESC 
    ");

// получаем список комментариев для вывода их количества на php
$com = q("
    SELECT COUNT(*)
    FROM `comments` 
");
$tnum = $com->fetch_row();
$num = $tnum[0];


/*if (isset ($_SESSION['ok'])) {
    unset ($_SESSION['ok']);
}*/

/*wtf($_SESSION,1);*/