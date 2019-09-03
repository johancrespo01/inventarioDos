<?php 
require_once MODELO_PATH . 'categorias' . DS . 'ModeloMueble.php';

class ControlMueble 
{
	
	private static $instancia;

    public static function singleton_mueble() {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }

    //FUNCION DE POLO
    public function tiempoRealMuebleControl() {
        //require_once '..'.DS. MODELO_PATH . 'Instructor' . DS . 'ModeloInstructor.php';
        //print_r($_POST);
        if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
            isset($_POST['parametro']) &&
            !empty($_POST['parametro'])) {
            $modificar = json_decode(stripslashes($_POST['parametro']));
        $modUs = ModeloMueble::tiempoRealMuebleModel($modificar->id);
        return $modUs;
    }
}

 



    }

    ?>