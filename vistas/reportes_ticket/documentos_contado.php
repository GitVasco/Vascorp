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

    $ctaCab = Controladorcuentas::ctrContadoPendientes();
    #var_dump($ctaCab);


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
                        
                                <th style="text-align:center;" colspan="11">Relación de documentos PENDIENTES con forma de pago CONTADO/CONTRA ENTREGA</th>
                        
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

                        <th style="width:5%;text-align:center;">VEN</th>
                        <th style="width:12%;text-align:left;">UBIGEO</th>
                        <th style="width:8%;text-align:left;">CÓDIGO</th>
                        <th style="width:20%;text-align:left;">CLIENTE</th>
                        <th style="width:8%;text-align:left;">T. DOC</th>
                        <th style="width:10%;text-align:left;">DOCUMENTO</th>
                        <th style="width:7%;text-align:left;">FEC. EMI.</th>
                        <th style="width:7%;text-align:left;">FEC. VEN.</th>
                        <th style="width:7%;text-align:left;">ULT. PAGO</th>
                        <th style="width:8%;text-align:left;">MONTO</th>
                        <th style="width:8%;text-align:left;">SALDO</th>
                        
                    </tr>
            
                </thead>
        
            </table>';      
            
            echo '<table border="1" align="left" width="980px">';

                foreach($ctaCab as $key => $value){

                    echo '<tr>
                                
                            <td style="width:5%;text-align:center;"><b>'.$value["vendedor"].'</b></td>
                            <td style="width:12%;text-align:left;">'.$value["nom_ubigeo"].'</td>
                            <td style="width:8%;text-align:left;"><b>'.$value["cliente"].'</b></td>
                            <td style="width:20%;text-align:left;">'.$value["nombre"].'</td>
                            <td style="width:8%;text-align:left;">'.$value["nom_doc"].'</td>
                            <td style="width:10%;text-align:left;"><b>'.$value["num_cta"].'</b></td>
                            <td style="width:7%;text-align:left;">'.$value["fecha"].'</td>
                            <td style="width:7%;text-align:left;"><b>'.$value["fecha_ven"].'</b></td>
                            <td style="width:7%;text-align:left;">'.$value["ult_pago"].'</td>
                            <td style="width:8%;text-align:right;">S/ '.number_format($value["monto"],2).'</td>
                            <td style="width:8%;text-align:right;"><b>S/ '.number_format($value["saldo"],2).'</b></td>                              

                        </tr>';                    

                }

            echo '</table>';            

        ?>


    </div>
    <p>&nbsp;</p>

</body>

</html>




