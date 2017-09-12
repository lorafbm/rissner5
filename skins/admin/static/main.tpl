<?php
include './skins/default/cab/auth.tpl';

if (isset($_SESSION['user'])) {
            if ($_SESSION['user']['access'] == 1) {
                echo @$_SESSION['info1'];
            }elseif ($_SESSION['user']['access'] == 5) {
                 echo @$_SESSION['info2'];
            }
}