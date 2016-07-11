<?php

class PlantillaView{

    public function View($lista,$menu){
        require_once 'view/header.php';
        require_once 'view/plantilla/plantilla-admin.php';
        require_once 'view/footer.php';
    }

    public function Nuevo($menu){
        require_once 'view/header.php';
        require_once 'view/plantilla/plantilla-new.php';
        require_once 'view/footer.php';
    }

}

?>