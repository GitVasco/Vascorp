<html>

    <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="css/ticket_v2.css" target="_blank" rel="stylesheet" type="text/css">
    </head>

<!-- <body> -->
<body onload="window.print();">
<?php
    require_once "../../controladores/cuentas.controlador.php";
    require_once "../../modelos/cuentas.modelo.php";

    require_once "../../extensiones/cantidad_en_letras.php";

    /* 
    todo: traemos todos lso datos para el ticket
    */
    $cliente = $_GET["cliente"];
    #var_dump($cliente);

    $ctaCab = Controladorcuentas::ctrEstadoCuentaCab($cliente);
    #var_dump($ctaCab);
    $ctaDet = Controladorcuentas::ctrEstadoCuentaDet($cliente);
    #var_dump($ctaDet);

    $hoy = date("m-d-y"); 

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
                        
                                <th style="text-align:left;" colspan="11">Área de créditos y cobranzas</th>
                        
                            </tr>                            
                        
                            <tr>
                        
                                <th style="width:10%;text-align:left;">Cod. Cliente</th>
                                <td style="width:50%" colspan="4">'.$ctaCab["cliente"].'</td>
                                <th colspan="1"></th>
                                <th style="text-align:right;">FECHA</th>
                                <td style="width:10%;text-align:right;" colspan="4">'.$hoy.'</td>
                        
                            </tr>
                        
                            <tr>
                        
                                <th style="width:10%;text-align:left;">CLIENTE:</th>
                                <td style="width:50%" colspan="4">'.$ctaCab["nombre"].'</td>
                                <th colspan="1"></th>
                                <th style="text-align:right;">Deuda Total:</th>
                                <th style="width:10%;text-align:right;" colspan="4">S/ '.number_format($ctaCab["saldo"],2).'</td>                             

                            </tr>
                        
                            <tr>
                        
                                <th style="width:10%;text-align:left;">DIRECCIÓN:</th>
                                <td style="width:50%" colspan="10">'.$ctaCab["direccion"].'</td>

                            </tr>                            
                    
                            <tr>
                        
                                <th style="width:10%;text-align:left;">ZONA:</th>
                                <td style="width:50%" colspan="10">'.$ctaCab["nom_ubigeo"].'</td>

                            </tr>    

                            <tr>
                        
                                <th style="width:10%;text-align:left;">RUC/DNI:</th>
                                <td style="width:50%" colspan="10">'.$ctaCab["documento"].'</td>

                            </tr>  
                            
                            <tr>
                        
                                <th style="width:10%;text-align:left;">TELÉFONO:</th>
                                <td style="width:50%" colspan="10">'.$ctaCab["telefono"].'</td>

                            </tr>  
                            
                            <tr>
                        
                                <th style="width:10%;text-align:left;"></th>
                                <th style="width:50%" colspan="10">Cta Recaudadora - BCP: 191-1553564-0-64</th>

                            </tr>                            

                        </thead>
                    
                </table>';

            echo '<br>';
            echo '<br>';

            echo '<table border="1" align="left" width="900px">

                <thead>
                    <tr></tr>

                    <tr>

                        <th style="width:6%">N°</th>
                        <th style="width:10%;text-align:left;">T/D</th>
                        <th style="width:15%;text-align:left;">DOCUMENTO</th>
                        <th style="width:10%;text-align:left;">FECHA EMISIÓN</th>
                        <th style="width:10%;text-align:left;">FECHA VEN.</th>
                        <th style="width:6%;text-align:left;">VEND.</th>
                        <th style="width:10%;text-align:left;">NRO ÚNICO</th>
                        <th style="width:10%;text-align:left;">MONTO TOTAL</th>
                        <th style="width:10%;text-align:left;">SALDO PENDIENTE</th>
                        <th style="width:10%;text-align:left;">PROTESTO</th>
                        
                    </tr>
            
                </thead>
        
            </table>';            
 
            echo '<table border="1" align="left" width="900px">';

                foreach($ctaDet as $key => $value){

                    echo '<tr>
                                
                                <td style="width:6%">'.($key+1).'</td>
                                <td style="width:10%;text-align:left;">'.$value["tipo_documento"].'</td>
                                <td style="width:15%;text-align:left;">'.$value["num_cta"].'</td>
                                <td style="width:10%;text-align:left;">'.$value["fecha"].'</td>
                                <td style="width:10%;text-align:left;">'.$value["fecha_ven"].'</td>
                                <td style="width:6%;text-align:left;">'.$value["vendedor"].'</td>
                                <td style="width:10%;text-align:left;">'.$value["num_unico"].'</td>
                                <td style="width:10%;text-align:right;">S/ '.number_format($value["monto"],2).'</td>
                                <td style="width:10%;text-align:right;">S/ '.number_format($value["saldo"],2).'</td>
                                <td style="width:10%;text-align:center;">'.$value["protesta"].'</td>

                        </tr>';                    

                }

            echo '</table>';

            echo '<table border="1" align="left" width="900px">

                <thead>
                    <tr></tr>

                    <tr>

                        <th style="width:6%"></th>
                        <th style="width:10%;text-align:left;"></th>
                        <th style="width:15%;text-align:left;"></th>
                        <th style="width:10%;text-align:left;"></th>
                        <th style="width:10%;text-align:left;"></th>
                        <th style="width:6%;text-align:left;"></th>
                        <th style="width:10%;text-align:left;"></th>
                        <th style="width:10%;text-align:left;"></th>
                        <th style="width:10%;text-align:right;">S/ '.number_format($ctaCab["saldo"],2).'</th>
                        <th style="width:10%;text-align:left;"></th>
                        
                    </tr>
            
                </thead>
        
            </table>';               

        ?>


    </div>
    <p>&nbsp;</p>

</body>

</html>




