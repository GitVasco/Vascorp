<?php

class ControladorColores{

	/*=============================================
	CREAR COLORES
	=============================================*/

	static public function ctrCrearColor(){

		if(isset($_POST["nuevoColor"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoColor"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoCodigo"])){

			   	$datos = array("color"=>$_POST["nuevoColor"],
					           "codigo"=>$_POST["nuevoCodigo"]);

			   	$respuesta = ModeloColores::mdlIngresarColor($datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El color ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "colores";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El color no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "colores";

							}
						})

			  	</script>';



			}

		}

    }
    

	/*=============================================
	MOSTRAR COLORES
	=============================================*/

	static public function ctrMostrarColores($valor){

		$respuesta = ModeloColores::mdlMostrarColores($valor);

		return $respuesta;

    }
    
	/*=============================================
	EDITAR COLOR
	=============================================*/

	static public function ctrEditarColor(){

		if(isset($_POST["editarColor"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarColor"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarCodigo"])){

			   	$datos = array("id"=>$_POST["idColor"],
                               "color"=>$_POST["editarColor"],
					           "codigo"=>$_POST["editarCodigo"]);

			   	$respuesta = ModeloColores::mdlEditarColor($datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El color ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "colores";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "colores";

							}
						})

			  	</script>';



			}

		}

    }
    
	/*=============================================
	ELIMINAR COLOR
	=============================================*/

	static public function ctrEliminarColor(){

		if(isset($_GET["idColor"])){

			$datos = $_GET["idColor"];

			$respuesta = ModeloColores::mdlEliminarColor($datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El cliente ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "colores";

								}
							})

				</script>';

			}		

		}

	}    

}
