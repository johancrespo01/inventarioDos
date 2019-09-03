<?php
require_once CONTROL_PATH . 'Session.php';
require_once CONTROL_PATH . 'Programa/ControlPrograma.php';
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
$int = ControlPrograma::singleton_Programa();
$limitado = $int->mostrarLimitadoPrograma();
?>


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
                <a href="tablaProgramas">Programas</a>
            </li>
        </ol>
  </div>
        	<div class="content-wrapper">
    <div class="container-fluid">
       <br>
        <div class="row">
            <div class="col-12">
                <div class="formulario_empresa">
                    <div id="listaContacto"></div>
                    <fieldset class="fieldset">
                       <legend class="text-center">Datos del los Programas</legend>
                       <div class="tablaDiseño animated flipInX">
                        <div id="datos"></div>
                     	<table id="buscarExt" class="responsive text-center table table-striped table-bordered table-sm tabla1" cellspacing="0" width="100%">
		                    <thead class="text-center">
		                        <tr>
		                    <br>
		                     <th class="text-center">+</th>
                            <th class="text-center">OPCIONES</th>
		                    <th class="text-center">NOMBRE</th>
		                    <th class="text-center">COORDINACION</th>
                        <th class="text-center">id programa</th>
		                    </tr>
		                    </thead>
                    <?php

                    #var_dump($limitado);exit();
                    #$empresa = ControlEmpresa::singleton_empresa();

                    foreach ($limitado as $key) {

                        //Guardo los datos de la BD en las variables de php
                        $id_programa = $key['id_programa'];
                        $coordinacion = $key['nombre_coordinacion'];
                        $nombre = $key['nombre'];

                        //Mostramos la empresa segun el id del Instructor
                        #$name_empresa = $empresa->BuscarEmpresaControl($key['id_empresa']);
                        ?>
                        <tr id="Programa<?php echo $id_programa; ?>">
                           <td class="text-center">
                                </td>

                            <td class="text-center"  style="color: white">
                               <!--ESTE ES EL BOTON QUE REALIZA LA ELIMINACION-->
                                <a class="btn btn-danger btnEliminar" value="<?php echo $id_programa ?>">
                                    <i class="fa fa-trash" id="icon"></i>
                                </a>
                                <!--ESTE ES EL BOTON QUE REALIZA LA EDICION-->
                                <a class="btn btn-primary btneditar" value="<?php echo $id_programa ?>">
                                    <i class="fa fa-edit" id="icon"></i>
                                </a></td>
                            <td class="relleno text-center"><?php echo $nombre; ?></td>
                            <td class="relleno text-center"><?php echo $coordinacion; ?></td>
                            <td class="relleno text-center"><?php echo $id_programa; ?></td>
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
if (isset($_POST['nombre'])) {
    //echo "<script>alert('modificar')</script>";
     $intContact = ControlPrograma::singleton_programa();
     $intContact->modificarPrograma();
} else {
    #echo "<script>alert('No existe la variable ')</script>";
}

include_once VISTA_PATH . 'pie.php';
include_once VISTA_PATH . 'scriptAndFinal.php';
 ?>
 <script src="<?php echo PUBLIC_PATH; ?>js/Programa/mainPrograma.js"></script>
   <script src="<?php echo PUBLIC_PATH; ?>js/sweet_alert.js"></script>
