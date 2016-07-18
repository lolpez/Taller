<h1 class="page-header"><i class="fa fa-file-text fa-fw fa-2x"></i> Plantillas</h1>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a class="btn btn-outline btn-primary agregar" href="?c=plantilla&a=nuevo"><i class="fa fa-plus"></i> Nueva Plantilla</a>
            </div>
            <div class="panel-body" style="overflow: scroll; height: 500px">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Titulo</th>
                            <th>Version</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($lista as $r): ?>
                            <tr>
                                <td><?php echo $r->codigo ?></td>
                                <td><?php echo $r->titulo ?></td>
                                <td><?php echo $r->version ?></td>
                                <td><?php echo $r->fecha ?></td>
                                <td><?php echo $r->hora ?></td>
                                <td style="text-align: center">
                                    <a href="?c=plantilla&a=descargar&pkplantilla=<?php echo $r->pkplantilla; ?>" class="btn btn-outline btn-info btn-circle"  data-toggle="tooltip" data-placement="top" title="Descargar Plantilla"><i class="fa fa-download"></i></a>
                                    <a href="#" onclick="Eliminar('<?php echo $r->pkplantilla; ?>','<?php echo $r->titulo;?>','plantilla')" class="btn btn-outline btn-danger btn-circle eliminar"><i class="fa fa-trash"></i></a>
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