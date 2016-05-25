<?php
require_once 'view/notificacion/notificacion.view.php';
require_once 'model/fachada/fachada.php';

class NotificacionController {

    private $vista;
    private $menu;

    public function __CONSTRUCT() {
        $this->vista = new NotificacionView();
        $fachada = new Fachada();
        $this->menu = $fachada->Obtener_Privilegio($_SESSION['usuario']->fkcargo);
    }

    public function Index() {
        $this->vista->View($this->menu);
    }

}
?>