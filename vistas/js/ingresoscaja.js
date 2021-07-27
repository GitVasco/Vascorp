/*=============================================
CARGAR LA TABLA DINÁMICA DE GASTOS
=============================================*/
if(localStorage.getItem("mesI") != null) {

    cargarTablaIngresosCaja(localStorage.getItem("mesI"));
    cargarTablaIngresosVendedor(localStorage.getItem("mesI"));

	if(localStorage.getItem("mesI") == "1"){

		$(".btnEneI").removeClass("btn-default");
		$(".btnEneI").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesI", localStorage.getItem("mesI"));
  
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

	}else if(localStorage.getItem("mesI") == "2"){

		$(".btnFebI").removeClass("btn-default");
		$(".btnFebI").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesI", localStorage.getItem("mesI"));
  
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

	}else if(localStorage.getItem("mesI") == "3"){

		$(".btnMarI").removeClass("btn-default");
		$(".btnMarI").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesI", localStorage.getItem("mesI"));
  
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

	}else if(localStorage.getItem("mesI") == "4"){

		$(".btnAbrI").removeClass("btn-default");
		$(".btnAbrI").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesI", localStorage.getItem("mesI"));
  
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

	}else if(localStorage.getItem("mesI") == "5"){

		$(".btnMayI").removeClass("btn-default");
		$(".btnMayI").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesI", localStorage.getItem("mesI"));
  
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

	}else if(localStorage.getItem("mesI") == "6"){

		$(".btnJunI").removeClass("btn-default");
		$(".btnJunI").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesI", localStorage.getItem("mesI"));
  
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

	}else if(localStorage.getItem("mesI") == "7"){

		$(".btnJulI").removeClass("btn-default");
		$(".btnJulI").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesI", localStorage.getItem("mesI"));
  
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

	}else if(localStorage.getItem("mesI") == "8"){

		$(".btnAgoI").removeClass("btn-default");
		$(".btnAgoI").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesI", localStorage.getItem("mesI"));
  
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

	}else if(localStorage.getItem("mesI") == "9"){

		$(".btnSepI").removeClass("btn-default");
		$(".btnSepI").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesI", localStorage.getItem("mesI"));
  
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

	}else if(localStorage.getItem("mesI") == "10"){

		$(".btnOctI").removeClass("btn-default");
		$(".btnOctI").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesI", localStorage.getItem("mesI"));
  
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

	}else if(localStorage.getItem("mesI") == "11"){

		$(".btnNovI").removeClass("btn-default");
		$(".btnNovI").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesI", localStorage.getItem("mesI"));
  
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

	}else if(localStorage.getItem("mesI") == "12"){

		$(".btnDicI").removeClass("btn-default");
		$(".btnDicI").addClass("btn-info");

		var datos = new FormData();
		datos.append("mesI", localStorage.getItem("mesI"));
  
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

}else{

    const fecha = new Date();
	const mesI = fecha.getMonth() + 1; 

	if(mesI == "1"){

		$(".btnEneI").removeClass("btn-default");
		$(".btnEneI").addClass("btn-info");
	}else if(mesI == "2"){

		$(".btnFebI").removeClass("btn-default");
		$(".btnFebI").addClass("btn-info");
	}else if(mesI == "3"){

		$(".btnMarI").removeClass("btn-default");
		$(".btnMarI").addClass("btn-info");
	}else if(mesI == "4"){

		$(".btnAbrI").removeClass("btn-default");
		$(".btnAbrI").addClass("btn-info");
	}else if(mesI == "5"){

		$(".btnMayI").removeClass("btn-default");
		$(".btnMayI").addClass("btn-info");
	}else if(mesI == "6"){

		$(".btnJunI").removeClass("btn-default");
		$(".btnJunI").addClass("btn-info");
	}else if(mesI == "7"){

		$(".btnJulI").removeClass("btn-default");
		$(".btnJulI").addClass("btn-info");
	}else if(mesI == "8"){

		$(".btnAgoI").removeClass("btn-default");
		$(".btnAgoI").addClass("btn-info");
	}else if(mesI == "9"){

		$(".btnSepI").removeClass("btn-default");
		$(".btnSepI").addClass("btn-info");
	}else if(mesI == "10"){

		$(".btnOctI").removeClass("btn-default");
		$(".btnOctI").addClass("btn-info");
	}else if(mesI == "11"){

		$(".btnNovI").removeClass("btn-default");
		$(".btnNovI").addClass("btn-info");
	}else if(mesI == "12"){

		$(".btnDicI").removeClass("btn-default");
		$(".btnDicI").addClass("btn-info");
	}

}

$(".btnEneI").click(function(){
	var mesI = document.getElementById("btnEneI").value;
	//console.log(mesI);

	var datos = new FormData();
	datos.append("mesG", mesI);

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

	$(".btnFebI").removeClass("btn-info");
	$(".btnFebI").addClass("btn-default");

	$(".btnMarI").removeClass("btn-info");
	$(".btnMarI").addClass("btn-default");

	$(".btnAbrI").removeClass("btn-info");
	$(".btnAbrI").addClass("btn-default");

	$(".btnMayI").removeClass("btn-info");
	$(".btnMayI").addClass("btn-default");

	$(".btnJunI").removeClass("btn-info");
	$(".btnJunI").addClass("btn-default");

	$(".btnJulI").removeClass("btn-info");
	$(".btnJulI").addClass("btn-default");

	$(".btnAgoI").removeClass("btn-info");
	$(".btnAgoI").addClass("btn-default");

	$(".btnSepI").removeClass("btn-info");
	$(".btnSepI").addClass("btn-default");

	$(".btnOctI").removeClass("btn-info");
	$(".btnOctI").addClass("btn-default");

	$(".btnNovI").removeClass("btn-info");
	$(".btnNovI").addClass("btn-default");

	$(".btnDicI").removeClass("btn-info");
	$(".btnDicI").addClass("btn-default");

	localStorage.setItem("mesI", mesI);
	$(".TablaIngresosCaja").DataTable().destroy();
    $(".TablaIngresosVendedor").DataTable().destroy();
    cargarTablaIngresosCaja(localStorage.getItem("mesI"));
    cargarTablaIngresosVendedor(localStorage.getItem("mesI"));
})
$(".btnFebI").click(function(){
	var mesI = document.getElementById("btnFebI").value;
	//console.log(mesI);

	var datos = new FormData();
	datos.append("mesG", mesI);

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

	$(".btnEneI").removeClass("btn-info");
	$(".btnEneI").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnMarI").removeClass("btn-info");
	$(".btnMarI").addClass("btn-default");

	$(".btnAbrI").removeClass("btn-info");
	$(".btnAbrI").addClass("btn-default");

	$(".btnMayI").removeClass("btn-info");
	$(".btnMayI").addClass("btn-default");

	$(".btnJunI").removeClass("btn-info");
	$(".btnJunI").addClass("btn-default");

	$(".btnJulI").removeClass("btn-info");
	$(".btnJulI").addClass("btn-default");

	$(".btnAgoI").removeClass("btn-info");
	$(".btnAgoI").addClass("btn-default");

	$(".btnSepI").removeClass("btn-info");
	$(".btnSepI").addClass("btn-default");

	$(".btnOctI").removeClass("btn-info");
	$(".btnOctI").addClass("btn-default");

	$(".btnNovI").removeClass("btn-info");
	$(".btnNovI").addClass("btn-default");

	$(".btnDicI").removeClass("btn-info");
	$(".btnDicI").addClass("btn-default");

	localStorage.setItem("mesI", mesI);
	$(".TablaIngresosCaja").DataTable().destroy();
    $(".TablaIngresosVendedor").DataTable().destroy();
    cargarTablaIngresosCaja(localStorage.getItem("mesI"));
    cargarTablaIngresosVendedor(localStorage.getItem("mesI"));

})
$(".btnMarI").click(function(){
	var mesI = document.getElementById("btnMarI").value;
	//console.log(mesI);

	var datos = new FormData();
	datos.append("mesG", mesI);

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

	$(".btnEneI").removeClass("btn-info");
	$(".btnEneI").addClass("btn-default");

	$(".btnFebI").removeClass("btn-info");
	$(".btnFebI").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnAbrI").removeClass("btn-info");
	$(".btnAbrI").addClass("btn-default");

	$(".btnMayI").removeClass("btn-info");
	$(".btnMayI").addClass("btn-default");

	$(".btnJunI").removeClass("btn-info");
	$(".btnJunI").addClass("btn-default");

	$(".btnJulI").removeClass("btn-info");
	$(".btnJulI").addClass("btn-default");

	$(".btnAgoI").removeClass("btn-info");
	$(".btnAgoI").addClass("btn-default");

	$(".btnSepI").removeClass("btn-info");
	$(".btnSepI").addClass("btn-default");

	$(".btnOctI").removeClass("btn-info");
	$(".btnOctI").addClass("btn-default");

	$(".btnNovI").removeClass("btn-info");
	$(".btnNovI").addClass("btn-default");

	$(".btnDicI").removeClass("btn-info");
	$(".btnDicI").addClass("btn-default");

	localStorage.setItem("mesI", mesI);
	$(".TablaIngresosCaja").DataTable().destroy();
    $(".TablaIngresosVendedor").DataTable().destroy();
    cargarTablaIngresosCaja(localStorage.getItem("mesI"));
    cargarTablaIngresosVendedor(localStorage.getItem("mesI"));

})
$(".btnAbrI").click(function(){
	var mesI = document.getElementById("btnAbrI").value;
	//console.log(mesI);

	var datos = new FormData();
	datos.append("mesG", mesI);

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

	$(".btnEneI").removeClass("btn-info");
	$(".btnEneI").addClass("btn-default");

	$(".btnFebI").removeClass("btn-info");
	$(".btnFebI").addClass("btn-default");

	$(".btnMarI").removeClass("btn-info");
	$(".btnMarI").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnMayI").removeClass("btn-info");
	$(".btnMayI").addClass("btn-default");

	$(".btnJunI").removeClass("btn-info");
	$(".btnJunI").addClass("btn-default");

	$(".btnJulI").removeClass("btn-info");
	$(".btnJulI").addClass("btn-default");

	$(".btnAgoI").removeClass("btn-info");
	$(".btnAgoI").addClass("btn-default");

	$(".btnSepI").removeClass("btn-info");
	$(".btnSepI").addClass("btn-default");

	$(".btnOctI").removeClass("btn-info");
	$(".btnOctI").addClass("btn-default");

	$(".btnNovI").removeClass("btn-info");
	$(".btnNovI").addClass("btn-default");

	$(".btnDicI").removeClass("btn-info");
	$(".btnDicI").addClass("btn-default");

	localStorage.setItem("mesI", mesI);
	$(".TablaIngresosCaja").DataTable().destroy();
    $(".TablaIngresosVendedor").DataTable().destroy();
    cargarTablaIngresosCaja(localStorage.getItem("mesI"));
    cargarTablaIngresosVendedor(localStorage.getItem("mesI"));

})
$(".btnMayI").click(function(){
	var mesI = document.getElementById("btnMayI").value;
	//console.log(mesI);

	var datos = new FormData();
	datos.append("mesG", mesI);

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

	$(".btnEneI").removeClass("btn-info");
	$(".btnEneI").addClass("btn-default");

	$(".btnFebI").removeClass("btn-info");
	$(".btnFebI").addClass("btn-default");

	$(".btnMarI").removeClass("btn-info");
	$(".btnMarI").addClass("btn-default");

	$(".btnAbrI").removeClass("btn-info");
	$(".btnAbrI").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnJunI").removeClass("btn-info");
	$(".btnJunI").addClass("btn-default");

	$(".btnJulI").removeClass("btn-info");
	$(".btnJulI").addClass("btn-default");

	$(".btnAgoI").removeClass("btn-info");
	$(".btnAgoI").addClass("btn-default");

	$(".btnSepI").removeClass("btn-info");
	$(".btnSepI").addClass("btn-default");

	$(".btnOctI").removeClass("btn-info");
	$(".btnOctI").addClass("btn-default");

	$(".btnNovI").removeClass("btn-info");
	$(".btnNovI").addClass("btn-default");

	$(".btnDicI").removeClass("btn-info");
	$(".btnDicI").addClass("btn-default");

	localStorage.setItem("mesI", mesI);
	$(".TablaIngresosCaja").DataTable().destroy();
    $(".TablaIngresosVendedor").DataTable().destroy();
    cargarTablaIngresosCaja(localStorage.getItem("mesI"));
    cargarTablaIngresosVendedor(localStorage.getItem("mesI"));

})
$(".btnJunI").click(function(){
	var mesI = document.getElementById("btnJunI").value;
	//console.log(mesI);

	  var datos = new FormData();
	  datos.append("mesG", mesI);

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

	$(".btnEneI").removeClass("btn-info");
	$(".btnEneI").addClass("btn-default");

	$(".btnFebI").removeClass("btn-info");
	$(".btnFebI").addClass("btn-default");

	$(".btnMarI").removeClass("btn-info");
	$(".btnMarI").addClass("btn-default");

	$(".btnAbrI").removeClass("btn-info");
	$(".btnAbrI").addClass("btn-default");

	$(".btnMayI").removeClass("btn-info");
	$(".btnMayI").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnJulI").removeClass("btn-info");
	$(".btnJulI").addClass("btn-default");

	$(".btnAgoI").removeClass("btn-info");
	$(".btnAgoI").addClass("btn-default");

	$(".btnSepI").removeClass("btn-info");
	$(".btnSepI").addClass("btn-default");

	$(".btnOctI").removeClass("btn-info");
	$(".btnOctI").addClass("btn-default");

	$(".btnNovI").removeClass("btn-info");
	$(".btnNovI").addClass("btn-default");

	$(".btnDicI").removeClass("btn-info");
	$(".btnDicI").addClass("btn-default");

	localStorage.setItem("mesI", mesI);
	$(".TablaIngresosCaja").DataTable().destroy();
    $(".TablaIngresosVendedor").DataTable().destroy();
    cargarTablaIngresosCaja(localStorage.getItem("mesI"));
    cargarTablaIngresosVendedor(localStorage.getItem("mesI"));

})
$(".btnJulI").click(function(){
	var mesI = document.getElementById("btnJulI").value;
	//console.log(mesI);

	var datos = new FormData();
	datos.append("mesG", mesI);

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

	$(".btnEneI").removeClass("btn-info");
	$(".btnEneI").addClass("btn-default");

	$(".btnFebI").removeClass("btn-info");
	$(".btnFebI").addClass("btn-default");

	$(".btnMarI").removeClass("btn-info");
	$(".btnMarI").addClass("btn-default");

	$(".btnAbrI").removeClass("btn-info");
	$(".btnAbrI").addClass("btn-default");

	$(".btnMayI").removeClass("btn-info");
	$(".btnMayI").addClass("btn-default");

	$(".btnJunI").removeClass("btn-info");
	$(".btnJunI").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnAgoI").removeClass("btn-info");
	$(".btnAgoI").addClass("btn-default");

	$(".btnSepI").removeClass("btn-info");
	$(".btnSepI").addClass("btn-default");

	$(".btnOctI").removeClass("btn-info");
	$(".btnOctI").addClass("btn-default");

	$(".btnNovI").removeClass("btn-info");
	$(".btnNovI").addClass("btn-default");

	$(".btnDicI").removeClass("btn-info");
	$(".btnDicI").addClass("btn-default");

	localStorage.setItem("mesI", mesI);
	$(".TablaIngresosCaja").DataTable().destroy();
    $(".TablaIngresosVendedor").DataTable().destroy();
    cargarTablaIngresosCaja(localStorage.getItem("mesI"));
    cargarTablaIngresosVendedor(localStorage.getItem("mesI"));

})
$(".btnAgoI").click(function(){
	var mesI = document.getElementById("btnAgoI").value;
	//console.log(mesI);

	var datos = new FormData();
	datos.append("mesG", mesI);

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

	$(".btnEneI").removeClass("btn-info");
	$(".btnEneI").addClass("btn-default");

	$(".btnFebI").removeClass("btn-info");
	$(".btnFebI").addClass("btn-default");

	$(".btnMarI").removeClass("btn-info");
	$(".btnMarI").addClass("btn-default");

	$(".btnAbrI").removeClass("btn-info");
	$(".btnAbrI").addClass("btn-default");

	$(".btnMayI").removeClass("btn-info");
	$(".btnMayI").addClass("btn-default");

	$(".btnJunI").removeClass("btn-info");
	$(".btnJunI").addClass("btn-default");

	$(".btnJulI").removeClass("btn-info");
	$(".btnJulI").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnSepI").removeClass("btn-info");
	$(".btnSepI").addClass("btn-default");

	$(".btnOctI").removeClass("btn-info");
	$(".btnOctI").addClass("btn-default");

	$(".btnNovI").removeClass("btn-info");
	$(".btnNovI").addClass("btn-default");

	$(".btnDicI").removeClass("btn-info");
	$(".btnDicI").addClass("btn-default");

	localStorage.setItem("mesI", mesI);
	$(".TablaIngresosCaja").DataTable().destroy();
    $(".TablaIngresosVendedor").DataTable().destroy();
    cargarTablaIngresosCaja(localStorage.getItem("mesI"));
    cargarTablaIngresosVendedor(localStorage.getItem("mesI"));

})
$(".btnSepI").click(function(){
	var mesI = document.getElementById("btnSepI").value;
	//console.log(mesI);

	var datos = new FormData();
	datos.append("mesG", mesI);

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

	$(".btnEneI").removeClass("btn-info");
	$(".btnEneI").addClass("btn-default");

	$(".btnFebI").removeClass("btn-info");
	$(".btnFebI").addClass("btn-default");

	$(".btnMarI").removeClass("btn-info");
	$(".btnMarI").addClass("btn-default");

	$(".btnAbrI").removeClass("btn-info");
	$(".btnAbrI").addClass("btn-default");

	$(".btnMayI").removeClass("btn-info");
	$(".btnMayI").addClass("btn-default");

	$(".btnJunI").removeClass("btn-info");
	$(".btnJunI").addClass("btn-default");

	$(".btnJulI").removeClass("btn-info");
	$(".btnJulI").addClass("btn-default");

	$(".btnAgoI").removeClass("btn-info");
	$(".btnAgoI").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnOctI").removeClass("btn-info");
	$(".btnOctI").addClass("btn-default");

	$(".btnNovI").removeClass("btn-info");
	$(".btnNovI").addClass("btn-default");

	$(".btnDicI").removeClass("btn-info");
	$(".btnDicI").addClass("btn-default");

	localStorage.setItem("mesI", mesI);
	$(".TablaIngresosCaja").DataTable().destroy();
    $(".TablaIngresosVendedor").DataTable().destroy();
    cargarTablaIngresosCaja(localStorage.getItem("mesI"));
    cargarTablaIngresosVendedor(localStorage.getItem("mesI"));

})
$(".btnOctI").click(function(){
	var mesI = document.getElementById("btnOctI").value;
	//console.log(mesI);

	var datos = new FormData();
	datos.append("mesG", mesI);

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

	$(".btnEneI").removeClass("btn-info");
	$(".btnEneI").addClass("btn-default");

	$(".btnFebI").removeClass("btn-info");
	$(".btnFebI").addClass("btn-default");

	$(".btnMarI").removeClass("btn-info");
	$(".btnMarI").addClass("btn-default");

	$(".btnAbrI").removeClass("btn-info");
	$(".btnAbrI").addClass("btn-default");

	$(".btnMayI").removeClass("btn-info");
	$(".btnMayI").addClass("btn-default");

	$(".btnJunI").removeClass("btn-info");
	$(".btnJunI").addClass("btn-default");

	$(".btnJulI").removeClass("btn-info");
	$(".btnJulI").addClass("btn-default");

	$(".btnAgoI").removeClass("btn-info");
	$(".btnAgoI").addClass("btn-default");

	$(".btnSepI").removeClass("btn-info");
	$(".btnSepI").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnNovI").removeClass("btn-info");
	$(".btnNovI").addClass("btn-default");

	$(".btnDicI").removeClass("btn-info");
	$(".btnDicI").addClass("btn-default");

	localStorage.setItem("mesI", mesI);
	$(".TablaIngresosCaja").DataTable().destroy();
    $(".TablaIngresosVendedor").DataTable().destroy();
    cargarTablaIngresosCaja(localStorage.getItem("mesI"));
    cargarTablaIngresosVendedor(localStorage.getItem("mesI"));

})
$(".btnNovI").click(function(){
	var mesI = document.getElementById("btnNovI").value;
	//console.log(mesI);

	var datos = new FormData();
	datos.append("mesG", mesI);

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

	$(".btnEneI").removeClass("btn-info");
	$(".btnEneI").addClass("btn-default");

	$(".btnFebI").removeClass("btn-info");
	$(".btnFebI").addClass("btn-default");

	$(".btnMarI").removeClass("btn-info");
	$(".btnMarI").addClass("btn-default");

	$(".btnAbrI").removeClass("btn-info");
	$(".btnAbrI").addClass("btn-default");

	$(".btnMayI").removeClass("btn-info");
	$(".btnMayI").addClass("btn-default");

	$(".btnJunI").removeClass("btn-info");
	$(".btnJunI").addClass("btn-default");

	$(".btnJulI").removeClass("btn-info");
	$(".btnJulI").addClass("btn-default");

	$(".btnAgoI").removeClass("btn-info");
	$(".btnAgoI").addClass("btn-default");

	$(".btnSepI").removeClass("btn-info");
	$(".btnSepI").addClass("btn-default");

	$(".btnOctI").removeClass("btn-info");
	$(".btnOctI").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnDicI").removeClass("btn-info");
	$(".btnDicI").addClass("btn-default");

	localStorage.setItem("mesI", mesI);
	$(".TablaIngresosCaja").DataTable().destroy();
    $(".TablaIngresosVendedor").DataTable().destroy();
    cargarTablaIngresosCaja(localStorage.getItem("mesI"));
    cargarTablaIngresosVendedor(localStorage.getItem("mesI"));

})
$(".btnDicI").click(function(){
	var mesI = document.getElementById("btnDicI").value;
	//console.log(mesI);

	var datos = new FormData();
	datos.append("mesG", mesI);

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

	$(".btnEneI").removeClass("btn-info");
	$(".btnEneI").addClass("btn-default");

	$(".btnFebI").removeClass("btn-info");
	$(".btnFebI").addClass("btn-default");

	$(".btnMarI").removeClass("btn-info");
	$(".btnMarI").addClass("btn-default");

	$(".btnAbrI").removeClass("btn-info");
	$(".btnAbrI").addClass("btn-default");

	$(".btnMayI").removeClass("btn-info");
	$(".btnMayI").addClass("btn-default");

	$(".btnJunI").removeClass("btn-info");
	$(".btnJunI").addClass("btn-default");

	$(".btnJulI").removeClass("btn-info");
	$(".btnJulI").addClass("btn-default");

	$(".btnAgoI").removeClass("btn-info");
	$(".btnAgoI").addClass("btn-default");

	$(".btnSepI").removeClass("btn-info");
	$(".btnSepI").addClass("btn-default");

	$(".btnOctI").removeClass("btn-info");
	$(".btnOctI").addClass("btn-default");

	$(".btnNovI").removeClass("btn-info");
	$(".btnNovI").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	localStorage.setItem("mesI", mesI);
	$(".TablaIngresosCaja").DataTable().destroy();
    $(".TablaIngresosVendedor").DataTable().destroy();
    cargarTablaIngresosCaja(localStorage.getItem("mesI"));
    cargarTablaIngresosVendedor(localStorage.getItem("mesI"));

})

function cargarTablaIngresosCaja(mesI){

    $(".TablaIngresosCaja").DataTable({
        ajax: "ajax/centrocostos/tabla-ingresos-caja.ajax.php?mesI=" + mesI,
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
            if(data[1] == "01"){
                $('td',row).eq(1).css({
                    'background-color':'#AAE1FF',
                    'color':'black'
                })
                $('td',row).eq(2).css({
                    'background-color':'#AAE1FF',
                    'color':'black'
                })
            }else if (data[1] == "02"){
                $('td',row).eq(1).css({
                    'background-color':'#52BEB4',
                    'color':'black'
                })
                $('td',row).eq(2).css({
                    'background-color':'#52BEB4',
                    'color':'black'
                })
            }else if (data[1] == "03"){
                $('td',row).eq(1).css({
                    'background-color':'#DDDAD6',
                    'color':'black'
                })
                $('td',row).eq(2).css({
                    'background-color':'#DDDAD6',
                    'color':'black'
                })
            }else if (data[1] == "04"){
                $('td',row).eq(1).css({
                    'background-color':'#CCF459',
                    'color':'black'
                })
                $('td',row).eq(2).css({
                    'background-color':'#CCF459',
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


function cargarTablaIngresosVendedor(mesI){

    $(".TablaIngresosVendedor").DataTable({
        ajax: "ajax/centrocostos/tabla-ingresos-vendedor.ajax.php?mesI=" + mesI,
        deferRender: true,
        retrieve: true,
        processing: true,
        searching: false,
        order: [[0, "asc"]],
        "pageLength": 20,
        "lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
        language: {
            sProcessing: "Procesando...",
            sLengthMenu: "Mostrar _MENU_",
            sZeroRecords: "No se encontraron resultados",
            sEmptyTable: "Ningún dato disponible en esta tabla",
            sInfo: "Del _START_ al _END_ de _TOTAL_",
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
            sNext: ">>>",
            sPrevious: "<<<"
            },
            oAria: {
            sSortAscending: ": Activar para ordenar la columna de manera ascendente",
            sSortDescending: ": Activar para ordenar la columna de manera descendente"
            }
        }
    
    });

}

$("#nuevoCodIng, #editarCodIng").change(function(){

	var cod_ingreso = $(this).val();
	console.log(cod_ingreso);
	
	if(cod_ingreso == "01"){

		document.getElementById("nuevoCodIng").style.background = "#AAE1FF";
		document.getElementById("nuevoCodIng").style.color = "black";
		$("#nuevoCodIng").css("font-weight","bold");

		document.getElementById("editarCodIng").style.background = "#AAE1FF";
		document.getElementById("editarCodIng").style.color = "black";
		$("#editarCodIng").css("font-weight","bold");
		
	}else if(cod_ingreso == "02"){

		document.getElementById("nuevoCodIng").style.background = "#52BEB4";
		document.getElementById("nuevoCodIng").style.color = "black";
		$("#nuevoCodIng").css("font-weight","bold");

		document.getElementById("editarCodIng").style.background = "#52BEB4";
		document.getElementById("editarCodIng").style.color = "black";
		$("#editarCodIng").css("font-weight","bold");
		
	}else if(cod_ingreso == "03"){

		document.getElementById("nuevoCodIng").style.background = "#DDDAD6";
		document.getElementById("nuevoCodIng").style.color = "black";
		$("#nuevoCodIng").css("font-weight","bold");

		document.getElementById("editarCodIng").style.background = "#DDDAD6";
		document.getElementById("editarCodIng").style.color = "black";
		$("#editarCodIng").css("font-weight","bold");
				
	}else if(cod_ingreso == "04"){

		document.getElementById("nuevoCodIng").style.background = "#CCF459";
		document.getElementById("nuevoCodIng").style.color = "black";
		$("#nuevoCodIng").css("font-weight","bold");

		document.getElementById("editarCodIng").style.background = "#CCF459";
		document.getElementById("editarCodIng").style.color = "black";
		$("#editarCodIng").css("font-weight","bold");
				
	}
	

})

/* 
*EDITAR GASTO
*/
$(".TablaIngresosCaja tbody").on("click", "button.btnEditarIngreso", function(){

	var idIngreso = $(this).attr("idIngreso");
	//console.log(idIngreso);

	var datos = new FormData();
	datos.append("idIngreso", idIngreso);

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

			$("#editarFechaIngreso").val(respuesta["fecha"]);
			$("#editarCodIng").val(respuesta["cod_ingreso"]);
			$("#editarResp").val(respuesta["cod_responsable"]);
			$("#editarResp").selectpicker("refresh");
			$("#editarTotal").val(respuesta["total"]);
			$("#totalAntiguo").val(respuesta["total"]);
			$("#editarTipo").val(respuesta["tipo_documento"]);
			$("#editarTipo").selectpicker("refresh");
			$("#editarDocumentoI").val(respuesta["documento"]);
			$("#editarObservacion").val(respuesta["observacion"]);

			if(respuesta["cod_ingreso"] == "01"){

				document.getElementById("editarCodIng").style.background = "#AAE1FF";
				document.getElementById("editarCodIng").style.color = "black";
				$("#editarCodIng").css("font-weight","bold");
				
			}else if(respuesta["cod_ingreso"] == "02"){
		
				document.getElementById("editarCodIng").style.background = "#52BEB4";
				document.getElementById("editarCodIng").style.color = "black";
				$("#editarCodIng").css("font-weight","bold");
				
			}else if(respuesta["cod_ingreso"] == "03"){
		
				document.getElementById("editarCodIng").style.background = "#DDDAD6";
				document.getElementById("editarCodIng").style.color = "black";
				$("#editarCodIng").css("font-weight","bold");
						
			}else if(respuesta["cod_ingreso"] == "04"){
		
				document.getElementById("editarCodIng").style.background = "#CCF459";
				document.getElementById("editarCodIng").style.color = "black";
				$("#editarCodIng").css("font-weight","bold");
						
			}

		}  
	})
})

$(".TablaIngresosCaja").on("click",".btnAnularIngreso",function(){
	var idIngreso = $(this).attr("idIngreso");
	console.log(idIngreso);
 
	// Capturamos el id de la orden de compra
	swal({
        title: '¿Está seguro de anular el Ingreso?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, anular ingreso!'
    }).then(function (result) {

		if (result.value) {

			window.location = "index.php?ruta=ingresos-caja&idIngreso="+idIngreso;

		}
	})

});