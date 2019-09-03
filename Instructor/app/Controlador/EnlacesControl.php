<?php 

class EnlacesControl {
	
	public function CargarPlantilla(){
		include VISTA_PATH. 'template.php';
	}

	public function EnlacesPaginas(){
        //NUEVO
        if(isset($_GET['url'])){
            $enlace= filter_input(INPUT_GET,'url',FILTER_SANITIZE_URL);        
        } else {
           $enlace='inicio'; 
        }
        //LLAMAMOS AL MODELO PARA QUE DEVUELVA LA VISTA
        if (empty($enlace)) {
        	echo "ALGO VA MAL2";
        }else{
        	$repuestaVista= EnlacesModelo::DevolverVista($enlace);
        }    	
        
        
        if (empty($repuestaVista)) {
        	echo "ALGO VA MAL3";
        }else{
        	include_once $repuestaVista;
        }
         
    }
}
 ?>