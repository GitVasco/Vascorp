<?php
class ControladorAlmacenCorte{

    /* 
    * SACAR EL ULTIMO CODIGO
    */
    static public function ctrUltimoCodigoAC(){

        $respuesta = ModeloAlmacenCorte::mdlUltimoCodigoAC();

        return $respuesta;

    }

	/* 
	* MOSTRAR ARTICULOS EN ORDENES DE CORTE PARA EL ALMACEN CORTE
	*/	
	static public function ctrMostarArticulosOrdCorte(){

		$respuesta = ModeloAlmacenCorte::mdlMostarArticulosOrdCorte();

		return $respuesta;
		
    }    
    
    /* 
    * CREAR ALMACEN DE CORTE
    */
    static public function ctrCrearAlmacenCorte(){

        /* 
        todo: ver si trae datos
        */
        if( isset($_POST["nuevaAlmacenCorte"]) &&
            isset($_POST["idUsuario"]) &&
            isset($_POST["listaArticulosAC"])){

            #var_dump("nuevoAlmacenCorte", $_POST["nuevaAlmacenCorte"]);
            #var_dump("idUsuario", $_POST["idUsuario"]);
            #var_dump("listaArticulosAC", $_POST["listaArticulosAC"]);

                if($_POST["listaArticulosAC"] == ""){

                    /* 
                    ? Mostramos una alerta suave si viene vacia
                    */
                    echo '<script>
                            swal({
                                type: "error",
                                title: "Error",
                                text: "¡No se seleccionó ningún artículo. Por favor, intenteló de nuevo!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then((result)=>{
                                if(result.value){
                                    window.location="crear-almacencorte";}
                            });
                        </script>';

                }else{

                    #var_dump("listaArticulosAC", $_POST["listaArticulosAC"]);

                    /* 
                    ? Capturamos los articulos unicos y sumamos sus cantidades
                    */
                    $listArticulo = json_decode($_POST["listArticulo"], true);
                    #var_dump("listArticulo", $listArticulo);

                    /* 
                    * array on los articulos unicos sin repetir
                    */
                    $articulos_array = [];
                    foreach ($listArticulo as $valor) {

                        $articulo = $valor["articulo"];

                        if (! in_array($articulo, $articulos_array)) {

                            $articulos_array[] = $articulo;

                        }

                    }
                    #var_dump("articulos_array", $articulos_array);
                    
                    /* 
                    * crear un array con la lista unica
                    */
                    $resultado = [];
                    foreach ($articulos_array as $unico_id) {

                        $temporal = [];
                        $cantidad = 0;
                        foreach ($listArticulo as $valor) {

                            $id = $valor["articulo"];

                            if ($id === $unico_id) {

                                $temporal[] = $valor;

                            }

                        }

                        $producto = $temporal[0];

                        $producto["cantidad"] = 0;
                        foreach ($temporal as $producto_temporal) {

                            $producto["cantidad"] = $producto["cantidad"] + $producto_temporal["cantidad"];

                        }
                        // dx($producto["cantidad"]); // trace

                        // store unique productoo with updated quantity
                        $resultado[] = $producto;

                    }
                    #var_dump("resultado", $resultado);

                    /* 
                    todo: GUARDAMOS LOS TOTALES DEL CORTE
                    */
                    foreach($resultado as $value){

                        $valor = $value["articulo"];

                        $valor1 = $value["cantidad"];

                        ModeloAlmacenCorte::mdlActualizarAlmCorte($valor, $valor1);

                    }

                    /* 
                    todo: Actualizamos saldos de las Detalles de Ordenes de Corte
                    */

                    $listaArticulosAC = json_decode($_POST["listaArticulosAC"], true);
                    #var_dump("listaArticulosAC", $listaArticulosAC);

                    foreach($listaArticulosAC as $value){

                        $valor = $value["articulo"];

                        $valor1 = $value["ordencorte"];

                        $valor2 = $value["cantidad"];

                        ModeloAlmacenCorte::mdlActualizarSaldoOrdCorte($valor, $valor1, $valor2);

                    }

                    /* 
                    todo: Actualizamos saldos de las ordenes de corte
                    */
                    ModeloAlmacenCorte::mdlActualizarSaldoOrdCorteGral();

                    /* 
                    todo: Guardar cabeera de ALMACEN DE CORTE
                    */



                    
                    


                }




        }




    }





}