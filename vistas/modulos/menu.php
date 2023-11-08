<aside class="main-sidebar">

    <section class="sidebar">

        <ul class="sidebar-menu">

            <?php
            $item = "idusuario";
            $valor = $_SESSION["id"];
            $permisos = ControladorUsuarios::ctrMostrarUsuariosPermisos($item, $valor);
            $valores = array();
            foreach ($permisos as $key => $value) {
                array_push($valores, $value["idpermiso"]);
            }
            in_array(1, $valores) ? $_SESSION['escritorio'] = 1 : $_SESSION['escritorio'] = 0;
            in_array(2, $valores) ? $_SESSION['analisis'] = 1 : $_SESSION['analisis'] = 0;
            in_array(3, $valores) ? $_SESSION['usuarios'] = 1 : $_SESSION['usuarios'] = 0;
            in_array(4, $valores) ? $_SESSION['backend'] = 1 : $_SESSION['backend'] = 0;
            in_array(5, $valores) ? $_SESSION['movimientos'] = 1 : $_SESSION['movimientos'] = 0;
            in_array(6, $valores) ? $_SESSION['maestros'] = 1 : $_SESSION['maestros'] = 0;
            in_array(7, $valores) ? $_SESSION['produccion'] = 1 : $_SESSION['produccion'] = 0;
            in_array(8, $valores) ? $_SESSION['tarjetas'] = 1 : $_SESSION['tarjetas'] = 0;
            in_array(9, $valores) ? $_SESSION['operaciones'] = 1 : $_SESSION['operaciones'] = 0;
            in_array(10, $valores) ? $_SESSION['materiaprima'] = 1 : $_SESSION['materiaprima'] = 0;
            in_array(11, $valores) ? $_SESSION['ventas'] = 1 : $_SESSION['ventas'] = 0;
            in_array(12, $valores) ? $_SESSION['facturacion'] = 1 : $_SESSION['facturacion'] = 0;
            in_array(13, $valores) ? $_SESSION['ticket'] = 1 : $_SESSION['ticket'] = 0;
            in_array(14, $valores) ? $_SESSION['cuenta'] = 1 : $_SESSION['cuenta'] = 0;
            in_array(15, $valores) ? $_SESSION['costos'] = 1 : $_SESSION['costos'] = 0;
            in_array(16, $valores) ? $_SESSION['caja'] = 1 : $_SESSION['caja'] = 0;
            in_array(17, $valores) ? $_SESSION['mantenimiento'] = 1 : $_SESSION['mantenimiento'] = 0;
            ?>

            <!-- search form -->
            <div class="input-group sidebar-form">
                <input type="text" name="q" class="form-control search-menu-box" placeholder="Buscar...">
            </div>

            <!-- Escritorio -->
            <?php
            if ($_SESSION["escritorio"] == 1) {
            ?>

                <li class="<?php if ($_GET["ruta"] == "inicio") echo 'active'; ?>">

                    <a href="inicio">

                        <i class="fa fa-home"></i>
                        <span>Inicio</span>

                    </a>

                </li>

            <?php
            }
            ?>

            <!--  Analisis-->
            <?php
            if ($_SESSION["analisis"] == 1) {
            ?>

                <li class="<?php if ($_GET["ruta"] == "inicio-gerencia") echo 'active'; ?>">

                    <a href="inicio-gerencia">

                        <i class="fa fa-globe"></i>
                        <span>Analisis</span>

                    </a>

                </li>

            <?php
            }
            ?>


            <!--  Usuarios-->
            <?php
            if ($_SESSION["usuarios"] == 1) {
            ?>

                <li class="<?php if ($_GET["ruta"] == "usuarios") echo 'active'; ?>">

                    <a href="usuarios">

                        <i class="fa fa-user"></i>
                        <span>Usuarios</span>

                    </a>

                </li>

            <?php
            }
            ?>

            <!--  Backend-->
            <?php
            if ($_SESSION["backend"] == 1) {
            ?>

                <li class="treeview <?php if (
                                        $_GET["ruta"] == "movimientos" ||
                                        $_GET["ruta"] == "datos-dia" ||
                                        $_GET["ruta"] == "backupDB" ||
                                        $_GET["ruta"] == "bkplista" ||
                                        $_GET["ruta"] == "cargas-automaticas" ||
                                        $_GET["ruta"] == "conexionjf"
                                    ) echo 'active'; ?>">

                    <a href="#">

                        <i class="fa fa-code"></i>

                        <span>Backend</span>

                        <span class="pull-right-container">

                            <i class="fa fa-angle-left pull-right"></i>

                        </span>

                    </a>

                    <ul class="treeview-menu">

                        <li class="<?php if ($_GET["ruta"] == "movimientos") echo 'active'; ?>">

                            <a href="movimientos">

                                <i class="fa fa-circle-o"></i>
                                <span>Movimientos</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "datos-dia") echo 'active'; ?>">

                            <a href="datos-dia">

                                <i class="fa fa-circle-o"></i>
                                <span>Datos Diarios</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "backupDB") echo 'active'; ?>">

                            <a href="#">

                                <i class="fa fa-circle-o"></i>
                                <span>Backup</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "bkplista") echo 'active'; ?>">

                            <a href="bkplista">

                                <i class="fa fa-circle-o"></i>
                                <span>Backup - Listos</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "cargas-automaticas") echo 'active'; ?>">

                            <a href="cargas-automaticas">

                                <i class="fa fa-circle-o"></i>
                                <span>Cargas automaticas</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "conexionjf") echo 'active'; ?>">

                            <a href="conexionjf">

                                <i class="fa fa-circle-o"></i>
                                <span>Conexiones</span>

                            </a>

                        </li>

                    </ul>

                </li>

            <?php
            }
            ?>

            <!--  Movimientos-->
            <?php
            if ($_SESSION["movimientos"] == 1) {
            ?>

                <li class="treeview <?php if (
                                        $_GET["ruta"] == "m-produccion" ||
                                        $_GET["ruta"] == "m-ventas" ||
                                        $_GET["ruta"] == "mp-ingresos" ||
                                        $_GET["ruta"] == "mp-salidas"
                                    ) echo 'active'; ?>">

                    <a href="#">

                        <i class="fa fa-line-chart text-info"></i>

                        <span>Movimientos</span>

                        <span class="pull-right-container">

                            <i class="fa fa-angle-left pull-right"></i>

                        </span>

                    </a>

                    <ul class="treeview-menu">

                        <li class="<?php if ($_GET["ruta"] == "m-produccion") echo 'active'; ?>">

                            <a href="m-produccion">

                                <i class="fa fa-circle-o"></i>
                                <span>Produccion</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "m-ventas") echo 'active'; ?>">

                            <a href="m-ventas">

                                <i class="fa fa-circle-o"></i>
                                <span>Ventas</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "mp-ingresos") echo 'active'; ?>">

                            <a href="mp-ingresos">

                                <i class="fa fa-circle-o"></i>
                                <span>Ingresos MP</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "mp-salidas") echo 'active'; ?>">

                            <a href="mp-salidas">

                                <i class="fa fa-circle-o"></i>
                                <span>Salidas MP</span>

                            </a>

                        </li>

                    </ul>

                </li>

            <?php
            }
            ?>

            <?php
            if ($_SESSION["maestros"] == 1) {
            ?>

                <li class="treeview <?php if (
                                        $_GET["ruta"] == "articulos" ||
                                        $_GET["ruta"] == "crear-articulo" ||
                                        $_GET["ruta"] == "agencias" ||
                                        $_GET["ruta"] == "bancos" ||
                                        $_GET["ruta"] == "colores" ||
                                        $_GET["ruta"] == "condicionesventa" ||
                                        $_GET["ruta"] == "tipodocumentos" ||
                                        $_GET["ruta"] == "marcas" ||
                                        $_GET["ruta"] == "modelosjf" ||
                                        $_GET["ruta"] == "operaciones" ||
                                        $_GET["ruta"] == "paras" ||
                                        $_GET["ruta"] == "sectores" ||
                                        $_GET["ruta"] == "marcas" ||
                                        $_GET["ruta"] == "tipomovimientos" ||
                                        $_GET["ruta"] == "tipopagos" ||
                                        $_GET["ruta"] == "tipotrabajador" ||
                                        $_GET["ruta"] == "trabajador" ||
                                        $_GET["ruta"] == "trabajador2" ||
                                        $_GET["ruta"] == "unidadesmedida" ||
                                        $_GET["ruta"] == "vendedor"
                                    ) echo 'active'; ?>">

                    <a href="#">

                        <i class="fa fa-database text-red"></i>

                        <span>Maestros</span>

                        <span class="pull-right-container">

                            <i class="fa fa-angle-left pull-right"></i>

                        </span>

                    </a>

                    <ul class="treeview-menu">

                        <li class="<?php if ($_GET["ruta"] == "articulos") echo 'active'; ?>">

                            <a href="articulos">

                                <i class="fa fa-circle-o"></i>
                                <span>Artículos</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "agencias") echo 'active'; ?>">
                            <a href="agencias">

                                <i class="fa fa-circle-o"></i>
                                <span>Agencias</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "bancos") echo 'active'; ?>">
                            <a href="bancos">

                                <i class="fa fa-circle-o"></i>
                                <span>Bancos</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "colores") echo 'active'; ?>">

                            <a href="colores">

                                <i class="fa fa-circle-o"></i>
                                <span>Colores</span>

                            </a>

                        </li>


                        <li class="<?php if ($_GET["ruta"] == "condicionesventa") echo 'active'; ?>">
                            <a href="condicionesventa">

                                <i class="fa fa-circle-o"></i>
                                <span>Condiciones Venta</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "tipodocumentos") echo 'active'; ?>">
                            <a href="tipodocumentos">

                                <i class="fa fa-circle-o"></i>
                                <span>Documentos</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "marcas") echo 'active'; ?>">

                            <a href="marcas">

                                <i class="fa fa-circle-o"></i>
                                <span>Marcas</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "modelosjf") echo 'active'; ?>">

                            <a href="modelosjf">

                                <i class="fa fa-circle-o"></i>
                                <span>Modelos</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "operaciones") echo 'active'; ?>">

                            <a href="operaciones">

                                <i class="fa fa-circle-o"></i>
                                <span>Operaciones</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "paras") echo 'active'; ?>">
                            <a href="paras">

                                <i class="fa fa-circle-o"></i>
                                <span>Paras</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "sectores") echo 'active'; ?>">
                            <a href="sectores">

                                <i class="fa fa-circle-o"></i>
                                <span>Sector</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "tipomovimientos") echo 'active'; ?>">
                            <a href="tipomovimientos">

                                <i class="fa fa-circle-o"></i>
                                <span>Tipo Movimientos</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "tipopagos") echo 'active'; ?>">
                            <a href="tipopagos">

                                <i class="fa fa-circle-o"></i>
                                <span>Tipo Pagos</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "tipotrabajador") echo 'active'; ?>">
                            <a href="tipotrabajador">

                                <i class="fa fa-circle-o"></i>
                                <span>Tipo Trabajador</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "trabajador") echo 'active'; ?>">
                            <a href="trabajador">

                                <i class="fa fa-circle-o"></i>
                                <span>Trabajador</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "trabajador2") echo 'active'; ?>">
                            <a href="trabajador2">

                                <i class="fa fa-circle-o"></i>
                                <span>Trabajador 2</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "unidadesmedida") echo 'active'; ?>">
                            <a href="unidadesmedida">

                                <i class="fa fa-circle-o"></i>
                                <span>Unidades Medida</span>

                            </a>

                        </li>



                        <li class="<?php if ($_GET["ruta"] == "vendedor") echo 'active'; ?>">
                            <a href="vendedor">

                                <i class="fa fa-circle-o"></i>
                                <span>Vendedor</span>

                            </a>

                        </li>
                    </ul>

                </li>

            <?php
            }
            ?>

            <!-- Produccion -->
            <?php
            if ($_SESSION["produccion"] == 1) {
            ?>

                <li class="treeview <?php if (
                                        $_GET["ruta"] == "ordencorte" ||
                                        $_GET["ruta"] == "crear-ordencorte" ||
                                        $_GET["ruta"] == "editar-detalle-ordencorte" ||
                                        $_GET["ruta"] == "almacencorte" ||
                                        $_GET["ruta"] == "crear-almacencorte" ||
                                        $_GET["ruta"] == "en-cortes" ||
                                        $_GET["ruta"] == "en-taller" ||
                                        $_GET["ruta"] == "marcar-taller" ||
                                        $_GET["ruta"] == "en-tallert" ||
                                        $_GET["ruta"] == "en-tallerp" ||
                                        $_GET["ruta"] == "ingresos" ||
                                        $_GET["ruta"] == "crear-ingresos" ||
                                        $_GET["ruta"] == "crear-segunda" ||
                                        $_GET["ruta"] == "asistencia" ||
                                        $_GET["ruta"] == "quincena" ||
                                        $_GET["ruta"] == "eficiencia-global" ||
                                        $_GET["ruta"] == "produccion-trusas" ||
                                        $_GET["ruta"] == "produccion-brasier" ||
                                        $_GET["ruta"] == "produccion-vasco" ||
                                        $_GET["ruta"] == "urgencias" ||
                                        $_GET["ruta"] == "urgenciasamp" ||
                                        $_GET["ruta"] == "proyeccion-mp" ||
                                        $_GET["ruta"] == "servicios" ||
                                        $_GET["ruta"] == "crear-servicio" ||
                                        $_GET["ruta"] == "cierres" ||
                                        $_GET["ruta"] == "crear-cierre" ||
                                        $_GET["ruta"] == "precio-servicio" ||
                                        $_GET["ruta"] == "pago-servicio" ||
                                        $_GET["ruta"] == "salidas-varios" ||
                                        $_GET["ruta"] == "crear-salidas-varios" ||
                                        $_GET["ruta"] == "operacion-taller" ||
                                        $_GET["ruta"] == "sublimados" ||
                                        $_GET["ruta"] == "seguimiento" ||
                                        $_GET["ruta"] == "enviados-taller" ||
                                        $_GET["ruta"] == "listar-documento" ||
                                        $_GET["ruta"] == "ajuste-taller" ||
                                        $_GET["ruta"] == "urgencias-produccion" ||
                                        $_GET["ruta"] == "urgencias-almacen" ||
                                        $_GET["ruta"] == "urgencias-corte" ||
                                        $_GET["ruta"] == "urgencias-plan" ||
                                        $_GET["ruta"] == "urgencias-maestro" ||
                                        $_GET["ruta"] == "transferencia-apt" ||
                                        $_GET["ruta"] == "crear-transferencias-apt" ||
                                        $_GET["ruta"] == "estampado"
                                    ) echo 'active'; ?>">

                    <a href="#">

                        <i class="fa fa-cogs"></i> <span>Producción</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>

                    </a>

                    <ul class="treeview-menu">

                        <li class="treeview <?php if (
                                                $_GET["ruta"] == "ordencorte" ||
                                                $_GET["ruta"] == "crear-ordencorte"
                                            ) echo 'active'; ?>">

                            <a href="#"><i class="fa fa-scissors"></i> Ordenes de Corte

                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>

                            </a>

                            <ul class="treeview-menu">

                                <li class="<?php if ($_GET["ruta"] == "ordencorte") echo 'active'; ?>">

                                    <a href="ordencorte">
                                        <i class="fa fa-circle-o"></i> Ord. de Corte
                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "crear-ordencorte") echo 'active'; ?>">

                                    <a href="crear-ordencorte">
                                        <i class="fa fa-circle-o"></i> Crear Ord. de Corte
                                    </a>

                                </li>

                            </ul>

                        </li>

                        <li class="treeview  <?php if (
                                                    $_GET["ruta"] == "almacencorte" ||
                                                    $_GET["ruta"] == "crear-almacencorte" ||
                                                    $_GET["ruta"] == "consumo-telas"
                                                ) echo 'active'; ?>">

                            <a href="#"><i class="fa fa-scissors"></i> Corte

                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>

                            </a>

                            <ul class="treeview-menu">

                                <li class="<?php if ($_GET["ruta"] == "almacencorte") echo 'active'; ?>">

                                    <a href="almacencorte">
                                        <i class="fa fa-circle-o"></i> Corte
                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "crear-almacencorte") echo 'active'; ?>">

                                    <a href="crear-almacencorte">
                                        <i class="fa fa-circle-o"></i> Crear Corte
                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "consumo-telas") echo 'active'; ?>">

                                    <a href="consumo-telas">
                                        <i class="fa fa-circle-o"></i> Consumo telas
                                    </a>

                                </li>

                            </ul>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "estampado") echo 'active'; ?>">

                            <a href="estampado">
                                <i class="fa fa-scissors"></i>
                                <span>Estampado</span>
                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "en-cortes") echo 'active'; ?>">

                            <a href="en-cortes">
                                <i class="fa fa-scissors"></i>
                                <span>Almacén de corte</span>
                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "enviados-taller") echo 'active'; ?>">

                            <a href="enviados-taller">
                                <i class="fa fa-scissors"></i>
                                <span>Env. a Taller</span>
                            </a>

                        </li>

                        <li class="treeview <?php if (
                                                $_GET["ruta"] == "en-taller" ||
                                                $_GET["ruta"] == "marcar-taller" ||
                                                $_GET["ruta"] == "en-tallert" ||
                                                $_GET["ruta"] == "en-tallerp"
                                            ) echo 'active'; ?>">

                            <a href="#"><i class="fa fa-scissors"></i> En Talleres
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>

                            <ul class="treeview-menu">

                                <li class="<?php if ($_GET["ruta"] == "en-taller") echo 'active'; ?>">

                                    <a href="en-taller">
                                        <i class="fa fa-circle-o"></i>Taller General
                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "marcar-taller") echo 'active'; ?>">

                                    <a href="marcar-taller">
                                        <i class="fa fa-circle-o"></i>Registar Tareas
                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "en-tallert") echo 'active'; ?>">

                                    <a href="en-tallert">
                                        <i class="fa fa-circle-o"></i>Taller Terminados
                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "en-tallerp") echo 'active'; ?>">

                                    <a href="en-tallerp">
                                        <i class="fa fa-circle-o"></i>Taller Generados
                                    </a>

                                </li>

                            </ul>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "ingresos") echo 'active'; ?>">

                            <a href="ingresos">
                                <i class="fa fa-scissors"></i>
                                <span>Ingresos</span>
                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "asistencia") echo 'active'; ?>">

                            <a href="asistencia">
                                <i class="fa fa-calendar"></i>Asistencias
                            </a>

                        </li>

                        <li class="treeview <?php if (
                                                $_GET["ruta"] == "quincena" ||
                                                $_GET["ruta"] == "eficiencia-global" ||
                                                $_GET["ruta"] == "produccion-trusas" ||
                                                $_GET["ruta"] == "produccion-brasier" ||
                                                $_GET["ruta"] == "produccion-vasco"
                                            ) echo 'active'; ?>">

                            <a href="#"><i class="fa fa-scissors"></i> Producción
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>

                            <ul class="treeview-menu">

                                <li class="<?php if ($_GET["ruta"] == "quincena") echo 'active'; ?>">

                                    <a href="quincena">
                                        <i class="fa fa-circle-o"></i>Quincenas
                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "eficiencia-global") echo 'active'; ?>">

                                    <a href="eficiencia-global">
                                        <i class="fa fa-circle-o"></i>Eficiencia Global
                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "produccion-trusas") echo 'active'; ?>">

                                    <a href="produccion-trusas">
                                        <i class="fa fa-circle-o"></i> Producción Trusas
                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "produccion-brasier") echo 'active'; ?>">

                                    <a href="produccion-brasier">
                                        <i class="fa fa-circle-o"></i> Producción Brasier
                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "produccion-vasco") echo 'active'; ?>">

                                    <a href="produccion-vasco">
                                        <i class="fa fa-circle-o"></i> Producción Vasco
                                    </a>

                                </li>

                            </ul>

                        </li>

                        <li class="treeview <?php if (
                                                $_GET["ruta"] == "urgencias" ||
                                                $_GET["ruta"] == "urgenciasamp" ||
                                                $_GET["ruta"] == "proyeccion-mp" ||
                                                $_GET["ruta"] == "seguimiento" ||
                                                $_GET["ruta"] == "urgencias-produccion" ||
                                                $_GET["ruta"] == "urgencias-almacen" ||
                                                $_GET["ruta"] == "urgencias-corte" ||
                                                $_GET["ruta"] == "urgencias-plan" ||
                                                $_GET["ruta"] == "urgencias-maestro"
                                            ) echo 'active'; ?>">

                            <a href="#"><i class="fa fa-file-o"></i> Reportes
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>

                            <ul class="treeview-menu">

                                <li class="<?php if ($_GET["ruta"] == "urgencias") echo 'active'; ?>">

                                    <a href="urgencias">
                                        <i class="fa fa-circle-o"></i> Urgencias APT
                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "seguimiento") echo 'active'; ?>">

                                    <a href="seguimiento">
                                        <i class="fa fa-circle-o"></i> Seguimiento
                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "urgenciasamp") echo 'active'; ?>">

                                    <a href="urgenciasamp">
                                        <i class="fa fa-circle-o"></i> Urgencias AMP
                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "proyeccion-mp") echo 'active'; ?>">

                                    <a href="proyeccion-mp">
                                        <i class="fa fa-circle-o"></i> Proyección AMP
                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "urgencias-maestro") echo 'active'; ?>">

                                    <a href="urgencias-maestro">
                                        <i class="fa fa-circle-o text-blue"></i> Urg. Maestro.
                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "urgencias-produccion") echo 'active'; ?>">

                                    <a href="urgencias-produccion">
                                        <i class="fa fa-circle-o text-red"></i> Urg. Prod.
                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "urgencias-almacen") echo 'active'; ?>">

                                    <a href="urgencias-almacen">
                                        <i class="fa fa-circle-o text-red"></i> Urg. Alm. Corte
                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "urgencias-corte") echo 'active'; ?>">

                                    <a href="urgencias-corte">
                                        <i class="fa fa-circle-o text-red"></i> Urg. Corte
                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "urgencias-plan") echo 'active'; ?>">

                                    <a href="urgencias-plan">
                                        <i class="fa fa-circle-o text-red"></i> Urg. Planificación
                                    </a>

                                </li>

                            </ul>

                        </li>

                        <li class="treeview <?php if (
                                                $_GET["ruta"] == "servicios" ||
                                                $_GET["ruta"] == "crear-servicio"
                                            ) echo 'active'; ?>">

                            <a href="#"><i class="fa fa-list-ul"></i> Servicios

                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>

                            </a>

                            <ul class="treeview-menu">

                                <li class="<?php if ($_GET["ruta"] == "servicios") echo 'active'; ?>">

                                    <a href="servicios">
                                        <i class="fa fa-circle-o"></i> Servicios
                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "crear-servicio") echo 'active'; ?>">

                                    <a href="crear-servicio">
                                        <i class="fa fa-circle-o"></i> Crear servicio
                                    </a>

                                </li>

                            </ul>

                        </li>
                        <li class="treeview <?php if (
                                                $_GET["ruta"] == "cierres" ||
                                                $_GET["ruta"] == "crear-cierre"
                                            ) echo 'active'; ?>">

                            <a href="#"><i class="fa fa-list-ul"></i> Cierres

                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>

                            </a>

                            <ul class="treeview-menu">

                                <li class="<?php if ($_GET["ruta"] == "cierres") echo 'active'; ?>">

                                    <a href="cierres">
                                        <i class="fa fa-circle-o"></i> Cierres
                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "crear-cierre") echo 'active'; ?>">

                                    <a href="crear-cierre">
                                        <i class="fa fa-circle-o"></i> Crear cierre
                                    </a>

                                </li>
                            </ul>
                        </li>

                        <li class="treeview <?php if (
                                                $_GET["ruta"] == "precio-servicio" ||
                                                $_GET["ruta"] == "pago-servicio"
                                            ) echo 'active'; ?>">

                            <a href="#"><i class="fa fa-list-ul"></i> Pagos

                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>

                            </a>

                            <ul class="treeview-menu">

                                <li class="<?php if ($_GET["ruta"] == "precio-servicio") echo 'active'; ?>">

                                    <a href="precio-servicio">
                                        <i class="fa fa-circle-o"></i> Precio servicio
                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "pago-servicio") echo 'active'; ?>">

                                    <a href="pago-servicio">
                                        <i class="fa fa-circle-o"></i> Pago servicio
                                    </a>

                                </li>
                            </ul>
                        </li>
                        <li class="treeview <?php if (
                                                $_GET["ruta"] == "salidas-varios" ||
                                                $_GET["ruta"] == "listar-documento" ||
                                                $_GET["ruta"] == "sublimados" ||
                                                $_GET["ruta"] == "ajuste-taller"
                                            ) echo 'active'; ?>">

                            <a href="#"><i class="fa fa-bolt"></i> Procedimientos

                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>

                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php if ($_GET["ruta"] == "sublimados") echo 'active'; ?>">

                                    <a href="sublimados">
                                        <i class="fa fa-circle-o"></i> Sublimados
                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "salidas-varios") echo 'active'; ?>">

                                    <a href="salidas-varios">
                                        <i class="fa fa-circle-o"></i> Ingresos y Salidas
                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "listar-documento") echo 'active'; ?>">

                                    <a href="listar-documento">
                                        <i class="fa fa-circle-o"></i> Listar Documentos
                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "ajuste-taller") echo 'active'; ?>">

                                    <a href="ajuste-taller">
                                        <i class="fa fa-circle-o"></i> Ajustes de Taller
                                    </a>

                                </li>
                            </ul>
                        </li>

                        <li class="<?php if (
                                        $_GET["ruta"] == "transferencias-apt" ||
                                        $_GET["ruta"] == "crear-transferencias-apt"
                                    ) echo 'active'; ?>">

                            <a href="transferencias-apt">
                                <i class="fa fa-circle-o text-green"></i>
                                <span>Transferencias</span>
                            </a>

                        </li>

                    </ul>

                </li>

            <?php
            }
            ?>

            <!-- Produccion VERSION NUEVA-->
            <?php if ($_SESSION["produccion"] == 1) : ?>

                <?php
                $rutasActivasProduccion = [
                    "ordencorte", "crear-ordencorte", "editar-detalle-ordencorte", "almacencorte",
                    "crear-almacencorte", "en-cortes", "en-taller", "marcar-taller", "en-tallert",
                    "en-tallerp", "ingresos", "crear-ingresos", "crear-segunda", "asistencia",
                    "quincena", "eficiencia-global", "produccion-trusas", "produccion-brasier",
                    "produccion-vasco", "urgencias", "urgenciasamp", "proyeccion-mp", "servicios",
                    "crear-servicio", "cierres", "crear-cierre", "precio-servicio", "pago-servicio",
                    "salidas-varios", "crear-salidas-varios", "operacion-taller", "sublimados",
                    "seguimiento", "enviados-taller", "listar-documento", "ajuste-taller",
                    "urgencias-produccion", "urgencias-almacen", "urgencias-corte", "urgencias-plan",
                    "urgencias-maestro", "transferencias-apt", "crear-transferencias-apt", "estampado", "tampografia"
                ];

                $isActiveProduccion = in_array($_GET["ruta"], $rutasActivasProduccion) ? 'active' : '';
                ?>
                <li class="treeview <?= $isActiveProduccion; ?>">

                    <a href="#">
                        <i class="fa fa-cogs"></i> <span>Producción <label class="text-danger">TEST</label></span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">

                        <?php
                        $rutasActivasProgramación = ["ordencorte", "almacencorte", "servicios", "cierres", "ingresos"];
                        $isActiveProgramación = in_array($_GET["ruta"], $rutasActivasProgramación) ? 'active' : '';
                        ?>

                        <!-- PROGRAMACIÓN -->
                        <li class="treeview <?= $isActiveProgramación; ?>">
                            <a href=" #"><i class="fa fa-circle-o"></i> Programación
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">

                                <!-- ORDEN DE CORTE -->
                                <li class="<?= $_GET['ruta'] == 'ordencorte' ? 'active' : '' ?>">
                                    <a href="ordencorte"><i class="fa fa-circle-o"></i> Ord. Corte</a>
                                </li>

                                <!-- CORTES -->
                                <li class="<?= $_GET['ruta'] == 'almacencorte' ? 'active' : '' ?>">
                                    <a href="almacencorte"><i class="fa fa-circle-o"></i> Cortes</a>
                                </li>

                                <!-- SERVICIOS -->
                                <li class="<?= $_GET['ruta'] == 'servicios' ? 'active' : '' ?>">
                                    <a href="servicios"><i class="fa fa-circle-o"></i> Servicios</a>
                                </li>

                                <!-- CIERRES -->
                                <li class="<?= $_GET['ruta'] == 'cierres' ? 'active' : '' ?>">
                                    <a href="cierres"><i class="fa fa-circle-o"></i> Cierres</a>
                                </li>

                                <!-- INGRESOS -->
                                <li class="<?= $_GET['ruta'] == 'ingresos' ? 'active' : '' ?>">
                                    <a href="ingresos"><i class="fa fa-circle-o"></i> Ingresos</a>
                                </li>

                            </ul>
                        </li>

                        <!-- TALLER VASCO -->
                        <?php
                        $rutasActivasTallerVasco = ["en-taller", "marcar-taller", "en-tallert", "en-tallerp", "quincena"];
                        $isActiveTallerVasco = in_array($_GET["ruta"], $rutasActivasTallerVasco) ? 'active' : '';
                        ?>
                        <li class="treeview <?= $isActiveTallerVasco; ?>">
                            <a href=" #"><i class="fa fa-circle-o"></i> Taller Vasco
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?= $_GET['ruta'] == 'en-taller' ? 'active' : '' ?>">
                                    <a href="en-taller"><i class="fa fa-circle-o"></i> Taller Gral</a>
                                </li>
                                <li class="<?= $_GET['ruta'] == 'marcar-taller' ? 'active' : '' ?>">
                                    <a href="marcar-taller"><i class="fa fa-circle-o"></i> Registrar</a>
                                </li>
                                <li class="<?= $_GET['ruta'] == 'en-tallerp' ? 'active' : '' ?>">
                                    <a href="en-tallerp"><i class="fa fa-circle-o"></i> Generados</a>
                                </li>
                                <li class="<?= $_GET['ruta'] == 'en-tallert' ? 'active' : '' ?>">
                                    <a href="en-tallert"><i class="fa fa-circle-o"></i> Terminados</a>
                                </li>
                                <li class="<?= $_GET['ruta'] == 'quincena' ? 'active' : '' ?>">
                                    <a href="quincena"><i class="fa fa-circle-o"></i> Quincenas</a>
                                </li>

                            </ul>
                        </li>

                        <!-- GASTOS -->
                        <?php
                        $rutasActivasGastos = ["precio-servicio", "pago-servicio"];
                        $isActiveGastos = in_array($_GET["ruta"], $rutasActivasGastos) ? 'active' : '';
                        ?>
                        <li class="treeview <?= $isActiveGastos; ?>">
                            <a href=" #"><i class="fa fa-circle-o"></i> Gastos
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?= $_GET['ruta'] == 'precio-servicio' ? 'active' : '' ?>">
                                    <a href="precio-servicio"><i class="fa fa-circle-o"></i> Precios</a>
                                </li>
                                <li class="<?= $_GET['ruta'] == 'pago-servicio' ? 'active' : '' ?>">
                                    <a href="pago-servicio"><i class="fa fa-circle-o"></i> Pagos</a>
                                </li>
                            </ul>
                        </li>

                        <!-- RESUMEN -->
                        <?php
                        $rutasActivasResumen = ["en-cortes", "enviados-taller"];
                        $isActiveResumen = in_array($_GET["ruta"], $rutasActivasResumen) ? 'active' : '';
                        ?>
                        <li class="treeview <?= $isActiveResumen; ?>">
                            <a href="#"><i class="fa fa-circle-o"></i> Resumen
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?= $_GET['ruta'] == 'en-cortes' ? 'active' : '' ?>">
                                    <a href="en-cortes"><i class="fa fa-circle-o"></i> Alm. Corte</a>
                                </li>
                                <li class="<?= $_GET['ruta'] == 'enviados-taller' ? 'active' : '' ?>">
                                    <a href="enviados-taller"><i class="fa fa-circle-o"></i> Env. Taller</a>
                                </li>

                            </ul>
                        </li>

                        <!-- CONTROLES -->
                        <?php
                        $rutasActivasControles = ["estampado", "salidas-varios", "listar-documento", "transferencias-apt"];
                        $isActiveControles = in_array($_GET["ruta"], $rutasActivasControles) ? 'active' : '';
                        ?>
                        <li class="treeview <?= $isActiveControles; ?>">
                            <a href="#"><i class="fa fa-circle-o"></i> Controles
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?= $_GET['ruta'] == 'estampado' ? 'active' : '' ?>">
                                    <a href="estampado"><i class="fa fa-circle-o"></i> Estampados</a>
                                </li>
                                <li class="<?= $_GET['ruta'] == 'tampografia' ? 'active' : '' ?>">
                                    <a href="tampografia"><i class="fa fa-circle-o"></i> Tampografia</a>
                                </li>
                                <?php
                                $rutasActivasMovimientos = ["salidas-varios", "listar-documento"];
                                $isActiveMovimientos = in_array($_GET["ruta"], $rutasActivasMovimientos) ? 'active' : '';
                                ?>
                                <li class="treeview <?= $isActiveMovimientos; ?>">
                                    <a href="#"><i class="fa fa-circle-o"></i> Movimientos
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li class="<?= $_GET['ruta'] == 'salidas-varios' ? 'active' : '' ?>">
                                            <a href="salidas-varios"><i class="fa fa-circle-o"></i> Registros</a>
                                        </li>
                                        <li class="<?= $_GET['ruta'] == 'listar-documento' ? 'active' : '' ?>">
                                            <a href="listar-documento"><i class="fa fa-circle-o"></i> Documentos</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="<?= $_GET['ruta'] == 'transferencias-apt' ? 'active' : '' ?>">
                                    <a href="transferencias-apt"><i class="fa fa-circle-o"></i> Transferencias</a>
                                </li>
                            </ul>
                        </li>

                        <!-- REPORTES -->
                        <?php
                        $rutasActivasResumen = ["seguimiento", 'urgencias', 'urgencias-maestro', 'urgencias-produccion', 'urgencias-almacen', 'urgencias-corte', 'urgencias-plan'];
                        $isActiveResumen = in_array($_GET["ruta"], $rutasActivasResumen) ? 'active' : '';
                        ?>
                        <li class="treeview <?= $isActiveResumen; ?>">
                            <a href="#"><i class="fa fa-circle-o"></i> Reportes
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?= $_GET['ruta'] == 'seguimiento' ? 'active' : '' ?>">
                                    <a href="seguimiento"><i class="fa fa-circle-o"></i> Seguimiento</a>
                                </li>
                                <?php
                                $rutasActivasUrgencia = ['urgencias', 'urgencias-maestro', 'urgencias-produccion', 'urgencias-almacen', 'urgencias-corte', 'urgencias-plan'];
                                $isActiveUrgencia = in_array($_GET["ruta"], $rutasActivasUrgencia) ? 'active' : '';
                                ?>
                                <li class="treeview <?= $isActiveUrgencia; ?>">
                                    <a href="#"><i class="fa fa-circle-o"></i> Urgencias
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li class="<?= $_GET['ruta'] == 'urgencias' ? 'active' : '' ?>">
                                            <a href="urgencias"><i class="fa fa-circle-o"></i> Urgencia APT</a>
                                        </li>
                                        <li class="<?= $_GET['ruta'] == 'urgencias-maestro' ? 'active' : '' ?>">
                                            <a href="urgencias-maestro"><i class="fa fa-circle-o"></i> Urg. Maestro</a>
                                        </li>
                                        <li class="<?= $_GET['ruta'] == 'urgencias-produccion' ? 'active' : '' ?>">
                                            <a href="urgencias-produccion"><i class="fa fa-circle-o"></i> Urg. Prod.</a>
                                        </li>
                                        <li class="<?= $_GET['ruta'] == 'urgencias-almacen' ? 'active' : '' ?>">
                                            <a href="urgencias-almacen"><i class="fa fa-circle-o"></i> Urg. A. Corte</a>
                                        </li>
                                        <li class="<?= $_GET['ruta'] == 'urgencias-corte' ? 'active' : '' ?>">
                                            <a href="urgencias-corte"><i class="fa fa-circle-o"></i> Urg. Corte</a>
                                        </li>
                                        <li class="<?= $_GET['ruta'] == 'urgencias-plan' ? 'active' : '' ?>">
                                            <a href="urgencias-plan"><i class="fa fa-circle-o"></i> Urg. Plan</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>



                    </ul>
                </li>


            <?php endif ?>

            <!-- Tarjetas-->
            <?php
            if ($_SESSION["tarjetas"] == 1) {
            ?>

                <li class="treeview <?php if (
                                        $_GET["ruta"] == "tarjetas" ||
                                        $_GET["ruta"] == "ficha-tecnica" ||
                                        $_GET["ruta"] == "crear-tarjeta"
                                    ) echo 'active'; ?>">

                    <a href="#">

                        <i class="fa fa-id-card-o text-primary"></i>

                        <span>Tarjetas</span>

                        <span class="pull-right-container">

                            <i class="fa fa-angle-left pull-right"></i>

                        </span>

                    </a>

                    <ul class="treeview-menu">

                        <li class="<?php if ($_GET["ruta"] == "tarjetas") echo 'active'; ?>">

                            <a href="tarjetas">

                                <i class="fa fa-circle-o"></i>
                                <span>Administrar Tarjetas</span>

                            </a>

                        </li>
                        <li class="<?php if ($_GET["ruta"] == "ficha-tecnica") echo 'active'; ?>">

                            <a href="ficha-tecnica">

                                <i class="fa fa-circle-o"></i>
                                <span>Fichas tecnicas</span>

                            </a>

                        </li>
                        <li class="<?php if ($_GET["ruta"] == "crear-tarjeta") echo 'active'; ?>">

                            <a href="crear-tarjeta">

                                <i class="fa fa-circle-o"></i>
                                <span>Crear Tarjeta</span>

                            </a>

                        </li>

                    </ul>

                </li>


            <?php
            }
            ?>

            <!-- Operaciones -->
            <?php
            if ($_SESSION["operaciones"] == 1) {
            ?>

                <li class="<?php if (
                                $_GET["ruta"] == "detalleoperaciones" ||
                                $_GET["ruta"] == "creardetalleoperaciones" ||
                                $_GET["ruta"] == "editardetalleoperaciones"
                            ) echo 'active'; ?>">

                    <a href="detalleoperaciones">
                        <i class="fa fa-bolt text-yellow"></i>
                        <span>Operaciones Modelos</span>
                    </a>

                </li>

            <?php
            }
            ?>

            <!-- Clientes-->
            <?php
            if ($_SESSION["materiaprima"] == 1) {
            ?>
                <li class="treeview <?php if (
                                        $_GET["ruta"] == "materiaprima" ||
                                        $_GET["ruta"] == "notas-ingresos" ||
                                        $_GET["ruta"] == "crear-nota-ingreso" ||
                                        $_GET["ruta"] == "notas-salidas" ||
                                        $_GET["ruta"] == "crear-nota-salida" ||
                                        $_GET["ruta"] == "tabla-maestra" ||
                                        $_GET["ruta"] == "orden-compra" ||
                                        $_GET["ruta"] == "crear-orden-compra" ||
                                        $_GET["ruta"] == "editar-orden-compra" ||
                                        $_GET["ruta"] == "proveedor" ||
                                        $_GET["ruta"] == "orden-servicio" ||
                                        $_GET["ruta"] == "crear-orden-servicio" ||
                                        $_GET["ruta"] == "crear-nota-ingreso-os" ||
                                        $_GET["ruta"] == "notas-ingresos-os" ||
                                        $_GET["ruta"] == "kardex" ||
                                        $_GET["ruta"] == "mp-oc-pendiente" ||
                                        $_GET["ruta"] == "mp-os-pendiente" ||
                                        $_GET["ruta"] == "almacen-01" ||
                                        $_GET["ruta"] == "crear-cuadros-prod"
                                    ) echo 'active'; ?>">

                    <a href="#">

                        <i class="fa fa-scissors text-orange"></i> <span>Materia Prima</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>

                    </a>

                    <ul class="treeview-menu">

                        <li class="<?php if ($_GET["ruta"] == "tabla-maestra") echo 'active'; ?>">

                            <a href="tabla-maestra">

                                <i class="fa fa-database text-blue"></i>
                                <span> Maestras Mp</span>

                            </a>

                        </li>

                        <li class="treeview <?php if (
                                                $_GET["ruta"] == "materiaprima" ||
                                                $_GET["ruta"] == "almacen-01"
                                            ) echo 'active'; ?>">

                            <a href="#"><i class="fa fa-scissors text-orange"></i> Materia Prima

                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>

                            </a>

                            <ul class="treeview-menu">

                                <li class="<?php if ($_GET["ruta"] == "materiaprima") echo 'active'; ?>">

                                    <a href="materiaprima">
                                        <i class="fa fa-circle-o"></i> Materia Prima
                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "almacen-01") echo 'active'; ?>">

                                    <a href="almacen-01">
                                        <i class="fa fa-circle-o"></i> Almacén 01
                                    </a>

                                </li>

                            </ul>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "tabla-produccion") echo 'active'; ?>">

                            <a href="tabla-produccion">

                                <i class="fa fa-cogs text-yellow"></i> Produccion Cuadros
                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "orden-servicio") echo 'active'; ?>">

                            <a href="orden-servicio">

                                <i class="fa fa-paint-brush text-red"></i>
                                <span> Orden Servicio</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "notas-ingresos-os") echo 'active'; ?>">

                            <a href="notas-ingresos-os">

                                <i class="fa fa-file-o text-red"></i>
                                <span> Ingresos x OS</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "orden-compra") echo 'active'; ?>">

                            <a href="orden-compra">

                                <i class="fa fa-shopping-basket text-yellow"></i>
                                <span> Orden Compra</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "notas-ingresos") echo 'active'; ?>">

                            <a href="notas-ingresos">

                                <i class="fa fa-file-o text-yellow"></i>
                                <span> Ingresos x OC</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "mp-oc-pendiente") echo 'active'; ?>">

                            <a href="mp-oc-pendiente">

                                <i class="fa fa-file-o text-green"></i>
                                <span> Mp Pendiente - OC</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "mp-os-pendiente") echo 'active'; ?>">

                            <a href="mp-os-pendiente">

                                <i class="fa fa-file-o text-green"></i>
                                <span> Mp Pendiente - OS</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "notas-salidas") echo 'active'; ?>">

                            <a href="notas-salidas">

                                <i class="fa fa-file-o text-danger"></i>
                                <span> Notas Salidas</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "kardex") echo 'active'; ?>">

                            <a href="kardex">

                                <i class="fa fa-random text-purple"></i>
                                <span> Kardex</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "proveedor") echo 'active'; ?>">
                            <a href="proveedor">

                                <i class="fa fa-truck"></i>
                                <span>Proveedor</span>

                            </a>

                        </li>
                    </ul>

                </li>

            <?php
            }
            ?>


            <!--  Facturacion-->
            <?php
            if ($_SESSION["facturacion"] == 1) {
            ?>
                <li class="treeview <?php if (
                                        $_GET["ruta"] == "pedidoscv" ||
                                        $_GET["ruta"] == "clientes"  ||
                                        $_GET["ruta"] == "guias-remision"  ||
                                        $_GET["ruta"] == "crear-pedidoscv" ||
                                        $_GET["ruta"] == "pedidos-generados"  ||
                                        $_GET["ruta"] == "pedidos-aprobados"  ||
                                        $_GET["ruta"] == "pedidos-apt" ||
                                        $_GET["ruta"] == "pedidos-confirmados" ||
                                        $_GET["ruta"] == "pedidos-facturados"  ||
                                        $_GET["ruta"] == "facturas" ||
                                        $_GET["ruta"] == "boletas" ||
                                        $_GET["ruta"] == "proformas" ||
                                        $_GET["ruta"] == "ver-nota-credito" ||
                                        $_GET["ruta"] == "procesar-ce" ||
                                        $_GET["ruta"] == "reportes-ventas" ||
                                        $_GET["ruta"] == "notas-credito" ||
                                        $_GET["ruta"] == "errores" ||
                                        $_GET["ruta"] == "cuadre-caja"
                                    ) echo 'active'; ?>">

                    <a href="#">

                        <i class="fa fa-cart-plus text-green"></i>

                        <span>Facturación</span>

                        <span class="pull-right-container">

                            <i class="fa fa-angle-left pull-right"></i>

                        </span>

                    </a>

                    <ul class="treeview-menu">
                        <li class="<?php if ($_GET["ruta"] == "clientes") echo 'active'; ?>">

                            <a href="clientes">

                                <i class="fa fa-users"></i>
                                <span>Clientes</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "pedidoscv") echo 'active'; ?>">

                            <a href="pedidoscv">

                                <i class="fa fa-paper-plane"></i>
                                <span>Pedidos</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "reportes-ventas") echo 'active'; ?>">

                            <a href="reportes-ventas">

                                <i class="fa fa-file-text"></i>
                                <span>Reportes Ventas</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "procesar-ce") echo 'active'; ?>">

                            <a href="procesar-ce">

                                <i class="fa fa-plane"></i>
                                <span>Procesar CE</span>

                            </a>

                        </li>

                        <li class="treeview <?php if (
                                                $_GET["ruta"] == "guias-remision" ||
                                                $_GET["ruta"] == "crear-pedidoscv" ||
                                                $_GET["ruta"] == "pedidos-generados"  ||
                                                $_GET["ruta"] == "pedidos-aprobados"  ||
                                                $_GET["ruta"] == "pedidos-apt" ||
                                                $_GET["ruta"] == "pedidos-confirmados" ||
                                                $_GET["ruta"] == "pedidos-facturados"  ||
                                                $_GET["ruta"] == "facturas" ||
                                                $_GET["ruta"] == "boletas" ||
                                                $_GET["ruta"] == "proformas" ||
                                                $_GET["ruta"] == "ver-nota-credito" ||
                                                $_GET["ruta"] == "notas-credito" ||
                                                $_GET["ruta"] == "errores" ||
                                                $_GET["ruta"] == "cuadre-caja"
                                            ) echo 'active'; ?>">

                            <a href="#"><i class="fa fa-clipboard"></i> Documentos

                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>

                            </a>

                            <ul class="treeview-menu">

                                <li class="<?php if ($_GET["ruta"] == "guias-remision") echo 'active'; ?>">

                                    <a href="guias-remision">

                                        <i class="fa fa-circle-o text-blue"></i>
                                        <span>Guias Remisión</span>

                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "facturas") echo 'active'; ?>">

                                    <a href="facturas">

                                        <i class="fa fa-circle-o text-green"></i>
                                        <span>Facturas</span>

                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "boletas") echo 'active'; ?>">

                                    <a href="boletas">

                                        <i class="fa fa-circle-o text-yellow"></i>
                                        <span>Boletas</span>

                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "proformas") echo 'active'; ?>">

                                    <a href="proformas">

                                        <i class="fa fa-circle-o text-orange"></i>
                                        <span>Proformas</span>

                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "ver-nota-credito") echo 'active'; ?>">

                                    <a href="ver-nota-credito">

                                        <i class="fa fa-circle-o text-green"></i>
                                        <span>NC/ND</span>

                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "errores") echo 'active'; ?>">

                                    <a href="errores">

                                        <i class="fa fa-exclamation-circle text-red"></i>
                                        <span>Errores</span>

                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "cuadre-caja") echo 'active'; ?>">

                                    <a href="cuadre-caja">

                                        <i class="fa fa-calculator text-primary"></i>
                                        <span>Cudrar caja</span>

                                    </a>

                                </li>

                            </ul>

                        </li>


                    </ul>

                </li>

            <?php
            }
            if ($_SESSION["cuenta"] == 1) {
            ?>
                <li class="treeview <?php if (
                                        $_GET["ruta"] == "cuentas" ||
                                        $_GET["ruta"] == "cuentas-pendientes" ||
                                        $_GET["ruta"] == "cuentas-canceladas" ||
                                        $_GET["ruta"] == "abonos" ||
                                        $_GET["ruta"] == "cancelar-abonos" ||
                                        $_GET["ruta"] == "consultar-cuentas" ||
                                        $_GET["ruta"] == "ver-envio-letras" ||
                                        $_GET["ruta"] == "envio-letras" ||
                                        $_GET["ruta"] == "reportes-generales"
                                    ) echo 'active'; ?>">

                    <a href="#">

                        <i class="fa fa-money text-green"></i>

                        <span>Cuentas corrientes</span>

                        <span class="pull-right-container">

                            <i class="fa fa-angle-left pull-right"></i>

                        </span>

                    </a>

                    <ul class="treeview-menu">
                        <li class="treeview <?php if (
                                                $_GET["ruta"] == "cuentas" ||
                                                $_GET["ruta"] == "cuentas-pendientes" ||
                                                $_GET["ruta"] == "cuentas-canceladas" ||
                                                $_GET["ruta"] == "abonos" ||
                                                $_GET["ruta"] == "cancelar-abonos" ||
                                                $_GET["ruta"] == "consultar-cuentas" ||
                                                $_GET["ruta"] == "ver-envio-letras" ||
                                                $_GET["ruta"] == "reportes-generales"
                                            ) echo 'active'; ?>">

                            <a href="#"><i class="fa fa-clipboard"></i> Cuentas

                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>

                            </a>

                            <ul class="treeview-menu">

                                <li class="<?php if ($_GET["ruta"] == "cuentas") echo 'active'; ?>">

                                    <a href="cuentas">

                                        <i class="fa fa-circle-o text-blue"></i>
                                        <span>Generales</span>

                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "cuentas-pendientes") echo 'active'; ?>">

                                    <a href="cuentas-pendientes">

                                        <i class="fa fa-circle-o text-red"></i>
                                        <span>Pendientes</span>

                                    </a>

                                </li>

                                <li class="<?php if ($_GET["ruta"] == "cuentas-canceladas") echo 'active'; ?>">

                                    <a href="cuentas-canceladas">

                                        <i class="fa fa-circle-o text-green"></i>
                                        <span>Canceladas</span>

                                    </a>

                                </li>


                            </ul>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "abonos") echo 'active'; ?>">

                            <a href="abonos">

                                <i class="fa fa-circle-o"></i>
                                <span>Abonos</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "cancelar-abonos") echo 'active'; ?>">
                            <a href="cancelar-abonos">

                                <i class="fa fa-circle-o"></i>
                                <span>Cancelar abonos</span>

                            </a>
                        </li>

                        <li class="<?php if ($_GET["ruta"] == "consultar-cuentas") echo 'active'; ?>">
                            <a href="consultar-cuentas">

                                <i class="fa fa-circle-o"></i>
                                <span>Consultar cuentas</span>

                            </a>
                        </li>

                        <li class="<?php if ($_GET["ruta"] == "ver-envio-letras") echo 'active'; ?>">
                            <a href="ver-envio-letras">

                                <i class="fa fa-circle-o"></i>
                                <span>Envio letras</span>

                            </a>
                        </li>

                        <li class="<?php if ($_GET["ruta"] == "reportes-generales") echo 'active'; ?>">
                            <a href="reportes-generales">

                                <i class="fa fa-circle-o"></i>
                                <span>Reportes Generales</span>

                            </a>
                        </li>
                    </ul>
                </li>


                <!--  Costos-->
            <?php
            }
            if ($_SESSION["caja"] == 1) {
            ?>
                <li class="treeview <?php if (
                                        $_GET["ruta"] == "centro-costos" ||
                                        $_GET["ruta"] == "gastos-caja" ||
                                        $_GET["ruta"] == "ingresos-caja" ||
                                        $_GET["ruta"] == "centro-costos-rsm" ||
                                        $_GET["ruta"] == "solicitud-caja" ||
                                        $_GET["ruta"] == "kardex-carga"
                                    ) echo 'active'; ?>">

                    <a href="#">

                        <i class="fa fa-rocket text-yellow"></i>

                        <span>Costos</span>

                        <span class="pull-right-container">

                            <i class="fa fa-angle-left pull-right"></i>

                        </span>

                    </a>

                    <ul class="treeview-menu">

                        <li class="<?php if ($_GET["ruta"] == "centro-costos") echo 'active'; ?>">

                            <a href="centro-costos">

                                <i class="fa fa-cc text-yellow"></i>
                                <span>Centro de Costos</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "kardex-carga") echo 'active'; ?>">

                            <a href="kardex-carga">

                                <i class="fa fa-cc text-yellow"></i>
                                <span>Kardex</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "gastos-caja") echo 'active'; ?>">

                            <a href="gastos-caja">

                                <i class="fa fa-diamond text-red"></i>
                                <span>Gastos Caja ( - )</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "solicitud-caja") echo 'active'; ?>">

                            <a href="solicitud-caja">

                                <i class="fa fa-diamond text-red"></i>
                                <span>Solicitud Gasto ( - )</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "ingresos-caja") echo 'active'; ?>">

                            <a href="ingresos-caja">

                                <i class="fa fa-diamond text-blue"></i>
                                <span>Ingresos Caja ( + )</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "centro-costos-rsm") echo 'active'; ?>">

                            <a href="centro-costos-rsm">

                                <i class="fa fa-cc text-yellow"></i>
                                <span>Resumen CC</span>

                            </a>

                        </li>

                    </ul>

                </li>

                <!--  Ticket-->
            <?php
            }
            if ($_SESSION["costos"] == 1) {
            ?>
                <li class="treeview <?php if (
                                        $_GET["ruta"] == "centro-costos" ||
                                        $_GET["ruta"] == "diario" ||
                                        $_GET["ruta"] == "diario-alerta" ||
                                        $_GET["ruta"] == "compras-reg" ||
                                        $_GET["ruta"] == "costos-modelo" ||
                                        $_GET["ruta"] == "costos-versus"
                                    ) echo 'active'; ?>">

                    <a href="#">

                        <i class="fa fa-cc text-red"></i>

                        <span>Centro de Costos</span>

                        <span class="pull-right-container">

                            <i class="fa fa-angle-left pull-right"></i>

                        </span>

                    </a>

                    <ul class="treeview-menu">

                        <li class="<?php if ($_GET["ruta"] == "centro-costos") echo 'active'; ?>">

                            <a href="centro-costos">

                                <i class="fa fa-cc text-yellow"></i>
                                <span>Centro de Costos</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "diario") echo 'active'; ?>">

                            <a href="diario">

                                <i class="fa fa-book text-blue"></i>
                                <span>Diario</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "diario-alerta") echo 'active'; ?>">

                            <a href="diario-alerta">

                                <i class="fa fa-book text-red"></i>
                                <span>Diario-Alerta</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "compras-reg") echo 'active'; ?>">

                            <a href="compras-reg">

                                <i class="fa fa-cart-arrow-down text-red"></i>
                                <span>Compras</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "validar-documento") echo 'active'; ?>">

                            <a href="validar-documento">

                                <i class="fa fa-search text-white"></i>
                                <span>Validar</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "costos-modelo") echo 'active'; ?>">

                            <a href="costos-modelo">

                                <i class="fa fa-star text-yellow"></i>
                                <span>Costos Por Modelo</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "costos-versus") echo 'active'; ?>">

                            <a href="costos-versus">

                                <i class="fa fa-star text-white"></i>
                                <span>Comparación de Costos</span>

                            </a>

                        </li>

                    </ul>

                </li>

                <!--  Ticket-->
            <?php
            }
            if ($_SESSION["ticket"] == 1) {
            ?>
                <li class="treeview <?php if (
                                        $_GET["ruta"] == "contactos" ||
                                        $_GET["ruta"] == "mailbox"
                                    ) echo 'active'; ?>">

                    <a href="#">

                        <i class="fa fa-inbox text-blue"></i>

                        <span>Ticket</span>

                        <span class="pull-right-container">

                            <i class="fa fa-angle-left pull-right"></i>

                        </span>

                    </a>

                    <ul class="treeview-menu">

                        <li class="<?php if ($_GET["ruta"] == "contactos") echo 'active'; ?>">

                            <a href="contactos">

                                <i class="fa fa-users"></i>
                                <span>Contactos</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "mailbox") echo 'active'; ?>">

                            <a href="mailbox">

                                <i class="fa fa-envelope-o"></i>
                                <span>Mailbox</span>

                            </a>

                        </li>

                    </ul>

                </li>

            <?php
            }
            if ($_SESSION["mantenimiento"] == 1) {
            ?>

                <li class="treeview <?php if (
                                        $_GET["ruta"] == "mantenimiento" ||
                                        $_GET["ruta"] == "equipos" ||
                                        $_GET["ruta"] == "calendario"
                                    ) echo 'active'; ?>">

                    <a href="#">

                        <i class="fa fa-industry text-white"></i>

                        <span>Mantenimiento</span>

                        <span class="pull-right-container">

                            <i class="fa fa-angle-left pull-right"></i>

                        </span>

                    </a>

                    <ul class="treeview-menu">

                        <li class="<?php if ($_GET["ruta"] == "equipos") echo 'active'; ?>">

                            <a href="equipos">

                                <i class="fa fa-wrench"></i>
                                <span>Equipos</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "calendario") echo 'active'; ?>">

                            <a href="calendario">

                                <i class="fa fa-calendar"></i>
                                <span>Calendario</span>

                            </a>

                        </li>

                        <li class="<?php if ($_GET["ruta"] == "mantenimiento") echo 'active'; ?>">

                            <a href="mantenimiento">

                                <i class="fa fa-wrench"></i>
                                <span>Mantenimiento</span>

                            </a>

                        </li>

                    </ul>

                </li>

            <?php
            }
            ?>


        </ul>

    </section>

</aside>

<script>
    $(".search-menu-box").on('input', function() {
        var filter = $(this).val();
        $(".sidebar-menu > li").each(function() {
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).hide();
            } else {
                $(this).show();
            }
        });
    });
</script>