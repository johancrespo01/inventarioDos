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
    header('Location:'.VISTA_PATH.'inicio?er='.$error);
    exit();
}
$usuario = $_SESSION['id_usuario'];
include_once VISTA_PATH . 'cabeza.php';
include_once VISTA_PATH . 'navegacion.php';
$int = ControlAmbiente::singleton_Ambiente();
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
                <a href="mi_inventario">Mi inventario</a>
            </li>
        </ol>
    </div>
    <div class="content-wrapper">
        <div class="container-fluid">
           <br>
           <div class="row">
            <div class="col-12">
                <div class="form-group animated flipInX">                                        
                  <select onchange="dd(this.value)" id="tipo_elementoI" class="selectpicker form-control" data-live-search="true" name="material" >
                    <option  VALUE="0"  disabled selected>Seleccione tipo de elemento</option> 
                    <option value="5" data-tokens="mustard" name="material">TIC</option> 
                    <option value="2" data-tokens="ketchup mustard" name="material">Muebles</option>
                    <option value="3" data-tokens="mustard" name="material">Herramientas</option>
                    <option value="4" data-tokens="mustard" name="material">Equipos de laboratorio</option>
                    
                     <option value="6" data-tokens="ketchup mustard" name="material">Todos los elementos</option>
                </select>                                  
            </div> 
            <input type="hidden" class="buscarMiInventario" id="<?php echo $usuario; ?>">
        </div>
    </div>
        <div class="tabla1">
<br><br>
<div  class="responsive text-center alert alert-info h4">

 ¡Atento! Recuerde que debe seleccionar un tipo de elemento para poder mostar la información requerida.
</div>
</div>
        <div id="datos_mostrar"></div>
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
<!--<script src="<?php echo PUBLIC_PATH; ?>js/mi_inventario_js/mi_inventario_js.js"></script>-->
