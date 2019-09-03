<?php 

require_once MODELO_PATH . 'conexion.php';

class ModeloElectronico extends conexion {
	
	public static function guardarInstructor($datos) {
		#echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'persona';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (nombre,apellido,correo,telefono,tipoDocumento,numeroDocumento,id_rol,State) VALUE (:a,:g,:i,:o,:u,:b,:e,:f)';
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['nombre_user']);
            $preparado->bindParam(':g', $datos['apellido_user']);
            $preparado->bindParam(':i', $datos['correo_user']);
            $preparado->bindParam(':o', $datos['telefono_user']);
            $preparado->bindParam(':u', $datos['tipo_documento']);
            $preparado->bindParam(':b', $datos['num_documento']);
            //$preparado->bindParam(':c', $datos['imagen']);
            $preparado->bindValue(':e', '2');
            $preparado->bindValue(':f', 'A');
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

    public static function guardarInstructorUsuario($datos) {
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

    public static function mostrarInstructorModel() {
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
    public static function mostrarInstructorContadoModel() {
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
    public static function mostrarLimitadoInstructorModel($q,$cant) {
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
        $tabla = 'elemento';
        $cnx = conexion::singleton_conexion();  
        $select = "SELECT * FROM elemento WHERE material = '" . $q. "'";
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