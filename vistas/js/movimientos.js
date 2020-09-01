/* 
* TABLA CON LAS VENTAS TOTALES POR MES
*/
$('.tablaMovimientos').DataTable( {
    "ajax": "ajax/tabla-movimientos.ajax.php",
    "deferRender": true,
	"retrieve": true,
    "processing": true,
    "order": [[0, "desc"]],
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

/* 
* ACTUALIZAR TOTALES DEL MES
*/
$(".tablaMovimientos").on("click", ".btnActualizarMes", function () {

	var año = $(this).attr("año");
    var mes = $(this).attr("mes");
    
    /* console.log(año, mes); */

    var datos = new FormData();
    datos.append("año", año);
    datos.append("mes", mes);
    
    $.ajax({

		url: "ajax/movimientos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function (respuesta) {

			/* console.log("respuesta",respuesta); */
			
			if (respuesta == "ok") {
				swal({
					type: "success",
					title: "¡Ok!",
					text: "¡La información fue Actualizada con éxito!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
				}).then((result) => {
					if (result.value) {
						window.location = "movimientos";
					}
				});
			}
		
		}
	})

})


/* 
! PRODUCCION
*/

/* 
* BOTON ACEPTAR
*/
$(".box").on("click", ".btnCargarModP", function () {

	$(".tablaMProd").DataTable().destroy();

	var modeloP = document.getElementById("modeloMov").value;
	//console.log(modeloP);

	localStorage.setItem("modeloP", modeloP);
	$(".btnReporteProduccion").attr("modelo",modeloP);
	cargarTablaMProd(localStorage.getItem("modeloP"));
	
})


/* 
* BOTON LIMPIAR
*/
$(".box").on("click", ".btnLimpiarModP", function () {

	localStorage.removeItem("modeloP");
	localStorage.clear();

	window.location = "m-produccion";
	
})

/* 
* VEMOS SI LOCAL STORAGE TRAE ALGO
*/
if (localStorage.getItem("modeloP") != null) {

	cargarTablaMProd(localStorage.getItem("modeloP"));
	//console.log("lleno");
	
}else{

	cargarTablaMProd(null);
	//console.log("vacio");

}

/* 
* TABLA MOVIMIENTOS
*/
function cargarTablaMProd(modeloP) {
	$(".tablaMProd").DataTable({
		"ajax": "ajax/tabla-mProd.ajax.php?perfil=" + $("#perfilOculto").val() + "&modeloP=" + modeloP,
		"deferRender": true,
		"retrieve": true,
		"processing": true,
		"order": [[0, "asc"]],
		"pageLength": 30,
		"lengthMenu": [[30, 60, 90, -1], [30, 60, 90, 'Todos']],
		"language": {
			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar _MENU_ registros",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "No hay datos disponibles en esta tabla",
			"sInfo": "Registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty": "Registros del 0 al 0 de un total de 0",
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
! VENTAS
*/

/* 
* BOTON ACEPTAR
*/
$(".box").on("click", ".btnCargarModV", function () {

	$(".tablaMVta").DataTable().destroy();

	var modeloV = document.getElementById("modeloMov").value;
	//console.log(modeloV);

	localStorage.setItem("modeloV", modeloV);
	
	cargarTablaMVta(localStorage.getItem("modeloV"));
	
})


/* 
* BOTON LIMPIAR
*/
$(".box").on("click", ".btnLimpiarModV", function () {

	localStorage.removeItem("modeloV");
	localStorage.clear();

	window.location = "m-ventas";
	
})

/* 
* VEMOS SI LOCAL STORAGE TRAE ALGO
*/
if (localStorage.getItem("modeloV") != null) {

	cargarTablaMVta(localStorage.getItem("modeloV"));
	//console.log("lleno");
	
}else{

	cargarTablaMVta(null);
	//console.log("vacio");

}

/* 
* TABLA MOVIMIENTOS
*/
function cargarTablaMVta(modeloV) {
	$(".tablaMVta").DataTable({
		"ajax": "ajax/tabla-mVta.ajax.php?perfil=" + $("#perfilOculto").val() + "&modeloV=" + modeloV,
		"deferRender": true,
		"retrieve": true,
		"processing": true,
		"order": [[0, "asc"]],
		"pageLength": 30,
		"lengthMenu": [[30, 60, 90, -1], [30, 60, 90, 'Todos']],
		"language": {
			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar _MENU_ registros",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "No hay datos disponibles en esta tabla",
			"sInfo": "Registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty": "Registros del 0 al 0 de un total de 0",
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
! INGRESOS MATERIA PRIMA
*/

/* 
* BOTON ACEPTAR
*/
$(".box").on("click", ".btnCargarMpIng", function () {

	$(".tablaMpIng").DataTable().destroy();

	var lineaMpIng = document.getElementById("lineaMPIng").value;
	//console.log(lineaMp);

	localStorage.setItem("lineaMpIng", lineaMpIng);

	cargarTablaMpIng(localStorage.getItem("lineaMpIng"));
	
})


/* 
* BOTON LIMPIAR
*/
$(".box").on("click", ".btnLimpiarMpIng", function () {

	localStorage.removeItem("lineaMpIng");
	localStorage.clear();

	window.location = "mp-ingresos";
	
})

/* 
* VEMOS SI LOCAL STORAGE TRAE ALGO
*/
if (localStorage.getItem("lineaMpIng") != null) {

	cargarTablaMpIng(localStorage.getItem("lineaMpIng"));
	//console.log("lleno");
	
}else{

	cargarTablaMpIng(null);
	//console.log("vacio");

}

/* 
* TABLA MOVIMIENTOS
*/
function cargarTablaMpIng(lineaMpIng) {
	$(".tablaMpIng").DataTable({
		"ajax": "ajax/tabla-mping.ajax.php?perfil=" + $("#perfilOculto").val() + "&lineaMpIng=" + lineaMpIng,
		"deferRender": true,
		"retrieve": true,
		"processing": true,
		"order": [[0, "asc"]],
		"pageLength": 30,
		"lengthMenu": [[30, 60, 90, -1], [30, 60, 90, 'Todos']],
		"language": {
			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar _MENU_ registros",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "No hay datos disponibles en esta tabla",
			"sInfo": "Registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty": "Registros del 0 al 0 de un total de 0",
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
! SALIDAS MATERIA PRIMA
*/

/* 
* BOTON ACEPTAR
*/
$(".box").on("click", ".btnCargarMpSal", function () {

	$(".tablaMpSal").DataTable().destroy();

	var lineaMpSal = document.getElementById("lineaMPSal").value;
	//console.log(lineaMp);

	localStorage.setItem("lineaMpSal", lineaMpSal);

	cargarTablaMpSal(localStorage.getItem("lineaMpSal"));
	
})


/* 
* BOTON LIMPIAR
*/
$(".box").on("click", ".btnLimpiarMpSal", function () {

	localStorage.removeItem("lineaMpSal");
	localStorage.clear();

	window.location = "mp-Salresos";
	
})

/* 
* VEMOS SI LOCAL STORAGE TRAE ALGO
*/
if (localStorage.getItem("lineaMpSal") != null) {

	cargarTablaMpSal(localStorage.getItem("lineaMpSal"));
	//console.log("lleno");
	
}else{

	cargarTablaMpSal(null);
	//console.log("vacio");

}

/* 
* TABLA MOVIMIENTOS
*/
function cargarTablaMpSal(lineaMpSal) {
	$(".tablaMpSal").DataTable({
		"ajax": "ajax/tabla-mpsal.ajax.php?perfil=" + $("#perfilOculto").val() + "&lineaMpSal=" + lineaMpSal,
		"deferRender": true,
		"retrieve": true,
		"processing": true,
		"order": [[0, "asc"]],
		"pageLength": 30,
		"lengthMenu": [[30, 60, 90, -1], [30, 60, 90, 'Todos']],
		"language": {
			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar _MENU_ registros",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "No hay datos disponibles en esta tabla",
			"sInfo": "Registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty": "Registros del 0 al 0 de un total de 0",
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
//Reporte de Produccion
$(".box").on("click", ".btnReporteProduccion", function () {
	var modelo = $(this).attr("modelo");
    window.location = "vistas/reportes_excel/rpt_movimiento_produccion.php?modelo="+modelo;
  
})

//Reporte de Ventas
$(".box").on("click", ".btnReporteVenta", function () {

    window.location = "vistas/reportes_excel/rpt_tarjeta_articulo.php";
  
})

//Reporte de Ingresos
$(".box").on("click", ".btnReporteIngreso", function () {

    window.location = "vistas/reportes_excel/rpt_tarjeta_articulo.php";
  
})

//Reporte de Salidas
$(".box").on("click", ".btnReporteSalida", function () {

    window.location = "vistas/reportes_excel/rpt_tarjeta_articulo.php";
  
})
