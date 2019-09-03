<?php

date_default_timezone_get('America/Bogota');
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', '..' . DS . '..' . DS . '..');
require_once '..' . DS . '..' . DS . '..' . DS . 'Config' . DS . 'Config.php';
require_once CONTROL_PATH . 'Coordinacion/ControlCoordinacion.php';


$objetClass = ControlCoordinacion::singleton_Coordinacion();
$rs = $objetClass->eliminarCoordinacionController();

// echo $rs;
return $rs;
?>