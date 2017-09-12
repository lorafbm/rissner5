<?php
// выборка новостей из БД
$news = q("  
    SELECT *
    FROM `news`
    WHERE `id`=" . (int)$_GET['key2'] . "
      LIMIT 1
");


if (isset ($_SESSION['info'])) {
    $inf = $_SESSION['info'];
    unset ($_SESSION['info']);
}



