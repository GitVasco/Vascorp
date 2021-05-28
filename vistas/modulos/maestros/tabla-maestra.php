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

                <div class="form-group">

                    <!-- ENTRADA PARA EL CODIGO DE TABLA -->
                    <label for="" class="col-form-label col-lg-3 col-md-3 col-sm-3">Código Tabla</label>
                    
                    <div class="col-lg-3">

                        <input type="text" class="form-control input-md"  name="nuevoCodTabla"  id ="nuevoCodTabla" readonly>

                    </div>

                </div>

                <div class="form-group" style="padding-top:25px">

                    <!-- ENTRADA PARA AL DESCRIPCION-->
                    <label for="" class="col-form-label col-lg-3 col-md-3 col-sm-3">Descripción</label>
                    
                    <div class="col-lg-9">

                        <input type="text" class="form-control input-md"  name="nuevaDescripcion"  id ="nuevaDescripcion" readonly>

                    </div>

                </div>     
                
                <div class="form-group" style="padding-top:25px">

                    <!-- ENTRADA PARA EL CORRELATIVO-->
                    <label for="" class="col-form-label col-lg-3 col-md-3 col-sm-3">Cod. Argumento</label>
                    
                    <div class="col-lg-3">

                        <input type="text" class="form-control input-md"  name="nuevoCorrelativo"  id ="nuevoCorrelativo" readonly>

                    </div>

                </div> 

                <div class="form-group campoSubLineaA" style="padding-top:25px">

                    <!-- ENTRADA PARA LA DESCRIPCION CORTA-->
                    <label for="" class="col-form-label col-lg-3 col-md-3 col-sm-3">Descripcion Corta</label>
                    
                    <div class="col-lg-5">

                        <input type="text" class="form-control input-md"  name="nuevaDescCortaA"  id ="nuevaDescCorta">

                    </div>

                </div>  

                <div class="form-group col-lg-12 campoSubLineaB hidden" style="padding-top:25px">

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-bars"></i></span>

                        <select class="form-control selectpicker" id="nuevaDescCortaSelect" name="nuevaDescCorta" data-live-search="true" >

                        <option value="">Seleccionar SubLinea</option>

                        <?php

                        $subLineas = ControladorMaestras::ctrMostrarSubLineas();

                        foreach ($subLineas as $key => $value) {

                            echo '<option value="'.$value["des_corta"].'">'.$value["des_corta"]." - ".$value["des_larga"].'</option>';

                        }

                        ?>

                        </select>

                    </div>

                </div>                      

                <div class="col-lg-12 "></div>

                <div class="form-group" style="padding-top:25px">

                    <!-- ENTRADA PARA LA DESCRIPCION LARGA-->
                    <label for="" class="col-form-label col-lg-3 col-md-3 col-sm-3">Descripcion Larga</label>
                    
                    <div class="col-lg-9">

                        <input type="text" class="form-control input-md"  name="nuevaDescLarga"  id ="nuevaDescLarga" required>

                    </div>

                </div>                 
                
                <div class="col-lg-12"></div>
                
                <div class="form-group" style="padding-top:25px">

                    <!-- ENTRADA PARA el valor 1-->
                    <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">Valor 1</label>
                    
                    <div class="col-lg-4">

                        <input type="text" class="form-control input-md"  name="nuevoVal1"  id ="nuevoVal1">

                    </div>

                    <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">Valor 2</label>
                    
                    <div class="col-lg-4">

                        <input type="text" class="form-control input-md"  name="nuevoVal2"  id ="nuevoVal2">

                    </div>
                    
                    <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">Valor 3</label>
                    
                    <div class="col-lg-4">

                        <input type="text" class="form-control input-md"  name="nuevoVal3"  id ="nuevoVal3">

                    </div>
                    
                    <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">Valor 4</label>
                    
                    <div class="col-lg-4">

                        <input type="text" class="form-control input-md"  name="nuevoVal4"  id ="nuevoVal4">

                    </div>
                    
                    <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">Valor 5</label>
                    
                    <div class="col-lg-4">

                        <input type="text" class="form-control input-md"  name="nuevoVal5"  id ="nuevoVal5">

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

      <?php

      $crearSubLinea = new ControladorMaestras();
      $crearSubLinea -> ctrCrearSubLinea();

      ?>         

    </div>

  </div>

</div>

<!--=====================================
MODAL AGREGAR EDITAR SUB LINEA
======================================-->

<div id="modalEditarSubLinea" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Sub Linea</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

            <div class="box-body">

                <div class="form-group">

                    <!-- ENTRADA PARA EL CODIGO DE TABLA -->
                    <label for="" class="col-form-label col-lg-3 col-md-3 col-sm-3">Código Tabla</label>
                    
                    <div class="col-lg-3">

                        <input type="text" class="form-control input-md"  name="editarCodTabla"  id ="editarCodTabla" readonly>

                    </div>

                </div>
                
                <div class="form-group" style="padding-top:25px">

                    <!-- ENTRADA PARA EL CORRELATIVO-->
                    <label for="" class="col-form-label col-lg-3 col-md-3 col-sm-3">Cod. Argumento</label>
                    
                    <div class="col-lg-3">

                        <input type="text" class="form-control input-md"  name="editarCorrelativo"  id ="editarCorrelativo" readonly>

                    </div>

                </div> 

                <div class="form-group" style="padding-top:25px">

                    <!-- ENTRADA PARA LA DESCRIPCION CORTA-->
                    <label for="" class="col-form-label col-lg-3 col-md-3 col-sm-3">Descripcion Corta</label>
                    
                    <div class="col-lg-5">

                        <input type="text" class="form-control input-md"  name="editarDescCorta"  id ="editarDescCorta">

                    </div>

                </div>  

                     

                <div class="col-lg-12 "></div>

                <div class="form-group" style="padding-top:25px">

                    <!-- ENTRADA PARA LA DESCRIPCION LARGA-->
                    <label for="" class="col-form-label col-lg-3 col-md-3 col-sm-3">Descripcion Larga</label>
                    
                    <div class="col-lg-9">

                        <input type="text" class="form-control input-md"  name="editarDescLarga"  id ="editarDescLarga" required>

                    </div>

                </div>                 
                
                <div class="col-lg-12"></div>
                
                <div class="form-group" style="padding-top:25px">

                    <!-- ENTRADA PARA el valor 1-->
                    <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">Valor 1</label>
                    
                    <div class="col-lg-4">

                        <input type="text" class="form-control input-md"  name="editarVal1"  id ="editarVal1">

                    </div>

                    <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">Valor 2</label>
                    
                    <div class="col-lg-4">

                        <input type="text" class="form-control input-md"  name="editarVal2"  id ="editarVal2">

                    </div>
                    
                    <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">Valor 3</label>
                    
                    <div class="col-lg-4">

                        <input type="text" class="form-control input-md"  name="editarVal3"  id ="editarVal3">

                    </div>
                    
                    <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">Valor 4</label>
                    
                    <div class="col-lg-4">

                        <input type="text" class="form-control input-md"  name="editarVal4"  id ="editarVal4">

                    </div>
                    
                    <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">Valor 5</label>
                    
                    <div class="col-lg-4">

                        <input type="text" class="form-control input-md"  name="editarVal5"  id ="editarVal5">

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

      <?php

      $editarSubLinea = new ControladorMaestras();
      $editarSubLinea -> ctrEditarSubLinea();

      ?>    

    </div>

  </div>

</div>