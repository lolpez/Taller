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
<style type="text/css" id="estilo"></style>
<style type="text/css">
    .shadowfilter {
        -webkit-filter: drop-shadow(-20px 30px 2px rgba(0,0,0,0.40));
    }
</style>
<body>
<div class="container">
    <div class="row" style="margin-top: 5%">
        <div class="col-md-6" id="imagen">
            <img src='resources/img/titbollogo.png' style="max-width: 100%" class="shadowfilter"/>
        </div>
        <div class="col-md-6" id="login">
            <div class="login-panel panel panel-default" style="background-color: rgba(0, 0, 0, 0);color: #FFFFFF">
                <div class="panel-heading" style="text-align: center; height: 50px; margin-bottom: 40px" >
                    <img src='resources/img/titbollogotipo.png' style='margin-bottom: 15px; width:30px; height:30px; display: none' id='icono'/>
                    <label class="panel-title" style="font-size: 30" id="cabezal"> TITBOL</label>
                </div>
                <div class="panel-body">
                    <form role="form" action="index.php?c=usuario&a=recuperar&correo" method="POST" onsubmit="return confSubmit()">
                        <fieldset>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
                                <input class="form-control" type="email" placeholder="correo" name="correo" autocomplete="off">
                            </div>
                            <div class="input-group">
                                <p>Para recuperar su password, inserte su correo electronico con la que fue registrado y recibira un email con su usuario y password.</p>
                            </div>
                            <button type="submit" class="btn btn-lg btn-success btn-block btn-outline" id="aceptar">Aceptar</button>
                            <div style="text-align: center">
                                <a href="index.php" style="text-align: center">Volver</a>
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
    function confSubmit() {
        $('#aceptar').html("<i class='fa fa-spinner fa-spin'></i> Iniciando sesion");
        $('#aceptar').attr("disabled","disabled");
        return true;
    }
</script>
</html>