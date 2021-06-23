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

                    <form role="form" method="post" class="formularioNotaIngresoServ">

                        <div class="box-body">

                            <div class="box">

                            <?php 
                                date_default_timezone_set('America/Lima');
                                $fecha = new DateTime();
                            ?>

                                <div class="form-group" style="padding-top:5px;padding-bottom:30px">

                                    <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Proveedor</label>
                                    <div class="col-lg-2">

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

                                    <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Serie</label>
                                    <div class="col-lg-1">
                                        <input type="text" class="form-control input-sm" id="nuevaSerieP" name="nuevaSerieP" placeholder="Serie">
                                    </div>
                                    <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Nro</label>                                    
                                    <div class="col-lg-1">
                                        <input type="text" class="form-control input-sm" id="nuevoNroP" name="nuevoNroP" placeholder="Número">
                                    </div>                                    
                                    
                                </div>

                                <!--=====================================
                                        TITULOS
                                ======================================-->

                                <div class="box box-primary">

                                    <div class="row">
                                            <div class="col-lg-1">

                                            <label>CodOri</label>

                                            </div>

                                            <div class="col-lg-4">

                                            <label for="">Descripción Origen</label>

                                            </div>

                                            <div class="col-lg-1">

                                            <label for="">Color</label>

                                            </div>   
                                            
                                            <div class="col-lg-1">

                                            <label for="">CodDest</label>

                                            </div>

                                            <div class="col-lg-1">

                                            <label for="">Color</label>

                                            </div>  

                                            <div class="col-lg-1">

                                            <label for="">Saldo</label>

                                            </div>

                                            <div class="col-lg-1">

                                            <label for="">C. Recibida</label>

                                            </div>

                                            <div class="col-lg-1">

                                            <label for="">Nro OS</label>

                                            </div>

                                            <div class="col-lg-1">

                                            <label for="">Cerrar</label>

                                            </div>
                                    </div>

                                </div>                                

                                <!--=====================================
                                ENTRADA PARA AGREGAR PRODUCTO
                                ======================================-->

                                <div class="form-group row nuevaMPOS">


                                </div>

                                <hr>

                                <input type="hidden" id="listaOS" name="listaOS">

                                <hr>

                                <br>

                            </div>

                        </div>

                        <div class="box-footer">

                            <button type="submit" class="btn btn-primary pull-right">Guardar Nota de Ingreso</button>

                            <a href="notas-ingresos-os"  class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancelar</a>

                        </div>

                    </form>

                    <?php

                    $crearNotaIngreso = new ControladorNotasIngresos();
                    $crearNotaIngreso -> ctrCrearNotaIngresoServicio();

                    ?>                     

                </div>

            </div>

        </div>

    </section>

</div>

<script>
window.document.title = "Crear Ing. x Serv."
</script>