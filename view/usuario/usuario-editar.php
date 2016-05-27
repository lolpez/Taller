<h1 class="page-header">Editar Usuario</h1>
<ol class="breadcrumb" style="background-color: white;">
    <li><a href="?c=usuario" style="color:#0016b0;">Usuario</a></li>
    <li class="active">Editar Usuario</li>
</ol>
<form action="?c=usuario&a=guardar" method="post" autocomplete="off" onsubmit="return confSubmit()">
    <input type="hidden" name="pk" value="<?php echo $usuario->pkusuario; ?>">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>CI</label>
                <input type="text" name="ci" class="form-control" placeholder="Ingrese el numero de carnet" value="<?php echo $usuario->ci; ?>" required >
            </div>
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre" value="<?php echo $usuario->nombre; ?>" required />
            </div>
            <div class="form-group">
                <label>Telefono</label>
                <input type="text" name="telefono" class="form-control" placeholder="Ingrese el Telefono" value="<?php echo $usuario->telefono; ?>"required />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Correo</label>
                <input type="email" name="correo" class="form-control" placeholder="Ingrese el Correo" value="<?php echo $usuario->email; ?>" required />
            </div>
            <div class="form-group">
                <label>Nombre de Usuario</label>
                <input type="text" name="username" class="form-control" placeholder="Ingrese el Nombre de Usuario" value="<?php echo substr($usuario->archivo,0,-5); ?>" required />
            </div>
            <div class="form-group">
                <label>Cargo</label>
                <select class="form-control" name="cargo" >
                    <?php foreach ($cargos as $c): ?>
                        <option
                            <?php if ($usuario->fkcargo == $c->pkcargo) { ?>
                                selected="selected"
                            <?php } ?>
                            value="<?php echo $c->pkcargo; ?>"><?php echo $c->nombre; ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Contraseña</label>
                <div class="form-group input-group">
                    <input type="password" name="pass" id="pass" class="form-control" value="<?php echo $pass; ?>"/>
                    <a class="input-group-addon" href="#" onclick="VerPass()"><i class="fa fa-eye"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <p>En la seccion de Contraseña, al dar click en el icono "<i class="fa fa-eye"></i>", el password de este usuario sera revelado en letras legibles.</p>
                <p>Por motivos de seguridad, asegurese que SOLO USTED y el USUARIO al que esta modificando sus datos esten viendo esta pantalla.</p>
            </div>
        </div>
    </div>
    <br>
    <div class="text-center">
        <button type="submit" class="btn btn-success btn-lg" id="guardar"><i class="fa fa-floppy-o"></i> Guardar</button>
    </div>
</form>

<script>
    var sw = true;
    function VerPass(){
        if (sw){
            $('#pass').attr('type', 'text');
        }else{
            $('#pass').attr('type', 'password');
        }
        sw= !sw;
    }
</script>