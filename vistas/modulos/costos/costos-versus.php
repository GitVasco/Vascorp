<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Comparación de Costos - 2022

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Costos por Modelo</li>

        </ol>

    </section>


    <?php
    $codigo = isset($_GET["modelo"]) ? $_GET["modelo"] : null;
    $tc = 3.8;

    $modelos  = file_get_contents("vistas/json/modelos.json");
    $dataModelos = json_decode($modelos, true);

    if (isset($_GET["modeloA"]) && isset($_GET["modeloB"])) {
        $modelos = ['A' => $_GET["modeloA"], 'B' => $_GET["modeloB"]];
        $datos = [];
        $jsonFiles = ['ventas.json', 'produccion.json'];
        $costos = ['A' => [0, 0, 0, 0], 'B' => [0, 0, 0, 0]];
        $meses = ['ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', 'DIC'];

        foreach ($modelos as $key => $modelo) {
            foreach ($dataModelos as $item) {
                if ($item['modelo'] == $modelo) {
                    $datos['nombre' . $key] = $item['nombre'];
                    $datos['modelo' . $key] = $item['modelo'];
                    $datos['imagen' . $key] = $item['imagen'];
                    $datos['costo' . $key] = $item['costo_total'];
                    $datos['precio' . $key] = $item['precio_venta'];
                    $datos['utilidad' . $key] = $item['utilidad'];
                    $datos['mpprincipal' . $key] = $item['mp_principal'];
                    $datos['mpd' . $key] = $item['materia_prima_directa'];
                    $datos['mod' . $key] = $item['mano_obra_directa'];
                    $datos['cif' . $key] = $item['cif'];
                    $datos['cf' . $key] = $item['costos_fijos'];

                    $costos[$key] = [
                        $item['materia_prima_directa'],
                        $item['mano_obra_directa'],
                        $item['cif'],
                        $item['costos_fijos']
                    ];
                    break;

                    break;
                }
            }

            foreach ($jsonFiles as $file) {
                $jsonContent = file_get_contents("vistas/json/" . $file);
                $data = json_decode($jsonContent, true);
                $totalKey = str_replace('.json', '', $file);
                $datos['total' . ucfirst($totalKey) . $key] = null;
                $datos[$totalKey . $key] = [];

                foreach ($data as $item) {
                    if ($item['modelo'] == $modelo) {
                        $datos['total' . ucfirst($totalKey) . $key] = $item['TOTAL'];
                        foreach ($meses as $mes) {
                            $datos[$totalKey . $key][$mes] = $item[$mes];
                        }
                        break;
                    }
                }
            }
        }
    }
    ?>

    <section class="content">

        <div class="row">

            <div class="col-md-2">

                <!-- LISTA DE MODELO -->
                <div class="col-md-12">

                    <div class="box box-primary">

                        <div class="box-header with-border">

                            <div class="form-group">
                                <label>Modelo A</label>
                                <select class="form-control" id="modeloA">

                                    <option value="">Seleccione Modelo A</option>

                                    <?php foreach ($dataModelos as $modeloA) : ?>

                                        <option value="<?= $modeloA["modelo"] ?>"><?= $modeloA["modelo"] . ' - ' . $modeloA["nombre"] ?></option>

                                    <?php endforeach ?>

                                </select>
                            </div>

                            <div class="form-group">
                                <label>Modelo B</label>
                                <select class="form-control" id="modeloB">
                                    <option value="">Seleccione Modelo B</option>

                                    <?php foreach ($dataModelos as $modeloB) : ?>

                                        <option value="<?= $modeloB["modelo"] ?>"><?= $modeloB["modelo"] . ' - ' . $modeloB["nombre"] ?></option>

                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">

                                <button type="button" class="btn btn-primary" id="btnComparar">Comparar</button>

                            </div>

                        </div>


                    </div>
                </div>

            </div>

            <?php if (isset($_GET["modeloA"])) : ?>

                <!-- Modelo A y Modelo B -->
                <div class="col-md-6">

                    <!-- Modelo A -->
                    <div class="col-md-12">

                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-body box-profile">
                                    <img class="profile-user-img img-responsive img-circle" src="<?php echo $datos["imagenA"]; ?>" alt="User profile picture">
                                    <h3 class="profile-username text-center"><?php echo $datos["nombreA"]; ?></h3>
                                    <p class="text-muted text-center"><?php echo $datos["modeloA"]; ?></p>
                                    <ul class="list-group list-group-unbordered">
                                        <li class="list-group-item">
                                            <b>Materia Prima Principal</b> <a class="pull-right"><?php echo $datos["mpprincipalA"]; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Und. Producidas 2022</b> <a class="pull-right"><?php echo $datos["totalProduccionA"]; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Und. Vendidas 2022</b> <a class="pull-right"><?php echo $datos["totalVentasA"]; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Costo 2022 S/</b> <a class="pull-right"><?php echo round($datos["costoA"], 2); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Precio 2022 S/</b> <a class="pull-right"><?php echo round($datos["precioA"], 2); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Utilidad 2022 %</b> <a class="pull-right"><?php echo round($datos["utilidadA"] * 100, 0); ?></a>
                                        </li>
                                    </ul>
                                    <br>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="box box-primary">
                                <h3 class="box-title">Resumen de Costos Modelo A</h3>
                                <div class="box-body no-padding">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>Concepto</th>
                                            <th>Costo</th>
                                            <th style="width: 40px">Participación</th>
                                        </tr>
                                        <tr>
                                            <td>Materia Prima Directa</td>
                                            <td>S/ <b><?php echo $datos["mpdA"] ?></b></td>
                                            <td align='center'><span class="badge bg-red"><?php echo round($datos["mpdA"] / $datos["costoA"] * 100, 0) ?> %</span></td>
                                        </tr>

                                        <tr>
                                            <td>Mano de Obra Directa</td>
                                            <td>S/ <b><?php echo $datos["modA"] ?></b></td>
                                            <td align='center'><span class="badge bg-green"><?php echo round($datos["modA"] / $datos["costoA"] * 100, 0) ?> %</span></td>
                                        </tr>

                                        <tr>
                                            <td>Costos Indirectos de Fabricación</td>
                                            <td>S/ <b><?php echo $datos["cifA"] ?></b></td>
                                            <td align='center'><span class="badge bg-purple"><?php echo round($datos["cifA"] / $datos["costoA"] * 100, 0) ?> %</span></td>
                                        </tr>

                                        <tr>
                                            <td>Costos Fijos</td>
                                            <td>S/ <b><?php echo $datos["cfA"] ?></b></td>
                                            <td align='center'><span class="badge bg-yellow"><?php echo round($datos["cfA"] / $datos["costoA"] * 100, 0) ?> %</span></td>
                                        </tr>
                                    </table>

                                    <div style="display: flex; justify-content: center; align-items: center;">
                                        <div style="width: 300px; height: 300px;">
                                            <canvas id="radarChartA"></canvas>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">

                        <!-- Modelo B -->
                        <div class="col-md-6">
                            <div class="box box-warning">
                                <div class="box-body box-profile">
                                    <img class="profile-user-img img-responsive img-circle" src="<?php echo $datos["imagenB"]; ?>" alt="User profile picture">
                                    <h3 class="profile-username text-center"><?php echo $datos["nombreB"]; ?></h3>
                                    <p class="text-muted text-center"><?php echo $datos["modeloB"]; ?></p>
                                    <ul class="list-group list-group-unbordered">
                                        <li class="list-group-item">
                                            <b>Materia Prima Principal</b> <a class="pull-right"><?php echo $datos["mpprincipalB"]; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Und. Producidas 2022</b> <a class="pull-right"><?php echo $datos["totalProduccionB"]; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Und. Vendidas 2022</b> <a class="pull-right"><?php echo $datos["totalVentasB"]; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Costo 2022 S/</b> <a class="pull-right"><?php echo round($datos["costoB"], 2); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Precio 2022 S/</b> <a class="pull-right"><?php echo round($datos["precioB"], 2); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Utilidad 2022 %</b> <a class="pull-right"><?php echo round($datos["utilidadB"] * 100, 0); ?></a>
                                        </li>
                                    </ul>
                                    <br>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="box box-warning">
                                <h3 class="box-title">Resumen de Costos Modelo B</h3>
                                <div class="box-body no-padding">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>Concepto</th>
                                            <th>Costo</th>
                                            <th style="width: 40px">Participación</th>
                                        </tr>
                                        <tr>
                                            <td>Materia Prima Directa</td>
                                            <td>S/ <b><?php echo $datos["mpdB"] ?></b></td>
                                            <td align='center'><span class="badge bg-red"><?php echo round($datos["mpdB"] / $datos["costoB"] * 100, 0) ?> %</span></td>
                                        </tr>

                                        <tr>
                                            <td>Mano de Obra Directa</td>
                                            <td>S/ <b><?php echo $datos["modB"] ?></b></td>
                                            <td align='center'><span class="badge bg-green"><?php echo round($datos["modB"] / $datos["costoB"] * 100, 0) ?> %</span></td>
                                        </tr>

                                        <tr>
                                            <td>Costos Indirectos de Fabricación</td>
                                            <td>S/ <b><?php echo $datos["cifB"] ?></b></td>
                                            <td align='center'><span class="badge bg-purple"><?php echo round($datos["cifB"] / $datos["costoB"] * 100, 0) ?> %</span></td>
                                        </tr>

                                        <tr>
                                            <td>Costos Fijos</td>
                                            <td>S/ <b><?php echo $datos["cfB"] ?></b></td>
                                            <td align='center'><span class="badge bg-yellow"><?php echo round($datos["cfB"] / $datos["costoB"] * 100, 0) ?> %</span></td>
                                        </tr>
                                    </table>
                                    <div style="display: flex; justify-content: center; align-items: center;">
                                        <div style="width: 300px; height: 300px;">
                                            <canvas id="radarChartB"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ventas y Produccion -->
                <div class="col-md-4">
                    <div class="col-md-12">
                        <div class="box box-success">
                            <h3 class="box-title">Comparación de Ventas 2022: Modelo A vs Modelo B</h3>
                            <div style="display: flex; justify-content: center; align-items: center;">
                                <div style="width: 800px; height: 430px;">
                                    <canvas id="ventasChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="box box-success">
                            <h3 class="box-title">Comparación de Producción 2022: Modelo A vs Modelo B</h3>
                            <div style="display: flex; justify-content: center; align-items: center;">
                                <div style="width: 800px; height: 430px;">
                                    <canvas id="produccionChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>

        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    window.document.title = "Versus";

    //* Primero los modelo
    $("#btnComparar").click(function() {
        const modeloA = document.getElementById("modeloA").value;
        const modeloB = document.getElementById("modeloB").value;

        if (modeloA != "" && modeloB != "") {

            window.location = "index.php?ruta=costos-versus&modeloA=" + modeloA + "&modeloB=" + modeloB;
        } else {
            window.location = "costos-versus"
        }

    })
</script>

<script>
    var ctxPolarA = document.getElementById('radarChartA');
    var dataPolarA = <?php echo json_encode($costos['A']); ?>;

    var myPolarChartA = new Chart(ctxPolarA, {
        type: 'polarArea',
        data: {
            labels: ['MP Directa', 'MO Directa', 'CIF', 'Costos Fijos'],
            datasets: [{
                label: 'Costos',
                data: dataPolarA,
                backgroundColor: [
                    'rgba(255, 0, 0, 0.2)',
                    'rgba(0, 255, 0, 0.2)',
                    'rgba(0, 0, 255, 0.2)',
                    'rgba(255, 255, 0, 0.2)'
                ],
                borderColor: [
                    'red',
                    'green',
                    'blue',
                    'yellow'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                r: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<script>
    var ctxPolarB = document.getElementById('radarChartB');
    var dataPolarB = <?php echo json_encode($costos['B']); ?>;

    var myPolarChartB = new Chart(ctxPolarB, {
        type: 'polarArea',
        data: {
            labels: ['MP Directa', 'MO Directa', 'CIF', 'Costos Fijos'],
            datasets: [{
                label: 'Costos',
                data: dataPolarB,
                backgroundColor: [
                    'rgba(255, 0, 0, 0.2)',
                    'rgba(0, 255, 0, 0.2)',
                    'rgba(0, 0, 255, 0.2)',
                    'rgba(255, 255, 0, 0.2)'
                ],
                borderColor: [
                    'red',
                    'green',
                    'blue',
                    'yellow'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                r: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<script>
    var ctxVentas = document.getElementById('ventasChart').getContext('2d');
    var dataVentasA = <?php echo json_encode($datos['ventasA']); ?>;
    console.log("🚀 ~ file: costos-versus.php:420 ~ dataVentasA:", dataVentasA)
    var dataVentasB = <?php echo json_encode($datos['ventasB']); ?>;

    var ventasChart = new Chart(ctxVentas, {
        type: 'line',
        data: {
            labels: Object.keys(dataVentasA),
            datasets: [{
                label: 'Ventas Modelo A',
                data: Object.values(dataVentasA),
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }, {
                label: 'Ventas Modelo B',
                data: Object.values(dataVentasB),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var ctxProduccion = document.getElementById('produccionChart').getContext('2d');
    var dataProduccionA = <?php echo json_encode($datos['produccionA']); ?>;
    var dataProduccionB = <?php echo json_encode($datos['produccionB']); ?>;

    var produccionChart = new Chart(ctxProduccion, {
        type: 'line',
        data: {
            labels: Object.keys(dataProduccionA),
            datasets: [{
                label: 'Producción Modelo A',
                data: Object.values(dataProduccionA),
                backgroundColor: 'rgba(255, 159, 64, 0.2)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1
            }, {
                label: 'Producción Modelo B',
                data: Object.values(dataProduccionB),
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>