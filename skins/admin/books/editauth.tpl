<div class="wgoods">
    <p class="game">Редактировать автора:</p>
    <?php if (isset($_SESSION['user'])){ ?>
        <?php if (isset($inf)){ ?>
        <p class="goods"><?php echo $inf;?></p>
        <?php } ?>
    <?php if (isset($error)){echo $error;}?>
    <div class="goods">
    <form action="" method="post">
        <p class="gamel">Автор: <input type="text" name="edit" value="<?php echo hsc($row['name']); ?>">
                   <input type="submit" name="submit" value="Редактировать" class="delete"></p>
    </form>
    </div>
     <?php }?>
</div>

