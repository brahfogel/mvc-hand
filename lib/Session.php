<?php


class Session
{
    protected static $userMessage;

    public static function setUserMessage($userMessage)
    {
        self::$userMessage = $userMessage;
    }

    public static function hesUmessage()
    {
        return isset(self::$userMessage) ? true : false;
    }

    public static function echoMessage()
    {
        echo self::$userMessage;
        self::$userMessage = null;
    }

    public static function setValue($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    public static function getValue($key)
    {
        return (isset($_SESSION[$key]) ? $_SESSION[$key] : false);
    }

    public static function destroy()
    {
        session_destroy();
    }

}




