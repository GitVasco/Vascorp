/*
* CARGAR TABLA TALLERES EN GENERAL
*/
$('.tablaTalleresG').DataTable({
	"ajax": "ajax/tabla-talleresGeneral.ajax.php?perfil=" + $("#perfilOculto").val(),
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

    var articulo = $(this).attr("articulo");
	console.log("articulo", articulo);
	
	var modelo = $(this).attr("modelo");
	console.log("modelo", modelo);
	
	var nombre = $(this).attr("nombre");
	console.log("nombre", nombre);
	
	var color = $(this).attr("color");
	console.log("color", color);
	
	var talla = $(this).attr("talla");
	console.log("talla", talla);
	
	var cant_taller = $(this).attr("cant_taller");
	console.log("cant_taller", cant_taller);
	
	var nom_trab = $(this).attr("nom_trab");
	console.log("nom_trab", nom_trab);
	
	var nom_sector = $(this).attr("nom_sector");
	console.log("nom_sector", nom_sector);
	
	var cod_operacion = $(this).attr("cod_operacion");
	console.log("cod_operacion", cod_operacion);
	
	var nom_operacion = $(this).attr("nom_operacion");
	console.log("nom_operacion", nom_operacion);
	
	var articulo = $(this).attr("articulo");
	console.log("articulo", articulo);
	
	var ultimo = $(this).attr("ultimo");
	console.log("ultimo", ultimo);
	

	//window.open("vistas/reportes_ticket/exTicket.php?articulo=" + articulo,'_blank');

	window.open("vistas/reportes_ticket/produccion_ticket.php?articulo="+ articulo + "&ultimo=" +ultimo + "&modelo=" + modelo + "&nombre=" + nombre + "&color=" + color + "&talla=" + talla + "&cant_taller=" + cant_taller + "&nom_trab=" + nom_trab + "&nom_sector=" + nom_sector + "&cod_operacion=" + cod_operacion + "&nom_operacion=" + nom_operacion,"_blank");
	
    
  
})
