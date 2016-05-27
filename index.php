<?php
include_once 'model/singleton/mongo.php';
include_once 'model/singleton/mysql.php';
$con = ConexionMysql::getInstance()->obtenerConexion();
$con2 = ConexionMongo::getInstance()->obtenerConexion();
?>