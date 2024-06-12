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
 * Producción por Taller
 ***************************************/
$produccion_taller = ControladorMovimientos::ctrTotalMesProdTaller(null);

$arrayProduccion = [];
$arrayTalleres = [];

foreach ($produccion_taller as $value) {
    $mes = $value["mes"] - 1; // restamos 1 porque los meses en PHP van de 1 a 12 y en JavaScript de 0 a 11
    $taller = $value["taller"];
    $produccion = $value["produccion"];

    if (!isset($arrayProduccion[$taller])) {
        $arrayProduccion[$taller] = array_fill(0, count($arrayMeses), 0);
    }
    $arrayProduccion[$taller][$mes] = $produccion;
    $arrayTalleres[$taller] = $value["nom_sector"];
}
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Producción Por Taller</h3>
    </div>
    <div class="box-body">

        <div class="chart">
            <canvas id="prodtallerChart" style="height:350px"></canvas>
        </div>

        <div class="form-inline">
            <label for="selectAll">Seleccionar Todos</label>
            <input type="checkbox" id="selectAll" checked>
            <div class="row">
                <?php
                foreach ($arrayTalleres as $taller => $sector) {
                    echo "<div class='col-xs-6 col-sm-4 col-md-3'><label for='sector-$taller'>$sector</label><input type='checkbox' class='sector-checkbox' id='sector-$taller' value='$taller' checked></div>";
                }
                ?>
            </div>
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
            <tbody id="produccionTableBody">
                <?php
                foreach ($arrayProduccion as $taller => $producciones) {
                    echo "<tr class='produccion-row' data-taller='$taller'>";
                    echo "<td>{$arrayTalleres[$taller]}</td>";
                    foreach ($producciones as $produccion) {
                        $produccion = number_format($produccion, 0);
                        echo "<td>$produccion</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    var areaChartCanvas = $('#prodtallerChart').get(0).getContext('2d');

    var areaChartData = {
        labels: <?php echo json_encode($arrayMeses); ?>,
        datasets: []
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

    var areaChart = new Chart(areaChartCanvas, {
        type: 'line',
        data: areaChartData,
        options: areaChartOptions
    });

    var colors = [
        'rgba(75,192,192,0.2)',
        'rgba(255,159,64,0.2)',
        'rgba(153,102,255,0.2)',
        'rgba(255,205,86,0.2)'
    ];
    var borderColors = [
        'rgba(75,192,192,1)',
        'rgba(255,159,64,1)',
        'rgba(153,102,255,1)',
        'rgba(255,205,86,1)'
    ];

    function updateChart() {
        var selectedSectors = $('.sector-checkbox:checked').map(function() {
            return this.value;
        }).get();

        areaChart.data.datasets = [];

        var index = 0;
        <?php foreach ($arrayProduccion as $taller => $producciones) : ?>
            if (selectedSectors.includes('<?php echo $taller; ?>')) {
                var color = colors[index % colors.length];
                var borderColor = borderColors[index % borderColors.length];
                areaChart.data.datasets.push({
                    label: '<?php echo $arrayTalleres[$taller]; ?>',
                    backgroundColor: color,
                    borderColor: borderColor,
                    pointBackgroundColor: borderColor,
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: borderColor,
                    data: <?php echo json_encode(array_values($producciones)); ?>
                });
                index++;
            }
        <?php endforeach; ?>

        areaChart.update();
    }

    function updateTable() {
        var selectedSectors = $('.sector-checkbox:checked').map(function() {
            return this.value;
        }).get();

        $('.produccion-row').each(function() {
            var taller = $(this).data('taller');
            if (selectedSectors.includes(taller)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    $(document).ready(function() {
        $('.sector-checkbox').on('change', function() {
            updateChart();
            updateTable();
        });

        $('#selectAll').on('change', function() {
            var checked = this.checked;
            $('.sector-checkbox').prop('checked', checked);
            updateChart();
            updateTable();
        });

        updateChart();
    });
</script>