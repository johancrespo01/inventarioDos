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
require_once CONTROL_PATH . 'Ambiente' . DS . 'ControlAmbiente.php';
require_once CONTROL_PATH . 'Programa' . DS . 'ControlPrograma.php';
#$int = ControlPrograma::singleton_Programa();$resultado = $int->mostrarProgramaControl();echo $resultado[0]['id_programa'];exit();                                      
                                        
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
                <a href="registrarAmbiente">Registrar Ambiente</a>
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
                        <legend class="text-center">Datos del Ambiente</legend>
                        <form enctype="multipart/form-data" action="" method="POST" id="formadd">
                           
                            <!--Contacto-->
                            <div class="form-group">
                                <label for="formGroupExampleInput">Nombre</label>
                                <input  type="text" class="form-control text_max" name="nombre" id="nombre_user" placeholder="Nombre" required>
                            </div>

                            <div class="form-group">                                        
                                    <label for="exampleInputEmail1">Programa</label><br/>
                                    <select class="selectpicker form-control" data-live-search="true" name="programa">
                                        <?php
                                        $int = ControlPrograma::singleton_Programa();
                                        $resultado = $int->mostrarProgramaControl();
                                        #$Programa =  $resultado[0]['nombre_Programa'];
                                        ?>

                                        <option data-tokens="ketchup mustard" name="programa" selected="true" style="display:none;" 
                                                value='<?php echo $resultado[0]['id_programa']; ?>'><?php echo $resultado[0]['nombre']; ?></option>

                                        <?php
                                        foreach ($resultado as $key) {
                                            $nom_Programa = $key['nombre'];
                                            $id_programa = $key['id_programa'];

                                            #$responsablePrograma = $key['responsable'];
                                            ?>
                                            <option data-tokens="ketchup mustard" name="programa" value='<?php echo $id_programa; ?>' ><?php echo $nom_Programa; ?></option>  
                                            <?php
                                        }//fin de for
                                        ?>
                                    </select>                                          
                                </div>


                            
                            <input type="submit" value="Registrar" class="btn btn-primary float-right" id="btn2">
                            <a href="registrarAmbiente" class="btn btn-danger der" id="btn2">Cancelar </a>
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
if (isset($_POST['programa'])) {
    $intContact = ControlAmbiente::singleton_Ambiente();
    $intContact->nuevoAmbiente();
} else {
    #echo "<script>alert('No existe la variable ')</script>";
}

include_once VISTA_PATH . 'pie.php';
include_once VISTA_PATH . 'scriptAndFinal.php';
 ?>
