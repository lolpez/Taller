<?php
require_once 'view/area/area.view.php';
require_once 'model/area.php';
require_once 'model/area_flujo.php';
require_once 'model/bitacora.php';
require_once 'model/permiso.php';

class AreaController {

    private $model;
    private $vista;
    private $item;
    private $area_flujo;
    private $bitacora;
    private $permiso;

    public function __CONSTRUCT() {
        $this->model = new Area();
        $this->vista = new AreaView();
        $this->bitacora = new Bitacora();
        $this->item = 'area';
        $this->area_flujo = new Area_Flujo();
        $permiso = new Permiso();
        $this->permiso = $permiso->Obtener($_SESSION['usuario']->fkcargo);
    }

    public function Index() {
        $lista = $this->model->Listar();
        $this->vista->View($lista,$this->permiso);
    }

    public function Nuevo() {
        $listaA = $this->model->Listar();
        $this->vista->Nuevo($listaA,$this->permiso);
    }

    public function Editar() {
        $listaA = $this->model->Listar();
        $area = $this->model->Obtener($_REQUEST['pkarea']);
        $this->vista->Editar($listaA,$area,$this->permiso);
    }

    public function Flujo() {
        $area = $this->model->Obtener($_REQUEST['pkarea']);
        $area_flujo = $this->area_flujo->Obtener($_REQUEST['pkarea']);
        $this->vista->Flujo($area,$area_flujo,$this->permiso);
    }

    public function Guardar() {
        if (isset($_POST['pk'])){   //si es editar
            $datos = array(
                'pk' => $_POST['pk'],
                'nombre' => $_POST['nombre'],
                'sigla' => $_POST['sigla'],
                'fkarea_padre' => $_POST['fkarea_padre']
            );
            $exito = $this->model->Editar($datos);
            $DescripcionBitacora = 'se modifico el '.$this->item.' '.$_POST['nombre'];
            $tarea='modificar';
        }else{
            $datos = array(
                'nombre' => $_POST['nombre'],
                'sigla' => $_POST['sigla'],
                'fkarea_padre' => $_POST['fkarea_padre']
            );
            $exito = $this->model->Guardar($datos);
            //Al crearse una nueva area, su flujo de documentos se creara por defecto
            if ($exito){
                $datos = array(
                    'flujo' => $this->Obtener_Flujo_JSON(),
                    'fkarea' => $this->model->Obtener_Ultimo_ID()->pkarea
                );
                $this->area_flujo->Guardar($datos);
            }
            $DescripcionBitacora = 'se agrego una nueva '.$this->item.' ' . $_POST['nombre'];
            $tarea='agregar';
        }
        $this->bitacora->GuardarBitacora($DescripcionBitacora);
        header('Location: ?c=area&item='.$this->item.' '.$_POST['nombre'].'&tarea='.$tarea.'&exito='.$exito);
    }

    public function Eliminar() {
        $tarea = 'eliminar';
        $area = $this->model->Obtener($_REQUEST['pk']);
        $exito = $this->model->Eliminar($_REQUEST['pk']);
        $this->bitacora->GuardarBitacora('se dio de baja el '.$this->item.' '.$area->nombre);
        header('Location: ?c=area&item='.$this->item.' '.$area->nombre.'&tarea='.$tarea.'&exito='.$exito);
    }

    public function Obtener_Flujo_JSON(){
        return '{
                    "class": "go.GraphLinksModel",
                    "nodeKeyProperty": "id",
                    "linkKeyProperty": "id",
                    "nodeDataArray": [
                        {"id":1, "loc":"-647.204174859376 205.3818282812499", "text":"Responsable de area"},
                        {"id":2, "loc":"-418.21268702262677 329.79056922703256", "text":"Supervisor de area"},
                        {"id":3, "loc":"-256.7424588096812 186.78730085621473", "text":"Director de area"},
                        {"id":4, "loc":"-64.51079628125011 331.8114768750002", "text":"Emisor"}
                    ],
                    "linkDataArray": [
                        {"from":1, "to":2, "id":-1, "points":[-510.595074496538,243.74476761327517,-472.9807123096858,257.6992671524351,-421.0781764544813,286.58879993048686,-365.16094065241816,329.9825695190597], "text":"elaborado"},
                        {"from":2, "to":3, "id":-2, "points":[-328.3174298858477,329.8696212197939,-299.9494522192109,284.9416164153528,-263.9692658297334,250.17809245385814,-221.3185911588322,225.23424619363476], "text":"revisado"},
                        {"from":3, "to":4, "id":-3, "points":[-157.4985853559002,225.2367813921834,-118.15886045644787,248.76918771694824,-78.18385910768801,284.63340244707365,-42.64701145567301,331.91396443844326], "text":"aprobado"}
                    ]
                }';
    }
}
?>