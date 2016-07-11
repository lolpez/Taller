<?php

require_once 'singleton/mongo.php';

class Plantilla {

    private $mongo;
    private $mongo_tabla = 'fs.files';

    public function __CONSTRUCT() {
        try {
            $this->mongo = ConexionMongo::getInstance()->obtenerConexion();
        } catch (MongoException $e) {
            die($e->getMessage());
        }
    }

    public function Listar() {
        try {
            $mongo = $this->mongo->selectCollection($this->mongo_tabla)->find(array("fktipo_documento" => 0));
            return $mongo;
        } catch (MongoException $e) {
            die($e->getMessage());
        }
    }

    public function Descargar($pkplantilla){
        try {
            $mongo = $this->mongo->getGridFS();
            $file = $mongo->findOne(array('_id' => new MongoId($pkplantilla)));
            $id = $file->file['_id'];
            if ( ($this->ObtenerExtencion($file->file['nombre']) == 'zip') || ($this->ObtenerExtencion($file->file['nombre']) == 'pdf') || ($this->ObtenerExtencion($file->file['nombre']) == 'docx') ) {
                /* Cualquier tipo de archivo permitido sera descargado*/
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename='.$file->file['nombre']);
                header('Content-Transfer-Encoding: binary');
                $cursor = $this->mongo->fs->chunks->find(array("files_id" => $id))->sort(array("n" => 1));
                foreach($cursor as $chunk) {
                    echo $chunk['data']->bin;
                }
            } else {
                // header('Content-Type: '.$file["contentType"]);
                // echo $file->getBytes();
                echo 'el tipo de archivo no esta permitido por el administrador';
            }
        } catch (MongoException $e) {
            die($e->getMessage());
        }
    }

    public function Guardar($datos){
        try {
            $mongo = $this->mongo->getGridFS();
            $mongo->storeFile($datos['plantilla'], array('sigla' => $datos['sigla'], 'nombre' => $datos['nombre'], 'fktipo_documento' => $datos['fktipo_documento']));
            return true;
        } catch (MongoException $e) {
            return false;
        }
    }

    public function Editar(){

    }

    public function Eliminar($pkplantilla){
        try {
            $mongo = $this->mongo->getGridFS();
            $mongo->remove(array("_id" => new MongoId($pkplantilla)));
            return true;
        } catch (MongoException $e) {
            return false;
        }
    }

    public function ObtenerExtencion($archivo){
        return pathinfo($archivo,PATHINFO_EXTENSION);
    }
}

?>