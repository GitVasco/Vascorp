/*=============================================
CARGAR LA TABLA DINÁMICA DE VENTAS
=============================================*/

/*  $.ajax({

 	url: "ajax/tabla-ventas.ajax.php",
 	success:function(respuesta){
		
 		console.log("respuesta", respuesta);

 	}

 })  */

 $(".tablaServicios").DataTable({
    ajax: "ajax/tabla-servicios.ajax.php",
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
  
 $(".tablaArticuloServicio").DataTable({
  ajax: "ajax/tabla-articuloservicios.ajax.php",
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
  
  $(".tablaArticuloServicio tbody").on("click", "button.agregarProducto", function() {
  
    var articuloServicio = $(this).attr("articuloServicio");
  
    /* console.log("idProducto", idProducto); */
  
    $(this).removeClass("btn-primary agregarProducto");
  
    $(this).addClass("btn-default");
  
    var datos = new FormData();
    datos.append("articuloServicio", articuloServicio);
  
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
  
          $("button[articuloServicio='" + articuloServicio + "']").addClass(
            "btn-primary agregarProducto"
          );
  
          return;
        }
  
        $(".nuevoProducto").append(
  
          '<div class="row" style="padding:5px 15px">' +
  
            "<!-- Descripción del producto -->" +
  
            '<div class="col-xs-6" style="padding-right:0px">' +
  
              '<div class="input-group">' +
  
                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" articuloServicio="' + articuloServicio + '"><i class="fa fa-times"></i></button></span>' +
  
                '<input type="text" class="form-control nuevaDescripcionProducto" name="agregarProducto" value="' + packing +'" articuloServicio="' + articuloServicio + '" readonly required>' +
  
              "</div>" +
  
            "</div>" +
  
            "<!-- Cantidad del producto -->" +
  
            '<div class="col-xs-3">' +
  
            '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="0" taller="' + servicio + '" nuevoTaller="' + servicio + '" required>' +
  
            "</div>" +
  
          "</div>"
        );
  
        // SUMAR TOTAL DE CANTIDADES
        sumarTotalServicio();

  
  
        // AGRUPAR PRODUCTOS EN FORMATO JSON
  
        listarProductos();
  
  
  
      }
    });
  });
  
  /*=============================================
  CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
  =============================================*/
  
  $(".tablaArticuloServicio").on("draw.dt", function() {
    /* console.log("tabla"); */
  
    if (localStorage.getItem("quitarProducto") != null) {
      var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));
  
      for (var i = 0; i < listaIdProductos.length; i++) {
        $(
          "button.recuperarBoton[articuloServicio='" +
            listaIdProductos[i]["articuloServicio"] +
            "']"
        ).removeClass("btn-default");
        $(
          "button.recuperarBoton[articuloServicio='" +
            listaIdProductos[i]["articuloServicio"] +
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
  
  $(".formularioServicio").on("click", "button.quitarProducto", function() {
    /* console.log("boton"); */
  
    $(this)
      .parent()
      .parent()
      .parent()
      .parent()
      .remove();
  
    var articuloServicio = $(this).attr("articuloServicio");
  
    /*=============================================
    ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
    =============================================*/
  
    if (localStorage.getItem("quitarProducto") == null) {
      idQuitarProducto = [];
    } else {
      idQuitarProducto.concat(localStorage.getItem("quitarProducto"));
    }
  
    idQuitarProducto.push({
      articuloServicio: articuloServicio
    });
  
    localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));
  
    $("button.recuperarBoton[articuloServicio='" + articuloServicio + "']").removeClass(
      "btn-default"
    );
  
    $("button.recuperarBoton[articuloServicio='" + articuloServicio + "']").addClass(
      "btn-primary agregarProducto"
    );
  
    if ($(".nuevoProducto").children().length == 0) {
      $("#nuevoTotalVenta").val(0);
      $("#totalVenta").val(0);
      $("#nuevoTotalVenta").attr("total", 0);
    } else {
      // SUMAR TOTAL DE PRECIOS
  
      // AGRUPAR PRODUCTOS EN FORMATO JSON
      sumarTotalServicio();

      listarProductos();
    }
  });
  
  /*=============================================
  MODIFICAR LA CANTIDAD
  =============================================*/
  
  $(".formularioServicio").on("change", "input.nuevaCantidadProducto", function() {
    
  
    var nuevoTaller = Number($(this).attr("taller")) - $(this).val();
  
    $(this).attr("nuevoTaller", nuevoTaller);
  
    if (Number($(this).val()) > Number($(this).attr("taller"))) {
      /*=============================================
      SI LA CANTIDAD ES SUPERIOR AL TALLER REGRESAR VALORES INICIALES
      =============================================*/
  
      $(this).val(0);
  

  
      swal({
        title: "La cantidad supera la cantidad de servicio",
        text: "¡Sólo hay " + $(this).attr("taller") + " unidades!",
        type: "error",
        confirmButtonText: "¡Cerrar!"
      });
  
      return;
    }

    sumarTotalServicio();

  
    // AGRUPAR PRODUCTOS EN FORMATO JSON
  
    listarProductos();

  });
  
  
  
  $("#nuevoTotalVenta").number(true, 2);
  

  

  /*=============================================
  LISTAR TODOS LOS PRODUCTOS
  =============================================*/
  
  function listarProductos() {
    var listaProductos = [];
  
    var descripcion = $(".nuevaDescripcionProducto");
  
    var cantidad = $(".nuevaCantidadProducto");
  
  
    for (var i = 0; i < descripcion.length; i++) {
      listaProductos.push({
        id: $(descripcion[i]).attr("articuloServicio"),
        articulo: $(descripcion[i]).attr("articuloServicio"),
        cantidad: $(cantidad[i]).val(),
        taller:$(cantidad[i]).attr("taller")
      });
    }
  
     console.log("listaProductos", JSON.stringify(listaProductos)); 
  
    $("#listaProductos").val(JSON.stringify(listaProductos));
    // console.log(JSON.stringify(listaProductos));
  }
  
  /* 
* SUMAR EL TOTAL DE LAS VENTAS
*/
  
function sumarTotalServicio() {

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
  $(".tablaServicios").on("click", ".btnEditarServicio", function() {
    var idServicio = $(this).attr("idServicio");
  
    window.location = "index.php?ruta=editar-servicio&idServicio=" + idServicio;
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
    var botonesTabla = $(".tablaArticuloServicio tbody button.agregarProducto");
  
    /* console.log("botonesTabla", botonesTabla); */
  
    //Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
    for (var i = 0; i < idProductos.length; i++) {
      //Capturamos los Id de los productos agregados a la venta
      var boton = $(idProductos[i]).attr("articuloServicio");
  
      //Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
      for (var j = 0; j < botonesTabla.length; j++) {
        if ($(botonesTabla[j]).attr("articuloServicio") == boton) {
          $(botonesTabla[j]).removeClass("btn-primary agregarProducto");
          $(botonesTabla[j]).addClass("btn-default");
        }
      }
    }
  }
  
  /*=============================================
  CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
  =============================================*/
  
  $(".tablaArticuloServicio").on("draw.dt", function() {
    quitarAgregarProducto();
  });
  
  /*=============================================
  BORRAR VENTA
  =============================================*/
  $(".tablaServicios").on("click", ".btnEliminarServicio", function() {
    var idServicio = $(this).attr("idServicio");
    
    swal({
      type: "warning",
      title: "Advertencia",
      text:
        "¿Está seguro de eliminar el servicio? ¡Si no está seguro, puede cancelar la acción!",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "¡Si, eliminar servicio!",
      cancelButtonText: "Cancelar"
    }).then(function(result) {
      if (result.value) {
        var datos = new FormData();
        datos.append("idServicio", idServicio);
        $.ajax({
          url: "ajax/servicios.ajax.php",
          type: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          success: function(respuesta) {
            console.log(respuesta);
            if (respuesta == "ok") {
              swal({
                type: "success",
                title: "¡Ok!",
                text: "¡La información fue Eliminada con éxito!",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
              }).then(result => {
                if (result.value) {
                  window.location = "servicios";
                }
              });
            }
          }
        });
      }
    });
  });
  