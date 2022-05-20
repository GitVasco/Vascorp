<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Evaluacion Activar
        </h1>
    </section>

    <?php

        $modelo = $_GET["modelo"];
        #var_dump($modelo);

        $evaluacion = ControladorEvaluacion::ctrVerEvaluacion($modelo);
        #var_dump($evaluacion)

        $fecha = ControladorEvaluacion::ctrVerFechaDetalle($modelo);
        #var_dump($fecha);

        
        #$detalle = ControladorEvaluacion::ctrVerEvaluacionDetalle($modelo);
        #var_dump($detalle);

    ?>    

    <section class="content">
        <div class="row">
            <div class="col-md-3">

                <div class="box box-primary">
                    <div class="box-body box-profile">

                        <img class="profile-user-img img-responsive img-circle" src="<?php echo $evaluacion["imagen"] ?>"
                            alt="User profile picture">
                        <h3 class="profile-username text-center"><?php echo $evaluacion["modelo"] ?></h3>
                        <p class="text-muted text-center">Prototipo <?php echo $evaluacion["nombre"] ?></p>
                       
                        <div class="box-header with-border">
                        <h3 class="box-title">Datos</h3>
                        </div>

                        <div class="box-body">
                            <strong><i class="fa fa-book margin-r-5"></i> Colores</strong>
                            <p class="text-muted">
                            <?php echo $evaluacion["colores"] ?>
                            </p>
                            <hr>
                            <strong><i class="fa fa-map-marker margin-r-5"></i> Tallas</strong>
                            <p class="text-muted"><?php echo $evaluacion["tallas"] ?></p>
                            <hr>           
                            <strong><i class="fa fa-pencil margin-r-5"></i> Estado</strong>
                            <p>
                            <?php
                            if($evaluacion["estado"] == "APROBADO"){

                                echo '<span class="label label-success">APROBADO</span>';

                            }else if($evaluacion["estado"] == "RECHAZADO"){

                                echo '<span class="label label-danger">RECHAZADO</span>';

                            }else if($evaluacion["estado"] == "PENDIENTE"){

                                echo '<span class="label label-warning">PENDIENTE</span>';
                            }
                            ?>

                            </p>                                         
                        </div>

                    </div>

                </div>

                <div class="box box-primary">
                    <div class="chart">
                        <canvas id="marksChart" width="600" height="600"></canvas>
                    </div>
                </div>

            </div>

            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#timeline" data-toggle="tab">Linea de Tiempo</a></li>
                        <li><a href="#settings" data-toggle="tab">Evaluación</a></li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane" id="timeline">

                            <ul class="timeline timeline-inverse">

                            <?php
                            foreach($fecha as $key => $value){

                                echo '<li class="time-label">
                                    <span class="bg-aqua">
                                        '.$value["dias"].'
                                    </span>
                                </li>';

                                $detalle = ControladorEvaluacion::ctrVerEvaluacionDetalle($modelo, $value["dias"]);

                                foreach($detalle as $key => $value2){

                                    echo '<li>
                                        <i class="'.$value2["icono_area"].' '.$value2["color_area"].'"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-clock-o"></i> '.$value2["hora"].'</span>
                                            <h3 class="timeline-header"><a href="#">'.$value2["nombre_area"].'</a> '.$value2["usuario"].' envio su evaluación</h3>
                                            <div class="timeline-body">
                                                '.$value2["comentario"].'
                                            </div>
                                            <div class="timeline-footer">';

                                                if($value2["pdf"] == null){
                                                    echo '';
                                                }else{
                                                    echo '<a class="btn btn-xs btn-danger margin" href="#" download >
                                                        <i class="fa fa-file-pdf-o"></i>
                                                    </a>';
                                                }

                                                if($value2["excel"] == null){
                                                    echo '';
                                                }else{
                                                    echo '<a class="btn btn-xs btn-success margin" href="#" download >
                                                        <i class="fa fa-file-excel-o"></i>
                                                    </a>';
                                                }

                                                if($value2["imagen"] == null){
                                                    echo '';
                                                }else{
                                                    echo '<a class="btn btn-xs btn-info margin" href="#" download >
                                                        <i class="fa fa-file-image-o"></i>
                                                    </a>'; 
                                                }    
                                                
                                                if($value2["fecha_propuesta"] == null){
                                                    echo '';
                                                }else{
                                                    echo '<a class="btn btn-warning btn-xs margin">'.$value2["fecha_propuesta"].'</a>';
                                                }

                                                if($value2["tipo_evaluacion"] == null){
                                                    echo '';
                                                }else{
                                                    echo '<a class="btn btn-primary btn-xs margin">'.$value2["tipo_evaluacion"].'</a>';
                                                }

                                                if($value2["colores"] == null){
                                                    echo '';
                                                }else{
                                                    echo '<a class="btn bg-navy btn-xs margin">Color: '.$value2["colores"].'</a>';
                                                }
                                            echo '</div>
                                        </div>
                                    </li>';

                                }

                            }

                            ?>

                                 <li>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                            </ul>
                        </div>

                        <div class="active tab-pane" id="settings">
                            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="tipoEvaluacion" class="col-sm-2 control-label">Tipo Evaluación</label>
                                    <div class="col-sm-10">
                                        <select  class="form-control"  name="tipoEvaluacion"  id="tipoEvaluacion" required>
                                            <option value="">Seleccionar</option>
                                            <option value="Nuevo">Nuevo</option>
                                            <option value="Modificar">Modificar</option>
                                            <option value="Desactivar">Desactivar</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nombreUsuario" class="col-sm-2 control-label">Usuario</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" value="<?php echo $_SESSION["nombre"] ?>" readonly>
                                        <input type="hidden"id="modelo" name="modelo" value="<?php echo $_GET['modelo']?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nombreArea" class="col-sm-2 control-label">Área</label>
                                    <div class="col-sm-10">
                                        <select  class="form-control"  name="nombreArea"  id="nombreArea" required>
                                            <option value="">Seleccionar</option>
                                            <option value="Diseño">Diseño</option>
                                            <option value="Logística">Logística</option>
                                            <option value="Producción">Producción</option>
                                            <option value="Costos">Costos</option>
                                            <option value="Ventas">Ventas</option>
                                            <option value="Público">Público</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="colores" class="col-sm-2 control-label">Colores</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="colores" name="colores" placeholder="TODOS">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="evaluacion" class="col-sm-2 control-label">Evaluación</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="evaluacion" name="evaluacion"
                                            placeholder="Evaluación" required></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nota" class="col-sm-2 control-label">Nota</label>
                                    <div class="col-sm-3">
                                        <select  class="form-control"  name="nota"  id="nota" required>
                                            <option value="">Seleccionar</option>
                                            <option value="0">0</option>
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="30">30</option>
                                            <option value="40">40</option>
                                            <option value="50">50</option>
                                            <option value="60">60</option>
                                            <option value="70">70</option>
                                            <option value="80">80</option>
                                            <option value="90">90</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>                                

                                <div class="form-group">
                                    <label for="fechaPropuesta" class="col-sm-2 control-label">Fecha Propuesta</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="fechaPropuesta" name="fechaPropuesta">
                                    </div>
                                </div>                                

                                <div class="form-group">
                                    <label for="pdf" class="col-sm-2 control-label">Ficha Técnica</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="pdf" id="pdf" class="form-control" accept="application/pdf">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="excel" class="col-sm-2 control-label">Excel</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="excel" id="excel" class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                    </div>
                                </div>              
                                
                                <div class="form-group">
                                    <label for="imagen" class="col-sm-2 control-label">Imagen</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
                                    </div>
                                </div>                                 

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </form>

                            <?php

                            $crearEvaluacion = new ControladorEvaluacion();
                            $crearEvaluacion->ctrCrearEvaluaciones();

                            ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@latest/dist/Chart.min.js"></script>
<script>
var marksCanvas = document.getElementById("marksChart");

var marksData = {
    labels: ["Produccion", "Logistica", "Ventas", "Diseño", "Publico", "Costos"],
    datasets: [{
        label: "Minimo",
        backgroundColor: "rgba(200,0,0,0.2)",
        data: [15, 15, 11.3, 11.3, 11.3, 11.3]
    }, {
        label: "Evaluacion",
        backgroundColor: "rgba(0,0,200,0.2)",
        data: [10, 18, 12, 15, 12, 10.5]
    }]
};

var radarChart = new Chart(marksCanvas, {
    type: 'radar',
    data: marksData
});

var chartOptions = {
    scale: {
        ticks: {
            beginAtZero: true,
            min: 0,
            max: 20,
            stepSize: 2
        },
            pointLabels: {
            fontSize: 18
        }
    },
    legend: {
        position: 'top'
    }
};

var radarChart = new Chart(marksCanvas, {
  type: 'radar',
  data: marksData,
  options: chartOptions
});
</script>