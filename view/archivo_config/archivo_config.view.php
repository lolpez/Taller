<?php

class Archivo_ConfigView{

    public function View($lista,$menu){
        require_once 'view/header.php';
        require_once 'view/archivo_config/archivo_config-admin.php';
        require_once 'view/footer.php';
    }

    public function Nuevo($menu){
        require_once 'view/header.php';
        require_once 'view/archivo_config/archivo_config-new.php';
        require_once 'view/footer.php';
    }

    public function Editar($archivo,$menu){
        require_once 'view/header.php';
        require_once 'view/archivo_config/archivo_config-editar.php';
        require_once 'view/footer.php';
    }


}

?>