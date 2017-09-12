<?php

class Mail
{
    static $subject = 'по умолчанию';
    static $from = 'admin@lora.school-php.com';
    static $to = 'lorik_fbm@mail.ru';
    static $text = 'шаблонное письмо';
    static $headers = '';

    static function send() {
        self::$subject = "=?utf-8?B?" . base64_encode(self::$subject) . "?="; // Кодируем тему (во избежание проблем с кодировкой)
        self::$headers = "Content-type: text/html; charset= \"utf-8 \"\r\n";
        self::$headers .= "From: " . self::$from . "\r\n";
        self::$headers .= "MIME-Version: 1.0 \r\n";
        self::$headers .= "Date:" . date('D,d M Y h:i:s O') . "\r\n";
        self::$headers .= "Precedence:bulk\r\n";

        return mail(self::$to, self::$subject, self::$text, self::$headers);
    }

    static function TestMail(){
        if (mail(self::$to,'English words','English words')){
            echo 'Письмо отправлено!';
        } else{
            echo 'Письмо не отправилось!';
        }
        exit();
    }

}


