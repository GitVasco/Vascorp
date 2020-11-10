<?php

/* 
* CONTROLADORES
*/

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/ventas.controlador.php";

require_once "controladores/marcas.controlador.php";
require_once "controladores/colores.controlador.php";
require_once "controladores/articulos.controlador.php";
require_once "controladores/materiaprima.controlador.php";

require_once "controladores/tarjetas.controlador.php";
require_once "controladores/movimientos.controlador.php";

require_once "controladores/ordencorte.controlador.php";

require_once "controladores/contactos.controlador.php";
require_once "controladores/mensajes.controlador.php";

require_once "controladores/pedidos.controlador.php";

require_once "controladores/operaciones.controlador.php";

require_once "controladores/tipodocumento.controlador.php";

require_once "controladores/almacencorte.controlador.php";

require_once "controladores/tipotrabajador.controlador.php";
require_once "controladores/trabajador.controlador.php";

require_once "controladores/cortes.controlador.php";
require_once "controladores/talleres.controlador.php";

require_once "controladores/sectores.controlador.php";

require_once "controladores/produccion.controlador.php";

/* 
* MODELOS
*/


require_once "modelos/usuarios.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/ventas.modelo.php";

require_once "modelos/marcas.modelo.php";
require_once "modelos/colores.modelo.php";
require_once "modelos/articulos.modelo.php";
require_once "modelos/materiaprima.modelo.php";

require_once "modelos/tarjetas.modelo.php";
require_once "modelos/movimientos.modelo.php";

require_once "modelos/ordencorte.modelo.php";

require_once "modelos/contactos.modelo.php";
require_once "modelos/mensajes.modelo.php";

require_once "modelos/pedidos.modelo.php";

require_once "modelos/operaciones.modelo.php";

require_once "modelos/tipodocumento.modelo.php";

require_once "modelos/almacencorte.modelo.php";

require_once "modelos/tipotrabajador.modelo.php";
require_once "modelos/trabajador.modelo.php";

require_once "modelos/modelos.modelo.php";
require_once "controladores/modelos.controlador.php";

require_once "modelos/cortes.modelo.php";
require_once "modelos/talleres.modelo.php";

require_once "modelos/sectores.modelo.php";

require_once "modelos/paras.modelo.php";
require_once "controladores/paras.controlador.php";

require_once "modelos/asistencia.modelo.php";
require_once "controladores/asistencia.controlador.php";

require_once "modelos/ingresos.modelo.php";
require_once "controladores/ingresos.controlador.php";

require_once "modelos/agencia.modelo.php";
require_once "controladores/agencia.controlador.php";

require_once "modelos/produccion.modelo.php";


require_once "extensiones/vendor/autoload.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();