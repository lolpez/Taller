<?php

class Tipo_DocumentoView{

    public function View($lista,$menu){
        require_once 'view/header.php';
        require_once 'view/tipo_documento/tipo_documento-admin.php';
        require_once 'view/footer.php';
    }

    public function Nuevo($menu){
        require_once 'view/header.php';
        require_once 'view/tipo_documento/tipo_documento-new.php';
        require_once 'view/footer.php';
    }

    public function Editar($tipo_documento,$menu){
        require_once 'view/header.php';
        require_once 'view/tipo_documento/tipo_documento-editar.php';
        require_once 'view/footer.php';
    }


}

?>