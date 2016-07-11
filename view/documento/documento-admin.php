<h1 class="page-header"><i class="fa fa-file fa-fw fa-2x"></i> Documentos</h1>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a class="btn btn-outline btn-primary agregar" href="?c=documento&a=nuevo"><i class="fa fa-plus"></i> Nuevo Documento</a>
            </div>
            <div class="panel-body" style="overflow: scroll; height: 500px">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Titulo</th>
                            <th>Tipo documento</th>
                            <th>Estado</th>
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
                                    <a href="?c=documento&a=descargar&pkdocumento=<?php echo $r->pkdocumento; ?>" class="btn btn-outline btn-info btn-circle"  data-toggle="tooltip" data-placement="top" title="Descargar Documento"><i class="fa fa-download"></i></a>
                                    <a href="?c=documento&a=historial&pkdocumento=<?php echo $r->pkdocumento; ?>" class="btn btn-outline btn-success btn-circle"  data-toggle="tooltip" data-placement="top" title="Ver historial de documento"><i class="fa fa-history"></i></a>
                                    <a href="#" onclick="Eliminar('<?php echo $r->pkdocumento; ?>','<?php echo $r->nombre;?>','documento')" class="btn btn-outline btn-danger btn-circle eliminar"><i class="fa fa-trash"></i></a>
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