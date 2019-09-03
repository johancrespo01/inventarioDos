<?php 
require_once MODELO_PATH . 'Coordinacion' . DS . 'ModeloCoordinacion.php';


class ControlCoordinacion 
{
	
	private static $instancia;

  public static function singleton_coordinacion() {
    if (!isset(self::$instancia)) {
      $miclase = __CLASS__;
      self::$instancia = new $miclase;
    }
    return self::$instancia;
  }

  public function eliminarCoordinacionController(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
      isset($_POST['detalleClases']) &&
      !empty($_POST['detalleClases'])) {
      $modificar = json_decode(stripslashes($_POST['detalleClases']));
    $modUs = ModeloCoordinacion::eliminarCoordinacionModel($modificar->id_Coordinacion);
    return $modUs;
  }
}

public function mostrarCoordinacionActualControl(){
  if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
    isset($_POST['detalleClases']) &&
    !empty($_POST['detalleClases'])) {
    $modificar = json_decode(stripslashes($_POST['detalleClases']));
  $modUs = ModeloCoordinacion::mostrarCoordinacionModelPorID($modificar->id_Coordinacion);
  return $modUs;
}
}

    //FUNCION DE POLO
public function tiempoRealCoordinacionControl() {
        //require_once '..'.DS. MODELO_PATH . 'Coordinacion' . DS . 'ModeloCoordinacion.php';
        //print_r($_POST);
  if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
    isset($_POST['parametro']) &&
    !empty($_POST['parametro'])) {
    $modificar = json_decode(stripslashes($_POST['parametro']));
  $modUs = ModeloCoordinacion::tiempoRealCoordinacionModel($modificar->id);
  return $modUs;
}
}

    //metodo para registrar un nuevo Aprendiz
public function nuevoCoordinacion() {
  if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
    isset($_POST['centro']) &&
    !empty($_POST['centro']) &&
    isset($_POST['nombre']) &&
    !empty($_POST['nombre']) &&
    isset($_POST['responsable']) &&
    !empty($_POST['responsable'])
  ) {

        	#echo "<script>alert('Entro al controlador')</script>";
            /* $nom_arch = $_FILES['imagen']['name']; //obtener el nombre del imagen
              $ext_img = explode(".", $nom_arch);
              $ext_img = end($ext_img);
              $nombre_img = strtolower($_POST['nombre_user'] .'_'. $_POST['apellido_user']) . '.' . $ext_img; */

              $valores = array('centroBD' => $_POST['centro'],
                'nombreBD' => $_POST['nombre'],
                'responsableBD' => $_POST['responsable']
              );
            //porceder a guardar mediante un metodo del modelo
              $guardar = ModeloCoordinacion::guardarCoordinacion($valores);
            /////////////////////
              if($guardar['guardar'] != FALSE){
               echo '<script>
               swal({
                 title: "Guardo",
                 text: "Guardado Correctamente",
                 icon: "success"
                 }).then((willDelete) => {
                  if (willDelete) {
                    window.location.replace("registrarCoordinacion");
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

          public function editarCoordinacion() {
                if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
                  isset($_POST['centro']) &&
                  !empty($_POST['centro']) &&
                  isset($_POST['nombre']) &&
                  !empty($_POST['nombre']) &&
                  isset($_POST['responsable']) &&
                  !empty($_POST['responsable'])
                ) {

          #echo "<script>alert('Entro al controlador')</script>";
            /* $nom_arch = $_FILES['imagen']['name']; //obtener el nombre del imagen
              $ext_img = explode(".", $nom_arch);
              $ext_img = end($ext_img);
              $nombre_img = strtolower($_POST['nombre_user'] .'_'. $_POST['apellido_user']) . '.' . $ext_img; */

              $valores = array('centroBD' => $_POST['centro'],
                'nombreBD' => $_POST['nombre'],
                'responsableBD' => $_POST['responsable'],
                'id_Coordinacion' => $_POST['id_Coordinacion']
              );
            //porceder a guardar mediante un metodo del modelo
              $modificar = ModeloCoordinacion::modificarCoordinacion($valores);
            /////////////////////
              if($modificar['guardar'] != FALSE){
               echo '<script>
               swal({
                 title: "Operacion exitosa",
                 text: "Modificado Correctamente",
                 icon: "success"
                 }).then((willDelete) => {
                  if (willDelete) {
                    window.location.replace("tablaCoordinacion");
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

               public function mostrarLimitadoCoordinacion($valores,$cant){
                $resultado = ModeloCoordinacion::mostrarLimitadoCoordinacionModel($valores,$cant);
                return $resultado;
              }

              public function mostrarCoordinacionControl() {
                $personas = ModeloCoordinacion::mostrarCoordinacionModel();

                return $personas;
              }

              public function mostrarCoordinacionControlID($id) {
                $personas = ModeloCoordinacion::mostrarCoordinacionModelID($id);
                return $personas;
              }


              public function mostrarCoordinacionContadosControl() {
                $personas = ModeloCoordinacion::mostrarCoordinacionContadoModel();
                return $personas;
              }

            }

            ?>