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

    $letras = Controladorcuentas::ctrLetrasAceptar();
    #var_dump($letras);


    $hoy = date("d-m-y"); 

?>
    <div class="zona_impresion">
    <!-- codigo imprimir -->

        <?php

            echo ' <table border="0" align="left" width="980px">

                        <thead>
                    
                            <tr>
                        
                                <th style="text-align:left;" colspan="11">CORPORACION VASCO S.A.C.</th>
                        
                            </tr>

                            <tr>
                        
                                <th style="text-align:left;" colspan="11">Área de créditos y cobranzas</th>
                        
                            </tr>         
                            
                            <tr>
                        
                                <th style="text-align:center;" colspan="11">Relación de LETRAS POR ACEPTAR</th>
                        
                            </tr>   

                            <tr>
                        
                                <th style="text-align:center;" colspan="11"></th>
                        
                            </tr>  
                        </thead>
                    
                </table>';

            echo '<br>';
            echo '<br>';

            echo '<table border="1" align="left" width="980px">

                <thead>
                    <tr></tr>

                    <tr>

                        <th style="width:5%;text-align:center;">TIPO</th>
                        <th style="width:10%;text-align:left;">NRO DOC</th>
                        <th style="width:8%;text-align:left;">FECHA EMI</th>
                        <th style="width:8%;text-align:left;">FECHA VEN.</th>
                        <th style="width:5%;text-align:left;">VEND.</th>
                        <th style="width:8%;text-align:left;">COD. CLIENTE</th>
                        <th style="width:30%;text-align:left;">CLIENTE</th>
                        <th style="width:7%;text-align:left;">MONTO</th>

                        
                    </tr>
            
                </thead>
        
            </table>';      
            
            echo '<table border="1" align="left" width="980px">';

                foreach($letras as $key => $value){

                    echo '<tr>
                                
                            <td style="width:5%;text-align:center;"><b>'.$value["tipo_doc"].'</b></td>
                            <td style="width:10%;text-align:left;">'.$value["num_cta"].'</td>
                            <td style="width:8%;text-align:left;"><b>'.$value["fecha"].'</b></td>
                            <td style="width:8%;text-align:left;">'.$value["fecha_ven"].'</td>
                            <td style="width:5%;text-align:left;">'.$value["vendedor"].'</td>
                            <td style="width:8%;text-align:left;"><b>'.$value["cliente"].'</b></td>
                            <td style="width:30%;text-align:left;">'.$value["nombre"].'</td>
                            <td style="width:7%;text-align:right;"><b>S/ '.$value["monto"].'</b></td>
                        

                        </tr>';                    

                }

            echo '</table>';            

        ?>


    </div>
    <p>&nbsp;</p>

</body>

</html>




