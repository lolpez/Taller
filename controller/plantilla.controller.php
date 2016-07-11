<?php
require_once 'view/plantilla/plantilla.view.php';
require_once 'model/plantilla.php';
require_once 'model/permiso.php';

class PlantillaController {

    private $model;
    private $vista;
    private $item;
    private $tipo_documento;
    private $permiso;

    public function __CONSTRUCT() {
        $this->model = new Plantilla();
        $this->vista = new PlantillaView();
        $this->item = 'plantilla';
        $permiso = new Permiso();
        $this->permiso = $permiso->Obtener($_SESSION['usuario']->fkcargo);
    }

    public function Index() {
        $coleccion = $this->model->Listar();
        $lista = array();
        foreach ($coleccion as $c){
            $objeto = new stdClass();
            $objeto->pkplantilla = $c['_id'];
            $objeto->sigla = $c['sigla'];
            $objeto->nombre = $c['nombre'];
            $objeto->tipo_documento = 0;    //Tipo de docuemto 0 = plantilla
            $lista[] = $objeto;
        }
        $this->vista->View($lista,$this->permiso);
    }

    public function Nuevo() {
        $this->vista->Nuevo($this->permiso);
    }

    public function Descargar(){
        $this->model->Descargar($_REQUEST['pkplantilla']);
    }

    public function Guardar(){
        $tarea = 'agregar';
        $ext = $this->ObtenerExtencion($_FILES["plantilla"]["name"]);
        $datos = array(
            'plantilla' => $_FILES['plantilla']['tmp_name'],
            'sigla' => $_POST['sigla'],
            'nombre' => $_POST['nombre'].'.'.$ext,
            'fktipo_documento' => 0 //Tipo de docuemto 0 = plantilla
        );
        $exito = $this->model->Guardar($datos);
        header('Location: ?c=plantilla&item='.$this->item.'&tarea='.$tarea.'&exito='.$exito);
    }

    public function Eliminar(){
        $tarea = 'eliminar';
        $exito = $this->model->Eliminar($_REQUEST['pk']);
        header('Location: ?c=plantilla&item='.$this->item.'&tarea='.$tarea.'&exito='.$exito);
    }

    public function ObtenerExtencion($archivo){
        return pathinfo($archivo,PATHINFO_EXTENSION);
    }

}

?>