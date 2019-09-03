<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', '..' . DS . '..' . DS . '..');
require_once '..' . DS . '..' . DS . '..' . DS . 'Config' . DS . 'Config.php';
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
require_once CONTROL_PATH . 'Elemento' . DS . 'ControlElemento.php';
require_once CONTROL_PATH . 'Centro' . DS . 'ControlCentro.php';
require_once CONTROL_PATH . 'Programa' . DS . 'ControlPrograma.php';

$int = ControlCentro::singleton_centro();
#var_dump($resultadoT);exit();
if (isset($_POST['detalleClases'])) {
  $modificar = json_decode(stripslashes($_POST['detalleClases']));
  $id_centro = $modificar->id_centro;
    #echo $id_centro;
}

$CentroActual = $int->mostrarCentroActualControl();
// var_dump($CentroActual[0]['region']);exit();
?>

<div id="ex1" class="modal">
  <p>Thanks for clicking. That felt good.</p>
  <a href="#" rel="modal:close">Close</a>
</div>


<script type="text/javascript">
 $(".modal-active").click();
</script>
<input type="hidden" data-toggle="modal" data-target="#exampleModal" class="modal-active">

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary" id="exampleModalLabel">Datos del elemento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <form enctype="multipart/form-data" action="" method="POST" id="formadd" style="width: 100%;">
              <input type="hidden" name="CentroActual" value="<?php echo $CentroActual[0]['id_centro']; ?>">
              <div class="form-group">                                        
                <label for="exampleInputEmail1">Region</label><br/>
                <select class="selectpicker form-control" data-live-search="true" name="region">
                  <option style="display: none"><?php echo $CentroActual[0]['region']; ?></option>
                  <option data-tokens="ketchup mustard" name="region">Caribe</option>
                  <option data-tokens="mustard" name="region">Amazonia</option>
                  <option data-tokens="mustard" name="region">Andina</option>
                  <option data-tokens="mustard" name="region">Insular</option>
                  <option data-tokens="mustard" name="region">Orinoquía</option>
                  <option data-tokens="mustard" name="region">Pacífico</option>
                </select>                                          
              </div>
              <!--Contacto-->
              <div class="form-group">
                <label for="formGroupExampleInput">Nombre</label>
                <input  type="text" class="form-control text_max" name="nombre" id="nombre_user" placeholder="Nombre" required value="<?php echo $CentroActual[0]['nombre']; ?>">
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput2">Direccion</label>
                <input  type="text" class="form-control text_max2" name="direccion" id="direccion" placeholder="Last name" required value="<?php echo $CentroActual[0]['direccion']; ?>">
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput2">Telefono</label>
                <input  type="text" class="form-control text_max2" name="telefono" id="telefono" placeholder="telefono" required value="<?php echo $CentroActual[0]['telefono']; ?>">
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput2">correo</label>
                <input  type="mail" class="form-control text_max2" name="correo" id="correo" placeholder="correo" required value="<?php echo $CentroActual[0]['correo']; ?>">
              </div>
              <input type="submit" value="Modificar" class="btn btn-primary float-right" id="btn2">
              <a href="tablaCentro" class="btn btn-danger izq" id="btn2">Cancelar </a>
              <br>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php 
include_once VISTA_PATH . 'scriptAndFinal.php';
?>