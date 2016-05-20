<form method="POST" enctype="multipart/form-data" action="upload.php">
    <h1>Agregar Nuevo Archivo</h1>
    <label for="username">Nombre archivo:</label>
    <input type="text" name="nombre"/>
    <label for="pic">Archivo: </label>
    <input type="file" name="archivo"/>
    <input type="submit"/>
</form>

<?php
$url = "mongodb://admin:U4f9rDwdDsMd@127.12.74.132:27017/";
$database = 'taller';
$m = new MongoClient($url);
$db = $m->selectDB($database);
$lista = $db->selectCollection('fs.files')->find();
foreach ($lista as $r) {
    echo "<a href='download.php?nombre=".$r["nombre"]."'>".$r["nombre"]."</a><br>";
}
?>