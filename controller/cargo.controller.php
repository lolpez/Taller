<?php
require_once 'view/cargo/cargo.view.php';
require_once 'model/cargo.php';
require_once 'model/bitacora.php';
require_once 'model/permiso.php';

class CargoController {

    private $model;
    private $vista;
    private $item;
    private $bitacora;
    private $permiso;

    public function __CONSTRUCT() {
        $this->model = new Cargo();
        $this->vista = new CargoView();
        $this->bitacora = new Bitacora();
        $this->item = 'cargo';
        $permiso = new Permiso();
        $this->permiso = $permiso->Obtener($_SESSION['usuario']->fkcargo);
    }

    public function Index() {
        $lista = $this->model->Listar();
        $this->vista->View($lista,$this->permiso);
    }

    public function Nuevo() {
        $this->vista->Nuevo($this->permiso);
    }

    public function Editar() {
        $cargo = $this->model->Obtener($_REQUEST['pkcargo']);
        $this->vista->Editar($cargo,$this->permiso);
    }

    public function Guardar() {
        if (isset($_POST['pk'])){   //si es editar
            $datos = array(
                'pk' => $_POST['pk'],
                'nombre' => $_POST['nombre'],
                'descripcion' => $_POST['descripcion']
            );
            $exito = $this->model->Editar($datos);
            $DescripcionBitacora = 'se modifico el '.$this->item.' '.$_POST['nombre'];
            $tarea='modificar';
        }else{
            $datos = array(
                'nombre' => $_POST['nombre'],
                'descripcion' => $_POST['descripcion']
            );
            $exito = $this->model->Guardar($datos);
            $DescripcionBitacora = 'se agrego un nuevo '.$this->item.' ' . $_POST['nombre'];
            $tarea='agregar';
        }
        $this->bitacora->GuardarBitacora($DescripcionBitacora);
        header('Location: ?c=cargo&item='.$this->item.' '.$_POST['nombre'].'&tarea='.$tarea.'&exito='.$exito);
    }

    public function Eliminar() {
        $tarea = 'eliminar';
        $cargo = $this->model->Obtener($_REQUEST['pk']);
        $exito = $this->model->Eliminar($_REQUEST['pk']);
        $this->bitacora->GuardarBitacora('se dio de baja el '.$this->item.' '.$cargo->nombre);
        header('Location: ?c=cargo&item='.$this->item.' '.$cargo->nombre.'&tarea='.$tarea.'&exito='.$exito);
    }
}
?>