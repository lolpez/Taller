<?php

class ReporteView{

    public function View($areas,$menu){
        require_once 'view/header.php';
        require_once 'view/reporte/reporte-admin.php';
        require_once 'view/footer.php';
    }

    public function Nuevo($lista,$fecha,$menu){
        require_once 'view/header.php';
        require_once 'view/reporte/reporte-new.php';
        require_once 'view/footer.php';
    }

}

?>