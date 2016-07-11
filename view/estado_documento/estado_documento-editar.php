<h1 class="page-header">Editar estado documento</h1>
<ol class="breadcrumb" style="background-color: white;">
    <li><a href="?c=estado_documento" style="color:#0016b0;">Estado Documento</a></li>
    <li class="active">Editar estado documento</li>
</ol>

<form action="?c=estado_documento&a=guardar" method="post" autocomplete="off" onsubmit="return confSubmit()">
    <input type="hidden" name="pk" value="<?php echo $estado_documento->pkestado_documento; ?>">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre" value="<?php echo $estado_documento->nombre; ?>" required >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Nomenglatura</label>
                <input type="text" name="nomenglatura" class="form-control" placeholder="Ingrese la nomenglatura del estado de documento" value="<?php echo $estado_documento->nomenglatura; ?>" required />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Descripcion</label>
                <input type="text" name="descripcion" class="form-control" placeholder="Ingrese la descripcion del estado de documento" value="<?php echo $estado_documento->descripcion; ?>" required />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Color</label>
                <input type="text" name="color" class="form-control color-picker" data-control="data-color" value="<?php echo $estado_documento->color; ?>">
            </div>
        </div>
    </div>
    <br>
    <div class="text-center">
        <button type="submit" class="btn btn-success btn-lg" id="guardar"><i class="fa fa-floppy-o"></i> Guardar</button>
    </div>
</form>

<script type="text/javascript">
    $(function(){
        var colpick = $('.color-picker').each( function() {
            $(this).minicolors({
                control: $(this).attr('data-control') || 'data-color',
                inline: $(this).attr('data-inline') === 'true',
                letterCase: 'lowercase',
                opacity: false,
                change: function(hex, opacity) {
                    if(!hex) return;
                    if(opacity) hex += ', ' + opacity;
                    try {
                        //console.log(hex);
                    } catch(e) {}
                    $(this).select();
                },
                theme: 'bootstrap'
            });
        });

        var $inlinehex = $('#inlinecolorhex h3 small');
        $('#inlinecolors').minicolors({
            inline: true,
            theme: 'bootstrap',
            change: function(hex) {
                if(!hex) return;
                $inlinehex.html(hex);
            }
        });
    });
</script>