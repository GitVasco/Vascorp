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
	* MOSTRAR ARTICULOS PARA LA TABLA DE ORDENES DE CORTE
	*/	
	static public function ctrMostrarProduccion($valor){

		$respuesta = ModeloArticulos::mdlMostrarProduccion($valor);

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
	
	static public function ctrCambiarStock(){

        if(isset($_POST["import"])){
			$nombre="STOCK";
			if(strncmp($nombre,$_FILES["archivoxls"]["name"],5) === 0){
				
				include "/../vistas/reportes_excel/Excel/reader.php";
				$directorio="vistas/cargas/".$_FILES["archivoxls"]["name"];
				$archivo=move_uploaded_file($_FILES["archivoxls"]['tmp_name'], $directorio);
				$data = new Spreadsheet_Excel_Reader();
				$data->setOutputEncoding('CP1251');
				$data->read("vistas/cargas/".$_FILES["archivoxls"]["name"]);
				$conexion = mysql_connect("192.168.1.3", "jesus", "admin123") or die("No se pudo conectar: " . mysql_error());
				mysql_select_db("new_vasco", $conexion);
				for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
					for ($j = 1; $j <= 1; $j++) {
					if(strlen($data->sheets[0]['cells'][$i][1])==7){
					$sqlDetalle = mysql_query("UPDATE articulojf SET stock=".$data->sheets[0]['cells'][$i][11].
					" WHERE articulo="."1".$data->sheets[0]['cells'][$i][1]) or die(mysql_error());
					
					}else {
					$sqlDetalle = mysql_query("UPDATE articulojf SET stock=".$data->sheets[0]['cells'][$i][11].
					" WHERE articulo="."B".$data->sheets[0]['cells'][$i][1]) or die(mysql_error());
					
						}
					}
				}
				echo'<script>

				swal({
					type: "success",
					title: "El articulo ha sido editado correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result){
								if (result.value) {

								window.location = "cargas-automaticas";

								}
							})

				</script>';
			}else{

				echo'<script>

					swal({
						type: "error",
						title: "¡El nombre de archivo no es correcto, debe ser STOCK.xls!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
							if (result.value) {

							window.location = "cargas-automaticas";

							}
						})

				</script>';
			}
		}
	}

	static public function ctrCambiarMovimientos(){

        if(isset($_POST["importmovimiento"])){
			include "/../vistas/reportes_excel/Excel/reader.php";
			$directorio="vistas/cargas/".$_FILES["archivoxlsmovimiento"]["name"];
			$archivo=move_uploaded_file($_FILES["archivoxlsmovimiento"]['tmp_name'], $directorio);
			$data = new Spreadsheet_Excel_Reader();
			$data->setOutputEncoding('CP1251');
			$data->read("vistas/cargas/".$_FILES["archivoxlsmovimiento"]["name"]);
			$conexion = mysql_connect("192.168.1.3", "jesus", "admin123") or die("No se pudo conectar: " . mysql_error());
			mysql_select_db("new_vasco", $conexion);
			$sqlEliminar = mysql_query("DELETE FROM movimientosjf WHERE fecha = DATE(NOW()) OR fecha = DATE(NOW()) - INTERVAL 1 DAY");
			for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
				for ($j = 1; $j <= 1; $j++) {
					
					$tipo=$data->sheets[0]['cells'][$i][1];
					$documento=$data->sheets[0]['cells'][$i][2];
					$mes=substr($data->sheets[0]['cells'][$i][3],3,3);
					if($mes=="Jan"){
						$num="01";
						$fecha=str_replace($mes,$num,$data->sheets[0]['cells'][$i][3]);
					}else if($mes=="Feb"){
						$num="02";
						$fecha=str_replace($mes,$num,$data->sheets[0]['cells'][$i][3]);
					}else if($mes=="Mar"){
						$num="03";
						$fecha=str_replace($mes,$num,$data->sheets[0]['cells'][$i][3]);
					}else if($mes=="Apr"){
						$num="04";
						$fecha=str_replace($mes,$num,$data->sheets[0]['cells'][$i][3]);
					}else if($mes=="May"){
						$num="05";
						$fecha=str_replace($mes,$num,$data->sheets[0]['cells'][$i][3]);
					}else if($mes=="Jun"){
						$num="06";
						$fecha=str_replace($mes,$num,$data->sheets[0]['cells'][$i][3]);
					}else if($mes=="Jul"){
						$num="07";
						$fecha=str_replace($mes,$num,$data->sheets[0]['cells'][$i][3]);
					}else if($mes=="Aug"){
						$num="08";
						$fecha=str_replace($mes,$num,$data->sheets[0]['cells'][$i][3]);
					}else if($mes=="Sep"){
						$num="09";
						$fecha=str_replace($mes,$num,$data->sheets[0]['cells'][$i][3]);
					}else if($mes=="Oct"){
						$num="10";
						$fecha=str_replace($mes,$num,$data->sheets[0]['cells'][$i][3]);
					}else if($mes=="Nov"){
						$num="11";
						$fecha=str_replace($mes,$num,$data->sheets[0]['cells'][$i][3]);
					}else if($mes=="Dec"){
						$num="12";
						$fecha=str_replace($mes,$num,$data->sheets[0]['cells'][$i][3]);
					}
					if(strlen($data->sheets[0]['cells'][$i][4])==7){
						$codArt="1".$data->sheets[0]['cells'][$i][4];
					}else{
						$codArt="B".$data->sheets[0]['cells'][$i][4];
					}
					if($data->sheets[0]['cells'][$i][1] == "E20"){
						$taller=substr($data->sheets[0]['cells'][$i][2],0,2);
					}
					else{
						$taller=0;
					}
					$linea=$data->sheets[0]['cells'][$i][6];
					$almacen=$data->sheets[0]['cells'][$i][7];
					$cliente=$data->sheets[0]['cells'][$i][8];
					$vendedor=$data->sheets[0]['cells'][$i][9];
					$cantidad=$data->sheets[0]['cells'][$i][10];
					$precio=$data->sheets[0]['cells'][$i][15];
					$dscto1=$data->sheets[0]['cells'][$i][18];
					$dscto2=$data->sheets[0]['cells'][$i][19];
					$nombre=$data->sheets[0]['cells'][$i][28];
					$total=($data->sheets[0]['cells'][$i][10]*$data->sheets[0]['cells'][$i][15]*((100-$data->sheets[0]['cells'][$i][18])/100))*((100-$data->sheets[0]['cells'][$i][19])/100);
					$sqlInsertar = mysql_query("INSERT INTO movimientosjf (tipo,documento,taller,fecha,articulo,linea,cliente,vendedor,cantidad,precio,dscto1,dscto2,total,nombre_tipo,almacen)  values(".$tipo.",".$documento.",".$taller.",".$fecha.",".$codArt.",".$linea.",".$cliente.",".$vendedor.",".$cantidad.",".$precio.",".$dscto1.",".$dscto2.",".$total.",".$nombre.",".$almacen.")");
				}
			
			}
				
			// 	// }else {
			// 	//   $sqlDetalle = mysql_query("UPDATE articulojf SET stock=".$data->sheets[0]['cells'][$i][11].
			// 	//   " WHERE articulo="."B".$data->sheets[0]['cells'][$i][1]) or die(mysql_error());
				
			// 	// }
			// 	}
			// 	echo("</tr>");

			// }
			// echo("</table>");

		}

	}

}

