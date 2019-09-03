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
$int = ControlAmbiente::singleton_Ambiente();


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
             <div class="tablaDiseño animated flipInX">
              <div id="datos"></div>
              <div id="datos_mostrar"></div>
              <table class="text-center table table-striped table-bordered table-sm tabla1 display responsive nowrap" id="buscarExt" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <br>
                 
                    <th class="text-center">OPCIONES</th>
                    <th class="text-center">NOMBRE</th>
                    <th class="text-center">PROGRAMA</th>
                    
                  </tr>
                </thead>
                <?php
                $limitado = $int->mostrarLimitadoAmbiente();
                    #var_dump($limitado);exit();
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
                   

                      <td class="text-center">
                       <!--ESTE ES EL BOTON QUE REALIZA LA ELIMINACION-->
                      <a class="btn btn-danger btnEliminarA" value="<?php echo $id_ambiente ?>">
                        <i class="fa fa-trash" id="icon" style="color: white"></i>
                      </a>
                        <!--ESTE ES EL BOTON QUE REALIZA LA EDICION-->
                        <a class="btn btn-primary btneditarA" value="<?php echo $id_ambiente ?>">
                          <i class="fa fa-edit" id="icon" style="color: white"></i>
                        </a></td>
                    <td class="relleno text-center"><?php echo $nombre; ?></td>
                    <td class="relleno text-center"><?php echo $programa; ?></td>
                   
                      </tr>
                      <?php
}// Cierras el WHILE
?>
</table>

</div>


</fieldset>
</div>

</div>
</div>
</div>
</div>
</div>

<?php 
if (isset($_POST['descripcion'])) {
 # echo "<script>alert('Se debe modificar')</script>";
  $intContact = ControlElemento::singleton_elemento();
  $intContact->modificarElementoID();
} else {

}
if (isset($_POST['programa'])) {
       # $int = ControlElemento::singleton_elemento();
  $int->modificarAmbienteID();
}
include_once VISTA_PATH . 'pie.php';
include_once VISTA_PATH . 'scriptAndFinal.php';
?>
<script src="<?php echo PUBLIC_PATH; ?>js/Ambiente/mainAmbiente.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/Reporte/reporte.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/sweet_alert.js"></script>
