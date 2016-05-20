<?php
$url = "mongodb://admin:U4f9rDwdDsMd@127.12.74.132:27017/";
$database = 'taller';
$m = new MongoClient($url);
$db = $m->selectDB($database);
$grid = $db->getGridFS();
$ask = $_REQUEST['nombre'];
$file = $grid->findOne(array('nombre' => $ask));
$files = $db->fs->files;
$file1 = $files->findOne(array('nombre' => $ask));
$id = $file->file['_id'];
if ( (substr($ask,-3) == 'zip') || (substr($ask,-3) == 'pdf') ) {
    /* Cualquier tipo de archivo que se desee descargar puede ser listado aqui */
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.$ask);
    header('Content-Transfer-Encoding: binary');
    $cursor = $db->fs->chunks->find(array("files_id" => $id))->sort(array("n" => 1));
    foreach($cursor as $chunk) {
        echo $chunk['data']->bin;
    }
} else {
    header('Content-Type: '.$file1["contentType"]);
    echo $file->getBytes();
}

?>