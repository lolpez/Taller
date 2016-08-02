<h1 class="page-header">Detalle documento <?php echo $documento['nombre_archivo'].' '.$documento['titulo'] ?></h1>
<ol class="breadcrumb" style="background-color: white;">
    <li><a href="?c=documento" style="color:#0016b0;"> Documentos</a></li>
    <li class="active">Detalle documento</li>
</ol>
<style>
    form{
        display: -webkit-inline-box;
    }
    <?php foreach ($botones as $b) { ?>
    #btn<?php echo $b->estado_documento_nuevo->pkestado_documento ?> {
        color: <?php echo $b->estado_documento_nuevo->color ?>
    }
     #btn<?php echo $b->estado_documento_nuevo->pkestado_documento ?>:hover {
         background-color: <?php echo $b->estado_documento_nuevo->color ?>;
         color: #FFFFFF
     }
    <?php } ?>
    #btndownload{
        color: #31b0d5
    }
     #btndownload:hover{
         background-color: #31b0d5;
         color: #FFFFFF
     }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div style="text-align: center">
                    <form action="?c=documento&a=descargar" method="post" autocomplete="off">
                        <input type="hidden" name="pkdocumento" value="<?php echo $documento['_id'] ?>">
                        <button id="btndownload" type="submit" class="btn btn-default btn-outline btn-circle btn-xl" data-toggle="tooltip" data-placement="top" title="Descargar Documento" style="border-color:  #31b0d5"><i class="fa fa-download"></i></button>
                    </form>
                    <?php foreach ($botones as $b) { ?>
                        <?php switch($b->estado_documento_nuevo->pkestado_documento){
                            case 1: ?>
                                <form action="?c=documento&a=editar" method="post" autocomplete="off">
                                    <input type="hidden" name="pkdocumento" value="<?php echo $documento['_id'] ?>">
                                    <input type="hidden" name="pkavance" value="<?php echo $pkavance ?>">
                                    <input type="hidden" name="pkestado_documento_nuevo" value="<?php echo $b->estado_documento_nuevo->pkestado_documento ?>">
                                    <button type="submit" id="btn<?php echo $b->estado_documento_nuevo->pkestado_documento ?>" class="btn btn-default btn-outline btn-circle btn-xl" data-toggle="tooltip" data-placement="top" title="Suba una nueva version del documento" style="border-color: <?php echo $b->estado_documento_nuevo->color ?>"><i class="<?php echo $b->estado_documento_nuevo->icono ?>"></i></button>
                                </form>
                                <?php break;
                            case 8: ?>
                                <form action="?c=documento&a=editar" method="post" autocomplete="off">
                                    <input type="hidden" name="pkdocumento" value="<?php echo $documento['_id'] ?>">
                                    <input type="hidden" name="pkavance" value="<?php echo $pkavance ?>">
                                    <input type="hidden" name="pkestado_documento_nuevo" value="<?php echo $b->estado_documento_nuevo->pkestado_documento ?>">
                                    <button type="submit" id="btn<?php echo $b->estado_documento_nuevo->pkestado_documento ?>" class="btn btn-default btn-outline btn-circle btn-xl" data-toggle="tooltip" data-placement="top" title="Suba una nueva version del documento" style="border-color: <?php echo $b->estado_documento_nuevo->color ?>"><i class="<?php echo $b->estado_documento_nuevo->icono ?>"></i></button>
                                </form>
                                <?php break;
                            default: ?>
                                <button onclick="confComentario('cambiar_estado','<?php echo $documento['_id'] ?>','<?php echo $pkavance ?>','<?php echo $b->estado_documento_nuevo->pkestado_documento ?>')" type="button" id="btn<?php echo $b->estado_documento_nuevo->pkestado_documento ?>" class="btn btn-default btn-outline btn-circle btn-xl" data-toggle="tooltip" data-placement="top" title="<?php echo $b->estado_documento_nuevo->descripcion ?>" style="border-color: <?php echo $b->estado_documento_nuevo->color ?>"><i class="<?php echo $b->estado_documento_nuevo->icono ?>"></i></button>
                                <?php break;
                        }?>
                    <?php } ?>
                </div>
            </div>
            <div class="panel-body" style="overflow: scroll; height: 500px">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#modo_linea" data-toggle="tab" style="color: #263340">Mostrar como linea de tiempo</a>
                    </li>
                    <li>
                        <a href="#modo_tabla" data-toggle="tab" style="color: #263340">Mostrar como tabla</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="modo_linea">
                        <div class="panel-body">
                            <ul class="timeline active in">
                                <?php $sw = false; foreach ($historial as $r){ ?>
                                    <li <?php if ($sw) { ?>class="timeline-inverted" <?php } ?> >
                                        <div class="timeline-badge" style="background-color: <?php echo $r->estado_documento->color ?>">
                                             <i style="cursor:pointer;" data-toggle="tooltip" data-placement="top" title="<?php echo $r->estado_documento->descripcion ?>" class="<?php echo $r->estado_documento->icono ?>"></i>
                                        </div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h4 class="timeline-title" style="color: <?php echo $r->estado_documento->color ?>"><?php echo $r->estado_documento->nombre ?></h4>
                                                <p><small class="text-muted"><i class="fa fa-clock-o"></i> <?php echo $r->fecha.' '.$r->hora ?></small>
                                                </p>
                                            </div>
                                            <div class="timeline-body">
                                                <p>Realizado por <?php echo $r->usuario_nombre.' ('.$r->usuario_cargo.')'; ?></p>
                                                <p><small><?php echo $r->comentario ?></small></p>
                                            </div>
                                        </div>
                                    </li>
                                <?php $sw=!$sw; } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="modo_tabla">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Estado del documento</th>
                                    <th>Realzado por</th>
                                    <th>Comentario</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($historial as $r): ?>
                                    <tr>
                                        <td><?php echo $r->fecha; ?></td>
                                        <td><?php echo $r->hora; ?></td>
                                        <td><span class="badge" style="background-color: <?php echo $r->estado_documento->color ?>; cursor:pointer;" data-toggle="tooltip" data-placement="top" title="<?php echo $r->estado_documento->descripcion ?>"><?php echo $r->estado_documento->nombre ?></span></td>
                                        <td><?php echo $r->usuario_nombre.' ('.$r->usuario_cargo.')'; ?></td>
                                        <td><?php echo $r->comentario ?></td>
                                    </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confComentario(accion, pkdocumento, pkavance, pkestado_documento_nuevo) {
        swal({
            html:
                '<div class="row">'+
                '<button class="close" style="color: #000000"><i class="fa fa-times"></i></button>'+
                '</div>'+
                '<h1>Ingrese un comentario</h1>' +
                '<form action="?c=documento&a='+accion+'" method="post" autocomplete="off" onsubmit="Guardar()" style="display:block" >' +
                '<textarea class="form-control" placeholder="Comentario" name="comentario" style="resize: vertical"></textarea>'+
                '<input type="hidden" name="pkdocumento" value="'+pkdocumento+'">'+
                '<input type="hidden" name="pkavance" value="'+pkavance+'">'+
                '<input type="hidden" name="pkestado_documento_nuevo" value="'+pkestado_documento_nuevo+'">' +
                '<div class="row" style="margin-top: 10px">'+
                '<button type="submit" class="btn btn-success btn-circle btn-lg" id="btnguardar"><i class="fa fa-check"></i></button>'+
                '</div>'+
                '</form>',
            showCancelButton: false,
            showConfirmButton: false,
            closeOnConfirm: false
        });
    }

    function Guardar(){
        $('#btnguardar').html("<i class='fa fa-spinner fa-spin'></i>");
        $('#btnguardar').attr("disabled","disabled");
        return true;
    }
</script>