<div class="wgoods">
    <?php if (isset($_SESSION['user'])){ ?>
    <?php if ($num>0){ echo '<p class="game">У нас '.(int)$num.' категорий:</p>';
    } else { echo '<p class="game">У нас пока нет категорий.</p> '; } ?>
        <?php if (isset($inf)){ ?>
        <p class="goods"><?php echo $inf;?></p>
        <?php } ?>
    <?php if (isset($error)){echo $error;}?>
    <form action="" method="post">
        <p class="gamel">Добавить категорию<input type="text" name="add" class="delete">
                                           <input type="submit" name="submit"  value="Добавить" class="delete"></p>
    </form>
    <div class="goods">
    <form action="" method="post" >
    <hr>
    <?php
        while($row = $cat->fetch_assoc()) { ?>
        <input type="checkbox" name="ids[]" value="<?php echo (int)$row['id']; ?>">
        <a href="/admin/news/cat?action=delete&id=<?php echo (int)$row['id']; ?>" onclick="return del();">Удалить категорию</a>
        <a href="/admin/news/editcat?id=<?php echo (int)$row['id']; ?>">Редактировать категорию</a>
        <?php echo '<p class="name">'.hsc($row['name']). '<hr></p>' ;} ?>
        <input type="submit" name="delete" value="удалить категории" class="delete" onclick="return del();">
    </form>
    </div>
     <?php }?>
</div>

