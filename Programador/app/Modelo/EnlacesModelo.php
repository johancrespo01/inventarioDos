<?php
class EnlacesModelo {

 	public function DevolverVista($enlace){
 		$vista = VISTA_PATH.'modulos'.DS.$enlace.'.php';
 		if (!is_readable($vista)) {
 			//echo "No se puede leer la ruta";
 			$vista = "";
 			#$vista =VISTA_PATH.'modulos'.DS.'inicio.php';
 			$er = '2';
			$error = base64_encode($er);
			//exit();
			header('Location:inicio?er='.$error);
 		}
 		return $vista;
 	}
}
 ?>
