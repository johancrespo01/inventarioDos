<?php

date_default_timezone_get('America/Bogota');
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', '..' . DS . '..' . DS . '..');
require_once '..' . DS . '..' . DS . '..' . DS . 'Config' . DS . 'Config.php';
require_once CONTROL_PATH . 'Centro/ControlCentro.php';


$objetClass = ControlCentro::singleton_Centro();
$rs = $objetClass->eliminarCentroController();

// echo $rs;
return $rs;
?>