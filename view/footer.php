    </div>
</div>
<!-- JavaScript bootstrap -->
<script src="resources/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- JavaScript para multimenu -->
<script src="resources/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- JavaScript para tablas -->
<script src="resources/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="resources/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

<!-- JavaScript para fullscreen -->
<script src="resources/bower_components/fullscreen/index.js"></script>

<!-- JavaScript para Clock Cocks -->
<script type="text/javascript" src="resources/bower_components/clock/js/bootstrap-clockpicker.min.js"></script>

<!-- JavaScript para Calendario-->
<script type="text/javascript" src="resources/bower_components/calendar/js/zabuto_calendar.js"></script>

<!-- JavaScript para Multiselect -->
<script src="resources/bower_components/multiselect/js/bootstrap-multiselect.js"></script>
<script src="resources/bower_components/multiselect/js/bootstrap-multiselect-collapsible-groups.js"></script>

<!--JavaScript para Datetime Picker -->
<script type="text/javascript" src="resources/bower_components/datetime-picker/js/moment-with-locales.js"></script>
<script type="text/javascript" src="resources/bower_components/datetime-picker/js/bootstrap-datetimepicker.js"></script>

<!--Switch Button -->
<script type="text/javascript" src="resources/bower_components/switch/js/bootstrap-switch.min.js"></script>

<!-- JavaScript Reponsive -->
<script src="resources/js/jsprincipal.js"></script>
<script>
    var elemento='';
    var controlador='';
    var pk='';

    $(document).ready(function() {
        //Desaparecer Spiner
        setTimeout(showPage, 500);

        //Evento al presionar una tecla en los inputs. Ya que al imprimir se necesita los "Value" de los inputs
        $("input").keyup(function(){
            $(this).attr("value",$(this).val());
        });

        //Habilitar buscadores de tablas
        $('#dataTable').DataTable();

        //Mensajes Sweet Alert
        <?php if (isset($_REQUEST['k'])) { ?>
            swal({
                timer: 3000,
                showCancelButton: false,
                showConfirmButton: false,
                closeOnConfirm: false,
                html:"<button class='close' style='color: #000000'><i class='fa fa-times'></i></button><br><h3><?php echo $_SESSION['usuario']->cargo; ?></h3><div class='col-md-6' style='max-height: 60px;'><img src='resources/img/Titbollogo.png' style='max-width: 100%;'/></div><div class='col-md-6' style='height:200px;'><div style='margin-top:40%'>Bienvenido de nuevo<br><?php echo $_SESSION['usuario']->nombre ?><div></div>"
            });
        <?php } ?>
        <?php if ((isset($_REQUEST['item'])) && (isset($_REQUEST['tarea'])) && (isset($_REQUEST['exito']))) { ?>
            var mensaje = "";
            var correcto = true;
            switch ("<?php echo $_REQUEST['tarea']?>") {
                case "agregar":
                    if (<?php echo $_REQUEST['exito'];?>) {
                        mensaje = "Se ha agregado un nuevo ";
                    } else {
                        mensaje = "No se puede registrar un nuevo ";
                        correcto = false;
                    }
                    break;
                case "modificar":
                    if (<?php echo $_REQUEST['exito'];?>) {
                        mensaje = "Se ha modificado un ";
                    } else {
                        mensaje = "No se puede modificar un ";
                        correcto = false;
                    }
                    break;
                case "eliminar":
                    if (<?php echo $_REQUEST['exito'];?>) {
                        mensaje = "Se ha eliminado un ";
                    } else {
                        mensaje = "No se puede eliminar un ";
                        correcto = false;
                    }
                    break;
            }
            mensaje = mensaje + "<?php echo $_REQUEST['item'];?>";
            ShowMessage(mensaje, correcto);
        <?php } ?>
    });

    function showPage() {
        $("#loader").remove();
        $("#panelAdmin").fadeIn("slow");
    }

    function ShowMessage(mensaje, correcto){
        if (correcto){
            swal('Operacion completada', mensaje , 'success');
        }else{
            swal('Operacion cancelada', mensaje + '. El registro ingresado ya existe, asegurese de que los codigos no se esten repitiendo.', 'error');
        }
    }

    function confSubmit() {
        $('#guardar').html("<i class='fa fa-spinner fa-spin'></i> Guardando por favor espere");
        $('#guardar').attr("disabled","disabled");
        return true;
    }

    function Eliminar(llave,ele,cont){
        elemento = ele;
        controlador = cont;
        pk = llave;
        swal({
                title: 'Eliminar '+elemento,
                text: '¿Esta seguro que desea eliminarlo?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No',
                confirmButtonClass: 'confirm-class',
                cancelButtonClass: 'cancel-class',
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    var ubicacion = '?c='+controlador+'&a=eliminar&pk='+pk;
                    window.location = ubicacion;
                }
            }
        );
    }
</script>
</body>
</html>