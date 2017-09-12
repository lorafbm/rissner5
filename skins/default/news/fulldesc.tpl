<div class="wgoods">
    <div class="assort">
        <?php if (isset($inf)){ ?>
        <p class="goods"><?php echo $inf;?></p>
        <?php } ?>
        <?php while($row = mysqli_fetch_assoc($news)) { ?>
        <div class="commentboxbody">
            <img src="<?php echo hsc($row['img']); ?>" alt="image" class="imgnewsf">
            <?php echo'<p class="cat">' .hsc($row['category']).'</p>
            <div class="goods"><p class="name">'.hsc($row['title']).'</p>
                <h6>'.hsc ($row['description']).'</h6>
                <p>'.hsc($row['fulldesc']).'</p>
                <p> '.hsc($row['date']).'</p>' ?>
            </div>
        </div>
        <div class="clear"></div>
        <?php } ?>
    </div>
</div>

