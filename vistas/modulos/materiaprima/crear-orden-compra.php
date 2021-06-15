<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Crear orden de compra

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Crear orden de compra</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">
      <!--=====================================
      LA TABLA DE MATERIA PRIMA
      ======================================-->

      <div class="col-lg-12 hidden-md hidden-sm hidden-xs">
      
        <div class="box box-warning collapsed-box">

          <div class="box-header with-border">
            <h3 class="box-title">Materia Prima</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
            </div>

          </div>
          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaMateriaOrdenCompra" width="100%">

              <thead>

                <tr>
                  <th>Codigo</th>
                  <th>Cod. Fabrica</th>
                  <th>Descripcion</th>
                  <th>Color</th>
                  <th>Unidad</th>
                  <th>Precio Unitario</th>
                  <th>Proveedor</th>
                  <th>Stock MateriaPrima</th>
                  <th>Acciones</th>
                </tr>

              </thead>


            </table>

          </div>

        </div>


      </div>

      <!--=====================================
      EL FORMULARIO
      ======================================-->

      <div class="col-lg-12 col-xs-12">

        <div class="box box-success">

          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioOrdenCompra">

            <div class="box-body">

              <div class="box">
              <?php 
                date_default_timezone_set('America/Lima');
                $fecha = new DateTime();
              ?>

                <!--=====================================
                FILA FECHA ALMACEN y CLIENTE
                ======================================-->

                <div class="form-group" style="padding-top:15px">
                  

                  <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">PROVEEDOR</label>
                  <div class="col-lg-2">
                    <select  class="form-control selectpicker" name="nuevoProveedorCompra" id="nuevoProveedorCompra" data-live-search="true" required>
                      <option value="">SELECCIONAR PROVEEDOR</option>
                        <?php
                            $item = null;
                            $valor = null;

                            $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);

                            foreach ($proveedores as $key => $value) {

                                echo '<option value="'.$value["CodRuc"].'">'.$value["CodRuc"].' - '.$value["RazPro"].'</option>';

                            }

                        ?>

                    </select>
                    <input type="hidden" name="nuevoCodRuc" id="nuevoCodRuc">
                  </div>
                    
                  <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">RAZON SOCIAL</label>
                  <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  name ="nuevaRazonSocial" id="nuevaRazonSocial" readonly>
                  </div>

                  <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">RUC</label>
                  <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id ="nuevoRuc" name="nuevoRuc" readonly>
                  </div>

                  <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">FECHA</label>
                  <div class="col-lg-2">
                    <input type="date" class="form-control input-sm"  name="nuevaFecha"
                      value="<?php echo $fecha->format("Y-m-d"); ?>" readonly>
                  </div>
                </div>

                <!--=====================================
                FILA TIPO MOTIVO
                ======================================-->

                <div class="form-group" style="padding-top:25px;padding-bottom:25px">

                    <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">MONEDA</label>
                    <div class="col-lg-2">
                    <select  class="form-control selectpicker" name="nuevaMoneda" id="nuevaMonedaCompra" data-live-search="true" >
                      <option value="">SELECCIONAR MONEDA</option>
                        <?php
                            $valor = null;
                            $sublineas = ControladorProveedores::ctrMostrarMonedas();


                            foreach ($sublineas as $key => $value) {

                                echo '<option value="'.$value["Cod_Argumento"].'">'.$value["Des_Larga"].'</option>';

                            }

                        ?>
                    </select>
                    </div>

                    <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">FEC ENTREGA</label>
                    <div class="col-lg-2">
                        <input type="date" class="form-control input-sm"  name ="nuevaFechaEntrega" >
                    </div>

                    <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">FOR PAGO</label>

                    <div class="col-lg-2">
                    
                        <select  class="form-control  selectpicker" name="nuevaFormaPago"  id="nuevaFormaPago" data-live-search="true" >
                        <option value="">SELECCIONAR FORMA PAGO</option>
                        <?php
                            $item = null;
                            $valor = null;

                            $condiciones = ControladorCondicionVentas::ctrMostrarCondicionVentas($item, $valor);


                            foreach ($condiciones as $key => $value) {

                                echo '<option value="'.$value["codigo"].'">'.$value["codigo"].' - '.$value["descripcion"].'</option>';

                            }

                        ?>
                        </select>
                    </div>

                    <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">DIAS</label>
                    <div class="col-lg-2">
                        <input type="text" class="form-control input-sm"  name ="nuevoDia" id="nuevoDia">
                    </div>

                    
                  <div class="col-lg-12"></div>

                </div>

                <div class="form-group" style="padding-bottom:25px">

                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">N° COTIZACION</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  name ="nuevoNroCotizacion" >
                </div>

                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">TIPO CAMBIO</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  name ="nuevoTipoCambio" id="nuevoTipoCambio" readonly>
                </div>

                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">CENT COSTO</label>

                <div class="col-lg-2">
                
                    <select  class="form-control  selectpicker" name="nuevoCentroCosto" data-live-search="true" >
                    <option value="">SELECCIONAR CENTRO COSTO</option>
                        <?php

                        $centro = ControladorMaestras::ctrMostrarMaestrasDetalle("TDET");
                        

                        foreach ($centro as $key => $value) {

                        echo '<option value="'.$value["cod_argumento"].'">'.$value["cod_argumento"]." - ".$value["des_larga"].'</option>';

                        }

                        ?>
                    </select>
                </div>

                

                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">OBSERVACION</label>
                <div class="col-lg-2">
                <input type="text" class="form-control input-sm"  name ="nuevaObservacion" >
                </div>

                <div class="col-lg-12"></div>

            </div>

                <div class="box box-primary" >

                  <div class="row">
                    <div class="col-xs-1">

                      <label for="">COD PRODUCTO</label>

                    </div>
                    <div class="col-xs-1">

                      <label >COD FABRICA</label>

                    </div>

                    <div class="col-xs-3">

                      <label for="" >DESCRIPCION</label>

                    </div>

                    <div class="col-xs-1">

                      <label for="" >COLOR</label>

                    </div>

                    <div class="col-xs-1">

                      <label for="" >COLOR PROV</label>

                    </div>

                    <div class="col-xs-1">

                      <label for="" >CANTIDAD</label>

                    </div>

                    <div class="col-xs-1">

                      <label for="" >UND</label>

                    </div>

                    <div class="col-xs-1">

                      <label for="" >P UNITARIO</label>

                    </div>

                    <div class="col-xs-1">

                      <label for="" >% DESCUENTO</label>

                    </div>

                    <div class="col-xs-1">

                      <label for="" >TOTAL</label>

                    </div>

                    
                  </div>

                </div>
                <!--=====================================
                ENTRADA PARA AGREGAR MATERIA PRIMA
                ======================================-->

                <div class="form-group row nuevaMateriaCompra">



                </div>

                <input type="hidden" id="listarMateriaCompras" name="listarMateriaCompras">


                <hr>

                <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->

                <div class="col-xs-5 pull-right">

                  <table class="table">

                    <thead>

                      <tr>
                        <th>SubTotal</th>
                        <th>Impuesto</th>
                        <th>Total</th>
                      </tr>

                    </thead>

                    <tbody>

                      <tr>
                        <td style="width: 35%">

                          <div class="input-group">

                            <input type="number" class="form-control input-sm" min="0" id="nuevoSubTotalCompra" step="any"
                              name="nuevoSubTotalCompra" placeholder="0.00000" readonly>
                            <span class="input-group-addon"><i class="fa fa-money"></i></span>

                          </div>

                        </td>

                        <td style="width: 30%">

                          <div class="input-group">

                            <input type="number" class="form-control input-sm" min="0" step="any" id="nuevoImpuestoCompra"
                              name="nuevoImpuestoCompra" placeholder="0.00000" readonly>



                            <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                          </div>

                        </td>

                        <td style="width: 35%">

                          <div class="input-group">

                            

                            <input type="text" min="0" class="form-control input-sm" id="nuevoTotalCompra" name="nuevoTotalCompra"  step="any" total="" placeholder="0.00000" readonly required>

                            <span class="input-group-addon"><i class="fa fa-money"></i></span>

                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

              </div>

            </div>

            <div class="box-footer">

              <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Guardar orden de compra</button>

              <a href="orden-compra"  class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancelar</a>
            </div>

          </form>

          <?php

            $guardarOrdenCompra = new ControladorOrdenCompra();
            $guardarOrdenCompra -> ctrCrearOrdenCompra();

          ?>          

        </div>

      </div>

      

    </div>

  </section>

</div>

<script>
window.document.title = "Crear orden de compra"
</script>