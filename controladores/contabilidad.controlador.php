<?php

class ControladorContabilidad{

    static public function ctrGenerarVentasSiscont(){
        
        if(isset($_POST["inicioSiscont"])){

            #var_dump($_POST["inicioSiscont"]);

            $fechaInicio = $_POST["inicioSiscont"];
            $fechaFin = $_POST["finSiscont"];

            $añoI = date("Y", strtotime($fechaInicio));
            $mesI = date("m", strtotime($fechaInicio));

            $fi = str_replace("-", "",$fechaInicio);
            $ff = str_replace("-", "",$fechaFin);

            $nomar = $fi.$ff;
            #var_dump($nomar);

            $ruta = "vistas/contabilidad/ventas/V$fi$ff.txt";
            #var_dump($ruta);

            $archivo = fopen($ruta, "w");

            $ventas = ModeloContabilidad::mdlVentasConfiguradas($fechaInicio, $fechaFin);
            $voucher = ModeloContabilidad::mdlVoucherSiscont($añoI, $mesI);
            #var_dump($ventas);

            $corr = $voucher["correlativo"];

            foreach($ventas as $key => $value){

                $corr++;

                $documento = ModeloContabilidad::mdlVentasSiscont($value["tipo"], $value["documento"]);

                foreach($documento as $key => $value2){

                    $origen     = str_pad($value2["origen"], 2);
                    $voucher    = str_pad($corr, 5 , '0', STR_PAD_LEFT);
                    $fecha      = str_pad($value2["fecha"], 8);
                    $cuenta     = str_pad($value2["cuenta"],10);
                    $debe       = str_pad($value2["debe"], 12 , '0', STR_PAD_LEFT);
                    $haber      = str_pad($value2["haber"], 12 , '0', STR_PAD_LEFT);
                    $moneda     = str_pad($value2["moneda"], 1);
                    $tc         = str_pad($value2["tipo_cambio"], 10 , '0', STR_PAD_LEFT);
                    $doc        = str_pad($value2["tipo_doc"], 2);
                    $numero     = str_pad($value2["documentoA"], 40);
                    $fechad     = str_pad($value2["fecha_emi"], 8);
                    $fechav     = str_pad($value2["fecha_ven"], 8);
                    $codigo     = str_pad($value2["doc_cli"], 15);
                    $cc         = str_pad(" ", 10);
                    $fe         = str_pad(" ", 4);
                    $pre        = str_pad(" ", 10); 
                    $mpago      = str_pad($value2["mpago"], 3);
                    $glosa      = str_pad($value2["glosa"], 60);
                    $rnumero    = str_pad(" ", 40);
                    $rtdoc      = str_pad(" ", 2);
                    $rfecha     = str_pad(" ", 8);
                    $snumero    = str_pad(" ", 40);
                    $sfecha     = str_pad(" ", 8);
                    $tl         = str_pad(" ", 1);
                    $neto       = str_pad("0.00", 12, '0', STR_PAD_LEFT);
                    $neto2      = str_pad("0.00", 12, '0', STR_PAD_LEFT);
                    $neto3      = str_pad("0.00", 12, '0', STR_PAD_LEFT);
                    $neto4      = str_pad("0.00", 12, '0', STR_PAD_LEFT);
                    $igv        = str_pad("0.00", 12, '0', STR_PAD_LEFT);
                    $neto5      = str_pad("0.00", 12, '0', STR_PAD_LEFT);
                    $neto6      = str_pad("0.00", 12, '0', STR_PAD_LEFT);
                    $neto7      = str_pad("0.00", 12, '0', STR_PAD_LEFT);
                    $neto8      = str_pad("0.00", 12, '0', STR_PAD_LEFT);
                    $neto9      = str_pad("0.00", 12, '0', STR_PAD_LEFT);
                    $ruc        = str_pad($value2["doc_cli"], 15);
                    $tipo       = str_pad($value2["tip_cli"], 1);
                    $r5         = str_pad(str_replace("Ñ", "N",$value2["nom_cliente"]), 60);
                    $ape1       = str_pad(str_replace("Ñ", "N",$value2["ape_paterno"]), 20);
                    $ape2       = str_pad(str_replace("Ñ", "N",$value2["ape_materno"]), 20);
                    $nombre     = str_pad(str_replace("Ñ", "N",$value2["nombres"]), 20);
                    $tdoi       = str_pad($value2["tipo_documento"], 1);
                    $rnumdes    = str_pad(" ", 1);
                    $rcodtasa   = str_pad(" ", 5);
                    $rindret    = str_pad(" ", 1);
                    $rmonto     = str_pad("0.00", 12, '0', STR_PAD_LEFT);
                    $rigv       = str_pad("0.00", 12, '0', STR_PAD_LEFT);
                    $tbien      = str_pad(" ", 1);


                fwrite($archivo,    $origen.
                                    $voucher.
                                    $fecha.
                                    $cuenta.
                                    $debe.
                                    $haber.
                                    $moneda.
                                    $tc.
                                    $doc.
                                    $numero.
                                    $fechad.
                                    $fechav.
                                    $codigo.
                                    $cc.
                                    $fe.
                                    $pre.
                                    $mpago.
                                    $glosa.
                                    $rnumero.
                                    $rtdoc.
                                    $rfecha.
                                    $snumero.
                                    $sfecha.
                                    $tl.
                                    $neto.
                                    $neto2.
                                    $neto3.
                                    $neto4.
                                    $igv.
                                    $neto5.
                                    $neto6.
                                    $neto7.
                                    $neto8.
                                    $neto9.
                                    $ruc.
                                    $tipo.
                                    $r5.
                                    $ape1.
                                    $ape2.
                                    $nombre.
                                    $tdoi.
                                    $rnumdes.
                                    $rcodtasa.
                                    $rindret.
                                    $rmonto.
                                    $rigv.
                                    $tbien.
                                    PHP_EOL);
                
                }

            }

            fclose($archivo); 

            $origen = 'c:/xampp/htdocs/vascorp/vistas/contabilidad/ventas/V'.$nomar.'.txt';
                
            $destino = '//Sistemas-2/d/contabilidad/ventas/V'.$nomar.'.txt';           
            
            copy($origen, $destino);

            $rutaBat = "vistas/contabilidad/ventas/VB$fi$ff.bat";
            $archivoBat = fopen($rutaBat, "w");

            $nombreEmpresa = "VASCO";

            fwrite($archivoBat, "MSISCONT.EXE ".$nombreEmpresa." V".$nomar.".txt".PHP_EOL);
            fclose($archivoBat); 
            
            $origen2 = 'c:/xampp/htdocs/vascorp/vistas/contabilidad/ventas/VB'.$nomar.'.bat';
            $destino2 = '//Sistemas-2/d/contabilidad/ventas/VB'.$nomar.'.bat';  
            copy($origen2, $destino2);

            #var_dump($corr);

            $correlativo = ModeloContabilidad::mdlActualizarCorrelativo($añoI, $mesI, $corr);
            var_dump($correlativo);

            if($correlativo == "ok"){

                echo'<script>

                swal({
                    type: "success",
                    title: "Se genero el archivo correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    }).then(function(result){
                        if (result.value) {

                        window.location = "procesar-ce";

                        }
                    })
    
                </script>';                

            }
            
        }

    }

}