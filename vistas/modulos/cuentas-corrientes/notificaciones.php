<?php
$fechaActual = date("Y-m-d");
$cuentas = ControladorCuentas::ctrNotificacionesPendientes();
$cuentasHoy = 0;
foreach ($cuentas as $key => $value) {
    if ($value["fecha_ven"] == $fechaActual) {
        $cuentasHoy++;
    }
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Notificaciones
            <small>Panel de notificaciones</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Notificaciones</li>
        </ol>
    </section>

    <section class="content">

        <div class="box">

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-info-circle"></i> Información de Envío de Mensajes</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <!-- Cantidad de Mensajes -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-envelope"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Mensajes a Enviar</span>
                                    <span class="info-box-number"><?= $cuentasHoy ?></span>
                                </div>
                            </div>
                        </div>
                        <!-- Hora de Envío -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-clock-o"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Hora de Envío</span>
                                    <span class="info-box-number">11:00 AM</span>
                                </div>
                            </div>
                        </div>
                        <!-- Fecha de Envío -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-calendar"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Fecha de Envío</span>
                                    <span class="info-box-number"><?= $fechaActual ?></span>
                                </div>
                            </div>
                        </div>
                        <!-- Información Adicional -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="fa fa-info"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Descripción</span>
                                    <span class="info-box-number">Vencimiento de Letras de Clientes</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="box box-body">

                <div class="col-md-8">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped dt-responsive tablaNotificacionesPendientes" width="100%">

                            <thead>

                                <tr>
                                    <th>Num. Cta.</th>
                                    <th>Fec. Emi</th>
                                    <th>Fec. Ven.</th>
                                    <th>Vend.</th>
                                    <th>Saldo</th>
                                    <th>Num. Uni.</th>
                                    <th>Cliente</th>
                                    <th>Telefono</th>
                                    <th>Acciones</th>
                                </tr>

                            </thead>

                            <tbody>

                            </tbody>

                        </table>
                    </div>

                </div>
            </div>


            <!-- <div class="col-md-4">
    
                    <div class="box-body">
    
                        <table class="table table-bordered table-striped dt-responsive tablaNotificacionesPendientesX" width="100%">
    
                            <thead>
    
                                <tr>
                                    <th>Nro Doc.</th>
                                    <th>Cliente</th>
                                    <th>Fec. Env.</th>
                                    <th>Estado</th>
    
                                </tr>
    
                            </thead>
    
                            <tbody>
    
                            </tbody>
    
                        </table>
    
                    </div>
                </div> -->

        </div>



    </section>


</div>

<script>
    window.document.title = "Notificaciones"
</script>