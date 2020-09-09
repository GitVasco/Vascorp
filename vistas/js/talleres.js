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
/*
* CARGAR TABLA TALLERES EN TERMINADO
*/
$('.tablaTalleresT').DataTable({
	"ajax": "ajax/tabla-talleresTerminado.ajax.php?perfil=" + $("#perfilOculto").val(),
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
			console.log(respuesta["color"]);
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