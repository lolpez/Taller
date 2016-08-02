<?php

require_once 'view/reporte/reporte.view.php';
require_once 'model/documento.php';
require_once 'model/tipo_documento.php';
require_once 'model/estado_documento.php';
require_once 'model/usuario.php';
require_once 'model/avance.php';
require_once 'model/area.php';
require_once 'model/bitacora.php';
require_once 'model/permiso.php';

class ReporteController {

    private $model;
    private $vista;
    private $item;
    private $tipo_documento;
    private $estado_documento;
    private $usuario;
    private $avance;
    private $area;
    private $bitacora;
    private $permiso;

    public function __CONSTRUCT() {
        $this->model = new Documento();
        $this->vista = new ReporteView();
        $this->item = 'reporte';
        $permiso = new Permiso();
        $this->tipo_documento = new Tipo_Documento();
        $this->estado_documento = new Estado_Documento();
        $this->usuario = new Usuario();
        $this->avance = new Avance();
        $this->area = new Area();
        $this->bitacora = new Bitacora();
        $this->permiso = $permiso->Obtener($_SESSION['usuario']->fkcargo);
    }

    public function Index() {
        $areas = $this->area->Listar();
        $this->vista->View($areas,$this->permiso);
    }

    public function Nuevo() {
        date_default_timezone_set("America/La_Paz");
        $fecha =  date("d/m/Y h:i:s");
        $lista = array();
        foreach ($_POST['areas'] as $a){
            $objeto = new stdClass();
            $objeto->area =  $this->area->Obtener($a)->nombre;
            $documentos = $this->model->Obtener_Por_Area((int)$a);
            foreach ($documentos as $d){
                $documento = new stdClass();
                $documento->codigo = $d['codigo'];
                $documento->titulo = $d['titulo'];
                $documento->fecha = $d['fecha'];
                $documento->hora = $d['hora'];
                $documento->version = $d['version'];
                $documento->tipo_documento = $this->tipo_documento->Obtener($d['fktipo_documento']);
                $documento->estado_documento = $this->estado_documento->Obtener($this->avance->Obtener_Estado_Documento($d['_id'])->fkestado_documento);
                $documento->usuario = $this->usuario->Obtener($this->avance->Obtener_Origen_Documento($d['_id'])->fkusuario);
                $objeto->documentos[] = $documento;
            }
            $lista[] = $objeto;
        }
        $tarea = 'se ha generado una nueva lista maestra';
        $this->bitacora->GuardarBitacora($tarea);
        $this->vista->Nuevo($lista,$fecha,$this->permiso);
    }
}
?>