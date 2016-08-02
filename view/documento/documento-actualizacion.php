<h1 class="page-header">Ordenar la actualizacion del documento <?php echo $documento['nombre_archivo'].' '.$documento['titulo'] ?></h1>
<ol class="breadcrumb" style="background-color: white;">
    <li><a href="?c=documento" style="color:#0016b0;"> Documentos</a></li>
    <li class="active">Ordenar actualizacion documento</li>
</ol>

<form action="?c=documento&a=Guardar_Orden_Actualizacion" method="post" autocomplete="off" onsubmit="return confSubmit()">
    <input type="hidden" name="pkdocumento" class="form-control" value="<?php echo $documento['_id'] ?>">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Titulo documento:</label>
                <input type="text" class="form-control" value="<?php echo $documento['titulo'] ?>" readonly >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Usuario responsable para la actualizacion:</label>
                <div class="form-group">
                    <select class="parcmb" name="usuario" required>
                        <?php foreach ($usuarios as $u): ?>
                            <option value="<?php echo $u->pkusuario; ?>"><?php echo $u->nombre; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Comentario</label>
                <div class="form-group">
                    <textarea class="form-control" placeholder="Comentario" name="comentario" style="resize: vertical"></textarea>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="text-center">
        <button type="submit" class="btn btn-success btn-lg" id="guardar"><i class="fa fa-floppy-o"></i> Guardar</button>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('.parcmb').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            includeSelectAllOption: true,
            filterPlaceholder: 'Buscar',
            nonSelectedText: 'Ninguno',
            maxHeight: 200,
            buttonWidth: '200px'
        });
    });
</script>