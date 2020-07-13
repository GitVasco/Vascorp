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
$articulo = $_GET["articulo"];
$modelo = $_GET["modelo"];

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
          <?php echo $articulo; ?><br>
          <?php echo $modelo; ?><br>
        </td>

      </tr>


    <br>
  </div>
  <p>&nbsp;</p>

</body>

</html>
