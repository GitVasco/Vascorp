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

    $inicio= $_GET["inicio"];
    $estadoCta = ControladorCuentas::ctrEstadoCuenta($inicio);
    #var_dump($ctaCab);


    $hoy = date("d-m-y"); 

?>
    <div class="zona_impresion">
    <!-- codigo imprimir -->

        <?php

            echo '<table border="1" align="left" width="980px">

                <thead>
                    <tr></tr>

                    <tr>

                        <th style="width:5%;text-align:center;">T. Doc</th>
                        <th style="width:10%;text-align:left;">Documentp</th>
                        <th style="width:8%;text-align:left;">Cod. Cliente</th>
                        <th style="width:30%;text-align:left;">Nombre Cliente</th>
                        <th style="width:8%;text-align:left;">Fec. Emi</th>
                        <th style="width:10%;text-align:left;">Fec. Ven</th>
                        <th style="width:15%;text-align:left;">Origen</th>
                        <th style="width:7%;text-align:left;">Tip. Mov.</th>
                        <th style="width:7%;text-align:left;">Monto</th>
                        
                    </tr>
            
                </thead>
        
            </table>';      
            
            echo '<table border="0" align="left" width="980px">';

                foreach($estadoCta as $key => $value){

                    echo '<tr>
                                
                            <td style="width:5%;text-align:center;"><b>'.$value["tipo_doc"].'</b></td>
                            <td style="width:10%;text-align:left;">'.$value["num_cta"].'</td>
                            <td style="width:8%;text-align:left;"><b>'.$value["cliente"].'</b></td>
                            <td style="width:30%;text-align:left;">'.$value["nom_cliente"].'</td>
                            <td style="width:8%;text-align:left;">'.$value["fecha"].'</td>
                            <td style="width:10%;text-align:left;"><b>'.$value["fecha_ven"].'</b></td>
                            <td style="width:15%;text-align:left;">'.$value["doc_origen"].'</td>
                            <td style="width:7%;text-align:center;"><b>'.$value["tip_mov"].'</b></td>
                            <td style="width:7%;text-align:right;">'.number_format($value["monto"],2).'</td>

                        </tr>';                    

                }

            echo '</table>';            

        ?>


    </div>
    <p>&nbsp;</p>

</body>

</html>




