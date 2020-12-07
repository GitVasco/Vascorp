<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Pedidos

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Pedidos</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <div class="btn-group">

        <?php

          #$numero = ControladorMovimientos::ctrMostrarTalonario();

          $pedido = "";
          #$pedido = $numero["pedido"] + 1;
          #var_dump("pedido", $pedido);

          echo '<button class="btn btn-primary  btnCrearPedido" pedido="'.$pedido.'" title="Crear Pedido">

                  Crear Pedido

                </button>';


        ?>

        </div>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablaPedidosCV">

          <thead>

            <tr>
              <th>Id</th>
              <th>Código</th>
              <th>Cod. Cliente</th>
              <th>Cliente</th>
              <th>Vendedor</th>
              <th>Total</th>
              <th>Condición de Venta</th>
              <th>Estado</th>
              <th>Usuario</th>
              <th>Fecha</th>
              <th>Acciones</th>
            </tr>

          </thead>

          </tbody>

        </table>

      </div>

    </div>

  </section>

</div>

<script>
window.document.title = "Pedidos"
</script>