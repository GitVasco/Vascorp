/* 
* TABLA MAESTRA CABECERAS - PRODUCCION
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

/* 
* ACTIVAR MAESTRA
*/  
if (localStorage.getItem("docPro") != null) {

	cargarTablaProduccionDetalle(localStorage.getItem("docPro"),localStorage.getItem("tipPro"));
	// console.log("lleno");
	
}else{

	cargarTablaProduccionDetalle(null, null);
	// console.log("vacio");

}

$(".TablaProdCabecera tbody").on("click", "button.ActivarDetalle", function () {

	$(".TablaProdDetalle").DataTable().destroy();

	var docPro = $(this).attr("documento");
    var tipPro = $(this).attr("tipo");
	//console.log("codigo", docPro);

	localStorage.setItem("docPro", docPro);
    localStorage.setItem("tipPro", tipPro);
	cargarTablaProduccionDetalle(localStorage.getItem("docPro"),localStorage.getItem("tipPro"));
	
})

function cargarTablaProduccionDetalle(docPro, tipPro){

    $('.TablaProdDetalle').DataTable({
        "ajax": "ajax/materiaprima/tabla-proddetalle.ajax.php?perfil="+$("#perfilOculto").val()+ "&docPro=" + docPro + "&tipPro=" + tipPro,
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

$(".TablaProdCabecera tbody").on("click", "button.btnEditarProd", function() {

    var docPro = $(this).attr("documento");
    var tipPro = $(this).attr("tipo");
	console.log("docPro", docPro, "tipPro", tipPro);

	localStorage.setItem("docPro", docPro);
    localStorage.setItem("tipPro", tipPro);
	cargarTablaProduccionDetalle(localStorage.getItem("docPro"),localStorage.getItem("tipPro"));
  
    window.location = "index.php?ruta=editar-cuadros-prod&docPro=" + docPro+ "&tipPro="+ tipPro;
  });

$(".TablaProdDetalle tbody").on("click", "button.btnEditarMP", function() {

    var documento = $(this).attr("documento");
    var tipo = $(this).attr("tipo");
    var codpro = $(this).attr("codpro");
    var despro = $(this).attr("despro");
    var canpro = $(this).attr("canpro");
    
    $("#editarTipo").val(tipo);
    $("#editarDocumento").val(documento);
    $("#editarCodigo").val(codpro);
    $("#editarDescripcion").val(despro);
    $("#editarCantidadMP").val(canpro);
    $("#editarCantidadAntigua").val(canpro);
    
})

$(".TablaProdDetalle tbody").on("click", "button.btnEliminarMP", function() {

    var documento = $(this).attr("documento");
    var tipo = $(this).attr("tipo");
    var codpro = $(this).attr("codpro");

    

})

