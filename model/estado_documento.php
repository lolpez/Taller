<?php

require_once 'singleton/mysql.php';

class Estado_Documento {

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
            $sql = $this->pdo->prepare("SELECT * FROM estado_documento e");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener($pk) {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM estado_documento e WHERE e.pkestado_documento= ? ");
            $sql->execute(array($pk));
            return $sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener_Por_Nomenglatura($nomenglatura) {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM estado_documento e WHERE e.nomenglatura= ? ");
            $sql->execute(array($nomenglatura));
            return $sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Editar($datos) {
        try {
            $sql = "UPDATE estado_documento SET nomenglatura=?, nombre=?, descripcion=?, color=? WHERE pkestado_documento=? ";
            $this->pdo->prepare($sql)->execute(
                array(
                    $datos['nomenglatura'],
                    $datos['nombre'],
                    $datos['descripcion'],
                    $datos['color'],
                    $datos['pk']
                )
            );
            return true;
        } catch (exception $e) {
            return false;
        }
    }

}
?>