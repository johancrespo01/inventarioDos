<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', '..' . DS . '..' . DS . '..');
require_once '..' . DS . '..' . DS . '..' . DS . 'Config' . DS . 'Config.php';
require_once CONTROL_PATH . 'Ambiente' . DS . 'ControlAmbiente.php';
require_once CONTROL_PATH . 'Instructor' . DS . 'ControlInstructor.php';
require_once CONTROL_PATH . 'Elemento' . DS . 'ControlElemento.php';
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
require_once CONTROL_PATH . 'categorias' . DS . 'ControladorTodosElements.php';
$intR = ControlTodos::singleton_todos();
$resultado = $intR->todosLosElementosControl();
// var_dump($resultado);exit();
?>

<fieldset class="fieldset">
    <div id="datos"></div>
    <div class="tablaDiseño animated flipInX">
         <table id="buscarExt" class="responsive table text-center display table-striped table-bordered table-sm tablaA1" style="width:100%" cellspacing="0" width="100%">
   <thead>
    <tr>
     <br>
      <th class="text-center">MODIFICAR</th>
     <th class="text-center">PLACA</th>
     <th class="text-center">NOMBRE</th>
     <th class="text-center">DESCRIPCION</th>
     <th>TIPO ELEMENTO</th>
     <th class="text-center">SERIAL</th>
     <th class="text-center">PRECIO</th>
     <th class="text-center">AMBIENTE</th>
     <th class="text-center">RESPONSABLE</th>
     <th class="text-center">INGRESO</th>
      <th>ULTIMA NOVEDAD</th>
      <!-- <th>id material</th> -->

   </tr>
 </thead>
 <?php
 $cont = 0;
 foreach ($resultado as $key) {
   $cont ++;
   $materialID = $key['id_material'];
  // echo $materialID . " ";
   $placa = $key['placa'];
   $id_elemento = $key['id_elemento'];
   $nombreBD = $key['nombre'];
   $descripcion = $key['descripcion'];
   $serial = $key['serial'];
   $precio = $key['precio'];
   $estado = $key['estado'];
   $ambiente = $key['id_ambiente'];
   $responsable = $key['id_persona'];
   $ingreso = $key['fecha_ingreso'];


        #MOSTRAR AMBIENTE POR NOMBRE
   $intAmbiente = ControlAmbiente::singleton_Ambiente();
   $resultAmbiente = $intAmbiente->mostrarAmbienteControlPorId($ambiente);
   $NameAmbiente = $resultAmbiente[0]['nombre'];

   $intInstructor = ControlInstructor::singleton_Instructor();
   $resultInstructor = $intInstructor->mostrarInstructorControlPorId($responsable);
   $NameResponsable = $resultInstructor[0]['nombre'];


$resultadonovedad = ControlInstructor::singleton_instructor();
$resultnovedad = $resultadonovedad->mostrarnovedadelementoIDAJAXControlInstructor($id_elemento);
 $Novedad = $resultnovedad;

 $resultadomaterial = ControlElemento::singleton_elemento();
$resultmaterial = $resultadomaterial->mostrarNombrematerial($id_elemento);
 $material = $resultmaterial[0]['Descripcion'];
 //var_dump($material);exit();
 //echo $materialID;

   ?>
   <tr id="Elemento<?php echo $id_elemento; ?>">
    <td class="text-center">
    <a class="btn btn-primary btneditarE" value="<?php echo $id_elemento; ?>">
     <i class="fa fa-edit" id="icon" style="color: white"></i>
   </a>
   <input id="materialA" type="hidden" class="valorMaterial" value="<?php echo $materialID; ?>">
 </td>
    <td class="relleno text-center"><?php echo $placa; ?></td>
    <td class="relleno text-center"><?php echo $nombreBD; ?></td>
    <td class="relleno text-center"><?php echo $descripcion; ?></td>
    <td class="relleno"><?php echo $material; ?></td>
    <td class="relleno text-center"><?php echo $serial; ?></td>
    <td class="relleno text-center"><?php echo $precio; ?></td>
    <td class="relleno text-center"><?php echo $NameAmbiente; ?></td>
    <td class="relleno text-center"><?php echo $NameResponsable; ?></td>
    <td class="relleno text-center"><?php echo $ingreso; ?></td>
    <td class="relleno"><?php echo $Novedad; ?></td>
    <!-- <td id="materialentd" class="relleno" value="<?php echo $materialID; ?>"><?php echo $materialID; ?></td> -->
</tr>
<?php
}// Cierras el WHILE
// echo "Este es el contador: " . $cont;
?>
<script src="<?php echo PUBLIC_PATH; ?>js/Reporte/reportePorAmbienteCategorias/Atodos.js"></script>
</table>
</div>
</fieldset>
 <script src="<?php echo PUBLIC_PATH ?>js/mod/datatables.min.js"></script>
<!-- <script src="<?php echo PUBLIC_PATH; ?>js/categorias/mueble.js"></script> -->
<!-- <script src="<?php echo PUBLIC_PATH; ?>js/categorias/herramienta.js"></script> -->
