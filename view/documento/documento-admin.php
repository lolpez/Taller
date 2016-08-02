<style>
    form{
        display: -webkit-inline-box;
    }
</style>
<h1 class="page-header"><i class="fa fa-file fa-fw fa-2x"></i> Documentos</h1>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active" id="pestaña_mis_documentos">
                        <a href="#mis_documentos" data-toggle="tab" style="color: #263340">Mis documentos</a>
                    </li>
                    <li id="pestaña_aprobados">
                        <a href="#aprobados" data-toggle="tab" style="color: #263340">Documentos del area <?php echo $_SESSION['usuario']->area ?></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="mis_documentos" style="overflow: scroll; height: 500px" >
                        <h4>
                            Mis documentos
                            <?php foreach ($botones as $b) {
                                if ($b->estado_documento_nuevo->pkestado_documento == 1) { ?>
                                    <a class="btn btn-outline btn-primary" href="?c=documento&a=nuevo" data-toggle="tooltip" data-placement="top" title="crea un nuevo documento para iniciar con el flujo"><i class="<?php echo $b->estado_documento_nuevo->icono ?>"></i> Nuevo documento</a>
                                <?php }
                            } ?>
                        </h4>
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="tabla_mis_documentos">
                                <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Titulo</th>
                                    <th>Tipo documento</th>
                                    <th>Estado del documento</th>
                                    <th>Fecha (de creacion)</th>
                                    <th>Hora (de creacion)</th>
                                    <th>Version</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($lista as $r): ?>
                                    <tr>
                                        <td><?php echo $r->codigo ?></td>
                                        <td><?php echo $r->titulo ?></td>
                                        <td><?php echo $r->tipo_documento ?></td>
                                        <td><span class="badge" style="background-color: <?php echo $r->estado_documento->color ?>; cursor:pointer;" data-toggle="tooltip" data-placement="top" title="<?php echo $r->estado_documento->descripcion ?>"><?php echo $r->estado_documento->nombre ?></span></td>
                                        <td><?php echo $r->fecha ?></td>
                                        <td><?php echo $r->hora ?></td>
                                        <td><?php echo $r->version ?></td>
                                        <td style="text-align: center">
                                            <form action="?c=documento&a=descargar" method="post" autocomplete="off">
                                                <input type="hidden" name="pkdocumento" value="<?php echo $r->pkdocumento ?>">
                                                <button type="submit" class="btn btn-outline btn-info btn-circle" data-toggle="tooltip" data-placement="top" title="Descargar Documento"><i class="fa fa-download"></i></button>
                                            </form>
                                            <a href="?c=documento&a=detalle&pkdocumento=<?php echo $r->pkdocumento; ?>&pkavance=<?php echo $r->pkavance; ?>" class="btn btn-outline btn-success btn-circle"  data-toggle="tooltip" data-placement="top" title="Ver detalle"><i class="fa fa-tasks"></i></a>
                                            <?php if ($r->estado_documento->pkestado_documento == 4 && $_SESSION['usuario']->fkcargo == 5){ ?>
                                                <a href="?c=documento&a=actualizacion&pkdocumento=<?php echo $r->pkdocumento; ?>" class="btn btn-outline btn-primary btn-circle"  data-toggle="tooltip" data-placement="top" title="Ordenar documento para su actualizacion"><i class="fa fa-refresh"></i></a>
                                            <?php } ?>
                                            <a href="#" onclick="Eliminar('<?php echo $r->pkdocumento; ?>','<?php echo $r->titulo;?>','documento')" class="btn btn-outline btn-danger btn-circle eliminar"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="aprobados" style="overflow: scroll; height: 500px" >
                        <h4>
                            Documentos aprobados mi area <?php echo $_SESSION['usuario']->area ?>
                        </h4>
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="tabla_documentos_aprobados">
                                <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Titulo</th>
                                    <th>Tipo documento</th>
                                    <th>Version</th>
                                    <th>Emitido por:</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($lista_aprobados as $r): ?>
                                    <tr>
                                        <td><?php echo $r->codigo ?></td>
                                        <td><?php echo $r->titulo ?></td>
                                        <td><?php echo $r->tipo_documento ?></td>
                                        <td><?php echo $r->version ?></td>
                                        <td><?php echo $r->usuario_nombre.' ('.$r->usuario_cargo.')' ?></td>
                                        <td style="text-align: center">
                                            <form action="?c=documento&a=descargar" method="post" autocomplete="off">
                                                <input type="hidden" name="pkdocumento" value="<?php echo $r->pkdocumento ?>">
                                                <button type="submit" class="btn btn-outline btn-info btn-circle" data-toggle="tooltip" data-placement="top" title="Descargar Documento"><i class="fa fa-download"></i></button>
                                            </form>
                                        </td>
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
<script>
    $(document).ready(function() {
        //Habilitar buscadores de tablas
        $('#tabla_mis_documentos').DataTable();
        $('#tabla_documentos_aprobados').DataTable();
    });
</script>