<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', '..' . DS . '..' . DS . '..');
require_once '..' . DS . '..' . DS . '..' . DS . 'Config' . DS . 'Config.php';
require_once CONTROL_PATH . 'aprendiz' . DS . 'ControlAprendiz.php';

$intMostrar = ControlAprendiz::singleton_aprendiz();
$dtll = $intMostrar->BuscarNumIdControl();
//var_dump($dtll);exit();
if (isset($dtll[0]['nombre'])) {
    echo 0;
} else {
    echo 1;
}
?>