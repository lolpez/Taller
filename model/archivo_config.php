<?php
require_once 'singleton/mysql.php';
class Archivo_Config {
    private $pdo;
    public function __CONSTRUCT() {
        try {
            $this->pdo = ConexionMysql::getInstance()->obtenerConexion();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Listar() {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM archivo_config WHERE estado=1");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Obtener($pk) {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM archivo_config a WHERE a.pkarchivo_config= ? ");
            $sql->execute(array($pk));
            return $sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Guardar($datos) {
        try {
            $sql = "INSERT INTO archivo_config (nombre,icono,extencion) VALUES (?,?,?)";
            $this->pdo->prepare($sql)->execute(
                array(
                    $datos['nombre'],
                    $datos['icono'],
                    $datos['extencion']
                )
            );
            return true;
        } catch (Exception $e) {
            return 0;
        }
    }
    public function Editar($datos) {
        try {
            $sql = "UPDATE archivo_config SET nombre=?, icono=?, extencion=? WHERE pkarchivo_config=? ";
            $this->pdo->prepare($sql)->execute(
                array(
                    $datos['nombre'],
                    $datos['icono'],
                    $datos['extencion'],
                    $datos['pk']
                )
            );
            return true;
        } catch (exception $e) {
            return false;
        }
    }
    public function Eliminar($pk) {
        try {
            $sql = $this->pdo->prepare("UPDATE archivo_config SET estado=0 WHERE pkarchivo_config = ?");
            $sql->execute(array($pk));
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
?>