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
    //include_once VISTA_PATH . 'navegacion.php';
    require_once CONTROL_PATH . 'Elemento' . DS . 'ControlElemento.php';
    require_once CONTROL_PATH . 'Ambiente' . DS . 'ControlAmbiente.php';
    require_once CONTROL_PATH . 'Instructor' . DS . 'ControlInstructor.php';
    $intInstructor = ControlInstructor::singleton_instructor();
    $resultado = $intInstructor->mostrarInstructorControl();

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
                <a href="registrarObjeto">Registrar Elemento</a>
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
                        <legend class="text-center">Datos del elemento</legend>
                        <form enctype="multipart/form-data" action="" method="POST" id="formadd">

                         <div class="form-group">
                            <label for="exampleInputEmail1">Escoja el tipo de elemento a registrar</label><br/>
                            <select id="tipo_elemento" class="selectpicker form-control" data-live-search="true" name="material">
                                <option  VALUE="0"  disabled selected>Seleccione tipo de elemento</option>
                                <option value="2" data-tokens="ketchup mustard" name="material">Muebles</option>
                                <option value="3" data-tokens="mustard" name="material">Herramientas</option>
                                <option value="4" data-tokens="mustard" name="material">Equipos de laboratorio</option>
                                <option value="5" data-tokens="mustard" name="material">TIC</option>
                            </select>
                        </div>


                        <div class="form-group animated zoomInUp" style = "display:none;" id="Dresponsable">
                            <label for="exampleInputEmail1">Responsable de este elemento</label><br/>
                            <select class="selectpicker form-control animated zoomInUp" data-live-search="true" name="responsable" required>
                                <?php

                                $instructor =  $resultado[0]['nombre'];
                                ?>
                                <option  VALUE="0"  disabled selected>Seleccione la persona encargada</option>
                                <?php
                                foreach ($resultado as $key) {
                                    $nom_instructor = $key['nombre'];
                                    $id_instructor = $key['id_persona'];
                                    ?>
                                    <option data-tokens="ketchup mustard" name="responsable" value='<?php echo $id_instructor; ?>' ><?php echo $nom_instructor; ?></option>
                                    <?php
                                        }//fin de for
                                        ?>
                                    </select>
                                </div>


                                <div class="form-group animated zoomInUp" id="Dnombre" style = "display:none;">
                                    <label for="formGroupExampleInput">Nombre</label>
                                    <input  type="text_max2" class="form-control text_max" name="nombre" id="nombre" placeholder="Nombre del elemento" required >
                                </div>

                                <div id="Ddescripcion" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="formGroupExampleInput">Descripcion</label>
                                    <input  type="text_max2" class="form-control text_max" name="descripcion" id="descripcion" placeholder="Informacion adicional aqui" >
                                </div>

                                <div id="Dplaca" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="formGroupExampleInput">Numero de placa</label>
                                    <input  type="number" class="form-control text_max" name="numero_placa" id="numero_placa" placeholder="Numero de placa" required>
                                </div>

                                <div id="Dambiente" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="exampleInputEmail1">Ambiente</label><br/>
                                    <select class="selectpicker form-control" data-live-search="true" name="ambiente">
                                        <?php
                                        $int = ControlAmbiente::singleton_Ambiente();
                                        $resultado = $int->mostrarAmbienteControl();
                                        if ($resultado == null) {
                                            echo '<script>
                                                       swal({
                                                         title: "Oops!",
                                                         text: "Antes de registrar un elemento debe existir un Ambiente",
                                                         icon: "error"
                                                         }).then((willDelete) => {
                                                          if (willDelete) {
                                                            window.location.replace("../Ambiente/registrarAmbiente");
                                                          }else{
                                                            window.location.replace("registrarAmbiente");
                                                          }
                                                          });
                                                </script>';
                                        }
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


                                <div id="Dserial" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="formGroupExampleInput2">Serial</label>
                                    <input  type="number" class="form-control text_max2" name="serial" id="serial" placeholder="Serial" required>
                                </div>
                                <!-- DETALLES -->
                                <div id="Dpeso" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="formGroupExampleInput2">Peso en Kg</label>
                                    <input  type="number" class="form-control text_max2" name="Peso" id="Peso" placeholder="Peso">
                                </div>
                                <div id="Dancho" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="formGroupExampleInput2">Ancho en cm</label>
                                    <input  type="number" class="form-control text_max2" name="Ancho" id="Ancho" placeholder="Ancho">
                                </div>
                                <div id="Dalto" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="formGroupExampleInput2">Alto en cm</label>
                                    <input  type="number" class="form-control text_max2" name="Alto" id="Alto" placeholder="Alto">
                                </div>
                                <div id="Dlargo" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="formGroupExampleInput2">Largo en cm</label>
                                    <input  type="number" class="form-control text_max2" name="Largo" id="Largo" placeholder="Largo">
                                </div>
                                <div id="Dprecio" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="formGroupExampleInput2">Precio</label>
                                    <input  type="number" class="form-control text_max2" name="Precio" id="Precio" placeholder="Precio">
                                </div>
                                <!-- AQUI HACER MEMORIA INFORMATICA -->


                                <div id="Dram" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="formGroupExampleInput2">Ram</label><br>
                                    <div id="DaplicaRam" class="custom-control custom-checkbox form-group animated zoomInUp">
                                      <input type="checkbox" class="custom-control-input" id="defaultUncheckedU">
                                      <label class="custom-control-label" for="defaultUncheckedU">Aplica</label>
                                  </div>
                                    <input readonly="readonly" type="text" class="form-control" name="ram" id="ram" placeholder="Ram">
                                </div>

                                <div id="Dprocesador" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="formGroupExampleInput2">Procesador</label><br>
                                    <div id="DaplicaProcesador" class="custom-control custom-checkbox form-group animated zoomInUp">
                                          <input type="checkbox" class="custom-control-input" id="defaultUncheckedD">
                                          <label class="custom-control-label" for="defaultUncheckedD">Aplica</label>
                                    </div>
                                    <input readonly="readonly" type="text" class="form-control" name="procesador" id="procesador" placeholder="Procesador">
                                </div>

                                <div id="Dalmacenamiento" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="formGroupExampleInput2">Almacenamiento</label><br>
                                    <div id="Daplicaalmacenamiento" class="custom-control custom-checkbox form-group animated zoomInUp">
                                          <input type="checkbox" class="custom-control-input checkboxTres" id="defaultUncheckedT">
                                          <label class="custom-control-label" for="defaultUncheckedT">Aplica</label>
                                    </div>
                                    <input readonly="readonly" type="text" class="form-control" name="almacenamiento" id="almacenamiento" placeholder="Almacenamiento">
                                </div>
                                <!-- FIN DE MEMORIA INFORMATICA -->

                                <!--MARCA DEBE SER FORANEA -->
                                <div id="Dmarca" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="formGroupExampleInput2">Marca</label>
                                    <input  type="text" class="form-control" name="marca" id="marca" placeholder="Marca">
                                </div>
                                <div id="Dfecha_adquisicion" class="form-group animated zoomInUp" style = "display:none;">
                                    <label for="formGroupExampleInput2">Fecha de adquisicion</label>
                                    <input  type="date" class="form-control" name="fecha_adquisicion" id="fecha_adquisicion">
                                </div>

                                <input type="submit" value="Registrar" class="btn btn-primary float-right animated zoomInUp" id="btn2">
                                <a href="registrarObjeto" class="btn btn-danger izq animated zoomInUp" id="btn2">Cancelar </a>
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
if (isset($_POST['numero_placa'])) {
    $intContact = ControlElemento::singleton_elemento();
    $intContact->nuevoElemento();
} else {
    #echo "<script>alert('No existe la variable ')</script>";
}

include_once VISTA_PATH . 'pie.php';
include_once VISTA_PATH . 'scriptAndFinal.php';
?>
<script src="<?php echo PUBLIC_PATH; ?>js/Elemento/mainElemento.js"></script>
