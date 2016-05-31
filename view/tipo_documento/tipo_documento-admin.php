<h1 class="page-header"><i class="fa fa-cube fa-fw fa-2x"></i> Tipo documento</h1>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a class="btn btn-outline btn-primary" href="?c=tipo_documento&a=nuevo"><i class="fa fa-plus"></i> Nuevo Tipo Documento</a>
            </div>
            <div class="panel-body yolo" style="overflow: scroll; height: 500px">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>Sigla</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($lista as $r): ?>
                            <tr>
                                <td><?php echo $r->sigla; ?></td>
                                <td><?php echo $r->nombre; ?></td>
                                <td style="text-align: center">
                                    <a href="?c=tipo_documento&a=editar&pktipo_documento=<?php echo $r->pktipo_documento; ?>" class="btn btn-outline btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                                    <a href="#" onclick="Eliminar('<?php echo $r->pktipo_documento; ?>','<?php echo $r->nombre;?>','tipo_documento')" class="btn btn-outline btn-danger btn-circle"><i class="fa fa-trash"></i></a>
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