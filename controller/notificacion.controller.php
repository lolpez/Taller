<?php
require_once 'view/notificacion/notificacion.view.php';
require_once 'model/fachada/permiso.php';

class NotificacionController {

    private $vista;
    private $permiso;

    public function __CONSTRUCT() {
        $this->vista = new NotificacionView();
        $fachada = new Permiso();
        $this->permiso = $fachada->Obtener_Permiso($_SESSION['usuario']->fkcargo);
    }

    public function Index() {
        $this->vista->View($this->permiso);
    }

}
?>