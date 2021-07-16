<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Procesar comprobante electronico

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Procesar comprobante electronico</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <div class="col-md-2">
                    <select class="form-control selectpicker " data-live-search="true" name="selectDocumentoCE" id="selectDocumentoCE">
                        <option value="">SELECCIONAR DOCUMENTO</option>
                        <option value="E05">NOTAS CREDITO</option>
                        <option value="S02">BOLETAS VENTAS</option>
                        <option value="S03">FACTURAS</option>
                        <option value="S99">NOTAS DEBITO</option>
                    </select>
                </div>
                
                <button type="button" class="btn btn-default pull-right" id="daterange-btnProcesarCE">
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

                <table class="table table-bordered table-striped dt-responsive tablaProcesarCE" width="100%">

                    <thead>

                        <tr>

                            <th>Tipo Documento</th>
                            <th>Documento</th>
                            <th>Total</th>
                            <th>Cod. Cliente</th>
                            <th>Nombre</th>
                            <th>Vendedor</th>
                            <th>Fec. Emisión</th>
                            <th>Doc. Destino</th>
                            <th>Estado</th>
                            <th>Agencia</th>
                            <th>Destino</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

</div>

<script>
    window.document.title = "Procesar CE"
</script>