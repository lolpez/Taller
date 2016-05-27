<style>
    .ocupado{
        background-color: #800000;
        color: #ffffff;
    }
</style>
<script>
    var feriados=[];
    var ano = <?php echo $ano; ?>;
    <?php foreach ($lista as $r): ?>
    feriados.push({fecha:'<?php echo $r->fecha;?>/'+ano, nombre: '<?php echo $r->nombre; ?>'});
    <?php endforeach ?>
</script>
<h1 class="page-header"><i class="fa fa-calendar fa-fw fa-2x"></i> Calendario de trabajo TITBOL</h1>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Calendario Anual</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8">
                        <div id="my-calendar"></div>
                    </div>
                    <div class="col-md-4">
                        Feriados registrados
                        <div class="dataTable_wrapper" style="overflow-y: scroll; height: 275px">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Nombre feriado</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($lista as $r): ?>
                                    <tr>
                                        <td><?php echo $r->fecha.'/'.$ano; ?></td>
                                        <td><?php echo $r->nombre; ?></td>
                                    </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">
    var fechasRegistradas =[];
    $.each(feriados, function (index, m) {
        fechasRegistradas.push(
            {
                "date": m['fecha'],
                "classname": "ocupado",
                "modal": true
            }
        )
    });
    $(document).ready(function () {
        $("#my-calendar").zabuto_calendar({
            cell_border: true,
            today: true,
            language: "es",
            data: fechasRegistradas,
            nav_icon: {
                prev: '<i class="fa fa-chevron-circle-left"></i>',
                next: '<i class="fa fa-chevron-circle-right"></i>'
            },
            action: function () {
                return ObtenerDia(this.id);
            },
            action_nav: function () {
                return ActualizarAno(this.id);
            }
        });
    });

    function ObtenerDia(id) {
        var fecha = $("#" + id).data("fecha");
        var dia = $("#" + id).data("nombreDia");
        //Verificar que no haya dado click en sabado o domingo (0=domingo; 6=sabado)
        if ((dia != 0) && (dia != 6))
        {
            //Verificar si ya tiene un evento registrado
            var hasEvent = $("#" + id).data("hasEvent");
            if (hasEvent) {
                //Editar
                $.each(feriados, function (index, m) {
                    if (m.fecha.slice(0, -5)+'/'+ano  == fecha){
                        swal({
                            html: ObtenerFormularioEditar(m.fecha, m.nombre),
                            showCancelButton: false,
                            showConfirmButton: false,
                            closeOnConfirm: false
                        });
                    }
                });
                return true;
            }
            //Agregar nuevo
            swal({
                html: ObtenerFormularioGuardar(fecha),
                showCancelButton: false,
                showConfirmButton: false,
                closeOnConfirm: false
            });
            return true;
        }
        swal({
            title: 'Dia no habil',
            html: 'Los dias sabados y domingos ya estan deshabilitados por defecto',
            type: 'error'
        });
        return false;
    }

    function ActualizarAno(id) {
        var to = $("#" + id).data("to");
        if (to.year != ano){
            $.each(fechasRegistradas, function (index, f) {
                f.date = f.date.slice(0, -5) + '/' + to.year;
            });
            ano = to.year;
        }
    }

    function ObtenerFormularioEditar(fecha, nombre){
        var form = "";
        form += "<div class='row'>";
        form += "<button class='close' style='color: #000000'><i class='fa fa-times'></i></button>";
        form += "</div>";
        form += "<label>Editar feriado dia: " + fecha + "</label>";
        form += "<input type='hidden' id='fecha' value='" + fecha + "'/>";
        form += "<input type='text' id='nombre' class='form-control' placeholder='Ingrese el nombre del feriado' value='" + nombre + "' required/>";
        form += "<div class='row' style='margin-top: 10px'>";
        form += "<div class='col-md-6'>";
        form += "<a href='#' class='btn btn-danger btn-circle btn-lg' onclick='EliminarFeriado()' id='btneliminar'><i class='fa fa-trash'></i></a>";
        form += "</div>";
        form += "<div class='col-md-6'>";
        form += "<a href='#' class='btn btn-success btn-circle btn-lg' onclick='Editar()' id='btneditar'><i class='fa fa-floppy-o'></i></a>";
        form += "</div>";
        form += "</div>";
        return form;
    }

    function ObtenerFormularioGuardar(fecha){
        var form = "";
        form += "<div class='row'>";
        form += "<button class='close' style='color: #000000'><i class='fa fa-times'></i></button>";
        form += "</div>";
        form += "<label>Agregar feriado dia: " + fecha + "</label>";
        form += "<input type='hidden' id='fechaNueva' value='" + fecha + "'/>";
        form += "<input type='text' id='nombreNueva' class='form-control' placeholder='Ingrese el nombre del feriado' required/>";
        form += "<div class='row' style='margin-top: 10px'>";
        form += "<a href='#' class='btn btn-success btn-circle btn-lg' onclick='Guardar()' id='btnguardar'><i class='fa fa-floppy-o'></i></a>";
        form += "</div>";
        return form;
    }

    function Guardar(){
        $('#btnguardar').html("<i class='fa fa-spinner fa-spin'></i>");
        var ubicacion = '?c=calendario&a=Guardar&fecha='+ $("#fechaNueva").val().slice(0, -5)+'&nombre='+$("#nombreNueva").val();
        window.location = ubicacion;
        $('#btnguardar').attr("disabled","disabled");
    }

    function Editar(){
        $('#btneditar').html("<i class='fa fa-spinner fa-spin'></i>");
        var ubicacion = '?c=calendario&a=Editar&fecha='+ $("#fecha").val().slice(0, -5)+'&nombre='+$("#nombre").val();
        window.location = ubicacion;
        $('#btneditar').attr("disabled","disabled");
        $('#btneliminar').attr("disabled","disabled");
    }

    function EliminarFeriado(){
        $('#btneliminar').html("<i class='fa fa-spinner fa-spin'></i>");
        var ubicacion = '?c=calendario&a=Eliminar&pk='+ $("#fecha").val().slice(0, -5);
        window.location = ubicacion;
        $('#btneliminar').attr("disabled","disabled");
        $('#btneditar').attr("disabled","disabled");
    }
</script>