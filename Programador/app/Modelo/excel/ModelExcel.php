<?php
 use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 require_once MODELO_PATH . 'conexion.php';
 require_once LIB_PATH . 'PHPMailer-master/src/Exception.php';
require_once LIB_PATH . 'PHPMailer-master/src/PHPMailer.php';
require_once LIB_PATH . 'PHPMailer-master/src/SMTP.php';

class ModelExcel extends conexion {
	// AMBIENTE
	public static function verificarExcelAmbienteModel($datos) {
        $tabla = 'ambiente';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT * FROM " . $tabla . " WHERE  nombre = :a";
        try {
            $preparado = $enlace->preparar($cmdsql);
            $preparado->bindParam(':a', $datos);
            // Especificamos el fetch mode antes de llamar a fetch()
            $preparado->setFetchMode(PDO::FETCH_ASSOC);
            if ($preparado->execute()) {
                $valida = $preparado->rowCount();
                //echo"<script>alert('el numero de filas afectadas es : ".$valida.");</script>";
                //echo "<script>alert('Se ha guardado el aprendiz');</script>";
                //return $preparado->fetchAll();
                return $valida;
                // return $preparado->execute();
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
        }
        $enlace->closed();
        $enlace = null;
    }

    public static function guardarExcelAmbienteModel($datos) {
		#echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'Ambiente';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (nombre,id_programa,estado) VALUE (:a,:g,:i)';
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['nombre']);
            $preparado->bindParam(':g', $datos['programa']);
            $preparado->bindValue(':i', '1');
            if ($preparado->execute()) {
                 return $preparado->fetchAll();
            } else {
                #echo "<script>alert('No se ha guardado el usuario')</script>";
                return FALSE;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
        }
        $cnx->closed();
        $cnx = null;
    }

    // APRENDIZ
    public static function verificarExcelAprendizModel($datos) {
        $tabla = 'persona';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT * FROM " . $tabla . " WHERE  numeroDocumento = :a";
        try {
            $preparado = $enlace->preparar($cmdsql);
            $preparado->bindParam(':a', $datos);
            // Especificamos el fetch mode antes de llamar a fetch()
            $preparado->setFetchMode(PDO::FETCH_ASSOC);
            if ($preparado->execute()) {
                $valida = $preparado->rowCount();
                //echo"<script>alert('el numero de filas afectadas es : ".$valida.");</script>";
                //echo "<script>alert('Se ha guardado el aprendiz');</script>";
                //return $preparado->fetchAll();
                return $valida;
                // return $preparado->execute();
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
        }
        $enlace->closed();
        $enlace = null;
    }

    public static function guardarExcelAprendizModel($datos) {
		#echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'persona';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (nombre,apellido,correo,telefono,tipoDocumento,numeroDocumento,id_rol,estado) VALUE (:a,:g,:i,:o,:u,:b,:e,:f)';
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['nombre']);
            $preparado->bindParam(':g', $datos['apellido']);
            $preparado->bindParam(':i', $datos['correo']);
            $preparado->bindParam(':o', $datos['telefono']);
            $preparado->bindParam(':u', $datos['tipoDocumento']);
            $preparado->bindParam(':b', $datos['numDocumento']);
            //$preparado->bindParam(':c', $datos['imagen']);
            $preparado->bindValue(':e', '2');
            $preparado->bindValue(':f', '1');
            if ($preparado->execute()) {
                 return $preparado->fetchAll();
            } else {
                #echo "<script>alert('No se ha guardado el usuario')</script>";
                return FALSE;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
        }
        $cnx->closed();
        $cnx = null;
    }

    // INSTRUCTOR
    public static function verificarExcelInstructorModel($datos) {
        $tabla = 'persona';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT * FROM " . $tabla . " WHERE  numeroDocumento = :a";
        try {
            $preparado = $enlace->preparar($cmdsql);
            $preparado->bindParam(':a', $datos);
            // Especificamos el fetch mode antes de llamar a fetch()
            $preparado->setFetchMode(PDO::FETCH_ASSOC);
            if ($preparado->execute()) {
                $valida = $preparado->rowCount();
                //echo"<script>alert('el numero de filas afectadas es : ".$valida.");</script>";
                //echo "<script>alert('Se ha guardado el Instructor');</script>";
                //return $preparado->fetchAll();
                return $valida;
                // return $preparado->execute();
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
        }
        $enlace->closed();
        $enlace = null;
    }

    public static function guardarExcelInstructorModel($datos) {
        #echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'persona';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (nombre,apellido,correo,telefono,tipoDocumento,numeroDocumento,id_rol,estado) VALUE (:a,:g,:i,:o,:u,:b,:e,:f)';
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['nombre']);
            $preparado->bindParam(':g', $datos['apellido']);
            $preparado->bindParam(':i', $datos['correo']);
            $preparado->bindParam(':o', $datos['telefono']);
            $preparado->bindParam(':u', $datos['tipoDocumento']);
            $preparado->bindParam(':b', $datos['numDocumento']);
            //$preparado->bindParam(':c', $datos['imagen']);
            $preparado->bindValue(':e', '3');
            $preparado->bindValue(':f', '1');
            if ($preparado->execute()) {
                $id = $cnx->ultimoIngreso($tabla);
                $resultado = array('guardar' => TRUE, 'id' => $id);
                return $resultado;
            } else {
                #echo "<script>alert('No se ha guardado el usuario')</script>";
                return FALSE;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
        }
        $cnx->closed();
        $cnx = null;
    }
    public static function guardarExcelUserInstructorModel($datos) {
        #echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'usuario';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (usuario,contrasenia,id_persona) VALUE (:a,:g,:i)';
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['usuario']);
            $preparado->bindParam(':g', $datos['pass']);
            $preparado->bindParam(':i', $datos['id_instructor']);
            if ($preparado->execute()) {

                //ENVIAR CORREO
                $txt_message='<!DOCTYPE html>
                <html lang="es">
                    <head>
                        <title>titulo</title>
                        <style type="text/css">
                            body {
                                background-color: #FFF }
                            #banner{
                                width:800px;
                                height:219px;}
                            #cuerpo{
                                width:800px;}
                        </style>
                    </head>
                    <body>
                        <div id="cuerpo">
                            <br />
                            <font face="Arial, Helvetica, sans-serif" color="#333" size="+1">Se&#241;or(a):
                            <b>'.$datos['nombre'].' '.$datos['apellido'].'</b></font>
                            <br />
                            <p align="justify">Se ah asignado el siguiente usuario:
                                <b>'.$datos['nombre'].'</b><br/><br/>Con esta contraseña:
                                <b>'.$datos['passNoCifrado'].'</b><br/><br/>
                                <b> Esto para iniciar sesion en la plataforma web de inventario sena, recuerde poner el usuario exactamente igual.</br>
                                La contraseña podra ser cambiada dentro del aplicativo web.</b><br/><br/>
                                <b> Puede iniciar sesion en : http://gestionedu.co/inventario/Instructor/</b>
                            </p>
                        </div>
                    </body>
                </html>';
                $header='MIME-Version: 1.0' . "\r\n";
                $header.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $header.='From: multilinguismosena@gmail.com'. "\r\n";
                $header.='Reply-To: multilinguismosena@gmail.com'. "\r\n";
                //$header.='Cc: aavalencia9@misena.edu.co'. "\r\n";
                // $header.='Bcc: l.jmb@hotmail.com'. "\r\n";
                $asunto="Sena Inventario - creacion de usuario";
                $success=mail($datos['correo'],$asunto,utf8_decode($txt_message),$header);
                //FIN ENVIAR CORREO

                $id = $cnx->ultimoIngreso($tabla);
                $resultado = array('guardar' => TRUE, 'id' => $id);
                return $resultado;
            } else {
                #echo "<script>alert('No se ha guardado el usuario')</script>";
                return FALSE;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
        }
        $cnx->closed();
        $cnx = null;
    }
    // COORDINADOR
    public static function verificarExcelCoordinadorModel($datos) {
        $tabla = 'persona';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT * FROM " . $tabla . " WHERE  numeroDocumento = :a";
        try {
            $preparado = $enlace->preparar($cmdsql);
            $preparado->bindParam(':a', $datos);
            // Especificamos el fetch mode antes de llamar a fetch()
            $preparado->setFetchMode(PDO::FETCH_ASSOC);
            if ($preparado->execute()) {
                $valida = $preparado->rowCount();
                //echo"<script>alert('el numero de filas afectadas es : ".$valida.");</script>";
                //echo "<script>alert('Se ha guardado el Coordinador');</script>";
                //return $preparado->fetchAll();
                return $valida;
                // return $preparado->execute();
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
        }
        $enlace->closed();
        $enlace = null;
    }

    public static function guardarExcelCoordinadorModel($datos) {
        #echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'persona';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (nombre,apellido,correo,telefono,tipoDocumento,numeroDocumento,id_rol,estado) VALUE (:a,:g,:i,:o,:u,:b,:e,:f)';
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['nombre']);
            $preparado->bindParam(':g', $datos['apellido']);
            $preparado->bindParam(':i', $datos['correo']);
            $preparado->bindParam(':o', $datos['telefono']);
            $preparado->bindParam(':u', $datos['tipoDocumento']);
            $preparado->bindParam(':b', $datos['numDocumento']);
            //$preparado->bindParam(':c', $datos['imagen']);
            $preparado->bindValue(':e', '4');
            $preparado->bindValue(':f', '1');
            if ($preparado->execute()) {
                $id = $cnx->ultimoIngreso($tabla);
                $resultado = array('guardar' => TRUE, 'id' => $id);
                return $resultado;
            } else {
                #echo "<script>alert('No se ha guardado el usuario')</script>";
                return FALSE;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
        }
        $cnx->closed();
        $cnx = null;
    }
    public static function guardarExcelUserCoordinadorModel($datos) {
        #echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'usuario';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (usuario,contrasenia,id_persona) VALUE (:a,:g,:i)';
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['usuario']);
            $preparado->bindParam(':g', $datos['pass']);
            $preparado->bindParam(':i', $datos['id_Coordinador']);
            if ($preparado->execute()) {

                //ENVIAR CORREO
                $txt_message='<!DOCTYPE html>
                <html lang="es">
                    <head>
                        <title>titulo</title>
                        <style type="text/css">
                            body {
                                background-color: #FFF }
                            #banner{
                                width:800px;
                                height:219px;}
                            #cuerpo{
                                width:800px;}
                        </style>
                    </head>
                    <body>
                        <div id="cuerpo">
                            <br />
                            <font face="Arial, Helvetica, sans-serif" color="#333" size="+1">Se&#241;or(a):
                            <b>'.$datos['nombre'].' '.$datos['apellido'].'</b></font>
                            <br />
                            <p align="justify">Se ah asignado el siguiente usuario:
                                <b>'.$datos['nombre'].'</b><br/><br/>Con esta contraseña:
                                <b>'.$datos['passNoCifrado'].'</b><br/><br/>
                                <b> Esto para iniciar sesion en la plataforma web de inventario sena, recuerde poner el usuario exactamente igual.</br>
                                La contraseña podra ser cambiada dentro del aplicativo web.</b><br/><br/>
                                <b> Puede iniciar sesion en : http://gestionedu.co/inventario/Programador/</b>
                            </p>
                        </div>
                    </body>
                </html>';
                $header='MIME-Version: 1.0' . "\r\n";
                $header.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $header.='From: multilinguismosena@gmail.com'. "\r\n";
                $header.='Reply-To: multilinguismosena@gmail.com'. "\r\n";
                //$header.='Cc: aavalencia9@misena.edu.co'. "\r\n";
                // $header.='Bcc: l.jmb@hotmail.com'. "\r\n";
                $asunto="Sena Inventario - creacion de usuario";
                $success=mail($datos['correo'],$asunto,utf8_decode($txt_message),$header);
                //FIN ENVIAR CORREO


                $id = $cnx->ultimoIngreso($tabla);
                $resultado = array('guardar' => TRUE, 'id' => $id);
                return $resultado;
            } else {
                #echo "<script>alert('No se ha guardado el usuario')</script>";
                return FALSE;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
        }
        $cnx->closed();
        $cnx = null;
    }

    // PROGRAMA
    public static function verificarExcelProgramaModel($datos) {
        $tabla = 'Programa';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT * FROM " . $tabla . " WHERE  nombre = :a";
        try {
            $preparado = $enlace->preparar($cmdsql);
            $preparado->bindParam(':a', $datos);
            // Especificamos el fetch mode antes de llamar a fetch()
            $preparado->setFetchMode(PDO::FETCH_ASSOC);
            if ($preparado->execute()) {
                $valida = $preparado->rowCount();
                //echo"<script>alert('el numero de filas afectadas es : ".$valida.");</script>";
                //echo "<script>alert('Se ha guardado el aprendiz');</script>";
                //return $preparado->fetchAll();
                return $valida;
                // return $preparado->execute();
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
        }
        $enlace->closed();
        $enlace = null;
    }

    public static function guardarExcelProgramaModel($datos) {
        #echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'programa';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (nombre,id_coordinacion,estado) VALUE (:a,:g,:p)';
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['nombre']);
            $preparado->bindParam(':g', $datos['Coordinacion']);
            $preparado->bindValue(':p', '1');
            if ($preparado->execute()) {
                $id = $cnx->ultimoIngreso($tabla);
                $resultado = array('guardar' => TRUE, 'id' => $id);
                return $resultado;
            } else {
                #echo "<script>alert('No se ha guardado el usuario')</script>";
                return FALSE;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
        }
        $cnx->closed();
        $cnx = null;   $cnx = null;
    }
    // TIC
    public static function verificarExcelElementoModel($datos) {
        $tabla = 'elemento';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT * FROM " . $tabla . " WHERE  placa = :a";
        try {
            $preparado = $enlace->preparar($cmdsql);
            $preparado->bindParam(':a', $datos);
            // Especificamos el fetch mode antes de llamar a fetch()
            $preparado->setFetchMode(PDO::FETCH_ASSOC);
            if ($preparado->execute()) {
                $valida = $preparado->rowCount();
                //echo"<script>alert('el numero de filas afectadas es : ".$valida.");</script>";
                //echo "<script>alert('Se ha guardado el aprendiz');</script>";
                //return $preparado->fetchAll();
                return $valida;
                // return $preparado->execute();
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
        }
        $enlace->closed();
        $enlace = null;
    }

    public static function guardarExcelElementoModel($datos) {
         #echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'elemento';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (placa,nombre,descripcion,serial,id_material,estado,id_ambiente,id_persona) VALUE (:a,:z,:c,:e,:g,:k,:l,:m)'; //curdate captura la fecha actual
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['Placa']);
            $preparado->bindParam(':z', $datos['nombre']);
            $preparado->bindParam(':c', $datos['Descripcion']);
            $preparado->bindParam(':e', $datos['Serial']);
            $preparado->bindParam(':g', $datos['material']);
            $preparado->bindValue(':k', '1');
            $preparado->bindParam(':l', $datos['Ambiente']);
            $preparado->bindValue(':m', $datos['Responsable']);
            //$preparado->bindParam(':c', $datos['imagen']);
            #$preparado->bindValue(':e', '1');
            #$preparado->bindValue(':f', 'A');
            if ($preparado->execute()) {
                $id = $cnx->ultimoIngreso($tabla);
                $resultado = array('guardar' => TRUE, 'id' => $id);
                return $resultado;
            } else {
               # echo "<script>alert('No se ha guardado el usuario')</script>";
                return FALSE;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
        }
        $cnx->closed();
        $cnx = null;

    }

     public static function guardarExcelDetalleElementoTicModel($datos) {
         #echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'detalle_elemento';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (precio,ram,almacenamiento,procesador,id_marca,id_elemento,fecha_ingreso) VALUE (:e,:i,:a,:p,:g,:k,curdate())'; //curdate captura la fecha actual
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':e', $datos['Precio']);
            $preparado->bindParam(':i', $datos['Ram']);
            $preparado->bindParam(':a', $datos['Almacenamiento']);
            $preparado->bindParam(':p', $datos['Procesador']);
            $preparado->bindValue(':g', '1');
            $preparado->bindParam(':k', $datos['id_elemento']);
            if ($preparado->execute()) {
                $id = $cnx->ultimoIngreso($tabla);
                $resultado = array('guardar' => TRUE, 'id' => $id);
                return $resultado;
            } else {
               # echo "<script>alert('No se ha guardado el usuario')</script>";
                return FALSE;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
        }
        $cnx->closed();
        $cnx = null;
    }
    // Herramienta
    public static function guardarExcelDetalleElementoHerramientaModel($datos) {
        #echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'detalle_elemento';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (precio,id_marca,id_elemento,fecha_ingreso) VALUE (:e,:g,:k,curdate())'; //curdate captura la fecha actual
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':e', $datos['Precio']);
            $preparado->bindValue(':g', '1');
            $preparado->bindParam(':k', $datos['id_elemento']);
            if ($preparado->execute()) {
                $id = $cnx->ultimoIngreso($tabla);
                $resultado = array('guardar' => TRUE, 'id' => $id);
                return $resultado;
            } else {
               # echo "<script>alert('No se ha guardado el usuario')</script>";
                return FALSE;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
        }
        $cnx->closed();
        $cnx = null;
    }
    // Laboratorio
    public static function guardarExcelDetalleElementoLaboratorioModel($datos) {
        #echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'detalle_elemento';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (precio,id_marca,id_elemento,fecha_ingreso) VALUE (:e,:g,:k,curdate())'; //curdate captura la fecha actual
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':e', $datos['Precio']);
            $preparado->bindValue(':g', '4');
            $preparado->bindParam(':k', $datos['id_elemento']);
            if ($preparado->execute()) {
                $id = $cnx->ultimoIngreso($tabla);
                $resultado = array('guardar' => TRUE, 'id' => $id);
                return $resultado;
            } else {
               # echo "<script>alert('No se ha guardado el usuario')</script>";
                return FALSE;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
        }
        $cnx->closed();
        $cnx = null;
    }
    //MUEBLES//
    public static function guardarExcelDetalleElementoMuebleModel($datos) {
        #echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'detalle_elemento';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (peso,ancho,alto,largo,precio,id_marca,id_elemento,fecha_ingreso) VALUE (:x,:a,:z,:c,:e,:g,:k,curdate())'; //curdate captura la fecha actual
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['Ancho']);
            $preparado->bindParam(':z', $datos['Alto']);
            $preparado->bindParam(':c', $datos['Largo']);
            $preparado->bindParam(':e', $datos['Precio']);
            $preparado->bindValue(':g', '1');
            $preparado->bindParam(':k', $datos['id_elemento']);
            $preparado->bindParam(':x', $datos['Peso']);
            if ($preparado->execute()) {
                $id = $cnx->ultimoIngreso($tabla);
                $resultado = array('guardar' => TRUE, 'id' => $id);
                return $resultado;
            } else {
               # echo "<script>alert('No se ha guardado el usuario')</script>";
                return FALSE;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
        }
        $cnx->closed();
        $cnx = null;
    }
}
 ?>
