<?php
class ConexionMysql {

    private static $instance = null;
    private static $mysql;

    final private function __construct() {
        try {
            self::obtenerConexion();
        } catch (PDOException $e) {

        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function obtenerConexion() {
        if (self::$mysql == null) {
            $username = 'adminPWHHWUh';
            $password = 'Tf_L3kbF1PX-';
            $host = '127.12.74.130';
            $port = '3306';
            $database = 'taller';
            $url = 'mysql:host='.$host.';port='.$port.';dbname='.$database;
            //$url = 'mysql:host=localhost;port=3306;dbname=taller';$username='root';$password='';
            self::$mysql = new PDO($url, $username, $password);
            self::$mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$mysql;
    }

    final protected function __clone() {

    }

    function _destructor() {
        self::$mysql = null;
    }

}
?>