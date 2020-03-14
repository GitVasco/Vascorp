<?php

class ControladorOperaciones{

	/*=============================================
	CREAR OPERACIONES
	=============================================*/

	static public function ctrCrearOperacion(){

		if(isset($_POST["nuevaOperacion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaOperacion"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoCodigo"])){
				$tabla="operacionesjf";
			   	$datos = array("codigo"=>$_POST["nuevoCodigo"],
					           "nombre"=>$_POST["nuevaOperacion"]);

			   	$respuesta = ModeloOperaciones::mdlIngresarOperacion($tabla,$datos);
				var_dump($respuesta);
			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La operación ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "operaciones";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La operación no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "operaciones";

							}
						})

			  	</script>';



			}

		}

	}
	/*=============================================
	MOSTRAR OPERACIONES
	=============================================*/

	static public function ctrMostrarOperaciones($item,$valor){
        $tabla="operacionesjf";
		$respuesta = ModeloOperaciones::mdlMostrarOperaciones($tabla,$item,$valor);

		return $respuesta;

    }
	
	
	/*=============================================
	MOSTRAR CABECERA OPERACIONES
	=============================================*/

	static public function ctrMostrarCabeceraOperaciones($item,$valor){
        $tabla="operacion_cabecerajf";
		$respuesta = ModeloOperaciones::mdlMostrarCabeceraOperaciones($tabla,$item,$valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR MODELOS
	=============================================*/

	static public function ctrMostrarModelos($item,$valor){
        $tabla="modelojf";
		$respuesta = ModeloOperaciones::mdlMostrarModelos($tabla,$item,$valor);

		return $respuesta;

	}
	
	/*=============================================
	MOSTRAR DETALLE OPERACIONES
	=============================================*/

	static public function ctrMostrarDetalleOperaciones($item,$valor){
        $tabla="operaciones_detallejf";
		$respuesta = ModeloOperaciones::mdlMostrarDetalleOperaciones($tabla,$item,$valor);

		return $respuesta;

    }
	/*=============================================
	EDITAR OPERACIONES
	=============================================*/

	static public function ctrEditarOperacion(){

		if(isset($_POST["editarOperacion"])){

			var_dump("editarOperacion", $_POST["editarOperacion"]);

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarOperacion"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarCodigo"])){

			   	$datos = array("id"=>$_POST["idOperacion"],
							   "codigo"=>$_POST["editarCodigo"],
							   "nombre"=>$_POST["editarOperacion"]);

				$tabla="operacionesjf";
			   	$respuesta = ModeloOperaciones::mdlEditarOperacion($tabla,$datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La operacion ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "operaciones";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La operacion no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "operaciones";

							}
						})

			  	</script>';



			}

		}

    }
    
	/*=============================================
	ELIMINAR OPERACION
	=============================================*/

	static public function ctrEliminarOperacion(){

		if(isset($_GET["idOperacion"])){

			$tabla ="operacionesjf";
			$datos = $_GET["idOperacion"];

			$respuesta = ModeloOperaciones::mdlEliminarOperacion($tabla,$datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La operación ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "operaciones";

								}
							})

				</script>';

			}		

		}

	}    

	
	/*=============================================
	CREAR OPERACIÓN POR MODELO
	=============================================*/

	static public function ctrCrearOperacionModelo(){

		if(isset($_POST["seleccionarArticulo"])){

			if($_POST["listaOperaciones"]==""){
				# Mostramos una alerta suave
				echo '<script>
						swal({
							type: "error",
							title: "Error",
							text: "¡No se seleccionó ninguna operacion. Por favor, intenteló de nuevo!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then((result)=>{
							if(result.value){
								window.location="creardetalle";}
						});
					</script>';
			}else{
				$tabla="operacion_cabecerajf";
				$datos = array("articulo" => $_POST["seleccionarArticulo"],
				   				 "vendedor_fk"=>$_POST["idVendedor"],
					   		     "total_pd"=>$_POST["nuevoTotalDocena"],
							     "total_ts"=>$_POST["nuevoTotalStandar"]
							   );

			   	$respuesta = ModeloOperaciones::mdlIngresarCabeceraOperacion($tabla,$datos);
				ModeloOperaciones::mdlActualizarUnDato("modelojf","operaciones",1,$_POST["seleccionarArticulo"]);
				//DETALLE
				
				$operaciones=json_decode($_POST["listaOperaciones"],true);
				foreach($operaciones as $key=>$value){
					$tabla2="operaciones_detallejf";
					$datos2=array("modelo"=>$_POST["seleccionarArticulo"],
								  "cod_operacion"=>$value["codigo"],
								  "precio_doc"=>$value["precio"],
								  "tiempo_stand"=>$value["tiempo"],);
					$respuesta2= ModeloOperaciones::mdlIngresarDetalleOperacion($tabla2,$datos2);
					
				}
			   	if($respuesta == "ok"  && $respuesta2=="ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La operación ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "detalleoperaciones";

									}
								})

					</script>';

				}

			else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La operación no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "creardetalle";

							}
						})

			  	</script>';



			}
		}

		}

    }
    


	/*=============================================
	EDITAR DETALLE OPERACIONES
	=============================================*/

	static public function ctrEditarCabeceraOperacion(){

		if(isset($_POST["seleccionarArticulo"])){

			if($_POST["listaOperaciones"]==""){
				# Mostramos una alerta suave
				echo '<script>
						swal({
							type: "error",
							title: "Error",
							text: "¡No se seleccionó ninguna operacion. Por favor, intenteló de nuevo!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then((result)=>{
							if(result.value){
								window.location="creardetalleoperaciones";}
						});
					</script>';
			}else{
				$tabla="operacion_cabecerajf";
				$datos = array( "id"=>$_POST["editarDetalleOperacion"],
								"articulo" => $_POST["seleccionarArticulo"],
				   				 "vendedor_fk"=>$_POST["idVendedor"],
					   		     "total_pd"=>$_POST["nuevoTotalDocena"],
							     "total_ts"=>$_POST["nuevoTotalStandar"]
							   );

			   	$respuesta = ModeloOperaciones::mdlEditarCabeceraOperacion($tabla,$datos);
				
				$tabla2="operaciones_detallejf";
				$valor2=$_POST["seleccionarArticulo"];
				

				//DETALLE
				
				$operaciones=json_decode($_POST["listaOperaciones"],true);
				$detalle = ModeloOperaciones::mdlEliminarDetalleOperacion($tabla2,$valor2);
				foreach($operaciones as $key=>$value){
					
					$datos2=array("modelo"=>$_POST["seleccionarArticulo"],
								  "cod_operacion"=>$value["codigo"],
								  "precio_doc"=>$value["precio"],
								  "tiempo_stand"=>$value["tiempo"],);
					$respuesta2= ModeloOperaciones::mdlIngresarDetalleOperacion($tabla2,$datos2);
					
				}
			   	if($respuesta == "ok"  && $respuesta2=="ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La operación ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "detalleoperaciones";

									}
								})

					</script>';

				}

			else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La operación no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "creardetalleoperaciones";

							}
						})

			  	</script>';



			}
		}

		}

	}
	
	//ELIMINAR CABECERA OPERACION
	static public function ctrEliminarCabeceraOperacion(){

		if(isset($_GET["idOperacion"])){

			$tabla ="operacion_cabecerajf";
			$datos = $_GET["idOperacion"];

			

			$respuesta = "ok";

			//LLAMAMOS CABECERA
			$item="id";
			$cabecera=ModeloOperaciones::mdlMostrarCabeceraOperaciones($tabla,$item,$datos);

			$tabla2="operaciones_detallejf";
			$itemDetalle="modelo";
			$valorDetalle=$cabecera["articulo"];
			$detalle=ModeloOperaciones::mdlMostrarDetalleOperaciones($tabla2,$itemDetalle,$valorDetalle);
			$modelo=ModeloOperaciones::mdlActualizarUnDato("modelojf","operaciones",0,$valorDetalle);

			foreach ($detalle as $key => $value) {
		
				$respuesta2=ModeloOperaciones::mdlEliminarDetalleOperacion($tabla2,$value["modelo"]);

			}
			$respuesta = ModeloOperaciones::mdlEliminarCabeceraOperacion($tabla,$datos);
			

	

		}

	} 


}
