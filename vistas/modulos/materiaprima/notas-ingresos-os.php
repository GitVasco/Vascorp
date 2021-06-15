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

                
                <button class="btn btn-outline-success "  style="border:green 1px solid">
                <img src="vistas/img/plantilla/excel.png" width="20px"> Reporte Notas de Ingreso Servicio</button> 
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
                            <th style="width:120px">Acciones</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

</div>

<script>
    window.document.title = "Ingreso de Servicios"
</script>