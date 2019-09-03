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
  public function BuscarNumIdControl() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
                isset($_POST['numExi']) &&
                !empty($_POST['numExi'])
        ) {


            $verificar_num = json_decode(stripslashes($_POST['numExi']));
            //$verAd_Ins = ModeloAdministrador::BuscarNumIdAdminModel($verificar_num->existe);
            $verUs = ModeloInstructor::BuscarNumIdModel($verificar_num->existe);
            return $verUs;

        }
    }
  //ELIMINAR CENTRO
  public function eliminarInstructorController(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
      isset($_POST['detalleClases']) &&
      !empty($_POST['detalleClases'])) {
      $modificar = json_decode(stripslashes($_POST['detalleClases']));
    $modUs = ModeloInstructor::eliminarInstructorModel($modificar->id_Instructor);
    return $modUs;
  }
}

public function mostrarInstructorActualControl(){
  if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
    isset($_POST['detalleClases']) &&
    !empty($_POST['detalleClases'])) {
    $modificar = json_decode(stripslashes($_POST['detalleClases']));
  $modUs = ModeloInstructor::mostrarInstructorModelPorID($modificar->id_Instructor);
  return $modUs;
}
}
    //FUNCION DE POLO
public function tiempoRealElectronicoControl() {
        //require_once '..'.DS. MODELO_PATH . 'Instructor' . DS . 'ModeloInstructor.php';
        //print_r($_POST);
  if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
            isset($_POST['parametro1']) &&
            !empty($_POST['parametro1'])) {
            $modificar = json_decode(stripslashes($_POST['parametro1']));
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
                  'apellido_user' => $_POST['apellido_user'],
                  'correo' => $_POST['correo_user'],
                  'passNoCifrado' => $clave,
                  'id_instructor' => $guardar['id']
                );
            //GUARDAMOS TAMBIEN EL USUARIO DE INGRESO AL APLICATIVO
                $guardarUser = ModeloInstructor::guardarInstructorUsuario($valoresU);
            /////////////////////
                if($guardarUser['guardar'] != FALSE){
                 echo '<script>
                 swal({
                   title: "Guardo",
                   text: "Instructor Guardado Correctamente",
                   icon: "success"
                   }).then((willDelete) => {
                    if (willDelete) {
                      
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


                 public function editarInstructor() {
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
                'pass' => $clavecifrada,
                'id_Instructor' => $_POST['id_Instructor']
              );
            //porceder a guardar mediante un metodo del modelo
              $modificar = ModeloInstructor::editarInstructorModel($valores);

            /////////////////////
                if($modificar['guardar'] != FALSE){
                 echo '<script>
                 swal({
                   title: "Guardo",
                   text: "Modificado Correctamente",
                   icon: "success"
                   }).then((willDelete) => {
                    if (willDelete) {
                      window.location.replace("tablaInstructores");
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


                 public function mostrarLimitadoInstructor(){
                  $resultado = ModeloInstructor::mostrarLimitadoInstructorModel();
                  return $resultado;
                }

                public function mostrarInstructorControl() {
                  $personas = ModeloInstructor::mostrarInstructorModel();
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
                  isset($_POST['parametro1']) &&
                  !empty($_POST['parametro1'])) {
                  $modificar = json_decode(stripslashes($_POST['parametro1']));
                $modUs = ModeloInstructor::mostrarLimitadoElementoPorIDAJAXMODEL($modificar->id,$modificar->fil);
                return $modUs;
              }
            }

            public function mostrarnovedadelementoIDAJAXControlInstructor($id){
               $novedad = ModeloInstructor::mostrarnovedadelemento($id);
               // var_dump($id);
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
