<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Administrar Proformas

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Administrar Proformas</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">
                <button type="button" class="btn btn-default pull-right" id="daterange-btnProforma">
                <span>
                    <i class="fa fa-calendar"></i>

                    <?php

                    if(isset($_GET["fechaInicial"])){

                        echo $_GET["fechaInicial"]." - ".$_GET["fechaFinal"];

                    }else{
                    
                        echo 'Rango de fecha';

                    }

                    ?>

                </span>

                <i class="fa fa-caret-down"></i>

                </button>
            </div>

            <div class="box-body">
                <input type="hidden" value="<?= $_SESSION["perfil"]; ?>" id="perfilOculto">
                <input type="hidden" value="<?= $_GET["ruta"]; ?>" id="rutaAcceso">     
                <table class="table table-bordered table-striped dt-responsive tablaProformas" width="100%">

                    <thead>

                        <tr>

                            <th>Tipo Documento</th>
                            <th>Documento</th>
                            <th>Total</th>
                            <th>Cod. Cliente</th>
                            <th>Nombre</th>
                            <th>Vendedor</th>
                            <th>Fec. Emisión</th>
                            <th>Doc. Destino</th>
                            <th>Estado</th>
                            <th>Destino</th>
                            <th>Fotos</th>
                            <th>Acciones</th>
                            

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

</div>

<!--=====================================
MODAL EDITAR MODELO
======================================-->

<div id="modalCargarFotos" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Cargar cargo y recepción</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

            <div class="box-body">

            <input type="hidden" name="tipo" id="tipo">
            <input type="hidden" name="documento" id="documento">
                <!-- ENTRADA PARA SUBIR FOTO CARGO -->

                <div class="form-group">

                    <div class="panel">SUBIR CARGO</div>

                    <input type="file" class="editarCargo" name="editarCargo">

                    <p class="help-block">Peso máximo de la imagen 2MB</p>

                    <img src="vistas/img/articulos/default/anonymous.png" class="img-thumbnail previsualizarCar" width="100px">

                    <input type="hidden" name="imagenActualCar" id="imagenActualCar">

                </div>

                <!-- ENTRADA PARA SUBIR FOTO RECEPCION -->

                <div class="form-group">

                    <div class="panel">SUBIR RECEPCION</div>

                    <input type="file" class="editarRecepcion" name="editarRecepcion">

                    <p class="help-block">Peso máximo de la imagen 2MB</p>

                    <img src="vistas/img/articulos/default/anonymous.png" class="img-thumbnail previsualizarRep" width="100px">

                    <input type="hidden" name="imagenActualRep" id="imagenActualRep">

                </div>                

            </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        <button type="submit" class="btn btn-primary">Guardar Fotos</button>

        </div>

      </form>
      <?php

      $crearImagen = new ControladorFacturacion();
      $crearImagen->ctrCargarImagen();

      ?>
    </div>

  </div>

</div>

<?php

$anularDocumento = new ControladorFacturacion();
$anularDocumento -> ctrAnularDocumento();

$eliminarDocumento = new ControladorFacturacion();
$eliminarDocumento -> ctrEliminarDocumento();
?>

<script>
    window.document.title = "Proformas"
</script>