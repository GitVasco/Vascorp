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