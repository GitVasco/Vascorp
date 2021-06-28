<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Almacen Cuadros - Copas

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Almacen Cuadros - Copas</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablaAlmacen01" width="100%">

                    <thead>

                        <tr>

                            <th>Código</th>
                            <th>Cod. Fab.</th>
                            <th>Descripcion</th>
                            <th>Color</th>
                            <th>Talla</th>
                            <th>Unidad</th>
                            <th>Stock</th>
                            <th>Cuadro</th>
                            <th>Responsable</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>


                    </tbody>

                </table>

            </div>

        </div>

    </section>

</div>

<!--=====================================
MODAL VIZUALIZAR NOTA DE INGRESO
======================================-->

<div id="modalAgrearCopas" class="modal fade" role="dialog">

    <div class="modal-dialog" style="width: 80% !important;">
  
      <div class="modal-content">
  
          <form role="form" method="post">
  
          <!--=====================================
          CABEZA DEL MODAL
          ======================================-->
  
          <div class="modal-header" style="background:#3c8dbc; color:white">
  
            <button type="button" class="close" data-dismiss="modal">&times;</button>
  
            <h4 class="modal-title">VISUALIZAR NOTA DE INGRESO</h4>
  
          </div>
  
          <!--=====================================
          CUERPO DEL MODAL
          ======================================-->
  
          <div class="modal-body">
  
            <div class="box-body">

  
              <div class="form-group" style="padding-top:5px;padding-bottom:25px">
  
                  <label class="col-form-label col-lg-1 col-md-3 col-sm-3">CodPro</label>
                  <div class="col-lg-1">
                      <input type="text" class="form-control input-sm" id="codpro" name="codpro" readonly>
                  </div>
  
                  <label class="col-form-label col-lg-1 col-md-3 col-sm-3">CodFab</label>
                  <div class="col-lg-2">
                      <input type="text" class="form-control input-sm" id="codfab" name="codfab" readonly>
                  </div>

                  <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Descripción</label>
                  <div class="col-lg-3">
                      <input type="text" class="form-control input-sm" id="despro" name="despro" readonly>
                  </div>

                  <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Color</label>
                  <div class="col-lg-2">
                      <input type="text" class="form-control input-sm" id="color" name="color" readonly>
                  </div>                  
  
                  
                  
              </div> 
  


  
              <div class="form-group col-lg-12">
                <table class="table table-hover table-striped tablaDetalleNotaIngreso" width="100%">
                  <thead>
                  
                      <th class="text-center">Item</th>
                      <th class="text-center">Cod.Producto</th>
                      <th class="text-center">Cod.Fabrica</th>
                      <th class="text-center">Descripcion</th>
                      <th class="text-center">Color</th>
                      <th class="text-center">Und</th>
                      <th class="text-center">Cant. Recibida</th>
                      <th class="text-center">Saldo</th>
                      <th class="text-center">Exceso</th>
                      <th class="text-center">P.S. IGV</th>
                      <th class="text-center">Total</th>
                      <th class="text-center">O.C</th>
  
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>                                          
              
            </div>
  
          </div>
  
          <!--=====================================
          PIE DEL MODAL
          ======================================-->
  
          <div class="modal-footer">
  
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>
  
            <button type="submit" class="btn btn-primary pull-right">Actualizar Cuadros</button>
  
  
          </div>
  
          </form>
  
   
      </div>
  
    </div>
  
  </div>

<script>
  
    window.document.title = "Almacén 01";
  
  </script>