<?php
class ConexionMysql {

    private static $instance = null;
    private static $mysql;
    private $configArray;
    private $username;
    private $pass;
    private $host;
    private $port;
    private $database;


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
            $this->configArray = parse_ini_file("appconfig.ini", true)['conexion_mysql_local'];
            $this->username = $this->configArray['username'];
            $this->pass = $this->configArray['password'];
            $this->host = $this->configArray['host'];
            $this->port = $this->configArray['port'];
            $this->database = $this->configArray['database'];
            $url = 'mysql:host='.$this->host.';port='.$this->host.';dbname='.$this->database;
            self::$mysql = new PDO($url, $this->username, $this->pass);
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