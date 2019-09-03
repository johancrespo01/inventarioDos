
<?php 
require_once CONTROL_PATH . 'Session.php';
require_once CONTROL_PATH . 'Ambiente/ControlAmbiente.php';
require_once CONTROL_PATH . 'Elemento/ControlElemento.php';
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
#include_once VISTA_PATH . 'navegacion.php';
/*********PAGINACION*********/

require_once LIB_PATH . 'Zebra_Pagination.php'; //incluimos la libreria 
$int = ControlAmbiente::singleton_Ambiente();
$total_registros = $int->mostrarAmbienteContadosControl();//llamar una funcion que contenga la cantidad de registros
$total = $total_registros["count(*)"];
$cant_resultados = 5;

$paginacion = new Zebra_Pagination();
$paginacion->records($total);//Aqui cantidad total de registros
$paginacion->records_per_page($cant_resultados); //cantidad de resultados en cada pagina
$obtenerPaginaActual =(($paginacion->get_page() - 1) * $cant_resultados);
#echo $obtenerPaginaActual;

//tomar el id del ambiente y hacer una consulta a los elementos y traer todos los que tengan el id_ambiente igual
/****************************/

#var_dump($elementos);exit();
?>
<div id="listaContacto"></div>
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
                <a href="tablaAmbiente">Ambientes</a>
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
                     <legend class="text-center">Elementos en el Ambiente actual</legend>
                     <form class="form-inline  barraBusqueda">
                         <input class="inputBusqueda" type="search" placeholder=" Aqui puede buscar el elemento que desea visualizar" aria-label="Search" id="parametroBusquedaAmbiente" name="parametroBusquedaAmbiente">
                         <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                     </form>
                     <div id="recargar" class="tablaDiseño">
                        <div id="datos"></div>
                        <div id="tabla" class="tablaDiseño">
                            <table id="buscarExt" class="table table-striped table-bordered table-sm tabla1" cellspacing="0" width="100%">
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
                <?php
                
                $id_ambiente = $_SESSION['ambiente'];
                $instancia_elementos = ControlElemento::singleton_elemento();
                $elementos = $instancia_elementos->elementosPorID($id_ambiente);
                #var_dump($elementos);exit();
                foreach ($elementos as $key) {

                        //Guardo los datos de la BD en las variables de php
                    $id_elemento = $key['id_elemento'];
                    $placa = $key['placa'];
                    $nombreBD = $key['nombre'];
                    $descripcion = $key['descripcion'];
                    $marca = $key['marca'];
                    $serial = $key['serial'];
                    $modulo = $key['modulo'];
                    $material = $key['material'];
                    $precio = $key['precio'];
                    $peso = $key['peso'];
                    $estado = $key['estado'];
                    $ambiente = $key['id_ambiente'];
                    $responsable = $key['id_persona'];
                    $ancho = $key['ancho'];
                    $alto = $key['alto'];
                    $largo = $key['largo'];
                        //Mostramos la empresa segun el id del aprendiz
                        #$name_empresa = $empresa->BuscarEmpresaControl($key['id_empresa']);
                    ?>   
                    <tr id="Elemento<?php echo $id_elemento; ?>">
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

                            <td>
                                <!--ESTE ES EL BOTON QUE REALIZA LA EDICION-->
                                <a style="color: white" title="Reportar novedad" class="btn btn-primary btnNovedad" value="<?php echo $id_elemento ?>">
                                    <i class="fa fa-edit" id="icon"></i>
                                </a></td>
                            </tr>
                            <?php
}//cierre del sino
// Cierras el WHILE
?>
</table>

</div>
<div id="paginar1" class="float-right">
    <?php $paginacion->render(); ?>
</div>

</fieldset>
<a class="btn btn-danger float-right der" id="btn2cancelar" style="color: white">Finalizar clase</a>
</div>

</div>
</div>
</div>
</div>
</div>

<?php 
if (isset($_POST['descripcion'])) {
    //si se detecta la variable entonces se debe modificar el elemento
    #echo "<script>alert('existe la variable ')</script>";
    $intContact = ControlElemento::singleton_elemento();
    $intContact->modificarElementoID();
} else {
    #echo "<script>alert('No existe la variable ')</script>";
}

include_once VISTA_PATH . 'pie.php';
include_once VISTA_PATH . 'scriptAndFinal.php';
?>
<script src="<?php echo PUBLIC_PATH; ?>js/sweet_alert.js"></script>
<script src="<?php echo PUBLIC_PATH; ?>js/Ambiente/mainAmbiente.js"></script>
