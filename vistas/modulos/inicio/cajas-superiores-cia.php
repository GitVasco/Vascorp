<?php

$mes = isset($_GET["mes"]) && $_GET["mes"] != "TODO" ? $_GET["mes"] : null;

$totales = ControladorMovimientos::ctrTotalesSoles($mes);

$pedidos = ControladorMovimientos::ctrTotalesSolesPedidos($mes);

$totalesInicio = ModeloMovimientos::mdlTotalesInicio();

?>



<div class="col-lg-2 col-xs-6">

    <div class="small-box bg-blue">

        <div class="inner">

            <h3>S/ <?php echo number_format($totales["vtas_soles"], 0); ?></h3>

            <p>Ventas - Soles</p>

        </div>

        <div class="icon">

            <i class="fa fa-cart-arrow-down"></i>

        </div>

        <a href="#" class="small-box-footer">

            Más info <i class="fa fa-arrow-circle-right"></i>

        </a>

    </div>

</div>

<div class="col-lg-2 col-xs-6">

    <div class="small-box bg-aqua">

        <div class="inner">

            <h3>S/ <?php echo number_format($pedidos["total"], 0); ?></h3>

            <p>Pedidos - Soles</p>

        </div>

        <div class="icon">

            <i class="fa fa-id-card-o"></i>

        </div>

        <a href="#" class="small-box-footer">

            Más info <i class="fa fa-arrow-circle-right"></i>

        </a>

    </div>

</div>

<div class="col-lg-2 col-xs-6">

    <div class="small-box bg-green">

        <div class="inner">

            <h3>S/<?php echo number_format($totales["pagos_soles"], 0); ?></h3>

            <p>Cobranza - Soles</p>

        </div>

        <div class="icon">

            <i class="fa fa-tags"></i>

        </div>

        <a href="#" class="small-box-footer">

            Más info <i class="fa fa-arrow-circle-right"></i>

        </a>

    </div>

</div>


<div class="col-lg-2 col-xs-6">

    <div class="small-box bg-yellow">

        <div class="inner">

            <h3>S/<?php echo number_format($totalesInicio["total_vencidos_cuentas"] - $totalesInicio["total_vencidos_180_cuentas"], 0); ?></h3>

            <p>Documentos Vencidos - Soles</p>

        </div>

        <div class="icon">

            <i class="fa fa-asterisk"></i>

        </div>

        <a href="#" class="small-box-footer">

            Más info <i class="fa fa-arrow-circle-right"></i>

        </a>

    </div>

</div>

<div class="col-lg-2 col-xs-6">

    <div class="small-box bg-orange">

        <div class="inner">

            <h3>S/<?php echo number_format($totalesInicio["total_vencidos_180_cuentas"], 0); ?></h3>

            <p>Documentos Vencidos - 180 días</p>

        </div>

        <div class="icon">

            <i class="fa fa-exclamation-circle"></i>

        </div>

        <a href="#" class="small-box-footer">

            Más info <i class="fa fa-arrow-circle-right"></i>

        </a>

    </div>

</div>

<div class="col-lg-2 col-xs-6">

    <div class="small-box bg-red">

        <div class="inner">

            <h3>S/<?php echo number_format($totalesInicio["incobrable_cuentas"], 0); ?></h3>

            <p>Documentos Incobrables - Soles</p>

        </div>

        <div class="icon">

            <i class="fa fa-times"></i>

        </div>

        <a href="#" class="small-box-footer">

            Más info <i class="fa fa-arrow-circle-right"></i>

        </a>

    </div>

</div>