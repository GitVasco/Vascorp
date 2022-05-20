<?php

    if(isset($_GET["modelo"])){
        $modelo = $_GET["modelo"];
    }else{

        $modelo = null;
    }
    
    #var_dump($modelo);

    $movimientos = ControladorMovimientos::ctrModelosMovimientos($modelo);
    #var_dump("movimiento", $movimientos); 

    $arrayMeses = array();
    $arrayCantidad = array();
    foreach($movimientos as $key => $value){
    
        $fecha = $value["nom_mes"];
        array_push($arrayMeses, $fecha);

        $cantidad = $value["cantidad"];
        array_push($arrayCantidad, $cantidad);

    }

    #var_dump($arrayCantidad);

?>

<div class="box box-primary">

    <div class="box-header with-border">

        <h3 class="box-title">Movimiento por Modelo</h3>
        <select name="ModelMov" id="ModelMov" class="form-control input-lg selectpicker" data-live-search="true" data-size="10">
        <option value="">--------Seleccionar modelo-------</option>
        <?php 
        $item=null;
        $valor=null;

        $modelo =ControladorModelos::ctrMostrarModelosActivos($item,$valor);
        foreach ($modelo as $key => $value) {
            echo '<option value="'.$value["modelo"].'">'. $value["nombre"].'</option>';
        }
        ?>
    </select>
    </div>

    <div class="box-body">

        <div class="chart">
        <canvas id="grafica" style="height:500px"></canvas>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@latest/dist/Chart.min.js"></script>
<script>

    const URLactual = window.location.search;

    const urlParamsM = new URLSearchParams(URLactual);

    var modelo = urlParamsM.get('modelo');
    //console.log(modelo);

    if(modelo === null){
        var titulo= "10197";
    }else{
        var titulo = modelo;
    }

    // Obtener una referencia al elemento canvas del DOM
    const $grafica = document.querySelector("#grafica");
    // Las etiquetas son las que van en el eje X. 
    const etiquetas = [

        <?php

            $conteoMes = count($arrayMeses);
            foreach($arrayMeses as $key => $value){

                if($key != $conteoMes-1){

                    echo "'$value',";
    
                }else{

                    echo "'$value'";

                }

            }

        ?>

    ]
    // Podemos tener varios conjuntos de datos. Comencemos con uno
    const datosVentas2020 = {
        label: "Ventas por mes " + titulo,
        data: [

        <?php

            $conteoMes = count($arrayCantidad);
            foreach($arrayCantidad as $key => $value){

                if($key != $conteoMes-1){

                    echo "$value,";
    
                }else{

                    echo "$value";

                }

            }

        ?>
    
    
    ], // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
        backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
        borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
        borderWidth: 1,// Ancho del borde
    };
    new Chart($grafica, {
        type: 'line',// Tipo de gráfica
        data: {
            labels: etiquetas,
            datasets: [
                datosVentas2020,
                // Aquí más datos...
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
            },
        }
    });
</script>