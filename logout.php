<?php
//require_once 'model/bitacora.php';
require_once 'model/usuario.php';
//$bitacora=new Bitacora();
$usuario = new Usuario();
session_start();
$DescripcionBitacora = 'Cierre de sesion';
//$bitacora->GuardarBitacora($DescripcionBitacora);
session_destroy();
header('Location: index.php');
?>