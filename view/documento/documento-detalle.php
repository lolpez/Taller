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
                        <?php }else{ ?>
                            <form action="?c=documento&a=editar" method="post" autocomplete="off">
                                <input type="hidden" name="pkdocumento" value="<?php echo $documento['_id'] ?>">
                                <input type="hidden" name="pkavance" value="<?php echo $pkavance ?>">
                                <input type="hidden" name="pkestado_documento_nuevo" value="<?php echo $b->pkestado_documento_nuevo ?>">
                                <button type="submit" class="btn btn-outline btn-info btn-circle btn-xl" data-toggle="tooltip" data-placement="top" title="Actualizar documento con correcciones para continuar con el flujo"><i class="fa fa-upload"></i></button>
                            </form>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <div class="panel-body" style="overflow: scroll; height: 500px">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#modo_linea" data-toggle="tab" style="color: #263340">Mostrar como linea de tiempo</a>
                    </li>
                    <li>
                        <a href="#modo_tabla" data-toggle="tab" style="color: #263340">Mostrar como tabla</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="modo_linea">
                        <div class="panel-body">
                            <ul class="timeline" active in>
                                <?php $sw = false; foreach ($historial as $r){ ?>
                                    <li <?php if ($sw) { ?>class="timeline-inverted" <?php } ?> >
                                        <div class="timeline-badge">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h4 class="timeline-title"><span class="badge" style="background-color: <?php echo $r->estado_documento->color ?>; cursor:pointer;" data-toggle="tooltip" data-placement="top" title="<?php echo $r->estado_documento->descripcion ?>"><?php echo $r->estado_documento->nombre ?></span></h4>
                                                <p><small class="text-muted"><i class="fa fa-clock-o"></i> <?php echo $r->fecha.' '.$r->hora ?></small>
                                                </p>
                                            </div>
                                            <div class="timeline-body">
                                                <p>Realizado por <?php echo $r->usuario_nombre.' ('.$r->usuario_cargo.')'; ?></p>
                                            </div>
                                        </div>
                                    </li>
                                <?php $sw=!$sw; } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="modo_tabla">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Estado del documento</th>
                                    <th>Realzado por</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($historial as $r): ?>
                                    <tr>
                                        <td><?php echo $r->fecha; ?></td>
                                        <td><?php echo $r->hora; ?></td>
                                        <td><span class="badge" style="background-color: <?php echo $r->estado_documento->color ?>; cursor:pointer;" data-toggle="tooltip" data-placement="top" title="<?php echo $r->estado_documento->descripcion ?>"><?php echo $r->estado_documento->nombre ?></span></td>
                                        <td><?php echo $r->usuario_nombre.' ('.$r->usuario_cargo.')'; ?></td>
                                    </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>