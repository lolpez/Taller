<h1 class="page-header">Nueva Plantilla</h1>
<ol class="breadcrumb" style="background-color: white;">
    <li><a href="?c=area" style="color:#0016b0;">Plantillas</a></li>
    <li class="active">Nueva Plantilla</li>
</ol>
<form action="?c=plantilla&a=guardar" method="post" autocomplete="off" onsubmit="return confSubmit()" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Sigla</label>
                <input type="text" name="sigla" class="form-control" placeholder="Ingrese la sigla" required />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre de la plantilla" required/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Archivo</label>
                <input type="file" name="plantilla" class="form-control" required/>
            </div>
        </div>
    </div>
    <br>
    <div class="text-center">
        <button type="submit" class="btn btn-success btn-lg" id="guardar"><i class="fa fa-floppy-o"></i> Guardar</button>
    </div>
</form>