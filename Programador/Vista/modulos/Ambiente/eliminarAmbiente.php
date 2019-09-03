<?php

date_default_timezone_get('America/Bogota');
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', '..' . DS . '..' . DS . '..');
require_once '..' . DS . '..' . DS . '..' . DS . 'Config' . DS . 'Config.php';
require_once CONTROL_PATH . 'Ambiente/ControlAmbiente.php';


$objetClass = ControlAmbiente::singleton_ambiente();
$rs = $objetClass->eliminarAmbienteController();

echo $rs;
return $rs;
?>