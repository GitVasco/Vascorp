<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Registro de gastos

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Registro de gastos</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarGasto">
          
                   Registrar Gasto
          
                  </button>
            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive TablaGastosCaja" width="100%">

                    <thead>

                        <tr>

                            <th>Fecha</th>
                            <th>Recibo</th>
                            <th>Proveedor</th>
                            <th>Sucursal</th>
                            <th>Gasto</th>
                            <th>Cod</th>
                            <th>Detalle</th>
                            <th>Total S/</th>
                            <th>Tip Doc.</th>
                            <th>Documento</th>
                            <th>Solicitante</th>
                            <th>Descripcion</th>

                        </tr>

                    </thead>

                    <tbody>
                    </tbody>

                </table>

            </div>

        </div>

    </section>

</div>

<!--=====================================
MODAL REGISTRAR GASTO
======================================-->

<div id="modalAgregarGasto" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 70% !important">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar categoría</h4>

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

            <div class="form-group">
                <label class="col-form-label col-lg-1 col-md-1">Fecha</label>
                <div class="col-lg-2">
                    <input type="date" class="form-control input-sm" id="fechaGasto" name="fechaGasto"   value="<?php echo $fecha->format("Y-m-d"); ?>">
                </div>

                <label class="col-form-label col-lg-1 col-md-1">Recibo</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" id="recibo" name="recibo">
                </div>

                <label for=""  class="col-form-label col-lg-1 col-md-1">Sucursal</label>
                <div class="col-lg-5 col-md-3">
                    <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevaSucursal" id="nuevaSucursal" required>
                        <option value="">Seleccionar Sucursal</option>
                        <?php
                        $valor = "TSUC";

                        $sucursal = ModeloMaestras::mdlMostrarMaestrasDetalle($valor);
                        #var_dump($sucursal);
                        foreach ($sucursal as $key => $value) {
                            echo '<option value="' . $value["cod_argumento"] . '">' .$value["cod_argumento"]. " - " . $value["des_larga"] . '</option>';
                        }

                        ?>
                    </select>
                </div>                

            </div>

            <div class="form-group" style="padding-top:25px">

                <label class="col-form-label col-lg-1 col-md-1">Proveedor</label>
                <div class="col-lg-2">
                    <div class="input-group">
                        <input type="number"  class="form-control input-sm" name="nuevoRUC" placeholder="Ingresar RUC" id = "nuevoRucPro" required>
                        <div class="input-group-addon" style="padding:0px !important;border: 0px !important">
                            <button type="button" class="btn btn-default btn-sm" onclick="ObtenerDatosRuc()"><i class="fa fa-search "></i></button>	
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-10 col-sm-9">

                    <input type="text" style="text-transform:uppercase;" class="form-control input-md" name="nuevaRazPro" id="nuevaRazPro" placeholder="Ingresar razon social" required readonly>

                </div>            

                <label class="col-form-label col-lg-1 col-md-1">Tipo Doc.</label>
                <div class="col-lg-2 col-md-3">
                    <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevoTipo" id="nuevoTipo" required>
                        <option value="">Seleccionar Tipo Doc.</option>
                        <?php

                        $tipoDoc = ControladorCentroCostos::ctrMostrarTipoDoc();
                        #var_dump($tipoDoc);
                        foreach ($tipoDoc as $key => $value) {
                            echo '<option value="' . $value["codigo"] . '">' .$value["codigo"]." - ".$value["descripcion"].'</option>';
                        }

                        ?>
                    </select>
                </div> 

                <label class="col-form-label col-lg-1 col-md-1">Número</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm" id="documento" name="documento">
                </div>

            </div>

            <div class="form-group" style="padding-top:25px">

                <label class="col-form-label col-lg-1 col-md-1">Cod. Caja</label>

                <div class="col-lg-8 col-md-3">
                    <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevoCodCaja" id="nuevoCodCaja" required>
                        <option value="">Seleccionar Código Caja</option>
                        <?php

                        $sucursal = ControladorCentroCostos::ctrMostrarCentroCostosCaja();
                        #var_dump($sucursal);
                        foreach ($sucursal as $key => $value) {
                            echo '<option value="'.$value["cod_caja"].'">'.$value["cod_caja"]." - ".$value["nombre_gasto"]." - ".$value["nombre_area"]." - ".$value["descripcion"].'</option>';
                        }

                        ?>
                    </select>
                </div>   
                
                <label class="col-form-label col-lg-1 col-md-1">Total S/.</label>
                <div class="col-lg-2">
                    <input type="number" step="any" class="form-control input-sm" id="total" name="total">
                </div>                

            </div>  

            <div class="form-group" style="padding-top:25px">          
            
                <label class="col-form-label col-lg-1 col-md-1">Gasto</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control input-sm" id="gasto" name="gasto" readonly>
                </div> 

                <label class="col-form-label col-lg-1 col-md-1">Área</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control input-sm" id="area" name="area" readonly>
                </div> 

                <label class="col-form-label col-lg-1 col-md-1">Caja</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control input-sm" id="caja" name="caja" readonly>
                </div> 

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Gasto</button>

        </div>

        <?php

          /* $crearCentroCostos = new ControladorCentroCostos();
          $crearCentroCostos -> ctrCrearCentroCostos(); */

        ?>

      </form>

    </div>

  </div>

</div>

<script>
    window.document.title = "Registro de Gastos"
</script>