<div class="wgoods">
    <?php if (isset($infoo)){ ?>
    <p class="goods"><?php echo $infoo;?></p>
    <?php } ?>
    <?php if (isset($_SESSION['user'])){
             while($row = mysqli_fetch_assoc($goods)) { ?>
    <img src="<?php echo hsc($row['img1']); ?>" alt="img1" class="imgg">
    <img src="<?php echo hsc($row['img2']); ?>" alt="img2" class="imgg">
    <div class="goods"><?php echo '<p class="name">'.hsc($row['name']).'</p>
        <p><span>Описание товара:</span> '.hsc($row['description']).'</p>
        <p><span>Артикул: </span>'.(int)$row['kod'].'</p>
        <p><span>Доставка: </span>'.hsc($row['transport']).'</p>
        <p><span>Гарантия:</span> '.hsc($row['garantee']).'</p>
        <p><span>В наличии: </span>'.hsc($row['avalible']).'<br>
        <p> Цена: <span class="name">'.number_format(hsc($row['price'])/100,2,',',' ').'грн.</span></p>
        ';?>
    </div>
    <?php }} ?>
</div>
