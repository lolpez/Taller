<?php
//Funcion Post Para verificar duplicados
if(isset($_POST['archivo'])) {
    require_once '../model/documento.php';
    require_once '../model/avance.php';
    require_once '../model/usuario.php';
    require_once '../model/cargo.php';
    require_once '../model/area.php';
    require_once '../model/tipo_documento.php';
    require_once '../model/estado_documento.php';
    $DocumentoModel = new Documento(true);  //True cuando es un metodo post
    $AvanceModel = new Avance(true);  //True cuando es un metodo post
    $UsuarioModel = new Usuario(true);  //True cuando es un metodo post
    $CargoModel = new Cargo(true);  //True cuando es un metodo post
    $AreaModel = new Area(true);  //True cuando es un metodo post
    $TipoDocumentoModel = new Tipo_Documento(true);  //True cuando es un metodo post
    $EstadoDocumentoModel = new Estado_Documento(true);  //True cuando es un metodo post
    $coleccion = $DocumentoModel->Verificar_Duplicados((int)$_POST['archivo']);
    $lista = array();
    foreach ($coleccion as $c){
        $objeto = new stdClass();
        $objeto->codigo = $c['codigo'];
        $usuario = $UsuarioModel->Obtener($AvanceModel->Obtener_Origen_Documento($c['_id'])->fkusuario);
        $objeto->usuario_nombre = $usuario->nombre;
        $objeto->usuario_cargo = $CargoModel->Obtener($usuario->fkcargo)->nombre;
        $objeto->area = $AreaModel->Obtener($c['fkarea'])->nombre;
        $objeto->nombre_archivo = $c['nombre_archivo'];
        $objeto->titulo = $c['titulo'];
        $objeto->version = $c['version'];
        $objeto->fecha = $c['fecha'];
        $objeto->hora = $c['hora'];
        $objeto->tipo_documento =  $TipoDocumentoModel->Obtener($c['fktipo_documento'])->nombre;
        $objeto->estado_documento = $EstadoDocumentoModel->Obtener($AvanceModel->Obtener_Estado_Documento($c['_id'])->fkestado_documento);
        $lista[] = $objeto;
    }
    echo json_encode($lista);
    return;
}

if(isset($_POST['descargar_movil']) && isset($_POST['pkdocumento'])) {
    require_once '../model/documento.php';
    $DocumentoModel = new Documento(true);  //True cuando es un metodo post
    $DocumentoModel->Descargar($_POST['pkdocumento']);
}

require_once 'view/documento/documento.view.php';
require_once 'model/documento.php';
require_once 'model/tipo_documento.php';
require_once 'model/estado_documento.php';
require_once 'model/area_flujo.php';
require_once 'model/usuario.php';
require_once 'model/notificacion.php';
require_once 'model/avance.php';
require_once 'model/archivo_config.php';
require_once 'model/area.php';
require_once 'model/cargo.php';
require_once 'model/emision.php';
require_once 'model/bitacora.php';
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
    private $avance;
    private $archivo_config;
    private $area;
    private $cargo;
    private $emision;
    private $bitacora;
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
        $this->avance = new Avance();
        $this->area_flujo = new Area_Flujo();
        $this->archivo_config = new Archivo_Config();
        $this->area = new Area();
        $this->cargo = new Cargo();
        $this->emision = new Emision();
        $this->bitacora = new Bitacora();
        $this->permiso = $permiso->Obtener($_SESSION['usuario']->fkcargo);
    }

    public function Index() {
        $avances = $this->avance->Listar_Por_Usuario($_SESSION['usuario']->pkusuario);
        $lista = array();
        foreach ($avances as $a){
            $objeto = new stdClass();
            $documento =   $this->model->Obtener($a->fkdocumento,(int)$_SESSION['usuario']->fkarea);
            if (!is_null($documento)) {
                $objeto->pkavance = $a->pkavance;
                $objeto->pkdocumento = $documento['_id'];
                $objeto->codigo = $documento['codigo'];
                $objeto->titulo = $documento['titulo'];
                $objeto->version = $documento['version'];
                $objeto->fecha = $a->fecha;
                $objeto->hora = $a->hora;
                $objeto->tipo_documento = $this->tipo_documento->Obtener($documento['fktipo_documento'])->nombre;
                $objeto->estado_documento = $this->estado_documento->Obtener($this->avance->Obtener_Estado_Documento($documento['_id'])->fkestado_documento);
                $lista[] = $objeto;
            }
        }
        $lista_aprobados = array();
        $aprobados = $this->emision->Listar($_SESSION['usuario']->fkarea);
        foreach ($aprobados as $a){
            $objeto = new stdClass();
            $documento = $this->model->Obtener_Simple($a->fkdocumento);
            if (!is_null($documento)) {
                $objeto->pkdocumento = $documento['_id'];
                $objeto->codigo = $documento['codigo'];
                $objeto->titulo = $documento['titulo'];
                $objeto->version = $documento['version'];
                $objeto->usuario_nombre = $this->usuario->Obtener($a->fkusuario)->nombre;
                $objeto->usuario_cargo = $this->cargo->Obtener($this->usuario->Obtener($a->fkusuario)->fkcargo)->nombre;
                $objeto->tipo_documento = $this->tipo_documento->Obtener($documento['fktipo_documento'])->nombre;
                $lista_aprobados[] = $objeto;
            }
        }
        $this->vista->View($lista,$lista_aprobados,$this->Obtener_Acciones(),$this->permiso);
    }

    public function Nuevo() {
        $tipo_documento = $this->tipo_documento->Listar();
        $archivos_permitidos = $this->archivo_config->Listar();
        $this->vista->Nuevo($tipo_documento,$archivos_permitidos,$this->permiso);
    }

    public function Editar() {
        $pkdocumento = $_POST['pkdocumento'];
        $pkavance = $_POST['pkavance'];
        $pkestadodocumento_nuevo = $_POST['pkestado_documento_nuevo'];
        $documento = $this->model->Obtener_Simple($pkdocumento);
        $tipo_documento = $this->tipo_documento->Listar();
        $archivos_permitidos = $this->archivo_config->Listar();
        $this->vista->Editar($documento,$pkavance,$pkestadodocumento_nuevo,$tipo_documento,$archivos_permitidos,$this->permiso);
    }

    public function Actualizacion() {
        $documento = $this->model->Obtener_Simple($_REQUEST['pkdocumento']);
        $usuarios = $this->usuario->Listar_Por_Area($_SESSION['usuario']->fkarea);
        $this->vista->Actualizacion($documento,$usuarios,$this->permiso);
    }

    public function Detalle() {
        $pkavance = $_REQUEST['pkavance'];
        $documento =  $this->model->Obtener_Simple($_REQUEST['pkdocumento']);
        $avances = $this->avance->Listar_Por_Documento($documento['_id']);
        $historial = array();
        foreach ($avances as $a){
            $objeto = new stdClass();
            $objeto->fecha = $a->fecha;
            $objeto->hora = $a->hora;
            $objeto->estado_documento = $this->estado_documento->Obtener($a->fkestado_documento);
            $usuario = $this->usuario->Obtener($a->fkusuario);
            $objeto->usuario_nombre = $usuario->nombre;
            $objeto->usuario_cargo = $this->cargo->Obtener($usuario->fkcargo)->nombre;
            $objeto->comentario = $a->comentario;
            $historial[] = $objeto;
        }
        $datos = array(
            'fkavance' => $pkavance,
            'fkusuario_destino' => $_SESSION['usuario']->pkusuario
        );
        if (!$this->notificacion->Obtener_Por_Avance($datos)){
            $acciones = array();
        }else{
            if (!$this->notificacion->Obtener_Por_Avance($datos)->terminado){
                $acciones = $this->Obtener_Acciones();
            }else{
                $acciones = array();
            }
        }
        $this->vista->Detalle($documento,$pkavance,$historial,$acciones,$this->permiso);
    }

    public function Descargar(){
        $this->model->Descargar($_POST['pkdocumento']);
    }

    public function Guardar(){
        if ($_POST['comentario'] == ''){
            $comentario = 'sin comentarios';
        }else{
            $comentario = $_POST['comentario'];
        }
        date_default_timezone_set("America/La_Paz");
        $tarea = 'agregar';
        $ext = $this->ObtenerExtencion($_FILES["documento"]["name"]);

        //Obtener el nuevo codigo para el documento siguiente
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
        $llave = array_search($_SESSION['usuario']->fkcargo, $this->array_column($area_flujo['linkDataArray'], 'from'));
        $estado_documento = $area_flujo['linkDataArray'][$llave]['pkestado_documento'];
        $de_cargo = $area_flujo['linkDataArray'][$llave]['from'];
        $para_cargo = $area_flujo['linkDataArray'][$llave]['to'];

        //Preparar datos para guardar el documento en Mongo
        $datos = array(
            'documento' => $_FILES['documento']['tmp_name'],
            'nombre_archivo' => $codigo.'.'.$ext,
            'codigo' => $codigo,
            'titulo' => $_POST['nombre'],
            'fecha' => date("d/m/Y"),
            'hora' => date("h:i:s"),
            'version' => 1, //Al crearse, su version sera 1
            'fktipo_documento' => (int)$_POST['fktipo_documento'],
            'fkarea' => (int)$_SESSION['usuario']->fkarea
        );
        $arrayExito = $this->model->Guardar($datos);

        //Si se tuvo exito al guardar, entonces guardar en la tabla avance y notificar al siguiente usuario
        if ($arrayExito['exito']) {
            $usuario_origen = $this->usuario->Obtener_Por_Cargo_Y_Area($de_cargo, $_SESSION['usuario']->fkarea);
            $usuario_destino = $this->usuario->Obtener_Por_Cargo_Y_Area($para_cargo, $_SESSION['usuario']->fkarea);
            //Insertar tabla avance como Historial de documento
            $datos = array(
                'fecha' => date("d/m/Y"),
                'hora' => date("h:i:s"),
                'fkusuario' => $usuario_origen->pkusuario,
                'fkdocumento' => $arrayExito['pkdocumento'],
                'fkestado_documento' => $estado_documento,
                'comentario' => $comentario
            );
            $pkavance = $this->avance->Guardar($datos);
            //Insertar tabla notificacion
            $datos = array(
                'fkavance' => $pkavance,
                'fkusuario_destino' => $usuario_destino->pkusuario
            );
            $this->notificacion->Guardar($datos);
			
            $tarea = 'se ha creado un nuevo docuemento '.$this->model->Obtener_Simple($arrayExito['pkdocumento'])['codigo'];
            $this->bitacora->GuardarBitacora($tarea);
        }
        header('Location: ?c=documento&item='.$this->item.'&tarea='.$tarea.'&exito='.$arrayExito['exito']);
    }

    public function Actualizar_Documento(){
        date_default_timezone_set("America/La_Paz");
        $documento = $this->model->Obtener_Simple($_POST['pkdocumento']);
        $tarea = 'agregar';
        $ext = $this->ObtenerExtencion($_FILES["documento"]["name"]);
        $this->model->Eliminar($_POST['pkdocumento']);

        //Obtener el estado actual del docuemento al ser creado
        $area_flujo = $this->area_flujo->Obtener_Por_Area($_SESSION['usuario']->fkarea);
        $area_flujo = json_decode($area_flujo->flujo, true);

        //Buscar el nodo en el que se encuentra el usuario (en este caso el nodo cargo Elaborador)
        $llave = array_search($_SESSION['usuario']->fkcargo, $this->array_column($area_flujo['linkDataArray'], 'from'));
        $estado_documento = $_POST['pkestadodocumento_nuevo'];
        $de_cargo = $area_flujo['linkDataArray'][$llave]['from'];
        $para_cargo = $area_flujo['linkDataArray'][$llave]['to'];

        //Preparar datos para actualizar el documento en Mongo
        $datos = array(
            '_id' => $_POST['pkdocumento'],
            'documento' => $_FILES['documento']['tmp_name'],
            'nombre_archivo' => $documento['codigo'].'.'.$ext,
            'codigo' => $documento['codigo'],
            'titulo' => $_POST['nombre'],
            'fecha' => date("d/m/Y"),
            'hora' => date("h:i:s"),
            'version' => (int)($documento['version'])+1, //Aumentar su version
            'fktipo_documento' => (int)$_POST['fktipo_documento'],
            'fkarea' => (int)$documento['fkarea']
        );
        $arrayExito = $this->model->Actualizar($datos);

        //Poner en visto la notificacion
        $datos = array(
            'fkavance' => $_POST['pkavance'],
            'fkusuario_destino' => $_SESSION['usuario']->pkusuario
        );
        $this->notificacion->Visto($this->notificacion->Obtener_Por_Avance($datos)->pknotificacion);

        //Si se tuvo exito al guardar, entonces guardar en la tabla avance y notificar al siguiente usuario
        if ($arrayExito['exito']) {
            $usuario_origen = $this->usuario->Obtener_Por_Cargo_Y_Area($de_cargo, $_SESSION['usuario']->fkarea);
            $usuario_destino = $this->usuario->Obtener_Por_Cargo_Y_Area($para_cargo, $_SESSION['usuario']->fkarea);
            //Insertar tabla avance como Historial de documento
            $datos = array(
                'fecha' => date("d/m/Y"),
                'hora' => date("h:i:s"),
                'fkusuario' => $usuario_origen->pkusuario,
                'fkdocumento' => $arrayExito['pkdocumento'],
                'fkestado_documento' => $estado_documento,
                'comentario' => $_POST['comentario']
            );
            $pkavance = $this->avance->Guardar($datos);
            //Insertar tabla notificacion
            $datos = array(
                'fkavance' => $pkavance,
                'fkusuario_destino' => $usuario_destino->pkusuario
            );
            $this->notificacion->Guardar($datos);
        }
        header('Location: ?c=documento&item='.$this->item.'&tarea='.$tarea.'&exito='.$arrayExito['exito']);
    }

    public function Cambiar_Estado(){
        if ($_POST['comentario'] == ''){
            $comentario = 'sin comentarios';
        }else{
            $comentario = $_POST['comentario'];
        }
        $pkdocumento = $_POST['pkdocumento'];
        $pkavance = $_POST['pkavance'];
        $pkestadodocumento_nuevo = $_POST['pkestado_documento_nuevo'];

        //Buscar el nodo en el que se encuentra el usuario
        $area_flujo = $this->area_flujo->Obtener_Por_Area($_SESSION['usuario']->fkarea);
        $area_flujo = json_decode($area_flujo->flujo, true);
        $llave = array_search($pkestadodocumento_nuevo, $this->array_column($area_flujo['linkDataArray'], 'pkestado_documento'));
        $de_cargo = $area_flujo['linkDataArray'][$llave]['from'];
        $para_cargo = $area_flujo['linkDataArray'][$llave]['to'];
        $usuario_origen = $this->usuario->Obtener_Por_Cargo_Y_Area($de_cargo, $_SESSION['usuario']->fkarea);
        $usuario_destino = $this->usuario->Obtener_Por_Cargo_Y_Area($para_cargo, $_SESSION['usuario']->fkarea);

        //Verificar si el flujo acabo
        if ($usuario_origen == $usuario_destino){
            $areas = $this->area->Listar();
            $documento = $this->model->Obtener_Simple($pkdocumento);
            $this->vista->Emitir($documento,$pkavance,$pkestadodocumento_nuevo,$comentario,$areas,$this->permiso);
        }else{
            //Poner en visto la notificacion
            $datos = array(
                'fkavance' => $pkavance,
                'fkusuario_destino' => $_SESSION['usuario']->pkusuario
            );
            $this->notificacion->Visto($this->notificacion->Obtener_Por_Avance($datos)->pknotificacion);

            //Insertar tabla avance como Historial de documento
            $datos = array(
                'fecha' => date("d/m/Y"),
                'hora' => date("h:i:s"),
                'fkusuario' => $usuario_origen->pkusuario,
                'fkdocumento' => $pkdocumento,
                'fkestado_documento' => $pkestadodocumento_nuevo,
                'comentario' => $comentario
            );
            $pkavance = $this->avance->Guardar($datos);

            //Insertar tabla notificacion
            $datos = array(
                'fkavance' => $pkavance,
                'fkusuario_destino' => $usuario_destino->pkusuario
            );
            $this->notificacion->Guardar($datos);
            $tarea = 'se ha '.$this->estado_documento->Obtener($pkestadodocumento_nuevo)->nombre.' el documento '.$this->model->Obtener_Simple($pkdocumento)['codigo'];
            $exito = true;
            $this->bitacora->GuardarBitacora($tarea);
            header('Location: ?c=documento&item=&tarea='.$tarea.'&exito='.$exito);
        }
    }

    public function Emitir(){
        if ($_POST['comentario'] == ''){
            $comentario = 'sin comentarios';
        }else{
            $comentario = $_POST['comentario'];
        }
        $pkdocumento = $_POST['pkdocumento'];
        $pkavance = $_POST['pkavance'];
        $pkestadodocumento_nuevo =  $_POST['pkestadodocumento_nuevo'];
        $areas = $_POST['multiselectArea'];

        foreach ($areas as $a){
            $datos = array(
                'fkusuario' => $_SESSION['usuario']->pkusuario,
                'fkdocumento' => $pkdocumento,
                'fkarea' => $a
            );
            $this->emision->Guardar($datos);
        }

        //Poner en visto la notificacion
        $datos = array(
            'fkavance' => $pkavance,
            'fkusuario_destino' => $_SESSION['usuario']->pkusuario
        );
        $this->notificacion->Visto($this->notificacion->Obtener_Por_Avance($datos)->pknotificacion);

        //Insertar tabla avance como Historial de documento
        $datos = array(
            'fecha' => date("d/m/Y"),
            'hora' => date("h:i:s"),
            'fkusuario' => $_SESSION['usuario']->pkusuario,
            'fkdocumento' => $pkdocumento,
            'fkestado_documento' => $pkestadodocumento_nuevo,
            'comentario' => $comentario
        );
        $this->avance->Guardar($datos);
        $tarea = 'se ha '.$this->estado_documento->Obtener($pkestadodocumento_nuevo)->nombre.' el documento '.$this->model->Obtener_Simple($pkdocumento)['codigo'];
        $exito = true;
        $this->bitacora->GuardarBitacora($tarea);
        header('Location: ?c=documento&item=&tarea='.$tarea.'&exito='.$exito);
    }

    public function Guardar_Orden_Actualizacion(){
        if ($_POST['comentario'] == ''){
            $comentario = 'sin comentarios';
        }else{
            $comentario = $_POST['comentario'];
        }
        //Insertar tabla avance como Historial de documento

        $datos = array(
            'fecha' => date("d/m/Y"),
            'hora' => date("h:i:s"),
            'fkusuario' => $_SESSION['usuario']->pkusuario,
            'fkdocumento' => $_POST['pkdocumento'],
            'fkestado_documento' => 8,
            'comentario' => $comentario
        );
        $pkavance = $this->avance->Guardar($datos);
        //Insertar tabla notificacion
        $datos = array(
            'fkavance' => $pkavance,
            'fkusuario_destino' => $_POST['usuario']
        );
        $this->notificacion->Guardar($datos);
		//Remover el documento de emisiones
		$datos = array(
			'fkusuario' => $_SESSION['usuario']->pkusuario,
			'fkdocumento' => $_POST['pkdocumento']
		);
		$this->emision->Eliminar($datos);
        
        $tarea = 'se ha ordenado la actualizacion del documento '.$this->model->Obtener_Simple($_POST['pkdocumento'])['codigo'].' al usuario '.$this->usuario->Obtener($_POST['usuario'])->nombre;
        $this->bitacora->GuardarBitacora($tarea);
        header('Location: ?c=documento&item=&tarea='.$tarea.'&exito='.true);
    }

    public function Eliminar(){
        $tarea = 'eliminar';
        $exito = $this->model->Eliminar($_REQUEST['pk']);
        header('Location: ?c=documento&item='.$this->item.'&tarea='.$tarea.'&exito='.$exito);
    }

    public function ObtenerExtencion($archivo){
        return pathinfo($archivo,PATHINFO_EXTENSION);
    }

    public function Obtener_Acciones(){
        //Obtener el estado actual del docuemento al ser creado
        $area_flujo = $this->area_flujo->Obtener_Por_Area($_SESSION['usuario']->fkarea);
        $area_flujo = json_decode($area_flujo->flujo, true);
        $llaves = array_keys($this->array_column($area_flujo['linkDataArray'], 'from'),$_SESSION['usuario']->fkcargo);
        $botones = array();
        foreach ($llaves as $llave) {
            $objeto = new stdClass();
            $objeto->estado_documento_nuevo = $this->estado_documento->Obtener($area_flujo['linkDataArray'][$llave]['pkestado_documento']);
            $botones[] = $objeto;
        }
        return $botones;
    }

    private function array_column(array $input, $columnKey, $indexKey = null) {
        $array = array();
        foreach ($input as $value) {
            if ( ! isset($value[$columnKey])) {
                trigger_error("Key \"$columnKey\" does not exist in array");
                return false;
            }
            if (is_null($indexKey)) {
                $array[] = $value[$columnKey];
            }
            else {
                if ( ! isset($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not exist in array");
                    return false;
                }
                if ( ! is_scalar($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not contain scalar value");
                    return false;
                }
                $array[$value[$indexKey]] = $value[$columnKey];
            }
        }
        return $array;
    }
}
?>