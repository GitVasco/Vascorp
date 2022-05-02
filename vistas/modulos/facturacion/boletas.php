<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Administrar Boletas

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Administrar Facturas</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <button type="button" class="btn btn-default pull-right" id="daterange-btnBoleta">
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

                <table class="table table-bordered table-striped dt-responsive tablaBoletas" width="100%">

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
                            <th>Destino</th>
                            <th>Responsable</th>
                            <th>Fotos</th>
                            <th style="width:180px">Acciones</th>

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

<!--=====================================
MODAL CCUENTA
======================================-->

<div id="modalCuenta" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Asignar cuenta</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

            <div class="box-body">
                <!-- ENTRADA PARA SUBIR FOTO CARGO -->

                <div class="form-group">

          <div class="box box-primary col-lg-12 ">

            <div class="box-header">

              <b>Datos Principales</b>

            </div>

              <!-- ENTRADA PARA EL CODIGO DEL PEDIDO-->

              <div class="form-group col-lg-4">

                  <label>Cod. Cliente</label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-key"></i></span>

                      <input type="text" class="form-control input-sm" id="codCliCta" name="codCliCta" readonly>

                  </div>

              </div>

              <!-- ENTRADA PARA EL NOMBRE DEL CLIENTE-->

              <div class="form-group col-lg-8">

                  <label>Cliente</label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-key"></i></span>

                      <input type="text" class="form-control input-sm" id="nomCliCta" name="nomCliCta" readonly>

                  </div>

              </div>


              <!-- ENTRADA PARA EL TIPO DOCUMENTO DEL CLIENTE-->

              <div class="form-group col-lg-4">

                  <label>Tipo Documento</label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-key"></i></span>

                      <input type="text" class="form-control input-sm" id="tipDocCta" name="tipDocCta" readonly>

                  </div>

              </div>

              <!-- ENTRADA PARA EL NUMERO DOCUMENTO DEL CLIENTE-->

              <div class="form-group col-lg-4">

                  <label>Nro. Documento</label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-key"></i></span>

                      <input type="text" class="form-control input-sm" id="nroDocCta" name="nroDocCta" readonly>

                  </div>

              </div>

              <!-- ENTRADA PARA EL NUMERO DOCUMENTO DEL CLIENTE-->

              <div class="form-group col-lg-4">

                  <label>Zona</label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-key"></i></span>

                      <input type="text" class="form-control input-sm" id="zonaCta" name="zonaCta" readonly>

                  </div>

              </div>              

          </div>                

                    <div class="panel">Cuenta</div>

                        <select type="text" class="form-control input-sm selectpicker" name="formaPagoCta" id="formaPagoCta" data-live-search="true"  required>
                        <option value="">Seleccionar Cuenta</option>

                            <?php

                            $valor = "01";

                            $documentos = ControladorPedidos::ctrTraerCuentas($valor);
                            foreach ($documentos as $key => $value) {
                                echo '<option value="' . $value["codigo"] . '">' . $value["cuenta"] . '</option>';
                            }

                            ?>

                        </select>


                </div>

            </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        <button type="submit" class="btn btn-primary">Guardar cambioss</button>

        </div>

      </form>
      <?php

      $cuenta = new ControladorFacturacion();
      $cuenta -> ctrAsignarCuenta();

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
    window.document.title = "Boletas"
</script>