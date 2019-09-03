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
require_once CONTROL_PATH . 'Ambiente' . DS . 'ControlAmbiente.php';
require_once CONTROL_PATH . 'Instructor' . DS . 'ControlInstructor.php';
//echo "HOla mundo ";
$int = ControlAmbiente::singleton_Ambiente();
$elementos = $int->mostrarAmbienteEspecificoControl();
 $nombrematerial=$int->mostrarmaterial($elementos[0]['id_material']);
$resultadoT = $int->mostrarAmbienteControl();
// var_dump($elementos);exit();
if (isset($_POST['detalleClases'])) {
    // echo "<script>alert('si existe la variable')</script>";
    $modificar = json_decode(stripslashes($_POST['detalleClases']));
    $id_elementoA = $modificar->id_elemento;
    $material = $modificar->material;
    //echo $material;exit();
}else{
   $material = "No existe ningun material";
}
var_dump($material);exit();
?>

<script type="text/javascript">
   $(".modal-active").click();
</script>
<input type="hidden" data-toggle="modal" data-target="#exampleModal" class="modal-active">
<input type="hidden" name="materialForValidacion" id="materialForValidacion" value=" <?php echo $elementos[0]['id_material']; ?> ">
<div class="modal fade" id="exampleModal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary" id="exampleModalLabel">Novedad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form method="POST">
    <input type="hidden" id="idenElement" name="id_elemento" value="<?php echo $elementos[0]['id_elemento']; ?>">
    <input type="hidden" id="materialA" name="materialA" value="<?php echo $material;?>" >
      <div class="modal-body">
        <div class="form-group">
                            <select id="tipo_elemento" class="selectpicker form-control" enabled="false" data-live-search="true" name="material">
                                <option  style="display: none;" data-tokens="ketchup mustard" name="responsable" value='<?php echo $elementos[0]['id_material']; ?>' ><?php echo $nombrematerial[0]["Descripcion"]; ?></option>
                            </select>
                        </div>

       <div class="form-group animated zoomInUp" style = "display:none;" id="Dresponsable">
                            <label for="exampleInputEmail1">Responsable de este elemento</label><br/>
                            <select id="responsableElemento" class="selectpicker form-control animated zoomInUp" data-live-search="true" name="responsable" required>
                                <?php
                                $intInstructor = ControlInstructor::singleton_instructor();
                                $todos = $intInstructor->mostrarInstructorControl();
                                $resultado = $intInstructor->mostrarInstructorControlPorId($elementos[0]['id_persona']);
                                $instructor =  $resultado[0]['nombre'];

                                ?>
                                <option style="display: none;" data-tokens="ketchup mustard" name="responsable" value='<?php echo $resultado[0]['id_persona']; ?>' ><?php echo $resultado[0]['nombre']; ?></option>
                                <?php
                                foreach ($todos as $key) {
                                    $nom_instructor = $key['nombre'];
                                    $id_instructor = $key['id_persona'];
                                    ?>
                                    <option data-tokens="ketchup mustard" name="responsable" value='<?php echo $id_instructor; ?>' ><?php echo $nom_instructor; ?></option>
                                    <?php

                                        }//fin de for
                                        ?>
                                    </select>
                                </div>


                                <div class="form-group animated zoomInUp" id="Dnombre" style = "display:none;">
                                    <label for="formGroupExampleInput">Nombre</label>
                                    <input  type="text_max2" class="form-control text_max" name="nombre" id="nombre" placeholder="Nombre del elemento" required value="<?php echo $elementos[0]['nombre']; ?>">
                                </div>

                                <div id="Ddescripcion" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="formGroupExampleInput">Descripcion</label>
                                    <input  type="text_max2" class="form-control text_max" name="descripcion" id="descripcion" placeholder="Informacion adicional aqui" value="<?php echo $elementos[0]['descripcion']; ?>">
                                </div>

                                <div id="Dplaca" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="formGroupExampleInput">Numero de placa</label>
                                    <input  type="number" class="form-control text_max" name="numero_placa" id="numero_placa" placeholder="Numero de placa" required value="<?php echo $elementos[0]['placa']; ?>">
                                </div>

                                <div id="Dambiente" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="exampleInputEmail1">Ambiente</label><br/>
                                    <select id="ambiente" class="selectpicker form-control" data-live-search="true" name="ambiente">
                                        <?php
                                        $int = ControlAmbiente::singleton_Ambiente();
                                        $resultado = $int->mostrarAmbienteControlPorId($elementos[0]['id_ambiente']);
                                        $ambiente =  $resultado[0]['nombre'];
                                        ?>

                                        <option data-tokens="ketchup mustard" name="ambiente" selected="true" style="display:none;"
                                        value='<?php echo $resultado[0]['id_ambiente']; ?>'><?php echo $ambiente; ?></option>

                                        <?php
                                        foreach ($resultadoT as $key) {
                                            $nom_ambiente = $key['nombre'];
                                            $id_ambiente = $key['id_ambiente'];
                                            ?>
                                            <option data-tokens="ketchup mustard" name="ambiente" value='<?php echo $id_ambiente; ?>' ><?php echo $nom_ambiente; ?></option>
                                            <?php
                                        }//fin de for
                                        ?>
                                    </select>
                                </div>


                                <div id="Dserial" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="formGroupExampleInput2">Serial</label>
                                    <input  type="number" class="form-control text_max2" name="serial" id="serial" placeholder="Serial" required value="<?php echo $elementos[0]['serial']; ?>">
                                </div>
                                <!-- DETALLES -->
                                <div id="Dpeso" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="formGroupExampleInput2">Peso en Kg</label>
                                    <input  type="number" class="form-control text_max2" name="Peso" id="Peso" placeholder="Peso" value="<?php echo $elementos[0]['peso']; ?>">
                                </div>
                                <div id="Dancho" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="formGroupExampleInput2">Ancho en cm</label>
                                    <input  type="number" class="form-control text_max2" name="Ancho" id="Ancho" placeholder="Ancho" value="<?php echo $elementos[0]['ancho']; ?>">
                                </div>
                                <div id="Dalto" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="formGroupExampleInput2">Alto en cm</label>
                                    <input  type="number" class="form-control text_max2" name="Alto" id="Alto" placeholder="Alto" value="<?php echo $elementos[0]['alto']; ?>">
                                </div>
                                <div id="Dlargo" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="formGroupExampleInput2">Largo en cm</label>
                                    <input  type="number" class="form-control text_max2" name="Largo" id="Largo" placeholder="Largo" value="<?php echo $elementos[0]['largo']; ?>">
                                </div>
                                <div id="Dprecio" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="formGroupExampleInput2">Precio</label>
                                    <input  type="number" class="form-control text_max2" name="Precio" id="Precio" placeholder="Precio" value="<?php echo $elementos[0]['precio']; ?>">
                                </div>
                                <!-- AQUI HACER MEMORIA INFORMATICA -->


                                <div id="Dram" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="formGroupExampleInput2">Ram</label><br>
                                    <div id="DaplicaRam" class="custom-control custom-checkbox form-group animated zoomInUp">
                                      <input type="checkbox" class="custom-control-input" id="defaultUncheckedU">
                                      <label class="custom-control-label" for="defaultUncheckedU">Aplica</label>
                                  </div>
                                    <input readonly="readonly" type="text" class="form-control" name="ram" id="ram" placeholder="Ram" value="<?php echo $elementos[0]['ram']; ?>">
                                </div>

                                <div id="Dprocesador" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="formGroupExampleInput2">Procesador</label><br>
                                    <div id="DaplicaProcesador" class="custom-control custom-checkbox form-group animated zoomInUp">
                                          <input type="checkbox" class="custom-control-input" id="defaultUncheckedD">
                                          <label class="custom-control-label" for="defaultUncheckedD">Aplica</label>
                                    </div>
                                    <input readonly="readonly" type="text" class="form-control" name="procesador" id="procesador" placeholder="Procesador" value="<?php echo $elementos[0]['procesador']; ?>">
                                </div>

                                <div id="Dalmacenamiento" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="formGroupExampleInput2">Almacenamiento</label><br>
                                    <div id="Daplicaalmacenamiento" class="custom-control custom-checkbox form-group animated zoomInUp">
                                          <input type="checkbox" class="custom-control-input checkboxTres" id="defaultUncheckedT">
                                          <label class="custom-control-label" for="defaultUncheckedT">Aplica</label>
                                    </div>
                                    <input readonly="readonly" type="text" class="form-control" name="almacenamiento" id="almacenamiento" placeholder="Almacenamiento" value="<?php echo $elementos[0]['almacenamiento']; ?>">
                                </div>
                                <!-- FIN DE MEMORIA INFORMATICA -->

                                <!--MARCA DEBE SER FORANEA -->
                                <div id="Dmarca" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="formGroupExampleInput2">Marca</label>
                                    <input  type="text" class="form-control" name="marca" id="marca" placeholder="Marca" value="<?php echo $elementos[0]['id_marca']; ?>">
                                </div>
                                <div id="Dfecha_adquisicion" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="formGroupExampleInput2">Fecha de adquisicion</label>
                                    <input  type="date" class="form-control" name="fecha_adquisicion" id="fecha_adquisicion" value="<?php echo $elementos[0]['fecha_ingreso']; ?>">
                                </div>

                                <input type="submit" value="Modificar" class="btn btn-primary float-right animated zoomInUp" id="btn2">
                                <br>
                    </form>
                </div>
            </div>
        </div>
        <script src="<?php echo PUBLIC_PATH; ?>js/categorias/validacion.js"></script>
        <?php


        ?>
