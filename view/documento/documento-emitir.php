<h1 class="page-header">Emitir documento <?php echo $documento['nombre_archivo'].' '.$documento['titulo'] ?></h1>
<ol class="breadcrumb" style="background-color: white;">
    <li><a href="?c=documento" style="color:#0016b0;"> Documentos</a></li>
    <li class="active">Emitir documento</li>
</ol>

<form action="?c=documento&a=emitir" method="post" autocomplete="off" onsubmit="return confSubmit()">
    <input type="hidden" name="pkdocumento" class="form-control" value="<?php echo $documento['_id'] ?>">
    <input type="hidden" name="pkavance" class="form-control" value="<?php echo $pkavance ?>">
    <input type="hidden" name="pkestadodocumento_nuevo" class="form-control" value="<?php echo $pkestadodocumento_nuevo ?>">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Titulo documento:</label>
                <input type="text" class="form-control" value="<?php echo $documento['titulo'] ?>" readonly >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Codigo:</label>
                <input type="text" class="form-control" value="<?php echo $documento['codigo'] ?>" readonly >
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Comentario</label>
                <div class="form-group">
                    <textarea class="form-control" placeholder="Comentario" name="comentario" style="resize: vertical"><?php echo $comentario; ?></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Emitir a areas:</label>
                <select class="parcmb" name="multiselectArea[]" multiple="multiple">
                    <?php foreach ($areas as $a): ?>
                        <option value="<?php echo $a->pkarea; ?>"><?php echo $a->nombre; ?></option>
                    <?php endforeach ?>
                </select>
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
            selectAllText: 'Seleccionar todo',
            allSelectedText: 'Todas las areas seleccionadas',
            nSelectedText: 'seleccionados',
            maxHeight: 200,
            buttonWidth: '200px'
        });
    });
</script>