<?php 
require_once CONTROL_PATH . 'Session.php';
require_once CONTROL_PATH . 'Centro/ControlCentro.php';
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
/*********PAGINACION*********/

require_once LIB_PATH . 'Zebra_Pagination.php'; //incluimos la libreria 
$int = ControlCentro::singleton_centro();
$total_registros = $int->mostrarCentroContadosControl();//llamar una funcion que contenga la cantidad de registros
$total = $total_registros["count(*)"];
$cant_resultados = 5;

$paginacion = new Zebra_Pagination();
$paginacion->records($total);//Aqui cantidad total de registros
$paginacion->records_per_page($cant_resultados); //cantidad de resultados en cada pagina
$obtenerPaginaActual =(($paginacion->get_page() - 1) * $cant_resultados);
#echo $obtenerPaginaActual;


/****************************/
 ?>
    
    
   
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
		<!-----------------   AQUI MOSTRAR EL CONNTENIDO DE LA PAGINA   ----------------->
        <!--BARRA DE NAVEGACION-->
        <div id="listaContacto"></div>
    <div class="table-responsive col-12 barra_navegacion">

          <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo BASE_URL ?>index">Principal</a>
            </li>
            <li class="breadcrumb-item">
                <a href="tablaCentro">Centros</a>
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
                       <legend class="text-center">Datos del los centros</legend>
                       <div class="tablaDiseño animated flipInX">
                     	<table id="buscarExt" class="responsive text-center table-striped table-bordered table-sm tabla1" cellspacing="0" width="100%">
		                    <thead>
		                        <tr>
		                    <br>
		                    <th class="text-center">+</th>
                            <th class="text-center">OPCIONES</th> 
		                    <th class="text-center">REGION</th>
		                    <th class="text-center">NOMBRE</th>
		                    <th class="text-center">DIRECCION</th>
		                    <th class="text-center">TELEFONO </th>
                            <th class="text-center">CORREO</th>
                            
		                    </tr>
		                    </thead>
                    <?php
                    $limitado = $int->mostrarLimitadoCentro($obtenerPaginaActual,$cant_resultados);
                    //var_dump($limitado);exit();
                    #$empresa = ControlEmpresa::singleton_empresa();

                    foreach ($limitado as $key) {

                        //Guardo los datos de la BD en las variables de php
                        $id_centro = $key['id_centro'];
                        $region = $key['region'];
                        $nombre = $key['nombre'];
                        $direccion = $key['direccion'];
                        $correo = $key['correo'];
                        $telefono = $key['telefono'];
                        //Mostramos la empresa segun el id del Instructor
                        #$name_empresa = $empresa->BuscarEmpresaControl($key['id_empresa']);
                        ?>	 
                        <tr id="Elemento<?php echo $id_centro; ?>">
                            <td class="text-center">
                               </td>

                            <td>
                                <!--ESTE ES EL BOTON QUE REALIZA LA ELIMINACION-->
                                <a class="btn btn-danger btnEliminar" value="<?php echo $id_centro ?>">
                                    <i class="fa fa-trash" id="icon" style="color: white"></i>
                                </a>
                                <!--ESTE ES EL BOTON QUE REALIZA LA EDICION-->
                                <a class="btn btn-primary btneditar" value="<?php echo $id_centro ?>">
                                    <i class="fa fa-edit" id="icon" style="color: white"></i>
                                </a></td>
                            <td class="relleno text-center"><?php echo $region; ?></td>
                            <td class="relleno text-center"><?php echo $nombre; ?></td>
                            <td class="relleno text-center"><?php echo $direccion; ?></td>
                            <td class="relleno text-center"><?php echo $telefono; ?></td>
                            <td class="relleno text-center"><?php echo $correo; ?></td>
                           
                        </tr>
    <?php
}// Cierras el WHILE
?>
                </table>
                
            </div>
            <div id="paginar1" class="float-right">
                <?php $paginacion->render(); ?>
            </div>
            
                    </fieldset>
                </div>

            </div>
        </div>
    </div>
</div>
      </div>

<?php 
if (isset($_POST['direccion'])) {
     // echo "<script>alert('Aqui editar')</script>";
     $intContact = ControlCentro::singleton_centro();
     $intContact->editarCentro();
} else {
    #echo "<script>alert('No existe la variable ')</script>";
}

include_once VISTA_PATH . 'pie.php';
include_once VISTA_PATH . 'scriptAndFinal.php';
 ?>
 <script src="<?php echo PUBLIC_PATH; ?>js/Centro/mainCentro.js"></script>
  <script src="<?php echo PUBLIC_PATH; ?>js/sweet_alert.js"></script>