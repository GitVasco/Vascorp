<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar cuentas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar cuentas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCuenta">
          
          Agregar cuentas

        </button>

        <button class="btn btn-danger" data-toggle="modal" data-target="#modalImportarBanco">
          <i class="fa fa-university"></i>
          Importar cuentas

        </button>

        <button class="btn btn-warning" data-toggle="modal" data-target="#modalActualizarUnico">
          <i class="fa fa-university"></i>
          Actualizar numero unico

        </button>
        <div class="pull-right">
          <button class="btn btn-outline-success btnReporteColor" style="border:green 1px solid">
          <img src="vistas/img/plantilla/excel.png" width="20px"> Reporte cuentas  </button>
        </div>
      </div>
        
      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaCuentas">
         
        <thead>
         
         <tr>
           <th>Tipo Doc.</th>
           <th>Nro Doc.</th>
           <th>Cliente</th>
           <th>Vendedor</th>
           <th>Fecha</th>
           <th>Vencimiento</th>
           <th>Monto</th>
           <th>Saldo</th>
           <th>Estado doc.</th>
           <th>Nro. unico</th>
           <th>Doc. origen</th>
           <th>Acciones</th>

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
MODAL AGREGAR TIPO PAGO
======================================-->

<div id="modalAgregarCuenta" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 85% !important;">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cuenta</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group col-lg-2">
            <label for=""><b>Documento por cobrar</b></label>
            <label for=""><b>Tipo de documento</b></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <select type="text" class="form-control input-lg selectpicker" name="nuevoCodigo" data-live-search="true"  required>
                  <option value="">Seleccionar tipo de documento</option>

                    <?php
                    $item="tipo_dato";
                    $valor = "tdoc";

                    $documentos = ControladorCuentas::ctrMostrarPagos($item,$valor);
                    foreach ($documentos as $key => $value) {
                      echo '<option value="' . $value["codigo"] . '">' .$value["codigo"]. " - " . $value["descripcion"] . '</option>';
                    }

                    ?>   
                 </select>  
                
              </div>

            </div>          

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-3">
              <div style="margin-top:23px"></div>
              <label for=""><b>Nro de documento</b></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoDocumento" placeholder="Numero de documento" required>

              </div>

            </div>
            

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-7">
            <div style="margin-top:23px"></div>
            <label for=""><b>Notas</b></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-text-width"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaNota" placeholder="Ingresar nota" >

              </div>

            </div>
            <div class="col-lg-12"></div>
            <!-- ENTRADA PARA EL CLIENTE -->
            
            <div class="form-group col-lg-3">

            <label for=""><b>Cliente</b></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <select type="text" class="form-control input-lg selectpicker"  data-live-search="true" name="nuevoCliente"  required>
                <option value="">Seleccionar cliente</option>

                  <?php

                  $valor = null;

                  $marcas = ControladorClientes::ctrMostrarClientes($valor);

                  foreach ($marcas as $key => $value) {
                    echo '<option value="' . $value["codigo"] . '">' . $value["codigo"] ." - ". $value["nombre"] . '</option>';
                  }

                  ?>
                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL VENDEDOR -->
            
            <div class="form-group col-lg-2">
            <label for=""><b>Vendedor</b></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <select type="text" class="form-control input-lg selectpicker" name="nuevoVendedor" data-live-search="true"  required>
                  <option value="">Seleccionar vendedor</option>

                    <?php
                    $item=null;
                    $valor = null;

                    $vendedor = ControladorVendedores::ctrMostrarVendedores($item,$valor);

                    foreach ($vendedor as $key => $value) {
                      echo '<option value="' . $value["codigo"] . '">' . $value["codigo"] ." - ". $value["descripcion"] . '</option>';
                    }

                    ?>   
                 </select>    
              </div>

            </div>
            <!-- ENTRADA PARA EL RENOVAR -->  
            <div class="form-group col-lg-7">
              <div class="input-group">
                  <label for="">Renovación</label>
                  <label class="switch"> <input type="checkbox" name='renovacion' value="1"> <span class="slider round"></span></label>
                  <div style="margin-top:23px"></div>
                  <label for="">Protestado</label>
                  <label class="switch"> <input type="checkbox" name='protestado' value="1"> <span class="slider round"></span></label>
              </div>    
            </div>

            <div class="col-lg-12"></div>    
            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="form-group col-lg-4">
            <label for="">Fecha</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="nuevaFecha"  required>

              </div>

            </div>
            
            <!-- ENTRADA PARA EL banco -->
            
            <div class="form-group col-lg-4">
            <label for="">Banco</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <select type="text" class="form-control input-lg selectpicker" name="nuevoBanco" data-live-search="true"  required>
                  <option value="">Seleccionar banco</option>

                    <?php

                    $valor = null;

                    $bancos = ControladorBancos::ctrMostrarBancos($valor);

                    foreach ($bancos as $key => $value) {
                      echo '<option value="' . $value["codigo"] . '">' . $value["nombre"] . '</option>';
                    }

                    ?>   
                 </select>    
              </div>

            </div>
            <!-- ENTRADA PARA EL banco -->
            
            <div class="form-group col-lg-4">
              <label for=""><b>Doc. que genero la deuda</b></label>
              <div class="input-group">
                    
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <select type="text" class="form-control input-lg selectpicker" name="nuevoTipoDocumento" data-live-search="true"  required>
                  <option value="">Seleccionar tipo de documento</option>

                    <?php

                      $item="tipo_dato";
                      $valor = "tdoc";

                    $documentos = ControladorCuentas::ctrMostrarPagos($item,$valor);

                    foreach ($documentos as $key => $value) {
                      echo '<option value="' . $value["codigo"] . '">' .$value["codigo"]. " - " . $value["descripcion"] . '</option>';
                    }

                    ?>   
                 </select>    
              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-4">
            <label for="">Fecha de vencimiento</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="nuevaFechaVenc"  required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-4">
              <label for="">Nro. unico</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoUnico" placeholder="Ingresar nro. unico" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-4">
              <label for="">Doc. origen</label>
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoOrigen" placeholder="Ingresar documento" required>

              </div>

            </div>


            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-3">
            <label for="">Fecha de aceptación</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="nuevaFechaAcep"  required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
                        
            <div class="form-group col-lg-3">
            <label for="">Fecha de envio</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="nuevaFechaEnvio"  required>

              </div>

            </div>

            <div class="form-group col-lg-3">
            <label for="">Saldo</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

                <input type="number" min="0" step="any" class="form-control input-lg" name="nuevoSaldo" id="nuevoSaldo" readonly>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
                        
            <div class="form-group col-lg-3">
              <label for="">Fecha Ult. pago</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="nuevaFechaUltima"  >

              </div>

            </div>

            <!-- ENTRADA PARA EL VENDEDOR -->
            
            <div class="form-group col-lg-4">
              <label for="">Tipo de moneda</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

                <select type="text" class="form-control input-lg selectpicker" name="nuevaMoneda" data-live-search="true"  required>
                  <option value="">Seleccionar moneda</option>
                  <option value="Soles">Soles</option>
                  <option value="Dólares">Dólares</option>   
                 </select>    
              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
                        
            <div class="form-group col-lg-3">
              <label for="">Fecha de abono</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="nuevaFechaAbono" >

              </div>

            </div>
            <div class="form-group col-lg-5">
            <label for="">Estado</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-bolt"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoEstado1" id="nuevoEstado1" readonly>

              </div>
            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-2">
              <label for="">Monto</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

                <input type="number" min="0" step="any" class="form-control input-lg" name="nuevoMonto" id="nuevoMonto" placeholder="Ingresar monto" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-3">
              <label for="">Tipo de cambio</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

                <input type="number" min="0" step="any" class="form-control input-lg" name="nuevoTipoCambio" placeholder="Ingresar tipo de cambio" required>
                <input type="hidden" name="nuevoUsuario" value="<?php echo $_SESSION["id"];?>">
              </div>

            </div>

            <!-- ENTRADA PARA EL VENDEDOR -->
            
            <div class="form-group col-lg-3">
              <label for="">Estado de doc.</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

                <select type="text" class="form-control input-lg selectpicker" name="nuevoEstado" data-live-search="true"  required>
                  <option value="">Seleccionar estado de documento</option>
                  <option value="GENERADO">GENERADO</option>
                  <option value="ENVIADO">ENVIADO</option>   
                 </select>    
              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cuenta</button>

        </div>

      </form>


      <?php

        $crearCuenta = new ControladorCuentas();
        $crearCuenta -> ctrCrearCuenta();

      ?>


    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR TIPO PAGO
======================================-->

<div id="modalEditarCuenta" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 85% !important;">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar cuenta</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          
            <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group col-lg-2">
            <label for=""><b>Documento por cobrar</b></label>
            <label for=""><b>Tipo de documento</b></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <select type="text" class="form-control input-lg selectpicker" name="editarCodigo" id="editarCodigo" data-live-search="true"  required>
                  <option value="">Seleccionar tipo de documento</option>

                    <?php

                    $item="tipo_dato";
                    $valor="tdoc";
                    $documentos = ControladorCuentas::ctrMostrarPagos($item,$valor);

                    foreach ($documentos as $key => $value) {
                      echo '<option value="' . $value["codigo"] . '">' .$value["codigo"]. " - " . $value["descripcion"] . '</option>';
                    }

                    ?>   
                 </select>    
                <input type="hidden" id="editarUsuario" name="editarUsuario" value="<?php echo $_SESSION["id"]?>">
                <input type="hidden" id="idCuenta" name="idCuenta" >
              </div>

            </div>          

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-3">
              <div style="margin-top:23px"></div>
              <label for=""><b>Nro de documento</b></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span> 

                <input type="text" class="form-control input-lg" name="editarDocumento" id="editarDocumento" required>

              </div>

            </div>
            

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-7">
            <div style="margin-top:23px"></div>
            <label for=""><b>Notas</b></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-text-width"></i></span> 

                <input type="text" class="form-control input-lg" name="editarNota" id="editarNota" >

              </div>

            </div>
            <div class="col-lg-12"></div>
            <!-- ENTRADA PARA EL CLIENTE -->
            
            <div class="form-group col-lg-3">

            <label for=""><b>Cliente</b></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <select type="text" class="form-control input-lg selectpicker"  data-live-search="true" name="editarCliente" id="editarCliente"  required>
                <option value="">Seleccionar cliente</option>

                  <?php

                  $valor = null;

                  $marcas = ControladorClientes::ctrMostrarClientes($valor);

                  foreach ($marcas as $key => $value) {
                    echo '<option value="' . $value["codigo"] . '">' . $value["codigo"] ." - ". $value["nombre"] . '</option>';
                  }

                  ?>
                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL VENDEDOR -->
            
            <div class="form-group col-lg-2">
            <label for=""><b>Vendedor</b></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <select type="text" class="form-control input-lg selectpicker" name="editarVendedor" id="editarVendedor" data-live-search="true"  required>
                  <option value="">Seleccionar vendedor</option>

                    <?php
                    $item = null;
                    $valor = null;

                    $vendedor = ControladorVendedores::ctrMostrarVendedores($item,$valor);

                    foreach ($vendedor as $key => $value) {
                      echo '<option value="' . $value["codigo"] . '">'  . $value["codigo"] ." - ". $value["descripcion"] . '</option>';
                    }

                    ?>   
                 </select>    
              </div>

            </div>
            <!-- ENTRADA PARA EL RENOVAR -->  
            <div class="form-group col-lg-7">
              <div class="input-group">
                  <label for="">Renovación</label>
                  <label class="switch"> <input type="checkbox" name='editarRenovacion' id="editarRenovacion" value="1"> <span class="slider round"></span></label>
                  <div style="margin-top:23px"></div>
                  <label for="">Protestado</label>
                  <label class="switch"> <input type="checkbox" name='editarProtestado' id="editarProtestado" value="1"> <span class="slider round"></span></label>
              </div>    
            </div>

            <div class="col-lg-12"></div>    
            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="form-group col-lg-4">
            <label for="">Fecha</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="editarFecha" id="editarFecha"  required>

              </div>

            </div>
            
            <!-- ENTRADA PARA EL banco -->
            
            <div class="form-group col-lg-4">
            <label for="">Banco</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <select type="text" class="form-control input-lg selectpicker" name="editarBanco" id="editarBanco" data-live-search="true"  required>
                  <option value="">Seleccionar banco</option>

                    <?php

                    $valor = null;

                    $bancos = ControladorBancos::ctrMostrarBancos($valor);

                    foreach ($bancos as $key => $value) {
                      echo '<option value="' . $value["codigo"] . '">' . $value["nombre"] . '</option>';
                    }

                    ?>   
                 </select>    
              </div>

            </div>
            <!-- ENTRADA PARA EL banco -->
            
            <div class="form-group col-lg-4">
              <label for=""><b>Doc. que genero la deuda</b></label>
              <div class="input-group">
                    
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <select type="text" class="form-control input-lg selectpicker" name="editarTipoDocumento" id="editarTipoDocumento" data-live-search="true"  required>
                  <option value="">Seleccionar tipo de documento</option>

                    <?php
                      $item="tipo_dato";
                      $valor = "tdoc";

                    $documentos = ControladorCuentas::ctrMostrarPagos($item,$valor);

                    foreach ($documentos as $key => $value) {
                      echo '<option value="' . $value["codigo"] . '">' .$value["codigo"]. " - " . $value["descripcion"] . '</option>';
                    }

                    ?>   
                 </select>    
              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-4">
            <label for="">Fecha de vencimiento</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="editarFechaVenc" id="editarFechaVenc" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-4">
              <label for="">Nro. unico</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span> 

                <input type="text" class="form-control input-lg" name="editarUnico" id="editarUnico"  required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-4">
              <label for="">Doc. origen</label>
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span> 

                <input type="text" class="form-control input-lg" name="editarOrigen" id="editarOrigen" required>

              </div>

            </div>


            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-3">
            <label for="">Fecha de aceptación</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="editarFechaAcep" id="editarFechaAcep" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
                        
            <div class="form-group col-lg-3">
            <label for="">Fecha de envio</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="editarFechaEnvio" id="editarFechaEnvio"  required>

              </div>

            </div>

            <div class="form-group col-lg-3">
            <label for="">Saldo</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

                <input type="number" min="0" step="any" class="form-control input-lg" name="editarSaldo" id="editarSaldo" readonly>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
                        
            <div class="form-group col-lg-3">
              <label for="">Fecha Ult. pago</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="editarFechaUltima" id="editarFechaUltima" >

              </div>

            </div>

            <!-- ENTRADA PARA EL VENDEDOR -->
            
            <div class="form-group col-lg-4">
              <label for="">Tipo de moneda</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

                <select type="text" class="form-control input-lg selectpicker" name="editarMoneda" id="editarMoneda" data-live-search="true"  required>
                  <option value="">Seleccionar moneda</option>
                  <option value="Soles">Soles</option>
                  <option value="Dólares">Dólares</option>   
                 </select>    
              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
                        
            <div class="form-group col-lg-3">
              <label for="">Fecha de abono</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="editarFechaAbono" id="editarFechaAbono">

              </div>

            </div>
            <div class="form-group col-lg-5">
            <label for="">Estado</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-bolt"></i></span> 

                <input type="text" class="form-control input-lg" name="editarEstado1"  id="editarEstado1" readonly>

              </div>
            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-2">
              <label for="">Monto</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

                <input type="number" min="0" step="any" class="form-control input-lg" name="editarMonto"  id="editarMonto" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-3">
              <label for="">Tipo de cambio</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

                <input type="number" min="0" step="any" class="form-control input-lg" name="editarTipoCambio" id="editarTipoCambio" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL VENDEDOR -->
            
            <div class="form-group col-lg-3">
              <label for="">Estado de doc.</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

                <select type="text" class="form-control input-lg selectpicker" name="editarEstado" id="editarEstado" data-live-search="true"  required>
                  <option value="">Seleccionar estado de documento</option>
                  <option value="GENERADO">GENERADO</option>
                  <option value="ENVIADO">ENVIADO</option>   
                 </select>    
              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      </form>

      <?php

        $editarCuenta = new ControladorCuentas();
        $editarCuenta -> ctrEditarCuenta();

      ?>   


    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR TIPO PAGO
======================================-->

<div id="modalCancelarCuenta" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 85% !important;">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Cancelar cuenta</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          
            <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group col-lg-4">
            <label for=""><b>Documento por cancelar</b></label><br>
            <label for=""><b>Tipo de cancelacion</b></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <select type="text" class="form-control input-lg selectpicker" name="cancelarCodigo" id="cancelarCodigo" data-live-search="true"  required>
                  <option value="">Seleccionar tipo de cancelacion</option>

                    <?php
                      $item= "tipo_dato";
                      $valor = "TCAN";

                    $documentos = ControladorCuentas::ctrMostrarPagos($item,$valor);

                    foreach ($documentos as $key => $value) {
                      echo '<option value="' . $value["codigo"] . '">' .$value["codigo"]. " - " . $value["descripcion"] . '</option>';
                    }

                    ?>   
                 </select>    
                <input type="hidden" id="cancelarUsuario" name="cancelarUsuario" value="<?php echo $_SESSION["id"]?>">
                <input type="hidden" id="idCuenta2" name="idCuenta2" >
              </div>

            </div>          

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-2">
              <div style="margin-top:23px"></div>
              <label for=""><b>Nro de documento</b></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span> 

                <input type="text" class="form-control input-lg" name="cancelarDocumento" id="cancelarDocumento" required>

              </div>

            </div>

           <!-- ENTRADA PARA LA FECHA  --> 
            <div class="form-group col-lg-2">
            <div style="margin-top:23px"></div>
              <label for="">Fecha </label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="cancelarFechaUltima" id="cancelarFechaUltima"  required>

              </div>

            </div>

            <!-- ENTRADA PARA LA NOTA -->
            
            <div class="form-group col-lg-3">
            <div style="margin-top:23px"></div>
            <label for=""><b>Notas</b></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-text-width"></i></span> 

                <input type="text" class="form-control input-lg" name="cancelarNota" id="cancelarNota" required>

              </div>

            </div>
            
            
            <div class="form-group col-lg-1">
            <div style="margin-top:23px"></div>
            <label for="">Monto </label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

                <input type="number" min="0" step="any" class="form-control input-lg" name="cancelarMonto" id="cancelarMonto" value="0">
                <input type="hidden"  id="cancelarSaldo" >
                <input type="hidden"  id="cancelarVendedor" name="cancelarVendedor" >
                <input type="hidden"  id="cancelarCliente" name="cancelarCliente" >

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Cancelar cuenta</button>

        </div>

      </form>

      <?php

        $cancelarCuenta = new ControladorCuentas();
        $cancelarCuenta -> ctrCancelarCuenta();

      ?>   


    </div>

  </div>

</div>


<div id="modalAgregarLetras" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 55% !important;">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Letras</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          
            <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group col-lg-2">
            <label for=""><b>Tipo de documento</b></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 
                <input type="text" class="form-control input-lg" name="letraCodigo" id="letraCodigo" readonly>
                   
                <input type="hidden" id="letraUsuario" name="letraUsuario" value="<?php echo $_SESSION["id"]?>">
                <input type="hidden" id="idCuenta3" name="idCuenta3" >
              </div>

            </div>          

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-4">
              <label for=""><b>Nro de documento</b></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span> 

                <input type="text" class="form-control input-lg" name="letraDocumento" id="letraDocumento" readonly>

              </div>

            </div>
            

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-3">
            <label for=""><b>Fecha</b></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-text-width"></i></span> 

                <input type="date" class="form-control input-lg" name="letraFecha" id="letraFecha" readonly>

              </div>

            </div>
            <div class="col-lg-12"></div>
            <!-- ENTRADA PARA EL CLIENTE -->
            
            <div class="form-group col-lg-2">

            <label for=""><b>Cliente</b></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="letraCli" id="letraCli" readonly>    
              </div>

            </div>

            <div class="form-group col-lg-6">
            <label for="">Nombres</label>
              <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span> 
              <input type="text" class="form-control input-lg" name="letraCliente" id="letraCliente" readonly>    
              </div>

            </div>

            <!-- ENTRADA PARA EL VENDEDOR -->
            
            <div class="form-group col-lg-2">
            <label for=""><b>Vendedor</b></label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="letraVendedor" id="letraVendedor" readonly>    
                <input type="hidden" class="form-control input-lg" name="letraMoneda" id="letraMoneda" >
              </div>

            </div>
            <div class="col-lg-12"></div>


            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-2">
              <label for="">Monto</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

                <input type="number" min="0" step="any" class="form-control input-lg" name="letraMonto"  id="letraMonto" readonly>

              </div>

            </div>

            <div class="form-group col-lg-2">
              <label for="">Saldo</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

                <input type="number" min="0" step="any" class="form-control input-lg" name="letraSaldo"  id="letraSaldo" readonly>

              </div>

            </div>
            <div class="col-lg-8"></div>
            <div class="col-lg-12"></div>

            <div class="col-lg-3">
              <div class="input-group">
                <span  class="input-group-addon"><b>N° letras</b></span>

                <input type="number" min="0"  class="form-control input-lg" name="nroLetra"  id="nroLetra" required>

              </div>

            </div>

            <div class="col-lg-3">
              <div class="input-group">
                <span  class="input-group-addon"><b>Vencen cada</b></span>

                <input type="number" min="0"  class="form-control input-lg" name="sumaFecha"  id="sumaFecha" required>

              </div>

            </div>

            <div class="col-lg-2">
                <input type="number" min="0"  class="form-control input-lg" name="sumaIntervalo"  id="sumaIntervalo" required>
            </div>

            <div class="col-lg-4">
                <div style="margin-top:5px"></div>
                <button type="button" class="btn btn-primary btnGenerarLetra" ><i class="fa fa-refresh"></i> Generar</button>
                <button type="button" class="btn btn-danger btnLimpiarLetra" ><i class="fa fa-trash"></i> Limpiar</button>
            </div>
          
            <div class="col-lg-12">
            <!--=====================================
                    TITULOS
            ======================================-->
            <br>
            <div class="box box-primary">

              <div class="col-lg-3">

                  <label>Vencimiento</label>

              </div>

              <div class="col-lg-6">

                  <label for="">Observaciones</label>

              </div>

              <div class="col-lg-2">

                  <label for="">Monto</label>

              </div>

            </div>
            </div>
            <div class="listaLetras"></div>
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar letras</button>

        </div>

      </form>

      <?php

        $agregarLetra = new ControladorCuentas();
        $agregarLetra -> ctrAgregarLetra();

      ?>   


    </div>

  </div>

</div>


<!--=====================================
MODAL IMPORTAR CUENTAS DE BANCO
======================================-->

<div id="modalImportarBanco" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Importar cuentas de banco</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group">
            <label for=""><h3>Archivo de banco</h3></label>
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="file" min="0" class="form-control input-lg" name="nuevaImportacion" id="nuevaImportacion"  required>

              </div>

            </div>        

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="importBanco">Importar cuentas</button>

        </div>

      </form>


      <?php

        $importarBanco = new ControladorCuentas();
        $importarBanco -> ctrImportarCuenta();

      ?>


    </div>

  </div>

</div>

<!--=====================================
MODAL IMPORTAR CUENTAS DE BANCO
======================================-->

<div id="modalActualizarUnico" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Importar letras</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group">
            <label for=""><h3>Archivo de banco para letras</h3></label>
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="file" min="0" class="form-control input-lg" name="nuevaUnico" id="nuevaUnico"  required>

              </div>

            </div>        

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="importLetra">Importar letras</button>

        </div>

      </form>


      <?php

        $importarLetra = new ControladorCuentas();
        $importarLetra -> ctrImportarLetra();

      ?>


    </div>

  </div>

</div>

<?php

  $eliminarCuenta = new ControladorCuentas();
  $eliminarCuenta -> ctrEliminarCuenta();

?>

<script>
window.document.title = "Cuentas"
</script>