<?php
require_once CONTROL_PATH . 'Session.php';
$objss = new Session;
$objss->iniciar();
if(!isset($_SESSION["validado"])){
  $er = '2';
  $error = base64_encode($er);
  $salir = new Session;
  $salir->iniciar();
  $salir->outsession();
  echo '<script>window.location.replace("../inicio?er='.$error.'");</script>';
  exit();
}
include_once VISTA_PATH . 'cabeza.php';
include_once VISTA_PATH . 'navegacion.php';
require_once CONTROL_PATH . 'Elemento' . DS . 'ControlElemento.php';
?>



<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
  <!-- Main Content -->
  <div id="content">
    <!-----------------   AQUI MOSTRAR EL CONNTENIDO DE LA PAGINA   ----------------->
    <div class="table-responsive col-12 barra_navegacion">

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo BASE_URL ?>index">Principal</a>
        </li>

      </ol>
      <!--ENLACES RECTANGULARES -->
      <!-- Content Row -->
      <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4 animated fadeInUpBig">
          <a style="cursor:pointer;" id="por_ambiente" value="madera"><div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="masGrande text-xs font-weight-bold text-primary text-uppercase mb-1">Reporte por</div>
                  <div class="masGrande h5 mb-0 font-weight-bold text-gray-800">Ambiente</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-home fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div></a>
        </div>



        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4 animated fadeInUpBig">
          <a style="cursor:pointer;" id="instructor" class="instructor" value="metal"><div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="masGrande text-xs font-weight-bold text-success text-uppercase mb-1">Reporte por</div>
                  <div class="masGrande h5 mb-0 font-weight-bold text-gray-800">Instructor</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div></a>
        </div>




      <!--FIN ENLACES RECTANGULARES-->

    </div>
    <!--FORMULARIO PARA REALIZAR BUSQUEDAS-->

<div id="listaContacto"></div>
    <div class="content-wrapper">
      <div class="container-fluid">
       <div class="formulario_empresa">
        <div id="datos">
          <!--AQUI CONTENIDO DINAMICO-->

        </div>
        <!--FIN FORMULARIO-->
      </div>
    </div>
  </div>
</div>
<!-- End of Main Content -->
<?php
if (isset($_POST['serial'])) {
 $intContact = ControlElemento::singleton_elemento();
 $intContact->modificarElemento();
  //echo "<script>alert('modificar...')</script>";
} else {
    #echo "<script>alert('No existe la variable ')</script>";
}
?>
<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; Your Website 2019</span>
    </div>
  </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<?php
#include_once VISTA_PATH . 'pie.php';
// include_once VISTA_PATH . 'scriptAndFinal.php';
?>
<script src="<?php echo PUBLIC_PATH; ?>js/Reporte/reporte.js"></script>
<!-- <script src="<?php echo PUBLIC_PATH; ?>js/Ambiente/mainAmbiente.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/Elemento/mainElemento.js"></script>
 <script src="<?php echo PUBLIC_PATH; ?>js/sweet_alert.js"></script> -->
