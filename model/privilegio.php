<?php

require_once 'singleton/mysql.php';

class Privilegio {

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
            $sql = $this->pdo->prepare("SELECT * FROM privilegio");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener($pk) {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM privilegio p WHERE p.fkcargo = ? ");
            $sql->execute(array($pk));
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Guardar($datos) {
        try {
            $sql = "INSERT INTO privilegio (fkcargo, fkmenu_detalle) VALUES (?,?)";
            $this->pdo->prepare($sql)->execute(
                array(
                    $datos['fkcargo'],
                    $datos['fkmenu_detalle']
                )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function  ObtenerUsuario($pkusuario){
        try {
            $sql = $this->pdo->prepare("SELECT u.nombre, u.fkcargo FROM usuario u WHERE u.pkusuario = ?");
            $sql->execute(array($pkusuario));
            return $sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Eliminar($pk) {
        try {
            $sql = $this->pdo->prepare("DELETE FROM privilegio WHERE fkcargo = ?");
            $sql->execute(array($pk));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}

?>