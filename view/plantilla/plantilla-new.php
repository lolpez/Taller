<h1 class="page-header">Nueva Plantilla</h1>
<ol class="breadcrumb" style="background-color: white;">
    <li><a href="?c=plantilla" style="color:#0016b0;">Plantillas</a></li>
    <li class="active">Nueva Plantilla</li>
</ol>
<form action="?c=plantilla&a=guardar" method="post" autocomplete="off" onsubmit="return confSubmit()" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12" id="alerta">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Codigo de plantilla</label>
                <input type="text" name="codigo" class="form-control" placeholder="Ingrese el codigo de plantilla" required />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Titulo</label>
                <input type="text" name="titulo" class="form-control" placeholder="Ingrese el titulo de la plantilla" required/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Archivo</label>
                <div class="form-group input-group">
                    <input type="file" name="plantilla" class="form-control" id="plantilla" required/>
                    <a class="input-group-addon" id="icono_verificar"><i class="fa fa-upload"></i></a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="text-center">
        <button type="submit" class="btn btn-success btn-lg" id="guardar"><i class="fa fa-floppy-o"></i> Guardar</button>
    </div>
</form>

<script>
    var tamano;
    var $icono_verificar = $("#icono_verificar");
    $('#plantilla').bind('change', function() {
        tamano = this.files[0].size;
        /*var reader = new FileReader();
        reader.onload = function(event) {
            array_bytes = event.target.result;
            //console.log("File contents: " + array_bytes);
        };
        reader.readAsText(this.files[0]);*/
        var datos = {
            archivo: tamano
        };
        $icono_verificar.children("i:first").attr("class","fa fa-spinner fa-spin");
        $("#guardar").attr("disabled","disabled");
        setTimeout(function () {  //Darle al servidor 3 segundos para que pueda devolver los datos correctamente
            $.post("controller/plantilla.controller.php", datos, function (duplicados) {
                if (!$.isEmptyObject(duplicados)){
                    var duplicados_text = "";
                    $.each(duplicados, function (index, duplicado) {
                        duplicados_text +=   '<div class="col-md-4">'+
                                             '<div class="panel panel-primary">'+
                                             '<div class="panel-heading">'+
                                             '<i class="'+ Obtener_Extencion_Icono(duplicado['nombre_archivo']) +'"></i>'+
                                             ' ' + duplicado['titulo'] +
                                             '</div>'+
                                             '<div class="panel-body" style="color: #000000">'+
                                             '<p><strong>Codigo: </strong>'+ duplicado['codigo'] + '</p>'+
                                             '<p><strong>Fecha de creacion: </strong>'+ duplicado['fecha'] + '</p>'+
                                             '<p><strong>Hora de creacion: </strong>'+ duplicado['hora'] + '</p>'+
                                             '</div>'+
                                             '<div class="panel-footer" style="color: #000000">'+
                                             '<strong>Version: </strong> '+ duplicado['version']+
                                             '</div>'+
                                             '</div>'+
                                             '</div>';
                    });
                    $("#alerta").html(
                        '<div class="alert alert-danger alert-dismissable" id="mensaje_alerta">'+
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                        '<h1>ADVERTENCIA</h1>'+
                        '<p>El sistema detecto que el archivo que esta subiendo ya existe en la base de datos. Es decir que usted esta intentando subir una plantilla duplicada.</p>'+
                        '<p>La plantilla que intenta subir es similar a las plantillas con las siguientes caracteristicas:</p>'+
                        '<div class="row">'+
                        duplicados_text+
                        '</div>'+
                        '<p>Sin embargo usted puede subir de todas formas el archivo si lo desea a pesar de esta advertencia</p>'+
                        '</div>'
                    );
                    $("#guardar").attr("class","btn btn-danger btn-lg");
                    $icono_verificar.children("i:first").attr("class","fa fa-eye");
                    $icono_verificar.attr("style","background-color: #d9534f; color: #FFFFFF");
                }else{
                    $("#mensaje_alerta").remove();
                    $("#guardar").attr("class","btn btn-success btn-lg");
                    $icono_verificar.children("i:first").attr("class","fa fa-check");
                    $icono_verificar.attr("style","background-color: #449d44; color: #FFFFFF");
                }
            }, 'json');
            $("#guardar").removeAttr("disabled");
        }, 3000);
    });

    function Obtener_Extencion_Icono(file){
        var extension = file.substr( (file.lastIndexOf('.') +1) );
        switch(extension) {
        <?php foreach ($archivo_config as $r) : ?>
            case  '<?php echo $r->extension ?>':
                return '<?php echo $r->icono ?>';
            break;
        <?php endforeach ?>
            default:
                return 'fa fa-file fa-fw';
        }
    }
</script>