<div class="wgoods">
    <?php if (isset($_SESSION['user'])){ ?>
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
    <a href="/admin/books/add">Добавить книгу</a>
    <a href="/admin/books/cat">Управление категориями</a>
    <a href="/admin/books/auth">Управление авторами</a>
    <hr>
    <form action="" method="post">
        <?php foreach ($books as $key => $value) { ?>
        <input type="checkbox" name="ids[]" value="<?php echo (int)$value['id']; ?>">
        <a href="/admin/books/main?action=delete&id=<?php echo (int)$value['id']; ?>" onclick="return del();">Удалить
            книгу</a>
        <a href="/admin/books/edit?id=<?php echo (int)$value['id']; ?>">Редактировать книгу</a>
        <img src="<?php echo hsc($value['img']); ?>" alt="image" class="imgb">
        <p class="cat"><?php echo hsc($value['category']); ?></p>
        <p class="name"><?php echo hsc($value['title']); ?></p>
        <?php foreach ($value['author'] as $k =>$v) {
        foreach ($a as $kkk=>$vvv){
        if($k==$kkk){
        $kk=$v-1;
        $v=$a[$kk]; } }?>
        <a href="/admin/books/author?keya=<?php  echo hsc($v); ?> " class="aavtor"><?php echo hsc($v); ?></a><?php }?>
        <p>
            <a href="/admin/books/fulldesc/<?php echo (int)$value['id']; ?> "><?php echo hsc($value['description']); ?></a>
        </p>
        <p>Цена: <span><?php echo number_format(hsc($value['price'])/100,2,',',' '); ?>грн.</span></p>
        <div class="clear"></div>
        <hr>
        <?php  }?>
        <input type="submit" name="delete" value="удалить выбранные книги" class="delete" onclick="return del();">
    </form>
    <?php } else { echo '<p class="game">Авторизуйтесь для просмотра книг!</p>';} ?>
</div>


