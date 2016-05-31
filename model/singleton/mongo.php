<?php
class ConexionMongo{

    private static $instance = null;
    private static $mongo;

    final private function __construct() {
        try {
            self::obtenerConexion();
        } catch (MongoException $e) {

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
            $username = 'admin';
            $password = 'U4f9rDwdDsMd';
            $host = '127.12.74.132';
            $port = '27017';
            $database = 'taller';
            $url = 'mongodb://'.$username.':'.$password.'@'.$host.':'.$port.'/';
            //$url = 'localhost';
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