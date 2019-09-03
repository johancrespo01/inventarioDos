<?php 
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
include_once VISTA_PATH . 'cabeza.php';
include_once VISTA_PATH . 'navegacion.php';
require_once CONTROL_PATH . 'Centro' . DS . 'ControlCentro.php';
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
                <a href="registrarCentro">Registrar Centro</a>
            </li>
        </ol>
  </div>
        	<div class="content-wrapper">
    <div class="container-fluid">
       <br>
        <div class="row">
            <div class="col-12">
                <div class="formulario_empresa animated bounceInUp">
                    <fieldset class="fieldset">
                        <legend class="text-center">Datos del Centro</legend>
                        <form enctype="multipart/form-data" action="" method="POST" id="formadd">
                            <div class="form-group">                                        
                                <label for="exampleInputEmail1">Region</label><br/>
                                <select class="selectpicker form-control" data-live-search="true" name="region">
                                    <option data-tokens="ketchup mustard" name="region">Caribe</option>
                                    <option data-tokens="mustard" name="region">Amazonia</option>
                                    <option data-tokens="mustard" name="region">Andina</option>
                                    <option data-tokens="mustard" name="region">Insular</option>
                                    <option data-tokens="mustard" name="region">Orinoquía</option>
                                    <option data-tokens="mustard" name="region">Pacífico</option>
                                </select>                                          
                            </div>
                            <!--Contacto-->
                            <div class="form-group">
                                <label for="formGroupExampleInput">Nombre</label>
                                <input  type="text" class="form-control text_max soloLetras" name="nombre" id="nombre_user" placeholder="Nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Direccion</label>
                                <input  type="text" class="form-control text_max2" name="direccion" id="direccion" placeholder="Last name" required>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Telefono</label>
                                <input  type="text" class="form-control text_max2 soloNumeros" name="telefono" id="telefono" placeholder="telefono" required>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">correo</label>
                                <input  type="mail" class="form-control text_max2" name="correo" id="correo" placeholder="correo" required>
                            </div>
                            <input type="submit" value="Registrar" class="btn btn-primary float-right" id="btn2">
                            <a href="registrarCentro" class="btn btn-danger izq" id="btn2">Cancelar </a>
                            <br>
                        </form>
                    </fieldset>
                </div>

            </div>
        </div>
    </div>
</div>
      </div>
<?php 
if (isset($_POST['nombre'])) {
    $intContact = ControlCentro::singleton_centro();
    $intContact->nuevoCentro();
} else {
    #echo "<script>alert('No existe la variable ')</script>";
}

include_once VISTA_PATH . 'pie.php';
include_once VISTA_PATH . 'scriptAndFinal.php';
 ?>
 <script src="<?php echo PUBLIC_PATH; ?>js/Centro/mainCentro.js"></script>