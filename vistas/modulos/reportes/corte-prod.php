<?php

/***************************************
 * Meses
 ***************************************/
$nombre_mes = ControladorMovimientos::ctrMesesMov();

$arrayMeses = [];

foreach ($nombre_mes as $key => $value) {
    $mes = $value["nom_mes"];
    $arrayMeses[] = $mes;
}

/***************************************
 * Produccion
 ***************************************/
$produccion_mes = ControladorMovimientos::ctrTotalMesProd();

$arrayProduccion = [];

foreach ($produccion_mes as $value) {
    $arrayProduccion[] = $value["total_mesP"];
}

/***************************************
 * Cortes
 ***************************************/
$corte_mes = ControladorMovimientos::ctrTotalMesCorte();

$arrayCorte = [];

foreach ($corte_mes as $value) {
    $arrayCorte[] = $value["total_mesC"];
}

?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Corte vs Producción</h3>
    </div>
    <div class="box-body">
        <div class="chart">
            <canvas id="corprodChart" style="height:400px"></canvas>
        </div>

        <table class="table table-bordered" style="margin-top: 20px;">
            <thead>
                <tr>
                    <th>Mes</th>
                    <?php
                    foreach ($arrayMeses as $mes) {
                        echo "<th>$mes</th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="background-color: rgba(75,192,192,0.2);">Producción</td>
                    <?php
                    foreach ($arrayProduccion as $produccion) {
                        $produccion = number_format($produccion, 0);
                        echo "<td>$produccion</td>";
                    }
                    ?>
                </tr>
                <tr>
                    <td style="background-color: rgba(255,159,64,0.2);">Corte</td>
                    <?php
                    foreach ($arrayCorte as $corte) {
                        $corte = number_format($corte, 0);
                        echo "<td>$corte</td>";
                    }
                    ?>
                </tr>
            </tbody>
        </table>

    </div>
</div>

<script>
    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#corprodChart').get(0).getContext('2d');

    var areaChartData = {
        labels: [
            <?php
            $conteoM = count($arrayMeses);
            foreach ($arrayMeses as $numeroM => $key) {
                if ($numeroM != $conteoM - 1) {
                    echo "'$key',";
                } else {
                    echo "'$key'";
                }
            }
            ?>
        ],
        datasets: [{
                label: 'Producción',
                backgroundColor: 'rgba(75,192,192,0.2)',
                borderColor: 'rgba(75,192,192,1)',
                pointBackgroundColor: 'rgba(75,192,192,1)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(75,192,192,1)',
                data: [
                    <?php
                    $conteoP = count($arrayProduccion);
                    foreach ($arrayProduccion as $numeroP => $key) {
                        if ($numeroP != $conteoP - 1) {
                            echo "$key,";
                        } else {
                            echo "$key";
                        }
                    }
                    ?>
                ]
            },
            {
                label: 'Corte',
                backgroundColor: 'rgba(255,159,64,0.2)',
                borderColor: 'rgba(255,159,64,1)',
                pointBackgroundColor: 'rgba(255,159,64,1)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(255,159,64,1)',
                data: [
                    <?php
                    $conteoV = count($arrayCorte);
                    foreach ($arrayCorte as $numeroV => $key) {
                        if ($numeroV != $conteoV - 1) {
                            echo "$key,";
                        } else {
                            echo "$key";
                        }
                    }
                    ?>
                ]
            }
        ]
    };

    var areaChartOptions = {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                display: true,
                position: 'top'
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.dataset.label + ' - ' + context.raw;
                    }
                }
            }
        }
    };

    //Create the line chart
    new Chart(areaChartCanvas, {
        type: 'line',
        data: areaChartData,
        options: areaChartOptions
    });
</script>