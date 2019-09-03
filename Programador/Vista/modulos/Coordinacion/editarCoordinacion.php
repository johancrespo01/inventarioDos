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
require_once CONTROL_PATH . 'Coordinacion' . DS . 'ControlCoordinacion.php';
require_once CONTROL_PATH . 'Centro' . DS . 'ControlCentro.php';
require_once CONTROL_PATH . 'Coordinador' . DS . 'ControlCoordinador.php';
$int = ControlCoordinacion::singleton_Coordinacion();
#var_dump($resultadoT);exit();
if (isset($_POST['detalleClases'])) {
  $modificar = json_decode(stripslashes($_POST['detalleClases']));
  $id_CoordinacionA = $modificar->id_Coordinacion;
}

$CoordinacionActual = $int->mostrarCoordinacionActualControl();
$id_centro = $CoordinacionActual[0]['id_centro'];
$id_coordinador = $CoordinacionActual[0]['id_persona'];
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
            <input type="hidden" name="id_Coordinacion" value="<?php echo $id_CoordinacionA; ?>">
                           <div class="form-group">                                        
                                    <label for="exampleInputEmail1">Centro</label><br/>
                                    <select class="selectpicker form-control" data-live-search="true" name="centro">
                                        <?php
                                        $int = ControlCentro::singleton_centro();
                                        $resultado = $int->mostrarCentroControl();
                                        $resultadoUnoCentro = $int->mostrarCentroControlID($id_centro);
                                        #var_dump($resultado);
                                        ?>

                                        <option data-tokens="ketchup mustard" name="centro" selected="true" style="display:none;" 
                                                value='<?php echo $resultadoUnoCentro[0]['id_centro']; ?>'><?php echo $resultadoUnoCentro[0]['nombre']; ?></option>

                                        <?php
                                        foreach ($resultado as $key) {
                                            $nom_centro = $key['nombre'];
                                            $id_centro = $key['id_centro'];
                                            ?>
                                            <option data-tokens="ketchup mustard" name="centro" value='<?php echo $id_centro; ?>' ><?php echo $nom_centro; ?></option>  
                                            <?php
                                        }//fin de for
                                        ?>
                                    </select>                                          
                                </div>
                            <!--Contacto-->
                            <div class="form-group">
                                <label for="formGroupExampleInput">Nombre</label>
                                <input  type="text" class="form-control text_max" name="nombre" id="nombre" placeholder="Name" required value="<?php echo $CoordinacionActual[0]['nombre']; ?>">
                            </div>
                            <div class="form-group">                                        
                                    <label for="exampleInputEmail1">Persona a cargo</label><br/>
                                    <select class="selectpicker form-control" data-live-search="true" name="responsable">
                                        <?php
                                        $int = ControlCoordinador::singleton_Coordinador();
                                        $Coordinadores = $int->mostrarCoordinadorControl();
                                        $CoordinadoresUno = $int->mostrarCoordinadorControlID($id_coordinador);
                                       # var_dump($Coordinadores);
                                        ?>

                                        <option data-tokens="ketchup mustard" name="Coordinador" selected="true" style="display:none;" 
                                                value='<?php echo $CoordinadoresUno[0]['id_persona']; ?>'><?php echo $CoordinadoresUno[0]['nombre']; ?></option>

                                        <?php
                                        foreach ($Coordinadores as $key) {
                                            $nom_Coordinador = $key['nombre'];
                                            $id_persona = $key['id_persona'];
                                            ?>
                                            <option data-tokens="ketchup mustard" name="Coordinador" value='<?php echo $id_persona; ?>' ><?php echo $nom_Coordinador; ?></option>  
                                            <?php
                                        }//fin de for
                                        ?>
                                    </select>                                          
                                </div>
                            
                            <input type="submit" value="Modificar" class="btn btn-primary float-right" id="btn2">
                            <a href="tablaCoordinacion" class="btn btn-danger izq" id="btn2">Cancelar </a>
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