<?php
// получаем список нужных новостей для вывода их количества всего по категории или без
$newsq = q("
    SELECT COUNT(*)
    FROM `news`
    " . ((isset($_GET['cat'])) ? " WHERE `category` = '" . res($_GET['cat']) . "'" : "") . "
");
$tnum = $newsq->fetch_row();
$num = $tnum[0];

/*пагинатор*/
$count_show_pages = 2;// задаем сколько сообщений выводить на странице
$count_pages = (int)(($num - 1) / $count_show_pages) + 1;

if (isset ($_GET['key']) && (int)$_GET['key'] && $_GET['key'] > 0) {

    $limit = (int)$_GET['key'] * $count_show_pages - $count_show_pages;

} else {
    $_GET['key'] = 1;
    $limit = 0;
}

// получаем список нужных новостей по категории или без
$news = q("
    SELECT *
    FROM `news` 
    " . ((isset($_GET['cat'])) ? " WHERE `category` = '" . res($_GET['cat']) . "'" : "") . "
    ORDER BY `id` DESC 
      LIMIT  " . $limit . "," . $count_show_pages . "
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



/*wtf($_GET,1);*/