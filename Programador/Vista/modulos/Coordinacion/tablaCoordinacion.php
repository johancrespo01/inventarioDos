<?php 
require_once CONTROL_PATH . 'Session.php';
require_once CONTROL_PATH . 'Coordinacion/ControlCoordinacion.php';
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
$int = ControlCoordinacion::singleton_Coordinacion();
$total_registros = $int->mostrarCoordinacionContadosControl();//llamar una funcion que contenga la cantidad de registros
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
    <div class="table-responsive col-12 barra_navegacion">

          <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo BASE_URL ?>index">Principal</a>
            </li>
            <li class="breadcrumb-item">
                <a href="tablaCoordinacion">Coordinacions</a>
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
                       <legend class="text-center">Datos del las Coordinaciones</legend>
                       <div class="tablaDiseño animated flipInX">
                        <div id="datos"></div>
                     	<table id="buscarExt" class="responsive table text-center table-striped table-bordered table-sm tabla1" cellspacing="0" width="100%">
		                    <thead>
		                        <tr>
		                    <br>
		                    <th class="text-center">+</th>
                            <th class="text-center">OPCIONES</th>
		                    <th class="text-center">NOMBRE</th>
		                    <th class="text-center">CENTRO</th>
		                    <th class="text-center">PERSONA</th>
                            
		                    </tr>
		                    </thead>
                    <?php
                    $limitado = $int->mostrarLimitadoCoordinacion($obtenerPaginaActual,$cant_resultados);
                    //var_dump($limitado);
                    #$empresa = ControlEmpresa::singleton_empresa();

                    foreach ($limitado as $key) {

                        //Guardo los datos de la BD en las variables de php
                        $id_coordinacion = $key['id_coordinacion'];
                        $nombre = $key['nombre_coordinacion'];
                        $responsable = $key['responsable'];
                        $centro = $key['nombre_centro'];
                        //Mostramos la empresa segun el id del Instructor
                        #$name_empresa = $empresa->BuscarEmpresaControl($key['id_empresa']);
                        ?>	 
                        <tr id="Coordinacion<?php echo $id_coordinacion; ?>">
                            <td class="text-center">
                               </td>

                            <td class="text-center">
                                <!--ESTE ES EL BOTON QUE REALIZA LA ELIMINACION-->
                                <a title="ELIMINAR" class="btn btn-danger btnEliminar" value="<?php echo $id_coordinacion ?>" style="color: white;">
                                    <i class="fa fa-trash" id="icon"></i>
                                </a>
                                <!--ESTE ES EL BOTON QUE REALIZA LA EDICION-->
                                <a title="EDITAR" class="btn btn-primary btneditar" value="<?php echo $id_coordinacion ?>" style="color: white;">
                                    <i class="fa fa-edit" id="icon"></i>
                                </a></td>
                            <td class="relleno text-center"><?php echo $nombre; ?></td>
                            <td class="relleno text-center"><?php echo $centro; ?></td>
                            <td class="relleno text-center"><?php echo $responsable; ?></td>
                           
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
if (isset($_POST['nombre'])) {
    $intContact = ControlCoordinacion::singleton_Coordinacion();
    $intContact->editarCoordinacion();
} else {
    #echo "<script>alert('No existe la variable ')</script>";
}

include_once VISTA_PATH . 'pie.php';
include_once VISTA_PATH . 'scriptAndFinal.php';
 ?>
 <script src="<?php echo PUBLIC_PATH; ?>js/Coordinaciones/mainCoordinacion.js"></script>
   <script src="<?php echo PUBLIC_PATH; ?>js/sweet_alert.js"></script>