<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Notas de Ingreso

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Notas de Ingreso</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <a href="crear-nota-ingreso">

                <button class="btn btn-primary">

                    Agregar Nota de Ingreso

                </button>

                </a>

                
                <button class="btn btn-outline-success "  style="border:green 1px solid">
                            <img src="vistas/img/plantilla/excel.png" width="20px"> Reporte Notas de Ingreso </button> 
                <button type="button" class="btn btn-default pull-right" id="daterange-btnNotasIngresos">
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

                <table class="table table-bordered table-striped dt-responsive tablaNotasIngresos" width="100%">

                    <thead>

                        <tr>

                            <th>Tipo</th>
                            <th>Fecha</th>
                            <th>Número</th>
                            <th>Proveedor</th>
                            <th>Tip. Documento</th>
                            <th>Nro. Doc</th>
                            <th>Guia Asociada</th>
                            <th>Oc. Asociada</th>
                            <th style="width:120px">Acciones</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

</div>


<script>
    window.document.title = "Notas de Ingreso"
</script>