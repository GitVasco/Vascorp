<?php

class ControladorOperaciones{

	/*=============================================
	CREAR COLORES
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



}
