<?php

?>

<!--------------------------------
* Arreglos
--------------------------------->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Administrar Arreglos
        </h1>
        <ol class="breadcrumb
            <li><a href=" #"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Administrar Arreglos</li>
        </ol>
    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <a href="crear-arreglos">

                    <button class="btn btn-primary">

                        Agregar Arreglos

                    </button>

                </a>
                <a href="cerrar-arreglos">

                    <button class="btn btn-danger">

                        Cerrar Arreglos

                    </button>

                </a>

                <button class="btn btn-info btnIngresoDeta" data-toggle='modal' data-target='#modalVerIngresoDeta' codigoServicio>
                    <i class="fa fa-eye"></i> Ver arreglos
                </button>


                <button class="btn btn-outline-success btnReporteArreglosM" style="border:green 1px solid">
                    <img src="vistas/img/plantilla/excel.png" width="20px"> Reporte Ingresos de stock </button>
                <button type="button" class="btn btn-default pull-right" id="daterange-btnArreglos">
                    <span>
                        <i class="fa fa-calendar"></i>

                        <?php

                        if (isset($_GET["fechaInicial"])) {

                            echo $_GET["fechaInicial"] . " - " . $_GET["fechaFinal"];
                        } else {

                            echo 'Rango de fecha';
                        }

                        ?>

                    </span>

                    <i class="fa fa-caret-down"></i>

                </button>

            </div>




            <div class="box-body">

                <input type="hidden" value="<?= $_SESSION["perfil"]; ?>" id="perfilOculto">
                <input type="hidden" value="<?= $_GET["ruta"]; ?>" id="rutaAcceso">
                <table class="table table-bordered table-striped dt-responsive tablaArreglos" width="100%">

                    <thead>

                        <tr>

                            <th>N°</th>
                            <th>Tipo</th>
                            <th>Código</th>
                            <th>Guia</th>
                            <th>Responsable</th>
                            <th>Taller</th>
                            <th>Total</th>
                            <th>Pendiente</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th style="width:180px">Acciones</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

</div>

<script>
    window.document.title = "Arreglos"
</script>