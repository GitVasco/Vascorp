/*
* CARGAR TABLA TALLERES EN GENERAL
*/
// Validamos que venga la variable capturaRango en el localStorage
if (localStorage.getItem("capturaRango5") != null) {
	$("#daterange-btnTaller span").html(localStorage.getItem("capturaRango5"));
	cargarTablaTalleres(localStorage.getItem("fechaInicial"), localStorage.getItem("fechaFinal"));
} else {
	$("#daterange-btnTaller span").html('<i class="fa fa-calendar"></i> Rango de Fecha ');
	cargarTablaTalleres(null, null);
}


function cargarTablaTalleres(fechaInicial, fechaFinal){
$('.tablaTalleresG').DataTable({
	"ajax": "ajax/tabla-talleresGeneral.ajax.php?perfil=" + $("#perfilOculto").val()+"&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal,
	"deferRender": true,
	"retrieve": true,
	"processing": true,
	"order": [[0, "desc"]],
	"pageLength": 20,
	"lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
	"language": {

		"sProcessing": "Procesando...",
		"sLengthMenu": "Mostrar _MENU_ registros",
		"sZeroRecords": "No se encontraron resultados",
		"sEmptyTable": "Ningún dato disponible en esta tabla",
		"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix": "",
		"sSearch": "Buscar:",
		"sUrl": "",
		"sInfoThousands": ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
			"sFirst": "Primero",
			"sLast": "Último",
			"sNext": "Siguiente",
			"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

	}

});
}

// Validamos que venga la variable capturaRango en el localStorage
if (localStorage.getItem("capturaRango8") != null) {
	$("#daterange-btnTallerT span").html(localStorage.getItem("capturaRango5"));
	cargarTablaTalleresTerminados(localStorage.getItem("fechaInicial"), localStorage.getItem("fechaFinal"));
} else {
	$("#daterange-btnTallerT span").html('<i class="fa fa-calendar"></i> Rango de Fecha ');
	cargarTablaTalleresTerminados(null, null);
}

/*
* CARGAR TABLA TALLERES EN TERMINADO
*/
function cargarTablaTalleresTerminados(fechaInicial, fechaFinal){
$('.tablaTalleresT').DataTable({
	"ajax": "ajax/tabla-talleresTerminado.ajax.php?perfil=" + $("#perfilOculto").val()+"&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal,
	"deferRender": true,
	"retrieve": true,
	"processing": true,
	"order": [[0, "desc"]],
	"pageLength": 20,
	"lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
	"language": {

		"sProcessing": "Procesando...",
		"sLengthMenu": "Mostrar _MENU_ registros",
		"sZeroRecords": "No se encontraron resultados",
		"sEmptyTable": "Ningún dato disponible en esta tabla",
		"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix": "",
		"sSearch": "Buscar:",
		"sUrl": "",
		"sInfoThousands": ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
			"sFirst": "Primero",
			"sLast": "Último",
			"sNext": "Siguiente",
			"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

	}

});
}


/* 
! TABLA PARA LOS PRODUCTOS EN PROCESO
*/
$(".tablaTallerP").DataTable({
	ajax: "ajax/tabla-talleresP.ajax.php",
	deferRender: true,
	retrieve: true,
	processing: true,
	searching: false,
	paging:   false,
	ordering: false,
	info:     false,
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

  /* 
! TABLA PARA LOS PRODUCTOS EN TERMINADO
*/
$(".tablaTallerT").DataTable({
	ajax: "ajax/tabla-talleresT.ajax.php",
	deferRender: true,
	retrieve: true,
	processing: true,
	searching: false,
	paging:   false,
	ordering: false,
	info:     false,
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


/* 
* BOTON  IMPRIMIR TICKET
*/
$(".tablaTalleresG").on("click", ".btnImprimirTicket", function () {

	var ultimo = $(this).attr("ultimo");

	var modelo = $(this).attr("modelo");
	
	var nombre = $(this).attr("nombre");
	
	var color = $(this).attr("color");
	
	var talla = $(this).attr("talla");
	
	var cant_taller = $(this).attr("cant_taller");
	
	var cod_operacion = $(this).attr("cod_operacion");
	
	var nom_operacion = $(this).attr("nom_operacion");
	
	window.open("vistas/reportes_ticket/produccion_ticket_detalle.php?ultimo=" +ultimo + "&modelo=" + modelo + "&nombre=" + nombre + "&color=" + color + "&talla=" + talla + "&cant_taller=" + cant_taller + "&cod_operacion=" + cod_operacion + "&nom_operacion=" + nom_operacion,"_blank");
	
    
  
})

/* 
* BOTON  IMPRIMIR TICKET
*/
$(".tablaTalleresG").on("click", ".btnEditarTallerG", function () {

	var idTaller = $(this).attr("idTaller");
	var datos= new FormData();
	datos.append("idTaller",idTaller);
	$.ajax({
		url:"ajax/talleres.ajax.php",
		method:"POST",
		data:datos,
		cache: false,
		contentType:false,
		processData:false,
		dataType: "json",
		success:function(respuesta){
			$("#editarCodigo").val(respuesta["id_cabecera"]);
			$("#editarArticulo").val(respuesta["articulo"]);
			$("#cantidad").val(respuesta["cantidad"]);
			$("#editarCodOperacion").val(respuesta["cod_operacion"]);
			$("#editarCantidad").val(respuesta["cantidad"]);
			$("#editarTaller").val(respuesta["id"]);
			$("#editarBarra").val(respuesta["codigo"]);
			$("#editarTalla").val(respuesta["talla"]);
			$("#editarMarca").val(respuesta["marca"]);
			$("#editarColor").val(respuesta["color"]);
			$("#editarNombre").val(respuesta["nombre"]);
			$("#editarModelo").val(respuesta["modelo"]);
		}
	});
	

})


/*=============================================
RANGO DE FECHAS
=============================================*/
moment.locale('es');
$("#daterange-btnTaller").daterangepicker(
    {
	  cancelClass: "CancelarTaller",
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
      $("#daterange-btnTaller span").html(
        start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
      );
  
      var fechaInicial = start.format("YYYY-MM-DD");
  
      var fechaFinal = end.format("YYYY-MM-DD");
  
      var capturarRango5 = $("#daterange-btnTaller span").html();
  
      localStorage.setItem("capturarRango5", capturarRango5);
      localStorage.setItem("fechaInicial", fechaInicial);
      localStorage.setItem("fechaFinal", fechaFinal);
      // Recargamos la tabla con la información para ser mostrada en la tabla
      $(".tablaTalleresG").DataTable().destroy();
      cargarTablaTalleres(fechaInicial, fechaFinal);
    });
  
  /*=============================================
  CANCELAR RANGO DE FECHAS
  =============================================*/
  
  $(".daterangepicker.opensleft .range_inputs .CancelarTaller").on(
    "click",
    function() {
      localStorage.removeItem("capturarRango5");
      localStorage.removeItem("fechaInicial");
    	localStorage.removeItem("fechaFinal");
      localStorage.clear();
      window.location = "en-taller";
    }
  );
  
  /*=============================================
  CAPTURAR HOY
  =============================================*/
  
  $(".daterangepicker.opensleft .ranges li").on("click", function() {
    var textoHoy = $(this).attr("data-range-key");
  
    if (textoHoy == "Hoy") {
      var d = new Date();
  
      var dia = d.getDate();
      var mes = d.getMonth() + 1;
      var año = d.getFullYear();
  
      dia = ("0" + dia).slice(-2);
      mes = ("0" + mes).slice(-2);
  
      var fechaInicial = año + "-" + mes + "-" + dia;
      var fechaFinal = año + "-" + mes + "-" + dia;
  
      localStorage.setItem("capturarRango5", "Hoy");
      localStorage.setItem("fechaInicial", fechaInicial);
      localStorage.setItem("fechaFinal", fechaFinal);
      // Recargamos la tabla con la información para ser mostrada en la tabla
      $(".tablaTalleresG").DataTable().destroy();
      cargarTablaTalleres(fechaInicial, fechaFinal);
    }
  });


  
//Reporte de tALLERES
$(".box").on("click", ".btnReporteTalleres", function () {
    window.location = "vistas/reportes_excel/rpt_talleres.php";
  
})
/* 
! PRODUCCION DE TRUSAS
*/
/* 
* BOTON ACEPTAR
*/
$(".box").on("click", ".btnCargarTrusas", function () {

	$(".tablaProduccionTrusas").DataTable().destroy();

	var mesT = document.getElementById("mesT").value;
	//console.log(mesT);
	//$(".btnReporteSalida").attr("linea",mesT);
	localStorage.setItem("mesT", mesT);

	cargarTablaProduccionTrusas(localStorage.getItem("mesT"));
	
})

/* 
* VEMOS SI LOCAL STORAGE TRAE ALGO
*/
if (localStorage.getItem("mesT") != null) {

	cargarTablaProduccionTrusas(localStorage.getItem("mesT"));
	console.log("lleno");
	
}else{

	cargarTablaProduccionTrusas(null);
	console.log("vacio");

}


/* 
* TABLA PARA PRODUCCION TRUSAS
*/
function cargarTablaProduccionTrusas(mesT) {
	$('.tablaProduccionTrusas').DataTable( {
		"ajax": "ajax/tabla-producciontrusas.ajax.php?perfil="+$("#perfilOculto").val() + "&mesT=" + mesT,
		"deferRender": true,
		"retrieve": true,
		"processing": true,
		"order": [[1, "desc"]],
		"pageLength": 20,
		"lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
		"language": {

				"sProcessing":     "Procesando...",
				"sLengthMenu":     "Mostrar _MENU_ registros",
				"sZeroRecords":    "No se encontraron resultados",
				"sEmptyTable":     "Ningún dato disponible en esta tabla",
				"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
				"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix":    "",
				"sSearch":         "Buscar:",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}

		}    
	} );
}


/* 
! PRODUCCION DE BRASIER
*/
/* 
* BOTON ACEPTAR
*/
$(".box").on("click", ".btnCargarBrasier", function () {

	$(".tablaProduccionBrasier").DataTable().destroy();

	var mesB = document.getElementById("mesB").value;
	//console.log(mesB);
	//$(".btnReporteSalida").attr("linea",mesB);
	localStorage.setItem("mesB", mesB);

	cargarTablaProduccionBrasier(localStorage.getItem("mesB"));
	
})

/* 
* VEMOS SI LOCAL STORAGE TRAE ALGO
*/
if (localStorage.getItem("mesB") != null) {

	cargarTablaProduccionBrasier(localStorage.getItem("mesB"));
	console.log("lleno");
	
}else{

	cargarTablaProduccionBrasier(null);
	console.log("vacio");

}


/* 
* TABLA PARA PRODUCCION Brasier
*/
function cargarTablaProduccionBrasier(mesB) {
	$('.tablaProduccionBrasier').DataTable( {
		"ajax": "ajax/tabla-produccionbrasier.ajax.php?perfil="+$("#perfilOculto").val() + "&mesB=" + mesB,
		"deferRender": true,
		"retrieve": true,
		"processing": true,
		"order": [[1, "desc"]],
		"pageLength": 20,
		"lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
		"language": {

				"sProcessing":     "Procesando...",
				"sLengthMenu":     "Mostrar _MENU_ registros",
				"sZeroRecords":    "No se encontraron resultados",
				"sEmptyTable":     "Ningún dato disponible en esta tabla",
				"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
				"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix":    "",
				"sSearch":         "Buscar:",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}

		}    
	} );
}
$("#nuevoTalleres").change(function(){
	$("#nuevoCodigo").val($(this).val()+"1234");
})
$('.tablaArticulosTalleres').DataTable( {
    "ajax": "ajax/tabla-articulostaller.ajax.php",
    "deferRender": true,
	"retrieve": true,
    "processing": true,
    "pageLength": 20,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     ">>>",
			"sPrevious": "<<<"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
})

$("#daterange-btnTallerT").daterangepicker(
    {
	  cancelClass: "CancelarTallerT",
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
      $("#daterange-btnTallerT span").html(
        start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
      );
  
      var fechaInicial = start.format("YYYY-MM-DD");
  
      var fechaFinal = end.format("YYYY-MM-DD");
  
      var capturarRango8 = $("#daterange-btnTallerT span").html();
  
      localStorage.setItem("capturarRango8", capturarRango8);
      localStorage.setItem("fechaInicial", fechaInicial);
      localStorage.setItem("fechaFinal", fechaFinal);
      // Recargamos la tabla con la información para ser mostrada en la tabla
      $(".tablaTalleresT").DataTable().destroy();
      cargarTablaTalleresTerminados(fechaInicial, fechaFinal);
    });
  
  /*=============================================
  CANCELAR RANGO DE FECHAS
  =============================================*/
  
  $(".daterangepicker.opensleft .range_inputs .CancelarTallerT").on(
    "click",
    function() {
      localStorage.removeItem("capturarRango8");
      localStorage.removeItem("fechaInicial");
    	localStorage.removeItem("fechaFinal");
      localStorage.clear();
      window.location = "en-tallert";
    }
  );
  
  /*=============================================
  CAPTURAR HOY
  =============================================*/
  
  $(".daterangepicker.opensleft .ranges li").on("click", function() {
    var textoHoy = $(this).attr("data-range-key");
  
    if (textoHoy == "Hoy") {
      var d = new Date();
  
      var dia = d.getDate();
      var mes = d.getMonth() + 1;
      var año = d.getFullYear();
  
      dia = ("0" + dia).slice(-2);
      mes = ("0" + mes).slice(-2);
  
      var fechaInicial = año + "-" + mes + "-" + dia;
      var fechaFinal = año + "-" + mes + "-" + dia;
  
      localStorage.setItem("capturarRango8", "Hoy");
      localStorage.setItem("fechaInicial", fechaInicial);
      localStorage.setItem("fechaFinal", fechaFinal);
      // Recargamos la tabla con la información para ser mostrada en la tabla
      $(".tablaTalleresT").DataTable().destroy();
      cargarTablaTalleresTerminados(fechaInicial, fechaFinal);
    }
  });


$(".tablaArticulosTalleres tbody").on("click", "button.agregarArt", function () {

    var articuloOC = $(this).attr("articuloT");
    var taller = $(this).attr("taller");
    //console.log(stockG);

    /* console.log("articuloOC", articuloOC); */

    $(this).removeClass("btn-primary agregarArt");

    $(this).addClass("btn-default");

    var datos = new FormData();
    datos.append("articuloT", articuloT);

    $.ajax({

        url: "ajax/articulos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            /* console.log("respuesta", respuesta); */

            var articulo = respuesta["articulo"];
            var packing = respuesta["packingB"];
            var ord_corte = respuesta["ord_corte"];
            var stockG = respuesta["stockG"];

            /* 
            todo: AGREGAR LOS CAMPOS
            */

            $(".nuevoArticuloOC").append(

                '<div class="row" style="padding:5px 15px">' +

                    "<!-- Descripción del Articulo -->" +

                    '<div class="col-xs-6" style="padding-right:0px">' +

                        '<div class="input-group">' +
                        
                            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarOC" articuloOC="' + articuloOC + '"><i class="fa fa-times"></i></button></span>' +

                            '<input type="text" class="form-control nuevaDescripcionProducto input-sm" articuloOC="' + articuloOC + '" name="agregarOC" value="' + packing + '" codigoAC="' + articulo + '" readonly required>' +

                        "</div>" +

                    "</div>" +

                    "<!-- Cantidad de la Orden de Corte -->" +

                    '<div class="col-xs-2">' +

                        '<input type="number" class="form-control nuevaCantidadArticuloOC input-sm" name="nuevaCantidadArticuloOC" id="nuevaCantidadArticuloOC" min="1" value="50" ord_corte="' + ord_corte + '" articulo="'+ articulo +'" nuevoOrdCorte="' + Number(Number(ord_corte) + 50) + '" required>' +

                    "</div>" +

                "</div>"

            );

            // SUMAR TOTAL DE UNIDADES

                sumarTotalOC();

            // AGREGAR IMPUESTO

            

            // AGRUPAR PRODUCTOS EN FORMATO JSON

            listarArticulosOC();

            // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

                      
        }

    })


});

/* 
* CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
*/
$(".tablaArticulosOrdenCorte").on("draw.dt", function () {
    /* console.log("tabla"); */

    if (localStorage.getItem("quitarOC") != null) {
        var listaIdArticuloOC = JSON.parse(localStorage.getItem("quitarOC"));

        for (var i = 0; i < listaIdArticuloOC.length; i++) {
            $("button.recuperarBoton[articuloOC='" + listaIdArticuloOC[i]["articuloOC"] + "']").removeClass("btn-default");

            $("button.recuperarBoton[articuloOC='" + listaIdArticuloOC[i]["articuloOC"] + "']").addClass("btn-primary agregarArt");
        }
    }
});

/* 
* QUITAR ARTICULO DE LA ORDEN DE CORTE Y RECUPERAR BOTÓN
*/
var idQuitarArticuloOC = [];

localStorage.removeItem("quitarOC");

$(".formularioOrdenCorte").on("click", "button.quitarOC", function () {

    /* console.log("boton"); */

    $(this).parent().parent().parent().parent().remove();

    var articuloOC = $(this).attr("articuloOC");

    /*=============================================
    ALMACENAR EN EL LOCALSTORAGE EL ID DEL MATERIA PRIMA A QUITAR
    =============================================*/

    if (localStorage.getItem("quitarOC") == null) {

        idQuitarArticuloOC = [];

    } else {

        idQuitarArticuloOC.concat(localStorage.getItem("quitarOC"))

    }

    idQuitarArticuloOC.push({
        "articuloOC": articuloOC
    });

    localStorage.setItem("quitarOC", JSON.stringify(idQuitarArticuloOC));

    $("button.recuperarBoton[articuloOC='" + articuloOC + "']").removeClass('btn-default');

    $("button.recuperarBoton[articuloOC='" + articuloOC + "']").addClass('btn-primary agregarArt');


    if ($(".nuevoArticuloOC").children().length == 0) {

        $("#nuevoTotalOrdenCorte").val(0);
        $("#totalOrdenCorte").val(0);
        $("#nuevoTotalOrdenCorte").attr("total", 0);

    } else {

            // SUMAR TOTAL DE UNIDADES

            sumarTotalOC();

            // AGREGAR IMPUESTO

            

            // AGRUPAR PRODUCTOS EN FORMATO JSON

            listarArticulosOC()


    }

})

/* 
* MODIFICAR LA CANTIDAD
*/
$(".formularioOrdenCorte").on("change", "input.nuevaCantidadArticuloOC", function() {

    var nuevoOrdCorte = Number($(this).attr("ord_corte")) + Number($(this).val());
    var articulo = $(this).attr("articulo");
    //console.log(articulo);
    var articuloM = articulo+'M';
    //console.log(articuloM);

    var pendiente = $(this)
    .parent()
    .parent()
    .children(".pendiente")
    .children(".nuevoPendienteProy");
    //console.log(pendiente);

    var pendienteReal = pendiente.attr("pendienteReal");
    //console.log(pendiente);
    //console.log(pendienteReal);

    var quedaPen = pendienteReal - Number($(this).val());
    //console.log(quedaPen);

    pendiente.val(quedaPen);

    $(this).attr("nuevoOrdCorte", Number(nuevoOrdCorte));


    if (quedaPen > 0){

        inputPositivoPend(articulo);

    }else{

        inputNegativoPend(articulo);

    }

    var mes = $(this)
    .parent()
    .parent()
    .children(".mes")
    .children(".nuevoMes");
    //console.log(mes);

    var mesReal = mes.attr("mesReal");
    //console.log(mesReal);

    var stockG = mes.attr("stockG");
    //console.log(Number(stockG) +50);
    var stock = Number(stockG) + Number($(this).val());

    var ventasG = mes.attr("ventasG");
    //console.log(ventasG * 1.3);
    var venta = ventasG * 1.3
 
    var quedaMes = stock / venta;
    //console.log(quedaMes);

    mes.val(quedaMes.toFixed(2));

    if(quedaMes < 2.1){

        inputPositivoMes(articuloM);
        //console.log("Hola mundo");

    }else{

        inputNegativoMes(articuloM);
        //console.log("Hola no Mundo");

    }



    // SUMAR TOTAL DE UNIDADES

    sumarTotalOC();
  
    // AGREGAR IMPUESTO
  

    // AGRUPAR PRODUCTOS EN FORMATO JSON
  
    listarArticulosOC();



  });

  
/* 
* SUMAR EL TOTAL DE LAS ORDENES DE CORTE
*/
  
function sumarTotalOC() {

    var cantidadOc = $(".nuevaCantidadArticuloOC");
  
    //console.log("cantidadOc", cantidadOc);
  
    var arraySumarCantidades = [];

    for (var i = 0; i < cantidadOc.length; i++){

        arraySumarCantidades.push(Number($(cantidadOc[i]).val()));

    }
        /* console.log("arraySumarCantidades", arraySumarCantidades); */

    function sunaArrayCantidades(total, numero) {
        return total + numero;
    }

    var sumarTotal = arraySumarCantidades.reduce(sunaArrayCantidades);

    /* console.log("sumarTotal", sumarTotal); */

    $("#nuevoTotalOrdenCorte").val(sumarTotal);
    $("#totalOrdenCorte").val(sumarTotal);
    $("#nuevoTotalOrdenCorte").attr("total", sumarTotal);

}

/* 
* FORMATO DE MILES AL TOTAL
*/
$("#nuevoTotalOrdenCorte").number(true, 0);

/* 
* LISTAR TODOS LOS ARTICULOS
*/
function listarArticulosOC() {

    var listaArticulos = [];
  
    var descripcion = $(".nuevaDescripcionProducto");
  
    var cantidad = $(".nuevaCantidadArticuloOC");
    
    for (var i = 0; i < descripcion.length; i++) {

      listaArticulos.push({

        id: $(descripcion[i]).attr("articuloOC"),
        articulo: $(descripcion[i]).attr("codigoAC"),
        cantidad: $(cantidad[i]).val(),
        ord_corte: $(cantidad[i]).attr("nuevoOrdCorte")

      });
    }
  
    /* console.log("listaArticulos", JSON.stringify(listaArticulos)); */
  
    $("#listaArticulosOC").val(JSON.stringify(listaArticulos));

}

/* 
* BOTON EDITAR ORDEN DE CORTE
*/
$(".tablaOrdenCorte").on("click", ".btnEditarOC", function () {

	var codigo = $(this).attr("codigo");

  window.location = "index.php?ruta=editar-detalle-ordencorte&codigo=" + codigo;
  
})

/* 
*FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL ARTICULO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
*/
function quitarAgregarArticuloOC() {

	//Capturamos todos los id de productos que fueron elegidos en la venta
    var articuloOC = $(".quitarOC");
    //console.log("articuloOC", articuloOC);

	//Capturamos todos los botones de agregar que aparecen en la tabla
    var botonesTablaOC = $(".tablaArticulosOrdenCorte tbody button.agregarArt");
    //console.log("botonesTablaOC", botonesTablaOC);

	//Recorremos en un ciclo para obtener los diferentes articuloOC que fueron agregados a la venta
	for (var i = 0; i < articuloOC.length; i++) {

		//Capturamos los Id de los productos agregados a la venta
		var boton = $(articuloOC[i]).attr("articuloOC");

		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for (var j = 0; j < botonesTablaOC.length; j++) {

			if ($(botonesTablaOC[j]).attr("articuloOC") == boton) {

				$(botonesTablaOC[j]).removeClass("btn-primary agregarMP");
				$(botonesTablaOC[j]).addClass("btn-default");

			}
		}

	}

}

/* 
* CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
*/
$(".tablaArticulosOrdenCorte").on("draw.dt", function() {
    quitarAgregarArticuloOC();
});
  
