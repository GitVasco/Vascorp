$('.tablaEquipos').DataTable({
    "ajax": "ajax/mantenimiento/tabla-equipos.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "order": [[3, "asc"]],
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

$('.tablaCalendario').DataTable({
    "ajax": "ajax/mantenimiento/tabla-calendario.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "order": [[3, "asc"]],
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

$('.TablaMantenimientoCabecera').DataTable({
    "ajax": "ajax/mantenimiento/tabla-mante-cabecera.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "order": [[0, "desc"]],
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

//*ACTIVAR DETALLE
if (localStorage.getItem("manteCab") != null) {

	cargarTablaMantenimientoDetalle(localStorage.getItem("manteCab"));
	// console.log("lleno");
	
}else{

	cargarTablaMantenimientoDetalle(null);
	// console.log("vacio");

}

$(".TablaMantenimientoCabecera tbody").on("click", "button.btnActivarDetalleMante", function () {

	$(".TablaMantenimientoDetalle").DataTable().destroy();

	var manteCab = $(this).attr("codigo");
	//console.log("codigo", manteCab);

	localStorage.setItem("manteCab", manteCab);
	cargarTablaMantenimientoDetalle(localStorage.getItem("manteCab"));
	
})

function cargarTablaMantenimientoDetalle(manteCab){
    $('.TablaMantenimientoDetalle').DataTable({
        "ajax": "ajax/mantenimiento/tabla-mante-detalle.ajax.php?manteCab=" + manteCab,
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

$("#cargarTablaRpt").click(function(){

    $('#divRpt').removeAttr('hidden');   

    var manteDet = document.getElementById("nuevoId").value; 
    console.log(manteDet);

    localStorage.setItem("manteDet", manteDet);

});

$("#ocultarTablaRpt").click(function(){

    $('#divRpt').attr('hidden','');    

});

$("#cargarTablaRptE").click(function(){

    $('#divRptE').removeAttr('hidden');  
    
    var manteDet = document.getElementById("editarId").value;
    console.log(manteDet);

    localStorage.setItem("manteDet", manteDet);

});

$("#ocultarTablaRptE").click(function(){

    $('#divRptE').attr('hidden','');    

});

$('.TablaMantenimientoRepuestos').DataTable({
    "ajax": "ajax/mantenimiento/tabla-mante-repuestos.ajax.php?codInterno=" + localStorage.getItem("manteDet"),
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "order": [[0, "desc"]],
    "pageLength": 10,
    "lengthMenu": [[10, 20, 30, -1], [10, 20, 30, 'Todos']],
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

//*crear cod tipo maquina
$("#nuevoTipMaq").change(function(){

	var tipoM = $(this).val();
    //console.log(tipoM);

	var datos = new FormData();
	datos.append("tipoM", tipoM);

	$.ajax({

		url:"ajax/mantenimiento.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

            $("#nuevoCodTipo").val(respuesta["nuevo"]);			
			
		}
	})   

});

//*editar maquina
$(".tablaEquipos").on("click", ".btnEditarEquipo", function(){

	var equipo = $(this).attr("idEquipo");
    //console.log(equipo);

	var datos = new FormData();
	datos.append("equipo", equipo);
	
	$.ajax({

		url:"ajax/mantenimiento.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
            //console.log(respuesta);

            $("#editarTipMaq").val(respuesta["nombre_tipo_maquina"]);
            $("#editarCodTipo").val(respuesta["cod_tipo"]);
            $("#editarIdEquipo").val(respuesta["id"]);
            $("#editarDescripcion").val(respuesta["descripcion"]);
            $("#editarUbicacion").val(respuesta["cod_ubicacion"]);
			$("#editarUbicacion").selectpicker("refresh");
            $("#editarMarcaMaq").val(respuesta["cod_marca_equi"]);
			$("#editarMarcaMaq").selectpicker("refresh");
            $("#editarModeloMaq").val(respuesta["modelo_equipo"]);
            $("#editarSerieMaq").val(respuesta["serie_equipo"]);

            $("#editarTipoMotor").val(respuesta["tipo_motor"]);
            $("#editarMarcaMotor").val(respuesta["cod_marca_motor"]);
            $("#editarMarcaMotor").selectpicker("refresh");
            $("#editarModeloMotor").val(respuesta["modelo_motor"]);
            $("#editarSerieMotor").val(respuesta["serie_motor"]);

            $("#editarMarcaCaja").val(respuesta["cod_marca_caja"]);
            $("#editarMarcaCaja").selectpicker("refresh");
            $("#editarModeloCaja").val(respuesta["modelo_caja"]);
            $("#editarSerieCaja").val(respuesta["serie_caja"]);

            $("#editarDocumento").val(respuesta["documento"]);
            $("#editarRuc").val(respuesta["ruc"]);
            $("#editarFecEmision").val(respuesta["fecha_emision"]);

            $("#editarEstado").val(respuesta["estado"]);
            $("#editarEstado").selectpicker("refresh");
            $("#editarObservacion").val(respuesta["observaciones"]);

            if(respuesta["fec_pro_mant"] == "0000-00-00" || respuesta["fec_pro_mant"] == null){

                $("#editarProgMantenimiento").val(respuesta["fec_pro_mant"]);
                document.getElementById("editarProgMantenimiento").readOnly  = true;

            }else{

                $("#editarProgMantenimiento").val(respuesta["fec_pro_mant"]);
                document.getElementById("editarProgMantenimiento").readOnly  = false;


            }

            $("#editarUltimoMantenimiento").val(respuesta["fec_ult_mant"]);
            document.getElementById("editarUltimoMantenimiento").readOnly = true;

		}

	})    

})


//*UBICACION DE MAQUINA
$("#nuevaMaquina").change(function(){

	var maq = $(this).val();
    //console.log(maq);

	var datos = new FormData();
	datos.append("maq", maq);

	$.ajax({

		url:"ajax/mantenimiento.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
            
            //console.log(respuesta);
            $("#nuevaNombreUbicacion").val(respuesta["ubicacion_maquina"]);
            $("#nuevaUbicacion").val(respuesta["cod_ubicacion"]);			
			
		}
	})   

});

//*MANTENIMIENTO PREVENTIVO
$("#nuevoTipo").change(function(){

    var tipo = $(this).val();
    //console.log(tipo);

    if(tipo == "Preventivo"){

        $("#nuevoFin").val("");	
        document.getElementById("nuevoFin").readOnly  = true;

        $("#nuevoResponsable").val("");	
        $("#nuevoResponsable").selectpicker("refresh");
        //document.getElementById("nuevoResponsable").disabled = true;

        document.getElementById("nuevoEstado").selectedIndex = 2;
        $("#nuevoEstado").val("NO HECHO");
        $("#nuevoEstado").selectpicker("refresh");	        
        //document.getElementById("nuevoEstado").disabled = true;    

        $("#nuevoOperario").val("");	
        $("#nuevoOperario").selectpicker("refresh");
        //document.getElementById("nuevoOperario").disabled = true;

        $("#nuevaObservacion").val("Mantenimiento Programado");

    }else if(tipo == "Correctivo"){

        document.getElementById("nuevoFin").readOnly  = false;

        //document.getElementById("nuevoFin").disabled = false;

        //document.getElementById("nuevoResponsable").disabled = false;

        document.getElementById("nuevoEstado").selectedIndex = 1;
        $("#nuevoEstado").val("HECHO");	        
        //document.getElementById("nuevoEstado").disabled = false;
        $("#nuevoEstado").selectpicker("refresh");

        //document.getElementById("nuevoOperario").disabled = false;  

        $("#nuevaObservacion").val("");

    }    

});


//*AGREGAR MANTENIMIENTO REPUESTOS
$(".TablaMantenimientoRepuestos tbody").on("click", "button.btnAddRpt", function(){

    $(this).removeClass("btn-primary btnAddRpt");

    $(this).addClass("btn-default");
  

	var codInterno = $(this).attr("codInterno");
    var codpro = $(this).attr("codpro");
    var cospro = $(this).attr("cospro");
	//console.log("codInterno", codInterno);

    var datos = new FormData();
	datos.append("codInterno", codInterno);
    datos.append("codpro", codpro);
    datos.append("cospro", cospro);

	$.ajax({

		url:"ajax/mantenimiento.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
	
            if(respuesta == "ok"){

                Command: toastr["success"]("Se registro el Repuesto");

                $(".TablaMantenimientoDetalle").DataTable().destroy();
                cargarTablaMantenimientoDetalle(localStorage.getItem("manteCab"));
                
              }else{
      
                Command: toastr["error"]("Error");
      
              }

		}

	})	    

})


//*EDITAR MANTENIMIENTO
$(".TablaMantenimientoCabecera").on("click", ".btnEditarMantenimiento", function(){

	var idMantenimiento = $(this).attr("idMantenimiento");
    //console.log(idMantenimiento);

    var datos = new FormData();
	datos.append("idMantenimiento", idMantenimiento);

    $.ajax({

		url:"ajax/mantenimiento.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
            
            //console.log(respuesta);

            $("#editarId").val(respuesta["cod_interno"]);
            $("#id").val(respuesta["id"]);
            $("#editarTipo").val(respuesta["tipo_mante"]);
            $("#editarInicio").val(respuesta["mante_inicio"]);
            $("#editarFin").val(respuesta["mante_fin"]);
            $("#editarMaquina").val(respuesta["descripcion"]);
            $("#editarNombreUbicacion").val(respuesta["ubicacion_maquina"]);

            $("#editarResponsable").val(respuesta["responsable"]);
			$("#editarResponsable").selectpicker("refresh");

            $("#editarEstado").val(respuesta["estado"]);
            $("#editarEstado").selectpicker("refresh");

            $("#editarOperario").val(respuesta["operario"]);
            $("#editarOperario").selectpicker("refresh");

            $("#editarObservacion").val(respuesta["observaciones"]);

		}

	})  

})