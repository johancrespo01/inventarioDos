<?php 

require_once MODELO_PATH . 'conexion.php';

class ModeloAmbiente extends conexion {
	
	public static function guardarAmbiente($datos) {
		#echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'Ambiente';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (nombre,id_programa) VALUE (:a,:g)';
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['nombreBD']);
            $preparado->bindParam(':g', $datos['programaBD']);
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

    public static function ModificarAmbiente($datos) {
        #echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'ambiente';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'UPDATE `ambiente` SET `nombre` = :a, `id_programa` = :g WHERE `id_ambiente` = :i ;';
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['nombreBD']);
            $preparado->bindParam(':g', $datos['programaBD']);
            $preparado->bindParam(':i', $datos['id_ambiente']);
            if ($preparado->execute()) {
                $id = $cnx->ultimoIngreso($tabla);
                $resultado = array('guardar' => TRUE, 'id' => $id);
                return $resultado;
            } else {
                echo "<script>alert('No se ha guardado el usuario')</script>";
                return FALSE;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
        }
        $cnx->closed();
        $cnx = null;
    }

    #ELIMINAR ELEMENTO
     public function eliminarAmbienteModel($id) {
        $tabla = 'ambiente';
        $enlace = conexion::singleton_conexion();
        $query = "DELETE FROM " . $tabla . " WHERE id_ambiente= :id";
        try {
            $preparado = $enlace->preparar($query);
            $preparado->bindValue(':id', (int) trim($id), PDO::PARAM_INT);
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

    public static function mostrarAmbienteEspecificoModel($idElemento, $idAmbiente) {
        $tabla = 'elemento';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT * FROM " . $tabla ." WHERE id_elemento = $idElemento";
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

     public static function mostrarAmbienteEspecificoModelPorInstructor($idElemento, $idInstructor) {
        $tabla = 'elemento';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT * FROM " . $tabla ." WHERE responsable = $idInstructor AND id_elemento = $idElemento";
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

     public static function mostrarAmbienteActualModel($idAmbiente) {
        $tabla = 'ambiente';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT * FROM " . $tabla ." WHERE id_ambiente = $idAmbiente";
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

    
    public static function mostrarAmbienteModel() {
        $tabla = 'ambiente';
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
    public static function mostrarAmbienteContadoModel() {
        $tabla = 'Ambiente';
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
    public static function mostrarLimitadoAmbienteModel() {
        $tabla = 'ambiente';
        $cnx = conexion::singleton_conexion();  
        $select = "SELECT ambiente.id_ambiente as id_ambiente, ambiente.nombre as nombre, ambiente.id_ambiente as id_ambiente, programa.nombre as nombre_programa, programa.id_programa as id_programa FROM ambiente JOIN programa ON programa.id_programa = ambiente.id_programa";
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
    public static function tiempoRealAmbienteModel($q) {
        $tabla = 'Ambiente';
        $cnx = conexion::singleton_conexion();  
        $select = "SELECT Ambiente.nombre as nombre, Ambiente.id_Ambiente as id_Ambiente, programa.nombre as nombre_programa, programa.id_programa as id_programa FROM Ambiente JOIN programa ON programa.id_programa = Ambiente.id_programa WHERE Ambiente.nombre LIKE '%$q%' ";
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

    public static function mostrarLimitadoElementoPorIDAJAXMODEL($id, $filtro) {
       //echo "<script> alert('$filtro')</script>";
         if($filtro!=6){
           // echo "<script> alert('$filtro')</script>";
           $material ="and e.id_material = $filtro"; 
       }else{
        $material ="";
       }
        $tabla = 'elemento';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT p.nombre nombre_Persona,e.id_elemento,e.nombre,e.descripcion,e.estado,e.serial,e.placa,e.id_persona,e.id_ambiente,e.id_material,d.id_detalleElemento,d.precio,d.peso,d.alto,d.ancho,d.largo,d.ram,d.almacenamiento,d.procesador,d.id_marca,d.id_elemento,d.fecha_ingreso,d.fecha_modificacion FROM elemento e,detalle_elemento d,persona p WHERE e.id_ambiente= $id " . $material . " AND e.id_elemento = d.id_elemento AND e.id_persona=p.id_persona";
            


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





}
?>