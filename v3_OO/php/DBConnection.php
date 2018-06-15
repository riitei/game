<?php
/**
 * Created by PhpStorm.
 * User: riitei
 * Date: 2018/4/30
 * Time: 10:14
 */

class DBConnection
{
    public static $host = "localhost";
    public static $db_name = "game_old";
    public static $user = "admin";
    public static $password = "admin";

    public static function PDO()
    {
        try {
            $dbconnect = "mysql:host=" . DBConnection::$host . ";dbname=" . DBConnection::$db_name;
            $PDO = new PDO($dbconnect, DBConnection::$user, DBConnection::$password);

            return $PDO;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

}