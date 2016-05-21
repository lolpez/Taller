<?php

require_once 'singleton/mysql.php';

class Usuario {

    private $pdo;

    public function __CONSTRUCT() {
        try {
            $this->pdo = ConexionMysql::getInstance()->getPDO();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Listar() {
        try {
            $sql = $this->pdo->prepare("select u.pkusuario,u.nombre,u.ci,u.telefono,u.email,c.nombre as cargo from usuario u, cargo c where u.fkcargo=c.pkcargo and u.estado=1 and c.estado=1;");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener($pk) {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM usuario u WHERE u.pkusuario= ? ");
            $sql->execute(array($pk));
            return $sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener_Responsable($pkarea) {
        try {
            $sql = $this->pdo->prepare("SELECT u.pkusuario, u.nombre as nombre, a.nombre as area FROM usuario u, cargo c, area a WHERE u.fkcargo=c.pkcargo AND c.fkarea=a.pkarea AND a.pkarea=?");
            $sql->execute(array($pkarea));
            return $sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener_Por_Cargo($pkcargo) {
        try {
            $sql = $this->pdo->prepare("SELECT u.pkusuario FROM usuario u, cargo c WHERE u.fkcargo=c.pkcargo AND c.pkcargo=?");
            $sql->execute(array($pkcargo));
            return $sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Login($ci){
        try {
            $sql = $this->pdo->prepare("SELECT u.pkusuario, u.nombre, u.ci, u.telefono, u.email, u.archivo, u.fkcargo, c.nombre as cargo FROM usuario u, cargo c WHERE u.fkcargo = c.pkcargo and u.ci= ? and u.estado = 1");
            $sql->execute(array($ci));
            return $sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Guardar($datos) {
        try {
            $sql = $this->pdo->prepare("INSERT INTO usuario (ci,nombre,email,telefono,archivo,fkcargo) VALUES (?,?,?,?,?,?)");
            $sql->execute(
                array(
                    $datos['ci'],
                    $datos['nombre'],
                    $datos['email'],
                    $datos['telefono'],
                    $datos['archivo'],
                    $datos['fkcargo']
                )
            );
            return 'si';
        } catch (Exception $e) {
            return 'no';
        }
    }

    public function Mail_User($correo) {
        try {
            $sql = $this->pdo->prepare("SELECT u.pkusuario,u.nombre,u.ci,u.telefono,u.email,c.nombre as cargo,u.pass from usuario u,cargo c where u.fkcargo=c.pkcargo and u.email='".$correo."'  and u.estado=1;");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Editar($datos) {
        try {
            $sql = "UPDATE usuario SET ci=? ,nombre=? ,email=? ,telefono=? ,archivo=? ,fkcargo=? WHERE pkusuario=? ";
            $this->pdo->prepare($sql)->execute(
                array(
                    $datos['ci'],
                    $datos['nombre'],
                    $datos['email'],
                    $datos['telefono'],
                    $datos['archivo'],
                    $datos['fkcargo'],
                    $datos['pk']
                )
            );
            return 'si';
        } catch (exception $e) {
            return 'no';
        }
    }

    public function Eliminar($pk) {
        try {
            $sql = $this->pdo->prepare("UPDATE usuario SET estado=0 WHERE pkusuario = ?");
            $sql->execute(array($pk));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}

?>