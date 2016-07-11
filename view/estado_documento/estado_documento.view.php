<?php

class Estado_DocumentoView{

    public function View($lista,$menu){
        require_once 'view/header.php';
        require_once 'view/estado_documento/estado_documento-admin.php';
        require_once 'view/footer.php';
    }

    public function Editar($estado_documento,$menu){
        require_once 'view/header.php';
        require_once 'view/estado_documento/estado_documento-editar.php';
        require_once 'view/footer.php';
    }

}

?>