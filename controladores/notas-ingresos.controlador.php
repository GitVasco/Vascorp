<?php


class ControladorNotasIngresos{

    /*=============================================
	MOSTRAR NOTAS DE INGRESO
	=============================================*/	

	static public function ctrRangoFechasNotasIngresos($fechaInicial, $fechaFinal){

		$respuesta = ModeloNotasIngresos::mdlRangoFechasNotasIngresos($fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

	/* 
	*MOSTRAR MP PARA NOTA DE INGRESO CON O SIN OC
	*/
	static public function ctrMostrarMPOC($empresa, $oc){

		$respuesta = ModeloNotasIngresos::mdlMostrarMPOC($empresa, $oc);

		return $respuesta;
		
	}

	/* 
	* TIPOS DE DOC PARA NI
	*/
	static public function ctrDocNI(){

		$respuesta = ModeloNotasIngresos::mdlDocNI();

		return $respuesta;
		
	}	

	/* 
	* OC por Proveedor
	*/
	static public function ctrOCProv($empresa){

		$respuesta = ModeloNotasIngresos::mdlOCProv($empresa);

		return $respuesta;
		
	}
	

	/* 
	* MP EN OC O SUELTA
	*/
	static public function ctrTraerMpOC($codpro, $orden, $codruc){

		$respuesta = ModeloNotasIngresos::mdlTraerMpOC($codpro, $orden, $codruc);

		return $respuesta;
		
	}
	
	static public function ctrCrearNotaIngreso(){

		/* 
		* revisamos que vengan datos
		*/
		if(	isset($_POST["nuevoProveedor"]) && 
			isset($_POST["listaNI"])){
		//var_dump($_POST["nuevoProveedor"], $_POST["listaNI"]);
				
			/* 
			*alerta si la lista de mp viene vacia
			*/	
			if($_POST["listaNI"] == ""){
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
								window.location="crear-nota-ingreso";}
						});
					</script>';

			}else{

				# Modificamos la lista en un array
				$listaNotaIngreso = json_decode($_POST["listaNI"],true);
				#var_dump($listaNotaIngreso);
				# traemos la fecha y la pc
				date_default_timezone_set('America/Lima');
				$fecha = new DateTime();
				$PcReg= gethostbyaddr($_SERVER['REMOTE_ADDR']);

				#1. Creamos la cabecera

				$ultimoNro = ModeloNotasIngresos::mdlMostrarCorrelativoNotaIngreso();
				//var_dump($ultimoNro);

				$datosCab = array(	"cod_local" 	=> '01',
									"cod_entidad" 	=> '01',
									"codruc" 		=> $_POST["nuevoProveedor"],
									"tnea" 			=> 'NE',
									"snea" 			=> '001',
									"nnea"			=> $ultimoNro["correlativo"],
									"trguia"		=> $_POST["tipDocS"],
									"serguia"		=> $_POST["nuevaSerieS"],
									"nroguia"		=> $_POST["nuevoNroS"],
									"fecemi" 		=> $_POST["fecS"],
									"mo"			=> $_POST["nuevaMoneda"],
									"obser"			=> $_POST["nuevaObservacion"],
									"pigv"			=> '18',
									"subtotal"		=> $_POST["subTotalNi"],
									"igv"			=> $_POST["impuestoNi"],
									"total"			=> $_POST["totalNi"],
									"trdcto"		=> $_POST["tipDocP"],
									"srdcto"		=> $_POST["nuevaSerieP"],
									"nrdcto"		=> $_POST["nuevoNroP"],
									"fecven" 		=> $_POST["fecP"],
									"tipoc"			=> 'OC',
									"seroc"			=> '001',
									"nrooc"			=> $_POST["nuevaOc"],
									"codalm"		=> '01',
									"estreg"		=> 'P',
									"fecreg"		=> $fecha->format("Y-m-d H:i:s"),
									"usureg"		=> $_SESSION["nombre"],
									"pcreg" 		=> $PcReg);

				#var_dump($datosCab);
				$respuestaCab = ModeloNotasIngresos::mdlGuardarNotaIngresoCab($datosCab);
				#var_dump($respuestaCab);
				#$respuestaCab = "ok";

				#2. Creamos el detalle
				if($respuestaCab == "ok"){

					foreach($listaNotaIngreso as $key=>$value){

						$datosDet = array(	"cod_local" 	=> '01',
											"cod_entidad" 	=> '01',
											"item"			=> $key+1,
											"codruc"		=> $_POST["nuevoProveedor"],
											"tnea"			=> 'NE',
											"snea" 			=> '001',
											"nnea"			=> $ultimoNro["correlativo"],
											"ndoc"			=> $_POST["nuevaOc"],
											"cansol"		=> $value["cantidadRe"],
											"presol"		=> $value["precio"],
											"codpro"		=> $value["codpro"],
											"codalm"		=> '01',
											"p_unitario"	=> $value["precio"],
											"coscompra"		=> $value["precio"],
											"total"			=> $value["total"],
											"estreg"		=> 'P',
											"fecreg"		=> $fecha->format("Y-m-d H:i:s"),
											"usureg"		=> $_SESSION["nombre"],
											"pcreg" 		=> $PcReg,
											"salpro"		=> $value["saldo"],
											"excpro"		=> $value["exceso"],
											"cantni"		=> $value["cantidadOc"],
											"fecemi"		=> $fecha->format("Y-m-d H:i:s"));

						#var_dump($datosDet);
						$respuestaDet = ModeloNotasIngresos::mdlGuardarNotaIngresoDet($datosDet);
						var_dump($respuestaDet);


					}

				}else{

					# Mostramos una alerta suave
				

				}




			}


		}


	}

}