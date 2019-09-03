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
    //FUNCION MIA
public function mostrarLimitadoElementoPorIDAJAX() {
    echo "<script>alert('ENTRO AL CONTROLADOR');</script>";
    if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
        isset($_POST['parametro']) &&
        !empty($_POST['parametro'])) {
        $modificar = json_decode(stripslashes($_POST['parametro']));
    $modUs = ModeloElemento::mostrarLimitadoElementoPorIDAJAXMODEL($modificar->id);
    return $modUs;
}else{
    echo "<script>alert('VARIABLE NO RECIBIDA');</script>";        }
}

    //ELIMINAR ELEMENTO
public function eliminarElementoController() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
        isset($_POST['idEliminar']) &&
        !empty($_POST['idEliminar'])
    ) {
       echo "<script>alert('se recibio el ID')</script>";
   $id = filter_input(INPUT_POST, 'idEliminar', FILTER_SANITIZE_NUMBER_INT);
   $result = ModeloElemento::eliminarElementoModel($id);

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

public function desactivarElementoControl(){
     if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
        isset($_POST['detalleClases']) &&
        !empty($_POST['detalleClases'])){
        $modificar = json_decode(stripslashes($_POST['detalleClases']));
        $result = ModeloElemento::desactivarElementoModel($modificar->id_elemento);
     }
}

    //para paginacion
public function mostrarElementoContadosControl() {
    $personas = ModeloElemento::mostrarElementoContadoModel();
    return $personas;
}

public function mostrarAmbienteID($ID) {
    $personas = ModeloElemento::mostrarAmbienteIDModel($ID);
    return $personas;
}
public function mostrarLimitadoElemento($valores,$cant){
    $resultado = ModeloElemento::mostrarLimitadoElementoModel($valores,$cant);
    return $resultado;
}

public function mostrarLimitadoElementoPorID($valores,$cant,$id){
    $resultado = ModeloElemento::mostrarLimitadoElementoModelPorID($valores,$cant,$id);
    return $resultado;
}
    //FIN PAGINACION
public function buscarElemento($valor) {
    $elementos = ModeloElemento::buscarElementoModel($valor);
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
    $id_autor = $_SESSION['id_persona'];
    // var_dump($array->serial);exit();
    $valores = array('materialBD' => $array->tipo_elemento,
        'id_elementoBD' => $array->id_elemento,
        'num_placaBD' => $array->numero_placa,
        'ambienteBD' => $array->ambiente,
        'serialBD' => $array->serial,
        'descripcionBD' => $array->descripcion,
        'nombreBD' => $array->nombre,
        'autorBD' => $id_autor,
        'responsableBD' => $array->responsableElemento
    );

             // var_dump($valores);exit();
    $guardar = ModeloElemento::modificarElementoModel($valores);
            // echo $array[1];
    if($guardar['guardar'] == TRUE){
     echo '<script>
     swal({
       title: "Guardo",
       text: "Guardado Correctamente",
       icon: "success"
       }).then((willDelete) => {
        if (willDelete) {
            array_replace(array, array1)("registrarObjeto");
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


public function modificarElemento() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
        isset($_POST['material']) &&
        !empty($_POST['material']) &&
        isset($_POST['id_elemento']) &&
        !empty($_POST['id_elemento']) &&
        isset($_POST['numero_placa']) &&
        !empty($_POST['numero_placa']) &&
        isset($_POST['ambiente']) &&
        !empty($_POST['ambiente']) &&
        isset($_POST['serial']) &&
        !empty($_POST['serial']) &&
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
        $id_autor = $_SESSION['id_persona'];

    $valores = array('materialBD' => $_POST['material'],
        'id_elementoBD' => $_POST['id_elemento'],
        'num_placaBD' => $_POST['numero_placa'],
        'ambienteBD' => $_POST['ambiente'],
        'serialBD' => $_POST['serial'],
        'descripcionBD' => $_POST['descripcion'],
        'nombreBD' => $_POST['nombre'],
        'autorBD' => $id_autor,
        'responsableBD' => $_POST['responsable']
    );
            //porceder a guardar mediante un metodo del modelo
    $guardar = ModeloElemento::modificarElementoModel($valores);
    $ElementoModificado = $guardar['id'];
            // echo $guardar['id'];exit();
            //CONDICIONALES PARA SABER EL TIPO DE ELEMENTO//
            //MUEBLES//
    if ($_POST['material'] == 2 &&
        isset($_POST['Peso']) &&
        !empty($_POST['Peso']) &&
        isset($_POST['Ancho']) &&
        !empty($_POST['Ancho']) &&
        isset($_POST['Alto']) &&
        !empty($_POST['Alto']) &&
        isset($_POST['Largo']) &&
        !empty($_POST['Largo']) &&
        isset($_POST['Precio']) &&
        !empty($_POST['Precio'])
    ){
                //echo "<script>alert('Es un mueble')</script>";
        $valoresDetalle = array('pesoBD' => $_POST['Peso'],
            'anchoBD' => $_POST['Ancho'],
            'altoBD' => $_POST['Alto'],
            'largoBD' => $_POST['Largo'],
            'precioBD' => $_POST['Precio'],
            'id_elementoBD' => $guardar['id']
        );

            //procedemos a guardar el elemento tipo mueble en detalleElemento
    $guardarDetalleMueble = ModeloElemento::modificarDetalleElementoMueble($valoresDetalle);

}else{}

if ($_POST['material'] == 3 &&
    isset($_POST['Precio']) &&
    !empty($_POST['Precio'])
){
                //HERRAMIENTAS//
                #echo "<script>alert('Entro al controlador especifico')</script>";
    $valoresDetalle = array('precioBD' => $_POST['Precio'],
        'id_elementoBD' => $guardar['id']);
            // var_dump($valoresDetalle);exit();

$guardarDetalleHerramienta = ModeloElemento::modificarDetalleElementoHerramienta($valoresDetalle);


                // FIN HERRAMIENTAS//
}else{}

if ($_POST['material'] == 4 &&
    isset($_POST['Precio']) &&
    !empty($_POST['Precio'])
){
                # code...
                //EQUIPOS DE LABORATORIO//
                #echo "<script>alert('Entro al controlador especifico')</script>";
    $valoresDetalle = array('precioBD' => $_POST['Precio'],
        'marcaBD' => $_POST['marca'],
        'id_elementoBD' => $guardar['id']);

$guardarDetalleLaboratorio = ModeloElemento::modificarDetalleElementoLaboratorio($valoresDetalle);

                //FIN EQUIPOS DE LABORATORIO//

                //TIC
}else{}

if ($_POST['material'] == 5) {
    if ($_POST['almacenamiento'] == "") {
        $valor_almacenamiento = "N/A";
    }else{
        $valor_almacenamiento = $_POST['almacenamiento'];
    }
    if ($_POST['ram'] == "") {
        $valor_ram = "N/A";
    }else{
        $valor_ram = $_POST['ram'];
    }
    if ($_POST['procesador'] == "") {
        $valor_procesador = "N/A";
    }else{
        $valor_procesador = $_POST['procesador'];
    }
               // echo "<script>alert('Es un TIC')</script>";
    $valoresDetalleTIC = array('precioBD' => $_POST['Precio'],
        'id_elementoBD' => $guardar['id'],
        'ramBD' => $valor_ram,
        'procesadorBD' => $valor_procesador,
        'almacenamientoBD' => $valor_almacenamiento
    );
            //procedemos a guardar el elemento tipo mueble en detalleElemento
    $guardarDetalleTIC =  ModeloElemento::modificarDetalleElementoTIC($valoresDetalleTIC);
                //FIN TIC
}



if($guardar['guardar'] == TRUE){
 echo '<script>
 swal({
   title: "Guardo",
   text: "Guardado Correctamente",
   icon: "success"
   }).then((willDelete) => {
    if (willDelete) {
        array_replace(array, array1)("registrarObjeto");
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



    //metodo para registrar un nuevo Elemento
public function nuevoElemento() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
        isset($_POST['material']) &&
        !empty($_POST['material']) &&
        isset($_POST['numero_placa']) &&
        !empty($_POST['numero_placa']) &&
        isset($_POST['ambiente']) &&
        !empty($_POST['ambiente']) &&
        isset($_POST['serial']) &&
        !empty($_POST['serial']) &&
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
        $id_autor = $_SESSION['id_persona'];

    $valores = array('materialBD' => $_POST['material'],
        'num_placaBD' => $_POST['numero_placa'],
        'ambienteBD' => $_POST['ambiente'],
        'serialBD' => $_POST['serial'],
        'descripcionBD' => $_POST['descripcion'],
        'nombreBD' => $_POST['nombre'],
        'autorBD' => $id_autor,
        'responsableBD' => $_POST['responsable']
    );
            //porceder a guardar mediante un metodo del modelo
    $guardar = ModeloElemento::guardarElemento($valores);
            //CONDICIONALES PARA SABER EL TIPO DE ELEMENTO//
            //MUEBLES//
    if ($_POST['material'] == 2 &&
        isset($_POST['Peso']) &&
        !empty($_POST['Peso']) &&
        isset($_POST['Ancho']) &&
        !empty($_POST['Ancho']) &&
        isset($_POST['Alto']) &&
        !empty($_POST['Alto']) &&
        isset($_POST['Largo']) &&
        !empty($_POST['Largo']) &&
        isset($_POST['Precio']) &&
        !empty($_POST['Precio'])
    ){
                //echo "<script>alert('Es un mueble')</script>";
        $valoresDetalle = array('pesoBD' => $_POST['Peso'],
            'anchoBD' => $_POST['Ancho'],
            'altoBD' => $_POST['Alto'],
            'largoBD' => $_POST['Largo'],
            'precioBD' => $_POST['Precio'],
            'marcaBD' => $_POST['marca'],
            'id_elementoBD' => $guardar['id']
        );

            //procedemos a guardar el elemento tipo mueble en detalleElemento
    $guardarDetalleMueble =  ModeloElemento::guardarDetalleElementoMueble($valoresDetalle);

}else{}

if ($_POST['material'] == 3 &&
    isset($_POST['Precio']) &&
    !empty($_POST['Precio'])
){
                //HERRAMIENTAS//
                #echo "<script>alert('Entro al controlador especifico')</script>";
    $valoresDetalle = array('precioBD' => $_POST['Precio'],
        'marcaBD' => $_POST['marca'],
        'id_elementoBD' => $guardar['id']);

$guardarDetalleHerramienta = ModeloElemento::guardarDetalleElementoHerramienta($valoresDetalle);


                // FIN HERRAMIENTAS//
}else{}

if ($_POST['material'] == 4 &&
    isset($_POST['Precio']) &&
    !empty($_POST['Precio'])
){
                # code...
                //EQUIPOS DE LABORATORIO//
                #echo "<script>alert('Entro al controlador especifico')</script>";
    $valoresDetalle = array('precioBD' => $_POST['Precio'],
        'marcaBD' => $_POST['marca'],
        'id_elementoBD' => $guardar['id']);

$guardarDetalleLaboratorio = ModeloElemento::guardarDetalleElementoLaboratorio($valoresDetalle);

                //FIN EQUIPOS DE LABORATORIO//

                //TIC
}else{}

if ($_POST['material'] == 5) {
    if ($_POST['almacenamiento'] == "") {
        $valor_almacenamiento = "N/A";
    }else{
        $valor_almacenamiento = $_POST['almacenamiento'];
    }
    if ($_POST['ram'] == "") {
        $valor_ram = "N/A";
    }else{
        $valor_ram = $_POST['ram'];
    }
    if ($_POST['procesador'] == "") {
        $valor_procesador = "N/A";
    }else{
        $valor_procesador = $_POST['procesador'];
    }
               // echo "<script>alert('Es un TIC')</script>";
    $valoresDetalleTIC = array('precioBD' => $_POST['Precio'],
        'id_elementoBD' => $guardar['id'],
        'ramBD' => $valor_ram,
        'procesadorBD' => $valor_procesador,
        'almacenamientoBD' => $valor_almacenamiento
    );
            //procedemos a guardar el elemento tipo mueble en detalleElemento
    $guardarDetalleTIC =  ModeloElemento::guardarDetalleElementoTIC($valoresDetalleTIC);
                //FIN TIC
}



if($guardar['guardar'] == TRUE){
 echo '<script>
 swal({
   title: "Guardo",
   text: "Guardado Correctamente",
   icon: "success"
   }).then((willDelete) => {
    if (willDelete) {
        array_replace(array, array1)("registrarObjeto");
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
