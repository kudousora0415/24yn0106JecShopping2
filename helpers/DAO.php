<?php
require_once 'config.php';
class DAO { private static $dbh;
// DBに接続するメソッド
public static function get_db_connect()
{
try { 
    if (self::$dbh === null) { 
     self::$dbh = new PDO(DSN, DB_USER, DB_PASSWORD); 
    } 
     return self::$dbh;
}
catch (PDOException $e) {
echo $e->getMessage();
die();
        }
    }
}
