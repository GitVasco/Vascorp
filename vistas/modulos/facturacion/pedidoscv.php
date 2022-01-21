<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Pedidos General

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Pedidos General</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <div class="btn-group pull-left">

        <?php

          #$numero = ControladorMovimientos::ctrMostrarTalonario();

          $pedido = "";
          #$pedido = $numero["pedido"] + 1;
          #var_dump("pedido", $pedido);

          echo '<button class="btn btn-primary  btnCrearPedido" pedido="'.$pedido.'" title="Crear Pedido">

                  Crear Pedido

                </button>';


        ?>

        <?php
        
          //var_dump($_SESSION["id"]);

          if( $_SESSION["id"] == "6" || 
              $_SESSION["id"] == "53" || 
              $_SESSION["id"] == "54" || 
              $_SESSION["id"] == "55"){

            echo '<button class="btn btn-success btnEnviarPedido" data-toggle="modal"       data-target="#modalEnviarPedido">
            <i class="fa fa-plane"></i>
            Enviar Pedidos

                </button>';

            echo '<div class="col-lg-6">

                  <form role="form"  method="POST" enctype="multipart/form-data">
                      <div class="col-lg-10">
                          <input type="file" name="archivoPedTxt" id="archivoPedTxt" class="form-control" accept="text/plain">
                      </div>
                      <div class="col-lg-2">
                          <button type="submit"  class="btn btn-info" name="importPedTxt"><i class="fa fa-upload"></i> Cargar Pedidos</a>
                      </div>
                  </form>';

                  $actualizarStock = new ControladorPedidos();
                  $actualizarStock -> ctrLeerPedido();

            echo '</div>  ';

          }

        
        ?>

        </div>

        <div class="btn-group pull-right" style="margin: 13px;">

          <button class="btn btn-success  btnFacturados"  title="Ver Pedidos FACTURADOS">

            FACTURADOS

          </button>

        </div>

        <div class="btn-group pull-right" style="margin: 13px;">

          <button class="btn btn-info  btnConfirmados"  title="Ver Pedidos CONFIRMADOS">

            CONFIRMADOS

          </button>

        </div>

        <div class="btn-group pull-right" style="margin: 13px;">

          <button class="btn btn-default  btnAPT"  title="Ver Pedidos EN APT">

            EN APT

          </button>

        </div>

        <div class="btn-group pull-right" style="margin: 13px;">

          <button class="btn btn-warning  btnAprobados" title="Ver Pedidos APROBADOS">

            APROBADOS

          </button>

        </div>

        <div class="btn-group pull-right" style="margin: 13px;">

          <button class="btn btn-basic  btnGenerados" title="Ver Pedidos Generados">

            GENERADOS

          </button>

        </div>

        <div class="btn-group pull-right" style="margin: 13px;">

          <button class='btn btnInicioPed' style='background-color:DarkSlateGray' title='inicio'>
            <i style='color:white'  class='fa fa-home'></i>
          </button>

        </div>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablaPedidosCV" width="100%">

          <thead>

            <tr>
              <th>Id</th>
              <th>Código</th>
              <th>Cod. Cliente</th>
              <th>Cliente</th>
              <th>Vendedor</th>
              <th>Total</th>
              <th>Condición de Venta</th>
              <th>Estado</th>
              <th>Usuario</th>
              <th>Fecha</th>
              <th width="200px">Acciones</th>
            </tr>

          </thead>

        </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL FACTURAR
======================================-->

<div id="modalFacturar" class="modal fade" role="dialog">

  <div class="modal-dialog" style="width: 50% !important;">

    <div class="modal-content">

      <form role="form" method="post" onsubmit="return checkSubmit();">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Pasar Pedido a:</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          <div class="box box-primary col-lg-12 ">

            <div class="box-header">

              <b>Datos Principales</b>

            </div>

              <!-- ENTRADA PARA EL CODIGO DEL PEDIDO-->

              <div class="form-group col-lg-3">

                  <label>Cod. Pedido</label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-key"></i></span>

                      <input type="text" class="form-control input-sm" id="codPedido" name="codPedido" readonly>

                  </div>

              </div>

              <!-- ENTRADA PARA EL NOMBRE DEL CLIENTE-->

              <div class="form-group col-lg-9">

                  <label>Cliente</label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-key"></i></span>

                      <input type="text" class="form-control input-sm" id="nomCli" name="nomCli" readonly>

                  </div>

              </div>

              <!-- ENTRADA PARA EL codigo DEL CLIENTE-->

              <div class="form-group col-lg-4">

                  <label>Cod. Cliente</label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-key"></i></span>

                      <input type="text" class="form-control input-sm" id="codCli" name="codCli" readonly>

                  </div>

              </div>

              <!-- ENTRADA PARA EL TIPO DOCUMENTO DEL CLIENTE-->

              <div class="form-group col-lg-4">

                  <label>Tipo Documento</label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-key"></i></span>

                      <input type="text" class="form-control input-sm" id="tipDoc" name="tipDoc" readonly>

                  </div>

              </div>

              <!-- ENTRADA PARA EL NUMERO DOCUMENTO DEL CLIENTE-->

              <div class="form-group col-lg-4">

                  <label>Nro. Documento</label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-key"></i></span>

                      <input type="text" class="form-control input-sm" id="nroDoc" name="nroDoc" readonly>

                      <input type="hidden" class="form-control input-sm" name="dscto" id="dscto" readonly>
                      <input type="hidden" class="form-control input-sm" name="codVen" id="codVen" readonly>
                      <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $_SESSION["id"]; ?>">

                  </div>

              </div>

            </div>

          <div class="box box-success col-lg-12 ">

            <div class="box-header">

              <b>Documento Destino</b>

            </div>

            <!-- ENTRADA PARA TIPO DE DOCUMENTO -->

            <div class="form-group col-lg-6">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-share-square-o"></i></span>
                <select type="text" class="form-control input-sm selectpicker" name="tdoc" id="tdoc" data-live-search="true"  required>
                  <option value="">Seleccionar tipo de documento</option>

                    <?php

                      $item="tipo_dato";
                      $valor = "tdoc";

                      $documentos = ControladorCuentas::ctrMostrarPagos($item,$valor);
                      foreach ($documentos as $key => $value) {
                        echo '<option value="' . $value["codigo"] . '">' .$value["codigo"]. " - " . $value["descripcion"] . '</option>';
                      }

                    ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA NUMERO DE SERIE-->

            <div class="form-group col-lg-6">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <select type="text" class="form-control input-md" name="serie" id="serie" required>
                  <option value="">Seleccionar Serie</option>

                </select>

              </div>

            </div>

            <!-- CHECKBOX PARA SEPARAR DOCUMENTO -->

            <div class="form-group col-lg-6">

              <div class="form-group">

                <label>
                  <input class="chkFactura" type="checkbox" id="chkFactura" name="chkFactura" disabled>
                  Separar Factura
                </label>

                <label>
                  <input class="chkBoleta" type="checkbox" id="chkBoleta" name="chkBoleta" disabled>
                  Separar Boleta
                </label>

              </div>

            </div>

            <!-- ENTRADA PARA NUMERO DE SERIE DEL DOCUMENTO SEPARADO-->

            <div class="form-group col-lg-6">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <select type="text" class="form-control input-md" name="serieSeparado" id="serieSeparado" required disabled>
                  <option value="">Seleccionar Serie</option>

                </select>

              </div>

            </div>

          </div>



          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" id="btnGenerarDoc" class="btn btn-primary">Generar Documento</button>

        </div>

      </form>

      <?php

      $facturar = new controladorFacturacion();
      $facturar->ctrFacturar();

      ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL DIVIDIR
======================================-->

<div id="modalDividir" class="modal fade" role="dialog">

  <div class="modal-dialog" style="width: 40% !important;">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Pasar Pedido a:</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          <div class="box box-primary col-lg-12 ">

            <div class="box-header">

              <b>Datos Principales</b>

            </div>

              <!-- ENTRADA PARA EL CODIGO DEL PEDIDO-->

              <div class="form-group col-lg-3">

                  <label>Cod. Pedido</label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-key"></i></span>

                      <input type="text" class="form-control input-sm" id="codPedidoD" name="codPedidoD" readonly>

                  </div>

              </div>

              <!-- ENTRADA PARA EL NOMBRE DEL CLIENTE-->

              <div class="form-group col-lg-9">

                  <label>Cliente</label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-key"></i></span>

                      <input type="text" class="form-control input-sm" id="nomCliD" name="nomCliD" readonly>

                  </div>

              </div>

              <!-- ENTRADA PARA EL codigo DEL CLIENTE-->

              <div class="form-group col-lg-3">

                  <label>Cod. Cliente</label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-key"></i></span>

                      <input type="text" class="form-control input-sm" id="codCliD" name="codCliD" readonly>

                  </div>

              </div>

              <!-- ENTRADA PARA EL codigo DEL CLIENTE-->

              <div class="form-group col-lg-4">

                  <label>Total S/.</label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-key"></i></span>

                      <input type="text" class="form-control input-sm" id="totalD" name="totalD" readonly>

                  </div>

              </div>          
              
              <div class="form-group col-lg-4">

                  <label>Porcentaje Aprobado</label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                        <select class="form-control input-sm" id="perPed" name="perPed" required>

                          <option value="">Porcentaje</option>

                          <option value="0.9">90 %</option>

                          <option value="0.8">80 %</option>

                          <option value="0.7">70 %</option>

                          <option value="0.6">60 %</option>

                          <option value="0.5">50 %</option>

                          <option value="0.4">40 %</option>

                          <option value="0.3">30 %</option>

                          <option value="0.2">20 %</option>

                          <option value="0.1">10 %</option>
                        
                        </select>

                  </div>

              </div>                 

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Dividir Pedido</button>

        </div>

      </form>

      <?php

      $dividir = new ControladorPedidos();
      $dividir -> ctrDividirPedido();

      ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL ENVIAR PEDIDOS
======================================-->

<div id="modalEnviarPedido" class="modal fade" role="dialog">

  <div class="modal-dialog" style="width: 20% !important;">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Enviar Pedidos</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          <div class="box box-primary col-lg-12 ">

            <div class="box-header">

              <b>Seleccionar Fecha</b>

            </div>

              <!-- ENTRADA PARA EL CODIGO DEL PEDIDO-->

              <div class="form-group col-lg-12">

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                      <?php

                        date_default_timezone_set('America/Lima');
                        $fecha = new DateTime();

                      ?>

                      <input type="date" class="form-control input-sm" id="fechaEnvio" name="fechaEnvio" value="<?php echo $fecha->format("Y-m-d"); ?>">

                  </div>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Enviar Pedido</button>

        </div>

      </form>

      <?php

      $enviar = new ControladorPedidos();
      $enviar -> ctrEnviarPedido();

      ?>

    </div>

  </div>

</div>


<?php

  $anularPedido = new ControladorPedidos();
  $anularPedido -> ctrAnularPedido();

?>

<script>
window.document.title = "Pedidos"

</script>