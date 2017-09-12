<?php

class Pagination
{

    static function paginator($page, $count_pages, $url, $url_page)
    {

        if ($page != 1) {
            $p1= '<a class="pag" href = "' . hsc($url) . '" title = "Первая страница" >&lt;&lt;&lt;</a>';

            if ($page == 2) {
                $p2= '<a class="pag" href = "' . hsc($url) . '"title = "Предыдущая страница" >&lt;</a>';
            } else {
                $p2= '<a class="pag" href = "' . hsc($url_page) . (int)($page - 1) . '"title = "Предыдущая страница">&lt;</a>';
            }

        }else{
            $p1="";
            $p2="";
        }

        if ($page - 2 > 0) {
            $page2left = ' <a class ="pag" href=' . hsc($url_page) . (int)($page - 2) . '>' . ($page - 2) . '</a>  ';

        }else{
            $page2left="";
        }
        if ($page - 1 > 0) {
            $page1left = '<a class="pag" href=' . hsc($url_page) . (int)($page - 1) . '>' . ($page - 1) . '</a> ';

        }else{
            $page1left="";
        }
        if ($page + 2 <= $count_pages) {
            $page2right = '  <a class="pag" href=' . hsc($url_page) . (int)($page + 2) . '>' . ($page + 2) . '</a>';
        }else{
            $page2right="";
        }
        if ($page + 1 <= $count_pages) {
            $page1right = '  <a class="pag" href=' . hsc($url_page) . (int)($page + 1) . '>' . ($page + 1) . '</a>';
        }else{
            $page1right="";
        }
        if ($page != $count_pages) {
            $p3= '<a class="pag" href="' . hsc($url_page) . (int)($page + 1) . '" title="Следующая страница">&gt;</a>
                    <a class="pag" href="' . hsc($url_page) . (int)$count_pages . '" title="Последняя страница">&gt;&gt;&gt;</a>';
        }else{
            $p3="";
        }

        $paginator = '<div class="paginator">'.$p1.$p2.$page2left . $page1left . '<a class="pagact" href='.$url_page.$page.'>'.$page.'</a>' . $page1right . $page2right.$p3.'</div><div class="clear"></div>';

        return $paginator;
    }

}