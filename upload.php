<?php
$url = "mongodb://admin:U4f9rDwdDsMd@127.12.74.132:27017/";
$database = 'taller';
$m = new MongoClient($url);
$tabla = 'documentos';
$grid = $m->selectDB($database)->getGridFS();
$grid->storeUpload('archivo', array('nombre' => $_POST['nombre']));
echo 'su archivo se subio con exito';
?>