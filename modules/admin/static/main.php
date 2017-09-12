<?php
include './modules/cab/auth.php';

if (isset ($_SESSION['info3'])) {

    unset ($_SESSION['info3']);
}
if (isset ($_SESSION['info'])) {

    unset ($_SESSION['info']);
}