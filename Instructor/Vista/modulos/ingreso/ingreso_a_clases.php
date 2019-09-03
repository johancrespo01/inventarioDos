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
require_once CONTROL_PATH . 'Ingreso' . DS . 'ControlIngresoClases.php';
require_once CONTROL_PATH . 'Ambiente' . DS . 'ControlAmbiente.php';
$instacia_programas = ControlIngresoClass::singleton_IngresoClass();
$programas = $instacia_programas->mostrarProgramaControl();
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
                <a href="registrarInstructor">Inicio de clase</a>
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
                        <legend class="text-center">Datos</legend>
                        <form enctype="multipart/form-data" action="" method="POST" id="formadd">
                             <div class="form-group">                                        
                                    <label for="exampleInputEmail1">Ambiente</label><br/>
                                    <select class="selectpicker form-control" data-live-search="true" name="ambiente">
                                        <?php
                                        $int = ControlAmbiente::singleton_Ambiente();
                                        $resultado = $int->mostrarAmbienteControl();
                                        $ambiente =  $resultado[0]['nombre'];
                                        ?>

                                        <option data-tokens="ketchup mustard" name="ambiente" selected="true" style="display:none;" 
                                                value='<?php echo $resultado[0]['id_ambiente']; ?>'><?php echo $ambiente; ?></option>

                                        <?php
                                        foreach ($resultado as $key) {
                                            $nom_ambiente = $key['nombre'];
                                            $id_ambiente = $key['id_ambiente'];
                                            ?>
                                            <option data-tokens="ketchup mustard" name="ambiente" value='<?php echo $id_ambiente; ?>' ><?php echo $nom_ambiente; ?></option>  
                                            <?php
                                        }//fin de for
                                        ?>
                                    </select>                                          
                                </div>

                            <div class="form-group">
                                <label for="formGroupExampleInput2">Ficha</label>
                                <input name="ficha" type="number" class="form-control" id="ficha" placeholder="Ficha" required style="text-transform: uppercase;">
                            </div>
                            

                            <div class="form-group">                                        
                                    <label for="exampleInputEmail1">Programa</label><br/>
                                    <select class="selectpicker form-control" data-live-search="true" name="programa">
                                        <?php
                                        $programa =  $programas[0]['nombre'];
                                        ?>

                                        <option data-tokens="ketchup mustard" name="ambiente" selected="true" style="display:none;" 
                                                value='<?php echo  $programas[0]['id_programa']; ?>'><?php echo $programa; ?></option>

                                        <?php
                                        foreach ($programas as $key) {
                                            $nom_programa = $key['nombre'];
                                            $id_programa = $key['id_programa'];
                                            ?>
                                            <option data-tokens="ketchup mustard" name="ambiente" value='<?php echo $id_programa; ?>' ><?php echo $nom_programa; ?></option>  
                                            <?php
                                        }//fin de for
                                        ?>
                                    </select>                                          
                                </div>

                            <div class="form-group">

                                <label for="formGroupExampleInput2">Hora de finalizacion de la clase</label>
                                <input name="hora_salida" type="text" class="form-control" id="ficha" placeholder="Example: 7:00 PM" required style="text-transform: uppercase;">
                            </div>

                            <input type="hidden" name="numeroPersona" value=" <?php echo $_SESSION['documento'] ?> ">

                            <input type="submit" value="Iniciar clase" class="btn btn-primary float-right" id="btn2">
                            <a href="ingreso_a_clases" class="btn btn-danger der" id="btn2">Cancelar </a>
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
if (isset($_POST['ficha'])) {
    $intContact = ControlIngresoClass::singleton_IngresoClass();
    $intContact->nuevoIngresoClass();
} else {
    #echo "<script>alert('No existe la variable ')</script>";
}

include_once VISTA_PATH . 'pie.php';
include_once VISTA_PATH . 'scriptAndFinal.php';
 ?>



