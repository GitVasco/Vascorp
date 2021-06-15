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
				GUARDAMOS LA NOTA DE SALIDA CABECERA
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
				var_dump($respuesta);
				/* ==============================================
				GUARDAMOS LA NOTA DE SALIDA DETALLE
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
									 "PcReg"=>$PcReg,
									 "UsuReg"=>$_SESSION["nombre"]);

					$respuesta2 = ModeloOrdenCompra::mdlGuardarDetalleOrdenCompra($datos2);
					var_dump($respuesta2);
					
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


}