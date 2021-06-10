/*=============================================
CARGAR LA TABLA DINÁMICA DE NOTAS DE SALIDAS
=============================================*/

if (localStorage.getItem("capturarRango30") != null) {
	$("#daterange-btnOrdenCompra span").html(localStorage.getItem("capturarRango30"));
	cargarTablaOrdenCompra(localStorage.getItem("fechaInicial"), localStorage.getItem("fechaFinal"));
} else {
	$("#daterange-btnOrdenCompra span").html('<i class="fa fa-calendar"></i> Rango de Fecha ');
	cargarTablaOrdenCompra(null, null);
}


/* 
* TABLA PARA PRODUCCION Brasier
*/
function cargarTablaOrdenCompra(fechaInicial,fechaFinal) {

 $(".tablaOrdenesCompras").DataTable({
    ajax: "ajax/materiaprima/tabla-orden-compra.ajax.php?perfil="+$("#perfilOculto").val() + "&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal,
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
RANGO DE FECHAS PARA ORDEN DE COMPRA
=============================================*/

$("#daterange-btnOrdenCompra").daterangepicker(
  {
    cancelClass: "CancelarOrdenCompra",
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
    $("#daterange-btnOrdenCompra span").html(
      start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
    );

    var fechaInicial = start.format("YYYY-MM-DD");

    var fechaFinal = end.format("YYYY-MM-DD");

    var capturarRango30 = $("#daterange-btnOrdenCompra span").html();
  
    localStorage.setItem("capturarRango30", capturarRango30);
    localStorage.setItem("fechaInicial", fechaInicial);
    localStorage.setItem("fechaFinal", fechaFinal);

    // Recargamos la tabla con la información para ser mostrada en la tabla
    $(".tablaOrdenesCompras").DataTable().destroy();
    cargarTablaOrdenCompra(fechaInicial, fechaFinal);
  });

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensleft .range_inputs .CancelarOrdenCompra").on(
  "click",
  function() {
    localStorage.removeItem("capturarRango30");
    localStorage.removeItem("fechaInicial");
    localStorage.removeItem("fechaFinal");
    localStorage.clear();
    window.location = "orden-compra";
  }
);

/*=============================================
CAPTURAR HOY
=============================================*/

$(".daterangepicker.opensleft .ranges li").on("click", function() {
  var textoHoy = $(this).attr("data-range-key");
  var ruta = $("#rutaAcceso").val();
  if(ruta == "orden-compra"){
    if (textoHoy == "Hoy") {
      var d = new Date();
  
      var dia = d.getDate();
      var mes = d.getMonth() + 1;
      var año = d.getFullYear();
  
      dia = ("0" + dia).slice(-2);
      mes = ("0" + mes).slice(-2);
  
      var fechaInicial = año + "-" + mes + "-" + dia;
      var fechaFinal = año + "-" + mes + "-" + dia;
  
      localStorage.setItem("capturarRango30", "Hoy");
      localStorage.setItem("fechaInicial", fechaInicial);
      localStorage.setItem("fechaFinal", fechaFinal);
    // Recargamos la tabla con la información para ser mostrada en la tabla
      $(".tablaOrdenesCompras").DataTable().destroy();
      cargarTablaOrdenCompra(fechaInicial, fechaFinal);
    }
  }

});

//ORDEN DE COMPRA PROVEEDOR CON SELECT DE MONEDA
$(".formularioOrdenCompra").on("change","select#nuevoProveedorCompra",function(){
	var CodRuc = $(this).val();
	var datos = new FormData();
  $(this).attr("disabled",true);
	datos.append("CodRuc", CodRuc);
  $(".tablaMateriaOrdenCompra").DataTable().destroy();
	cargarTablaMateriaCompra(CodRuc);

  	//TRAEMOS CAMPOS DEL PROVEEDOR POR CODIGO
	
	$.ajax({

		url:"ajax/proveedor.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
			// console.log(respuesta);
			$("#nuevaMonedaCompra").val(respuesta["Des_Larga"]);
			$("#nuevaMonedaCompra").selectpicker("refresh");
      $("#nuevoRuc").val(respuesta["RucPro"]);
      $("#nuevoDia").val(respuesta["Dia"]);
      $("#nuevaRazonSocial").val(respuesta["RazPro"]);
      $("#nuevaFormaPago").val(respuesta["ForPag"]);
			$("#nuevaFormaPago").selectpicker("refresh");

 
		}
  
	})	
  
  //TRAEMOS TIPO DE CAMBIO POR API
  var datos2 = new FormData();
  datos2.append("ApiCambio", "ApiCambio");
  $.ajax({

		url:"ajax/orden-compra.ajax.php",
		method: "POST",
		data: datos2,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

			$("#nuevoTipoCambio").val(respuesta["cambio_actual"]["venta"]);
		}
  
	})

})

/* 
* TABLA A PARA MP SIN OC  
*/
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

//AGREGAR MATERIA PRIMA PARA LA ORDEN DE COMPRA

/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/

$(".tablaMateriaOrdenCompra").on("click", "button.agregarMateriaCompra", function() {
  
  var idMateriaCompra = $(this).attr("idMateriaCompra");

  /* console.log("idProducto", idProducto); */

  $(this).removeClass("btn-primary agregarMateriaCompra");

  $(this).addClass("btn-default");

  var datos = new FormData();
  datos.append("idMateriaPrima", idMateriaCompra);

  $.ajax({
    url: "ajax/materiaprima.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {
      // console.log(respuesta);
      var codpro = respuesta["codpro"];
      var codfab = respuesta["codfab"];
      var color = respuesta["color"];
      var unidad = respuesta["unidad"];
      var precio = respuesta["precio"];
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

        $("button[idMateriaCompra='" + idMateriaCompra + "']").addClass(
          "btn-primary agregarMateriaNota"
        );

        return;
      }
      var datos2 = new FormData();
      datos2.append("ColorCompra", "");

      $.ajax({
        url: "ajax/orden-compra.ajax.php",
        method: "POST",
        data: datos2,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta2) {
          $(".nuevoColorProv").find('option').remove();
                
            $(".nuevoColorProv").append("<option value=''>COLOR</option>");
            for (let i = 0; i < respuesta2.length; i++) {
              
              $(".nuevoColorProv").append("<option value='"+respuesta2[i]["cod_argumento"]+"'>"+respuesta2[i]["cod_argumento"]+" - "+respuesta2[i]["des_larga"]+"</option>");
              
            }
        }

      });

      $(".nuevaMateriaCompra").append(

        '<div class="row" style="padding:1px 15px">' +

          "<!-- Descripción del producto -->" +

          '<div class="col-xs-1" style="padding-right:0px">' +

              '<input type="text" class="form-control input-sm nuevoCodigoPro" idMateriaCompra="' + codpro + '" name="agregarProducto" value="' + codpro + '"  readonly>' +

          "</div>" +

          '<div class="col-xs-1" >' +

              '<input type="text" class="form-control input-sm nuevoCodigoFabrica"  name="nuevoCodigoFabrica" value="' + codfab + '"  readonly>' +

          "</div>" +

          '<div class="col-xs-3" >' +

              '<input type="text" class="form-control input-sm nuevaDescripcionMateria"  name="nuevaDescripcionMateria" value="' + descripcion + '"  readonly>' +

          "</div>" +

          '<div class="col-xs-1" >' +

              '<input type="text" class="form-control input-sm nuevoColor"  name="nuevoColor" value="' + color + '"  readonly>' +

          "</div>" +

          '<div class="col-xs-1" >' +

              '<select class="form-control input-sm select2 nuevoColorProv" name="nuevoColorProv" >' +
              '<option value="">COLOR</option>' +

              '</select>'+

          "</div>" +

          "<!-- Cantidad del producto -->" +

          '<div class="col-xs-1 ingresoCantidad">' +

            '<input type="number" step="any" class="form-control input-sm nuevaCantidadMateria" name="nuevaCantidadMateria" min="1" value="1" stock="' + stock + '" nuevoStock="' + Number(stock - 1) + '"   required>' +
            
          "</div>" +

          '<div class="col-xs-1" >' +

              '<input type="text" class="form-control input-sm nuevaUnidad"  name="nuevaUnidad" value="' + unidad + '"  readonly required>' +

          "</div>" +

          '<div class="col-xs-1 ingresoPrecio" >' +

              '<input type="number" min="0" step="any"  class="form-control input-sm nuevoPrecio"  name="nuevoPrecio" value="' + precio + '"   required>' +

          "</div>" +

          '<div class="col-xs-1 ingresoDscto" >' +

              '<input type="number" min="0"  step="any" class="form-control input-sm nuevoDscto"  name="nuevoDscto" value="0.00"   >' +

          "</div>" +

          '<div class="col-xs-1 ingresoTotal" >' +
            '<div class="input-group">' +
              '<input type="number" step="any" class="form-control input-sm nuevoTotal"  name="nuevoTotal" value="'+precio+'"  readonly required>' +
              '<span class="input-group-addon"  style="padding: 3px 6px"><button type="button" class="btn btn-danger btn-xs quitarMateriaCompra" idMateriaCompra="' + idMateriaCompra + '"><i class="fa fa-times"></i></button></span>' +
            "</div>" +
          "</div>" +

          


        "</div>"


      );


      // AGRUPAR MATERIAS EN FORMATO JSON

      listarMateriaCompras();
     
      


    }
  });
});

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaMateriaOrdenCompra").on("draw.dt", function() {
  /* console.log("tabla"); */

  if (localStorage.getItem("quitarMateriaCompra") != null) {
    var listaIdMateriaCompra = JSON.parse(localStorage.getItem("quitarMateriaCompra"));

    for (var i = 0; i < listaIdMateriaCompra.length; i++) {
      $(
        "button.recuperarBoton[idMateriaCompra='" +
        listaIdMateriaCompra[i]["idMateriaCompra"] +
          "']"
      ).removeClass("btn-default");
      $(
        "button.recuperarBoton[idMateriaCompra='" +
        listaIdMateriaCompra[i]["idMateriaCompra"] +
          "']"
      ).addClass("btn-primary agregarMateriaCompra");
    }
  }
});

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarMateriaCompra = [];

localStorage.removeItem("quitarMateriaCompra");

$(".formularioOrdenCompra").on("click", "button.quitarMateriaCompra", function() {
  /* console.log("boton"); */

  $(this)
    .parent()
    .parent()
    .parent()
    .parent()
    .remove();

  var idMateriaCompra = $(this).attr("idMateriaCompra");

  /*=============================================
  ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
  =============================================*/

  if (localStorage.getItem("quitarMateriaCompra") == null) {
    idQuitarMateriaCompra = [];
  } else {
    idQuitarMateriaCompra.concat(localStorage.getItem("quitarMateriaNota"));
  }

  idQuitarMateriaCompra.push({
    idMateriaCompra: idMateriaCompra
  });

  localStorage.setItem("quitarMateriaCompra", JSON.stringify(idQuitarMateriaCompra));

  $("button.recuperarBoton[idMateriaCompra='" + idMateriaCompra + "']").removeClass(
    "btn-default"
  );

  $("button.recuperarBoton[idMateriaCompra='" + idMateriaCompra + "']").addClass(
    "btn-primary agregarMateriaCompra"
  );

   
    // AGRUPAR MATERIAS EN FORMATO JSON

    listarMateriaCompras();
  
});


/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioOrdenCompra").on("keyup", "input.nuevaCantidadMateria", function() {

  //entramos al input de precio para obtener su valor
  var precio = $(this)
  .parent()
  .parent()
  .children(".ingresoPrecio")
  .children(".nuevoPrecio");  
  // console.log(precio);

  var cantRecibida = Number($(this).val());
  //console.log(cantRecibida)

  
  //entramos al input del total par asignar el valor
  var total = $(this)
              .parent()
              .parent()
              .children(".ingresoTotal")
              .children()
              .children(".nuevoTotal"); 
  // console.log(total);

  //entramos al input del descuento para obtener su valor
  var descuento = $(this)
  .parent()
  .parent()
  .children(".ingresoDscto")
  .children(".nuevoDscto");  
  
  //Obtenemos el descuento lo dividimos entre 100 como porcentaje
  var descuentoTotal = (precio.val() * cantRecibida) * (descuento.val()/100);

  //le restamos el descuento al total
  precioFinal = (precio.val() * cantRecibida) - descuentoTotal;

  total.val(precioFinal.toFixed(6));

  

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

  listarMateriaCompras();
});


$(".formularioOrdenCompra").on("keyup", "input.nuevoPrecio", function() {

  //entramos al input de cantidad para obtener su valor
  var cantidad = $(this)
  .parent()
  .parent()
  .children(".ingresoCantidad")
  .children(".nuevaCantidadMateria");  
  // console.log(precio);

  var precio = Number($(this).val());
  //console.log(cantRecibida)

  

  //entramos al input de total para asignar su valor
  var total = $(this)
              .parent()
              .parent()
              .children(".ingresoTotal")
              .children()
              .children(".nuevoTotal"); 
  // console.log(total);

  //entramos al input de descuento para obtener su valor
  var descuento = $(this)
  .parent()
  .parent()
  .children(".ingresoDscto")
  .children(".nuevoDscto");  
  
  //Obtenemos el descuento lo dividimos entre 100 como porcentaje
  var descuentoTotal = (precio * cantidad.val()) * (descuento.val()/100);

  //le restamos el descuento al total
  precioFinal = (precio * cantidad.val()) - descuentoTotal;

  total.val(precioFinal.toFixed(6));

  listarMateriaCompras();
});


$(".formularioOrdenCompra").on("change", "select.nuevoColorProv", function() {
  listarMateriaCompras();
});


/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioOrdenCompra").on("change", "input.nuevoDscto", function() {

  //entramos al input de cantidad para obtener su valor
  var cantidad = $(this)
  .parent()
  .parent()
  .children(".ingresoCantidad")
  .children(".nuevaCantidadMateria");  

  //entramos al input de precio para obtener su valor
  var precio = $(this)
  .parent()
  .parent()
  .children(".ingresoPrecio")
  .children(".nuevoPrecio");  

  //entramos al input de total para asignar su valor
  var total = $(this)
  .parent()
  .parent()
  .children(".ingresoTotal")
  .children()
  .children(".nuevoTotal"); 

  //Obtenemos el descuento lo dividimos entre 100 como porcentaje
  var nuevoDscto = (precio.val() * cantidad.val()) * ($(this).val()/100);
  // console.log(nuevoDscto);

  //le restamos el descuento al total
  var nuevoTotal = (precio.val() * cantidad.val())- nuevoDscto;

  total.val(nuevoTotal.toFixed(6));

  listarMateriaCompras();
})

/*=============================================
LISTAR TODAS LAS MATERIA PRIMA
=============================================*/

function listarMateriaCompras() {
  var listarMateriaCompras = [];

  var descripcion = $(".nuevaDescripcionMateria");

  var cantidad = $(".nuevaCantidadMateria");

  var codpro = $(".nuevoCodigoPro");

  var codfab = $(".nuevoCodigoFab");
  
  var colorprov = $(".nuevoColorProv");

  var descuento = $(".nuevoDscto");

  var color = $(".nuevoColor");

  var precio = $(".nuevoPrecio");

  var total = $(".nuevoTotal");

  for (var i = 0; i < descripcion.length; i++) {
    listarMateriaCompras.push({
      id:  $(codpro[i]).val(),
      codfab:  $(codfab[i]).val(),
      descripcion: $(descripcion[i]).val(),
      cantidad: $(cantidad[i]).val(),
      colorprov: $(colorprov[i]).val(),
      descuento: $(descuento[i]).val(),
      color: $(color[i]).val(),
      stock : $(cantidad[i]).attr("nuevoStock"),
      precio: $(precio[i]).val(),
      total: $(total[i]).val(),
    });
  }

  // console.log("listarMateriaCompras", JSON.stringify(listarMateriaCompras)); 

  $("#listarMateriaCompras").val(JSON.stringify(listarMateriaCompras));
}


/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

function quitarAgregarMateriaCompra() {
  //Capturamos todos los id de productos que fueron elegidos en la venta
  var idMateriaCompras = $(".quitarMateriaCompra");
  //console.log("idProductos", idProductos);

  //Capturamos todos los botones de agregar que aparecen en la tabla
  var botonesTabla = $(".tablaMateriaOrdenCompra tbody button.agregarMateriaCompra");


  //Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
  for (var i = 0; i < idMateriaCompras.length; i++) {
    //Capturamos los Id de los productos agregados a la venta
    var boton = $(idMateriaCompras[i]).attr("idMateriaCompra");

    //Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
    for (var j = 0; j < botonesTabla.length; j++) {
      if ($(botonesTabla[j]).attr("idMateriaCompra") == boton) {
        $(botonesTabla[j]).removeClass("btn-primary agregarMateriaCompra");
        $(botonesTabla[j]).addClass("btn-default");
      }
    }
  }
}

/*=============================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
=============================================*/

$(".tablaMateriaOrdenCompra").on("draw.dt", function() {
  quitarAgregarMateriaCompra();
});