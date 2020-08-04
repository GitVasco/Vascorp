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

            if (
                $_SESSION["perfil"] == "Supervisores" ||
                $_SESSION["perfil"] == "Sistemas"
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

                echo '<li>

                            <a href="usuarios">
            
                                <i class="fa fa-user"></i>
                                <span>Usuarios</span>
            
                            </a>
    
                        </li>
                        
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

                            </ul>
            
                        </li>
            
                        <!-- fin backend -->   ';
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

                echo '<!-- maestros Joel -->

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

            ?>

            <?php

            if (
                $_SESSION["perfil"] == "Sistemas" ||
                $_SESSION["perfil"] == "Supervisores" ||
                $_SESSION["perfil"] == "Produccion" ||
                $_SESSION["perfil"] == "Logistica" ||
                $_SESSION["perfil"] == "Costos"
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
                                
                                                        </ul>
                                                    </li>';

                }

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
                $_SESSION["perfil"] == "Sistemas" ||
                $_SESSION["perfil"] == "Supervisores" ||
                $_SESSION["perfil"] == "Produccion" ||
                $_SESSION["perfil"] == "Logistica" ||
                $_SESSION["perfil"] == "Udp" ||
                $_SESSION["perfil"] == "Costos"
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

                    echo '<li>
            
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

                echo '  
                        <li>
                            <a href="detalleoperaciones">
                                <i class="fa fa-bolt"></i>
                                <span>Operaciones Modelos</span>
                            </a>
                        </li>
            
                        <li>

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

                        </li>

                        <li>

                            <a href="clientes">

                                <i class="fa fa-users"></i>
                                <span>Clientes</span>

                            </a>

                        </li>

                        <li class="treeview">

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

            ?>

            <!-- FACTURACION -->

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