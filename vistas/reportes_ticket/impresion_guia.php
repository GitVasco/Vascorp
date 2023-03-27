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
    $modelo = ControladorFacturacion::ctrMostrarModeloImpresionV2("movimientosjf_2023", $documento, $tipo, 0, 100);
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

        $cliente = '<table style="width:100%;">
            <thead>
                <tr>
                    <td style="width:100%; border-radius: 10px;  border: 1px solid #000000;  padding: 1px;">
                        <table>
                            <tr>
                                <td style="width:120px;font-weight: bold;" colspan="2">DATOS DEL CLIENTE</td>
                                                       
                            </tr>                        
                            <tr>
                                <td style="width:120px;font-weight: bold;">Cliente:</td>
                                <td>' . $venta["nombre"] . '</td>                            
                            </tr>
                            <tr>
                                <td style="width:120px;font-weight: bold;">Dirección:</td>
                                <td>' . $venta["direccion"] . '</td>
                            </tr>
                            <tr>
                                <td style="width:120px;font-weight: bold;">Ciudad:</td>
                                <td>' . $venta["nom_ubigeo"] . '</td>
                            </tr>
                            <tr>
                                <td style="width:120px;font-weight: bold;">Nro RUC:</td>
                                <td>' . $venta["dni"] . '</td>                        
                            </tr>
                            <tr>
                                <td style="width:120px;font-weight: bold;">Cod. Cliente:</td>
                                <td>' . $venta["cliente"] . '</td>                        
                            </tr>   
                            <tr>
                                <td style="width:120px;font-weight: bold;">Vendedor:</td>
                                <td>' . $venta["vendedor"] . ' - ' . $venta["nom_vendedor"] . '</td>                        
                            </tr>                             
                        </table>
                    </td>
                </tr>
                                    
            </thead>
        </table>';

        $envio = '<table style="width:100%;">
            <thead>
                <tr>
                    <td style="width:100%; border-radius: 10px;  border: 1px solid #000000;  padding: 1px;">
                        <table style="width:100%;">
                            <tr>
                                <td style="width:120px;font-weight: bold;" colspan="2">DATOS DEL ENVIO</td>
                                                       
                            </tr>                        
                            <tr>
                                <td style="width:120px;font-weight: bold;">Tipo de envío:</td>
                                <td>VENTA</td>           
                                
                                <td style="width:120px;font-weight: bold;">Fecha de envío:</td>
                                <td>' . $venta["fecha"] . '</td>     
                            </tr>
                            <tr>
                                <td style="width:120px;font-weight: bold;">Peso bruto total:</td>
                                <td>' . $venta["peso"] . ' KGM</td>

                                <td style="width:120px;font-weight: bold;">Número de Bultos:</td>
                                <td>' . $venta["bultos"] . '</td>
                            </tr>
                            <tr>
                                <td style="width:120px;font-weight: bold;">Punto de partida:</td>
                                <td style="width:300px;" colspan="3">Calle Santo Toribio N° 259- Urb. Santa Luisa 1era Etapa - San Martin de Porres - Lima</td>
                            </tr>
                            <tr>
                                <td style="width:120px;font-weight: bold;">Punto de llegada:</td>
                                <td style="width:300px;" colspan="3">' . $venta["direccion"] . ' ' . $venta["nom_ubigeo"] . '</td>                        
                            </tr>
                         
                        </table>
                    </td>
                </tr>
                                    
            </thead>
        </table>';

        if ($tipo_transporte == "Privado") {

            $transporte = '<table style="width:100%;">
                <thead>
                    <tr>
                        <td style="width:100%; border-radius: 10px;  border: 1px solid #000000;  padding: 1px;">
                            <table style="width:100%;">
                                <tr>
                                    <td style="width:150px;font-weight: bold;" colspan="2">DATOS DEL TRANSPORTE</td>
                                                           
                                </tr>                        
                                <tr>
                                    <td style="width:150px;font-weight: bold;">Tipo Transporte:</td>
                                    <td>' . $tipo_transporte . '</td>                            
                                </tr>
                                <tr>
                                    <td style="width:150px;font-weight: bold;">Nombre Conductor:</td>
                                    <td colspan="3">' . $venta["chofer"] . '</td>
                                </tr>
                                <tr>
                                    <td style="width:150px;font-weight: bold;">DNI Conductor:</td>
                                    <td>' . $venta["dni_chofer"] . '</td>

                                    <td style="width:150px;font-weight: bold;">Licencia Conductor:</td>
                                    <td>' . $venta["brevete_chofer"] . '</td>
                                </tr>
                                <tr>
                                    <td style="width:150px;font-weight: bold;">Placa de la movilidad:</td>
                                    <td>' . $venta["carro"] . '</td>                        
                                </tr>                           
                            </table>
                        </td>
                    </tr>
                                        
                </thead>
            </table>';
        } else {
            $transporte = '<table style="width:100%;">
                <thead>
                    <tr>
                        <td style="width:100%; border-radius: 10px;  border: 1px solid #000000;  padding: 1px;">
                            <table>
                                <tr>
                                    <td style="width:120px;font-weight: bold;" colspan="2">DATOS DEL TRANSPORTE</td>
                                                        
                                </tr>                        
                                <tr>
                                    <td style="width:150px;font-weight: bold;">Tipo Transporte:</td>
                                    <td>' . $tipo_transporte . '</td>                             
                                </tr>
                                <tr>
                                    <td style="width:120px;font-weight: bold;">Razón Social:</td>
                                    <td>' . $venta["nom_agencia"] . '</td>
                                </tr>
                                <tr>
                                    <td style="width:120px;font-weight: bold;">R.U.C:</td>
                                    <td>' . $venta["ruc_agencia"] . '</td>
                                </tr>
                                
                            </table>
                        </td>
                    </tr>
                                        
                </thead>
            </table>';
        }


        $cabDet = '<table style="width:100%;">

            <thead>

                <tr>
                    <th style="width:80px; border-radius: 5px;  border: 1px solid #000000;  padding: 1px; background-color:#E0DEDE;">CODIGO</th>
                    <th style="width:250px; border-radius: 5px;  border: 1px solid #000000;  padding: 1px; background-color:#E0DEDE;">DESCRIPCIÓN</th>
                    <th style="width:80px; border-radius: 5px;  border: 1px solid #000000;  padding: 1px; background-color:#E0DEDE;">CANT.</th>
                    <th style="width:50px; border-radius: 5px;  border: 1px solid #000000;  padding: 1px; background-color:#E0DEDE;">UND</th>               
                </tr>

            </thead>

        </table> ';

        if (substr($venta["doc_destino"], 0, 1) == "F") {
            $doc_destino = 'FACTURA';
        } else {
            $doc_destino = 'BOLETA';
        }

        $pie = '<table style="width:100%;">
            <thead>
                <tr>
                    <td style="width:100%; border-radius: 10px;  border: 1px solid #000000;  padding: 1px;">
                        <table style="width:100%;">
                            <tr>
                                <td style="width:200px;font-weight: bold;">COMPROBANTE DE PAGO:</td>
                                <td>' . $doc_destino . ' - ' . $venta["doc_destino"] . '</td>                            
                            </tr>
                                                     
                        </table>
                    </td>
                </tr>
                                    
            </thead>
        </table>';

        //todo: 1 página
        if ($cantModelo <= 25) {

            echo $cabecera;

            echo $cliente;

            echo $envio;

            echo $transporte;

            echo $cabDet;

            echo '<table style="width:100%;">';

            foreach ($modelo as $key => $value) {

                echo '<tr>
                    <td style="width:80px; border-right: 1px solid; text-align:center;">' . $value["modelo"] . '</td>
                    <td style="width:250px; border-right: 1px solid;">' . $value["nombre"] . '</td>
                    <td style="width:80px; border-right: 1px solid; text-align:right;">' . $value["cantidad"] . '</td>
                    <td style="width:50px; border-right: 1px solid; text-align:center;">' . $value["unidad"] . '</td>
                    </tr>';
            }

            echo '</table>';

            echo $pie;
        }

        //todo: 2 Páginas
        else if ($cantModelo > 25 && $cantModelo <= 50) {

            echo $cabecera;

            echo $cliente;

            echo $envio;

            echo $transporte;

            echo $cabDet;

            echo '<table style="width:100%;">';

            foreach ($modelo as $key => $value) {

                if ($key <= 25) {

                    echo '<tr>
                        <td style="width:80px; border-right: 1px solid; text-align:center;">' . $value["modelo"] . '</td>
                        <td style="width:250px; border-right: 1px solid;">' . $value["nombre"] . '</td>
                        <td style="width:80px; border-right: 1px solid; text-align:right;">' . $value["cantidad"] . '</td>
                        <td style="width:50px; border-right: 1px solid; text-align:center;">' . $value["unidad"] . '</td>
                        </tr>';
                }
            }

            echo '</table>';

            for ($i = 0; $i < 15; $i++) {

                echo '<table>
                    <tr>
                        <td></td>
                    </tr>
                </table>';
            }

            //*PAGINA 2
            echo $cabecera;

            echo $cliente;

            echo $envio;

            echo $transporte;

            echo $cabDet;

            echo '<table style="width:100%;">';

            foreach ($modelo as $key => $value) {

                if ($key > 25) {

                    echo '<tr>
                        <td style="width:80px; border-right: 1px solid; text-align:center;">' . $value["modelo"] . '</td>
                        <td style="width:250px; border-right: 1px solid;">' . $value["nombre"] . '</td>
                        <td style="width:80px; border-right: 1px solid; text-align:right;">' . $value["cantidad"] . '</td>
                        <td style="width:50px; border-right: 1px solid; text-align:center;">' . $value["unidad"] . '</td>
                        </tr>';
                }
            }

            echo '</table>';

            echo $pie;
        }

        //todo: 3 Páginas
        else if ($cantModelo > 50 && $cantModelo <= 75) {

            echo $cabecera;

            echo $cliente;

            echo $envio;

            echo $transporte;

            echo $cabDet;

            echo '<table style="width:100%;">';

            foreach ($modelo as $key => $value) {

                if ($key <= 25) {

                    echo '<tr>
                        <td style="width:80px; border-right: 1px solid; text-align:center;">' . $value["modelo"] . '</td>
                        <td style="width:250px; border-right: 1px solid;">' . $value["nombre"] . '</td>
                        <td style="width:80px; border-right: 1px solid; text-align:right;">' . $value["cantidad"] . '</td>
                        <td style="width:50px; border-right: 1px solid; text-align:center;">' . $value["unidad"] . '</td>
                        </tr>';
                }
            }

            echo '</table>';

            for ($i = 0; $i < 15; $i++) {

                echo '<table>
                    <tr>
                        <td></td>
                    </tr>
                </table>';
            }

            //*PAGINA 2
            echo $cabecera;

            echo $cliente;

            echo $envio;

            echo $transporte;

            echo $cabDet;

            echo '<table style="width:100%;">';

            foreach ($modelo as $key => $value) {

                if ($key > 25 && $key <= 50) {

                    echo '<tr>
                        <td style="width:80px; border-right: 1px solid; text-align:center;">' . $value["modelo"] . '</td>
                        <td style="width:250px; border-right: 1px solid;">' . $value["nombre"] . '</td>
                        <td style="width:80px; border-right: 1px solid; text-align:right;">' . $value["cantidad"] . '</td>
                        <td style="width:50px; border-right: 1px solid; text-align:center;">' . $value["unidad"] . '</td>
                        </tr>';
                }
            }

            echo '</table>';

            for ($i = 0; $i < 20; $i++) {

                echo '<table>
                    <tr>
                        <td></td>
                    </tr>
                </table>';
            }
            //*PAGINA 3
            echo $cabecera;

            echo $cliente;

            echo $envio;

            echo $transporte;

            echo $cabDet;

            echo '<table style="width:100%;">';

            foreach ($modelo as $key => $value) {

                if ($key > 50 && $key <= 75) {

                    echo '<tr>
                        <td style="width:80px; border-right: 1px solid; text-align:center;">' . $value["modelo"] . '</td>
                        <td style="width:250px; border-right: 1px solid;">' . $value["nombre"] . '</td>
                        <td style="width:80px; border-right: 1px solid; text-align:right;">' . $value["cantidad"] . '</td>
                        <td style="width:50px; border-right: 1px solid; text-align:center;">' . $value["unidad"] . '</td>
                        </tr>';
                }
            }

            echo '</table>';

            echo $pie;
        }



        ?>

    </div>

</body>

</html>