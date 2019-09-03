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
require_once CONTROL_PATH . 'Programa' . DS . 'ControlPrograma.php';
require_once CONTROL_PATH . 'Coordinacion' . DS . 'ControlCoordinacion.php';
$int = ControlPrograma::singleton_programa();
#var_dump($resultadoT);exit();
if (isset($_POST['detalleClases'])) {
  $modificar = json_decode(stripslashes($_POST['detalleClases']));
  $id_programaA = $modificar->id_Programa;
    #echo $id_InstructorA;
}

$ProgramaActual = $int->mostrarProgramaActualControl();

$int = ControlCoordinacion::singleton_coordinacion();
$resultado = $int->mostrarCoordinacionControl();
$resultadoUno = $int->mostrarCoordinacionControlID($id_programaA);
//var_dump($resultadoUno);exit();
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
                  <input type="hidden" name="id_programa" value="<?php echo $ProgramaActual[0]['id_programa']; ?>">
                            <!--Contacto-->
                            <div class="form-group">
                                    <label for="exampleInputEmail1">Coordinacion</label><br/>
                                    <select class="selectpicker form-control" data-live-search="true" name="coordinacion">
                                        <?php

                                        $coordinacion =  $resultadoUno[0]['nombre_coordinacion'];
                                        ?>

                                        <option data-tokens="ketchup mustard" name="coordinacion" selected="true" style="display:none;"
                                                value='<?php echo $resultadoUno[0]['id_coordinacion']; ?>'><?php echo $resultadoUno[0]['responsable']." - ", $coordinacion; ?></option>

                                        <?php
                                        foreach ($resultado as $key) {
                                            $nom_Coordinacion = $key['nombre_coordinacion'];
                                            $id_Coordinacion = $key['id_coordinacion'];
                                            $responsableCoordinacion = $key['responsable'];
                                            ?>
                                            <option data-tokens="ketchup mustard" name="Coordinacion" value='<?php echo $id_Coordinacion; ?>' ><?php echo $responsableCoordinacion. " - ", $nom_Coordinacion; ?></option>
                                            <?php
                                        }//fin de for
                                        ?>
                                    </select>
                                </div>


                            <div class="form-group">
                                <label for="formGroupExampleInput">Nombre</label>
                                <input  type="text" class="form-control text_max" name="nombre" id="nombre_user" placeholder="Nombre" required value="<?php echo $ProgramaActual[0]['nombre']; ?>">
                            </div>
                            <input type="submit" value="Modificar" class="btn btn-primary float-right" id="btn2">
                            <a href="tablaProgramas" class="btn btn-danger izq" id="btn2">Cancelar </a>
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
