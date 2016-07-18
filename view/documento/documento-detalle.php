<h1 class="page-header">Detalle documento <?php echo $documento['nombre_archivo'].' '.$documento['titulo'] ?></h1>
<ol class="breadcrumb" style="background-color: white;">
    <li><a href="?c=documento" style="color:#0016b0;"> Documentos</a></li>
    <li class="active">Detalle documento</li>
</ol>
<style>
    form{
        display: -webkit-inline-box;
    }
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                HISTORIAL
            </div>
            <div class="panel-body" style="overflow: scroll; height: 500px">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Estado documento</th>
                            <th>Realzado por</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($historial as $r): ?>
                            <tr>
                                <td><?php echo $r->fecha; ?></td>
                                <td><?php echo $r->hora; ?></td>
                                <td><?php echo $r->estado_documento; ?></td>
                                <td><?php echo $r->usuario_nombre.' ('.$r->usuario_cargo.')'; ?></td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div style="text-align: center">
                    <form action="?c=documento&a=descargar" method="post" autocomplete="off">
                        <input type="hidden" name="pkdocumento" value="<?php echo $documento['_id'] ?>">
                        <button type="submit" class="btn btn-outline btn-primary btn-circle btn-xl" data-toggle="tooltip" data-placement="top" title="Descargar Documento"><i class="fa fa-download"></i></button>
                    </form>
                    <?php foreach ($botones as $b) { ?>
                        <?php if ($b->id_boton != 1) { ?>
                            <form action="?c=documento&a=cambiar_estado" method="post" autocomplete="off">
                                <input type="hidden" name="pkdocumento" value="<?php echo $documento['_id'] ?>">
                                <input type="hidden" name="pkavance" value="<?php echo $pkavance ?>">
                                <input type="hidden" name="pkestado_documento_nuevo" value="<?php echo $b->pkestado_documento_nuevo ?>">
                                <button type="submit" class="btn btn-outline btn-<?php echo $b->clase ?> btn-circle btn-xl" data-toggle="tooltip" data-placement="top" title="<?php echo $b->ayuda ?>"><i class="<?php echo $b->icono ?>"></i></button>
                            </form>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>