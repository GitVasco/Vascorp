<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Consultar cuentas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Consultar cuentas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <div class="col-lg-2">
          <select name="tipoCliente" id="tipoCliente" class="form-control input-lg selectpicker" data-live-search="true">
          <option value="">Seleccionar cargar cliente</option></select>
        </div>

        <div class="col-lg-1">
          <button class="btn btn-primary" id="cargaClienteCuenta">Cargar Clientes</button>
        </div>


        <div class="col-lg-4 text-center bg-primary border-20">

        <span class="info-box-text">Cliente</span>
        <p class="info-box-number" name="consultaCliente" id="consultaCliente">-</p>
        <input type="hidden" id="CodCliBtn" name="CodCliBtn">

        </div>

        <div class="col-lg-2 text-center bg-green">

        <span class="info-box-text">Total Venta S/</span>
        <p class="info-box-number" name="consultaCredito" id="consultaCredito">0</p>

        </div>

        <div class="col-lg-1 text-center bg-yellow">

        <span class="info-box-text">Deuda Total S/</span>
        <p class="info-box-number" name="consultaDeudaTot" id="consultaDeudaTot">0</p>

        </div>   

        <div class="col-lg-1 text-center bg-red">

        <span class="info-box-text">Vencido  TotalS/</span>
        <p class="info-box-number" name="consultaDeudaVen" id="consultaDeudaVen">0</p>

        </div> 

        <div class="col-lg-1">
          <button class="btn btn-info" data-toggle="modal" data-target="#modalVerPagos" id="btnCargarPagos" >Pagos</button>
        </div>
 
      
    <div class="col-lg-12">
    </div>
        
      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaCuentasConsultar" width="100%">
         
        <thead>
         
         <tr>
           <th>Tipo Doc.</th>
           <th>Nro Doc.</th>
           <th>Tipo</th>
           <th>Doc. origen</th>
           <th>Emisión</th>
           <th>Vencimiento</th>
           <th>Monto S/.</th>
           <th>Saldo S/.</th>
           <th>Fec. Pago</th>
           <th>Dif</th>
           <th>Protes.</th>
           <th>Renov.</th>
           <th>Bco.</th>
           <th>Nro. unico</th>
           <th>Vendedor</th>
           <th>Estado</th>
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
MODAL AGREGAR USUARIO
======================================-->

<div id="modalVerPagos" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Pagos de los últimos 6 meses</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

            <div class="box-body">

                <div class="form-group row nuevosPagos" >

                </div>                          

            </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar categoría</button>

        </div>

      </form>

    </div>

  </div>

</div>


<script>
window.document.title = "Consultar cuentas"
</script>