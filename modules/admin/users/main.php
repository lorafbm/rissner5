<?php
Core:: $JS[] =  '<script type = text/javascript src="/skins/default/js/scripts_v1.js"></script>';
// удаление группы пользователей из БД
if (isset($_POST['delete'])) {
    if (isset($_POST['ids'])) {
        foreach ($_POST['ids'] as $k => $v) {
            $_POST['ids'][$k] = (int)$v;
        }
        $ids = implode(',', $_POST['ids']);
        q("
            DELETE FROM `users`
            WHERE `id` IN (" . $ids . ")
        ");
        $_SESSION['info'] = 'Пользователи были удалены!';
        header("Location: /admin/users");
        exit();
    }else {
        $_SESSION['info'] = '<p class="gamel"> Не выбраны пользователи для удаления!</p>';
        header("Location: /admin/users");
        exit();
    }
}
if (isset ($_GET['action']) && $_GET['action'] == 'delete') { // удаление одного пользователя из БД
    q("
        DELETE FROM `users`
        WHERE `id`=" . (int)$_GET['id'] . "
    ");
    $_SESSION['info'] = 'Пользователь был удален!';
    header("Location: /admin/users");
    exit();
}
// выборка пользователей из БД
$users = q("
  SELECT *
  FROM `users`
  ORDER BY `id` ASC 
");

// получаем количество пользователей
$numuser = q("
        SELECT COUNT(*)
        FROM `users`
    ");
$tnum = $numuser->fetch_row();
$num = $tnum[0];
//поиск пользователя
if (isset($_POST['serchname'])){
    $users = q(" 
        SELECT *
        FROM `users` 
        WHERE `name` LIKE '%" . res($_POST['name']) . "%' 
     ");
}

if (isset ($_SESSION['info'])) {
   $inf = $_SESSION['info'];
    unset ($_SESSION['info']);
}

