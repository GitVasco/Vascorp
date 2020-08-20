<?php

class ControladorAsistencias{

	/*=============================================
	CREAR AsistenciaS
	=============================================*/

	static public function ctrCrearAsistencia(){

        $tabla="trabajadorjf";
        $item=null;
		$valor=null;
		$fecha=date("Y-m-d H:m:s");
		$validar_fecha=date("l");	
		$rpta_trabajador = ModeloTrabajador::mdlMostrarTrabajador($tabla,$item,$valor);
        foreach ($rpta_trabajador as $key => $value) {
			if($value["estado"]=="Activo"){
				
				$tabla2="asistenciasjf";
				if($validar_fecha=="Saturday"){
					$datos = array("fecha"=>$fecha,
							"minutos"=>255,
							"id_trabajador"=>$value["cod_tra"]);
				  	$respuesta=ModeloAsistencias::mdlIngresarAsistencia2($tabla2,$datos);
				}else{
				$datos = array("fecha"=>$fecha,
						"id_trabajador"=>$value["cod_tra"]);
				$respuesta=ModeloAsistencias::mdlIngresarAsistencia($tabla2,$datos);
				}
				   
			}
		}

		
		
        if($respuesta == "ok"){

            echo'<script>

            swal({
                    type: "success",
                    title: "La asistencia ha sido registrada correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                            if (result.value) {

                            window.location = "asistencia";

                            }
                        })

            </script>';

        }

    }

	/*=============================================
	MOSTRAR AsistenciaS
	=============================================*/

	static public function ctrMostrarAsistencias($item, $valor){

		$tabla = "asistenciasjf";

		$respuesta = ModeloAsistencias::mdlMostrarAsistencias($tabla, $item, $valor);

		return $respuesta;
	
	}    

	/*=============================================
	MOSTRAR Presente
	=============================================*/

	static public function ctrMostrarPresente(){

		$tabla = "asistenciasjf";

		$respuesta = ModeloAsistencias::mdlMostrarPresente($tabla);

		return $respuesta;
	
	}    


	/*=============================================
	EDITAR Asistencia
	=============================================*/

	static public function ctrEditarAsistencia(){

		if(isset($_POST["editarMinutos"])){
			$tabla = "asistenciasjf";

			$datos = array("minutos"=>$_POST["editarMinutos"],
							"id"=>$_POST["idAsistencia"]);

			$respuesta = ModeloAsistencias::mdlEditarAsistencia($tabla, $datos);
			$tabla2 = "asistencia_parajf";
			$listaTiempos=$_POST["cantidad"];
			for ($i=0; $i < $listaTiempos; $i++){ 
				$datos2 = array("id"=>$_POST["idDetalle".$i],
							"tiempo_para"=>$_POST["editarTiempoParas".$i],
							"id_asistencia"=>$_POST["idAsistencia"]);
				$respuesta2=ModeloAsistencias::mdlEditarAsistenciaPara($tabla2,$datos2);
			}

			
			if($respuesta == "ok"){

				echo'<script>

				swal({
						type: "success",
						title: "La asistencia ha sido cambiada correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
								if (result.value) {

								window.location = "asistencia";

								}
							})

				</script>';

			}
		}

	}

	/*=============================================
	EDITAR NUEVA PARA
	=============================================*/

	static public function ctrEditarPara(){

		if(isset($_POST["editarMinutos3"])){
			$tabla = "asistenciasjf";

			$datos = array("minutos"=>$_POST["editarMinutos3"],
							"id"=>$_POST["idAsistencia3"]);

			$respuesta = ModeloAsistencias::mdlEditarAsistencia($tabla, $datos);
			$tabla2 = "asistencia_parajf";

			$datos2 = array("id_para"=>$_POST["editarPara3"],
							"tiempo_para"=>$_POST["editarTiempoPara3"],
							"id_asistencia"=>$_POST["idAsistencia3"]);

			$respuesta2=ModeloAsistencias::mdlIngresarAsistenciaPara($tabla2,$datos2);

			if($respuesta == "ok"){

				echo'<script>

				swal({
						type: "success",
						title: "La asistencia ha sido cambiada correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
								if (result.value) {

								window.location = "asistencia";

								}
							})

				</script>';

			}
		}

	}

	
	/*=============================================
	EDITAR Asistencia
	=============================================*/

	static public function ctrEditarExtra(){

		if(isset($_POST["editarMinutos2"])){
			$tabla = "asistenciasjf";

			$datos = array("minutos"=>$_POST["editarMinutos2"],
							"horas_extras"=>$_POST["editarExtras"],
							"id"=>$_POST["idAsistencia2"]);

			$respuesta = ModeloAsistencias::mdlEditarExtra($tabla, $datos);
			if($respuesta == "ok"){

				echo'<script>

				swal({
						type: "success",
						title: "La asistencia ha sido cambiada correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
								if (result.value) {

								window.location = "asistencia";

								}
							})

				</script>';

			}
		}

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasAsistencias($fechaInicial, $fechaFinal){

		$tabla = "asistenciasjf";

		$respuesta = ModeloAsistencias::mdlRangoFechasAsistencias($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}
}










    

