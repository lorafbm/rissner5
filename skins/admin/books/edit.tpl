<?php if (isset($_SESSION['user'])){ ?>
<div class="wgoods">
    <h1>Редактировать книгу:</h1>
    <hr>
    <img src="<?php echo hsc($row['img']); ?>" alt="img">
    <form action="" method="post" enctype="multipart/form-data" class="file">
        <table class="addgoods">
            <tr>
                <td><input type="file" name="file"></td>
                <td><?php if (isset($errors['img'])){echo $errors['img'];}?></td>
            </tr>
            <tr>
                <td>Категория книги:<select name="category">
                        <?php  while($cat = $res->fetch_assoc()){ ?>
                        <option value="<?php echo hsc($cat['name']);?>"
                        <?php if($row['category'] == $cat['name']){ ?> selected <?php } ?>
                        ><?php echo hsc($cat['name']); ?></option>
                        </option>;<?php }?>
                    </select>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Заголовок: <input type="text" name="title" value="<?php echo hsc($row['title']); ?>"></td>
                <td><?php if (isset($errors['title'])){echo $errors['title'];}?></td>
            </tr>
            <tr>
                <td>Автор:
                    <?php  while($author = $auth->fetch_assoc()){ ?>
                    <input type="checkbox" class="author" name="author[]" value="<?php echo (int)$author['id'];?>"
                    <?php if(in_array($author['id'],$array)){ ?> checked <?php } ?>><?php echo hsc($author['name']); ?>
                    <?php }?>
                </td>
                <td><?php if (isset($errors['author'])){echo $errors['author'];}?></td>
            </tr>
            <tr>
                <td>Краткое описание книги:<textarea
                            name="description"><?php echo hsc($row['description']); ?></textarea>
                </td>
                <td><?php if (isset($errors['description'])){echo $errors['description'];}?></td>
            </tr>
            <tr>
                <td>Полное описание книги:<textarea name="fulldesc"><?php echo hsc($row['fulldesc']); ?></textarea></td>
                <td><?php if (isset($errors['fulldesc'])){echo $errors['fulldesc'];}?></td>
            </tr>
            <tr>
                <td>Цена: <input type="text" name="price" value="<?php   echo number_format(hsc($row['price'])/100,2,',','').'грн.'; ?>">
                 Введите цену с копейками без ,</td>
                <td><?php if (isset($errors['price'])){echo $errors['price'];}?></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Редактировать книгу" class="subedit"></td>
            </tr>
        </table>
    </form>
</div>
<?php } ?>
