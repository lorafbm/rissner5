<?php
$msg = array();
if (isset($_POST['lastid'])) {
    $lastid = $_POST['lastid'];
} else {
    $lastid = 0;
}
if (isset($_POST['lastiddel'])) {
    $lastiddel = $_POST['lastiddel'];
} else {
    $lastiddel = 0;
}

if ($lastid == 0) {
    $msg['q'] = "SELECT * ,DATE_FORMAT( data,  '%d %M %Y %T'  ) as data
    FROM `chat`
    WHERE `data` > NOW() - INTERVAL 10  SECOND 
     ORDER BY `id` ASC";

    $lm = q($msg['q']);

} else {
    $msg['q'] = "SELECT * ,DATE_FORMAT( data,  '%d %M %Y %T'  ) as data
    FROM `chat`
    WHERE `id` > " . $lastid . "
    ORDER BY `id` ASC";

    $lm = q($msg['q']);
}

if ($lastiddel == 0) {
    //выборка удаленных сообщений
    $msg['del_q'] = "SELECT *
    FROM `chat_delmes`
    WHERE `data` > NOW() - INTERVAL 10  SECOND
    ORDER BY `id` ASC";
    $dm = q($msg['del_q']);

} else {
    $msg['del_q'] = "  SELECT *
     FROM `chat_delmes`
     WHERE `id` > " . $lastiddel . "
     ORDER BY `id` ASC  ";

    $dm = q($msg['del_q']);
}

if ($lm->num_rows) {

    while ($row = $lm->fetch_assoc()) {

        $msg['id'][$row['id']] = $row;
        $msg['lastid'] = $row['id'];

        //вывод получателю другим цветом
        $pos = stripos($row['text'], $_SESSION['user']['name']);
        if ($pos === false) {
            $msg['id'][$row['id']]['bc'] = '#ffffff';
        } else {
            $msg['id'][$row['id']]['bc'] = '#CBE0FA';
        }
    }
}

if ($dm->num_rows) {
    while ($row1 = $dm->fetch_assoc()) {

        $msg['del'][$row1['id']] = $row1;
        $msg['lastiddel'] = $row1['id'];

    }
}
//обновление активных в чате за посл 10 секунд
$au = q("
    SELECT `name`,`id`,`access`,`color`
    FROM `users`
    WHERE `datelast` > NOW() - INTERVAL 10  SECOND 
    ORDER BY `id` ASC 
");
if ($au->num_rows) {

    while ($row2 = $au->fetch_assoc()) {
        $msg['users'][$row2['id']] = $row2;
    }
}
//обновление количества активных в чате за посл 10секунд
$auq = q("
    SELECT `name`,`id`
    FROM `users`
    WHERE `datelast` > NOW() - INTERVAL 10  SECOND 
");

if ($auq->num_rows) {
    $msg['qusers'] = $auq->num_rows;
}

echo json_encode($msg);
exit();
