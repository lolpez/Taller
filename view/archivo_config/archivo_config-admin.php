<h1 class="page-header"><i class="fa fa-file-o fa-fw fa-2x"></i> Archivos permitidos por el sistema para elaboraciones de documentos</h1>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a class="btn btn-outline btn-primary agregar" href="?c=archivo_config&a=nuevo"><i class="fa fa-plus"></i> Nuevo tipo de archivo permitido</a>
            </div>
            <div class="panel-body yolo" style="overflow: scroll; height: 500px">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Icono</th>
                            <th>Extencion</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($lista as $r): ?>
                            <tr>
                                <td><?php echo $r->nombre; ?></td>
                                <td style="text-align: center; font-size: 30px"><i class="<?php echo $r->icono; ?>"></i></td>
                                <td><?php echo $r->extencion; ?></td>
                                <td style="text-align: center">
                                    <a href="?c=archivo_config&a=editar&pkarchivo_config=<?php echo $r->pkarchivo_config; ?>" class="btn btn-outline btn-info btn-circle editar"><i class="fa fa-pencil"></i></a>
                                    <a href="#" onclick="Eliminar('<?php echo $r->pkarchivo_config; ?>','<?php echo $r->nombre;?>','archivo_config')" class="btn btn-outline btn-danger btn-circle eliminar"><i class="fa fa-trash"></i></a>
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