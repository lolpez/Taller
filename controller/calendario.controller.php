<?php
require_once 'model/calendario.php';
require_once 'model/bitacora.php';
require_once 'view/calendario/calendario.view.php';
require_once 'model/permiso.php';

class CalendarioController {

    private $model;
    private $vista;
    private $bitacora;
    private $permiso;

    public function __CONSTRUCT() {
        $this->model = new Calendario();
        $this->vista = new CalendarioView();
        $this->bitacora = new Bitacora();
        $permiso = new Permiso();
        $this->permiso = $permiso->Obtener($_SESSION['usuario']->fkcargo);
    }

    public function Index() {
        $lista = $this->model->Listar();
        $ano = date('Y');
        $this->vista->View($lista,$ano,$this->permiso);
    }

    public function Guardar() {
        $datos = array(
            'fecha' => $_REQUEST['fecha'],
            'nombre' => $_REQUEST['nombre']
        );
        $this->model->Guardar($datos);
        $DescripcionBitacora = 'se agrego un nuevo feriado '.$_REQUEST['fecha'].' ('.$_REQUEST['nombre'].')';
        $this->bitacora->GuardarBitacora($DescripcionBitacora);
        header('Location: ?c=calendario&item=feriado '.$_REQUEST['nombre'].'&tarea=agregar&exito=1');
    }

    public function Editar() {
        $datos = array(
            'fecha' => $_REQUEST['fecha'],
            'nombre' => $_REQUEST['nombre']
        );
        $this->model->Editar($datos);
        $DescripcionBitacora = 'se modifico el feriado '.$_REQUEST['fecha'].' ('.$_REQUEST['nombre'].')';
        $this->bitacora->GuardarBitacora($DescripcionBitacora);
        header('Location: ?c=calendario&item=feriado '.$_REQUEST['nombre'].'&tarea=modificar&exito=1');
    }

    public function Eliminar() {
        $nombre = $this->model->Obtener($_REQUEST['pk']);
        $this->model->Eliminar($_REQUEST['pk']);
        $this->bitacora->GuardarBitacora('se elimino el feriado '.$_REQUEST['pk'].' ('.$nombre->nombre.')');
        header('Location: ?c=calendario&item=feriado '.$nombre->nombre.'&tarea=eliminar&exito=1');
    }
}

?>