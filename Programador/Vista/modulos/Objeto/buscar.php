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
require_once CONTROL_PATH . 'Elemento' . DS . 'ControlElemento.php';

$resultado = ControlElemento::singleton_elemento();
$resultado = $resultado->tiempoRealElementoControl();

?>
<div class="tablaDiseño">
  <table class="table table-striped table-bordered table-sm tabla2" cellspacing="0" width="100%">
    <thead>
      <tr>
        <br>
        <th>PLACA<hr></th>
        <th>NOMBRE<hr></th>
        <th>DESCRIPCION<hr></th>
        <th>MARCA<hr></th>
        <th>SERIAL<hr></th> 
        <th>MODULO <hr></th>
        <th>MATERIAL<hr></th>
        <th>PRECIO<hr></th>
        <th>PESO<hr></th>
        <!--<th>FECHA DE ADQUISICION<hr></th>-->
        <th>ESTADO<hr></th>
        <th>AMBIENTE<hr></th>
        <th>RESPONSABLE<hr></th>
        <th>ANCHO<hr></th>
        <th>ALTO<hr></th>
        <th>LARGO<hr></th>
                          <!--<th>FECHA DE INGRESO AL SISTEMA<hr></th>
                          <th>ULTIMA MODIFICACION<hr></th>
                          <th>AUTOR DE LA MODIFICACION<hr></th>-->
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        foreach($resultado as $valor){
                          $placa = $valor['placa'];
                          $nombreBD = $valor['nombre'];
                          $descripcion = $valor['descripcion'];
                          $marca = $valor['marca'];
                          $serial = $valor['serial'];
                          $modulo = $valor['modulo'];
                          $material = $valor['material'];
                          $precio = $valor['precio'];
                          $peso = $valor['peso'];
                          $estado = $valor['estado'];
                          $ambiente = $valor['id_ambiente'];
                          $responsable = $valor['id_persona'];
                          $ancho = $valor['ancho'];
                          $alto = $valor['alto'];
                          $largo = $valor['largo'];
                          ?>
                          <tr id="Elemento<?php echo $id_aprendiz; ?>">
                            <td class="relleno"><?php echo $placa; ?></td>
                            <td class="relleno"><?php echo $nombreBD; ?></td>
                            <td class="relleno"><?php echo $descripcion; ?></td>
                            <td class="relleno"><?php echo $marca; ?></td>
                            <td class="relleno"><?php echo $serial; ?></td>
                            <td class="relleno"><?php echo $modulo; ?></td>
                            <td class="relleno"><?php echo $material; ?></td>
                            <td class="relleno"><?php echo $precio; ?></td>
                            <td class="relleno"><?php echo $peso; ?>kg</td>
                            <td class="relleno"><?php echo $estado; ?></td>
                            <td class="relleno"><?php echo $ambiente; ?></td>
                            <td class="relleno"><?php echo $responsable; ?></td>
                            <td class="relleno"><?php echo $ancho; ?></td>
                            <td class="relleno"><?php echo $alto; ?></td>
                            <td class="relleno"><?php echo $largo; ?></td>
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
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>