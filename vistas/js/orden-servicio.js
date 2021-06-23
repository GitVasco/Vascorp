/*=============================================
CARGAR LA TABLA DINÁMICA DE NOTAS DE SALIDAS
=============================================*/

if (localStorage.getItem("capturarRango33") != null) {
	$("#daterange-btnOrdenServicio span").html(localStorage.getItem("capturarRango33"));
	cargarTablaOrdenServicio(localStorage.getItem("fechaInicial"), localStorage.getItem("fechaFinal"));
} else {
	$("#daterange-btnOrdenServicio span").html('<i class="fa fa-calendar"></i> Rango de Fecha ');
	cargarTablaOrdenServicio(null, null);
}


/* 
* TABLA PARA ORDEN DE SERVICIO
*/
function cargarTablaOrdenServicio(fechaInicial,fechaFinal) {

 $(".tablaOrdenesServicios").DataTable({
    ajax: "ajax/materiaprima/tabla-orden-servicio.ajax.php?perfil="+$("#perfilOculto").val() + "&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal,
    deferRender: true,
    retrieve: true,
    processing: true,
    order: [[2, "desc"]],
    "pageLength": 20,
	  "lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
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


/*=============================================
RANGO DE FECHAS PARA ORDEN DE SERVICIO
=============================================*/

$("#daterange-btnOrdenServicio").daterangepicker(
  {
    cancelClass: "CancelarOrdenServicio",
    locale:{
  "daysOfWeek": [
    "Dom",
    "Lun",
    "Mar",
    "Mie",
    "Jue",
    "Vie",
    "Sab"
  ],
  "monthNames": [
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre"
  ],
  },
    ranges: {
      Hoy: [moment(), moment()],
      Ayer: [moment().subtract(1, "days"), moment().subtract(1, "days")],
      "Últimos 7 días": [moment().subtract(6, "days"), moment()],
      "Últimos 30 días": [moment().subtract(29, "days"), moment()],
      "Este mes": [moment().startOf("month"), moment().endOf("month")],
      "Último mes": [
        moment()
          .subtract(1, "month")
          .startOf("month"),
        moment()
          .subtract(1, "month")
          .endOf("month")
      ]
    },
    
    startDate: moment(),
    endDate: moment()
  },
  function(start, end) {
    $("#daterange-btnOrdenServicio span").html(
      start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
    );

    var fechaInicial = start.format("YYYY-MM-DD");

    var fechaFinal = end.format("YYYY-MM-DD");

    var capturarRango33 = $("#daterange-btnOrdenServicio span").html();
  
    localStorage.setItem("capturarRango33", capturarRango33);
    localStorage.setItem("fechaInicial", fechaInicial);
    localStorage.setItem("fechaFinal", fechaFinal);

    // Recargamos la tabla con la información para ser mostrada en la tabla
    $(".tablaOrdenesServicios").DataTable().destroy();
    cargarTablaOrdenServicio(fechaInicial, fechaFinal);
  });

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensleft .range_inputs .CancelarOrdenServicio").on(
  "click",
  function() {
    localStorage.removeItem("capturarRango33");
    localStorage.removeItem("fechaInicial");
    localStorage.removeItem("fechaFinal");
    localStorage.clear();
    window.location = "orden-servicio";
  }
);

/*=============================================
CAPTURAR HOY
=============================================*/

$(".daterangepicker.opensleft .ranges li").on("click", function() {
  var textoHoy = $(this).attr("data-range-key");
  var ruta = $("#rutaAcceso").val();
  if(ruta == "orden-servicio"){
    if (textoHoy == "Hoy") {
      var d = new Date();
  
      var dia = d.getDate();
      var mes = d.getMonth() + 1;
      var año = d.getFullYear();
  
      dia = ("0" + dia).slice(-2);
      mes = ("0" + mes).slice(-2);
  
      var fechaInicial = año + "-" + mes + "-" + dia;
      var fechaFinal = año + "-" + mes + "-" + dia;
  
      localStorage.setItem("capturarRango33", "Hoy");
      localStorage.setItem("fechaInicial", fechaInicial);
      localStorage.setItem("fechaFinal", fechaFinal);
    // Recargamos la tabla con la información para ser mostrada en la tabla
      $(".tablaOrdenesServicios").DataTable().destroy();
      cargarTablaOrdenServicio(fechaInicial, fechaFinal);
    }
  }

});

  // TABLA MATERIA NOTAS SALIDAS

  $(".tablaMateriaOrdenesServicios").DataTable({
    ajax: "ajax/materiaprima/tabla-materia-orden-servicio.ajax.php?perfil="+$("#perfilOculto").val(),
    deferRender: true,
    retrieve: true,
    processing: true,
    order: [[0, "asc"]],
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

$(".tablaMateriaOrdenesServicios tbody").on("click", "button.agregarMateriaServicio", function() {

  var idMateriaServicio = $(this).attr("idMateriaServicio");

  /* console.log("idProducto", idProducto); */

  $(this).removeClass("btn-primary agregarMateriaServicio");

  $(this).addClass("btn-default");

  var datos = new FormData();
  datos.append("idMateriaPrima2", idMateriaServicio);

  $.ajax({
    url: "ajax/materiaprima.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {
      console.log(respuesta);
      var codpro = respuesta["codpro"];
      var color = respuesta["color"];
      var unidad = respuesta["unidad"];
      var descripcion = respuesta["descripcion"];
      var stock = respuesta["stock"];

      /*=============================================
      EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
      =============================================*/

      if (stock == 0) {
        swal({
          title: "No hay stock disponible",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });

        $("button[idMateriaServicio='" + idMateriaServicio + "']").addClass(
          "btn-primary agregarMateriaServicio"
        );

        return;
      }

      $(".nuevaMateriaServicio").append(

        '<div class="row" style="padding:1px 15px">' +

          "<!-- Descripción del producto -->" +

          '<div class="col-xs-1" style="padding-right:0px">' +

              '<input type="text" class="form-control input-sm nuevoCodigoPro" idMateriaNota="' + codpro + '" name="agregarProducto" value="' + codpro + '"  readonly>' +

          "</div>" +

          '<div class="col-xs-3" >' +

              '<input type="text" class="form-control input-sm nuevaDescripcionMateria"  name="nuevaDescripcionMateria" value="' + descripcion + '"  readonly>' +

          "</div>" +

          '<div class="col-xs-1" >' +

              '<input type="text" class="form-control input-sm nuevoColor"  name="nuevoColor" value="' + color + '"  readonly>' +

          "</div>" +

          '<div class="col-xs-1">' +

              '<input type="text" class="form-control input-sm nuevoCodigoPro2 modmpOSDestino"  name="nuevoCodigoPro2"  >' +

          "</div>" +

          '<div class="col-xs-3" >' +

              '<input type="text" class="form-control input-sm nuevaDescripcionMateria2"  name="nuevaDescripcionMateria2"  readonly>' +

          "</div>" +

          '<div class="col-xs-1" >' +

              '<input type="text" class="form-control input-sm nuevoColor2"  name="nuevoColor2"  readonly>' +

          "</div>" +

          '<div class="col-xs-1" >' +

              '<input type="text" class="form-control input-sm nuevaUnidad"  name="nuevaUnidad" value="' + unidad + '"  readonly>' +

          "</div>" +

          "<!-- Cantidad del producto -->" +

          '<div class="col-xs-1">' +

            '<div class="input-group">' +

            '<input type="number" step="any" class="form-control input-sm nuevaCantidadMateria" name="nuevaCantidadMateria" min="1" value="1" stock="' + stock + '" nuevoStock="' + Number(stock - 1) + '" required>' +
            
            '<span class="input-group-addon"  style="padding: 3px 6px"><button type="button" class="btn btn-danger btn-xs quitarMateriaServicio" idMateriaServicio="' + idMateriaServicio + '"><i class="fa fa-times"></i></button></span>' +

            "</div>" +

          "</div>" +


        "</div>"


      );


      // AGRUPAR MATERIAS EN FORMATO JSON

      listarMateriaServicios();
     
      


    }
  });
});

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaMateriaOrdenesServicios").on("draw.dt", function() {
  /* console.log("tabla"); */

  if (localStorage.getItem("quitarMateriaServicio") != null) {
    var listaIdMateriaServicio = JSON.parse(localStorage.getItem("quitarMateriaServicio"));

    for (var i = 0; i < listaIdMateriaServicio.length; i++) {
      $(
        "button.recuperarBoton[idMateriaServicio='" +
        listaIdMateriaServicio[i]["idMateriaServicio"] +
          "']"
      ).removeClass("btn-default");
      $(
        "button.recuperarBoton[idMateriaServicio='" +
        listaIdMateriaServicio[i]["idMateriaServicio"] +
          "']"
      ).addClass("btn-primary agregarMateriaServicio");
    }
  }
});

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarMateriaServicio = [];

localStorage.removeItem("quitarMateriaServicio");

$(".formularioOrdenServicio").on("click", "button.quitarMateriaServicio", function() {
  /* console.log("boton"); */

  $(this)
    .parent()
    .parent()
    .parent()
    .parent()
    .remove();

  var idMateriaServicio = $(this).attr("idMateriaServicio");

  /*=============================================
  ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
  =============================================*/

  if (localStorage.getItem("quitarMateriaServicio") == null) {
    idQuitarMateriaServicio = [];
  } else {
    idQuitarMateriaServicio.concat(localStorage.getItem("quitarMateriaServicio"));
  }

  idQuitarMateriaServicio.push({
    idMateriaServicio: idMateriaServicio
  });

  localStorage.setItem("quitarMateriaServicio", JSON.stringify(idQuitarMateriaServicio));

  $("button.recuperarBoton[idMateriaServicio='" + idMateriaServicio + "']").removeClass(
    "btn-default"
  );

  $("button.recuperarBoton[idMateriaServicio='" + idMateriaServicio + "']").addClass(
    "btn-primary agregarMateriaServicio"
  );

   
    // AGRUPAR MATERIAS EN FORMATO JSON

    listarMateriaServicios();
  
});


/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioOrdenServicio").on("keyup", "input.nuevaCantidadMateria", function() {
  

  var nuevoStock = Number($(this).attr("stock")) - $(this).val();

  $(this).attr("nuevoStock", nuevoStock);

  if (Number($(this).val()) > Number($(this).attr("stock"))) {
    /*=============================================
    SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
    =============================================*/

    $(this).val(1);

    

    swal({
      title: "La cantidad supera el Stock",
      text: "¡Sólo hay " + $(this).attr("stock") + " unidades!",
      type: "error",
      confirmButtonText: "¡Cerrar!"
    });

    return;
  }

  

  // AGRUPAR MATERIAS EN FORMATO JSON

  listarMateriaServicios();
});

/*=============================================
MODIFICAR MATERIA DESTINO
=============================================*/
$(".formularioOrdenServicio").on("click", "input.nuevoCodigoPro2", function() {
  var $element;
  var encontrado=0;
  $("#ModalMPOrdenServicioDestino").modal('show');
  $element=$(this);

  $("#ModalMPOrdenServicioDestino").on('click','tr .boton',function(){
    var data = [];
    var i=0;
    //Recorrido de.boton'l array
    $(this).parents("tr").find("td").each(function(){
      data.push($(this).html());
    });

    



    if(encontrado!=-1){
    $element.parents("tr").find("input").each(function(){
      if(i==4){
        $(this).val(data[1]);
      }else if(i==5){
        $(this).val(data[2]);
      }else if(i==6){
        $(this).val(data[3]);
      }else if(i==7){
        $(this).val(data[4]);
      }
        i++;
      });
      i=0;
    }
    encontrado=0;
    $("#ModalMPOrdenServicioDestino").modal('hide');
  });
});



/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarMateriaServicios() {
  var listarMateriaServicios = [];

  var descripcion = $(".nuevaDescripcionMateria");

  var cantidad = $(".nuevaCantidadMateria");

  var codpro = $(".nuevoCodigoPro");

  var color = $(".nuevoColor");

  var descripcion_des = $(".nuevaDescripcionMateria2");

  var codpro_des = $(".nuevoCodigoPro2");

  var color_des = $(".nuevoColor2");


  for (var i = 0; i < descripcion.length; i++) {
    listarMateriaServicios.push({
      id:  $(codpro[i]).val(),
      descripcion: $(descripcion[i]).val(),
      cantidad: $(cantidad[i]).val(),
      color: $(color[i]).val(),
      stock : $(cantidad[i]).attr("nuevoStock"),
      id_des:  $(codpro_des[i]).val(),
      descripcion_des: $(descripcion_des[i]).val(),
      color_des: $(color_des[i]).val()
    });
  }

  console.log("listarMateriaServicios", JSON.stringify(listarMateriaServicios)); 

  $("#listarMateriaServicios").val(JSON.stringify(listarMateriaServicios));
}


/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

function quitarAgregarMateriaServicio() {
  //Capturamos todos los id de productos que fueron elegidos en la venta
  var idMateriaServicios = $(".quitarMateriaServicio");
  //console.log("idProductos", idProductos);

  //Capturamos todos los botones de agregar que aparecen en la tabla
  var botonesTabla = $(".tablaMateriaOrdenesServicios tbody button.agregarMateriaServicio");


  //Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
  for (var i = 0; i < idMateriaServicios.length; i++) {
    //Capturamos los Id de los productos agregados a la venta
    var boton = $(idMateriaServicios[i]).attr("idMateriaServicio");

    //Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
    for (var j = 0; j < botonesTabla.length; j++) {
      if ($(botonesTabla[j]).attr("idMateriaServicio") == boton) {
        $(botonesTabla[j]).removeClass("btn-primary agregarMateriaServicio");
        $(botonesTabla[j]).addClass("btn-default");
      }
    }
  }
}

/*=============================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
=============================================*/

$(".tablaMateriaOrdenesServicios").on("draw.dt", function() {
  quitarAgregarMateriaServicio();
});


//  // Modal para entrar ingresar la data de materia prima destino
//  function dataMateriaPrimaOrdenServicioDestino(input,modal){
//   var $element;
//   var encontrado=0;
//   $('.add-table').on('click',input,function(){
//     $(modal).modal('show');
//     $element=$(this);
//   });

//   $(modal).on('click','tr .boton',function(){
//     var data = [];
//     var i=0;
//     //Recorrido de.boton'l array
//     $(this).parents("tr").find("td").each(function(){
//       data.push($(this).html());
//     });

    



//     if(encontrado!=-1){
//     $element.parents("tr").find("input").each(function(){
//       if(i==4){
//         $(this).val(data[1]);
//       }else if(i==5){
//         $(this).val(data[2]);
//       }else if(i==6){
//         $(this).val(data[3]);
//       }else if(i==7){
//         $(this).val(data[4]);
//       }
//         i++;
//       });
//       i=0;
//     }
//     encontrado=0;
//     $(modal).modal('hide');
//   });
//  }
