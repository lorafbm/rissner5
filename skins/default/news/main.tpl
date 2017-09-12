<div class="wgoods">
    <!--<h1>Новости:</h1>-->
    <div class="newsnav">
        <a href="/news">Все новости / </a><?php  while($row = $res->fetch_assoc()) { echo '<a
                href="/news?cat='.hsc($row['name']).'&key='.(int)$_GET['key'].'">'.hsc($row['name']).'/</a>'; }?>
    </div>
    <?php if (isset($_GET['cat'])){
    if($num >0){
    echo '<p class="gamel">У нас '.(int)$num.' новостей категории '.hsc($_GET['cat']).':</p>';}
    } else{
    if ($num){ echo '<p class="gamel">У нас всего '.(int)$num. ' новостей:</p>';
    } else { echo '<p class="gamel">У нас пока нет новостей.</p> '; }
    }?>
    <?php echo Pagination::paginator((int)$_GET['key'], $count_pages, $url, $url_page);?>
    <div class="assort">
        <?php if (isset($inf)){ ?>
        <p class="goods"><?php echo $inf;?></p>
        <?php } ?>
        <?php while($row = mysqli_fetch_assoc($news)) { ?>
        <div class="commentboxbody">
            <img src="<?php echo hsc($row['img']); ?>" alt="image" class="imgnews">
            <?php echo'<p class="cat">' .hsc($row['category']).'</p>
            <div class="goods"><p class="name">'.hsc($row['title']).'</p>
                <a href="/news/fulldesc/'.(int)$row['id'].'">'.hsc ($row['description']).'</a>
                <p> '.hsc($row['date']).'</p>' ?>
            </div>
        </div>
        <div class="clear"></div>
        <hr>
        <?php } ?>
    </div>
</div>

