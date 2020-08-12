
$('.tablaAsistencias').DataTable( {
    "ajax": "ajax/tabla-asistencias.ajax.php?perfil="+$("#perfilOculto").val(),
    "deferRender": true,
	"retrieve": true,
	"processing": true,
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

/*=============================================
EDITAR Asistencia
=============================================*/
$(".tablaAsistencias").on("click", ".btnEditarAsistencia", function () {

    var idAsistencia = $(this).attr("idAsistencia");
    var datos = new FormData();
    datos.append("idAsistencia", idAsistencia);
    $.ajax({
        url: "ajax/asistencias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            $("#editarCodigo").val(respuesta["id_trabajador"]);
            $("#editarTrabajador").val(respuesta["nom_tra"]+" "+respuesta["ape_mat_tra"]+" "+respuesta["ape_pat_tra"]);
            $("#editarMinutos").val(respuesta["minutos"]);
            $("#editarPara").val(respuesta["para"]);
            $("#editarTiempoPara").val(respuesta["tiempo_para"]);
            $("#idAsistencia").val(respuesta["id"]);
            $("#editarMinutos").attr("original",respuesta["minutos"]);
            $("#editarMinutos").attr("original2",parseInt(respuesta["minutos"])+parseInt(respuesta["tiempo_para"]));

        }

    })
    
})

$("#editarTiempoPara").change(function(){
    if($("#editarMinutos").attr("original2")== "NaN"){
        var nuevoValor=$("#editarMinutos").attr("original")-$(this).val();
        $("#editarMinutos").val(nuevoValor);
    }else{
        var nuevoValor2=$("#editarMinutos").attr("original2")-$(this).val();
        $("#editarMinutos").val(nuevoValor2);
    }
    
    
})


// ACTIVANDO-DESACTIVANDO ARTICULO
$(".tablaAsistencias").on("click",".btnAprobarAsistencia",function(){
	// Capturamos el id del usuario y el estado
    var idAsistencia=$(this).attr("idAsistencia");
	var estadoAsistencia=$(this).attr("estadoAsistencia");
	var datos=new FormData();
	datos.append("activarId",idAsistencia);
    datos.append("activarEstado",estadoAsistencia);
    console.log(idAsistencia);
	$.ajax({
		url:"ajax/asistencias.ajax.php",
		type:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		success:function(respuesta){
				swal({
					type: "success",
					title: "¡Ok!",
					text: "¡La información fue actualizada con éxito!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				}).then((result)=>{
					if(result.value){
						window.location="asistencia";}
				});}
	});
	// Cambiamos el estado del botón físicamente
	if(estadoAsistencia="FALTA"){
		$(this).attr("estadoAsistencia","ASISTIO");}
	else{
		$(this).attr("estadoAsistencia","FALTA");}
});

/*=============================================
EDITAR EXTRAS
=============================================*/
$(".tablaAsistencias").on("click", ".btnEditarExtras", function () {

    var idAsistencia = $(this).attr("idAsistencia");
    var datos = new FormData();
	datos.append("idAsistencia", idAsistencia);
    $.ajax({
        url: "ajax/asistencias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
			console.log(respuesta);
            $("#editarCodigo2").val(respuesta["id_trabajador"]);
            $("#editarTrabajador2").val(respuesta["nom_tra"]+" "+respuesta["ape_mat_tra"]+" "+respuesta["ape_pat_tra"]);
            $("#editarMinutos2").val(respuesta["minutos"]);
            $("#editarExtras").val(respuesta["horas_extras"]);
            $("#idAsistencia2").val(respuesta["id"]);
            $("#editarMinutos2").attr("originales",respuesta["minutos"]);
            $("#editarMinutos2").attr("originales2",parseInt(respuesta["minutos"])-parseInt(respuesta["horas_extras"]));

        }

    })
    
})


$("#editarExtras").change(function(){
    if($("#editarMinutos2").attr("originales2")!=$("#editarMinutos2").attr("originales")){
        var nuevoValor=parseInt($("#editarMinutos2").attr("originales2"))+parseInt($(this).val());
        $("#editarMinutos2").val(nuevoValor);
    }else{
        var nuevoValor2=parseInt($("#editarMinutos2").attr("originales"))+parseInt($(this).val());
        $("#editarMinutos2").val(nuevoValor2);
	}
    
})