<?php

class Conexao {
    private static $host = 'localhost';
    private static $dbname = 'finbank';
    private static $user = 'root';
    private static $password = 'root';
    private static $port = '8889';

    public static function conectar() {
        try {
            $pdo = new PDO("mysql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$dbname, self::$user, self::$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }
}
