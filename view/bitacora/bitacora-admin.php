<h1 class="page-header"><i class="fa fa-desktop fa-fw fa-2x"></i> Bitacora</h1>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body" style="overflow: scroll; height: 500px">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Cargo</th>
                            <th>Accion</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($lista as $r): ?>
                            <tr>
                                <td><?php echo $r->usuario; ?></td>
                                <td><?php echo $r->cargo; ?></td>
                                <td><?php echo $r->accion; ?></td>
                                <td><?php echo $r->fecha; ?></td>
                                <td><?php echo $r->hora; ?></td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>