<div class="content-wrapper">

  <section class="content-header">  
    
    <h1>
      
      Administrar proveedores
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar proveedores</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProveedor">
          
          Agregar proveedor

        </button>

        <div class="pull-right">
          <button class="btn btn-outline-success btnReporteColor" style="border:green 1px solid">
          <img src="vistas/img/plantilla/excel.png" width="20px"> Reporte proveedores  </button>
        </div>
      </div>
        
      <div class="box-body">
        <input type="hidden" value="<?=$_SESSION["perfil"];?>" id="perfilOculto">
        
       <table class="table table-bordered table-striped dt-responsive tablaProveedores">
         
        <thead>
         
         <tr>
           
           <th>Codigo</th>
           <th>RUC</th>
           <th>Razon Social</th>
           <th>Direccion</th>
           <th>Telefono 1</th>
           <th>Email 1</th>
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

<div id="modalAgregarProveedor" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 75% !important">

    <div class="modal-content ">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar proveedor</h4>
          <?php 
            $ultimoCod = ControladorProveedores::ctrMostrarUltimoCodRuc();

            $suma = $ultimoCod["CodRuc"]+1;
            $codigo = str_pad($suma,strlen($ultimoCod["CodRuc"]),'0',STR_PAD_LEFT);
          ?>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" style="padding-top:0px !important">

          <div class="box-body" >
            
            <div  class="form-group" id="alertaRUC">
              <label for=""  class="col-form-label col-lg-1 col-md-1">TIPO</label>

              <div class="col-lg-3 col-md-3">

                  <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevoTipoProv" required>
                    <option value="">Seleccionar tipo </option>
                    <?php
                      $item="tipo_dato";
                      $valor = "TNAC";

                      $documentos = ControladorCuentas::ctrMostrarPagos($item,$valor);
                      foreach ($documentos as $key => $value) {
                        echo '<option value="' . $value["codigo"] . '">' .$value["codigo"]. " - " . $value["descripcion"] . '</option>';
                      }

                    ?>
                  </select>

              </div>

              <label for=""  class="col-form-label col-lg-1 col-md-1">RUC</label>

              <div class="col-lg-3 col-md-3">

                  <input type="number"  class="form-control input-md" name="nuevoRUC" placeholder="Ingresar RUC" id = "nuevoRucPro" required>

              </div>

              <label for="" class="col-form-label col-lg-1 col-md-1">CODIGO</label>

              <div class="col-lg-3 col-md-3">

                <input type="text" class="form-control input-md" name="nuevoCodigoPro" value="<?php echo $codigo ?>"readonly>

              </div>


            </div>    


            <!-- ENTRADA PARA RAZON SOCIAL -->
            
            <div class="form-group" style="padding-top:25px">
              <label for="" class="col-form-label col-lg-1 col-md-2 col-sm-3">RAZ SOCIAL</label>
              <div class="col-lg-11 col-md-10 col-sm-9">

                <input type="text" style="text-transform:uppercase;" class="form-control input-md" name="nuevaRazPro" placeholder="Ingresar razon social" required>

              </div>

            </div>

            <!-- ENTRADA PARA DIRECCION -->
            
            <div class="form-group " style="padding-top:25px">
              <label for="" class="col-form-label col-lg-1 col-md-2 col-sm-3">DIRECCION</label>
              <div class="col-lg-11 col-md-10 col-sm-9">
              
                <input type="text" style="text-transform:uppercase;" class="form-control input-md" name="nuevaDireccion" placeholder="Ingresar direccion" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL UBIGEO -->
            
            <div class="form-group " style="padding-top:25px">
              <label for="" class="col-form-label col-lg-1 col-md-2 col-sm-3">DISTRITO</label>
              <div class="col-lg-11 col-md-10 col-sm-9">

                <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevoUbiPro" required>
                  <option value="">Seleccionar ubigeo</option>
                  <?php
                     $ubigeo = ControladorClientes::ctrMostrarUbigeos();
                     #var_dump("ubigeo", $ubigeo);
                     foreach ($ubigeo as $key => $value) {
 
                       echo '<option value="' . $value["codigo"] . '">' . $value["codigo"] . ' - ' . $value["ubigeo"] . '</option>';
 
                     }
 

                  ?>
                </select>

              </div>

            </div> 

            <!-- ENTRADA PARA TELEFONO -->
            
            <div class="form-group " style="padding-top:25px">
              <label for="" class="col-form-label col-lg-1 col-md-2">TELEFONOS</label>
              <div class="col-lg-2 col-md-2">
            
                <input type="text" style="text-transform:uppercase;" class="form-control input-md" name="nuevoTlf1" placeholder="Ingresar telefono 1" >

              </div>
              <div class="col-lg-2 col-md-2">
              
                <input type="text" style="text-transform:uppercase;" class="form-control input-md" name="nuevoTlf2" placeholder="Ingresar telefono 2" >

              </div>

              <div class="col-lg-2 col-md-2">
              
                <input type="text" style="text-transform:uppercase;" class="form-control input-md" name="nuevoTlf3" placeholder="Ingresar telefono 3" >

              </div>

               <div class="col-lg-2 col-md-2">

                <input type="text" style="text-transform:uppercase;" class="form-control input-md" name="nuevoTlf4" placeholder="Ingresar telefono 4" >

              </div>

            </div>
            <div class="col-lg-12 "></div>

            <!-- ENTRADA PARA CONTACTO -->
            
            <div class="form-group " style="padding-top:25px">
              <label for="" class="col-form-label col-lg-1 col-md-2 col-sm-3">CONTACTO</label>
              <div class="col-lg-11 col-md-10 col-sm-9">
              
                <input type="text" style="text-transform:uppercase;" class="form-control input-md" name="nuevoContacto" placeholder="Ingresar contacto" >

              </div>

            </div>   

            <!-- ENTRADA PARA EMAIL -->
            
            <div class="form-group " style="padding-top:25px">
              <label for="" class="col-form-label col-lg-1 col-md-2">EMAIL</label>
              <div class="col-lg-5 col-md-5">
              
                <input type="email" style="text-transform:uppercase;" class="form-control input-md" name="nuevoEmail1" placeholder="Ingresar email 1" >

              </div>

              <div class="col-lg-5 col-md-5">

                <input type="email" style="text-transform:uppercase;" class="form-control input-md" name="nuevoEmail2" placeholder="Ingresar email 2" >

              </div>
            </div>   

            <!-- ENTRADA PARA PAGINA -->
           
            <div class="form-group " style="padding-top:25px">
              <label for=""  class="col-form-label col-lg-1 col-md-2 col-sm-3">PAGINA WEB</label>
              <div class="col-lg-5 col-md-5 col-sm-5">
              
                <input type="text" style="text-transform:uppercase;" class="form-control input-md" name="nuevaWeb" placeholder="Ingresar pagina web" >

              </div>

            </div>   
            <div class="col-lg-12"></div>

            <div class="form-group"  style="padding-top:25px">
              <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">T. ENTREGA</label>
              <div class="col-lg-3 col-md-3 col-sm-3">

                <input type="number" style="text-transform:uppercase;" class="form-control input-md" name="nuevoTipoEntr" placeholder="Ingresar tiempo entrega dias" >

              </div>

              <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">PAGO</label>
              <div class="col-lg-3 col-md-3 col-sm-3">

                <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevaFormaPago" >
                  
                  <?php
                    $item = null;
                    $valor = null;

                    $condiciones = ControladorCondicionVentas::ctrMostrarCondicionVentas($item, $valor);

                    echo '<option value="">Seleccionar forma de pago</option>';

                    foreach ($condiciones as $key => $value) {

                        echo '<option value="'.$value["codigo"].'">'.$value["codigo"].' - '.$value["descripcion"].'</option>';

                    }

                  ?>
                </select>

              </div>

              <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">DIAS</label>
              <div class="col-lg-3 col-md-3 col-sm-3">

                <input type="text" style="text-transform:uppercase;" class="form-control input-md" name="nuevoDias" placeholder="Ingresar nro dia" >

              </div>

            </div>  

            <!-- ENTRADA PARA EL BANCO MONEDA Y NRO CUENTA-->
            
            <div class="form-group" style="padding-top:25px">
              <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">BANCO</label>
              <div class="col-lg-3 col-md-3 col-sm-3">
              
                <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevoBanco" >
                  
                  <?php
                    $item = null;
                    $valor = null;

                    $bancos = ControladorBancos::ctrMostrarBancos($item, $valor);

                    echo '<option value="">Seleccionar banco</option>';

                    foreach ($bancos as $key => $value) {

                        echo '<option value="'.$value["codigo"].'">'.$value["codigo"].' - '.$value["descripcion"].'</option>';

                    }

                  ?>
                </select>

              </div>

              <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">MONEDA</label>
              <div class="col-lg-3 col-md-3 col-sm-3">
               
                <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevaMoneda" >
                  <option value="">Seleccionar moneda</option>
                  <option value="1">1-Soles</option>
                  <option value="2">2-Dólares</option>   
                </select>

              </div>

              <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">N° CUENTA</label>
              <div class="col-lg-3 col-md-3 col-sm-3">
              

                <input type="text" style="text-transform:uppercase;" class="form-control input-md" name="nuevoNroCuenta" placeholder="Ingresar nro cuenta" >

              </div>

            </div>    

            <!-- ENTRADA PARA EL BANCO1 MONEDA1 Y NRO CUENTA1-->

            <div class="form-group" style="padding-top:25px">
              <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">BANCO1</label>
              <div class="col-lg-3 col-md-3 col-sm-3">
              
                <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevoBanco1" >
                  
                  <?php
                    $item = null;
                    $valor = null;

                    $bancos = ControladorBancos::ctrMostrarBancos($item, $valor);

                    echo '<option value="">Seleccionar banco</option>';

                    foreach ($bancos as $key => $value) {

                        echo '<option value="'.$value["codigo"].'">'.$value["codigo"].' - '.$value["descripcion"].'</option>';

                    }

                  ?>
                </select>

              </div>

              <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">MONEDA1</label>
              <div class="col-lg-3 col-md-3 col-sm-3">
               
                <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevaMoneda1" >
                  <option value="">Seleccionar moneda</option>
                  <option value="1">1-Soles</option>
                  <option value="2">2-Dólares</option>   
                </select>

              </div>

              <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">N° CUENTA1</label>
              <div class="col-lg-3 col-md-3 col-sm-3">
              

                <input type="text" style="text-transform:uppercase;" class="form-control input-md" name="nuevoNroCuenta1" placeholder="Ingresar nro cuenta 1" >

              </div>

            </div>   

           
            <!-- ENTRADA PARA OBSERVACIONES -->
            <div class="col-sm-12"></div>
            <div class="form-group" style="padding-top:25px">
              <label for="" class="col-form-label col-lg-1 col-md-2 col-sm-3">OBSERVACION</label>
              <div class="col-lg-11 col-md-10 col-sm-9">
            
                <input type="text" style="text-transform:uppercase;" class="form-control input-md" name="nuevaObservacion" placeholder="Ingresar observacion" >

              </div>

            </div>       


          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar proveedor</button>

        </div>

      </form>


      <?php

        $crearProveedor = new ControladorProveedores();
        $crearProveedor -> ctrCrearProveedor();

      ?>


    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR PROVEEDOR
======================================-->

<div id="modalEditarProveedor" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width:75% !important">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar proveedor</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          
          <div  class="form-group" id="alertaRUC2">
              <label for=""  class="col-form-label col-lg-1 col-md-1">TIPO</label>

              <div class="col-lg-3 col-md-3">

                  <select  class="form-control input-md selectpicker" data-live-search="true" name="editarTipoProv" id="editarTipoProv" required>
                    
                    <?php
                      $item="tipo_dato";
                      $valor = "TNAC";

                      $documentos = ControladorCuentas::ctrMostrarPagos($item,$valor);
                      foreach ($documentos as $key => $value) {
                        echo '<option value="' . $value["codigo"] . '">' .$value["codigo"]. " - " . $value["descripcion"] . '</option>';
                      }

                    ?>
                  </select>

              </div>

              <label for=""  class="col-form-label col-lg-1 col-md-1">RUC</label>

              <div class="col-lg-3 col-md-3">

                  <input type="number"  class="form-control input-md" name="editarRUC"  id = "editarRucPro" required>

              </div>

              <label for="" class="col-form-label col-lg-1 col-md-1">CODIGO</label>

              <div class="col-lg-3 col-md-3">

                <input type="text" class="form-control input-md" name="editarCodigoPro" id="editarCodigoPro" readonly>

              </div>


            </div>    


            <!-- ENTRADA PARA RAZON SOCIAL -->
            
            <div class="form-group" style="padding-top:25px">
              <label for="" class="col-form-label col-lg-1 col-md-2 col-sm-3">RAZ SOCIAL</label>
              <div class="col-lg-11 col-md-10 col-sm-9">

                <input type="text" style="text-transform:uppercase;" class="form-control input-md" name="editarRazPro"  id="editarRazPro" required>

              </div>

            </div>

            <!-- ENTRADA PARA DIRECCION -->
            
            <div class="form-group " style="padding-top:25px">
              <label for="" class="col-form-label col-lg-1 col-md-2 col-sm-3">DIRECCION</label>
              <div class="col-lg-11 col-md-10 col-sm-9">
              
                <input type="text" style="text-transform:uppercase;" class="form-control input-md" name="editarDireccion" id="editarDireccion"  required>

              </div>

            </div>

            <!-- ENTRADA PARA EL UBIGEO -->
            
            <div class="form-group " style="padding-top:25px">
              <label for="" class="col-form-label col-lg-1 col-md-2 col-sm-3">DISTRITO</label>
              <div class="col-lg-11 col-md-10 col-sm-9">

                <select  class="form-control input-md selectpicker" data-live-search="true" name="editarUbiPro" id="editarUbiPro" required>
                  
                  <?php
                     $ubigeo = ControladorClientes::ctrMostrarUbigeos();
                     #var_dump("ubigeo", $ubigeo);
                     foreach ($ubigeo as $key => $value) {
 
                       echo '<option value="' . $value["codigo"] . '">' . $value["codigo"] . ' - ' . $value["ubigeo"] . '</option>';
 
                     }
 

                  ?>
                </select>

              </div>

            </div> 

            <!-- ENTRADA PARA TELEFONO -->
            
            <div class="form-group " style="padding-top:25px">
              <label for="" class="col-form-label col-lg-1 col-md-2">TELEFONOS</label>
              <div class="col-lg-2 col-md-2">
            
                <input type="text" style="text-transform:uppercase;" class="form-control input-md" name="editarTlf1" id="editarTlf1" >

              </div>
              <div class="col-lg-2 col-md-2">
              
                <input type="text" style="text-transform:uppercase;" class="form-control input-md" name="editarTlf2" id="editarTlf2" >

              </div>

              <div class="col-lg-2 col-md-2">
              
                <input type="text" style="text-transform:uppercase;" class="form-control input-md" name="editarTlf3" id="editarTlf3" >

              </div>

               <div class="col-lg-2 col-md-2">

                <input type="text" style="text-transform:uppercase;" class="form-control input-md" name="editarTlf4" id="editarTlf4" >

              </div>

            </div>
            <div class="col-lg-12 "></div>

            <!-- ENTRADA PARA CONTACTO -->
            
            <div class="form-group " style="padding-top:25px">
              <label for="" class="col-form-label col-lg-1 col-md-2 col-sm-3">CONTACTO</label>
              <div class="col-lg-11 col-md-10 col-sm-9">
              
                <input type="text" style="text-transform:uppercase;" class="form-control input-md" name="editarContacto" id="editarContacto" >

              </div>

            </div>   

            <!-- ENTRADA PARA EMAIL -->
            
            <div class="form-group " style="padding-top:25px">
              <label for="" class="col-form-label col-lg-1 col-md-2">EMAIL</label>
              <div class="col-lg-5 col-md-5">
              
                <input type="email" style="text-transform:uppercase;" class="form-control input-md" name="editarEmail1" id="editarEmail1">

              </div>

              <div class="col-lg-5 col-md-5">

                <input type="email" style="text-transform:uppercase;" class="form-control input-md" name="editarEmail2" id="editarEmail2">

              </div>
            </div>   

            <!-- ENTRADA PARA PAGINA -->
           
            <div class="form-group " style="padding-top:25px">
              <label for=""  class="col-form-label col-lg-1 col-md-2 col-sm-3">PAGINA WEB</label>
              <div class="col-lg-5 col-md-5 col-sm-5">
              
                <input type="text" style="text-transform:uppercase;" class="form-control input-md" name="editarWeb" id="editarWeb" >

              </div>

            </div>   
            <div class="col-lg-12"></div>

            <div class="form-group"  style="padding-top:25px">
              <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">T. ENTREGA</label>
              <div class="col-lg-3 col-md-3 col-sm-3">

                <input type="number" class="form-control input-md" name="editarTipoEntr"  id="editarTipoEntr" >

              </div>

              <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">PAGO</label>
              <div class="col-lg-3 col-md-3 col-sm-3">

                <select  class="form-control input-md selectpicker" data-live-search="true" name="editarFormaPago" id="editarFormaPago">
                  
                  <?php
                    $item = null;
                    $valor = null;

                    $condiciones = ControladorCondicionVentas::ctrMostrarCondicionVentas($item, $valor);


                    foreach ($condiciones as $key => $value) {

                        echo '<option value="'.$value["codigo"].'">'.$value["codigo"].' - '.$value["descripcion"].'</option>';

                    }

                  ?>
                </select>

              </div>

              <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">DIAS</label>
              <div class="col-lg-3 col-md-3 col-sm-3">

                <input type="text" style="text-transform:uppercase;" class="form-control input-md" name="editarDias" id="editarDias">

              </div>

            </div>  

            <!-- ENTRADA PARA EL BANCO MONEDA Y NRO CUENTA-->
            
            <div class="form-group" style="padding-top:25px">
              <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">BANCO</label>
              <div class="col-lg-3 col-md-3 col-sm-3">
              
                <select  class="form-control input-md selectpicker" data-live-search="true" name="editarBanco" id="editarBanco">
                  <option value="">Seleccionar Banco</option>
                  <?php
                    $item = null;
                    $valor = null;

                    $bancos = ControladorBancos::ctrMostrarBancos($item, $valor);


                    foreach ($bancos as $key => $value) {

                        echo '<option value="'.$value["codigo"].'">'.$value["codigo"].' - '.$value["descripcion"].'</option>';

                    }

                  ?>
                </select>

              </div>

              <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">MONEDA</label>
              <div class="col-lg-3 col-md-3 col-sm-3">
               
                <select  class="form-control input-md selectpicker" data-live-search="true" name="editarMoneda" id="editarMoneda" >
                  <option value="">Seleccionar Moneda</option>
                  <option value="1">1-Soles</option>
                  <option value="2">2-Dólares</option>   
                </select>

              </div>

              <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">N° CUENTA</label>
              <div class="col-lg-3 col-md-3 col-sm-3">
              

                <input type="text"  style="text-transform:uppercase;" class="form-control input-md" name="editarNroCuenta" id="editarNroCuenta"  >

              </div>

            </div>    

            <!-- ENTRADA PARA EL BANCO1 MONEDA1 Y NRO CUENTA1-->

            <div class="form-group" style="padding-top:25px">
              <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">BANCO1</label>
              <div class="col-lg-3 col-md-3 col-sm-3">
              
                <select  class="form-control input-md selectpicker" data-live-search="true" name="editarBanco1" id="editarBanco1" >
                  <option value="">Seleccionar Banco</option>
                  <?php
                    $item = null;
                    $valor = null;

                    $bancos = ControladorBancos::ctrMostrarBancos($item, $valor);

                    foreach ($bancos as $key => $value) {

                        echo '<option value="'.$value["codigo"].'">'.$value["codigo"].' - '.$value["descripcion"].'</option>';

                    }

                  ?>
                </select>

              </div>

              <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">MONEDA1</label>
              <div class="col-lg-3 col-md-3 col-sm-3">
               
                <select  class="form-control input-md selectpicker" data-live-search="true" name="editarMoneda1" id="editarMoneda1">
                  <option value="">Seleccionar Moneda</option>
                  <option value="1">1-Soles</option>
                  <option value="2">2-Dólares</option>   
                </select>

              </div>

              <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">N° CUENTA1</label>
              <div class="col-lg-3 col-md-3 col-sm-3">
              

                <input type="text" style="text-transform:uppercase;" class="form-control input-md" name="editarNroCuenta1" id="editarNroCuenta1" >

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

        $editarProveedor = new ControladorProveedores();
        $editarProveedor -> ctrEditarProveedor();

      ?>   


    </div>

  </div>

</div>


<?php

  $eliminarProveedor = new ControladorProveedores();
  $eliminarProveedor -> ctrEliminarProveedor();

?>

<script>
window.document.title = "Proveedores"
</script>