<?php

class AreaView{

    public function View($lista,$menu){
        require_once 'view/header.php';
        require_once 'view/area/area-admin.php';
        require_once 'view/footer.php';
    }

    public function Nuevo($listaA,$menu){
        require_once 'view/header.php';
        require_once 'view/area/area-new.php';
        require_once 'view/footer.php';
    }

    public function Editar($listaA,$area,$menu){
        require_once 'view/header.php';
        require_once 'view/area/area-editar.php';
        require_once 'view/footer.php';
    }

    public function Flujo($area,$area_flujo,$estado_documentos,$flujo_default,$menu){
        require_once 'view/header.php';
        require_once 'view/area/area-flujo.php';
        require_once 'view/footer.php';
    }


}

?>