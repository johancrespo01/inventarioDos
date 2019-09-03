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
require_once CONTROL_PATH . 'Coordinacion' . DS . 'ControlCoordinacion.php';
require_once CONTROL_PATH . 'Centro' . DS . 'ControlCentro.php';
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
                <a href="registrarCoordinacion">Registrar Coordinacion</a>
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
                        <legend class="text-center">Datos de la coordinacion</legend>
                        <form enctype="multipart/form-data" action="" method="POST" id="formadd">
                           <div class="form-group">                                        
                                    <label for="exampleInputEmail1">Centro</label><br/>
                                    <select class="selectpicker form-control" data-live-search="true" name="centro">
                                        <?php
                                        $int = ControlCentro::singleton_centro();
                                        $resultado = $int->mostrarCentroControl();
                                        if ($resultado == null) {
                                            echo '<script>
                                                       swal({
                                                         title: "Importante!!",
                                                         text: "Antes de registrar una coordinacion debe existir un centro",
                                                         icon: "error"
                                                         }).then((willDelete) => {
                                                          if (willDelete) {
                                                            window.location.replace("../Centro/registrarCentro");
                                                          }else{
                                                            window.location.replace("registrarCoordinacion");
                                                          }
                                                          });
                                                </script>';
                                        }
                                        #var_dump($resultado);
                                        ?>

                                        <option data-tokens="ketchup mustard" name="centro" selected="true" style="display:none;" 
                                                value='<?php echo $resultado[0]['id_centro']; ?>'><?php echo $resultado[0]['nombre']; ?></option>

                                        <?php
                                        foreach ($resultado as $key) {
                                            $nom_centro = $key['nombre'];
                                            $id_centro = $key['id_centro'];
                                            ?>
                                            <option data-tokens="ketchup mustard" name="centro" value='<?php echo $id_centro; ?>' ><?php echo $nom_centro; ?></option>  
                                            <?php
                                        }//fin de for
                                        ?>
                                    </select>                                          
                                </div>
                            <!--Contacto-->
                            <div class="form-group">
                                <label for="formGroupExampleInput">Nombre</label>
                                <input  type="text" class="form-control text_max" name="nombre" id="nombre" placeholder="Name" required>
                            </div>
                            <div class="form-group">                                        
                                    <label for="exampleInputEmail1">Persona a cargo</label><br/>
                                    <select class="selectpicker form-control" data-live-search="true" name="responsable">
                                        <?php
                                        $int = ControlCoordinador::singleton_Coordinador();
                                        $Coordinadores = $int->mostrarCoordinadorControl();
                                         if ($Coordinadores == null) {
                                            echo '<script>
                                                       swal({
                                                         title: "Importante!!",
                                                         text: "Antes de registrar una coordinacion debe existir un coordinador",
                                                         icon: "error"
                                                         }).then((willDelete) => {
                                                          if (willDelete) {
                                                            window.location.replace("../Coordinador/registrarCoordinador");
                                                          }else{
                                                            window.location.replace("registrarCoordinacion");
                                                          }
                                                          });
                                                </script>';
                                        }
                                       # var_dump($Coordinadores);
                                        ?>

                                        <option data-tokens="ketchup mustard" name="Coordinador" selected="true" style="display:none;" 
                                                value='<?php echo $Coordinadores[0]['id_persona']; ?>'><?php echo $Coordinadores[0]['nombre']; ?></option>

                                        <?php
                                        foreach ($Coordinadores as $key) {
                                            $nom_Coordinador = $key['nombre'];
                                            $id_persona = $key['id_persona'];
                                            ?>
                                            <option data-tokens="ketchup mustard" name="Coordinador" value='<?php echo $id_persona; ?>' ><?php echo $nom_Coordinador; ?></option>  
                                            <?php
                                        }//fin de for
                                        ?>
                                    </select>                                          
                                </div>
                            
                            <input type="submit" value="Registrar" class="btn btn-primary float-right" id="btn2">
                            <a href="registrarCoordinacion" class="btn btn-danger izq" id="btn2">Cancelar </a>
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
    $intContact = ControlCoordinacion::singleton_coordinacion();
    $intContact->nuevoCoordinacion();
} else {
    #echo "<script>alert('No existe la variable ')</script>";
}

include_once VISTA_PATH . 'pie.php';
include_once VISTA_PATH . 'scriptAndFinal.php';
 ?>