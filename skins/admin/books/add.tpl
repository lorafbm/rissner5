<?php if (isset($_SESSION['user'])){ ?>
<div class="wgoods">
    <h1>добавить новую книгу:</h1>
    <hr>
    <img src="<?php echo hsc($row['img']); ?>" alt="img1">
    <form action="" method="post" enctype="multipart/form-data" class="file">
        <table class="addgoods">
            <tr>
                <td><input type="file" name="file"></td>
                <td></td>
            </tr>
            <tr>
                <td>Категория книги:<select name="category">
                        <?php   while($row = $res->fetch_assoc()) {
                        echo '
                        <option value="'.hsc($row['name']).'">'.hsc($row['name']).'</option>
                        ';
                        } ?>
                    </select>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Заголовок книги: <input type="text" name="title"
                                            value="<?php if (isset($_POST['title'])){echo hsc($_POST['title']);} ?>">
                </td>
                <td><?php if (isset($errors['title'])){echo $errors['title'];} ?></td>
            </tr>
            <tr>
                <td>Автор:</td>
                <td><?php if (isset($errors['author'])){echo $errors['author'];}?></td>
            </tr>
            <?php   while($row = $auth->fetch_assoc()) {
            echo '
            <tr>
                <td><input type="checkbox" class="author" name="author[]" value="'.(int)$row['id'].'">'.hsc($row['name']).'
                </td>
                <td></td>
            </tr>
            '
            ;
            } ?>
            <tr>
                <td>Описание:<textarea name="description"
                    >Описание>></textarea>
                </td>
                <td><?php if (isset($errors['description'])){echo $errors['description'];}?></td>
            </tr>
            <tr>
                <td>Описание книги:<textarea name="fulldesc"
                                             value="<?php if (isset($_POST['fulldesc'])){echo hsc($_POST['fulldesc']); }?>"></textarea>
                </td>
                <td><?php if (isset($errors['fulldesc'])){echo $errors['fulldesc'];}?></td>
            </tr>
            <tr>
                <td>Цена:<input type="text" name="price"
                                value="<?php if (isset($_POST['price'])){echo (int)$_POST['price'];} ?>">
                    Введите цену с копейками без ,
                </td>
                <td><?php if (isset($errors['price'])){echo $errors['price'];} ?></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="добавить новую книгу" class="subedit"></td>
                <td></td>
            </tr>
        </table>
    </form>
</div>
<?php } ?>


