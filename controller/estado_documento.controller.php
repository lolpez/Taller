<?php
require_once 'view/estado_documento/estado_documento.view.php';
require_once 'model/estado_documento.php';
require_once 'model/bitacora.php';
require_once 'model/permiso.php';

class Estado_DocumentoController {

    private $model;
    private $vista;
    private $item;
    private $bitacora;
    private $permiso;

    public function __CONSTRUCT() {
        $this->model = new Estado_Documento();
        $this->vista = new Estado_DocumentoView();
        $this->bitacora = new Bitacora();
        $this->item = 'estado documento';
        $permiso = new Permiso();
        $this->permiso = $permiso->Obtener($_SESSION['usuario']->fkcargo);
    }

    public function Index() {
        $lista = $this->model->Listar();
        $this->vista->View($lista,$this->permiso);
    }

    public function Editar() {
        $estado_documento = $this->model->Obtener($_REQUEST['pkestado_documento']);
        $this->vista->Editar($estado_documento,$this->permiso);
    }

    public function Guardar() {
        $datos = array(
            'pk' => $_POST['pk'],
            'nombre' => $_POST['nombre'],
            'nomenglatura' => $_POST['nomenglatura'],
            'descripcion' => $_POST['descripcion'],
            'color' => $_POST['color']
        );
        $exito = $this->model->Editar($datos);
        $DescripcionBitacora = 'se modifico el '.$this->item.' '.$_POST['nombre'];
        $tarea='modificar';
        $this->bitacora->GuardarBitacora($DescripcionBitacora);
        header('Location: ?c=estado_documento&item='.$this->item.' '.$_POST['nombre'].'&tarea='.$tarea.'&exito='.$exito);
    }
}
?>