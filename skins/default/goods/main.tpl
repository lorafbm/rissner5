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
    <?php while($row = mysqli_fetch_assoc($goods)) { ?>
    <div class="goods">
        <img src="<?php echo hsc($row['img2']); ?>" alt="image">
        <p><?php echo '<p><p class="cat">'.hsc($row['category']).'</p>
        <a href="/goods/fulldesc/'.(int)$row['id'].'" class="kp">'.hsc($row['name']).'</a></p>
        <p><span>Артикул: </span>'.(int)$row['kod'].'</p>
        <p><span>Описание товара:</span> '.hsc($row['description']).'</p>
        <p><span>Доставка: </span>'.hsc($row['transport']).'</p>
        <p><span>Гарантия:</span> '.hsc($row['garantee']).'</p>
        <p><span>В наличии: </span>'.hsc($row['avalible']).'<br>
        <p>Цена: <span class="name">'.number_format(hsc($row['price'])/100,2,',',' ').'грн.</span></p>
        <hr>';?>
    </div>
    <?php } ?>
</div>
