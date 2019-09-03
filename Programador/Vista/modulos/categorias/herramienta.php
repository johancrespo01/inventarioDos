<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', '..' . DS . '..' . DS . '..');
require_once '..' . DS . '..' . DS . '..' . DS . 'Config' . DS . 'Config.php';
require_once CONTROL_PATH . 'Ambiente' . DS . 'ControlAmbiente.php';
require_once CONTROL_PATH . 'Instructor' . DS . 'ControlInstructor.php';
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
require_once CONTROL_PATH . 'categorias' . DS . 'ControlHerramienta.php';
$resultado = ControlHerramienta::singleton_herramienta();
$resultado = $resultado->tiempoRealHerramientaControl();
?>

<fieldset class="fieldset">
    <div id="datos"></div>
    <div class="tablaDiseño animated flipInX">
        <table id="tablaHerramienta"  class="responsive table text-center table-striped table-bordered table-sm tabla1" cellspacing="0" width="100%">
            <thead>
                <tr>
                   <br>
                  <th class="text-center">+</th>
                      <th class="text-center">Opciones</th>
                   <th class="text-center">PLACA</th>
                   <th class="text-center">NOMBRE</th>
                   <th class="text-center">DESCRIPCION</th>
                   <th class="text-center">SERIAL</th>
                   <th class="text-center">PRECIO</th>
                   <th class="text-center">AMBIENTE</th>
                   <th class="text-center">RESPONSABLE</th>
                   <th class="text-center">INGRESO</th>
                   <th class="text-center">ULTIMA NOVEDAD</th>
               </tr>
           </thead>
           <?php

                #$inicial = ControlELemento::singleton_elemento();
                #limitado = $inicial->mostrarLimitadoElemento($obtenerPaginaActual,$cant_resultados);
           foreach ($resultado as $key) {

                        //Guardo los datos de< la BD en las variables de php
            $placa = $key['placa'];
            $id_elemento = $key['id_elemento'];
            $nombreBD = $key['nombre'];
            $descripcion = $key['descripcion'];
            $serial = $key['serial'];
            $precio = number_format($key['precio']);
            $estado = $key['estado'];
            $ambiente = $key['id_ambiente'];
            $responsable = $key['id_persona'];
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
                        //Mostramos la empresa segun el id del aprendiz
                        #$name_empresa = $empresa->BuscarEmpresaControl($key['id_empresa']);
            ?>
            <tr id="Elemento<?php echo $id_elemento; ?>">
              <td class="text-center">

                </td>
                <td class="text-center">
                     <!--ESTE ES EL BOTON QUE REALIZA LA ELIMINACION-->
                    <a id="eliminar" class="btn btn-danger btnEliminarEa" value="<?php echo $id_elemento; ?>">
                        <i class="fa fa-trash" id="icon" style="color: white"></i>
                    </a>
                    <a class="btn btn-primary btneditarE" value="<?php echo $id_elemento; ?>">
                        <i class="fa fa-edit" id="icon" style="color: white"></i>
                    </a>
                    <input type="hidden" class="valorMaterial" value="<?php echo $key['id_material']; ?>">
               </td>
               <td class="relleno text-center"><?php echo $placa; ?></td>
               <td class="relleno text-center"><?php echo $nombreBD; ?></td>
               <td class="relleno text-center"><?php echo $descripcion; ?></td>
               <td class="relleno text-center"><?php echo $serial; ?></td>
               <td class="relleno text-center">$<?php echo $precio; ?></td>
               <td class="relleno text-center"><?php echo $NameAmbiente; ?></td>
               <td class="relleno text-center"><?php echo $NameResponsable; ?></td>
               <td class="relleno text-center"><?php echo $ingreso; ?></td>
                <td class="relleno"><?php echo $Novedad; ?></td>
            </tr>
 <?php
}//cierre del sino

?>
<?php
#include_once VISTA_PATH . 'pie.php';

?>
</table>
</div>
</fieldset>
 <script src="<?php echo PUBLIC_PATH ?>js/mod/datatables.min.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/categorias/herramienta.js"></script>
