<?php @session_start(); ?>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo BASE_URL ?>index">
                <div class="sidebar-brand-icon"><!--rotate-n-15-->
                   <img style="width: 50px; height: 60px;" src="<?php echo BASE_URL ?>Public/img/sena.png" alt="SENA" class="img-circle">
                </div>
                <div class="sidebar-brand-text mx-3">Bienvenido
                    <?php
                    echo $_SESSION["personaUno"];
                    ?>
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo BASE_URL ?>index">
                    <i class="fas fa-fw far fa-boxes"></i>
                    <span>Inventario</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->


            <li class="nav-item">
                <a class="nav-link" href="<?php echo BASE_URL ?>Reportes/reportes">
                    <i class="fas fa-fw fa-clipboard"></i> <span>Reporte</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-user-plus"></i>
                    <span>Registrar</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Registrar un:</h6>
                        <a class="collapse-item" href="<?php echo BASE_URL ?>Objeto/registrarObjeto">Elemento</a>
                        <!-- <a class="collapse-item" href="<?php echo BASE_URL ?>Aprendiz/crearAprendiz">Aprendiz</a> -->
                        <a class="collapse-item" href="<?php echo BASE_URL ?>Instructor/registrarInstructor">Instructor</a>
                        <a class="collapse-item" href="<?php echo BASE_URL ?>Coordinador/registrarCoordinador">Coordinador</a>
                        <!-- <a class="collapse-item" href="#">Subdirector</a> -->
                        <a class="collapse-item" href="<?php echo BASE_URL ?>Centro/registrarCentro">Centro</a>
                        <a class="collapse-item" href="<?php echo BASE_URL ?>Coordinacion/registrarCoordinacion">Coordinacion</a>
                        <a class="collapse-item" href="<?php echo BASE_URL ?>Programa/registrarPrograma">Programa</a>
                        <a class="collapse-item" href="<?php echo BASE_URL ?>Ambiente/registrarAmbiente">Ambiente</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-table"></i>
                    <!--<i class="fas fa-fw fa-wrench"></i>-->
                    <span>Ver registros</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Reporte de:</h6>
                        <!-- <a class="collapse-item" href="<?php echo BASE_URL ?>Aprendiz/tablaAprendiz">Aprendices</a> -->
                        <a class="collapse-item" href="<?php echo BASE_URL ?>Instructor/tablaInstructores">Instructores</a>
                        <a class="collapse-item" href="<?php echo BASE_URL ?>Coordinador/tablaCoordinador">Coordinadores</a>
                        <a class="collapse-item" href="<?php echo BASE_URL ?>Coordinacion/tablaCoordinacion">Coordinacion</a>
                        <a class="collapse-item" href="<?php echo BASE_URL ?>Centro/tablaCentro">Centro</a>
                        <a class="collapse-item" href="<?php echo BASE_URL ?>Programa/tablaProgramas">Programas</a>
                        <a class="collapse-item" href="<?php echo BASE_URL ?>Ambiente/tablaAmbiente">Ambientes</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities2">
                    <i class="fas fa-fw fa-upload"></i>
                    <!--<i class="fas fa-fw fa-wrench"></i>-->
                    <span>Subir Masivamente</span>
                </a>
                <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Reporte de:</h6>
                        <a class="collapse-item" href="<?php echo BASE_URL ?>subirImportar/descargarExcel">Descargar formato</a>
                        <a class="collapse-item" href="<?php echo BASE_URL ?>subirImportar/subirExcel">Subir Formato</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo BASE_URL ?>cambiarPassword">
                   <i class="fas fa-fw fa-cog"></i> <span>Cambiar contraseña</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>




            <li class="nav-item">
                <a class="nav-link" href="<?php echo BASE_URL ?>salir">
                    <i class="fas fa-sign-out-alt"></i></i>Salir</a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>



        </ul>
        <!-- End of Sidebar -->
