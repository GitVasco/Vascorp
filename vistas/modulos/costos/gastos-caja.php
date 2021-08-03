<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Registro de gastos

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Registro de gastos</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <div class="col-lg-1">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarGasto">
                        Registrar Gasto
                    </button>
                </div>

                <div class="col-lg-1">
                    <button type="button" class="btn btn-danger" id="cerrarMes" name="cerrarMes" data-toggle="modal" data-target="#modalCerrarMes">Seleccionar Mes
                    </button>
                </div>

                <div class="col-lg-6 text-center">
                    <button class="btn btn-default  btnEne" id="btnEne" name="btnEne" value="1">
                        Ene
                    </button>
                    <button class="btn btn-default  btnFeb" id="btnFeb" name="btnFeb" value="2">
                        Feb
                    </button>
                    <button class="btn btn-default  btnMar" id="btnMar" name="btnMar" value="3">
                        Mar
                    </button>
                    <button class="btn btn-default  btnAbr" id="btnAbr" name="btnAbr" value="4">
                        Abr
                    </button>
                    <button class="btn btn-default  btnMay" id="btnMay" name="btnMay" value="5">
                        May
                    </button>
                    <button class="btn btn-default  btnJun" id="btnJun" name="btnJun" value="6">
                        Jun
                    </button>
                    <button class="btn btn-default  btnJul" id="btnJul" name="btnJul" value="7">
                        Jul
                    </button>
                    <button class="btn btn-default  btnAgo" id="btnAgo" name="btnAgo" value="8">
                        Ago
                    </button>
                    <button class="btn btn-default  btnSep" id="btnSep" name="btnSep" value="9">
                        Sep
                    </button>
                    <button class="btn btn-default  btnOct" id="btnOct" name="btnOct" value="10">
                        Oct
                    </button>
                    <button class="btn btn-default  btnNov" id="btnNov" name="btnNov" value="11">
                        Nov
                    </button>
                    <button class="btn btn-default  btnDic" id="btnDic" name="btnDic" value="12">
                        Dic
                    </button>
                    
                </div>

                <div class="col-lg-1 text-center bg-yellow border-20">

                    <span class="info-box-text">Saldo Inicial</span>
                    <span class="info-box-number saldoInicial" name="saldoInicial" id="saldoInicial">0</span>

                </div>

                <div class="col-lg-1 text-center bg-primary">

                    <span class="info-box-text">Ingresos</span>
                    <span class="info-box-number" name="saldoIngreso" id="saldoIngreso">0</span>

                </div>
                
                <div class="col-lg-1 text-center bg-red">

                    <span class="info-box-text">Egresos</span>
                    <span class="info-box-number" name="saldoEgreso" id="saldoEgreso">0</span>

                </div>   
                
                <div class="col-lg-1 text-center bg-green">

                    <span class="info-box-text">Saldo Actual</span>
                    <span class="info-box-number" name="saldoActual" id="saldoActual">0</span>

                </div>      
                
                



            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive TablaGastosCaja" width="100%">

                    <thead>

                        <tr>

                            <th width="5%">Fecha</th>
                            <th width="5%">Recibo</th>
                            <th width="10%">Proveedor</th>
                            <th width="10%">Sucursal</th>
                            <th width="3%">Gasto</th>
                            <th width="3%">Cod</th>
                            <th width="12%">Detalle</th>
                            <th width="5%">Total S/</th>
                            <th width="5%">Tip Doc.</th>
                            <th width="7%">Documento</th>
                            <th width="13%">Solicitante</th>
                            <th width="13%">Descripcion</th>
                            <th width="9%">#</th>

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

<div id="modalAgregarGasto" class="modal fade" role="dialog">
  
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
                    <input type="date" class="form-control input-sm" id="fechaGasto" name="fechaGasto"   value="<?php echo $fecha->format("Y-m-d"); ?>">
                </div>

                <label class="col-form-label col-lg-1 col-md-1">Recibo</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" id="recibo" name="recibo">
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
                        <input type="number"  class="form-control input-sm" name="nuevoRucProC" id="nuevoRucProC">
                        <div class="input-group-addon" style="padding:0px !important;border: 0px !important">
                            <button type="button" class="btn btn-default btn-sm" onclick="ObtenerDatosRuc3()"><i class="fa fa-search "></i></button>	
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-10 col-sm-9">

                    <input type="text" style="text-transform:uppercase;" class="form-control input-md" name="nuevaRazPro" id="nuevaRazPro" placeholder="Ingresar razon social" readonly>

                </div>            

                <label class="col-form-label col-lg-1 col-md-1">Tipo Doc.</label>
                <div class="col-lg-2 col-md-3">
                    <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevoTipo" id="nuevoTipo" required>
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
                    <input type="text" style="text-transform:uppercase;" class="form-control input-sm" id="documento" name="documento">
                </div>

            </div>

            <div class="form-group" style="padding-top:25px">

                <label class="col-form-label col-lg-1 col-md-1">Cod. Caja</label>

                <div class="col-lg-8 col-md-3">
                    <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevoCodCaja" id="nuevoCodCaja" required>
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
                    <input type="text" class="form-control input-sm money" id="total" name="total" required>
                </div>                

            </div>  

            <div class="form-group" style="padding-top:25px">          
            
                <label class="col-form-label col-lg-1 col-md-1">Gasto</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control input-sm" id="gasto" name="gasto" readonly>
                </div> 

                <label class="col-form-label col-lg-1 col-md-1">Área</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control input-sm" id="area" name="area" readonly>
                </div> 

                <label class="col-form-label col-lg-1 col-md-1">Caja</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control input-sm" id="caja" name="caja" readonly>
                </div> 

            </div>

            <div class="form-group" style="padding-top:25px">          
            
                <label class="col-form-label col-lg-1 col-md-1">Solicitante</label>
                <div class="col-lg-2">
                    <input type="text" style="text-transform:uppercase;" class="form-control input-sm" id="solicitante" name="solicitante">
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

          <button type="submit" class="btn btn-primary">Guardar Gasto</button>

        </div>

        <?php

          $crearGastosCaja = new ControladorCentroCostos();
          $crearGastosCaja -> ctrCrearGastosCaja();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR GASTO
======================================-->

<div id="modalEditarGasto" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 70% !important">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar gasto</h4>

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
                    <input type="date" class="form-control input-sm" id="editarFechaGasto" name="editarFechaGasto">
                    <input type="hidden" class="form-control input-sm" id="id" name="id">
                </div>

                <label class="col-form-label col-lg-1 col-md-1">Recibo</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" id="editarRecibo" name="editarRecibo">
                </div>

                <label for=""  class="col-form-label col-lg-1 col-md-1">Sucursal</label>
                <div class="col-lg-5 col-md-3">
                    <select  class="form-control input-md selectpicker" data-live-search="true" name="editarSucursal" id="editarSucursal" required>
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
                        <input type="number"  class="form-control input-sm" name="editarRucProC" id="editarRucProC">
                        <div class="input-group-addon" style="padding:0px !important;border: 0px !important">
                            <button type="button" class="btn btn-default btn-sm" onclick="ObtenerDatosRuc3()"><i class="fa fa-search "></i></button>	
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-10 col-sm-9">

                    <input type="text" style="text-transform:uppercase;" class="form-control input-md" name="editarRazPro" id="editarRazPro" placeholder="Ingresar razon social">

                </div>            

                <label class="col-form-label col-lg-1 col-md-1">Tipo Doc.</label>
                <div class="col-lg-2 col-md-3">
                    <select  class="form-control input-md selectpicker" data-live-search="true" name="editarTipo" id="editarTipo" required>
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
                    <input type="text" style="text-transform:uppercase;" class="form-control input-sm" id="editarDocumentoG" name="editarDocumentoG">
                </div>

            </div>

            <div class="form-group" style="padding-top:25px">

                <label class="col-form-label col-lg-1 col-md-1">Cod. Caja</label>

                <div class="col-lg-8 col-md-3">
                    <select  class="form-control input-md selectpicker" data-live-search="true" name="editarCodCaja" id="editarCodCaja" required>
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
                    <input type="text" class="form-control input-sm money" id="editarTotal" name="editarTotal" required>
                    <input type="hidden" step="any" class="form-control input-sm" id="totalAntiguo" name="totalAntiguo" required>
                </div>                

            </div>  

            <div class="form-group" style="padding-top:25px">          
            
                <label class="col-form-label col-lg-1 col-md-1">Gasto</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control input-sm" id="editarGasto" name="editarGasto" readonly>
                </div> 

                <label class="col-form-label col-lg-1 col-md-1">Área</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control input-sm" id="editarArea" name="editarArea" readonly>
                </div> 

                <label class="col-form-label col-lg-1 col-md-1">Caja</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control input-sm" id="editarCaja" name="editarCaja" readonly>
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
          $editarGastosCaja -> ctrEditarGastosCaja();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL CERRAR MES
======================================-->

<div id="modalCerrarMes" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Cerrar Mes</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA PORCENTAJE -->

            <div class="form-group">
              
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user-o"></i></span>

                <input type="hidden" id="usuario" name="usuario" value = "<?php echo $_SESSION["id"]?>">

                  <select class="form-control input-sm selectpicker" id="mesCerrar" name="mesCerrar" data-live-search="true" required>

                    <option value="">Seleccionar Mes</option>

                    <?php

                    $mes = ControladorCentroCostos::ctrMostrarMeses();
                    var_dump("mes", $mes);

                    foreach ($mes as $key => $value) {

                      echo '<option value="'.$value["cod_mes"].'">'.$value["correlativo"].' - '.$value["nom_mes"].'</option>';
                    }

                    ?>

                  </select>

              </div>

            </div>       

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Cerrar Mes</button>

        </div>

      </form>

        <?php

          $cerrarMEs = new ControladorCentroCostos();
          $cerrarMEs -> ctrCerrarMesG();

        ?>  


    </div>

  </div>

</div>

<?php

  $anularGasto = new ControladorCentroCostos();
  $anularGasto -> ctrAnularGasto();

?>

<script>
    window.document.title = "Egresos (-)";

/*=============================================
CARGAR LA TABLA DINÁMICA DE GASTOS
=============================================*/
if (localStorage.getItem("mesG") != null) {
	cargarTablaGastosCaja(localStorage.getItem("mesG"));

	if(localStorage.getItem("mesG") == "1"){

		$(".btnEne").removeClass("btn-default");
		$(".btnEne").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesG", localStorage.getItem("mesG"));
  
			$.ajax({
	  
			  url:"ajax/tablamaestra.ajax.php",
			  method: "POST",
			  data: datos,
			  cache: false,
			  contentType: false,
			  processData: false,
			  dataType:"json",
			  success:function(respuesta){
				
				  //console.log(respuesta);
				  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
				  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
				  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
				  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];
  
			  }
		
		  })		

	}else if(localStorage.getItem("mesG") == "2"){

		$(".btnFeb").removeClass("btn-default");
		$(".btnFeb").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesG", localStorage.getItem("mesG"));
  
			$.ajax({
	  
			  url:"ajax/tablamaestra.ajax.php",
			  method: "POST",
			  data: datos,
			  cache: false,
			  contentType: false,
			  processData: false,
			  dataType:"json",
			  success:function(respuesta){
				
				  //console.log(respuesta);
				  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
				  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
				  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
				  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];
  
			  }
		
		  })	

	}else if(localStorage.getItem("mesG") == "3"){

		$(".btnMar").removeClass("btn-default");
		$(".btnMar").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesG", localStorage.getItem("mesG"));
  
			$.ajax({
	  
			  url:"ajax/tablamaestra.ajax.php",
			  method: "POST",
			  data: datos,
			  cache: false,
			  contentType: false,
			  processData: false,
			  dataType:"json",
			  success:function(respuesta){
				
				  //console.log(respuesta);
				  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
				  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
				  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
				  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];
  
			  }
		
		  })	

	}else if(localStorage.getItem("mesG") == "4"){

		$(".btnAbr").removeClass("btn-default");
		$(".btnAbr").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesG", localStorage.getItem("mesG"));
  
			$.ajax({
	  
			  url:"ajax/tablamaestra.ajax.php",
			  method: "POST",
			  data: datos,
			  cache: false,
			  contentType: false,
			  processData: false,
			  dataType:"json",
			  success:function(respuesta){
				
				  //console.log(respuesta);
				  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
				  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
				  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
				  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];
  
			  }
		
		  })		

	}else if(localStorage.getItem("mesG") == "5"){

		$(".btnMay").removeClass("btn-default");
		$(".btnMay").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesG", localStorage.getItem("mesG"));
  
			$.ajax({
	  
			  url:"ajax/tablamaestra.ajax.php",
			  method: "POST",
			  data: datos,
			  cache: false,
			  contentType: false,
			  processData: false,
			  dataType:"json",
			  success:function(respuesta){
				
				  //console.log(respuesta);
				  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
				  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
				  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
				  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];
  
			  }
		
		  })

	}else if(localStorage.getItem("mesG") == "6"){

		$(".btnJun").removeClass("btn-default");
		$(".btnJun").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesG", localStorage.getItem("mesG"));
  
			$.ajax({
	  
			  url:"ajax/tablamaestra.ajax.php",
			  method: "POST",
			  data: datos,
			  cache: false,
			  contentType: false,
			  processData: false,
			  dataType:"json",
			  success:function(respuesta){
				
				  //console.log(respuesta);
				  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
				  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
				  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
				  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];
  
			  }
		
		  })

	}else if(localStorage.getItem("mesG") == "7"){

		$(".btnJul").removeClass("btn-default");
		$(".btnJul").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesG", localStorage.getItem("mesG"));
  
			$.ajax({
	  
			  url:"ajax/tablamaestra.ajax.php",
			  method: "POST",
			  data: datos,
			  cache: false,
			  contentType: false,
			  processData: false,
			  dataType:"json",
			  success:function(respuesta){
				
				  //console.log(respuesta);
				  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
				  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
				  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
				  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];
  
			  }
		
		  })

	}else if(localStorage.getItem("mesG") == "8"){

		$(".btnAgo").removeClass("btn-default");
		$(".btnAgo").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesG", localStorage.getItem("mesG"));
  
			$.ajax({
	  
			  url:"ajax/tablamaestra.ajax.php",
			  method: "POST",
			  data: datos,
			  cache: false,
			  contentType: false,
			  processData: false,
			  dataType:"json",
			  success:function(respuesta){
				
				  //console.log(respuesta);
				  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
				  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
				  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
				  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];
  
			  }
		
		  })

	}else if(localStorage.getItem("mesG") == "9"){

		$(".btnSep").removeClass("btn-default");
		$(".btnSep").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesG", localStorage.getItem("mesG"));
  
			$.ajax({
	  
			  url:"ajax/tablamaestra.ajax.php",
			  method: "POST",
			  data: datos,
			  cache: false,
			  contentType: false,
			  processData: false,
			  dataType:"json",
			  success:function(respuesta){
				
				  //console.log(respuesta);
				  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
				  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
				  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
				  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];
  
			  }
		
		  })

	}else if(localStorage.getItem("mesG") == "10"){

		$(".btnOct").removeClass("btn-default");
		$(".btnOct").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesG", localStorage.getItem("mesG"));
  
			$.ajax({
	  
			  url:"ajax/tablamaestra.ajax.php",
			  method: "POST",
			  data: datos,
			  cache: false,
			  contentType: false,
			  processData: false,
			  dataType:"json",
			  success:function(respuesta){
				
				  //console.log(respuesta);
				  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
				  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
				  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
				  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];
  
			  }
		
		  })

	}else if(localStorage.getItem("mesG") == "11"){

		$(".btnNov").removeClass("btn-default");
		$(".btnNov").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesG", localStorage.getItem("mesG"));
  
			$.ajax({
	  
			  url:"ajax/tablamaestra.ajax.php",
			  method: "POST",
			  data: datos,
			  cache: false,
			  contentType: false,
			  processData: false,
			  dataType:"json",
			  success:function(respuesta){
				
				  //console.log(respuesta);
				  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
				  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
				  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
				  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];
  
			  }
		
		  })

	}else if(localStorage.getItem("mesG") == "12"){

		$(".btnDic").removeClass("btn-default");
		$(".btnDic").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesG", localStorage.getItem("mesG"));
  
			$.ajax({
	  
			  url:"ajax/tablamaestra.ajax.php",
			  method: "POST",
			  data: datos,
			  cache: false,
			  contentType: false,
			  processData: false,
			  dataType:"json",
			  success:function(respuesta){
				
				  //console.log(respuesta);
				  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
				  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
				  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
				  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];
  
			  }
		
		  })

	}

}else{
	const fecha = new Date();
	const mesG = fecha.getMonth() + 1; 

	if(mesG == "1"){

		$(".btnEne").removeClass("btn-default");
		$(".btnEne").addClass("btn-info");
	}else if(mesG == "2"){

		$(".btnFeb").removeClass("btn-default");
		$(".btnFeb").addClass("btn-info");
	}else if(mesG == "3"){

		$(".btnMar").removeClass("btn-default");
		$(".btnMar").addClass("btn-info");
	}else if(mesG == "4"){

		$(".btnAbr").removeClass("btn-default");
		$(".btnAbr").addClass("btn-info");
	}else if(mesG == "5"){

		$(".btnMay").removeClass("btn-default");
		$(".btnMay").addClass("btn-info");
	}else if(mesG == "6"){

		$(".btnJun").removeClass("btn-default");
		$(".btnJun").addClass("btn-info");
	}else if(mesG == "7"){

		$(".btnJul").removeClass("btn-default");
		$(".btnJul").addClass("btn-info");
	}else if(mesG == "8"){

		$(".btnAgo").removeClass("btn-default");
		$(".btnAgo").addClass("btn-info");
	}else if(mesG == "9"){

		$(".btnSep").removeClass("btn-default");
		$(".btnSep").addClass("btn-info");
	}else if(mesG == "10"){

		$(".btnOct").removeClass("btn-default");
		$(".btnOct").addClass("btn-info");
	}else if(mesG == "11"){

		$(".btnNov").removeClass("btn-default");
		$(".btnNov").addClass("btn-info");
	}else if(mesG == "12"){

		$(".btnDic").removeClass("btn-default");
		$(".btnDic").addClass("btn-info");
	}

	cargarTablaGastosCaja(mesG);
}    

function cargarTablaGastosCaja(mesG){

$(".TablaGastosCaja").DataTable({
    ajax: "ajax/centrocostos/tabla-gastos-caja.ajax.php?mesG="+ mesG,
    deferRender: true,
    retrieve: true,
    processing: true,
    order: [[0, "desc"]],
    "pageLength": 20,
    "lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
    language: {
      sProcessing: "Procesando...",
      sLengthMenu: "Mostrar _MENU_ registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior"
      },
      oAria: {
        sSortAscending: ": Activar para ordenar la columna de manera ascendente",
        sSortDescending: ": Activar para ordenar la columna de manera descendente"
      }
    },
    "createdRow":function(row,data,index){
        if(data[4] == "94"){
            $('td',row).eq(4).css({
                'background-color':'#52BE80',
                'color':'black'
            })
            $('td',row).eq(5).css({
                'background-color':'#52BE80',
                'color':'black'
            })
            $('td',row).eq(6).css({
                'background-color':'#52BE80',
                'color':'black'
            })
        }else if (data[4] == "95"){
            $('td',row).eq(4).css({
                'background-color':'#52BEB4',
                'color':'black'
            })
            $('td',row).eq(5).css({
                'background-color':'#52BEB4',
                'color':'black'
            })
            $('td',row).eq(6).css({
                'background-color':'#52BEB4',
                'color':'black'
            })
        }else if(data[4] == "92"){
            $('td',row).eq(4).css({
                'background-color':'#FF6868',
                'color':'black'
            })
            $('td',row).eq(5).css({
                'background-color':'#FF6868',
                'color':'black'
            })
            $('td',row).eq(6).css({
                'background-color':'#FF6868',
                'color':'black'
            })
        }else if(data[4] == "97"){
            $('td',row).eq(4).css({
                'background-color':'#7C9EFF',
                'color':'black'
            })
            $('td',row).eq(5).css({
                'background-color':'#7C9EFF',
                'color':'black'
            })
            $('td',row).eq(6).css({
                'background-color':'#7C9EFF',
                'color':'black'
            })
        }else if(data[4] == "60"){
            $('td',row).eq(4).css({
                'background-color':'#CCF459',
                'color':'black'
            })
            $('td',row).eq(5).css({
                'background-color':'#CCF459',
                'color':'black'
            })
            $('td',row).eq(6).css({
                'background-color':'#CCF459',
                'color':'black'
            })
        }else if(data[4] == "10"){
            $('td',row).eq(4).css({
                'background-color':'#AAE1FF',
                'color':'black'
            })
            $('td',row).eq(5).css({
                'background-color':'#AAE1FF',
                'color':'black'
            })
            $('td',row).eq(6).css({
                'background-color':'#AAE1FF',
                'color':'black'
            })
        }else if(data[4] == "11"){
            $('td',row).eq(4).css({
                'background-color':'#DDDAD6',
                'color':'black'
            })
            $('td',row).eq(5).css({
                'background-color':'#DDDAD6',
                'color':'black'
            })
            $('td',row).eq(6).css({
                'background-color':'#DDDAD6',
                'color':'black'
            })
        }else if(data[4] == "12"){
            $('td',row).eq(4).css({
                'background-color':'#FFCFE8',
                'color':'black'
            })
            $('td',row).eq(5).css({
                'background-color':'#FFCFE8',
                'color':'black'
            })
            $('td',row).eq(6).css({
                'background-color':'#FFCFE8',
                'color':'black'
            })
        }else if(data[4] == "13"){
            $('td',row).eq(4).css({
                'background-color':'#F5FAA5',
                'color':'black'
            })
            $('td',row).eq(5).css({
                'background-color':'#F5FAA5',
                'color':'black'
            })
            $('td',row).eq(6).css({
                'background-color':'#F5FAA5',
                'color':'black'
            })
        }else if(data[4] == "14"){
            $('td',row).eq(4).css({
                'background-color':'#DFB6F9',
                'color':'black'
            })
            $('td',row).eq(5).css({
                'background-color':'#DFB6F9',
                'color':'black'
            })
            $('td',row).eq(6).css({
                'background-color':'#DFB6F9',
                'color':'black'
            })
        }

        if(data[9] == "POR RENDIR"){
            $('td',row).eq(9).css({
              'background-color':'#F5F106',
              'color':'black'
            })
        }

        if(data[0].substr(-2,2) == "31"){
            $('td',row).eq(0).css({
              'background-color':'#C2E4FF',
              'color':'black'
            })
        }else if(data[0].substr(-2,2) == "30"){
            $('td',row).eq(0).css({
                'background-color':'#E8C2FF',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "29"){
            $('td',row).eq(0).css({
                'background-color':'#C2E4FF',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "28"){
            $('td',row).eq(0).css({
                'background-color':'#C2FFD2',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "27"){
            $('td',row).eq(0).css({
                'background-color':'#E8C2FF',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "26"){
            $('td',row).eq(0).css({
                'background-color':'#C2E4FF',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "25"){
            $('td',row).eq(0).css({
                'background-color':'#C2FFD2',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "26"){
            $('td',row).eq(0).css({
                'background-color':'#E8C2FF',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "25"){
            $('td',row).eq(0).css({
                'background-color':'#C2E4FF',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "24"){
            $('td',row).eq(0).css({
                'background-color':'#C2FFD2',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "23"){
            $('td',row).eq(0).css({
                'background-color':'#E8C2FF',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "22"){
            $('td',row).eq(0).css({
                'background-color':'#C2E4FF',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "21"){
            $('td',row).eq(0).css({
                'background-color':'#C2FFD2',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "20"){
            $('td',row).eq(0).css({
                'background-color':'#E8C2FF',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "19"){
            $('td',row).eq(0).css({
                'background-color':'#C2E4FF',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "18"){
            $('td',row).eq(0).css({
                'background-color':'#C2FFD2',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "17"){
            $('td',row).eq(0).css({
                'background-color':'#E8C2FF',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "16"){
            $('td',row).eq(0).css({
                'background-color':'#C2E4FF',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "15"){
            $('td',row).eq(0).css({
                'background-color':'#C2FFD2',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "14"){
            $('td',row).eq(0).css({
                'background-color':'#E8C2FF',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "13"){
            $('td',row).eq(0).css({
                'background-color':'#C2E4FF',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "12"){
            $('td',row).eq(0).css({
                'background-color':'#C2FFD2',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "11"){
            $('td',row).eq(0).css({
                'background-color':'#E8C2FF',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "10"){
            $('td',row).eq(0).css({
                'background-color':'#C2E4FF',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "09"){
            $('td',row).eq(0).css({
                'background-color':'#C2FFD2',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "08"){
            $('td',row).eq(0).css({
                'background-color':'#E8C2FF',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "07"){
            $('td',row).eq(0).css({
                'background-color':'#C2E4FF',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "06"){
            $('td',row).eq(0).css({
                'background-color':'#C2FFD2',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "05"){
            $('td',row).eq(0).css({
                'background-color':'#E8C2FF',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "04"){
            $('td',row).eq(0).css({
                'background-color':'#C2E4FF',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "03"){
            $('td',row).eq(0).css({
                'background-color':'#C2FFD2',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "02"){
            $('td',row).eq(0).css({
                'background-color':'#E8C2FF',
                'color':'black'
            })
        }else if(data[0].substr(-2,2) == "01"){
            $('td',row).eq(0).css({
                'background-color':'#C2E4FF',
                'color':'black'
            })
        }


      }

});

}

</script>