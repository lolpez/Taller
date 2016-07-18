<?php
//Funcion Post Para verificar duplicados
if(isset($_POST['archivo'])) {
    require_once '../model/documento.php';
    require_once '../model/avance.php';
    require_once '../model/usuario.php';
    require_once '../model/cargo.php';
    require_once '../model/tipo_documento.php';
    require_once '../model/estado_documento.php';
    $DocumentoModel = new Documento(true);  //True cuando es un metodo post
    $AvanceModel = new Avance(true);  //True cuando es un metodo post
    $UsuarioModel = new Usuario(true);  //True cuando es un metodo post
    $CargoModel = new Cargo(true);  //True cuando es un metodo post
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
                $objeto->estado_documento = $this->estado_documento->Obtener($a->fkestado_documento);
                $lista[] = $objeto;
            }
        }
        $lista_aprobados = array();
        $aprobados = $this->emision->Listar($_SESSION['usuario']->fkarea);
        foreach ($aprobados as $a){
            $objeto = new stdClass();
            $documento =   $this->model->Obtener($a->fkdocumento,(int)$_SESSION['usuario']->fkarea);
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

    public function Detalle() {
        $pkavance = $_REQUEST['pkavance'];
        $documento =  $this->model->Obtener_Simple($_REQUEST['pkdocumento']);
        $avances = $this->avance->Listar_Por_Documento($documento['_id']);
        $historial = array();
        foreach ($avances as $a){
            $objeto = new stdClass();
            $objeto->fecha = $a->fecha;
            $objeto->hora = $a->hora;
            $objeto->estado_documento = $this->estado_documento->Obtener($a->fkestado_documento)->nombre;
            $usuario = $this->usuario->Obtener($a->fkusuario);
            $objeto->usuario_nombre = $usuario->nombre;
            $objeto->usuario_cargo = $this->cargo->Obtener($usuario->fkcargo)->nombre;
            $historial[] = $objeto;
        }
        $this->vista->Detalle($documento,$pkavance,$historial,$this->Obtener_Acciones(),$this->permiso);
    }

    public function Descargar(){
        $this->model->Descargar($_POST['pkdocumento']);
    }

    public function Guardar(){
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
           // $usuario_origen = $_SESSION['usuario']->pkusuario;
            $usuario_origen = $this->usuario->Obtener_Por_Cargo_Y_Area($de_cargo, $_SESSION['usuario']->fkarea);
            $usuario_destino = $this->usuario->Obtener_Por_Cargo_Y_Area($para_cargo, $_SESSION['usuario']->fkarea);
            //Insertar tabla avance como Historial de documento
            $datos = array(
                'fecha' => date("d/m/Y"),
                'hora' => date("h:i:s"),
                'fkusuario' => $usuario_origen->pkusuario,
                'fkdocumento' => $arrayExito['pkdocumento'],
                'fkestado_documento' => $estado_documento
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
            $this->vista->Emitir($documento,$pkavance,$pkestadodocumento_nuevo,$areas,$this->permiso);
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
                'fkestado_documento' => $pkestadodocumento_nuevo
            );
            $pkavance = $this->avance->Guardar($datos);

            //Insertar tabla notificacion
            $datos = array(
                'fkavance' => $pkavance,
                'fkusuario_destino' => $usuario_destino->pkusuario
            );
            $this->notificacion->Guardar($datos);
            $tarea = 'agregar';
            $exito = true;
            header('Location: ?c=documento&item='.$this->item.'&tarea='.$tarea.'&exito='.$exito);
        }
    }

    public function Emitir(){
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
            'fkestado_documento' => $pkestadodocumento_nuevo
        );
        $x = $this->avance->Guardar($datos);
        $tarea = 'agregar';
        $exito = true;
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

    public function Obtener_Acciones(){
        //Obtener el estado actual del docuemento al ser creado
        $area_flujo = $this->area_flujo->Obtener_Por_Area($_SESSION['usuario']->fkarea);
        $area_flujo = json_decode($area_flujo->flujo, true);
        $llaves = array_keys($this->array_column($area_flujo['linkDataArray'], 'from'),$_SESSION['usuario']->fkcargo);
        $botones = array();
        foreach ($llaves as $llave) {
            $objeto = new stdClass();
            switch ($area_flujo['linkDataArray'][$llave]['pkestado_documento']) {
                case 1:
                    $objeto->id_boton = 1;
                    $objeto->pkestado_documento_nuevo = 1;
                    $objeto->nombre = 'Nuevo documento';
                    $objeto->ayuda = 'crea un nuevo documento para iniciar con el flujo';
                    $objeto->clase = 'primary';
                    $objeto->icono = 'fa fa-plus';
                    break;
                case 2:
                    $objeto->id_boton = 2;
                    $objeto->pkestado_documento_nuevo = 2;
                    $objeto->nombre = 'Revisar documento';
                    $objeto->ayuda = 'el documento cambiara de estado a revisado y estara listo para su aprobacion';
                    $objeto->clase = 'success';
                    $objeto->icono = 'fa fa-check';
                    break;
                case 3:
                    $objeto->id_boton = 3;
                    $objeto->pkestado_documento_nuevo = 3;
                    $objeto->nombre = 'Aprobar documento';
                    $objeto->ayuda = 'el documento cambiara de estado a aprobado y estara listo para su emision.';
                    $objeto->clase = 'success';
                    $objeto->icono = 'fa fa-check';
                    break;
                case 4:
                    $objeto->id_boton = 4;
                    $objeto->pkestado_documento_nuevo = 4;
                    $objeto->nombre = 'Emitir';
                    $objeto->ayuda = 'emita el documento a las diferentes areas';
                    $objeto->clase = 'info';
                    $objeto->icono = 'fa fa-paper-plane';
                    break;
                case 5:
                    $objeto->id_boton = 5;
                    $objeto->pkestado_documento_nuevo = 5;
                    $objeto->nombre = 'Rechazar';
                    $objeto->ayuda = 'rechaze este documento para volver al flujo correspondiente';
                    $objeto->clase = 'danger';
                    $objeto->icono = 'fa fa-times';
                    break;
                case 6:
                    $objeto->id_boton = 6;
                    $objeto->pkestado_documento_nuevo = 6;
                    $objeto->nombre = 'Devolver';
                    $objeto->ayuda = 'rechaze este documento para volver al flujo correspondiente';
                    $objeto->clase = 'danger';
                    $objeto->icono = 'fa fa-times';
                    break;
            }
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