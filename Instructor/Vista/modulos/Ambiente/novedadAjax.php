<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', '..' . DS . '..' . DS . '..');
require_once '..' . DS . '..' . DS . '..' . DS . 'Config' . DS . 'Config.php';
require_once CONTROL_PATH . 'Elemento' . DS . 'ControlElemento.php';
if (isset($_POST['detalleClases'])) {
 $intContact = ControlElemento::singleton_elemento();
 $intContact->modoficarPorAjax();
 $a = true;
   echo "<script>alert('modificado...')</script>";
} else { 
	$a = false;
     echo "<script>alert('No modificado')</script>";
}
return $a;
?>