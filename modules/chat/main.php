<?php
//вывод сообщений из бд первый раз
$res = q("
        SELECT * ,DATE_FORMAT( data,  '%d %M %Y %T'  ) as data
        FROM `chat`
        WHERE `data` > NOW() - INTERVAL 1 HOUR
         
    ");
//вывод списка активных пользователей  за посл 10сек
$au = q("
    SELECT `name`,`color`,`access`
    FROM `users`
    WHERE `datelast` > NOW() - INTERVAL 10  SECOND 
");
//удаление

//удаляем из базы сообщения, добавленные ранее 30 минут назад
$res1 = q("
     SELECT *
     FROM `chat`       
     WHERE `data` < NOW() - INTERVAL 30 MINUTE     
     ORDER BY `id` DESC 
     
");
if ($res1->num_rows) {
    $list = array();
    while ($list1 = $res1->fetch_assoc()) {
        $list[] = $list1['id'];
    }
    q("
        DELETE 
        FROM `chat`
        WHERE `id` IN (" . implode(",", $list) . ")
    ");
}
//удаляем данные об удаленных сообщениях
$res2 = q("
     SELECT *
     FROM `chat_delmes`       
     WHERE `data` < NOW() - INTERVAL 30 MINUTE     
     ORDER BY `id` DESC 
     
");
if ($res2->num_rows) {
    $list2 = array();
    while ($list3 = $res2->fetch_assoc()) {
        $list2[] = $list3['id'];
    }
    q("
        DELETE 
        FROM `chat_delmes`
        WHERE `id` IN (" . implode(",", $list2) . ")
    ");
}


//здесь удаление сообщения модератором
if (isset($_SESSION['user']['access']) == 5) {
    if (isset ($_POST['delete'])) {
        $res5 = q("
            SELECT `data`,`name`,`color` ,DATE_FORMAT( data,  '%d %M %Y %T'  ) as data
            FROM `chat`
            WHERE `id` = " . (int)$_POST['id'] . "
 
        ");
        $datames=$res5->fetch_assoc();

        //записываем id удаляемого сообщения в спец таблицу
        q("
            INSERT INTO `chat_delmes` SET
             `id_mes`    = " . $_POST['id'] . ",
             `name`      ='" . hsc($datames['name']) . "',
             `color`     ='" . $datames['color']  . "',
             `data_chat` ='" . $datames['data'] . "',
             `data`   = NOW()
        ");

//меняем текст сообщения на то что оно удалено в БД
        $text = 'Сообщение было удалено!';
        q("
            UPDATE `chat` SET
            `text`     = '"  .hsc($text). "'
            WHERE `id`=" . $_POST['id'] . "
        ");


        $msg['name'] = hsc($datames['name']);
        $msg['data'] = $datames['data'];
        $msg['color'] = $datames['color'];
        $msg['id']=(int)$_POST['id'];

        echo json_encode($msg);
        exit();
    }
}

if (isset ($_SESSION['info'])) {
    $inf = $_SESSION['info'];
    unset ($_SESSION['info']);
}





/*wtf($_SESSION, 1);*/
