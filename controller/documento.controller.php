<?php
require_once 'view/documento/documento.view.php';
require_once 'model/documento.php';
require_once 'model/tipo_documento.php';
require_once 'model/estado_documento.php';
require_once 'model/area_flujo.php';
require_once 'model/usuario.php';
require_once 'model/notificacion.php';
require_once 'model/archivo_config.php';
require_once 'model/area.php';
require_once 'model/permiso.php';

class DocumentoController {

    private $model;
    private $vista;
    private $item;
    private $tipo_documento;
    private $estado_documento;
    private $area_flujo;
    private $usuario;
    private $notificacion;
    private $archivo_config;
    private $area;
    private $permiso;

    public function __CONSTRUCT() {
        $this->model = new Documento();
        $this->vista = new DocumentoView();
        $this->item = 'documento';
        $permiso = new Permiso();
        $this->tipo_documento = new Tipo_Documento();
        $this->estado_documento = new Estado_Documento();
        $this->usuario = new Usuario();
        $this->notificacion = new Notificacion();
        $this->area_flujo = new Area_Flujo();
        $this->archivo_config = new Archivo_Config();
        $this->area = new Area();
        $this->permiso = $permiso->Obtener($_SESSION['usuario']->fkcargo);
    }

    public function Index() {
        $coleccion = $this->model->Listar();
        $lista = array();
        foreach ($coleccion as $c){
            $objeto = new stdClass();
            $objeto->pkdocumento = $c['_id'];
            $objeto->codigo = $c['codigo'];
            $objeto->titulo = $c['titulo'];
            $objeto->version = $c['version'];
            $objeto->fecha = $c['fecha'];
            $objeto->hora = $c['hora'];
            $objeto->tipo_documento = $this->tipo_documento->Obtener($c['fktipo_documento'])->nombre;
            $objeto->estado_documento = $this->estado_documento->Obtener($c['fkestado_documento']);
            $lista[] = $objeto;
        }
        $this->vista->View($lista,$this->permiso);
    }

    public function Nuevo() {
        $tipo_documento = $this->tipo_documento->Listar();
        $archivos_permitidos = $this->archivo_config->Listar();
        $this->vista->Nuevo($tipo_documento,$archivos_permitidos,$this->permiso);
    }

    public function Descargar(){
        $this->model->Descargar($_REQUEST['pkdocumento']);
    }

    public function Guardar(){
        date_default_timezone_set("America/La_Paz");
        $tarea = 'agregar';
        $ext = $this->ObtenerExtencion($_FILES["documento"]["name"]);
        $area_sigla = $this->area->Obtener($_SESSION['usuario']->fkarea)->sigla;
        $tipo_documento_sigla = $this->tipo_documento->Obtener($_POST['fktipo_documento'])->sigla;
        $datos = array(
            'fktipo_documento' => (int)$_POST['fktipo_documento'],
            'fkarea' => (int)$_SESSION['usuario']->fkarea
        );
        $numero = $this->model->Obtener_Numero($datos);
        $codigo = $area_sigla.'-'.$tipo_documento_sigla.'-'.$numero;

        //Obtener el estado actual del docuemento al ser creado
        $area_flujo = $this->area_flujo->Obtener_Por_Area($_SESSION['usuario']->fkarea);
        $area_flujo = json_decode($area_flujo->flujo, true);
        //Buscar el nodo en el que se encuentra el usuario (en este caso el nodo cargo Elaborador)
        $llave = array_search($_SESSION['usuario']->fkcargo, array_column($area_flujo['linkDataArray'], 'from'));
        $estado_documento = $area_flujo['linkDataArray'][$llave]['pkestado_documento'];
        $de_cargo = $area_flujo['linkDataArray'][$llave]['from'];
        $para_cargo = $area_flujo['linkDataArray'][$llave]['to'];


        $datos = array(
            'documento' => $_FILES['documento']['tmp_name'],
            'nombre_archivo' => $codigo.'.'.$ext,
            'codigo' => $codigo,
            'titulo' => $_POST['nombre'],
            'fecha' => date("d/m/Y"),
            'hora' => date("h:i:s"),
            'version' => 1, //Al crearse, su version sera 1
            'fktipo_documento' => (int)$_POST['fktipo_documento'],
            'fkarea' => (int)$_SESSION['usuario']->fkarea,
            'fkusuario' => (int)$_SESSION['usuario']->pkusuario,
            'fkestado_documento' => $estado_documento //Estado 1 = Elaboracion (cuando el documento fue creado)
        );
        $exito = $this->model->Guardar($datos);

        /*$area_flujo = $this->area_flujo->Obtener_Por_Area($_SESSION['usuario']->fkarea);
        $area_flujo = json_decode($area_flujo->flujo, true);
        //Buscar el nodo en el que se encuentra el usuario (en este caso el nodo cargo Elaborador)
        $llave = array_search($_SESSION['usuario']->fkcargo, array_column($area_flujo['linkDataArray'], 'from'));
        $de_cargo = $area_flujo['linkDataArray'][$llave]['from'];
        $para_cargo = $area_flujo['linkDataArray'][$llave]['to'];
        $usuario_destino = $this->usuario->Obtener_Por_Cargo_Y_Area($para_cargo,$_SESSION['usuario']->fkarea);
        //Notificar al usuario destino que tiene un documento pendiente para su revision*/

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