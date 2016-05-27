<style>
    .icono{
        color: #000000;
    }
</style>
<h1 class="page-header"><i class="fa fa-sliders fa-fw fa-2x"></i> Editar permisos para el cargo <?php echo $cargo->nombre ?></h1>
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p>Esta seccion debe ser solamente manipulada por el administrador de sistema. Los cambios a realizar deben ser cuidadosamente revisadas ya que pueden traer consecuencias no deseadas.</p><p>Al marcar "SI", se le estara otrogando permiso al cargo <?php echo $cargo->nombre ?> para poder realizar dicha accion.</p></div>
<form action="?c=privilegio&a=guardar" method="post" autocomplete="off" onsubmit="return confSubmit()">
    <input type="hidden" name="pk" value="<?php echo $cargo->pkcargo; ?>">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <?php foreach ($menupriv as $m): ?>
                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <i class="<?php echo $m->icono?>"></i> <?php echo $m->nombre ?>
                            </div>
                            <div class="panel-body">
                                <?php foreach ($menu_detallepriv as $d): ?>
                                    <div>
                                        <?php if ($d->fkmenu == $m->pkmenu){ ?>
                                            <label><i class="<?php echo $d->icono ?> icono"></i><?php echo $d->nombre ?></label>
                                            <input
                                                <?php foreach ($privilegio as $p): ?>
                                                    <?php if ($p->fkmenu_detalle == $d->pkmenu_detalle){ ?>
                                                        checked
                                                    <?php } ?>
                                                <?php endforeach ?>
                                                class="switch" type="checkbox" name="fkmenu_detalle[]" value="<?php echo $d->pkmenu_detalle?>" >
                                        <?php } ?>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <div class="text-center" style="margin-top: 10px; margin-bottom: 10px">
        <button type="submit" class="btn btn-success btn-lg" id="guardar"><i class="fa fa-floppy-o"></i> Guardar</button>
    </div>
</form>
<script>
    $(document).ready(function() {
        $(".switch").bootstrapSwitch({
            size : 'mini',
            animate : false
        });
    });
</script>