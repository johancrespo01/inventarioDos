<?php 
require_once MODELO_PATH . 'Centro' . DS . 'ModeloCentro.php';


class ControlCentro 
{
	
	private static $instancia;

    public static function singleton_centro() {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }

    //FUNCION DE POLO
    public function tiempoRealCentroControl() {
        //require_once '..'.DS. MODELO_PATH . 'Centro' . DS . 'ModeloCentro.php';
        //print_r($_POST);
        if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
            isset($_POST['parametro']) &&
            !empty($_POST['parametro'])) {
            $modificar = json_decode(stripslashes($_POST['parametro']));
        $modUs = ModeloCentro::tiempoRealCentroModel($modificar->id);
        return $modUs;
    }
}
  
  //ELIMINAR CENTRO
public function eliminarCentroController(){
      if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
            isset($_POST['detalleClases']) &&
            !empty($_POST['detalleClases'])) {
            $modificar = json_decode(stripslashes($_POST['detalleClases']));
        $modUs = ModeloCentro::eliminarCentroModel($modificar->id_centro);
        return $modUs;
    }
}


    //metodo para registrar un nuevo Aprendiz
public function nuevoCentro() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
        isset($_POST['region']) &&
        !empty($_POST['region']) &&
        isset($_POST['nombre']) &&
        !empty($_POST['nombre']) &&
        isset($_POST['direccion']) &&
        !empty($_POST['direccion']) &&
        isset($_POST['telefono']) &&
        !empty($_POST['telefono']) &&
        isset($_POST['correo']) &&
        !empty($_POST['correo'])


        // $_FILES['imagen']['name']
    ) {

        	#echo "<script>alert('Entro al controlador')</script>";
            /* $nom_arch = $_FILES['imagen']['name']; //obtener el nombre del imagen
              $ext_img = explode(".", $nom_arch);
              $ext_img = end($ext_img);
              $nombre_img = strtolower($_POST['nombre_user'] .'_'. $_POST['apellido_user']) . '.' . $ext_img; */

              $valores = array('regionBD' => $_POST['region'],
                'nombreBD' => $_POST['nombre'],
                'direccionBD' => $_POST['direccion'],
                'telefonoBD' => $_POST['telefono'],
                'correorBD' => $_POST['correo']
            );
            //porceder a guardar mediante un metodo del modelo
              $guardar = ModeloCentro::guardarCentro($valores);
            /////////////////////
              if($guardar['guardar'] != FALSE){
               echo '<script>
               swal({
                 title: "Guardo",
                 text: "Guardado Correctamente",
                 icon: "success"
                 }).then((willDelete) => {
                    if (willDelete) {
                        window.location.replace("registrarCentro");
                    }
                    });
                    </script>';
                }else{
                    echo '<script>
                    swal({
                      title: "Oops!",
                      text: "Ha ocurrido un error al modificar",
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

         //EDITAR CENTRO
         public function editarCentro() {

    if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
        isset($_POST['region']) &&
        !empty($_POST['region']) &&
        isset($_POST['nombre']) &&
        !empty($_POST['nombre']) &&
        isset($_POST['direccion']) &&
        !empty($_POST['direccion']) &&
        isset($_POST['telefono']) &&
        !empty($_POST['telefono']) &&
        isset($_POST['correo']) &&
        !empty($_POST['correo'])


        // $_FILES['imagen']['name']
    ) {

          #echo "<script>alert('Entro al controlador')</script>";
            /* $nom_arch = $_FILES['imagen']['name']; //obtener el nombre del imagen
              $ext_img = explode(".", $nom_arch);
              $ext_img = end($ext_img);
              $nombre_img = strtolower($_POST['nombre_user'] .'_'. $_POST['apellido_user']) . '.' . $ext_img; */

              $valores = array('regionBD' => $_POST['region'],
                'nombreBD' => $_POST['nombre'],
                'direccionBD' => $_POST['direccion'],
                'telefonoBD' => $_POST['telefono'],
                'correorBD' => $_POST['correo'],
                'id_centroBD' => $_POST['CentroActual']
            );
            //porceder a guardar mediante un metodo del modelo
              $Modificar = ModeloCentro::editarCentroModel($valores);
            /////////////////////
              if($Modificar['guardar'] != FALSE){
               echo '<script>
               swal({
                 title: "Guardo",
                 text: "Modificado Correctamente",
                 icon: "success"
                 }).then((willDelete) => {
                    if (willDelete) {
                        window.location.replace("tablaCentro");
                    }
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

         public function mostrarCentroActualControl(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
            isset($_POST['detalleClases']) &&
            !empty($_POST['detalleClases'])) {
            $modificar = json_decode(stripslashes($_POST['detalleClases']));
            $modUs = ModeloCentro::tiempoRealCentroModel($modificar->id_centro);
            return $modUs;
          }
         }

         public function mostrarLimitadoCentro($valores,$cant){
            $resultado = ModeloCentro::mostrarLimitadoCentroModel($valores,$cant);
            return $resultado;
        }

        public function mostrarCentroControl() {
            $personas = ModeloCentro::mostrarCentroModel();
            return $personas;
        }
        public function mostrarCentroControlID($id) {
            $personas = ModeloCentro::mostrarCentroModelID($id);
            return $personas;
        }

        public function mostrarCentroContadosControl() {
            $personas = ModeloCentro::mostrarCentroContadoModel();
            return $personas;
        }

    }

    ?>
