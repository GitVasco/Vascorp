<?php

class ControladorEvaluacion{

    static public function ctrVerEvaluacion($modelo){


        $respuesta = ModeloEvaluacion::mdlVerEvaluacion($modelo);

		return $respuesta;

    }

    static public function ctrVerEvaluacionDetalle($modelo, $fecha){


        $respuesta = ModeloEvaluacion::mdlVerEvaluacionDetalle($modelo, $fecha);

		return $respuesta;

    }    

    static public function ctrVerFechaDetalle($modelo){


        $respuesta = ModeloEvaluacion::mdlVerFechaDetalle($modelo);

		return $respuesta;

    }     

    static public function ctrCrearEvaluaciones(){

        if(isset($_POST["modelo"])){
            
            //*logos y color
            switch ($_POST["nombreArea"]) {

                case $_POST["nombreArea"] == "Diseño":                
                    $icono = "fa fa-scissors";
                    $color = "bg-purple";
                    $peso = 15;
                    $minimo = 11.25;
                    $nota = $_POST["nota"] * $peso / 100;
                    break;

                case $_POST["nombreArea"] == "Logística":                
                    $icono = "fa fa-truck";
                    $color = "bg-yellow";
                    $peso = 20;
                    $minimo = 15;
                    $nota = $_POST["nota"] * $peso / 100;
                    break;
                    
                case $_POST["nombreArea"] == "Producción":                
                    $icono = "fa fa-cogs";
                    $color = "bg-red";
                    $peso = 20;
                    $minimo = 15;
                    $nota = $_POST["nota"] * $peso / 100;
                    break;
                    
                case $_POST["nombreArea"] == "Costos":                
                    $icono = "fa fa-calculator";
                    $color = "bg-blue";
                    $peso = 15;
                    $minimo = 11.25;
                    $nota = $_POST["nota"] * $peso / 100;
                    break;
                    
                case $_POST["nombreArea"] == "Ventas":                
                    $icono = "fa fa-cart-plus";
                    $color = "bg-green";
                    $peso = 15;
                    $minimo = 11.25;
                    $nota = $_POST["nota"] * $peso / 100;
                    break;
                    
                case $_POST["nombreArea"] == "Público":                
                    $icono = "fa fa-users";
                    $color = "bg-maroon";
                    $peso = 15;
                    $minimo = 11.25;
                    $nota = $_POST["nota"] * $peso / 100;
                    break;                
                
                default:
                    var_dump("prueba");
                    break;
            }

            date_default_timezone_set('America/Lima');
            $usureg = $_SESSION["nombre"];
			$pcreg= gethostbyaddr($_SERVER['REMOTE_ADDR']);  
			$fecreg = new DateTime();

            if(isset($_FILES["pdf"]["tmp_name"])){

                var_dump("lleno");

            }else{
                var_dump("vacio");
            }

            $datos = array( 'modelo'            => $_POST["modelo"], 
                            'usuario'           => $_POST["nombreUsuario"],
                            'nombre_area'       => $_POST["nombreArea"],
                            'icono_area'        => $icono,
                            'color_area'        => $color,
                            'peso_area'         => $peso,
                            'minimo_area'       => $minimo,
                            'fecha_creacion'    => $fecreg->format("Y-m-d H:i:s"),
                            'comentario'        => $_POST["evaluacion"],
                            'puntuacion'        => $nota,
                            'pdf'               => null,
                            'excel'             => null,
                            'imagen'            => null,
                            'fecha_propuesta'   => $_POST["fechaPropuesta"],
                            'tipo_evaluacion'   => $_POST["tipoEvaluacion"],
                            'colores'           => $_POST["colores"],
                            'usureg'            => $usureg,
                            'fecreg'            => $fecreg->format("Y-m-d H:i:s"),
                            'pcreg'             => $pcreg
        
            );
            var_dump($datos);

        }else{

            var_dump("no llego");

        }

    }

}
