<?php
session_start();
$validador = new Validador();
$validador->Validar();

class Validador {

    private $controladores_permitidos;

    public function __CONSTRUCT() {
        $this->controladores_permitidos = array("documento","notificacion","usuario","bitacora","usuario","cargo","privilegio","calendario","archivo_config");
    }

    public function Validar() {
        if (!isset($_REQUEST['c'])) {
            if (!isset($_SESSION['usuario'])) {
                header('Location: login.php');
            }
            else
            {
                header('Location: ?c=notificacion');
            }
        } else {
            if (!isset($_SESSION['usuario'])){
                header('Location: login.php');
            }
            $controller = strtolower($_REQUEST['c']);
            $controlador = $controller;
            $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
            if (file_exists("controller/$controller.controller.php") && is_readable("controller/$controller.controller.php")) {
                if (!in_array($controller,$this->controladores_permitidos)) {
                    header('Location: 404.php?error=0');//cuando el controlador no esta en el array
                    exit;
                }
                require_once ("controller/".$controller.".controller.php");
                $controller = ucwords($controller) . 'Controller';
                $controller = new $controller;

                if (isset($_REQUEST['a']) && isset($_REQUEST['c']) && $_REQUEST['c']=='usuario' && $_REQUEST['a']=='perfil'){ //permitir el acceso a perfil de usuario
                    call_user_func(array($controller, $accion));
                }

                if ($_REQUEST['c'] != 'notificacion'){
                    $fachada = new Permiso();
                    $usuario = $fachada->Obtener_Permiso($_SESSION['usuario']->fkcargo);
                    foreach ($usuario->listaMenuDetalle as $c){
                        if ($c->controlador == $controlador){
                            if (method_exists($controller, $accion)) {
                                call_user_func(array($controller, $accion));
                            } else {
                                header('Location: 404.php?error=2');//cuando la accion no se encuentra
                                exit;
                            }
                        }
                    }
                    header('Location: 404.php?error=3');//cuando el controlador no esta permitido para el usuario
                }

                if (method_exists($controller, $accion)) {
                    call_user_func(array($controller, $accion));
                } else {
                    header('Location: 404.php?error=2');//cuando la accion no se encuentra
                    exit;
                }
            } else {
                header('Location: 404.php?error=1'); //cuando el controlador no se encuentra
                exit;
            }
        }
    }
}
?>