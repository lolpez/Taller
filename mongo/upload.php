<?php
$username = 'lulax666';
$password = 'luis666666';
$server = 'ds045465.mlab.com';
$port = '45465';
$database = 'taller';
$url = "mongodb://${username}:${password}@${server}:${port}/${database}";
//$url = "localhost";
$m = new MongoClient($url);

$tabla = 'documentos';
$grid = $m->selectDB($database)->getGridFS();
$grid->storeUpload('archivo', array('nombre' => $_POST['nombre']));

echo 'su archivo se subio con exito';
?>