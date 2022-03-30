<?php

namespace Core;

use PDO;
use PDOException;

class Conn
{

    private const OPTIONS = [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ];

    private static $conn;

    public static function getConn(): PDO
    {
        if (empty(self::$conn)) {
            try {
                self::$conn = new PDO(
                    "mysql:host=" . DB_HOST . ";dbname=" . DB_DBNAME . ';charset=utf8mb4',
                    DB_USER,
                    DB_PASS,
                    self::OPTIONS
                );
            } catch (PDOException $exception) {
            }
        }
        return self::$conn;
    }
}
