<div class="wgoods">
    <?php if (isset($_SESSION['user'])){ ?>
    <h1>Пользователи:</h1>
    <?php echo '<p class="game">У нас '.(int)$num.' пользователей:</p>';  ?>
    <div class="assort">
        <?php if (isset($inf)){ ?>
        <p class="goods"><?php echo $inf;?></p>
        <?php } ?>
        <form action="" method="post">
            <table class="users">
                <tr class="ftr">
                    <td colspan="4"></td>
                    <td>ID</td>
                    <td>Пользователь:</td>
                    <td>Возраст:</td>
                    <td>Цвет:</td>
                    <td>Активация:</td>
                    <td>E-mail:</td>
                    <td>Права:</td>
                    <td>Дата создания:</td>
                    <td>Последняя активность:</td>
                </tr>
                <tr class="str">
                    <td></td>
                    <td colspan="2"></td>
                    <td>Поиск:</td>
                    <td></td>
                    <td><input type="text" name="name"
                               value="<?php if (isset($_POST['name'])){echo hsc($_POST['name']);} ?>">
                        <input type="submit" name="serchname" style="display: none"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php while($row = mysqli_fetch_assoc($users)) { ?>
                <tr>
                    <td><input type="checkbox" name="ids[]" value="<?php echo (int)$row['id']; ?>"></td>
                    <td><a href="/admin/users/main?action=delete&id=<?php echo (int)$row['id']; ?>" class="inn" onclick="return del();">Удалить</a></td>
                    <td><a href="/admin/users/edit?id=<?php echo (int)$row['id']; ?>" class="inn">Редактировать</a></td>
                    <td><?php echo '<td>'.(int)($row['id']).'</td>
                    <td>'.hsc($row['name']).'</td>
                    <td>'.(int) ($row['age']).'</td>
                    <td>'.hsc ($row['color']).'</td>
                    <td>'.(int)($row['active']).'</td>
                    <td>'.hsc($row['email']).'</td>
                    <td>'.(int)($row['access']).'</td>
                    <td>'.hsc($row['date']).'</td>
                    <td>'.hsc($row['datelast']).'</td>
                    '
                    ?>
                </tr>
                <?php } ?>
            </table>
            <input type="submit" name="delete" value="удалить" class="delete" onclick="return del();">
        </form>
    </div>
    <?php } else { echo '<p class="game">Авторизуйтесь для управления правами пользователей!</p>';} ?>
</div>





