<?php

require_once 'singleton/mysql.php';

class Area_Flujo {

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
            $sql = $this->pdo->prepare("SELECT a.pkarea_flujo, a.nombre, a.sigla, b.nombre as padre FROM area_flujo a, area_flujo b WHERE a.fkarea_flujo_padre = b.pkarea_flujo AND a.estado=1");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener($pk) {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM area_flujo a WHERE a.fkarea= ?");
            $sql->execute(array($pk));
            return $sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Guardar($datos) {
        try {
            $sql = "INSERT INTO area_flujo (flujo,fkarea) VALUES (?,?)";
            $this->pdo->prepare($sql)->execute(
                array(
                    $datos['flujo'],
                    $datos['fkarea']
                )
            );
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function Editar($datos) {
        try {
            $sql = "UPDATE area_flujo SET nombre=?, sigla=?, fkarea_flujo_padre=? WHERE pkarea_flujo=? ";
            $this->pdo->prepare($sql)->execute(
                array(
                    $datos['nombre'],
                    $datos['sigla'],
                    $datos['fkarea_flujo_padre'],
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
            $sql = $this->pdo->prepare("UPDATE area_flujo SET estado=0 WHERE pkarea_flujo = ?");
            $sql->execute(array($pk));
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}
?>