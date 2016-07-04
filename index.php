<?php
session_name("taller");
session_start();
$_controllers_permitidos = array("documento","notificacion","usuario","bitacora","usuario","cargo","privilegio","calendario","archivo_config","area","tipo_documento","backup");
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
    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
    if (file_exists("controller/$controller.controller.php") && is_readable("controller/$controller.controller.php")) {
        if (!in_array($controller,$_controllers_permitidos) ) {
            header('Location: 404.php?error=0');//cuando el controlador no esta permitido
        }
        require_once ("controller/".$controller.".controller.php");
        $controller = ucwords($controller) . 'Controller';
        $controller = new $controller;
        if (method_exists($controller, $accion)) {
            call_user_func(array($controller, $accion));
        } else {
            header('Location: 404.php?error=2');//cuando la accion no se encuentra
        }
    } else {
        header('Location: 404.php?error=1'); //cuando el controlador no se encuentra
    }
}
?>