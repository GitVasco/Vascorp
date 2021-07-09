<div class="content-wrapper">

    <section class="content-header">
        

        <h1 style="display:inline-block">

            Tabla Maestra - Producción

        </h1>

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
MODAL AGREGAR ITEM A LA PRODUCCION
======================================-->

<div id="modalAgregarProd" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="formularioNuevoProdMP">

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
                    
                    <div class="col-lg-2">

                        <input type="text" class="form-control input-sm"  name="nuevoTipo"  id ="nuevoTipo" readonly>

                    </div>

                    <!-- ENTRADA PARA EL CORRELATIVO-->
                    <label for="" class="col-form-label col-lg-2  col-lg-offset-4 col-md-3 col-sm-3">Documento</label>
                    
                    <div class="col-lg-2">

                        <input type="text" class="form-control input-sm"  name="nuevoDocumento"  id ="nuevoDocumento" readonly>

                    </div>

                    

                </div> 

                <div class="form-group" style="padding-top:25px">


                    <!-- ENTRADA PARA LA DESCRIPCION CORTA-->
                    <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">Materia P.</label>
                    
                    <div class="col-lg-10">
                        <select  class="form-control selectpicker"  name="nuevaMateriaMP"  id ="nuevaMateriaMP" data-live-search="true" >

                        </select>

                        <input type="hidden" id="cuadroMP" name="cuadroMP">

                    </div>

                </div>  

                <div class="form-group" style="padding-top:25px">


                    <!-- ENTRADA PARA LA DESCRIPCION CORTA-->
                    <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">Cantidad</label>
                    
                    <div class="col-lg-3">

                        <input type="number" class="form-control input-md"  name="nuevaCantidadMP"  id ="nuevaCantidadMP" >

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


<!--=====================================
MODAL AGREGAR ITEM A LA PRODUCCION
======================================-->

<div id="modalEditarMP" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="formularioEditarDetalleMP">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar MP detalle</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

            <div class="box-body">

                <div class="form-group">

                    <!-- ENTRADA PARA EL CODIGO DE TABLA -->
                    <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">Tipo</label>
                    
                    <div class="col-lg-2">

                        <input type="text" class="form-control input-sm"  name="editarTipo"  id ="editarTipo" readonly>

                    </div>

                    <!-- ENTRADA PARA LA DESCRIPCION CORTA-->
                    <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">Cod fab</label>
                    
                    <div class="col-lg-3">

                        <input type="text" class="form-control input-md"  name="editarCodFab"  id ="editarCodFab" readonly>

                    </div>

                    <!-- ENTRADA PARA LA DESCRIPCION CORTA-->
                    <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">Codigo</label>
                            
                    <div class="col-lg-2">

                        <input type="text" class="form-control input-md"  name="editarCodigo"  id ="editarCodigo" readonly>

                    </div>

                </div> 

                <div class="form-group" style="padding-top:25px">

                    <!-- ENTRADA PARA LA DESCRIPCION CORTA-->
                    <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">Unidad</label>
                    
                    <div class="col-lg-2">

                        <input type="text" class="form-control input-md"  name="editarUnidad"  id ="editarUnidad" readonly>

                    </div>

                    
                    

                    <!-- ENTRADA PARA LA DESCRIPCION CORTA-->
                    <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">Descripcion</label>
                    
                    <div class="col-lg-6">

                        <input type="text" class="form-control input-md"  name="editarDescripcion"  id ="editarDescripcion" readonly>

                    </div>

                </div>  

                <div class="form-group" style="padding-top:25px">

                    <!-- ENTRADA PARA LA DESCRIPCION CORTA-->
                    <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">Talla</label>
                    
                    <div class="col-lg-2">

                        <input type="text" class="form-control input-md"  name="editarTalla"  id ="editarTalla" readonly>

                    </div>

                    <!-- ENTRADA PARA LA DESCRIPCION CORTA-->
                    <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">Color</label>
                    
                    <div class="col-lg-6">

                        <input type="text" class="form-control input-md"  name="editarColor"  id ="editarColor" readonly>

                    </div>

                    

                    

                </div>  

                <div class="form-group" style="padding-top:25px">

                    


                    <!-- ENTRADA PARA EL CORRELATIVO-->
                    <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">Documento</label>
                    
                    <div class="col-lg-2">

                        <input type="text" class="form-control input-sm"  name="editarDocumento"  id ="editarDocumento" readonly>

                    </div>

                    <!-- ENTRADA PARA LA DESCRIPCION CORTA-->
                    <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">Cantidad</label>
                    
                    <div class="col-lg-3">

                        <input type="number" class="form-control input-md"  name="editarCantidadMP"  id ="editarCantidadMP" >
                        <input type="hidden" name="editarCantidadAntigua" id="editarCantidadAntigua">

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
 

    </div>

  </div>

</div>

<script>
window.document.title = "Maestra Produccion";
var tamañoTabla = $(".TablaProdCabecera").width();
if(tamañoTabla == "331.25"){
    $(document).ready(function () {             
        $('.dataTables_filter input[type="search"]').css(
            {'width':'270px','display':'inline-block'}
        );
    });
}else{
    $(document).ready(function () {             
        $('.dataTables_filter input[type="search"]').css(
            {'width':'370px','display':'inline-block'}
        );
    });
}
</script>