<?php
namespace Src;
final class DataBaseConnection
{
    private static $instance = null;
    private static $connection = null;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            return self::$instance = new DataBaseConnection;
        } else {
            return self::$instance;
        }
    }

    public function connect($host, $dbName, $user, $password)
    {   
        if (is_null(self::$connection)) {
            $dsn = "mysql:dbname=$dbName;host=$host";

            try {
                self::$connection = new \PDO(
                $dsn,
                $user,
                $password, [
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
                ]);
            } catch (\PDOException $e) {
                echo 'Connection Failed: ' . $e->getMessage() . PHP_EOL;
                exit();
            }
        }
    }

    public static function getConnection() {
        return self::$connection;
    }

    // override these methods so that they are not callable
    private function __construct()
    {
    }
    private function __clone()
    {
    }
}