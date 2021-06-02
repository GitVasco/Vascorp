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
      
        <div class="box box-warning collapsed-box">

          <div class="box-header with-border">
            <h3 class="box-title">Materia Prima</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
            </div>

          </div>
          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaMateriaNotaSalida" width="100%">

              <thead>

                <tr>
                  <th>Codigo</th>
                  <th>Cod. Fabrica</th>
                  <th>Descripcion</th>
                  <th>Unidad</th>
                  <th>Cod Color</th>
                  <th>Color</th>
                  <th>Costo</th>
                  <th>Stock Minimo</th>
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

          <form role="form" method="post" class="formularioNotaSalida">

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
                  <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">FECHA</label>
                  <div class="col-lg-2">
                    <input type="date" class="form-control input-sm"  name="nuevaFecha"
                      value="<?php echo $fecha->format("Y-m-d"); ?>" readonly>
                  </div>

                  <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">ALMACEN</label>
                  <div class="col-lg-2">
                    <select  class="form-control selectpicker" name="nuevoTipoAlmacen" data-live-search="true" required>
                      <option value="">SELECCIONAR TIPO DE ALMACEN</option>
                        <?php

                        $almacen = ControladorNotasSalidas::ctrMostrarTipoAlmacen();

                        foreach ($almacen as $key => $value) {

                          echo '<option value="'.$value["id_almacen"].'">'.$value["id_almacen"]." - ".$value["almacen"].'</option>';

                        }

                        ?>
                    </select>
                  </div>
                    
                  <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">RAZON SOCIAL</label>
                  <div class="col-lg-2">
                    <select  class="form-control  selectpicker" name="nuevoClienteNota" id="nuevoClienteNota" data-live-search="true" required>
                      <option value="">SELECCIONAR CLIENTE</option>
                        <?php

                        $cliente = ControladorNotasSalidas::ctrMostrarClientesNotas();

                        foreach ($cliente as $key => $value) {

                          echo '<option value="'.$value["Ruc"].'">'.$value["CodCli"]." - ".$value["RazCli"].'</option>';

                        }

                        ?>
                    </select>
                  </div>

                  <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">RUC</label>
                  <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id ="nuevoRuc" name="nuevoRuc" readonly>
                    <input type="hidden"   id ="codigoCli" name="nuevocodigoCli" readonly>
                  </div>
                </div>

                <!--=====================================
                FILA TIPO MOTIVO
                ======================================-->

                <div class="form-group" style="padding-top:25px;padding-bottom:35px">
                  <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">MOTIVO</label>

                  <div class="col-lg-3">
                  
                    <select  class="form-control  selectpicker" name="nuevoMotivoNota" id="nuevoMotivoNota" data-live-search="true" >
                      <option value="">SELECCIONAR MOTIVO</option>
                        <?php

                        $motivo = ControladorNotasSalidas::ctrMostrarMotivoNota();

                        foreach ($motivo as $key => $value) {

                          echo '<option value="'.$value["Cod_Argumento"].'">'.$value["Des_Larga"].'</option>';

                        }

                        ?>
                    </select>
                    <input type="hidden" id="desMotivo" name="nuevoDesMotivo">
                    
                  </div>

                  <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  name ="nuevaDescripcionMotivo" >
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

                    <div class="col-xs-4">

                      <label for="" >DESCRIPCION</label>

                    </div>

                    <div class="col-xs-1">

                      <label for="" >COD COLOR</label>

                    </div>

                    <div class="col-xs-1">

                      <label for="" >COLOR</label>

                    </div>

                    <div class="col-xs-1">

                      <label for="" >COSTO</label>

                    </div>

                    <div class="col-xs-2">

                      <label for="" >DESTINO</label>

                    </div>

                    <div class="col-xs-1">

                      <label for="" >CANTIDAD</label>

                    </div>
                  </div>

                </div>
                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================-->

                <div class="form-group row nuevaMateriaNota">



                </div>

                <input type="hidden" id="listarMateriaNotas" name="listarMateriaNotas">


                <hr>

              </div>

            </div>

            <div class="box-footer">

              <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Guardar nota salida</button>

              <a href="notas-salidas"  class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancelar</a>
            </div>

          </form>

          <?php

            $guardarNotaSalida = new ControladorNotasSalidas();
            $guardarNotaSalida -> ctrCrearNotaSalida();

          ?>          

        </div>

      </div>

      

    </div>

  </section>

</div>

<script>
window.document.title = "Crear nota salida"
</script>