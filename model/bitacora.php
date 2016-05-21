<?php

require_once 'singleton/mysql.php';

class Bitacora {

    private $pdo;

    public function __CONSTRUCT() {
        try {
            $this->pdo = ConexionMysql::getInstance()->getPDO();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function GuardarBitacora($descripcion){
        date_default_timezone_set("America/La_Paz");
        $fecha=date("d/m/Y");
        $hora=date("h:i:s");
        $datosbitacora = array(
            'fkusuario' => $_SESSION['usuario'],
            'accion' => $descripcion,
            'fecha' => $fecha,
            'hora' => $hora,
        );
        $this->Guardar($datosbitacora);
    }

    public function Listar() {
        try {
            $sql = $this->pdo->prepare("SELECT b.pkbitacora, u.nombre AS usuario , c.nombre as cargo, b.accion, b.fecha, b.hora FROM bitacora b, usuario u, cargo c WHERE b.fkusuario = u.pkusuario AND c.pkcargo = u.fkcargo ORDER BY b.pkbitacora DESC");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    private  function Guardar($data) {
        try {
            $sql = "INSERT INTO bitacora (fkusuario, accion, fecha, hora) VALUES (?,?,?,?)";
            $this->pdo->prepare($sql)->execute(
                array(
                    $data['fkusuario'],
                    $data['accion'],
                    $data['fecha'],
                    $data['hora']
                )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}

?>