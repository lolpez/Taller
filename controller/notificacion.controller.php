<?php
require_once 'view/notificacion/notificacion.view.php';
require_once 'model/permiso.php';

class NotificacionController {

    private $vista;
    private $permiso;

    public function __CONSTRUCT() {
        $this->vista = new NotificacionView();
        $permiso = new Permiso();
        $this->permiso = $permiso->Obtener($_SESSION['usuario']->fkcargo);
    }

    public function Index() {
        $this->vista->View($this->permiso);
    }

}
?>