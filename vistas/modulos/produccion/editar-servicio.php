<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Editar venta

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Editar venta</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->

      <div class="col-lg-5 col-xs-12">

        <div class="box box-success">

          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioServicio">

            <div class="box-body">

              <div class="box">

              <?php

                    $item = "codigo";
                    $valor = $_GET["idServicio"];

                    $venta = ControladorServicios::ctrMostrarServicios($item, $valor);
                   

                    $itemUsuario = "id";
                    $valorUsuario = $venta["usuario"];

                    $vendedor = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                    $valorSector = $venta["taller"];

                    $sector = ControladorSectores::ctrMostrarSectores($valorSector);
                    $nombreSector=$sector["cod_sector"]." - ".$sector["nom_sector"];    
                                   
                    date_default_timezone_set('America/Lima');
                    $ahora=date('Y/m/d h:i:s');
                    
                ?>              

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->

                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $vendedor["nombre"]; ?>" readonly>

                    <input type="hidden" name="idVendedor" value="<?php echo $vendedor["id"]; ?>">

                    <input type="hidden" name="fechaActual" value="<?php echo $ahora; ?>">

                  </div>

                </div> 

                <!--=====================================
                ENTRADA DEL CODIGO
                ======================================-->

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                   <input type="text" class="form-control" id="nuevaVenta" name="editarServicio" value="<?php echo $venta["codigo"]; ?>" readonly>
               
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon" id="spanAddon"><i class="fa fa-users"></i></span>
                    <input type="text" class="form-control" id="editarSectorVenta" value="<?=$nombreSector;?>"
                      readonly>
                    <input type="hidden" name="idSectorVenta" value="<?=$venta["taller"];?>">

                  </div>

                </div>
                <div class="box box-primary">

                  <div class="row">

                    <div class="col-xs-6">

                      <label>Articulo</label>

                    </div>

                    <div class="col-xs-4">

                      <label for="">Cantidad</label>

                    </div>

                  </div>

                </div>
                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================-->

                <div class="form-group row nuevoProducto">

                <?php

                # Traemos los detalles de la venta que se desea editar
                $listaProductos=ControladorServicios::ctrMostrarDetallesServicios("codigo",$_GET["idServicio"]);

                /* var_dump("listaProductos", $listaProductos); */
                
                foreach($listaProductos as $key=>$value){

                  # Traemos el dato de cada producto
                  $infoProducto=controladorArticulos::ctrMostrarArticulos($value["articulo"]);

                  /* var_dump("infoproducto", $infoProducto); */
                  
                  # Hallamos el stock anterior
                  $tallerAntiguo = $infoProducto["taller"] + $value["cantidad"];  

                  /* var_dump("stockAntiguo", $stockAntiguo); */
                  
                  echo '<div class="row" style="padding:5px 15px">

                  <div class="col-xs-6" style="padding-right:0px">

                    <div class="input-group">

                      <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" articuloServicio="'.$infoProducto["articulo"].'"><i class="fa fa-times"></i></button></span>

                      <input type="text" class="form-control nuevaDescripcionProducto" articuloServicio="'.$infoProducto["articulo"].'" name="agregarProducto" value="'.$infoProducto["packing"].'" codigoP="'.$infoProducto["articulo"].'" readonly required>

                    </div>

                  </div>

                  <div class="col-xs-3">

                    <input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="0" value="'.$value["cantidad"].'" taller="'.$tallerAntiguo.'" nuevoTaller="'.$infoProducto["taller"].'" required>

                  </div>

                </div>';                  


                }


                ?>


                </div>

                <input type="hidden" id="listaProductos" name="listaProductos">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar articulo</button>

                <hr>

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->

                  <div class="col-xs-6 pull-right">

                    <table class="table">

                      <thead>

                        <tr>
                          <th>Total</th>
                        </tr>

                      </thead>

                      <tbody>

                        <tr>


                          <td style="width: 50%">

                          <div class="input-group">
                           
                           <span class="input-group-addon"><i class="fa fa-money"></i></span>

                           <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" value="<?php echo $venta["total"]; ?>" readonly required>

                           <input type="hidden" name="totalVenta" value="<?php echo $venta["total"]; ?>" id="totalVenta">
                           
                     
                         </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

              </div>

            </div>

            <div class="box-footer">

              <button type="submit" class="btn btn-primary pull-right">Guardar Cambios</button>

            </div>

          </form>

          <?php

            $editarServicio = new ControladorServicios();
            $editarServicio -> ctrEditarServicios();

          ?>        

        </div>

      </div>

      <!--=====================================
      LA TABLA DE ARTICULOS
      ======================================-->

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaArticuloServicio">

              <thead>

                <tr>
                  <th>Articulo</th>
                  <th>Modelo</th>
                  <th>Nombre</th>
                  <th>Color</th>
                  <th>Talla</th>
                  <th>Taller</th>
                  <th>Acciones</th>
                </tr>

              </thead>


            </table>

          </div>

        </div>


      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre"
                  required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId"
                  placeholder="Ingresar documento" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email"
                  required>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono"
                  data-inputmask="'mask':'(999) 999-999'" data-mask required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección"
                  required>

              </div>

            </div>

            <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento"
                  placeholder="Ingresar fecha nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cliente</button>

        </div>

      </form>


      <?php

        $crearCliente = new ControladorClientes();
        $crearCliente -> ctrCrearCliente();

      ?>


    </div>

  </div>

</div>
<script>
window.document.title = "Editar venta"
</script>