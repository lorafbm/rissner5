<div class="wgoods">
    <?php if (isset($_SESSION['user'])){ ?>
    <h1>добавить новый товар:</h1>
    <hr>
    <img src="/uploaded/<?php if (isset($_POST['submit'])){echo hsc($name);} ?>">
    <form action="" method="post" enctype="multipart/form-data" class="file">
        <table class="addgoods">
            <tr>
                <td><input type="file" name="file"></td>
                <td><?php if (isset($errors['img'])){echo $errors['img'];}?></td>
            </tr>
            <tr>
                <td>Категория товара:<select name="category">
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
                <td>Наименование товара: <input type="text" name="name"
                                                value="<?php if (isset($_POST['name'])){echo hsc($_POST['name']);} ?>">
                </td>
                <td><?php if (isset($errors['name'])){echo $errors['name'];}?></td>
            </tr>
            <tr>
                <td>Код товара:<input type="text" name="kod"
                                      value="<?php if (isset($_POST['kod'])){echo (int)$_POST['kod'];} ?>"></td>
                <td><?php if (isset($errors['kod'])){echo $errors['kod'];}?></td>
            </tr>
            <tr>
                <td>Описание товара:<textarea name="description"
                                              value="<?php if (isset($_POST['description'])){echo hsc($_POST['description']); }?>"></textarea>
                </td>
                <td><?php if (isset($errors['description'])){echo $errors['description'];}?></td>
            </tr>
            <tr>
                <td>Доставка товара:<input type="text" name="transport"
                                           value="<?php if (isset($_POST['transport'])){echo hsc($_POST['transport']);} ?>">
                </td>
                <td><?php if (isset($errors['transport'])){echo $errors['transport'];} ?></td>
            </tr>
            <tr>
                <td>Гарантия товара:<input type="text" name="garantee"
                                           value="<?php if (isset($_POST['garantee'])){echo hsc($_POST['garantee']);} ?>">
                </td>
                <td><?php if (isset($errors['garantee'])){echo $errors['garantee'];}?></td>
            </tr>
            <tr>
                <td>Цена товара:<input type="text" name="price"
                                       value="<?php if (isset($_POST['price'])){echo (int)($_POST['price']);} ?>">
                    Введите цену с копейками без ,
                </td>
                <td><?php if (isset($errors['price'])){echo $errors['price'];}?></td>
            </tr>
            <tr>
                <td>Наличие товара:<input type="text" name="avalible"
                                          value="<?php if (isset($_POST['avalible'])){echo hsc($_POST['avalible']);} ?>">
                </td>
                <td><?php if (isset($errors['avalible'])){echo $errors['avalible'];}?></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="добавить новый товар" class="subedit"></td>
                <td></td>
            </tr>
        </table>
    </form>
    <?php } ?>
</div>








