<?php


class ControladorOrdenCompra{
    /*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasOrdenCompra($fechaInicial, $fechaFinal){


		$respuesta = ModeloOrdenCompra::mdlRangoFechasOrdenCompra($fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

	/*=============================================
	REPORTE FECHAS ORDEN COMPRA POR ESTADO
	=============================================*/	

	static public function ctrReporteFechasOrdenCompra($fechaInicial, $fechaFinal , $estado , $estac){


		$respuesta = ModeloOrdenCompra::mdlReporteFechasOrdenCompra($fechaInicial, $fechaFinal,$estado,$estac);

		return $respuesta;
		
	}

	/*=============================================
	REPORTE FECHAS ORDEN COMPRA GENERAL
	=============================================*/	

	static public function ctrReporteFechasOrdenCompraGeneral($fechaInicial, $fechaFinal){


		$respuesta = ModeloOrdenCompra::mdlReporteFechasOrdenCompraGeneral($fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

	/*=============================================
	MOSTRAR ORDEN DE COMPRA
	=============================================*/	

	static public function ctrMostrarOrdenCompra($item,$valor){


		$respuesta = ModeloOrdenCompra::mdlMostrarOrdenCompra($item,$valor);

		return $respuesta;
		
	}

	/*=============================================
	MOSTRAR DETALLES ORDEN DE COMPRA
	=============================================*/	

	static public function ctrMostrarDetallesOrdenCompra($item,$valor){


		$respuesta = ModeloOrdenCompra::mdlMostrarDetallesOrdenCompra($item,$valor);

		return $respuesta;
		
	}


	/*=============================================
	MOSTRAR MATERIA PRIMA PARA ORDEN DE COMPRA
	=============================================*/	

	static public function ctrMostrarMateriasCompras($valor){


		$respuesta = ModeloOrdenCompra::mdlMostrarMateriasCompras($valor);

		return $respuesta;
		
	}


	/*=============================================
	CREAR  ORDEN DE COMPRA
	=============================================*/

	static public function ctrCrearOrdenCompra(){

		/* veriaficamos que venta traiga datos */

		if(isset($_POST["listarMateriaCompras"]) && isset($_POST["nuevoCodRuc"])){

			/* alerta  si la lista de productos viene vacia  */

			if($_POST["listarMateriaCompras"]==""){
				# Mostramos una alerta suave
				echo '<script>
						swal({
							type: "error",
							title: "Error",
							text: "¡No se seleccionó ninguna materia prima. Por favor, intenteló de nuevo!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then((result)=>{
							if(result.value){
								window.location="crear-orden-compra";}
						});
					</script>';
			}else{

				# Modificamos la información de los productos comprados en un array

				$listaMateriaCompras=json_decode($_POST["listarMateriaCompras"],true);
				
				//TRAEMOS LA FECHA Y LA PC QUE SE REGISTRO
				date_default_timezone_set('America/Lima');
				$fecha = new DateTime();
				$PcReg= gethostbyaddr($_SERVER['REMOTE_ADDR']);

				//TRAEMOS EL ULTIMO NRO DE LA NOTA DE SALIDA Y LO SUMAMOS Y CONCATENAMOS LOS 0'S

				$ultimoNro=ModeloOrdenCompra::mdlMostrarUltimoNro();
				

				$suma = $ultimoNro["Nro"]+1;
				$compraNro = str_pad($suma,strlen($ultimoNro["Nro"]),'0',STR_PAD_LEFT);


				
				/* ==============================================
				GUARDAMOS EL ORDEN DE COMPRA CABECERA
				============================================== */

				$datos=array("Tip"=>'OC',
							 "Ser"=>'001',
							 "Nro"=>$compraNro,
							 "Cod_Local"=>'01',
							 "Cod_Entidad"=>'01',
							 "CodRuc"=>$_POST["nuevoCodRuc"],
							 "FecEmi"=>$fecha->format("Y-m-d H:i:s"),
							 "tCambio"=>$_POST["nuevoTipoCambio"],
							 "Mo"=>$_POST["nuevaMoneda"],
							 "Obser"=>$_POST["nuevaObservacion"],
							 "pIgv"=>'18',
							 "SubTotal"=>$_POST["nuevoSubTotalCompra"],
							 "Igv"=>$_POST["nuevoImpuestoCompra"],
							 "Total"=>$_POST["nuevoTotalCompra"],
							 "mtopago"=>'0.000000',
							 "Centcosto"=>$_POST["nuevoCentroCosto"],
							 "Cantidad"=>'0.000000',
							 "NroProforma"=>$_POST["nuevoNroCotizacion"],
							 "FecLlegada"=>$_POST["nuevaFechaEntrega"],
							 "TipPago"=>$_POST["nuevaFormaPago"],
							 "Dia"=>$_POST["nuevoDia"],
							 "EstOco"=>'03',
							 "EstReg"=>'1',
							 "FecReg"=>$fecha->format("Y-m-d H:i:s"),
							 "PcReg"=>$PcReg,
							 "UsuReg"=>$_SESSION["nombre"],
							 "estac"=>'ABI');

							 

				$respuesta=ModeloOrdenCompra::mdlGuardarOrdenCompra($datos);
				// var_dump($respuesta);
				/* ==============================================
				GUARDAMOS EL ORDEN DE COMPRA DETALLE
				============================================== */

				if($respuesta=="ok"){

					

					foreach($listaMateriaCompras as $key=>$value){

						$datos2=array("Item"=>($key+1),
									 "Tip"=>'OC',
									 "Ser"=>'001',
									 "Nro"=>$compraNro,
									 "ColProv"=>$value["colorprov"],
									 "Cod_Local"=>'01',
									 "Cod_Entidad"=>'01',
									 "CodRuc"=>$_POST["nuevoCodRuc"],
									 "CodPro"=>$value["id"],
									 "CodFab"=>$value["codfab"],
									 "UndPro"=>$value["unidad"],
									 "CanPro"=>$value["cantidad"],
									 "CanPro_Ant"=>$value["cantidad"],
									 "PrePro"=>$value["precio"],
									 "PrePro_Ant"=>$value["precio"],
									 "DscPro"=>$value["descuento"],
									 "ImpPro"=>$value["total"],
									 "EstOco"=>'03',
									 "CantNI"=>$value["cantidad"],
									 "SalCan"=>'0.000000',
									 "FecEmi"=>$fecha->format("Y-m-d H:i:s"),
									 "estac"=>'ABI',
									 "FecReg"=>$fecha->format("Y-m-d H:i:s"),
									 "UsuReg"=>$_SESSION["nombre"],
									 "PcReg"=>$PcReg);

					$respuesta2 = ModeloOrdenCompra::mdlGuardarDetalleOrdenCompra($datos2);
					// var_dump($respuesta2);
					// var_dump($datos2);
					
					}

					# Mostramos una alerta suave
					echo '<script>
							swal({
								type: "success",
								title: "Felicitaciones",
								text: "¡La orden de compra fue registrada con éxito!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
							}).then((result)=>{
								if(result.value){
									window.location="orden-compra";}
							});
						</script>';
					}else{

					# Mostramos una alerta suave
					echo '<script>
							swal({
								type: "error",
								title: "Error",
								text: "¡La información presento problemas y no se registro adecuadamente. Por favor, intenteló de nuevo!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
							}).then((result)=>{
								if(result.value){
									window.location="crear-orden-compra";}
							});
						</script>';
					}				
			}			
		}

	}

	/*=============================================
	EDITAR ORDEN DE COMPRA
	=============================================*/

	public function ctrEditarOrdenCompra(){

		if(isset($_POST["editarOrdenCompra"]) && isset($_POST["listarMateriaCompras"])){

			$detaMateria = ControladorOrdenCompra::ctrMostrarDetallesOrdenCompra("Nro",$_POST["editarOrdenCompra"]);

			if($_POST["listarMateriaCompras"]==""){

				$listaMateriaCompras=$detaMateria;

			}else{

				$listaMateriaCompras=json_decode($_POST["listarMateriaCompras"],true);
			}
				//TRAEMOS LA FECHA Y LA PC QUE SE REGISTRO
				date_default_timezone_set('America/Lima');
				$fecha = new DateTime();
				$PcReg= gethostbyaddr($_SERVER['REMOTE_ADDR']);
				
				
					$datos=array("Nro"=>$_POST["editarOrdenCompra"],
								"CodRuc"=>$_POST["editarCodRuc"],
								"FecEmi"=>$fecha->format("Y-m-d H:i:s"),
								"Mo"=>$_POST["nuevaMoneda"],
								"Obser"=>$_POST["nuevaObservacion"],
								"SubTotal"=>$_POST["nuevoSubTotalCompra"],
								"Igv"=>$_POST["nuevoImpuestoCompra"],
								"Total"=>$_POST["nuevoTotalCompra"],
								"Centcosto"=>$_POST["nuevoCentroCosto"],
								"NroProforma"=>$_POST["nuevoNroCotizacion"],
								"FecLlegada"=>$_POST["nuevaFechaEntrega"],
								"TipPago"=>$_POST["nuevaFormaPago"],
								"Dia"=>$_POST["nuevoDia"],
								"FecMod"=>$fecha->format("Y-m-d H:i:s"),
								"PcMod"=>$PcReg,
								"UsuMod"=>$_SESSION["nombre"]);

								//  var_dump($datos);

					$respuesta=ModeloOrdenCompra::mdlEditarOrdenCompra($datos);


				if($respuesta=="ok"){

					# Eliminamos los detalles de la orden de compra
					$eliminarDeta=ModeloOrdenCompra::mdlEliminarDato("ocomdet","Nro",$_POST["editarOrdenCompra"]);

					if($eliminarDeta=="ok"){

						# Guardamos los nuevos detalles de la orden de compra
						foreach($listaMateriaCompras as $key=>$value){

							$datos2=array("Item"=>($key+1),
										"Tip"=>'OC',
										"Ser"=>'001',
										"Nro"=>$_POST["editarOrdenCompra"],
										"ColProv"=>$value["colorprov"],
										"Cod_Local"=>'01',
										"Cod_Entidad"=>'01',
										"CodRuc"=>$_POST["editarCodRuc"],
										"CodPro"=>$value["id"],
										"CodFab"=>$value["codfab"],
										"UndPro"=>$value["unidad"],
										"CanPro"=>$value["cantidad"],
										"CanPro_Ant"=>$value["cantidad"],
										"PrePro"=>$value["precio"],
										"PrePro_Ant"=>$value["precio"],
										"DscPro"=>$value["descuento"],
										"ImpPro"=>$value["total"],
										"EstOco"=>'03',
										"CantNI"=>$value["cantidad"],
										"SalCan"=>'0.000000',
										"FecEmi"=>$fecha->format("Y-m-d H:i:s"),
										"estac"=>'ABI',
										"FecMod"=>$fecha->format("Y-m-d H:i:s"),
										"UsuMod"=>$_SESSION["nombre"],
										"PcMod"=>$PcReg);

								// var_dump($datos2);

						$respuesta2 = ModeloOrdenCompra::mdlGuardarDetalleOrdenCompra2($datos2);
						
						
						}
						# Mostramos una alerta suave
						echo '<script>
								swal({
									type: "success",
									title: "Felicitaciones",
									text: "¡La orden de compra fue actualizada con éxito!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"
								}).then((result)=>{
									if(result.value){
										window.location="orden-compra";}
								});
							</script>';
					}else{
						# Mostramos una alerta suave
						echo '<script>
								swal({
									type: "error",
									title: "Error",
									text: "¡La información presento problemas al actualizar los detalles. Por favor, comunicarse con el departamento de sistemas",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"
								}).then((result)=>{
									if(result.value){
										window.location="orden-compra";}
								});
							</script>';
					}
						
				}else{
					# Mostramos una alerta suave
					echo '<script>
							swal({
								type: "error",
								title: "Error",
								text: "¡La información presento problemas y no se actualizó adecuadamente. Por favor, intenteló de nuevo!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
							}).then((result)=>{
								if(result.value){
									window.location="orden-compra";}
							});
						</script>';
					
				}			

			
		}		
	} 
	
	
	/*=============================================
	ANULAR ORDEN DE COMPRA
	=============================================*/

	static public function ctrAnularOrdenCompra(){

		if(isset($_GET["idOrdenCompra"])){

			$datos = $_GET["idOrdenCompra"];
			date_default_timezone_set('America/Lima');
			$fecha = new DateTime();
			$PcAnu= gethostbyaddr($_SERVER['REMOTE_ADDR']);
			$usuario= $_SESSION["nombre"];
			$descripcion   = 'El usuario '.$usuario.' anulo la orden de compra '.$datos;
			// var_dump($descripcion);
			if($_SESSION["datos"] == 1){
				$datos2= array( "usuario" => $usuario,
								"concepto" => $descripcion,
								"fecha" => $fecha->format("Y-m-d H:i:s"));
				$auditoria=ModeloUsuarios::mdlIngresarAuditoria("auditoriajf",$datos2);
			}

			$datosAnular = array("Nro"=>$datos,
								"EstOco"=>'01',
								"FecAnulacion"=>$fecha->format("Y-m-d H:i:s"),
								"FecAnu"=>$fecha->format("Y-m-d H:i:s"),
								"UsuAnu"=>$usuario,
								"PcAnu"=>$PcAnu);
			// var_dump($datosAnular);
			$respuesta = ModeloOrdenCompra::mdlAnularOrdenCompra("ocompra",$datosAnular);
			$respuesta2 = ModeloOrdenCompra::mdlAnularOrdenCompra("ocomdet",$datosAnular);
			if($respuesta == "ok" && $respuesta2 == "ok"){
				
				
				echo'<script>

				swal({
					  type: "success",
					  title: "La orden de compra ha sido anulada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "orden-compra";

								}
							})

				</script>';

			}		

		}

	}   


}