<?php 

require_once MODELO_PATH . 'conexion.php';

class ModeloCentro extends conexion {
	
	public static function guardarCentro($datos) {
		#echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'centro';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (nombre,region,direccion,telefono,correo,estado) VALUE (:a,:g,:i,:o,:u,:p)';
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['nombreBD']);
            $preparado->bindParam(':g', $datos['regionBD']);
            $preparado->bindParam(':i', $datos['direccionBD']);
            $preparado->bindParam(':o', $datos['telefonoBD']);
            $preparado->bindParam(':u', $datos['correorBD']);
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
        $cnx = null;
    }

    //ELIMINAR CENTRO
    public static function eliminarCentroModel($datos) {
        #echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'centro';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'UPDATE `centro` SET `estado` = "2" WHERE `centro`.`id_centro` = :l'; 
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

    public static function editarCentroModel($datos) {
        #echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'centro';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'UPDATE `centro` SET `nombre` = :a , `region` = :g , `direccion` = :i, `telefono` = :o , `correo` = :u WHERE `centro`.`id_centro` = :l'; 
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':l', $datos['id_centroBD']);
            $preparado->bindParam(':a', $datos['nombreBD']);
            $preparado->bindParam(':g', $datos['regionBD']);
            $preparado->bindParam(':i', $datos['direccionBD']);
            $preparado->bindParam(':o', $datos['telefonoBD']);
            $preparado->bindParam(':u', $datos['correorBD']);
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

    public static function mostrarCentroModel() {
        $tabla = 'centro';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT * FROM " . $tabla. " WHERE estado = '1'";
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

    public static function mostrarCentroModelID($id) {
        $tabla = 'centro';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT * FROM " . $tabla. " WHERE estado = '1' AND id_centro = $id";
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
    public static function mostrarCentroContadoModel() {
        $tabla = 'centro';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT count(*) FROM " . $tabla . " WHERE estado = '1'";
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
    public static function mostrarLimitadoCentroModel($q,$cant) {
        $tabla = 'centro';
        $cnx = conexion::singleton_conexion();  
        $select = "SELECT * FROM centro WHERE estado = '1' LIMIT ".$q.",".$cant;
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
    public static function tiempoRealCentroModel($q) {
        $tabla = 'centro';
        $cnx = conexion::singleton_conexion();  
        $select = "SELECT * FROM centro WHERE id_centro = $q AND estado = '1'";
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