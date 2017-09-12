<?php
Core:: $JS[] = '<script type = text/javascript src="/skins/default/js/scripts_v1.js"></script>';
// удаление группы товаров из БД
if (isset($_POST['delete'])) {
    if (isset($_POST['ids'])) {
        foreach ($_POST['ids'] as $k => $v) {
            $_POST['ids'][$k] = (int)$v;
        }
        $ids = implode(',', $_POST['ids']);
        q("
            DELETE FROM `news`
            WHERE `id` IN (" . $ids . ")
        ");
        $_SESSION['info'] = '<p class="gamel">Новости были удалены!</p>';
        header("Location: /admin/news");
        exit();
    } else {
        $_SESSION['info'] = '<p class="gamel"> Не выбраны новости для удаления!</p>';
        header("Location: /admin/news");
        exit();
    }
}
if (isset ($_GET['action']) && $_GET['action'] == 'delete') { // удаление одной новости из БД
    q("
        DELETE FROM `news`
        WHERE `id`=" . (int)$_GET['id'] . "
    ");
    $_SESSION['info'] = '<p class="gamel">Новость была удалена!</p>';
    header("Location: /admin/news");
    exit();
}
// получаем список нужных новостей для вывода их количества всего по категории или без
$newsq = q("
    SELECT COUNT(*)
    FROM `news`
    " . ((isset($_GET['cat'])) ? " WHERE `category` = '" . res($_GET['cat']) . "'" : "") . "
");
$tnum = $newsq->fetch_row();
$num = $tnum[0];

/*пагинатор*/
$count_show_pages=2;// задаем сколько сообщений выводить на странице
$count_pages= (int)(($num-1)/$count_show_pages)+1;

if (isset ($_GET['key'])) {
    if (($_GET['key']<0) || !is_numeric($_GET['key'])) {
        $_GET['key'] = 1;
    }
    $limit = $_GET['key'] * $count_show_pages - $count_show_pages;

}
else {
    $_GET['key'] = 1;
    $limit = 0;
}

// получаем список нужных новостей по категории или без
$news = q("
    SELECT *
    FROM `news` 
    " . ((isset($_GET['cat'])) ? " WHERE `category` = '" . res($_GET['cat']) . "'" : "") . "
    ORDER BY `id` DESC 
      LIMIT  ".$limit.",".$count_show_pages."
  ");

if (isset($_GET['cat'])) {
  $url = '/news?cat=' . hsc($_GET['cat']);
  $url_page = '/news?cat=' . hsc($_GET['cat']) . '&key=';
} else {
    $url = '/news';
    $url_page = '/news?key=';
}

//выборка категорий для вывода ссылок категорий
$res = q("  
    SELECT *
    FROM `news_cat`
    ORDER BY `id` 
");

if (isset ($_SESSION['info'])) {
    $inf = $_SESSION['info'];
    unset ($_SESSION['info']);
}

/*wtf($_POST, 1);
wtf($_FILES, 1);*/
