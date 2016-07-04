<?php
class ConexionMongo{

    private static $instance = null;
    private static $mongo;
    private $configArray;
    private $username;
    private $pass;
    private $host;
    private $port;
    private $database;

    final private function __construct() {
        try {
            self::obtenerConexion();
        } catch (MongoException $e) {
			header('Location: 404.php?error=5&exc='.$e->getMessage()); //error en la conexion mongodb
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function obtenerConexion() {
        if (self::$mongo == null) {
            $this->configArray = parse_ini_file("appconfig.ini", true)['conexion_mongo_local'];
            $this->username = $this->configArray['username'];
            $this->pass = $this->configArray['password'];
            $this->host = $this->configArray['host'];
            $this->port = $this->configArray['port'];
            $this->database = $this->configArray['database'];
            if ($this->host == "localhost"){
                $url = 'localhost';
            }else {
                $url = 'mongodb://'.$this->username.':'.$this->pass.'@'.$this->host.':'.$this->port.'/';
            }
            self::$mongo = new MongoClient($url);
            self::$mongo = self::$mongo->selectDB($this->database);
        }
        return self::$mongo;
    }

    final protected function __clone() {

    }

    function _destructor() {
        self::$mongo = null;
    }

}
?>