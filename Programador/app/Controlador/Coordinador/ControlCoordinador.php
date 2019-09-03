<?php 
require_once MODELO_PATH . 'Coordinador' . DS . 'ModeloCoordinador.php';

require_once CONTROL_PATH . 'hash.php';


class ControlCoordinador 
{
	
	private static $instancia;

    public static function singleton_coordinador() {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }

    public function BuscarNumIdControl() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
                isset($_POST['numExi']) &&
                !empty($_POST['numExi'])
        ) {


            $verificar_num = json_decode(stripslashes($_POST['numExi']));
            //$verAd_Ins = ModeloAdministrador::BuscarNumIdAdminModel($verificar_num->existe);
            $verUs = ModeloCoordinador::BuscarNumIdModel($verificar_num->existe);
            return $verUs;
            
        }
    }

    public function mostrarCoordinadorActualControl(){
  if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
    isset($_POST['detalleClases']) &&
    !empty($_POST['detalleClases'])) {
    $modificar = json_decode(stripslashes($_POST['detalleClases']));
  $modUs = ModeloCoordinador::mostrarCoordinadorModelPorID($modificar->id_Coordinador);
  return $modUs;
}
}

    public function eliminarCoordinadorController(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
      isset($_POST['detalleClases']) &&
      !empty($_POST['detalleClases'])) {
      $modificar = json_decode(stripslashes($_POST['detalleClases']));
    $modUs = ModeloCoordinador::eliminarCoordinadorModel($modificar->id_Coordinador);
    return $modUs;
  }
}

    //FUNCION DE POLO
    public function tiempoRealCoordinadorControl() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
                isset($_POST['parametro']) &&
                !empty($_POST['parametro'])) {
            $modificar = json_decode(stripslashes($_POST['parametro']));
            $modUs = ModeloCoordinador::buscarCoordinadorModel($modificar->id);
            return $modUs;
        }
    }

    //para paginacion 
    public function mostrarCoordinadorContadosControl() {
        $personas = ModeloCoordinador::mostrarCoordinadorContadoModel();
        return $personas;
    }

    public function mostrarLimitadoCoordinador(){
        $resultado = ModeloCoordinador::mostrarLimitadoCoordinadorModel();
        return $resultado;
    }
    //FIN PARA paginacion

    //metodo para registrar un nuevo Coordinador
    public function nuevoCoordinador() {
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
            $clavecifrada = Hash::hashpass($clave);

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
            $guardar = ModeloCoordinador::guardarCoordinador($valores);
            //GUARDAMOS TAMBIEN EL USUARIO DE INGRESO AL APLICATIVO
            $valoresU = array('num_documento' => $_POST['numero_documento'],
                'pass' => $clavecifrada,
                'nombre' => $_POST['nombre_user'],
                'correo' => $_POST['correo_user'],
                'apellido' => $_POST['apellido_user'],
                'passNoCifrada' => $clave,
                'id_persona' => $guardar['id']
            );
            $guardarUser = ModeloCoordinador::guardarCoordinadorUsuario($valoresU);
            /////////////////////
            if($guardar['guardar'] != FALSE){
           echo '<script>
                      swal({
                         title: "Guardo",
                      text: "Guardado Correctamente",
                     icon: "success"
                        }).then((willDelete) => {
            if (willDelete) {
                window.location.replace("registrarCoordinador");
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

    public function editarCoordinador() {
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
            $clavecifrada = Hash::hashpass($clave);
            $id_Coordinador = $_POST['id_coordinador'];

            $valores = array('tipo_documento' => $_POST['tipoD'],
                'num_documento' => $_POST['numero_documento'],
                'nombre_user' => $_POST['nombre_user'],
                'apellido_user' => $_POST['apellido_user'],
                'correo_user' => $_POST['correo_user'],
                'telefono_user' => $_POST['telefono_user'],
                'telefono_user' => $_POST['telefono_user'],
                'pass' => $clavecifrada,
                'id_coordinador' => $id_Coordinador
            );
            //porceder a guardar mediante un metodo del modelo
            $guardar = ModeloCoordinador::editarCoordinadorModel($valores);
            if($guardar['guardar'] != FALSE){
           echo '<script>
                      swal({
                         title: "Guardo",
                      text: "Guardado Correctamente",
                     icon: "success"
                        }).then((willDelete) => {
            if (willDelete) {
                window.location.replace("tablaCoordinador");
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

    public function mostrarCoordinadorControl() {
        $personas = ModeloCoordinador::mostrarCoordinadorModel();
        return $personas;
    }
    public function mostrarCoordinadorControlID($id) {
        $personas = ModeloCoordinador::mostrarCoordinadorModelID($id);
        return $personas;
    }

    public function mostrarCoordinadorControlPorID($id) {
        $personas = ModeloCoordinador::mostrarCoordinadorModelPorId($id);
        return $personas;
    }
}

 ?>