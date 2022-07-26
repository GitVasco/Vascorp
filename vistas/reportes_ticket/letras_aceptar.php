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

    $vendedor = $_GET["vendedor"];

    //*Construir hojas
    $ini = 0;
    $fin = 1000;

    $letras = Controladorcuentas::ctrLetrasAceptar($vendedor, $ini, $fin);
    #var_dump($letras);
    $cantidadLetras = count($letras);
    #var_dump($cantidadLetras);


    $hoy = date("d-m-y"); 

?>
    <div class="zona_impresion">
    <!-- codigo imprimir -->

        <?php

        $cabeceraGlobal = '<table border="0" align="left" width="980px">

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

        $cabecera = '<table border="1" align="left" width="980px">

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

        //todo: 1 pagina
        if($cantidadLetras <= 60){

            //*CABECERA GLOBAL

            echo $cabeceraGlobal;

            echo $cabecera;

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
                            <td style="width:7%;text-align:right;"><b>S/ '.number_format($value["saldo"],2).'</b></td>
                        

                        </tr>';                    

                }

            echo '</table>';            

        }
        //*todo: 2 paginas
        else if($cantidadLetras > 60 && $cantidadLetras <= 120){

            echo $cabeceraGlobal;

            echo $cabecera;

            echo '<table border="1" align="left" width="980px">';

                $letrasP1 = Controladorcuentas::ctrLetrasAceptar($vendedor, 0, 60);

                foreach($letrasP1 as $key => $value){

                    echo '<tr>
                                
                            <td style="width:5%;text-align:center;"><b>'.$value["tipo_doc"].'</b></td>
                            <td style="width:10%;text-align:left;">'.$value["num_cta"].'</td>
                            <td style="width:8%;text-align:left;"><b>'.$value["fecha"].'</b></td>
                            <td style="width:8%;text-align:left;">'.$value["fecha_ven"].'</td>
                            <td style="width:5%;text-align:left;">'.$value["vendedor"].'</td>
                            <td style="width:8%;text-align:left;"><b>'.$value["cliente"].'</b></td>
                            <td style="width:30%;text-align:left;">'.$value["nombre"].'</td>
                            <td style="width:7%;text-align:right;"><b>S/ '.number_format($value["saldo"],2).'</b></td>
                        

                        </tr>';                    

                }

            echo '</table>';  
            
            for ($i=0; $i < 25; $i++) { 

                echo '<table border="0" align="left" width="900px">
                    <tr>
                        <td></td>
                    </tr>
                </table>';

            }

            echo $cabeceraGlobal;

            echo $cabecera;

            echo '<table border="1" align="left" width="980px">';

            $letrasP2 = Controladorcuentas::ctrLetrasAceptar($vendedor, 60, 120);

            foreach($letrasP2 as $key => $value){

                echo '<tr>
                            
                        <td style="width:5%;text-align:center;"><b>'.$value["tipo_doc"].'</b></td>
                        <td style="width:10%;text-align:left;">'.$value["num_cta"].'</td>
                        <td style="width:8%;text-align:left;"><b>'.$value["fecha"].'</b></td>
                        <td style="width:8%;text-align:left;">'.$value["fecha_ven"].'</td>
                        <td style="width:5%;text-align:left;">'.$value["vendedor"].'</td>
                        <td style="width:8%;text-align:left;"><b>'.$value["cliente"].'</b></td>
                        <td style="width:30%;text-align:left;">'.$value["nombre"].'</td>
                        <td style="width:7%;text-align:right;"><b>S/ '.number_format($value["saldo"],2).'</b></td>
                    

                    </tr>';                    

            }

            echo '</table>';  

        }

        //*todo: 3 paginas
        else if($cantidadLetras > 120 && $cantidadLetras <= 180){

            echo $cabeceraGlobal;

            echo $cabecera;

            echo '<table border="1" align="left" width="980px">';

                $letrasP1 = Controladorcuentas::ctrLetrasAceptar($vendedor, 0, 60);

                foreach($letrasP1 as $key => $value){

                    echo '<tr>
                                
                            <td style="width:5%;text-align:center;"><b>'.$value["tipo_doc"].'</b></td>
                            <td style="width:10%;text-align:left;">'.$value["num_cta"].'</td>
                            <td style="width:8%;text-align:left;"><b>'.$value["fecha"].'</b></td>
                            <td style="width:8%;text-align:left;">'.$value["fecha_ven"].'</td>
                            <td style="width:5%;text-align:left;">'.$value["vendedor"].'</td>
                            <td style="width:8%;text-align:left;"><b>'.$value["cliente"].'</b></td>
                            <td style="width:30%;text-align:left;">'.$value["nombre"].'</td>
                            <td style="width:7%;text-align:right;"><b>S/ '.number_format($value["saldo"],2).'</b></td>
                        

                        </tr>';                    

                }

            echo '</table>';  
            
            for ($i=0; $i < 25; $i++) { 

                echo '<table border="0" align="left" width="900px">
                    <tr>
                        <td></td>
                    </tr>
                </table>';

            }

            echo $cabeceraGlobal;

            echo $cabecera;

            echo '<table border="1" align="left" width="980px">';

                $letrasP2 = Controladorcuentas::ctrLetrasAceptar($vendedor, 60, 60);

                foreach($letrasP2 as $key => $value){

                    echo '<tr>
                                
                            <td style="width:5%;text-align:center;"><b>'.$value["tipo_doc"].'</b></td>
                            <td style="width:10%;text-align:left;">'.$value["num_cta"].'</td>
                            <td style="width:8%;text-align:left;"><b>'.$value["fecha"].'</b></td>
                            <td style="width:8%;text-align:left;">'.$value["fecha_ven"].'</td>
                            <td style="width:5%;text-align:left;">'.$value["vendedor"].'</td>
                            <td style="width:8%;text-align:left;"><b>'.$value["cliente"].'</b></td>
                            <td style="width:30%;text-align:left;">'.$value["nombre"].'</td>
                            <td style="width:7%;text-align:right;"><b>S/ '.number_format($value["saldo"],2).'</b></td>
                        

                        </tr>';                    

                }

            echo '</table>';      

            for ($i=0; $i < 25; $i++) { 

                echo '<table border="0" align="left" width="900px">
                    <tr>
                        <td></td>
                    </tr>
                </table>';

            }            
            
            echo $cabeceraGlobal;

            echo $cabecera;

            echo '<table border="1" align="left" width="980px">';

                $letrasP2 = Controladorcuentas::ctrLetrasAceptar($vendedor, 120, 60);

                foreach($letrasP2 as $key => $value){

                    echo '<tr>
                                
                            <td style="width:5%;text-align:center;"><b>'.$value["tipo_doc"].'</b></td>
                            <td style="width:10%;text-align:left;">'.$value["num_cta"].'</td>
                            <td style="width:8%;text-align:left;"><b>'.$value["fecha"].'</b></td>
                            <td style="width:8%;text-align:left;">'.$value["fecha_ven"].'</td>
                            <td style="width:5%;text-align:left;">'.$value["vendedor"].'</td>
                            <td style="width:8%;text-align:left;"><b>'.$value["cliente"].'</b></td>
                            <td style="width:30%;text-align:left;">'.$value["nombre"].'</td>
                            <td style="width:7%;text-align:right;"><b>S/ '.number_format($value["saldo"],2).'</b></td>
                        

                        </tr>';                    

                }

            echo '</table>';              


        }

        //*todo: 4 paginas
        else if($cantidadLetras > 180 && $cantidadLetras <= 200){

            echo $cabeceraGlobal;

            echo $cabecera;

            echo '<table border="1" align="left" width="980px">';

                $letrasP1 = Controladorcuentas::ctrLetrasAceptar($vendedor, 0, 60);

                foreach($letrasP1 as $key => $value){

                    echo '<tr>
                                
                            <td style="width:5%;text-align:center;"><b>'.$value["tipo_doc"].'</b></td>
                            <td style="width:10%;text-align:left;">'.$value["num_cta"].'</td>
                            <td style="width:8%;text-align:left;"><b>'.$value["fecha"].'</b></td>
                            <td style="width:8%;text-align:left;">'.$value["fecha_ven"].'</td>
                            <td style="width:5%;text-align:left;">'.$value["vendedor"].'</td>
                            <td style="width:8%;text-align:left;"><b>'.$value["cliente"].'</b></td>
                            <td style="width:30%;text-align:left;">'.$value["nombre"].'</td>
                            <td style="width:7%;text-align:right;"><b>S/ '.number_format($value["saldo"],2).'</b></td>
                        

                        </tr>';                    

                }

            echo '</table>';        
            
            for ($i=0; $i < 25; $i++) { 

                echo '<table border="0" align="left" width="900px">
                    <tr>
                        <td></td>
                    </tr>
                </table>';
    
            }
    
            echo $cabeceraGlobal;
    
            echo $cabecera;    
            
            echo '<table border="1" align="left" width="980px">';
    
                $letrasP2 = Controladorcuentas::ctrLetrasAceptar($vendedor, 60, 60);
    
                foreach($letrasP2 as $key => $value){
    
                    echo '<tr>
                                
                            <td style="width:5%;text-align:center;"><b>'.$value["tipo_doc"].'</b></td>
                            <td style="width:10%;text-align:left;">'.$value["num_cta"].'</td>
                            <td style="width:8%;text-align:left;"><b>'.$value["fecha"].'</b></td>
                            <td style="width:8%;text-align:left;">'.$value["fecha_ven"].'</td>
                            <td style="width:5%;text-align:left;">'.$value["vendedor"].'</td>
                            <td style="width:8%;text-align:left;"><b>'.$value["cliente"].'</b></td>
                            <td style="width:30%;text-align:left;">'.$value["nombre"].'</td>
                            <td style="width:7%;text-align:right;"><b>S/ '.number_format($value["saldo"],2).'</b></td>
                        
    
                        </tr>';                    
    
                }
    
            echo '</table>';  
            
            for ($i=0; $i < 25; $i++) { 

                echo '<table border="0" align="left" width="900px">
                    <tr>
                        <td></td>
                    </tr>
                </table>';

            }            
            
            echo $cabeceraGlobal;

            echo $cabecera;

            echo '<table border="1" align="left" width="980px">';

                $letrasP2 = Controladorcuentas::ctrLetrasAceptar($vendedor, 120, 60);

                foreach($letrasP2 as $key => $value){

                    echo '<tr>
                                
                            <td style="width:5%;text-align:center;"><b>'.$value["tipo_doc"].'</b></td>
                            <td style="width:10%;text-align:left;">'.$value["num_cta"].'</td>
                            <td style="width:8%;text-align:left;"><b>'.$value["fecha"].'</b></td>
                            <td style="width:8%;text-align:left;">'.$value["fecha_ven"].'</td>
                            <td style="width:5%;text-align:left;">'.$value["vendedor"].'</td>
                            <td style="width:8%;text-align:left;"><b>'.$value["cliente"].'</b></td>
                            <td style="width:30%;text-align:left;">'.$value["nombre"].'</td>
                            <td style="width:7%;text-align:right;"><b>S/ '.number_format($value["saldo"],2).'</b></td>
                        

                        </tr>';                    

                }

            echo '</table>';                

            for ($i=0; $i < 25; $i++) { 

                echo '<table border="0" align="left" width="900px">
                    <tr>
                        <td></td>
                    </tr>
                </table>';

            }            
            
            echo $cabeceraGlobal;

            echo $cabecera;

            echo '<table border="1" align="left" width="980px">';

                $letrasP2 = Controladorcuentas::ctrLetrasAceptar($vendedor, 180, 60);

                foreach($letrasP2 as $key => $value){

                    echo '<tr>
                                
                            <td style="width:5%;text-align:center;"><b>'.$value["tipo_doc"].'</b></td>
                            <td style="width:10%;text-align:left;">'.$value["num_cta"].'</td>
                            <td style="width:8%;text-align:left;"><b>'.$value["fecha"].'</b></td>
                            <td style="width:8%;text-align:left;">'.$value["fecha_ven"].'</td>
                            <td style="width:5%;text-align:left;">'.$value["vendedor"].'</td>
                            <td style="width:8%;text-align:left;"><b>'.$value["cliente"].'</b></td>
                            <td style="width:30%;text-align:left;">'.$value["nombre"].'</td>
                            <td style="width:7%;text-align:right;"><b>S/ '.number_format($value["saldo"],2).'</b></td>
                        

                        </tr>';                    

                }

            echo '</table>';   

        }

        echo '<table border="1" align="left" width="980px">';

        $total = Controladorcuentas::ctrLetrasAceptarTotal($vendedor);
        #var_dump($total);

        echo '<tr>
                                
            <td style="width:5%;text-align:center;"><b></b></td>
            <td style="width:10%;text-align:left;"></td>
            <td style="width:8%;text-align:left;"><b></b></td>
            <td style="width:8%;text-align:left;"></td>
            <td style="width:5%;text-align:left;"></td>
            <td style="width:8%;text-align:left;"><b></b></td>
            <th style="width:30%;text-align:left;">TOTAL VENDEDOR</th>
            <th style="width:7%;text-align:right;"><b>S/ '.number_format($total["saldo"],2).'</b></th>
        

        </tr>';          

        echo '</table>';           

        ?>


    </div>
    <p>&nbsp;</p>

</body>

</html>




