<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Administrar Boletas

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Administrar Facturas</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <button type="button" class="btn btn-default pull-right" id="daterange-btnBoleta">
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

                <input type="hidden" value="<?= $_SESSION["perfil"]; ?>" id="perfilOculto">
                <input type="hidden" value="<?= $_GET["ruta"]; ?>" id="rutaAcceso">    

                <table class="table table-bordered table-striped dt-responsive tablaBoletas" width="100%">

                    <thead>

                        <tr>

                        <th>Tipo Doc.</th>
                            <th>Documento</th>
                            <th>Total</th>
                            <th>Cliente</th>
                            <th>Nombre</th>
                            <th>Vend.</th>
                            <th>Fec. Emi.</th>
                            <th>Doc. Dest.</th>
                            <th>Cond. Venta</th>
                            <th>Estado</th>
                            <th>Agencia</th>
                            <th>Destino</th>
                            <th>Responsable</th>
                            <th style="width:130px">Acciones</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

</div>

<?php

$anularDocumento = new ControladorFacturacion();
$anularDocumento -> ctrAnularDocumento();

$eliminarDocumento = new ControladorFacturacion();
$eliminarDocumento -> ctrEliminarDocumento();
?>

<script>
    window.document.title = "Boletas"
</script>