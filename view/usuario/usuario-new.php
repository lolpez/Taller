<h1 class="page-header">Nuevo Usuario</h1>
<ol class="breadcrumb" style="background-color: white;">
    <li><a href="?c=usuario" style="color:#0016b0;">Usuario</a></li>
    <li class="active">Nuevo Usuario</li>
</ol>

<form action="?c=usuario&a=guardar" method="post" autocomplete="off" onsubmit="return confSubmit()">
    <input type="hidden" name="pkusuario" value="0" />
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>CI</label>
                <input type="text" name="ci" class="form-control" 
                       placeholder="Ingrese el numero de carnet" required >
            </div>
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control"  
                       placeholder="Ingrese el nombre" required />
            </div>
            <div class="form-group">
                <label>Telefono</label>
                <input type="text" name="telefono" class="form-control"  
                       placeholder="Ingrese el Telefono" required />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Correo</label>
                <input type="email" name="correo" class="form-control" 
                       placeholder="Ingrese el Correo" required />
            </div>
            <div class="form-group">
                <label>Nombre de Usuario</label>
                <input type="text" name="username" class="form-control"  
                       placeholder="Ingrese el Nombre de Usuario" required />
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="pass" class="form-control"  
                       placeholder="Ingrese Su Contraseña" required />
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Cargo</label>
                    <select class="form-control" name="cargo" >
                    <?php foreach ($cargos as $c): ?>
                        <option value="<?php echo $c->pkcargo; ?>"><?php echo $c->nombre; ?></option>
                    <?php endforeach ?>
                    </select>
                </div>               
            </div>
        </div>
    </div>
    <br>
    <div class="text-center">
        <button type="submit" class="btn btn-success btn-lg" id="guardar"><i class="fa fa-floppy-o"></i> Guardar</button>
    </div>
</form>

