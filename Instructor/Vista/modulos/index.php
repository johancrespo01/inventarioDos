<?php 
require_once CONTROL_PATH . 'Session.php';
$objss = new Session;
$objss->iniciar();
if ($_SESSION["validado"] != "SI") {

  $er = '2';
  $error = base64_encode($er);
    //header('Location:ingreso?er=' . $error);
  $salir = new Session;
  $salir->iniciar();
  $salir->outsession();
  header('Location:'.VISTA_PATH.'inicio?er='.$error);
  exit();
}
include_once VISTA_PATH . 'cabeza.php';
include_once VISTA_PATH . 'navegacion.php';

?>



<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column contenedorDeIndex">
  <!-- Main Content -->
  <div id="content">
    <!-----------------   AQUI MOSTRAR EL CONNTENIDO DE LA PAGINA   ----------------->
    <div class="table-responsive col-12 barra_navegacion">

     
      <!--ENLACES RECTANGULARES -->
      <!-- Content Row -->
      <div class="row containerDescripcion">
        <div class="container h-100">
          <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end">
              <h1 class="text-uppercase text-white font-weight-bold animated zoomIn">Bienvenido al Inventario del Sena Centro industrial y de aviacion</h1>
              <center><hr class="divider my-4 hrSeparator"></center>
            </div>
            <div class="col-lg-8 align-self-baseline animated bounceInUp">
              <p class="text-white-75 font-weight-light mb-5">Aqui usted podra ver todos los elementos que hay en el Sena, y podra hacer filtros de estos ya sea por ambientes de formacion o por tipo de elemento, ademas podra reportar una novedad de algun elemento u objeto que haya sufrido un cambio.</p>
            </div>
          </div>
        </div>
      </div>

      
      <div class="content-wrapper">
        <div class="container-fluid">
         <div class="formulario_empresa">
          <div id="datos">
          </div>
          <!--FIN FORMULARIO-->
        </div>
      </div>
    </div>
  </div>
  <!-- End of Main Content -->

  <!-- Footer -->

  <!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
<?php 
#include_once VISTA_PATH . 'pie.php';
include_once VISTA_PATH . 'scriptAndFinal.php';
?>
<script src="<?php echo PUBLIC_PATH; ?>js/jsMain.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/Elemento/mainElemento.js"></script>

