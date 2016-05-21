<?php
session_start();
$_controllers_permitidos = array("documento","notificacion","usuario");
$_acciones_permitidos = array("enviar");
if (!isset($_REQUEST['c'])) {
    if (!isset($_SESSION['usuario'])) {
        header('Location: login.php');
    }
    else
    {
        header('Location: ?c=documento');
    }
} else {
    if (!isset($_SESSION['usuario'])) {
        header('Location: login.php');
    }
    $controller = strtolower($_REQUEST['c']);
    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
    // Instanciamos el controlador
    if (file_exists("controller/$controller.controller.php") && is_readable("controller/$controller.controller.php")) {
        //Validacion de privilegios del usuario que se encuentra en esta session
        if (!in_array($controller,$_controllers_permitidos) ) {
            echo 'controlador no permitido';
            exit;
        }
        require_once ("controller/".$controller.".controller.php");
        $controller = ucwords($controller) . 'Controller';
        $controller = new $controller;
        if (method_exists($controller, $accion)) {
            call_user_func(array($controller, $accion));
        } else {
            echo 'accion no encontrada 404';    //cuando la accion no se encuentra
            exit;
        }
    } else {
        echo 'controlador no encontrado o no se puede leerlo 404';  //cuando el controlador no se encuentra
        exit;
    }
}
?>