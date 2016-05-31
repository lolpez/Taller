<h1 class="page-header">Editar Area</h1>
<ol class="breadcrumb" style="background-color: white;">
    <li><a href="?c=area" style="color:#0016b0;">Area</a></li>
    <li class="active">Editar area</li>
</ol>

<form action="?c=area&a=guardar" method="post" autocomplete="off" onsubmit="return confSubmit()">
    <input type="hidden" name="pk" value="<?php echo $area->pkarea; ?>">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre del area" value="<?php echo $area->nombre; ?>" required >
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Sigla</label>
                <input type="text" name="sigla" class="form-control" placeholder="Ingrese la sigla de larea" value="<?php echo $area->sigla; ?>" required />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Area padre</label>
                <select class="form-control" name="fkarea_padre" style="color: #000000;">
                    <?php foreach ($listaA as $r): ?>
                        <option
                            <?php if ($r->pkarea == $area->fkarea_padre) { ?>
                                selected="selected"
                            <?php } ?>
                            value="<?php print $r->pkarea; ?>"><?php print $r->nombre; ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
    </div>
    <br>
    <div class="text-center">
        <button type="submit" class="btn btn-success btn-lg" id="guardar"><i class="fa fa-floppy-o"></i> Guardar</button>
    </div>
</form>
