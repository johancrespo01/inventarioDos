<?php
if(isset($_GET['var'])){

}else{
  define('DS', DIRECTORY_SEPARATOR);
  define('ROOT', '..' . DS . '..' . DS . '..');
  require_once '..' . DS . '..' . DS . '..' . DS . 'Config' . DS . 'Config.php';
}
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
if(isset($_GET['var'])){
  include_once VISTA_PATH . 'cabeza.php'; 
  include_once VISTA_PATH . 'navegacion.php';
}
$int = ControlAmbiente::singleton_Ambiente();

?>
<br>
<!-- <div class="form-group animated flipInX">                                        
  <select id="tipo_elemento" class="selectpicker form-control" data-live-search="true" name="material">
    <option  VALUE="0"  disabled selected>Seleccione tipo de elemento</option> 
    <option value="2" data-tokens="ketchup mustard" name="material">Muebles</option>
    <option value="3" data-tokens="mustard" name="material">Herramientas</option>
    <option value="4" data-tokens="mustard" name="material">Equipos de laboratorio</option>
    <option value="5" data-tokens="mustard" name="material">TIC</option> 
  </select>                                  
</div> 
 -->

<div id="datos_mostrar"></div>
<fieldset class="fieldset">
  <div class="tablaDiseño animated zoomInUp tabla1">

    <table id="buscarExtEspecifico" class="responsive text-center tabla1 table display table-striped table-bordered table-sm tablaA1 tabla1" style="width:100%" cellspacing="0" width="100%">
      <thead>
        <tr>
          <br>
          <th></th>
          <th class="text-center">NOMBRE</th>
          <th class="text-center">PROGRAMA</th>
          
        </tr>
      </thead>
      <?php
      $limitado = $int->mostrarLimitadoAmbiente();
                    //var_dump($limitado);exit();
                    #$empresa = ControlEmpresa::singleton_empresa();

      foreach ($limitado as $key) {

                        //Guardo los datos de la BD en las variables de php
        $programa = $key['nombre_programa'];
        $nombre = $key['nombre'];
        $id_ambiente = $key['id_ambiente'];
                        //Mostramos la empresa segun el id del Instructor
                        #$name_empresa = $empresa->BuscarEmpresaControl($key['id_empresa']);
        ?>
        <tr id="Elemento<?php echo $id_ambiente; ?>">
           <td>
            <!--ESTE ES EL BOTON QUE PERMITE VER INVENTARIOS-->
            <!--CREO UN FORMULARIO DENTRO DE LA CELDA-->
            <button title="Ver inventario de este ambiente" class=" pr-3 pl-3 btn btn-primary btnInventariosAmbiente" id="<?php echo $id_ambiente; ?>">
              <i class="fas fa-eye" id="icon" style="color: white"></i>
            </button><!--CREO EL BOTON Y LE ASIGNO UN ICONO -->
          </td>
          <td class="relleno text-center"><?php echo $nombre; ?></td>
          <td class="relleno text-center"><?php echo $programa; ?></td>

        
        </tr>
        <?php
}// Cierras el WHILE
?>
</table>    

</div>
</fieldset>
<?php 
//include_once VISTA_PATH . 'scriptAndFinal.php';
 ?>
<script src="<?php echo PUBLIC_PATH ?>js/mod/datatables.min.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/Reporte/porAmbienteEspecifico.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/Reporte/reporte.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/Ambiente/mainAmbiente.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/sweet_alert.js"></script>