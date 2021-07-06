<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Tabla Maestra - Producción

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

            <div class="col-lg-3 col-xs-12">

                <div class="box box-primary">

                    <div class="box-header with-border"></div>

                    <div class="box-body">

                        <table class="table table-bordered table-striped dt-responsive TablaProdCabecera" width="100%">

                            <thead>

                                <tr>
                                    <th>Tipo</th>
                                    <th>Nro</th>
                                    <th>Total</th>
                                    <th>Fecha</th>
                                    <th>#</th>
                                </tr>

                            </thead>

                        </table>

                    </div>

                </div>


            </div>

            <!--=====================================
            LA TABLA DE PRODUCTOS
            ======================================-->

            <div class="col-lg-9 col-xs-12">

                <div class="box box-info">

                    <div class="box-header with-border"></div>

                    <div class="box-body">

                        <table class="table table-bordered table-striped dt-responsive TablaProdDetalle" width="100%">

                            <thead>

                                <tr>
                                    <th>Tipo</th>
                                    <th>Doc.</th>
                                    <th>Codpro</th>
                                    <th>CodFab</th>
                                    <th>Des. Larga</th>
                                    <th>Color</th>
                                    <th>Talla</th>
                                    <th>Und</th>
                                    <th>Cantidad</th>
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
MODAL AGREGAR ITEM A LA PRODUCCION
======================================-->

<div id="modalAgregarProd" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Item</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

            <div class="box-body">

                <div class="form-group">

                    <!-- ENTRADA PARA EL CODIGO DE TABLA -->
                    <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">Tipo</label>
                    
                    <div class="col-lg-4">

                        <input type="text" class="form-control input-sm"  name="tipo"  id ="tipo" readonly>

                    </div>



                    <!-- ENTRADA PARA EL CORRELATIVO-->
                    <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">Documentos</label>
                    
                    <div class="col-lg-4">

                        <input type="text" class="form-control input-sm"  name="documento"  id ="documento" readonly>

                    </div>

                </div> 

                <div class="form-group" style="padding-top:25px">

                    <!-- ENTRADA PARA LA DESCRIPCION CORTA-->
                    <label for="" class="col-form-label col-lg-3 col-md-3 col-sm-3">Descripcion Corta</label>
                    
                    <div class="col-lg-5">

                        <input type="text" class="form-control input-md"  name="editarDescCorta"  id ="editarDescCorta">

                    </div>

                </div>  



            </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar</button>

        </div>

      </form>

      <?php

      /* $editarSubLinea = new ControladorMaestras();
      $editarSubLinea -> ctrEditarSubLinea(); */

      ?>    

    </div>

  </div>

</div>

<script>
window.document.title = "Maestra Produccion";
</script>