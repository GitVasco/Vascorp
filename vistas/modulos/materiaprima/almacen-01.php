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

          <div class="box-header with-border">
              <div class="col-lg-2">
                
                <select type="text" class="form-control input-sm " name="selectAlmacen01" id="selectAlmacen01" >
                    <option value="">Seleccionar sector</option>
                    <option value="COP">COPAS</option>
                    <option value="CUA">CUADROS</option>
                </select>
              </div>
              <a href="crear-cuadros-prod">
              <button class="btn btn-warning">
              <i class="fa fa-object-ungroup"> </i> Crear Cuadro
              
              </button>
              </a>

              <a href="crear-copas-prod">
              <button class="btn btn-info">
              <i class="fa fa-eercast"> </i> Crear Copa
              
              </button>
              </a>

          </div>        

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablaAlmacen01" width="100%">

                    <thead>

                        <tr>

                            <th style="width:50px">CodPro</th>
                            <th style="width:100px">Cod. Fab.</th>
                            <th style="width:200px">Descripcion</th>
                            <th style="width:300px">Color</th>
                            <th>Talla</th>
                            <th>Unidad</th>
                            <th>Stock</th>
                            <th>Cuadro</th>
                            <th style="width:120px">Responsable</th>
                            <th style="width:80px">Acciones</th>

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
MODAL AGREGAR COPAS A CUADROS
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
  
            <h4 class="modal-title">Agregar copas al Cuadro</h4>
  
          </div>
  
          <!--=====================================
          CUERPO DEL MODAL
          ======================================-->
  
          <div class="modal-body">
  
            <div class="box-body">

  
              <div class="form-group" style="padding-top:5px;padding-bottom:20px">
  
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

              <div class="form-group" style="padding-top:5px;padding-bottom:25px">
  
                <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Unidad</label>
                <div class="col-lg-1">
                    <input type="text" class="form-control input-sm" id="unidad" name="unidad" readonly>
                </div>

                <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Stock</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" id="stock" name="stock" readonly>
                </div>

              </div>                
  


  
              <div class="form-group col-lg-12">
                <table class="table table-hover table-striped tablaAlm01Add" width="100%">
                  <thead>
                  
                    <th>CodPro</th>
                    <th>CodFab</th>
                    <th>Descripcion</th>
                    <th>Color</th>
                    <th>Talla</th>
                    <th>Und</th>
                    <th>Stock</th>
                    <th>Acciones</th>
  
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

            <a href="almacen-01"  class="btn btn-primary pull-right"><i class="fa fa-times-circle"></i> Actualizar Cuadro</a>
  
  
          </div>
  
          </form>
  
   
      </div>
  
    </div>
  
  </div>

<!--=====================================
MODAL QUITAR COPAS A CUADROS
======================================-->

<div id="modalQuitarCopas" class="modal fade" role="dialog">

    <div class="modal-dialog" style="width: 80% !important;">
  
      <div class="modal-content">
  
          <form role="form" method="post">
  
          <!--=====================================
          CABEZA DEL MODAL
          ======================================-->
  
          <div class="modal-header" style="background:#3c8dbc; color:white">
  
            <button type="button" class="close" data-dismiss="modal">&times;</button>
  
            <h4 class="modal-title">Quitar copas al Cuadro</h4>
  
          </div>
  
          <!--=====================================
          CUERPO DEL MODAL
          ======================================-->
  
          <div class="modal-body">
  
            <div class="box-body">

  
              <div class="form-group" style="padding-top:5px;padding-bottom:20px">
  
                <label class="col-form-label col-lg-1 col-md-3 col-sm-3">CodPro</label>
                <div class="col-lg-1">
                    <input type="text" class="form-control input-sm" id="codproQ" name="codproQ" readonly>
                </div>

                <label class="col-form-label col-lg-1 col-md-3 col-sm-3">CodFab</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" id="codfabQ" name="codfabQ" readonly>
                </div>

                <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Descripción</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" id="desproQ" name="desproQ" readonly>
                </div>

                <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Color</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control input-sm" id="colorQ" name="colorQ" readonly>
                </div>               

              </div>

              <div class="form-group" style="padding-top:5px;padding-bottom:25px">
  
                <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Unidad</label>
                <div class="col-lg-1">
                    <input type="text" class="form-control input-sm" id="unidadQ" name="unidadQ" readonly>
                </div>

                <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Stock</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" id="stockQ" name="stockQ" readonly>
                </div>

              </div>                
  


  
              <div class="form-group col-lg-12">
                <table class="table table-hover table-striped tablaAlm01Off" width="100%">
                  <thead>
                  
                    <th>CodPro</th>
                    <th>CodFab</th>
                    <th>Descripcion</th>
                    <th>Color</th>
                    <th>Talla</th>
                    <th>Und</th>
                    <th>Stock</th>
                    <th>Acciones</th>
  
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

            <a href="almacen-01"  class="btn btn-primary pull-right"><i class="fa fa-times-circle"></i> Actualizar Cuadro</a>
  
  
          </div>
  
          </form>
  
   
      </div>
  
    </div>
  
  </div>  

<script>
  
    window.document.title = "Almacén 01";
  
  </script>