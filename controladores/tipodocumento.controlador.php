<?php

class ControladorTipoDocumento{

    /*=============================================
	CREAR CATEGORIAS
	=============================================*/

	static public function ctrCrearTipoDocumento(){

		if(isset($_POST["nuevoTipoDocumento"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevotipoDocumento"])){

                $tabla = "tipo_documentojf";

				$datos = $_POST["nuevoTipoDocumento"];

				$respuesta = ModeloTipoDocumento::mdlIngresarTipoDocumento($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El tipo de documento ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "tipodocumentos";

									}
								})

					</script>';

				}



			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El tipo de documento no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "tipodocumentos";

							}
						})

			  	</script>';

			}

		}

    }
    /*=============================================
	MOSTRAR TIPO DOCUMENTO
	=============================================*/

	static public function ctrMostrarTipoDocumento($item, $valor){

		$tabla = "tipo_documentojf";

		$respuesta = ModeloTipoDocumento::mdlMostrarTipoDocumento($tabla, $item, $valor);

        return $respuesta;
        
	
	}    


}