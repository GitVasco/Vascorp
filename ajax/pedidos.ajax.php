<?php

session_start();

require_once '../controladores/articulos.controlador.php';
require_once '../modelos/articulos.modelo.php';
require_once '../controladores/clientes.controlador.php';
require_once '../modelos/clientes.modelo.php';

require_once '../controladores/pedidos.controlador.php';
require_once '../modelos/pedidos.modelo.php';

require_once '../controladores/movimientos.controlador.php';
require_once '../modelos/movimientos.modelo.php';

class AjaxPedidos
{

    /* 
	* VISUALIZAR COLORES
	*/
    public function ajaxVerColores()
    {

        $valor = $this->modelo;

        $respuesta = controladorArticulos::ctrVerColores($valor);

        echo json_encode($respuesta);
    }

    /* 
	* VISUALIZAR COLORES
	*/
    public function ajaxVerColoresCantidades()
    {

        $pedido = $this->pedido;
        $modelo = $this->modeloA;

        $respuesta = controladorArticulos::ctrVerColoresCantidades($pedido, $modelo);

        echo json_encode($respuesta);
    }

    /* 
	* VISUALIZAR COLORES
	*/
    public function ajaxVerColoresCantidadesB()
    {

        $pedido = $this->pedidoT;
        $modelo = $this->modeloT;

        $respuesta = controladorArticulos::ctrVerColoresCantidadesB($pedido, $modelo);

        echo json_encode($respuesta);
    }

    /* 
	* VISUALIZAR COLORES
	*/
    public function ajaxVerDatos()
    {

        $modelo = $this->mod;
        $lista = $this->modLista;

        $respuestaLista = controladorArticulos::ctrVerPrecios($modelo, $lista);

        echo json_encode($respuestaLista);
    }

    /* 
	* SACAR LA LISTA DE PRECIOS ASIGNADA
	*/
    public function ajaxVeLista()
    {

        $valor = $this->cliList;

        $respuestaDet = ControladorClientes::ctrVerLista($valor);

        echo json_encode($respuestaDet);
    }

    /* 
	* SACAR LA LISTA DE PRECIOS ASIGNADA
	*/
    public function ajaxBorrarModelo()
    {

        $modelo = $this->modelo;
        $pedido = $this->pedido;

        $respuesta = ModeloPedidos::mdlBorrarModelo($modelo, $pedido);

        echo json_encode($respuesta);
    }


    /* 
	* SACAR LA LISTA DE PRECIOS ASIGNADA
	*/
    public function ajaxBorrarArticulo()
    {

        $articulo = $this->articulo;
        $pedido = $this->pedido;

        $respuesta = ModeloPedidos::mdlBorrarArticulo($articulo, $pedido);

        echo json_encode($respuesta);
    }

    /* 
	* VER TALONARIO
	*/
    public function ajaxVerTalonario()
    {

        $serie = $this->serie;
        $talonario = $this->talonario;

        $respuesta = ModeloPedidos::mdlVerTalonario($serie, $talonario);

        echo json_encode($respuesta);
    }

    /* 
	* VER TALONARIO
	*/
    public function ajaxActualizarTalonario()
    {

        $serie = $this->serieA;
        $talonario = $this->talonarioA;

        $respuesta = ModeloPedidos::mdlSepararTalonario($serie, $talonario);

        echo json_encode($respuesta);
    }

    /* 
	* VER TALONARIO
	*/
    public function ajaxReiniciarTalonario()
    {

        $tipo = $this->tipo;

        $respuesta = ModeloPedidos::mdlReiniciarTalonario($tipo);

        echo json_encode($respuesta);
    }


    /* 
	* SACAR LA LISTA DE PRECIOS ASIGNADA
	*/
    public function ajaxDupicarPedido()
    {

        $codDup = $this->codDup;

        #vemos el numero que sigue en el talonario y actualizamos en +1
        $numero = ControladorMovimientos::ctrMostrarTalonario();
        $talonario = $numero["pedido"] + 1;



        $usuario = $_SESSION["id"];
        $talonarioN = $usuario . $talonario;

        //*COPIAR CABECERA
        $rptCab = ModeloPedidos::mdlDuplicarCabecera($codDup, $talonarioN);

        if ($rptCab == "ok") {

            //*COPIAR DETALLE
            $rptDet = ModeloPedidos::mdlDuplicarDetalle($codDup, $talonarioN);

            ModeloPedidos::mdlActualizarTalonario();
        }

        echo json_encode($rptDet);
    }

    //*TRAER CUENTAS
    public function ajaxTraerCuentas()
    {

        $valor = $this->documento;

        $respuesta = ControladorPedidos::ctrTraerCuentas($valor);

        echo json_encode($respuesta);
    }

    /* 
	* VER TALONARIO
	*/
    public function ajaxActualizarTotales()
    {

        $codPedido = $this->codPedido;

        $respuesta = ModeloPedidos::mdlActualizarTotales($codPedido);

        echo json_encode($respuesta);
    }

    /* 
	* VER TALONARIO
	*/
    public function ajaxNuevoGuardarPedido()
    {

        $pedidoN = $this->pedidoN;
        $nuevoPedidoN = $this->nuevoPedidoN;
        $clienteN = $this->clienteN;
        $vendedorN = $this->vendedorN;
        $listaN = $this->listaN;
        $agenciaN = $this->agenciaN;
        $modeloN = $this->modeloN;
        $precioN = $this->precioN;
        $articulosN = $this->articulosN;

        $articulosN = json_decode($_POST["articulosN"], true);

        if (count($articulosN) > 0) {

            if ($pedidoN === "") {

                $numero = ControladorMovimientos::ctrMostrarTalonario();
                $talonario = $numero["pedido"] + 1;
                ModeloPedidos::mdlActualizarTalonario();

                $usuario = $_SESSION["id"];
                $talonarioN = $usuario . $talonario;

                $datos = array(
                    "codigo"    => $talonarioN,
                    "cliente"   => $clienteN,
                    "vendedor"  => $vendedorN,
                    "lista"     => $listaN,
                    "usuario"   => $usuario,
                    "agencia"   => $agenciaN
                );

                $cab = ModeloPedidos::mdlGuardarTemporal("temporaljf", $datos);

                foreach ($articulosN as $key => $value) {
                    if ($value["value"] > 0) {
                        $datosDetalle = array(
                            "codigo"    => $talonarioN,
                            "articulo"  => $value["name"],
                            "cantidad"  => $value["value"],
                            "precio"    => $precioN
                        );
                        $respuesta = ModeloPedidos::mdlGuardarTemporalDetalle("detalle_temporal", $datosDetalle);
                    }
                }

                if ($cab == "ok") {
                    echo json_encode($talonarioN);
                }
            } else {
                $limpiar = ModeloPedidos::mdlEliminarDetalleTemporalB("detalle_temporal", $pedidoN, $modeloN);

                foreach ($articulosN as $key => $value) {
                    if ($value["value"] > 0) {
                        $datosDetalle = array(
                            "codigo"    => $pedidoN,
                            "articulo"  => $value["name"],
                            "cantidad"  => $value["value"],
                            "precio"    => $precioN
                        );
                        $respuesta = ModeloPedidos::mdlGuardarTemporalDetalle("detalle_temporal", $datosDetalle);
                    }
                }

                echo json_encode("toast");
            }
        }
    }
}

/* 
 * VISUALIZAR COLORES
*/
if (isset($_POST["modelo"])) {

    $visualizarMateriaPrimaDetalle = new AjaxPedidos();
    $visualizarMateriaPrimaDetalle->modelo = $_POST["modelo"];
    $visualizarMateriaPrimaDetalle->ajaxVerColores();
}

/* 
 * VISUALIZAR COLORES Y MODIFICAR
*/
if (isset($_POST["pedido"])) {

    $verColoresyCantidades = new AjaxPedidos();
    $verColoresyCantidades->pedido = $_POST["pedido"];
    $verColoresyCantidades->modeloA = $_POST["modeloA"];
    $verColoresyCantidades->ajaxVerColoresCantidades();
}

/* 
 * VISUALIZAR COLORES Y MODIFICAR
*/
if (isset($_POST["pedidoT"])) {

    $verColoresyCantidades = new AjaxPedidos();
    $verColoresyCantidades->pedidoT = $_POST["pedidoT"];
    $verColoresyCantidades->modeloT = $_POST["modeloT"];
    $verColoresyCantidades->ajaxVerColoresCantidadesB();
}

/* 
 * VISUALIZAR precios y otros
*/
if (isset($_POST["mod"])) {

    $visualizarPrecios = new AjaxPedidos();
    $visualizarPrecios->mod = $_POST["mod"];
    $visualizarPrecios->modLista = $_POST["modLista"];
    $visualizarPrecios->ajaxVerDatos();
}

/* 
 * SACAR LA LISTA DE PRECIOS ASIGNADA
*/
if (isset($_POST["cliList"])) {

    $visualizarListaPrecios = new AjaxPedidos();
    $visualizarListaPrecios->cliList = $_POST["cliList"];
    $visualizarListaPrecios->ajaxVeLista();
}

/* 
 * PARA BORRAR POR MODELO
*/
if (isset($_POST["modeloB"])) {

    $borrarModelo = new AjaxPedidos();
    $borrarModelo->modelo = $_POST["modeloB"];
    $borrarModelo->pedido = $_POST["pedidoB"];
    $borrarModelo->ajaxBorrarModelo();
}

if (isset($_POST["articuloC"])) {

    $borrarModelo = new AjaxPedidos();
    $borrarModelo->articulo = $_POST["articuloC"];
    $borrarModelo->pedido = $_POST["pedidoC"];
    $borrarModelo->ajaxBorrarArticulo();
}

/* 
 * PARA BORRAR POR MODELO
*/
if (isset($_POST["codDup"])) {

    $borrarModelo = new AjaxPedidos();
    $borrarModelo->codDup = $_POST["codDup"];
    $borrarModelo->ajaxDupicarPedido();
}

/* 
 * VER TALONARIOS QUE TRAE
*/
if (isset($_POST["talonario"])) {

    $verColoresyCantidades = new AjaxPedidos();
    $verColoresyCantidades->serie = $_POST["serie"];
    $verColoresyCantidades->talonario = $_POST["talonario"];
    $verColoresyCantidades->ajaxVerTalonario();
}

/* 
 * ACTUALIZAR Y SEPARAR EL COONTROL
*/
if (isset($_POST["talonarioA"])) {

    $verColoresyCantidades = new AjaxPedidos();
    $verColoresyCantidades->serieA = $_POST["serieA"];
    $verColoresyCantidades->talonarioA = $_POST["talonarioA"];
    $verColoresyCantidades->ajaxActualizarTalonario();
}


/* 
 * REINICIAR TALONARIO
*/
if (isset($_POST["tipo"])) {

    $verColoresyCantidades = new AjaxPedidos();
    $verColoresyCantidades->tipo = $_POST["tipo"];
    $verColoresyCantidades->ajaxReiniciarTalonario();
}


/* 
 * Treaemos las cuentas
*/
if (isset($_POST["documento"])) {

    $verColoresyCantidades = new AjaxPedidos();
    $verColoresyCantidades->documento = $_POST["documento"];
    $verColoresyCantidades->ajaxTraerCuentas();
}

/* 
 * Actualizar totales
*/
if (isset($_POST["codPedido"])) {

    $verColoresyCantidades = new AjaxPedidos();
    $verColoresyCantidades->codPedido = $_POST["codPedido"];
    $verColoresyCantidades->ajaxActualizarTotales();
}


/* 
 * Guardar Modelo Nuevo
*/
if (isset($_POST["pedidoN"])) {

    $activar = new AjaxPedidos();
    $activar->pedidoN = $_POST["pedidoN"];
    $activar->nuevoPedidoN = $_POST["nuevoPedidoN"];
    $activar->clienteN = $_POST["clienteN"];
    $activar->vendedorN = $_POST["vendedorN"];
    $activar->listaN = $_POST["listaN"];
    $activar->agenciaN = $_POST["agenciaN"];
    $activar->modeloN = $_POST["modeloN"];
    $activar->precioN = $_POST["precioN"];
    $activar->articulosN = $_POST["articulosN"];
    $activar->ajaxNuevoGuardarPedido();
}
