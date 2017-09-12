<div class="wgoods">
    <h4><?php if ($res->num_rows){ echo 'У нас '.(int)$res->num_rows.' книги автора '.hsc($_GET['keya']) ; } ?>:</h4>
    <?php if (isset($inf)){ ?>
    <p class="goods"><?php echo $inf;?></p>
    <?php } ?>
    <?php foreach ($books as $key => $value) { ?>
    <img src="<?php echo hsc($value['img']); ?>" alt="img" class="imgfn">
    <p class="cat"><?php echo hsc($value['category']); ?></p>
    <p class="name"><?php echo hsc($value['title']); ?></p>
    <?php foreach ($value['author'] as $k =>$v) {
    foreach ($a as $kkk=>$vvv){
    if($k==$kkk){
    $kk=$v-1;
    $v=$a[$kk]; } }?>
    <p class="aavtor"><?php echo hsc($v); ?></p><?php }?>
    <p><a href="/books/fulldesc/<?php echo (int)$value['id']; ?> "><?php echo hsc($value['description']); ?></a></p>
    <p>Цена: <span><?php echo number_format(hsc($value['price'])/100,2,',',' '); ?>грн.</span></p>
    <div class="clear"></div>
    <hr>
    <?php } ?>
</div>
