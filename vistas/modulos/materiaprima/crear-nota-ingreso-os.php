<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Crear Ingreso de Servicio

        </h1>

        <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Crear Ingreso de Servicio</li>

        </ol>

    </section>

    <section class="content">

        <div class="row">

            <!--=====================================
            LA TABLA DE PRODUCTOS
            ======================================-->
            <div class="col-lg-12">
                <div class="box box-warning collapsed-box tablaCollapsada" id="tablaCollapsada" name="tablaCollapsada" >
                    <div class="box-header with-border">
                    <h3 class="box-title">Seleccionar Materia Prima</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>

                    </div>
                        <div class="box-body">

                            <table class="table table-bordered table-striped dt-responsive tablaMpSO" width="100%">

                                <thead>

                                    <tr>
                                        <th>Nro</th>
                                        <th>Descripción</th>
                                        <th>Cod. Ori.</th>                                        
                                        <th>Color Ori</th>
                                        <th>Cod. Dest.</th>
                                        <th>Color Dest.</th>
                                        <th>Cantidad</th>
                                        <th>#</th>
                                    </tr>

                                </thead>

                            </table>

                        </div>

                </div>

            </div>
     

            <!--=====================================
            EL FORMULARIO
            ======================================-->

            <div class="col-lg-12 col-xs-12">

                <div class="box box-success">

                    <div class="box-header with-border"></div>

                    <form role="form" method="post" class="formularioNotaIngreso">

                        <div class="box-body">

                            <div class="box">

                            <?php 
                                date_default_timezone_set('America/Lima');
                                $fecha = new DateTime();
                            ?>

                                <div class="form-group" style="padding-top:5px;padding-bottom:30px">

                                    <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Proveedor</label>
                                    <div class="col-lg-3">

                                        <?php
                                            $item = "codruc";
                                            $valor = '000097';

                                            $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);

                                            //var_dump($proveedores["RazPro"]);
                                            echo '<input type="text" class="form-control input-sm" id="NomProv" name="NomProv"
                                            value="'.$proveedores["RazPro"].'">';

                                        ?>
                                        
                                    </div>                                

                                    <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Fec. Emision</label>
                                    <div class="col-lg-2">
                                        <input type="date" class="form-control input-sm" id="fecP" name="fecP"
                                        value="<?php echo $fecha->format("Y-m-d"); ?>">
                                    </div>
                                    
                                </div>

                                <!--=====================================
                                        TITULOS
                                ======================================-->

                                <div class="box box-primary">

                                    <div class="row">
                                            <div class="col-lg-1">

                                            <label>CodPro</label>

                                            </div>

                                            <div class="col-lg-1">

                                            <label for="">CodFab</label>

                                            </div>

                                            <div class="col-lg-2">

                                            <label for="">Descripción / Color / Und</label>

                                            </div>

                                            <div class="col-lg-1">

                                            <label for="">Cantidad</label>

                                            </div>   
                                            
                                            <div class="col-lg-1">

                                            <label for="">C. Recibida</label>

                                            </div>

                                            <div class="col-lg-1">

                                            <label for="">Saldo</label>

                                            </div>  

                                            <div class="col-lg-1">

                                            <label for="">Exceso</label>

                                            </div>

                                            <div class="col-lg-1">

                                            <label for="">P.S. IGV</label>

                                            </div>

                                            <div class="col-lg-1">

                                            <label for="">Total</label>

                                            </div>

                                            <div class="col-lg-1">

                                            <label for="">OC</label>

                                            </div>

                                            <div class="col-lg-1">

                                            <label for="">Cerrar</label>

                                            </div>
                                    </div>

                                </div>                                

                                <!--=====================================
                                ENTRADA PARA AGREGAR PRODUCTO
                                ======================================-->

                                <div class="form-group row nuevaMPNI">


                                </div>

                                <hr>

                                <input type="hidden" id="listaNI" name="listaNI">

                                <div class="row">

                                    <!--=====================================
                                    ENTRADA IMPUESTOS Y TOTAL
                                    ======================================-->

                                    <div class="col-xs-6 pull-right">

                                        <table class="table">

                                            <thead>

                                                <tr>
                                                    <th>SubTotal</th>
                                                    <th>Impuesto</th>
                                                    <th>Total</th>
                                                </tr>

                                            </thead>

                                            <tbody>

                                                <tr>

                                                    <td style="width: 30%">

                                                        <div class="input-group">

                                                            <input type="number" step="any" class="form-control" min="0" id="nuevoSubTotalNi" name="nuevoSubTotalNi" placeholder="0" required readonly>
                                                            <span class="input-group-addon"><i class="fa fa-money"></i></span>

                                                            <input type="hidden" name="subTotalNi" id="subTotalNi">                                                            

                                                        </div>

                                                    </td>                                                

                                                    <td style="width: 30%">

                                                        <div class="input-group">

                                                            <input type="number" step="any" class="form-control" min="0" id="nuevoImpuestoNi" name="nuevoImpuestoNi" placeholder="0" required readonly>
                                                            <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                                                            <input type="hidden" name="impuestoNi" id="impuestoNi">

                                                        </div>

                                                    </td>

                                                    <td style="width: 40%">

                                                        <div class="input-group">

                                                            <span class="input-group-addon"><i class="fa fa-money"></i></span>

                                                            <input type="number" step="any" min="1" class="form-control" id="nuevoTotalNi" name="nuevoTotalNi" readonly required>

                                                            <input type="hidden" name="totalNi" id="totalNi">

                                                        </div>

                                                    </td>

                                                </tr>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                                <hr>

                                <br>

                            </div>

                        </div>

                        <div class="box-footer">

                            <button type="submit" class="btn btn-primary pull-right">Guardar Nota de Ingreso</button>

                            <a href="notas-ingresos"  class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancelar</a>

                        </div>

                    </form>

                    <?php

                    /* $crearNotaIngreso = new ControladorNotasIngresos();
                    $crearNotaIngreso -> ctrCrearNotaIngreso(); */

                    ?>                     

                </div>

            </div>

        </div>

    </section>

</div>

<script>
window.document.title = "Crear nota ingreso"
</script>