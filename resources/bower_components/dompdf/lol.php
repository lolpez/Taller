<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<style type="text/css">
    #pdf_header, #pdf_container {
        border: 1px solid #CCCCCC;
        padding: 10px;
    }

    #pdf_header {
        margin-bottom: 10px
    }

    table {
        width: 580px;
    }

    #pdf_container {
        margin-bottom: 10px
    }

    .rpt_title {
        background: #99CCFF;
    }

    label {
        border: 2px solid #9c9c9c;
        padding: 3px;
        text-align: center
    }

    .celdacabezal {
        border: 1px solid #000000;
        text-align: center
    }

    td{border: 1px solid #000000; text-align: left}
</style>

<body>
<!--Cabezal del pdf-->
<div id="pdf_header">
    <table>
        <tr>
            <td width="20%" class="celdacabezal"><img src="space_age_header.jpg" style="width:100px"></td>
            <td width="40%" class="celdacabezal" style="background-color: #c2c2c2">LABORATORIO CENTRAL</td>
            <td width="20%" class="celdacabezal">Documento#<br>LAB ISO FOR 04.01</td>
            <td width="20%" class="celdacabezal">Ver.:<br>13</td>
        </tr>
        <tr>
            <td colspan="3" class="celdacabezal">SOLICITUD DE SERVICIOS DE ENSAYO</td>
            <td class="celdacabezal">Pagina 1 de 2</td>
        </tr>
    </table>
    <div align="right">
        Codigo de Laboratorio: <label class="entrada">yolo</label>
    </div>
</div>
<!--Contenido del pdf-->
<div id="pdf_container">
    <table cellpadding="10">
        <tr bgcolor="#006" style="color:#FFF">
            <td style="text-align: left" colspan="2">1.-DATOS GENERALES CLIENTE SOLICITANTE</td>
        </tr>
        <tr>
            <td width="50%">Cliente: <label>el cliente</label></td>
            <td width="50%">Gerencia/Dpto./Division: <label class="entrada">la gerencia</label></td>
        </tr>
        <tr>
            <td width="50%">Direccion: <label>la direccion</label></td>
            <td width="50%">Telefono: <label>el telefono</label></td>
        </tr>
    </table>
    <table cellpadding="10">
        <tr bgcolor="#006" style="color:#FFF">
            <td style="text-align: left" colspan="2">2.-DATOS DEL MUESTREO</td>
        </tr>
        <tr>
            <td  width="50%">
                Fecha: <label>la fecha</label>
                Hora: <label>la hora</label>
            </td >
            <td  width="50%">Localidad: <label>la localidad</label></td>
        </tr>
        <tr>
            <td  width="50%">Zona/Lugar: <label>el lugar</label></td>
            <td  width="50%">Punto de muestreo: <label>el punto</label></td>
        </tr>
        <tr>
            <td  width="50%">Fuente: <label>la gerencia</label></td>
            <td  width="50%">Tipo de muestra: <label>el tipo de muestra</label></td>
        </tr>
        <tr>
            <td  width="50%">Responsable de muestreo: <label>la gerencia</label></td>
            <td  width="50%">Otros: <label>otros</label></td>
        </tr>
    </table>
    <table cellpadding="10">
        <tr bgcolor="#006" style="color:#FFF">
            <td style="text-align: left" colspan="3">3.-DATOS DE RECEPCION DE MUESTRAS</td>
        </tr>
        <tr>
            <td>Fecha: <label>la fecha</label></td>
            <td>Hora: <label>la hora</label></td>
            <td>Codigo de muestra(cliente): <label>el cliente</label></td>
        </tr>
        <tr>
            <td>Tipo de recipiente: <label>el tipo</label></td>
            <td>Cantidad de recipientes: <label>cant</label></td>
            <td>Volumen/peso: <label>vol</label></td>
        </tr>
        <tr>
            <table style="border-spacing:0">
                <tr>
                    <td width="50%" style="border: 2px solid #000000; text-align: center">Observacion respecto a las condiciones de la muestra:</td>
                    <td width="50%" style="border: 2px solid #000000; text-align: center">Datos de medicion in situ:</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #000000">good</td>
                    <td style="border: 1px solid #000000">se adjunta registro LAB ISO FOR 17.02</td>
                </tr>
            </table>
        </tr>
    </table>
</div>
</body>
<body>
<div id="pdf_container">
    <table cellpadding="10">
        <tr bgcolor="#006" style="color:#FFF">
            <td style="text-align: left" colspan="2">4.-ESPECIFICACION y REVISION DEL SERVICIO DE ENSAYO</td>
        </tr>
        <tr>
            <td width="20%">TIPO DE SERVICIO: <label>Filtracion</label></td>
            <td width="80%">Parametros de Ensayo: <label>dafuq</label></td>
        </tr>
        <tr>
			<td width="20%">Fecha de entrega Informe: <label>la fecha</label></td>
            <td width="80%">Observaciones: <label>yolo</label></td>            
        </tr>
    </table>
    <table>
        <tr bgcolor="#006" style="color:#FFF">
            <td style="text-align: left" colspan="3">5.-RECEPCION Y ENTREGA DE MUESTRA</td>
        </tr>
        <tr>
            <td width="10%">Entregue conforme: <label>Who</label></td>
            <td width="10%">Recibi conforme: <label>el que lo recibio</label></td>
            <td width="30%" rowspan="4">
                <table style="width:100%">
                    <tr>
                        <td colspan="2" style="text-align: center">RESPONSABLE DE RECEPCION</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center">AREA FISICO-QUIMICA</td>
                    </tr>
                    <tr>
                        <td width="50%">nigga</td>
                        <td width="50%">huehue</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center">AREA RESIDUAL</td>
                    </tr>
                    <tr>
                        <td width="50%">area</td>
                        <td width="50%">huehue</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center">AREA METALES PESADOS</td>
                    </tr>
                    <tr>
                        <td width="50%">nigga</td>
                        <td width="50%">huehue</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>Responsable: <label>el responsable</label></td>
            <td>Responsable: <label>el responsable</label></td>
        </tr>
        <tr>
            <td>Cargo: <label>el cargo</label></td>
            <td>Cargo: <label>el cargo</label></td>
        </tr>
        <tr>
            <td>Fecha: <label>la fecha</label></td>
            <td>Fecha: <label>la fecha</label></td>
        </tr>
        <tr>
			<table style="width:100%">
				<tr>
					<td width="50%">
						<table style="width:100%">
							<tr>
								<td width="50%">
									asdasdsadasdsdasdasdadasdasdadassda asdasdasdadasdasdadasdadsad
								</td>
								<td width="50%">
									asdasdsadasdsdasdasdadasdasdadassda asdasdasdadasdasdadasdadsad
								</td>
							</tr>	
							<tr>
								<td>Vo. Bo. Jefatura</td>
								<td>Observaciones</td>
							</tr>
						</table>	
					</td>
					<td width="50%" style="font-size: 10px">
						<table style="width:100%">
							<tr>
								<td colspan="2" style="text-align: center">RESPONSABLE DE RECEPCION</td>
							</tr>
							<tr>
								<td colspan="2" style="text-align: center">AREA MICROBIOLOGIA</td>
							</tr>
							<tr>
								<td width="50%">
									
								</td>
								<td width="50%">
									
								</td>
							</tr>		
							<tr>
								<td>Firma/Aclaracion</td>
								<td>Observacion</td>
							</tr>							
						</table>
					</td>
				</tr>				
            </table>			
        </tr>
    </table>
</div>
</body>
</html>