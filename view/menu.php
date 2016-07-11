<!--Estilo para el menu-->
<style>
    a{
        color: #ffffff;
    }
</style>
<div id="wrapper">
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0 ; background-color: #263340; border-color: #263340; color: #ffffff">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="?c=notificacion">TITBOL</a>
        </div>
        <!-- Barra horizontal -->
        <ul class="nav navbar-top-links navbar-right">
            <!-- Mi perfil -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li>
                        <a href="?c=usuario&a=perfil"><i class="fa fa-user fa-fw"></i> Perfil de Usuario</a>
                    </li>
                    <li>
                        <a href="#" id='fullscreen'><i class="fa fa-expand fa-fw"></i> Pantalla completa</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="?c=usuario&a=logout"><i class="fa fa-power-off fa-fw"></i> Cerrar sesion</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!--Menu vertical-->
        <div class="navbar-default sidebar" role="navigation" style=" background-color: #263340">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="?c=notificacion"><i class="fa fa-home fa-fw fa-2x"></i> Inicio</a>
                    </li>
                    <?php foreach ($menu->listaMenu as $m): ?>
                        <li>
                            <a href="#"><i class="<?php echo $m->icono ?>"></i> <?php echo $m->nombre ?><span class="fa arrow" style="margin-top: 10px"></span></a>
                            <?php foreach ($menu->listaMenuDetalle as $md): ?>
                                <?php if ($md->fkmenu == $m->pkmenu){ ?>
                                    <ul class="nav nav-second-level">
                                        <ul class="nav nav-second-level">
                                            <li>
                                                <a href="?c=<?php echo $md->controlador ?>"><i class="<?php echo $md->icono ?>"></i> <?php echo $md->nombre ?></a>
                                            </li>
                                        </ul>
                                    </ul>
                                <?php array_diff_key($menu->listaMenuDetalle, ["pkmenu_detalle" => $md->pkmenu_detalle]); } ?>
                            <?php endforeach ?>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </nav>
</div>