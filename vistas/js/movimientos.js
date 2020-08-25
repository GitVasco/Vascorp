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
