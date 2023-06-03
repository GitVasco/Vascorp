<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Costos por Modelo - 2022

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Costos por Modelo</li>

        </ol>

    </section>

    <?php

    function quantile($array, $quantile)
    {
        sort($array);
        $index = $quantile * (count($array) - 1);

        $lower = floor($index);
        $upper = ceil($index);
        $weight = $index - $lower;

        if ($lower == $upper) {
            return $array[$lower];
        } else {
            return (1 - $weight) * $array[$lower] + $weight * $array[$upper];
        }
    }

    $codigo = isset($_GET["modelo"]) ? $_GET["modelo"] : null;
    $tc = 3.8;

    $modelos  = file_get_contents("vistas/json/modelos.json");
    $dataModelos = json_decode($modelos, true);

    $modelo = null;
    $nombre = null;
    $imagen = null;
    foreach ($dataModelos as $item) {
        if ($item['modelo'] == $codigo) {
            $nombre = $item['nombre'];
            $modelo = $item['modelo'];
            $imagen = $item['imagen'];
            $costo = $item['costo_total'];
            $precio = $item['precio_venta'];
            $utilidad = $item['utilidad'];
            $mpprincipal = $item['mp_principal'];
            $mpd = $item['materia_prima_directa'];
            $mod = $item['mano_obra_directa'];
            $cif = $item['cif'];
            $cf = $item['costos_fijos'];
            break;
        }
    }

    $costos = [0, 0, 0, 0]; // Valores predeterminados

    if (isset($_GET["modelo"])) {

        // Busca el modelo con el código proporcionado en $_GET["modelo"]
        foreach ($dataModelos as $item) {
            if ($item['modelo'] == $_GET["modelo"]) {

                $costos = [
                    $item['materia_prima_directa'],
                    $item['mano_obra_directa'],
                    $item['cif'],
                    $item['costos_fijos']
                ];
                break;
            }
        }
    }

    //*

    // Cargar y decodificar los archivos JSON
    $modelo_data = json_decode(file_get_contents('vistas/json/tarjetas.json'), true);
    $precios_data = json_decode(file_get_contents('vistas/json/materiaprima.json'), true);

    if (isset($_GET["modelo"])) {
        // Selección del modelo
        $modelo_seleccionado = $codigo;
        $codigos_materia_prima = array_column($modelo_data[$modelo_seleccionado], 'materia_prima');

        // Mapear los precios a los códigos de materia prima
        // Mapear los precios a los códigos de materia prima
        $precios_mapeados = ['TEL' => [], 'SES' => [], 'BLO' => [], 'ELA' => []];
        $prefijos = array_keys($precios_mapeados);
        foreach ($precios_data as $precio) {
            foreach ($prefijos as $prefijo) {
                if (in_array($precio['Código_MP'], $codigos_materia_prima) && strpos($precio['Código_MP'], $prefijo) === 0) {
                    // Si la moneda es $, multiplicar el precio por $tc
                    if ($precio['Mon'] === '$') {
                        foreach (['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'setiembre', 'octubre', 'noviembre', 'diciembre'] as $mes) {
                            $precio[$mes] *= $tc;
                        }
                    }
                    $precios_mapeados[$prefijo][$precio['Código_MP']] = $precio;
                    break; // Si se encuentra una coincidencia, pasa a la siguiente entrada de precio
                }
            }
        }

        // Pasar datos a JavaScript
        echo '<script>';
        echo 'let precios_mapeados_linea  = ' . json_encode($precios_mapeados) . ';';
        echo 'console.log("🚀 ~ file: costos-modelo.php:116 ~ precios_mapeados_linea:", precios_mapeados_linea)';
        echo '</script>';
    }



    ?>


    <section class="content">

        <div class="row">

            <div class="col-md-2">

                <!-- LISTA DE MODELO -->
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-body box-profile">

                            <ul class="list-group">

                                <?php foreach ($dataModelos as $key => $value) : ?>

                                    <li class="active">
                                        <a href="index.php?ruta=costos-modelo&modelo=<?php echo $value['modelo']; ?>">
                                            <h3><?php echo "{$value["modelo"]}-{$value["nombre"]}" ?></h3>
                                        </a>
                                    </li>

                                <?php endforeach ?>

                            </ul>

                        </div>

                    </div>
                </div>

            </div>

            <div class="col-md-10">

                <?php

                $jsonVentas = file_get_contents("vistas/json/ventas.json");
                $data = json_decode($jsonVentas, true);

                $totalVentas = null;
                foreach ($data as $item) {
                    if ($item['modelo'] == $codigo) {
                        $totalVentas = $item['TOTAL'];
                        break;
                    }
                }

                $jsonPrducccion = file_get_contents("vistas/json/produccion.json");
                $data = json_decode($jsonPrducccion, true);

                $totalProduccion = null;
                foreach ($data as $item) {
                    if ($item['modelo'] == $codigo) {
                        $totalProduccion = $item['TOTAL'];
                        break;
                    }
                }

                if (isset($_GET["modelo"])) : ?>

                    <div class="col-md-12 row">

                        <!-- PERFIL DE MODELO -->
                        <div class="col-md-4">
                            <div class="box box-primary">
                                <div class="box-body box-profile">
                                    <img class="profile-user-img img-responsive img-circle" src="<?php echo $imagen; ?>" alt="User profile picture">
                                    <h3 class="profile-username text-center"><?php echo $nombre; ?></h3>
                                    <p class="text-muted text-center"><?php echo $modelo; ?></p>
                                    <ul class="list-group list-group-unbordered">
                                        <li class="list-group-item">
                                            <b>Materia Prima Principal</b> <a class="pull-right"><?php echo $mpprincipal; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Und. Producidas 2022</b> <a class="pull-right"><?php echo $totalProduccion; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Und. Vendidas 2022</b> <a class="pull-right"><?php echo $totalVentas; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Costo 2022 S/</b> <a class="pull-right"><?php echo round($costo, 2); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Precio 2022 S/</b> <a class="pull-right"><?php echo round($precio, 2); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Utilidad 2022 %</b> <a class="pull-right"><?php echo round($utilidad * 100, 0); ?></a>
                                        </li>
                                    </ul>
                                    <br>

                                    <h3 class="box-title">Resumen de Costos</h3>
                                    <div class="box-body no-padding">
                                        <table class="table table-striped">
                                            <tr>
                                                <th>Concepto</th>
                                                <th>Costo</th>
                                                <th style="width: 40px">Participación</th>
                                            </tr>
                                            <tr>
                                                <td>Materia Prima Directa</td>
                                                <td>S/ <b><?php echo $mpd ?></b></td>
                                                <td align='center'><span class="badge bg-red"><?php echo round($mpd / $costo * 100, 0) ?> %</span></td>
                                            </tr>

                                            <tr>
                                                <td>Mano de Obra Directa</td>
                                                <td>S/ <b><?php echo $mod ?></b></td>
                                                <td align='center'><span class="badge bg-green"><?php echo round($mod / $costo * 100, 0) ?> %</span></td>
                                            </tr>

                                            <tr>
                                                <td>Costos Indirectos de Fabricación</td>
                                                <td>S/ <b><?php echo $cif ?></b></td>
                                                <td align='center'><span class="badge bg-purple"><?php echo round($cif / $costo * 100, 0) ?> %</span></td>
                                            </tr>

                                            <tr>
                                                <td>Costos Fijos</td>
                                                <td>S/ <b><?php echo $cf ?></b></td>
                                                <td align='center'><span class="badge bg-yellow"><?php echo round($cf / $costo * 100, 0) ?> %</span></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <br>

                                    <canvas id="radarChart" width="400" height="400"></canvas>
                                </div>

                            </div>
                        </div>

                        <!-- TARJETA -->

                        <div class="col-md-8">
                            <div class="box box-primary">
                                <h3 class="box-title">TARJETA</h3>
                                <?php
                                // Leemos el archivo JSON
                                $json = file_get_contents('vistas/json/tarjetas.json');

                                // Decodificamos el JSON a un array asociativo en PHP
                                $data = json_decode($json, true);

                                $items = $data[$codigo];

                                // Ahora, puedes usar el array $data para generar las filas de tu tabla.
                                ?>
                                <div class="box-body no-padding">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>Cod. MP</th>
                                            <th>Materia Prima</th>
                                            <th>Unidad</th>
                                            <th>Moneda</th>
                                            <th>Precio</th>
                                            <th>Consumo</th>
                                            <th>Costo Primo</th>
                                            <th style="width: 40px">Participación</th>
                                        </tr>
                                        <?php
                                        $percentages = array();
                                        foreach ($items as $item) {
                                            $precio = $item["moneda"] == "$" ? $item["precio"] * $tc : $item["precio"];
                                            $costoPrimo =  $precio * $item["consumo"];
                                            $participacion = ($costoPrimo / $costo) * 100;
                                            array_push($percentages, $participacion);
                                        }

                                        $q1 = quantile($percentages, 0.25);
                                        $q2 = quantile($percentages, 0.5);
                                        $q3 = quantile($percentages, 0.75);

                                        foreach ($items as $item) : ?>
                                            <tr>
                                                <td><?php echo $item["materia_prima"] ?></td>
                                                <td><b><?php echo $item["descripcion"] ?></b></td>
                                                <td><?php echo $item["unidad"] ?></td>
                                                <td><?php echo $item["moneda"] ?></td>
                                                <td align='right'><?php echo round($item["precio"], 4) ?></td>
                                                <td align='right'><?php echo round($item["consumo"], 4) ?></td>
                                                <?php

                                                $precio = $item["moneda"] == "$" ? $item["precio"] * $tc : $item["precio"];

                                                $costoPrimo =  $precio * $item["consumo"];
                                                $participacion = ($costoPrimo / $costo) * 100; // Recalculate participation for this item.

                                                ?>
                                                <td align='right'><?php echo round($costoPrimo, 4) ?></td>

                                                <?php
                                                echo "<td align='right'><span class='badge ";
                                                if ($participacion <= $q1) {
                                                    echo "bg-green";
                                                } elseif ($participacion <= $q2) {
                                                    echo "bg-blue";
                                                } elseif ($participacion <= $q3) {
                                                    echo "bg-yellow";
                                                } else {
                                                    echo "bg-red";
                                                }
                                                echo "'>" . number_format($participacion, 2) . "%</span></td>";
                                                ?>

                                            </tr>
                                        <?php endforeach ?>

                                    </table>

                                </div>
                            </div>
                        </div>

                        <!-- OPERACIONES -->

                        <div class="col-md-8">
                            <div class="box box-primary">
                                <h4 class="box-title">Linea de Tiempo por Tipo de Materia Prima</h4>
                                <canvas id="lineaChartTEL" width="400" height="75"></canvas>
                                <canvas id="lineaChartSES" width="400" height="75"></canvas>
                                <canvas id="lineaChartBLO" width="400" height="75"></canvas>
                                <canvas id="lineaChartELA" width="400" height="75"></canvas>

                            </div>
                        </div>

                    </div>

                <?php endif ?>
            </div>



        </div>

    </section>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    window.document.title = "Costos x Modelo";

    //* POLAR
    var ctxPolar = document.getElementById('radarChart');

    var dataPolar = <?php echo json_encode($costos); ?>;

    var myPolarChart = new Chart(ctxPolar, {
        type: 'polarArea',
        data: {
            labels: ['MP Directa', 'MO Directa', 'CIF', 'Costos Fijos'],
            datasets: [{
                label: 'Costos',
                data: dataPolar,
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

    //* linea

    //* linea
    let labels_linea = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'setiembre', 'octubre', 'noviembre', 'diciembre'];

    for (let prefijo in precios_mapeados_linea) {
        let datasets_linea = [];

        // Crear un dataset para cada código de materia prima
        for (let codigo in precios_mapeados_linea[prefijo]) {
            let dataset = {
                label: codigo,
                data: [],
                fill: false,
                borderColor: '#' + Math.floor(Math.random() * 16777215).toString(16), // color aleatorio
                tension: 0.1
            };

            // Rellenar el dataset con los precios de cada mes
            for (let label of labels_linea) {
                dataset.data.push(precios_mapeados_linea[prefijo][codigo][label]);
            }

            datasets_linea.push(dataset);
        }

        let ctx_linea = document.getElementById(`lineaChart${prefijo}`).getContext('2d');

        new Chart(ctx_linea, {
            type: 'line',
            data: {
                labels: labels_linea,
                datasets: datasets_linea
            },
            options: {
                responsive: true
            }
        });
    }
</script>