<?php
Core:: $JS[] =  '<script type = text/javascript src="/skins/default/js/scripts_v1.js"></script>';
// удаление группы категорий из БД
if (isset($_POST['delete'])) {
    if (isset($_POST['ids'])) {
        foreach ($_POST['ids'] as $k => $v) {
            $_POST['ids'][$k] = (int)$v;
        }
        $ids = implode(',', $_POST['ids']);
        q("
            DELETE FROM `news_cat`
            WHERE `id` IN (" . $ids . ")
        ");
        $_SESSION['info'] = '<p class="gamel">Категории были удалены!</p>';
        header("Location: /admin/news/cat");
        exit();
    }else {
        $_SESSION['info'] = '<p class="gamel"> Не выбраны категории для удаления!</p>';
        header("Location: /admin/news/cat");
        exit();
    }
}

//выборка категорий
$cat = q("  
  SELECT *
  FROM `news_cat`
  ORDER BY `id` 
  ");

// получаем количество категорий для вывода
$catnum = q("
        SELECT COUNT(*)
        FROM `news_cat`
    ");
$tnum = $catnum->fetch_row();
$num = $tnum[0];



// Добавление категории
if (isset($_POST['submit'], $_POST['add'])) {

    if (empty($_POST['add'])) {
        $error = '<p class="gamel">Заполните поле добавить категорию!</p>';
    } else {
        // запрос в БД на проверку категории
        $res = q("
        SELECT `id`
        FROM `news_cat`
        WHERE `name`= '" . res($_POST['add']) . "'
        LIMIT 1
        ");
        if ($res->num_rows) {
            $_SESSION['info'] = '<p class="gamel"> Такая категория уже существует!</p>';
            header("Location: /admin/news/cat");
            exit();
        }
           //вставляем данные в БД
        q("
         INSERT INTO `news_cat` SET
           `name`     = '" . res($_POST['add']) . "'
      ");
        $_SESSION['info'] = '<p class="gamel">Категория успешно добавлена!</p>';
        header("Location: /admin/news/cat");
        exit();
    }

}

if (isset ($_SESSION['info'])) {
    $inf = $_SESSION['info'];
    unset ($_SESSION['info']);
}

/*wtf($_POST, 1);
wtf($_FILES, 1);*/
