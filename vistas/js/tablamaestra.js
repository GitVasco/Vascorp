/* 
* TABLA MAESTRA CABECERAS
*/
$('.TablaMaestraCabecera').DataTable({
    "ajax": "ajax/maestros/tabla-maestracabecera.ajax.php?perfil="+$("#perfilOculto").val(),
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "order": [[1, "asc"]],
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
  });

/* 
* ACTIVAR SUB LINEA
*/  

if (localStorage.getItem("codigoSubLinea") != null) {

	cargarTablaMaestraDetalle(localStorage.getItem("codigoSubLinea"));
	// console.log("lleno");
	
}else{

	cargarTablaMaestraDetalle(null);
	// console.log("vacio");

}

$(".TablaMaestraCabecera tbody").on("click", "button.btnActivarSubLinea", function () {

	$(".TablaMaestraDetalle").DataTable().destroy();

	var codigoSubLinea = $(this).attr("codigo");
	//console.log("codigo", codigoSubLinea);

	localStorage.setItem("codigoSubLinea", codigoSubLinea);
	cargarTablaMaestraDetalle(localStorage.getItem("codigoSubLinea"));
	
})

/* 
* TABLA MAESTRA DETALLES
*/
function cargarTablaMaestraDetalle(codigoSubLinea){
  $('.TablaMaestraDetalle').DataTable({
    "ajax": "ajax/maestros/tabla-maestradetalle.ajax.php?perfil="+$("#perfilOculto").val()+ "&codigoSubLinea=" + codigoSubLinea,
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "order": [[1, "asc"]],
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
  });  

}