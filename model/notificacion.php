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

    public function Listar($pkusuario) {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM notificacion WHERE fkusuario_destino = ?");
            $sql->execute(array($pkusuario));
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
            $sql = $this->pdo->prepare("SELECT * FROM notificacion n WHERE n.fkusuario_destino=? AND n.terminado=0");
            $sql->execute(array($fkusuario_destino));
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener_Visto($fkusuario_destino) {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM notificacion n WHERE n.fkusuario_destino=? AND n.terminado=1");
            $sql->execute(array($fkusuario_destino));
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Guardar($datos) {
        try {
            $sql = "INSERT INTO notificacion(fkavance,fkusuario_destino) VALUES (?,?)";
            $this->pdo->prepare($sql)->execute(
                array(
                    $datos['fkavance'],
                    $datos['fkusuario_destino']
                )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Visto($pk) {
        try {
            $sql = $this->pdo->prepare("UPDATE notificacion SET terminado=1 WHERE pknotificacion = ?");
            $sql->execute(array($pk));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener_Por_Avance($datos){
        try {
            $sql = $this->pdo->prepare("SELECT n.pknotificacion FROM notificacion n, avance a WHERE n.fkavance=a.pkavance AND a.pkavance=? AND n.fkusuario_destino=?");
            $sql->execute(
                array(
                    $datos['fkavance'],
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