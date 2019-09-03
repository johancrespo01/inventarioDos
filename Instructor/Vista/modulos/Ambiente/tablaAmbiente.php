<?php
require_once CONTROL_PATH . 'Session.php';
require_once CONTROL_PATH . 'Ambiente/ControlAmbiente.php';
require_once CONTROL_PATH . 'Elemento/ControlElemento.php';
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
include_once VISTA_PATH . 'navegacion.php';
?>
<div id="listaContacto"></div>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
  <!-- Main Content -->
  <div id="content">
    <!-----------------   AQUI MOSTRAR EL CONNTENIDO DE LA PAGINA   ----------------->
    <!--BARRA DE NAVEGACION-->
    <div class="table-responsive col-12 barra_navegacion">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo BASE_URL ?>index">Principal</a>
        </li>
        <li class="breadcrumb-item">
          <a href="tablaAmbiente">Ambientes</a>
        </li>
      </ol>
    </div>
    <div class="content-wrapper">
      <div class="container-fluid">
       <br>
       <div class="row">
        <div class="col-12">
          <div class="formulario_empresa">
            <fieldset class="fieldset">
             <legend class="text-center">Datos del los Ambientes</legend>
             <br>
<div id="datos_mostrar"></div>
<fieldset class="fieldset">
  <div class="tablaDiseño animated zoomInUp tabla2">

    <table id="buscarExt" class="text-center responsive text-center tabla1 table display table-striped table-bordered table-sm tablaA1 tabla1" style="width:100%" cellspacing="0" width="100%">
      <thead>
        <tr>
          <br>
          <th>VER</th>
          <th class="text-center">NOMBRE</th>
          <th class="text-center">PROGRAMA</th>
          
        </tr>
      </thead>
                <?php
                $int = ControlAmbiente::singleton_Ambiente();
                $limitado = $int->mostrarLimitadoAmbiente();
                    #var_dump($limitado);exit();
                    #$empresa = ControlEmpresa::singleton_empresa();
                    #var_dump($limitado);
                foreach ($limitado as $key) {
                        //Guardo los datos de la BD en las variables de php
                  $id_ambiente = $key['id_ambiente'];
                  $programa = $key['nombre_programa'];
                  $nombre = $key['nombre'];
                        //Mostramos la empresa segun el id del Instructor
                        #$name_empresa = $empresa->BuscarEmpresaControl($key['id_empresa']);
                  ?>	 
                  <tr id="Elemento<?php echo $id_aprendiz; ?>">
                   <td>
                      <!--ESTE ES EL BOTON QUE PERMITE VER INVENTARIOS-->
                      <!--CREO UN FORMULARIO DENTRO DE LA CELDA-->
                      <button title="Ver inventario de este ambiente" class="btn btn-primary btnInventarios" id="<?php echo $id_ambiente; ?>">
                        <i class="fas fa-eye" id="icon" style="color: white"></i>
                      </button><!--CREO EL BOTON Y LE ASIGNO UN ICONO -->
                    </td>
                    <td class="relleno"><?php echo $nombre; ?></td>
                    <td class="relleno"><?php echo $programa; ?></td>
                  </tr>
                  <?php
}// Cierras el WHILE
?>
</table>



</div>
</fieldset>




<?php 
if (isset($_POST['numero_placa'])) {
  $intContact = ControlElemento::singleton_elemento();
  $intContact->nuevoElemento();
} else {
    #echo "<script>alert('No existe la variable ')</script>";
}
if (isset($_POST['descripcion'])) {
  #echo "<script>alert('editar... ')</script>";exit();
  $intContact = ControlElemento::singleton_elemento();
  $intContact->modificarElementoID();
} else {
    #echo "<script>alert('No existe la variable ')</script>";
}
include_once VISTA_PATH . 'pie.php';
include_once VISTA_PATH . 'scriptAndFinal.php';
?>
<script src="<?php echo PUBLIC_PATH; ?>js/Ambiente/mainAmbiente.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/Reporte/reporte.js"></script>