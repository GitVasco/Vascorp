<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Administrar Facturas

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Administrar Facturas</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <button type="button" class="btn btn-default pull-right" id="daterange-btnFactura">
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

                <table class="table table-bordered table-striped dt-responsive tablaFacturas" width="100%">

                    <thead>

                        <tr>

                            <th>Tipo Doc.</th>
                            <th>Documento</th>
                            <th>Total</th>
                            <th>Cliente</th>
                            <th>Nombre</th>
                            <th>Vend.</th>
                            <th>Fec. Emi.</th>
                            <th>Doc. Dest.</th>
                            <th>Cond. Venta</th>
                            <th>Estado</th>
                            <th>Agencia</th>
                            <th>Destino</th>
                            <th>Responsable</th>
                            <th style="width:130px">Acciones</th>

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

                <div class="form-group">

                    <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-text-height"></i></span>

                        <select class="form-control input-lg" name="tipo" id="tipo" required>

                            <option value="CA">CARGO</option>
                            <option value="RE">RECEPCIÓN</option>

                        </select>

                    </div>

                </div>

                <!-- ENTRADA PARA SUBIR FOTO -->

                <div class="form-group">

                    <div class="panel">SUBIR IMAGEN</div>

                    <input type="file" class="nuevaImagen" name="nuevaImagen">

                    <p class="help-block">Peso máximo de la imagen 2MB</p>

                    <img src="vistas/img/articulos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

                </div>

            </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

      </form>
      <?php

      /* $crearImagen = new ControladorFacturacion();
      $crearImagen->ctrCargarImagen(); */

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
    window.document.title = "Facturas"
</script>