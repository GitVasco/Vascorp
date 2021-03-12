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

      public $clienteCredito;
    
      public function ajaxCuentaCredito(){
        $valor = $this->clienteCredito;
    
        $respuesta = ControladorCuentas::ctrMostrarCuentaCredito($valor);
    
        echo json_encode($respuesta);
    
      }

      public $clienteDeuda;
    
      public function ajaxCuentaDeuda(){
        $valor = $this->clienteDeuda;
    
        $respuesta = ControladorCuentas::ctrMostrarCuentaDeuda($valor);
    
        echo json_encode($respuesta);
    
      }

      public $clienteDeudaVencida;
    
      public function ajaxCuentaDeudaVencida(){
        $valor = $this->clienteDeudaVencida;
    
        $respuesta = ControladorCuentas::ctrMostrarCuentaDeudaVencida($valor);
    
        echo json_encode($respuesta);
    
      }

      public $letraCuenta;
    
      public function ajaxCuentaLetras(){
        $valor = $this->letraCuenta;
    
        $respuesta = ControladorCuentas::ctrMostrarCuentasUnicos("id",$valor);
    
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

  /*=============================================
    MOSTRAR CREDITO
    =============================================*/	
    if(isset($_POST["clienteCredito"])){
    
      $cuentaCredito = new AjaxCuentas();
      $cuentaCredito -> clienteCredito = $_POST["clienteCredito"];
      $cuentaCredito -> ajaxCuentaCredito();
  }

  /*=============================================
    MOSTRAR DEUDA
    =============================================*/	
    if(isset($_POST["clienteDeuda"])){
    
      $cuentaDeuda = new AjaxCuentas();
      $cuentaDeuda -> clienteDeuda = $_POST["clienteDeuda"];
      $cuentaDeuda -> ajaxCuentaDeuda();
  }

  /*=============================================
    MOSTRAR DEUDA
    =============================================*/	
    if(isset($_POST["clienteDeudaVencida"])){
    
      $cuentaDeudaVencida = new AjaxCuentas();
      $cuentaDeudaVencida -> clienteDeudaVencida = $_POST["clienteDeudaVencida"];
      $cuentaDeudaVencida -> ajaxCuentaDeudaVencida();
  }

  /*=============================================
    ENVIO LETRAS
    =============================================*/	
    if(isset($_POST["letraCuenta"])){
    
      $cuentaLetras = new AjaxCuentas();
      $cuentaLetras -> letraCuenta = $_POST["letraCuenta"];
      $cuentaLetras -> ajaxCuentaLetras();
  }