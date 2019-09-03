<?php 
require_once MODELO_PATH . 'Elemento' . DS . 'ModeloElemento.php';
@session_start();
class ControlElemento {
	
	private static $instancia;

    public static function singleton_elemento() {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }

//FUNCION DE POLO
    public function tiempoRealElementoControl() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
                isset($_POST['parametro']) &&
                !empty($_POST['parametro'])) {
            $modificar = json_decode(stripslashes($_POST['parametro']));
            $modUs = ModeloElemento::buscarElementoModel($modificar->id);
            return $modUs;
        }
    }
    
    //para paginacion 
    public function mostrarElementoContadosControl() {
        $personas = ModeloElemento::mostrarElementoContadoModel();
        return $personas;
    }
    public function mostrarLimitadoElemento($valores,$cant){
        $resultado = ModeloElemento::mostrarLimitadoElementoModel($valores,$cant);
        return $resultado;
    }
    //FIN PAGINACION
    public function buscarElemento($valor) {
        $elementos = ModeloElemento::buscarElementoModel($valor);
        //print_r($elementos);
       return $elementos;
    }
  //ELEMENTOS POR ID
    public function elementosPorID($valor) {
        $elementos = ModeloElemento::elementosPorIDModel($valor);
        //print_r($elementos);
       return $elementos;
    }


public function modoficarPorAjax(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
        isset($_POST['detalleClases']) &&
        !empty($_POST['detalleClases'])){

        $modificar = json_decode(stripslashes($_POST['detalleClases']));
    $array = $modificar->arreglo;
            // var_dump($array);exit();
    //$id_autor = $_SESSION['id_persona'];
    // var_dump($array->serial);exit();
    $valores = array('descripcionBD' => $array->descripcion,
                            'id_elementoBD' => $array->id_elemento,
                            'id_persona' => $_SESSION['id_usuario'],
                            'id_ambienteBD' => $array->ambiente,
                            'usuarioBD' => $array->usuario,
                            'nombreElementoBD' => $array->nombre,
                            'placaBD' => $array->numero_placa,
                            'serialBD' => $array->serial,
                            'nombreAmbienteBD' => $array->ambienteNombre,
                            'apellidoBD' => $array->apellidoRes,
                            'correoBD' => $array->correoRes
             );

              //var_dump($valores);exit();
    $modificar = ModeloElemento::modificarElemento($valores);
            // echo $array[1];
    if($modificar['guardar'] == TRUE){
        return TRUE;
    }else{
        return FLASE;
      }
            ////////////////////
  } else {
    return FALSE;
   }
}

    public function modificarElementoID(){
         if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
                isset($_POST['descripcion']) &&
                !empty($_POST['descripcion']) &&
                isset($_POST['id_elemento']) &&
                !empty($_POST['id_elemento']) &&
                isset($_POST['id_ambiente']) &&
                !empty($_POST['id_ambiente'])&&
                isset($_POST['nombreElemento']) &&
                !empty($_POST['nombreElemento'])&&
                isset($_POST['usuario']) &&
                !empty($_POST['usuario'])&&
                isset($_POST['placa']) &&
                !empty($_POST['placa'])&&
                isset($_POST['serial']) &&
                !empty($_POST['serial'])&&
                isset($_POST['nombreAmbiente']) &&
                !empty($_POST['nombreAmbiente'])&&
                isset($_POST['apellido']) &&
                !empty($_POST['apellido'])&&
                isset($_POST['correo']) &&
                !empty($_POST['correo'])


         ) {
            $descripcion = $_POST['descripcion'];
            echo "<script>alert($descripcion
        );</script>";
            $valores = array('descripcionBD' => $_POST['descripcion'],
                            'id_elementoBD' => $_POST['id_elemento'],
                            'id_persona' => $_SESSION['id_usuario'],
                            'id_ambienteBD' => $_POST['id_ambiente'],
                            'usuarioBD' => $_POST['usuario'],
                            'nombreElementoBD' => $_POST['nombreElemento'],
                            'placaBD' => $_POST['placa'],
                            'serialBD' => $_POST['serial'],
                            'nombreAmbienteBD' => $_POST['nombreAmbiente'],
                            'apellidoBD' => $_POST['apellido'],
                            'correoBD' => $_POST['correo']
             );

            $modificar = ModeloElemento::modificarElemento($valores);
            //tambien guardar a la persona que modifica
             if($modificar['guardar'] == TRUE){
                #echo "<script>alert('se devolvio true')</script>";
           echo '<script>
                      swal({
                      title: "Guardo",
                      text: "Novedad registrada",
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
                      text: "Ha ocurrido un error al crear la novedad",
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
    //metodo para registrar un nuevo Elemento
    public function nuevoElemento() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
                isset($_POST['material']) &&
                !empty($_POST['material']) &&
                isset($_POST['numero_placa']) &&
                !empty($_POST['numero_placa']) &&
                isset($_POST['estado']) &&
                !empty($_POST['estado']) &&
                isset($_POST['ambiente']) &&
                !empty($_POST['ambiente']) &&
                isset($_POST['serial']) &&
                !empty($_POST['serial']) &&
                isset($_POST['Peso']) &&
                !empty($_POST['Peso']) &&
                isset($_POST['Ancho']) &&
                !empty($_POST['Ancho']) &&
                isset($_POST['Alto']) &&
                !empty($_POST['Alto']) &&
                isset($_POST['Largo']) &&
                !empty($_POST['Largo']) &&
                isset($_POST['Precio']) &&
                !empty($_POST['Precio']) &&
                isset($_POST['marca']) &&
                !empty($_POST['marca']) &&
                isset($_POST['fecha_adquisicion']) &&
                !empty($_POST['fecha_adquisicion']) &&
                isset($_POST['modulo']) &&
                !empty($_POST['modulo']) &&
                isset($_POST['descripcion']) &&
                !empty($_POST['descripcion']) &&
                isset($_POST['nombre']) &&
                !empty($_POST['nombre']) 

        ) {
        	
        	#echo "<script>alert('Entro al controlador')</script>";
        	#exit();

        	//obtener datos sin la ayuda del usuario
        	// id elemento es autoincremental
        	// sub categoria no se como tomarlo 
        	// fecha ingreso en sentencia SQL con GETDATE() 
        	// buscar el ambiente por medio del nombre 
        	// Buscar la persona por medio del el iD (variables de SESSION)
        	#$fecha_actual = date();
        	#echo "<script>alert('".$fecha_actual."')</script>";
        	#var_dump($fecha_actual);
        	#exit();
        	//crear array con valores a ingresar en la BD
            $valores = array('materialBD' => $_POST['material'],
                'num_placaBD' => $_POST['numero_placa'],
                'estadoBD' => $_POST['estado'],
                'ambienteBD' => $_POST['ambiente'],
                'serialBD' => $_POST['serial'],
                'PesoBD' => $_POST['Peso'],
                'AnchoBD' => $_POST['Ancho'],
                'AltoBD' => $_POST['Alto'],
                'LargoBD' => $_POST['Largo'],
                'PrecioBD' => $_POST['Precio'],
                'marcaBD' => $_POST['marca'],
                'fecha_adquisicionBD' => $_POST['fecha_adquisicion'],
                'moduloBD' => $_POST['modulo'],
                'descripcionBD' => $_POST['descripcion'],
                'nombreBD' => $_POST['nombre']
            );
            //porceder a guardar mediante un metodo del modelo
            $guardar = ModeloElemento::guardarElemento($valores);

            if($guardar['guardar'] == TRUE){
           echo '<script>
                      swal({
                         title: "Guardo",
                      text: "Guardado Correctamente",
                     icon: "success"
                        }).then((willDelete) => {
            if (willDelete) {
                window.location.replace("registrarObjeto");
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

    #FUNCION PARA TRAER LOS DATOS DE LA BASE DE DATOS

    public function mostrarElementoControl() {
        $elementos = ModeloElemento::mostrarElementoModel();
        return $elementos;
    }
     public function mostrarNombrematerial($id) {
                $material = ModeloElemento::mostrarNombrematerial($id);
                return $material;
              }

}
 ?>
  <script src="<?php echo PUBLIC_PATH; ?>js/sweet_alert.js"></script>