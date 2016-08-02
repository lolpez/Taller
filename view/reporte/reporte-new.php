<!-- JavaScript print -->
<script src="resources/js/print.js"></script>
<script src="resources/bower_components/jquery/dist/clonefix.js"></script>

<div id = "titulo">
    <h1 class="page-header">Lista maestra</h1>
    <ol class="breadcrumb" style="background-color: white;">
        <li><a href="?c=reporte" style="color:#0016b0;">Lista maestra</a></li>
        <li class="active">Nueva lista maestra</li>
    </ol>
</div>
<style>
    .punto{background: #006; color: #ffffff; height: 30px; text-align: center}
    .seccion{ margin-top: 10px; margin-bottom: 10px }
    .tabla{width: 100%}
    .tabla tr{height: 50px}
    .tabla th{border: 1px solid #000000; text-align: center}
    .tabla td{border: 1px solid #000000; text-align: center}
    .vistaPrevia {
        position: fixed;
        bottom: 2em;
        right: 2em;
        text-decoration: none;
        color: #ffffff;
        background-color: rgba(0, 0, 0, 0.3);
        padding: 2.3em;
        border-radius: 50%;
        text-align: center;
        width: 100px;
        height: 100px;
    }
    .vistaPrevia:hover {
        background-color: #263340;
        color: #ffffff;
        text-decoration: none;
    }
</style>
<div style="background-color: #ffffff; padding: 20px" id="Pagina">
    <div class="row">
        <div class="col-xs-12">
            <table class="tabla">
                <tr>
                    <td width="20%"><img src="resources/img/titbollogo.png" style="width:80px"></td>
                    <td width="40%" class="punto">LISTA MAESTRA</td>
                    <td width="20%">
                        Areas:<br>
                        <?php foreach ($lista as $r) { ?>
                            <?php echo $r->area.'<br>' ?>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="celdacabezal">Documentos por areas</td>
                    <td class="celdacabezal">Fecha:<br> <?php echo $fecha ?></td>
                </tr>
            </table>
        </div>
    </div>
    <?php foreach ($lista as $r) { ?>
        <div class="seccion">
            <div class="punto">Area <?php echo $r->area ?></div>
            <div class="row">
                <div class="col-xs-12">
                    <?php if(isset($r->documentos)){  ?>
                        <br>
                        <table class="tabla">
                            <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Titulo</th>
                                <th>Fecha/Hora de elaboracion</th>
                                <th>Tipo de documento</th>
                                <th>Estado del documento</th>
                                <th>Version</th>
                                <th>Elaborado por</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($r->documentos as $d) { ?>
                                <tr>
                                    <td><?php echo $d->codigo; ?></td>
                                    <td><?php echo $d->titulo; ?></td>
                                    <td><?php echo $d->fecha.' '.$d->hora; ?></td>
                                    <td><?php echo $d->tipo_documento->nombre ?></td>
                                    <td><span class="badge" style="background-color: <?php echo $d->estado_documento->color ?>; cursor:pointer;" data-toggle="tooltip" data-placement="top" title="<?php echo $d->estado_documento->descripcion ?>"><?php echo $d->estado_documento->nombre ?></span></td>
                                    <td><?php echo $d->version ?></td>
                                    <td><?php echo $d->usuario->nombre ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    <?php }else{ echo 'sin documentos'; } ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<div class="row" align="center" style="margin-top: 10px; margin-bottom: 10px" id="botones">
    <a href="#" onclick="VistaPrevia()" class="vistaPrevia"><span class="fa-stack fa-lg"><i class="fa fa-file-o fa-stack-2x"></i><i class="fa fa-eye fa-stack-1x"></i></span></a>
</div>

<script>
    function VistaPrevia(){
        var frame1 = $('<iframe/>');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        frameDoc.document.write('<html><head><title>LISTA MAESTRA <?php echo $fecha ?></title>');
        frameDoc.document.write('<link href="resources/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">');
        frameDoc.document.write('<link href="resources/css/print.css" rel="stylesheet" type="text/css">');
        frameDoc.document.write('</head><body>');
        frameDoc.document.write(ObtenerDocumento());
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
    }
</script>