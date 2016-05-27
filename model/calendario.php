<?php

require_once 'singleton/mysql.php';

class Calendario {

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
            $sql = $this->pdo->prepare("SELECT * FROM calendario");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener($pk) {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM calendario WHERE fecha= ? ");
            $sql->execute(array($pk));
            return $sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Guardar($datos) {
        try {
            $sql = "INSERT INTO calendario (fecha,nombre) VALUES (?,?)";
            $this->pdo->prepare($sql)->execute(
                array(
                    $datos['fecha'],
                    $datos['nombre']
                )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function Editar($datos) {
        try {
            $sql = "UPDATE calendario SET nombre=? WHERE fecha=? ";
            $this->pdo->prepare($sql)->execute(
                array(
                    $datos['nombre'],
                    $datos['fecha']
                )
            );
        } catch (exception $e) {
            die($e->getMessage());
        }
    }

    public function Eliminar($pk) {
        try {
            $sql = $this->pdo->prepare("DELETE FROM calendario WHERE fecha = ?");
            $sql->execute(array($pk));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}

?>