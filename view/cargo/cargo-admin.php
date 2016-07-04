<h1 class="page-header"><i class="fa fa-briefcase fa-fw fa-2x"></i> Cargos</h1>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a class="btn btn-outline btn-primary agregar" href="?c=cargo&a=nuevo"><i class="fa fa-plus"></i> Nuevo Cargo</a>
            </div>
            <div class="panel-body" style="overflow: scroll; height: 500px">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($lista as $r): ?>
                            <tr>
                                <td><?php echo $r->nombre; ?></td>
                                <td><?php echo $r->descripcion; ?></td>
                                <td style="text-align: center">
                                    <a href="?c=cargo&a=editar&pkcargo=<?php echo $r->pkcargo; ?>" class="btn btn-outline btn-info btn-circle editar"><i class="fa fa-pencil"></i></a>
                                    <a href="#" onclick="Eliminar('<?php echo $r->pkcargo; ?>','<?php echo $r->nombre;?>','cargo')" class="btn btn-outline btn-danger btn-circle eliminar"><i class="fa fa-trash"></i></a>
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