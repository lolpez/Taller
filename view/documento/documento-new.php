<h1 class="page-header">Nuevo Documento</h1>
<ol class="breadcrumb" style="background-color: white;">
    <li><a href="?c=area" style="color:#0016b0;">Documentos</a></li>
    <li class="active">Nuevo Documento</li>
</ol>
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p>Solo estan permitidos subir los siguientes tipos de archivos:</p>
            <p>
                <?php
                    foreach($archivos_permitidos as $a):
                        echo '<i class="'.$a->icono.' fa-2x"></i>'.$a->nombre.' (.'.$a->extencion.')<br>';
                    endforeach;
                ?>
            </p>
        </div>
    </div>
</div>
<form action="?c=documento&a=guardar" method="post" autocomplete="off" onsubmit="return confSubmit()" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre" required >
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Tipo de documento</label>
                <select class="form-control" name="fktipo_documento" style="color: #000000">
                    <?php foreach ($tipo_documento as $t): ?>
                        <option value="<?php echo $t->pktipo_documento; ?>"><?php echo $t->nombre; ?> </option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Archivo</label>
                <input type="file" name="documento" class="form-control" accept="<?php
                    foreach($archivos_permitidos as $a):
                        echo '.'.$a->extencion.',';
                    endforeach;
                ?>" required />
            </div>
        </div>
    </div>
    <br>
    <div class="text-center">
        <button type="submit" class="btn btn-success btn-lg" id="guardar"><i class="fa fa-floppy-o"></i> Guardar</button>
    </div>
</form>