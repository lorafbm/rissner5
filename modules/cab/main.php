<?php
if (isset ($_POST['name']) && isset ($_POST['pass']) && isset($_POST['email']) && isset($_POST['age'])) {
    $errors = array();
    if (empty ($_POST['name'])) {
        $errors['name'] = 'Вы не  заполнили логин!';
    } elseif (mb_strlen($_POST['name']) < 2) {
        $errors['name'] = 'Логин слишком короткий!';
    } elseif (mb_strlen($_POST['name']) > 16) {
        $errors['name'] = 'Логин слишком длинный!';
    }
    if (mb_strlen($_POST['pass']) < 5) {
        $errors['pass'] = 'Пароль слишком короткий!';
    }
    if (empty ($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Заполните e-mail!';
    }


    if (!count($errors)) { // запрос в БД на проверку логина
        $res = q("
            SELECT `id`
            FROM `users`
            WHERE `name`= '" . res($_POST['name']) . "'
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
              LIMIT 1
        ");
        if ($res->num_rows) {
            $errors['email'] = 'Такой e-mail уже существует!';
        }
    }


    if (!count($errors)) {//вставляем данные в БД


        q("
           INSERT INTO `users` SET 
          `name`    ='" . res($_POST['name']) . "',
          `pass`    ='" . res(MyHash($_POST['pass'])) . "',
          `color`   ='" . (random_color()) . "',
          `age`     =" . (int)$_POST['age'] . ",
          `email`   ='" . res($_POST['email']) . "',
          `hash`    = '" . MyHash($_POST['name'] . ":" . $_POST['email'] . ":" . $_POST['age']) . "', 
          `date` = NOW()
        ");

        $_SESSION['ok'] = 'Вы авторизованы!Вам было отправлно письмо с дальнейшими инструкциями.';

        $id = mysqli_insert_id($link); // получаем id пользователя который зарегистрировался


        Mail::$to = $_POST['email']; // создаем письмо-подтверждение для активации аккаунта
        Mail::$subject = 'Вы зарегистрировались на сайте!';
        Mail::$text = '
            То пройдите по ссылке для активации вашего аккаунта: ' . CORE::$DOMAIN . '/cab/activate?id=' . $id . '&hash=' .
            MyHash($_POST['name'] . ":" . $_POST['email'] . ":" . $_POST['age']) . '
         ';
        Mail::send();
        header("Location: /cab");
        exit();
    }
}




/*if (isset ($_POST['name']) && isset ($_POST['pass']) && isset($_POST['email'])&&!empty ($_POST['name']) && !empty ($_POST['pass'])&& !empty ($_POST['email'])) {
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $inf = 'email введен корректно!<br>';
        if (($_POST['name'] == 'lara' && $_POST['pass'] == '123' && $_POST['email'] == 'lorik_fbm@mail.ru')or ($_SERVER ['REMOTE_ADDR'] == '127.0.0.1')) {
            setcookie('access', 'lara', time() + 3600, '/');
            $_COOKIE['access'] = 'lara';
        }else {
            $inf.='неправильный логин или пароль!<br>';
        }
    }else {
        $inf = 'введите email корректно! Вы не авторизованы!<br>';
    }
}else {
    $inf = 'Заполните все поля!<br>';
}
if (isset ($_COOKIE['access']) == 'lara') {
    $inf = 'Вы авторизованы! Это закрытая страница. Привет, ' . $_COOKIE['access'] . '!<br>';
}*/