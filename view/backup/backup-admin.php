<h1 class="page-header"><i class="fa fa-database fa-fw fa-2x"></i> Copias de seguridad</h1>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a class="btn btn-outline btn-primary agregar" href="?c=backup&a=verificacion&bd=Crear"><i class="fa fa-plus"></i> Realizar Copia de Seguridad</a>
            </div>
            <div class="panel-body" style="overflow: scroll; height: 500px">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($lista as $r): ?>
                            <tr>
                                <td><?php echo $r->fecha; ?></td>
                                <td><?php echo $r->hora; ?></td>
                                <td style="text-align: center">
                                    <a href="?c=backup&a=verificacion&bd=Descargar&pkbackup=<?php echo $r->pkbackup ?>" class="btn btn-outline btn-info btn-circle" data-toggle="tooltip" data-placement="top" title="Descargar copia de seguridad"><i class="fa fa-download"></i></a>
                                    <a href="?c=backup&a=verificacion&bd=Restaurar&pkbackup=<?php echo $r->pkbackup ?>" class="btn btn-outline btn-success btn-circle" data-toggle="tooltip" data-placement="top" title="Restaurar esta copia de seguridad"><i class="fa fa-refresh"></i></a>
                                    <a href="?c=backup&a=verificacion&bd=Eliminar&pkbackup=<?php echo $r->pkbackup ?>" class="btn btn-outline btn-danger btn-circle" data-toggle="tooltip" data-placement="top" title="Eliminar esta copia de seguridad"><i class="fa fa-trash"></i></a>
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