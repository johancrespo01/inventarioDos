<?php

 require_once MODELO_PATH . 'conexion.php';

class ModeloAprendiz extends conexion {

	public function guardarAprendiz($datos) {
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
            $preparado->bindValue(':e', '2');
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

    public static function mostrarAprendizEspecificoModel($idAprendiz) {
        $tabla = 'persona';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT * FROM " . $tabla . " WHERE estado = '1' AND id_rol = 2 AND id_persona = $idAprendiz";
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


    #FUNCION PARA PAGINAR
     public function mostrarAprendizContadoModel() {
        $tabla = 'persona';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT count(*) FROM " . $tabla . " WHERE estado = '1' AND id_rol = 2";
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

    public static function mostrarLimitadoAprendizModel() {
        $tabla = 'persona';
        $cnx = conexion::singleton_conexion();
        $select = "SELECT * FROM persona WHERE estado = '1' AND id_rol = 2";
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


    public function guardarAprendizUsuario($datos) {
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

    public function mostrarAprendizModel() {
        $tabla = 'persona';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT * FROM " . $tabla . " WHERE estado = '1' AND id_rol = 2";
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
    public static function buscarAprendizModel($q) {
        $tabla = 'persona';
        $cnx = conexion::singleton_conexion();
        $select = "SELECT * FROM persona WHERE estado = '1' AND id_rol = 2 AND
        (nombre LIKE '%$q%' OR apellido LIKE '%$q%' OR correo LIKE '%$q%' OR telefono LIKE '%$q%' OR tipoDocumento LIKE '%$q%' OR      numeroDocumento LIKE '%$q%' OR State LIKE '%$q%')";
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
