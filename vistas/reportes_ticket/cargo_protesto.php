<html>

    <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="css/ticket_v8.css" target="_blank" rel="stylesheet" type="text/css">
    </head>

<body>
<!-- <body onload="window.print();"> -->
<?php
    require_once "../../controladores/cuentas.controlador.php";
    require_once "../../modelos/cuentas.modelo.php";

    require_once "../../extensiones/cantidad_en_letras.php";

    /* 
    todo: traemos todos lso datos para el ticket
    */
    $cliente = $_GET["cliente"];
    #var_dump($cliente);

    $num_cta = $_GET["num_cta"];
    #var_dump($num_cta);

    $ctaCab = Controladorcuentas::ctrEstadoCuentaCab($cliente);
    #var_dump($ctaCab);
    $ctaDet = Controladorcuentas::ctrEstadoCuentaProt($num_cta);
    #var_dump($ctaDet);

    $hoy = date("d-m-Y"); 

?>
    <div class="zona_impresion">
    <!-- codigo imprimir -->

        <?php

            echo ' <table border="0" align="left" width="600px">

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
                                <td style="width:15%;text-align:right;" colspan="4">'.$hoy.'</td>
                        
                            </tr>
                        
                            <tr>
                        
                                <th style="width:10%;text-align:left;">CLIENTE:</th>
                                <td style="width:50%" colspan="4">'.$ctaCab["nombre"].'</td>
                                <th colspan="1"></th>

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
                            
                            <tr>
                        
                                <th style="width:10%;text-align:left;">GESTOR:</th>
                                <th style="width:50%" colspan="2">Banco de Crédito del Perú</th>

                            </tr>           
                            
                            <tr>
                        
                                <th style="width:10%;text-align:left;">Gasto x Protesto:</th>
                                <th style="width:50%" colspan="2">S/ 85.00</th>

                            </tr>                               

                        </thead>
                    
                </table>';

            echo '<br>';
            echo '<br>';

            echo '<table border="1" align="left" width="600px">

                <thead>
                    <tr></tr>

                    <tr>

                        <th style="width:5%;text-align:left;">N°</th>
                        <th style="width:10%;text-align:left;">T/D</th>
                        <th style="width:15%;text-align:left;">DOCUMENTO</th>
                        <th style="width:15%;text-align:center;">FEC. VEN.</th>
                        <th style="width:15%;text-align:center;">SALDO</th>
                        <th style="width:15%;text-align:center;">GASTOS</th>
                        <th style="width:15%;text-align:center;">TOTAL</th>
                        <th style="width:15%;text-align:center;">BANCO</th>
                        
                    </tr>
            
                </thead>
        
            </table>';            
 
            echo '<table border="1" align="left" width="600px">';

                    echo '<tr>
                                
                                <td style="width:5%;text-align:left;">1</td>
                                <td style="width:10%;text-align:left;">'.$ctaDet["tipo_documento"].'</td>
                                <td style="width:15%;text-align:left;">'.$ctaDet["num_cta"].'</td>
                                <td style="width:15%;text-align:center;"><b>'.$ctaDet["fecha_ven"].'</b></td>
                                <td style="width:15%;text-align:right;">S/ '.number_format($ctaDet["saldo"],2).'</td>
                                <td style="width:15%;text-align:right;"><b>S/ '.number_format($ctaDet["gasto"],2).'</b></td>
                                <td style="width:15%;text-align:right;"><b>S/ '.number_format($ctaDet["monto_total"],2).'</b></td>
                                <td style="width:15%;text-align:center;">B.C.P</td>

                        </tr>';                    

            echo '</table>';

            echo '<table border="0" align="left" width="600px">

                <thead>
                    <tr></tr>

                    <tr>

                        <td style="width:5%;text-align:left;"></td>
                        <td style="width:10%;text-align:left;"></td>
                        <td style="width:15%;text-align:left;"></td>
                        <td style="width:15%;text-align:left;"></td>
                        <td style="width:15%;text-align:right;">Capital</td>
                        <td style="width:15%;text-align:right;"><b>S/ '.number_format($ctaDet["saldo"],2).'</b></td>
                        <td style="width:15%;text-align:right;"><b></b></td>
                        <td style="width:15%;text-align:center;"></td>                        
                        
                    </tr>

                    <tr>

                        <td style="width:5%;text-align:left;"></td>
                        <td style="width:10%;text-align:left;"></td>
                        <td style="width:15%;text-align:left;"></td>
                        <td style="width:15%;text-align:left;"></td>
                        <td style="width:15%;text-align:right;">Gasto</td>
                        <td style="width:15%;text-align:right;"><b>S/ '.number_format($ctaDet["gasto"],2).'</b></td>
                        <td style="width:15%;text-align:right;"><b></b></td>
                        <td style="width:15%;text-align:center;"></td>                        
                        
                    </tr>   
                    
                    <tr>

                        <td style="width:5%;text-align:left;"></td>
                        <td style="width:10%;text-align:left;"></td>
                        <td style="width:15%;text-align:left;"></td>
                        <td style="width:15%;text-align:left;"></td>
                        <td style="width:15%;text-align:right;"><b>Total</b></td>
                        <td style="width:15%;text-align:right;"><b>S/ '.number_format($ctaDet["monto_total"],2).'</b></td>
                        <td style="width:15%;text-align:right;"><b></b></td>
                        <td style="width:15%;text-align:center;"></td>                        
                        
                    </tr>                     
            
                </thead>
        
            </table>';               

        ?>


    </div>
    <p>&nbsp;</p>

</body>

</html>




