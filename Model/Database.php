<?php
// namespace TaskManagement\Model;

class Database
{
    //properties
/*     private static $user = 'root';
    private static $pass = 'root';
    private static $dsn = 'mysql:host=localhost;dbname=task_management'; */

    private static $user = 'b7fb78cb3de5d6';
    private static $pass = '709e640b';
    private static $dsn = 'mysql:host=us-cdbr-east-03.cleardb.com;dbname=heroku_c80c4ebe61a07b4';

    private static $dbcon;

    private function __construct()
    {
    }

    //get pdo connection
    public static function getDb(){
        if(!isset(self::$dbcon)) {
            try {
                self::$dbcon = new \PDO(self::$dsn, self::$user, self::$pass);
                self::$dbcon->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$dbcon->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
            } catch (\PDOException $e) {
                $msg = $e->getMessage();
                // include '../custom-error.php';
                exit();
            }
        }

        return self::$dbcon;
    }
}
