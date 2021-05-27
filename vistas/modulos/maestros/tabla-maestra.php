<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Tabla Maestra

        </h1>

        <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Tabla Maestra</li>

        </ol>

    </section>

    <section class="content">

        <div class="row">

            <!--=====================================
            EL FORMULARIO
            ======================================-->

            <div class="col-lg-4 col-xs-12">

                <div class="box box-primary">

                    <div class="box-header with-border"></div>

                    <div class="box-body">

                        <table class="table table-bordered table-striped dt-responsive TablaMaestraCabecera">

                            <thead>

                                <tr>
                                    <th>Cód.</th>
                                    <th>Descripcion</th>
                                    <th>Long</th>
                                    <th>+</th>
                                </tr>

                            </thead>

                        </table>

                    </div>

                </div>


            </div>

            <!--=====================================
            LA TABLA DE PRODUCTOS
            ======================================-->

            <div class="col-lg-8 col-xs-12">

                <div class="box box-info">

                    <div class="box-header with-border"></div>

                    <div class="box-body">

                        <table class="table table-bordered table-striped dt-responsive TablaMaestraDetalle">

                            <thead>

                                <tr>
                                    <th>Tabla</th>
                                    <th>Arg</th>
                                    <th>Des. Larga</th>
                                    <th>Des. Corta</th>
                                    <th>Valor1</th>
                                    <th>Valor2</th>
                                    <th>Valor3</th>
                                    <th>Valor4</th>
                                    <th>Valor5</th>
                                    <th>Editar</th>
                                </tr>

                            </thead>

                        </table>

                    </div>

                </div>


            </div>

        </div>

    </section>

</div>


<!--=====================================
MODAL AGREGAR NUEVA SUB LINEA
======================================-->

<div id="modalAgregarSubLinea" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Sub Linea</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            
          <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCodigo" readonly>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar agencia" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DIRECCION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar Dirección" >

              </div>

            </div>

            <!-- ENTRADA PARA EL UBIGEO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map"></i></span> 

                <select  class="form-control input-lg selectpicker" data-live-search="true" name="nuevoUbigeo"  >
                  <option value="">Ubigeo</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL RUC -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-id-card-o"></i></span> 

                <input type="text" min="0" class="form-control input-lg" name="nuevoRUC" placeholder="Ingresar RUC" >

              </div>

            </div>          


            <!-- ENTRADA PARA EL TELEFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" min="0" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar telefono" >

              </div>

            </div>          

 
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar agencia</button>

        </div>

      </form>

    </div>

  </div>

</div>