<?php
require_once 'view/notificacion/notificacion.view.php';
require_once 'model/notificacion.php';
require_once 'model/avance.php';
require_once 'model/permiso.php';
require_once 'model/usuario.php';
require_once 'model/cargo.php';
require_once 'model/documento.php';
require_once 'model/estado_documento.php';
require_once 'model/area.php';

class NotificacionController {

    private $vista;
    private $model;
    private $avance;
    private $usuario;
    private $cargo;
    private $area;
    private $documento;
    private $estado_documento;
    private $permiso;

    public function __CONSTRUCT() {
        $this->vista = new NotificacionView();
        $permiso = new Permiso();
        $this->permiso = $permiso->Obtener($_SESSION['usuario']->fkcargo);
        $this->model = new Notificacion();
        $this->avance = new Avance();
        $this->usuario = new Usuario();
        $this->cargo = new Cargo();
        $this->area = new Area();
        $this->documento = new Documento();
        $this->estado_documento = new Estado_Documento();
    }

    public function Index() {
        $usuario = $this->usuario->Obtener($_SESSION['usuario']->pkusuario);
        $lista = array();
        $notif = $this->model->Obtener_NoVisto($usuario->pkusuario);
        foreach ($notif as $n):
            $avance = $this->avance->Obtener($n->fkavance);
            $usuario_creador = $this->usuario->Obtener($avance->fkusuario);
            $objeto = new stdClass();
            $objeto->pkavance = $avance->pkavance;
            $objeto->fecha = $avance->fecha;
            $objeto->hora = $avance->hora;
            $objeto->usuario_creador = $this->usuario->Obtener($avance->fkusuario)->nombre;
            $objeto->usuario_creador_cargo = $this->cargo->Obtener($usuario_creador->fkcargo)->nombre;
            $objeto->documento = $this->documento->Obtener($avance->fkdocumento,(int)$usuario->fkarea);
            $objeto->estado_documento = $this->estado_documento->Obtener($avance->fkestado_documento);
            $objeto->mensaje = 'El usuario ' . $objeto->usuario_creador. ' (' . $objeto->usuario_creador_cargo . ') ha '.$objeto->estado_documento->nombre.' el documento '.$objeto->documento['codigo'].' ('.$objeto->documento['titulo'].' v.'.$objeto->documento['version'].')';
            $objeto->url = '?c=documento&a=detalle&pkdocumento='.$objeto->documento['_id'].'&pkavance='.$objeto->pkavance;
            $lista[] = $objeto;
        endforeach;
        $this->vista->View($lista,$this->permiso);
    }

    public function Notificaciones() {
        $usuario = $this->usuario->Obtener($_SESSION['usuario']->pkusuario);
        $listaV = array();
        $notifV = $this->model->Obtener_Visto($_SESSION['usuario']->pkusuario);
        foreach ($notifV as $n):
            $avance = $this->avance->Obtener($n->fkavance);
            $usuario_creador = $this->usuario->Obtener($avance->fkusuario);
            $objeto = new stdClass();
            $objeto->pkavance = $avance->pkavance;
            $objeto->fecha = $avance->fecha;
            $objeto->hora = $avance->hora;
            $objeto->usuario_creador = $this->usuario->Obtener($avance->fkusuario)->nombre;
            $objeto->usuario_creador_cargo = $this->cargo->Obtener($usuario_creador->fkcargo)->nombre;
            $objeto->documento = $this->documento->Obtener($avance->fkdocumento,(int)$usuario->fkarea);
            $objeto->estado_documento = $this->estado_documento->Obtener($avance->fkestado_documento);
            $objeto->mensaje = 'El usuario ' . $objeto->usuario_creador. ' (' . $objeto->usuario_creador_cargo . ') ha '.$objeto->estado_documento->nombre.' el documento '.$objeto->documento['codigo'].' ('.$objeto->documento['titulo'].' v'.$objeto->documento['version'].'.)';
            $objeto->url = '?c=documento&a=detalle&pkdocumento='.$objeto->documento['_id'].'&pkavance='.$objeto->pkavance;
            $listaV[] = $objeto;
        endforeach;
        $listaNV = array();
        $notifNV = $this->model->Obtener_NoVisto($_SESSION['usuario']->pkusuario);
        foreach ($notifNV as $n):
            $avance = $this->avance->Obtener($n->fkavance);
            $usuario_creador = $this->usuario->Obtener($avance->fkusuario);
            $objeto = new stdClass();
            $objeto->pkavance = $avance->pkavance;
            $objeto->fecha = $avance->fecha;
            $objeto->hora = $avance->hora;
            $objeto->usuario_creador = $this->usuario->Obtener($avance->fkusuario)->nombre;
            $objeto->usuario_creador_cargo = $this->cargo->Obtener($usuario_creador->fkcargo)->nombre;
            $objeto->documento = $this->documento->Obtener($avance->fkdocumento,(int)$usuario->fkarea);
            $objeto->estado_documento = $this->estado_documento->Obtener($avance->fkestado_documento);
            $objeto->mensaje = 'El usuario ' . $objeto->usuario_creador. ' (' . $objeto->usuario_creador_cargo . ') ha '.$objeto->estado_documento->nombre.' el documento '.$objeto->documento['codigo'].' ('.$objeto->documento['titulo'].' v'.$objeto->documento['version'].'.)';
            $objeto->url = '?c=documento&a=detalle&pkdocumento='.$objeto->documento['_id'].'&pkavance='.$objeto->pkavance;
            $listaNV[] = $objeto;
        endforeach;
        $this->vista->Notificaciones($listaV,$listaNV,$this->permiso);
    }
}
?>