<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Crear ingresos

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Crear ingreso</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->

      <div class="col-lg-5 col-xs-12">

        <div class="box box-success">

          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioIngreso">

            <div class="box-body">

              <div class="box">

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control" id="usuario" name="usuario"
                      value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idUsuario" value="<?php echo $_SESSION["id"]; ?>">                      

                  </div>

                </div>

                <!--=====================================
                ENTRADA DEL CODIGO INTERNO
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="text" class="form-control" id="nuevoCodigo" name="nuevoCodigo" readonly>
                   

                  </div>

                </div>

                <!--=====================================
                ENTRADA DEL ARTICULO
                ======================================-->

                <div class="form-group">

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-wrench"></i></span>
                        <select class="form-control  input-sm selectpicker" name="nuevoTalleres" id="nuevoTalleres" data-live-search="true">
                        <option value="">Seleccionar un taller</option>
                        <?php

                            $sector=ControladorSectores::ctrMostrarSectores(null);
                            foreach ($sector as $key => $value) {

                                echo '<option value="' . $value["cod_sector"] . '">' . $value["cod_sector"] . "-". $value["nom_sector"].'</option>';
          
                              }

                            

                        ?>
                        </select>

                    </div>

                </div>

                <!--=====================================
                TITULOS
                ======================================-->
                
                <div class="box box-primary">

                  <div class="row">

                    <div class="col-xs-6">

                      <label>Articulo</label>

                    </div>

                    <div class="col-xs-2">

                      <label for="">En Taller</label>

                    </div>

                  </div>

                </div>
         
                <!--=====================================
                ENTRADA PARA AGREGAR MATERIAPRIMA
                ======================================-->

                <div class="form-group row nuevoArticuloIngreso">


                </div>

                <input type="hidden" id="listaArticulosIngreso" name="listaArticulosIngreso">                

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

                            <span class="input-group-addon"><i class="fa fa-scissors"></i></span>

                            <input type="text" min="1" class="form-control input-lg" id="nuevoTotalTaller"
                              name="nuevoTotalTaller" total="" placeholder="0" readonly required>

                            <input type="hidden" name="totalTaller" id="totalTaller">


                          </div>

                        </td>

                      </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

                <hr>

                <!--=====================================
                BOTON GUARDAR
                ======================================-->

                <br>

              </div>

            </div>

            <div class="box-footer">

              <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i>  Guardar cambios</button>
              
              <a href="ordencorte" id="cancel" name="cancel" class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancelar</a>
            </div>

          </form>

          <?php

            $guardarIngreso = new ControladorIngresos();
            $guardarIngreso -> ctrCrearIngreso();

          ?>            
          

        </div>

      </div>

      <!--=====================================
      LA TABLA DE ARTICULOS
      ======================================-->

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">

            <table class="table table-bordered table-striped table-condensed tablaArticulosTalleres">

              <thead>

                <tr>
                  <th>Modelo</th>
                  <th>Color</th>
                  <th>Talla</th>
                  <th>Proy</th>
                  <th>Prod</th>
                  <th>Avance</th>
                  <th>Stock</th>
                  <th>Ped.</th>
                  <th>En Taller</th>
                  <th>Alm. Corte</th>
                  <th>Ord. Corte</th>
                  <th>Vtas 30d</th>
                  <th>Xprog</th>
                  <th style="width:10px">Acciones</th>
                </tr>

              </thead>



            </table>

          </div>

        </div>


      </div>

    </div>

  </section>

</div>


