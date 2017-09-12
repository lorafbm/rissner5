<div class="wgoods">
    <?php if (isset($inf)){ ?>
    <p class="goods"><?php echo $inf;?></p>
    <?php } ?>
    <div class="goods">
        <?php while($row2 = $auth->fetch_assoc()) { ?>
        <p class="auth"><a
                    href="/admin/books/author/<?php echo  hsc($row2['name']); ?>"><?php echo  hsc($row2['name']); ?></a>
        </p><?php } ?>
        <?php while($row = $books->fetch_assoc()) { ?>
        <img src="<?php echo hsc($row['img']); ?>" alt="img1" class="imgbf">
        <div class="commentboxbody">
            <?php echo'<p class="cat">' .hsc($row['category']).'</p>
            <p class="name">'.hsc($row['title']).'</p>
            <p>'.hsc($row['fulldesc']).'</p>
            <p> Цена: <span class="name">'.number_format(hsc($row['price'])/100,2,',',' ').'грн.</span></p>'; ?>
        </div>
    </div>
    <?php } ?>
</div>

