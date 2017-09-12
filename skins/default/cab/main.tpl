<div class="wauto">
<?php if (isset($_SESSION['ok'])){
    echo '<p>'.$_SESSION['ok'].'</p>';}?>
    <?php if (!isset($_SESSION['user'])) { ?>
    <h1>Форма регистрации:</h1>
    <fieldset>
        <table class="commentform">
            <form action="" method="post" class="formauto">
                <tr>
                    <td><label>Введите логин:*</td><td><input type="text" name="name"></label></td>
                    <td></td><td><?php if (isset($errors['name'])){echo $errors['name'];} ?></td>
                </tr>
                <tr>
                    <td><label>Введите пароль:**&nbsp;</td><td><input type="password" name="pass"></label></td>
                    <td></td><td><?php if (isset($errors['pass'])){echo $errors['pass'];} ?></td>
                </tr>
                <tr>
                    <td><label>Введите email:</td><td><input type="text" name="email"></label></td>
                    <td></td><td><?php if (isset($errors['email'])){echo $errors['email'];} ?></td>
                </tr>
                <tr>
                    <td><label>Введите возраст:&nbsp;</td><td><input type="text" name="age"></label></td>
                    <td></td><td><?php if (isset($errors['age'])){echo $errors['age'];}  ?></td>
                </tr>
                <tr>
                    <td><input type="submit" name="button" value="Регистрация"></td><td></td>
                </tr>
            </form>
        </table>
        <p class="prim">* имя от 2 до 16 символов</p>
        <p class="prim">** пароль не короче 5 символов</p>
    </fieldset>
    <?php } ?>
</div>