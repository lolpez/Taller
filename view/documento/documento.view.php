<?php

class DocumentoView{

    public function View($lista,$lista_aprobados,$botones,$menu){
        require_once 'view/header.php';
        require_once 'view/documento/documento-admin.php';
        require_once 'view/footer.php';
    }

    public function Nuevo($tipo_documento,$archivos_permitidos,$menu){
        require_once 'view/header.php';
        require_once 'view/documento/documento-new.php';
        require_once 'view/footer.php';
    }

    public function Detalle($documento,$pkavance,$historial,$botones,$menu){
        require_once 'view/header.php';
        require_once 'view/documento/documento-detalle.php';
        require_once 'view/footer.php';
    }

    public function Emitir($documento,$pkavance,$pkestadodocumento_nuevo,$areas,$menu){
        require_once 'view/header.php';
        require_once 'view/documento/documento-emitir.php';
        require_once 'view/footer.php';
    }

}

?>