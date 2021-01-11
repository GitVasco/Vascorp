<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
    <?php

                $cuentas=ControladorCuentas::ctrMostrarCuentas("num_cta",$_GET["numCta"]);
                $cliente=ControladorClientes::ctrMostrarClientes("codigo",$cuentas["cliente"]);

     ?>
      Administrar cancelaciones de N° de cuenta <?php echo $cuentas["num_cta"]?>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar cancelaciones</li>
    
    </ol>

  </section>

  <section class="content ">
    <div class="  col-lg-5">
      <div class="box box-success">
        <div class="box-body">
          <div class="col-md-3" style="margin-bottom:10px">
            <a href="cuentas" class="btn btn-primary"><i class ="fa fa-arrow-left"> Atrás </i></a>
          </div>
          <div class="col-md-12"></div>

          <div class="col-md-3 ">
            <label for="">Tipo Documento</label>
            <input type="text" class="form-control" value="<?php echo $cuentas["tipo_doc"]; ?>" readonly>
          </div>

          <div class="col-md-3">
            <label for="">Nro Documento</label>
            <input type="text" class="form-control" value="<?php echo $cuentas["num_cta"]; ?>" readonly>
          </div>

          <div class="col-md-3">
            <label for="">Fecha</label>
            <input type="text" class="form-control" value="<?php echo $cuentas["fecha"]; ?>" readonly>
          </div>

          <div class="col-md-3">
            <label for="">Fecha Vencimiento</label>
            <input type="text" class="form-control" value="<?php echo $cuentas["fecha_ven"]; ?>" readonly>
          </div>

          <div class="col-md-3">
            <label for="">Clientes</label>
            <input type="text" class="form-control" value="<?php echo $cuentas["cliente"]; ?>" readonly>
          </div>

          <div class="col-md-6">
            <div style="margin-top:25px"></div>
            <input type="text" class="form-control" value="<?php echo $cliente["nombre"]; ?>" readonly>
          </div>

          <div class="col-md-3">
            <label for="">Vendedor</label>
            <input type="text" class="form-control" value="<?php echo $cuentas["vendedor"]; ?>" readonly>
          </div>

          <div class="col-md-3">
            <label for="">Estado</label>
            <input type="text" class="form-control" value="<?php echo $cuentas["estado"]; ?>" readonly>
          </div>

          <div class="col-md-3">
            <label for="">Saldo</label>
            <input type="text" class="form-control" value="<?php echo $cuentas["saldo"]; ?>" readonly>
          </div>

          <div class="col-md-3">
            <label for="">Nro unico</label>
            <input type="text" class="form-control" value="<?php echo $cuentas["num_unico"]; ?>" readonly>
          </div>

          <div class="col-md-3">
            <label for="">Total</label>
            <input type="text" class="form-control" value="<?php echo "S/.".$cuentas["monto"]; ?>" readonly>
          </div>
          
          <?php if($cuentas["saldo"] != 0){?>
          <div class="col-md-3" style="margin-top:30px;">
            <button class='btn btn-success btnCancelarCuenta2' numCta="<?php echo $_GET["numCta"]?>" data-toggle='modal' data-target='#modalCancelarCuenta' title='Cancelar cuenta'><i class='fa fa-money'></i> Cancelar cuenta</button>
          </div>
          <?php }?>
        </div>
      </div>
    </div>
        
    <div class=" col-lg-7">
      <div class="box box-warning">
        <div class="box-body">
         <table class="table table-bordered table-striped dt-responsive tablas">
         
          <thead>
         
          <tr>
           <th>Nro Doc.</th>
           <th>Vendedor</th>
           <th>Monto</th>
           <th>Notas</th>
           <th>Acciones</th>

          </tr> 

          </thead>

          <tbody>
            <?php
                $cancelaciones=ControladorCuentas::ctrMostrarCancelaciones("num_cta",$_GET["numCta"]);
                foreach ($cancelaciones as $key => $value) {
           
                    echo    ' <tr>
        
                                <td>'.$value["num_cta"].'</td>
            
                                <td>'.$value["vendedor"].'</td>
                                
                                <td>'.$value["monto"].'</td>
                                
                                <td>'.$value["notas"].'</td>

                                <td>

                                    <div class="btn-group">
                                        
                                        <button class="btn btn-warning btnEditarCancelacion" idCancelacion="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCancelacion"><i class="fa fa-pencil"></i></button><button class="btn btn-danger btnEliminarCancelacion" idCancelacion="'.$value["id"].'" ><i class="fa fa-times"></i></button>
                                    
                                    </div>  

                                 </td>
                                
                            </tr>';
                }
            ?>
          </tbody>

          </table>

        </div>
      </div>
    </div>

  </section>

</div>


<!--=====================================
MODAL EDITAR TIPO PAGO
======================================-->

<div id="modalEditarCancelacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 85% !important;">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Cancelacion</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          
            <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group col-lg-2">
            <label for=""><b>Documento por cancelar</b></label>
            <label for=""><b>Tipo de cancelacion</b></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <select type="text" class="form-control input-lg selectpicker" name="cancelarCodigo" id="cancelarCodigo" data-live-search="true"  required>
                  <option value="">Seleccionar cancelacion</option>

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
              <label for="">Fecha último pago</label>
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
            
            
            <div class="form-group col-lg-3">
            <div style="margin-top:23px"></div>
            <label for="">Monto </label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

                <input type="number" min="0" step="any" class="form-control input-lg" name="cancelarMonto2" id="cancelarMonto2" >
                <input type="hidden"  id="cancelarMontoAntiguo" name="cancelarMontoAntiguo">
                <input type="hidden"  id="cancelarSaldoAntiguo" name="cancelarSaldoAntiguo" value="<?php echo $cuentas["saldo"];?>">
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

          <button type="submit" class="btn btn-primary">Editar cancelacion</button>

        </div>

      </form>

      <?php

        $editarCancelacion = new ControladorCuentas();
        $editarCancelacion -> ctrEditarCancelacion();

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
            
            <div class="form-group col-lg-3">
            <label for=""><b>Documento por cancelar</b></label><br>
            <label for=""><b>Tipo de cancelacion</b></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <select type="text" class="form-control input-lg selectpicker" name="cancelarCodigo2" id="cancelarCodigo2" data-live-search="true"  required>
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
                <input type="hidden" id="cancelarUsuario2" name="cancelarUsuario2" value="<?php echo $_SESSION["id"]?>">
                <input type="hidden" id="idCuenta3" name="idCuenta3" >
              </div>

            </div>          

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-2">
              <div style="margin-top:23px"></div>
              <label for=""><b>Nro de documento</b></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span> 

                <input type="text" class="form-control input-lg" name="cancelarDocumento2" value="<?php echo $_GET["numCta"]?>"  readonly required>

              </div>

            </div>
            
            <?php 
            date_default_timezone_set("America/Lima");
            $fecha = new DateTime();
            ?>
           <!-- ENTRADA PARA LA FECHA  --> 
            <div class="form-group col-lg-2">
            <div style="margin-top:23px"></div>
              <label for="">Fecha </label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="cancelarFechaUltima2" id="cancelarFechaUltima2" value="<?php echo $fecha->format("Y-m-d")?>"  required>

              </div>

            </div>

            <!-- ENTRADA PARA LA NOTA -->
            
            <div class="form-group col-lg-3">
            <div style="margin-top:23px"></div>
            <label for=""><b>Notas</b></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-text-width"></i></span> 

                <input type="text" class="form-control input-lg" name="cancelarNota2" id="cancelarNota2" >

              </div>

            </div>
            
            
            <div class="form-group col-lg-2">
            <div style="margin-top:23px"></div>
            <label for="">Monto </label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

                <input type="number" min="0" step="any" class="form-control input-lg" name="cancelarMonto3" id="cancelarMonto3" value="0" required>
                <input type="hidden"  id="cancelarSaldo2" >
                <input type="hidden"  id="cancelarVendedor2" name="cancelarVendedor2" >
                <input type="hidden"  id="cancelarCliente2" name="cancelarCliente2" >

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

        $cancelarCuenta2 = new ControladorCuentas();
        $cancelarCuenta2 -> ctrCancelarCuenta2();

      ?>   


    </div>

  </div>

</div>

<?php

  $eliminarCancelacion = new ControladorCuentas();
  $eliminarCancelacion -> ctrEliminarCancelacion();

?>

<script>
window.document.title = "Cancelaciones de cuenta"
</script>