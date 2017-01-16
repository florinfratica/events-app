<?php

class Db
{
    private static $instance = null;

    private function __construct()
    {
        //
    }

    private function __clone()
    {
        //
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            mysqli_set_charset(self::$instance, "utf8");
        }
        return self::$instance;
    }
}
