<?php
class ConexionMongo{

    private static $instance = null;
    private static $mongo;
    private static $metodo;

    final private function __construct() {
        try {
            self::obtenerConexion();
        } catch (MongoException $e) {
            header('Location: 404.php?error=5&exc='.$e->getMessage()); //error en la conexion mongodb
        }
    }

    public static function getInstance($metodo = false) {   //Si el metodo es Post para operaciones Ajax o no
        if (self::$instance === null) {
            self::$metodo = $metodo;
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function obtenerConexion() {
        if (self::$mongo == null) {
            if (self::$metodo){ //Si el metodo es true entonces es Post
                $tipo_conexion = parse_ini_file("../appconfig.ini", true)['tipo_conexion'];
                $configArray = parse_ini_file("../appconfig.ini", true)['conexion_mongo_'.$tipo_conexion['mongo']];
            }else{
                $tipo_conexion = parse_ini_file("appconfig.ini", true)['tipo_conexion'];
                $configArray = parse_ini_file("appconfig.ini", true)['conexion_mongo_'.$tipo_conexion['mongo']];
            }
            $username = $configArray['username'];
            $pass = $configArray['password'];
            $host = $configArray['host'];
            $port = $configArray['port'];
            $database = $configArray['database'];
            if ($host == "localhost"){
                $url = 'localhost';
            }else {
                $url = 'mongodb://'.$username.':'.$pass.'@'.$host.':'.$port.'/';
            }
            self::$mongo = new MongoClient($url);
            self::$mongo = self::$mongo->selectDB($database);
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