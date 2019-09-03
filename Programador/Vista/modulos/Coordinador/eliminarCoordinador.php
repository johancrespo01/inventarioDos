<?php

date_default_timezone_get('America/Bogota');
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', '..' . DS . '..' . DS . '..');
require_once '..' . DS . '..' . DS . '..' . DS . 'Config' . DS . 'Config.php';
require_once CONTROL_PATH . 'Coordinador/ControlCoordinador.php';


$objetClass = ControlCoordinador::singleton_Coordinador();
$rs = $objetClass->eliminarCoordinadorController();

// echo $rs;
return $rs;
?>