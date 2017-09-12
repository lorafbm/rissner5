<h1>Поиграем:</h1>
<?php
echo '<p class="game">Вы =' . hsc($_SESSION['client']) . '<br>'.'Компьютер =' . hsc($_SESSION['server']) . '</p>';
if (isset($info)){
    echo '<p class="game">'.$info.'</p>';
}

?>
<div class="forma">
    <form method="post">
        <p class="game">Введите число от 1 до 3:</p>
        <p class="game"><label><input type="text" name="num" value=""></label></p>
        <p class="game"><input type="submit" name="button" value="отправить"></p>
    </form>
</div>
