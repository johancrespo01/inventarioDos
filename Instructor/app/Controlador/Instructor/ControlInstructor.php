<?php 
require_once MODELO_PATH . 'Instructor' . DS . 'ModeloInstructor.php';

require_once CONTROL_PATH . 'hash.php';


class ControlInstructor 
{
	
	private static $instancia;

    public static function singleton_instructor() {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }

    //FUNCION DE POLO
    public function tiempoRealElectronicoControl() {
        //require_once '..'.DS. MODELO_PATH . 'Instructor' . DS . 'ModeloInstructor.php';
        //print_r($_POST);
        if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
            isset($_POST['parametro']) &&
            !empty($_POST['parametro'])) {
            $modificar = json_decode(stripslashes($_POST['parametro']));
        $modUs = ModeloInstructor::tiempoRealElectronicoModel($modificar->id);
        return $modUs;
    }
}

    //metodo para registrar un nuevo Aprendiz
public function nuevoInstructor() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
        isset($_POST['tipoD']) &&
        !empty($_POST['tipoD']) &&
        isset($_POST['numero_documento']) &&
        !empty($_POST['numero_documento']) &&
        isset($_POST['nombre_user']) &&
        !empty($_POST['nombre_user']) &&
        isset($_POST['apellido_user']) &&
        !empty($_POST['apellido_user']) &&
        isset($_POST['correo_user']) &&
        !empty($_POST['correo_user']) &&
        isset($_POST['telefono_user']) &&
        !empty($_POST['telefono_user']) 


        // $_FILES['imagen']['name']
    ) {
        	#echo "<script>alert('Entro al controlador')</script>";
            /* $nom_arch = $_FILES['imagen']['name']; //obtener el nombre del imagen
              $ext_img = explode(".", $nom_arch);
              $ext_img = end($ext_img);
              $nombre_img = strtolower($_POST['nombre_user'] .'_'. $_POST['apellido_user']) . '.' . $ext_img; */


              $clave = $_POST['numero_documento'];

              $clavecifrada = password_hash($clave, PASSWORD_DEFAULT);

              $valores = array('tipo_documento' => $_POST['tipoD'],
                'num_documento' => $_POST['numero_documento'],
                'nombre_user' => $_POST['nombre_user'],
                'apellido_user' => $_POST['apellido_user'],
                'correo_user' => $_POST['correo_user'],
                'telefono_user' => $_POST['telefono_user'],
                'telefono_user' => $_POST['telefono_user'],
                'pass' => $clavecifrada
            );
            //porceder a guardar mediante un metodo del modelo
              $guardar = ModeloInstructor::guardarInstructor($valores);
              //echo $guardar['id'];
              if($guardar['guardar'] != FALSE){
               echo '<script>
               swal({
                 title: "Guardo",
                 text: "Instructor Guardado Correctamente",
                 icon: "success"
                 }).then((willDelete) => {
                    if (willDelete) {
                        window.location.replace("registrarInstructor");
                    }
                    });
                    </script>';
                }

              $valoresU  = array('pass' => $clavecifrada,
                                  'num_documento' => $_POST['numero_documento'],
                                  'nombre_user' => $_POST['nombre_user'],
                                  'id_instructor' => $guardar['id']
                                );
            //GUARDAMOS TAMBIEN EL USUARIO DE INGRESO AL APLICATIVO
              $guardarUser = ModeloInstructor::guardarInstructorUsuario($valoresU);
            /////////////////////
              if($guardarUser['guardar'] != FALSE){
               echo '<script>
               swal({
                 title: "Guardo",
                 text: "Guardado Correctamente Usuario",
                 icon: "success"
                 }).then((willDelete) => {
                    if (willDelete) {
                        window.location.replace("registrarInstructor");
                    }
                    });
                    </script>';
                }else{
                    echo '<script>
                    swal({
                      title: "Oops!",
                      text: "Ha ocurrido un error al guardar Usuario",
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

         public function mostrarLimitadoInstructor($valores,$cant){
            $resultado = ModeloInstructor::mostrarLimitadoInstructorModel($valores,$cant);
            return $resultado;
        }

        public function mostrarInstructorControl($id) {
            $personas = ModeloInstructor::mostrarInstructorModel($id);
            return $personas;
        }
        public function mostrarInstructorControlPorId($id) {
            $personas = ModeloInstructor::mostrarInstructorModelPorID($id);
            return $personas;
        }

        public function mostrarInstructorContadosControl() {
            $personas = ModeloInstructor::mostrarInstructorContadoModel();
            return $personas;
        }

        public function mostrarLimitadoElementoPorIDAJAXControlInstructor(){
           if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
                  isset($_POST['parametro']) &&
                  !empty($_POST['parametro'])) {
                  $modificar = json_decode(stripslashes($_POST['parametro']));
                $modUs = ModeloInstructor::mostrarLimitadoElementoPorIDAJAXMODEL($modificar->id,$modificar->fil);
                return $modUs;
              }
        }

        public function mostrarnovedadelementoIDAJAXControlInstructor($id){
               $novedad = ModeloInstructor::mostrarnovedadelemento($id);
               // var_dump($novedad);
               // $novedades=$novedad[0]['descripcion'];
                if(!isset($novedad[0]['descripcion'])){

              $novedad="No hay novedades";
              
                
              }
              else{
                $novedad=$novedad[0]['descripcion'];
               
              }
               return $novedad;
              
            }



    }

    ?>

     <script src="<?php echo PUBLIC_PATH; ?>js/sweet_alert.js"></script>