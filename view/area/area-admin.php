<h1 class="page-header"><i class="fa fa-sitemap fa-fw fa-2x"></i> Area</h1>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a class="btn btn-outline btn-primary agregar" href="?c=area&a=nuevo"><i class="fa fa-plus"></i> Nueva Area</a>
            </div>
            <div class="panel-body" style="overflow: scroll; height: 500px">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>Sigla</th>
                            <th>Nombre</th>
                            <th>Area padre</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($lista as $r): ?>
                            <tr>
                                <td><?php echo $r->sigla; ?></td>
                                <td><?php echo $r->nombre; ?></td>
                                <td><?php echo $r->padre; ?></td>
                                <td style="text-align: center">
                                    <a href="?c=area&a=editar&pkarea=<?php echo $r->pkarea; ?>" class="btn btn-outline btn-info btn-circle editar"><i class="fa fa-pencil"></i></a>
                                    <a href="?c=area&a=flujo&pkarea=<?php echo $r->pkarea; ?>" class="btn btn-outline btn-success btn-circle"  data-toggle="tooltip" data-placement="top" title="Flujo de documentos"><i class="fa fa-chain"></i></a>
                                    <a href="#" onclick="Eliminar('<?php echo $r->pkarea; ?>','<?php echo $r->nombre;?>','area')" class="btn btn-outline btn-danger btn-circle eliminar"><i class="fa fa-trash"></i></a>
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