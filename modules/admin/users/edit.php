<?php
Core:: $JS[] =  '<script type = text/javascript src="/skins/default/js/scripts_v1.js"></script>';
if (isset($_POST['name'], $_POST['age'], $_POST['email'], $_POST['access'],$_POST['color'], $_POST['submit'])) {

    $errors = array();

    if (empty ($_POST['name'])) {
        $errors['name'] = 'Вы не  заполнили логин!';
    } elseif (mb_strlen($_POST['name']) < 2) {
        $errors['name'] = 'Логин слишком короткий!';
    } elseif (mb_strlen($_POST['name']) > 16) {
        $errors['name'] = 'Логин слишком длинный!';
    }
    if (empty ($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Заполните e-mail!';
    }
    if (empty($_POST['age'])) {
        $errors['age'] = 'Заполните возраст!';
    }
    if (empty($_POST['color'])) {
        $errors['color'] = 'Заполните цвет!';
    }
    if (empty($_POST['access'])) {
        $errors['access'] = 'Заполните права доступа!';
    }

    if (!count($errors)) { // запрос в БД на проверку логина
        $res = q("
        SELECT `id`
        FROM `users`
        WHERE `name`= '" . res($_POST['name']) . "'
        AND `id`   <>" . (int)$_GET['id'] . "
        LIMIT 1
        ");
        if ($res->num_rows) {
            $errors['name'] = 'Такой логин уже существует!';
        }
    }
    if (!count($errors)) {// запрос в БД на проверку e mail
        $res = q("
        SELECT `id`
        FROM `users`
        WHERE `email`= '" . res($_POST['email']) . "'
        AND `id`  <>" . (int)$_GET['id'] . "
        LIMIT 1
        ");

        if ($res->num_rows) {
            $errors['email'] = 'Такой e-mail уже существует!';
        }
    }

    if (isset($_FILES['file'])) {

        if (!empty($_FILES['file']['tmp_name'])) {

            // проверяем, можно ли загружать изображение
            $check = LoadImg::can_upload($_FILES['file']);

            if ($check == 'OK') {

                LoadImg::make_upload($_FILES['file']['tmp_name']);

                $img = LoadImg::resize($_FILES['file']['tmp_name'], 100, 100);

            } else {
                $errors['img'] = $check;
            }

        }
    }


    if (!count($errors)) {   //вставляем данные в БД*/

        q("
          UPDATE `users` SET
          `name`           = '" . res($_POST['name']) . "',
          `age`            = '" . (int)($_POST['age']) . "',
          `color`          = '" . res($_POST['color']) . "',
          `active`         = '" . (int)($_POST['active']) . "',
          `email`          = '" . res($_POST['email']) . "',
          `access`         = '" . (int)($_POST['access']) . "',
          `ip`             = '" . res($_POST['ip']) . "',
          `httpuseragent`  = '" . res($_POST['httpuseragent']) . "'
                    " . ((isset($img)) ? ",`img` = '" . res($img) . "'" : "") . "
          " . ((!empty($_POST['pass'])) ? ",`pass` = '" . res(MyHash($_POST['pass'])) . "'" : "") . "
         
          WHERE `id`       =" . (int)$_GET['id'] . "
        ");

        $_SESSION['info'] = 'Пользователь успешно отредактирован!';
        header("Location: /admin/users/main");
        exit();
    }

}
DB::close();

$users = q("
  SELECT *
  FROM `users`
  WHERE `id`=" . (int)$_GET['id'] . "
  LIMIT 1
  ");
if (!$users->num_rows) {
    $_SESSION['info'] = 'Данного пользователя не существует !</p>';
    header("Location: /admin/users");
    exit();
}

$row = $users->fetch_assoc();

if (isset($_POST['name'], $_POST['age'], $_POST['color'],$_POST['active'], $_POST['email'], $_POST['access'], $_POST['ip'], $_POST['httpuseragent'])) {

    $row['name'] = $_POST['name'];
    $row['age'] = $_POST['age'];
    $row['color'] = $_POST['color'];
    $row['active'] = $_POST['active'];
    $row['email'] = $_POST['email'];
    $row['access'] = $_POST['access'];
    $row['ip'] = $_POST['ip'];
    $row['httpuseragent'] = $_POST['httpuseragent'];

}



/*wtf($_FILES, 1);
wtf($_POST, 1);*/







