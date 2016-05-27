<?php

class UsuarioView{
   
    public function View($lista,$menu){
        require_once 'view/header.php';
        require_once 'view/usuario/usuario-admin.php';
        require_once 'view/footer.php';
    }
    
    public function Nuevo($cargos,$menu){
        require_once 'view/header.php';
        require_once 'view/usuario/usuario-new.php';
        require_once 'view/footer.php';
    }
    
     public function Editar($usuario,$cargos,$pass,$menu){
        require_once 'view/header.php';
        require_once 'view/usuario/usuario-editar.php';
        require_once 'view/footer.php';
    }

    public function Profile($user,$pass,$menu){
        require_once 'view/header.php';
        require_once 'view/usuario/usuario-profile.php';
        require_once 'view/footer.php';
    }

 
}