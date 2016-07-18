<?php
//Funcion Post Para verificar duplicados
if(isset($_POST['archivo'])) {
    require_once '../model/plantilla.php';
    $PlantillaModel = new Plantilla(true);
    $datos = $PlantillaModel->Verificar_Duplicados((int)$_POST['archivo']);
    echo json_encode(iterator_to_array($datos));
    return;
}
require_once 'view/plantilla/plantilla.view.php';
require_once 'model/plantilla.php';
require_once 'model/archivo_config.php';
require_once 'model/permiso.php';

class PlantillaController {

    private $model;
    private $vista;
    private $item;
    private $archivo_config;
    private $permiso;

    public function __CONSTRUCT() {
        $this->model = new Plantilla();
        $this->vista = new PlantillaView();
        $this->item = 'plantilla';
        $permiso = new Permiso();
        $this->archivo_config = new Archivo_Config();
        $this->permiso = $permiso->Obtener($_SESSION['usuario']->fkcargo);
    }

    public function Index() {
        $coleccion = $this->model->Listar();
        $lista = array();
        foreach ($coleccion as $c){
            $objeto = new stdClass();
            $objeto->pkplantilla = $c['_id'];
            $objeto->codigo = $c['codigo'];
            $objeto->titulo = $c['titulo'];
            $objeto->version = $c['version'];
            $objeto->fecha = $c['fecha'];
            $objeto->hora = $c['hora'];
            $lista[] = $objeto;
        }
        $this->vista->View($lista,$this->permiso);
    }

    public function Nuevo() {
        $archivo_config = $this->archivo_config->Listar();
        $this->vista->Nuevo($archivo_config,$this->permiso);
    }

    public function Descargar(){
        $this->model->Descargar($_REQUEST['pkplantilla']);
    }

    public function Guardar(){
        date_default_timezone_set("America/La_Paz");
        $tarea = 'agregar';
        $datos = array(
            'plantilla' => $_FILES['plantilla']['tmp_name'],
            'nombre_archivo' => $_FILES["plantilla"]["name"],
            'codigo' => $_POST['codigo'],
            'titulo' => $_POST['titulo'],
            'fecha' => date("d/m/Y"),
            'hora' => date("h:i:s"),
            'version' => 1, //Al crearse, su version sera 1
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