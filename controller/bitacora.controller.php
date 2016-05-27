<?php
require_once 'model/bitacora.php';
require_once 'view/bitacora/bitacora.view.php';
require_once 'model/fachada/permiso.php';

class BitacoraController {

    private $model;
    private $vista;
    private $permiso;

    public function __CONSTRUCT() {
        $this->model = new Bitacora();
        $this->vista = new BitacoraView();
        $fachada = new Permiso();
        $this->permiso = $fachada->Obtener_Permiso($_SESSION['usuario']->fkcargo);
    }

    public function Index() {
        $lista = $this->model->Listar();
        $this->vista->View($lista,$this->permiso);
    }
}

?>