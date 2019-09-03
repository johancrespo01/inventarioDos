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
  //header('Location:'.VISTA_PATH.'inicio?er='.$error);
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
      <div class="row col-12 h-30">

        <!-- Earnings (Monthly) Card Example -->
        <div class=" mw-25 col-xl-3 col-md-6 mb-4 animated fadeInUpBig" style="max-width: 20%;">
          <a style="cursor:pointer;" id="mueble" value="2"><div class="card border-left-primary shadow h-100 py-2 imagenAmpliah">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Ver:</div>
                  <div class="h6 mb-0 font-weight-bold text-gray-800">Muebles</div>
                </div>
                <div class="col-auto">
                  <i class="fa fa-couch fa-2x text-gray-500"></i>
                </div>
              </div>
            </div>
          </div></a>
        </div>



        <!-- Earnings (Monthly) Card Example -->
        <div class=" col-xl-3 col-md-6 mb-4 animated fadeInUpBig" style="max-width: 20%;">
          <a style="cursor:pointer;" id="herramienta" value="3"><div class="card border-left-success shadow h-100 py-2 imagenAmpliah">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ver:</div>
                  <div class="h6 mb-0 font-weight-bold text-gray-800">Herramienta</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-hammer fa-2x text-gray-500"></i>
                </div>
              </div>
            </div>
          </div></a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class=" col-xl-3 col-md-6 mb-4 animated fadeInUpBig" style="max-width: 20%;">
          <a style="cursor: pointer;" id="laboratorio" value="4">
            <div class="card border-left-info shadow h-100 py-2 imagenAmpliah">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Ver:</div>
                    <div class="row no-gutters align-items-center">
                      <div class="col-auto">
                        <div class="h6 mb-0 mr-3 font-weight-bold text-gray-800">Laboratorio</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-flask fa-2x text-gray-500"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

        <!-- Pending Requests Card Example -->
        <div class=" col-xl-3 col-md-6 mb-4 animated fadeInUpBig " style="max-width: 20%;">
          <a style="cursor:pointer;" id="tic" value="5"><div class="card border-left-warning shadow h-100 py-2 imagenAmpliah">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Ver:</div>
                  <div class="h6 mb-0 font-weight-bold text-gray-800">TIC</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-tv fa-2x text-gray-500"></i>
                </div>
              </div>
            </div>
          </div>
        </div></a>

        <div class="col-xl-3 col-md-6 mb-4 animated fadeInUpBig" style="max-width: 20%;">
          <a style="cursor:pointer;" id="todosElementos" value="2"><div class="card border-left-danger shadow h-100 py-2 imagenAmpliah ">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Ver:</div>
                  <div class="h6 mb-0 font-weight-bold text-gray-800">Todos</div>
                </div>
                <div class="col-2">
                   <i class="fas fa-hammer fa-1x text-gray-500"></i>
                  <i class="fas fa-flask fa-1x text-gray-500"></i>
                </div>
                <div class="col-2">
                  <i class="fas fa-tv fa-1x text-gray-500"></i>
                  <i class="fa fa-couch fa-1x text-gray-500"></i>
                </div>
              </div>
            </div>
          </div></a>
        </div>

      </div>

      <!--FIN ENLACES RECTANGULARES-->
    </div>

    <div id="listaContacto"></div>

    <div class="content-wrapper">
      <div class="container-fluid">
       <div class="formulario_empresa">
        <div id="datos">
              <div id="mensaje">
<br><br>
<div  class="responsive text-center alert alert-info h4 animated bounceInUp">

 ¡Atento! Recuerde que debe seleccionar un tipo de elemento para poder mostar la información requerida.
</div>
</div>
        </div>
        <!--FIN FORMULARIO-->
      </div>
    </div>
  </div>
</div>


<!-- End of Main Content -->
<?php
if (isset($_POST['numero_placa'])) {
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
include_once VISTA_PATH . 'scriptAndFinal.php';
?>
<script src="<?php echo PUBLIC_PATH ?>js/mod/datatables.min.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/jsMain.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/Elemento/mainElemento.js"></script>
