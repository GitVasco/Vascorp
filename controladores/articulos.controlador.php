<?php

class controladorArticulos{

	/* 
	* MOSTRAR ARTICULOS
	*/
	static public function ctrMostrarArticulos($valor){

		$tabla = "articulojf";

		$respuesta = ModeloArticulos::mdlMostrarArticulos($valor);

		return $respuesta;

	}

	/* 
	* MOSTRAR SIN TARJETA
	*/
	static public function ctrMostrarSinTarjeta(){

		$respuesta = ModeloArticulos::mdlMostrarSinTarjeta();

		return $respuesta;

	}	

	/* 
	* MOSTRAR CANTIDAD DE PEDIDOS
	*/
	static public function ctrArticulosPedidos(){

		$respuesta = ModeloArticulos::mdlArticulosPedidos();

		return $respuesta;

	}	

	/* 
	* MOSTRAR CANTIDAD DE FALTANTES
	*/
	static public function ctrArticulosFaltantes(){

		$tabla = "articulojf";

		$respuesta = ModeloArticulos::mdlArticulosFaltantes($tabla);

		return $respuesta;

	}	
	/* 
	* CREAR ARTICULO
	*/
	static public function ctrCrearArticulo(){

        if(isset($_POST["nuevoModelo"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoModelo"])){
	
                $tabla = "articulojf";
				$codigo="";
				$datos = array("id_marca" => $_POST["nuevaMarca"],
							   "modelo" => $_POST["nuevoModelo"],
							   "descripcion" => $_POST["nuevaDescripcion"],
							   "cod_color" => $_POST["nuevoColor"],
							   "cod_talla" => $_POST["nuevaTalla"],
							   "tipo" => $_POST["nuevoTipo"],
							   "articulo" => $codigo,
							   "color" => $_POST["color"],
							   "talla" => $_POST["talla"],
							   "imagen" => null);

                $respuesta = ModeloArticulos::mdlIngresarArticulo($tabla, $datos);
                
				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El articulo ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "articulos";

										}
									})

						</script>';

				}                


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El articulo no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "articulos";

							}
						})

			  	</script>';
			}
		}


	}

	/* 
	* CREAR ARTICULO x MODELO
	*/
	static public function ctrCrearArticuloModelo(){

        if(isset($_POST["nuevoModelo"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoModelo"])){
				$tablaModelo="modelojf";
				$valorModelo=$_SESSION["modelos"];
				if(empty($_POST["descuentos"])){
					$descuentos=0;
				}else{
					$descuentos=$_POST["descuentos"];
				}
				if(empty($_POST["precios"])){
					$precios=0;
				}else{
					$precios=$_POST["precios"];
				}
				if(empty($_POST["efectosDesc"])){
					$efectosDesc=0;
				}else{
					$efectosDesc=$_POST["efectosDesc"];
				}
				if(empty($_POST["efectosIGV"])){
					$efectosIGV=0;
				}else{
					$efectosIGV=$_POST["efectosIGV"];
				}
				$datosModelo = array("modelo" => $valorModelo,
							"descuentos" => $descuentos,
							"precios" => $precios,
							"efectos_desc" => $efectosDesc,
							"efectos_igv" => $efectosIGV,
							"articulos"=>1
						);
				$modelo=ModeloModelos::mdlModeloPrecios($tablaModelo,$datosModelo);

				$colores=json_decode($_POST["listaColores"],true);
				$arregloCHK=$_POST["chk"];
				$num=count($arregloCHK);
				for($n=0;$n<$num;$n++){
					$tabla2="tallajf";
					$item="cod_talla";
					$valor=$arregloCHK[$n];
					$valor2=$_POST["nuevoGrupoTalla"];
					$talla=ModeloModelos::mdlMostrarTallaGrupo($tabla2,$item,$valor,$valor2);
					foreach($colores as $key=>$value){
						$tabla = "articulojf";
						$codigo=$_POST["nuevoModelo"].$value["codigo"].$talla["cod_talla"];
						$datos = array("id_marca" => $_POST["nuevaMarca"],
									"marca"=>$_POST["nuevaDescripcionMarca"],
									"modelo" => $_POST["nuevoModelo"],
									"descripcion" => $_POST["nuevaDescripcion"],
									"cod_color" => $value["codigo"],
									"cod_talla" => $talla["cod_talla"],
									"articulo" => $codigo,
									"color" => $value["descripcion"],
									"talla" => $talla["talla"]);
						$existeArticulo=ModeloArticulos::mdlMostrarArticulos($codigo);
						
						if(empty($existeArticulo)){
							$respuesta = ModeloArticulos::mdlIngresarArticulo($tabla, $datos);
							if($respuesta == "ok"){

								echo'<script>
			
									swal({
										  type: "success",
										  title: "El articulo ha sido guardado correctamente",
										  showConfirmButton: true,
										  confirmButtonText: "Cerrar"
										  }).then(function(result){
													if (result.value) {
			
													window.location = "articulos";
			
													}
												})
			
									</script>';
			
							}      
						}else{
							echo'<script>
								swal({
									type: "error",
									title: "¡El articulo ya esta creado!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"
									}).then(function(result){
										if (result.value) {

										window.location = "articulos";

										}
									})

							</script>';
						}

					}
					
				}
				
				          


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El articulo ya esta creado!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "articulos";

							}
						})

			  	</script>';
			}
		}


	}

	/* 
	* EDITAR ARTICULO
	*/
	static public function ctrEditarArticulo(){

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

					$directorio = "vistas/img/articulos/".$_POST["editarCodigo"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["imagenActual"]) && $_POST["imagenActual"] != "vistas/img/articulos/default/anonymous.png"){

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

						$ruta = "vistas/img/articulos/".$_POST["editarCodigo"]."/".$aleatorio.".jpg";

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

						$ruta = "vistas/img/articulos/".$_POST["editarCodigo"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$datos = array("descripcion" => $_POST["editarDescripcion"],
							"articulo" => $_POST["editarCodigo"],
							"imagen" => $ruta);

				$respuesta = ModeloArticulos::mdlEditarArticulo($datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							type: "success",
							title: "El articulo ha sido editado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result){
										if (result.value) {

										window.location = "articulos";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						type: "error",
						title: "¡El articulo no puede ir con los campos vacíos o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
							if (result.value) {

							window.location = "articulos";

							}
						})

				</script>';
			}
		}

	}	

	/* 
	* BORRAR ARTICULO
	*/
	static public function ctrEliminarArticulo(){

		if(isset($_GET["idArticulo"])){

			$datos = $_GET["idArticulo"];

			if($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/img/articulos/default/anonymous.png"){

				unlink($_GET["imagen"]);
				rmdir('vistas/img/articulos/'.$_GET["articulo"]);

			}

			$respuesta = ModeloArticulos::mdlEliminarArticulo($datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El articulo ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "articulos";

								}
							})

				</script>';

			}		
		}


	}	

	/* 
	* SACAR CONFIGURACION DE URGENCIAS
	*/
	static public function ctrConfiguracion(){

		$respuesta = ModeloArticulos::mdlConfiguracion();

		return $respuesta;

	}

    /* 
    * CONFIGURAR PORCENTAJE SALTA A CREAR OC
    */
    static public function ctrConfigurarUrgencia(){

        if(isset($_POST["urgencia"])){

			$dato = $_POST["urgencia"];
			
			var_dump("dato", $dato);

			$respuesta = ModeloArticulos::mdlConfigurarUrgencia($dato);
			
			if ($respuesta == "ok"){

				echo	'<script>

							swal({
								type: "success",
								title: "El porcentaje de urgencias ha sido configurado correctamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								}).then(function(result){
											if (result.value) {

											window.location = "crear-ordencorte";

											}
										})

						</script>';

			}

        }

	}

    /* 
    * CONFIGURAR PORCENTAJE SALTA A CREAR OC
    */
    static public function ctrConfigurarUrgenciaLista(){

        if(isset($_POST["urgencia"])){

			$dato = $_POST["urgencia"];
			
			var_dump("dato", $dato);

			$respuesta = ModeloArticulos::mdlConfigurarUrgencia($dato);
			
			if ($respuesta == "ok"){

				echo	'<script>

							swal({
								type: "success",
								title: "El porcentaje de urgencias ha sido configurado correctamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								}).then(function(result){
											if (result.value) {

											window.location = "urgencias";

											}
										})

						</script>';

			}

        }

	}	
	
	/* 
	* MOSTRAR ARTICULOS PARA LA TABLA DE ORDENES DE CORTE
	*/	
	static public function ctrMostrarArticulosUrgencia(){

		$respuesta = ModeloArticulos::mdlMostrarArticulosUrgencia();

		return $respuesta;
		
	}

	/* 
	* MOSTRAR ARTICULOS PARA LA TABLA DE ORDENES DE CORTE - PRODUCCION
	*/	
	static public function ctrMostrarProduccion($valor){

		$respuesta = ModeloArticulos::mdlMostrarProduccion($valor);

		return $respuesta;
		
	}	


	/* 
	* MOSTRAR ARTICULOS PARA LA TABLA DE ORDENES DE CORTE - VENTAS
	*/	
	static public function ctrMostrarVentas($valor){

		$respuesta = ModeloArticulos::mdlMostrarVentas($valor);

		return $respuesta;
		
	}		

	/* 
	* MOSTRAR ARTICULOS PARA LA TABLA URGENCIA
	*/	
	static public function ctrMostrarUrgencia($valor){

		$tabla = "articulojf";
		
		$respuesta = ModeloArticulos::mdlMostrarUrgencia($tabla,$valor);

		return $respuesta;
		
	}
	
		/* 
	* MOSTRAR MP DETALLE PARA LA TABLA URGENCIA
	*/	
	static public function ctrVisualizarUrgenciasDetalle($valor){

		$respuesta = ModeloArticulos::mdlVisualizarUrgenciasDetalle($valor);

		return $respuesta;
		
	}


	/* 
	* MOSTRAR ARTICULOS PARA LA TABLA URGENCIA - DETALLE
	*/	
	static public function ctrListaArticulosPedidos(){

		$respuesta = ModeloArticulos::mdlListaArticulosPedidos();

		return $respuesta;
		
	}
	
	/* 
	* MOSTRAR  COLORES
	*/	
	static public function ctrVerColores($valor){

		$respuesta = ModeloArticulos::mdlVerColores($valor);

		return $respuesta;
		
	}
	
	/* 
	* MOSTRAR  ARTICULOS
	*/	
	static public function ctrVerArticulos($valor){

		$respuesta = ModeloArticulos::mdlVerArticulos($valor);

		return $respuesta;
		
	}	

	/* 
	* MOSTRAR  ARTICULOS
	*/	
	static public function ctrVerPrecios($valor){

		$respuesta = ModeloArticulos::mdlVerPrecios($valor);

		return $respuesta;
		
	}		
	


}

