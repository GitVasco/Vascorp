<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Compras

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Compras</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header">

                <div class="col-lg-3">

                    <button class="btn btn-info  generarTxt" id="generarTxt" name="generarTxt">
                        Generar *.txt
                    </button>
                    
                </div>

                <div class="col-lg-6">

                    <form role="form"  method="POST" enctype="multipart/form-data">
                        <div class="col-lg-6">
                            <input type="file" name="archivotxt" id="archivotxt" class="form-control" accept="text/plain">
                        </div>
                        <div class="col-lg-6">
                            <button type="submit"  class="btn btn-success" name="imporTxt"><i class="fa fa-refresh"></i> Cargar Diario</a>
                        </div>
                    </form>

                    
                    <?php

                        $actualizarStock = new ControladorCompras();
                        $actualizarStock->ctrLeerTxt();

                    ?>
                    
                </div>                
            
            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive TablaRegCompras" width="100%">

                    <thead>

                        <tr>

                            <th>Mes</th>
                            <th>O.</th>
                            <th>V.</th>
                            <th>Ruc</th>
                            <th>Razón Social</th>
                            <th>TD</th>
                            <th>Ser</th>
                            <th>Doc</th>
                            <th>Total</th>
                            <th width="60px">F. Emi</th>
                            <th width="60px">F. Ven</th>
                            <th>Comp-Cont-Cond</th>
                            <th>Rev</th>

                        </tr>

                    </thead>

                    <tbody>
                    </tbody>

                </table>

            </div>

        </div>

    </section>

</div>

<?php

    $generarTxt = new ControladorCompras();
    $generarTxt -> ctrGenerarTxt();

?>

<script>
    window.document.title = "Compras";
</script>