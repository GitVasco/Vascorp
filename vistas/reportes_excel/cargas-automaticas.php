<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar cargas automaticas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar cargas automaticas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-body">
        <form role="form" method="POST" enctype="multipart/form-data">
          <div class="form-group col-lg-3">
            <label for=""><strong>LEER ARTICULO POR STOCK</strong></label>
            <input type="file" name="archivoxls" id="archivoxls" class="form-control" accept="application/vnd.ms-excel">
          </div>
          <div class="form-group col-lg-1">
            <br>
            <button type="submit"  class="btn btn-success" name="import" ><i class="fa fa-refresh"></i> Cargar articulo</a>
          </div>
        </form>

        <?php

        $actualizarStock = new ControladorArticulos();
        $actualizarStock->ctrCambiarStock();

        ?>
        <div class="col-lg-2"></div>
        <form role="form" method="POST" action="leer-stock" enctype="multipart/form-data">
          <div class="form-group col-lg-4">
            <label for=""><strong>LEER MOVIMIENTOS ACTUALES</strong></label>
            <input type="file" name="archivoxlsmovimiento" id="archivoxlsmovimiento" class="form-control" accept="application/vnd.ms-excel">
          </div>
          <div class="form-group col-lg-1">
            <br>
            <button type="submit"  class="btn btn-success" name="importmovimiento" ><i class="fa fa-refresh"></i> Cargar movimientos</a>
          </div>
        </form>

        <?php

        // $actualizarMovimiento = new ControladorArticulos();
        // $actualizarMovimiento->ctrCambiarStock();

        ?>

      </div>

    </div>

  </section>

</div>