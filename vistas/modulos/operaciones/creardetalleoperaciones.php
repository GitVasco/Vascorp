<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Crear Operacion para Modelo

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Crear Operación Modelo</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->

      <div class="col-lg-7 col-xs-12">

        <div class="box box-success">

          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioOperacion">

            <div class="box-body">

              <div class="box">

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control" id="nuevoVendedor" name="nuevoVendedor"
                      value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">

                  </div>

                </div>


                <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                    <select class="form-control selectpicker" id="seleccionarArticulo" name="seleccionarArticulo" data-live-search="true" required>

                      <option value="">Seleccionar Articulo</option>

                      <?php

                      $item = null;
                      $valor = null;

                      $articulos = ControladorOperaciones::ctrMostrarModelos($item, $valor);
                      
                      foreach ($articulos as $key => $value) {
                        if($value["operaciones"] == 0){
                          echo '<option value="'.$value["modelo"].'">'.$value["packing"].'</option>';
                        }    
                      }

                      ?>

                    </select>

                  </div>

                </div>

                <!--=====================================
                ENTRADA PARA AGREGAR OPERACION
                ======================================-->
                <table>
                  <thead>
                  <tr>
                      <th style="width:450px;margin-right:150px;">Operaciones</th>
                      <th style="width:200px">Precio x Docena</th>
                      <th style="width:200px">Tiempo Standart</th>
                  </tr>
                  </thead>

                </table>

                <div class="form-group row nuevaOperacion">



                </div>

                <input type="hidden" id="listaOperaciones" name="listaOperaciones">

                <!--=====================================
                BOTÓN PARA AGREGAR OPERACION
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarOperacion">Agregar operacion</button>

                <hr>

                <div class="row">

                  <!--=====================================
                  ENTRADA TOTAL y TIEMPO STANDAR
                  ======================================-->

                  <div class="col-xs-8 pull-right">

                    <table class="table">

                      <thead>

                        <tr>
                          <th style="width:50%">Total x Docena</th>
                          <th style="width:50%">Total T. Standar</th>
                        </tr>

                      </thead>

                      <tbody>

                        <tr>


                          <td style="width: 50%">

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-money"></i></span>

                              <input type="text" min="0" class="form-control input-lg" id="nuevoTotalDocena" name="nuevoTotalDocena" totalDecena="" placeholder="00000" step="any" readonly required>



                            </div>

                          </td>

                          <td style="width: 50%">

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>

                              <input type="text" min="0" class="form-control input-lg" id="nuevoTotalStandar" name="nuevoTotalStandar" totalStand="" placeholder="00000" step="any" readonly required>

                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

                <hr>

                <br>

              </div>

            </div>

            <div class="box-footer">

              <button type="submit" class="btn btn-primary pull-right">Guardar Operacion</button>

            </div>

          </form>

          <?php

            $guardarOperacion = new ControladorOperaciones();
            $guardarOperacion -> ctrCrearOperacionModelo();

          ?>          

        </div>

      </div>

      <!--=====================================
      LA TABLA DE OPERACIONES
      ======================================-->

      <div class="col-lg-5 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaArticuloOperaciones">

              <thead>

                <tr>
                  <th style="width: 10px">#</th>
                  <th>Código</th>
                  <th>Nombre</th>
                  <th>Acciones</th>
                </tr>

              </thead>


            </table>

          </div>

        </div>


      </div>

    </div>

  </section>

</div>

