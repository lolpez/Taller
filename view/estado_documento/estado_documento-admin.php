<h1 class="page-header"><i class="fa fa-clock-o fa-fw fa-2x"></i> Estado de documento</h1>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body" style="overflow: scroll; height: 500px">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Nomenglatura</th>
                            <th>Descripcion</th>
                            <th>Color de estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($lista as $r): ?>
                            <tr>
                                <td><?php echo $r->nombre; ?></td>
                                <td><?php echo $r->nomenglatura; ?></td>
                                <td><?php echo $r->descripcion; ?></td>
                                <td><span class="badge" style="background-color: <?php echo $r->color; ?>"><?php echo $r->color; ?></span></td>
                                <td style="text-align: center">
                                    <a href="?c=estado_documento&a=editar&pkestado_documento=<?php echo $r->pkestado_documento; ?>" class="btn btn-outline btn-info btn-circle editar"><i class="fa fa-pencil"></i></a>
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