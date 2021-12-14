<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Equipos

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Equipos</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

        <div class="box-header with-border">

            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarEquipos">
            <i class="fa fa-plus-square"></i>
                Agregar modelo

            </button>

        </div>

        <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablaEquipos" width="100%"> 

                <thead>

                    <tr>

                        <th>Cod. Global</th>
                        <th>Cod. Tip</th>
                        <th>Nombre Tipo</th>
                        <th>Descripcion</th>
                        <th>Ubicación</th>
                        <th>Marca Equipo</th>
                        <th>Modelo Equipo</th>
                        <th>Serie Equipo</th>
                        <th>Tipo Motor</th>
                        <th>Marca Motor</th>
                        <th>Modelo Motor</th>
                        <th>Serie Motor</th>
                        <th>Marca Caja</th>
                        <th>Modelo Caja</th>
                        <th>Serie Caja</th>
                        <th>Estado</th>
                        <th style="width:100px">Acciones</th>

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
MODAL AGREGAR EQUIPOS
======================================-->
<div id="modalAgregarEquipos" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width:50%">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Equipo</h4>

        </div>

        <?php 
        date_default_timezone_set('America/Lima');
        $fecha = new DateTime();
        ?>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

            <div class="box-body">            
                
                <div class="form-group">

                    <!-- ENTRADA PARA EL CÓDIGO GLOBAL -->
                    <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">COD. GLOBAL</label>
                    <div class="col-lg-2">

                        <input type="text" class="form-control input-md"  name="nuevoCodGlobal"  id ="nuevoCodGlobal" readonly required>

                    </div>

                    <!-- ENTRADA PARA EL CÓDIGO TIPO -->
                    <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">COD. TIPO</label>
                    <div class="col-lg-2">

                        <input type="text" class="form-control input-md"  name="nuevoCodTipo"  id ="nuevoCodTipo" readonly required>

                    </div>
                    
                    <!-- ENTRADA PARA EL TIPO -->
                    <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">COD. TIPO</label>
                    <div class="col-lg-6">

                        <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevaLinea" id="nuevaLinea" data-size="10" required>
                        
                        <?php

                            $lineas = ControladorMateriaPrima::ctrMostrarLineas();

                            echo '<option value="">SELECCIONAR LINEAS</option>';

                            foreach ($lineas as $key => $value) {

                                echo '<option value="'.$value["Des_Corta"].'">'.$value["Des_Corta"].' - '.$value["Cod_Argumento"].' - '.$value["Des_Larga"].'</option>';

                            }

                        ?>
                        </select>

                    </div>                

                </div>

                <div class="col-lg-12"></div>

                <!-- ENTRADA PARA LA LINEA -->
                <div class="form-group" style ="padding-top:25px">

                <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">DESCRIPCION</label>
                <div class="col-lg-9">

                    <input type="text" class="form-control input-md" style="text-transform:uppercase;" name="nuevaDescripcion"  id="nuevaDescripcion" placeholder="Ingresar descripción"  required>

                </div> 

                </div>

                <div class="col-lg-12"></div>         
                
                <div class="form-group" style ="padding-top:25px">                
                
                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">LINEA</label>
                <div class="col-lg-5">

                    <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevaLinea" id="nuevaLinea" data-size="10" required>
                    
                    <?php

                        $lineas = ControladorMateriaPrima::ctrMostrarLineas();

                        echo '<option value="">SELECCIONAR LINEAS</option>';

                        foreach ($lineas as $key => $value) {

                            echo '<option value="'.$value["Des_Corta"].'">'.$value["Des_Corta"].' - '.$value["Cod_Argumento"].' - '.$value["Des_Larga"].'</option>';

                        }

                    ?>
                    </select>

                </div>

                </div>

                <!-- ENTRADA PARA LA SUB LINEA -->
                <div class="form-group" style ="padding-top:25px">
                
                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">SUB LINEA</label>
                <div class="col-lg-5">

                    <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevaSubLinea" id="nuevaSubLinea" data-size="10" required>
                    <option value="">SELECCIONAR SUBLINEAS</option>
                    
                    </select>

                </div>

                </div>

                <!-- ENTRADA PARA EL COLOR -->
                <div class="form-group" style ="padding-top:25px">
                
                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">COLOR</label>
                <div class="col-lg-5">

                    <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevoColorMateria" id="nuevoColorMateria" data-size="10" required>
                    
                    <?php

                        $colores = ControladorMateriaPrima::ctrMostrarColores();

                        echo '<option value="">SELECCIONAR COLOR</option>';

                        foreach ($colores as $key => $value) {

                            echo '<option value="'.$value["Cod_Argumento"].'">'.$value["Cod_Argumento"].' - '.$value["Des_Larga"].'</option>';

                        }

                    ?>
                    </select>

                </div>

                </div>

                <!-- ENTRADA PARA LA TALLA -->
                <div class="form-group" style ="padding-top:25px">
                
                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">TALLA</label>
                <div class="col-lg-5">

                    <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevaTallaMateria" id="nuevaTallaMateria" data-size="10" required>
                    
                    <?php

                        $tallas = ControladorMateriaPrima::ctrMostrarTallas();

                        echo '<option value="">SELECCIONAR TALLA</option>';

                        foreach ($tallas as $key => $value) {

                            echo '<option value="'.$value["Cod_Argumento"].'">'.$value["Cod_Argumento"].' - '.$value["Des_Larga"].'</option>';

                        }

                    ?>
                    </select>

                </div>

                </div>

                <div class="col-lg-12"></div>

                <!-- ENTRADA PARA LA DESCRIPCION -->
                <div class="form-group" style="padding-top:25px">

                
                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">DESCRIPCION</label>
                <div class="col-lg-11">

                    <input type="text" class="form-control input-md" style="text-transform:uppercase;" name="nuevaDescripcion"  id="nuevaDescripcionMat" placeholder="Ingresar descripción"  required>

                </div>

                </div>

                <!-- ENTRADA PARA LA UND. MEDIDA -->
                <div class="form-group" style ="padding-top:25px">
                
                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">UNID. MEDIDA</label>
                <div class="col-lg-2">

                    <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevaUnidadMedida" data-size="10" required>
                    
                    <?php
                        $item = null;
                        $valor = null;

                        $bancos = ControladorMateriaPrima::ctrMostrarUndMedida();

                        echo '<option value="">SELECCIONAR UNID MEDIDA</option>';

                        foreach ($bancos as $key => $value) {

                            echo '<option value="'.$value["Cod_Argumento"].'">'.$value["Cod_Argumento"].' - '.$value["Des_Larga"].' - '.$value["Des_Corta"].'</option>';

                        }

                    ?>
                    </select>

                </div>

                </div>
                
                <div class="col-lg-12"></div>

                <div class="form-group" style="padding-top:25px">

                <!-- ENTRADA PARA EL CÓDIGO FABRICA -->
                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">PESO</label>
                <div class="col-lg-2">

                    <input type="number" min = "0" step="any"  class="form-control input-md"  name="nuevoPeso"   value="0.00" >

                </div>
                <!-- ENTRADA PARA EL CÓDIGO ALTERNO-->
                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">%AD VAL</label>
                <div class="col-lg-2">
                
                    <input type="number" min = "0" step="any" class="form-control input-md"  name="nuevoAdVal"  value="0.00"  >
                </div>

                <!-- ENTRADA PARA LA FECHA DE EMISION -->
                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3 ">%SEGURO</label>
                <div class="col-lg-2">
                
                    <input type="number" min = "0" step="any" class="form-control input-md" name="nuevoSeguro" value="0.00"  >

                </div>

                </div>

                <div class="col-lg-12"></div>

                <div class="form-group" style="padding-top:25px">

                <!-- ENTRADA PARA EL CÓDIGO FABRICA -->
                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">STK ACTUAL</label>
                <div class="col-lg-2">

                    <input type="number" min = "0" step="any"  class="form-control input-md"  name="nuevoStockActual"   value="0.00"  readonly>

                </div>
                <!-- ENTRADA PARA EL CÓDIGO ALTERNO-->
                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">STK MIN</label>
                <div class="col-lg-2">
                
                    <input type="number" min = "0" step="any" class="form-control input-md"  name="nuevoStockMinimo"  value="0.00"  >
                </div>

                <!-- ENTRADA PARA LA FECHA DE EMISION -->
                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3 ">STK MAX.</label>
                <div class="col-lg-2">
                
                    <input type="number" min = "0" step="any" class="form-control input-md" name="nuevoStockMaximo" value="0.00"  >

                </div>

                </div>
                <div class="col-lg-12"></div>
                <label for="" style="padding-top:25px">PROVEEDORES X LISTA DE PRECIO</label>

                <div class="form-group" style="padding-top:25px">

                <!-- ENTRADA PARA EL CÓDIGO FABRICA -->
                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">PROVEEDOR</label>
                <div class="col-lg-5">

                    <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevoProveedor" id="nuevoProveedor" data-size="10">
                    
                    <?php
                        $item = null;
                        $valor = null;

                        $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);

                        echo '<option value="">SELECCIONAR PROVEEDOR</option>';

                        foreach ($proveedores as $key => $value) {

                            echo '<option value="'.$value["CodRuc"].'">'.$value["CodRuc"].' - '.$value["RazPro"].'</option>';

                        }

                    ?>
                    </select>

                </div>
                <!-- ENTRADA PARA EL CÓDIGO ALTERNO-->
                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">MONEDA</label>
                <div class="col-lg-2">
                
                    <input type="text" class="form-control input-md"  name="nuevaMoneda"  id="nuevaMoneda" readonly >
                </div>

                <!-- ENTRADA PARA LA FECHA DE EMISION -->
                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3 ">P S/IGV</label>
                <div class="col-lg-2">
                
                    <input type="number" min = "0" step="any" class="form-control input-md" name="nuevoPrecioSIGV"  >

                </div>

                </div>


                <div class="form-group" style="padding-top:25px">

                <!-- ENTRADA PARA EL CÓDIGO FABRICA -->
                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">PROVEEDOR</label>
                <div class="col-lg-5">

                    <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevoProveedor1" id="nuevoProveedor1" data-size="10">
                    
                    <?php
                        $item = null;
                        $valor = null;

                        $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);

                        echo '<option value="">SELECCIONAR PROVEEDOR</option>';

                        foreach ($proveedores as $key => $value) {

                            echo '<option value="'.$value["CodRuc"].'">'.$value["CodRuc"].' - '.$value["RazPro"].'</option>';

                        }

                    ?>
                    </select>

                </div>
                <!-- ENTRADA PARA EL CÓDIGO ALTERNO-->
                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">MONEDA</label>
                <div class="col-lg-2">
                
                    <input type="text" class="form-control input-md"  name="nuevaMoneda1" id="nuevaMoneda1"  readonly >
                </div>

                <!-- ENTRADA PARA LA FECHA DE EMISION -->
                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3 ">P S/IGV</label>
                <div class="col-lg-2">
                
                    <input type="number" min = "0" step="any" class="form-control input-md" name="nuevoPrecioSIGV1"  >

                </div>

                </div>

                <div class="form-group" style="padding-top:25px">

                <!-- ENTRADA PARA EL CÓDIGO FABRICA -->
                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">PROVEEDOR</label>
                <div class="col-lg-5">

                    <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevoProveedor2" id="nuevoProveedor2" data-size="10">
                    
                    <?php
                        $item = null;
                        $valor = null;

                        $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);

                        echo '<option value="">SELECCIONAR PROVEEDOR</option>';

                        foreach ($proveedores as $key => $value) {

                            echo '<option value="'.$value["CodRuc"].'">'.$value["CodRuc"].' - '.$value["RazPro"].'</option>';

                        }

                    ?>
                    </select>

                </div>
                <!-- ENTRADA PARA EL CÓDIGO ALTERNO-->
                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">MONEDA</label>
                <div class="col-lg-2">
                
                    <input type="text" class="form-control input-md"  name="nuevaMoneda2" id="nuevaMoneda2"   readonly >
                </div>

                <!-- ENTRADA PARA LA FECHA DE EMISION -->
                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3 ">P S/IGV</label>
                <div class="col-lg-2">
                
                    <input type="number" min = "0" step="any" class="form-control input-md" name="nuevoPrecioSIGV2"  >

                </div>

                </div>

                <div class="col-lg-12"></div>

                <!-- ENTRADA PARA LA OBSERVACION DE PROVEEDOR 1 -->
                <div class="form-group" style="padding-top:25px">

                <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">OBSERVACION PROV 1</label>
                <div class="col-lg-10">

                    <input type="text" class="form-control input-md" style="text-transform:uppercase;" name="nuevaObservacion1" placeholder="Ingresar observación de proveedor 1"  >

                </div>

                </div>

                <!-- ENTRADA PARA LA OBSERVACION DE PROVEEDOR 2 -->
                <div class="form-group" style="padding-top:25px">

                <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">OBSERVACION PROV 2</label>
                <div class="col-lg-10">

                    <input type="text" class="form-control input-md" style="text-transform:uppercase;"  name="nuevaObservacion2" placeholder="Ingresar observación de proveedor 2"  >

                </div>

                </div>

                <!-- ENTRADA PARA LA OBSERVACION DE PROVEEDOR 3 -->
                <div class="form-group" style="padding-top:25px">

                <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">OBSERVACION PROV 3</label>
                <div class="col-lg-10">

                    <input type="text" class="form-control input-md" style="text-transform:uppercase;" name="nuevaObservacion3" placeholder="Ingresar observación de proveedor 3"  >

                </div>

                </div>

            </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar materia prima</button>

        </div>

      </form>

      <?php

      $guardarMateriaPrima = new ControladorMateriaPrima();
      $guardarMateriaPrima -> ctrCrearMateriaPrima();

      ?>    

    </div>

  </div>

</div>

<script>
    window.document.title = "Equipos"
</script>