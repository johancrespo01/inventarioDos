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
require_once CONTROL_PATH . 'Aprendiz' . DS . 'ControlAprendiz.php';
require_once CONTROL_PATH . 'Ambiente' . DS . 'ControlAmbiente.php';
require_once CONTROL_PATH . 'excel' . DS . 'importarExcel.php';
// POR AMBIENTES OBTENER TODOS LOS AMBIENTES
$int = ControlAmbiente::singleton_ambiente();
$AmbientesTotalBD = $int->mostrarAmbienteControl();
?>


<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
  <!-- Main Content -->
  <div id="content">
    <!-----------------   AQUI MOSTRAR EL CONNTENIDO DE LA PAGINA   ----------------->
    <!--BARRA DE NAVEGACION-->
    <div class="table-responsive col-12 barra_navegacion">

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo BASE_URL ?>index">Principal</a>
        </li>
        <li class="breadcrumb-item">
          <a href="crearAprendiz ">Registrar Aprendiz</a>
        </li>
      </ol>
    </div>
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <form id="formSubirExcel" method="POST" enctype="multipart/form-data">
              <div class="form-group" id="subir_archivo">
                <div class="formulario_empresa animated bounceInUp">
                  <legend class="text-center">Subir Masivo</legend>
                  <div class="form-group">
                    <label for="formGroupExampleInput2">Eliga que tipo de usuario subir</label>
                    <select id="tipoElemento" class="selectpicker form-control" data-live-search="true" name="ente" required>
                      <option data-tokens="ketchup mustard" value="0" >Seleccionar</option>
                                <option data-tokens="mustard" value="Tic">Tic</option>
                                <option data-tokens="mustard" value="Herramientas">Herramientas</option>
                                <option data-tokens="mustard" value="laboratorio">Equipos de laboratorio</option>
                                <option data-tokens="mustard" value="Muebles">Muebles</option>
                                <!-- <option data-tokens="mustard" value="Aprendiz">Aprendiz</option> -->
                                <option data-tokens="mustard" value="Instructor">Instructor</option>
                                <option data-tokens="mustard" value="Coordinador">Coordinador</option>
                                <option data-tokens="mustard" value="Programa">Programa</option>
                                <option data-tokens="mustard" value="Ambiente">Ambiente</option>
                    </select>
                  </div>



                  <label>Archivo a Subir</label><br/>
                  <input id="input-b3" name="excel" accept=".xlsx" type="file" class="file" data-show-upload="false" data-show-caption="true" data-msg-placeholder="Select {files} for upload...">
                  <br>
                  <input type="button" name="Enviar" id="btn_subir" value="Importar" class="btn btn-success der">
                  <br>
                </div>
              </div>

              <input type="hidden" value="upload" name="action"/>
              <input type="hidden" name="mod" value="usuarios"/>
              <input type="hidden" name="acc" value="masiva">

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
$intExcel = ImportarExcel::singleton_importarExcel();
$intExcel->importar();
  include_once VISTA_PATH . 'pie.php';
  include_once VISTA_PATH . 'scriptAndFinal.php';
  ?>
<script src="<?php echo PUBLIC_PATH; ?>js/Excel/subirExcel.js"></script>
