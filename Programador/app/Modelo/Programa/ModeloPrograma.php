<?php

require_once MODELO_PATH . 'conexion.php';

class ModeloPrograma extends conexion {

	public static function guardarPrograma($datos) {
		#echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'programa';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (nombre,id_coordinacion,estado) VALUE (:a,:g,:p)';
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['nombreBD']);
            $preparado->bindParam(':g', $datos['coordinacionBD']);
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

    public static function modificarProgramaModel($datos) {
        var_dump($datos);exit();
        $tabla = 'programa';
        $cnx = conexion::singleton_conexion();
        //UPDATE `programa` SET `estado` = '1' WHERE `programa`.`id_programa` = 1;
        $cmdsql = "UPDATE `programa` SET `nombre` = ':a', `id_coordinacion` = ':g' WHERE `id_programa` = ':l'";
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['nombreBD']);
            $preparado->bindParam(':g', $datos['coordinacionBD']);
            $preparado->bindParam(':l', $datos['id_programa']);
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

    public static function mostrarProgramaModelPorID($id) {
        $tabla = 'programa';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT * FROM " . $tabla . " WHERE estado = '1' AND id_programa = $id";
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

    //ELIMINAR CENTRO
    public static function eliminarProgramaModel($datos) {
        //echo "<script>onsole.log($datos)</script>";exit();
        $tabla = 'programa';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'UPDATE `programa` SET `estado` = "2" WHERE `id_programa` = :l';
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

    public static function mostrarProgramaModel() {
        $tabla = 'programa';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT * FROM " . $tabla . " WHERE estado = '1'";
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

    public static function mostrarProgramaEspecificoModel($id) {
        $tabla = 'programa';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT * FROM " . $tabla ." WHERE id_programa = $id AND estado = '1'";
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
        $tabla = 'programa';
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
    public static function mostrarLimitadoProgramaModel() {
        $tabla = 'programa';
        $cnx = conexion::singleton_conexion();
        $select = "SELECT programa.nombre as nombre, programa.id_programa as id_programa, coordinacion.nombre as nombre_coordinacion, coordinacion.id_coordinacion as id_coordinacion FROM programa JOIN coordinacion ON coordinacion.id_coordinacion = programa.id_coordinacion WHERE programa.estado = '1' ";
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
        $tabla = 'programa';
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
