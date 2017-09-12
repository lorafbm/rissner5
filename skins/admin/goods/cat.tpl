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
        <table class="users">
            <tr class="str">
                <td>Поиск:</td>
                <td></td>
                <td><input type="text" name="name"
                           value="<?php if (isset($_POST['name'])){echo hsc($_POST['name']);} ?>">
                    <input type="submit" name="serchname" style="display: none"></td>
                <td></td>
            </tr>
            <?php while($row = $cat->fetch_assoc()) { ?>
            <tr>
                <td><input type="checkbox" name="ids[]" value="<?php echo (int)$row['id']; ?>"></td>
                <td><a href="/admin/goods/cat?action=delete&id=<?php echo (int)$row['id']; ?>" class="inna" onclick="return del();">Удалить</a></td>
                <td><a href="/admin/goods/editcat?id=<?php echo (int)$row['id']; ?>" class="inn">Редактировать</a></td>
                <td><?php echo '<b>'.hsc($row['name']).'</b>'; ?></td>
            </tr>
            <?php } ?>
        </table>
        <input type="submit" name="delete" value="удалить" class="delete" onclick="return del();">
    </form>
    </div>
     <?php }?>
</div>

