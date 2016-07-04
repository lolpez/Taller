<style>
    .icono{
        color: #000000;
    }
</style>
<h1 class="page-header"><i class="fa fa-ban fa-fw fa-2x"></i> Permisos de Sistema</h1>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body" style="overflow: scroll; height: 450px">
                <div class="panel-group" id="accordion">
                    <?php foreach ($cargo as $c): ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a data-toggle="collapse" data-parent="#accordion" style="color:#337ab7; text-decoration: none" href="#<?php echo $c->pkcargo; ?>"><?php echo $c->nombre; ?> <i class="fa fa-angle-down"></i></a>
                                <div class="pull-right">
                                    <a href="?c=privilegio&a=editar&pkcargo=<?php echo $c->pkcargo; ?>" class="btn btn-outline btn-info btn-circle editar"><i class="fa fa-pencil"></i></a>
                                </div>
                            </div>
                            <div id="<?php echo $c->pkcargo; ?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?php foreach ($menupriv as $m): ?>
                                        <div class="col-md-6">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                    <i class="<?php echo $m->icono?>"></i> <?php echo $m->nombre ?>
                                                </div>
                                                <div class="panel-body permisos">
                                                    <?php foreach ($menu_detallepriv as $d): ?>
                                                        <?php if ($d->fkmenu == $m->pkmenu){ ?>
                                                            <?php foreach ($privilegio as $p): ?>
                                                                <?php if (($p->fkcargo == $c->pkcargo) && ($p->fkmenu_detalle == $d->pkmenu_detalle)){ ?>
                                                                    <div>
                                                                        <label><i class="<?php echo $d->icono ?> icono"></i><?php echo $d->nombre ?></label>
                                                                    </div>
                                                                <?php } ?>
                                                            <?php endforeach ?>
                                                        <?php } ?>
                                                    <?php endforeach ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $.each($('.permisos'), function (index, p) {
        if (!$(p).children().length>0){
            $(p).html("<div><label style='color: #800000'><i class='fa fa-ban fa-fw fa-2x'></i>Sin permisos</label></div>");
        }
    });
</script>