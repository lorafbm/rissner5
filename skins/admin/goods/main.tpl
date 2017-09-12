<div class="wgoods">
    <h1>наш ассортимент:</h1>
    <?php if (isset($infoo)){ ?>
    <p class="goods"><?php echo $infoo;?></p>
    <?php } ?>
   <form action="" method="post">
        <p class="game">Выберите категорию товара:
            <select name="category">
                <?php   while($row = $res->fetch_assoc()) { ?>
                <option value="<?php echo hsc($row['name']);?>"
                <?php if (isset($_POST['category'])&& $_POST['category'] == $row['name']){ ?> selected <?php } ?> >
                <?php echo hsc($row['name']); ?></option>
                <?php } ?>
            </select><input type="submit" name="selectcat"  value="Найти" class="delete"></p>
    </form>
    <form action="" method="post" >
        <?php if (isset($_SESSION['user'])){ ?>
        <a href="/admin/goods/add">Добавить товар</a>
        <a href="/admin/goods/cat">Управление категориями</a>
        <hr>
        <?php } ?>
        <?php while($row = mysqli_fetch_assoc($goods)) { ?>
        <?php if (isset($_SESSION['user'])){ ?>
            <input type="checkbox" name="ids[]" value="<?php echo (int)($row['id']); ?>">
            <a href="/admin/goods/main?action=delete&id=<?php echo (int)($row['id']); ?>" onclick="return del();">Удалить товар</a>
            <a href="/admin/goods/edit?id=<?php echo (int)($row['id']); ?>">Редактировать товар</a>
            <?php } ?>
            <div class="goods">
                <img src="<?php echo hsc($row['img2']); ?>" alt="image">
                <p><?php echo '<p class="gname"><p class="cat">'.hsc($row['category']).'</p>
                <a href="/admin/goods/fulldesc/'.(int)$row['id'].'" class="kp">'.hsc($row['name']).'</a></p>
                <p><span>Артикул: </span>'.(int)$row['kod'].'</p>
                <p><span>Описание товара:</span> '.hsc($row['description']).'</p>
                <p><span>Доставка: </span>'.hsc($row['transport']).'</p>
                <p><span>Гарантия:</span> '.hsc($row['garantee']).'</p>
                <p>Цена: <span class="name">'.number_format(hsc($row['price'])/100,2,',',' ').'грн.</span></p>
                <p><span>В наличии: </span>'.hsc($row['avalible']).'<br>
                <hr>
                ';?>
            </div>
            <div class="clear"></div>
        <?php } ?>
        <?php if (isset($_SESSION['user'])){ ?>
        <input type="submit" name="delete" value="удалить выбранные товары" class="delete" onsubmit="return del();" >
        <?php } ?>
    </form>
</div>
