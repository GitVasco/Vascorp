<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Crear orden de servicio

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Crear orden de servicio</li>

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

            <table class="table table-bordered table-striped dt-responsive tablaMateriaOrdenesServicios" width="100%">

              <thead>

                <tr>
                  <th>Codigo</th>
                  <th>Cod. Fabrica</th>
                  <th>Descripcion</th>
                  <th>Color</th>
                  <th>Unidad</th>
                  <th>Costo</th>
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

          <form role="form" method="post" class="formularioOrdenServicio">

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
                  

                  <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">PROVEEDOR</label>
                  <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" name="nuevoProveedorServicio" id="nuevoProveedorServicio" value="000097" readonly>
                    
                  </div>
                    
                  <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">RAZON SOCIAL</label>
                  <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  name ="nuevaRazonSocial" id="nuevaRazonSocial" value="ELASTICOS VASCO" readonly>
                  </div>

                  <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">RUC</label>
                  <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  id ="nuevoRuc" name="nuevoRuc" value="20551240356" readonly>
                  </div>

                  <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">FECHA</label>
                  <div class="col-lg-2">
                    <input type="date" class="form-control input-sm"  name="nuevaFecha" value="<?php echo $fecha->format("Y-m-d"); ?>" readonly>
                  </div>

                  
                </div>

               

                <div class="form-group" style="padding-top:25px;padding-bottom:25px">


                    <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">FEC ENTREGA</label>
                    <div class="col-lg-2">
                        <input type="date" class="form-control input-sm"  name ="nuevaFechaEntrega" value="<?php echo $fecha->format("Y-m-d"); ?>">
                    </div>

                    <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">OBSERVACION</label>
                    <div class="col-lg-5">
                    <input type="text" class="form-control input-sm info-box-text"  name ="nuevaObservacion" >
                    </div>

                    <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">DESCONTAR STOCK</label>
                    <div class="col-lg-2">
                        <select  class="form-control input-sm" name="nuevoDsctoStock" id="nuevoDsctoStock" required>
                        
                        <option value="SI">SI</option>
                        <option value="NO">NO </option>
                        </select>
                    </div>

                    <div class="col-lg-12"></div>

                </div>

                <div class="box box-primary" >

                  <div class="row">
                    <div class="col-xs-1">

                      <label for="">COD PRODUCTO</label>

                    </div>
                    <div class="col-xs-3">

                      <label for="" >DESCRIPCION</label>

                    </div>

                    <div class="col-xs-1">

                      <label for="" >COLOR</label>

                    </div>

                    <div class="col-xs-1">

                      <label for="" >COD DESTINO</label>

                    </div>

                    <div class="col-xs-3">

                      <label for="" >DESCRIPCION</label>

                    </div>

                    <div class="col-xs-1">

                      <label for="" >COLOR</label>

                    </div>

                    <div class="col-xs-1">

                      <label for="" >UND</label>

                    </div>

                    <div class="col-xs-1">

                      <label for="" >CANTIDAD</label>

                    </div>

                  </div>

                </div>
                <!--=====================================
                ENTRADA PARA AGREGAR MATERIA PRIMA
                ======================================-->

                <div class="form-group row nuevaMateriaServicio">



                </div>

                <input type="hidden" id="listarMateriaServicios" name="listarMateriaServicios">


                <hr>


                </div>

              </div>

            </div>

            <div class="box-footer">

              <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Guardar orden de servicio</button>

              <a href="orden-servicio"  class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancelar</a>
            </div>

          </form>

          <?php

            $guardarOrdenServicio = new ControladorOrdenServicio();
            $guardarOrdenServicio -> ctrCrearOrdenServicio();

          ?>          

        </div>

      </div>

      

    </div>

  </section>

</div>



<!--  Modal de Informacion de Materia Prima destino -->
   <!-- Start -->

   <div class="modal fade" id="ModalMPOrdenServicioDestino" tabindex="-1" role="dialog" aria-labelledby="ModalProvlLabel">
			<div class="modal-dialog " role="document" style="width:75%">
				<div class="modal-content " >
					<div class="modal-header" style="background:#3c8dbc; color:white">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="ModalProvlLabel">Materia Prima destino</h4>
					</div>
					<div class="modal-body">
          <input type="hidden" id="codigoOrigen" >
					<div class="table-responsive">
						<table class="table table-hover tablaMateriaServicioDestino" width="100%">
							<thead>
								<tr>
                  <th>Codigo</th>
									<th>Cod.Fabrica</th> 
									<th style="min-width:240px">Descripcion</th>
									<th>Color</th>
									<th>Unidad</th>
									<th>Precio </th>
									<th>Stock MateriaPrima</th>
									<th>Acciones</th>
								</tr>
							</thead>
						</table>
					</div>
						
					</div>
					<div class="modal-footer">
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

	<!-- End -->

<script>
window.document.title = "Crear orden de servicio"
</script>