<div class="wgoods">
    <!--<h1>Книги:</h1>-->
    <?php if (isset($_POST['cat'])){
          if($num >0){
    echo '<p class="game">У нас '.(int)$num.' книг категории '.hsc($_POST['cat']).':</p>';}
    } else{
    if ($num){ echo '<p class="game">У нас всего '.(int)$num. ' книг:</p>';
    } else { echo '<p class="game">У нас пока нет книг.</p> '; }
    }?>
    <?php if (isset($inf)){ ?>
    <p class="goods"><?php echo $inf;?></p>
    <?php } ?>
    <form action="" method="post">
        <p class="game">Выберите категорию для просмотра книг:
            <select name="category">
                <?php   while($roww = $ress->fetch_assoc()) { ?>
                <option value="<?php echo hsc($roww['name']);?>"
                <?php if (isset($_POST['category'])&& $_POST['category'] == $roww['name']){ ?> selected <?php } ?> >
                <?php echo hsc($roww['name']); ?></option>
                <?php } ?>
            </select><input type="submit" name="selectcat" value="Найти" class="delete"></p>
    </form>
    <?php foreach ($books as $key => $value) { ?>
    <img src="<?php echo hsc($value['img']); ?>" alt="image" class="imgbb">
    <p class="cat"><?php echo hsc($value['category']); ?></p>
    <p class="name"><?php echo hsc($value['title']); ?></p>
    <?php foreach ($value['author'] as $k =>$v) {
    foreach ($a as $kkk=>$vvv){
    if($k==$kkk){
    $kk=$v-1;
    $v=$a[$kk]; } }?>
    <a href="/books/author?keya=<?php  echo hsc($v); ?> " class="aavtor"><?php echo hsc($v); ?></a><?php }?>
    <p><a href="/books/fulldesc/<?php echo (int)$value['id']; ?> "><?php echo hsc($value['description']); ?></a></p>
    <p>Цена: <span><?php echo number_format(hsc($value['price'])/100,2,',',' '); ?>грн.</span></p>
    <div class="clear"></div>
    <hr>
    <?php  }?>
</div>
