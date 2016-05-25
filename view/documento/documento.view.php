<?php

class DocumentoView{

    public function View($lista,$menu){
        require_once 'view/header.php';
        require_once 'view/documento/documento-admin.php';
        require_once 'view/footer.php';
    }

    public function Nuevo($menu){
        require_once 'view/header.php';
        require_once 'view/documento/documento-new.php';
        require_once 'view/footer.php';
    }

}

?>