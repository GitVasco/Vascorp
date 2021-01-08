/*=============================================
CARGAR LA TABLA DINÁMICA DE CIERRES
=============================================*/


 $(".tablaCierres").DataTable({
    ajax: "ajax/tabla-cierres.ajax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
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
  
 $(".tablaArticuloCierre").DataTable({
  ajax: "ajax/tabla-articulocierres.ajax.php",
  deferRender: true,
  retrieve: true,
  processing: true,
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

  /*=============================================
  AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
  =============================================*/
  
  $(".tablaArticuloCierre tbody").on("click", "button.agregarProducto", function() {
  
    var articuloCierre = $(this).attr("articuloCierre");
    /* console.log("idProducto", idProducto); */
  
    $(this).removeClass("btn-primary agregarProducto");
  
    $(this).addClass("btn-default");
  
    var datos = new FormData();
    datos.append("articuloServicio", articuloCierre);
  
    $.ajax({
      url: "ajax/articulos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(respuesta) {
        var packing = respuesta["packing"];
        var servicio = respuesta["servicio"];
        /*=============================================
        EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
        =============================================*/
  
        if (servicio == 0) {
          swal({
            title: "No hay en servicio disponible",
            type: "error",
            confirmButtonText: "¡Cerrar!"
          });
  
          $("button[articuloCierre='" + articuloCierre + "']").addClass(
            "btn-primary agregarProducto"
          );
  
          return;
        }
  
        $(".nuevoCierres").append(
  
          '<div class="row" style="padding:5px 15px">' +
  
            "<!-- Descripción del producto -->" +
  
            '<div class="col-xs-6" style="padding-right:0px">' +
  
              '<div class="input-group">' +
  
                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" articuloCierre="' + articuloCierre + '"><i class="fa fa-times"></i></button></span>' +
  
                '<input type="text" class="form-control nuevaDescripcionProducto" name="agregarProducto" value="' + packing +'" articuloCierre="' + articuloCierre + '" readonly required>' +
  
              "</div>" +
  
            "</div>" +
  
            "<!-- Cantidad del producto -->" +
  
            '<div class="col-xs-3">' +
  
            '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="0" servicio="' + servicio + '" nuevoServicio="' + servicio + '"  required>' +
  
            "</div>" +
  
          "</div>"
        );
  
        // SUMAR TOTAL DE CANTIDADES
        sumarTotalCierre();

  
  
        // AGRUPAR PRODUCTOS EN FORMATO JSON
  
        listarCierres();
  
  
  
      }
    });
  });
  
  /*=============================================
  CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
  =============================================*/
  
  $(".tablaArticuloCierre").on("draw.dt", function() {
    /* console.log("tabla"); */
  
    if (localStorage.getItem("quitarProducto") != null) {
      var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));
  
      for (var i = 0; i < listaIdProductos.length; i++) {
        $(
          "button.recuperarBoton[articuloCierre='" +
            listaIdProductos[i]["articuloCierre"] +
            "']"
        ).removeClass("btn-default");
        $(
          "button.recuperarBoton[articuloCierre='" +
            listaIdProductos[i]["articuloCierre"] +
            "']"
        ).addClass("btn-primary agregarProducto");
      }
    }
  });
  
  /*=============================================
  QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
  =============================================*/
  
  var idQuitarProducto = [];
  
  localStorage.removeItem("quitarProducto");
  
  $(".formularioCierre").on("click", "button.quitarProducto", function() {
    /* console.log("boton"); */
  
    $(this)
      .parent()
      .parent()
      .parent()
      .parent()
      .remove();
  
    var articuloCierre = $(this).attr("articuloCierre");
  
    /*=============================================
    ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
    =============================================*/
  
    if (localStorage.getItem("quitarProducto") == null) {
      idQuitarProducto = [];
    } else {
      idQuitarProducto.concat(localStorage.getItem("quitarProducto"));
    }
  
    idQuitarProducto.push({
      articuloCierre: articuloCierre
    });
  
    localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));
  
    $("button.recuperarBoton[articuloCierre='" + articuloCierre + "']").removeClass(
      "btn-default"
    );
  
    $("button.recuperarBoton[articuloCierre='" + articuloCierre + "']").addClass(
      "btn-primary agregarProducto"
    );
  
    if ($(".nuevoCierres").children().length == 0) {
      $("#nuevoTotalVenta").val(0);
      $("#totalVenta").val(0);
      $("#nuevoTotalVenta").attr("total", 0);
    } else {
      // SUMAR TOTAL DE PRECIOS
  
      // AGRUPAR PRODUCTOS EN FORMATO JSON
      sumarTotalCierre();

      listarCierres();
    }
  });
  
  /*=============================================
  MODIFICAR LA CANTIDAD
  =============================================*/
  
  $(".formularioCierre").on("change", "input.nuevaCantidadProducto", function() {
    
  
    var nuevoServicio = Number($(this).attr("servicio")) - $(this).val();
  
    $(this).attr("nuevoServicio", nuevoServicio);
  
    if (Number($(this).val()) > Number($(this).attr("servicio"))) {
      /*=============================================
      SI LA CANTIDAD ES SUPERIOR AL SERVICIO REGRESAR VALORES INICIALES
      =============================================*/
  
      $(this).val(0);
  

  
      swal({
        title: "La cantidad supera la cantidad de servicio",
        text: "¡Sólo hay " + $(this).attr("servicio") + " unidades!",
        type: "error",
        confirmButtonText: "¡Cerrar!"
      });
  
      return;
    }

    sumarTotalCierre();

  
    // AGRUPAR PRODUCTOS EN FORMATO JSON
  
    listarCierres();

  });
  
  
  
  $("#nuevoTotalVenta").number(true, 2);
  

  

  /*=============================================
  LISTAR TODOS LOS PRODUCTOS
  =============================================*/
  
  function listarCierres() {
    var listaProductos = [];
  
    var descripcion = $(".nuevaDescripcionProducto");
  
    var cantidad = $(".nuevaCantidadProducto");
  
  
    for (var i = 0; i < descripcion.length; i++) {
      listaProductos.push({
        id: $(descripcion[i]).attr("articuloCierre"),
        articulo: $(descripcion[i]).attr("articuloCierre"),
        cantidad: $(cantidad[i]).val(),
        servicio:$(cantidad[i]).attr("servicio"),
      });
    }
   
  
    $("#listaProductos").val(JSON.stringify(listaProductos));
     console.log(JSON.stringify(listaProductos));
  }
  
  /* 
* SUMAR EL TOTAL DE LAS VENTAS
*/
  
function sumarTotalCierre() {

  var cantidadSer = $(".nuevaCantidadProducto");

  //console.log("cantidadOc", cantidadOc);

  var arraySumarCantidades = [];

  for (var i = 0; i < cantidadSer.length; i++){

      arraySumarCantidades.push(Number($(cantidadSer[i]).val()));

  }
      /* console.log("arraySumarCantidades", arraySumarCantidades); */

  function sunaArrayCantidades(total, numero) {
      return total + numero;
  }

  var sumarTotal = arraySumarCantidades.reduce(sunaArrayCantidades);

  /* console.log("sumarTotal", sumarTotal); */

  $("#nuevoTotalVenta").val(sumarTotal);
  $("#totalVenta").val(sumarTotal);
  $("#nuevoTotalVenta").attr("total", sumarTotal);

}
  
  /*=============================================
  BOTON EDITAR SERVICIO
  =============================================*/
  $(".tablaCierres").on("click", ".btnEditarCierre", function() {
    var idCierre = $(this).attr("idCierre");
  
    window.location = "index.php?ruta=editar-cierre&idCierre=" + idCierre;
  });
  
  // Formato para los números en las cajas
  $("#totalVenta").number(true, 0);
  
  /*=============================================
  FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
  =============================================*/
  
  function quitarAgregarProducto() {
    //Capturamos todos los id de productos que fueron elegidos en la venta
    var idProductos = $(".quitarProducto");
    //console.log("idProductos", idProductos);
  
    //Capturamos todos los botones de agregar que aparecen en la tabla
    var botonesTabla = $(".tablaArticuloCierre tbody button.agregarProducto");
  
    /* console.log("botonesTabla", botonesTabla); */
  
    //Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
    for (var i = 0; i < idProductos.length; i++) {
      //Capturamos los Id de los productos agregados a la venta
      var boton = $(idProductos[i]).attr("articuloCierre");
  
      //Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
      for (var j = 0; j < botonesTabla.length; j++) {
        if ($(botonesTabla[j]).attr("articuloCierre") == boton) {
          $(botonesTabla[j]).removeClass("btn-primary agregarProducto");
          $(botonesTabla[j]).addClass("btn-default");
        }
      }
    }
  }
  
  /*=============================================
  CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
  =============================================*/
  
  $(".tablaArticuloCierre").on("draw.dt", function() {
    quitarAgregarProducto();
  });
  
  /*=============================================
  BORRAR VENTA
  =============================================*/
  $(".tablaCierres").on("click", ".btnEliminarCierre", function() {
    var idCierre = $(this).attr("idCierre");
    swal({
      type: "warning",
      title: "Advertencia",
      text:
        "¿Está seguro de eliminar el cierre? ¡Si no está seguro, puede cancelar la acción!",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "¡Si, eliminar cierre!",
      cancelButtonText: "Cancelar"
    }).then(function(result) {
      if (result.value) {
        var datos = new FormData();
        datos.append("idCierre", idCierre);
        $.ajax({
          url: "ajax/cierres.ajax.php",
          type: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          success: function(respuesta) {
           
            if (respuesta == "ok") {
              swal({
                type: "success",
                title: "¡Ok!",
                text: "¡La información fue Eliminada con éxito!",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
              }).then(result => {
                if (result.value) {
                  window.location = "cierres";
                }
              });
            }
          }
        });
      }
    });
  });
  
   /*=============================================
  BOTON REPORTE SERVICIO CON MATERIA PRIMA
  =============================================*/
  $(".tablaCierres").on("click", ".btnDetalleCierre", function() {
    var idCierre = $(this).attr("idCierre");
  
    window.location = "vistas/reportes_excel/rpt_detalle_cierre.php?idCierre=" + idCierre;
  });
  
  $("#seleccionarSector").change(function(){
    var cierre = $(this).val();
    var datos2 = new FormData();
    datos2.append("cierre", cierre);
    $.ajax({
      url: "ajax/cierres.ajax.php",
      method: "POST",
      data: datos2,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(respuesta) {
        $("#nuevoCierre").val(cierre+"R"+("000"+respuesta["ultimo_codigo"]).slice(-4));
      }
    })
  });