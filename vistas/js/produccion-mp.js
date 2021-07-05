/* 
* TABLA MAESTRA CABECERAS
*/
$('.TablaProdCabecera').DataTable({
    "ajax": "ajax/materiaprima/tabla-prodcabecera.ajax.php?perfil="+$("#perfilOculto").val(),
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "order": [[0, "asc"]],
    "pageLength": 20,
    "bLengthChange": false,	
    "language": {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Del _START_ al _END_ de _TOTAL_",
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
			"sNext":     ">>>",
			"sPrevious": "<<<"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
    }    
});