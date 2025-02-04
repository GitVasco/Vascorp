<?php
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            En Talleres
            <small>Producción</small>
        </h1>
        <ol class="breadcrumb
            <li><a href=" #"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">En Talleres</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <div class="col-lg-2">
                    <select name="selectEnTalleres" id="selectEnTalleres" class="form-control input-lg selectpicker" data-live-search="true" data-size="10">
                        <option value="null">Seleccionar Taller</option>
                        <?php
                        // creamos un array para configurar los talleres
                        $taller = ["T0", "T1", "T2", "T3", "T4", "T5", "T6", "T8", "T9", "TA", "TB", "TC", "TD", "T11"];

                        $sector = ControladorSectores::ctrMostrarSectores(null);
                        foreach ($sector as $key => $value) {

                            // validamos que el sector sea un taller 
                            if (in_array($value["cod_sector"], $taller)) {
                                echo '<option value="' . $value["cod_sector"] . '">' . $value["cod_sector"] . "-" . $value["nom_sector"] . '</option>';
                            }
                        }

                        ?>
                    </select>
                </div>

                <a href="vistas/reportes_excel/rpt_entalleres_grupal.php" class="btn btn-default pull-right" style="border:green 1px solid">
                    <img src="vistas/img/plantilla/excel.png" width="20px"> En Talleres Grupal
                </a>
                <a href="vistas/reportes_excel/rpt_entalleres.php" class="btn btn-default pull-right" style="border:green 1px solid">
                    <img src="vistas/img/plantilla/excel.png" width="20px"> En Talleres
                </a>
            </div>
            <div class="box-body">

                <input type="hidden" value="<?= $_SESSION["perfil"]; ?>" id="perfilOculto">

                <table class="table table-bordered table-striped dt-responsive tablaEnTalleres" width="100%">

                    <thead>

                        <tr>
                            <th>Fecha</th>
                            <th>Guia</th>
                            <th>Taller</th>
                            <th>Modelo</th>
                            <th>Nombre</th>
                            <th>Color</th>
                            <th>Talla</th>
                            <th>Cantidad</th>
                            <th>Saldo</th>
                            <th>Acciones</th>
                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

</div>


<script>
    window.document.title = "En Talleres"
</script>