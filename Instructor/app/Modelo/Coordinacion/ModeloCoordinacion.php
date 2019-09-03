<?php 

 require_once MODELO_PATH . 'conexion.php';

class ModeloCoordinacion extends conexion {
	
	public function guardarCoordinacion($datos) {
		#echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'coordinacion';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (nombre,id_centro,id_persona) VALUE (:a,:g,:i)';
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['nombreBD']);
            $preparado->bindParam(':g', $datos['centroBD']);
            $preparado->bindParam(':i', $datos['responsableBD']);
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
     public function mostrarCoordinacionContadoModel() {
        $tabla = 'coordinacion';
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

    public static function mostrarLimitadoCoordinacionModel($q,$cant) {
        $tabla = 'coordinacion';
        $cnx = conexion::singleton_conexion();  
        $select = "SELECT coordinacion.nombre as nombre_coordinacion, centro.nombre as nombre_centro, persona.nombre as responsable FROM coordinacion JOIN centro ON centro.id_centro = coordinacion.id_centro JOIN persona on persona.id_persona = coordinacion.id_persona LIMIT ".$q.",".$cant;
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


   

    public function mostrarCoordinacionModel() {
        $tabla = 'coordinacion';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT coordinacion.nombre as nombre_coordinacion, coordinacion.id_coordinacion as id_coordinacion, centro.nombre as nombre_centro, persona.nombre as responsable, persona.id_persona as id_persona FROM coordinacion JOIN centro ON centro.id_centro = coordinacion.id_centro JOIN persona on persona.id_persona = coordinacion.id_persona " ;
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
    public static function tiempoRealCoordinacionModel($q) {
        $tabla = 'coordinacion';
        $cnx = conexion::singleton_conexion();  
        $select = "SELECT coordinacion.nombre as nombre_coordinacion, centro.nombre as nombre_centro, persona.nombre as responsable FROM coordinacion JOIN centro ON centro.id_centro = coordinacion.id_centro JOIN persona on persona.id_persona = coordinacion.id_persona WHERE coordinacion.nombre LIKE '%$q%' ";
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