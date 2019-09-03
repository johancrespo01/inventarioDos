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
  echo '<script>window.location.replace(../inicio?er='.$error.'");</script>';
  //header('Location:'.VISTA_PATH.'inicio?er='.$error);
  exit();
}
include_once VISTA_PATH . 'cabeza.php';
require_once CONTROL_PATH . 'Elemento' . DS . 'ControlElemento.php';
require_once CONTROL_PATH . 'Ambiente' . DS . 'ControlAmbiente.php';
require_once CONTROL_PATH . 'Programa' . DS . 'ControlPrograma.php';
$int = ControlAmbiente::singleton_ambiente();
#var_dump($resultadoT);exit();
if (isset($_POST['detalleClases'])) {
    $modificar = json_decode(stripslashes($_POST['detalleClases']));
    $id_ambienteA = $modificar->id_ambiente;
    #echo $id_ambienteA;
}

$ambienteActual = $int->mostrarAmbienteActualControl();

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
            <form class="col-12" enctype="multipart/form-data" action="" method="POST" id="formadd">
                <input type="hidden" name="id_ambienteA" value=" <?php echo $id_ambienteA ?> ">
              <!--Contacto-->
              <div class="form-group">
                <label for="formGroupExampleInput">Nombre</label>
                <input  type="text" class="form-control text_max" name="nombre" id="nombre_user" placeholder="Nombre" required value=" <?php echo $ambienteActual[0]['nombre']; ?> ">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Programa</label><br/>
                <select class="selectpicker form-control" data-live-search="true" name="programa">
                  <?php
                  $int = ControlPrograma::singleton_Programa();
                  $resultado = $int->mostrarProgramaEspecificoControl($ambienteActual[0]['id_programa']);
                                        #$Programa =  $resultado[0]['nombre_Programa'];
                  ?>

                  <option data-tokens="ketchup mustard" name="programa" selected="true" style="display:none;"
                  value='<?php echo $resultado[0]['id_programa']; ?>'><?php echo $resultado[0]['nombre']; ?></option>

                  <?php
                  foreach ($resultado as $key) {
                    $nom_Programa = $key['nombre'];
                    $id_programa = $key['id_programa'];

                                            #$responsablePrograma = $key['responsable'];
                    ?>
                    <option data-tokens="ketchup mustard" name="programa" value='<?php echo $id_programa; ?>' ><?php echo $nom_Programa; ?></option>
                    <?php
                                        }//fin de for
                                        ?>
                                      </select>
                                    </div>



                                    <input type="submit" value="Modificar" class="btn btn-primary float-right" id="btn2">
                                    <a href="tablaAmbiente" class="btn btn-danger izq" id="btn2">Cancelar</a>
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
                      <script src="<?php echo PUBLIC_PATH; ?>js/categorias/validacion.js"></script>
