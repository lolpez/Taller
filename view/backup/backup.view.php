<?php

class BackupView{

    public function View($lista,$menu){
        require_once 'view/header.php';
        require_once 'view/backup/backup-admin.php';
        require_once 'view/footer.php';
    }

    public function Verificacion($bd_accion,$icono,$pkbackup,$menu){
        require_once 'view/header.php';
        require_once 'view/backup/backup-verificacion.php';
        require_once 'view/footer.php';
    }

    public function Resultado($bd_accion,$alerta,$icono,$mensaje,$menu,$archivo){
        require_once 'view/header.php';
        require_once 'view/backup/backup-resultado.php';
        require_once 'view/footer.php';
    }

}

?>