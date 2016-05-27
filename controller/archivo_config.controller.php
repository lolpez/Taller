<?php
require_once 'view/archivo_config/archivo_config.view.php';
require_once 'model/archivo_config.php';
require_once 'model/bitacora.php';
require_once 'model/fachada/permiso.php';

class Archivo_ConfigController {

    private $model;
    private $vista;
    private $item;
    private $bitacora;
    private $permiso;

    public function __CONSTRUCT() {
        $this->model = new Archivo_Config();
        $this->vista = new Archivo_ConfigView();
        $this->bitacora = new Bitacora();
        $this->item = 'archivos permitidos';
        $fachada = new Permiso();
        $this->permiso = $fachada->Obtener_Permiso($_SESSION['usuario']->fkcargo);
    }

    public function Index() {
        $lista = $this->model->Listar();
        $this->vista->View($lista,$this->permiso);
    }

    public function Nuevo() {
        $this->vista->Nuevo($this->permiso);
    }

    public function Editar() {
        $archivo = $this->model->Obtener($_REQUEST['pkarchivo_config']);
        $this->vista->Editar($archivo,$this->permiso);
    }

    public function Guardar() {
        if (isset($_POST['pk'])){   //si es editar
            $datos = array(
                'pk' => $_POST['pk'],
                'nombre' => $_POST['nombre'],
                'icono' => $_POST['icono'],
                'extencion' => $_POST['extencion']
            );
            $exito = $this->model->Editar($datos);
            $DescripcionBitacora = 'se modifico el tipo de archivo que el sistema permitira ('.$_POST['extencion'].')';
            $tarea='modificar';
        }else{
            $datos = array(
                'nombre' => $_POST['nombre'],
                'icono' => $_POST['icono'],
                'extencion' => $_POST['extencion']
            );
            $exito = $this->model->Guardar($datos);
            $DescripcionBitacora = 'se agrego un nuevo tipo de archivo que el sistema permitira (' .$_POST['extencion'].')';
            $tarea='agregar';
        }
        if ($exito){
            $this->bitacora->GuardarBitacora($DescripcionBitacora);
        }
        header('Location: ?c=archivo_config&item='.$this->item.' '.$_POST['nombre'].'&tarea='.$tarea.'&exito='.$exito);
    }

    public function Eliminar() {
        $tarea = 'eliminar';
        $archivo = $this->model->Obtener($_REQUEST['pk']);
        $exito = $this->model->Eliminar($_REQUEST['pk']);
        $this->bitacora->GuardarBitacora('se dio de baja el tipo de archivo permitido por el sistema '.$archivo->nombre);
        header('Location: ?c=archivo_config&item='.$this->item.' '.$archivo->nombre.'&tarea='.$tarea.'&exito='.$exito);
    }
}
?>