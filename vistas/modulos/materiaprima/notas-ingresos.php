<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Notas de Ingreso por Orden de Compra

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Notas de Ingreso por OC</li>

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

<div id="modalVizualizarNotaIngreso" class="modal fade" role="dialog">

  <div class="modal-dialog" style="width: 80% !important;">

    <div class="modal-content">

        <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">VISUALIZAR NOTA DE INGRESO</h4>

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
                <div class="col-lg-3">
                    <input type="date" class="form-control input-sm" id="fecNi" name="fecNi" readonly>
                </div>

                
                
            </div> 

            <div class="form-group" style="padding-top:25px">

                <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Doc. Pri.</label>
                <div class="col-lg-2">
                    <select  class="form-control input-sm" name="tipDocP" id="tipDocP">
                    <option value="">Doc. Principal</option>
                    <?php
                        $documentos = ControladorNotasIngresos::ctrDocNI();
                        #var_dump("ubigeo", $documentos);

                        foreach ($documentos as $key => $value) {
    
                        echo '<option value="' . $value["cod_argumento"] . '">' . $value["cod_argumento"] . ' - ' . $value["des_larga"] . '</option>';
    
                        }                        

                    ?>
                    </select>
                </div>

                <div class="col-lg-1">
                    <input type="text" class="form-control input-sm" id="nuevaSerieP" name="nuevaSerieP" placeholder="Serie">
                </div>
                <div class="col-lg-1">
                    <input type="text" class="form-control input-sm" id="nuevoNroP" name="nuevoNroP" placeholder="Número">
                </div>

                <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Fec. Emi.</label>
                <div class="col-lg-2">
                    <input type="date" class="form-control input-sm" id="fecP" name="fecP" value="<?php echo $fecha->format("Y-m-d"); ?>">
                </div>

                <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Proveedor</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control input-sm" id="proveedor" name="proveedor" readonly>
                </div>                                    
                
            </div>   
            
            <div class="form-group" style="padding-top:25px;">

                <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Doc. Sec.</label>
                <div class="col-lg-2">
                    <select  class="form-control input-sm" name="tipDocS" id="tipDocS">
                    <option value="">Doc. Secundario</option>
                    <?php
                        $documentos = ControladorNotasIngresos::ctrDocNI();
                        #var_dump("ubigeo", $documentos);

                        foreach ($documentos as $key => $value) {

                        echo '<option value="' . $value["cod_argumento"] . '">' . $value["cod_argumento"] . ' - ' . $value["des_larga"] . '</option>';

                        }                        

                    ?>
                    </select>
                </div>
                
                <div class="col-lg-1">
                    <input type="text" class="form-control input-sm" id="nuevaSerieS" name="nuevaSerieS" placeholder="Serie">
                </div>
                <div class="col-lg-1">
                    <input type="text" class="form-control input-sm" id="nuevoNroS" name="nuevoNroS" placeholder="Número">
                </div>

                <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Fec. Emi.</label>
                <div class="col-lg-2">
                    <input type="date" class="form-control input-sm" id="fecS" name="fecS" value="<?php echo $fecha->format("Y-m-d"); ?>">
                </div>                                    

                <label class="col-form-label col-lg-1 col-md-3 col-sm-3">O. Compra</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control input-sm" id="oc" name="oc" readonly>
                </div>  

            </div> 
            
            <div class="form-group" style="padding-top:25px;padding-bottom:25px">

                <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Moneda</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" id="moneda" name="moneda" readonly>
                </div> 

                <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Observaciones</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control input-sm" id="nuevaObservacion" name="nuevaObservacion">
                </div> 

            </div> 

            <div class="form-group col-lg-12">
              <table class="table table-hover table-striped tablaDetalleNotaIngreso" width="100%">
                <thead>
                
                    <th class="text-center">Item</th>
                    <th class="text-center">Cod.Producto</th>
                    <th class="text-center">Cod.Fabrica</th>
                    <th class="text-center">Descripcion</th>
                    <th class="text-center">Color</th>
                    <th class="text-center">Und</th>
                    <th class="text-center">Cant. Recibida</th>
                    <th class="text-center">Saldo</th>
                    <th class="text-center">Exceso</th>
                    <th class="text-center">P.S. IGV</th>
                    <th class="text-center">Total</th>
                    <th class="text-center">O.C</th>

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

          <button type="submit" class="btn btn-primary pull-right">Actualizar Nota de Ingreso</button>


        </div>

        </form>

        <?php

        $editarNotaIngreso = new ControladorNotasIngresos();
        $editarNotaIngreso -> ctrEditarNotaIngreso();

        ?>  

    </div>

  </div>

</div>


<script>
    window.document.title = "Notas de Ingreso"
</script>