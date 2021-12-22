<?php

class ControladorMantenimiento{

    //*MOSTRAR EQUIPOS
    static public function ctrMostrarEquipos($valor){

        $respuesta = ModeloMantenimiento::mdlMostrarEquipos($valor);

		return $respuesta;

    }

    //*TRAER EL UTIMO CODIGO 
    static public function ctrTraerUltCod($valor){

        $respuesta = ModeloMantenimiento::mdlTraerUltCod($valor);

		return $respuesta;

    }    

    //*CREAR MAQUINA
    static public function ctrCrearMaquina(){

        if(isset($_POST["nuevoCodTipo"])){

            #var_dump($_POST["nuevoCodTipo"]);

            # traemos la fecha y la pc
            date_default_timezone_set('America/Lima');
            $usureg =$_SESSION["nombre"];
            $pcreg = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $fecreg = new DateTime();
            

            $datos = array( "cod_tipo"          => $_POST["nuevoCodTipo"],
                            "cod_tip_maquina"   => $_POST["nuevoTipMaq"],
                            "descripcion"       => $_POST["nuevaDescripcion"],
                            "cod_ubicacion"     => $_POST["nuevaUbicacion"],
                            "cod_marca_equi"    => $_POST["nuevaMarcaMaq"],
                            "modelo_equipo"     => $_POST["nuevoModeloMaq"],
                            "serie_equipo"      => $_POST["nuevaSerieMaq"],
                            "tipo_motor"        => $_POST["nuevoTipoMotor"],
                            "cod_marca_motor"   => $_POST["nuevaMarcaMaq"],
                            "modelo_motor"      => $_POST["nuevoModeloMotor"],
                            "serie_motor"       => $_POST["nuevoSerieMotor"],
                            "cod_marca_caja"    => $_POST["nuevaMarcaCaja"],
                            "modelo_caja"       => $_POST["nuevoModeloCaja"],
                            "serie_caja"        => $_POST["nuevaSerieCaja"],
                            "documento"         => $_POST["nuevoDocumento"],
                            "ruc"               => $_POST["nuevoRuc"],
                            "fecha_emision"      => $_POST["nuevoFecEmision"],
                            "estado"            => $_POST["nuevoEstado"],
                            "observaciones"     => $_POST["nuevaObservacion"],
                            "fec_ult_mant"      => $_POST["nuevoUltimoMantenimiento"],
                            "fec_pro_mant"      => $_POST["nuevoProgMantenimiento"],
                            "usureg"            => $usureg,
                            "pcreg"             => $pcreg,
                            "fecreg"            => $fecreg->format("Y-m-d H:i:s"));

            var_dump($datos);
            $respuesta = ModeloMantenimiento::mdlCrearMaquina($datos);
            #var_dump($respuesta);

            if($respuesta == "ok"){

                if($_POST["nuevoProgMantenimiento"] != null){

                    $datosCalendario = array(   "tipo"          => 'Mantenimiento',
                                                "titulo"        => 'Mant. - '.$_POST["nuevoCodTipo"],
                                                "cod_interno"   => $_POST["nuevoCodTipo"],
                                                "inicio"        => $_POST["nuevoProgMantenimiento"],
                                                "fin"           => '',
                                                "allday"        => '',
                                                "dirurl"        => 'index.php?ruta=equipos',
                                                "indicaciones"  => 'Mant. Preventivo',
                                                "estado"        => 'Pendiente',
                                                "usureg"        => $usureg,
                                                "pcreg"         => $pcreg,
                                                "fecreg"        => $fecreg->format("Y-m-d H:i:s"));
    
                    #var_dump($datosCalendario);
                    $respuestaCalendario = ModeloMantenimiento::mdlCrearCalendario($datosCalendario);
                    #var_dump($respuestaCalendario);

                    $interno = ControladorMantenimiento::ctrMostrarCorrelativo();

                    $datosMantenimiento = array("cod_interno"   => $interno["correlativo"],
                                                "tipo_mante"    => 'PREVENTIVO',
                                                "mante_inicio"  => $_POST["nuevoProgMantenimiento"],
                                                "mante_fin"     => '',
                                                "cod_maquina"   => $_POST["nuevoCodTipo"],
                                                "cod_ubi"       => $_POST["nuevaUbicacion"],
                                                "responsable"   => '',
                                                "items"         => 0,
                                                "operario"      => '',
                                                "observaciones" => '',
                                                "estado"        => 'NO HECHO',
                                                "usureg"        => $usureg,
                                                "pcreg"         => $pcreg,
                                                "fecreg"        => $fecreg->format("Y-m-d H:i:s"));

                    #var_dump($datosMantenimiento);
                    $respuestaMantenimiento = ModeloMantenimiento::mdlCrearMantenimiento($datosMantenimiento);
                    #var_dump($respuestaMantenimiento);
    
                }

                echo'<script>

                swal({
    
                    type: "success",
                    title: "Se creo la nueva maquina",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
    
                        if (result.value) {
    
                        window.location = "equipos";
    
                        }
    
                    })
    
                </script>';                


            }else{

                echo'<script>

                swal({
    
                    type: "error",
                    title: "No se creo la nueva maquina",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
    
                        if (result.value) {
    
                        window.location = "equipos";
    
                        }
    
                    })
    
                </script>';

            }

        }

    }
    
    //*MOSTRAR CALENDARIO
    static public function ctrMostrarCalendario($valor){

        $respuesta = ModeloMantenimiento::mdlMostrarCalendario($valor);

		return $respuesta;

    }    

    //*EDITAR MAQUINA
    static public function ctrEditarMaquina(){

        if(isset($_POST["editarIdEquipo"])){

            #var_dump($_POST["editarIdEquipo"]);

            # traemos la fecha y la pc
            date_default_timezone_set('America/Lima');
            $usumod =$_SESSION["nombre"];
            $pcmod = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $fecmod = new DateTime();
            

            $datos = array( "id"                => $_POST["editarIdEquipo"],
                            "descripcion"       => $_POST["editarDescripcion"],
                            "cod_ubicacion"     => $_POST["editarUbicacion"],
                            "cod_marca_equi"    => $_POST["editarMarcaMaq"],
                            "modelo_equipo"     => $_POST["editarModeloMaq"],
                            "serie_equipo"      => $_POST["editarSerieMaq"],
                            "tipo_motor"        => $_POST["editarTipoMotor"],
                            "cod_marca_motor"   => $_POST["editarMarcaMaq"],
                            "modelo_motor"      => $_POST["editarModeloMotor"],
                            "serie_motor"       => $_POST["editarSerieMotor"],
                            "cod_marca_caja"    => $_POST["editarMarcaCaja"],
                            "modelo_caja"       => $_POST["editarModeloCaja"],
                            "serie_caja"        => $_POST["editarSerieCaja"],
                            "documento"         => $_POST["editarDocumento"],
                            "ruc"               => $_POST["editarRuc"],
                            "fecha_emision"     => $_POST["editarFecEmision"],
                            "estado"            => $_POST["editarEstado"],
                            "observaciones"     => $_POST["editarObservacion"],
                            "fec_ult_mant"      => $_POST["editarUltimoMantenimiento"],
                            "fec_pro_mant"      => $_POST["editarProgMantenimiento"],
                            "usumod"            => $usumod,
                            "pcmod"             => $pcmod,
                            "fecmod"            => $fecmod->format("Y-m-d H:i:s"));            

            #var_dump($datos);
            $respuesta = ModeloMantenimiento::mdlEditarMaquina($datos);
            #var_dump($respuesta);
            
            $calendario = ModeloMantenimiento::mdlMostrarCalendarioPendiente($_POST["editarCodTipo"]);
            #var_dump($calendario);

            if($_POST["editarProgMantenimiento"] != $calendario["inicio"]){

                $datosCalendario = array(   "cod_interno"   => $_POST["editarCodTipo"],
                                            "inicio"        => $_POST["editarProgMantenimiento"],
                                            "usumod"        => $usumod,
                                            "pcmod"         => $pcmod,
                                            "fecmod"        => $fecmod->format("Y-m-d H:i:s"));

                $respuestaProg = ModeloMantenimiento::mdlActualizarCalendarioMaquina($datosCalendario);
                #var_dump($respuestaProg);

                $datosMantenimiento = array("cod_interno"   => $_POST["editarCodTipo"],
                                            "inicio"        => $_POST["editarProgMantenimiento"],
                                            "usumod"        => $usumod,
                                            "pcmod"         => $pcmod,
                                            "fecmod"        => $fecmod->format("Y-m-d H:i:s"));

                var_dump($datosMantenimiento);
                $respuestaProg = ModeloMantenimiento::mdlActualizarCalendarioMantenimiento($datosMantenimiento);
                var_dump($respuestaProg);                

            }

            if($respuesta == "ok"){

                echo'<script>

                swal({
    
                    type: "success",
                    title: "Se edito la nueva maquina",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
    
                        if (result.value) {
    
                        window.location = "equipos";
    
                        }
    
                    })
    
                </script>';

            }else{

                echo'<script>

                swal({
    
                    type: "error",
                    title: "No se edito la nueva maquina",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
    
                        if (result.value) {
    
                        window.location = "equipos";
    
                        }
    
                    })
    
                </script>';

            }          

        }

    }      

    //*MOSTRAR MANTENIMIENTO
    static public function ctrMostrarMantenimiento($valor){

        $respuesta = ModeloMantenimiento::mdlMostrarMantenimiento($valor);

		return $respuesta;

    }  

    //*MOSTRAR MANTENIMIENTO DETALLE
    static public function ctrMostrarMantenimientoDetalle($valor){

        $respuesta = ModeloMantenimiento::mdlMostrarMantenimientoDetalle($valor);

		return $respuesta;

    }     

    //*MOSTRAR MANTENIMIENTO REPUESTOS
    static public function ctrMostrarMantenimientoRepuestos($valor){

        $respuesta = ModeloMantenimiento::mdlMostrarMantenimientoRepuestos($valor);

		return $respuesta;

    }
    
    //*MOSTRAR CORRELATIVO MANTENIMIENTO
    static public function ctrMostrarCorrelativo(){

        $respuesta = ModeloMantenimiento::mdlMostrarCorrelativo();

		return $respuesta;

    }      
    
    //*EDITAR MAQUINA
    static public function ctrCrearMantenimiento(){

        if(isset($_POST["nuevoId"])){

            #var_dump($_POST["nuevoId"]);

            # traemos la fecha y la pc
            date_default_timezone_set('America/Lima');
            $usureg =$_SESSION["nombre"];
            $pcreg = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $fecreg = new DateTime();

            if($_POST["nuevoTipo"] == "Preventivo"){

                $fechaInicio = new DateTime($_POST["nuevoInicio"]);
                $fechaIni = $fechaInicio->format("Y-m-d");
            
            }else{
                
                $fechaIni = $_POST["nuevoInicio"];

            }

            $datos = array( "cod_interno"   => $_POST["nuevoId"],
                            "tipo_mante"    => $_POST["nuevoTipo"],
                            "mante_inicio"  => $fechaIni,
                            "mante_fin"     => $_POST["nuevoFin"],
                            "cod_maquina"   => $_POST["nuevaMaquina"],
                            "cod_ubi"       => $_POST["nuevaUbicacion"],
                            "responsable"   => $_POST["nuevoResponsable"],
                            "items"         => 0,
                            "operario"      => $_POST["nuevoOperario"],
                            "observaciones" => $_POST["nuevaObservacion"],
                            "estado"        => $_POST["nuevoEstado"],                            
                            "usureg"        => $usureg,
                            "pcreg"         => $pcreg,
                            "fecreg"        => $fecreg->format("Y-m-d H:i:s"));

            #var_dump($datos);
            $respuesta = ModeloMantenimiento::mdlCrearMantenimiento($datos);
            #var_dump($respuesta);

            if($_POST["nuevoTipo"] == "Preventivo"){

                $fechaInicio = new DateTime($_POST["nuevoInicio"]);

                $datosCalendario = array(   "tipo"          => 'Mantenimiento',
                                            "titulo"        => 'Mant. - '.$_POST["nuevaMaquina"],
                                            "cod_interno"   => $_POST["nuevaMaquina"],
                                            "inicio"        => $fechaInicio->format("Y-m-d"),
                                            "fin"           => '',
                                            "allday"        => '',
                                            "dirurl"        => 'index.php?ruta=equipos',
                                            "indicaciones"  => 'Mant. Preventivo',
                                            "estado"        => 'Pendiente',
                                            "usureg"        => $usureg,
                                            "pcreg"         => $pcreg,
                                            "fecreg"        => $fecreg->format("Y-m-d H:i:s"));

                #var_dump($datosCalendario);
                $respuestaCalendario = ModeloMantenimiento::mdlCrearCalendario($datosCalendario);
                #var_dump($respuestaCalendario);

                $datosEquipo = array(   "fec_pro_mant"  => $fechaInicio->format("Y-m-d"),
                                        "cod_tipo"      => $_POST["nuevaMaquina"],
                                        "usureg"        => $usureg,
                                        "pcreg"         => $pcreg,
                                        "fecreg"        => $fecreg->format("Y-m-d H:i:s"));

                #var_dump($datosEquipo);
                $respuestaEquipo = ModeloMantenimiento::mdlActualizarEquipoMantProg($datosEquipo);
                #var_dump($respuestaEquipo);


            }else{

                $fechaInicio = new DateTime($_POST["nuevoInicio"]);

                $datosEquipo = array(   "fec_ult_mant"  => $fechaInicio->format("Y-m-d"),
                                        "cod_tipo"      => $_POST["nuevaMaquina"],
                                        "usureg"        => $usureg,
                                        "pcreg"         => $pcreg,
                                        "fecreg"        => $fecreg->format("Y-m-d H:i:s"));

                #var_dump($datosEquipo);
                $respuestaEquipo = ModeloMantenimiento::mdlActualizarEquipoMantUlt($datosEquipo);
                #var_dump($respuestaEquipo);

            }

            if($respuesta == "ok"){

                ModeloMantenimiento::mdlActualizarManteTotales($_POST["nuevoId"]);

                echo'<script>

                swal({
    
                    type: "success",
                    title: "Se creo el mantenimiento",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
    
                        if (result.value) {
    
                        window.location = "mantenimiento";
    
                        }
    
                    })
    
                </script>';  

            }else{

                echo'<script>

                swal({
    
                    type: "error",
                    title: "No se creo el mantenimiento",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
    
                        if (result.value) {
    
                        window.location = "mantenimiento";
    
                        }
    
                    })
    
                </script>';

            }


        }
        
    }

    //*TRAER UBICACION
    static public function ctrTraerUbicacion($valor){

        $respuesta = ModeloMantenimiento::mdlTraerUbicacion($valor);

		return $respuesta;

    }  
    
}