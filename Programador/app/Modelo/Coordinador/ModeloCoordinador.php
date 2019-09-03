<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 require_once MODELO_PATH . 'conexion.php';
 require_once LIB_PATH . 'PHPMailer-master/src/Exception.php';
require_once LIB_PATH . 'PHPMailer-master/src/PHPMailer.php';
require_once LIB_PATH . 'PHPMailer-master/src/SMTP.php';
class ModeloCoordinador extends conexion {

	public function guardarCoordinador($datos) {
		#echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'persona';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (nombre,apellido,correo,telefono,tipoDocumento,numeroDocumento,id_rol,estado) VALUE (:a,:g,:i,:o,:u,:b,:e,:f)';
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['nombre_user']);
            $preparado->bindParam(':g', $datos['apellido_user']);
            $preparado->bindParam(':i', $datos['correo_user']);
            $preparado->bindParam(':o', $datos['telefono_user']);
            $preparado->bindParam(':u', $datos['tipo_documento']);
            $preparado->bindParam(':b', $datos['num_documento']);
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

    public function BuscarNumIdModel($datos) {
        $tabla = 'persona';
        $cnx = conexion::singleton_conexion();
        $select = 'SELECT * FROM ' . $tabla . ' WHERE numeroDocumento = :u';
        try {
            $preparado = $cnx->preparar($select);
            $preparado->bindParam(':u', $datos);
            if ($preparado->execute()) {
                return $preparado->fetchAll();
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
        }
        $cnx->closed();
        $cnx = null;
    }

    public static function editarCoordinadorModel($datos) {
        $tabla = 'persona';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'UPDATE `persona` SET `nombre` = :a, `apellido` = :g, `correo` = :i, `telefono` = :o, `tipoDocumento` = :u, `numeroDocumento` = :b WHERE `persona`.`id_persona` = :l';
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['nombre_user']);
            $preparado->bindParam(':g', $datos['apellido_user']);
            $preparado->bindParam(':i', $datos['correo_user']);
            $preparado->bindParam(':o', $datos['telefono_user']);
            $preparado->bindParam(':u', $datos['tipo_documento']);
            $preparado->bindParam(':b', $datos['num_documento']);
            $preparado->bindParam(':l', $datos['id_coordinador']);
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


    public static function eliminarCoordinadorModel($datos) {
        //echo "<script>onsole.log($datos)</script>";exit();
        $tabla = 'persona';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'UPDATE `persona` SET `estado` = "2" WHERE `id_persona` = :l';
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':l', $datos);
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

    #FUNCION PARA PAGINAR
     public function mostrarCoordinadorContadoModel() {
        $tabla = 'persona';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT count(*) FROM " . $tabla . " WHERE estado = '1' AND id_rol = 4";
        try {
            $preparado = $enlace->preparar($cmdsql);
            // Especificamos el fetch mode antes de llamar a fetch()
            $preparado->setFetchMode(PDO::FETCH_ASSOC);
            if ($preparado->execute()) {
                //echo "<script>alert('Se ha guardado la empresa');</script>";
                return $preparado->fetch();
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

    public static function mostrarLimitadoCoordinadorModel() {
        $tabla = 'persona';
        $cnx = conexion::singleton_conexion();
        $select = "SELECT * FROM persona WHERE estado = '1' AND id_rol = 4";
        try {
            $preparado = $cnx->preparar($select);
            $preparado->setFetchMode(PDO::FETCH_ASSOC);
            //$preparado->bindValue(':u', $datos);
            if ($preparado->execute()) {
                return $preparado->fetchAll();
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
        }
        $cnx->closed();
        $cnx = null;
    }
    #########################


    public function guardarCoordinadorUsuario($datos) {
		#echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'usuario';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (usuario,contrasenia,id_persona) VALUE (:a,:g,:i)';
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['num_documento']);
            $preparado->bindParam(':g', $datos['pass']);
            $preparado->bindParam(':i', $datos['id_persona']);
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
                                <b>'.$datos['num_documento'].'</b><br/><br/>Con esta contraseña:
                                <b>'.$datos['passNoCifrada'].'</b><br/><br/>
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

    public function mostrarCoordinadorModel() {
        $tabla = 'persona';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT * FROM " . $tabla . " WHERE estado = '1' AND id_rol = 4";
        try {
            $preparado = $enlace->preparar($cmdsql);
            // Especificamos el fetch mode antes de llamar a fetch()
            $preparado->setFetchMode(PDO::FETCH_ASSOC);
            if ($preparado->execute()) {
                //echo "<script>alert('Se ha guardado la empresa');</script>";
                return $preparado->fetchAll();
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

    public function mostrarCoordinadorModelID($id) {
        $tabla = 'persona';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT * FROM " . $tabla . " WHERE estado = '1' AND id_rol = 4 AND id_persona = $id";
        try {
            $preparado = $enlace->preparar($cmdsql);
            // Especificamos el fetch mode antes de llamar a fetch()
            $preparado->setFetchMode(PDO::FETCH_ASSOC);
            if ($preparado->execute()) {
                //echo "<script>alert('Se ha guardado la empresa');</script>";
                return $preparado->fetchAll();
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

    public function mostrarCoordinadorModelPorId($id) {
        $tabla = 'persona';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT * FROM " . $tabla . " WHERE estado = '1' AND id_rol = 4 AND id_persona = $id";
        try {
            $preparado = $enlace->preparar($cmdsql);
            // Especificamos el fetch mode antes de llamar a fetch()
            $preparado->setFetchMode(PDO::FETCH_ASSOC);
            if ($preparado->execute()) {
                //echo "<script>alert('Se ha guardado la empresa');</script>";
                return $preparado->fetchAll();
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

     #FUNCION EN TIEMPO REAL
    public static function buscarCoordinadorModel($q) {
        $tabla = 'persona';
        $cnx = conexion::singleton_conexion();
        $select = "SELECT * FROM persona WHERE estado = '1' AND id_rol = 4 AND
        (nombre LIKE '%$q%' OR apellido LIKE '%$q%' OR correo LIKE '%$q%' OR telefono LIKE '%$q%' OR tipoDocumento LIKE '%$q%' OR      numeroDocumento LIKE '%$q%' OR estado LIKE '%$q%')";
        try {
            $preparado = $cnx->preparar($select);
            $preparado->setFetchMode(PDO::FETCH_ASSOC);
            //$preparado->bindValue(':u', $datos);
            if ($preparado->execute()) {
                return $preparado->fetchAll();
            } else {
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
