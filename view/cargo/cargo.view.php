<?php

class CargoView{

    public function View($lista,$menu){
        require_once 'view/header.php';
        require_once 'view/cargo/cargo-admin.php';
        require_once 'view/footer.php';
    }

    public function Nuevo($menu){
        require_once 'view/header.php';
        require_once 'view/cargo/cargo-new.php';
        require_once 'view/footer.php';
    }

    public function Editar($cargo,$menu){
        require_once 'view/header.php';
        require_once 'view/cargo/cargo-editar.php';
        require_once 'view/footer.php';
    }


}

?>