<?php

require_once 'singleton/mysql.php';

class Emision {

    private $pdo;

    public function __CONSTRUCT() {
        try {
            $this->pdo = ConexionMysql::getInstance()->obtenerConexion();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Listar($pkarea) {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM emision e WHERE e.fkarea = ?");
            $sql->execute(array($pkarea));
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener($pk) {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM emision a WHERE a.pkemision= ? ");
            $sql->execute(array($pk));
            return $sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Guardar($datos) {
        try {
            $sql = "INSERT INTO emision (fkusuario,fkdocumento,fkarea) VALUES (?,?,?)";
            $this->pdo->prepare($sql)->execute(
                array(
                    $datos['fkusuario'],
                    $datos['fkdocumento'],
                    $datos['fkarea']
                )
            );
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
?>