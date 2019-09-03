<?php
session_start();
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', '..' . DS . '..' . DS . '..');
require_once '..' . DS . '..' . DS . '..' . DS . 'Config' . DS . 'Config.php';
require_once CONTROL_PATH . 'Ambiente' . DS . 'ControlAmbiente.php';
require_once CONTROL_PATH . 'Instructor' . DS . 'ControlInstructor.php';
require_once CONTROL_PATH . 'Elemento' . DS . 'ControlElemento.php';


require_once CONTROL_PATH . 'Session.php';
$objss = new Session;
$objss->iniciar();



if (isset($_POST['parametro'])) {
   # echo "<script>alert('Si existe la variable')</script>";
    $modificar = json_decode(stripslashes($_POST['parametro']));
   $id_ambiente = $modificar->id;
  // $filtro = $modificar->fil;

if( $id_ambiente!=""){
 
   $_SESSION["idambiente2"] = $id_ambiente;
   $id_ambienteA =  $_SESSION["idambiente2"];
   // $filtro = $modificar->fil;
}
$id_ambienteA =  $_SESSION["idambiente2"];

}
$id_instructorA = $_SESSION['id_usuario'];
#echo "<script>alert($id_instructorA);</script>";exit();
?>

 <div class="row">
              <div class="col-12">
                <div class="form-group animated flipInX">                                        
                  <select onchange="inventarioambiente(this.value)" id="tipo_elementoI" class="selectpicker form-control" data-live-search="true" name="material">
                    <option  VALUE="0"  disabled selected>Seleccione tipo de elemento</option> 
                    <option value="5" data-tokens="mustard" name="material">TIC</option> 
                    <option value="2" data-tokens="ketchup mustard" name="material">Muebles</option>
                    <option value="3" data-tokens="mustard" name="material">Herramientas</option>
                    <option value="4" data-tokens="mustard" name="material">Equipos de laboratorio</option>
                    
                     <option value="6" data-tokens="ketchup mustard" name="material">Todos los elementos</option>
                  </select>                                  
                </div> 
                 <input type="hidden" class="buscarMiInventario" id="<?php echo $_SESSION["idambiente2"];?>">
              </div>
            </div>

<a class="btn btn-success btnRetrocesoDos animated zoomInUp" id="<?php echo $id_instructorA; ?>">
  <i class="fa fa-arrow-left"></i>
</a>
<script type="text/javascript">
  $(".tabla2").hide();
</script>
<div class="tabla1">
<br><br>
<div  class="responsive text-center alert alert-info h4">

 ¡Atento! Recuerde que debe seleccionar un tipo de elemento para poder mostar la información requerida.
</div>
</div>
<?php 
if(isset($_POST['parametro1'])){
  $resultado = ControlAmbiente::singleton_Ambiente();
$resultado = $resultado->mostrarLimitadoElementoPorIDAJAXControl();
// var_dump($resultado[0]['nombre']);exit();
$modificar = json_decode(stripslashes($_POST['parametro1']));
  $id_ambienteA = $modificar->id;
  $filtro = $modificar->fil;


if ($filtro == 2) { //if de muebles
  
?>
<script type="text/javascript">
  $(".tabla1").hide();
</script>
<br>

<br>
<div id="listaContacto animated zoomInUp"></div>
<div class="tablaDiseño animated zoomInUp">
  <table class="responsive table text-center table-striped table-bordered table-sm" id="tablaMueble" cellspacing="0" width="100%">
   <thead>
    <tr>
     <br>
     <th>editaru</th>
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
    $responsable = $key['nombre_Persona'];
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
   // $intInstructor = ControlInstructor::singleton_Instructor();
   // $resultInstructor = $intInstructor->mostrarInstructorControlPorId($responsable);
   // $NameResponsable = $resultInstructor[0]['nombre'];

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
    <td class="relleno"><?php echo $responsable; ?></td>
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
    $responsable = $key['nombre_Persona'];
   $ingreso = $key['fecha_ingreso'];


        #MOSTRAR AMBIENTE POR NOMBRE
   $intAmbiente = ControlAmbiente::singleton_Ambiente();
   $resultAmbiente = $intAmbiente->mostrarAmbienteControlPorId($ambiente);
   $NameAmbiente = $resultAmbiente[0]['nombre'];

   // $intInstructor = ControlInstructor::singleton_Instructor();
   // $resultInstructor = $intInstructor->mostrarInstructorControlPorId($responsable);
   // $NameResponsable = $resultInstructor[0]['nombre'];

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
    <td class="relleno"><?php echo $responsable; ?></td>
    <td class="relleno"><?php echo $ingreso; ?></td>
    <td class="relleno"><?php echo $Novedad; ?></td>
   
</tr>
<?php
}// Cierras el WHILE
?>
<script src="<?php echo PUBLIC_PATH; ?>js/categorias/tic.js"></script>
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
   $responsable = $key['nombre_Persona'];
   $ingreso = $key['fecha_ingreso'];


        #MOSTRAR AMBIENTE POR NOMBRE
   $intAmbiente = ControlAmbiente::singleton_Ambiente();
   $resultAmbiente = $intAmbiente->mostrarAmbienteControlPorId($ambiente);
   $NameAmbiente = $resultAmbiente[0]['nombre'];

   // $intInstructor = ControlInstructor::singleton_Instructor();
   // $resultInstructor = $intInstructor->mostrarInstructorControlPorId($responsable);
   // $NameResponsable = $resultInstructor[0]['nombre'];

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
    <td class="relleno"><?php echo $responsable; ?></td>
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
   $responsable = $key['nombre_Persona'];
   $ingreso = $key['fecha_ingreso'];


        #MOSTRAR AMBIENTE POR NOMBRE
   $intAmbiente = ControlAmbiente::singleton_Ambiente();
   $resultAmbiente = $intAmbiente->mostrarAmbienteControlPorId($ambiente);
   $NameAmbiente = $resultAmbiente[0]['nombre'];

   // $intInstructor = ControlInstructor::singleton_Instructor();
   // $resultInstructor = $intInstructor->mostrarInstructorControlPorId($responsable);
   // $NameResponsable = $resultInstructor[0]['nombre'];
   // echo "<script>alert('".$NameResponsable."');</script>";
   // var_dump($NameResponsable);exit();

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
    <td class="relleno"><?php echo $responsable; ?></td>
    <td class="relleno"><?php echo $ingreso; ?></td>
    <td class="relleno"><?php echo $Novedad; ?></td>
  
</tr>
<?php
}// Cierras el WHILE
?>
<script src="<?php echo PUBLIC_PATH; ?>js/categorias/laboratorio.js"></script>
<?php
}//cierra el if de muebles

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
   $responsable = $key['nombre_Persona'];
   $ingreso = $key['fecha_ingreso'];


        #MOSTRAR AMBIENTE POR NOMBRE
   $intAmbiente = ControlAmbiente::singleton_Ambiente();
   $resultAmbiente = $intAmbiente->mostrarAmbienteControlPorId($ambiente);
   $NameAmbiente = $resultAmbiente[0]['nombre'];

   // $intInstructor = ControlInstructor::singleton_Instructor();
   // $resultInstructor = $intInstructor->mostrarInstructorControlPorId($responsable);
   // $NameResponsable = $resultInstructor[0]['nombre'];
   // echo "<script>alert('".$NameResponsable."');</script>";
   // var_dump($NameResponsable);exit();

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
    <td class="relleno"><?php echo $responsable; ?></td>
    <td class="relleno"><?php echo $ingreso; ?></td>
    <td class="relleno"><?php echo $Novedad; ?></td>
  
</tr>
<?php
}// Cierras el WHILE
?>
<script src="<?php echo PUBLIC_PATH; ?>js/categorias/todos.js"></script>
<?php
}//cierra el if de todos los elementos
}//Cierre parametro
?>
</table>
 <script src="<?php echo PUBLIC_PATH ?>js/mod/datatables.min.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/Ambiente/mainAmbiente.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/Reporte/reporte.js"></script>


