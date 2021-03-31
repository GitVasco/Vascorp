<?php

require_once "../controladores/facturacion.controlador.php";
require_once "../modelos/facturacion.modelo.php";
require_once "../modelos/cuentas.modelo.php";


class AjaxFacturacion{
    
    /*=============================================
    CREAR DOCUMENTO DE VENTA
    =============================================*/	
      public $datosVenta;
      public function ajaxCrearVentaNota(){
        $valor = $this->datosVenta;
        $datos = json_decode($valor);
        foreach ($datos->{"datosCuenta"} as  $value) {
          $doc = $value->{"tipo_venta"};
          $cta = $value->{"num_cta"};
          $cli = $value->{"cliente"};
          $vend = $value->{"vendedor"};
          $neto = $value->{"neto"};
          $igv = $value->{"igv"};
          $monto = $value->{"monto"};
          $fecha = $value->{"fecha"};
          $tipo_doc = $value->{"tip_doc_venta"};
          $origen_venta = $value->{"origen_venta"};
          $user = $value->{"usuario"};
          $arregloVenta = array("tipo"=>$doc,
                                "documento"=>$cta,
                                "neto"=>$neto,
                                "igv"=>$igv,
                                "total"=>$monto,
                                "cliente"=>$cli,
                                "vendedor"=>$vend,
                                "fecha"=>$fecha,
                                "tipo_documento"=>$tipo_doc,
                                "doc_origen"=>$origen_venta,
                                "usuario"=>$user);
          
          $respuesta = ModeloFacturacion::mdlRegistrarVentaNota($arregloVenta);
          if($tipo_doc == 'NC'){
            $aumento = ModeloCuentas::mdlActualizarNotaSerie("nota_credito","serie_nc",substr($cta,0,4));
          }else{
            $aumento = ModeloCuentas::mdlActualizarNotaSerie("nota_debito","serie_nd",substr($cta,0,4));
          }
          
        }
    
        echo $respuesta;
    
      }

      /*=============================================
      VALIDAR DOCUMENTO DE VENTA EN CREDITO
      =============================================*/	
      public $documentoCredito;
      public function ajaxValidarDocumentoCredito(){
        
        $valor=$this->documentoCredito;
        $tipo="E05";
        $estado="FACTURADO";
        $respuesta=ControladorFacturacion::ctrMostrarTablas($tipo,$estado,$valor);
        echo json_encode($respuesta);
      }
    
      /*=============================================
      VALIDAR DOCUMENTO DE VENTA EN DEBITO
      =============================================*/	
      public $documentoDebito;
      public function ajaxValidarDocumentoDebito(){
        
        $valor=$this->documentoDebito;
        $tipo="E23";
        $estado="FACTURADO";
        $respuesta=ControladorFacturacion::ctrMostrarTablas($tipo,$estado,$valor);
        echo json_encode($respuesta);
      }
    
      /*=============================================
      EDITAR DOCUMENTO DE VENTA
      =============================================*/	
      public $datosVenta2;
      public function ajaxEditarVentaNota(){
        $valor = $this->datosVenta2;
        $datos = json_decode($valor);
        foreach ($datos->{"datosCuenta"} as  $value) {
          $doc = $value->{"tipo_venta"};
          $cta = $value->{"num_cta"};
          $cli = $value->{"cliente"};
          $vend = $value->{"vendedor"};
          $neto = $value->{"neto"};
          $igv = $value->{"igv"};
          $monto = $value->{"monto"};
          $fecha = $value->{"fecha"};
          $origen_venta = $value->{"origen_venta"};
          $user = $value->{"usuario"};
          $arregloVenta = array("tipo"=>$doc,
                                "documento"=>$cta,
                                "neto"=>$neto,
                                "igv"=>$igv,
                                "total"=>$monto,
                                "cliente"=>$cli,
                                "vendedor"=>$vend,
                                "fecha"=>$fecha,
                                "doc_origen"=>$origen_venta,
                                "usuario"=>$user);
          
        $respuesta = ModeloFacturacion::mdlEditarVentaNota($arregloVenta);
        }
        
    
        echo $respuesta;
    
      }

    }
    

  /*=============================================
    CREAR VENTA
    =============================================*/	
    if(isset($_POST["jsonCuenta"])){
      
      $crearVenta = new AjaxFacturacion();
      $crearVenta -> datosVenta = $_POST["jsonCuenta"];
      $crearVenta -> ajaxCrearVentaNota();
  }


    /*=============================================
    VALIDAR VENTA CREDITO
    =============================================*/	
    if(isset($_POST["documentoCredito"])){
        $validarDocumentoCredito=new AjaxFacturacion();
        $validarDocumentoCredito->documentoCredito=$_POST["documentoCredito"];
        $validarDocumentoCredito->ajaxValidarDocumentoCredito();
    }

    /*=============================================
    VALIDAR VENTA DEBITO
    =============================================*/	
    if(isset($_POST["documentoDebito"])){
        $validarDocumentoDebito=new AjaxFacturacion();
        $validarDocumentoDebito->documentoDebito=$_POST["documentoDebito"];
        $validarDocumentoDebito->ajaxValidarDocumentoDebito();
    }
    
  /*=============================================
    EDITAR VENTA
    =============================================*/	
    if(isset($_POST["jsonCuenta2"])){
      
      $editarVenta = new AjaxFacturacion();
      $editarVenta -> datosVenta2 = $_POST["jsonCuenta2"];
      $editarVenta -> ajaxEditarVentaNota();
  }