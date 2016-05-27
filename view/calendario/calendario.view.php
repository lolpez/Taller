<?php

class CalendarioView{

    public function View($lista,$ano,$menu){
        require_once 'view/header.php';
        require_once 'view/calendario/calendario-admin.php';
        require_once 'view/footer.php';
    }

}

?>