<?php
//добавляем сообщения
if (isset($_POST['text'])) {
    if (empty ($_POST['text'])) {
        $error = 'Заполните сообщение!';
        $msg['status'] = $error;
        echo json_encode($msg);
        exit();
    }

//выборка цвета
    if (!isset($error)) {
//вставляем данные в БД
        q("
            INSERT INTO `chat` SET 
            `name`    ='" . res($_SESSION['user']['name']) . "',
            `color`   ='" . $_SESSION['user']['color'] . "',
            `text`    ='" . res($_POST['text']) . "',
            `data`    = NOW()
        ");
        $latestid = DB::_()->insert_id;// получаем id сообщения которое добавлено
    }

    //вывод получателю другим цветом(если захочет себе написать а вдруг?)
    $pos = stripos($_POST['text'], $_SESSION['user']['name']);

    if ($pos === false) {
        $msg['bc'] = '#ffffff';
    } else {
        $msg['bc'] ='#CBE0FA';
    }

    $msg['status'] = 'ok';
    $msg['data'] = date(" j F Y  h:i:s");
    $msg['id']= $latestid;

    echo json_encode($msg);
    exit();

}




/*wtf($_POST, 1);*/
