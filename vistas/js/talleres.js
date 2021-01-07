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
	$("#daterange-btnTallerT span").html(localStorage.getItem("capturaRango8"));
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
	// console.log("lleno");
	
}else{

	cargarTablaProduccionTrusas(null);
	// console.log("vacio");

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
	//console.log("lleno");
	
}else{

	cargarTablaProduccionBrasier(null);
	//console.log("vacio");

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

/* 
! PRODUCCION DE VASCO
*/
/* 
* BOTON ACEPTAR
*/
$(".box").on("click", ".btnCargarVasco", function () {

	$(".tablaProduccionVasco").DataTable().destroy();

	var mesV = document.getElementById("mesV").value;
	//console.log(mesV);
	//$(".btnReporteSalida").attr("linea",mesV);
	localStorage.setItem("mesV", mesV);

	cargarTablaProduccionVasco(localStorage.getItem("mesV"));
	
})

/* 
* VEMOS SI LOCAL STORAGE TRAE ALGO
*/
if (localStorage.getItem("mesV") != null) {

	cargarTablaProduccionVasco(localStorage.getItem("mesV"));
	//console.log("lleno");
	
}else{

	cargarTablaProduccionVasco(null);
	//console.log("vacio");

}


/* 
* TABLA PARA PRODUCCION Vasco
*/
function cargarTablaProduccionVasco(mesV) {
	$('.tablaProduccionVasco').DataTable( {
		"ajax": "ajax/tabla-produccionvasco.ajax.php?perfil="+$("#perfilOculto").val() + "&mesV=" + mesV,
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
$("#editarTalleres").change(function(){
	$("#editarCodigo").val($(this).val()+"1234");
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


$(".tablaArticulosTalleres tbody").on("click", "button.agregarArtiTaller", function () {

	var articuloIngreso = $(this).attr("articuloIngreso");
	
    var talleres = $(this).attr("taller");
    $(this).removeClass("btn-primary agregarArtiTaller");

    $(this).addClass("btn-default");

    var datos = new FormData();
    datos.append("articuloT", articuloIngreso);

    $.ajax({

        url: "ajax/articulos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            console.log("respuesta", respuesta); 

            var articulo = respuesta["articulo"];
            var packing = respuesta["packingB"];
            var taller = respuesta["taller"];

            /* 
            todo: AGREGAR LOS CAMPOS
            */

            $(".nuevoArticuloIngreso").append(

                '<div class="row" style="padding:5px 15px">' +

                    "<!-- Descripción del Articulo -->" +

                    '<div class="col-xs-6" style="padding-right:0px">' +

                        '<div class="input-group">' +
                        
                            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarTaller" articuloIngreso="' + articuloIngreso + '"><i class="fa fa-times"></i></button></span>' +

                            '<input type="text" class="form-control nuevaDescripcionProducto input-sm" articuloIngreso="' + articuloIngreso + '" name="agregarT" value="' + packing + '" codigoAC="' + articulo + '" readonly required>' +

                        "</div>" +

                    "</div>" +

                    "<!-- Cantidad de la Orden de Corte -->" +

                    '<div class="col-xs-6">' +

                        '<input type="number" class="form-control nuevaCantidadArticuloIngreso input-sm" name="nuevaCantidadArticuloIngreso" id="nuevaCantidadArticuloIngreso" min="1" value="0" taller="' + taller + '" articulo="'+ articulo +'" nuevoTaller="' + Number(Number(taller) - Number($("#nuevaCantidadArticuloIngreso").val())) + '" required>' +

                    "</div>" +

                "</div>"

            );

            // SUMAR TOTAL DE UNIDADES

			sumarTotalIngreso();

            // AGREGAR IMPUESTO

            

            // AGRUPAR PRODUCTOS EN FORMATO JSON

            listarArticulosIngreso();

            // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

                      
        }

    })


});

/* 
* CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
*/
$(".tablaArticulosTalleres").on("draw.dt", function () {

    if (localStorage.getItem("quitarTaller") != null) {
        var listaIdArticuloT = JSON.parse(localStorage.getItem("quitarTaller"));
		
        for (var i = 0; i < listaIdArticuloT.length; i++) {
			
            $("button.recuperarBoton[articuloIngreso='" + listaIdArticuloT[i]["articuloIngreso"] + "']").removeClass("btn-default");

            $("button.recuperarBoton[articuloIngreso='" + listaIdArticuloT[i]["articuloIngreso"] + "']").addClass("btn-primary agregarArtiTaller");
        }
    }
});

/* 
* QUITAR ARTICULO DE LA ORDEN DE CORTE Y RECUPERAR BOTÓN
*/
var idQuitarArticuloT= [];

localStorage.removeItem("quitarTaller");

$(".formularioIngreso").on("click", "button.quitarTaller", function () {

    /* console.log("boton"); */

    $(this).parent().parent().parent().parent().remove();
    var articuloIngreso = $(this).attr("articuloIngreso");
    /*=============================================
    ALMACENAR EN EL LOCALSTORAGE EL ID DEL MATERIA PRIMA A QUITAR
    =============================================*/

    if (localStorage.getItem("quitarTaller") == null) {

        idQuitarArticuloT = [];

    } else {

        idQuitarArticuloT.concat(localStorage.getItem("quitarTaller"))

    }

    idQuitarArticuloT.push({
        "articuloIngreso": articuloIngreso
    });

	localStorage.setItem("quitarTaller", JSON.stringify(idQuitarArticuloT));
	console.log(articuloIngreso);
    $("button.recuperarBoton[articuloIngreso='" + articuloIngreso + "']").removeClass('btn-default');

    $("button.recuperarBoton[articuloIngreso='" + articuloIngreso + "']").addClass('btn-primary agregarArtiTaller');


    if ($(".nuevoArticuloIngreso").children().length == 0) {

        $("#nuevoTotalTaller").val(0);
        $("#totalTaller").val(0);
        $("#nuevoTotalTaller").attr("total", 0);

    } else {

            // SUMAR TOTAL DE UNIDADES

            sumarTotalIngreso();

            // AGREGAR IMPUESTO

            

            // AGRUPAR PRODUCTOS EN FORMATO JSON

            listarArticulosIngreso()


    }

})

/* 
* MODIFICAR LA CANTIDAD
*/
$(".formularioIngreso").on("change", "input.nuevaCantidadArticuloIngreso", function() {

    var nuevoTaller = Number($(this).attr("taller")) + Number($(this).val());
    var articulo = $(this).attr("articulo");
    //console.log(articulo);

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

    $(this).attr("nuevoTaller", Number(nuevoTaller));


    // SUMAR TOTAL DE UNIDADES

    sumarTotalIngreso();
  
    // AGREGAR IMPUESTO
  

    // AGRUPAR PRODUCTOS EN FORMATO JSON
  
    listarArticulosIngreso();



  });

  
/* 
* SUMAR EL TOTAL DE LAS ORDENES DE CORTE
*/
  
function sumarTotalIngreso() {

    var cantidadOc = $(".nuevaCantidadArticuloIngreso");
  
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

    $("#nuevoTotalTaller").val(sumarTotal);
    $("#totalTaller").val(sumarTotal);
    $("#nuevoTotalTaller").attr("total", sumarTotal);

}

/* 
* FORMATO DE MILES AL TOTAL
*/
$("#nuevoTotalTaller").number(true, 0);

/* 
* LISTAR TODOS LOS ARTICULOS
*/
function listarArticulosIngreso() {

    var listaArticulos = [];
  
    var descripcion = $(".nuevaDescripcionProducto");
  
    var cantidad = $(".nuevaCantidadArticuloIngreso");
    
    for (var i = 0; i < descripcion.length; i++) {

      listaArticulos.push({

        id: $(descripcion[i]).attr("articuloIngreso"),
        articulo: $(descripcion[i]).attr("codigoAC"),
        cantidad: $(cantidad[i]).val(),
        taller: $(cantidad[i]).attr("nuevoTaller")

      });
    }
  
    // console.log("listaArticulos", JSON.stringify(listaArticulos)); 
  
    $("#listaArticulosIngreso").val(JSON.stringify(listaArticulos));

}

/* 
* BOTON EDITAR ORDEN DE CORTE
*/
$(".tablaIngresoM").on("click", ".btnEditarIngStock", function () {

	var idIngreso = $(this).attr("idIngreso");

  window.location = "index.php?ruta=editar-ingreso&idIngreso=" + idIngreso;
  
})

/* 
*FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL ARTICULO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
*/
function quitarAgregarArticuloT() {

	//Capturamos todos los id de productos que fueron elegidos en la venta
    var articuloIngreso = $(".quitarTaller");
    //console.log("articuloOC", articuloOC);

	//Capturamos todos los botones de agregar que aparecen en la tabla
    var botonesTablaIngreso = $(".tablaArticulosTalleres tbody button.agregarArtiTaller");
    //console.log("botonesTablaOC", botonesTablaOC);

	//Recorremos en un ciclo para obtener los diferentes articuloOC que fueron agregados a la venta
	for (var i = 0; i < articuloIngreso.length; i++) {

		//Capturamos los Id de los productos agregados a la venta
		var boton = $(articuloIngreso[i]).attr("articuloIngreso");

		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for (var j = 0; j < botonesTablaIngreso.length; j++) {

			if ($(botonesTablaIngreso[j]).attr("articuloIngreso") == boton) {

				$(botonesTablaIngreso[j]).removeClass("btn-primary agregarArtiTaller");
				$(botonesTablaIngreso[j]).addClass("btn-default");

			}
		}

	}

}

/* 
* CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
*/
$(".tablaArticulosTalleres").on("draw.dt", function() {
    quitarAgregarArticuloT();
});
  

// Validamos que venga la variable capturaRango en el localStorage
if (localStorage.getItem("capturaRango9") != null) {
	$("#daterange-btnIngresoM span").html(localStorage.getItem("capturaRango9"));
	cargarTablaIngresosM(localStorage.getItem("fechaInicial"), localStorage.getItem("fechaFinal"));
} else {
	$("#daterange-btnIngresoM span").html('<i class="fa fa-calendar"></i> Rango de Fecha ');
	cargarTablaIngresosM(null, null);
}

/*
* CARGAR TABLA TALLERES EN TERMINADO
*/
function cargarTablaIngresosM(fechaInicial, fechaFinal){
$('.tablaIngresoM').DataTable({
	"ajax": "ajax/tabla-ingresos.ajax.php?perfil=" + $("#perfilOculto").val()+"&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal,
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

$("#daterange-btnIngresoM").daterangepicker(
    {
	  cancelClass: "CancelarIngresoStock",
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
      $("#daterange-btnIngresoM span").html(
        start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
      );
  
      var fechaInicial = start.format("YYYY-MM-DD");
  
      var fechaFinal = end.format("YYYY-MM-DD");
  
      var capturarRango9 = $("#daterange-btnIngresoM span").html();
  
      localStorage.setItem("capturarRango9", capturarRango9);
      localStorage.setItem("fechaInicial", fechaInicial);
      localStorage.setItem("fechaFinal", fechaFinal);
      // Recargamos la tabla con la información para ser mostrada en la tabla
      $(".tablaIngresoM").DataTable().destroy();
      cargarTablaIngresosM(fechaInicial, fechaFinal);
    });
  
  /*=============================================
  CANCELAR RANGO DE FECHAS
  =============================================*/
  
  $(".daterangepicker.opensleft .range_inputs .CancelarIngresoStock").on(
    "click",
    function() {
      localStorage.removeItem("capturarRango9");
      localStorage.removeItem("fechaInicial");
    	localStorage.removeItem("fechaFinal");
      localStorage.clear();
      window.location = "ingresos";
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
  
      localStorage.setItem("capturarRango9", "Hoy");
      localStorage.setItem("fechaInicial", fechaInicial);
      localStorage.setItem("fechaFinal", fechaFinal);
      // Recargamos la tabla con la información para ser mostrada en la tabla
      $(".tablaIngresoM").DataTable().destroy();
      cargarTablaIngresosM(fechaInicial, fechaFinal);
    }
  });

/*=============================================
ELIMINAR INGRESOS
=============================================*/
$(".tablaIngresoM").on("click", ".btnEliminarIngStock", function () {

	var idIngreso = $(this).attr("idIngreso");
	var documento=$(this).attr("documento")

    swal({
        title: '¿Está seguro de borrar el ingreso de stock?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar ingreso de stock!'
    }).then(function (result) {

        if (result.value) {

            window.location = "index.php?ruta=ingresos&idIngreso=" + idIngreso + "&documento="+documento;

        }

    })

})

/* 
* BOTON REPORTE DE ORDEN DE CORTE
*/
$(".tablaIngresoM").on("click", ".btnReporteIngresoStock", function () {

    var documento = $(this).attr("documento");
    //console.log("codigo", codigo);

    window.location = "vistas/reportes_excel/rpt_ingreso_detalle.php?documento=" + documento;
  
})

//Reporte de Salidas
$(".box").on("click", ".btnReporteIngresoM", function () {
    window.location = "vistas/reportes_excel/rpt_ingreso_stock.php";
  
})

//Reporte de Salidas
$(".box").on("click", ".btnReporteTallerTerminado", function () {
	fechaI=localStorage.getItem("fechaInicial");
	fechaF=localStorage.getItem("fechaFinal");
    window.location = "vistas/reportes_excel/rpt_taller_terminado.php?fechaInicial="+fechaI+"&fechaFinal="+fechaF;
  
})

/*=============================================
EDITAR TALLER T
=============================================*/
$(".tablaTalleresT").on("click", ".btnEditarTallerTerminado", function () {

	var idTallerT = $(this).attr("idTallerT");
    var datos = new FormData();
    datos.append("idTallerT", idTallerT);

    $.ajax({
        url: "ajax/talleres.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
			$("#editarModelo").val(respuesta["modelo"]);
			$("#editarColor").val(respuesta["color"]);
			$("#editarTalla").val(respuesta["talla"]);
			$("#editarCodOperacion").val(respuesta["cod_operacion"]);
			$("#editarOperacion").val(respuesta["nom_operacion"]);
			$("#editar_cod_tra").val(respuesta["cod_trabajador"]);
			$("#editar_cod_tra").selectpicker('refresh');
			$("#editar_codigoBarra").val(respuesta["codigo"]);

        }

    })

})

/*=============================================
EDITAR TALLER T
=============================================*/
$(".tablaTalleresT").on("click", ".btnDividirTallerTerminado", function () {

	var idTaller = $(this).attr("idTaller");
    var datos = new FormData();
    datos.append("idTaller", idTaller);

    $.ajax({
        url: "ajax/talleres.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
			$("#editarCodigo").val(respuesta["id_cabecera"]);
			 $("#editarArticulo").val(respuesta["articulo"]);
			 $("#editarNombre").val(respuesta["nombre"]);
			 $("#editarModelos").val(respuesta["modelo"]);
			$("#editarColores").val(respuesta["color"]);
			$("#editarTallas").val(respuesta["talla"]);
			$("#cantidades").val(respuesta["cantidad"]);
			$("#editarCodOperaciones").val(respuesta["cod_operacion"]);
			$("#editarOperacion").val(respuesta["nom_operacion"]);
			$("#editarBarra").val(respuesta["codigo"]);
			$("#editarTaller").val(respuesta["id"]);
			$("#trabajador").val(respuesta["trabajador"]);
			$("#fecha_proceso").val(respuesta["fecha_proceso"]);
			$("#fecha_terminado").val(respuesta["fecha_terminado"]);
			

        }

    })

})

/* 
* BOTON EDITAR SEGUNDA
*/
$(".tablaIngresoM").on("click", ".btnEditarSegunda", function () {

	var idIngreso = $(this).attr("idIngreso");

  window.location = "index.php?ruta=editar-segunda&idIngreso=" + idIngreso;
  
})
