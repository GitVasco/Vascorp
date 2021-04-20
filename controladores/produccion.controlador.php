<?php
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
class ControladorProduccion{

    /* 
    *MOSTRAR QUINCENAS
    */
    static public function ctrMostrarQuincenas($valor){

		$respuesta = ModeloProduccion::mdlMostrarQuincenas($valor);

		return $respuesta;

	}

  /* 
    *MOSTRAR AVANCES
    */
    static public function ctrMostrarAvances($inicio,$fin){

      $respuesta = ModeloProduccion::mdlMostrarAvances($inicio,$fin);
  
      return $respuesta;
  
    }

	/* 
	* CREAR QUINCENA
	*/
	static public function ctrCrearQuincenas(){

        if(isset($_POST["mes"])){

            $datos = array( "ano" => $_POST["año"],
                            "mes" => $_POST["mes"],
                            "quincena" => $_POST["quincena"],
                            "inicio" => $_POST["inicio"],
                            "fin" => $_POST["fin"],
                            "usuario" => $_POST["usuario"]);
            //var_dump($datos);

            $respuesta = ModeloProduccion::mdlCrearQuincenas($datos);
                
            if($respuesta == "ok"){

                echo'<script>

                    swal({
                          type: "success",
                          title: "La quincena ha sido guardada correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                                    if (result.value) {

                                    window.location = "quincena";

                                    }
                                })

                    </script>';

            }  


		}

    }
    
    /* 
    *EDITAR QUINCENA
    */

	static public function ctrEditarQuincenas(){

		if(isset($_POST["editarMes"])){

            $datos = array( "id" => $_POST["id"],
                            "ano" => $_POST["editarAño"],
                            "mes" => $_POST["editarMes"],
                            "quincena" => $_POST["editarQuincena"],
                            "inicio" => $_POST["editarInicio"],
                            "fin" => $_POST["editarFin"],
                            "usuario" => $_POST["editarUsuario"]);
            

            $respuesta = ModeloProduccion::mdlEditarQuincenas($datos);

            if($respuesta == "ok"){

                echo'<script>

                swal({
                      type: "success",
                      title: "La quincena ha sido cambiada correctamente",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                                if (result.value) {

                                window.location = "quincena";

                                }
                            })

                </script>';

            }

		}

    }    

    /* 
    *MOSTRAR EFICIENCIA QUINCENAL
    */
    static public function ctrMostrarEficiencia($inicio, $fin, $nquincena, $id ,$sector ){

		$respuesta = ModeloProduccion::mdlMostrarEficiencia($inicio, $fin, $nquincena, $id,$sector);

		return $respuesta;

    } 
    
    /* 
    *MOSTRAR PAGOS QUINCENAL
    */
    static public function ctrMostrarPagos($inicio, $fin, $nquincena, $id,$sector ){

		$respuesta = ModeloProduccion::mdlMostrarPagos($inicio, $fin, $nquincena,$id, $sector);

		return $respuesta;

  }     
  
	/* 
	* BORRAR ARTICULO
	*/
	static public function ctrEliminarQuincena(){

		if(isset($_GET["idQuincena"])){

      //var_dump($_GET["idQuincena"]);

			$id = $_GET["idQuincena"];

			$respuesta = ModeloProduccion::mdlEliminarQuincena($id);

			if($respuesta == "ok"){

        //var_dump($respuesta);
				
				echo'<script>

				swal({
					  type: "success",
					  title: "La quincena ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "quincena";

								}
							})

				</script>';

			}		
		}


	}	  

  static public function ctrImprimirAvance(){

    if(isset($_GET["inicioQuincena"] ) && isset($_GET["finQuincena"])){

            $inicio = $_GET["inicioQuincena"];

            $fin = $_GET["finQuincena"];
        

            $nombre_impresora = "Star BSC10"; 

            $connector = new WindowsPrintConnector($nombre_impresora);
            $printer = new Printer($connector);

            $fecha = date("d-m-Y");

            $respuesta = ControladorProduccion::ctrMostrarAvances($inicio,$fin);
            //Establecemos los datos de la empresa
            $empresa = "Corporacion Vasco S.A.C.";
            $documento = "20513613939";

            foreach ($respuesta as $key => $value) {
                
                $printer -> setFont(Printer::FONT_B);
                $printer -> setJustification(Printer::JUSTIFY_CENTER);
                $printer -> setTextSize(1, 1);
                //Activamos negrita

                $printer->setPrintLeftMargin(0); // margen 0
                $printer->setEmphasis(true);
                $printer -> text("AVANCE PAGO DE ".$inicio." AL ".$fin."\n");//Nombre de la empresa

                $printer -> text("======================================="."\n");//Dirección de la empresa
                //Quitamos negrita
                
                
                $printer -> setJustification(Printer::JUSTIFY_LEFT);

                $printer -> text("ID:".$value["id_trabajador"]."\n");

                $printer->setEmphasis(false);

                $printer -> text("Nombre:     ".$value["nombre"]."\n");

                $printer -> text("Produccion:                 ".$value["produccion"]."\n");

                $printer -> text("Sueldo:                     ".$value["sueldo"]."\n");

                $diferencia = substr($value["diferencia"],0,1);
                $tamano = strlen($value["diferencia"]);

                if($diferencia == "-"){
                  if($tamano == 7){
                    $printer -> text("Diferencia:                ".$value["diferencia"]."\n");
                  }else{
                    $printer -> text("Diferencia:                 ".$value["diferencia"]."\n");
                  }
                  

                }else{

                  $printer -> text("Incentivo:                  ".$value["incentivo"]."\n");

                }

                

                

                //Activamos negrita
                $printer->setEmphasis(true);

                $printer -> text("---------------------------------------"."\n");//Divisor Total
            
                $printer -> text("Total:                      ".$value["total"]."\n");

                
                $printer -> text("---------------------------------------"."\n");//Divisor Total

                $printer -> feed(1);
                
                $printer -> cut();
        
                }

            $printer -> close();

            echo'<script>

            swal({
                  type: "success",
                  title: "Se imprimio el avance correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                  }).then(function(result){
                            if (result.value) {

                            window.location = "quincena";

                            }
                        })

            </script>';
        }

        

        
  }

}
