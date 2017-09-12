<?php
$_SESSION['alstop'] = "There's any good you are drunk! Stop it!";
if (!isset ( $_SESSION['client']) && !isset ($_SESSION['server'])) {
    $_SESSION['client'] = 0;
    $_SESSION['server'] = 0;
}
if (!isset ($_POST['button'])){
    $_SESSION['client'] = 10;
    $_SESSION['server'] = 10;
} else{
    if (isset($_POST['num']) && !empty($_POST['num'])) {
        if ($_POST['num'] == 1 or $_POST['num'] == 2 or $_POST['num'] == 3) {
            $server = rand(1, 3);
            $info='<p class="game">Компьютер выбрал цифру ' . $server . '<br>'.'Вы выбрали цифру ' . ($_POST['num']) . '</p>';
            if ($_POST['num'] == $server) {
                $num = rand(1, 4);
                $_SESSION['client'] = ($_SESSION['client'] - $num);
                $info.= '<p class="game">Ваши цифры совпали, поэтому компьютер спарировал удар и отнял у вас  ' . $num . ' очка здоровья.<br>'.' Cчет Клиента : Счет Сервера = ' . $_SESSION['client'] . ':' . $_SESSION['server'] . '</p>';
                if ($_SESSION['client'] <= 0) {
                    header("Location: /games/gameover");
                    exit();
                }
            }elseif ($_POST['num'] !== $server) {
                $num = rand(1, 4);
                $_SESSION['server'] = ($_SESSION['server'] - $num);
                $info.= '<p class="game">Ваши цифры не совпали,  компьютер пропустил ваш  удар. Вы отняли у него ' . $num . ' очка здоровья.<br>'.' Вы : Компьютер = ' . $_SESSION['client'] . ':' . $_SESSION['server'] . '</p>';
                if ($_SESSION['server'] <= 0) {
                    header("Location: /games/gameover");
                    exit();
                }
            }
        } else {
            $info = '<p class="game">Введите число от 1 до 3!</p>';
        }
    } else {
        $info = '<p class="game">Заполните поле!</p>';
    }
}
