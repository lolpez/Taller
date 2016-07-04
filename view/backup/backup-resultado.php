<h1 class="page-header"><i class="fa fa-<?php echo $icono ?> fa-fw fa-2x"></i> <?php echo $bd_accion ?> copia de seguridad</h1>
<ol class="breadcrumb" style="background-color: white;">
    <li><a href="?c=backup" style="color:#0016b0;">Copia de seguridad</a></li>
    <li class="active"><?php echo $bd_accion ?> copia de seguridad</li>
</ol>
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-<?php echo $alerta ?> alert-dismissable">
            <p><?php echo $mensaje ?></p>
            <?php if (!is_null($archivo)) { ?>
                <p>Su archivo se descargara automaticamente en: <i class='fa fa-spinner fa-spin' id="descarga_spin"></i> <strong id="tiempo"></strong></p>
                <p>Si el archivo no se descarga automaticamente, puede hacer click en el siguiente boton para descargarlo.</p>
                <a class="btn btn-outline btn-success" href="<?php echo 'resources/backup/'.$archivo ?>"><i class="fa fa-download fa-2x"></i> Descargar ahora</a>
            <?php } ?>
            <br>
        </div>
    </div>
</div>

<!-- Si es un resultado de descarga -->
<script>
    $(document).ready(function() {
        <?php if (!is_null($archivo)) { ?>
            var tiempo_restante = 10;
            var reloj = setInterval(myTimer, 1000);
            function myTimer() {
                tiempo_restante --;
                if (tiempo_restante > 0) {
                    $('#tiempo').html(tiempo_restante + ' segundo');
                    if (tiempo_restante > 1){
                        $('#tiempo').append('s');
                    }
                }else{
                    $('#descarga_spin').remove();
                    $('#tiempo').html('Descargando...');
                    clearTimeout(reloj);
                }
            }
            setTimeout(function () {
                window.location = '<?php echo 'resources/backup/'.$archivo ?>';
            }, 10000);
        <?php } ?>
    });
</script>