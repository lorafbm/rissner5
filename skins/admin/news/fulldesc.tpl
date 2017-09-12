<div class="wgoods">
    <?php if (isset($_SESSION['user'])){ ?>
    <?php if (isset($inf)){ ?>
    <p class="goods"><?php echo $inf;?></p>
    <?php } ?>
    <?php while($row = mysqli_fetch_assoc($news)) { ?>
    <img src="<?php echo hsc($row['img']); ?>" alt="img1" class="imgnewsf">
    <div class="commentboxbody">
        <?php echo'<p class="cat">' .hsc($row['category']).'</p>
        <div class="goods"><p class="name">'.hsc($row['title']).'</p>
            <h6>'.hsc ($row['description']).'</h6>
            <p>'.hsc($row['fulldesc']).'</p>
            <p>'.hsc($row['date']).'</p>'
            ?>
        </div>
    </div>
    <?php } ?>
    <?php } else { echo '<p class="game">Авторизуйтесь для просмотра новостей!</p>';} ?>
</div>

