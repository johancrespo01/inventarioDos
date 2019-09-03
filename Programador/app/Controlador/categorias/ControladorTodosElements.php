<?php 
require_once MODELO_PATH . 'categorias' . DS . 'ModeloTodsoElements.php';

class ControlTodos 
{
	
	private static $instancia;

    public static function singleton_todos() {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }

    //FUNCION DE POLO
    public function todosLosElementosControl() {
        //require_once '..'.DS. MODELO_PATH . 'Instructor' . DS . 'ModeloInstructor.php';
        //print_r($_POST);
        if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
            isset($_POST['parametro']) &&
            !empty($_POST['parametro'])) {
            $modificar = json_decode(stripslashes($_POST['parametro']));
        $modUs = ModeloTodos::todosLosElementosModel();
        return $modUs;
    }
}

 



    }

    ?>