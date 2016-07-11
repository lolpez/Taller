<?php
require_once 'view/tipo_documento/tipo_documento.view.php';
require_once 'model/tipo_documento.php';
require_once 'model/bitacora.php';
require_once 'model/permiso.php';

class Tipo_DocumentoController {

    private $model;
    private $vista;
    private $item;
    private $bitacora;
    private $permiso;

    public function __CONSTRUCT() {
        $this->model = new Tipo_Documento();
        $this->vista = new Tipo_DocumentoView();
        $this->bitacora = new Bitacora();
        $this->item = 'tipo documento';
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
        $tipo_documento = $this->model->Obtener($_REQUEST['pktipo_documento']);
        $this->vista->Editar($tipo_documento,$this->permiso);
    }

    public function Guardar() {
        if (isset($_POST['pk'])){   //si es editar
            $datos = array(
                'pk' => $_POST['pk'],
                'sigla' => $_POST['nombre'],
                'nombre' => $_POST['sigla']
            );
            $exito = $this->model->Editar($datos);
            $DescripcionBitacora = 'se modifico el '.$this->item.' '.$_POST['nombre'];
            $tarea='modificar';
        }else{
            $datos = array(
                'sigla' => $_POST['nombre'],
                'nombre' => $_POST['sigla']
            );
            $exito = $this->model->Guardar($datos);
            $DescripcionBitacora = 'se agrego un nuevo '.$this->item.' ' . $_POST['nombre'];
            $tarea='agregar';
        }
        $this->bitacora->GuardarBitacora($DescripcionBitacora);
        header('Location: ?c=tipo_documento&item='.$this->item.' '.$_POST['nombre'].'&tarea='.$tarea.'&exito='.$exito);
    }

    public function Eliminar() {
        $tarea = 'eliminar';
        $tipo_documento = $this->model->Obtener($_REQUEST['pk']);
        $exito = $this->model->Eliminar($_REQUEST['pk']);
        $this->bitacora->GuardarBitacora('se dio de baja el '.$this->item.' '.$tipo_documento->nombre);
        header('Location: ?c=tipo_documento&item='.$this->item.' '.$tipo_documento->nombre.'&tarea='.$tarea.'&exito='.$exito);
    }
}
?>