<?php


class Lang //App
{
    protected static $data;

    public static function load($langCode) //En
    {
        $langFilePath = ROOT . DS . 'lang' . DS . $langCode . '.php';

        if (file_exists($langFilePath)) {
            self::$data = include($langFilePath);
        }
        else {
            Throw new Exception('Lang file "' . $langFilePath . '" was not found');
        }
    }

    function get($str, $defaultStr = '') {
        return isset(self::$data[$str]) ? self::$data[$str] : $defaultStr;
    }
}






