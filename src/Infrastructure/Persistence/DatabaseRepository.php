<?php


namespace ShoppingCart\Infrastructure\Persistence;
use Exception;
use PDO;

class DatabaseRepository
{


    public static function getConnection()
    {
        $server = "mysql-shop";
        $username = "root";
        $passwd = "root";
        $bd = "tienda"; // Schema
        $options = [
            PDO::ATTR_EMULATE_PREPARES => false, // Modo emulación desactivado para prepared statements "reales"
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Que los errores salgan como excepciones.
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // El modo de fetch que queremos por defecto.
        ];

        try {
            $pdo = new PDO("mysql:host=$server;dbname=$bd;charset=utf8", $username, $passwd, $options);
        } catch (Exception $e) {
            $str = "Connexion error: " . $e->getMessage();
            error_log($str);
            exit($str);
        }
        return $pdo;
    }

}