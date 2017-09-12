<div class="wgoods">
    <div class="wgoodscom">
        <h1>Отзывы и комментарии:</h1>
        <?php if (mysqli_num_rows($res)){
    echo '<div id="num"><p class="game">У нас '.(int)$num.' комментариев:</p></div>
    ';}
    else {echo '<p class="game">У нас пока нет комментариев.</p> ';} ?>
    <?php while($row = mysqli_fetch_assoc($res)) { echo '<div id="com">
    <div class="commentboxbodycom">'.hsc($row['comments']).'</div>
    <div class="commentboxname">-'. hsc($row['name']).' '.(int)$row['age'].' лет</div>
    <div class="commentboxname">'.hsc($row['date']).'</div></div>';} ?>
    </div>
<?php  if (isset($_SESSION['user'])){ ?>
<p class="commenttitle">Введите ваш комментарий:</p>
<div id="info" style="display: none"></div>
<fieldset>
    <table class="commentform">
        <form action="" method="post" class="commentform" id="commentform"
              onsubmit="return sendcom(name,email,comments,age,num);">
            <tr>
                <td><label>Введите имя*:&nbsp;<input type="text" name="name" id="name"
                                                     value="<?php if (isset($_POST['name'])){echo hsc($_POST['name']);} ?>"></label>
                </td>
            </tr>
            <tr>
                <td><label>Введите ваш возраст*:&nbsp;<input type="text" name="age" id="age"
                                                             value="<?php if (isset($_POST['age'])){echo hsc($_POST['age']);} ?>"></label>
                </td>
            </tr>
            <tr>
                <td><label>Введите e-mail*:&nbsp;<input type="text" name="email" id="email"
                                                        value="<?php if (isset($_POST['email'])){echo hsc($_POST['email']);}?>"></label>
                </td>
            </tr>
            <tr>
                <td><label>Введите комментарий*:<br>
                        <textarea class="comments" name="comments" id="comments"
                                  value="<?php if (isset($_POST['comments'])){echo hsc($_POST['comments']);}?>"></textarea></label>
                </td>
            </tr>
            <div class="mess" style="display: none"></div>
            <tr>
                <td><input type="submit" name="button" value="Отправить"></td>
            </tr>
        </form>
    </table>
    <p class="prim">*Обязательные поля.</p>
</fieldset>
<?php } else { echo '<p class="game">Авторизиуйтесь на сайте для того, чтобы оставлять комментарии !</p>';} ?>






