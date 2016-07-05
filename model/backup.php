<?php

class BackUp {

    private $mysql;
    private $mongo;

    public function __CONSTRUCT() {
        $tipo_conexion = parse_ini_file("appconfig.ini", true)['tipo_conexion'];
        $configArray = parse_ini_file("appconfig.ini", true);
        $mysql = new stdClass();
        //Datos Mysql
        $datosMysql = $configArray['conexion_mysql_'.$tipo_conexion['mysql']];
        $mysql->username = $datosMysql['username'];
        $mysql->password = $datosMysql['password'];
        $mysql->host = $datosMysql['host'];
        $mysql->port = $datosMysql['port'];
        $mysql->database = $datosMysql['database'];
        $this->mysql = $mysql;
        //Datos Mongo
        $datosMongo = $configArray['conexion_mongo_'.$tipo_conexion['mongo']];
        $mongo = new stdClass();
        $mongo->username = $datosMongo['username'];
        $mongo->password = $datosMongo['password'];
        $mongo->host = $datosMongo['host'];
        $mongo->port = $datosMongo['port'];
        $mongo->database = $datosMongo['database'];
        $this->mongo = $mongo;
    }

    public function Listar() {
        $directory = 'resources/backup';
        $archivos = array_diff(scandir($directory), array('..', '.'));
        $array = array();
        foreach ($archivos as $a){
            $token = explode('_',$a);
            $objeto = new stdClass();
            $objeto->pkbackup = $a;
            $objeto->fecha = $token[0];
            $objeto->hora =  DateTime::createFromFormat('H-i-s', substr($token[1],0,-4))->format('H:i:s');
            $array[] = $objeto;
        }
        return $array;
    }

    public function Guardar() {
        try {
            date_default_timezone_set("America/La_Paz");
            $now = new DateTime;
            $archivo = $now->format('d-m-Y_H-i-s');
            if ($this->mongo->host == 'localhost' && $this->mysql->host == 'localhost'){
                //Localhost
                $path = $_SERVER['DOCUMENT_ROOT'] . '/taller/resources/backup/' . $archivo;
                $path_dump = $_SERVER['DOCUMENT_ROOT'] . '/taller/resources/backup/';
            }else{
                //RemoteServer
                $path = $_SERVER['DOCUMENT_ROOT'] . 'resources/backup/' . $archivo;
                $path_dump = $_SERVER['DOCUMENT_ROOT'] . 'resources/backup/';
            }
            $this->BackupMongo($path);
            $this->BackupMysql($path, $archivo);
            $this->Zip($path, $path_dump, $archivo);
            $this->EliminarResiduo($path);
            return true;
        }catch (exception $e){
            return false;
        }
    }

    public function Restarurar($archivo){
        try{
            if ($this->mongo->host == 'localhost' && $this->mysql->host == 'localhost'){
                //Localhost
                $path = $_SERVER['DOCUMENT_ROOT'] . '/taller/resources/backup/' . $archivo;
            }else{
                //RemoteServer
                $path = $_SERVER['DOCUMENT_ROOT'] . 'resources/backup/' . $archivo;
            }
            $path_dump = substr($path,0,-4);
            $this->UnZip($path,$path_dump);
            $this->RestaurarMongo($path_dump.'/'.$this->mongo->database);
            $this->RestaurarMysql($path_dump, substr($archivo,0,-4));
            $this->EliminarResiduo($path_dump);
            return true;
        }catch (exception $e){
            return false;
        }
    }

    public function Subir($archivo){
        try{
            if ($this->mongo->host == 'localhost' && $this->mysql->host == 'localhost'){
                //Localhost
                $path = $_SERVER['DOCUMENT_ROOT'] . '/taller/resources/backup/'.$archivo['name'];
            }else{
                //RemoteServer
                $path = $_SERVER['DOCUMENT_ROOT'] . 'resources/backup/'.$archivo['name'];
            }
            //Verificar que el archivo no existe para subir el archivo en vano
            $ok = false;
            if (file_exists($path)){
                $ok = $this->Restarurar($archivo['name']);
            }else{
                //Tratar de subir archivo, restaurarlo y borrar el temporal
                if (move_uploaded_file($archivo['tmp_name'], $path) && $this->Restarurar($archivo['name']) && $this->Eliminar($archivo['name'])){
                    $ok = true;
                }
            }
            return $ok;
        }catch (exception $e){
            return false;
        }
    }

    public function Eliminar($archivo){
        try{
            if ($this->mongo->host == 'localhost' && $this->mysql->host == 'localhost'){
                //Localhost
                $path = $_SERVER['DOCUMENT_ROOT'] . '/taller/resources/backup/' . $archivo;
            }else{
                //RemoteServer
                $path = $_SERVER['DOCUMENT_ROOT'] . 'resources/backup/' . $archivo;
            }
            unlink($path);
            return true;
        }catch (exception $e){
            return false;
        }
    }

    public function BackupMongo($path){
        if ($this->mongo->host == "localhost") {
            //Localhost
            $command = 'mongodump --db ' . $this->mongo->database . ' --out "' . $path . '"';
        }else{
            //RemoteServer
            $command = 'mongodump -h ' . $this->mongo->host . ' --port ' . $this->mongo->port . ' --username ' . $this->mongo->username . ' --password ' . $this->mongo->password . ' --db ' . $this->mongo->database . ' --out "' . $path . '"';
        }
        shell_exec($command);
    }

    public function BackupMysql($path,$archivo){
        if ($this->mysql->host == "localhost") {
            //Localhost
            $cmd  = 'c: & cd "c:/xampp/mysql/bin/" & mysqldump.exe --user=' . $this->mysql->username . ' --password=' . $this->mysql->password . ' --host=' . $this->mysql->host . ' ' . $this->mysql->database . ' > "' . $path . '/' . $archivo . '.sql"';
        }else{
            //RemoteServer
            $cmd  = 'mysqldump --opt -h '.$this->mysql->host.' -u ' .$this->mysql->username.' --password='.$this->mysql->password.' '.$this->mysql->database.' > "' . $path . '/' . $archivo . '.sql"';
        }
        shell_exec($cmd);
    }

    public function RestaurarMongo($path){
        if ($this->mongo->host == "localhost") {
            //Localhost
            $cmd = 'mongorestore --drop --db ' . $this->mongo->database . ' "' . $path . '"';
        }else{
            //RemoteServer
            $cmd = 'mongorestore --drop --db ' . $this->mongo->database . ' --host ' . $this->mongo->host . ' --port ' . $this->mongo->port . ' --username ' . $this->mongo->username . ' --password ' . $this->mongo->password . ' "' . $path .'"';
        }
        shell_exec($cmd);
    }

    public function RestaurarMysql($path,$archivo){
        if ($this->mysql->host == "localhost") {
            $cmd  = 'c: & cd "c:/xampp/mysql/bin/" & mysql.exe --user=' . $this->mysql->username . ' --password=' . $this->mysql->password . ' --host=' . $this->mysql->host . ' ' . $this->mysql->database . ' < "' . $path . '/' . $archivo . '.sql"';
        }else {
            $cmd  = 'mysql -h '.$this->mysql->host.' -u ' .$this->mysql->username.' --password='.$this->mysql->password.' '.$this->mysql->database.' < "' . $path . '/' . $archivo . '.sql"';
        }
        shell_exec($cmd);
    }

    public function Zip($path,$path_dump,$archivo) {
        $zip = new ZipArchive();
        $zip->open($path_dump.'/'.$archivo.'.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path),
            RecursiveIteratorIterator::LEAVES_ONLY
        );
        foreach ($files as $name => $file)
        {
            if (!$file->isDir())
            {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($path) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();
    }

    public function UnZip($path,$path_dump) {
        $zip = new ZipArchive;
        $zip->open($path);
        $zip->extractTo($path_dump);
        $zip->close();
    }

    //Esta funcion no es necesario, la descarga se hara por JavaScript
    public function Descargar($archivo){
        try{
            $file = 'resources/backup/'.$archivo;
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            return true;
        }catch (exception $e){
            return false;
        }
    }

    public function EliminarResiduo($path) {
        $files = glob($path . '/*');
        foreach ($files as $file) {
            is_dir($file) ? $this->EliminarResiduo($file) : unlink($file);
        }
        rmdir($path);
        return;
    }
}
?>