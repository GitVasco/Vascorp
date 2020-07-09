<?php

class ControladorModelos{

	/* 
	* MOSTRAR MODELOS
	*/
	static public function ctrMostrarModelos($item,$valor){

        $tabla = "modelojf";

		$respuesta = ModeloModelos::mdlMostrarModelos($tabla, $item,$valor);

		return $respuesta;

    }
    
	/* 
	* CREAR ARTICULO
	*/
	static public function ctrCrearModelo(){

        if(isset($_POST["nuevaDescripcion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoModelo"])){

		   		/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = "vistas/img/modelos/default/anonymous.png";

				if(isset($_FILES["nuevaImagen"]["tmp_name"])){

				 list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);

				 $nuevoAncho = 500;
				 $nuevoAlto = 500;

				 /*=============================================
				 CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
				 =============================================*/

				 $directorio = "vistas/img/modelos/".$_POST["nuevoModelo"];

				 mkdir($directorio, 0755);

				 /*=============================================
				 DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
				 =============================================*/

				 if($_FILES["nuevaImagen"]["type"] == "image/jpeg"){

					 /*=============================================
					 GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					 =============================================*/

					 $aleatorio = mt_rand(100,999);

					 $ruta = "vistas/img/modelos/".$_POST["nuevoModelo"]."/".$aleatorio.".jpg";

					 $origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);						

					 $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					 imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					 imagejpeg($destino, $ruta);

				 }

				 if($_FILES["nuevaImagen"]["type"] == "image/png"){

					 /*=============================================
					 GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					 =============================================*/

					 $aleatorio = mt_rand(100,999);

					 $ruta = "vistas/img/modelos/".$_POST["nuevoModelo"]."/".$aleatorio.".png";

					 $origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);						

					 $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					 imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					 imagepng($destino, $ruta);

				 }

			 }				

                $tabla = "modelojf";

				$datos = array("id_marca" => $_POST["nuevaMarca"],
							   "modelo" => $_POST["nuevoModelo"],
							   "descripcion" => $_POST["nuevaDescripcion"],
							   "tipo" => $_POST["nuevoTipo"],
							   "imagen" => $ruta,
							   "estado" => "ACTIVO");

                $respuesta = ModeloModelos::mdlIngresarModelo($tabla, $datos);
                
				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El modelo ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "modelosjf";

										}
									})

						</script>';

				}                


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El modelo no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "modelosjf";

							}
						})

			  	</script>';
			}
		}


	}

	/* 
	* EDITAR MODELO
	*/
	static public function ctrEditarModelo(){

		if(isset($_POST["editarDescripcion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"])){

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["imagenActual"];

				if(isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/modelos/".$_POST["editarModelo"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["imagenActual"]) && $_POST["imagenActual"] != "vistas/img/modelos/default/anonymous.png"){

						unlink($_POST["imagenActual"]);

					}else{

						mkdir($directorio, 0755);	
					
					}
					
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarImagen"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/modelos/".$_POST["editarModelo"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarImagen"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/modelos/".$_POST["editarModelo"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}
				$tabla="modelojf";
				$datos = array("descripcion" => $_POST["editarDescripcion"],
							"modelo" => $_POST["editarModelo"],
							"id_marca"=>$_POST["editarMarca"],
							"tipo" => $_POST["editarTipo"],
							"imagen" => $ruta);

				$respuesta=ModeloModelos::mdlEditarModelo($tabla,$datos);
				if($respuesta == "ok"){

					echo'<script>

						swal({
							type: "success",
							title: "El modelo ha sido editado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result){
										if (result.value) {

										window.location = "modelosjf";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						type: "error",
						title: "¡El modelo no puede ir con los campos vacíos o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
							if (result.value) {

							window.location = "modelosjf";

							}
						})

				</script>';
			}
		}

	}	

	/* 
	* BORRAR MODELO
	*/
	static public function ctrEliminarModelo(){

		if(isset($_GET["idModelo"])){

			$datos = $_GET["idModelo"];
			$tabla="modelojf";

			$respuesta = ModeloModelos::mdlEliminarModelo($tabla,$datos);
			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El modelo ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "modelosjf";

								}
							})

				</script>';

			}		
		}


	}	

	
	/* 
	* MOSTRAR MODELOS
	*/
	static public function ctrMostrarModeloArticulo($item,$valor){

        $tabla = "modelojf";

		$respuesta = ModeloModelos::mdlMostrarModeloArticulo($tabla, $item,$valor);

		return $respuesta;

    }

}

