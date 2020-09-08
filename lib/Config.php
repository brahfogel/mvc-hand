<?php



class Config
{
     protected static $settings = array();

     static function get($key)
     {
         if (isset(self::$settings[$key]))
             return self::$settings[$key];
         else
             return null;
     }
     static function set($key, $value)
     {
         self::$settings[$key] = $value;
     }

}




