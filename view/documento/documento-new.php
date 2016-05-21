<h1 class="page-header">Nuevo Documento</h1>
<ol class="breadcrumb" style="background-color: white;">
    <li><a href="?c=area" style="color:#0016b0;">Documentos</a></li>
    <li class="active">Nuevo Documento</li>
</ol>
<form action="?c=documento&a=guardar" method="post" autocomplete="off" onsubmit="return confSubmit()" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre" required >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Archivo</label>
                <input type="file" name="documento" class="form-control" required />
            </div>
        </div>
    </div>
    <br>
    <div class="text-center">
        <button type="submit" class="btn btn-success btn-lg" id="guardar"><i class="fa fa-floppy-o"></i> Guardar</button>
    </div>
</form>