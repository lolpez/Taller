<h1 class="page-header">Editar Usuario</h1>
<ol class="breadcrumb" style="background-color: white;">
    <li><a href="?c=usuario" style="color:#0016b0;">Usuario</a></li>
    <li class="active">Editar Usuario</li>
</ol>
<form action="?c=usuario&a=guardar" method="post" autocomplete="off" onsubmit="return confSubmit()">
    <input type="hidden" name="pk" value="<?php echo $personal->pkusuario; ?>">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>CI</label>
                <input type="text" name="ci" class="form-control" placeholder="Ingrese el numero de carnet" value="<?php echo $personal->ci; ?>" required >
            </div>
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre" value="<?php echo $personal->nombre; ?>" required />
            </div>
            <div class="form-group">
                <label>Telefono</label>
                <input type="text" name="telefono" class="form-control" placeholder="Ingrese el Telefono" value="<?php echo $personal->telefono; ?>"required />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Correo</label>
                <input type="email" name="correo" class="form-control" placeholder="Ingrese el Correo" value="<?php echo $personal->email; ?>" required />
            </div>
            <div class="form-group">
                <label>Nombre de Usuario</label>
                <input type="text" name="username" class="form-control" placeholder="Ingrese el Nombre de Usuario" value="<?php echo substr($personal->archivo,0,-6); ?>" required />
            </div>
            <div class="form-group">
                <label>Cargo</label>
                <select class="form-control" name="cargo" >
                    <?php foreach ($cargos as $c): ?>
                        <option
                            <?php if ($personal->fkcargo == $c->pkcargo) { ?>
                                selected="selected"
                            <?php } ?>
                            value="<?php echo $c->pkcargo; ?>"><?php echo $c->nombre; ?></option>
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