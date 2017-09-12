<?php
setcookie("access1", "", time() - 60 * 60 * 24);
setcookie("access2", "", time() - 60 * 60 * 24);
unset ($_SESSION['user']);
session_unset();
session_destroy();
header("Location: /");
exit();
