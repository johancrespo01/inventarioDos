<?php 

require_once MODELO_PATH . 'conexion.php';

class ModeloIngresoClass extends conexion {
	
	public static function guardarIngresoClass($datos) {
		#echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'ocupacion_ambiente';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (id_ambiente,id_persona,ficha,id_programa,fecha,hora_entrada,hora_salida) VALUE (:a,:g,:i,:r,curdate(),:p,:y)';
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['ambienteBD']);
            $preparado->bindParam(':g', $datos['personaBD']);
            $preparado->bindParam(':i', $datos['fichaBD']);
            $preparado->bindParam(':r', $datos['programaBD']);
            $preparado->bindParam(':p', $datos['horaEntradaBD']);
            $preparado->bindParam(':y', $datos['horaSalidaBD']);
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


    public static function mostrarProgramaModel() {
        $tabla = 'programa';
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
                return FALSE;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
        }
        $enlace->closed();
        $enlace = null;
    }

    public static function guardarFinClass($datos) {
        #echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'ocupacion_ambiente';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'UPDATE `ocupacion_ambiente` SET `hora_salida` = (:a) WHERE `ocupacion_ambiente`.`id_ocupacionA` = (:b);';
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['ambienteBD']);
            $preparado->bindParam(':b', $datos['personaBD']);
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

    public static function obtenerPersona($documentoPersona) {
        $tabla = 'persona';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT * FROM " . $tabla . " WHERE State = 'A' AND numeroDocumento = $documentoPersona";
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

    public static function guardarIngresoClassUsuario($datos) {
		#echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'usuario';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (usuario,contrasenia,numeroDocumento,rol) VALUE (:a,:g,:i,:r)';
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['num_documento']);
            $preparado->bindParam(':g', $datos['pass']);
            $preparado->bindParam(':i', $datos['num_documento']);
            $preparado->bindValue(':r', '2');
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

    public static function mostrarIngresoClassModel() {
        $tabla = 'persona';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT * FROM " . $tabla . " WHERE State = 'A' AND id_rol = 2";
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
    #FUNCION PARA PAGINAR
    public static function mostrarIngresoClassContadoModel() {
        $tabla = 'persona';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT count(*) FROM " . $tabla . " WHERE State = 'A' AND id_rol = 2";
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

    #aa
    public static function mostrarLimitadoIngresoClassModel($q,$cant) {
        $tabla = 'persona';
        $cnx = conexion::singleton_conexion();  
        $select = "SELECT * FROM persona WHERE State = 'A' AND id_rol = 2 LIMIT ".$q.",".$cant;
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

    #FUNCION EN TIEMPO REAL
    public static function tiempoRealElectronicoModel($q) {
        $tabla = 'persona';
        $cnx = conexion::singleton_conexion();  
        $select = "SELECT * FROM persona WHERE State = 'A' AND id_rol = ".$q."";
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