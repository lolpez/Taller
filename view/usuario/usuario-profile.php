<h1 class="page-header">Mi perfil "<?php echo $user->nombre ?>"</h1>
<form action="?c=usuario&a=modificar_perfil" method="post" autocomplete="off" onsubmit="return confSubmit()">
    <input type="hidden" name="pk" value="<?php echo $user->pkusuario; ?>" />
    <input type="hidden" name="cargo" value="<?php echo $user->fkcargo; ?>" />
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <p>En la seccion de Contraseña, al dar click en el icono "<i class="fa fa-eye"></i>", su password sera revelado en letras legibles.</p>
                <p>Por motivos de seguridad, asegurese que SOLO USTED esta viendo esta pantalla.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>CI</label>
                <input type="text" name="ci" class="form-control" value="<?php echo $user->ci ?>" required >
            </div>
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" value="<?php echo $user->nombre ?>" />
            </div>
            <div class="form-group">
                <label>Telefono</label>
                <input type="text" name="telefono" class="form-control" value="<?php echo $user->telefono ?>" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Correo</label>
                <input type="email" name="correo" class="form-control" value="<?php echo $user->email ?>" />
            </div>
            <div class="form-group">
                <label>Nombre de Usuario</label>
                <input type="text" name="username" class="form-control" value="<?php echo substr($user->archivo,0,-6) ?>" />
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <div class="form-group input-group">
                    <input type="password" name="pass" id="pass" class="form-control" value="<?php echo $pass; ?>"/>
                    <a class="input-group-addon" href="#" onclick="VerPass()"><i class="fa fa-eye"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Cargo</label>
                <input type="text" name="noname" class="form-control" value="<?php echo $user->cargo; ?>" readonly />
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

