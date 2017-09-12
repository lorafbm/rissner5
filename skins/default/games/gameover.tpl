<?php
echo '<p class="game">'.$_SESSION['alstop'].'</p><p class="game"><img src="/skins/default/img/kot.png" width="236px" height="304px" alt="kot"></p>';

if ($_SESSION['client']<=0) {
    echo '<p class="game">Mr Server,congrats, you are win! Mr. Client,sorry...</p>';
}

elseif ($_SESSION['server']<=0) {
echo '<p class="game">Mr Client,congrats, you are win! Mr. Server,sorry...</p>';
}
?>
