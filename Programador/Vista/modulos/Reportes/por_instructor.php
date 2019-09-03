<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', '..' . DS . '..' . DS . '..');
require_once '..' . DS . '..' . DS . '..' . DS . 'Config' . DS . 'Config.php';
require_once CONTROL_PATH . 'Session.php';
require_once CONTROL_PATH . 'Ambiente/ControlAmbiente.php';
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
require_once CONTROL_PATH . 'Instructor' . DS . 'ControlInstructor.php';
$resultado = ControlInstructor::singleton_instructor();
$resultado = $resultado->tiempoRealElectronicoControl();
$int = ControlAmbiente::singleton_Ambiente();

?>
<br>
<!-- <div class="form-group animated flipInX">
  <select id="tipo_elementoI" class="selectpicker form-control" data-live-search="true" name="material">
    <option  VALUE="0"  disabled selected>Seleccione tipo de elemento</option>
    <option value="2" data-tokens="ketchup mustard" name="material">Muebles</option>
    <option value="3" data-tokens="mustard" name="material">Herramientas</option>
    <option value="4" data-tokens="mustard" name="material">Equipos de laboratorio</option>
    <option value="5" data-tokens="mustard" name="material">TIC</option>
  </select>
</div>  -->
<div id="datos_mostrar"></div>
 <fieldset class="fieldset">
                       <div class="tablaDiseño animated zoomInUp tabla1">
                       <table id="buscarExtEspecificoI" class="table responsive text-center table-striped table-bordered table-sm tabla1" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                        <br>
                        <th class="text-center"></th>
                        <th class="text-center">TIPO DE DOCUMENTO</th>
                        <th class="text-center">NUMERO DE DOCUMENTO</th>
                        <th class="text-center">NOMBRE</th>
                        <th class="text-center">APELLIDO</th>
                        <th class="text-center">CORREO</th>
                        <th class="text-center">TELEFONO</th>

                        </tr>
                        </thead>
                    <?php
                    $inicial = ControlInstructor::singleton_instructor();
                    $limitado = $inicial->mostrarLimitadoInstructor();
                    #exit();
                    #$empresa = ControlEmpresa::singleton_empresa();

                    foreach ($limitado as $key) {

                        //Guardo los datos de la BD en las variables de php
                        $id_instructor = $key['id_persona'];
                        $tipo_documento = $key['tipoDocumento'];
                        $numero_documento = $key['numeroDocumento'];
                        $nombre = $key['nombre'];
                        $apellido = $key['apellido'];
                        $correo = $key['correo'];
                        $telefono = $key['telefono'];
                        //Mostramos la empresa segun el id del Instructor
                        #$name_empresa = $empresa->BuscarEmpresaControl($key['id_empresa']);
                        ?>
                        <tr id="Elemento<?php echo $id_instructor; ?>">
                            <td class="text-center">
                              <!--ESTE ES EL BOTON QUE PERMITE VER INVENTARIOS-->
                              <!--CREO UN FORMULARIO DENTRO DE LA CELDA-->
                                <button title="Ver inventario de este instructor" class="btn btn-primary btnInventariosInstructor" id="<?php echo $id_instructor; ?>">
                                  <i class="fas fa-eye" id="icon" style="color: white"></i>
                                </button><!--CREO EL BOTON Y LE ASIGNO UN ICONO -->
                            </td>
                            <td class="relleno text-center"><?php echo $tipo_documento; ?></td>
                            <td class="relleno text-center"><?php echo $numero_documento; ?></td>
                            <td class="relleno text-center"><?php echo $nombre; ?></td>
                            <td class="relleno text-center"><?php echo $apellido; ?></td>
                            <td class="relleno text-center"><?php echo $correo; ?></td>
                            <td class="relleno text-center"><?php echo $telefono; ?></td>

                        </tr>
    <?php
}// Cierras el WHILE
?>
                </table>

</div>
</fieldset>
 <script src="<?php echo PUBLIC_PATH ?>js/mod/datatables.min.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/Reporte/porInstructorEspecifico.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/Reporte/reporte.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/Ambiente/mainAmbiente.js"></script>
