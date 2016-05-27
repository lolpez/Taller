<?php
include_once 'model/singleton/mysql.php';
try {
    $this->pdo = ConexionMysql::getInstance()->obtenerConexion();
} catch (Exception $e) {
    die($e->getMessage());
}
?>