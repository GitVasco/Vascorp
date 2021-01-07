<?php

require_once "../controladores/cuentas.controlador.php";
require_once "../modelos/cuentas.modelo.php";


class AjaxCuentas{
    /*=============================================
      EDITAR CUENTA
      =============================================*/ 
    
      public $idCuenta;
    
      public function ajaxEditarCuenta(){
        $item="id";
        $valor = $this->idCuenta;
    
        $respuesta = ControladorCuentas::ctrMostrarCuentas($item,$valor);
    
        echo json_encode($respuesta);
    
      }

      public $idCancelacion;
    
      public function ajaxEditarCancelacion(){
        $item="id";
        $valor = $this->idCancelacion;
    
        $respuesta = ModeloCuentas::mdlMostrarCancelacion("cuenta_ctejf",$item,$valor);
    
        echo json_encode($respuesta);
    
      }

      public $numCta;
    
      public function ajaxCancelarCuenta(){
        $item="num_cta";
        $valor = $this->numCta;
    
        $respuesta = ControladorCuentas::ctrMostrarCuentas($item,$valor);
    
        echo json_encode($respuesta);
    
      }
    
    }
    
    
    /*=============================================
    EDITAR CUENTA
    =============================================*/	
    if(isset($_POST["idCuenta"])){
    
        $tipoPago = new AjaxCuentas();
        $tipoPago -> idCuenta = $_POST["idCuenta"];
        $tipoPago -> ajaxEditarCuenta();
    }
    /*=============================================
    EDITAR CANCELACION
    =============================================*/	
    if(isset($_POST["idCancelacion"])){
    
      $tipoCancelacion = new AjaxCuentas();
      $tipoCancelacion -> idCancelacion = $_POST["idCancelacion"];
      $tipoCancelacion -> ajaxEditarCancelacion();
  }

  /*=============================================
    CANCELAR CUENTA
    =============================================*/	
    if(isset($_POST["numCta"])){
    
      $cancelaCuenta = new AjaxCuentas();
      $cancelaCuenta -> numCta = $_POST["numCta"];
      $cancelaCuenta -> ajaxCancelarCuenta();
  }