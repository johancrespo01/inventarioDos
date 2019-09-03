<?php 

require_once MODELO_PATH . 'conexion.php';

class ModeloPrograma extends conexion {
	
	public static function guardarPrograma($datos) {
		#echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'programa';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (nombre,id_coordinacion) VALUE (:a,:g)';
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['nombreBD']);
            $preparado->bindParam(':g', $datos['coordinacionBD']);
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
        $tabla = 'Programa';
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
    #FUNCION PARA PAGINAR
    public static function mostrarProgramaContadoModel() {
        $tabla = 'Programa';
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

    #aa
    public static function mostrarLimitadoProgramaModel($q,$cant) {
        $tabla = 'Programa';
        $cnx = conexion::singleton_conexion();  
        $select = "SELECT programa.nombre as nombre, programa.id_programa as id_programa, coordinacion.nombre as nombre_coordinacion, coordinacion.id_coordinacion as id_coordinacion FROM programa JOIN coordinacion ON coordinacion.id_coordinacion = programa.id_programa LIMIT ".$q.",".$cant;
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
    public static function tiempoRealProgramaModel($q) {
        $tabla = 'Programa';
        $cnx = conexion::singleton_conexion();  
        $select = "SELECT programa.nombre as nombre, programa.id_programa as id_programa, coordinacion.nombre as nombre_coordinacion, coordinacion.id_coordinacion as id_coordinacion FROM programa JOIN coordinacion ON coordinacion.id_coordinacion = programa.id_programa WHERE programa.nombre LIKE '%$q%' ";
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