<?php
session_start();
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', '..' . DS . '..' . DS . '..');
require_once '..' . DS . '..' . DS . '..' . DS . 'Config' . DS . 'Config.php';
require_once CONTROL_PATH . 'Ambiente' . DS . 'ControlAmbiente.php';
require_once CONTROL_PATH . 'Coordinador' . DS . 'ControlCoordinador.php';
require_once CONTROL_PATH . 'Instructor' . DS . 'ControlInstructor.php';
require_once CONTROL_PATH . 'Elemento' . DS . 'ControlElemento.php';

//var_dump($resultado);
if (isset($_POST['parametro3'])) {
  $modificar = json_decode(stripslashes($_POST['parametro3']));
 $id_ambiente = $modificar->id;
  // $filtro = $modificar->fil;

if( $id_ambiente!=""){

   $_SESSION["idambiente"] = $id_ambiente;
   $id_ambienteA =  $_SESSION["idambiente"];
   // $filtro = $modificar->fil;
}
$id_ambienteA =  $_SESSION["idambiente"];

}
?>
<script type="text/javascript">
  $(".tabla1").hide();
</script>
<div class="content-wrapper">
        <div class="container-fluid">
           <br>
           <div class="row">
            <div class="col-12">
                <div class="form-group animated bounce">
                  <select onchange="ambienteinventario(this.value)" id="tipo_elementoI" class="selectpicker form-control " data-live-search="true" name="material" >
                    <option  VALUE="0"  disabled selected>Seleccione tipo de elemento</option>
                    <option value="5" data-tokens="mustard" name="material">TIC</option>
                    <option value="2" data-tokens="ketchup mustard" name="material">Muebles</option>
                    <option value="3" data-tokens="mustard" name="material">Herramientas</option>
                    <option value="4" data-tokens="mustard" name="material">Equipos de laboratorio</option>
                    <option value="6" data-tokens="mustard" name="material">Todos los elementos</option>

                </select>
            </div>
            <input type="hidden" class="buscarMiInventario" id="<?php echo $_SESSION["idambiente"];?>">
        </div>
    </div>


</div>
</div>

<div id="datos_mostrar"></div>
<br>
<a class="btn btn-success btnRetrocesoUno animated zoomInUp" id="<?php echo $id_ambienteA; ?>">
  <i class="fa fa-arrow-left"></i>
</a>
<div id="mensaje">
<br><br>
<div  class="responsive text-center alert alert-info h4">

 ¡Atento! Recuerde que debe seleccionar un tipo de elemento para poder mostar la información requerida.
</div>
</div>
<?php
if (isset($_POST['parametro1'])) {

  $resultado = ControlAmbiente::singleton_ambiente();
$resultado = $resultado->mostrarLimitadoElementoPorIDAJAXControl();
  $modificar = json_decode(stripslashes($_POST['parametro1']));
  $id_ambienteA = $_SESSION["idambiente"];
  $filtro = $modificar->fil;

//var_dump($resultado[0]['id_material']);exit();

if ($filtro == 2) { //if de muebles


?>
<script type="text/javascript">
  $("#mensaje").hide();
</script>

<div id="listaContacto animated zoomInUp"></div>
<div class="tablaDiseño animated zoomInUp">
  <table id="buscarExtMuebles" class="mub responsive table text-center display table-striped table-bordered table-sm tablaA1" style="width:100%" cellspacing="0" width="100%">
   <thead>
    <tr>
     <br>
      <th class="text-center">MODIFICAR</th>
     <th class="text-center">PLACA</th>
     <th class="text-center">NOMBRE</th>
     <th class="text-center">DESCRIPCION</th>
     <th class="text-center">SERIAL</th>
     <th class="text-center">PRECIO</th>
     <th class="text-center">PESO</th>
     <!--<th class="text-center">FECHA DE ADQUISICION</th>-->
     <th class="text-center">AMBIENTE</th>
     <th class="text-center">RESPONSABLE</th>
     <th class="text-center">ANCHO</th>
     <th class="text-center">ALTO</th>
     <th class="text-center">LARGO</th>
     <th class="text-center">INGRESO</th>
     <th>ULTIMA NOVEDAD</th>

   </tr>
 </thead>
 <?php
 foreach ($resultado as $key) {
   $material = $key['id_material'];
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

     <td class="text-center">
    <a  class="btn btn-primary btneditarE" value="<?php echo $id_elemento; ?>">
     <i class="fa fa-edit" id="icon" style="color: white"></i>
   </a>
   <input id="materialA" type="hidden" class="valorMaterial" value="<?php echo $material; ?>">
 </td>
    <td class="relleno text-center"><?php echo $placa; ?></td>
    <td class="relleno text-center"><?php echo $nombreBD; ?></td>
    <td class="relleno text-center"><?php echo $descripcion; ?></td>
    <td class="relleno text-center"><?php echo $serial; ?></td>
    <td class="relleno text-center"><?php echo $precio; ?></td>
    <td class="relleno text-center"><?php echo $peso; ?>kg</td>
    <td class="relleno text-center"><?php echo $NameAmbiente; ?></td>
    <td class="relleno text-center"><?php echo $NameResponsable; ?></td>
    <td class="relleno text-center"><?php echo $ancho; ?></td>
    <td class="relleno text-center"><?php echo $alto; ?></td>
    <td class="relleno text-center"><?php echo $largo; ?></td>
    <td class="relleno text-center"><?php echo $ingreso; ?></td>
    <td class="relleno"><?php echo $Novedad; ?></td>

</tr>
<?php
}// Cierras el WHILE
?>
<script src="<?php echo PUBLIC_PATH; ?>js/Reporte/reportePorAmbienteCategorias/Amueble.js"></script>
<?php
}//cierra el if de muebles
else{}

if ($filtro == 5) {
  //preguntar si posee ram, almacenamiento y procesador
  ?>
<script type="text/javascript">
  $(".tabla1").hide();
   $("#mensaje").hide();
</script>

<br>

<br>
<div id="listaContacto animated zoomInUp"></div>
<div class="tablaDiseño animated zoomInUp">
  <table id="buscarExtTic" class="responsive table text-center display table-striped table-bordered table-sm tablaA1" style="width:100%" cellspacing="0" width="100%">
   <thead>
    <tr>
     <br>
     <th class="text-center">MODIFICAR</th>
     <th class="text-center">PLACA</th>
     <th class="text-center">NOMBRE</th>
     <th class="text-center">DESCRIPCION</th>
     <th class="text-center">SERIAL</th>
     <th class="text-center">PRECIO</th>
     <th class="text-center">RAM</th>
     <th class="text-center">ALMACENAMIENTO</th>
     <th class="text-center">PROCESADOR</th>
     <th class="text-center">AMBIENTE</th>
     <th class="text-center">RESPONSABLE</th>
     <th class="text-center">INGRESO</th>
     <th>ULTIMA NOVEDAD</th>

   </tr>
 </thead>
 <?php
 foreach ($resultado as $key) {
   $material = $key['id_material'];
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
   <td class="text-center">
    <a class="btn btn-primary btneditarE" value="<?php echo $id_elemento; ?>">
     <i class="fa fa-edit" id="icon" style="color: white"></i>
   </a>
   <input id="materialA" type="hidden" class="valorMaterial" value="<?php echo $material; ?>">
 </td>
    <td class="relleno text-center"><?php echo $placa; ?></td>
    <td class="relleno text-center"><?php echo $nombreBD; ?></td>
    <td class="relleno text-center"><?php echo $descripcion; ?></td>
    <td class="relleno text-center"><?php echo $serial; ?></td>
    <td class="relleno text-center"><?php echo $precio; ?></td>
    <td class="relleno text-center"><?php echo $ram; ?></td>
    <td class="relleno text-center"><?php echo $almacenamiento; ?></td>
    <td class="relleno text-center"><?php echo $procesador; ?></td>
    <td class="relleno text-center"><?php echo $NameAmbiente; ?></td>
    <td class="relleno text-center"><?php echo $NameResponsable; ?></td>
    <td class="relleno text-center"><?php echo $ingreso; ?></td>
    <td class="relleno"><?php echo $Novedad; ?></td>

</tr>
<?php
}// Cierras el WHILE
?>
<script src="<?php echo PUBLIC_PATH; ?>js/Reporte/reportePorAmbienteCategorias/Atic.js"></script>
<?php
}//cierra el if de muebles

if ($filtro == 3) {
  //preguntar si posee ram, almacenamiento y procesador
  ?>
<script type="text/javascript">
  $(".tabla1").hide();
   $("#mensaje").hide();
</script>
<br>

<br>
<div id="listaContacto animated zoomInUp"></div>
<div class="tablaDiseño animated zoomInUp">
  <table id="buscarExtHerramienta" class="responsive table text-center display table-striped table-bordered table-sm tablaA1" style="width:100%" cellspacing="0" width="100%">
   <thead>
    <tr>
     <br>
      <th class="text-center">MODIFICAR</th>
     <th class="text-center">PLACA</th>
     <th class="text-center">NOMBRE</th>
     <th class="text-center">DESCRIPCION</th>
     <th class="text-center">SERIAL</th>
     <th class="text-center">PRECIO</th>
     <th class="text-center">AMBIENTE</th>
     <th class="text-center">RESPONSABLE</th>
     <th class="text-center">INGRESO</th>
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
    <td class="text-center">
    <a class="btn btn-primary btneditarE" value="<?php echo $id_elemento; ?>">
     <i class="fa fa-edit" id="icon" style="color: white"></i>
   </a>
   <input type="hidden" class="valorIDoculto" value="<?php echo $id_instructorA; ?>">
 </td>
    <td class="relleno text-center"><?php echo $placa; ?></td>
    <td class="relleno text-center"><?php echo $nombreBD; ?></td>
    <td class="relleno text-center"><?php echo $descripcion; ?></td>
    <td class="relleno text-center"><?php echo $serial; ?></td>
    <td class="relleno text-center"><?php echo $precio; ?></td>
    <td class="relleno text-center"><?php echo $NameAmbiente; ?></td>
    <td class="relleno text-center"><?php echo $NameResponsable; ?></td>
    <td class="relleno text-center"><?php echo $ingreso; ?></td>
    <td class="relleno"><?php echo $Novedad; ?></td>

</tr>
<?php
}// Cierras el WHILE
?>
<script src="<?php echo PUBLIC_PATH; ?>js/Reporte/reportePorAmbienteCategorias/Aherramientas.js"></script>
<?php
}

if ($filtro == 4) {
  //preguntar si posee ram, almacenamiento y procesador
  ?>
<script type="text/javascript">
  $(".tabla1").hide();
   $("#mensaje").hide();
</script>
<br>

<br>
<div id="listaContacto animated zoomInUp"></div>
<div class="tablaDiseño animated zoomInUp">
  <table id="buscarExtLaboratorio" class="responsive table text-center display table-striped table-bordered table-sm tablaA1" style="width:100%" cellspacing="0" width="100%">
   <thead>
    <tr>
     <br>
     <th class="text-center">MODIFICAR</th>
     <th class="text-center">PLACA</th>
     <th class="text-center">NOMBRE</th>
     <th class="text-center">DESCRIPCION</th>
     <th class="text-center">SERIAL</th>
     <th class="text-center">PRECIO</th>
     <th class="text-center">AMBIENTE</th>
     <th class="text-center">RESPONSABLE</th>
     <th class="text-center">INGRESO</th>
      <th>ULTIMA NOVEDAD</th>

   </tr>
 </thead>
 <?php
 foreach ($resultado as $key) {
  $material = $key['id_material'];
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
     <td class="text-center">
    <a class="btn btn-primary btneditarE" value="<?php echo $id_elemento; ?>">
     <i class="fa fa-edit" id="icon" style="color: white"></i>
   </a>
   <input id="materialA" type="hidden" class="valorMaterial" value="<?php echo $material; ?>">
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
<script src="<?php echo PUBLIC_PATH; ?>js/Reporte/reportePorAmbienteCategorias/Alaboratorio.js"></script>
<?php
}//cierra el if de muebles
if ($filtro == 6) {
  //preguntar si posee ram, almacenamiento y procesador
  ?>
<script type="text/javascript">
  $(".tabla1").hide();
   $("#mensaje").hide();
</script>
<br>

<br>
<div id="listaContacto animated zoomInUp"></div>
<div class="tablaDiseño animated zoomInUp">
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

   </tr>
 </thead>
 <?php
 foreach ($resultado as $key) {
   $material = $key['id_material'];
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
    <td class="text-center">
    <a class="btn btn-primary btneditarE" value="<?php echo $id_elemento; ?>">
     <i class="fa fa-edit" id="icon" style="color: white"></i>
   </a>
   <input id="materialA" type="hidden" class="valorMaterial" value="<?php echo $material; ?>">
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

</tr>
<?php
}// Cierras el WHILE
?>
<script src="<?php echo PUBLIC_PATH; ?>js/Reporte/reportePorAmbienteCategorias/Atodos.js"></script>
<?php
}

}//cierra el if de parametro
include_once VISTA_PATH . 'scriptAndFinal.php';
?>
<script src="<?php echo PUBLIC_PATH; ?>js/Ambiente/mainAmbiente.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/Reporte/reporte.js"></script>
</table>
</div>
