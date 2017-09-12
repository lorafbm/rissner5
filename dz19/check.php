<?php

if (isset($_POST['name'], $_POST['tel'])) {
    $msg['status'] = 'ok';
    echo json_encode($msg);
    exit();
} else {
    $error = 'что то не так';
    $msg['status'] = $error;
    echo json_encode($msg);
    exit();
}
