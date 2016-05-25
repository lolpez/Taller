<?php
require_once 'model/bitacora.php';
require_once 'view/bitacora/bitacora.view.php';
require_once 'model/fachada/fachada.php';

class BitacoraController {

    private $model;
    private $vista;
    private $menu;

    public function __CONSTRUCT() {
        $this->model = new Bitacora();
        $this->vista = new BitacoraView();
        $fachada = new Fachada();
        $this->menu = $fachada->Obtener_Privilegio($_SESSION['usuario']->fkcargo);
    }

    public function Index() {
        $lista = $this->model->Listar();
        $this->vista->View($lista,$this->menu);
    }
}

?>