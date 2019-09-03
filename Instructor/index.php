<?php 
date_default_timezone_get('America/Bogota'); //Se define la zona
define('ROOT', __DIR__); // se crea la variable ROOT la cual contiene la raiz del proyecto
define('DS', DIRECTORY_SEPARATOR); //DS sera el separador de carpetas por ejemplo / o \ 
require_once 'Config' . DS . 'Config.php';
require_once CONTROL_PATH .  'EnlacesControl.php';
$instancia = new EnlacesControl();
$instancia->CargarPlantilla();
 ?>