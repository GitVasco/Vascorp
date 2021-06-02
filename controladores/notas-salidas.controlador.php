<?php


class ControladorNotasSalidas{
    /*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasNotasSalidas($fechaInicial, $fechaFinal){


		$respuesta = ModeloNotasSalidas::mdlRangoFechasNotasSalidas($fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

	/*=============================================
	MOSTRAR CLIENTES PARA NOTA DE SALIDA
	=============================================*/	

	static public function ctrMostrarClientesNotas(){


		$respuesta = ModeloNotasSalidas::mdlMostrarClientesNotas();

		return $respuesta;
		
	}

	/*=============================================
	MOSTRAR TIPO DE ALMACEN PARA NOTA DE SALIDA
	=============================================*/	

	static public function ctrMostrarTipoAlmacen(){


		$respuesta = ModeloNotasSalidas::mdlMostrarTipoAlmacen();

		return $respuesta;
		
	}

	/*=============================================
	MOSTRAR TIPO DE MOTIVO PARA NOTA DE SALIDA
	=============================================*/	

	static public function ctrMostrarMotivoNota(){


		$respuesta = ModeloNotasSalidas::mdlMostrarMotivoNota();

		return $respuesta;
		
	}

	/*=============================================
	MOSTRAR DESTINO DE MATERIA PRIMA PARA NOTA DE SALIDA
	=============================================*/	

	static public function ctrMostrarDestinoNota(){


		$respuesta = ModeloNotasSalidas::mdlMostrarDestinoNota();

		return $respuesta;
		
	}

	/*=============================================
	MOSTRAR MATERIA PRIMA PARA NOTA DE SALIDA
	=============================================*/	

	static public function ctrMostrarMateriasNotas(){


		$respuesta = ModeloNotasSalidas::mdlMostrarMateriasNotas();

		return $respuesta;
		
	}

	/*=============================================
	MOSTRAR MATERIA PRIMA PARA NOTA DE SALIDA
	=============================================*/	

	static public function ctrMostrarNotaSalida($item,$valor){
		$tabla = "ventas_cab";

		$respuesta = ModeloNotasSalidas::mdlMostrarNotaSalida($tabla,$item,$valor);

		return $respuesta;
		
	}

	/*=============================================
	MOSTRAR MATERIA PRIMA PARA NOTA DE SALIDA
	=============================================*/	

	static public function ctrMostrarDetalleNotaSalida($item,$valor){

		$tabla = "venta_det";
		$respuesta = ModeloNotasSalidas::mdlMostrarDetalleNotaSalida($tabla,$item,$valor);

		return $respuesta;
		
	}
	/*=============================================
	CREAR VENTA
	=============================================*/

	static public function ctrCrearNotaSalida(){

		/* veriaficamos que venta traiga datos */

		if(isset($_POST["nuevoMotivoNota"]) && 
		   isset($_POST["nuevoClienteNota"]) && 
		   isset($_POST["listarMateriaNotas"])){

			/* alerta  si la lista de productos viene vacia  */

			if($_POST["listarMateriaNotas"]==""){
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
								window.location="crear-nota-salida";}
						});
					</script>';
			}else{

				# Modificamos la información de los productos comprados en un array

				$listaMateriaNotas=json_decode($_POST["listarMateriaNotas"],true);
				

				foreach($listaMateriaNotas as $key=>$value){

					# Actualizamos el stock en la tabla materia prima
					$tabla="producto";
					$valor=$value["id"];
					$item1="CodAlm01";
					$valor1=$value["stock"];
					ModeloNotasSalidas::mdlActualizarUnDatoMateria($tabla,$item1,$valor1,$valor);

				}
				//TRAEMOS LA FECHA Y LA PC QUE SE REGISTRO
				date_default_timezone_set('America/Lima');
				$fecha = new DateTime();
				$PcReg= gethostbyaddr($_SERVER['REMOTE_ADDR']);

				//TRAEMOS EL ULTIMO NRO DE LA NOTA DE SALIDA Y LO SUMAMOS Y CONCATENAMOS LOS 0'S

				$ultimoNro=ModeloNotasSalidas::mdlMostrarUltimoNro();

				$suma = $ultimoNro["Nro"]+1;
				$notaNro = str_pad($suma,strlen($ultimoNro["Nro"]),'0',STR_PAD_LEFT);


				
				/* ==============================================
				GUARDAMOS LA NOTA DE SALIDA CABECERA
				============================================== */

				$datos=array("Tip"=>'NS',
							 "Ser"=>'001',
							 "Nro"=>$notaNro,
							 "Cod_Local"=>'01',
							 "Cod_Entidad"=>'01',
							 "Ruc"=>$_POST["nuevoRuc"],
							 "FecEmi"=>$fecha->format("Y-m-d H:i:s"),
							 "FecVto"=>$fecha->format("Y-m-d H:i:s"),
							 "MdaVta"=>'1',
							 "ForVta"=>'11',
							 "TcVta"=>'0.000000',
							 "ImpVta"=>'0.000000',
							 "brutot"=>'',
							 "totdct"=>'0.00',
							 "SubVta"=>'',
							 "IgvVta"=>'0.00',
							 "TotVta"=>'',
							 "EstVta"=>'P',
							 "Abono"=>'0.000000',
							 "ValVta"=>'0',
							 "ObsGer"=>'',
							 "EstExp"=>'.',
							 "EstGuia"=>'P',
							 "CodAlm"=>$_POST["nuevoTipoAlmacen"],
							 "AlmDes"=>$_POST["nuevoTipoAlmacen"],
							 "CodCli"=>$_POST["nuevocodigoCli"],
							 "EstAte"=>'.',
							 "Dia"=>'0',
							 "ObsCre"=>'',
							 "EstPri"=>'.',
							 "DocSal"=>$_POST["nuevoMotivoNota"],
							 "DetDocSal"=>$_POST["nuevoDesMotivo"],
							 "FecReg"=>$fecha->format("Y-m-d H:i:s"),
							 "PcReg"=>$PcReg,
							 "UsuReg"=>$_SESSION["nombre"]);

				$respuesta=ModeloNotasSalidas::mdlGuardarNotaSalida("ventas_cab",$datos);

				/* ==============================================
				GUARDAMOS LA NOTA DE SALIDA DETALLE
				============================================== */

				if($respuesta=="ok"){

					

					foreach($listaMateriaNotas as $key=>$value){

						$datos2=array("Item"=>($key+1),
									 "CanVta"=>$value["cantidad"],
									 "PreVta"=>'0',
									 "FecEmi"=>$fecha->format("Y-m-d H:i:s"),
									 "DscVta"=>'0',
									 "Tip"=>'NS',
									 "Ser"=>'001',
									 "Nro"=>$notaNro,
									 "Cod_Local"=>'01',
									 "Cod_Entidad"=>'01',
									 "Ruc"=>$_POST["nuevoRuc"],
									 "CodPro"=>$value["id"],
									 "SugVta"=>'0',
									 "EstVta"=>'P',
									 "pcosto"=>$value["precio"],
									 "CenCosto"=>$value["destino"],
									 "FecReg"=>$fecha->format("Y-m-d H:i:s"),
									 "PcReg"=>$PcReg,
									 "UsuReg"=>$_SESSION["nombre"]);

					ModeloNotasSalidas::mdlGuardarDetalleNotaSalida("venta_det",$datos2);
					
					}

					# Mostramos una alerta suave
					echo '<script>
							swal({
								type: "success",
								title: "Felicitaciones",
								text: "¡La nota de salida fue registrada con éxito!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
							}).then((result)=>{
								if(result.value){
									window.location="notas-salidas";}
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
									window.location="crear-nota-salida";}
							});
						</script>';
					}				
			}			
		}

	}	


}