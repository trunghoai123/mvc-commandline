<?php

class Connection
{
    private static $__instance = null;
    private static $__conn = null;
    private function __construct($db_config)
    {
        try {
            $dsn = 'mysql: host=' . $db_config['host'] . ';dbname=' . $db_config['database'];
            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];
            self::$__conn = new PDO($dsn, $db_config['username'],    $db_config['password'], $options);
        } catch (Exception $exception) {
            $mess = $exception->getMessage();
            die($mess);
        }
    }
    public static function getInstance($db_config)
    {
        if (self::$__instance == null) {
            new Connection($db_config);
            self::$__instance = self::$__conn;
        }
        return self::$__instance;
    }
}
