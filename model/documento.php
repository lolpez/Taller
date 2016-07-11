<?php

require_once 'singleton/mongo.php';

class Documento {

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
            $consulta = array('fktipo_documento' => array('$ne' => 0));    //Buscar todos los documento con tipo de de documento diferente a 0 (0=tipo plantilla)
            $mongo = $this->mongo->selectCollection($this->mongo_tabla)->find($consulta);
            return $mongo;
        } catch (MongoException $e) {
            die($e->getMessage());
        }
    }

    public function Descargar($pkdocumento){
        try {
            $mongo = $this->mongo->getGridFS();
            $file = $mongo->findOne(array('_id' => new MongoId($pkdocumento)));
            $id = $file->file['_id'];
            if ( ($this->ObtenerExtencion($file->file['nombre_archivo']) == 'zip') || ($this->ObtenerExtencion($file->file['nombre_archivo']) == 'pdf') || ($this->ObtenerExtencion($file->file['nombre_archivo']) == 'docx') ) {
                /* Cualquier tipo de archivo permitido sera descargado*/
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename='.$file->file['nombre_archivo']);
                header('Content-Transfer-Encoding: binary');
                $cursor = $this->mongo->fs->chunks->find(array("files_id" => $id))->sort(array("n" => 1));
                foreach($cursor as $chunk) {
                    echo $chunk['data']->bin;
                }
            } else {
                // header('Content-Type: '.$file["contentType"]);
                // echo $file->getBytes();
                header('Location: 404.php?error=6'); //tipo de archivo no permitido o corrupto
            }
        } catch (MongoException $e) {
            die($e->getMessage());
        }
    }

    public function Guardar($datos){
        try {
            $mongo = $this->mongo->getGridFS();
            $mongo->storeFile(
                $datos['documento'],
                array(
                    'nombre_archivo' => $datos['nombre_archivo'],
                    'codigo' => $datos['codigo'],
                    'titulo' => $datos['titulo'],
                    'fecha' => $datos['fecha'],
                    'hora' => $datos['hora'],
                    'version' => $datos['version'],
                    'fkusuario' => $datos['fkusuario'],
                    'fkarea' => $datos['fkarea'],
                    'fktipo_documento' => $datos['fktipo_documento'],
                    'fkestado_documento' => $datos['fkestado_documento']
                )
            );
            return true;
        } catch (MongoException $e) {
            return false;
        }
    }

    public function Editar(){

    }

    public function Eliminar($pkdocumento){
        try {
            $mongo = $this->mongo->getGridFS();
            $mongo->remove(array("_id" => new MongoId($pkdocumento)));
            return true;
        } catch (MongoException $e) {
            return false;
        }
    }

    public function ObtenerExtencion($archivo){
        return pathinfo($archivo,PATHINFO_EXTENSION);
    }

    public function Obtener_Numero($datos){
        try {
            $consulta = array('fktipo_documento' => $datos['fktipo_documento'], 'fkarea' => $datos['fkarea']);
            $numero = $this->mongo->selectCollection($this->mongo_tabla)->find($consulta)->count();
            return 1000 + $numero + 1;
        } catch (MongoException $e) {
              die($e->getMessage());
        }
    }
}

?>