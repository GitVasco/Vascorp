<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Solicitud de Gasto

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Solicitud de Gasto</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <div class="col-lg-1">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarSolicitud">
                        Registrar Solicitud
                    </button>
                </div>

            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive TablaSolicitud" width="100%">

                    <thead>

                        <tr>

                            <th>Fecha</th>
                            <th>Recibo</th>
                            <th>Proveedor</th>
                            <th>Sucursal</th>
                            <th>Gasto</th>
                            <th>Detalle</th>
                            <th>Total S/</th>
                            <th>Tip Doc.</th>
                            <th>Documento</th>
                            <th>Solicitante</th>
                            <th>Descripcion</th>
							<th>Responsable</th>
							<th>Estado</th>
                            <th width="80px">Acciones</th>

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
MODAL REGISTRAR GASTO
======================================-->

<div id="modalAgregarSolicitud" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 70% !important">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar gasto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          <?php
            date_default_timezone_set('America/Lima');
            $fecha = new DateTime();
          ?>

            <div class="form-group">
                <label class="col-form-label col-lg-1 col-md-1">Fecha</label>
                <div class="col-lg-2">
                    <input type="date" class="form-control input-sm" id="fechaSolicitud" name="fechaSolicitud"   value="<?php echo $fecha->format("Y-m-d"); ?>">
                </div>

                <label class="col-form-label col-lg-1 col-md-1">Recibo</label>
                <div class="col-lg-2">
                        <?php

                            $recibo = ControladorCentroCostos::ctrMostrarCorrelativoRecibo();
                            #var_dump($recibo);

                            echo'<input type="text" class="form-control input-sm" id="recibo" name="recibo" value="'.$recibo["recibo"].'" readonly>';

                        ?>
                    
                </div>

                <label for=""  class="col-form-label col-lg-1 col-md-1">Sucursal</label>
                <div class="col-lg-5 col-md-3">
                    <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevaSucursal" id="nuevaSucursal" required>
                        <option value="">Seleccionar Sucursal</option>
                        <?php
                        $valor = "TSUC";

                        $sucursal = ModeloMaestras::mdlMostrarMaestrasDetalle($valor);
                        #var_dump($sucursal);
                        foreach ($sucursal as $key => $value) {
                            echo '<option value="' . $value["cod_argumento"] . '">' .$value["cod_argumento"]. " - " . $value["des_larga"] . '</option>';
                        }

                        ?>
                    </select>
                </div>                

            </div>

            <div class="form-group" style="padding-top:25px">

                <label class="col-form-label col-lg-1 col-md-1">Proveedor</label>
                <div class="col-lg-2">
                    <div class="input-group">
                        <input type="number"  class="form-control input-sm" name="nuevoRucProSol" id="nuevoRucProSol">
                        <div class="input-group-addon" style="padding:0px !important;border: 0px !important">
                            <button type="button" class="btn btn-default btn-sm" onclick="ObtenerDatosRuc3('nvo3')"><i class="fa fa-search "></i></button>	
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-10 col-sm-9">

                    <input type="text" style="text-transform:uppercase;" class="form-control input-md" name="nuevaRazPro" id="nuevaRazPro" placeholder="Ingresar razon social" readonly>

                </div>            

                <label class="col-form-label col-lg-1 col-md-1">Tipo Doc.</label>
                <div class="col-lg-2 col-md-3">
                    <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevoTipo" id="nuevoTipo" disabled>
                        <option value="">Seleccionar Tipo Doc.</option>
                        <?php

                        $tipoDoc = ControladorCentroCostos::ctrMostrarTipoDoc();
                        #var_dump($tipoDoc);
                        foreach ($tipoDoc as $key => $value) {
                            echo '<option value="' . $value["codigo"] . '">' .$value["codigo"]." - ".$value["descripcion"].'</option>';
                        }

                        ?>
                    </select>
                </div> 

                <label class="col-form-label col-lg-1 col-md-1">Número</label>
                <div class="col-lg-2">
                    <input type="text" style="text-transform:uppercase;" class="form-control input-sm" id="documento" name="documento" disabled>
                </div>

            </div>

            <div class="form-group" style="padding-top:25px">

                <label class="col-form-label col-lg-1 col-md-1">Cod. Caja</label>

                <div class="col-lg-8 col-md-3">
                    <select  class="form-control input-md selectpicker" data-size="10" data-live-search="true" name="nuevoCodCajaSol" id="nuevoCodCajaSol" required>
                        <option value="">Seleccionar Código Caja</option>
                        <?php

                        $sucursal = ControladorCentroCostos::ctrMostrarCentroCostosCaja();
                        #var_dump($sucursal);
                        foreach ($sucursal as $key => $value) {
                            echo '<option value="'.$value["cod_caja"].'">'.$value["cod_caja"]." - ".$value["nombre_gasto"]." - ".$value["nombre_area"]." - ".$value["descripcion"].'</option>';
                        }

                        ?>
                    </select>
                </div>   
                
                <label class="col-form-label col-lg-1 col-md-1">Total S/.</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm money" id="totalSol" name="totalSol" required>
                </div>                

            </div>  

            <div class="form-group" style="padding-top:25px">          
            
                <label class="col-form-label col-lg-1 col-md-1">Gasto</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control input-sm" id="gastoSol" name="gastoSol" readonly>
                </div> 

                <label class="col-form-label col-lg-1 col-md-1">Área</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control input-sm" id="areaSol" name="areaSol" readonly>
                </div> 

                <label class="col-form-label col-lg-1 col-md-1">Caja</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control input-sm" id="cajaSol" name="cajaSol" readonly>
                </div> 

            </div>

            <div class="form-group" style="padding-top:25px">          
            
                <label class="col-form-label col-lg-1 col-md-1">Solicitante</label>
                <div class="col-lg-2">
                    <input type="text" style="text-transform:uppercase;" class="form-control input-sm" id="solicitante" name="solicitante" value="<?php echo $_SESSION["nombre"] ; ?>">
                </div> 

                <label class="col-form-label col-lg-1 col-md-1">Descripción</label>
                <div class="col-lg-4">
                    <input type="text" style="text-transform:uppercase;" class="form-control input-sm" id="descripcion" name="descripcion">
                </div> 

                <label class="col-form-label col-lg-1 col-md-1">Canc.</label>
                <div class="col-lg-3">
                    <input type="text" style="text-transform:uppercase;" class="form-control input-sm" id="rubro" name="rubro">
                </div> 

            </div> 
            
            <div class="form-group" style="padding-top:25px">          
            
                <label class="col-form-label col-lg-1 col-md-1">Obs.</label>
                <div class="col-lg-11">
                    <input type="text" style="text-transform:uppercase;" class="form-control input-sm" id="observacion" name="observacion">
                </div> 

            </div>            

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Solicitud</button>

        </div>

        <?php

          $crearGastosSolicitud = new ControladorCentroCostos();
          $crearGastosSolicitud -> ctrCrearGastosSolicitud();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR SOLICITUD
======================================-->

<div id="modalEditarSolicitud" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 70% !important">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar solicitud</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          <?php
            date_default_timezone_set('America/Lima');
            $fecha = new DateTime();
          ?>

            <div class="form-group">
                <label class="col-form-label col-lg-1 col-md-1">Fecha</label>
                <div class="col-lg-2">
                    <input type="date" class="form-control input-sm" id="editarFechaSol" name="editarFechaSol" readonly>
                    <input type="hidden" class="form-control input-sm" id="id" name="id">
                    <input type="hidden" class="form-control input-sm" id="estado" name="estado">
                </div>

                <label class="col-form-label col-lg-1 col-md-1">Recibo</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" id="editarRecibo" name="editarRecibo" readonly>
                </div>

                <label for=""  class="col-form-label col-lg-1 col-md-1">Sucursal</label>
                <div class="col-lg-5 col-md-3">
                    <select  class="form-control input-md selectpicker" data-live-search="true" name="editarSucursalSol" id="editarSucursalSol" required>
                        <option value="">Seleccionar Sucursal</option>
                        <?php
                        $valor = "TSUC";

                        $sucursal = ModeloMaestras::mdlMostrarMaestrasDetalle($valor);
                        #var_dump($sucursal);
                        foreach ($sucursal as $key => $value) {
                            echo '<option value="' . $value["cod_argumento"] . '">' .$value["cod_argumento"]. " - " . $value["des_larga"] . '</option>';
                        }

                        ?>
                    </select>
                </div>                

            </div>

            <div class="form-group" style="padding-top:25px">

                <label class="col-form-label col-lg-1 col-md-1">Proveedor</label>
                <div class="col-lg-2">
                    <div class="input-group">
                        <input type="number"  class="form-control input-sm" name="editarRucProSol" id="editarRucProSol">
                        <div class="input-group-addon" style="padding:0px !important;border: 0px !important">
                            <button type="button" class="btn btn-default btn-sm" onclick="ObtenerDatosRuc3('nvo4')"><i class="fa fa-search "></i></button>	
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-10 col-sm-9">

                    <input type="text" style="text-transform:uppercase;" class="form-control input-md" name="editarRazPro" id="editarRazPro" placeholder="Ingresar razon social">

                </div>            

                <label class="col-form-label col-lg-1 col-md-1">Tipo Doc.</label>
                <div class="col-lg-2 col-md-3">
                    <select  class="form-control input-md selectpicker" data-live-search="true" name="editarTipoSol" id="editarTipoSol" required>
                        <option value="">Seleccionar Tipo Doc.</option>
                        <?php

                        $tipoDoc = ControladorCentroCostos::ctrMostrarTipoDoc();
                        #var_dump($tipoDoc);
                        foreach ($tipoDoc as $key => $value) {
                            echo '<option value="' . $value["codigo"] . '">' .$value["codigo"]." - ".$value["descripcion"].'</option>';
                        }

                        ?>
                    </select>
                </div> 

                <label class="col-form-label col-lg-1 col-md-1">Número</label>
                <div class="col-lg-2">
                    <input type="text" style="text-transform:uppercase;" class="form-control input-sm" id="editarDocumentoS" name="editarDocumentoS">
                </div>

            </div>

            <div class="form-group" style="padding-top:25px">

                <label class="col-form-label col-lg-1 col-md-1">Cod. Caja</label>

                <div class="col-lg-8 col-md-3">
                    <select  class="form-control input-md selectpicker" data-size="10" data-live-search="true" name="editarCodCajaSol" id="editarCodCajaSol" required>
                        <option value="">Seleccionar Código Caja</option>
                        <?php

                        $sucursal = ControladorCentroCostos::ctrMostrarCentroCostosCaja();
                        #var_dump($sucursal);
                        foreach ($sucursal as $key => $value) {
                            echo '<option value="'.$value["cod_caja"].'">'.$value["cod_caja"]." - ".$value["nombre_gasto"]." - ".$value["nombre_area"]." - ".$value["descripcion"].'</option>';
                        }

                        ?>
                    </select>
                </div>   
                
                <label class="col-form-label col-lg-1 col-md-1">Total S/.</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm money" id="editarTotalS" name="editarTotalS" required>
                    <input type="hidden" step="any" class="form-control input-sm" id="totalAntiguo" name="totalAntiguo" required>
                </div>                

            </div>  

            <div class="form-group" style="padding-top:25px">          
            
                <label class="col-form-label col-lg-1 col-md-1">Gasto</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control input-sm" id="editarGastoSol" name="editarGastoSol" readonly>
                </div> 

                <label class="col-form-label col-lg-1 col-md-1">Área</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control input-sm" id="editarAreaSol" name="editarAreaSol" readonly>
                </div> 

                <label class="col-form-label col-lg-1 col-md-1">Caja</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control input-sm" id="editarCajaSol" name="editarCajaSol" readonly>
                </div> 

            </div>

            <div class="form-group" style="padding-top:25px">          
            
                <label class="col-form-label col-lg-1 col-md-1">Solicitante</label>
                <div class="col-lg-2">
                    <input type="text" style="text-transform:uppercase;" class="form-control input-sm" id="editarSolicitante" name="editarSolicitante">
                </div> 

                <label class="col-form-label col-lg-1 col-md-1">Descripción</label>
                <div class="col-lg-4">
                    <input type="text" style="text-transform:uppercase;" class="form-control input-sm" id="editarDescripcion" name="editarDescripcion">
                </div> 

                <label class="col-form-label col-lg-1 col-md-1">Canc.</label>
                <div class="col-lg-3">
                    <input type="text" style="text-transform:uppercase;" class="form-control input-sm" id="editarRubro" name="editarRubro">
                </div> 

            </div> 
            
            <div class="form-group" style="padding-top:25px">          
            
                <label class="col-form-label col-lg-1 col-md-1">Obs.</label>
                <div class="col-lg-11">
                    <input type="text" style="text-transform:uppercase;" class="form-control input-sm" id="editarObservacion" name="editarObservacion">
                </div> 

            </div>            

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Editar Gasto</button>

        </div>

        <?php

          $editarGastosCaja = new ControladorCentroCostos();
          $editarGastosCaja -> ctrEditarSolicitudCaja();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

    $anularGasto = new ControladorCentroCostos();
    $anularGasto -> ctrAnularSolicitud();

?>

<script>

    window.document.title = "Solicitud Gasto (-)";

$("#nuevoCodCajaSol, #editarCodCajaSol").change(function(){

	var cod_caja = $(this).val();
	//console.log(cod_caja);

	var datos = new FormData();

	datos.append("cod_caja", cod_caja);

	$.ajax({

		url:"ajax/centro-costos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

			$("#editarGastoSol").val(respuesta["nombre_gasto"]);
			$("#editarAreaSol").val(respuesta["nombre_area"]);
			$("#editarCajaSol").val(respuesta["descripcion"]);

			$("#gastoSol").val(respuesta["nombre_gasto"]);
			$("#areaSol").val(respuesta["nombre_area"]);
			$("#cajaSol").val(respuesta["descripcion"]);

			if(respuesta["tipo_gasto"] == "94"){

				document.getElementById("gastoSol").style.background = "#52BE80";
				document.getElementById("gastoSol").style.color = "black";
				$("#gastoSol").css("font-weight","bold");

				document.getElementById("areaSol").style.background = "#52BE80";
				document.getElementById("areaSol").style.color = "black";
				$("#areaSol").css("font-weight","bold");

				document.getElementById("cajaSol").style.background = "#52BE80";
				document.getElementById("cajaSol").style.color = "black";
				$("#cajaSol").css("font-weight","bold");

				document.getElementById("editarGastoSol").style.background = "#52BE80";
				document.getElementById("editarGastoSol").style.color = "black";
				$("#editarGastoSol").css("font-weight","bold");

				document.getElementById("editarAreaSol").style.background = "#52BE80";
				document.getElementById("editarAreaSol").style.color = "black";
				$("#editarAreaSol").css("font-weight","bold");

				document.getElementById("editarCajaSol").style.background = "#52BE80";
				document.getElementById("editarCajaSol").style.color = "black";
				$("#editarCajaSol").css("font-weight","bold");

			}else if(respuesta["tipo_gasto"] == "95"){

				document.getElementById("gastoSol").style.background = "#52BEB4";
				document.getElementById("gastoSol").style.color = "black";
				$("#gastoSol").css("font-weight","bold");

				document.getElementById("areaSol").style.background = "#52BEB4";
				document.getElementById("areaSol").style.color = "black";
				$("#areaSol").css("font-weight","bold");

				document.getElementById("cajaSol").style.background = "#52BEB4";
				document.getElementById("cajaSol").style.color = "black";
				$("#cajaSol").css("font-weight","bold");

				document.getElementById("editarGastoSol").style.background = "#52BEB4";
				document.getElementById("editarGastoSol").style.color = "black";
				$("#editarGastoSol").css("font-weight","bold");

				document.getElementById("editarAreaSol").style.background = "#52BEB4";
				document.getElementById("editarAreaSol").style.color = "black";
				$("#editarAreaSol").css("font-weight","bold");

				document.getElementById("editarCajaSol").style.background = "#52BEB4";
				document.getElementById("editarCajaSol").style.color = "black";
				$("#editarCajaSol").css("font-weight","bold");

			}else if(respuesta["tipo_gasto"] == "92"){

				document.getElementById("gastoSol").style.background = "#FF6868";
				document.getElementById("gastoSol").style.color = "black";
				$("#gastoSol").css("font-weight","bold");

				document.getElementById("areaSol").style.background = "#FF6868";
				document.getElementById("areaSol").style.color = "black";
				$("#areaSol").css("font-weight","bold");

				document.getElementById("cajaSol").style.background = "#FF6868";
				document.getElementById("cajaSol").style.color = "black";
				$("#cajaSol").css("font-weight","bold");

				document.getElementById("editarGastoSol").style.background = "#FF6868";
				document.getElementById("editarGastoSol").style.color = "black";
				$("#editarGastoSol").css("font-weight","bold");

				document.getElementById("editarAreaSol").style.background = "#FF6868";
				document.getElementById("editarAreaSol").style.color = "black";
				$("#editarAreaSol").css("font-weight","bold");

				document.getElementById("editarCajaSol").style.background = "#FF6868";
				document.getElementById("editarCajaSol").style.color = "black";
				$("#editarCajaSol").css("font-weight","bold");				

			}else if(respuesta["tipo_gasto"] == "97"){

				document.getElementById("gastoSol").style.background = "#7C9EFF";
				document.getElementById("gastoSol").style.color = "black";
				$("#gastoSol").css("font-weight","bold");

				document.getElementById("areaSol").style.background = "#7C9EFF";
				document.getElementById("areaSol").style.color = "black";
				$("#areaSol").css("font-weight","bold");

				document.getElementById("cajaSol").style.background = "#7C9EFF";
				document.getElementById("cajaSol").style.color = "black";
				$("#cajaSol").css("font-weight","bold");

				document.getElementById("editarGastoSol").style.background = "#7C9EFF";
				document.getElementById("editarGastoSol").style.color = "black";
				$("#editarGastoSol").css("font-weight","bold");

				document.getElementById("editarAreaSol").style.background = "#7C9EFF";
				document.getElementById("editarAreaSol").style.color = "black";
				$("#editarAreaSol").css("font-weight","bold");

				document.getElementById("editarCajaSol").style.background = "#7C9EFF";
				document.getElementById("editarCajaSol").style.color = "black";
				$("#editarCajaSol").css("font-weight","bold");				

			}else if(respuesta["tipo_gasto"] == "60"){

				document.getElementById("gastoSol").style.background = "#CCF459";
				document.getElementById("gastoSol").style.color = "black";
				$("#gastoSol").css("font-weight","bold");

				document.getElementById("areaSol").style.background = "#CCF459";
				document.getElementById("areaSol").style.color = "black";
				$("#areaSol").css("font-weight","bold");

				document.getElementById("cajaSol").style.background = "#CCF459";
				document.getElementById("cajaSol").style.color = "black";
				$("#cajaSol").css("font-weight","bold");

				document.getElementById("editarGastoSol").style.background = "#CCF459";
				document.getElementById("editarGastoSol").style.color = "black";
				$("#editarGastoSol").css("font-weight","bold");

				document.getElementById("editarAreaSol").style.background = "#CCF459";
				document.getElementById("editarAreaSol").style.color = "black";
				$("#editarAreaSol").css("font-weight","bold");

				document.getElementById("editarCajaSol").style.background = "#CCF459";
				document.getElementById("editarCajaSol").style.color = "black";
				$("#editarCajaSol").css("font-weight","bold");				

			}else if(respuesta["tipo_gasto"] == "10"){

				document.getElementById("gastoSol").style.background = "#AAE1FF";
				document.getElementById("gastoSol").style.color = "black";
				$("#gastoSol").css("font-weight","bold");

				document.getElementById("areaSol").style.background = "#AAE1FF";
				document.getElementById("areaSol").style.color = "black";
				$("#areaSol").css("font-weight","bold");

				document.getElementById("cajaSol").style.background = "#AAE1FF";
				document.getElementById("cajaSol").style.color = "black";
				$("#cajaSol").css("font-weight","bold");

				document.getElementById("editarGastoSol").style.background = "#AAE1FF";
				document.getElementById("editarGastoSol").style.color = "black";
				$("#editarGastoSol").css("font-weight","bold");

				document.getElementById("editarAreaSol").style.background = "#AAE1FF";
				document.getElementById("editarAreaSol").style.color = "black";
				$("#editarAreaSol").css("font-weight","bold");

				document.getElementById("editarCajaSol").style.background = "#AAE1FF";
				document.getElementById("editarCajaSol").style.color = "black";
				$("#editarCajaSol").css("font-weight","bold");				

			}else if(respuesta["tipo_gasto"] == "11"){

				document.getElementById("gastoSol").style.background = "#DDDAD6";
				document.getElementById("gastoSol").style.color = "black";
				$("#gastoSol").css("font-weight","bold");

				document.getElementById("areaSol").style.background = "#DDDAD6";
				document.getElementById("areaSol").style.color = "black";
				$("#areaSol").css("font-weight","bold");

				document.getElementById("cajaSol").style.background = "#DDDAD6";
				document.getElementById("cajaSol").style.color = "black";
				$("#cajaSol").css("font-weight","bold");

				document.getElementById("editarGastoSol").style.background = "#DDDAD6";
				document.getElementById("editarGastoSol").style.color = "black";
				$("#editarGastoSol").css("font-weight","bold");

				document.getElementById("editarAreaSol").style.background = "#DDDAD6";
				document.getElementById("editarAreaSol").style.color = "black";
				$("#editarAreaSol").css("font-weight","bold");

				document.getElementById("editarCajaSol").style.background = "#DDDAD6";
				document.getElementById("editarCajaSol").style.color = "black";
				$("#editarCajaSol").css("font-weight","bold");				

			}else if(respuesta["tipo_gasto"] == "12"){

				document.getElementById("gastoSol").style.background = "#FFCFE8";
				document.getElementById("gastoSol").style.color = "black";
				$("#gastoSol").css("font-weight","bold");

				document.getElementById("areaSol").style.background = "#FFCFE8";
				document.getElementById("areaSol").style.color = "black";
				$("#areaSol").css("font-weight","bold");

				document.getElementById("cajaSol").style.background = "#FFCFE8";
				document.getElementById("cajaSol").style.color = "black";
				$("#cajaSol").css("font-weight","bold");

				document.getElementById("editarGastoSol").style.background = "#FFCFE8";
				document.getElementById("editarGastoSol").style.color = "black";
				$("#editarGastoSol").css("font-weight","bold");

				document.getElementById("editarAreaSol").style.background = "#FFCFE8";
				document.getElementById("editarAreaSol").style.color = "black";
				$("#editarAreaSol").css("font-weight","bold");

				document.getElementById("editarCajaSol").style.background = "#FFCFE8";
				document.getElementById("editarCajaSol").style.color = "black";
				$("#editarCajaSol").css("font-weight","bold");				

			}else if(respuesta["tipo_gasto"] == "13"){

				document.getElementById("gastoSol").style.background = "#F5FAA5";
				document.getElementById("gastoSol").style.color = "black";
				$("#gastoSol").css("font-weight","bold");

				document.getElementById("areaSol").style.background = "#F5FAA5";
				document.getElementById("areaSol").style.color = "black";
				$("#areaSol").css("font-weight","bold");

				document.getElementById("cajaSol").style.background = "#F5FAA5";
				document.getElementById("cajaSol").style.color = "black";
				$("#cajaSol").css("font-weight","bold");

				document.getElementById("editarGastoSol").style.background = "#F5FAA5";
				document.getElementById("editarGastoSol").style.color = "black";
				$("#editarGastoSol").css("font-weight","bold");

				document.getElementById("editarAreaSol").style.background = "#F5FAA5";
				document.getElementById("editarAreaSol").style.color = "black";
				$("#editarAreaSol").css("font-weight","bold");

				document.getElementById("editarCajaSol").style.background = "#F5FAA5";
				document.getElementById("editarCajaSol").style.color = "black";
				$("#editarCajaSol").css("font-weight","bold");				

			}else if(respuesta["tipo_gasto"] == "14"){

				document.getElementById("gastoSol").style.background = "#DFB6F9";
				document.getElementById("gastoSol").style.color = "black";
				$("#gastoSol").css("font-weight","bold");

				document.getElementById("areaSol").style.background = "#DFB6F9";
				document.getElementById("areaSol").style.color = "black";
				$("#areaSol").css("font-weight","bold");

				document.getElementById("cajaSol").style.background = "#DFB6F9";
				document.getElementById("cajaSol").style.color = "black";
				$("#cajaSol").css("font-weight","bold");

				document.getElementById("editarGastoSol").style.background = "#DFB6F9";
				document.getElementById("editarGastoSol").style.color = "black";
				$("#editarGastoSol").css("font-weight","bold");

				document.getElementById("editarAreaSol").style.background = "#DFB6F9";
				document.getElementById("editarAreaSol").style.color = "black";
				$("#editarAreaSol").css("font-weight","bold");

				document.getElementById("editarCajaSol").style.background = "#DFB6F9";
				document.getElementById("editarCajaSol").style.color = "black";
				$("#editarCajaSol").css("font-weight","bold");				

			}

		}
  
	}) 

})
</script>