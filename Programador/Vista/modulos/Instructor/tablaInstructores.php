<?php 
require_once CONTROL_PATH . 'Session.php';
require_once CONTROL_PATH . 'Instructor/ControlInstructor.php';
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
$int = ControlInstructor::singleton_instructor();
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
                <a href="tablaInstructores">Registros de Instructores</a>
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
                       <legend class="text-center">Datos del los instructores</legend>
                       <div class="tablaDiseño animated flipInX">
                        
                     	<table id="buscarExt" class="tabla1 responsive table text-center display table-striped table-bordered table-sm tablaA1" style="width:100%" cellspacing="0" width="100%">
		                    <thead>
		                        <tr>
		                    <br>
		                     <th class="text-center">+</th>   
                            <th class="text-center">OPCIONES</th>
		                    <th class="text-center">TIPO DE DOCUMENTO</th>
		                    <th class="text-center">NUMERO DE DOCUMENTO</th>
		                    <th class="text-center">NOMBRE</th>
		                    <th class="text-center">APELLIDO</th>
		                    <th class="text-center">CORREO</th>	
		                    <th class="text-center">TELEFONO </th>
                           
		                    </tr>
		                    </thead>
                    <?php
                    $inicial = ControlInstructor::singleton_instructor();
                    $limitado = $inicial->mostrarLimitadoInstructor();
                    #exit();
                    #$empresa = ControlEmpresa::singleton_empresa();

                    foreach ($limitado as $key) {

                        //Guardo los datos de la BD en las variables de php
                        $id_persona = $key['id_persona'];
                        $tipo_documento = $key['tipoDocumento'];
                        $numero_documento = $key['numeroDocumento'];
                        $nombre = $key['nombre'];
                        $apellido = $key['apellido'];
                        $correo = $key['correo'];
                        $telefono = $key['telefono'];
                        //Mostramos la empresa segun el id del Instructor
                        #$name_empresa = $empresa->BuscarEmpresaControl($key['id_empresa']);
                        ?>	 
                        <tr id="Persona<?php echo $id_persona; ?>">
                           <td class="text-center">
                            </td>

                            <td class="text-center"  style="color: white">
                                 <!--ESTE ES EL BOTON QUE REALIZA LA ELIMINACION-->
                                <a class="btn btn-danger btnEliminar" value="<?php echo $id_persona ?>">
                                    <i class="fa fa-trash" id="icon"></i>
                                </a>
                                <!--ESTE ES EL BOTON QUE REALIZA LA EDICION-->
                                <a class="btn btn-primary btneditar" value="<?php echo $id_persona ?>">
                                    <i class="fa fa-edit" id="icon"></i>
                                </a></td>
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
                </div>

            </div>
        </div>
    </div>
</div>
      </div>

<?php 
if (isset($_POST['nombre_user'])) {
    // echo "<script>alert('editar')</script>";
     $intContact = ControlInstructor::singleton_instructor();
     $intContact->editarInstructor();
} else {
    #echo "<script>alert('No existe la variable ')</script>";
}

include_once VISTA_PATH . 'pie.php';
include_once VISTA_PATH . 'scriptAndFinal.php';
 ?>
<script src="<?php echo PUBLIC_PATH; ?>js/Instructor/mainInstructor.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/jsMain.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/sweet_alert.js"></script>