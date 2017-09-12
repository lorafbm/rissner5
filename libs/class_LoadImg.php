<?php

class LoadImg
{


    static function can_upload($file)
    {

        if ($file['name'] == '') {
            return 'Вы не выбрали файл.';
        }
        if ($file['size'] == 0){// если размер файла 0, значит его не пропустили настройки сервера из-за того, что он слишком большой
            return 'Файл слишком большой.';
        }
        // разбиваем имя файла по точке и получаем массив
        $getExt = explode('.', $file['name']);
        // end возвращает значение последнего элемента или FALSE для пустого массива.
        $ext = strtolower(end($getExt));

        $types = array('jpg', 'png', 'gif', 'jpeg');

        if (!in_array($ext, $types)) {
           return 'Недопустимый тип файла, можно загружать только файлы с расширениями jpg, png, gif, jpeg!';
        }
           if(!isset($error)) {
                return 'OK';
           }

    }

    static function make_upload($file)
    {        // формируем уникальное имя картинки
        $getExt = explode('.', $file['name']);
        $ext = strtolower(end($getExt));
        $name = date('Ymd-His') . 'img' . rand(10000, 99999) . '.' . $ext;
       if(move_uploaded_file($file['tmp_name'], './uploaded/' . $name))
       {
           return 'ОК';
       }else{
           return 'Файл не загружен! ';
       }

    }


    static function resize($image, $width,$height)
    {
        $infoimg = getimagesize($image);

        $getExt = explode('/', $infoimg['mime']);
        $ext = strtolower(end($getExt));

        $w_i = $infoimg[0];//исх ширина
        $h_i = $infoimg[1];//исх высота
        /*echo $w_i . 'это $w_i ширина<br>' . $h_i . 'это $h_i высота<br>';*/

        $types = array("gif", "jpeg", "png"); // Массив с допустимыми типами изображений
        if (!in_array($ext, $types)) {
            return 'Недопустимый формат файла.';
        } else {
            $func = 'imagecreatefrom' . $ext; // Получаем название функции, соответствующую типу, для создания изображения
            $img_i = $func($image); // Создаём шаблон для работы с исходным изображением
        }


        // Вычисление пропорций

        $ratio = $w_i / $h_i;

        if ($width/$height > $ratio) {
            $w = round($height * $ratio);
            $h=$height;
        } else {
            $h = round($width / $ratio);
            $w=$width;
        }

        $img = imagecreatetruecolor($w, $h); //Создаем полноцветное изображение

        if ($ext == 'png') {
            imagealphablending($img, false);//Отключаем режим сопряжения цветов
            imagesavealpha($img, true);//Включаем сохранение альфа канала
        } elseif ($ext == 'gif') {
            $transparent_source_index = imagecolortransparent($img_i);//Задаем прозрачный цвет
            if ($transparent_source_index !== -1) {//Проверяем наличие прозрачности
                $transparent_color = imagecolorsforindex($img_i, $transparent_source_index);
                //Добавляем цвет в палитру нового изображения, и устанавливаем его как прозрачный
                $transparent_destination_index = imagecolorallocate($img, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
                imagecolortransparent($img, $transparent_destination_index);
                imagefill($img, 0, 0, $transparent_destination_index);//На всякий случай заливаем фон этим цветом
            }
        }
        imagecopyresampled($img, $img_i, 0, 0, 0, 0, $w, $h, $w_i, $h_i); // Переносим изображение из исходного в выходное, масштабируя его Ресайз

        $name = '/photo/'.$w.'x'.$h.'img'.rand(10000, 99999) . '.'. $ext;

        if($infoimg['mime']=='image/jpeg') {
            imagejpeg($img, '.' . $name,100);
        }elseif($infoimg['mime']=='image/png') {
        imagepng($img, '.' . $name);
        }elseif($infoimg['mime']=='image/gif') {
            imagegif($img, '.' . $name);
        }

        imagedestroy($img);
        imagedestroy($img_i);
        return $name;

    }








}
/*wtf($_FILES, 1);
wtf($_POST, 1);
wtf($temp, 1);*/


//загрузка img рабочий стас
/*$array = array('image/jpeg', 'image/gif', 'image/png');
$array2 = array('jpg', 'jpeg', 'gif', 'png');

if (isset ($_POST ['submit'])) {
    if ($_FILES['file']['error'] == 0) {
        if ($_FILES ['file']['size'] < 5000 || $_FILES ['file']['size'] > 50000000) {
            $error = '<p class="game">Размер изображения нам не подходит!</p>';
        } else {
            preg_match('#\.([a-z]+)$#ui', $_FILES['file']['name'], $matches);

            if (isset($matches[1])) {
                $matches[1] = mb_strtolower($matches[1]);
                $temp = getimagesize($_FILES['file']['tmp_name']);
                $name = date('Ymd-His') . 'img' . rand(10000, 99999) . '.jpg';

                if ($temp[0] || $temp[1] != $width) {
                    resize($_FILES['file']['tmp_name'], $width);
                }
                if (!in_array($matches[1], $array2)) {
                    $error = '<p class="game">Не подходит расширение изображения!</p>';
                } elseif (!in_array($temp['mime'], $array)) {
                    $error = '<p class="game">Не подходит тип файла можно загружать только изображения!</p>';
                } elseif (!move_uploaded_file($_FILES['file']['tmp_name'], './uploaded/' . $name)) {
                    $error = '<p class="game">Изображение не загружено ошибка!</p>';
                } else {
                    $info = '<p class="game">Изображение загружено!</p>';
                }
            } else {
                $error = '<p class="game">Данный файл не является картинокой!</p>';
            }
        }
    }
}*/
