// ...
autoSessionTracking: false;
/* SIDE BAR MENU */

$(".sidebar-menu").tree();

$(".tablas").DataTable({
    pageLength: 25,
    lengthMenu: [
        [25, 50, 75, -1],
        [25, 50, 75, "Todos"],
    ],
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
            sPrevious: "Anterior",
        },
        oAria: {
            sSortAscending:
                ": Activar para ordenar la columna de manera ascendente",
            sSortDescending:
                ": Activar para ordenar la columna de manera descendente",
        },
    },
});

$(".tablasA").DataTable({
    searching: false,
    paging: false,
    ordering: false,
    info: false,
    lengthChange: false,
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
            sPrevious: "Anterior",
        },
        oAria: {
            sSortAscending:
                ": Activar para ordenar la columna de manera ascendente",
            sSortDescending:
                ": Activar para ordenar la columna de manera descendente",
        },
    },
});

/*=============================================
 //iCheck for checkbox and radio inputs
=============================================*/

$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: "icheckbox_minimal-blue",
    radioClass: "iradio_minimal-blue",
});

/*=============================================
 //input Mask
=============================================*/

//Datemask dd/mm/yyyy
$("#datemask").inputmask("dd/mm/yyyy", { placeholder: "dd/mm/yyyy" });
//Datemask2 mm/dd/yyyy
$("#datemask2").inputmask("mm/dd/yyyy", { placeholder: "mm/dd/yyyy" });
//Money Euro
$("[data-mask]").inputmask();

$(".money").mask("#,##0.00", { reverse: true });

/* SELECT2 */

/* 
$(document).ready(function(){
	$('#seleccionarCliente').select2();
}); */
window.addEventListener("beforeunload", function (e) {
    localStorage.removeItem("capturarRango");
    localStorage.removeItem("capturarRango3");
    localStorage.removeItem("capturarRango4");
    localStorage.removeItem("capturarRango6");
    localStorage.removeItem("capturarRango7");
    localStorage.removeItem("capturarRango9");
    localStorage.removeItem("capturarRango11");
    localStorage.removeItem("capturarRango12");
    localStorage.removeItem("envioLetras");
    // localStorage.removeItem("ano");
    // localStorage.removeItem("anoP");
    // localStorage.removeItem("anoC");
    // localStorage.removeItem("sectorIngreso");
});
//Libreria Toastr
toastr.options = {
    closeButton: false,
    debug: false,
    newestOnTop: false,
    progressBar: true,
    positionClass: "toast-top-right",
    preventDuplicates: false,
    onclick: null,
    showDuration: "300",
    hideDuration: "1000",
    timeOut: "2000",
    extendedTimeOut: "2000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut",
};

/*=============================================
Función para Notie Alert
=============================================*/

function fncNotie(type, text) {
    notie.alert({
        type: type,
        text: text,
        time: 5,
    });
}

/*=============================================
Función Sweetalert
=============================================*/

function fncSweetAlert(type, text, url) {
    switch (type) {
        /*=============================================
		Cuando ocurre un error
		=============================================*/

        case "error":
            if (url == null) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: text,
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: text,
                }).then((result) => {
                    if (result.value) {
                        window.open(url, "_top");
                    }
                });
            }

            break;

        /*=============================================
		Cuando es correcto
		=============================================*/

        case "success":
            if (url == null) {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: text,
                });
            } else {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: text,
                }).then((result) => {
                    if (result.value) {
                        window.open(url, "_top");
                    }
                });
            }

            break;

        /*=============================================
		Cuando estamos precargando
		=============================================*/

        case "loading":
            Swal.fire({
                allowOutsideClick: false,
                icon: "info",
                text: text,
            });
            Swal.showLoading();

            break;

        /*=============================================
		Cuando necesitamos cerrar la alerta suave
		=============================================*/

        case "close":
            Swal.close();

            break;

        /*=============================================
		Cuando solicitamos confirmación
		=============================================*/

        case "confirm":
            return new Promise((resolve) => {
                Swal.fire({
                    text: text,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "Cancel",
                    confirmButtonText: "Yes, delete!",
                }).then(function (result) {
                    resolve(result.value);
                });
            });

            break;
    }
}

/*=============================================
Función Material Preload
=============================================*/

function matPreloader(type) {
    var preloader = new $.materialPreloader({
        position: "top",
        height: "5px",
        col_1: "#159756",
        col_2: "#da4733",
        col_3: "#3b78e7",
        col_4: "#fdba2c",
        fadeIn: 200,
        fadeOut: 200,
    });

    if (type == "on") {
        preloader.on();
    }

    if (type == "off") {
        $(".load-bar-container").remove();
    }
}

/*=============================================
Función para formatear Inputs
=============================================*/

function fncFormatInputs() {
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
}
