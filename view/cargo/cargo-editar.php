<h1 class="page-header">Editar Cargo</h1>
<ol class="breadcrumb" style="background-color: white;">
    <li><a href="?c=cargo" style="color:#0016b0;">Cargo</a></li>
    <li class="active">Editar Cargo</li>
</ol>

<form action="?c=cargo&a=guardar" method="post" autocomplete="off" onsubmit="return confSubmit()">
    <input type="hidden" name="pk" value="<?php echo $cargo->pkcargo; ?>">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre" value="<?php echo $cargo->nombre; ?>" required >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Descripcion</label>
                <input type="text" name="descripcion" class="form-control" placeholder="Ingrese la descripcion" value="<?php echo $cargo->descripcion; ?>" required />
            </div>
        </div>
    </div>
    <br>
    <div class="text-center">
        <button type="submit" class="btn btn-success btn-lg" id="guardar"><i class="fa fa-floppy-o"></i> Guardar</button>
    </div>
</form>