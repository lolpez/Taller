<?php
$username = 'lulax666';
$password = 'luis666666';
$server = 'ds045465.mlab.com';
$port = '45465';
$database = 'taller';
$url = "mongodb://${username}:${password}@${server}:${port}/${database}";
//$url = "localhost";
$m = new MongoClient($url);
$db = $m->selectDB($database);

$lista = $db->selectCollection('fs.files')->find();
foreach ($lista as $r) {
    echo "<a href='download.php?nombre=".$r["nombre"]."'>".$r["nombre"]."</a><br>";
}


?>
