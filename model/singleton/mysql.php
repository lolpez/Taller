<?php
class ConexionMysql {

    private static $instance = null;
    private static $mysql;

    final private function __construct() {
        try {
            self::obtenerConexion();
        } catch (PDOException $e) {
            header('Location: 404.php?error=4&exc='.$e->getMessage()); //error en la conexion mysql
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
            $tipo_conexion = parse_ini_file("appconfig.ini", true)['tipo_conexion'];
            $configArray = parse_ini_file("appconfig.ini", true)['conexion_mysql_'.$tipo_conexion['mysql']];
            $username = $configArray['username'];
            $pass = $configArray['password'];
            $host = $configArray['host'];
            $port = $configArray['port'];
            $database = $configArray['database'];
            $url = 'mysql:host='.$host.';port='.$port.';dbname='.$database;
            self::$mysql = new PDO($url, $username, $pass);
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