<?php

class ControladorCuentas{

	/*=============================================
	CREAR TIPO DE PAGO
	=============================================*/

	static public function ctrCrearCuenta(){

		if(isset($_POST["nuevoCodigo"])){

				$tabla="cuenta_ctejf";
				if(empty($_POST["renovacion"])){
					$renovacion=0;
				}else{
					$renovacion=$_POST["renovacion"];
				}
				if(empty($_POST["protestado"])){
					$protestado=0;
				}else{
					$protestado=$_POST["protestado"];
				}
			   	$datos = array("tipo_doc"=>$_POST["nuevoCodigo"],
							   "num_cta"=>$_POST["nuevoDocumento"],
							   "cliente"=>$_POST["nuevoCliente"],
							   "vendedor"=>$_POST["nuevoVendedor"],
							   "fecha"=>$_POST["nuevaFecha"],
							   "fecha_ven"=>$_POST["nuevaFechaVenc"],
							   "fecha_cep"=>$_POST["nuevaFechaAcep"],
							   "tip_mon"=>$_POST["nuevaMoneda"],
							   "monto"=>$_POST["nuevoMonto"],
							   "tip_cambio"=>$_POST["nuevoTipoCambio"],
							   "estado"=>$_POST["nuevoEstado1"],
							   "notas"=>$_POST["nuevaNota"],
							   "cod_pago"=>$_POST["nuevoTipoDocumento"],
							   "doc_origen"=>$_POST["nuevoOrigen"],
							   "renovacion"=>$renovacion,
							   "protesta"=>$protestado,
							   "usuario"=>$_POST["nuevoUsuario"],
							   "saldo"=>$_POST["nuevoSaldo"],
							   "ult_pago"=>$_POST["nuevaFechaUltima"],
							   "estado_doc"=>$_POST["nuevoEstado"],
							   "banco"=>$_POST["nuevoBanco"],
							   "num_unico"=>$_POST["nuevoUnico"],
							   "fecha_envio"=>$_POST["nuevaFechaEnvio"],
							   "fecha_abono"=>$_POST["nuevaFechaAbono"]);
							   


			   	$respuesta = ModeloCuentas::mdlIngresarCuenta($tabla,$datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La cuenta ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "cuentas";

									}
								})

					</script>';

				}

			

		}

    }
    

	/*=============================================
	MOSTRAR CUENTAS
	=============================================*/

	static public function ctrMostrarCuentas($item,$valor){
		$tabla="cuenta_ctejf";
		$respuesta = ModeloCuentas::mdlMostrarCuentas($tabla,$item,$valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR CUENTAS
	=============================================*/

	static public function ctrMostrarTipoCuentas($item,$valor){
		$tabla="cuenta_ctejf";
		$respuesta = ModeloCuentas::mdlMostrarTipoCuentas($tabla,$item,$valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR CUENTAS PENDIENTES
	=============================================*/

	static public function ctrMostrarCuentasPendientes($saldo){
		$tabla="cuenta_ctejf";
		$respuesta = ModeloCuentas::mdlMostrarCuentasPendientes($tabla,$saldo);

		return $respuesta;

	}
	
	
    /*=============================================
	MOSTRAR  DOCUMENTOS DE PAGOS
	=============================================*/

	static public function ctrMostrarPagos($item,$valor){
		$tabla="maestrajf";
		$respuesta = ModeloCuentas::mdlMostrarPagos($tabla,$item,$valor);

		return $respuesta;

	}
	
	/*=============================================
	MOSTRAR CANCELACIONES
	=============================================*/

	static public function ctrMostrarCancelaciones($item,$valor){
		$tabla="cuenta_ctejf";
		$respuesta = ModeloCuentas::mdlMostrarCancelaciones($tabla,$item,$valor);

		return $respuesta;

    }
	/*=============================================
	EDITAR CUENTAS
	=============================================*/

	static public function ctrEditarCuenta(){

		if(isset($_POST["editarCodigo"])){

			$tabla="cuenta_ctejf";
			if(empty($_POST["editarRenovacion"])){
				$renovacion=0;
			}else{
				$renovacion=$_POST["editarRenovacion"];
			}
			if(empty($_POST["editarProtestado"])){
				$protestado=0;
			}else{
				$protestado=$_POST["editarProtestado"];
			}
			   $datos = array("id" => $_POST["idCuenta"],
				   		   "tipo_doc"=>$_POST["editarCodigo"],
						   "num_cta"=>$_POST["editarDocumento"],
						   "cliente"=>$_POST["editarCliente"],
						   "vendedor"=>$_POST["editarVendedor"],
						   "fecha"=>$_POST["editarFecha"],
						   "fecha_ven"=>$_POST["editarFechaVenc"],
						   "fecha_cep"=>$_POST["editarFechaAcep"],
						   "tip_mon"=>$_POST["editarMoneda"],
						   "monto"=>$_POST["editarMonto"],
						   "tip_cambio"=>$_POST["editarTipoCambio"],
						   "estado"=>$_POST["editarEstado1"],
						   "notas"=>$_POST["editarNota"],
						   "cod_pago"=>$_POST["editarTipoDocumento"],
						   "doc_origen"=>$_POST["editarOrigen"],
						   "renovacion"=>$renovacion,
						   "protesta"=>$protestado,
						   "usuario"=>$_POST["editarUsuario"],
						   "saldo"=>$_POST["editarSaldo"],
						   "ult_pago"=>$_POST["editarFechaUltima"],
						   "estado_doc"=>$_POST["editarEstado"],
						   "banco"=>$_POST["editarBanco"],
						   "num_unico"=>$_POST["editarUnico"],
						   "fecha_envio"=>$_POST["editarFechaEnvio"],
						   "fecha_abono"=>$_POST["editarFechaAbono"]);
						   

			   	$respuesta = ModeloCuentas::mdlEditarCuenta($tabla,$datos);
			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La cuenta ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "cuentas";

									}
								})

					</script>';


			}
		}

    }
	
	/*=============================================
	CANCELAR CUENTAS
	=============================================*/

	static public function ctrCancelarCuenta(){

		if(isset($_POST["cancelarDocumento"])){

			$tabla="cuenta_ctejf";
			   $datos = array("id" => $_POST["idCuenta2"],
			   			   "tipo_doc"=>$_POST["cancelarCodigo"],
						   "num_cta"=>$_POST["cancelarDocumento"],
						   "cliente"=>$_POST["cancelarCliente"],
						   "vendedor"=>$_POST["cancelarVendedor"],
						   "monto"=>$_POST["cancelarMonto"],
						   "notas"=>$_POST["cancelarNota"],
						   "usuario"=>$_POST["cancelarUsuario"],
						   "fecha"=>$_POST["cancelarFechaUltima"]);

				$cuenta=ControladorCuentas::ctrMostrarCuentas("id",$_POST["idCuenta2"]);
				$saldoNuevo=$cuenta["saldo"]-$_POST["cancelarMonto"];
				if($saldoNuevo >= -0.5 && $saldoNuevo<= 0.5){
					$estado=ModeloCuentas::mdlActualizarUnDato($tabla,"estado","CANCELADO",$_POST["idCuenta2"]);
				}
				$ultimo_pago=ModeloCuentas::mdlActualizarUnDato($tabla,"ult_pago",$_POST["cancelarFechaUltima"],$_POST["idCuenta2"]);
				$actualizado=ModeloCuentas::mdlActualizarUnDato($tabla,"saldo",$saldoNuevo,$_POST["idCuenta2"]);
			   	$respuesta = ModeloCuentas::mdlIngresarCuenta($tabla,$datos);
			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La cuenta ha sido cancelada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "cuentas";

									}
								})

					</script>';


			}
		}

	}
	
	/*=============================================
	ELIMINAR CUENTAS
	=============================================*/

	static public function ctrEliminarCuenta(){

		if(isset($_GET["idCuenta"])){

			$datos = $_GET["idCuenta"];
			$tabla="cuenta_ctejf";
			date_default_timezone_set('America/Lima');
			$fecha = new DateTime();
			$cuentas=ControladorCuentas::ctrMostrarCuentas("id",$datos);
			$usuario= $_SESSION["nombre"];
			$para      = 'notificacionesvascorp@gmail.com';
			$asunto    = 'Se elimino una cuenta';
			$descripcion   = 'El usuario '.$usuario.' elimino la cuenta '.$cuentas["codigo"].' - '.$cuentas["num_cta"];
			$de = 'From: notificacionesvascorp@gmail.com';
			if($_SESSION["correo"] == 1){
				mail($para, $asunto, $descripcion, $de);
			}
			if($_SESSION["datos"] == 1){
				$datos2= array( "usuario" => $usuario,
								"concepto" => $descripcion,
								"fecha" => $fecha->format("Y-m-d H:i:s"));
				$auditoria=ModeloUsuarios::mdlIngresarAuditoria("auditoriajf",$datos2);
			}
			
			$respuesta = ModeloCuentas::mdlEliminarCuenta($tabla,$datos);
			if($respuesta == "ok"){
				
				
				echo'<script>

				swal({
					  type: "success",
					  title: "La cuenta ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "cuentas";

								}
							})

				</script>';

			}		

		}

	}    

	/*=============================================
	EDITAR CANCELACION
	=============================================*/

	static public function ctrEditarCancelacion(){

		if(isset($_POST["cancelarDocumento"])){

			$tabla="cuenta_ctejf";
			
			$datos = array("id" => $_POST["idCuenta2"],
							"tipo_doc"=>$_POST["cancelarCodigo"],
						   "num_cta"=>$_POST["cancelarDocumento"],
						   "vendedor"=>$_POST["cancelarVendedor"],
						   "fecha"=>$_POST["cancelarCliente"],
						   "monto"=>$_POST["cancelarMonto2"],
						   "notas"=>$_POST["cancelarNota"],
						   "usuario"=>$_POST["cancelarUsuario"],
						   "fecha"=>$_POST["cancelarFechaUltima"]);
						   
				$origen=ControladorCuentas::ctrMostrarCuentas("num_cta",$_POST["cancelarDocumento"]);
				$idOrigen=$origen["id"];
				$saldoNuevo=$_POST["cancelarMontoAntiguo"]-$_POST["cancelarMonto2"];
				if($saldoNuevo>0){
					$estado=ModeloCuentas::mdlActualizarUnDato($tabla,"estado","PENDIENTE",$idOrigen);
				}
				$actualizacion=ModeloCuentas::mdlActualizarUnDato($tabla,"saldo",$saldoNuevo,$idOrigen);
			   	$respuesta = ModeloCuentas::mdlEditarCuenta($tabla,$datos);
			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La cancelación ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "index.php?ruta=ver-cuentas&numCta='.$_POST["cancelarDocumento"].'";

									}
								})

					</script>';


			}
		}

	}
	
	/*=============================================
	ELIMINAR CANCELACION
	=============================================*/

	static public function ctrEliminarCancelacion(){

		if(isset($_GET["idCancelacion"])){

			$datos = $_GET["idCancelacion"];
			$tabla="cuenta_ctejf";
			date_default_timezone_set('America/Lima');
			$fecha = new DateTime();
			$cancelacion=ModeloCuentas::mdlMostrarCancelacion($tabla,"id",$datos);
			$usuario= $_SESSION["nombre"];
			$para      = 'notificacionesvascorp@gmail.com';
			$asunto    = 'Se elimino una cuenta';
			$descripcion   = 'El usuario '.$usuario.' elimino una cancelacion de la cuenta de '.$cuentas["codigo"].' - '.$cuentas["num_cta"];
			$de = 'From: notificacionesvascorp@gmail.com';
			if($_SESSION["correo"] == 1){
				mail($para, $asunto, $descripcion, $de);
			}
			if($_SESSION["datos"] == 1){
				$datos2= array( "usuario" => $usuario,
								"concepto" => $descripcion,
								"fecha" => $fecha->format("Y-m-d H:i:s"));
				$auditoria=ModeloUsuarios::mdlIngresarAuditoria("auditoriajf",$datos2);
			}
			$origen=ControladorCuentas::ctrMostrarCuentas("num_cta",$cancelacion["num_cta"]);
			$idOrigen=$origen["id"];
			$saldoNuevo=$cancelacion["monto"]+$origen["saldo"];
			if($saldoNuevo>0){
				$estado=ModeloCuentas::mdlActualizarUnDato($tabla,"estado","PENDIENTE",$idOrigen);
			}
			$actualizacion=ModeloCuentas::mdlActualizarUnDato($tabla,"saldo",$saldoNuevo,$idOrigen);
			$respuesta = ModeloCuentas::mdlEliminarCuenta($tabla,$datos);
			if($respuesta == "ok"){
				
				
				echo'<script>

				swal({
					  type: "success",
					  title: "La cancelación ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "index.php?ruta=ver-cuentas&numCta='.$origen["num_cta"].'";

								}
							})

				</script>';

			}		

		}

	}    

	/*=============================================
	CANCELAR CUENTAS
	=============================================*/

	static public function ctrAgregarLetra(){

		if(isset($_POST["letraDocumento"])){

			$tabla="cuenta_ctejf";
			$fechasInput=$_POST["fechaVenc"];
			$doc1=substr($_POST["letraDocumento"],0,4);
			$doc2=substr($_POST["letraDocumento"],-5);
			$documento=$doc1.$doc2."-";
            for ($i=0; $i <count($fechasInput) ; $i++) { 

				$datos = array("tipo_doc"=>$_POST["letraCodigo"],
							"num_cta"=>$documento.($i+1),
							"cliente"=>$_POST["letraCli"],
							"vendedor"=>$_POST["letraVendedor"],	
							"tip_mon"=>$_POST["letraMoneda"],
							"monto"=>$_POST["monto".$i],
							"notas"=>$_POST["obs".$i],
							"usuario"=>$_POST["letraUsuario"],
							"fecha"=>$_POST["letraFecha"],
							"fecha_ven"=>$fechasInput[$i],
							"cod_pago"=>$_POST["letraCodigo"],
							"doc_origen"=>$documento.($i+1));

					
					$respuesta = ModeloCuentas::mdlIngresarCuenta($tabla,$datos);
				}
				$eliminado = ModeloCuentas::mdlEliminarCuenta($tabla,$_POST["idCuenta3"]);
			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La cuenta ha sido cancelada a letras correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "cuentas";

									}
								})

					</script>';


			}
		}

	}

	static public function ctrImportarCuenta(){

        if(isset($_POST["importBanco"])){
				
				include "/../vistas/reportes_excel/Excel/reader.php";
				$directorio="vistas/cuentas/".$_FILES["nuevaImportacion"]["name"];
				$archivo=move_uploaded_file($_FILES["nuevaImportacion"]['tmp_name'], $directorio);
				$data = new Spreadsheet_Excel_Reader();
				$data->setOutputEncoding('CP1251');
				$data->read("vistas/cuentas/".$_FILES["nuevaImportacion"]["name"]);
				$con=ControladorUsuarios::ctrMostrarConexiones("id",1);
				$conexion = mysql_connect($con["ip"], $con["user"], $con["pwd"]) or die("No se pudo conectar: " . mysql_error());
				mysql_select_db($con["db"], $conexion);
				for ($i = 6; $i <= $data->sheets[0]['numRows']; $i++) {
					for ($j = 1; $j <= 1; $j++) {
						$tipo="00";
						$documento=$data->sheets[0]['cells'][$i][1];
						$unico=$data->sheets[0]['cells'][$i][2];
						$fecha_ven=$data->sheets[0]['cells'][$i][5];
						$monto=$data->sheets[0]['cells'][$i][6];
						$montoConv=str_replace(",","",$monto);
						$estado=$data->sheets[0]['cells'][$i][8];
						$fecha=$data->sheets[0]['cells'][$i][9];
						$fecha_cep=$data->sheets[0]['cells'][$i][10];
						$tipo_mon="Soles";
						$usuario=$_SESSION["id"];
						$saldo=0;
						$existe=ControladorCuentas::ctrMostrarCuentas("num_unico",$unico);
						$sqlInsertar = mysql_query("INSERT INTO cuenta_ctejf (tipo_doc,num_cta,cliente,vendedor,fecha,fecha_ven,tip_mon,monto,estado,cod_pago,doc_origen,usuario,saldo,num_unico,fecha_abono)  values('".$tipo."','".$documento."','".$existe["cliente"]."','".$existe["vendedor"]."','".substr($fecha,6,4)."-".substr($fecha,3,2)."-".substr($fecha,0,2)."','".substr($fecha_ven,6,4)."-".substr($fecha_ven,3,2)."-".substr($fecha_ven,0,2)."','".$tipo_mon."',".$montoConv.",'".$estado."','".$tipo."','".$documento."','".$usuario."',".$saldo.",'".$unico."','".substr($fecha_cep,6,4)."-".substr($fecha_cep,3,2)."-".substr($fecha_cep,0,2)."')");
						
						
						if($existe){
							$saldoImportar=$existe["saldo"]-$montoConv;
							ModeloCuentas::mdlActualizarUnDato("cuenta_ctejf","saldo",$saldoImportar,$existe["id"]);
						}
					}
				}
				echo'<script>

				swal({
					type: "success",
					title: "Las cuentas han sido canceladas correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result){
								if (result.value) {

								window.location = "cuentas";

								}
							})

				</script>';
				
		}
	}

	static public function ctrImportarLetra(){

        if(isset($_POST["importLetra"])){
				
				include "/../vistas/reportes_excel/Excel/reader.php";
				$directorio="vistas/cuentas/".$_FILES["nuevaUnico"]["name"];
				$archivo=move_uploaded_file($_FILES["nuevaUnico"]['tmp_name'], $directorio);
				$data = new Spreadsheet_Excel_Reader();
				$data->setOutputEncoding('CP1251');
				$data->read("vistas/cuentas/".$_FILES["nuevaUnico"]["name"]);
				$con=ControladorUsuarios::ctrMostrarConexiones("id",1);
				$conexion = mysql_connect($con["ip"], $con["user"], $con["pwd"]) or die("No se pudo conectar: " . mysql_error());
				mysql_select_db($con["db"], $conexion);
				for ($i = 6; $i <= $data->sheets[0]['numRows']; $i++) {
					for ($j = 1; $j <= 1; $j++) {
						$documento=$data->sheets[0]['cells'][$i][1];
						$unico=$data->sheets[0]['cells'][$i][2];
						$existe=ControladorCuentas::ctrMostrarCuentas("num_cta",$documento);
						
						if($existe){
							$sqlInsertar = mysql_query("UPDATE cuenta_ctejf SET num_unico = '".$unico."' WHERE num_cta = '".$documento."'") or die(mysql_error());
							
						}
					}
				}
				echo'<script>

				swal({
					type: "success",
					title: "Las cuentas han sido canceladas correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result){
								if (result.value) {

								window.location = "cuentas";

								}
							})

				</script>';
				
		}
	}

	/*=============================================
	RANGO FECHAS CUENTAS
	=============================================*/	

	static public function ctrRangoFechasCuentas($fechaInicial, $fechaFinal){

		$tabla = "cuenta_ctejf";

		$respuesta = ModeloCuentas::mdlRangoFechasCuentas($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}
	
	/*=============================================
	RANGO FECHAS CUENTAS
	=============================================*/	

	static public function ctrRangoFechasCuentasPendientes($fechaInicial, $fechaFinal){

		$tabla = "cuenta_ctejf";

		$respuesta = ModeloCuentas::mdlRangoFechasCuentasPendientes($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}
	
	/*=============================================
	RANGO FECHAS CUENTAS
	=============================================*/	

	static public function ctrRangoFechasCuentasAprobadas($fechaInicial, $fechaFinal){

		$tabla = "cuenta_ctejf";

		$respuesta = ModeloCuentas::mdlRangoFechasCuentasAprobadas($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}
	
	/*=============================================
	CANCELAR CUENTAS
	=============================================*/

	static public function ctrCancelarCuenta2(){

		if(isset($_POST["cancelarDocumento2"])){

			$tabla="cuenta_ctejf";
			   $datos = array("id" => $_POST["idCuenta3"],
			   			   "tipo_doc"=>$_POST["cancelarCodigo2"],
						   "num_cta"=>$_POST["cancelarDocumento2"],
						   "cliente"=>$_POST["cancelarCliente2"],
						   "vendedor"=>$_POST["cancelarVendedor2"],
						   "monto"=>$_POST["cancelarMonto3"],
						   "notas"=>$_POST["cancelarNota2"],
						   "usuario"=>$_POST["cancelarUsuario2"],
						   "fecha"=>$_POST["cancelarFechaUltima2"]);

				$cuenta=ControladorCuentas::ctrMostrarCuentas("id",$_POST["idCuenta3"]);
				$saldoNuevo=$cuenta["saldo"]-$_POST["cancelarMonto3"];
				if($saldoNuevo >= -0.5 && $saldoNuevo<= 0.5){
					$estado=ModeloCuentas::mdlActualizarUnDato($tabla,"estado","CANCELADO",$_POST["idCuenta3"]);
				}
				$ultimo_pago=ModeloCuentas::mdlActualizarUnDato($tabla,"ult_pago",$_POST["cancelarFechaUltima2"],$_POST["idCuenta3"]);
				$actualizado=ModeloCuentas::mdlActualizarUnDato($tabla,"saldo",$saldoNuevo,$_POST["idCuenta3"]);
			   	$respuesta = ModeloCuentas::mdlIngresarCuenta($tabla,$datos);
			   	if($respuesta == "ok"){

					echo'<script>	

					swal({
						  type: "success",
						  title: "La cuenta ha sido cancelada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "index.php?ruta=ver-cuentas&numCta='.$cuenta["num_cta"].'";

									}
								})

					</script>';


			}
		}

	}
   
}
