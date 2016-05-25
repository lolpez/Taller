<?php

require_once 'singleton/mysql.php';

class Cargo {

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
            $sql = $this->pdo->prepare("SELECT * FROM cargo WHERE estado=1");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener($pk) {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM cargo c WHERE c.pkcargo= ? ");
            $sql->execute(array($pk));

            return $sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Guardar($datos) {
        try {
            $sql = "INSERT INTO cargo (nombre,descripcion) VALUES (?,?)";
            $this->pdo->prepare($sql)->execute(
                array(
                    $datos['nombre'],
                    $datos['descripcion']
                )
            );
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function Editar($datos) {
        try {
            $sql = "UPDATE cargo SET nombre=?, descripcion=? WHERE pkcargo=? ";
            $this->pdo->prepare($sql)->execute(
                array(
                    $datos['nombre'],
                    $datos['descripcion'],
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
            $sql = $this->pdo->prepare("UPDATE cargo SET estado=0 WHERE pkcargo = ?");
            $sql->execute(array($pk));
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}
?>