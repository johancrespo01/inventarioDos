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
require_once CONTROL_PATH . 'Instructor' . DS . 'ControlInstructor.php';
require_once CONTROL_PATH . 'Ambiente' . DS . 'ControlAmbiente.php';
require_once CONTROL_PATH . 'Programa' . DS . 'ControlPrograma.php';
require_once CONTROL_PATH . 'Coordinacion' . DS . 'ControlCoordinacion.php';
// POR AMBIENTES OBTENER TODOS LOS AMBIENTES
$int = ControlAmbiente::singleton_ambiente();
$AmbientesTotalBD = $int->mostrarAmbienteControl();

// BUSCAR PROGRAMAS
$intProgramas = ControlPrograma::singleton_Programa();
$ProgramasTotalBD = $intProgramas->mostrarProgramaControl();
//var_dump($ProgramasTotalBD);exit();

//BUSCAR COORDINACION
$intCoordinacion = ControlCoordinacion::singleton_Coordinacion();
$CoordinacionTotalBD = $intCoordinacion->mostrarCoordinacionControl();

//BUSCAR INSTRUCTORES
$intInstructor = ControlInstructor::singleton_Instructor();
$InstructorTotalBD = $intInstructor->mostrarInstructorControl();
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
          <a href="crearAprendiz ">Registrar Aprendiz</a>
        </li>
      </ol>
    </div>
    <div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <form method="GET" action="<?php echo BASE_URL ?>Vista/modulos/subirImportar/excelPrueba.php">
                    <div class="formulario_empresa animated bounceInUp">
                        <legend class="text-center">Descargar Formato De Excel</legend>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Eliga que tipo de formato descargar</label>
                            <select class="selectpicker form-control" data-live-search="true" name="ente" required>
                                <option data-tokens="ketchup mustard" value="0" >Seleccionar</option>
                                <option data-tokens="mustard" value="Tic">Tic</option>
                                <option data-tokens="mustard" value="Herramientas">Herramientas</option>
                                <option data-tokens="mustard" value="laboratorio">Equipos de laboratorio</option>
                                <option data-tokens="mustard" value="Muebles">Muebles</option>
                                <!-- <option data-tokens="mustard" value="Aprendiz">Aprendiz</option> -->
                                <option data-tokens="mustard" value="Instructor">Instructor</option>
                                <option data-tokens="mustard" value="Coordinador">Coordinador</option>
                                <option data-tokens="mustard" value="Programa">Programa</option>
                                <option data-tokens="mustard" value="Ambiente">Ambiente</option>
                            </select>
                        </div>
                        <?php
                        // foreach para programas
                        foreach ($ProgramasTotalBD as $key) {
                            $Programa[] = $key['nombre'];
                            $idPrograma[] = $key['id_programa'];
                        }
                        // foreach para coordinacion
                        foreach ($CoordinacionTotalBD as $key) {
                            $Coordinacion[] = $key['nombre_coordinacion'];
                            $Responsable[] = $key['responsable'];
                            $idCoordinacion[] = $key['id_coordinacion'];
                        }
                        //foreach para ambientes
                        foreach ($AmbientesTotalBD as $key) {
                            $Ambiente[] = $key['nombre'];
                            $idAmbiente[] = $key['id_ambiente'];
                        }
                        //Foreach de instructor
                        foreach ($InstructorTotalBD as $key) {
                            $Instructor[] = $key['nombre'];
                            $idInstructor[] = $key['id_persona'];
                        }
                        // programa
                        $CODnomPrograma = json_encode($Programa);
                        $CODidPrograma = json_encode($idPrograma);

                        // Coordinaciom
                        $CODnomCoordinacion = json_encode($Coordinacion);
                        $CODidCoordinacion = json_encode($idCoordinacion);
                        $CODnomResponsableCoordinacion = json_encode($Responsable);

                        // CODIFICACION DE AMBIENTES
                        $CODambientes = json_encode($Ambiente);
                        $CODidAmbiente = json_encode($idAmbiente);

                        //CODIFICACION DE INSTRUCTOR
                        $CODInstructor = json_encode($Instructor);
                        $CODidInstructor = json_encode($idInstructor);

                         echo "
                           <input type='hidden' name='NombreAmbientesCOD' value='$CODnomPrograma'>
                           <input type='hidden' name='IDAmbientesCOD' value='$CODidPrograma'>

                           <input type='hidden' name='NombreCoordinacionCod' value='$CODnomCoordinacion'>
                           <input type='hidden' name='IDCoordinacionCOD' value='$CODidCoordinacion'>
                           <input type='hidden' name='ResponsableCoordinacionCod' value='$CODnomResponsableCoordinacion'>

                          <input type='hidden' name='CodAmbiente' value='$CODambientes'>
                           <input type='hidden' name='CodIdAmbiente' value='$CODidAmbiente'>

                            <input type='hidden' name='CodInstructor' value='$CODInstructor'>
                           <input type='hidden' name='CodIdInstructor' value='$CODidInstructor'>
                          ";
                      //   ?>

                        <input type="submit" class="btn btn-primary" value="Descargar formato">
                        <br><br>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

  </div>



<?php


include_once VISTA_PATH . 'pie.php';
include_once VISTA_PATH . 'scriptAndFinal.php';
?>
<script src="<?php echo PUBLIC_PATH; ?>js/aprendiz/mainAprendiz.js"></script>
