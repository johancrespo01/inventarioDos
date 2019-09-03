<?php
require_once MODELO_PATH . 'Aprendiz' . DS . 'ModeloAprendiz.php';
require_once CONTROL_PATH . 'hash.php';
class ControlAprendiz
{

	private static $instancia;

    public static function singleton_aprendiz() {
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
            $verUs = ModeloAprendiz::BuscarNumIdModel($verificar_num->existe);
            return $verUs;

        }
    }

    //FUNCION DE POLO
    public function tiempoRealAprendizControl() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
                isset($_POST['parametro']) &&
                !empty($_POST['parametro'])) {
            $modificar = json_decode(stripslashes($_POST['parametro']));
            $modUs = ModeloAprendiz::buscarAprendizModel($modificar->id);
            return $modUs;
        }
    }

    public function mostrarAprendizEspecificoControl() {
     if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
      isset($_POST['detalleClases']) &&
      !empty($_POST['detalleClases'])) {
      $modificar = json_decode(stripslashes($_POST['detalleClases']));
    $id_aprendiz = $modificar->id_aprendiz;
    $modUs = ModeloAprendiz::mostrarAprendizEspecificoModel($id_aprendiz);
    return $modUs;
    }

}



    //para paginacion
    public function mostrarAprendizContadosControl(){
        $personas = ModeloAprendiz::mostrarAprendizContadoModel();
        return $personas;
    }

    public function mostrarLimitadoAprendiz(){
        $resultado = ModeloAprendiz::mostrarLimitadoAprendizModel();
        return $resultado;
    }
    //FIN PARA paginacion

    //metodo para registrar un nuevo Aprendiz
    public function nuevoAprendiz() {
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
            $guardar = ModeloAprendiz::guardarAprendiz($valores);
            //GUARDAMOS TAMBIEN EL USUARIO DE INGRESO AL APLICATIVO
            $guardarUser = ModeloAprendiz::guardarAprendizUsuario($valores);
            /////////////////////
            if($guardar['guardar'] != FALSE){
           echo '<script>
                      swal({
                         title: "Guardo",
                      text: "Guardado Correctamente",
                     icon: "success"
                        }).then((willDelete) => {
            if (willDelete) {
                window.location.replace("crearAprendiz");
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

    public function mostrarAprendizControl() {
        $personas = ModeloAprendiz::mostrarAprendizModel();
        return $personas;
    }
}

 ?>
