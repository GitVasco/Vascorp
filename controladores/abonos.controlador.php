<?php

class ControladorAbonos{

	/*=============================================
	CREAR TIPO DE PAGO
	=============================================*/

	static public function ctrCrearAbono(){

		if(isset($_POST["nuevaDescripcion"])){

				$tabla="abonosjf";
			   	$datos = array("fecha"=>$_POST["nuevaFecha"],
                               "descripcion"=>$_POST["nuevaDescripcion"],
                               "monto"=>$_POST["nuevoMonto"],
                               "agencia"=>$_POST["nuevaAgencia"],
                               "num_ope"=>$_POST["nuevoOpe"]);

			   	$respuesta = ModeloAbonos::mdlIngresarAbono($tabla,$datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El abono ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "abonos";

									}
								})

					</script>';

				}

			

		}

    }
    

	/*=============================================
	MOSTRAR TIPO DE PAGO
	=============================================*/

	static public function ctrMostrarAbonos($item,$valor){
		$tabla="abonosjf";
		$respuesta = ModeloAbonos::mdlMostrarAbonos($tabla,$item,$valor);

		return $respuesta;

    }
    
	/*=============================================
	EDITAR TIPO DE PAGO
	=============================================*/

	static public function ctrEditarAbono(){

		if(isset($_POST["editarDescripcion"])){

				$tabla="abonosjf";
				   $datos = array("id"=>$_POST["idAbono"],
                                "fecha"=>$_POST["editarFecha"],
                                "descripcion"=>$_POST["editarDescripcion"],
                                "monto"=>$_POST["editarMonto"],
                                "agencia"=>$_POST["editarAgencia"],
                                "num_ope"=>$_POST["editarOpe"]);

			   	$respuesta = ModeloAbonos::mdlEditarAbono($tabla,$datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El abono ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "abonos";

									}
								})

					</script>';


			}
		}

    }
    
	/*=============================================
	ELIMINAR TIPO DE PAGO
	=============================================*/

	static public function ctrEliminarAbono(){

		if(isset($_GET["idAbono"])){

			$datos = $_GET["idAbono"];
			$tabla="abonosjf";
			date_default_timezone_set('America/Lima');
			$fecha = new DateTime();
			$abonos=ControladorAbonos::ctrMostrarAbonos("id",$datos);
			$usuario= $_SESSION["nombre"];
			$para      = 'notificacionesvascorp@gmail.com';
			$asunto    = 'Se elimino un abono';
			$descripcion   = 'El usuario '.$usuario.' elimino el abono '.$abonos["descripcion"];
			$de = 'From: notificacionesvascorp@gmail.com';
			if($_SESSION["correo"] == 1){
				mail($para, $asunto, $descripcion, $de);
			}
			if($_SESSION["datos"] == 1){
				$datos2= array( "usuario" => $usuario,
								"concepto" => $descripcion,
								"fecha" => $fecha->format("Y-m-d H:i:s"));
				$auditoria=ModeloUsuarios::mdlIngresarAuditoria("auditoriajf",$datos2);
			}
			
			$respuesta = ModeloAbonos::mdlEliminarAbono($tabla,$datos);
			if($respuesta == "ok"){
				
				
				echo'<script>

				swal({
					  type: "success",
					  title: "El abono ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "abonos";

								}
							})

				</script>';

			}		

		}

    }  
    
    /*=============================================
	IMPORTAR ABONOS DE BANCO
    =============================================*/
    
    static public function ctrImportarAbono(){

        if(isset($_POST["importAbono"])){
				
				include "/../vistas/reportes_excel/Excel/reader.php";
				$directorio="vistas/abonos/".$_FILES["nuevoAbono"]["name"];
				$archivo=move_uploaded_file($_FILES["nuevoAbono"]['tmp_name'], $directorio);
				$data = new Spreadsheet_Excel_Reader();
				$data->setOutputEncoding('CP1251');
				$data->read("vistas/abonos/".$_FILES["nuevoAbono"]["name"]);
				$con=ControladorUsuarios::ctrMostrarConexiones("id",1);
				$conexion = mysql_connect($con["ip"], $con["user"], $con["pwd"]) or die("No se pudo conectar: " . mysql_error());
				mysql_select_db($con["db"], $conexion);
				for ($i = 6; $i <= $data->sheets[0]['numRows']; $i++) {
					for ($j = 1; $j <= 1; $j++) {
                        $fecha=$data->sheets[0]['cells'][$i][1];
                        $descripcion=$data->sheets[0]['cells'][$i][3];
                        $monto=$data->sheets[0]['cells'][$i][4];
						$montoConv=str_replace(",","",$monto);
                        $agencia=$data->sheets[0]['cells'][$i][6];
                        $operacion=$data->sheets[0]['cells'][$i][7];
						
						$sqlInsertar = mysql_query("INSERT INTO abonosjf (fecha,descripcion,monto,agencia,num_ope)  values('".substr($fecha,6,4)."-".substr($fecha,3,2)."-".substr($fecha,0,2)."','".$descripcion."',".$montoConv.",'".$agencia."','".$operacion."')");
					}
				}
				echo'<script>

				swal({
					type: "success",
					title: "Las abonos han sido importados correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result){
								if (result.value) {

								window.location = "abonos";

								}
							})

				</script>';
				
		}
	}

}
