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
require_once CONTROL_PATH . 'Aprendiz' . DS . 'ControlAprendiz.php';

 $int = ControlAprendiz::singleton_aprendiz();
 $aprendices = $int->mostrarAprendizEspecificoControl();

if (isset($_POST['detalleClases'])) {
    // echo "<script>alert('si existe la variable')</script>";
    $modificar = json_decode(stripslashes($_POST['detalleClases']));
    $id_aprendiz = $modificar->id_aprendiz;
}else{
 $material = "No existe ningun material";
}
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
              <form enctype="multipart/form-data" action="" method="POST" id="formadd" style="width:100%">
                <div class="form-group animated zoomInUp">
                    <label for="exampleInputEmail1">Tipo de documento</label><br/>
                    <select class="selectpicker form-control" data-live-search="true" name="tipoD">
                        <option data-tokens="ketchup mustard" name="tipoD">Cedula de Ciudadania</option>
                        <option data-tokens="mustard" name="tipoD">Tarjeta de Identidad</option>
                        <option data-tokens="mustard" name="tipoD">Cedula de Extranjeria</option>
                        <option data-tokens="mustard" name="tipoD">Numero ciego SENA</option>
                        <option data-tokens="mustard" name="tipoD">Pasaporte</option>
                        <option data-tokens="mustard" name="tipoD">Documento Nacional de Identificacion</option>
                        <option data-tokens="mustard" name="tipoD">Numero de Identificacion Tributaria</option>
                    </select>
                </div>

                <label id="validar"></label>
                <div class="form-group animated zoomInUp">

                    <label for="formGroupExampleInput2">Numero de documento</label>
                    <input name="numero_documento" type="number" class="form-control" id="numDoc" placeholder="Document number" required>
                </div>

                <!--Contacto-->
                <div class="form-group animated zoomInUp">
                    <label for="formGroupExampleInput">Nombre</label>
                    <input  type="text" class="form-control text_max" name="nombre_user" id="nombre_user" placeholder="Name" required>
                </div>
                <div class="form-group animated zoomInUp">
                    <label for="formGroupExampleInput2">Apellido</label>
                    <input  type="text" class="form-control text_max2" name="apellido_user" id="apellido_user" placeholder="Last name" required>
                </div>
                <div class="form-group animated zoomInUp">
                    <label for="formGroupExampleInput2">Correo</label>
                    <input  type="mail" class="form-control" name="correo_user" id="correo_user" placeholder="Mail" required>
                </div>
                <div class="form-group animated zoomInUp">
                    <label for="formGroupExampleInput2">Telefono</label>
                    <input  type="number" class="form-control num_max" name="telefono_user" id="telefono_user" placeholder="Phone" required>
                </div>
                <input type="submit" value="Registrar" class="btn btn-primary float-right" id="btn2">
                <a href="crearAprendiz" class="btn btn-danger izq" id="btn2">Cancelar </a>
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
