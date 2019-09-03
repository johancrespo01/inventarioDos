<?php
 use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 require_once MODELO_PATH . 'conexion.php';
 require_once LIB_PATH . 'PHPMailer-master/src/Exception.php';
require_once LIB_PATH . 'PHPMailer-master/src/PHPMailer.php';
require_once LIB_PATH . 'PHPMailer-master/src/SMTP.php';
class ModeloElemento extends conexion{

	public static function guardarElemento($datos) {
		#echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'elemento';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (placa,id_subcategoria,nombre,descripcion,marca,serial,modulo,material,precio,peso,fecha_adquisicion,estado,id_ambiente,id_persona,ancho,alto,largo,fecha_ingresoSistema) VALUE (:a,:b,:z,:c,:d,:e,:f,:g,:h,:p,:j,:k,:l,:m,:n,:o,:q,curdate())'; //curdate captura la fecha actual
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['num_placaBD']);
            $preparado->bindValue(':b', '1');
            $preparado->bindParam(':z', $datos['nombreBD']);
            $preparado->bindParam(':c', $datos['descripcionBD']);
            $preparado->bindParam(':d', $datos['marcaBD']);
            $preparado->bindParam(':e', $datos['serialBD']);
            $preparado->bindParam(':f', $datos['moduloBD']);
            $preparado->bindParam(':g', $datos['materialBD']);
            $preparado->bindParam(':h', $datos['PrecioBD']);
            $preparado->bindParam(':p', $datos['PesoBD']);
            $preparado->bindParam(':j', $datos['fecha_adquisicionBD']);
            $preparado->bindParam(':k', $datos['estadoBD']);
            $preparado->bindValue(':l', '1');
            $preparado->bindValue(':m', '1');
            $preparado->bindParam(':n', $datos['AnchoBD']);
            $preparado->bindParam(':o', $datos['AltoBD']);
            $preparado->bindParam(':q', $datos['LargoBD']);

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

    public static function modificarElemento($datos) {
        // var_dump($datos);exit();
        // echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'novedades';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO novedades (id_persona,id_ambiente,id_elemento,descripcion) VALUE (:c,:d,:a,:b)';
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['id_elementoBD']);
            $preparado->bindParam(':b', $datos['descripcionBD']);
            $preparado->bindParam(':c', $datos['id_persona']);
             $preparado->bindParam(':d', $datos['id_ambienteBD']);

            if ($preparado->execute()) {
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
                          <b>Coordinador</b></font>
                          <br />
                          <p align="justify">Se presento una novedad en el elemento:
                  <b>'.$datos['nombreElementoBD'].'</b><br/><br/>Placa:
                  <b>'.$datos['placaBD'].'</b><br/><br/>Serial:
                  <b>'.$datos['serialBD'].'</b><br/><br/>Ambiente del elemento:
                  <b>'.$datos['nombreAmbienteBD'].'</b><br/><br/>  Novedad presentada por:  <b>'.$datos['usuarioBD'].' '.$datos['apellidoBD'].' </b> --- <b>'.$datos['correoBD'].'</b> --- <b> '. $datos[''] .' </b></p>' ;
                  $txt_message.='<p align="justify"><font face="Arial, Helvetica, sans-serif" color="#333">Novedad: <b>'.$datos['descripcionBD'].'</b></font></p>
                    </div>
                   </body>
                  </html>';
                $header='MIME-Version: 1.0' . "\r\n";
                $header.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $header.='From: multilinguismosena@gmail.com'. "\r\n";
                $header.='Reply-To: multilinguismosena@gmail.com'. "\r\n";
                //$header.='Cc: aavalencia9@misena.edu.co'. "\r\n";
                // $header.='Bcc: l.jmb@hotmail.com'. "\r\n";
                $asunto="Novedad de elemento - Sena Inventario";
                $correoDestino="tecsisintecol@gmail.com";
                $success=mail($correoDestino,$asunto,utf8_decode($txt_message),$header);
                //FIN ENVIAR CORREO

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

    #FUNCION PARA BUSCAR ELEMENTOS FILTRADOS POR ID_AMBIENTE
    public static function elementosPorIDModel($id) {
        $tabla = 'elemento';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT * FROM `elemento` WHERE id_ambiente = $id ";
        try {
            $preparado = $enlace->preparar($cmdsql);
            // Especificamos el fetch mode antes de llamar a fetch()
            $preparado->setFetchMode(PDO::FETCH_ASSOC);
            if ($preparado->execute()) {
                //echo "<script>alert('Se ha guardado la empresa');</script>";
                return $preparado->fetchAll();
                // return $preparado->execute();
            } else {
                #echo "<script>alert('FALSE');</script>";
                return FALSE;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
        }
        $enlace->closed();
        $enlace = null;
    }

    #FUNCION PARA PAGINAR
     public function mostrarElementoContadoModel() {
        $tabla = 'elemento';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT count(*) FROM " . $tabla ;
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

    public static function mostrarLimitadoElementoModel($q,$cant) {
        $tabla = 'elemento';
        $cnx = conexion::singleton_conexion();
        $select = "SELECT * FROM elemento LIMIT ".$q.",".$cant;
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

    #FUNCION PARA MOSTRAR TODOS LOS MODELOS

    public static function mostrarElementoModel() {
        $tabla = 'elemento';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT * FROM " . $tabla ;
        try {
            $preparado = $enlace->preparar($cmdsql);
            // Especificamos el fetch mode antes de llamar a fetch()
            $preparado->setFetchMode(PDO::FETCH_ASSOC);
            if ($preparado->execute()) {
                //echo "<script>alert('Se ha guardado la empresa');</script>";
                return $preparado->fetchAll();
                // return $preparado->execute();
            } else {
                #echo "<script>alert('FALSE');</script>";
                return FALSE;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
        }
        $enlace->closed();
        $enlace = null;
    }



    #FUNCION EN TIEMPO REAL
    public static function buscarElementoModel($q) {
        $tabla = 'elemento';
        $cnx = conexion::singleton_conexion();
        $select = "SELECT * FROM elemento WHERE nombre LIKE '%$q%' OR placa LIKE '%$q%' OR descripcion LIKE '%$q%' OR modulo LIKE '%$q%' OR marca LIKE '%$q%' OR estado LIKE '%$q%' OR peso LIKE '%$q%' OR serial LIKE '%$q%' OR marca LIKE '%$q%' OR modulo LIKE '%$q%' OR precio LIKE '%$q%' OR ancho LIKE '%$q%' OR alto LIKE '%$q%' OR largo LIKE '%$q%' OR material LIKE '%$q%'";
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

    public static function mostrarNombrematerial($idelemento) {
        // $tabla = 'ambiente';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT m.Descripcion FROM elemento e,material m WHERE e.id_elemento = $idelemento AND e.id_material=m.id_material";
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
}
 ?>
