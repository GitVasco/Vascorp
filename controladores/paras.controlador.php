<?php

class ControladorParas{

	/*=============================================
	CREAR PARAS
	=============================================*/

	static public function ctrCrearPara(){

		if(isset($_POST["nuevaPara"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaPara"])){

                $tabla = "parajf";

				$datos = $_POST["nuevaPara"];

				$respuesta = ModeloParas::mdlIngresarPara($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La para ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "paras";

									}
								})

					</script>';

				}



			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La para no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "paras";

							}
						})

			  	</script>';

			}

		}

    }
    
	/*=============================================
	MOSTRAR paras
	=============================================*/

	static public function ctrMostrarParas($item, $valor){

		$tabla = "parajf";

		$respuesta = ModeloParas::mdlMostrarParas($tabla, $item, $valor);

		return $respuesta;
	
	}    


	/*=============================================
	EDITAR PARA
	=============================================*/

	static public function ctrEditarPara(){

		if(isset($_POST["editarPara"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarPara"])){

				$tabla = "parajf";

				$datos = array("nombre"=>$_POST["editarPara"],
							   "id"=>$_POST["idPara"]);

				$respuesta = ModeloParas::mdlEditarPara($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La para ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "paras";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La para no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "paras";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR PARA
	=============================================*/

	static public function ctrBorrarPara(){

		if(isset($_GET["idPara"])){

			$tabla ="parajf";
			$datos = $_GET["idPara"];

			$respuesta = ModeloParas::mdlBorrarPara($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "La para ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "paras";

									}
								})

					</script>';
			}
		}
		
	}
}










    

