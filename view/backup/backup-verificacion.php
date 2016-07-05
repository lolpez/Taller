<h1 class="page-header"><i class="fa fa-database fa-fw fa-2x"></i> Verificacion de seguridad</h1>
<ol class="breadcrumb" style="background-color: white;">
    <li><a href="?c=backup" style="color:#0016b0;">Copia de seguridad</a></li>
    <li class="active">Verificacion de seguridad</li>
</ol>
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p>Antes de <i class="fa fa-<?php echo $icono ?>"></i> <?php echo $bd_accion ?> esta copia de seguridad, se requiere de sus datos de usuario como administrador.</p>
            <p>Por motivos de seguridad, solo el administrador del sistema puede realizar copias de seguridad y restauraciones.</p>
            <p>Como administrador de sistema, debe conocer los riesgos que existen al realizar copias de seguridad y restauraciones.</p>
            <p>Para mayor informacion, lea el manual de usuario.</p>
        </div>
        <form action="?c=backup&a=<?php echo $bd_accion?>" method="post" autocomplete="off" onsubmit="return confSubmitBackUp()" enctype="multipart/form-data">
            <input type="hidden" name="pk" value="<?php echo $pkbackup ?>">
            <div class="row">
                <div class="col-xs-4 col-xs-offset-4">
                    <div class="form-group">
                        <label>Usuario</label>
                        <div class="input-group" style="margin-bottom: 40px">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input class="form-control" type="text" placeholder="Usuario" name="username" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Contraseña</label>
                        <div class="input-group" style="margin-bottom: 40px">
                            <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                            <input class="form-control" type="password" placeholder="Contraseña" name="password" required>
                        </div>
                    </div>
                    <?php if ($bd_accion == 'Subir'){ ?>
                        <div class="form-group">
                            <label>Archivo</label>
                            <div class="input-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-file-zip-o fa-fw"></i></span>
                                    <input type="file" name="archivo" class="form-control" accept=".zip" required />
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <br>
            <div class="text-center">
                <button type="submit" class="btn btn-success btn-lg" id="backup"><i class="fa fa-<?php echo $icono ?>"></i> <?php echo $bd_accion ?> copia de seguridad</button>
            </div>
        </form>
    </div>
</div>

<script>
    function confSubmitBackUp() {
        $('#backup').html("<i class='fa fa-spinner fa-spin'></i> Cargando por favor espere. Este proceso puede tardar varios minutos.");
        $('#backup').attr("disabled","disabled");
        return true;
    }
</script>