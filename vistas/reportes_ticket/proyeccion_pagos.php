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
    $ctaDet = Controladorcuentas::ctrProyeccionPagos();
    #var_dump($ctaDet);

    $hoy = date("d-m-y"); 

?>
    <div class="zona_impresion">
    <!-- codigo imprimir -->

        <?php

            echo ' <table border="0" align="left" width="800px">

                        <thead>
                    
                            <tr>
                        
                                <th style="text-align:left;" colspan="11">CORPORACION VASCO S.A.C.</th>
                        
                            </tr>

                            <tr>
                        
                                <th style="text-align:left;" colspan="11">Área de créditos y cobranzas</th>
                        
                            </tr>   
                            
                            <tr>
                        
                                <th style="text-align:center;" colspan="11">Proyección de pagos por semana</th>
                        
                            </tr>                              
                        
                        </thead>
                    
                </table>';

            echo '<br>';
            echo '<br>';

            echo '<table border="1" align="left" width="800px">

                <thead>
                    <tr></tr>

                    <tr>

                        <th style="width:5%">Año</th>
                        <th style="width:10%;text-align:center;">Semana</th>
                        <th style="width:10%;text-align:center;">Inicio</th>
                        <th style="width:10%;text-align:center;">Fin</th>
                        <th style="width:15%;text-align:center;">Facturas</th>
                        <th style="width:15%;text-align:center;">Letras</th>
                        <th style="width:15%;text-align:center;">Total</th>
                        
                    </tr>
            
                </thead>
        
            </table>';            
 
            echo '<table border="1" align="left" width="800px">';

                foreach($ctaDet as $key => $value){

                    echo '<tr>
                                
                                <td style="width:5%">'.$value["anno"].'</td>
                                <td style="width:10%;text-align:center;">'.$value["semana"].'</td>
                                <td style="width:10%;text-align:center;">'.$value["inicio"].'</td>
                                <td style="width:10%;text-align:center;">'.$value["fin"].'</td>
                                <td style="width:15%;text-align:right;">'.number_format($value["facturas"],2).'</td>
                                <td style="width:15%;text-align:right;">'.number_format($value["letras"],2).'</td>
                                <td style="width:15%;text-align:right;"><b>'.number_format($value["facturas"]+$value["letras"], 2).'</b></td>

                        </tr>';                    

                }

            echo '</table>';

        ?>


    </div>
    <p>&nbsp;</p>

</body>

</html>




