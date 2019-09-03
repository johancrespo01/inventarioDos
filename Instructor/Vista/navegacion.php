

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo BASE_URL ?>index">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Bienvenido 
          <?php
          @session_start();
           echo $_SESSION["persona"];
            ?>
              
            </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo BASE_URL ?>index">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Pagina principal</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>
      <!--<li class="nav-item">
          <a class="nav-link"  href="<?php echo BASE_URL ?>ingreso/ingreso_a_clases">
            <i class="fas fa-sign-in-alt"></i> <span>Inicio de clase</span></a>
      </li> -->

      <li class="nav-item">
          <a class="nav-link"  href="<?php echo BASE_URL ?>mi_inventario/mi_inventario">
            <i class="fas fa-sign-in-alt"></i> <span>Ver mi inventario</span></a>
      </li> 

      <li class="nav-item">
          <a class="nav-link"  href="<?php echo BASE_URL ?>Ambiente/tablaAmbiente">
            <i class="fas fa-sign-in-alt"></i> <span>Ver ambientes</span></a>
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
          <a class="nav-link"  href="<?php echo BASE_URL ?>salir">
            <i class="fa fa-fw fa-angle-left"></i></i><span>Salir</span></a>
        </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
      
      
        
      

    </ul>
    <!-- End of Sidebar -->
