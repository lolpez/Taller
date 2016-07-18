<h1 class="page-header">Editar archivo permitido por el sistema para elaboraciones de documentos</h1>
<ol class="breadcrumb" style="background-color: white;">
    <li><a href="?c=archivo_config" style="color:#0016b0;">Archivos permitidos</a></li>
    <li class="active">Editar archivo permitido</li>
</ol>
<style>
    .icono{
        color: #000000;
        font-size: 30px;
    }
</style>
<form action="?c=archivo_config&a=guardar" method="post" autocomplete="off" onsubmit="return confSubmit()">
    <input type="hidden" name="pk" value="<?php echo $archivo->pkarchivo_config ?>">
    <input type="hidden" name="icono" id="icono" value="<?php echo $archivo->icono ?>">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre ejemplo documentos word" value="<?php echo $archivo->nombre ?>" required >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Extencion e icono(opcional)</label>
                <div class="form-group input-group">
                    <input type="text" name="extension" placeholder="Ingrese la extension ejemplo pdf docx" class="form-control" value="<?php echo $archivo->extension ?>" required >
                    <a href="#" class="dropdown-toggle btn btn-default input-group-addon" data-toggle="dropdown"><i class="<?php echo $archivo->icono ?>" id="iconodibujo"></i><span class="caret"></span></a>
                    <div class="dropdown-menu" style="max-width: 180px;">
                        <a class="icono" href="#" onclick="CambiarIcono(this)"><i class ="fa fa-file-o fa-fw"></i></a>
                        <a class="icono" href="#" onclick="CambiarIcono(this)"><i class ="fa fa-file-audio-o fa-fw"></i></a>
                        <a class="icono" href="#" onclick="CambiarIcono(this)"><i class ="fa fa-file-code-o fa-fw"></i></a>
                        <a class="icono" href="#" onclick="CambiarIcono(this)"><i class ="fa fa-file-excel-o fa-fw"></i></a>
                        <a class="icono" href="#" onclick="CambiarIcono(this)"><i class ="fa fa-file-image-o fa-fw"></i></a>
                        <a class="icono" href="#" onclick="CambiarIcono(this)"><i class ="fa fa-file-movie-o fa-fw"></i></a>
                        <a class="icono" href="#" onclick="CambiarIcono(this)"><i class ="fa fa-file-pdf-o fa-fw"></i></a>
                        <a class="icono" href="#" onclick="CambiarIcono(this)"><i class ="fa fa-file-powerpoint-o fa-fw"></i></a>
                        <a class="icono" href="#" onclick="CambiarIcono(this)"><i class ="fa fa-file-text-o fa-fw"></i></a>
                        <a class="icono" href="#" onclick="CambiarIcono(this)"><i class ="fa fa-file-word-o fa-fw"></i></a>
                        <a class="icono" href="#" onclick="CambiarIcono(this)"><i class ="fa fa-file-zip-o fa-fw"></i></a>
                    </div>
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
    function CambiarIcono(elemento){
        var icono = $(elemento).children("i").attr('class');
        $('#icono').attr('value',icono);
        $('#iconodibujo').attr('class',icono);
    }
</script>