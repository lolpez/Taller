<?php
require_once 'view/area/area.view.php';
require_once 'model/area.php';
require_once 'model/bitacora.php';
require_once 'model/fachada/permiso.php';

class AreaController {

    private $model;
    private $vista;
    private $item;
    private $bitacora;
    private $permiso;

    public function __CONSTRUCT() {
        $this->model = new Area();
        $this->vista = new AreaView();
        $this->bitacora = new Bitacora();
        $this->item = 'area';
        $fachada = new Permiso();
        $this->permiso = $fachada->Obtener_Permiso($_SESSION['usuario']->fkcargo);
    }

    public function Index() {
        $lista = $this->model->Listar();
        $this->vista->View($lista,$this->permiso);
    }

    public function Nuevo() {
        $listaA = $this->model->Listar();
        $this->vista->Nuevo($listaA,$this->permiso);
    }

    public function Editar() {
        $listaA = $this->model->Listar();
        $area = $this->model->Obtener($_REQUEST['pkarea']);
        $this->vista->Editar($listaA,$area,$this->permiso);
    }

    public function Guardar() {
        if (isset($_POST['pk'])){   //si es editar
            $datos = array(
                'pk' => $_POST['pk'],
                'nombre' => $_POST['nombre'],
                'sigla' => $_POST['sigla'],
                'fkarea_padre' => $_POST['fkarea_padre']
            );
            $exito = $this->model->Editar($datos);
            $DescripcionBitacora = 'se modifico el area '.$_POST['nombre'];
            $tarea='modificar';
        }else{
            $datos = array(
                'nombre' => $_POST['nombre'],
                'sigla' => $_POST['sigla'],
                'fkarea_padre' => $_POST['fkarea_padre']
            );
            $exito = $this->model->Guardar($datos);
            $DescripcionBitacora = 'se agrego un nuevo area ' . $_POST['nombre'];
            $tarea='agregar';
        }
        $this->bitacora->GuardarBitacora($DescripcionBitacora);
        header('Location: ?c=area&item='.$this->item.' '.$_POST['nombre'].'&tarea='.$tarea.'&exito='.$exito);
    }

    public function Eliminar() {
        $tarea = 'eliminar';
        $area = $this->model->Obtener($_REQUEST['pk']);
        $exito = $this->model->Eliminar($_REQUEST['pk']);
        $this->bitacora->GuardarBitacora('se dio de baja el area '.$area->nombre);
        header('Location: ?c=area&item='.$this->item.' '.$area->nombre.'&tarea='.$tarea.'&exito='.$exito);
    }
}
?>