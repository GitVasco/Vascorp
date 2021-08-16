$(".TablaCentroCostos").DataTable({
    "ajax": "ajax/centrocostos/tabla-centrocostos.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "order": [[0, "asc"]],
	/* "scrollY":        "700px",
	"scrollCollapse": true,
	"paging":         false, */
    "pageLength": 110,
    "lengthMenu": [[110, 220, 330, -1], [110, 220, 330, 'Todos']],
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
    },
    "createdRow":function(row,data,index){
		if(data[0] == "0"){
		  $('td',row).css({
			'background-color':'#52BE80',
			'color':'black'
		  })
		}else if (data[0] == "1"){
		  $('td',row).css({
			'background-color':'#52BEB4',
			'color':'black'
		  })
		}else if(data[0] == "2"){
		  $('td',row).css({
			'background-color':'#FF6868',
			'color':'black'
		  })
		}else if(data[0] == "3"){
		  $('td',row).css({
			'background-color':'#7C9EFF',
			'color':'black'
		  })
		}else if(data[0] == "4"){
		  $('td',row).css({
			'background-color':'#CCF459',
			'color':'black'
		  })
		}else if(data[0] == "5"){
		  $('td',row).css({
			'background-color':'#AAE1FF',
			'color':'black'
		  })
		}else if(data[0] == "6"){
		  $('td',row).css({
			'background-color':'#DDDAD6',
			'color':'black'
		  })
		}else if(data[0] == "7"){
		  $('td',row).css({
			'background-color':'#FFCFE8',
			'color':'black'
		  })
		}else if(data[0] == "8"){
		  $('td',row).css({
			'background-color':'#F5FAA5',
			'color':'black'
		  })
		}else if(data[0] == "9"){
		  $('td',row).css({
			'background-color':'#DFB6F9',
			'color':'black'
		  })
		}

	  }
});

$("#tipoGasto").change(function(){

    var tipoGasto = $(this).val();
    //console.log(tipoGasto)

	var datos = new FormData();

	datos.append("tipoGasto", tipoGasto);
	
	$.ajax({

		url:"ajax/centro-costos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
			//console.log(respuesta);
			$("#Area").find('option').remove();
			$("#Area").append("<option value=''> Seleccionar Área </option>");
			for (let i = 0; i < respuesta.length; i++) {
				
				$("#Area").append("<option value='"+respuesta[i]["cod_argumento"]+"'>"+respuesta[i]["cod_argumento"]+" - "+respuesta[i]["des_larga"]+"</option>");
				
			}
			$("#Area").selectpicker("refresh");
 
		}
  
	})    

})

$("#Area").change(function(){

    var area = $(this).val();
    var tipoGasto = $("#tipoGasto").val();
    //console.log(area,tipoGasto);

	var datos = new FormData();

	datos.append("area", area);
    datos.append("tipoGastoB", tipoGasto);
    
	$.ajax({

		url:"ajax/centro-costos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

			//console.log('HOLA MUNDO',respuesta);
			$("#nuevoCod").val(respuesta["correlativo"]);
 
		}
  
	})     

})


$(".TablaCentroCostosResumen").DataTable({
    "ajax": "ajax/centrocostos/tabla-centrocostosresumen.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "order": [[0, "asc"]],
    "pageLength": 110,
    "lengthMenu": [[110, 220, 330, -1], [110, 220, 330, 'Todos']],
	"fixedHeader": {
		"header": true,
		"footer": true
	},
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
    },
    "createdRow":function(row,data,index){
		if(data[0] == "K0"){
		  $('td',row).css({
			'background-color':'#52BE80',
			'color':'black'
		  })
		}else if (data[0] == "K1"){
		  $('td',row).css({
			'background-color':'#52BEB4',
			'color':'black'
		  })
		}else if(data[0] == "K2"){
		  $('td',row).css({
			'background-color':'#FF6868',
			'color':'black'
		  })
		}else if(data[0] == "K3"){
		  $('td',row).css({
			'background-color':'#7C9EFF',
			'color':'black'
		  })
		}else if(data[0] == "K4"){
		  $('td',row).css({
			'background-color':'#CCF459',
			'color':'black'
		  })
		}else if(data[0] == "K5"){
		  $('td',row).css({
			'background-color':'#AAE1FF',
			'color':'black'
		  })
		}else if(data[0] == "K6"){
		  $('td',row).css({
			'background-color':'#DDDAD6',
			'color':'black'
		  })
		}else if(data[0] == "K7"){
		  $('td',row).css({
			'background-color':'#FFCFE8',
			'color':'black'
		  })
		}else if(data[0] == "K8"){
		  $('td',row).css({
			'background-color':'#F5FAA5',
			'color':'black'
		  })
		}else if(data[0] == "K9"){
		  $('td',row).css({
			'background-color':'#DFB6F9',
			'color':'black'
		  })
		}

	},
	"drawCallback":function(){
		var api=this.api();
		$(api.column(5).footer()).html(
			new Intl.NumberFormat("en-Us").format((api.column(5,{page:'current'}).data().sum().toFixed(2))*-1)
		)
		$(api.column(6).footer()).html(
			new Intl.NumberFormat("en-Us").format((api.column(6,{page:'current'}).data().sum().toFixed(2))*-1)
		)
		$(api.column(7).footer()).html(
			new Intl.NumberFormat("en-Us").format((api.column(7,{page:'current'}).data().sum().toFixed(2))*-1)
		)
		$(api.column(8).footer()).html(
			new Intl.NumberFormat("en-Us").format((api.column(8,{page:'current'}).data().sum().toFixed(2))*-1)
		)
		$(api.column(9).footer()).html(
			new Intl.NumberFormat("en-Us").format((api.column(9,{page:'current'}).data().sum().toFixed(2))*-1)
		)
		$(api.column(10).footer()).html(
			new Intl.NumberFormat("en-Us").format((api.column(10,{page:'current'}).data().sum().toFixed(2))*-1)
		)
		$(api.column(11).footer()).html(
			new Intl.NumberFormat("en-Us").format((api.column(11,{page:'current'}).data().sum().toFixed(2))*-1)
		)
		$(api.column(12).footer()).html(
			new Intl.NumberFormat("en-Us").format((api.column(12,{page:'current'}).data().sum().toFixed(2))*-1)
		)
		$(api.column(13).footer()).html(
			new Intl.NumberFormat("en-Us").format((api.column(13,{page:'current'}).data().sum().toFixed(2))*-1)
		)
		$(api.column(14).footer()).html(
			new Intl.NumberFormat("en-Us").format((api.column(14,{page:'current'}).data().sum().toFixed(2))*-1)
		)
		$(api.column(15).footer()).html(
			new Intl.NumberFormat("en-Us").format((api.column(15,{page:'current'}).data().sum().toFixed(2))*-1)
		)
		$(api.column(16).footer()).html(
			new Intl.NumberFormat("en-Us").format((api.column(16,{page:'current'}).data().sum().toFixed(2))*-1)
		)
		$(api.column(17).footer()).html(
			new Intl.NumberFormat("en-Us").format((api.column(17,{page:'current'}).data().sum().toFixed(2))*-1)
		)
	}
});


if (localStorage.getItem("mesD") != null) {
	cargarTablaDiario(localStorage.getItem("mesD"));

	if(localStorage.getItem("mesD") == "1"){

		$(".btnEneD").removeClass("btn-default");
		$(".btnEneD").addClass("btn-info");

	}else if(localStorage.getItem("mesD") == "2"){

		$(".btnFebD").removeClass("btn-default");
		$(".btnFebD").addClass("btn-info");

	}else if(localStorage.getItem("mesD") == "3"){

		$(".btnMarD").removeClass("btn-default");
		$(".btnMarD").addClass("btn-info");

	}else if(localStorage.getItem("mesD") == "4"){

		$(".btnAbrD").removeClass("btn-default");
		$(".btnAbrD").addClass("btn-info");

	}else if(localStorage.getItem("mesD") == "5"){

		$(".btnMayD").removeClass("btn-default");
		$(".btnMayD").addClass("btn-info");

	}else if(localStorage.getItem("mesD") == "6"){

		$(".btnJunD").removeClass("btn-default");
		$(".btnJunD").addClass("btn-info");

	}else if(localStorage.getItem("mesD") == "7"){

		$(".btnJulD").removeClass("btn-default");
		$(".btnJulD").addClass("btn-info");

	}else if(localStorage.getItem("mesD") == "8"){

		$(".btnAgoD").removeClass("btn-default");
		$(".btnAgoD").addClass("btn-info");

	}else if(localStorage.getItem("mesD") == "9"){

		$(".btnSepD").removeClass("btn-default");
		$(".btnSepD").addClass("btn-info");

	}else if(localStorage.getItem("mesD") == "10"){

		$(".btnOctD").removeClass("btn-default");
		$(".btnOctD").addClass("btn-info");

	}else if(localStorage.getItem("mesD") == "11"){

		$(".btnNovD").removeClass("btn-default");
		$(".btnNovD").addClass("btn-info");

	}else if(localStorage.getItem("mesD") == "12"){

		$(".btnDicD").removeClass("btn-default");
		$(".btnDicD").addClass("btn-info");

	}

}else{

	const fecha = new Date();
	const mesD = fecha.getMonth() + 1; 

	if(mesD == "1"){

		$(".btnEneD").removeClass("btn-default");
		$(".btnEneD").addClass("btn-info");

	}else if(mesD == "2"){

		$(".btnFebD").removeClass("btn-default");
		$(".btnFebD").addClass("btn-info");

	}else if(mesD == "3"){

		$(".btnMarD").removeClass("btn-default");
		$(".btnMarD").addClass("btn-info");

	}else if(mesD == "4"){

		$(".btnAbrD").removeClass("btn-default");
		$(".btnAbrD").addClass("btn-info");
	}else if(mesD == "5"){

		$(".btnMayD").removeClass("btn-default");
		$(".btnMayD").addClass("btn-info");

	}else if(mesD == "6"){

		$(".btnJunD").removeClass("btn-default");
		$(".btnJunD").addClass("btn-info");

	}else if(mesD == "7"){

		$(".btnJulD").removeClass("btn-default");
		$(".btnJulD").addClass("btn-info");

	}else if(mesD == "8"){

		$(".btnAgoD").removeClass("btn-default");
		$(".btnAgoD").addClass("btn-info");

	}else if(mesD == "9"){

		$(".btnSepD").removeClass("btn-default");
		$(".btnSepD").addClass("btn-info");

	}else if(mesD == "10"){

		$(".btnOctD").removeClass("btn-default");
		$(".btnOctD").addClass("btn-info");

	}else if(mesD == "11"){

		$(".btnNovD").removeClass("btn-default");
		$(".btnNovD").addClass("btn-info");

	}else if(mesD == "12"){

		$(".btnDicD").removeClass("btn-default");
		$(".btnDicD").addClass("btn-info");

	}

	cargarTablaDiario(mesD);
}    

$(".btnEneD").click(function(){
	var mesD = document.getElementById("btnEneD").value;
	//console.log(mesD);

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnFebD").removeClass("btn-info");
	$(".btnFebD").addClass("btn-default");

	$(".btnMarD").removeClass("btn-info");
	$(".btnMarD").addClass("btn-default");

	$(".btnAbrD").removeClass("btn-info");
	$(".btnAbrD").addClass("btn-default");

	$(".btnMayD").removeClass("btn-info");
	$(".btnMayD").addClass("btn-default");

	$(".btnJunD").removeClass("btn-info");
	$(".btnJunD").addClass("btn-default");

	$(".btnJulD").removeClass("btn-info");
	$(".btnJulD").addClass("btn-default");

	$(".btnAgoD").removeClass("btn-info");
	$(".btnAgoD").addClass("btn-default");

	$(".btnSepD").removeClass("btn-info");
	$(".btnSepD").addClass("btn-default");

	$(".btnOctD").removeClass("btn-info");
	$(".btnOctD").addClass("btn-default");

	$(".btnNovD").removeClass("btn-info");
	$(".btnNovD").addClass("btn-default");

	$(".btnDicD").removeClass("btn-info");
	$(".btnDicD").addClass("btn-default");

	localStorage.setItem("mesD", mesD);
	$(".TablaDiario").DataTable().destroy();
	cargarTablaDiario(localStorage.getItem("mesD"));
})
$(".btnFebD").click(function(){
	var mesD = document.getElementById("btnFebD").value;
	//console.log(mesD);

	$(".btnEneD").removeClass("btn-info");
	$(".btnEneD").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnMarD").removeClass("btn-info");
	$(".btnMarD").addClass("btn-default");

	$(".btnAbrD").removeClass("btn-info");
	$(".btnAbrD").addClass("btn-default");

	$(".btnMayD").removeClass("btn-info");
	$(".btnMayD").addClass("btn-default");

	$(".btnJunD").removeClass("btn-info");
	$(".btnJunD").addClass("btn-default");

	$(".btnJulD").removeClass("btn-info");
	$(".btnJulD").addClass("btn-default");

	$(".btnAgoD").removeClass("btn-info");
	$(".btnAgoD").addClass("btn-default");

	$(".btnSepD").removeClass("btn-info");
	$(".btnSepD").addClass("btn-default");

	$(".btnOctD").removeClass("btn-info");
	$(".btnOctD").addClass("btn-default");

	$(".btnNovD").removeClass("btn-info");
	$(".btnNovD").addClass("btn-default");

	$(".btnDicD").removeClass("btn-info");
	$(".btnDicD").addClass("btn-default");

	localStorage.setItem("mesD", mesD);
	$(".TablaDiario").DataTable().destroy();
	cargarTablaDiario(localStorage.getItem("mesD"));
})
$(".btnMarD").click(function(){
	var mesD = document.getElementById("btnMarD").value;
	//console.log(mesD);

	$(".btnEneD").removeClass("btn-info");
	$(".btnEneD").addClass("btn-default");

	$(".btnFebD").removeClass("btn-info");
	$(".btnFebD").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnAbrD").removeClass("btn-info");
	$(".btnAbrD").addClass("btn-default");

	$(".btnMayD").removeClass("btn-info");
	$(".btnMayD").addClass("btn-default");

	$(".btnJunD").removeClass("btn-info");
	$(".btnJunD").addClass("btn-default");

	$(".btnJulD").removeClass("btn-info");
	$(".btnJulD").addClass("btn-default");

	$(".btnAgoD").removeClass("btn-info");
	$(".btnAgoD").addClass("btn-default");

	$(".btnSepD").removeClass("btn-info");
	$(".btnSepD").addClass("btn-default");

	$(".btnOctD").removeClass("btn-info");
	$(".btnOctD").addClass("btn-default");

	$(".btnNovD").removeClass("btn-info");
	$(".btnNovD").addClass("btn-default");

	$(".btnDicD").removeClass("btn-info");
	$(".btnDicD").addClass("btn-default");

	localStorage.setItem("mesD", mesD);
	$(".TablaDiario").DataTable().destroy();
	cargarTablaDiario(localStorage.getItem("mesD"));
})
$(".btnAbrD").click(function(){
	var mesD = document.getElementById("btnAbrD").value;
	//console.log(mesD);

	$(".btnEneD").removeClass("btn-info");
	$(".btnEneD").addClass("btn-default");

	$(".btnFebD").removeClass("btn-info");
	$(".btnFebD").addClass("btn-default");

	$(".btnMarD").removeClass("btn-info");
	$(".btnMarD").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnMayD").removeClass("btn-info");
	$(".btnMayD").addClass("btn-default");

	$(".btnJunD").removeClass("btn-info");
	$(".btnJunD").addClass("btn-default");

	$(".btnJulD").removeClass("btn-info");
	$(".btnJulD").addClass("btn-default");

	$(".btnAgoD").removeClass("btn-info");
	$(".btnAgoD").addClass("btn-default");

	$(".btnSepD").removeClass("btn-info");
	$(".btnSepD").addClass("btn-default");

	$(".btnOctD").removeClass("btn-info");
	$(".btnOctD").addClass("btn-default");

	$(".btnNovD").removeClass("btn-info");
	$(".btnNovD").addClass("btn-default");

	$(".btnDicD").removeClass("btn-info");
	$(".btnDicD").addClass("btn-default");

	localStorage.setItem("mesD", mesD);
	$(".TablaDiario").DataTable().destroy();
	cargarTablaDiario(localStorage.getItem("mesD"));
})
$(".btnMayD").click(function(){
	var mesD = document.getElementById("btnMayD").value;
	//console.log(mesD);

	$(".btnEneD").removeClass("btn-info");
	$(".btnEneD").addClass("btn-default");

	$(".btnFebD").removeClass("btn-info");
	$(".btnFebD").addClass("btn-default");

	$(".btnMarD").removeClass("btn-info");
	$(".btnMarD").addClass("btn-default");

	$(".btnAbrD").removeClass("btn-info");
	$(".btnAbrD").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnJunD").removeClass("btn-info");
	$(".btnJunD").addClass("btn-default");

	$(".btnJulD").removeClass("btn-info");
	$(".btnJulD").addClass("btn-default");

	$(".btnAgoD").removeClass("btn-info");
	$(".btnAgoD").addClass("btn-default");

	$(".btnSepD").removeClass("btn-info");
	$(".btnSepD").addClass("btn-default");

	$(".btnOctD").removeClass("btn-info");
	$(".btnOctD").addClass("btn-default");

	$(".btnNovD").removeClass("btn-info");
	$(".btnNovD").addClass("btn-default");

	$(".btnDicD").removeClass("btn-info");
	$(".btnDicD").addClass("btn-default");

	localStorage.setItem("mesD", mesD);
	$(".TablaDiario").DataTable().destroy();
	cargarTablaDiario(localStorage.getItem("mesD"));
})
$(".btnJunD").click(function(){
	var mesD = document.getElementById("btnJunD").value;
	//console.log(mesD);

	$(".btnEneD").removeClass("btn-info");
	$(".btnEneD").addClass("btn-default");

	$(".btnFebD").removeClass("btn-info");
	$(".btnFebD").addClass("btn-default");

	$(".btnMarD").removeClass("btn-info");
	$(".btnMarD").addClass("btn-default");

	$(".btnAbrD").removeClass("btn-info");
	$(".btnAbrD").addClass("btn-default");

	$(".btnMayD").removeClass("btn-info");
	$(".btnMayD").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnJulD").removeClass("btn-info");
	$(".btnJulD").addClass("btn-default");

	$(".btnAgoD").removeClass("btn-info");
	$(".btnAgoD").addClass("btn-default");

	$(".btnSepD").removeClass("btn-info");
	$(".btnSepD").addClass("btn-default");

	$(".btnOctD").removeClass("btn-info");
	$(".btnOctD").addClass("btn-default");

	$(".btnNovD").removeClass("btn-info");
	$(".btnNovD").addClass("btn-default");

	$(".btnDicD").removeClass("btn-info");
	$(".btnDicD").addClass("btn-default");

	localStorage.setItem("mesD", mesD);
	$(".TablaDiario").DataTable().destroy();
	cargarTablaDiario(localStorage.getItem("mesD"));
})
$(".btnJulD").click(function(){
	var mesD = document.getElementById("btnJulD").value;
	//console.log(mesD);

	$(".btnEneD").removeClass("btn-info");
	$(".btnEneD").addClass("btn-default");

	$(".btnFebD").removeClass("btn-info");
	$(".btnFebD").addClass("btn-default");

	$(".btnMarD").removeClass("btn-info");
	$(".btnMarD").addClass("btn-default");

	$(".btnAbrD").removeClass("btn-info");
	$(".btnAbrD").addClass("btn-default");

	$(".btnMayD").removeClass("btn-info");
	$(".btnMayD").addClass("btn-default");

	$(".btnJunD").removeClass("btn-info");
	$(".btnJunD").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnAgoD").removeClass("btn-info");
	$(".btnAgoD").addClass("btn-default");

	$(".btnSepD").removeClass("btn-info");
	$(".btnSepD").addClass("btn-default");

	$(".btnOctD").removeClass("btn-info");
	$(".btnOctD").addClass("btn-default");

	$(".btnNovD").removeClass("btn-info");
	$(".btnNovD").addClass("btn-default");

	$(".btnDicD").removeClass("btn-info");
	$(".btnDicD").addClass("btn-default");

	localStorage.setItem("mesD", mesD);
	$(".TablaDiario").DataTable().destroy();
	cargarTablaDiario(localStorage.getItem("mesD"));
})
$(".btnAgoD").click(function(){
	var mesD = document.getElementById("btnAgoD").value;
	//console.log(mesD);

	$(".btnEneD").removeClass("btn-info");
	$(".btnEneD").addClass("btn-default");

	$(".btnFebD").removeClass("btn-info");
	$(".btnFebD").addClass("btn-default");

	$(".btnMarD").removeClass("btn-info");
	$(".btnMarD").addClass("btn-default");

	$(".btnAbrD").removeClass("btn-info");
	$(".btnAbrD").addClass("btn-default");

	$(".btnMayD").removeClass("btn-info");
	$(".btnMayD").addClass("btn-default");

	$(".btnJunD").removeClass("btn-info");
	$(".btnJunD").addClass("btn-default");

	$(".btnJulD").removeClass("btn-info");
	$(".btnJulD").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnSepD").removeClass("btn-info");
	$(".btnSepD").addClass("btn-default");

	$(".btnOctD").removeClass("btn-info");
	$(".btnOctD").addClass("btn-default");

	$(".btnNovD").removeClass("btn-info");
	$(".btnNovD").addClass("btn-default");

	$(".btnDicD").removeClass("btn-info");
	$(".btnDicD").addClass("btn-default");

	localStorage.setItem("mesD", mesD);
	$(".TablaDiario").DataTable().destroy();
	cargarTablaDiario(localStorage.getItem("mesD"));
})
$(".btnSepD").click(function(){
	var mesD = document.getElementById("btnSepD").value;
	//console.log(mesD);

	$(".btnEneD").removeClass("btn-info");
	$(".btnEneD").addClass("btn-default");

	$(".btnFebD").removeClass("btn-info");
	$(".btnFebD").addClass("btn-default");

	$(".btnMarD").removeClass("btn-info");
	$(".btnMarD").addClass("btn-default");

	$(".btnAbrD").removeClass("btn-info");
	$(".btnAbrD").addClass("btn-default");

	$(".btnMayD").removeClass("btn-info");
	$(".btnMayD").addClass("btn-default");

	$(".btnJunD").removeClass("btn-info");
	$(".btnJunD").addClass("btn-default");

	$(".btnJulD").removeClass("btn-info");
	$(".btnJulD").addClass("btn-default");

	$(".btnAgoD").removeClass("btn-info");
	$(".btnAgoD").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnOctD").removeClass("btn-info");
	$(".btnOctD").addClass("btn-default");

	$(".btnNovD").removeClass("btn-info");
	$(".btnNovD").addClass("btn-default");

	$(".btnDicD").removeClass("btn-info");
	$(".btnDicD").addClass("btn-default");

	localStorage.setItem("mesD", mesD);
	$(".TablaDiario").DataTable().destroy();
	cargarTablaDiario(localStorage.getItem("mesD"));
})
$(".btnOctD").click(function(){
	var mesD = document.getElementById("btnOctD").value;
	//console.log(mesD);

	$(".btnEneD").removeClass("btn-info");
	$(".btnEneD").addClass("btn-default");

	$(".btnFebD").removeClass("btn-info");
	$(".btnFebD").addClass("btn-default");

	$(".btnMarD").removeClass("btn-info");
	$(".btnMarD").addClass("btn-default");

	$(".btnAbrD").removeClass("btn-info");
	$(".btnAbrD").addClass("btn-default");

	$(".btnMayD").removeClass("btn-info");
	$(".btnMayD").addClass("btn-default");

	$(".btnJunD").removeClass("btn-info");
	$(".btnJunD").addClass("btn-default");

	$(".btnJulD").removeClass("btn-info");
	$(".btnJulD").addClass("btn-default");

	$(".btnAgoD").removeClass("btn-info");
	$(".btnAgoD").addClass("btn-default");

	$(".btnSepD").removeClass("btn-info");
	$(".btnSepD").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnNovD").removeClass("btn-info");
	$(".btnNovD").addClass("btn-default");

	$(".btnDicD").removeClass("btn-info");
	$(".btnDicD").addClass("btn-default");

	localStorage.setItem("mesD", mesD);
	$(".TablaDiario").DataTable().destroy();
	cargarTablaDiario(localStorage.getItem("mesD"));
})
$(".btnNovD").click(function(){
	var mesD = document.getElementById("btnNovD").value;
	//console.log(mesD);

	$(".btnEneD").removeClass("btn-info");
	$(".btnEneD").addClass("btn-default");

	$(".btnFebD").removeClass("btn-info");
	$(".btnFebD").addClass("btn-default");

	$(".btnMarD").removeClass("btn-info");
	$(".btnMarD").addClass("btn-default");

	$(".btnAbrD").removeClass("btn-info");
	$(".btnAbrD").addClass("btn-default");

	$(".btnMayD").removeClass("btn-info");
	$(".btnMayD").addClass("btn-default");

	$(".btnJunD").removeClass("btn-info");
	$(".btnJunD").addClass("btn-default");

	$(".btnJulD").removeClass("btn-info");
	$(".btnJulD").addClass("btn-default");

	$(".btnAgoD").removeClass("btn-info");
	$(".btnAgoD").addClass("btn-default");

	$(".btnSepD").removeClass("btn-info");
	$(".btnSepD").addClass("btn-default");

	$(".btnOctD").removeClass("btn-info");
	$(".btnOctD").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnDicD").removeClass("btn-info");
	$(".btnDicD").addClass("btn-default");

	localStorage.setItem("mesD", mesD);
	$(".TablaDiario").DataTable().destroy();
	cargarTablaDiario(localStorage.getItem("mesD"));
})
$(".btnDicD").click(function(){
	var mesD = document.getElementById("btnDicD").value;
	//console.log(mesD);

	$(".btnEneD").removeClass("btn-info");
	$(".btnEneD").addClass("btn-default");

	$(".btnFebD").removeClass("btn-info");
	$(".btnFebD").addClass("btn-default");

	$(".btnMarD").removeClass("btn-info");
	$(".btnMarD").addClass("btn-default");

	$(".btnAbrD").removeClass("btn-info");
	$(".btnAbrD").addClass("btn-default");

	$(".btnMayD").removeClass("btn-info");
	$(".btnMayD").addClass("btn-default");

	$(".btnJunD").removeClass("btn-info");
	$(".btnJunD").addClass("btn-default");

	$(".btnJulD").removeClass("btn-info");
	$(".btnJulD").addClass("btn-default");

	$(".btnAgoD").removeClass("btn-info");
	$(".btnAgoD").addClass("btn-default");

	$(".btnSepD").removeClass("btn-info");
	$(".btnSepD").addClass("btn-default");

	$(".btnOctD").removeClass("btn-info");
	$(".btnOctD").addClass("btn-default");

	$(".btnNovD").removeClass("btn-info");
	$(".btnNovD").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	localStorage.setItem("mesD", mesD);
	$(".TablaDiario").DataTable().destroy();
	cargarTablaDiario(localStorage.getItem("mesD"));
})

function cargarTablaDiario(mesD){

	$(document).ready(function() {

		var tablaD = $(".TablaDiario").DataTable({
			"ajax": "ajax/centrocostos/tabla-diarios.ajax.php?mesD=" + mesD,
			"deferRender": true,
			"retrieve": true,
			"processing": true,
			"order": [[2, "asc"]],
			"pageLength": 20,
			"lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
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
			},
			"createdRow":function(row,data,index){
				if(data[0] == "94"){
					$('td',row).eq(0).css({
						'background-color':'#52BE80',
						'color':'black'
					})
				}else if (data[0] == "95"){
					$('td',row).eq(0).css({
						'background-color':'#52BEB4',
						'color':'black'
					})
				}else if(data[0] == "92"){
					$('td',row).eq(0).css({
						'background-color':'#FF6868',
						'color':'black'
					})
				}else if(data[0] == "97"){
					$('td',row).eq(0).css({
						'background-color':'#7C9EFF',
						'color':'black'
					})
				}else if(data[0] == "60"){
					$('td',row).eq(0).css({
						'background-color':'#CCF459',
						'color':'black'
					})
				}		
			}


		});
	
		tablaD.columns( [8,9,11] ).visible( false );
	
		$('a.toggle-vis').on( 'click', function (e) {
			e.preventDefault();
		
			// Get the column API object
			var column = tablaD.column( $(this).attr('data-column') );
		
			// Toggle the visibility
			column.visible( ! column.visible() );
			
		} );
	
	});

}

$(".TablaDiario").on("click", ".btnAlertaD", function() {

	var ruc = $(this).attr("ruc");
	var documento = $(this).attr("documento");
	var estadoAlerta = $(this).attr("estadoAlerta");
	//console.log(ruc,documento,estadoAlerta);

	var datos=new FormData();
	datos.append("ruc",ruc);
	datos.append("documento",documento);
	datos.append("estadoAlerta",estadoAlerta);

	$.ajax({

		url:"ajax/centro-costos.ajax.php",
		type:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		success:function(respuesta){

			//console.log(respuesta);

			if(respuesta == '"ok"' && estadoAlerta == "1"){

				Command: toastr["error"]("Alerta Registrada");

			}else if(respuesta == '"ok"' && estadoAlerta == "0"){

				Command: toastr["info"]("Sin Observación");

			}

		}

	});

	if(estadoAlerta == "1"){

		$(this).removeClass("btn-default");
		$(this).removeClass("fa-ellipsis-h");
		$(this).addClass("btn-danger");
		$(this).addClass("fa-exclamation-circle");
		$(this).attr("estadoAlerta","0");

	}else if(estadoAlerta == "0"){

		$(this).addClass("btn-default");
		$(this).addClass("fa-ellipsis-h");
		$(this).removeClass("btn-danger");
		$(this).removeClass("fa-exclamation-circle");
		$(this).attr("estadoAlerta","1");		

	}


})


$(".TablaDiarioAlerta").DataTable({

	"ajax": "ajax/centrocostos/tabla-diarios-alerta.ajax.php",
	"deferRender": true,
	"retrieve": true,
	"processing": true,
	"order": [[0, "asc"]],
	"pageLength": 20,
	"lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
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
	},
	"createdRow":function(row,data,index){
		if(data[0] == "94"){
			$('td',row).eq(0).css({
				'background-color':'#52BE80',
				'color':'black'
			})
		}else if (data[0] == "95"){
			$('td',row).eq(0).css({
				'background-color':'#52BEB4',
				'color':'black'
			})
		}else if(data[0] == "92"){
			$('td',row).eq(0).css({
				'background-color':'#FF6868',
				'color':'black'
			})
		}else if(data[0] == "97"){
			$('td',row).eq(0).css({
				'background-color':'#7C9EFF',
				'color':'black'
			})
		}else if(data[0] == "60"){
			$('td',row).eq(0).css({
				'background-color':'#CCF459',
				'color':'black'
			})
		}		
	}

});
	
