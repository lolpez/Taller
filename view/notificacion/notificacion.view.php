<?php

class NotificacionView{

    public function View($lista,$menu){
        require_once 'view/header.php';
        require_once 'view/notificacion/notificacion-admin.php';
        require_once 'view/footer.php';
    }

    public function Notificaciones($listaV,$listaNV,$menu){
        require_once 'view/header.php';
        require_once 'view/notificacion/notificacion-panel.php';
        require_once 'view/footer.php';
    }

}

?>