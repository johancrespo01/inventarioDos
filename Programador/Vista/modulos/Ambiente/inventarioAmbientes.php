<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', '..' . DS . '..' . DS . '..');
require_once '..' . DS . '..' . DS . '..' . DS . 'Config' . DS . 'Config.php';
require_once CONTROL_PATH . 'Ambiente' . DS . 'ControlAmbiente.php';

$resultado = ControlAmbiente::singleton_Ambiente();
$resultado = $resultado->mostrarLimitadoElementoPorIDAJAXControl();
if (isset($_POST['parametro'])) {
    $modificar = json_decode(stripslashes($_POST['parametro']));
    $id_ambienteA = $modificar->id;
}
?>
<script type="text/javascript">
	$(".tabla1").hide();
</script>
<br>
<a class="btn btn-success" href="tablaAmbiente">
	<i class="fa fa-arrow-left"></i>
</a>
<br>
<table class="table table-striped table-bordered table-sm" id="buscarExt" cellspacing="0" width="100%">
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
        </tr>
    </thead>
    <?php
    foreach ($resultado as $key) {
     $placa = $key['placa'];
     $id_elemento = $key['id_elemento'];
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
            <!--ESTE ES EL BOTON QUE REALIZA LA ELIMINACION-->
            <a class="btn btn-danger btnEliminarE" value="<?php echo $id_elemento; ?>">
               <i class="fa fa-trash" id="icon" style="color: white"></i>
           </a>
       </td>
       <td>
        <a class="btn btn-primary btneditarE" value="<?php echo $id_elemento; ?>">
           <i class="fa fa-edit" id="icon" style="color: white"></i>
       </a>
       <input type="hidden" class="valorIDoculto" value="<?php echo $id_ambienteA; ?>">
   </td>
</tr>
<?php
}// Cierras el WHILE


?>
<script src="<?php echo PUBLIC_PATH; ?>js/Ambiente/mainAmbiente.js"></script>
</table

