<aside class="main-sidebar">

    <section class="sidebar">

        <ul class="sidebar-menu">

            <li class="active">

                <a href="inicio">

                    <i class="fa fa-home"></i>
                    <span>Inicio</span>

                </a>

            </li>

            <?php
            $item="idusuario";
            $valor=$_SESSION["id"];
            $permisos=ControladorUsuarios::ctrMostrarUsuariosPermisos($item,$valor);
            $valores= array();
            foreach ($permisos as $key => $value) {
                array_push($valores,$value["idpermiso"]);
            }
            in_array(1,$valores)?$_SESSION['escritorio']=1:$_SESSION['escritorio']=0;
            in_array(2,$valores)?$_SESSION['analisis']=1:$_SESSION['analisis']=0;
            in_array(3,$valores)?$_SESSION['usuarios']=1:$_SESSION['usuarios']=0;
            in_array(4,$valores)?$_SESSION['backend']=1:$_SESSION['backend']=0;
            in_array(5,$valores)?$_SESSION['movimientos']=1:$_SESSION['movimientos']=0;
            in_array(6,$valores)?$_SESSION['maestros']=1:$_SESSION['maestros']=0;
            in_array(7,$valores)?$_SESSION['produccion']=1:$_SESSION['produccion']=0;
            in_array(8,$valores)?$_SESSION['tarjetas']=1:$_SESSION['tarjetas']=0;
            in_array(9,$valores)?$_SESSION['operaciones']=1:$_SESSION['operaciones']=0;
            in_array(10,$valores)?$_SESSION['clientes']=1:$_SESSION['clientes']=0;
            in_array(11,$valores)?$_SESSION['ventas']=1:$_SESSION['ventas']=0;
            in_array(12,$valores)?$_SESSION['facturacion']=1:$_SESSION['facturacion']=0;
            

            if (
                $_SESSION["perfil"] == "Supervisores"  && $_SESSION["analisis"] == 1 ||
                $_SESSION["perfil"] == "Sistemas" && $_SESSION["analisis"] == 1
            ) {

                echo '<li class="active">

                                <a href="inicio-gerencia">
                
                                    <i class="fa fa-globe"></i>
                                    <span>Analisis</span>
                
                                </a>
                
                            </li>';
            }

            ?>

            <?php

            if ($_SESSION["perfil"] == "Sistemas") {
                if($_SESSION["usuarios"] == 1){
                echo '<li>

                            <a href="usuarios">
            
                                <i class="fa fa-user"></i>
                                <span>Usuarios</span>
            
                            </a>
    
                        </li>';
                }
                if($_SESSION["backend"] == 1){
                       echo' 
                        <!-- BACKEND SISTEMAS -->

                        <li class="treeview">
            
                            <a href="#">
            
                                <i class="fa fa-code"></i>
            
                                <span>Backend</span>
            
                                <span class="pull-right-container">
            
                                    <i class="fa fa-angle-left pull-right"></i>
            
                                </span>
            
                            </a>
            
                            <ul class="treeview-menu">
            
                                <li>
            
                                    <a href="movimientos">
            
                                        <i class="fa fa-circle-o"></i>
                                        <span>Movimientos</span>
            
                                    </a>
            
                                </li>

                                <li>
            
                                    <a href="backupDB">
            
                                        <i class="fa fa-circle-o"></i>
                                        <span>Backup</span>
            
                                    </a>
            
                                </li>

                                <li>
            
                                    <a href="bkplista">
            
                                        <i class="fa fa-circle-o"></i>
                                        <span>Backup - Listos</span>
            
                                    </a>
            
                                </li>  
                                
                                <li>
            
                                    <a href="cargas-automaticas">
            
                                        <i class="fa fa-circle-o"></i>
                                        <span>Cargas automaticas</span>
            
                                    </a>
            
                                </li>  

                            </ul>
            
                        </li>
            
                        <!-- fin backend -->   ';
                }
            }

            ?>

            <?php

            if (
                $_SESSION["perfil"] == "Sistemas" ||
                $_SESSION["perfil"] == "Supervisores" ||
                $_SESSION["perfil"] == "Produccion" ||
                $_SESSION["perfil"] == "Logistica" ||
                $_SESSION["perfil"] == "Udp" ||
                $_SESSION["perfil"] == "Costos"
            ) {
                if($_SESSION["movimientos"] == 1){
                echo '<!-- INICIO Movimientos -->

                        <li class="treeview">
            
                            <a href="#">
            
                                <i class="fa fa-line-chart"></i>
            
                                <span>Movimientos</span>
            
                                <span class="pull-right-container">
            
                                    <i class="fa fa-angle-left pull-right"></i>
            
                                </span>
            
                            </a>
            
                            <ul class="treeview-menu">
            
                                <li>
            
                                    <a href="m-produccion">
            
                                        <i class="fa fa-circle-o"></i>
                                        <span>Produccion</span>
            
                                    </a>
            
                                </li>

                                <li>
            
                                    <a href="m-ventas">
            
                                        <i class="fa fa-circle-o"></i>
                                        <span>Ventas</span>
            
                                    </a>
            
                                </li>    
                                
                                <li>
            
                                    <a href="mp-ingresos">
            
                                        <i class="fa fa-circle-o"></i>
                                        <span>Ingresos MP</span>
            
                                    </a>
            
                                </li>                                  

                            </ul>
                                    
                        </li>';
            
                }
                if($_SESSION["maestros"] == 1){
                        echo'
                        <!-- FIN Movimientos -->
                
                        <!-- maestros Joel -->

                        <li class="treeview">
            
                            <a href="#">
            
                                <i class="fa fa-database"></i>
            
                                <span>Maestros</span>
            
                                <span class="pull-right-container">
            
                                    <i class="fa fa-angle-left pull-right"></i>
            
                                </span>
            
                            </a>
            
                            <ul class="treeview-menu">

                                <li>
                
                                    <a href="articulos">
            
                                        <i class="fa fa-circle-o"></i>
                                        <span>Artículos</span>
            
                                    </a>
        
                                </li>  
                                
                                <li>
            
                                    <a href="colores">
            
                                        <i class="fa fa-circle-o"></i>
                                        <span>Colores</span>
            
                                    </a>
            
                                </li>   
                                
                                <li>
                                    <a href="tipodocumentos">
            
                                        <i class="fa fa-circle-o"></i>
                                        <span>Documentos</span>
            
                                    </a>
        
                                </li>
                                
                                <li>
            
                                    <a href="marcas">
            
                                        <i class="fa fa-circle-o"></i>
                                        <span>Marcas</span>
            
                                    </a>
            
                                </li>    
                                
                                <li>
            
                                    <a href="materiaprima">
            
                                        <i class="fa fa-circle-o"></i>
                                        <span> Materia Prima</span>
            
                                    </a>
            
                                </li>                                

                                <li>
                                        
                                    <a href="modelosjf">
            
                                        <i class="fa fa-circle-o"></i>
                                        <span>Modelos</span>
                                        
            
                                    </a>
                        
                                </li>

                                <li>
                                     
                                    <a href="operaciones">
            
                                        <i class="fa fa-circle-o"></i>
                                        <span>Operaciones</span>
                                        
            
                                    </a>
                                
                                </li>
                                
                                <li>
                                    <a href="sectores">
            
                                        <i class="fa fa-circle-o"></i>
                                        <span>Sector</span>
            
                                    </a>
        
                                </li>                                  

                                <li>
                                    <a href="tipotrabajador">
            
                                        <i class="fa fa-circle-o"></i>
                                        <span>Tipo Trabajador</span>
            
                                    </a>
        
                                </li>                              

                                <li>
                                    <a href="trabajador">
            
                                        <i class="fa fa-circle-o"></i>
                                        <span>Trabajador</span>
            
                                    </a>
        
                                </li>
                                
                                <li>
                                    <a href="paras">
            
                                        <i class="fa fa-circle-o"></i>
                                        <span>Paras</span>
            
                                    </a>
        
                                </li> 
                      
                            </ul>
            
                        </li>
            
                        <!-- fin maestros -->';
                }
            }

            ?>

            <?php

            if (
                $_SESSION["perfil"] == "Sistemas" && $_SESSION["produccion"] == 1 ||
                $_SESSION["perfil"] == "Supervisores"&& $_SESSION["produccion"] == 1 ||
                $_SESSION["perfil"] == "Produccion" && $_SESSION["produccion"] == 1 ||
                $_SESSION["perfil"] == "Logistica" && $_SESSION["produccion"] == 1 ||
                $_SESSION["perfil"] == "Costos" && $_SESSION["produccion"] == 1
            ) {

                echo '<li class="treeview">

                                    <a href="#">
                    
                                        <i class="fa fa-cogs"></i> <span>Producción</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                    
                                    </a>
                    
                                    <ul class="treeview-menu">';

                if (
                    $_SESSION["perfil"] == "Sistemas" ||
                    $_SESSION["perfil"] == "Supervisores" ||
                    $_SESSION["perfil"] == "Produccion" ||
                    $_SESSION["perfil"] == "Costos"
                ) {

                    echo '<li class="treeview">
                                                        <a href="#"><i class="fa fa-scissors"></i> Ordenes de Corte
                                                            <span class="pull-right-container">
                                                                <i class="fa fa-angle-left pull-right"></i>
                                                            </span>
                                                        </a>
                                
                                                        <ul class="treeview-menu">
                                               
                                                            <li>
                                                                <a href="ordencorte">
                                                                    <i class="fa fa-circle-o"></i> Ord. de Corte
                                                                </a>
                                                            </li>
                                
                                                            <li>
                                                                <a href="crear-ordencorte">
                                                                    <i class="fa fa-circle-o"></i> Crear Ord. de Corte
                                                                </a>
                                                            </li>
                                
                                                        </ul>
                                                    </li>';


                    echo '<li class="treeview">
                                                    <a href="#"><i class="fa fa-scissors"></i> Corte
                                                        <span class="pull-right-container">
                                                            <i class="fa fa-angle-left pull-right"></i>
                                                        </span>
                                                    </a>

                                                    <ul class="treeview-menu">

                                                        <li>
                                                            <a href="almacencorte">
                                                                <i class="fa fa-circle-o"></i> Corte
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="crear-almacencorte">
                                                                <i class="fa fa-circle-o"></i> Crear Corte
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </li>';

                    echo '<li>

                                                    <a href="en-cortes">

                                                        <i class="fa fa-scissors"></i>
                                                        <span>Almacén de corte</span>

                                                    </a>

                                                </li>';

                    echo '<li class="treeview">
                                                        <a href="#"><i class="fa fa-scissors"></i> En Talleres
                                                            <span class="pull-right-container">
                                                                <i class="fa fa-angle-left pull-right"></i>
                                                            </span>
                                                        </a>
                                
                                                        <ul class="treeview-menu">
                                               
                                                            <li>
                                                                <a href="en-taller">
                                                                    <i class="fa fa-circle-o"></i>Taller General
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="marcar-taller">
                                                                    <i class="fa fa-circle-o"></i>Registar Tareas
                                                                </a>
                                                            </li>                                                            

                                                            <li>
                                                                <a href="en-tallert">
                                                                    <i class="fa fa-circle-o"></i>Taller Terminados
                                                                </a>
                                                            </li>
                                
                                                        </ul>
                                                    </li>';

                }
                echo '<li >
                    
                                            <a href="asistencia">
                                                    <i class="fa fa-calendar"></i>Asistencias
                                            </a></li>';
                    
                echo '<li class="treeview">
                    
                                            <a href="#"><i class="fa fa-file-o"></i> Reportes
                                                <span class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                                            </a>
                    
                                            <ul class="treeview-menu">
                    
                                                <li>
                                                    <a href="urgencias">
                                                        <i class="fa fa-circle-o"></i> Urgencias APT
                                                    </a>
                                                </li>                        
                    
                                                <li>
                                                    <a href="urgenciasamp">
                                                        <i class="fa fa-circle-o"></i> Urgencias AMP
                                                    </a>
                                                </li>
                    
                                            </ul>
                                        </li>                    
                    
                                    </ul>
                    
                                </li>';
            }



            ?>

            <?php

            if (
                $_SESSION["perfil"] == "Sistemas" && $_SESSION["tarjetas"] == 1 ||
                $_SESSION["perfil"] == "Supervisores"  && $_SESSION["tarjetas"] == 1 ||
                $_SESSION["perfil"] == "Produccion" && $_SESSION["tarjetas"] == 1 ||
                $_SESSION["perfil"] == "Logistica" && $_SESSION["tarjetas"] == 1 ||
                $_SESSION["perfil"] == "Udp"  && $_SESSION["tarjetas"] == 1 ||
                $_SESSION["perfil"] == "Costos" && $_SESSION["tarjetas"] == 1
            ) {

                echo '<!-- inicio tarjetas -->

                        <li class="treeview">
            
                            <a href="#">
            
                                <i class="fa fa-id-card-o"></i>
            
                                <span>Tarjetas</span>
            
                                <span class="pull-right-container">
            
                                    <i class="fa fa-angle-left pull-right"></i>
            
                                </span>
            
                            </a>
            
                            <ul class="treeview-menu">
            
                                <li>
            
                                    <a href="tarjetas">
            
                                        <i class="fa fa-circle-o"></i>
                                        <span>Administrar Tarjetas</span>
            
                                    </a>
            
                                </li>';

                if (
                    $_SESSION["perfil"] == "Sistemas" ||
                    $_SESSION["perfil"] == "Supervisores" ||
                    $_SESSION["perfil"] == "Produccion" ||
                    $_SESSION["perfil"] == "Udp" ||
                    $_SESSION["perfil"] == "Costos"
                ) {

                    echo '
                                             <li>
            
                                                <a href="ficha-tecnica">
                        
                                                    <i class="fa fa-circle-o"></i>
                                                    <span>Fichas tecnicas</span>
                        
                                                </a>
                        
                                            </li>
                                             <li>
            
                                                <a href="crear-tarjeta">
                        
                                                    <i class="fa fa-circle-o"></i>
                                                    <span>Crear Tarjeta</span>
                        
                                                </a>
                        
                                            </li>';
                }

                echo '</ul>
                    
                        </li>
            
                        <!-- fin tarjetas -->';
                        
            }

            ?>

            <?php

            if (
                $_SESSION["perfil"] == "Sistemas" ||
                $_SESSION["perfil"] == "Administrador"
            )
                if($_SESSION["operaciones"] == 1){
                echo '  
                        <li>
                            <a href="detalleoperaciones">
                                <i class="fa fa-bolt"></i>
                                <span>Operaciones Modelos</span>
                            </a>
                        </li>';
                }
                       echo ' <li>

                            <a href="categorias">

                                <i class="fa fa-th"></i>
                                <span>Categorías</span>

                            </a>

                        </li>

                        <li>

                            <a href="productos">

                                <i class="fa fa-product-hunt"></i>
                                <span>Productos</span>

                            </a>

                        </li>';
                        if($_SESSION["clientes"] == 1){
                        echo '<li>

                            <a href="clientes">

                                <i class="fa fa-users"></i>
                                <span>Clientes</span>

                            </a>

                        </li>';
                        }
                        if($_SESSION["ventas"] == 1){
                        echo'<li class="treeview">

                            <a href="#">

                                <i class="fa fa-list-ul"></i>

                                <span>Ventas</span>

                                <span class="pull-right-container">

                                    <i class="fa fa-angle-left pull-right"></i>

                                </span>

                            </a>

                            <ul class="treeview-menu">

                                <li>

                                    <a href="ventas">

                                        <i class="fa fa-circle-o"></i>
                                        <span>Administrar ventas</span>

                                    </a>

                                </li>

                                <li>

                                    <a href="crear-venta">

                                        <i class="fa fa-circle-o"></i>
                                        <span>Crear venta</span>

                                    </a>

                                </li>

                                <li>

                                    <a href="reportes">

                                        <i class="fa fa-circle-o"></i>
                                        <span>Reporte de ventas</span>

                                    </a>

                                </li>

                            </ul>

                        </li>';
                        }

            ?>

            <!-- FACTURACION -->
            <?php 
            if($_SESSION["facturacion"] == 1){
            ?>
            <li class="treeview">

                <a href="#">

                    <i class="fa fa-cart-plus text-green"></i>

                    <span>Facturación</span>

                    <span class="pull-right-container">

                        <i class="fa fa-angle-left pull-right"></i>

                    </span>

                </a>

                <ul class="treeview-menu">

                    <li>

                        <a href="pedidoscv">

                            <i class="fa fa-circle-o"></i>
                            <span>Administrar pedidos</span>

                        </a>

                    </li>

                    <li>

                        <a href="crear-pedidocv">

                            <i class="fa fa-circle-o"></i>
                            <span>Crear Pedidos</span>

                        </a>

                    </li>

                    <li>

                        <a href="reportes">

                            <i class="fa fa-circle-o"></i>
                            <span>Reporte de ventas</span>

                        </a>

                    </li>

                </ul>

            </li>
            <?php 
            }
            ?>

            <!-- FIN FACTURACION -->

            <!-- TICKET Joel -->

            <li class="treeview">

                <a href="#">

                    <i class="fa fa-inbox text-blue"></i>

                    <span>Ticket</span>

                    <span class="pull-right-container">

                        <i class="fa fa-angle-left pull-right"></i>

                    </span>

                </a>

                <ul class="treeview-menu">

                    <li>

                        <a href="contactos">

                            <i class="fa fa-users"></i>
                            <span>Contactos</span>

                        </a>

                    </li>

                    <li>

                        <a href="mailbox">

                            <i class="fa fa-envelope-o"></i>
                            <span>Mailbox</span>

                        </a>

                    </li>

                </ul>

            </li>

            <!-- fin maestros -->



        </ul>

    </section>

</aside>