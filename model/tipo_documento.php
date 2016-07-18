<?php

require_once 'singleton/mysql.php';

class Tipo_Documento {

    private $pdo;

    public function __CONSTRUCT($metodo = false) {
        try {
            $this->pdo = ConexionMysql::getInstance($metodo)->obtenerConexion();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Listar() {
        try {
            //Excluir el tipo de documento 0 porque es el tipo plantilla
            $sql = $this->pdo->prepare("SELECT * FROM tipo_documento t WHERE t.estado=1 AND NOT t.pktipo_documento = 0");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener($pk) {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM tipo_documento a WHERE a.pktipo_documento= ? ");
            $sql->execute(array($pk));

            return $sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Guardar($datos) {
        try {
            $sql = "INSERT INTO tipo_documento (sigla,nombre) VALUES (?,?)";
            $this->pdo->prepare($sql)->execute(
                array(
                    $datos['sigla'],
                    $datos['nombre']
                )
            );
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function Editar($datos) {
        try {
            $sql = "UPDATE tipo_documento SET sigla=?, nombre=? WHERE pktipo_documento=? ";
            $this->pdo->prepare($sql)->execute(
                array(
                    $datos['sigla'],
                    $datos['nombre'],
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
            $sql = $this->pdo->prepare("UPDATE tipo_documento SET estado=0 WHERE pktipo_documento = ?");
            $sql->execute(array($pk));
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}
?>