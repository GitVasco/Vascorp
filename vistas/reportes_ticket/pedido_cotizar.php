<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="css/ticket_v2.css" target="_blank" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- <body onload="window.print();"> -->
    <?php

    require_once "../../controladores/pedidos.controlador.php";
    require_once "../../modelos/pedidos.modelo.php";

    /* 
    todo: traemos todos lso datos para el ticket
    */
    $codigo = $_GET["codigo"];
    //var_dump($codigo);

    $respuesta = ControladorPedidos::ctrPedidoImpresionCab($codigo);
    echo '<pre>';
    print_r($respuesta);
    echo '</pre>';
    //var_dump($respuesta["pedido"]);
    #var_dump($respuesta);
    $moneda = $respuesta["lista"] == "precio1" ? " $ " : " S/ ";

    $totales = ControladorPedidos::ctrPedidoImpresionTotales($codigo);
    //var_dump($totales);

    $pedidos = controladorPedidos::ctrMostraPedidosCabecera($codigo);

    $modelos = controladorPedidos::ctrMostrarCotizacion($codigo);
    #var_dump($modelos);

    date_default_timezone_set("America/Lima");

    //var_dump($respuesta["fecha"]);

    $originalDate = $respuesta["fecha"];
    $newDate = date("d/m/Y", strtotime($originalDate));
    //var_dump($newDate);

    //*Construir hojas
    $ini = 0;
    $fin = 1000;

    $articulos = ControladorPedidos::ctrPedidoImpresionB($codigo, $ini, $fin);
    $cantidadArticulos = count($articulos);
    #var_dump(count($articulos));

    ?>
    <div class="zona_impresion">
        <!-- codigo imprimir -->

        <?php

        echo ' <table border="0" align="left" width="900px">

                        <thead>
                    
                            <tr>
                        
                                <th style="text-align:left;" colspan="11">CORPORACION VASCO S.A.C.</th>
                        
                            </tr>
                        
                            <tr>
                        
                                <th style="width:10%;text-align:left;">Nro. PEDIDO</th>
                                <td style="width:20%">' . $respuesta["pedido"] . '</td>
                                <th colspan="6"></th>
                                <th style="width:6%;text-align:left;">FECHA</th>
                                <td colspan="2">' . $newDate . '</td>
                        
                            </tr>
                        
                            <tr>
                        
                                <th style="width:10%;text-align:left;">CLIENTE:</th>
                                <td colspan="4">' . $respuesta["nombre"] . '</td>
                                <th colspan="2"></th>
                                <th style="width:6%">Cod:</th>
                                <td colspan="2">' . $respuesta["codigo"] . '</td>
                                <th style="width:6%"></th>
                        
                            </tr>
                        
                            <tr>
                        
                                <th style="width:10%;text-align:left;">DIRECCIÓN:</th>
                                <td colspan="10">' . $respuesta["direccion"] . '</td>
                        
                            </tr>
                        
                            <tr>
                        
                                <th style="width:10%"></th>
                                <td colspan="6">' . $respuesta["nom_ubi"] . '</td>
                                <th style="width:10%;text-align:left;" colspan="2">' . $respuesta["ubigeo"] . '</th>
                                <th style="width:6%"></th>
                                <th style="width:6%"></th>
                        
                            </tr>
                        
                            <tr>
                        
                                <th style="width:10%;text-align:left;">VENDEDOR</th>
                                <td style="width:20%">' . $respuesta["vendedor"] . '</td>
                                <th style="width:6%;text-align:left;">' . $respuesta["tipo_doc"] . '</th>
                                <td colspan="2">' . $respuesta["documento"] . '</td>
                                <th style="width:50%">' . $respuesta["nom_agencia"] . '</th>
                                <th style="width:1%"></th>
                                <th style="width:1%"></th>
                                <th style="width:1%"></th>
                                <th style="width:1%"></th>
                        
                            </tr>
                        
                            <tr>
                        
                                <th style="width:10%"></th>
                                <th style="width:20%"></th>
                                <th style="width:6%"></th>
                                <th style="width:6%"></th>
                                <th style="width:6%"></th>
                                <th style="width:6%"></th>
                                <th style="width:6%"></th>
                                <th style="width:6%"></th>
                                <th style="width:6%"></th>
                                <th style="width:6%"></th>
                                <th style="width:6%"></th>
                        
                            </tr>
                    
                        </thead>
                    
                </table>';

        echo '<table border="1" align="left" width="900px">

                <thead>
                    <tr></tr>

                    <tr>

                        <th style="width:10%">MODELO</th>
                        <th style="width:30%;text-align:left;">DESCRIPCIÓN</th>
                        <th style="width:10%;text-align:center;">P/U</th>
                        <th style="width:10%;text-align:center;">CANTIDAD</th>
                        <th style="width:10%;text-align:center;">NETO</th>
                        <th style="width:10%;text-align:center;">IGV</th>
                        <th style="width:10%;text-align:center;">TOTAL</th>

                        
                    </tr>
            
                </thead>
        
            </table>';

        echo '<table border="1" align="left" width="900px">';

        foreach ($modelos as $key => $value) {
            $igv = $value["igv"];
            $total = $value["total"];

            if ($moneda == " $ ") {
                $igv = 0;
                $total = $value["neto"];
            }

            echo '<tr>
                <td style="width:10%;text-align:left;">' . $value["modelo"] . '</td>
                <td style="width:30%;text-align:left;">' . $value["nombre"] . '</td>
                <td style="width:10%;text-align:center;">' . number_format($value["precio"], 2) . '</td>
                <td style="width:10%;text-align:center;">' . $value["cantidad"] . '</td>
                <td style="width:10%;text-align:right;">' . $moneda . ' ' . number_format($value["neto"], 2) . '</td>
                <td style="width:10%;text-align:right;">' . $moneda . ' ' . number_format($igv, 2) . '</td>
                <td style="width:10%;text-align:right;">' . $moneda . ' ' . number_format($total, 2) . '</td>
            </tr>';
        }

        echo '</table>';

        echo '<table border="1" align="left" width="900px">

                <thead>
                <tr></tr>

                <tr>

                    <th style="width:10%"></th>
                    <th style="width:30%;text-align:left;"></th>
                    <th style="width:10%;text-align:center;"></th>
                    <th style="width:10%;text-align:center;"></th>
                    <th style="width:10%;text-align:right;">' . $moneda . ' ' . number_format($respuesta["op_gravada"], 2) . '</th>
                    <th style="width:10%;text-align:right;">' . ($moneda == " $ " ? " $ 0.00" : $moneda . ' ' . number_format($respuesta["igv"], 2)) . '</th>
                    <th style="width:10%;text-align:right;">' . ($moneda == " $ " ? " $ 0.00" : $moneda . ' ' . number_format($respuesta["total"], 2)) . '</th>

                    
                </tr>
            
                </thead>
            
            </table>';

        ?>


    </div>
    <p>&nbsp;</p>

</body>

</html>