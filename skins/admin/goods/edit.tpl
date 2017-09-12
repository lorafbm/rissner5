<?php if (isset($_SESSION['user'])){ ?>
<div class="wgoods">
    <h1>Редактировать товар:</h1>
    <hr>
    <img src="<?php echo hsc($row['img1']); ?>" alt="img1">
    <img src="<?php echo hsc($row['img2']); ?>" alt="img2">
    <table class="addgoods">
        <form action="" method="post" enctype="multipart/form-data" class="file">
            <tr>
                <td><input type="file" name="file"></td>
                 <td><?php if (isset($errors['img'])){echo $errors['img'];}?></td>
            </tr>
            <tr>
                <td>Категория товара:<select name="category">
                        <?php  while($cat = $res->fetch_assoc()){  ?>
                        <option value="<?php echo hsc($cat['name']);?>"
                        <?php if($row['category'] == $cat['name']){ ?> selected <?php } ?> ><?php echo hsc($cat['name']); ?></option>
                        </option>;<?php }?>
                    </select><td>
                <td></td>
            </tr>
            <tr>
                <td>Наименование товара: <input type="text" name="name" value="<?php echo hsc($row['name']); ?>"></td>
                <td><?php if (isset($errors['name'])){echo $errors['name'];}?></td>
            </tr>
            <tr>
                <td>Код товара:<input type="text" name="kod" value="<?php echo (int)$row['kod']; ?>"></td>
                <td><?php if (isset($errors['kod'])){echo $errors['kod'];}?></td>
            </tr>
            <tr>
                <td>Описание товара:<textarea name="description"><?php echo hsc($row['description']); ?></textarea></td>
                <td><?php if (isset($errors['description'])){echo $errors['description'];}?></td>
            </tr>
            <tr>
                <td>Доставка товара:<input type="text" name="transport" value="<?php echo hsc($row['transport']); ?>">
                </td>
                <td><?php if (isset($errors['transport'])){echo $errors['transport'];}?></td>
            </tr>
            <tr>
                <td>Гарантия товара:<input type="text" name="garantee" value="<?php echo hsc ($row['garantee']); ?>">
                </td>
                <td><?php if (isset($errors['garantee'])){echo $errors['garantee'];}?></td>
            </tr>
            <tr>
                <td>Цена товара:<input type="text" name="price" value="<?php echo (int)$row['price']; ?>">(с копейками без ,)</td>
                <td><?php if (isset($errors['price'])){echo $errors['price'];}?></td>
            </tr>
            <tr>
                <td>Наличие товара:<input type="text" name="avalible" value="<?php echo hsc ($row['avalible']); ?>">
                </td>
                <td><?php if (isset($errors['avalible'])){echo $errors['avalible'];}?></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Редактировать товар" class="subedit"></td>
                <td></td>
            </tr>
        </form>
    </table>
</div>
<?php } ?>


