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

    public function Editar($documento,$pkavance,$pkestadodocumento_nuevo,$tipo_documento,$archivos_permitidos,$menu){
        require_once 'view/header.php';
        require_once 'view/documento/documento-editar.php';
        require_once 'view/footer.php';
    }

    public function Detalle($documento,$pkavance,$historial,$botones,$menu){
        require_once 'view/header.php';
        require_once 'view/documento/documento-detalle.php';
        require_once 'view/footer.php';
    }

    public function Emitir($documento,$pkavance,$pkestadodocumento_nuevo,$comentario,$areas,$menu){
        require_once 'view/header.php';
        require_once 'view/documento/documento-emitir.php';
        require_once 'view/footer.php';
    }

    public function Actualizacion($documento,$usuarios,$menu){
        require_once 'view/header.php';
        require_once 'view/documento/documento-actualizacion.php';
        require_once 'view/footer.php';
    }

}

?>