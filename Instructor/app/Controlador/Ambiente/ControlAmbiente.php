<?php 
require_once MODELO_PATH . 'Ambiente' . DS . 'ModeloAmbiente.php';


class ControlAmbiente 
{
	
	private static $instancia;

  public static function singleton_Ambiente() {
    if (!isset(self::$instancia)) {
      $miclase = __CLASS__;
      self::$instancia = new $miclase;
    }
    return self::$instancia;
  }

    //FUNCION DE POLO
  public function tiempoRealAmbienteControl() {
        //require_once '..'.DS. MODELO_PATH . 'Ambiente' . DS . 'ModeloAmbiente.php';
        //print_r($_POST);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
      isset($_POST['parametro']) &&
      !empty($_POST['parametro'])) {
      $modificar = json_decode(stripslashes($_POST['parametro']));
    $modUs = ModeloAmbiente::tiempoRealAmbienteModel($modificar->id);
    return $modUs;
  }
}

//ELIMINAR AMBIENTE 
public function eliminarAmbienteController() {
  if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
    isset($_POST['idEliminar']) &&
    !empty($_POST['idEliminar'])
  ) {
   echo "<script>alert('se recibio el ID')</script>";
 $id = filter_input(INPUT_POST, 'idEliminar', FILTER_SANITIZE_NUMBER_INT);
 $result = ModeloAmbiente::eliminarAmbienteModel($id);

 if ($result) {

  $r = "ok";
} else {
  $r = "No";
}
return $r;
}else{
  echo "<script>alert('No se recibio el ID')</script>";
}
}

public function mostrarAmbienteEspecificoControl() {
     if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
      isset($_POST['detalleClases']) &&
      !empty($_POST['detalleClases'])) {
      $modificar = json_decode(stripslashes($_POST['detalleClases']));
    $id_elementoA = $modificar->id;
    $id_ambienteA = $modificar->id_ambiente;
    $modUs = ModeloAmbiente::mostrarAmbienteEspecificoModel($id_elementoA,$id_ambienteA);
    return $modUs;
    }else 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
      isset($_POST['detalleClasesU']) &&
      !empty($_POST['detalleClasesU'])) {
      $modificar = json_decode(stripslashes($_POST['detalleClasesU']));
      $id_elementoA = $modificar->id;
      $id_instructor = $modificar->id_instructor;
      $modUs = ModeloAmbiente::mostrarAmbienteEspecificoModelPorInstructor($id_elementoA,$id_instructor);
      return $modUs;
    }



}

#AMBIENTE ACTUAL
public function mostrarAmbienteActualControl() {
 if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
  isset($_POST['detalleClases']) &&
  !empty($_POST['detalleClases'])) {
  $modificar = json_decode(stripslashes($_POST['detalleClases']));
$id_ambienteA = $modificar->id_ambiente;
$modUs = ModeloAmbiente::mostrarAmbienteActualModel($id_ambienteA);
return $modUs;
}else{
  echo "ERROR!!!!";
}



}

    //metodo para registrar un nuevo Aprendiz
public function nuevoAmbiente() {
  if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
    isset($_POST['programa']) &&
    !empty($_POST['programa']) &&
    isset($_POST['nombre']) &&
    !empty($_POST['nombre']) 


        // $_FILES['imagen']['name']
  ) {

        	#echo "<script>alert('Entro al controlador')</script>";
            /* $nom_arch = $_FILES['imagen']['name']; //obtener el nombre del imagen
              $ext_img = explode(".", $nom_arch);
              $ext_img = end($ext_img);
              $nombre_img = strtolower($_POST['nombre_user'] .'_'. $_POST['apellido_user']) . '.' . $ext_img; */

              $valores = array('programaBD' => $_POST['programa'],
                'nombreBD' => $_POST['nombre']
              );
            //porceder a guardar mediante un metodo del modelo
              $guardar = ModeloAmbiente::guardarAmbiente($valores);
            /////////////////////
              if($guardar['guardar'] != FALSE){
               echo '<script>
               swal({
                 title: "Guardo",
                 text: "Guardado Correctamente",
                 icon: "success"
                 }).then((willDelete) => {
                  if (willDelete) {
                    window.location.replace("registrarAmbiente");
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

#MODIFICAR AMBIENTE
               public function modificarAmbienteID() {
                if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
                  isset($_POST['programa']) &&
                  !empty($_POST['programa']) &&
                  isset($_POST['nombre']) &&
                  !empty($_POST['nombre']) &&
                  isset($_POST['id_ambienteA']) &&
                  !empty($_POST['id_ambienteA']) 


        // $_FILES['imagen']['name']
                ) {

          #echo "<script>alert('Entro al controlador')</script>";
            /* $nom_arch = $_FILES['imagen']['name']; //obtener el nombre del imagen
              $ext_img = explode(".", $nom_arch);
              $ext_img = end($ext_img);
              $nombre_img = strtolower($_POST['nombre_user'] .'_'. $_POST['apellido_user']) . '.' . $ext_img; */

              $valores = array('programaBD' => $_POST['programa'],
                'nombreBD' => $_POST['nombre'],
                'id_ambiente' => $_POST['id_ambienteA']
              );
            //porceder a guardar mediante un metodo del modelo
              $guardar = ModeloAmbiente::ModificarAmbiente($valores);
            /////////////////////
              if($guardar['guardar'] != FALSE){
               echo '<script>
               swal({
                 title: "Modificado",
                 text: "Ambiente Modificado Correctamente",
                 icon: "success"
                 }).then((willDelete) => {
                  if (willDelete) {
                    window.location.replace("tablaAmbiente");
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
               public function mostrarLimitadoAmbiente(){
                $resultado = ModeloAmbiente::mostrarLimitadoAmbienteModel();
                return $resultado;
              }

              public function mostrarAmbienteControl() {
                $ambientes = ModeloAmbiente::mostrarAmbienteModel();
                return $ambientes;
              }

              public function mostrarAmbienteControlPorId($id) {
                $ambientes = ModeloAmbiente::mostrarAmbienteActualModel($id);
                return $ambientes;
              }

              public function mostrarAmbienteContadosControl() {
                $personas = ModeloAmbiente::mostrarAmbienteContadoModel();
                return $personas;
              }



              public function mostrarLimitadoElementoPorIDAJAXControl() {

                if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
                  isset($_POST['parametro1']) &&
                  !empty($_POST['parametro1'])) {
                  $modificar = json_decode(stripslashes($_POST['parametro1']));
                $modUs = ModeloAmbiente::mostrarLimitadoElementoPorIDAJAXMODEL($modificar->id,$modificar->fil);
                return $modUs;
              }
            }

            


          }

          ?>