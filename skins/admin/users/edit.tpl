<?php if (isset($_SESSION['user'])){ ?>
<div class="wgoods">
    <h1>Редактировать пользователя:</h1>
    <hr>
    <img src="<?php echo hsc($row['img']); ?>" alt="img">
    <?php if (isset($errors['active'])){echo $errors['active'];}?>
    <table class="addgoods" align="center">
        <form action="" method="post" enctype="multipart/form-data" class="file">
            <div>
                <p class="status">Активный: <input type="radio" name="active"
                                                   value="1" <?php echo ((isset($row['active'])&&($row['active'])==1)?'checked="checked"':'');?>
                    ">
                    Забанить: <input type="radio" name="active" onclick="return del();"
                                     value="0" <?php echo ((isset($row['active'])&&($row['active'])==0)?'checked="checked"':'');?>
                    "></p>
            </div>
           <tr>
                <td><input type="file" name="file"></td>
                <td><?php if (isset($errors['img'])){echo $errors['img'];}?></td>
            </tr>
            <tr>
                <td>Логин:<input type="text" name="name" value="<?php echo hsc($row['name']); ?>"></td>
                <td><?php if (isset($errors['name'])){echo $errors['name'];}?></td>
            </tr>
            <tr>
                <td>Пароль:<input type="text" name="pass" value=""></td>
                <td><?php if (isset($errors['pass'])){echo $errors['pass'];}?></td>
            </tr>
            <tr>
                <td>Цвет:<input type="text" name="color" value="<?php echo hsc($row['color']); ?>"></td>
                <td></td>
            </tr>
            <tr>
                <td>Возраст:<input type="text" name="age" value="<?php echo (int)$row['age']; ?>"></td>
                <td><?php if (isset($errors['age'])){echo $errors['age'];}?></td>
            </tr>
            <tr>
                <td>E-mail:<input type="text" name="email" value="<?php echo hsc($row['email']); ?>"></td>
                <td><?php if (isset($errors['email'])){echo $errors['email'];}?></td>
            </tr>
            <tr>
                <td>Права доступа:<input type="text" name="access" value="<?php echo (int)$row['access']; ?>"></td>
                <td><?php if (isset($errors['access'])){echo $errors['access'];}?></td>
            </tr>
            <tr>
                <td>IP адрес:<input type="text" name="ip" value="<?php echo hsc ($row['ip']); ?>"></td>
                <td><?php if (isset($errors['ip'])){echo $errors['ip'];}?></td>
            </tr>
            <tr>
                <td>Браузер:<input type="text" name="httpuseragent" value="<?php echo hsc($row['httpuseragent']); ?>"></td>
                <td><?php if (isset($errors['httpuseragent'])){echo $errors['httpuseragent'];}?></td>
            </tr>
            <tr>
               <td>Дата создания:<input type="date" name="date" value="<?php echo hsc($row['date']); ?>"></td>
                <td><?php if (isset($errors['date'])){echo $errors['date'];}?></td>
            </tr>
            <tr>
                <td>Последняя активность:<input type="datelast" name="datelast" value="<?php echo hsc($row['datelast']); ?>"></td>
                <td><?php if (isset($errors['datelast'])){echo $errors['datelast'];}?></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Редактировать" class="subedit"></td>
                <td></td>
            </tr>
        </form>
    </table>
</div>
<?php } ?>


