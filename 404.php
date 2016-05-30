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
<body style="padding: 10%; overflow: hidden">
<div class="row">
    <div class="jumbotron" style="background-color: rgba(0, 0, 0, 0); color: #FFFFFF; text-align: center; left: 50%">
        <img src='resources/img/titbollogotipo.png' style="width:50px; height:50px;"/>
        <h1 class="cover-heading">Error 404</h1>
        <p class="lead">La pagina que esta buscando no existe</p>
        <p class="lead">
            <a href="index.php" class="btn btn-lg btn-success btn-outline ">Volver</a>
        </p>
        <h6 style="color: rgba(255, 249, 251, 0.30)">Mensaje de error:
            <?php
            switch ($_REQUEST['error']){
                case 0:
                    echo 'controlador no permitido por el sistema.';
                    break;
                case 1:
                    echo 'controlador solicitado no existe o no es leible.';
                    break;
                case 2:
                    echo 'accion solicitada no existe.';
                    break;
                case 3:
                    echo 'usted no tiene acceso a este nivel del sistema.';
                    break;
            }
            ?>
        </h6>
        <h6 style="color: rgba(255, 249, 251, 0.30)">Si sigue viendo este mensaje de error, fuck you</h6>
    </div>
</div>
</body>
</html>