<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Notas de Ingreso por Orden de Servicio

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Notas de Ingreso por OS</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <a href="crear-nota-ingreso-os">

                <button class="btn btn-primary">

                    Agregar Ingreso por Servicio

                </button>

                </a>
                
                <a href="vistas/reportes_excel/rpt_notaingresoserviciogeneral.php" class="btn btn-default" style="border:green 1px solid">

                    <img src="vistas/img/plantilla/excel.png" width="20px"> Reporte Ingresos x Servicio

                </a>

                <button type="button" class="btn btn-default pull-right" id="daterange-btnNotasIngresosOS">
                <span>
                    <i class="fa fa-calendar"></i>

                    <?php

                        if(isset($_GET["fechaInicial"])){

                            echo $_GET["fechaInicial"]." - ".$_GET["fechaFinal"];

                        }else{
                        
                            echo 'Rango de fecha';

                        }

                    ?>

                </span>

                <i class="fa fa-caret-down"></i>

                </button>
                
            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablaNotasIngresosOS" width="100%">

                    <thead>

                        <tr>

                            <th>Tipo</th>
                            <th>Fecha</th>
                            <th>Número</th>
                            <th>Proveedor</th>
                            <th>OS Asociada</th>
                            <th>Nro. OS</th>
                            <th>Responsable</th>
                            <th style="width:120px">Acciones</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

</div>

<!--=====================================
MODAL VIZUALIZAR NOTA DE INGRESO
======================================-->

<div id="modalVizualizarNotaIngresoServicio" class="modal fade" role="dialog">

  <div class="modal-dialog" style="width: 80% !important;">

    <div class="modal-content">

        <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">VISUALIZAR NOTA DE INGRESO SERVICIO</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <?php 
            date_default_timezone_set('America/Lima');
            $fecha = new DateTime();
            ?>

            <div class="form-group" style="padding-top:5px">

                <label class="col-form-label col-lg-1 col-md-3 col-sm-3">N. Ingreso</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control input-sm" id="NotaIngreso" name="NotaIngreso" readonly>
                </div>

                <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Fec. Emi.</label>
                <div class="col-lg-2">
                    <input type="date" class="form-control input-sm" id="fecNi" name="fecNi" readonly>
                </div>

                
                
            </div> 

            <div class="form-group" style="padding-top:25px;padding-bottom:25px">

                <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Proveedor</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control input-sm" id="proveedor" name="proveedor" readonly>
                </div>       

                <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Guia Asoc.</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" id="nuevoNroP" name="nuevoNroP" readonly>
                </div>                                           
                
            </div>   

            <div class="form-group col-lg-12">
              <table class="table table-hover table-striped tablaDetalleNotaIngreso" width="100%">
                <thead>
                
                    <th class="text-center">Item</th>
                    <th class="text-center">Cod. Ori.</th>
                    <th class="text-center">Descripcion</th>
                    <th class="text-center">Color</th>
                    <th class="text-center">Und</th>
                    <th class="text-center">Cod. Dest.</th>
                    <th class="text-center">Descripcion</th>
                    <th class="text-center">Color</th>
                    <th class="text-center">Cant. Recibida</th>
                    <th class="text-center">O.S</th>

                </thead>
                <tbody>
                </tbody>
              </table>
            </div>                                          
            
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

        </div>

        </form>

    </div>

  </div>

</div>

<script>
    window.document.title = "Ingreso de Servicios"
</script>