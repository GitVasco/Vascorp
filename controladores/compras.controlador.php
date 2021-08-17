<?php
ob_start();

class ControladorCompras{

    static public function ctrGenerarTxt(){

        if(isset($_GET["estado"])){

            $cantidad = ModeloCompras::mdlCantidadDocumentos();
            ##var_dump($cantidad);

            $cantArchivos = $cantidad["cantidad"] / 100;
            #var_dump(round($cantArchivos,0));

            if(round($cantArchivos,0) < 1){

                $redon = 1;


            }else{

                $redon = round($cantArchivos,0);

            }

            $indicador = rand(1000,9999);

            for ($i = 1; $i <= $redon; $i++) {

                $ruta = "vistas/sunat/".$indicador."-".$i.".txt";

                $contenido = $_GET["estado"];
    
                $archivo = fopen($ruta,"w");  
                
                $datos = ModeloCompras::mdlComprasSinVerificar($i);
                #var_dump(count($datos));

                foreach($datos as $key=>$value){

                    if($key < count($datos)-1){

                        fwrite($archivo,$value["sunat"]."\r\n");

                    }else{

                        fwrite($archivo,$value["sunat"]);

                    }					

                }

            }
            
            fclose($archivo);

            echo'<script>

            swal({

                type: "success",
                title: "Se genero los *.txt",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){

                    if (result.value) {

                    window.location = "compras-reg";

                    }

                })

            </script>';

        }

    }

    static public function ctrLeerTxt(){

        if(isset($_POST["imporTxt"])){

            #var_dump($_POST["imporTxt"]);
        if(empty($_FILES['archivotxt'])){

            $ruta = "vistas/sunat/leer/";
            $subir_archivo = $ruta.basename($_FILES['archivotxt']['name']);
            #var_dump($subir_archivo);

            move_uploaded_file($_FILES['archivotxt']['tmp_name'],$subir_archivo);

            $archivo = fopen($subir_archivo, "r");

            while(!feof($archivo)){

                $linea = fgets($archivo);
                $partes = explode("|",$linea);

                if($partes[6] == "ACEPTADO" || $partes[6] == "AUTORIZADO"){

                    $comprobante = "2";

                }else{

                    $comprobante = "1";

                }

                if($partes[7] == "ACTIVO"){

                    $contribuyente = "2";

                }else{

                    $contribuyente = "1";

                }      
                
                if($partes[8] == "HABIDO"){

                    $condicion = "2";

                }else{

                    $condicion = "1";

                }   

                $datos = array( "ruc"           =>  $partes[0],
                                "serie_doc"     =>  $partes[2],
                                "num_doc"       =>  $partes[3],
                                "comprobante"   =>  $comprobante,
                                "contribuyente" =>  $contribuyente,
                                "condicion"     =>  $condicion,
                                "estado"        =>  '1');
                #var_dump($datos);

                $respuesta = ModeloCompras::mdlActualizarRegCompras($datos);
                $respuesta2 = ModeloCompras::mdlActualizarDiario($datos);

            }

            #var_dump($respuesta2);

            if($respuesta == "ok" && $respuesta2 == "ok"){

                echo'<script>

                    swal({
                        
                        type: "success",
                        title: "Se actualizo correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {

                            window.location = "compras-reg";

                            }
                        })

                    </script>';

            }else{

                echo'<script>

                swal({

                    type: "error",
                    title: "¡No se puedo actualizar!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {

                        window.location = "compras-reg";

                        }
                    })

                </script>';

            }
        }else{
            echo'<script>

            swal({

                type: "error",
                title: "¡Error, debe seleccionar un archivo!",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                    if (result.value) {

                    window.location = "compras-reg";

                    }
                })

            </script>';
        }

        }

    }
    
	static public function ctrTraerCompra($ruc, $serie, $numero){

		$respuesta = ModeloCompras::mdlTraerCompra($ruc, $serie, $numero);

		return $respuesta;

	}    

}