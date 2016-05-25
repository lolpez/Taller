<?php

require_once 'singleton/mysql.php';

class MenuDetalle {

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
            $sql = $this->pdo->prepare("SELECT * FROM menu_detalle");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener($pk) {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM menu_detalle m WHERE m.pkmenu_detalle= ? ");
            $sql->execute(array($pk));
            return $sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Guardar($datos) {
        try {
            $sql = "INSERT INTO menu_detalle (nombre,icono,fkmenu) VALUES (?,?)";
            $this->pdo->prepare($sql)->execute(
                array(
                    $datos['nombre'],
                    $datos['icono']
                )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Editar($datos) {
        try {
            $sql = "UPDATE menu_detalle SET nombre=?, icono=? WHERE pkmenu_detalle=? ";
            $this->pdo->prepare($sql)->execute(
                array(
                    $datos['nombre'],
                    $datos['icono'],
                    $datos['pk']
                )
            );
        } catch (exception $e) {
            die($e->getMessage());
        }
    }
}

?>