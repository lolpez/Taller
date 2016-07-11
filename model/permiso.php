<?php
require_once 'model/menu.php';
require_once 'model/menu_detalle.php';
require_once 'model/privilegio.php';

class Permiso
{
    private $menu;
    private $menu_detalle;
    private $privilegio;

    public function __CONSTRUCT()
    {
        $this->menu = new Menu();
        $this->menu_detalle = new MenuDetalle();
        $this->privilegio = new Privilegio();
    }

    public function Obtener($fkcargo){
        $listaP = $this->privilegio->Obtener($fkcargo);
        $listaMenuDetalle = array();
        foreach ($listaP as $p):
            $menu_detalle = $this->menu_detalle->Obtener($p->fkmenu_detalle);
            $listaMenuDetalle[] = $menu_detalle;
        endforeach;
        $listaMenu = array();
        $listaM = $this->menu->Listar();
        foreach ($listaM as $m):
            foreach ($listaMenuDetalle as $md):
                if ($md->fkmenu == $m->pkmenu){
                    $listaMenu[] = $m;
                    break;
                }
            endforeach;
        endforeach;
        $menu = new stdClass();
        $menu->listaMenu = $listaMenu;
        $menu->listaMenuDetalle = $listaMenuDetalle;
        return $menu;
    }
}
?>