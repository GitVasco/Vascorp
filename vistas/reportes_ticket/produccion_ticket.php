  <html>

  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="css/ticket.css" target="_blank" rel="stylesheet" type="text/css">
  </head>

  <body onload="window.print();">
  <?php
  require_once "../../controladores/cortes.controlador.php";
  require_once "../../modelos/cortes.modelo.php";

  /* 
  todo: traemos todos lso datos para el ticket
  */
  $codigo = $_GET["codigo"];
  $fecha = date("d-m-Y");

  $respuesta = ControladorCortes::ctrMostrarEnTalleres($codigo);
  //var_dump($respuesta);

  //Establecemos los datos de la empresa
  $empresa = "Corporacion Vasco S.A.C.";
  $documento = "20513613939";

  ?>
    <div class="zona_impresion">
      <!-- codigo imprimir -->
      <br>

      <?php

        foreach ($respuesta as $key => $value) {

        echo '<table border="0" align="center" width="300px">

                <br>

                <tr>
                  <td colspan="3">================================</td>
                </tr>  

                <tr>
                  <td align="center">
                    <!-- Mostramos los datos de la empresa en el documento HTML -->
                    .::<strong> '.$empresa.' </strong>::.<br>
                    '.$documento.'<br>
                  </td>
                </tr>

                <tr>
                  <td colspan="3">================================</td>
                </tr>  

                <tr>
                  <!-- Mostramos los datos del cliente en el documento HTML -->
                  <td><strong>Trabajador:  </strong></td>
                </tr>

                <tr>
                <td colspan="3">================================</td>
                </tr>

            </table>

            <table border="0" align="center" width="300px">

              <tr>
                <td><strong>Modelo</strong></td>
                <td><strong>Nombre</strong></td>      
              </tr>
              
              <tr>
                <td>'.$value["modelo"].'</td>
                <td>'.$value["nombre"].'</td>
              </tr>
    
            </table>
        
            <table border="0" align="center" width="300px">

                    <tr>
                      <td><strong>Color</strong></td>
                      <td><strong>Talla</strong></td>      
                      <td><strong>Cantidad</strong></td>
                    </tr>
                    
                    <tr>
                      <td>'.$value["color"].'</td>
                      <td>'.$value["talla"].'</td>
                      <td>'.$value["cantidad"].'</td>
                    </tr>

                </table>
                
            <table border="0" align="center" width="300px">

                <tr>
                  <td><strong>Cod. Operación</strong></td>
                  <td><strong>Operación</strong></td>      
                </tr>
                
                <tr>
                  <td>'.$value["cod_operacion"].'</td>
                  <td>'.$value["operacion"]." 0".($key+1)'</td>
                </tr>
        
            </table>
            
            <table border="0" align="center" width="300px">

              <tr>
        
                <td align="center">
      
                  <input type="hidden" name="codigo" id="'.$value["codigo"].'" value="'.$value["codigo"].'">
                  <span>
                    <svg id="barcode'.$value["codigo"].'" style="width: 350px; height:200px;"></svg>
                  </span> 
      
                </td>
      
              </tr>
      
            </table>
            <script src="../bower_components/barcode/JsBarcode.all.min.js"></script>
            
            <script>

              var c'.$value["codigo"].' = document.getElementById("'.$value["codigo"].'").value;
              console.log(c'.$value["codigo"].');
        
              JsBarcode("#barcode'.$value["codigo"].'", c'.$value["codigo"].')
      
            </script>';

        }
     
      
      ?> 

      <br>
    </div>
    <p>&nbsp;</p>

  </body>

  </html>




