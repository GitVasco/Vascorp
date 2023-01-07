<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="css/ticket_v9.css" target="_blank" rel="stylesheet" type="text/css">
</head>

<!-- <body onload="window.print();"> -->

<body>
    <?php
    require_once "../../controladores/facturacion.controlador.php";
    require_once "../../modelos/facturacion.modelo.php";
    require_once "../../extensiones/cantidad_en_letras.php";

    $tipo = $_GET["tipo"];
    $documento = $_GET["codigo"];
    $venta = ControladorFacturacion::ctrMostrarVentaImpresion($documento, $tipo);
    echo '<pre>';
    print_r($venta);
    echo '</pre>';
    $modelo = ControladorFacturacion::ctrMostrarModeloImpresionV2($documento, $tipo, 0, 100);
    $cantModelo = count($modelo);
    $subtotal = $venta["neto"] - $venta["dscto"];
    $monto_letra = CantidadEnLetra($venta["total"]);
    //var_dump($venta);

    if ($venta["agencia"] == 0) {
        $tipo_transporte = "Privado";
    } else {
        $tipo_transporte = "Público";
    }

    ?>

    <div class="zona_impresion">

        <?php

        $cabecera = '<table border="0">

            <thead>

                <tr>
                    <td style="width:150px;">
                        <div style="align:center;">
                            <img src="../../vistas/img/plantilla/jackyform_paloma2.png" width="150px" height="75px">
                        </div>
                    </td>

                    <td style="width:350px;">
                        <div>
                            <img src="../../vistas/img/plantilla/jackyform_letras.png" width="150px" height="75px" style="margin-left: auto; margin-right: auto; display: block;">
                            <p style="margin:0px; text-align:center;"><b>Corporación Vasco S.A.C.</b></p>
                            <p style="margin:0px; text-align:center;">Cal.Santo Toribio Nro. 259 - Urb Santa Luisa 1ra Etapa</p>   
                            <p style="margin:0px; text-align:center;">San Martin de Porres - Lima - Lima</p>  
                            <p style="margin:0px; text-align:center;">Telfs: 537-2501/536-4024 Cel 964570509 / 964543475</p>  
                            <p style="margin:0px; text-align:center;">Página Web: www.jackyform.com.pe</p>  
                            <p style="margin:0px; text-align:center;">Email: gerenciadeventas@jackyform.com.pe</p>  
                            <p style="margin:0px; text-align:center;">cuentascorrientes@jackyform.com.pe</p> 
                            <p style="margin:0px; text-align:center;"><i>Confecciones de Prendas de Ropa Interior</i></p>                                                                 
                        </div>                         
                    </td>  

                    <td style="width:250px; height:100px; border: 1px solid black;">
                        <p style="text-align:center;"><b>RUC: 20513613939</b></p>
                        <p style="text-align:center;"><b>' . $venta["tipo_documento"] . ' REMITENTE ELECTRONICA</b></p>
                        <p style="text-align:center;"><b>Nro.: ' . substr($venta["documento"], 0, 4) . "-" . substr($venta["documento"], 4, 12) . '</b></p>
                    </td>
                </tr>

            </thead>

        </table>';

        $traslado = '<table>
            <thead>
                <tr>
                    <td style="width:150px;font-weight: bold;">DATOS DEL TRASLADO</td>
                    <td></td>

                    <td style="width:50px;"></td>
                    
                    <td style="width:130px;font-weight: bold;">DATOS DEL CLIENTE</td>
                    <td></td>
                </tr>            
                <tr>
                    <td style="width:150px;font-weight: bold;">Fecha Emision:</td>
                    <td>' . $venta["fecha"] . '</td>

                    <td style="width:50px;"></td>
                    
                    <td style="width:130px;font-weight: bold;">Cliente:</td>
                    <td>' . $venta["nombre"] . '</td>
                </tr>
                <tr>
                    <td style="width:150px;font-weight: bold;">Fecha Traslado:</td>
                    <td>' . $venta["fecha"] . '</td>
                    
                    <td style="width:50px;"></td>

                    <td style="width:130px;font-weight: bold;">Dirección:</td>
                    <td>' . $venta["direccion"] . '</td>
                </tr>
                <tr>
                    <td style="width:150px;font-weight: bold;">Motivo de Traslado:</td>
                    <td>VENTA</td>

                    <td style="width:50px;"></td>

                    <td style="width:130px;font-weight: bold;">Ciudad:</td>
                    <td>' . $venta["nom_ubigeo"] . '</td>
                </tr>
                <tr>
                    <td style="width:150px;font-weight: bold;">Modalidad de Transporte:</td>
                    <td>' . $tipo_transporte . '</td>    
                    
                    <td style="width:50px;"></td>

                    <td style="width:130px;font-weight: bold;">Nro RUC:</td>
                    <td>' . $venta["dni"] . '</td>   
                </tr>
                <tr>
                    <td style="width:150px;font-weight: bold;">Peso Bruto:</td>
                    <td>' . $venta["peso"] . ' KGM</td>   
                    
                    <td style="width:50px;"></td>

                    <td style="width:130px;font-weight: bold;">Cod. Cliente:</td>
                    <td>' . $venta["cliente"] . '</td>   
                </tr>   
                <tr>
                    <td style="width:150px;font-weight: bold;">Cantidad de bultos:</td>
                    <td>' . $venta["bultos"] . '</td>       
                    
                    <td style="width:50px;"></td>
                    
                    <td style="width:130px;font-weight: bold;">Vendedor:</td>
                    <td>' . $venta["vendedor"] . ' - ' . $venta["nom_vendedor"] . '</td>    
                </tr>                                       
            </thead>
        </table>';

        $puntos = '<table>

            <thead>

                <tr>
                    <th style="width:50%; border-radius: 10px;  border: 2px solid #000000;  padding: 1px;">PUNTO DE PARTIDA:</th>
                    <th style="width:50%; border-radius: 10px;  border: 2px solid #000000;  padding: 1px;">PUNTO DE LLEGADA:</th>
                </tr>
                
                <tr>
                    <td style="text-align:center;">Calle Santo Toribio N° 259- Urb. Santa Luisa 1era Etapa - San Martin de Porres - Lima</td>
                    <td style="text-align:center;">' . $venta["direccion"] . $venta["nom_ubigeo"] . '</td>
                </tr>

            </thead>

        </table>';

        $conductor_agencia = '<table>
            <thead>
                <tr>
                    <td style="width:150px;font-weight: bold;">DATOS DEL CONDUCTOR</td>
                    <td></td>

                    <td style="width:50px;"></td>
                    
                    <td style="width:130px;font-weight: bold;">EMPRESA DE TRANSPORTES</td>
                    <td></td>
                </tr>            
                <tr>
                    <td style="width:150px;font-weight: bold;">Fecha Emision:</td>
                    <td>' . $venta["fecha"] . '</td>

                    <td style="width:50px;"></td>
                    
                    <td style="width:130px;font-weight: bold;">Cliente:</td>
                    <td>' . $venta["nombre"] . '</td>
                </tr>
                <tr>
                    <td style="width:150px;font-weight: bold;">Fecha Traslado:</td>
                    <td>' . $venta["fecha"] . '</td>
                    
                    <td style="width:50px;"></td>

                    <td style="width:130px;font-weight: bold;">Dirección:</td>
                    <td>' . $venta["direccion"] . '</td>
                </tr>
                <tr>
                    <td style="width:150px;font-weight: bold;">Motivo de Traslado:</td>
                    <td>VENTA</td>

                    <td style="width:50px;"></td>

                    <td style="width:130px;font-weight: bold;">Ciudad:</td>
                    <td>' . $venta["nom_ubigeo"] . '</td>
                </tr>
                <tr>
                    <td style="width:150px;font-weight: bold;">Modalidad de Transporte:</td>
                    <td>' . $tipo_transporte . '</td>    
                    
                    <td style="width:50px;"></td>

                    <td style="width:130px;font-weight: bold;">Nro RUC:</td>
                    <td>' . $venta["dni"] . '</td>   
                </tr>
                <tr>
                    <td style="width:150px;font-weight: bold;">Peso Bruto:</td>
                    <td>' . $venta["peso"] . ' KGM</td>   
                    
                    <td style="width:50px;"></td>

                    <td style="width:130px;font-weight: bold;">Cod. Cliente:</td>
                    <td>' . $venta["cliente"] . '</td>   
                </tr>   
                <tr>
                    <td style="width:150px;font-weight: bold;">Cantidad de bultos:</td>
                    <td>' . $venta["bultos"] . '</td>       
                    
                    <td style="width:50px;"></td>
                    
                    <td style="width:130px;font-weight: bold;">Vendedor:</td>
                    <td>' . $venta["vendedor"] . ' - ' . $venta["nom_vendedor"] . '</td>    
                </tr>                                       
            </thead>
        </table>';

        $cabDet = '<table>

            <thead>

                <tr>
                    <th style="width:80px; border-radius: 5px;  border: 1px solid #000000;  padding: 1px; background-color:#E0DEDE;">CODIGO</th>
                    <th style="width:80px; border-radius: 5px;  border: 1px solid #000000;  padding: 1px; background-color:#E0DEDE;">CANT.</th>
                    <th style="width:50px; border-radius: 5px;  border: 1px solid #000000;  padding: 1px; background-color:#E0DEDE;">UND</th>
                    <th style="width:250px; border-radius: 5px;  border: 1px solid #000000;  padding: 1px; background-color:#E0DEDE;">DESCRIPCIÓN</th>
                    <th style="width:80px; border-radius: 5px;  border: 1px solid #000000;  padding: 1px; background-color:#E0DEDE;">V.UNIT</th>
                    <th style="width:80px; border-radius: 5px;  border: 1px solid #000000;  padding: 1px; background-color:#E0DEDE;">DSCTO</th>
                    <th style="width:80px; border-radius: 5px;  border: 1px solid #000000;  padding: 1px; background-color:#E0DEDE;">P.VENTA</th>                                                
                </tr>

            </thead>

        </table> ';

        //todo: 1 página
        if ($cantModelo <= 20) {

            echo $cabecera;

            echo '<br>';

            echo $traslado;

            echo $puntos;

            echo $conductor_agencia;

            echo '<br>';

            echo $cabDet;

            echo '<table>';

            foreach ($modelo as $key => $value) {

                echo '<tr>
                    <td style="width:80px; border-right: 1px solid; text-align:right;">' . $value["modelo"] . '</td>
                    <td style="width:80px; border-right: 1px solid; text-align:right;">' . $value["cantidad"] . '</td>
                    <td style="width:50px; border-right: 1px solid; text-align:center;">' . $value["unidad"] . '</td>
                    <td style="width:250px; border-right: 1px solid;">' . $value["nombre"] . '</td>
                    <td style="width:80px; border-right: 1px solid; text-align:right;">' . $value["precio"] . '</td>
                    <td style="width:80px; border-right: 1px solid; text-align:right;">' . $value["dscto1"] . '</td>
                    <td style="width:80px; border-right: 1px solid; text-align:right;">' . $value["total"] . '</td>
                </tr>';
            }

            echo '</table>';

            echo $pie;
        }


        ?>

    </div>

</body>

</html>