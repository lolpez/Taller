<h1 class="page-header"><i class="fa fa-cubes fa-fw fa-2x"></i> Documentos</h1>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a class="btn btn-outline btn-primary" href="?c=documento&a=nuevo"><i class="fa fa-plus"></i> Nuevo Documento</a>
            </div>
            <div class="panel-body" style="overflow: scroll; height: 500px">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>Documento</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($lista as $r): ?>
                            <tr>
                                <td><?php echo $r->nombre ?></td>
                                <td style="text-align: center">
                                    <a href="?c=documento&a=descargar&pkdocumento=<?php echo $r->pkdocumento; ?>" class="btn btn-outline btn-info btn-circle"><i class="fa fa-download"></i></a>
                                    <a href="#" onclick="Eliminar('<?php echo $r->pkdocumento; ?>','<?php echo $r->nombre;?>','documento')" class="btn btn-outline btn-danger btn-circle"><i class="fa fa-trash"></i></a>
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