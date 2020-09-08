<?php

final class Db
{
    static private $instance = null;
    static private $dbConn;

    private function __construct()
    {
        self::$dbConn = new PDO('mysql:host=' . Config::get('db_host') . ';dbname=' . Config::get('db_name'), Config::get('db_user'), Config::get('db_pass'), array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES => false));
        self::$dbConn->beginTransaction();
    }  // new Singleton

    private function __clone() { /* ... @return Singleton */ }  // clone
    private function __wakeup() { /* ... @return Singleton */ }  //  unserialize

    static public function getInstance()
    {
        return
            self::$instance === null
                ? self::$instance = new static() //new self()
                : self::$instance;
    }

    public function query($sql)
    {
        return self::$dbConn->query($sql);
    }

    public function exec($sql)
    {
        return self::$dbConn->exec($sql);
    }
    public function commit()
    {
        return self::$dbConn->commit();
    }
    public function rollBack()
    {
        return self::$dbConn->rollBack();
    }

    public function prepare($sql)
    {
        return self::$dbConn->prepare($sql);
    }
    public function fetch($sql)
    {
        return self::$dbConn->fetch($sql);
    }
    public function lastInsertId()
    {
        return self::$dbConn->lastInsertId();
    }

    public function closeDb()
    {
        self::$dbConn = null;
    }

}