<?php

session_start();

?>

<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Vasco System</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="vistas/img/plantilla/vascorp.png">

  <!--=====================================
  PLUGINS DE CSS
  ======================================-->

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">

  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- DataTables -->
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="vistas/plugins/iCheck/all.css"> 

  <!-- SELECT2 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css">

  <!-- Daterange picker -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.css">  

  <!-- Morris chart -->
  <link rel="stylesheet" href="vistas/bower_components/morris.js/morris.css">

  <!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->

  <!-- jQuery 3 -->
  <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap 3.3.7 -->
  <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- FastClick -->
  <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>

  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>

  <!-- DataTables -->
  <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

  <!-- SweetAlert 2 -->
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
  <!-- By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

  <!-- iCheck 1.0.1 -->
  <script src="vistas/plugins/iCheck/icheck.min.js"></script>  

  <!-- InputMask -->
  <script src="vistas/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script>
  
  <!-- bootstrap-select -->

  <script src="vistas/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

  <!-- jQuery Number -->
  <script src="vistas/plugins/jqueryNumber/jquerynumber.min.js"></script>

  <!-- daterangepicker http://www.daterangepicker.com/-->
  <script src="vistas/bower_components/moment/min/moment.min.js"></script>
  <script src="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>  

  <!-- Morris.js charts http://morrisjs.github.io/morris.js/-->
  <script src="vistas/bower_components/raphael/raphael.min.js"></script>
  <script src="vistas/bower_components/morris.js/morris.min.js"></script>

  <!-- ChartJS http://www.chartjs.org/-->
  <script src="vistas/bower_components/Chart.js/Chart.js"></script>
  <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment-with-locales.min.js"></script>

</head>

<!--=====================================
CUERPO DOCUMENTO
======================================-->

<body class="hold-transition skin-blue-light sidebar-collapse sidebar-mini login-page">

  <?php

  if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){

   echo '<div class="wrapper">';

    /*=============================================
    CABEZOTE
    =============================================*/

    include "modulos/cabezote.php";

    /*=============================================
    MENU
    =============================================*/

    include "modulos/menu.php";

    /*=============================================
    CONTENIDO
    =============================================*/

      if(isset($_GET["ruta"])){

        if( $_GET["ruta"] == "inicio" ||
            $_GET["ruta"] == "inicio-gerencia"){

              include "modulos/".$_GET["ruta"].".php";

        }else if( $_GET["ruta"] == "usuarios"){

              include "modulos/usuarios/".$_GET["ruta"].".php";

        }else if( $_GET["ruta"] == "backupDB" ||
                  $_GET["ruta"] == "bkplista" ||
                  $_GET["ruta"] == "movimientos" ||
                  $_GET["ruta"] == "conexionjf"){

              include "modulos/backend/".$_GET["ruta"].".php";

        }else if( $_GET["ruta"] == "m-produccion" ||
                  $_GET["ruta"] == "m-ventas" ||
                  $_GET["ruta"] == "mp-ingresos" ||
                  $_GET["ruta"] == "mp-salidas"){

                include "modulos/movimientos/".$_GET["ruta"].".php";              

        }else if( $_GET["ruta"] == "articulos" ||
                  $_GET["ruta"] == "materiaprima" ||
                  $_GET["ruta"] == "marcas" ||
                  $_GET["ruta"] == "colores" ||
                  $_GET["ruta"] == "tipodocumentos" ||
                  $_GET["ruta"] == "tipotrabajador" ||
                  $_GET["ruta"] == "trabajador" ||
                  $_GET["ruta"] == "operaciones" ||
                  $_GET["ruta"] == "modelosjf" ||
                  $_GET["ruta"] == "crear-articulo" ||
                  $_GET["ruta"] == "sectores" ||
                  $_GET["ruta"] == "paras" ||
                  $_GET["ruta"] == "agencias" ||
                  $_GET["ruta"] == "tipomovimientos" ||
                  $_GET["ruta"] == "tipopagos" ||
                  $_GET["ruta"] == "condicionesventa" ||
                  $_GET["ruta"] == "unidadesmedida" ){

              include "modulos/maestros/".$_GET["ruta"].".php";

        }else if( $_GET["ruta"] == "ordencorte" ||
                  $_GET["ruta"] == "crear-ordencorte" ||
                  $_GET["ruta"] == "editar-ordencorte" ||
                  $_GET["ruta"] == "editar-detalle-ordencorte" ||
                  $_GET["ruta"] == "almacencorte" ||
                  $_GET["ruta"] == "crear-almacencorte" ||
                  $_GET["ruta"] == "editar-almacencorte" ||
                  $_GET["ruta"] == "urgencias" ||
                  $_GET["ruta"] == "urgenciasamp" ||
                  $_GET["ruta"] == "en-cortes" ||
                  $_GET["ruta"] == "en-taller" ||
                  $_GET["ruta"] == "asistencia" ||
                  $_GET["ruta"] == "ingresos" ||
                  $_GET["ruta"] == "crear-ingresos" ||
                  $_GET["ruta"] == "editar-ingreso" ||
                  $_GET["ruta"] == "crear-segunda" ||
                  $_GET["ruta"] == "editar-segunda" ||
                  $_GET["ruta"] == "en-tallert" ||
                  $_GET["ruta"] == "marcar-taller" ||
                  $_GET["ruta"] == "proyeccion-mp" ||
                  $_GET["ruta"] == "produccion-trusas" ||
                  $_GET["ruta"] == "produccion-brasier" ||
                  $_GET["ruta"] == "produccion-vasco" ||
                  $_GET["ruta"] == "quincena" ||
                  $_GET["ruta"] == "eficiencia" ||
                  $_GET["ruta"] == "pagos"){

              include "modulos/produccion/".$_GET["ruta"].".php";

        }else if( $_GET["ruta"] == "tarjetas" ||
                  $_GET["ruta"] == "crear-tarjeta" ||
                  $_GET["ruta"] == "editar-tarjeta" ||
                  $_GET["ruta"] == "copiar-tarjeta" ||
                  $_GET["ruta"] == "ficha-tecnica"){

              include "modulos/tarjetas/".$_GET["ruta"].".php";

        }else if( $_GET["ruta"] == "categorias" ||
                  $_GET["ruta"] == "productos" ||
                  $_GET["ruta"] == "ventas" ||
                  $_GET["ruta"] == "crear-venta" ||
                  $_GET["ruta"] == "editar-venta"){

              include "modulos/curso/".$_GET["ruta"].".php";

        }else if( $_GET["ruta"] == "contactos" ||
                  $_GET["ruta"] == "mailbox" ||
                  $_GET["ruta"] == "mensajes"){

              include "modulos/ticket/".$_GET["ruta"].".php";

        }else if( $_GET["ruta"] == "pedidoscv" ||
                  $_GET["ruta"] == "clientes" ||
                  $_GET["ruta"] == "crear-pedidocv"){

              include "modulos/facturacion/".$_GET["ruta"].".php";

        }else if( $_GET["ruta"] == "detalleoperaciones" ||
                  $_GET["ruta"] == "creardetalleoperaciones" ||
                  $_GET["ruta"] == "editardetalleoperaciones") {

              include "modulos/operaciones/".$_GET["ruta"].".php";

        }else if( $_GET["ruta"] == "salir" ||
                  $_GET["ruta"] == "reportes"){

              include "modulos/".$_GET["ruta"].".php";

        }else if($_GET["ruta"] == "leer-stock" ||
        $_GET["ruta"] == "cargas-automaticas"){
          include "reportes_excel/".$_GET["ruta"].".php";

        }else{

          include "modulos/404.php";

        }

      }else{

        include "modulos/inicio.php";

      }

    /*=============================================
    FOOTER
    =============================================*/

    include "modulos/footer.php";

    echo '</div>';

  }else{

    include "modulos/login.php";

  }

  ?>


  <script src="vistas/js/plantilla.js"></script>
  <script src="vistas/js/usuarios.js"></script>
  <script src="vistas/js/categorias.js"></script>
  <script src="vistas/js/productos.js"></script>
  <script src="vistas/js/clientes.js"></script>
  <script src="vistas/js/ventas.js"></script>
  <script src="vistas/js/reportes.js"></script>
  <script src="vistas/js/tipodocumento.js"></script>
  <script src="vistas/js/tipotrabajador.js"></script>

  <script src="vistas/js/articulos.js"></script>
  <script src="vistas/js/marcas.js"></script>
  <script src="vistas/js/colores.js"></script>
  <script src="vistas/js/materiaprima.js"></script>
  <script src="vistas/js/tarjetas.js"></script>
  <script src="vistas/js/movimientos.js"></script>
  <script src="vistas/js/ordencorte.js"></script>
  <script src="vistas/js/urgencias.js"></script>
  <script src="vistas/js/contactos.js"></script>
  <script src="vistas/js/mensajes.js"></script>
  <script src="vistas/js/pedidoscv.js"></script>
  <script src="vistas/js/almacencorte.js"></script>
  <script src="vistas/js/operaciones.js"></script>
  <script src="vistas/js/trabajador.js"></script>
  <script src="vistas/js/modelos.js"></script>
  <script src="vistas/js/cortes.js"></script>
  <script src="vistas/js/talleres.js"></script>
  <script src="vistas/js/sectores.js"></script>
  <script src="vistas/js/paras.js"></script>
  <script src="vistas/js/asistencias.js"></script>
  <script src="vistas/js/produccion.js"></script>
  <script src="vistas/js/agencias.js"></script>
  <script src="vistas/js/tipomovimientos.js"></script>
  <script src="vistas/js/tipopagos.js"></script>
  <script src="vistas/js/condicionesventa.js"></script>
  <script src="vistas/js/unidadesmedida.js"></script>

</body>

</html>
