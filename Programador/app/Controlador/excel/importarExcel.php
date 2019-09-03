<?php 
require_once MODELO_PATH . 'excel' . DS . 'ModelExcel.php';
require_once CONTROL_PATH . 'hash.php';
class ImportarExcel {

    private static $instancia;

    public static function singleton_importarExcel() {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }

    public static function importar() {
        //echo "<script>alert('Entro al controlador')</script>";
        set_time_limit(600);
        if (isset($_POST['action']) &&
         isset($_POST['mod']) && 
         isset($_POST['acc']) && 
         isset($_POST['ente']) &&
          $_FILES['excel']['name']) {
        	//echo "<script>alert('se recibieron los datos')</script>";
        	$tipo_de_ente = $_POST['ente'];
            $archivo = $_FILES['excel']['name'];
            $tipo = $_FILES['excel']['type'];

            $ext = explode(".", $archivo);
            $ext = end($ext);

            $poss = strpos($archivo, '.');
            $nombre_final = substr($archivo, 0, $poss);

            $nombre_del_archivo = $nombre_final . $tipo_de_ente . date("his") . '.' . $ext;

           	switch ($tipo_de_ente) {
                case "Ambiente":
                    $destino = ROOT . DS . 'app' . DS . 'documentos' . DS . 'report' . DS . 'Ambiente' . DS . $nombre_del_archivo;
                    break;
                case "Aprendiz":
                    $destino = ROOT . DS . 'app' . DS . 'documentos' . DS . 'report' . DS . 'Aprendiz' . DS . $nombre_del_archivo;
                    break;
                case "Instructor":
                    $destino = ROOT . DS . 'app' . DS . 'documentos' . DS . 'report' . DS . 'Instructor' . DS . $nombre_del_archivo;
                    break;
                case "Coordinador":
                    $destino = ROOT . DS . 'app' . DS . 'documentos' . DS . 'report' . DS . 'Coordinador' . DS . $nombre_del_archivo;
                    break;
                case "Programa":
                    $destino = ROOT . DS . 'app' . DS . 'documentos' . DS . 'report' . DS . 'Programa' . DS . $nombre_del_archivo;
                    break;
                case "Tic":
                    $destino = ROOT . DS . 'app' . DS . 'documentos' . DS . 'report' . DS . 'Tic' . DS . $nombre_del_archivo;
                    break;
                case "Herramientas":
                    $destino = ROOT . DS . 'app' . DS . 'documentos' . DS . 'report' . DS . 'Herramienta' . DS . $nombre_del_archivo;
                    break;
                case "laboratorio":
                    $destino = ROOT . DS . 'app' . DS . 'documentos' . DS . 'report' . DS . 'laboratorio' . DS . $nombre_del_archivo;
                    break;
                case "Muebles":
                    $destino = ROOT . DS . 'app' . DS . 'documentos' . DS . 'report' . DS . 'Mueble' . DS . $nombre_del_archivo;
                    break;
                default:
                            echo '<script>
            swal({
             title: "Oops!",
              text: "No se recibieron algunos datos",
              icon: "error",
              dangerMode:true
            });
            </script>';
                    break;
            }

            if (is_uploaded_file($_FILES['excel']['tmp_name'])) {
                $move = move_uploaded_file($_FILES['excel']['tmp_name'], $destino);
                if ($move) {
                    if (file_exists($destino)) {
                        
                    	require_once(ROOT . DS . 'Public' . DS . 'lib' . DS . 'PHPExcel' . DS . 'PHPExcel.php');
                        require_once(ROOT . DS . 'Public' . DS . 'lib' . DS . 'PHPExcel' . DS . 'PHPExcel' . DS . 'Reader' . DS . 'Excel2007.php');

                        // Cargando la hoja de cálculo
                        $objReader = new PHPExcel_Reader_Excel2007();
                        $objPHPExcel = $objReader->load($destino);
                        // Asignar hoja de excel activa
                        $objPHPExcel->setActiveSheetIndex(0);
                        $worksheet = $objPHPExcel->getActiveSheet(0);
                        // Llenamos el arreglo con los datos  del archivo xlsx
                        //Obtener la letra de la ultima columna y el numero de ROWs  que tiene el excel
                        $columnas = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
                        //$filas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
                        $filas = $worksheet->getHighestRow();
                        
                        switch ($tipo_de_ente) {
                        	case "Ambiente":
                        		$cant = 0; //contador
                        		$tipoArch = $worksheet->getCell('AA1')->getValue();
                        		if ($tipoArch != 'ambiente') {
                                echo '<script>
                                    swal({
                                     title: "Oops!",
                                      text: "Verifique que el formato sea correcto",
                                      icon: "error",
                                      dangerMode:true
                                    });
                                    </script>';
                                    exit();
                                }
                        		for ($i = 2; $i <= $filas; $i++) {
                                    $nombre = $worksheet->getCell('A' . $i)->getValue();
                                    $programa = $objPHPExcel->getActiveSheet()->getCell('Z' . $i)->getOldCalculatedValue();
                                    if (!empty($nombre) && !empty($programa)) {
                                        //almacenando datos en un array
                                        $valores = array('nombre' => $nombre, 'programa' => $programa);

                                        //var_dump($valores);

                                        $validacion = ImportarExcel::verificarExcelAmbiente($nombre);

                                        if ($validacion > 0) {
                                        	//var_dump($validacion);
                                            //echo '<script>alert("Este ambiente ya existe' . $valores['nombre'] . '");</script>';
                                        } else {
                                            ImportarExcel::guardarExcelAmbiente($valores);
                                            $cant++;
                                        }
                                    }
                                }
                                echo '<script>
                                          swal({
                                             title: "Guardo",
                                          text: "Se cargaron exitosamente '.$cant.' registros",
                                         icon: "success"
                                            }).then((willDelete) => {
                                if (willDelete) {
                                    
                                }
                                }); 
                                    </script>';
                                break;

                            case 'Aprendiz':
                            		$cant = 0; //contador
                        		$tipoArch = $worksheet->getCell('AA1')->getValue();
                        		if ($tipoArch != 'aprendiz') {
                                echo '<script>
                                    swal({
                                     title: "Oops!",
                                      text: "Verifique que el formato sea correcto",
                                      icon: "error",
                                      dangerMode:true
                                    });
                                    </script>';
                                    exit();
                                }
                        		for ($i = 2; $i <= $filas; $i++) {
                                   $tipoDc = $worksheet->getCell('A' . $i)->getValue();
                                    $numero_docu = $worksheet->getCell('B' . $i)->getValue();
                                    $nombre = $worksheet->getCell('C' . $i)->getValue();
                                    $apellido = $worksheet->getCell('D' . $i)->getValue();
                                    $correo = $worksheet->getCell('E' . $i)->getValue();
                                    $telefono = $worksheet->getCell('F' . $i)->getValue();
                                    if (!empty($tipoDc) && !empty($numero_docu) && !empty($nombre) && !empty($apellido) && !empty($correo) && !empty($telefono)) {
                                        //almacenando datos en un array
                                        $valores = array('tipoDocumento' => $tipoDc, 'numDocumento' => $numero_docu, 'nombre' => $nombre, 'apellido' => $apellido, 'correo' => $correo, 'telefono' => $telefono);

                                        $validacion = ImportarExcel::verificarExcelAprendiz($numero_docu);

                                        if ($validacion > 0) {
                                        	//var_dump($validacion);
                                            //echo '<script>alert("Este Aprendiz ya existe' . $valores['nombre'] . '");</script>';
                                        } else {
                                            ImportarExcel::guardarExcelAprendiz($valores);
                                            $cant++;
                                        }
                                    }else{
                                    	echo "<script>alert('!empty(nombre) && !empty(programa Fallo')</script>";
                                    }
                                }
                                echo '<script>
                                          swal({
                                             title: "Guardo",
                                          text: "Se cargaron exitosamente '.$cant.' registros",
                                         icon: "success"
                                            }).then((willDelete) => {
                                if (willDelete) {
                                    
                                }
                                }); 
                                    </script>';
                            	break;
                            case 'Instructor':
                            		$cant = 0; //contador
                        		$tipoArch = $worksheet->getCell('AA1')->getValue();
                        		if ($tipoArch != 'instructor') {
                                echo '<script>
                                    swal({
                                     title: "Oops!",
                                      text: "Verifique que el formato sea correcto",
                                      icon: "error",
                                      dangerMode:true
                                    });
                                    </script>';
                                    exit();
                                }
                        		for ($i = 2; $i <= $filas; $i++) {
                                    $tipoDc = $worksheet->getCell('A' . $i)->getValue();
                                    $numero_docu = $worksheet->getCell('B' . $i)->getValue();
                                    $nombre = $worksheet->getCell('C' . $i)->getValue();
                                    $apellido = $worksheet->getCell('D' . $i)->getValue();
                                    $correo = $worksheet->getCell('E' . $i)->getValue();
                                    $telefono = $worksheet->getCell('F' . $i)->getValue();
                                    if (!empty($tipoDc) && !empty($numero_docu) && !empty($nombre) && !empty($apellido) && !empty($correo) && !empty($telefono)) {
                                        //almacenando datos en un array
                                        $valores = array('tipoDocumento' => $tipoDc, 'numDocumento' => $numero_docu, 'nombre' => $nombre, 'apellido' => $apellido, 'correo' => $correo, 'telefono' => $telefono);

                                        $validacion = ImportarExcel::verificarExcelInstructor($numero_docu);

                                        if ($validacion > 0) {
                                        	//var_dump($validacion);
                                            //echo '<script>alert("Este Aprendiz ya existe' . $valores['nombre'] . '");</script>';
                                        } else {
                                            $guardado = ImportarExcel::guardarExcelInstructor($valores);
                                            $idInstrucGuardado = $guardado['id'];
                                            //Guardar usuario de cada instructor
                                            $clavecifrada = Hash::hashpass($numero_docu);
                                            $usuario = $numero_docu;
                                            $arrayUser = array('usuario' => $usuario,
                                                                'nombre' => $nombre,
                                                                'apellido' => $apellido, 
                                                                'correo' => $correo, 
                                                                'pass'=>$clavecifrada,
                                                                'passNoCifrado'=>$numero_docu,
                                                                'id_instructor'=>$idInstrucGuardado);
                                           // var_dump($arrayUser);
                                            ImportarExcel::guardarExcelUserInstructor($arrayUser);
                                            $cant++;
                                        }
                                    }else{
                                    	echo "<script>alert('!empty(nombre) && !empty(programa Fallo')</script>";
                                    }
                                }
                                echo '<script>
                                          swal({
                                             title: "Guardo",
                                          text: "Se cargaron exitosamente '.$cant.' registros",
                                         icon: "success"
                                            }).then((willDelete) => {
                                if (willDelete) {
                                    
                                }
                                }); 
                                    </script>';
                            	break;
                            case 'Coordinador':
                                    $cant = 0; //contador
                                $tipoArch = $worksheet->getCell('AA1')->getValue();
                                if ($tipoArch != 'Coordinador') {
                                echo '<script>
                                    swal({
                                     title: "Oops!",
                                      text: "Verifique que el formato sea correcto",
                                      icon: "error",
                                      dangerMode:true
                                    });
                                    </script>';
                                    exit();
                                }
                                for ($i = 2; $i <= $filas; $i++) {
                                    $tipoDc = $worksheet->getCell('A' . $i)->getValue();
                                    $numero_docu = $worksheet->getCell('B' . $i)->getValue();
                                    $nombre = $worksheet->getCell('C' . $i)->getValue();
                                    $apellido = $worksheet->getCell('D' . $i)->getValue();
                                    $correo = $worksheet->getCell('E' . $i)->getValue();
                                    $telefono = $worksheet->getCell('F' . $i)->getValue();
                                    if (!empty($tipoDc) && !empty($numero_docu) && !empty($nombre) && !empty($apellido) && !empty($correo) && !empty($telefono)) {
                                        //almacenando datos en un array
                                        $valores = array('tipoDocumento' => $tipoDc, 'numDocumento' => $numero_docu, 'nombre' => $nombre, 'apellido' => $apellido, 'correo' => $correo, 'telefono' => $telefono);

                                        $validacion = ImportarExcel::verificarExcelCoordinador($numero_docu);

                                        if ($validacion > 0) {
                                            //var_dump($validacion);
                                            //echo '<script>alert("Este Aprendiz ya existe' . $valores['nombre'] . '");</script>';
                                        } else {
                                            $guardado = ImportarExcel::guardarExcelCoordinador($valores);
                                            $idCoordiGuardado = $guardado['id'];
                                            //Guardar usuario de cada Coordinador
                                            $clavecifrada = Hash::hashpass($numero_docu);
                                            $usuario = $numero_docu;
                                            $arrayUser = array('usuario' => $usuario,
                                                                'nombre' => $nombre,
                                                                'apellido' => $apellido, 
                                                                'correo' => $correo, 
                                                                'pass'=>$clavecifrada,
                                                                'passNoCifrado'=>$numero_docu,
                                                                'id_Coordinador'=>$idCoordiGuardado);
                                           // var_dump($arrayUser);
                                            ImportarExcel::guardarExcelUserCoordinador($arrayUser);
                                            $cant++;
                                        }
                                    }else{
                                        echo "<script>alert('!empty(nombre) && !empty(programa Fallo')</script>";
                                    }
                                }
                                echo '<script>
                                          swal({
                                             title: "Guardo",
                                          text: "Se cargaron exitosamente '.$cant.' registros",
                                         icon: "success"
                                            }).then((willDelete) => {
                                if (willDelete) {
                                    
                                }
                                }); 
                                    </script>';
                                break;
                            case 'Programa':
                                    $cant = 0; //contador
                                $tipoArch = $worksheet->getCell('AA1')->getValue();
                                if ($tipoArch != 'Programa') {
                                echo '<script>
                                    swal({
                                     title: "Oops!",
                                      text: "Verifique que el formato sea correcto",
                                      icon: "error",
                                      dangerMode:true
                                    });
                                    </script>';
                                    exit();
                                }
                                for ($i = 2; $i <= $filas; $i++) {
                                    $nombre = $worksheet->getCell('A' . $i)->getValue();
                                    $Coordinacion = $objPHPExcel->getActiveSheet()->getCell('Z' . $i)->getOldCalculatedValue();
                                    if (!empty($nombre) && !empty($Coordinacion)) {
                                        //almacenando datos en un array
                                        $valores = array('nombre' => $nombre, 'Coordinacion' => $Coordinacion);

                                        //var_dump($valores);

                                        $validacion = ImportarExcel::verificarExcelPrograma($nombre);

                                        if ($validacion > 0) {
                                            //var_dump($validacion);
                                            //echo '<script>alert("Este ambiente ya existe' . $valores['nombre'] . '");</script>';
                                        } else {
                                            ImportarExcel::guardarExcelPrograma($valores);
                                            $cant++;
                                        }
                                    }
                                }
                                echo '<script>
                                          swal({
                                             title: "Guardo",
                                          text: "Se cargaron exitosamente '.$cant.' registros",
                                         icon: "success"
                                            }).then((willDelete) => {
                                if (willDelete) {
                                    
                                }
                                }); 
                                    </script>';
                                break;
                            case 'Herramientas':
                                   $cant = 0; //contador
                                $tipoArch = $worksheet->getCell('AA1')->getValue();
                                if ($tipoArch != 'Herramienta') {
                                echo '<script>
                                    swal({
                                     title: "Oops!",
                                      text: "Verifique que el formato sea correcto",
                                      icon: "error",
                                      dangerMode:true
                                    });
                                    </script>';
                                    exit();
                                }
                                for ($i = 2; $i <= $filas; $i++) {
                                    $Responsable = $objPHPExcel->getActiveSheet()->getCell('Z' . $i)->getOldCalculatedValue();
                                    $nombre = $worksheet->getCell('B' . $i)->getValue();
                                    $Descripcion = $worksheet->getCell('C' . $i)->getValue();
                                    $Placa = $worksheet->getCell('D' . $i)->getValue();
                                    $Ambiente = $objPHPExcel->getActiveSheet()->getCell('Y' . $i)->getOldCalculatedValue();
                                    $Serial = $worksheet->getCell('F' . $i)->getValue();
                                    $Precio = $worksheet->getCell('G' . $i)->getValue();
                                    
                                    
                                    if (!empty($Responsable) && !empty($nombre) && !empty($Descripcion) && !empty($Placa) && !empty($Ambiente) && !empty($Precio)) {
                                        $material = "3";

                                        if (empty($Serial)) {
                                           $newSerial = "N/A";
                                        }else{
                                            $newSerial = $Serial;
                                        }
                                        //almacenando datos en un array
                                        $valores = array('Responsable' => $Responsable, 'nombre' => $nombre, 'Descripcion' => $Descripcion, 'Placa' => $Placa, 'Ambiente' => $Ambiente, 'Serial' => $newSerial, 'material' => $material);

                                        //var_dump($valores);

                                        $validacion = ImportarExcel::verificarExcelElemento($Placa);

                                        if ($validacion > 0) {
                                            //var_dump($validacion);
                                            //echo '<script>alert("Este ambiente ya existe' . $valores['nombre'] . '");</script>';
                                        } else {
                                            $guardar = ImportarExcel::guardarExcelElemento($valores);
                                            $id_elemento = $guardar['id'];
                                            $valoresDetalle = array('Precio' => $Precio, 'id_elemento' => $id_elemento);
                                            ImportarExcel::guardarExcelDetalleElementoHerramienta($valoresDetalle);
                                            $cant++;
                                        }
                                    }
                                }
                                echo '<script>
                                          swal({
                                             title: "Guardo",
                                          text: "Se cargaron exitosamente '.$cant.' registros",
                                         icon: "success"
                                            }).then((willDelete) => {
                                if (willDelete) {
                                    
                                }
                                }); 
                                    </script>';
                                break;
                            case 'Tic':
                                   $cant = 0; //contador
                                $tipoArch = $worksheet->getCell('AA1')->getValue();
                                if ($tipoArch != 'Tic') {
                                echo '<script>
                                    swal({
                                     title: "Oops!",
                                      text: "Verifique que el formato sea correcto",
                                      icon: "error",
                                      dangerMode:true
                                    });
                                    </script>';
                                    exit();
                                }
                                for ($i = 2; $i <= $filas; $i++) {
                                    $Responsable = $objPHPExcel->getActiveSheet()->getCell('Z' . $i)->getOldCalculatedValue();
                                    $nombre = $worksheet->getCell('B' . $i)->getValue();
                                    $Descripcion = $worksheet->getCell('C' . $i)->getValue();
                                    $Placa = $worksheet->getCell('D' . $i)->getValue();
                                    $Ambiente = $objPHPExcel->getActiveSheet()->getCell('Y' . $i)->getOldCalculatedValue();
                                    $Serial = $worksheet->getCell('F' . $i)->getValue();
                                    $Precio = $worksheet->getCell('G' . $i)->getValue();
                                    $Ram = $worksheet->getCell('H' . $i)->getValue();
                                    $Procesador = $worksheet->getCell('I' . $i)->getValue();
                                    $Almacenamiento = $worksheet->getCell('J' . $i)->getValue();
                                    
                                    if (!empty($Responsable) && !empty($nombre) && !empty($Descripcion) && !empty($Placa) && !empty($Ambiente) && !empty($Precio)) {
                                        $material = "5";
                                        if (empty($Ram)) {
                                           $newRam = "N/A";
                                        }else{
                                            $newRam = $Ram;
                                        }
                                        if (empty($Almacenamiento)) {
                                           $newAlmacenamiento = "N/A";
                                        }else{
                                            $newAlmacenamiento = $Almacenamiento;
                                        }
                                        if (empty($Procesador)) {
                                           $newProcesador = "N/A";
                                        }else{
                                            $newProcesador = $Procesador;
                                        }
                                        if (empty($Serial)) {
                                           $newSerial = "N/A";
                                        }else{
                                            $newSerial = $Serial;
                                        }
                                        //almacenando datos en un array
                                        $valores = array('Responsable' => $Responsable, 'nombre' => $nombre, 'Descripcion' => $Descripcion, 'Placa' => $Placa, 'Ambiente' => $Ambiente, 'Serial' => $newSerial, 'material' => $material);

                                        //var_dump($valores);

                                        $validacion = ImportarExcel::verificarExcelElemento($Placa);

                                        if ($validacion > 0) {
                                            //var_dump($validacion);
                                            //echo '<script>alert("Este ambiente ya existe' . $valores['nombre'] . '");</script>';
                                        } else {
                                            $guardar = ImportarExcel::guardarExcelElemento($valores);
                                            $id_elemento = $guardar['id'];
                                            $valoresDetalle = array('Precio' => $Precio, 'Ram' => $newRam, 'Procesador' => $newProcesador, 'Almacenamiento' => $newAlmacenamiento, 'id_elemento' => $id_elemento);
                                            ImportarExcel::guardarExcelDetalleElementoTic($valoresDetalle);
                                            $cant++;
                                        }
                                    }
                                }
                                echo '<script>
                                          swal({
                                             title: "Guardo",
                                          text: "Se cargaron exitosamente '.$cant.' registros",
                                         icon: "success"
                                            }).then((willDelete) => {
                                if (willDelete) {
                                    
                                }
                                }); 
                                    </script>';
                                break;
                            case 'laboratorio':
                                   $cant = 0; //contador
                                $tipoArch = $worksheet->getCell('AA1')->getValue();
                                if ($tipoArch != 'laboratorio') {
                                echo '<script>
                                    swal({
                                     title: "Oops!",
                                      text: "Verifique que el formato sea correcto",
                                      icon: "error",
                                      dangerMode:true
                                    });
                                    </script>';
                                    exit();
                                }
                                for ($i = 2; $i <= $filas; $i++) {
                                    $Responsable = $objPHPExcel->getActiveSheet()->getCell('Z' . $i)->getOldCalculatedValue();
                                    $nombre = $worksheet->getCell('B' . $i)->getValue();
                                    $Descripcion = $worksheet->getCell('C' . $i)->getValue();
                                    $Placa = $worksheet->getCell('D' . $i)->getValue();
                                    $Ambiente = $objPHPExcel->getActiveSheet()->getCell('Y' . $i)->getOldCalculatedValue();
                                    $Serial = $worksheet->getCell('F' . $i)->getValue();
                                    $Precio = $worksheet->getCell('G' . $i)->getValue();
                                    
                                    
                                    if (!empty($Responsable) && !empty($nombre) && !empty($Descripcion) && !empty($Placa) && !empty($Ambiente) && !empty($Precio)) {
                                        $material = "3";

                                        if (empty($Serial)) {
                                           $newSerial = "N/A";
                                        }else{
                                            $newSerial = $Serial;
                                        }
                                        //almacenando datos en un array
                                        $valores = array('Responsable' => $Responsable, 'nombre' => $nombre, 'Descripcion' => $Descripcion, 'Placa' => $Placa, 'Ambiente' => $Ambiente, 'Serial' => $newSerial, 'material' => $material);

                                        //var_dump($valores);

                                        $validacion = ImportarExcel::verificarExcelElemento($Placa);

                                        if ($validacion > 0) {
                                            //var_dump($validacion);
                                            //echo '<script>alert("Este ambiente ya existe' . $valores['nombre'] . '");</script>';
                                        } else {
                                            $guardar = ImportarExcel::guardarExcelElemento($valores);
                                            $id_elemento = $guardar['id'];
                                            $valoresDetalle = array('Precio' => $Precio, 'id_elemento' => $id_elemento);
                                            ImportarExcel::guardarExcelDetalleElementoLaboratorio($valoresDetalle);
                                            $cant++;
                                        }
                                    }
                                }
                                echo '<script>
                                          swal({
                                             title: "Guardo",
                                          text: "Se cargaron exitosamente '.$cant.' registros",
                                         icon: "success"
                                            }).then((willDelete) => {
                                if (willDelete) {
                                    
                                }
                                }); 
                                    </script>';
                                break;
                            case 'Muebles':
                                   $cant = 0; //contador
                                $tipoArch = $worksheet->getCell('AA1')->getValue();
                                if ($tipoArch != 'Muebles') {
                                echo '<script>
                                    swal({
                                     title: "Oops!",
                                      text: "Verifique que el formato sea correcto",
                                      icon: "error",
                                      dangerMode:true
                                    });
                                    </script>';
                                    exit();
                                }
                                for ($i = 2; $i <= $filas; $i++) {
                                    $Responsable = $objPHPExcel->getActiveSheet()->getCell('Z' . $i)->getOldCalculatedValue();
                                    $nombre = $worksheet->getCell('B' . $i)->getValue();
                                    $Descripcion = $worksheet->getCell('C' . $i)->getValue();
                                    $Placa = $worksheet->getCell('D' . $i)->getValue();
                                    $Ambiente = $objPHPExcel->getActiveSheet()->getCell('Y' . $i)->getOldCalculatedValue();
                                    $Serial = $worksheet->getCell('F' . $i)->getValue();
                                    $Precio = $worksheet->getCell('G' . $i)->getValue();
                                    $Peso = $worksheet->getCell('H' . $i)->getValue();
                                    $Ancho = $worksheet->getCell('I' . $i)->getValue();
                                    $Alto = $worksheet->getCell('J' . $i)->getValue();
                                    $Largo = $worksheet->getCell('K' . $i)->getValue();
                                    
                                    if (!empty($Responsable) && !empty($nombre) && !empty($Descripcion) && !empty($Placa) && !empty($Ambiente) && !empty($Precio)) {
                                        $material = "2";
                                        if (empty($Peso)) {
                                           $newPeso = "N/A";
                                        }else{
                                            $newPeso = $Peso;
                                        }
                                        if (empty($Ancho)) {
                                           $newAncho = "N/A";
                                        }else{
                                            $newAncho = $Ancho;
                                        }
                                        if (empty($Alto)) {
                                           $newAlto = "N/A";
                                        }else{
                                            $newAlto = $Alto;
                                        }
                                        if (empty($Largo)) {
                                           $newLargo = "N/A";
                                        }else{
                                            $newLargo = $Largo;
                                        }
                                        if (empty($Serial)) {
                                           $newSerial = "N/A";
                                        }else{
                                            $newSerial = $Serial;
                                        }
                                        //almacenando datos en un array
                                        $valores = array('Responsable' => $Responsable, 'nombre' => $nombre, 'Descripcion' => $Descripcion, 'Placa' => $Placa, 'Ambiente' => $Ambiente, 'Serial' => $newSerial, 'material' => $material);

                                        //var_dump($valores);

                                        $validacion = ImportarExcel::verificarExcelElemento($Placa);

                                        if ($validacion > 0) {
                                            //var_dump($validacion);
                                            //echo '<script>alert("Este ambiente ya existe' . $valores['nombre'] . '");</script>';
                                        } else {
                                            $guardar = ImportarExcel::guardarExcelElemento($valores);
                                            $id_elemento = $guardar['id'];
                                            $valoresDetalle = array('Precio' => $Precio, 'Peso' => $newPeso, 'Ancho' => $newAncho, 'Alto' => $newAlto, 'Largo' => $newLargo, 'id_elemento' => $id_elemento);
                                            ImportarExcel::guardarExcelDetalleElementoMueble($valoresDetalle);
                                            $cant++;
                                        }
                                    }
                                }
                                echo '<script>
                                          swal({
                                             title: "Guardo",
                                          text: "Se cargaron exitosamente '.$cant.' registros",
                                         icon: "success"
                                            }).then((willDelete) => {
                                if (willDelete) {
                                    
                                }
                                }); 
                                    </script>';
                                break;
                        }
                    }else{
                    	echo "<script>alert('file_exists Fallo')</script>";
                    }
                }else{
                	echo "<script>alert('move fallo')</script>";
                }
        	}else{
        		 echo "<script>alert('is_uploaded_file Fallo')</script>";
        	}
        }
	}
	// AMBIENTE
	private function verificarExcelAmbiente($arreglo) {
        $a = ModelExcel::verificarExcelAmbienteModel($arreglo);
        return $a;
    }

    private function guardarExcelAmbiente($arreglo) {
        $a = ModelExcel::guardarExcelAmbienteModel($arreglo);
    }

    // APRENDIZ
    private function verificarExcelAprendiz($arreglo) {
        $a = ModelExcel::verificarExcelAprendizModel($arreglo);
        return $a;
    }
    private function guardarExcelAprendiz($arreglo) {
        $a = ModelExcel::guardarExcelAprendizModel($arreglo);
    }

    //INSTRUCTOR
    private function verificarExcelInstructor($arreglo){
        $a = ModelExcel::verificarExcelInstructorModel($arreglo);
        return $a;
    }

    private function guardarExcelInstructor($arreglo) {
        $a = ModelExcel::guardarExcelInstructorModel($arreglo);
        return $a;
    }

    private function guardarExcelUserInstructor($arreglo) {
        $a = ModelExcel::guardarExcelUserInstructorModel($arreglo);
    }
    //COORDINADOR
    private function verificarExcelCoordinador($arreglo){
        $a = ModelExcel::verificarExcelCoordinadorModel($arreglo);
        return $a;
    }

    private function guardarExcelCoordinador($arreglo) {
        $a = ModelExcel::guardarExcelCoordinadorModel($arreglo);
        return $a;
    }

    private function guardarExcelUserCoordinador($arreglo) {
        $a = ModelExcel::guardarExcelUserCoordinadorModel($arreglo);
    }
    // PROGRAMA
    private function verificarExcelPrograma($arreglo) {
        $a = ModelExcel::verificarExcelProgramaModel($arreglo);
        return $a;
    }
    private function guardarExcelPrograma($arreglo) {
        $a = ModelExcel::guardarExcelProgramaModel($arreglo);
    }
    // PROGRAMA
    private function verificarExcelElemento($arreglo) {
        $a = ModelExcel::verificarExcelElementoModel($arreglo);
        return $a;
    }
    private function guardarExcelElemento($arreglo) {
        $a = ModelExcel::guardarExcelElementoModel($arreglo);
        return $a;
    }
    private function guardarExcelDetalleElementoTic($arreglo){
        $a = ModelExcel::guardarExcelDetalleElementoTicModel($arreglo);
    }
    // Herramienta
    private function guardarExcelDetalleElementoHerramienta($arreglo){
        $a = ModelExcel::guardarExcelDetalleElementoHerramientaModel($arreglo);
    }
    // Laboratorio
    private function guardarExcelDetalleElementoLaboratorio($arreglo){
        $a = ModelExcel::guardarExcelDetalleElementoLaboratorioModel($arreglo);
    }
    // Mueble
    private function guardarExcelDetalleElementoMueble($arreglo){
        $a = ModelExcel::guardarExcelDetalleElementoMuebleModel($arreglo);
    }
}
 ?>
