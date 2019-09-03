<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', '..' . DS . '..' . DS . '..');
require_once '..' . DS . '..' . DS . '..' . DS . 'Config' . DS . 'Config.php';
require_once CONTROL_PATH . 'Elemento' . DS . 'ControlElemento.php';
if (isset($_POST['detalleClases'])) {
 $intContact = ControlElemento::singleton_elemento();
 $intContact->desactivarElementoControl();
 //echo $intContact;
  #echo "<script>alert('modificar...')</script>";
} else {
    #echo "<script>alert('No existe la variable ')</script>";
}
return $intContact;
?>
