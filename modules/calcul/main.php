<?php

function calc ($num1,$num2, $action)  {

    switch ($action ){
        case '+':
            return $num1 + $num2;
            break;
        case '-':
            return $num1 - $num2;
            break;
        case '*':
            return $num1 * $num2;
            break;
        case '/':
            if ($num2 != 0) {
                return $num1 / $num2;
            } else
                return "нельзя делить на 0!";
            break;

        default:
            return "Неопределенное значение!";
            break;

    }
}


/*echo '<pre>'.print_r($files,1).'</pre>';*/

