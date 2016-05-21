<?php

require_once 'model/documento.php';
require_once 'view/documento/documento.view.php';

class DocumentoController {

    private $model;
    private $vista;
    private $item;

    public function __CONSTRUCT() {
        $this->model = new Documento();
        $this->vista = new DocumentoView();
        $this->item = 'documento';
    }

    public function Index() {
        $colleccion = $this->model->Listar();
        $lista = array();
        foreach ($colleccion as $c){
            $objeto = new stdClass();
            $objeto->pkdocumento = $c['_id'];
            $objeto->nombre = $c['nombre'];
            $lista[] = $objeto;
        }
        $this->vista->View($lista);
    }

    public function Nuevo() {
        $this->vista->Nuevo();
    }

    public function Descargar(){
        $this->model->Descargar($_REQUEST['pkdocumento']);
    }

    public function Guardar(){
        $tarea = 'agregar';
        $ext = $this->ObtenerExtencion($_FILES["documento"]["name"]);
        $datos = array(
            'documento' => $_FILES['documento']['tmp_name'],
            'nombre' => $_POST['nombre'].'.'.$ext
        );
        $exito = $this->model->Guardar($datos);
        header('Location: ?c=documento&item='.$this->item.'&tarea='.$tarea.'&exito='.$exito);
    }

    public function Eliminar(){
        $tarea = 'eliminar';
        $exito = $this->model->Eliminar($_REQUEST['pk']);
        header('Location: ?c=documento&item='.$this->item.'&tarea='.$tarea.'&exito='.$exito);
    }

    public function ObtenerExtencion($archivo){
        return pathinfo($archivo,PATHINFO_EXTENSION);
    }

}

?>