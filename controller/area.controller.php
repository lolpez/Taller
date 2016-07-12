<?php
require_once 'view/area/area.view.php';
require_once 'model/area.php';
require_once 'model/cargo.php';
require_once 'model/estado_documento.php';
require_once 'model/area_flujo.php';
require_once 'model/bitacora.php';
require_once 'model/permiso.php';

class AreaController {

    private $model;
    private $vista;
    private $item;
    private $area_flujo;
    private $estado_documento;
    private $cargo;
    private $bitacora;
    private $permiso;

    public function __CONSTRUCT() {
        $this->model = new Area();
        $this->vista = new AreaView();
        $this->bitacora = new Bitacora();
        $this->item = 'area';
        $this->estado_documento = new Estado_Documento();
        $this->area_flujo = new Area_Flujo();
        $this->cargo = new Cargo();
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
        $area_flujo = $this->area_flujo->Obtener_Por_Area($_REQUEST['pkarea']);
        $estado_documentos = $this->estado_documento->Listar();
        $flujo_default = $this->Obtener_Flujo_JSON();
        $this->vista->Flujo($area,$area_flujo,$estado_documentos,$flujo_default,$this->permiso);
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

    public function Guardar_Flujo() {
        $flujo = json_decode($_POST['flujo'],true);
        for ($i=0; $i<count($flujo['linkDataArray']);$i++){
            $estado_documento = $this->estado_documento->Obtener_Por_Nomenglatura($flujo['linkDataArray'][$i]['text']);
            $flujo['linkDataArray'][$i]['pkestado_documento'] = $estado_documento->pkestado_documento;
            $flujo['linkDataArray'][$i]['nombre_estado_documento'] = $estado_documento->nombre;
        }
        $datos = array(
            'pk' => $_POST['pk'],
            'flujo' => json_encode($flujo)
        );
        $exito = $this->area_flujo->Editar($datos);
        $DescripcionBitacora = 'se modifico el flujo de documentos del area '.$_POST['area_nombre'];
        $tarea='modificar';
        $this->bitacora->GuardarBitacora($DescripcionBitacora);
        header('Location: ?c=area&item=flujo&tarea='.$tarea.'&exito='.$exito);
    }

    public function Eliminar() {
        $tarea = 'eliminar';
        $area = $this->model->Obtener($_REQUEST['pk']);
        $exito = $this->model->Eliminar($_REQUEST['pk']);
        $this->bitacora->GuardarBitacora('se dio de baja el '.$this->item.' '.$area->nombre);
        header('Location: ?c=area&item='.$this->item.' '.$area->nombre.'&tarea='.$tarea.'&exito='.$exito);
    }

    public function Obtener_Flujo_JSON(){
        //Cargar los datos para el grafo por defecto
        $arrayCargos = '{';
        $arrayCargos .= '"class": "go.GraphLinksModel","nodeKeyProperty": "id","linkKeyProperty": "id",';
        $arrayCargos .= '"nodeDataArray": [';
        $x = 0;
        $y = 100;
        foreach ($this->cargo->Listar() as $c){
            $arrayCargos .= '{"id":'.$c->pkcargo.', "loc":"'.$x.' '.$y.'", "text":"'.$c->nombre.'"},';
            $x = $x + 200;
        }
        $arrayCargos = substr($arrayCargos,0,-1); //Eliminar la ultima coma
        $arrayCargos .= ']}';
        return $arrayCargos;
    }
}
?>