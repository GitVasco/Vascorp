<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Editar ingresos

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Editar ingreso</li>

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

          <form role="form" method="post" class="formularioIngreso">

            <div class="box-body">

              <div class="box">

              <?php
              
              $item = "id";
              $valor = $_GET["idIngreso"];

              $ingreso = ControladorIngresos::ctrMostrarIngresos($item, $valor);
              ?>
                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control" id="usuario" name="usuario"
                      value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idUsuario" value="<?php echo $_SESSION["id"]; ?>">                      

                  </div>

                </div>

                <!--=====================================
                ENTRADA DEL CODIGO INTERNO
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="text" class="form-control" id="editarCodigo" name="editarCodigo" value="<?php echo $ingreso["documento"]; ?>" readonly>
                    <input type="hidden" id="pasarTaller" value="<?php echo $ingreso["taller"]; ?>" >  

                  </div>

                </div>

                <!--=====================================
                ENTRADA DEL ARTICULO
                ======================================-->

                <div class="form-group">

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-wrench"></i></span>
                        <input type="text" class="form-control  input-sm " name="editarTalleres" id="editarTalleres" readonly>
                        

                    </div>

                </div>

                <!--=====================================
                TITULOS
                ======================================-->
                
                <div class="box box-primary">

                  <div class="row">

                    <div class="col-xs-6">

                      <label>Articulo</label>

                    </div>

                    <div class="col-xs-2">

                      <label for="">En Taller</label>

                    </div>

                  </div>

                </div>
         
                <!--=====================================
                ENTRADA PARA AGREGAR MATERIAPRIMA
                ======================================-->

                <div class="form-group row nuevoArticuloIngreso">
                  
                <?php

                  $listaArticuloIng = ControladorIngresos::ctrMostrarDetallesIngresos("documento",$ingreso["documento"]);
                  #var_dump("ordencorte", $ordencorte["codigo"]);
                  #var_dump("listaArticuloOC", $listaArticuloOC);
                  foreach($listaArticuloIng as $key=>$value){
                    if($ingreso["taller"]=="T1" || $ingreso["taller"]=="T3" || $ingreso["taller"]=="T5" ){

                      $infoArticulo = ControladorArticulos::ctrMostrarArticulos($value["articulo"]);
                    }else{
                      $infoArticulo = ControladorIngresos::ctrMostrarArticulosCierres($value["idcierre"]);
                    }
                    $tallerAntiguo = $infoArticulo["taller"] + $value["cantidad"];
                    $stockG = $infoArticulo["stockG"];
                    echo '<div class="row" style="padding:5px 15px">

                            <div class="col-xs-6" style="padding-right:0px">
                        
                              <div class="input-group">
                        
                                <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarTaller" articuloIngreso="'.$infoArticulo["articulo"].'"><i class="fa fa-times"></i></button></span>
                        
                                <input type="text" class="form-control nuevaDescripcionProducto input-sm" articuloIngreso="'.$infoArticulo["articulo"].'" name="agregarT" value="'.$infoArticulo["packing"].'" codigoAC="'.$infoArticulo["articulo"].'" idCierre= "'.$value["idcierre"].'" readonly required>
                        
                              </div>
                        
                            </div>
                        
                            <div class="col-xs-6">
                        
                              <input type="number" class="form-control nuevaCantidadArticuloIngreso input-sm" name="nuevaCantidadArticuloIngreso" id="nuevaCantidadArticuloIngreso" min="1" value="'.$value["cantidad"].'" taller="'.$tallerAntiguo.'" articulo="'.$infoArticulo["articulo"].'" nuevotaller="'.$infoArticulo["taller"].'" required>
                        
                            </div>';
                            echo '</div>';  
                  }
                            ?>
                  

                </div>

                <input type="hidden" id="listaArticulosIngreso" name="listaArticulosIngreso">                

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

                            <span class="input-group-addon"><i class="fa fa-scissors"></i></span>

                            <input type="text" min="1" class="form-control input-lg" id="nuevoTotalTaller"
                              name="nuevoTotalTaller" total="" placeholder="0" total="<?php echo $ingreso["total"]; ?>" value=<?php echo $ingreso["total"]?> readonly required>

                            <input type="hidden" name="totalTaller" id="totalTaller" value=<?php echo $ingreso["total"]?>>


                          </div>

                        </td>

                      </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

                <hr>

                <!--=====================================
                BOTON GUARDAR
                ======================================-->

                <br>

              </div>

            </div>

            <div class="box-footer">

              <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i>  Guardar cambios</button>
              
              <a href="ingresos" id="cancel" name="cancel" class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancelar</a>
            </div>

          </form>

          <?php

            $editarIngreso = new ControladorIngresos();
            $editarIngreso -> ctrEditarIngreso();

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

            <table class="table table-bordered table-striped table-condensed tablaArticulosTalleres">

              <thead>

                <tr>
                  <th class="text-center">Guia</th>
                  <th class="text-center">Modelo</th>
                  <th class="text-center">Color</th>
                  <th class="text-center">Talla</th>
                  <th class="text-center">Stock</th>
                  <th class="text-center">En Taller</th>
                  <th class="text-center">Alm. Corte</th>
                  <th class="text-center">Ord. Corte</th>
                  <th class="text-center">Acciones</th>
                </tr>

              </thead>



            </table>

          </div>

        </div>


      </div>

    </div>

  </section>

</div>

<script>
$(document).ready(function(){
  pasar=$("#pasarTaller").val();          
  $("#editarTalleres").val(pasar);
  $("#editarTalleres").selectpicker("refresh");
})
</script>

<script>
window.document.title = "Editar ingresos"
</script>