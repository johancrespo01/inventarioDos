<?php 
require_once MODELO_PATH . 'Ingreso' . DS . 'ModeloIngresoClass.php';
require_once CONTROL_PATH . 'Session.php';
require_once CONTROL_PATH . 'hash.php';
@session_start();
class ControlIngresoClass 
{
	
	private static $instancia;

    public static function singleton_IngresoClass() {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }

    //FUNCION DE POLO
    public function tiempoRealIngresoClassControl() {
        //require_once '..'.DS. MODELO_PATH . 'IngresoClass' . DS . 'ModeloInstructor.php';
        //print_r($_POST);
        if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
            isset($_POST['parametro']) &&
            !empty($_POST['parametro'])) {
            $modificar = json_decode(stripslashes($_POST['parametro']));
        $modUs = ModeloIngresoClass::tiempoRealIngresoClassModel($modificar->id);
        return $modUs;
    }
}

    //metodo para registrar un nuevo Aprendiz
public function nuevoIngresoClass() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
        isset($_POST['ambiente']) &&
        !empty($_POST['ambiente']) &&
        isset($_POST['ficha']) &&
        !empty($_POST['ficha']) &&
        isset($_POST['programa']) &&
        !empty($_POST['programa']) &&
        isset($_POST['hora_salida']) &&
        !empty($_POST['hora_salida'])
    ) {
    $_SESSION['ambiente'] = $_POST['ambiente'];
    $documentoPersona = $_SESSION['documento'];

     //consulta para saber la personas
     $datos_persona = ModeloIngresoClass::obtenerPersona($documentoPersona);
     $id_persona = $datos_persona[0]['id_persona'];

        $hora = date("h");
        $minutos = date("i");
        $formato = date("A"); 
        $horaEntrada = $hora. ":". $minutos ." ". $formato;

              $valores = array('ambienteBD' => $_POST['ambiente'],
                'fichaBD' => $_POST['ficha'],
                'programaBD' => $_POST['programa'],
                'personaBD' => $id_persona,
                'horaEntradaBD' => $horaEntrada,
                'horaSalidaBD' => $_POST['hora_salida']
            );
            //porceder a guardar mediante un metodo del modelo
              $guardar = ModeloIngresoClass::guardarIngresoClass($valores);

              if($guardar['guardar'] != FALSE){
               echo '<script>
               swal({
                 title: "Guardo",
                 text: "Clase registrada",
                 icon: "success"
                 }).then((willDelete) => {
                    if (willDelete) {
                        window.location.replace("inventarioAmbiente");
                    }
                    window.location.replace("inventarioAmbiente");
                    });
                    </script>';
                }else{
                    echo '<script>
                    swal({
                      title: "Oops!",
                      text: "Ha ocurrido un error al guardar",
                      icon: "error"
                      });
                      </script>';
                  }
            ////////////////////
              } else {
                echo '<script>
                swal({
                 title: "Oops!",
                 text: "No se recibieron algunos datos",
                 icon: "error"
                 });
                 </script>';
             }
         }

         public function mostrarLimitadoIngresoClass($valores,$cant){
            $resultado = ModeloIngresoClass::mostrarLimitadoIngresoClassModel($valores,$cant);
            return $resultado;
        }

        public function mostrarProgramaControl() {
            $personas = ModeloIngresoClass::mostrarProgramaModel();
            return $personas;
        }


        public function mostrarIngresoClassControl() {
            $personas = ModeloIngresoClass::mostrarIngresoClassModel();
            return $personas;
        }

        public function mostrarIngresoClassContadosControl() {
            $personas = ModeloIngresoClass::mostrarIngresoClassContadoModel();
            return $personas;
        }

    }

    ?>