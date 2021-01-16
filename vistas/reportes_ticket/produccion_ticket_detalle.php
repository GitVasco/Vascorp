<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link href="css/ticket.css" target="_blank" rel="stylesheet" type="text/css">
</head>

<body onload="window.print();">
  <?php

/* 
todo: traemos todos lso datos para el ticket
*/
$modelo = $_GET["modelo"];

$nombre = $_GET["nombre"];
$color = $_GET["color"];
$talla = $_GET["talla"];
$cantidad= $_GET["cant_taller"];

$cod_operacion = $_GET["cod_operacion"];
$nom_operacion = $_GET["nom_operacion"];

$fecha = date("d-m-Y");

$codigo = $_GET["ultimo"];

//Establecemos los datos de la empresa
$empresa = "Corporacion Vasco S.A.C.";
$documento = "20513613939";

?>
  <div class="zona_impresion">
    <!-- codigo imprimir -->
    <br>

    <table border="0" align="center" width="300px">

      <tr>
        <td align="center">
          <!-- Mostramos los datos de la empresa en el documento HTML -->
          .::<strong> <?php echo $empresa; ?></strong>::.<br>
          <?php echo $documento; ?><br>
        </td>
      </tr>
  
      <tr>
        <td align="center"><?php echo $fecha; ?></td>
      </tr>

      <tr>
        <td colspan="3">===============================</td>
      </tr>  

      <tr>
        <!-- Mostramos los datos del cliente en el documento HTML -->
        <td><strong>Trabajador:  </strong></td>
      </tr>
      <tr>
      <td colspan="3">===============================</td>
      </tr>

    </table>

    <table border="0" align="center" width="300px">

      <tr>
        <td><b><u>Modelo</u></b></td>
        <td><b><u>Nombre</u></b></td>      
      </tr>
      
      <tr>
        <td style="font-size: x-large;"><strong><?php echo $modelo?></strong></td>
        <td style="font-size: x-large;"><strong><?php echo $nombre?></strong></td>
      </tr>

    </table>

    <br>

    <table border="0" align="center" width="300px">

      <tr>
        <td><b><u>Color</u></b></td>
        <td><b><u>Talla</u></b></td>      
        <td><b><u>Cantidad</u></b></td>
      </tr>
      
      <tr>
        <td style="font-size: x-large;"><strong><?php echo $color?></strong></td>
        <td style="font-size: x-large;"><strong><?php echo $talla?></strong></td>
        <td style="font-size: x-large;"><strong><?php echo $cantidad?></strong></td>
      </tr>

    </table>

    <br>

    <table border="0" align="center" width="300px">

      <tr>
        <td><b><u>Cod. Op.</u></b></td>
        <td><b><u>Operación</u></b></td>      
      </tr>
      
      <tr>
        <td><strong><?php echo $cod_operacion?></strong></td>
        <td style="font-size: x-large;"><strong><?php echo $nom_operacion?></strong></td>
      </tr>

    </table>


    <table border="0" align="center" width="300px">

      <tr>
 
        <td align="center">

          <input type="hidden" name="codigo" id="codigo" value=<?php echo $codigo?>>
          <div>
            <svg id="barcode" style="width: 400px; height:220px;"></svg>
          </div> 

        </td>

      </tr>

    </table>
 

    <br>
  </div>
  <p>&nbsp;</p>

</body>

</html>

<script src="../bower_components/barcode/JsBarcode.all.min.js"></script>

<script>

  var codigo = document.getElementById("codigo").value;
  //console.log(codigo);

  JsBarcode("#barcode", codigo)


</script>
