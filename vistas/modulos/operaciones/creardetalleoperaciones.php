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

          <div class="box-header with-border">
            
          </div>

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

                    <select class="form-control selectpicker" id="seleccionarArticulo" name="seleccionarArticulo" data-live-search="true" data-size="10" required>

                      <option value="">Seleccionar Modelo</option>

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
                ENTRADA BUSCADOR
                ======================================-->

                <div class=" form-group buscador" id="elid" style="padding-bottom:25px">
                  <label for="" class="col-form-label col-lg-1">Buscar:</label>
                  <div class="col-lg-11">
                      <div class="input-group">
                          
                          <input type="text" class="form-control " id="buscadorOperacion" name="buscadorOperacion"/>
                          <div class="input-group-addon"><i class="fa fa-search"></i></div>
                      </div>
                  </div>
                      
                </div>         


                <!--=====================================
                ENTRADA PARA AGREGAR OPERACION
                ======================================-->
                <table class=" box box-primary" >
                  <thead >
                  <tr>
                      <th style="width:550px;margin-right:150px;">Codigo-Operaciones</th>
                      <th style="width:250px">Precio x Docena</th>
                      <th style="width:200px">Tiempo Standart</th>
                  </tr>
                  </thead>

                </table>

                <div class="form-group row nuevaOperacion" style="height:400px;overflow: scroll; overflow-x:hidden">



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

                              <input type="number" min="0" class="form-control input-lg" id="nuevoTotalDocena" name="nuevoTotalDocena" totalDecena="" placeholder="00000" step="any" readonly required>



                            </div>

                          </td>

                          <td style="width: 50%">

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>

                              <input type="number" min="0" class="form-control input-lg" id="nuevoTotalStandar" name="nuevoTotalStandar" totalStand="" placeholder="00000" step="any" readonly required>

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

              <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Guardar operación modelo</button>
              
              <a href="detalleoperaciones"  class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancelar</a>
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

          <div class="box-header with-border">
            <?php 
              $item=null;
              $valor=null;
            ?>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarOperacion" id="btnAgregarOperacion2"><i class="fa fa-plus-square"></i>
              Nueva operacion
            </button>
          </div>

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaArticuloOperaciones" width="100%">

              <thead>

                <tr>
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


<!--=====================================
MODAL AGREGAR OPERACION
======================================-->

<div id="modalAgregarOperacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="formularioAgregarOperacion2">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Operación</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group">
              <label for="">Codigo operación</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" min="0" class="form-control input-md" name="nuevoCodigo" id="nuevoCodigo" readonly>

              </div>

            </div>          

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              <label for="">Descripción</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-md" style="text-transform:uppercase" name="nuevaOperacion" id="nuevaDescOperacion" placeholder="Ingresar nombre" required>

              </div>

            </div>
 
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar operación</button>

        </div>

      </form>


    </div>

  </div>

</div>

<script>
window.document.title = "Crear operaciones modelo"
</script>

<script>
$('.nuevaOperacion').ready(function(){
    $('#buscadorOperacion').keyup(function(){


    var nombres = $('.nuevaDescripcionOperacion2');
    //console.log(nombres.val())
    //console.log(nombres.length())

    var buscando = $(this).val();
    //console.log(buscando.length);

    var item='';

       for( var i = 0; i < nombres.length; i++ ){

        item = $(nombres[i]).val();
        item2 = $(nombres[i]).val().toLowerCase();
        // console.log(item);

            for(var x = 0; x < item.length; x++ ){

                if( buscando.length == 0 || item.indexOf( buscando ) > -1 || item2.indexOf( buscando ) > -1 ){

                    $(nombres[i]).parents('.munditoOperacion').show(); 

                }else{

                    $(nombres[i]).parents('.munditoOperacion').hide();

                }
            }

          
       }

       
    });
  });

</script>