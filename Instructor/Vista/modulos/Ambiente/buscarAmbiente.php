<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', '..' . DS . '..' . DS . '..');
require_once '..' . DS . '..' . DS . '..' . DS . 'Config' . DS . 'Config.php';
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
require_once CONTROL_PATH . 'Ambiente' . DS . 'ControlAmbiente.php';

$int = ControlAmbiente::singleton_Ambiente();
$resultado = $int->tiempoRealAmbienteControl();

?>

                        <table class="table table-striped table-bordered table-sm tabla2" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                            <br>
                            <th>NOMBRE<hr></th>
                            <th>PROGRAMA<hr></th>
                            </tr>
                            </thead>
                    <?php
                  
                    #var_dump($limitado);exit();
                    #$empresa = ControlEmpresa::singleton_empresa();

                    foreach ($resultado as $key) {

                        //Guardo los datos de la BD en las variables de php
                        $programa = $key['nombre_programa'];
                        $nombre = $key['nombre'];

                        //Mostramos la empresa segun el id del Instructor
                        #$name_empresa = $empresa->BuscarEmpresaControl($key['id_empresa']);
                        ?>   
                        <tr id="Elemento<?php echo $id_aprendiz; ?>">
                            <td class="relleno"><?php echo $nombre; ?></td>
                            <td class="relleno"><?php echo $programa; ?></td>
                            <td>
                                <!--ESTE ES EL BOTON QUE REALIZA LA ELIMINACION-->
                                <a class="btn btn-danger btnEliminar" value="<?php echo $id_aprendiz ?>">
                                    <i class="fa fa-trash" id="icon"></i>
                                </a></td>

                            <td>
                                <!--ESTE ES EL BOTON QUE REALIZA LA EDICION-->
                                <a class="btn btn-primary btneditar" value="<?php echo $id_aprendiz ?>">
                                    <i class="fa fa-edit" id="icon"></i>
                                </a></td>
                        </tr>
    <?php
}// Cierras el WHILE
?>
                </table>
                
           