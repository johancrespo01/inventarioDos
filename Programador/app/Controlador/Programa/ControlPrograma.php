<?php
require_once MODELO_PATH . 'Programa' . DS . 'ModeloPrograma.php';


class ControlPrograma
{

	private static $instancia;

  public static function singleton_Programa() {
    if (!isset(self::$instancia)) {
      $miclase = __CLASS__;
      self::$instancia = new $miclase;
    }
    return self::$instancia;
  }

  public function eliminarProgramaController(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
      isset($_POST['detalleClases']) &&
      !empty($_POST['detalleClases'])) {
      $modificar = json_decode(stripslashes($_POST['detalleClases']));
    $modUs = ModeloPrograma::eliminarProgramaModel($modificar->id_Programa);
    return $modUs;
  }
}

public function mostrarProgramaActualControl(){
  if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
    isset($_POST['detalleClases']) &&
    !empty($_POST['detalleClases'])) {
    $modificar = json_decode(stripslashes($_POST['detalleClases']));
  $modUs = ModeloPrograma::mostrarProgramaModelPorID($modificar->id_Programa);
  return $modUs;
}
}

    //FUNCION DE POLO
public function tiempoRealProgramaControl() {
        //require_once '..'.DS. MODELO_PATH . 'Programa' . DS . 'ModeloPrograma.php';
        //print_r($_POST);
  if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
    isset($_POST['parametro']) &&
    !empty($_POST['parametro'])) {
    $modificar = json_decode(stripslashes($_POST['parametro']));
  $modUs = ModeloPrograma::tiempoRealProgramaModel($modificar->id);
  return $modUs;
  }
}

    //metodo para registrar un nuevo programa
public function nuevoPrograma() {
  if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
    isset($_POST['coordinacion']) &&
    !empty($_POST['coordinacion']) &&
    isset($_POST['nombre']) &&
    !empty($_POST['nombre'])
    // $_FILES['imagen']['name']
  ) {

        	// echo "<script>alert('Entro al controlador')</script>";
					// exit();
            /* $nom_arch = $_FILES['imagen']['name']; //obtener el nombre del imagen
              $ext_img = explode(".", $nom_arch);
              $ext_img = end($ext_img);
              $nombre_img = strtolower($_POST['nombre_user'] .'_'. $_POST['apellido_user']) . '.' . $ext_img; */

              $valores = array('coordinacionBD' => $_POST['coordinacion'],
                'nombreBD' => $_POST['nombre']
              );
            //porceder a guardar mediante un metodo del modelo
              $guardar = ModeloPrograma::guardarPrograma($valores);
            /////////////////////
              if($guardar['guardar'] != FALSE){
               echo '<script>
               swal({
                 title: "Guardo",
                 text: "Guardado Correctamente",
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

        public function modificarPrograma() {
                if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
                  isset($_POST['coordinacion']) &&
                  !empty($_POST['coordinacion']) &&
                  isset($_POST['nombre']) &&
                  !empty($_POST['nombre']) &&
                  isset($_POST['id_programa']) &&
                  !empty($_POST['id_programa'])
        // $_FILES['imagen']['name']
                ) {

          echo "<script>alert('Entro al controlador')</script>";
            /* $nom_arch = $_FILES['imagen']['name']; //obtener el nombre del imagen
              $ext_img = explode(".", $nom_arch);
              $ext_img = end($ext_img);
              $nombre_img = strtolower($_POST['nombre_user'] .'_'. $_POST['apellido_user']) . '.' . $ext_img; */

              $valores = array('coordinacionBD' => $_POST['coordinacion'],
                'nombreBD' => $_POST['nombre'],
                'id_programa' => $_POST['id_programa']
              );
							 //var_dump($valores);exit();
            //porceder a guardar mediante un metodo del modelo
              $modificar = ModeloPrograma::modificarProgramaModel($valores);
							if ($modificar['id'] == "0") {
								echo '<script>
								swal({
									title: "Oops!",
									text: "La consulta se ah ejecutado pero no ha modificado ningun elemento de la tabla... NO SE CUAL ES EL HIJUEPUTA ERRROR",
									icon: "error"
									});
									</script>';
							}
							var_dump($modificar['id']);exit();
            /////////////////////
              if($modificar['guardar'] != FALSE && $modificar['id'] != "0"){
               echo '<script>
               swal({
                 title: "Operacion Exitosa",
                 text: "Modificado Correctamente",
                 icon: "success"
                 }).then((willDelete) => {
                  if (willDelete) {
                    window.location.replace("tablaProgramas");
                  }
                  });
                  </script>';
                }else{
                  echo '<script>
                  swal({
                    title: "Oops!",
                    text: "Ha ocurrido un error al Modificar",
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

               public function mostrarLimitadoPrograma(){
                $resultado = ModeloPrograma::mostrarLimitadoProgramaModel();
                return $resultado;
              }

              public function mostrarProgramaControl() {
                $personas = ModeloPrograma::mostrarProgramaModel();
                return $personas;
              }

              public function mostrarProgramaEspecificoControl($id) {
                $personas = ModeloPrograma::mostrarProgramaEspecificoModel($id);
                return $personas;
              }

              public function mostrarProgramaContadosControl() {
                $personas = ModeloPrograma::mostrarProgramaContadoModel();
                return $personas;
              }

            }

            ?>
            <script src="<?php echo PUBLIC_PATH; ?>js/sweet_alert.js"></script>
