<?php
/*авторизация*/
if (isset($_POST['name'], $_POST['pass'])) {
    $res = q("
        SELECT *
        FROM `users`
        WHERE `name` ='" . res($_POST['name']) . "'
        AND `pass`   ='" . res(MyHash($_POST['pass'])) . "'
        AND `active` = 1
         LIMIT 1
    ");
    if ($res->num_rows) {
        $_SESSION['user'] = $res->fetch_assoc();//если авторизировалисьто храним в сессии данный идентификатор сессии
        $row = $res->fetch_assoc(); // извлекаем всю информацию о пользователе
        $_SESSION['info'] = '<p class="game">Вы авторизованы,' . hsc($_SESSION['user']['name']) . '!<p>';

        if (isset($_SESSION['user'])) {
            $_SESSION['info3']='<p class="game"><a  href= "/cab/edit?id='.$_SESSION['user']['id'].'" class="gamea" >Редактировать профиль пользователя  ' .$_SESSION['user']['name'] .':</a></p>';
            if ($_SESSION['user']['access'] == 1) {
                $_SESSION['info1'] = '<p class="game">У вас недостаточно прав для управления контентом сайта, ' . $_SESSION['user']['name'] . '!</p>';
            }elseif ($_SESSION['user']['access'] == 5) {
                $_SESSION['info2'] = '<p class="game">Добро пожаловать в управление контентом сайта, ' . $_SESSION['user']['name'] . '!</p>';
            }
        }
        if (isset($_POST['remember'])) {
            //новые ключи записываем в cookies браузера пользователя
            setcookie('access1', $_SESSION['user']['id'], time() + 60 * 60 * 24);
            $_COOKIE['access1'] = $_SESSION['user']['id'];
            setcookie('access2', MyHash($row['name'] . $row['email']), time() + 60 * 60 * 24);
            $_COOKIE['access2'] = MyHash($row['name'] . $row['email']);
            $new_hash = MyHash($row['name'] . $row['email']);//генерируем новый секретный ключ из (логина +email)
            // всю вычисленную информацию записываем в базу данных;
            $res = q("
                UPDATE `users` SET
                `ip`               ='" . res($_POST['ip']) . "',
                `httpuseragent`    ='" . res($_POST['hua']) . "',
                `hash`             ='" . res($new_hash) . "'
                   WHERE    `name` ='" . res($_POST['name']) . "'
            ");
        }
        $msg['status']='ok';
        $msg['name'] = $_SESSION['user']['name'];
        echo json_encode($msg);
        exit();
    } else {
        $error = 'Нет пользователя с таким логином или паролем!';
        if (isset($_COOKIE['access1'], $_COOKIE['access2'])) {
            include './modules/cab/exit.php';
        }
        $msg['status']=$error;
        echo json_encode($msg);
        exit();
    }
}

/*wtf($_SESSION,1);
wtf($_POST,1);
wtf($_COOKIE,1);*/