<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', '..' . DS . '..' . DS . '..');
require_once '..' . DS . '..' . DS . '..' . DS . 'Config' . DS . 'Config.php';
require_once CONTROL_PATH . 'Ambiente' . DS . 'ControlAmbiente.php';
require_once CONTROL_PATH . 'Coordinador' . DS . 'ControlCoordinador.php';
require_once CONTROL_PATH . 'Instructor' . DS . 'ControlInstructor.php';
require_once CONTROL_PATH . 'Elemento' . DS . 'ControlElemento.php';

$resultado = ControlInstructor::singleton_instructor();
$resultado = $resultado->mostrarLimitadoElementoPorIDAJAXControlInstructor();
//var_dump($resultado);
if (isset($_POST['parametro'])) {
  $modificar = json_decode(stripslashes($_POST['parametro']));
  $id_instructorA = $modificar->id;
  $filtro = $modificar->fil;
}
?>
<script type="text/javascript">
  $(".tabla1").hide();
</script>
<br>
<a class="btn btn-success btnRetrocesoDos animated zoomInUp" id="<?php echo $id_instructorA; ?>">
  <i class="fa fa-arrow-left"></i>
  
</a>
<br>
<?php 
if ($filtro == 2) { //if de muebles
?>
<div id="listaContacto animated zoomInUp"></div>
<div class="tablaDiseño animated zoomInUp">
  <table class="responsive table text-center table-striped table-bordered table-sm" id="tablaMueble" cellspacing="0" width="100%">
   <thead>
    <tr>
     <br>
     <th>editar</th>
     <th>PLACA</th>
     <th>NOMBRE</th>
     <th>DESCRIPCION</th>
     <th>SERIAL</th> 
     <th>PRECIO</th>
     <th>PESO</th>
     <!--<th>FECHA DE ADQUISICION<hr></th>-->
     <th>AMBIENTE</th>
     <th>RESPONSABLE</th>
     <th>ANCHO</th>
     <th>ALTO</th>
     <th>LARGO</th>
     <th>INGRESO</th>
      <th>ULTIMA NOVEDAD</th>
   </tr>
 </thead>
 <?php
 foreach ($resultado as $key) {
   $placa = $key['placa'];
   $id_elemento = $key['id_elemento'];
   $nombreBD = $key['nombre'];
   $descripcion = $key['descripcion'];
   $serial = $key['serial'];
   $precio = $key['precio'];
   $peso = $key['peso'];
   $estado = $key['estado'];
   $ambiente = $key['id_ambiente'];
   $responsable = $key['id_persona'];
   $ancho = $key['ancho'];
   $alto = $key['alto'];
   $largo = $key['largo'];
   $ingreso = $key['fecha_ingreso'];


        #MOSTRAR AMBIENTE POR NOMBRE
   $intAmbiente = ControlAmbiente::singleton_Ambiente();
   $resultAmbiente = $intAmbiente->mostrarAmbienteControlPorId($ambiente);
   $NameAmbiente = $resultAmbiente[0]['nombre'];
       #MOSTRAR CREADOR POR NOMBRE
  // $intCoordinador = ControlCoordinador::singleton_coordinador();
   //$resultCoordinador = $intCoordinador->mostrarCoordinadorControlPorID($creador);
   //$NameCoordinador = $resultCoordinador[0]['nombre'];
       #MOSTRAR RESPONSABLE POR NOMBRE
   $intInstructor = ControlInstructor::singleton_Instructor();
   $resultInstructor = $intInstructor->mostrarInstructorControlPorId($responsable);
   $NameResponsable = $resultInstructor[0]['nombre'];

$resultadonovedad = ControlInstructor::singleton_instructor();
$resultnovedad = $resultadonovedad->mostrarnovedadelementoIDAJAXControlInstructor($id_elemento);
 $Novedad = $resultnovedad;



   ?>
   <tr id="Elemento<?php echo $id_elemento; ?>">
   <td>
    <a class="btn btn-primary btneditarE" value="<?php echo $id_elemento; ?>">
     <i class="fa fa-edit" id="icon" style="color: white"></i>
   </a>
   <input type="hidden" class="valorIDoculto" value="<?php echo $id_instructorA; ?>">
 </td>
    <td class="relleno"><?php echo $placa; ?></td>
    <td class="relleno"><?php echo $nombreBD; ?></td>
    <td class="relleno"><?php echo $descripcion; ?></td>
    <td class="relleno"><?php echo $serial; ?></td>
    <td class="relleno"><?php echo $precio; ?></td>
    <td class="relleno"><?php echo $peso; ?>kg</td>
    <td class="relleno"><?php echo $NameAmbiente; ?></td>
    <td class="relleno"><?php echo $NameResponsable; ?></td>
    <td class="relleno"><?php echo $ancho; ?></td>
    <td class="relleno"><?php echo $alto; ?></td>
    <td class="relleno"><?php echo $largo; ?></td>
    <td class="relleno"><?php echo $ingreso; ?></td>
    <td class="relleno"><?php echo $Novedad; ?></td>
   
</tr>
<?php
}// Cierras el WHILE
?>
<script src="<?php echo PUBLIC_PATH; ?>js/categorias/mueble.js"></script>
<?php 
}//cierra el if de muebles
else{}

if ($filtro == 5) {
  //preguntar si posee ram, almacenamiento y procesador
  ?>
<script type="text/javascript">
  $(".tabla1").hide();
</script>
<br>

<br>
<div id="listaContacto animated zoomInUp"></div>
<div class="tablaDiseño animated zoomInUp">
   <table class="responsive table text-center table-striped table-bordered table-sm" id="tablaTic" cellspacing="0" width="100%">
   <thead>
    <tr>
     <br>
     <th>EDITAR</th>
     <th>PLACA</th>
     <th>NOMBRE</th>
     <th>DESCRIPCION</th>
     <th>SERIAL</th> 
     <th>PRECIO</th>
     <th>RAM</th>
     <th>ALMACENAMIENTO</th>
     <th>PROCESADOR</th>
     <th>AMBIENTE</th>
     <th>RESPONSABLE</th>
     <th>INGRESO</th>
      <th>ULTIMA NOVEDAD</th>
   </tr>
 </thead>
 <?php
 foreach ($resultado as $key) {
   $placa = $key['placa'];
   $id_elemento = $key['id_elemento'];
   $nombreBD = $key['nombre'];
   $descripcion = $key['descripcion'];
   $serial = $key['serial'];
   $precio = $key['precio'];
   $ram = $key['ram'];
   $almacenamiento = $key['almacenamiento'];
   $procesador = $key['procesador'];
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
 

   ?>
   <tr id="Elemento<?php echo $id_elemento; ?>">
   <td>
    <a class="btn btn-primary btneditarE" value="<?php echo $id_elemento; ?>">
     <i class="fa fa-edit" id="icon" style="color: white"></i>
   </a>
   <input type="hidden" class="valorIDoculto" value="<?php echo $id_instructorA; ?>">
 </td>
    <td class="relleno"><?php echo $placa; ?></td>
    <td class="relleno"><?php echo $nombreBD; ?></td>
    <td class="relleno"><?php echo $descripcion; ?></td>
    <td class="relleno"><?php echo $serial; ?></td>
    <td class="relleno"><?php echo $precio; ?></td>
    <td class="relleno"><?php echo $ram; ?></td>
    <td class="relleno"><?php echo $almacenamiento; ?></td>
    <td class="relleno"><?php echo $procesador; ?></td>
    <td class="relleno"><?php echo $NameAmbiente; ?></td>
    <td class="relleno"><?php echo $NameResponsable; ?></td>
    <td class="relleno"><?php echo $ingreso; ?></td>
    <td class="relleno"><?php echo $Novedad; ?></td>
   
</tr>
<?php
}// Cierras el WHILE
?>
<script src="<?php echo PUBLIC_PATH; ?>js/categorias/Tic.js"></script>
<?php 
}//cierra el if de muebles

if ($filtro == 3) {
  //preguntar si posee ram, almacenamiento y procesador
  ?>
<script type="text/javascript">
  $(".tabla1").hide();
</script>
<br>

<br>
<div id="listaContacto animated zoomInUp"></div>
<div class="tablaDiseño animated zoomInUp">
  <table class="responsive table text-center table-striped table-bordered table-sm" id="tablaHerramienta" cellspacing="0" width="100%">
   <thead>
    <tr>
     <br>
     <th>EDITAR</th>
     <th>PLACA</th>
     <th>NOMBRE</th>
     <th>DESCRIPCION</th>
     <th>SERIAL</th> 
     <th>PRECIO</th>
     <th>AMBIENTE</th>
     <th>RESPONSABLE</th>
     <th>INGRESO</th>
     <th>ULTIMA NOVEDAD</th>

   </tr>
 </thead>
 <?php
 foreach ($resultado as $key) {
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
 


   ?>
   <tr id="Elemento<?php echo $id_elemento; ?>">
   <td>
    <a class="btn btn-primary btneditarE" value="<?php echo $id_elemento; ?>">
     <i class="fa fa-edit" id="icon" style="color: white"></i>
   </a>
   <input type="hidden" class="valorIDoculto" value="<?php echo $id_instructorA; ?>">
 </td>
    <td class="relleno"><?php echo $placa; ?></td>
    <td class="relleno"><?php echo $nombreBD; ?></td>
    <td class="relleno"><?php echo $descripcion; ?></td>
    <td class="relleno"><?php echo $serial; ?></td>
    <td class="relleno"><?php echo $precio; ?></td>
    <td class="relleno"><?php echo $NameAmbiente; ?></td>
    <td class="relleno"><?php echo $NameResponsable; ?></td>
    <td class="relleno"><?php echo $ingreso; ?></td>
    <td class="relleno"><?php echo $Novedad; ?></td>
   
</tr>
<?php
}// Cierras el WHILE
?>
<script src="<?php echo PUBLIC_PATH; ?>js/categorias/herramienta.js"></script>
<?php 
}

if ($filtro == 4) {
  //preguntar si posee ram, almacenamiento y procesador
  ?>
<script type="text/javascript">
  $(".tabla1").hide();
</script>
<br>

<br>
<div id="listaContacto animated zoomInUp"></div>
<div class="tablaDiseño animated zoomInUp">
   <table class="responsive table text-center table-striped table-bordered table-sm" id="tablaLaboratorio" cellspacing="0" width="100%">
   <thead>
    <tr>
     <br>
     <th>EDITAR</th>
     <th>PLACA</th>
     <th>NOMBRE</th>
     <th>DESCRIPCION</th>
     <th>SERIAL</th> 
     <th>PRECIO</th>
     <th>AMBIENTE</th>
     <th>RESPONSABLE</th>
     <th>INGRESO</th>
     <th>ULTIMA NOVEDAD</th>
   </tr>
 </thead>
 <?php
 foreach ($resultado as $key) {
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


   ?>
   <tr id="Elemento<?php echo $id_elemento; ?>">
    <td>
    <a class="btn btn-primary btneditarE" value="<?php echo $id_elemento; ?>">
     <i class="fa fa-edit" id="icon" style="color: white"></i>
   </a>
   <input type="hidden" class="valorIDoculto" value="<?php echo $id_instructorA; ?>">
 </td>

    <td class="relleno"><?php echo $placa; ?></td>
    <td class="relleno"><?php echo $nombreBD; ?></td>
    <td class="relleno"><?php echo $descripcion; ?></td>
    <td class="relleno"><?php echo $serial; ?></td>
    <td class="relleno"><?php echo $precio; ?></td>
    <td class="relleno"><?php echo $NameAmbiente; ?></td>
    <td class="relleno"><?php echo $NameResponsable; ?></td>
    <td class="relleno"><?php echo $ingreso; ?></td>
    <td class="relleno"><?php echo $Novedad; ?></td>
  </tr>
<?php
}// Cierras el WHILE
?>
<script src="<?php echo PUBLIC_PATH; ?>js/categorias/laboratorio.js"></script>
<?php
}

if ($filtro == 6) {
  //preguntar si posee ram, almacenamiento y procesador
  ?>
<script type="text/javascript">
  $(".tabla1").hide();
</script>
<br>

<br>
<div id="listaContacto animated zoomInUp"></div>
<div class="tablaDiseño animated zoomInUp">
  <table class="responsive table text-center table-striped table-bordered table-sm" id="buscarExt" cellspacing="0" width="100%">
   <thead>
    <tr>
     <br>
     <th>EDITAR</th>
     <th>PLACA</th>
     <th>NOMBRE</th>
     <th>DESCRIPCION</th>
      <th>TIPO ELEMENTO</th>
     <th>SERIAL</th> 
     <th>PRECIO</th>
     <th>AMBIENTE</th>
     <th>RESPONSABLE</th>
     <th>INGRESO</th>
     <th>ULTIMA NOVEDAD</th>

   </tr>
 </thead>
 <?php
 foreach ($resultado as $key) {
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
 


   ?>
   <tr id="Elemento<?php echo $id_elemento; ?>">
   <td>
    <a class="btn btn-primary btneditarE" value="<?php echo $id_elemento; ?>">
     <i class="fa fa-edit" id="icon" style="color: white"></i>
   </a>
   <input type="hidden" class="valorIDoculto" value="<?php echo $id_instructorA; ?>">
 </td>
    <td class="relleno"><?php echo $placa; ?></td>
    <td class="relleno"><?php echo $nombreBD; ?></td>
    <td class="relleno"><?php echo $descripcion; ?></td>
    <td class="relleno"><?php echo $material; ?></td>
    <td class="relleno"><?php echo $serial; ?></td>
    <td class="relleno"><?php echo $precio; ?></td>
    <td class="relleno"><?php echo $NameAmbiente; ?></td>
     <td class="relleno"><?php echo $NameResponsable; ?></td>
    <td class="relleno"><?php echo $ingreso; ?></td>
    <td class="relleno"><?php echo $Novedad; ?></td>
   
</tr>
<?php
}// Cierras el WHILE
?>
<script src="<?php echo PUBLIC_PATH; ?>js/categorias/todos.js"></script>
<?php
}
?>
 <script src="<?php echo PUBLIC_PATH ?>js/mod/datatables.min.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/Ambiente/mainAmbiente.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/Reporte/reporte.js"></script>
</table>
</div>