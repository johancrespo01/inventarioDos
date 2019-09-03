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
$int = ControlAmbiente::singleton_Ambiente();
$elementos = $int->mostrarAmbienteEspecificoControl();
$resultadoT = $int->mostrarAmbienteControl();
$int2 = ControlInstructor::singleton_Instructor();
$datospersona = $int2->mostrarInstructorControl($_SESSION['id_usuario']);
// var_dump($datospersona);exit();

?>

<script type="text/javascript">
   $(".modal-active").click();
</script>
<input type="hidden" data-toggle="modal" data-target="#exampleModal" class="modal-active">

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h5 class="modal-title text-primary" id="exampleModalLabel">Adicionar novedad</h5></center>
        <button id="cerrarModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form method="POST">
    <input type="hidden" name="id_elemento" value=" <?php echo $elementos[0]['id_elemento']; ?> " >
    <div class="modal-body">

        <div class="form-group">
            <label for="formGroupExampleInput">Novedad</label>
            <input  type="text_max2" class="form-control text_max" name="descripcion" id="descripcion">
        </div>
       
        <input id="idenElement" type="hidden" class="form-control text_max" name="id_elemento"  placeholder="Descripcion aqui"  value="<?php echo $elementos[0]['id_elemento']; ?>">

        <input  type="hidden" class="form-control text_max" name="id_ambiente" placeholder="Descripcion aqui"  value=" <?php echo $elementos[0]['id_ambiente'];?>" id="id_ambiente">

         <input  type="hidden" class="form-control text_max" name="nombreElemento" placeholder="Descripcion aqui"  value=" <?php echo $elementos[0]['nombre'];?>" id="nombreElemento">

         <input  type="hidden" class="form-control text_max" name="placa" placeholder="Descripcion aqui"  value=" <?php echo $elementos[0]['placa'];?>" id="placa">

         <input  type="hidden" class="form-control text_max" name="serial" placeholder="Descripcion aqui"  value=" <?php echo $elementos[0]['serial'];?>" id="serial">

         <input  type="hidden" class="form-control text_max" name="nombreAmbiente" placeholder="Descripcion aqui"  value=" <?php echo $resultadoT[0]['nombre']; ?> " id="nombreAmbiente">

          <input  type="hidden" class="form-control text_max" name="apellido" placeholder="Descripcion aqui"  value=" <?php echo $datospersona[0]['apellido'];?>" id="apellido">

         <input  type="hidden" class="form-control text_max" name="correo" placeholder="Descripcion aqui"  value=" <?php echo $datospersona[0]['correo']; ?>" id="correo">
      
         <input  type="hidden" class="form-control text_max" name="usuario"  placeholder="Descripcion aqui"  value=" <?php  echo $_SESSION["usuario"];?>" id="usuario">
       

    </div>
    <div class="modal-footer">
        <div class="row d-flex float-right"> 
          <div class="form-group">
            <input id="btn-enviar-por-ajax" type="button" class="btn btn-success" value="Guardar novedad">
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
<script src="<?php echo PUBLIC_PATH; ?>js/enviarFormularioElemento.js"></script>