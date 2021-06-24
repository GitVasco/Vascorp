<?php


class ControladorOrdenServicio{
    /*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasOrdenServicio($fechaInicial, $fechaFinal){


		$respuesta = ModeloOrdenServicio::mdlRangoFechasOrdenServicio($fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

	/*=============================================
	MOSTRAR ORDEN DE SERVICIO
	=============================================*/	

	static public function ctrMostrarOrdenServicio($item,$valor){


		$respuesta = ModeloOrdenServicio::mdlMostrarOrdenServicio($item,$valor);

		return $respuesta;
		
	}

	/*=============================================
	MOSTRAR DETALLES ORDEN DE SERVICIO
	=============================================*/	

	static public function ctrMostrarDetallesOrdenServicio($item,$valor){


		$respuesta = ModeloOrdenServicio::mdlMostrarDetallesOrdenServicio($item,$valor);

		return $respuesta;
		
	}
	/*=============================================
	CREAR NOTA DE SALIDA
	=============================================*/

	static public function ctrCrearOrdenServicio(){

		/* veriaficamos que venta traiga datos */

		if(isset($_POST["nuevoProveedorServicio"]) && 
		   isset($_POST["listarMateriaServicios"])){

			/* alerta  si la lista de productos viene vacia  */

			if($_POST["listarMateriaServicios"]==""){
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
								window.location="crear-orden-servicio";}
						});
					</script>';
			}else{

				# Modificamos la información de los productos comprados en un array

				$listaMateriaServicios=json_decode($_POST["listarMateriaServicios"],true);
				

				foreach($listaMateriaServicios as $key=>$value){

					# Traemos las materia prima por CodPro en cada interacción
					
					$valor=$value["id"];

					$infoMateria=ModeloMateriaPrima::mdlMostrarMateriaPrima($valor);

					# Actualizamos el stock en la tabla materia prima
					$tabla="producto";
					$item1="CodAlm01";
					$valor1=$infoMateria["CodAlm01"]-$value["cantidad"];
					// var_dump($infoMateria);
					var_dump($valor1);
					// ModeloNotasSalidas::mdlActualizarUnDatoMateria($tabla,$item1,$valor1,$valor);

				}
				//TRAEMOS LA FECHA Y LA PC QUE SE REGISTRO
				date_default_timezone_set('America/Lima');
				$fecha = new DateTime();
				$PcReg= gethostbyaddr($_SERVER['REMOTE_ADDR']);

				//TRAEMOS EL ULTIMO NRO DE LA NOTA DE SALIDA Y LO SUMAMOS Y CONCATENAMOS LOS 0'S

				$ultimoNro=ModeloOrdenServicio::mdlMostrarUltimoNro();

				$suma = $ultimoNro["Nro"]+1;
				$notaNro = str_pad($suma,strlen($ultimoNro["Nro"]),'0',STR_PAD_LEFT);


				
				/* ==============================================
				GUARDAMOS LA NOTA DE SALIDA CABECERA
				============================================== */

				$datos=array("Cod_Local"=>'01',
							 "Cod_Entidad"=>'01',
							 "Tip"=>'OS',
							 "Ser"=>'001',
							 "Nro"=>$notaNro,
							 "FecEmi"=>$fecha->format("Y-m-d H:i:s"),
							 "CodRuc"=>$_POST["nuevoProveedorServicio"],
							 "FecEnt"=>$_POST["nuevaFechaEntrega"],
							 "EstOS"=>'ABI',
							 "DesStk"=>$_POST["nuevoDsctoStock"],
							 "ObsOs"=>$_POST["nuevaObservacion"],
							 "EstReg"=>'1',
							 "FecReg"=>$fecha->format("Y-m-d H:i:s"),
							 "PcReg"=>$PcReg,
							 "UsuReg"=>$_SESSION["nombre"]);

				// $respuesta=ModeloOrdenServicio::mdlGuardarOrdenServicio($datos);

				/* ==============================================
				GUARDAMOS LA ORDEN DE SERVICIO DETALLE
				============================================== */

				// if($respuesta=="ok"){

					

					foreach($listaMateriaServicios as $key=>$value){

						$datos2=array("Cod_Local"=>'01',
									 "Cod_Entidad"=>'01',
									 "Item"=>($key+1),
									 "Tip"=>'OS',
									 "Ser"=>'001',
									 "Nro"=>$notaNro,
									 "FecEmi"=>$fecha->format("Y-m-d H:i:s"),
									 "CodRuc"=>$_POST["nuevoProveedorServicio"],
									 "CodProOrigen"=>$value["id"],
									 "CantidadIni"=>$value["cantidad"],
									 "CodProDestino"=>$value["id_des"],
									 "Saldo"=>$value["cantidad"],
									 "Despacho"=>'0',
									 "EstOS"=>'ABI',
									 "DesStk"=>$_POST["nuevoDsctoStock"],
									 "EstReg"=>'1',
									 "FecReg"=>$fecha->format("Y-m-d H:i:s"),
									 "PcReg"=>$PcReg,
									 "UsuReg"=>$_SESSION["nombre"]);

					// ModeloOrdenServicio::mdlGuardarDetalleOrdenServicio($datos2);
					
					}

					# Mostramos una alerta suave
					// echo '<script>
					// 		swal({
					// 			type: "success",
					// 			title: "Felicitaciones",
					// 			text: "¡El orden de servicio fue registrado con éxito!",
					// 			showConfirmButton: true,
					// 			confirmButtonText: "Cerrar"
					// 		}).then((result)=>{
					// 			if(result.value){
					// 				window.location="orden-servicio";}
					// 		});
					// 	</script>';
					// }else{

					// # Mostramos una alerta suave
					// echo '<script>
					// 		swal({
					// 			type: "error",
					// 			title: "Error",
					// 			text: "¡La información presento problemas y no se registro adecuadamente. Por favor, intenteló de nuevo!",
					// 			showConfirmButton: true,
					// 			confirmButtonText: "Cerrar"
					// 		}).then((result)=>{
					// 			if(result.value){
					// 				window.location="crear-orden-servicio";}
					// 		});
					// 	</script>';
					// }				
			}			
		}

	}	
}