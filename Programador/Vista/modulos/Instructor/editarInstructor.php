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
require_once CONTROL_PATH . 'Instructor' . DS . 'ControlInstructor.php';

$int = ControlInstructor::singleton_Instructor();
#var_dump($resultadoT);exit();
if (isset($_POST['detalleClases'])) {
  $modificar = json_decode(stripslashes($_POST['detalleClases']));
  $id_instructorA = $modificar->id_Instructor;
    #echo $id_InstructorA;
}

$InstructorActual = $int->mostrarInstructorActualControl();
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
              <input type="hidden" name="id_Instructor" value="<?php echo $InstructorActual[0]['id_persona']; ?>">
              <div class="form-group">
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
              <div class="form-group">

                <label for="formGroupExampleInput2">Numero de documento</label>
                <input name="numero_documento" type="number" class="form-control" id="numDoc" placeholder="Document number" required value="<?php echo $InstructorActual[0]['numeroDocumento']; ?>">
              </div>

              <!--Contacto-->
              <div class="form-group">
                <label for="formGroupExampleInput">Nombres</label>
                <input  type="text" class="form-control text_max" name="nombre_user" id="nombre_user" placeholder="Name" required value="<?php echo $InstructorActual[0]['nombre']; ?>">
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput2">Apellidos</label>
                <input  type="text" class="form-control text_max2" name="apellido_user" id="apellido_user" placeholder="Last name" required value="<?php echo $InstructorActual[0]['apellido']; ?>">
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput2">Correo</label>
                <input  type="mail" class="form-control" name="correo_user" id="correo_user" placeholder="Mail" required value="<?php echo $InstructorActual[0]['correo']; ?>">
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput2">Telefono</label>
                <input  type="number" class="form-control num_max" name="telefono_user" id="telefono_user" placeholder="Phone" required value="<?php echo $InstructorActual[0]['telefono']; ?>">
              </div>
              <input type="submit" value="Modificar" class="btn btn-primary float-right" id="btn2">
              <a href="tablaInstructores" class="btn btn-danger izq" id="btn2">Cancelar </a>
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
