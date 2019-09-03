<?php 
require_once CONTROL_PATH . 'Session.php';
require_once CONTROL_PATH . 'cambiarPass.php';
$objss = new Session;
$objss->iniciar();
if ($_SESSION["validado"] != "SI") {

    $er = '2';
    $error = base64_encode($er);
    $salir = new Session;
    $salir->iniciar();
    $salir->outsession();
    header('Location:'.VISTA_PATH.'inicio?er='.$error);
    exit();
}
include_once VISTA_PATH . 'cabeza.php';
include_once VISTA_PATH . 'navegacion.php';
/*********PAGINACION*********/

require_once LIB_PATH . 'Zebra_Pagination.php'; //incluimos la libreria 
//$int = ControlInstructor::singleton_instructor();
//$total_registros = $int->mostrarInstructorContadosControl();//llamar una funcion que contenga la cantidad de registros
// $total = $total_registros["count(*)"];
// $cant_resultados = 5;

// $paginacion = new Zebra_Pagination();
// $paginacion->records($total);//Aqui cantidad total de registros
// $paginacion->records_per_page($cant_resultados); //cantidad de resultados en cada pagina
// $obtenerPaginaActual =(($paginacion->get_page() - 1) * $cant_resultados);
// #echo $obtenerPaginaActual;


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
                <a href="cambiarContraseña">Cambiar contraseña</a>
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
                       <legend class="text-center">Cambiar mi contraseña</legend>
                       <div class="tablaDiseño animated flipInX">

                        <form method="POST" id="form_cambiarPass">
                            <label for="formGroupExampleInput">Ingrese la contraseña actual</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Contraseña actual" aria-label="password" aria-describedby="basic-addon2" name="passActual" id="passActual" required>
                                <div class="input-group-append">
                                    <button id="verV" class="btn btn-secondary btn-outline-secondary" type="button">
                                     <i class="fas fa-eye"></i>
                                 </button>
                             </div>
                         </div>

                         <label for="formGroupExampleInput">Ingrese la nueva contraseña</label>
                         <div class="input-group mb-3">
                            <input type="password" class="form-control" aria-label="password" aria-describedby="basic-addon2" name="newPass" id="newPass" required oncopy="Accion bloqueada" onpaste="return false" maxlength="8" placeholder="Nueva contraseña">
                            <div class="input-group-append">
                                <button id="verN" title="Ver contraseña" class="btn btn-secondary btn-outline-secondary" type="button">
                                 <i class="fas fa-eye"></i>
                             </button>
                         </div>
                     </div>

                     <label for="formGroupExampleInput">verifique la nueva contraseña</label>
                     <div class="input-group mb-3">
                        <input type="password" class="form-control" aria-label="password" aria-describedby="basic-addon2" name="veriPass" id="veriPass" required onpaste="return false" maxlength="8">
                        <div class="input-group-append">
                            <button id="verVer" class="btn btn-secondary btn-outline-secondary" type="button">
                             <i class="fas fa-eye"></i>
                         </button>
                     </div>
                 </div>
                 <input type="button" value="Cambiar contraseña" class="btn btn-primary float-right cambiarPass" id="btn2">
             </form>
         </div>
   

    </fieldset>
</div>

</div>
</div>
</div>
</div>
</div>

<?php 
if (isset($_POST['newPass'])) {
 $intContact = ControlCambiarPass::singleton_CambiarPass();
 $intContact->cambiarContrasenia();
} else {
    #echo "<script>alert('No existe la variable ')</script>";
}

include_once VISTA_PATH . 'pie.php';
include_once VISTA_PATH . 'scriptAndFinal.php';
?>
<script src="<?php echo PUBLIC_PATH; ?>js/cambiarPass.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/sweet_alert.js"></script>
