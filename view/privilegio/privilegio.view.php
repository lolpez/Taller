<?php

class PrivilegioView{

    public function View($privilegio,$cargo,$menupriv,$menu_detallepriv,$menu){
        require_once 'view/header.php';
        require_once 'view/privilegio/privilegio-admin.php';
        require_once 'view/footer.php';
    }

    public function Editar($cargo,$privilegio,$menupriv,$menu_detallepriv,$menu){
        require_once 'view/header.php';
        require_once 'view/privilegio/privilegio-editar.php';
        require_once 'view/footer.php';
    }
}

?>