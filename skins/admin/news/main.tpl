<div class="wgoods">
    <?php if (isset($_SESSION['user'])){ ?>
    <!--<h1>Новости:</h1>-->
    <div class="newsnav">
        <a href="/admin/news">Все новости / </a><?php  while($row = $res->fetch_assoc()) { echo '<a
                href="/admin/news?cat='.hsc($row['name']).'&key='.(int)$_GET['key'].'">'.hsc($row['name']).' /</a>'; }?>
    </div>
    <?php if (isset($_GET['cat'])){
    if($num >0){
    echo '<p class="gamel">У нас '.(int)$num.' новостей категории '.hsc($_GET['cat']).':</p>';}
    } else{
    if ($num){ echo '<p class="gamel">У нас всего '.(int)$num. ' новостей:</p>';
    } else { echo '<p class="gamel">У нас пока нет новостей.</p> '; }
    }?>
    <?php echo Pagination::paginator((int)$_GET['key'], $count_pages, $url, $url_page);?>
    <?php if (isset($inf)){ ?>
    <p class="goods"><?php echo $inf;?></p>
    <?php } ?>
    <a href="/admin/news/add">Добавить новость</a>
    <a href="/admin/news/cat">Управление категориями</a>
    <hr>
    <form action="" method="post">
        <?php while($row = $news->fetch_assoc()) { ?>
        <input type="checkbox" name="ids[]" value="<?php echo (int)$row['id']; ?>">
        <a href="/admin/news/main?action=delete&id=<?php echo (int)$row['id']; ?>" onclick="return del();">Удалить
            новость</a>
        <a href="/admin/news/edit?id=<?php echo (int)$row['id']; ?>">Редактировать новость</a>
        <div class="commentboxbody">
            <img src="<?php echo hsc($row['img']); ?>" alt="image" class="imgnews">
            <?php echo'<p class="cat">' .hsc($row['category']).'</p>
            <div class="goods"><p class="name">'.hsc($row['title']).'</p>
                <a href="/admin/news/fulldesc/'.(int)$row['id'].'">'.hsc ($row['description']).'</a>
                <p>'.hsc($row['date']).'</p>' ?>
            </div>
        </div>
        <div class="clear"></div>
        <hr>
        <?php } ?>
        <input type="submit" name="delete" value="удалить выбранные новости" class="delete" onclick="return del();">
    </form>
    <?php } else { echo '<p class="game">Авторизуйтесь для просмотра новостей!</p>';} ?>
</div>

