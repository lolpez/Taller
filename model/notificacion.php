<?php

require_once 'singleton/mysql.php';

class Notificacion {

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
            $sql = $this->pdo->prepare("SELECT * FROM notificacion");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener($pk) {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM notificacion n WHERE n.pknotificacion=?");
            $sql->execute(array($pk));
            return $sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener_NoVisto($fkusuario_destino) {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM notificacion n WHERE n.fkusuario_destino=? AND n.visto=0");
            $sql->execute(array($fkusuario_destino));
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener_Visto($fkusuario_destino) {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM notificacion n WHERE n.fkusuario_destino=? AND n.visto=1");
            $sql->execute(array($fkusuario_destino));
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Guardar($datos) {
        try {
            $sql = "INSERT INTO notificacion(fecha,fksolicitud,fkusuario_creador,fkusuario_destino) VALUES (?,?,?,?)";
            $this->pdo->prepare($sql)->execute(
                array(
                    $datos['fecha'],
                    $datos['fksolicitud'],
                    $datos['fkusuario_creador'],
                    $datos['fkusuario_destino']
                )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Editar($datos) {
        try {
            $sql = "UPDATE notificacion SET fecha=?, mensaje=?, fksolicitud=?, fkusuario_creador=?, fkusuario_destino=? WHERE pknotificacion=? ";
            $this->pdo->prepare($sql)->execute(
                array(
                    $datos['fecha'],
                    $datos['mensaje'],
                    $datos['fksolicitud'],
                    $datos['fkusuario_creador'],
                    $datos['fkusuario_destino'],
                    $datos['pk']
                )
            );
        } catch (exception $e) {
            die($e->getMessage());
        }
    }

    public function Visto($pk) {
        try {
            $sql = $this->pdo->prepare("UPDATE notificacion SET visto=1 WHERE pknotificacion = ?");
            $sql->execute(array($pk));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener_Por_Solicitud($datos){
        try {
            $sql = $this->pdo->prepare("SELECT n.pknotificacion FROM notificacion n WHERE n.fksolicitud=? and n.fkusuario_destino=?");
            $sql->execute(
                array(
                    $datos['fksolicitud'],
                    $datos['fkusuario_destino']
                )
            );
            return $sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}

?>