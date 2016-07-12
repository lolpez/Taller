<?php

require_once 'singleton/mysql.php';

class Area {

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
            $sql = $this->pdo->prepare("SELECT a.pkarea, a.nombre, a.sigla, b.nombre as padre FROM area a, area b WHERE a.fkarea_padre = b.pkarea AND a.estado=1");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener($pk) {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM area a WHERE a.pkarea= ? ");
            $sql->execute(array($pk));
            return $sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Guardar($datos) {
        try {
            $sql = "INSERT INTO area (nombre,sigla,fkarea_padre) VALUES (?,?,?)";
            $this->pdo->prepare($sql)->execute(
                array(
                    $datos['nombre'],
                    $datos['sigla'],
                    $datos['fkarea_padre']
                )
            );
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function Editar($datos) {
        try {
            $sql = "UPDATE area SET nombre=?, sigla=?, fkarea_padre=? WHERE pkarea=? ";
            $this->pdo->prepare($sql)->execute(
                array(
                    $datos['nombre'],
                    $datos['sigla'],
                    $datos['fkarea_padre'],
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
            $sql = $this->pdo->prepare("UPDATE area SET estado=0 WHERE pkarea = ?");
            $sql->execute(array($pk));
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function Obtener_Ultimo_ID() {
        try {
            $sql = $this->pdo->prepare("SELECT max(pkarea) as pkarea FROM area");
            $sql->execute();
            return $sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
?>