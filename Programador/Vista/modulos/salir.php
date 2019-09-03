<?php
require_once CONTROL_PATH . 'Session.php';
$salir = new Session;
$salir->iniciar();
$salir->outsession();
$er = '5';
$error = base64_encode($er);
header('Location:inicio?er='.$error);
exit();
