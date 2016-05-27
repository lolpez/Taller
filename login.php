<?php
$accion = "k";
if (isset($_REQUEST['hell'])) {
    $accion = "error";
}
if (isset($_REQUEST['pass'])) {
    $accion = "password";
}
if (isset($_REQUEST['no'])) {
    $accion = "no";
}
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>TITBOL</title>
    <link rel="shortcut icon" href="resources/img/titbolicono.ico">
    <!-- Bootstrap Core CSS -->
    <link href="resources/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="resources/css/cssprincipal.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="resources/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!--Sweet alert-->
    <script src="resources/bower_components/sweetalert/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="resources/bower_components/sweetalert/sweetalert2.css">
    <!-- jQuery-->
    <script src="resources/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- JavaScript Reponsive -->
    <script src="resources/js/jslogin.js"></script>
</head>
<style type="text/css" id="estilo">
</style>
<body>
<div class="container">
    <div class="row" >
        <div class="col-md-4 col-md-offset-7 col-lg-5" style="margin-top: 10%">
            <div class="login-panel panel panel-default" >
                <div class="panel-heading" style="text-align: center; height: 50px; margin-bottom: 40px" >
                    <img src='resources/img/titbollogotipo.png' style='margin-bottom: 15px; width:30px; height:30px; display: none' id='icono'/>
                    <label class="panel-title" style="font-size: 30" id="cabezal"> TITBOL</label>
                </div>
                <div class="panel-body">
                    <form role="form" action="index.php?c=usuario&a=Login" method="POST" onsubmit="return confSubmit()">
                        <fieldset>
                            <div class="input-group" style="margin-bottom: 40px">
                                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                <input class="form-control" type="text" placeholder="Usuario" name="username" autocomplete="off">
                            </div>
                            <div class="input-group" style="margin-bottom: 40px">
                                <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                                <input class="form-control" type="password" placeholder="Contraseña" name="password">
                            </div>
                            <?php
                            if (isset($_REQUEST['hell'])) {
                                print "<p style='color:red'>Error de datos personales</p>";
                            }
                            ?>
                            <button type="submit" class="btn btn-lg btn-success btn-block" id="aceptar">Iniciar Sesion</button>
                            <div style="text-align: center">
                                <a href="recuperar.php" style="text-align: center">¿Olvido su contraseña?</a>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    $(document).ready(function() {
        if ("<?php echo $accion;?>" == "error") {
            swal('ERROR', "Datos incorrectos", 'error');
        }
        if ("<?php echo $accion;?>" == "password") {
            swal('Operacion completada', 'se envio su password a su correo', 'success');
        }
        if ("<?php echo $accion;?>" == "no") {
            swal('ERROR', "El correo no esta registrado", 'error');
        }
    });
    function confSubmit() {
        $('#aceptar').html("<i class='fa fa-spinner fa-spin'></i> Iniciando sesion");
        $('#aceptar').attr("disabled","disabled");
        return true;
    }
</script>
</html>