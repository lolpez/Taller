<style>
    form{
        display: -webkit-inline-box;
    }
</style>
<h1 class="page-header"><i class="fa fa-bar-chart fa-fw fa-2x"></i> Lista Maestra</h1>
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <p>Seleccione las áreas para generar la lista maestra</p>
        </div>
    </div>
</div>
<form action="?c=reporte&a=nuevo" method="post" autocomplete="off" onsubmit="return confSubmit()">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label>Lista maestra</label>
                <select class="form-control" name="areas[]" multiple="multiple" required>
                    <?php foreach ($areas as $a): ?>
                        <option value="<?php echo $a->pkarea; ?>"
                            <?php if ($a->pkarea == $_SESSION['usuario']->fkarea) { ?>
                                selected
                            <?php } ?>
                            ><?php echo $a->nombre; ?></option>
                    <?php endforeach ?>
                </select>
                <button type="submit" class="btn btn-outline btn-primary" data-toggle="tooltip" data-placement="top" title="Generar lista maestra"><i class="fa fa-plus"></i> Generar reporte</button>
            </div>
         </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $('select').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            includeSelectAllOption: true,
            filterPlaceholder: 'Buscar',
            nonSelectedText: 'Ninguno',
            selectAllText: 'Seleccionar todo',
            allSelectedText: 'Todas las areas seleccionadas',
            nSelectedText: 'seleccionados',
            maxHeight: 200,
            buttonWidth: '200px'
        });
    });
</script>