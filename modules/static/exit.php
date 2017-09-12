<?php
if (($_GET['page']) == 'exit') {
    setcookie('access', 'lara', time() - 3600, '/');
    header("Location:" . $_SERVER['HTTP_REFERER']);
    exit();
}