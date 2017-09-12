<?php
if (isset($_GET['hash'], $_GET['id'])) { // меняем поле active в БД на 1
    q("
        UPDATE `users` SET
        `active`     = '1'
         WHERE `id` = " . (int)($_GET['id']) . "
         AND `hash`='" . res($_GET['hash']) . "'
    ");
    $info = 'Вы успешно активировали аккаунт!';
} else {
    $info = 'Вы прошли по неверной ссылке!';
}



