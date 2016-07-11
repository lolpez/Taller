<?php
require_once 'model/privilegio.php';
require_once 'model/cargo.php';
require_once 'model/menu.php';
require_once 'model/menu_detalle.php';
require_once 'model/bitacora.php';
require_once 'view/privilegio/privilegio.view.php';
require_once 'model/permiso.php';

class PrivilegioController {

    private $model;
    private $cargo;
    private $menu;
    private $menu_detalle;
    private $vista;
    private $bitacora;
    private $permiso;

    public function __CONSTRUCT() {
        $this->model = new Privilegio();
        $this->cargo = new Cargo();
        $this->menu = new Menu();
        $this->menu_detalle = new MenuDetalle();
        $this->vista = new PrivilegioView();
        $this->bitacora = new Bitacora();
        $permiso = new Permiso();
        $this->permiso = $permiso->Obtener($_SESSION['usuario']->fkcargo);
    }

    public function Index() {
        $privilegio = $this->model->Listar();
        $cargo = $this->cargo->Listar();
        $menu = $this->menu->Listar();
        $menu_detalle = $this->menu_detalle->Listar();
        $this->vista->View($privilegio,$cargo,$menu,$menu_detalle,$this->permiso);
    }

    public function Nuevo() {
        $this->vista->Nuevo();
    }

    public function Editar() {
        $privilegio = $this->model->Obtener($_REQUEST['pkcargo']);
        $cargo = $this->cargo->Obtener($_REQUEST['pkcargo']);
        $menu = $this->menu->Listar();
        $menu_detalle = $this->menu_detalle->Listar();
        $this->vista->Editar($cargo, $privilegio, $menu, $menu_detalle,$this->permiso);
    }

    public function Guardar() {
        $cargo = $this->cargo->Obtener($_POST['pk']);
        //Esto funcionara como un editar tambien
        //HEY! pero si es estupido y funciona entonces no es estupido
        $this->model->Eliminar($cargo->pkcargo);
        foreach ($_POST['fkmenu_detalle'] as $r):
            $datos = array(
                'fkcargo' => $cargo->pkcargo,
                'fkmenu_detalle' => $r
            );
            $this->model->Guardar($datos);
        endforeach;
        $DescripcionBitacora = 'se modifico los permisos para el cargo '.$cargo->nombre;
        $this->bitacora->GuardarBitacora($DescripcionBitacora);
        header('Location: ?c=privilegio&item=permisos para el cargo '.$cargo->nombre.'&tarea=modificar&exito=1');
    }

}

?>