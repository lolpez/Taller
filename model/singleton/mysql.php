<?php
class ConexionMysql {

    private static $instance = null;
    private static $pdo;

    final private function __construct() {
        try {
            self::getPDO();
        } catch (PDOException $e) {

        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getPDO() {
        if (self::$pdo == null) {
            $username = 'adminPWHHWUh';
            $password = 'Tf_L3kbF1PX-';
            $host = '127.12.74.130';
            $port = '3306';
            $database = 'taller';
            $url = 'mysql:host='.$host.';port='.$port.';dbname='.$database;
            self::$pdo = new PDO($url, $username, $password);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }

    final protected function __clone() {

    }

    function _destructor() {
        self::$pdo = null;
    }

}
?>