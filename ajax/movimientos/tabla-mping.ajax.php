<?php

require_once '../../controladores/movimientos.controlador.php';
require_once '../../modelos/movimientos.modelo.php';

class AjaxTablaMpIng{
	// Mostramos la tabla de Vtauctos
	public function mostrarTablaMpIng(){

		$movimientos=ControladorMovimientos::ctrMovIngMp($_GET["lineaMpIng"]);

		if(count($movimientos)>0){

			$datosJson='{

				"data":[';

					for($i=0;$i<count($movimientos);$i++){

						$descripcion = str_replace('"','',$movimientos[$i]["descripcion"]);

                        /* 
						TODO: TOTALES
						*/
						if($movimientos[$i]["codigofabrica"] == "TOTAL"){

							$total = "<b>".$movimientos[$i]["codigofabrica"]."</b>";
			
							
						}else{
			
							$total = $movimientos[$i]["codigofabrica"];
			
						}

						/* 
						*eliminar ceros
						*/
						if($movimientos[$i]["1"] == "0"){

							$m1 = "";

						}else{

							$m1 = number_format($movimientos[$i]["1"],0);

						}

						if($movimientos[$i]["2"] == "0"){

							$m2 = "";

						}else{

							$m2 = number_format($movimientos[$i]["2"],0);

						}

						if($movimientos[$i]["3"] == "0"){

							$m3 = "";

						}else{

							$m3 = number_format($movimientos[$i]["3"],0);

						}

						if($movimientos[$i]["4"] == "0"){

							$m4 = "";

						}else{

							$m4 = number_format($movimientos[$i]["4"],0);

						}

						if($movimientos[$i]["5"] == "0"){

							$m5 = "";

						}else{

							$m5 = number_format($movimientos[$i]["5"],0);

						}

						if($movimientos[$i]["6"] == "0"){

							$m6 = "";

						}else{

							$m6 = number_format($movimientos[$i]["6"],0);

						}

						if($movimientos[$i]["7"] == "0"){

							$m7 = "";

						}else{

							$m7 = number_format($movimientos[$i]["7"],0);

						}

						if($movimientos[$i]["8"] == "0"){

							$m8 = "";

						}else{

							$m8 = number_format($movimientos[$i]["8"],0);

						}

						if($movimientos[$i]["9"] == "0"){

							$m9 = "";

						}else{

							$m9 = number_format($movimientos[$i]["9"],0);

						}

						if($movimientos[$i]["10"] == "0"){

							$m10 = "";

						}else{

							$m10 = number_format($movimientos[$i]["10"],0);

						}

						if($movimientos[$i]["11"] == "0"){

							$m11 = "";

						}else{

							$m11 = number_format($movimientos[$i]["11"],0);

						}

						if($movimientos[$i]["12"] == "0"){

							$m12 = "";

						}else{

							$m12 = number_format($movimientos[$i]["12"],0);

						}						
					
						$datosJson.='[

                                        "'.$movimientos[$i]["codsublinea"].'",
										"'.$total.'",
										"'.$movimientos[$i]["codpro"].'",
										"'.$descripcion.'",
										"'.$movimientos[$i]["color"].'",
										"'.$movimientos[$i]["unidad"].'",
										"'.$m1.'",
										"'.$m2.'",
										"'.$m3.'",
										"'.$m4.'",
                                        "'.$m5.'",
                                        "'.$m6.'",
                                        "'.$m7.'",
                                        "'.$m8.'",
                                        "'.$m9.'",
                                        "'.$m10.'",
                                        "'.$m11.'",
                                        "'.$m12.'",
                                        "'.number_format($movimientos[$i]["total"],2).'"
                                        

									],';
					}

					$datosJson=substr($datosJson,0,-1);
					$datosJson.=']
			}';

			echo $datosJson;

		}else{

			echo '{
				"data":[]
			}';
			return;

		}
	}
}

$movimientos=new AjaxTablaMpIng();
$movimientos->mostrarTablaMpIng();