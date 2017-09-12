<?php if (isset($_SESSION['user'])){ ?>
<div class="wgoods">
<h1>Редактировать новости:</h1>
<hr>
    <img src="<?php echo hsc($row['img']); ?>" alt="img">
<table class="addgoods">
    <form action="" method="post" enctype="multipart/form-data" class="file">
        <tr>
            <td><input type="file" name="file"></td>
            <td><?php if (isset($errors['img'])){echo $errors['img'];}?></td>
        </tr>
        <tr>
            <td>Категория новости:<select name="category">
                    <?php  while($cat = $res->fetch_assoc()){  ?>
                    <option value="<?php echo hsc($cat['name']);?>"
                    <?php if($row['category'] == $cat['name']){ ?> selected <?php } ?> ><?php echo hsc($cat['name']); ?></option>
                    </option>;<?php }?>
                </select><td>
            <td></td>
        </tr>
        <tr>
            <td>Заголовок: <input type="text" name="title" value="<?php echo hsc($row['title']); ?>"></td>
            <td><?php if (isset($errors['title'])){echo $errors['title'];}?></td>
        </tr>
        <tr>
            <td>Краткое описание новости:<textarea name="description"><?php echo hsc($row['description']); ?></textarea>
            </td>
            <td><?php if (isset($errors['description'])){echo $errors['description'];}?></td>
        </tr>
        <tr>
            <td>Полное описание новости:<textarea name="fulldesc"><?php echo hsc($row['fulldesc']); ?></textarea></td>
            <td><?php if (isset($errors['fulldesc'])){echo $errors['fulldesc'];}?></td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" value="Редактировать новость" class="subedit"></td>
        </tr>
    </form>
</table>
    </div>
<?php } ?>
