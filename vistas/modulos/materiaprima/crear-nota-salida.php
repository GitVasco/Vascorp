<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Crear nota salida

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Crear nota salida</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">
      <!--=====================================
      LA TABLA DE MATERIA PRIMA
      ======================================-->

      <div class="col-lg-12 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning">

          <div class="box-header with-border">
            <h3 class="box-title">Materia Prima</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>

          </div>
          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaOrdenNotaSalida">

              <thead>

                <tr>
                  <th>Codigo</th>
                  <th>Articulo</th>
                  <th>Modelo</th>
                  <th>Nombre</th>
                  <th>Color</th>
                  <th>Talla</th>
                  <th>Saldo</th>
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

          <form role="form" method="post" class="formularioNotaSalida">

            <div class="box-body">

              <div class="box">
              <?php 
                date_default_timezone_set('America/Lima');
                $fecha = new DateTime();
              ?>

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->

                <div class="form-group" style="padding-top:15px">
                  <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">FECHA</label>
                  <div class="col-lg-2">
                    <input type="date" class="form-control" id="nuevaFecha" name="nuevaFecha"
                      value="<?php echo $fecha->format("Y-m-d"); ?>" readonly>
                  </div>
                  <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">ALMACEN</label>
                  <div class="col-lg-2">
                    <input type="date" class="form-control" id="nuevaFecha" name="nuevaFecha"
                      value="<?php echo $fecha->format("Y-m-d"); ?>" readonly>
                  </div>
                    
                </div>

                <!--=====================================
                ENTRADA DE GUIA
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                    <input type="text" class="form-control" id="nuevaGuia" name="nuevaGuia"  >

                  </div>

                </div>

                <!--=====================================
                ENTRADA DEL CODIGO
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="text" class="form-control" id="nuevoCierre" name="nuevoCierre"  readonly>

                  </div>

                </div>

                
                <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                    <select class="form-control selectpicker" id="seleccionarSector" name="seleccionarSector" data-live-search="true" required>

                      <option value="">Seleccionar sector</option>

                      <?php

                      $item = null;
                      $valor = null;

                      $categorias = ControladorSectores::ctrMostrarSectores($item, $valor);

                      foreach ($categorias as $key => $value) {

                        echo '<option value="'.$value["cod_sector"].'">'.$value["cod_sector"]." - ".$value["nom_sector"].'</option>';

                      }

                      ?>

                    </select>

                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs btnLimpiarSectorCierre">Limpiar
                        sector</button></span>

                  </div>

                </div>
                <div class="box box-primary">

                  <div class="row">
                    <div class="col-xs-3">

                      <label for="">Codigo</label>

                    </div>
                    <div class="col-xs-5">

                      <label >Articulo</label>

                    </div>

                    <div class="col-xs-2">

                      <label for="" >Cantidad</label>

                    </div>

                    <div class="col-xs-2">

                      <label for="" >Servicio</label>

                    </div>

                  </div>

                </div>
                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================-->

                <div class="form-group row nuevaNotasSalidas">



                </div>

                <input type="hidden" id="listaProductos" name="listaProductos">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>

                <hr>

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->

                  <div class="col-xs-6 pull-right">

                    <table class="table">

                      <thead>

                        <tr>
                          <th>Total</th>
                        </tr>

                      </thead>

                      <tbody>

                        <tr>

                          <td style="width: 50%">

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-money"></i></span>

                              <input type="text" min="1" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="00000" readonly required>

                              <input type="hidden" name="totalVenta" id="totalVenta">


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

              <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Guardar nota salida</button>

              <a href="notas-salidas"  class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancelar</a>
            </div>

          </form>

          <?php

            $guardarCierre = new ControladorCierres();
            $guardarCierre -> ctrCrearCierre();

          ?>          

        </div>

      </div>

      

    </div>

  </section>

</div>

<script>
window.document.title = "Crear nota salida"
</script>