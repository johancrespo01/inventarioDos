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
require_once CONTROL_PATH . 'Programa' . DS . 'ControlPrograma.php';
require_once CONTROL_PATH . 'Coordinacion' . DS . 'ControlCoordinacion.php';
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
                <a href="registrarPrograma">Registrar Programa</a>
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
                        <legend class="text-center">Datos del Programa</legend>
                        <form enctype="multipart/form-data" action="" method="POST" id="formadd">

                            <!--Contacto-->

                            <div class="form-group">
                                    <label for="exampleInputEmail1">Coordinacion</label><br/>
                                    <select class="selectpicker form-control" data-live-search="true" name="coordinacion">
                                        <?php
                                        $int = ControlCoordinacion::singleton_coordinacion();
                                        $resultado = $int->mostrarCoordinacionControl();
                                        if ($resultado == null) {
                                            echo '<script>
                                                       swal({
                                                         title: "Importante!!",
                                                         text: "Antes de registrar un programa debe existir una coordinacion",
                                                         icon: "error"
                                                         }).then((willDelete) => {
                                                          if (willDelete) {
                                                            window.location.replace("../Coordinacion/registrarCoordinacion");
                                                          }else{
                                                            window.location.replace("registrarPrograma");
                                                          }
                                                          });
                                                </script>';
                                        }
                                        $coordinacion =  $resultado[0]['nombre_coordinacion'];
                                        ?>

                                        <option data-tokens="ketchup mustard" name="coordinacion" selected="true" style="display:none;"
                                                value='<?php echo $resultado[0]['id_coordinacion']; ?>'><?php echo $resultado[0]['responsable']." - ", $coordinacion; ?></option>
                                        <?php
                                        foreach ($resultado as $key) {
                                            $nom_Coordinacion = $key['nombre_coordinacion'];
                                            $id_Coordinacion = $key['id_coordinacion'];
                                            $responsableCoordinacion = $key['responsable'];
                                            ?>
                                            <option data-tokens="ketchup mustard" name="coordinacion" value='<?php echo $id_Coordinacion; ?>' ><?php echo $responsableCoordinacion. " - ", $nom_Coordinacion; ?></option>
                                            <?php
                                        }//fin de for
                                        ?>
                                    </select>
                                </div>


                            <div class="form-group">
                                <label for="formGroupExampleInput">Nombre</label>
                                <input  type="text" class="form-control text_max" name="nombre" id="nombre_user" placeholder="Nombre" required>
                            </div>
                            <input type="submit" value="Registrar" class="btn btn-primary float-right" id="btn2">
                            <a href="registrarPrograma" class="btn btn-danger izq" id="btn2">Cancelar </a>
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
    $intContact = ControlPrograma::singleton_programa();
    $intContact->nuevoPrograma();
} else {
    #echo "<script>alert('No existe la variable ')</script>";
}

include_once VISTA_PATH . 'pie.php';
include_once VISTA_PATH . 'scriptAndFinal.php';
 ?>
