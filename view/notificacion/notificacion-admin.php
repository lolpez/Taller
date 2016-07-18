<h1 class="page-header"><img src="" style="max-width: 10%"/> Sistema de gestion documental TITBOL</h1>
<div class="row">
    <div class="col-md-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo count($lista) ?></div>
                        <?php if (count($lista) == 1){?>
                            <div>Tarea pendiente</div>
                        <?php }else{ ?>
                            <div>Tareas pendientes</div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <a href="?c=notificacion&a=notificaciones" style="color: #337AB7">
                <div class="panel-footer">
                    <span class="pull-left">Ver Todas</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Nuevas tareas pendientes</h4>
            </div>
            <div class="panel-body" style="overflow: scroll; height: 400px">
                <?php if (count($lista)==0){ ?>
                    <div style="text-align: center; color: #2ecc71; margin-top: 15%; opacity: 0.7; font-size:20px">
                        <i class="fa fa-smile-o fa-5x"></i>
                        <h2>Usted no tiene tareas pendientes</h2>
                    </div>
                <?php }else{ ?>
                    <div class="list-group">
                        <?php foreach ($lista as $l) : ?>
                            <a href="<?php echo $l->url?>" class="list-group-item">
                                <p class="text-muted small"><em><?php echo $l->fecha ?></em></p>
                                <p><?php echo $l->mensaje ?></p>
                            </a>
                        <?php endforeach ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>