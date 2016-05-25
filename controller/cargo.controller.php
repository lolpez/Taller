<?php
require_once 'view/cargo/cargo.view.php';
require_once 'model/cargo.php';
require_once 'model/bitacora.php';
require_once 'model/fachada/fachada.php';

class CargoController {

    private $model;
    private $vista;
    private $item;
    private $bitacora;
    private $menu;

    public function __CONSTRUCT() {
        $this->model = new Cargo();
        $this->vista = new CargoView();
        $this->bitacora = new Bitacora();
        $this->item = 'cargo';
        $fachada = new Fachada();
        $this->menu = $fachada->Obtener_Privilegio($_SESSION['usuario']->fkcargo);
    }

    public function Index() {
        $lista = $this->model->Listar();
        $this->vista->View($lista,$this->menu);
    }

    public function Nuevo() {
        $this->vista->Nuevo($this->menu);
    }

    public function Editar() {
        $cargo = $this->model->Obtener($_REQUEST['pkcargo']);
        $this->vista->Editar($cargo,$this->menu);
    }

    public function Guardar() {
        if (isset($_POST['pk'])){   //si es editar
            $datos = array(
                'pk' => $_POST['pk'],
                'nombre' => $_POST['nombre'],
                'descripcion' => $_POST['descripcion']
            );
            $exito = $this->model->Editar($datos);
            $DescripcionBitacora = 'se modifico el cargo '.$_POST['nombre'];
            $tarea='modificar';
        }else{
            $datos = array(
                'nombre' => $_POST['nombre'],
                'descripcion' => $_POST['descripcion']
            );
            $exito = $this->model->Guardar($datos);
            $DescripcionBitacora = 'se agrego un nuevo cargo ' . $_POST['nombre'];
            $tarea='agregar';
        }
        $this->bitacora->GuardarBitacora($DescripcionBitacora);
        header('Location: ?c=cargo&item='.$this->item.' '.$_POST['nombre'].'&tarea='.$tarea.'&exito='.$exito);
    }

    public function Eliminar() {
        $tarea = 'eliminar';
        $cargo = $this->model->Obtener($_REQUEST['pk']);
        $exito = $this->model->Eliminar($_REQUEST['pk']);
        $this->bitacora->GuardarBitacora('se dio de baja el cargo '.$cargo->nombre);
        header('Location: ?c=cargo&item='.$this->item.' '.$cargo->nombre.'&tarea='.$tarea.'&exito='.$exito);
    }
}
?>