<h1 class="page-header"><i class="fa fa-tasks fa-fw fa-2x"></i> Tareas</h1>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body" style="overflow: scroll; height: 450px">
                <div class="list-group" >
                    <?php foreach ($listaNV as $l) : ?>
                        <a href="<?php echo $l->url?>" class="list-group-item" style="background-color: #f2dede">
                            <i class="fa fa-square-o fa-fw"></i> <?php echo $l->mensaje ?>
                            <span class="pull-right text-muted small"><em><?php echo $l->fecha ?></em></span>
                        </a>
                    <?php endforeach ?>
                </div>
                <div class="list-group" >
                    <?php foreach ($listaV as $l) : ?>
                        <a href="<?php echo $l->url?>" class="list-group-item" style="background-color: #dff0d8">
                            <i class="fa fa-check-square-o fa-fw"></i> <?php echo $l->mensaje ?>
                            <span class="pull-right text-muted small"><em><?php echo $l->fecha ?></em></span>
                        </a>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>