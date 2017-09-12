<?php
/*бан*/// динамически баним  авторизированного пользователя
if (isset($_SESSION ['user'])) {
    $res = q("
            SELECT *
            FROM `users`
            WHERE `id`  = '" . (int)$_SESSION['user']['id'] . "'
            LIMIT 1
    ");
    $_SESSION ['user'] = $res->fetch_assoc();
    if ($_SESSION['user']['active'] != 1) {
        include './modules/cab/exit.php';
    }
    //обновляем посл активностьпользователя
    $res = q("
                UPDATE `users` SET
               `datelast`         = NOW()
                WHERE    `id` ='" . (int)$_SESSION['user']['id'] . "'
            ");
    //проверяем, есть ли  в куках браузера клиента наша переменная
} else {
    if (isset($_COOKIE['access1'],$_COOKIE['access2'])) {
        //ищем в базе данных пользователя с таким id
        $res = q(" 
                SELECT *
                FROM `users`
                WHERE  `id`             = '" . res($_COOKIE['access1']) . "'
                  AND  `hash`           = '" . res($_COOKIE['access2']) . "'
                  AND  `ip`             = '" . res($_SERVER['REMOTE_ADDR']) . "'
                  AND  `httpuseragent`  = '" . res($_SERVER['HTTP_USER_AGENT']) . "'
                 ");

        if ($res->num_rows) {                  // если пользователь существует
            //если авторизировалисьто храним в сессии данный идентификатор сессии
            $_SESSION['user'] = $res->fetch_assoc();
            $row = $res->fetch_assoc(); // извлекаем всю информацию о пользователе


        } else {
            include './modules/cab/exit.php';// удаляем куки если не подошли куки или браузер или ip
        }
    }
}




