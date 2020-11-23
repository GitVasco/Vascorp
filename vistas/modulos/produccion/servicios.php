<div class="content-wrapper">

  <section class="content-header">

    <h1>

    Servicios

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Servicios</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">
      <div class="box-header with-border">
        <a href="crear-servicio">
          <button class="btn btn-primary" name="RegistrarServicio" >
            Registrar Servicio
          </button>
        </a>
        <button class="btn btn-outline-success pull-right btnReporteAlmacen"  style="border:green 1px solid">
                      <img src="vistas/img/plantilla/excel.png" width="20px"> Reporte Servicios  </button>
      </div>
      <div class="box-body">

        <input type="hidden" value="<?= $_SESSION["perfil"]; ?>" id="perfilOculto">

        <table class="table table-bordered table-striped dt-responsive tablaServicios">

          <thead>

            <tr>

              <th>#</th>
              <th>Codigo</th>
              <th>Usuario</th>
              <th>Taller</th>
              <th>Total</th>
              <th>Fecha</th>
              <th>Estado</th>
              <th>Acciones</th>

            </tr>

          </thead>

        </table>

      </div>

    </div>

  </section>

</div>


<script>
window.document.title = "Servicios"
</script>