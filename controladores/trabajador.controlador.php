<?php

class ControladorTrabajador{
/*=============================================
	MOSTRAR TRABAJADORES
	=============================================*/

	static public function ctrMostrarTrabajador($item,$valor){
        $tabla="trabajadorjf";
		$respuesta = ModeloTrabajador::mdlMostrarTrabajador($tabla,$item,$valor);

		return $respuesta;

	}
	/*=============================================
	CREAR TRABAJADOR
	=============================================*/
	static public function ctrCrearTrabajador(){

		if(isset($_POST["apellidoPaterno"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["apellidoPaterno"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreTrabajador"])&&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["apellidoMaterno"])&&
			   preg_match('/^[0-9]+$/', $_POST["nroDocumento"])
			   
			   ){
				$tabla="trabajadorjf";

			   	$datos = array("cod_tra"=>$_POST["codigoTrabajador"],
							   "cod_doc"=>$_POST["tipoDocumento"], 
							   "nro_doc_tra"=>$_POST["nroDocumento"],
							   "nom_tra"=>$_POST["nombreTrabajador"],
							   "ape_pat_tra"=>$_POST["apellidoPaterno"],
							   "ape_mat_tra"=>$_POST["apellidoMaterno"],
							   "cod_tip_tra"=>$_POST["tipoTrabajador"], 
							   "sueldo_total"=>$_POST["sueldoMes"]);

			   	$respuesta = ModeloTrabajador::mdlIngresarTrabajador($tabla,$datos);
				//var_dump($datos);
			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El trabajador ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "trabajador";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El trabajador no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "trabajador";

							}
						})

			  	</script>';



			}

		}


	}



	/*=============================================
	ELIMINAR TRABAJADOR
	=============================================*/

	static public function ctrEliminarTrabajador(){

		if(isset($_GET["idTrabajador"])){

			$tabla ="trabajadorjf";
			$datos = $_GET["idTrabajador"];

			$respuesta = ModeloTrabajador::mdlEliminarTrabajador($tabla,$datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El trabajador ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "trabajador";

								}
							})

				</script>';

			}		

		}

	}    

	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function ctrEditarTrabajador(){

		if(isset($_POST["editarNombreTrabajador"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreTrabajador"])&&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApellidoPaterno"])&&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApellidoMaterno"])
			){

				

				$datos = array("cod_tra"=>$_POST["editarCodigoTrabajador"],
							   "cod_doc"=>$_POST["editarTipoDocumento"],
							   "nro_doc_tra"=>$_POST["editarNroDocumento"],
							   "nom_tra"=>$_POST["editarNombreTrabajador"],
							   "ape_pat_tra"=>$_POST["editarApellidoPaterno"],
							   "ape_mat_tra"=>$_POST["editarApellidoMaterno"],
							   "cod_tip_tra"=>$_POST["editarTipoTrabajador"],
							   "sueldo_total"=>$_POST["editarSueldoMes"],
							);

				$tabla = "trabajadorjf";

				$respuesta = ModeloTrabajador::mdlEditarTrabajador($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El trabajador ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "trabajador";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El trabajador no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "trabajador";

							}
						})

			  	</script>';

			}

		}

	}


}