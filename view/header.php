<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>TITBOL</title>
    <link rel="shortcut icon" href="resources/img/titbolicono.ico">
    <!--Loader-->
    <link href="resources/css/loader.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="resources/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Multi Menu -->
    <link href="resources/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <!-- Tablas Personalizables -->
    <link href="resources/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <!-- CSS Principal -->
    <link href="resources/css/cssprincipal.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="resources/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Sweet alert -->
    <script src="resources/bower_components/sweetalert/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="resources/bower_components/sweetalert/sweetalert2.css">
    <!-- Clock Cocks -->
    <link rel="stylesheet" type="text/css" href="resources/bower_components/clock/css/bootstrap-clockpicker.min.css">
    <!-- Multiselect -->
    <link rel="stylesheet" type="text/css" href="resources/bower_components/multiselect/css/bootstrap-multiselect.css">
    <!-- Calendario -->
    <link rel="stylesheet" href="resources/bower_components/calendar/css/zabuto_calendar.css"/>
    <!-- DateTime Picker -->
    <link rel="stylesheet" href="resources/bower_components/datetime-picker/css/bootstrap-datetimepicker.css" />
    <!-- Switch Button -->
    <link rel="stylesheet" href="resources/bower_components/switch/css/bootstrap-switch.min.css"/>
    <!-- jQuery -->
    <script src="resources/bower_components/jquery/dist/jquery.min.js"></script>
</head>
<body>
<!-- Menu -->
<?php
require_once 'view/menu.php';
?>
<!-- Contenido de la pagina -->
<div id="page-wrapper">
    <!--Loader-->
    <div id="loader" align="center" style="padding: 25%; color: #384f83">
        <div class="loader"></div>
        <p>Cargando para usted<br>Por favor espere <i class="fa fa-smile-o"></i></p>
    </div>
    <div class="container-fluid animate-bottom" id="panelAdmin" style="display:none;">
