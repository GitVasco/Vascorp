<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ControladorServicios{

	/*=============================================
	MOSTRAR SERVICIOS
	=============================================*/

	static public function ctrMostrarServicios($item, $valor){

		$tabla = "serviciosjf";

		$respuesta = ModeloServicios::mdlMostrarServicios($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR SERVICIOS
	=============================================*/

	static public function ctrMostrarDetallesServicios($item, $valor){

		$tabla = "servicios_detallejf";

		$respuesta = ModeloServicios::mdlMostraDetallesServicios($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR SERVICIO
	=============================================*/

	static public function ctrCrearServicio(){

		/* veriaficamos que venta traiga datos */

		if(isset($_POST["nuevoServicio"]) && 
		   isset($_POST["seleccionarSector"]) && 
		   isset($_POST["listaProductos"])){

			/* alerta  si la lista de productos viene vacia  */

			if($_POST["listaProductos"]==""){
				# Mostramos una alerta suave
				echo '<script>
						swal({
							type: "error",
							title: "Error",
							text: "¡No se seleccionó ningún articulo. Por favor, intenteló de nuevo!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then((result)=>{
							if(result.value){
								window.location="crear-servicio";}
						});
					</script>';
			}else{

				# Modificamos la información de los productos comprados en un array

				$listaProductos=json_decode($_POST["listaProductos"],true);
				
				$comprasTotales=0;

				foreach($listaProductos as $key=>$value){

					$tabla="articulojf";
					$valor=$value["articulo"];
					$respuestaProducto=ModeloArticulos::mdlMostrarArticulos($valor);
					$item1 = "servicio";
					$valor1 = $respuestaProducto["servicio"]-$value["cantidad"];
					ModeloArticulos::mdlActualizarUnDato($tabla, $item1, $valor1, $valor);
					

				}

			

				# Actualizamos ultima_compra en la tabla Clientes
				date_default_timezone_set('America/Lima');
				$fecha=new DateTime();
				
				/* ==============================================
				GUARDAMOS LA VENTA
				============================================== */

				$datos=array("codigo"=>$_POST["nuevoServicio"],
							 "taller"=>$_POST["seleccionarSector"],
							 "usuario"=>$_POST["idVendedor"],
							 "total"=>$_POST["totalVenta"],
							 "fecha"=>$fecha->format("Y-m-d H:i:s"),
							 "estado"=>"ACTIVO");

				$respuesta=ModeloServicios::mdlGuardarServicios("serviciosjf",$datos);

				if($respuesta=="ok"){


					foreach($listaProductos as $key=>$value){

						$datos=array("articulo"=>$value["articulo"],
									 "cantidad"=>$value["cantidad"],
									 "codigo"=>$_POST["nuevoServicio"]);

									 ModeloServicios::mdlGuardarDetallesServicios("servicios_detallejf",$datos);
					
					}

					# Mostramos una alerta suave
					echo '<script>
							swal({
								type: "success",
								title: "Felicitaciones",
								text: "¡La información fue registrada con éxito!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
							}).then((result)=>{
								if(result.value){
									window.location="servicios";}
							});
						</script>';
					}else{

					# Mostramos una alerta suave
					echo '<script>
							swal({
								type: "error",
								title: "Error",
								text: "¡La información presento problemas y no se registro adecuadamente. Por favor, intenteló de nuevo!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
							}).then((result)=>{
								if(result.value){
									window.location="crear-servicio";}
							});
						</script>';
					}				
			}			
		}

	}	

	/*=============================================
	EDITAR VENTA
	=============================================*/

	public function ctrEditarServicios(){

		if(isset($_POST["editarServicio"]) && isset($_POST["idSectorVenta"]) && isset($_POST["listaProductos"])){

			# Formateamos la tabla de Productos y de Clientes
			# Traemos los detalles asociados a la venta a editar
		
			$detaProductos=ModeloServicios::mdlMostraDetallesServicios("servicios_detallejf","codigo",$_POST["editarServicio"]);
		
			# Cambiamos los id de la lista por los id de los Productos
			foreach($detaProductos as $key=>$value){

				$infoPro=controladorArticulos::ctrMostrarArticulos($value["articulo"]);
				$detaProductos[$key]["articulo"]=$infoPro["articulo"];
				
			
			}	

			if($_POST["listaProductos"]==""){

				$listaProductos=$detaProductos;
				$validarCambio=false;

			}else{

				$listaProductos=json_decode($_POST["listaProductos"],true);
				$validarCambio=true;

			}
			
			if($validarCambio){


				foreach($listaProductos as $key=>$value){
					# Traemos los productos por ID en cada interacción
					$valor=$value["articulo"];

					$respuestaProducto=ModeloArticulos::mdlMostrarArticulos($valor);


					# Actualizamos las ventas en la tabla productos
					$item1="servicio";
					$valor1=$value["taller"]-$value["cantidad"];

					ModeloArticulos::mdlActualizarUnDato("articulojf", $item1, $valor1, $valor);
				}


				# Actualizamos ultima_compra en la tabla Clientes
				date_default_timezone_set('America/Lima');
				$fecha= new DateTime();

			}
			
			/* ==============================================
			EDITAMOS LOS CAMBIOS DE LA VENTA listaMetodoPago
			============================================== */
			$datos=array("codigo"=>$_POST["editarServicio"],
						 "usuario"=>$_POST["idVendedor"],
						 "taller"=>$_POST["idSectorVenta"],
						 "total"=>$_POST["totalVenta"],
						 "fecha"=>$fecha->format("Y-m-d H:i:s"));
						 						

			$respuesta=ModeloServicios::mdlEditarServicios("serviciosjf",$datos);


			/* var_dump("datos", $datos); */

			if($respuesta=="ok"){

				# Eliminamos los detalles de la venta
				$eliminarDeta=ModeloServicios::mdlEliminarDato("servicios_detallejf","codigo",$_POST["editarServicio"]);

				if($eliminarDeta=="ok"){

					# Guardamos los nuevos detalles de la venta
					foreach($listaProductos as $key=>$value){

						$datos=array("codigo"=>$_POST["editarServicio"],
									 "articulo"=>$value["articulo"],
									 "cantidad"=>$value["cantidad"]);

									 ModeloServicios::mdlGuardarDetallesServicios("servicios_detallejf",$datos);
					
					
					}
					# Mostramos una alerta suave
					echo '<script>
							swal({
								type: "success",
								title: "Felicitaciones",
								text: "¡La información fue Actualizada con éxito!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
							}).then((result)=>{
								if(result.value){
									window.location="servicios";}
							});
						</script>';
				}else{
					# Mostramos una alerta suave
					echo '<script>
							swal({
								type: "error",
								title: "Error",
								text: "¡La información presento problemas al actualizar los Detalles. Por favor, comunicarse con el Administrador de la Base de Datos!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
							}).then((result)=>{
								if(result.value){
									window.location="servicios";}
							});
						</script>';
				}
					
			}else{
				# Mostramos una alerta suave
				echo '<script>
						swal({
							type: "error",
							title: "Error",
							text: "¡La información presento problemas y no se actualizó adecuadamente. Por favor, intenteló de nuevo!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then((result)=>{
							if(result.value){
								window.location="servicios";}
						});
					</script>';
				
			}			



		}		
	} 


	/*=============================================
	ELIMINAR SERVICIO
	=============================================*/

	static public function ctrEliminarServicio($codigo){

		$item = "codigo";
        $infoServicio = ModeloServicios::mdlMostrarServicios("serviciosjf", $item, $codigo);
    	

        $detaServicio = ModeloServicios::mdlMostraDetallesServicios("servicios_detallejf", "codigo", $codigo);
        

        /* 
        todo: Actualizamos orden de corte en Articulojf
        */
        foreach($detaServicio as $key=>$value){

            $valorA = $value["articulo"];

            $infoA = ModeloArticulos::mdlMostrarArticulos($valorA);
            // var_dump("infoA", $infoA);
            #var_dump("infoA", $infoA["ord_corte"]);
            #var_dump("cantidad", $value["cantidad"]);

            $taller = $infoA["taller"] + $value["cantidad"];
            #var_dump("ord_corte", $ord_corte);

            ModeloArticulos::mdlActualizarUnDato("articulojf", "taller", $taller, $value["articulo"]);

        }

        /* 
        todo: Eliminamos la cabecera de Orden de corte
        */
        $tablaServicio = "serviciosjf";
        $itemServicio = "codigo";
        $valorServicio = $codigo;

        $respuesta = ModeloServicios::mdlEliminarDato($tablaServicio, $itemServicio, $valorServicio);

        if($respuesta == "ok"){

            /* 
            todo: Eliminamos el detalle de Orden de corte
            */
            $tablaDSer = "servicios_detallejf";
            $itemDSer = "codigo";
            $valorDSer = $codigo;

            ModeloServicios::mdlEliminarDato($tablaDSer, $itemDSer, $valorDSer);

        }

        return $respuesta;


	}

	/*=============================================
	SUMA TOTAL VENTAS
	=============================================*/

	public function ctrSumaTotalVentas(){

		$tabla = "serviciosjf";

		$respuesta = ModeloServicios::mdlSumaTotalServicios($tabla);

		return $respuesta;

	}


}