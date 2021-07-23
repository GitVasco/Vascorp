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
			'background-color':'#F4596F',
			'color':'black'
		  })
		}else if(data[0] == "3"){
		  $('td',row).css({
			'background-color':'#5F86F8',
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

/*=============================================
CARGAR LA TABLA DINÁMICA DE GASTOS
=============================================*/
if (localStorage.getItem("mesG") != null) {
	cargarTablaGastosCaja(localStorage.getItem("mesG"));

	if(localStorage.getItem("mesG") == "1"){

		$(".btnEne").removeClass("btn-default");
		$(".btnEne").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesG", localStorage.getItem("mesG"));
  
			$.ajax({
	  
			  url:"ajax/tablamaestra.ajax.php",
			  method: "POST",
			  data: datos,
			  cache: false,
			  contentType: false,
			  processData: false,
			  dataType:"json",
			  success:function(respuesta){
				
				  //console.log(respuesta);
				  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
				  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
				  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
				  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];
  
			  }
		
		  })		

	}else if(localStorage.getItem("mesG") == "2"){

		$(".btnFeb").removeClass("btn-default");
		$(".btnFeb").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesG", localStorage.getItem("mesG"));
  
			$.ajax({
	  
			  url:"ajax/tablamaestra.ajax.php",
			  method: "POST",
			  data: datos,
			  cache: false,
			  contentType: false,
			  processData: false,
			  dataType:"json",
			  success:function(respuesta){
				
				  //console.log(respuesta);
				  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
				  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
				  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
				  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];
  
			  }
		
		  })	

	}
	else if(localStorage.getItem("mesG") == "3"){

		$(".btnMar").removeClass("btn-default");
		$(".btnMar").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesG", localStorage.getItem("mesG"));
  
			$.ajax({
	  
			  url:"ajax/tablamaestra.ajax.php",
			  method: "POST",
			  data: datos,
			  cache: false,
			  contentType: false,
			  processData: false,
			  dataType:"json",
			  success:function(respuesta){
				
				  //console.log(respuesta);
				  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
				  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
				  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
				  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];
  
			  }
		
		  })	

	}
	else if(localStorage.getItem("mesG") == "4"){

		$(".btnAbr").removeClass("btn-default");
		$(".btnAbr").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesG", localStorage.getItem("mesG"));
  
			$.ajax({
	  
			  url:"ajax/tablamaestra.ajax.php",
			  method: "POST",
			  data: datos,
			  cache: false,
			  contentType: false,
			  processData: false,
			  dataType:"json",
			  success:function(respuesta){
				
				  //console.log(respuesta);
				  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
				  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
				  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
				  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];
  
			  }
		
		  })		

	}
	else if(localStorage.getItem("mesG") == "5"){

		$(".btnMay").removeClass("btn-default");
		$(".btnMay").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesG", localStorage.getItem("mesG"));
  
			$.ajax({
	  
			  url:"ajax/tablamaestra.ajax.php",
			  method: "POST",
			  data: datos,
			  cache: false,
			  contentType: false,
			  processData: false,
			  dataType:"json",
			  success:function(respuesta){
				
				  //console.log(respuesta);
				  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
				  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
				  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
				  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];
  
			  }
		
		  })

	}
	else if(localStorage.getItem("mesG") == "6"){

		$(".btnJun").removeClass("btn-default");
		$(".btnJun").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesG", localStorage.getItem("mesG"));
  
			$.ajax({
	  
			  url:"ajax/tablamaestra.ajax.php",
			  method: "POST",
			  data: datos,
			  cache: false,
			  contentType: false,
			  processData: false,
			  dataType:"json",
			  success:function(respuesta){
				
				  //console.log(respuesta);
				  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
				  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
				  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
				  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];
  
			  }
		
		  })

	}
	else if(localStorage.getItem("mesG") == "7"){

		$(".btnJul").removeClass("btn-default");
		$(".btnJul").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesG", localStorage.getItem("mesG"));
  
			$.ajax({
	  
			  url:"ajax/tablamaestra.ajax.php",
			  method: "POST",
			  data: datos,
			  cache: false,
			  contentType: false,
			  processData: false,
			  dataType:"json",
			  success:function(respuesta){
				
				  //console.log(respuesta);
				  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
				  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
				  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
				  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];
  
			  }
		
		  })

	}
	else if(localStorage.getItem("mesG") == "8"){

		$(".btnAgo").removeClass("btn-default");
		$(".btnAgo").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesG", localStorage.getItem("mesG"));
  
			$.ajax({
	  
			  url:"ajax/tablamaestra.ajax.php",
			  method: "POST",
			  data: datos,
			  cache: false,
			  contentType: false,
			  processData: false,
			  dataType:"json",
			  success:function(respuesta){
				
				  //console.log(respuesta);
				  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
				  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
				  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
				  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];
  
			  }
		
		  })

	}
	else if(localStorage.getItem("mesG") == "9"){

		$(".btnSep").removeClass("btn-default");
		$(".btnSep").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesG", localStorage.getItem("mesG"));
  
			$.ajax({
	  
			  url:"ajax/tablamaestra.ajax.php",
			  method: "POST",
			  data: datos,
			  cache: false,
			  contentType: false,
			  processData: false,
			  dataType:"json",
			  success:function(respuesta){
				
				  //console.log(respuesta);
				  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
				  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
				  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
				  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];
  
			  }
		
		  })

	}
	else if(localStorage.getItem("mesG") == "10"){

		$(".btnOct").removeClass("btn-default");
		$(".btnOct").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesG", localStorage.getItem("mesG"));
  
			$.ajax({
	  
			  url:"ajax/tablamaestra.ajax.php",
			  method: "POST",
			  data: datos,
			  cache: false,
			  contentType: false,
			  processData: false,
			  dataType:"json",
			  success:function(respuesta){
				
				  //console.log(respuesta);
				  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
				  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
				  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
				  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];
  
			  }
		
		  })

	}else if(localStorage.getItem("mesG") == "11"){

		$(".btnNov").removeClass("btn-default");
		$(".btnNov").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesG", localStorage.getItem("mesG"));
  
			$.ajax({
	  
			  url:"ajax/tablamaestra.ajax.php",
			  method: "POST",
			  data: datos,
			  cache: false,
			  contentType: false,
			  processData: false,
			  dataType:"json",
			  success:function(respuesta){
				
				  //console.log(respuesta);
				  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
				  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
				  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
				  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];
  
			  }
		
		  })

	}
	else if(localStorage.getItem("mesG") == "12"){

		$(".btnDic").removeClass("btn-default");
		$(".btnDic").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesG", localStorage.getItem("mesG"));
  
			$.ajax({
	  
			  url:"ajax/tablamaestra.ajax.php",
			  method: "POST",
			  data: datos,
			  cache: false,
			  contentType: false,
			  processData: false,
			  dataType:"json",
			  success:function(respuesta){
				
				  //console.log(respuesta);
				  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
				  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
				  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
				  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];
  
			  }
		
		  })

	}

} else {
	const fecha = new Date();
	const mesG = fecha.getMonth() + 1; 

	if(mesG == "1"){

		$(".btnEne").removeClass("btn-default");
		$(".btnEne").addClass("btn-info");
	}else if(mesG == "2"){

		$(".btnFeb").removeClass("btn-default");
		$(".btnFeb").addClass("btn-info");
	}
	else if(mesG == "3"){

		$(".btnMar").removeClass("btn-default");
		$(".btnMar").addClass("btn-info");
	}
	else if(mesG == "4"){

		$(".btnAbr").removeClass("btn-default");
		$(".btnAbr").addClass("btn-info");
	}
	else if(mesG == "5"){

		$(".btnMay").removeClass("btn-default");
		$(".btnMay").addClass("btn-info");
	}
	else if(mesG == "6"){

		$(".btnJun").removeClass("btn-default");
		$(".btnJun").addClass("btn-info");
	}
	else if(mesG == "7"){

		$(".btnJul").removeClass("btn-default");
		$(".btnJul").addClass("btn-info");
	}
	else if(mesG == "8"){

		$(".btnAgo").removeClass("btn-default");
		$(".btnAgo").addClass("btn-info");
	}
	else if(mesG == "9"){

		$(".btnSep").removeClass("btn-default");
		$(".btnSep").addClass("btn-info");
	}
	else if(mesG == "10"){

		$(".btnOct").removeClass("btn-default");
		$(".btnOct").addClass("btn-info");
	}else if(mesG == "11"){

		$(".btnNov").removeClass("btn-default");
		$(".btnNov").addClass("btn-info");
	}
	else if(mesG == "12"){

		$(".btnDic").removeClass("btn-default");
		$(".btnDic").addClass("btn-info");
	}

	cargarTablaGastosCaja(mesG);
}


$(".btnEne").click(function(){
	var mesG = document.getElementById("btnEne").value;
	//console.log(mesG);

	var datos = new FormData();
	datos.append("mesG", mesG);

		$.ajax({
  
		  url:"ajax/tablamaestra.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  dataType:"json",
		  success:function(respuesta){
			
			  //console.log(respuesta);
			  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
			  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
			  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
			  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];

		  }
	
	  })	

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnFeb").removeClass("btn-info");
	$(".btnFeb").addClass("btn-default");

	$(".btnMar").removeClass("btn-info");
	$(".btnMar").addClass("btn-default");

	$(".btnAbr").removeClass("btn-info");
	$(".btnAbr").addClass("btn-default");

	$(".btnMay").removeClass("btn-info");
	$(".btnMay").addClass("btn-default");

	$(".btnJun").removeClass("btn-info");
	$(".btnJun").addClass("btn-default");

	$(".btnJul").removeClass("btn-info");
	$(".btnJul").addClass("btn-default");

	$(".btnAgo").removeClass("btn-info");
	$(".btnAgo").addClass("btn-default");

	$(".btnSep").removeClass("btn-info");
	$(".btnSep").addClass("btn-default");

	$(".btnOct").removeClass("btn-info");
	$(".btnOct").addClass("btn-default");

	$(".btnNov").removeClass("btn-info");
	$(".btnNov").addClass("btn-default");

	$(".btnDic").removeClass("btn-info");
	$(".btnDic").addClass("btn-default");

	localStorage.setItem("mesG", mesG);
	$(".TablaGastosCaja").DataTable().destroy();
	cargarTablaGastosCaja(localStorage.getItem("mesG"));
})
$(".btnFeb").click(function(){
	var mesG = document.getElementById("btnFeb").value;
	//console.log(mesG);

	var datos = new FormData();
	datos.append("mesG", mesG);

		$.ajax({
  
		  url:"ajax/tablamaestra.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  dataType:"json",
		  success:function(respuesta){
			
			  //console.log(respuesta);
			  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
			  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
			  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
			  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];

		  }
	
	  })	

	$(".btnEne").removeClass("btn-info");
	$(".btnEne").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnMar").removeClass("btn-info");
	$(".btnMar").addClass("btn-default");

	$(".btnAbr").removeClass("btn-info");
	$(".btnAbr").addClass("btn-default");

	$(".btnMay").removeClass("btn-info");
	$(".btnMay").addClass("btn-default");

	$(".btnJun").removeClass("btn-info");
	$(".btnJun").addClass("btn-default");

	$(".btnJul").removeClass("btn-info");
	$(".btnJul").addClass("btn-default");

	$(".btnAgo").removeClass("btn-info");
	$(".btnAgo").addClass("btn-default");

	$(".btnSep").removeClass("btn-info");
	$(".btnSep").addClass("btn-default");

	$(".btnOct").removeClass("btn-info");
	$(".btnOct").addClass("btn-default");

	$(".btnNov").removeClass("btn-info");
	$(".btnNov").addClass("btn-default");

	$(".btnDic").removeClass("btn-info");
	$(".btnDic").addClass("btn-default");

	localStorage.setItem("mesG", mesG);
	$(".TablaGastosCaja").DataTable().destroy();
	cargarTablaGastosCaja(localStorage.getItem("mesG"));
})
$(".btnMar").click(function(){
	var mesG = document.getElementById("btnMar").value;
	//console.log(mesG);

	var datos = new FormData();
	datos.append("mesG", mesG);

		$.ajax({
  
		  url:"ajax/tablamaestra.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  dataType:"json",
		  success:function(respuesta){
			
			  //console.log(respuesta);
			  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
			  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
			  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
			  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];

		  }
	
	  })	

	$(".btnEne").removeClass("btn-info");
	$(".btnEne").addClass("btn-default");

	$(".btnFeb").removeClass("btn-info");
	$(".btnFeb").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnAbr").removeClass("btn-info");
	$(".btnAbr").addClass("btn-default");

	$(".btnMay").removeClass("btn-info");
	$(".btnMay").addClass("btn-default");

	$(".btnJun").removeClass("btn-info");
	$(".btnJun").addClass("btn-default");

	$(".btnJul").removeClass("btn-info");
	$(".btnJul").addClass("btn-default");

	$(".btnAgo").removeClass("btn-info");
	$(".btnAgo").addClass("btn-default");

	$(".btnSep").removeClass("btn-info");
	$(".btnSep").addClass("btn-default");

	$(".btnOct").removeClass("btn-info");
	$(".btnOct").addClass("btn-default");

	$(".btnNov").removeClass("btn-info");
	$(".btnNov").addClass("btn-default");

	$(".btnDic").removeClass("btn-info");
	$(".btnDic").addClass("btn-default");

	localStorage.setItem("mesG", mesG);
	$(".TablaGastosCaja").DataTable().destroy();
	cargarTablaGastosCaja(localStorage.getItem("mesG"));
})
$(".btnAbr").click(function(){
	var mesG = document.getElementById("btnAbr").value;
	//console.log(mesG);

	var datos = new FormData();
	datos.append("mesG", mesG);

		$.ajax({
  
		  url:"ajax/tablamaestra.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  dataType:"json",
		  success:function(respuesta){
			
			  //console.log(respuesta);
			  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
			  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
			  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
			  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];

		  }
	
	  })	

	$(".btnEne").removeClass("btn-info");
	$(".btnEne").addClass("btn-default");

	$(".btnFeb").removeClass("btn-info");
	$(".btnFeb").addClass("btn-default");

	$(".btnMar").removeClass("btn-info");
	$(".btnMar").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnMay").removeClass("btn-info");
	$(".btnMay").addClass("btn-default");

	$(".btnJun").removeClass("btn-info");
	$(".btnJun").addClass("btn-default");

	$(".btnJul").removeClass("btn-info");
	$(".btnJul").addClass("btn-default");

	$(".btnAgo").removeClass("btn-info");
	$(".btnAgo").addClass("btn-default");

	$(".btnSep").removeClass("btn-info");
	$(".btnSep").addClass("btn-default");

	$(".btnOct").removeClass("btn-info");
	$(".btnOct").addClass("btn-default");

	$(".btnNov").removeClass("btn-info");
	$(".btnNov").addClass("btn-default");

	$(".btnDic").removeClass("btn-info");
	$(".btnDic").addClass("btn-default");

	localStorage.setItem("mesG", mesG);
	$(".TablaGastosCaja").DataTable().destroy();
	cargarTablaGastosCaja(localStorage.getItem("mesG"));
})
$(".btnMay").click(function(){
	var mesG = document.getElementById("btnMay").value;
	//console.log(mesG);

	var datos = new FormData();
	datos.append("mesG", mesG);

		$.ajax({
  
		  url:"ajax/tablamaestra.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  dataType:"json",
		  success:function(respuesta){
			
			  //console.log(respuesta);
			  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
			  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
			  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
			  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];

		  }
	
	  })	

	$(".btnEne").removeClass("btn-info");
	$(".btnEne").addClass("btn-default");

	$(".btnFeb").removeClass("btn-info");
	$(".btnFeb").addClass("btn-default");

	$(".btnMar").removeClass("btn-info");
	$(".btnMar").addClass("btn-default");

	$(".btnAbr").removeClass("btn-info");
	$(".btnAbr").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnJun").removeClass("btn-info");
	$(".btnJun").addClass("btn-default");

	$(".btnJul").removeClass("btn-info");
	$(".btnJul").addClass("btn-default");

	$(".btnAgo").removeClass("btn-info");
	$(".btnAgo").addClass("btn-default");

	$(".btnSep").removeClass("btn-info");
	$(".btnSep").addClass("btn-default");

	$(".btnOct").removeClass("btn-info");
	$(".btnOct").addClass("btn-default");

	$(".btnNov").removeClass("btn-info");
	$(".btnNov").addClass("btn-default");

	$(".btnDic").removeClass("btn-info");
	$(".btnDic").addClass("btn-default");

	localStorage.setItem("mesG", mesG);
	$(".TablaGastosCaja").DataTable().destroy();
	cargarTablaGastosCaja(localStorage.getItem("mesG"));
})
$(".btnJun").click(function(){
	var mesG = document.getElementById("btnJun").value;
	//console.log(mesG);

	  var datos = new FormData();
	  datos.append("mesG", mesG);

	  	$.ajax({
	
			url:"ajax/tablamaestra.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType:"json",
			success:function(respuesta){
		  	
				//console.log(respuesta);
				document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
				document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
				document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
				document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];

			}
	  
		})

	$(".btnEne").removeClass("btn-info");
	$(".btnEne").addClass("btn-default");

	$(".btnFeb").removeClass("btn-info");
	$(".btnFeb").addClass("btn-default");

	$(".btnMar").removeClass("btn-info");
	$(".btnMar").addClass("btn-default");

	$(".btnAbr").removeClass("btn-info");
	$(".btnAbr").addClass("btn-default");

	$(".btnMay").removeClass("btn-info");
	$(".btnMay").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnJul").removeClass("btn-info");
	$(".btnJul").addClass("btn-default");

	$(".btnAgo").removeClass("btn-info");
	$(".btnAgo").addClass("btn-default");

	$(".btnSep").removeClass("btn-info");
	$(".btnSep").addClass("btn-default");

	$(".btnOct").removeClass("btn-info");
	$(".btnOct").addClass("btn-default");

	$(".btnNov").removeClass("btn-info");
	$(".btnNov").addClass("btn-default");

	$(".btnDic").removeClass("btn-info");
	$(".btnDic").addClass("btn-default");

	localStorage.setItem("mesG", mesG);
	$(".TablaGastosCaja").DataTable().destroy();
	cargarTablaGastosCaja(localStorage.getItem("mesG"));
})
$(".btnJul").click(function(){
	var mesG = document.getElementById("btnJul").value;
	//console.log(mesG);

	var datos = new FormData();
	datos.append("mesG", mesG);

		$.ajax({
  
		  url:"ajax/tablamaestra.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  dataType:"json",
		  success:function(respuesta){
			
			  //console.log(respuesta);
			  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
			  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
			  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
			  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];

		  }
	
	  })	

	$(".btnEne").removeClass("btn-info");
	$(".btnEne").addClass("btn-default");

	$(".btnFeb").removeClass("btn-info");
	$(".btnFeb").addClass("btn-default");

	$(".btnMar").removeClass("btn-info");
	$(".btnMar").addClass("btn-default");

	$(".btnAbr").removeClass("btn-info");
	$(".btnAbr").addClass("btn-default");

	$(".btnMay").removeClass("btn-info");
	$(".btnMay").addClass("btn-default");

	$(".btnJun").removeClass("btn-info");
	$(".btnJun").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnAgo").removeClass("btn-info");
	$(".btnAgo").addClass("btn-default");

	$(".btnSep").removeClass("btn-info");
	$(".btnSep").addClass("btn-default");

	$(".btnOct").removeClass("btn-info");
	$(".btnOct").addClass("btn-default");

	$(".btnNov").removeClass("btn-info");
	$(".btnNov").addClass("btn-default");

	$(".btnDic").removeClass("btn-info");
	$(".btnDic").addClass("btn-default");

	localStorage.setItem("mesG", mesG);
	$(".TablaGastosCaja").DataTable().destroy();
	cargarTablaGastosCaja(localStorage.getItem("mesG"));
})
$(".btnAgo").click(function(){
	var mesG = document.getElementById("btnAgo").value;
	//console.log(mesG);

	var datos = new FormData();
	datos.append("mesG", mesG);

		$.ajax({
  
		  url:"ajax/tablamaestra.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  dataType:"json",
		  success:function(respuesta){
			
			  //console.log(respuesta);
			  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
			  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
			  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
			  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];

		  }
	
	  })	

	$(".btnEne").removeClass("btn-info");
	$(".btnEne").addClass("btn-default");

	$(".btnFeb").removeClass("btn-info");
	$(".btnFeb").addClass("btn-default");

	$(".btnMar").removeClass("btn-info");
	$(".btnMar").addClass("btn-default");

	$(".btnAbr").removeClass("btn-info");
	$(".btnAbr").addClass("btn-default");

	$(".btnMay").removeClass("btn-info");
	$(".btnMay").addClass("btn-default");

	$(".btnJun").removeClass("btn-info");
	$(".btnJun").addClass("btn-default");

	$(".btnJul").removeClass("btn-info");
	$(".btnJul").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnSep").removeClass("btn-info");
	$(".btnSep").addClass("btn-default");

	$(".btnOct").removeClass("btn-info");
	$(".btnOct").addClass("btn-default");

	$(".btnNov").removeClass("btn-info");
	$(".btnNov").addClass("btn-default");

	$(".btnDic").removeClass("btn-info");
	$(".btnDic").addClass("btn-default");

	localStorage.setItem("mesG", mesG);
	$(".TablaGastosCaja").DataTable().destroy();
	cargarTablaGastosCaja(localStorage.getItem("mesG"));
})
$(".btnSep").click(function(){
	var mesG = document.getElementById("btnSep").value;
	//console.log(mesG);

	var datos = new FormData();
	datos.append("mesG", mesG);

		$.ajax({
  
		  url:"ajax/tablamaestra.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  dataType:"json",
		  success:function(respuesta){
			
			  //console.log(respuesta);
			  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
			  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
			  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
			  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];

		  }
	
	  })	

	$(".btnEne").removeClass("btn-info");
	$(".btnEne").addClass("btn-default");

	$(".btnFeb").removeClass("btn-info");
	$(".btnFeb").addClass("btn-default");

	$(".btnMar").removeClass("btn-info");
	$(".btnMar").addClass("btn-default");

	$(".btnAbr").removeClass("btn-info");
	$(".btnAbr").addClass("btn-default");

	$(".btnMay").removeClass("btn-info");
	$(".btnMay").addClass("btn-default");

	$(".btnJun").removeClass("btn-info");
	$(".btnJun").addClass("btn-default");

	$(".btnJul").removeClass("btn-info");
	$(".btnJul").addClass("btn-default");

	$(".btnAgo").removeClass("btn-info");
	$(".btnAgo").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnOct").removeClass("btn-info");
	$(".btnOct").addClass("btn-default");

	$(".btnNov").removeClass("btn-info");
	$(".btnNov").addClass("btn-default");

	$(".btnDic").removeClass("btn-info");
	$(".btnDic").addClass("btn-default");

	localStorage.setItem("mesG", mesG);
	$(".TablaGastosCaja").DataTable().destroy();
	cargarTablaGastosCaja(localStorage.getItem("mesG"));
})
$(".btnOct").click(function(){
	var mesG = document.getElementById("btnOct").value;
	//console.log(mesG);

	var datos = new FormData();
	datos.append("mesG", mesG);

		$.ajax({
  
		  url:"ajax/tablamaestra.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  dataType:"json",
		  success:function(respuesta){
			
			  //console.log(respuesta);
			  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
			  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
			  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
			  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];

		  }
	
	  })	

	$(".btnEne").removeClass("btn-info");
	$(".btnEne").addClass("btn-default");

	$(".btnFeb").removeClass("btn-info");
	$(".btnFeb").addClass("btn-default");

	$(".btnMar").removeClass("btn-info");
	$(".btnMar").addClass("btn-default");

	$(".btnAbr").removeClass("btn-info");
	$(".btnAbr").addClass("btn-default");

	$(".btnMay").removeClass("btn-info");
	$(".btnMay").addClass("btn-default");

	$(".btnJun").removeClass("btn-info");
	$(".btnJun").addClass("btn-default");

	$(".btnJul").removeClass("btn-info");
	$(".btnJul").addClass("btn-default");

	$(".btnAgo").removeClass("btn-info");
	$(".btnAgo").addClass("btn-default");

	$(".btnSep").removeClass("btn-info");
	$(".btnSep").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnNov").removeClass("btn-info");
	$(".btnNov").addClass("btn-default");

	$(".btnDic").removeClass("btn-info");
	$(".btnDic").addClass("btn-default");

	localStorage.setItem("mesG", mesG);
	$(".TablaGastosCaja").DataTable().destroy();
	cargarTablaGastosCaja(localStorage.getItem("mesG"));
})
$(".btnNov").click(function(){
	var mesG = document.getElementById("btnNov").value;
	//console.log(mesG);

	var datos = new FormData();
	datos.append("mesG", mesG);

		$.ajax({
  
		  url:"ajax/tablamaestra.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  dataType:"json",
		  success:function(respuesta){
			
			  //console.log(respuesta);
			  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
			  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
			  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
			  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];

		  }
	
	  })	

	$(".btnEne").removeClass("btn-info");
	$(".btnEne").addClass("btn-default");

	$(".btnFeb").removeClass("btn-info");
	$(".btnFeb").addClass("btn-default");

	$(".btnMar").removeClass("btn-info");
	$(".btnMar").addClass("btn-default");

	$(".btnAbr").removeClass("btn-info");
	$(".btnAbr").addClass("btn-default");

	$(".btnMay").removeClass("btn-info");
	$(".btnMay").addClass("btn-default");

	$(".btnJun").removeClass("btn-info");
	$(".btnJun").addClass("btn-default");

	$(".btnJul").removeClass("btn-info");
	$(".btnJul").addClass("btn-default");

	$(".btnAgo").removeClass("btn-info");
	$(".btnAgo").addClass("btn-default");

	$(".btnSep").removeClass("btn-info");
	$(".btnSep").addClass("btn-default");

	$(".btnOct").removeClass("btn-info");
	$(".btnOct").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnDic").removeClass("btn-info");
	$(".btnDic").addClass("btn-default");

	localStorage.setItem("mesG", mesG);
	$(".TablaGastosCaja").DataTable().destroy();
	cargarTablaGastosCaja(localStorage.getItem("mesG"));
})
$(".btnDic").click(function(){
	var mesG = document.getElementById("btnDic").value;
	//console.log(mesG);

	var datos = new FormData();
	datos.append("mesG", mesG);

		$.ajax({
  
		  url:"ajax/tablamaestra.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  dataType:"json",
		  success:function(respuesta){
			
			  //console.log(respuesta);
			  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
			  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
			  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
			  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];

		  }
	
	  })	

	$(".btnEne").removeClass("btn-info");
	$(".btnEne").addClass("btn-default");

	$(".btnFeb").removeClass("btn-info");
	$(".btnFeb").addClass("btn-default");

	$(".btnMar").removeClass("btn-info");
	$(".btnMar").addClass("btn-default");

	$(".btnAbr").removeClass("btn-info");
	$(".btnAbr").addClass("btn-default");

	$(".btnMay").removeClass("btn-info");
	$(".btnMay").addClass("btn-default");

	$(".btnJun").removeClass("btn-info");
	$(".btnJun").addClass("btn-default");

	$(".btnJul").removeClass("btn-info");
	$(".btnJul").addClass("btn-default");

	$(".btnAgo").removeClass("btn-info");
	$(".btnAgo").addClass("btn-default");

	$(".btnSep").removeClass("btn-info");
	$(".btnSep").addClass("btn-default");

	$(".btnOct").removeClass("btn-info");
	$(".btnOct").addClass("btn-default");

	$(".btnNov").removeClass("btn-info");
	$(".btnNov").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	localStorage.setItem("mesG", mesG);
	$(".TablaGastosCaja").DataTable().destroy();
	cargarTablaGastosCaja(localStorage.getItem("mesG"));
})


function cargarTablaGastosCaja(mesG){

	$(".TablaGastosCaja").DataTable({
		ajax: "ajax/centrocostos/tabla-gastos-caja.ajax.php?mesG="+ mesG,
		deferRender: true,
		retrieve: true,
		processing: true,
		order: [[0, "desc"]],
		"pageLength": 20,
		  "lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
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
		},
		"createdRow":function(row,data,index){
			if(data[4] == "94"){
				$('td',row).eq(4).css({
					'background-color':'#52BE80',
					'color':'black'
				})
				$('td',row).eq(5).css({
					'background-color':'#52BE80',
					'color':'black'
				})
				$('td',row).eq(6).css({
					'background-color':'#52BE80',
					'color':'black'
				})
			}else if (data[4] == "95"){
				$('td',row).eq(4).css({
					'background-color':'#52BEB4',
					'color':'black'
				})
				$('td',row).eq(5).css({
					'background-color':'#52BEB4',
					'color':'black'
				})
				$('td',row).eq(6).css({
					'background-color':'#52BEB4',
					'color':'black'
				})
			}else if(data[4] == "92"){
				$('td',row).eq(4).css({
					'background-color':'#F4596F',
					'color':'black'
				})
				$('td',row).eq(5).css({
					'background-color':'#F4596F',
					'color':'black'
				})
				$('td',row).eq(6).css({
					'background-color':'#F4596F',
					'color':'black'
				})
			}else if(data[4] == "97"){
				$('td',row).eq(4).css({
					'background-color':'#5F86F8',
					'color':'black'
				})
				$('td',row).eq(5).css({
					'background-color':'#5F86F8',
					'color':'black'
				})
				$('td',row).eq(6).css({
					'background-color':'#5F86F8',
					'color':'black'
				})
			}else if(data[4] == "60"){
				$('td',row).eq(4).css({
					'background-color':'#CCF459',
					'color':'black'
				})
				$('td',row).eq(5).css({
					'background-color':'#CCF459',
					'color':'black'
				})
				$('td',row).eq(6).css({
					'background-color':'#CCF459',
					'color':'black'
				})
			}else if(data[4] == "10"){
				$('td',row).eq(4).css({
					'background-color':'#AAE1FF',
					'color':'black'
				})
				$('td',row).eq(5).css({
					'background-color':'#AAE1FF',
					'color':'black'
				})
				$('td',row).eq(6).css({
					'background-color':'#AAE1FF',
					'color':'black'
				})
			}else if(data[4] == "11"){
				$('td',row).eq(4).css({
					'background-color':'#DDDAD6',
					'color':'black'
				})
				$('td',row).eq(5).css({
					'background-color':'#DDDAD6',
					'color':'black'
				})
				$('td',row).eq(6).css({
					'background-color':'#DDDAD6',
					'color':'black'
				})
			}else if(data[4] == "12"){
				$('td',row).eq(4).css({
					'background-color':'#FFCFE8',
					'color':'black'
				})
				$('td',row).eq(5).css({
					'background-color':'#FFCFE8',
					'color':'black'
				})
				$('td',row).eq(6).css({
					'background-color':'#FFCFE8',
					'color':'black'
				})
			}else if(data[4] == "13"){
				$('td',row).eq(4).css({
					'background-color':'#F5FAA5',
					'color':'black'
				})
				$('td',row).eq(5).css({
					'background-color':'#F5FAA5',
					'color':'black'
				})
				$('td',row).eq(6).css({
					'background-color':'#F5FAA5',
					'color':'black'
				})
			}else if(data[4] == "14"){
				$('td',row).eq(4).css({
					'background-color':'#DFB6F9',
					'color':'black'
				})
				$('td',row).eq(5).css({
					'background-color':'#DFB6F9',
					'color':'black'
				})
				$('td',row).eq(6).css({
					'background-color':'#DFB6F9',
					'color':'black'
				})
			}
	
			if(data[9] == "POR RENDIR"){
				$('td',row).eq(9).css({
				  'background-color':'#F5F106',
				  'color':'black'
				})
			}

			if(data[0].substr(-2,2) == "31"){
				$('td',row).eq(0).css({
				  'background-color':'#C2E4FF',
				  'color':'black'
				})
			}else if(data[0].substr(-2,2) == "30"){
				$('td',row).eq(0).css({
					'background-color':'#E8C2FF',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "29"){
				$('td',row).eq(0).css({
					'background-color':'#C2E4FF',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "28"){
				$('td',row).eq(0).css({
					'background-color':'#C2FFD2',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "27"){
				$('td',row).eq(0).css({
					'background-color':'#E8C2FF',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "26"){
				$('td',row).eq(0).css({
					'background-color':'#C2E4FF',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "25"){
				$('td',row).eq(0).css({
					'background-color':'#C2FFD2',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "26"){
				$('td',row).eq(0).css({
					'background-color':'#E8C2FF',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "25"){
				$('td',row).eq(0).css({
					'background-color':'#C2E4FF',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "24"){
				$('td',row).eq(0).css({
					'background-color':'#C2FFD2',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "23"){
				$('td',row).eq(0).css({
					'background-color':'#E8C2FF',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "22"){
				$('td',row).eq(0).css({
					'background-color':'#C2E4FF',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "21"){
				$('td',row).eq(0).css({
					'background-color':'#C2FFD2',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "20"){
				$('td',row).eq(0).css({
					'background-color':'#E8C2FF',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "19"){
				$('td',row).eq(0).css({
					'background-color':'#C2E4FF',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "18"){
				$('td',row).eq(0).css({
					'background-color':'#C2FFD2',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "17"){
				$('td',row).eq(0).css({
					'background-color':'#E8C2FF',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "16"){
				$('td',row).eq(0).css({
					'background-color':'#C2E4FF',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "15"){
				$('td',row).eq(0).css({
					'background-color':'#C2FFD2',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "14"){
				$('td',row).eq(0).css({
					'background-color':'#E8C2FF',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "13"){
				$('td',row).eq(0).css({
					'background-color':'#C2E4FF',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "12"){
				$('td',row).eq(0).css({
					'background-color':'#C2FFD2',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "11"){
				$('td',row).eq(0).css({
					'background-color':'#E8C2FF',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "10"){
				$('td',row).eq(0).css({
					'background-color':'#C2E4FF',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "09"){
				$('td',row).eq(0).css({
					'background-color':'#C2FFD2',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "08"){
				$('td',row).eq(0).css({
					'background-color':'#E8C2FF',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "07"){
				$('td',row).eq(0).css({
					'background-color':'#C2E4FF',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "06"){
				$('td',row).eq(0).css({
					'background-color':'#C2FFD2',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "05"){
				$('td',row).eq(0).css({
					'background-color':'#E8C2FF',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "04"){
				$('td',row).eq(0).css({
					'background-color':'#C2E4FF',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "03"){
				$('td',row).eq(0).css({
					'background-color':'#C2FFD2',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "02"){
				$('td',row).eq(0).css({
					'background-color':'#E8C2FF',
					'color':'black'
				})
			}else if(data[0].substr(-2,2) == "01"){
				$('td',row).eq(0).css({
					'background-color':'#C2E4FF',
					'color':'black'
				})
			}

	
		  }
	
	});

}



  //OBTENER DATOS POR RUC MEDIANTE LA API 
function ObtenerDatosRuc3(){
	
	var nuevoRuc = $("#nuevoRucProC, #editarRucProC").val();
	var tamano = nuevoRuc.length;
	// console.log(tamano);
	if(tamano == 8){
		var datos = new FormData();
		datos.append("nuevoDni",nuevoRuc);
		$.ajax({
			type: "POST",
			url: 'ajax/clientes.ajax.php',
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success:function( jsonx ) {
				// console.log(jsonx);
				if(jsonx["success"]==false){
					$('#nuevaRazPro').attr('readonly',false);
					$('#nuevaRazPro').val("");

					$('#editarRazPro').attr('readonly',false);
					$('#editarRazPro').val("");
					
				}else{
					$('#nuevaRazPro').val(jsonx["apellidoPaterno"]+" "+jsonx["apellidoMaterno"]+" "+jsonx["nombres"] );

					$('#editarRazPro').val(jsonx["apellidoPaterno"]+" "+jsonx["apellidoMaterno"]+" "+jsonx["nombres"] );
					
				}
			  
			}
		})
	}else if(tamano == 11){
		var datos = new FormData();
		datos.append("nuevoRuc",nuevoRuc);
		$.ajax({
			type: "POST",
			url: 'ajax/proveedor.ajax.php',
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success:function( jsonx ) {
				// console.log(jsonx);
				if(jsonx["success"]==false){
					$('#nuevaRazPro').attr('readonly',false);
					$('#nuevaRazPro').val("");

					$('#editarRazPro').attr('readonly',false);
					$('#editarRazPro').val("");
					
				}else{
					$('#nuevaRazPro').val(jsonx["razonSocial"]);

					$('#editarRazPro').val(jsonx["razonSocial"]);
				}
			  
			}
		})
	}else{
		
		$('#nuevaRazPro').attr('readonly',false);
		$('#nuevaRazPro').val("");

		$('#editarRazPro').attr('readonly',false);
		$('#editarRazPro').val("");

		Command: toastr["warning"]("DNI 8 digitos!");		
		Command: toastr["warning"]("RUC 11 digitos!");
	}
	
}

$("#nuevoCodCaja, #editarCodCaja").change(function(){

	var cod_caja = $(this).val();

	var datos = new FormData();

	datos.append("cod_caja", cod_caja);

	$.ajax({

		url:"ajax/centro-costos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

			$("#editarGasto").val(respuesta["nombre_gasto"]);
			$("#editarArea").val(respuesta["nombre_area"]);
			$("#editarCaja").val(respuesta["descripcion"]);

			$("#gasto").val(respuesta["nombre_gasto"]);
			$("#area").val(respuesta["nombre_area"]);
			$("#caja").val(respuesta["descripcion"]);

			if(respuesta["tipo_gasto"] == "94"){

				document.getElementById("gasto").style.background = "#52BE80";
				document.getElementById("gasto").style.color = "black";
				$("#gasto").css("font-weight","bold");

				document.getElementById("area").style.background = "#52BE80";
				document.getElementById("area").style.color = "black";
				$("#area").css("font-weight","bold");

				document.getElementById("caja").style.background = "#52BE80";
				document.getElementById("caja").style.color = "black";
				$("#caja").css("font-weight","bold");

				document.getElementById("editarGasto").style.background = "#52BE80";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#52BE80";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#52BE80";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");

			}else if(respuesta["tipo_gasto"] == "95"){

				document.getElementById("gasto").style.background = "#52BEB4";
				document.getElementById("gasto").style.color = "black";
				$("#gasto").css("font-weight","bold");

				document.getElementById("area").style.background = "#52BEB4";
				document.getElementById("area").style.color = "black";
				$("#area").css("font-weight","bold");

				document.getElementById("caja").style.background = "#52BEB4";
				document.getElementById("caja").style.color = "black";
				$("#caja").css("font-weight","bold");

				document.getElementById("editarGasto").style.background = "#52BEB4";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#52BEB4";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#52BEB4";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");

			}else if(respuesta["tipo_gasto"] == "92"){

				document.getElementById("gasto").style.background = "#F4596F";
				document.getElementById("gasto").style.color = "black";
				$("#gasto").css("font-weight","bold");

				document.getElementById("area").style.background = "#F4596F";
				document.getElementById("area").style.color = "black";
				$("#area").css("font-weight","bold");

				document.getElementById("caja").style.background = "#F4596F";
				document.getElementById("caja").style.color = "black";
				$("#caja").css("font-weight","bold");

				document.getElementById("editarGasto").style.background = "#F4596F";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#F4596F";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#F4596F";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");				

			}else if(respuesta["tipo_gasto"] == "97"){

				document.getElementById("gasto").style.background = "#5F86F8";
				document.getElementById("gasto").style.color = "black";
				$("#gasto").css("font-weight","bold");

				document.getElementById("area").style.background = "#5F86F8";
				document.getElementById("area").style.color = "black";
				$("#area").css("font-weight","bold");

				document.getElementById("caja").style.background = "#5F86F8";
				document.getElementById("caja").style.color = "black";
				$("#caja").css("font-weight","bold");

				document.getElementById("editarGasto").style.background = "#5F86F8";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#5F86F8";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#5F86F8";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");				

			}else if(respuesta["tipo_gasto"] == "60"){

				document.getElementById("gasto").style.background = "#CCF459";
				document.getElementById("gasto").style.color = "black";
				$("#gasto").css("font-weight","bold");

				document.getElementById("area").style.background = "#CCF459";
				document.getElementById("area").style.color = "black";
				$("#area").css("font-weight","bold");

				document.getElementById("caja").style.background = "#CCF459";
				document.getElementById("caja").style.color = "black";
				$("#caja").css("font-weight","bold");

				document.getElementById("editarGasto").style.background = "#CCF459";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#CCF459";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#CCF459";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");				

			}else if(respuesta["tipo_gasto"] == "10"){

				document.getElementById("gasto").style.background = "#AAE1FF";
				document.getElementById("gasto").style.color = "black";
				$("#gasto").css("font-weight","bold");

				document.getElementById("area").style.background = "#AAE1FF";
				document.getElementById("area").style.color = "black";
				$("#area").css("font-weight","bold");

				document.getElementById("caja").style.background = "#AAE1FF";
				document.getElementById("caja").style.color = "black";
				$("#caja").css("font-weight","bold");

				document.getElementById("editarGasto").style.background = "#AAE1FF";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#AAE1FF";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#AAE1FF";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");				

			}else if(respuesta["tipo_gasto"] == "11"){

				document.getElementById("gasto").style.background = "#DDDAD6";
				document.getElementById("gasto").style.color = "black";
				$("#gasto").css("font-weight","bold");

				document.getElementById("area").style.background = "#DDDAD6";
				document.getElementById("area").style.color = "black";
				$("#area").css("font-weight","bold");

				document.getElementById("caja").style.background = "#DDDAD6";
				document.getElementById("caja").style.color = "black";
				$("#caja").css("font-weight","bold");

				document.getElementById("editarGasto").style.background = "#DDDAD6";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#DDDAD6";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#DDDAD6";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");				

			}else if(respuesta["tipo_gasto"] == "12"){

				document.getElementById("gasto").style.background = "#FFCFE8";
				document.getElementById("gasto").style.color = "black";
				$("#gasto").css("font-weight","bold");

				document.getElementById("area").style.background = "#FFCFE8";
				document.getElementById("area").style.color = "black";
				$("#area").css("font-weight","bold");

				document.getElementById("caja").style.background = "#FFCFE8";
				document.getElementById("caja").style.color = "black";
				$("#caja").css("font-weight","bold");

				document.getElementById("editarGasto").style.background = "#FFCFE8";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#FFCFE8";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#FFCFE8";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");				

			}else if(respuesta["tipo_gasto"] == "13"){

				document.getElementById("gasto").style.background = "#F5FAA5";
				document.getElementById("gasto").style.color = "black";
				$("#gasto").css("font-weight","bold");

				document.getElementById("area").style.background = "#F5FAA5";
				document.getElementById("area").style.color = "black";
				$("#area").css("font-weight","bold");

				document.getElementById("caja").style.background = "#F5FAA5";
				document.getElementById("caja").style.color = "black";
				$("#caja").css("font-weight","bold");

				document.getElementById("editarGasto").style.background = "#F5FAA5";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#F5FAA5";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#F5FAA5";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");				

			}else if(respuesta["tipo_gasto"] == "14"){

				document.getElementById("gasto").style.background = "#DFB6F9";
				document.getElementById("gasto").style.color = "black";
				$("#gasto").css("font-weight","bold");

				document.getElementById("area").style.background = "#DFB6F9";
				document.getElementById("area").style.color = "black";
				$("#area").css("font-weight","bold");

				document.getElementById("caja").style.background = "#DFB6F9";
				document.getElementById("caja").style.color = "black";
				$("#caja").css("font-weight","bold");

				document.getElementById("editarGasto").style.background = "#DFB6F9";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#DFB6F9";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#DFB6F9";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");				

			}

			
 
		}
  
	}) 

})


/* 
*EDITAR GASTO
*/
$(".TablaGastosCaja tbody").on("click", "button.btnEditarGasto", function(){

	var idGasto = $(this).attr("idGasto");
	//console.log(idGasto);

	var datos = new FormData();
	datos.append("idGasto", idGasto);

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

			$("#id").val(respuesta["id"]);

			$("#editarFechaGasto").val(respuesta["fecha"]);
			$("#editarRecibo").val(respuesta["recibo"]);
			$("#editarSucursal").val(respuesta["sucursal"]);
			$("#editarSucursal").selectpicker("refresh");
			$("#editarRucProC").val(respuesta["ruc_proveedor"]);
			$("#editarRazPro").val(respuesta["proveedor"]);
			$("#editarTipo").val(respuesta["tipo_documento"]);
			$("#editarTipo").selectpicker("refresh");
			$("#editarDocumentoG").val(respuesta["documento"]);
			$("#editarCodCaja").val(respuesta["cod_caja"]);
			$("#editarCodCaja").selectpicker("refresh");
			$("#editarTotal").val(respuesta["total"]);
			$("#totalAntiguo").val(respuesta["total"]);

			$("#editarGasto").val(respuesta["nombre_gasto"]);
			$("#editarArea").val(respuesta["nombre_area"]);
			$("#editarCaja").val(respuesta["nom_caja"]);

			if(respuesta["tipo_gasto"] == "94"){

				document.getElementById("editarGasto").style.background = "#52BE80";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#52BE80";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#52BE80";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");

			}else if(respuesta["tipo_gasto"] == "95"){

				document.getElementById("editarGasto").style.background = "#52BEB4";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#52BEB4";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#52BEB4";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");

			}else if(respuesta["tipo_gasto"] == "92"){

				document.getElementById("editarGasto").style.background = "#F4596F";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#F4596F";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#F4596F";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");

			}else if(respuesta["tipo_gasto"] == "97"){

				document.getElementById("editarGasto").style.background = "#5F86F8";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#5F86F8";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#5F86F8";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");

			}else if(respuesta["tipo_gasto"] == "60"){

				document.getElementById("editarGasto").style.background = "#CCF459";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#CCF459";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#CCF459";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");

			}else if(respuesta["tipo_gasto"] == "10"){

				document.getElementById("editarGasto").style.background = "#AAE1FF";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#AAE1FF";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#AAE1FF";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");

			}else if(respuesta["tipo_gasto"] == "11"){

				document.getElementById("editarGasto").style.background = "#DDDAD6";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#DDDAD6";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#DDDAD6";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");

			}else if(respuesta["tipo_gasto"] == "12"){

				document.getElementById("editarGasto").style.background = "#FFCFE8";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#FFCFE8";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#FFCFE8";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");

			}else if(respuesta["tipo_gasto"] == "13"){

				document.getElementById("editarGasto").style.background = "#F5FAA5";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#F5FAA5";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#F5FAA5";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");

			}else if(respuesta["tipo_gasto"] == "14"){

				document.getElementById("editarGasto").style.background = "#DFB6F9";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#DFB6F9";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#DFB6F9";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");

			}
			
			$("#editarSolicitante").val(respuesta["solicitante"]);
			$("#editarDescripcion").val(respuesta["desc_salida"]);
			$("#editarRubro").val(respuesta["rubro_cancelacion"]);
			$("#editarObservacion").val(respuesta["observacion"]);



		}
  
	})	
})

$(".TablaGastosCaja").on("click",".btnAnularGasto",function(){
	var idGasto = $(this).attr("idGasto");
 
	// Capturamos el id de la orden de compra
	swal({
        title: '¿Está seguro de anular el gasto '+idGasto+'?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, anular gasto!'
    }).then(function (result) {

      if (result.value) {

        window.location = "index.php?ruta=gastos-caja&idGasto="+idGasto;

		  }
	})

});