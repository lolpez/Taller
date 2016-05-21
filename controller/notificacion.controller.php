<?php
require_once 'view/notificacion/notificacion.view.php';

class NotificacionController {

    private $vista;

    public function __CONSTRUCT() {
        $this->vista = new NotificacionView();
    }

    public function Index() {
        $this->vista->View();
    }
}
?>