<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link href="css/ticket_v3.css" target="_blank" rel="stylesheet" type="text/css">
</head>

<body onload="window.print();">
  <?php

    require_once "../../controladores/trabajador.controlador.php";
    require_once "../../modelos/trabajador.modelo.php";

  

    $respuesta = ControladorTrabajador::ctrMostrarTrabajador2(null);
    //var_dump($respuesta["pedido"]);
    //var_dump($respuesta);


    date_default_timezone_set("America/Lima");

    //var_dump($respuesta["fecha"]);

    $newDay = date("d");
    $newMonth = date("m");
    $newYear = date("Y");

    if($newMonth == "01"){
        $mes="Enero";
    }if($newMonth == "02"){
        $mes="Febrero";
    }if($newMonth == "03"){
        $mes="Marzo";
    }if($newMonth == "04"){
        $mes="Abril";
    }if($newMonth == "05"){
        $mes="Mayo";
    }if($newMonth == "06"){
        $mes="Junio";
    }if($newMonth == "07"){
        $mes="Julio";
    }if($newMonth == "08"){
        $mes="Agosto";
    }if($newMonth == "09"){
        $mes="Septiembre";
    }if($newMonth == "10"){
        $mes="Octubre";
    }if($newMonth == "11"){
        $mes="Noviembre";
    }else{
        $mes="Diciembre";
    }

    
    //var_dump($newDate);

  ?>
  <div class="zona_impresion">
  <!-- codigo imprimir -->

    <table border="0" align="left" width="1300px">

    <thead>
    <tr style="height:400px;"></tr>
    <?php
        
        foreach ($respuesta as $key => $value) {
       echo
      '<tr>
        <div class="carnet fondo">
            <img src="../../vistas/img/plantilla/jackyform_letras.png" width="200px" height="100px">
            <p style="border:1px solid pink; width:100%"></p>
            <img src="../../vistas/img/modelos/10010/117.png" width="100px" height="150px">
            <p><b>'.$value["ape_pat"]." ".$value["ape_mat"].'<br>'.$value["nombres"].'</b></p>
            <p><b>D.N.I: '.$value["dni"].'</b></p>
            <p><b>'.$value["funcion"].'</b></p>

        </div>';

        }
        ?>
        
      </tr>
      

    </thead>

    </table>


  </div>
  <p>&nbsp;</p>

</body>

</html>
