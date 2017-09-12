<div class="wcalc">
<h1>Калькулятор:</h1>
<fieldset>
<form action = "" method = 'POST' class="formcalc">
    <p><label><input type="text" name ="num1" value="<?php
                                                    if (isset ($_POST['num1'])){
                                                        echo (int)$_POST['num1'];
                                                    }
                                                   ?>"> Введите число 1 </label></p>
    <p><label><input type="text" name ="num2" value="<?php
                                                    if(isset($_POST['num2'])){
                                                        echo (int)$_POST['num2'];
                                                    }
                                                  ?>"> Введите число 2 </label></p>

    <p><label><input type="submit" name ="action" value="+"></label>
        <label><input type="submit" name ="action" value="-"></label>
        <label><input type="submit" name ="action" value="*"></label>
        <label><input type="submit" name ="action" value="/"></label></p>
    <p>Результат:</p>


    <div style="background-color: aqua; width: 120px; height: 40px; text-align: center;"><?php
                    if (isset ($_POST['num1'])&& isset($_POST['num2'])&& isset ($_POST['action'])) {
                        echo calc ($_POST['num1'],$_POST['num2'],$_POST['action']);
                    }
                      ?></div>
</form>
</fieldset>
</div>
