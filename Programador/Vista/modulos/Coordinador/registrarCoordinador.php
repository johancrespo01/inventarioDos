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
require_once CONTROL_PATH . 'Coordinador' . DS . 'ControlCoordinador.php';
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
                <a href="registrarCoordinador">Registrar Coordinador</a>
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
                        <legend class="text-center">Datos del Coordinador</legend>
                        <form enctype="multipart/form-data" action="" method="POST" id="formadd">
                            <div class="form-group">                                        
                                <label for="exampleInputEmail1">Tipo de documento</label><br/>
                                <select class="selectpicker form-control" data-live-search="true" name="tipoD">
                                    <option data-tokens="ketchup mustard" name="tipoD">Cedula de Ciudadania</option>
                                    <option data-tokens="mustard" name="tipoD">Tarjeta de Identidad</option>
                                    <option data-tokens="mustard" name="tipoD">Cedula de Extranjeria</option>
                                    <option data-tokens="mustard" name="tipoD">Numero ciego SENA</option>
                                    <option data-tokens="mustard" name="tipoD">Pasaporte</option>
                                    <option data-tokens="mustard" name="tipoD">Documento Nacional de Identificacion</option>
                                    <option data-tokens="mustard" name="tipoD">Numero de Identificacion Tributaria</option>
                                </select>                                          
                            </div>

                            <label id="validar"></label>
                            <div class="form-group">

                                <label for="formGroupExampleInput2">Numero de documento</label>
                                <input name="numero_documento" type="number" class="form-control" id="numDoc" placeholder="Document number" required>
                            </div>

                            <!--Contacto-->
                            <div class="form-group">
                                <label for="formGroupExampleInput">Nombres</label>
                                <input  type="text" class="form-control text_max" name="nombre_user" id="nombre_user" placeholder="Name" required>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Apellidos</label>
                                <input  type="text" class="form-control text_max2" name="apellido_user" id="apellido_user" placeholder="Last name" required>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Correo</label>
                                <input  type="mail" class="form-control" name="correo_user" id="correo_user" placeholder="Mail" required>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Telefono</label>
                                <input  type="number" class="form-control num_max" name="telefono_user" id="telefono_user" placeholder="Phone" required>
                            </div>  
                            <input type="submit" value="Registrar" class="btn btn-primary float-right" id="btn2">
                            <a href="registrarCoordinador" class="btn btn-danger izq" id="btn2">Cancelar </a>
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
if (isset($_POST['nombre_user'])) {
    $intContact = ControlCoordinador::singleton_coordinador();
    $intContact->nuevoCoordinador();
} else {
    #echo "<script>alert('No existe la variable ')</script>";
}

include_once VISTA_PATH . 'pie.php';
include_once VISTA_PATH . 'scriptAndFinal.php';
 ?>
  <script src="<?php echo PUBLIC_PATH; ?>js/Coordinador/mainCoordinador.js"></script>