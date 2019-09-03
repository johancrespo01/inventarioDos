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

$id_ambiente = $_SESSION['ambiente'];

$int = ControlAmbiente::singleton_Ambiente();
$elementos = $int->mostrarAmbienteEspecificoControl($id_ambiente);
#var_dump($elementos);

?>
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
  <form method="POST">
    <input type="hidden" name="id_elemento" value=" <?php echo $elementos[0]['id_elemento']; ?> " >
      <div class="modal-body">
        <div class="form-group">                                        
            <label for="exampleInputEmail1">Material</label><br/>
            <select disabled class="selectpicker form-control" data-live-search="true" name="material">
                <option style="display: none"><?php echo $elementos[0]['material']; ?></option>
                <option data-tokens="ketchup mustard" name="material">Madera</option>
                <option data-tokens="mustard" name="material">Metal</option>
                <option data-tokens="mustard" name="material">Electronico</option>
                <option data-tokens="mustard" name="material">Plastico</option> 
            </select>                                  
        </div>  

        <div class="form-group">
            <label for="formGroupExampleInput">Nombre</label>
            <input  type="text_max2" class="form-control text_max" name="nombre" id="nombre" placeholder="Nombre del elemento" required Disabled value=" <?php echo $elementos[0]['nombre']; ?> ">
        </div>

        <div class="form-group">
            <label for="formGroupExampleInput">Descripcion</label>
            <input  type="text_max2" class="form-control text_max" name="descripcion" id="descripcion" placeholder="Descripcion aqui"  value="<?php echo $elementos[0]['descripcion']; ?>">
        </div>

        <div class="form-group">
            <label for="formGroupExampleInput">Numero de placa</label>
            <input  type="text" class="form-control text_max" name="numero_placa" id="numero_placa" required  Disabled value=" <?php echo $elementos[0]['placa']; ?> ">
        </div>

        <div class="form-group">
            <label for="formGroupExampleInput">Estado</label>
            <input  type="text" class="form-control text_max" name="estado" id="estado" placeholder="Estado" required value="<?php echo $elementos[0]['estado']; ?>">
        </div>

        <div class="form-group">                                        
            <label for="exampleInputEmail1">Aprendiz</label><br/>
            <select class="selectpicker form-control" data-live-search="true" name="ambiente" disabled>
                <?php
                $int = ControlAmbiente::singleton_Ambiente();
                $resultado = $int->mostrarAmbienteControlID($id_ambiente);
                $resultadoT = $int->mostrarAmbienteControl();
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

                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Serial</label>
                                    <input  type="text" class="form-control text_max2" name="serial" id="serial" placeholder="Serial" required disabled  value='<?php echo $elementos[0]['serial']; ?>'>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Peso en Kg</label>
                                    <input  type="text" class="form-control text_max2" name="Peso" id="Peso" placeholder="Peso" required disabled  value='<?php echo $elementos[0]['peso']; ?>'>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Ancho en cm</label>
                                    <input  type="text" class="form-control text_max2" name="Ancho" id="Ancho" placeholder="Ancho" required disabled  value='<?php echo $elementos[0]['ancho']; ?>'>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Alto en cm</label>
                                    <input  type="text" class="form-control text_max2" name="Alto" id="Alto" placeholder="Alto" required disabled  value='<?php echo $elementos[0]['alto']; ?>'>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Largo en cm</label>
                                    <input  type="text" class="form-control text_max2" name="Largo" id="Largo" placeholder="Largo" required disabled  value='<?php echo $elementos[0]['largo']; ?>'>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Precio</label>
                                    <input  type="text" class="form-control text_max2" name="Precio" id="Precio" placeholder="Precio" required disabled  value='<?php echo $elementos[0]['precio']; ?>'>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Marca</label>
                                    <input  type="text" class="form-control" name="marca" id="marca" placeholder="Marca" required disabled  value='<?php echo $elementos[0]['marca']; ?>'>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Fecha de adquisicion</label>
                                    <input  type="date" class="form-control" name="fecha_adquisicion" id="fecha_adquisicion" required disabled  value='<?php echo $elementos[0]['fecha_adquisicion']; ?>'>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Modulo</label>
                                    <input  type="text" class="form-control num_max" name="modulo" id="modulo" placeholder="Modulo" required disabled  value='<?php echo $elementos[0]['modulo']; ?>'>
                                </div>  
                            </div>
                            <div class="modal-footer">
                                <div class="row d-flex float-right"> 
                                  <div class="form-group">
                                    <input type="submit" class="btn btn-success" value="Guardar novedad">
                                </div>
                                &nbsp;  
                                <div class="form-group">
                                    <input type="button" data-dismiss="modal" class="btn btn-danger" value="Cancelar">
                                </div> 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php 
        include_once VISTA_PATH . 'scriptAndFinal.php';
        ?>