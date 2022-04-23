<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Editar orden de compra - <?php echo $_GET["idOrdenCompra"]?>

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Editar orden de compra</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">
      <!--=====================================
      LA TABLA DE MATERIA PRIMA
      ======================================-->

      <div class="col-lg-12 hidden-md hidden-sm hidden-xs">
      
        <div class="box box-warning collapsed-box">

          <div class="box-header with-border">
            <h3 class="box-title">Materia Prima</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
            </div>

          </div>
          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaMateriaOrdenCompra" width="100%">

              <thead>

                <tr>
                  <th>Codigo</th>
                  <th>Cod. Fabrica</th>
                  <th style="min-width:240px">Descripcion</th>
                  <th>Color</th>
                  <th>Unidad</th>
                  <th>Precio Unitario</th>
                  <th style="min-width:180px">Proveedor</th>
                  <th>Stock MateriaPrima</th>
                  <th>Acciones</th>
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

          <form role="form" method="post" class="formularioOrdenCompra">

            <div class="box-body">

              <div class="box">
              <?php 
                $nro = $_GET["idOrdenCompra"];
                date_default_timezone_set('America/Lima');
                $fecha = new DateTime();
                $ordencompra = ControladorOrdenCompra::ctrMostrarOrdenCompra("Nro",$nro);
                // var_dump($ordencompra)
              ?>

                <!--=====================================
                FILA FECHA ALMACEN y CLIENTE
                ======================================-->

                <div class="form-group" style="padding-top:15px">
                  

                  <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">PROVEEDOR</label>
                  <div class="col-lg-2">
                    <input  class="form-control " name="nuevoProveedorCompra"  value="<?php echo $ordencompra["CodRuc"]." - ".$ordencompra["RazPro"]?>" readonly>
                      
                    <input type="hidden" name="editarCodRuc" id="editarCodRuc" value="<?php echo $ordencompra["CodRuc"] ?>" >
                    <input type="hidden" name="editarOrdenCompra" id="editarOrdenCompra" value="<?php echo $_GET["idOrdenCompra"] ?>" >
                  </div>
                    
                  <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">RAZON SOCIAL</label>
                  <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  name ="nuevaRazonSocial"  value="<?php echo $ordencompra["RazPro"]?>" readonly>
                  </div>

                  <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">RUC</label>
                  <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  name="nuevoRuc" value="<?php echo $ordencompra["RucPro"]?>" readonly>
                  </div>

                  <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">FECHA</label>
                  <div class="col-lg-2">
                    <input type="date" class="form-control input-sm"  name="nuevaFecha"
                      value="<?php echo $ordencompra["FecEmi"] ?>" readonly>
                  </div>
                </div>

                <!--=====================================
                FILA TIPO MOTIVO
                ======================================-->

                <div class="form-group" style="padding-top:25px;padding-bottom:25px">

                    <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">MONEDA</label>
                    <div class="col-lg-2">
                    <select  class="form-control " name="nuevaMoneda" >
                      <option value="">SELECCIONAR MONEDA</option>
                        <?php
                            $valor = null;
                            $sublineas = ControladorProveedores::ctrMostrarMonedas();


                            foreach ($sublineas as $key => $value) {
                                if($value["Cod_Argumento"] == $ordencompra["Mo"]){
                                    echo '<option value="'.$value["Cod_Argumento"].'" selected>'.$value["Des_Larga"].'</option>';
                                }else{
                                    echo '<option value="'.$value["Cod_Argumento"].'">'.$value["Des_Larga"].'</option>';
                                }

                                

                            }

                        ?>
                    </select>
                    </div>

                    <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">FEC ENTREGA</label>
                    <div class="col-lg-2">
                        <input type="date" class="form-control input-sm"  name ="nuevaFechaEntrega" value="<?php echo $ordencompra["FecLlegada"]?>">
                    </div>

                    <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">FOR PAGO</label>

                    <div class="col-lg-2">
                    
                        <select  class="form-control  " name="nuevaFormaPago"  >
                        <option value="">SELECCIONAR FORMA PAGO</option>
                        <?php
                            $item = null;
                            $valor = null;

                            $condiciones = ControladorMaestras::ctrMostrarMaestrasDetalle("TFOR");


                            foreach ($condiciones as $key => $value) {
                                if($value["cod_argumento"] == $ordencompra["TipPago"]){
                                  echo '<option value="'.$value["cod_argumento"].'" selected>'.$value["cod_argumento"].'-'.$value["des_larga"].'</option>';
                                }else{
                                  echo '<option value="'.$value["cod_argumento"].'">'.$value["cod_argumento"].'-'.$value["des_larga"].'</option>';
                                }
                               

                            }

                        ?>
                        </select>
                    </div>

                    <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">DIAS</label>
                    <div class="col-lg-2">
                        <input type="text" class="form-control input-sm info-box-text"  name ="nuevoDia" value="<?php echo $ordencompra["Dia"]?>">
                    </div>

                    
                  <div class="col-lg-12"></div>

                </div>

                <div class="form-group" style="padding-bottom:25px">

                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">N° COTIZACION</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm info-box-text"  name ="nuevoNroCotizacion" value="<?php echo $ordencompra["NroProforma"]?>">
                </div>

                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">TIPO CAMBIO</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control input-sm"  name ="nuevoTipoCambio" value="<?php echo $ordencompra["tCambio"]?>" readonly>
                </div>

                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">CENT COSTO</label>

                <div class="col-lg-2">
                
                    <select  class="form-control  selectpicker" name="nuevoCentroCosto" data-size="10" data-live-search="true"  required>
                    <option value="">SELECCIONAR CENTRO COSTO</option>
                        <?php

                        $centro = ControladorMaestras::ctrMostrarMaestrasDetalle("TDET");
                        

                        foreach ($centro as $key => $value) {
                            if($value["des_corta"] == $ordencompra["Centcosto"]){
                                echo '<option value="'.$value["des_corta"].'" selected>'.$value["des_corta"]." - ".$value["des_larga"].'</option>';
                            }else{
                                echo '<option value="'.$value["des_corta"].'">'.$value["des_corta"]." - ".$value["des_larga"].'</option>';
                            }
                            

                        }

                        ?>
                    </select>
                </div>

                

                <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">OBSERVACION</label>
                <div class="col-lg-2">
                <input type="text" class="form-control input-sm info-box-text"  name ="nuevaObservacion" value="<?php echo $ordencompra["Obser"]?>" >
                </div>

                <div class="col-lg-12"></div>

            </div>

                <div class="box box-primary" >

                  <div class="row">
                    <div class="col-xs-1">

                      <label for="">COD PRODUCTO</label>

                    </div>
                    <div class="col-xs-1">

                      <label >COD FABRICA</label>

                    </div>

                    <div class="col-xs-3">

                      <label for="" >DESCRIPCION</label>

                    </div>

                    <div class="col-xs-1">

                      <label for="" >COLOR</label>

                    </div>

                    <div class="col-xs-1">

                      <label for="" >COLOR PROV</label>

                    </div>

                    <div class="col-xs-1">

                      <label for="" >CANTIDAD</label>

                    </div>

                    <div class="col-xs-1">

                      <label for="" >UND</label>

                    </div>

                    <div class="col-xs-1">

                      <label for="" >V UNITARIO</label>

                    </div>

                    <div class="col-xs-1">

                      <label for="" >% DESCUENTO</label>

                    </div>

                    <div class="col-xs-1">

                      <label for="" >TOTAL</label>

                    </div>

                    
                  </div>

                </div>
                <!--=====================================
                ENTRADA PARA AGREGAR MATERIA PRIMA
                ======================================-->

                <div class="form-group row nuevaMateriaCompra">

                <?php

                # Traemos los detalles de la venta que se desea editar
                $listaMaterias=ControladorOrdenCompra::ctrMostrarDetallesOrdenCompra("Nro",$_GET["idOrdenCompra"]);

                // var_dump("listaMaterias", $listaMaterias); 
                
                foreach($listaMaterias as $key=>$value){
                // var_dump($infoMateria);

                  echo '<div class="row" style="padding:1px 15px">


                  <div class="col-xs-1" style="padding-right:0px">

                      <input type="text" class="form-control input-sm nuevoCodigoPro" idMateriaCompra="'.$value["id"].'" name="agregarProducto" value="'.$value["id"].'"  readonly>

                  </div>

                  <div class="col-xs-1" >

                      <input type="text" class="form-control input-sm nuevoCodigoFabrica"  name="nuevoCodigoFabrica" value="'.$value["codfab"].'"  readonly>

                  </div>

                  <div class="col-xs-3" >

                      <input type="text" class="form-control input-sm nuevaDescripcionMateria"  name="nuevaDescripcionMateria" value="'.$value["descripcion"].'"  readonly>

                  </div>

                  <div class="col-xs-1" >

                      <input type="text" class="form-control input-sm nuevoColor"  name="nuevoColor" value="'.$value["color"].'"  readonly>

                  </div>

                  <div class="col-xs-1" >

                      <select class="form-control input-sm  nuevoColorProv" name="nuevoColorProv" id="nuevoColorProv">
                      <option value="">COLOR</option>';
                      $valor="TCOL";

                      $colorprov = ControladorMaestras::ctrMostrarMaestrasDetalle($valor);
                      foreach ($colorprov as $key => $value2) {
                        if($value2["cod_argumento"] == $value["colorprov"]){
                            echo '<option value="'.$value2["cod_argumento"].'" selected>'.$value2["cod_argumento"]." - ".$value2["des_larga"].'</option>';
                        }else{
                            echo '<option value="'.$value2["cod_argumento"].'">'.$value2["cod_argumento"]." - ".$value2["des_larga"].'</option>';
                        }
                      }
                      echo'</select>

                  </div>

                  <div class="col-xs-1 ingresoCantidad">

                    <input type="number" step="any" class="form-control input-sm nuevaCantidadMateria" name="nuevaCantidadMateria" min="1" value="'.$value["cantidad"].'" stock="1" nuevoStock="1"   required>
                    
                  </div>

                  <div class="col-xs-1" >

                      <input type="text" class="form-control input-sm nuevaUnidad"  name="nuevaUnidad" value="'.$value["unidad"].'"  readonly required>

                  </div>

                  <div class="col-xs-1 ingresoPrecio" >

                      <input type="number" min="0" step="any"  class="form-control input-sm nuevoPrecio"  name="nuevoPrecio" value="'.$value["precio"].'"   required>

                  </div>

                  <div class="col-xs-1 ingresoDscto" >

                      <input type="number" min="0"  step="any" class="form-control input-sm nuevoDscto"  name="nuevoDscto" value="'.$value["descuento"].'"   >
                  </div>

                  <div class="col-xs-1 ingresoTotal" >
                    <div class="input-group">
                      <input type="number" step="any" class="form-control input-sm nuevoTotal"  name="nuevoTotal" value="'.$value["total"].'"  readonly required>
                      <span class="input-group-addon"  style="padding: 3px 6px"><button type="button" class="btn btn-danger btn-xs quitarMateriaCompra" idMateriaCompra="'.$value["id"].'"><i class="fa fa-times"></i></button></span>
                    </div>
                  </div>
                </div>';                  


                }


                ?>

                </div>

                <input type="hidden" id="listarMateriaCompras" name="listarMateriaCompras">


                <hr>

                <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->

                <div class="col-xs-5 pull-right">

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
                        <td style="width: 35%">

                          <div class="input-group">

                            <input type="number" class="form-control input-sm" min="0" id="nuevoSubTotalCompra" step="any"
                              name="nuevoSubTotalCompra" value="<?php echo $ordencompra["SubTotal"]?>" readonly>
                            <span class="input-group-addon"><i class="fa fa-money"></i></span>

                          </div>

                        </td>

                        <td style="width: 30%">

                          <div class="input-group">

                            <input type="number" class="form-control input-sm" min="0" step="any" id="nuevoImpuestoCompra"
                              name="nuevoImpuestoCompra" value="<?php echo $ordencompra["Igv"]?>" readonly>



                            <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                          </div>

                        </td>

                        <td style="width: 35%">

                          <div class="input-group">

                            

                            <input type="text" min="0" class="form-control input-sm" id="nuevoTotalCompra" name="nuevoTotalCompra"  step="any" total="" value="<?php echo $ordencompra["Total"]?>" readonly required>

                            <span class="input-group-addon"><i class="fa fa-money"></i></span>

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

              <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Guardar cambios</button>

              <a href="orden-compra"  class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancelar</a>
            </div>

          </form>

          <?php

            $editarOrdenCompra = new ControladorOrdenCompra();
            $editarOrdenCompra -> ctrEditarOrdenCompra();

          ?>          

        </div>

      </div>

      

    </div>

  </section>

</div>

<script>
function cargarTablaMateriaCompra(proveedorCompra){

$(".tablaMateriaOrdenCompra").DataTable({
  ajax: "ajax/materiaprima/tabla-materia-orden-compra.ajax.php?proveedorCompra=" + proveedorCompra,
  deferRender: true,
  retrieve: true,
  processing: true,
  order: [[1, "asc"]],
  "pageLength": 10,
  "lengthMenu": [[10, 20, 30, -1], [10, 20, 30, 'Todos']],
  language: {
    sProcessing: "Procesando...",
    sLengthMenu: "Mostrar _MENU_ registros",
    sZeroRecords: "No se encontraron resultados",
    sEmptyTable: "Ningún dato disponible en esta tabla",
    sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
    sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
    sInfoPostFix: "",
    sSearch: "Buscar:",
    sUrl: "",
    sInfoThousands: ",",
    sLoadingRecords: "Cargando...",
    oPaginate: {
      sFirst: "Primero",
      sLast: "Último",
      sNext: "Siguiente",
      sPrevious: "Anterior"
    },
    oAria: {
      sSortAscending: ": Activar para ordenar la columna de manera ascendente",
      sSortDescending: ": Activar para ordenar la columna de manera descendente"
    }
  }
});

}
var CodRuc = $("#editarCodRuc").val();

$(".tablaMateriaOrdenCompra").DataTable().destroy();
cargarTablaMateriaCompra(CodRuc);
window.document.title = "Editar orden de compra"
</script>