<?php if (isset($_SESSION['user'])){ ?>
<div class="wgoods">
    <h1>добавить новую новость:</h1>
    <hr>
    <img src="<?php echo hsc($row['img']); ?>" alt="img1">
    <table class="addgoods">
        <form action="" method="post" enctype="multipart/form-data" class="file">
            <tr>
                <td><input type="file" name="file"></td>
                <td><?php if (isset($errors['img'])){echo $errors['img'];}?></td>
            </tr>
            <tr>
                <td>Категория новости:<select name="category">
                        <?php   while($row = $res->fetch_assoc()) {
                        echo  '<option  value="'.hsc($row['name']).'">'.hsc($row['name']).'</option>';
                        } ?>
                    </select>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Заголовок новости: <input type="text" name="title"
                                              value="<?php if (isset($_POST['title'])){echo hsc($_POST['title']);} ?>">
                </td>
                <td><?php if (isset($errors['title'])){echo $errors['title'];}?></td>
            </tr>
            <tr>
                <td>Краткое описание новости:<input type="text" name="description"
                                                    value="<?php if (isset($_POST['description'])){echo hsc($_POST['description']);} ?>">
                </td>
                <td><?php if (isset($errors['description'])){echo $errors['description'];} ?></td>
            </tr>
            <tr>
                <td>Описание новости:<textarea name="fulldesc"
                                               value="<?php if (isset($_POST['fulldesc'])){echo hsc($_POST['fulldesc']); }?>"></textarea>
                </td>
                <td><?php if (isset($errors['fulldesc'])){echo $errors['fulldesc'];}?></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="добавить новую новость" class="subedit"></td>
                <td></td>
            </tr>
        </form>
    </table>
</div>
<?php } ?>


