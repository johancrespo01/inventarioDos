<?php 
date_default_timezone_get('America/Bogota');
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', '..' . DS . '..' . DS . '..');
require_once '..' . DS . '..' . DS . '..' . DS . 'Config' . DS . 'Config.php';
#require_once CONTROL_PATH . 'Elemento' . DS . 'ControlElemento.php';
 require_once MODELO_PATH . 'conexion.php';
 $cnx = conexion::singleton_conexion();
 $salida = "";
 $sql = "SELECT * FROM elementos ORDER By id_elemento";

 if (isset($_POST['consulta'])) {
 	$sql = 
 }

 ?>