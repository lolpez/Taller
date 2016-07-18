<script src="resources/bower_components/gojs/go.js"></script>
    <script id="code">

        function init() {
            var $ = go.GraphObject.make;  // for conciseness in defining templates
            myDiagram =
                $(go.Diagram, "myDiagramDiv",  // must name or refer to the DIV HTML element
                    {
                        // Inicializar
                        initialContentAlignment: go.Spot.Center,
                        // Inicializar eventos del mouse para zoom
                        "toolManager.mouseWheelBehavior": go.ToolManager.WheelZoom,
                        // Habilitar doble click para crear nuevos nodos
                        //"clickCreatingTool.archetypeNodeData": { text: "new node" },
                        // Habilitar deshacer, rehacer
                        "undoManager.isEnabled": true
                    });

            // when the document is modified, add a "*" to the title and enable the "Save" button
            myDiagram.addDiagramListener("Modified", function(e) {
                var button = document.getElementById("SaveButton");
                if (button) button.disabled = !myDiagram.isModified;
                var idx = document.title.indexOf("*");
                if (myDiagram.isModified) {
                    if (idx < 0) document.title += "*";
                } else {
                    if (idx >= 0) document.title = document.title.substr(0, idx);
                }
            });

            //Definir la forma del Nodo
            myDiagram.nodeTemplate =
                $(go.Node, "Auto",
                    new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
                    // Definir la forma del nodo que rodeara al texto
                    $(go.Shape, "RoundedRectangle",
                        {
                            parameter1: 20,  // the corner has a large radius
                            fill: $(go.Brush, "Linear", { 0: "rgb(254, 201, 0)", 1: "rgb(254, 162, 0)" }),
                            stroke: null,
                            portId: "",  // this Shape is the Node's port, not the whole Node
                            fromLinkable: true,
                            fromLinkableSelfNode: true,	//Permitir que no sea linkeable a si mismo
                            fromLinkableDuplicates: false,	//Permitir que pueda haber un link dos veces a la misma direccion
                            toLinkable: true,
                            toLinkableSelfNode: true,
                            toLinkableDuplicates: true,
                            cursor: "pointer"
                        }),
                    $(go.TextBlock,
                        {
                            font: "bold 11pt helvetica, bold arial, sans-serif",
                            editable: false,  // Permitir que el texto sea editable
                            cursor: "move"
                        },
                        new go.Binding("text").makeTwoWay())
                );

            //Agregar boton para unir links
            myDiagram.nodeTemplate.selectionAdornmentTemplate =
                $(go.Adornment, "Spot",
                    $(go.Panel, "Auto",
                        $(go.Shape, { fill: null, stroke: "blue", strokeWidth: 2 }),
                        $(go.Placeholder)  // a Placeholder sizes itself to the selected Node
                    ),
                    // Boton para crear un nuevo link
                    $("Button",
                        {
                            alignment: go.Spot.TopRight,
                            click: drawLink,  // Al dar click en el boton, redirigir el link
                            actionMove: drawLink  // Al arrastrar el boton, redirigir el link
                        },
                        $(go.Shape, { toArrow: "standard", stroke: null }) //Dibujo de la flecha
                    )
                );

            function drawLink(e, button) {
                var node = button.part.adornedPart;
                var tool = e.diagram.toolManager.linkingTool;
                tool.startObject = node.port;
                e.diagram.currentTool = tool;
                tool.doActivate();
            }

            // Estilo de los links
            myDiagram.linkTemplate =
                $(go.Link,  // the whole link panel
                    {
                        curve: go.Link.Bezier, adjusting: go.Link.Stretch,
                        reshapable: true,
                        relinkableFrom: true,	//Re-linkeable de
                        relinkableTo: true, //Re-linkeable a
                        toShortLength: 3
                    },
                    new go.Binding("points").makeTwoWay(),
                    new go.Binding("curviness"),
                    $(go.Shape,  // the link shape
                        { strokeWidth: 1.5 }),
                    $(go.Shape,  // the arrowhead
                        { toArrow: "standard", stroke: null }),
                    $(go.Panel, "Auto",
                        $(go.Shape,  // the label background, which becomes transparent around the edges
                            {
                                fill: $(go.Brush, "Radial",
                                    { 0: "rgb(240, 240, 240)", 0.3: "rgb(240, 240, 240)", 1: "rgba(240, 240, 240, 0)" }),
                                stroke: null
                            }),
                        $(go.TextBlock, "escriba la nomengaltura exacta del estado de documento",  // the label text
                            {
                                textAlign: "center",
                                font: "9pt helvetica, arial, sans-serif",
                                margin: 4,
                                editable: true  // enable in-place editing
                            },
                            // editing the text automatically updates the model data
                            new go.Binding("text").makeTwoWay())
                    )
                );
            // Leer del JSON para renderizar los datos
            load();
        }

        // Mostrar el modelo del diagrama en formato JSON
        function save() {
            document.getElementById("mySavedModel").value = myDiagram.model.toJson();
        }
        function load() {
            myDiagram.model = go.Model.fromJson(document.getElementById("mySavedModel").value);
        }
    </script>

<body onload="init()">
    <h1 class="page-header">Flujo de documentos Area <?php echo $area->nombre ?></h1>
    <ol class="breadcrumb" style="background-color: white;">
        <li><a href="?c=area" style="color:#0016b0;">Area</a></li>
        <li class="active">Flujo de documentos Area <?php echo $area->nombre ?></li>
    </ol>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="#" onclick="Reiniciar()" class="btn btn-outline btn-success" data-toggle="tooltip" data-placement="top" title="Reiniciar Flujo"><i class="fa fa-refresh"></i> Reiniciar flujo</a>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div id="myDiagramDiv" style="border: solid 1px black; width: 100%; height: 400px"></div>
                        </div>
                        <div class="col-md-4">
                            Estados de documentos
                            <div class="dataTable_wrapper" style="overflow-y: scroll; height: 380px">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Nomenglatura</th>
                                        <th>Descripcion</th>
                                        <th>Color</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($estado_documentos as $r): ?>
                                        <tr>
                                            <td><?php echo $r->nombre ?></td>
                                            <td><?php echo $r->nomenglatura ?></td>
                                            <td><?php echo $r->descripcion ?></td>
                                            <td><span class="badge" style="background-color: <?php echo $r->color; ?>"><?php echo $r->color; ?></span></td>
                                        </tr>
                                    <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <form action="?c=area&a=guardar_flujo" method="post" autocomplete="off" onsubmit="return Guardar_Grafo()">
                            <input type="hidden" name="pk" value="<?php echo $area_flujo->pkarea_flujo; ?>">
                            <input type="hidden" name="area_nombre" value="<?php echo $area->nombre; ?>">
                            <textarea id="mySavedModel" style="width:100%;height:300px" class="hidden" name="flujo">
                                <?php echo $area_flujo->flujo ?>
                            </textarea>
                            <br>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-lg" id="guardar"><i class="fa fa-floppy-o"></i> Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    function Guardar_Grafo(){
        $('#guardar').html("<i class='fa fa-spinner fa-spin'></i> Guardando por favor espere");
        $('#guardar').attr("disabled","disabled");
        save();
        return true;
    }

    function Reiniciar(){
        var inicio = '<?php echo $flujo_default; ?>';
        $("#mySavedModel").html(inicio);
        load();
    }
</script>
