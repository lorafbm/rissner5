<!--/*<div class="wauto">
    <?php if (isset($_SESSION['user'])){
              echo @$_SESSION['info'].@$_SESSION['info3'];
    } else {echo @$error;} ?>



   <?php if (!isset($_SESSION['user']) || $_SESSION['user']['access'] != 5) { ?>
    <h1>Форма авторизации:</h1>
    <div class="fon">
        <fieldset>
            <table class="commentform">
                <form action="" method="post" class="formauto">
                    <tr>
                        <td><label>Введите имя:* &nbsp;&nbsp;<input type="text" name="name"></label></td>
                        <td><?php if (isset($errors['name'])){echo $errors['name'];} ?></td>
                    </tr>
                    <tr>
                        <td><label>Введите пароль:**&nbsp;&nbsp;<input type="password" name="pass"></label></td>
                        <td><?php if (isset($errors['pass'])){echo $errors['pass'];} ?></td>
                    </tr>
                    <tr>
                        <td><input type="hidden" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>"</td>
                        <td><input type="hidden" name="hua" value="<?php echo $_SERVER['HTTP_USER_AGENT']; ?>"</td>
                    <tr>
                        <td><input type="checkbox" name="remember"><span>Запомнить</span></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="button" value="Войти"></td>
                    </tr>
                </form>
            </table>
            <p class="prim">* имя от 2 до 16 символов</p>
            <p class="prim">** пароль не короче 4 символов</p>
        </fieldset>
    </div>
    <?php  } ?>
</div>*/-->

<div class="wauto">
    <?php if (isset($_SESSION['user'])){
              echo @$_SESSION['info'].@$_SESSION['info3'];
    } else {echo @$error;} ?>
</div>