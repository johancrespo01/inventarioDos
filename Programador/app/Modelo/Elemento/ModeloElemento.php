<?php 
 require_once MODELO_PATH . 'conexion.php';
class ModeloElemento extends conexion{



     public static function modificarElementoModel($datos) {
        //var_dump($datos['nombreBD']);
        #echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'elemento';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'UPDATE `elemento` SET `placa` = :b , `nombre` = :z , `descripcion` = :c, `serial` = :o , `id_material` = :q, `estado` = :h, `id_ambiente` = :j, `id_persona` = :s WHERE `elemento`.`id_elemento` = :a'; //curdate captura la fecha actual
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['id_elementoBD']);
            $preparado->bindParam(':b', $datos['num_placaBD']);
            $preparado->bindParam(':z', $datos['nombreBD']);
            $preparado->bindParam(':c', $datos['descripcionBD']);
            $preparado->bindParam(':o', $datos['serialBD']);
            $preparado->bindParam(':q', $datos['materialBD']);
            $preparado->bindValue(':h', '1');//
            $preparado->bindParam(':j', $datos['ambienteBD']);
            $preparado->bindParam(':s', $datos['responsableBD']);
            if ($preparado->execute()) {
                $id = $cnx->ultimoIngreso($tabla);
                $resultado = array('guardar' => TRUE, 'id' => $datos['id_elementoBD']);
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

	public static function guardarElemento($datos) {
		#echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'elemento';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (placa,nombre,descripcion,serial,id_material,estado,id_ambiente,id_persona) VALUE (:a,:z,:c,:e,:g,:k,:l,:m)'; //curdate captura la fecha actual
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['num_placaBD']);
            $preparado->bindParam(':z', $datos['nombreBD']);
            $preparado->bindParam(':c', $datos['descripcionBD']);
            $preparado->bindParam(':e', $datos['serialBD']);
            $preparado->bindParam(':g', $datos['materialBD']);
            $preparado->bindValue(':k', '1');
            $preparado->bindParam(':l', $datos['ambienteBD']);
            $preparado->bindValue(':m', $datos['responsableBD']);
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

    //METODOS PARA GUARDAR DETALLES DE ELEMENTOS//
    //MUEBLES//
    public static function guardarDetalleElementoMueble($datos) {
        #echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'detalle_elemento';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (peso,ancho,alto,largo,precio,id_marca,id_elemento,fecha_ingreso) VALUE (:x,:a,:z,:c,:e,:g,:k,curdate())'; //curdate captura la fecha actual
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['anchoBD']);
            $preparado->bindParam(':z', $datos['altoBD']);
            $preparado->bindParam(':c', $datos['largoBD']);
            $preparado->bindParam(':e', $datos['precioBD']);
            $preparado->bindValue(':g', '1');
            $preparado->bindParam(':k', $datos['id_elementoBD']);
            $preparado->bindParam(':x', $datos['pesoBD']);
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

    public static function modificarDetalleElementoMueble($datos) {
        #echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'detalle_elemento';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'UPDATE `detalle_elemento` SET `peso` = :x, `ancho` = :a, `largo` = :c, `alto`=:z, `precio` = :e, `fecha_ingreso` = curdate() WHERE `detalle_elemento`.`id_elemento` = :k';

        // $cmdsql = 'INSERT INTO ' . $tabla . ' (peso,ancho,alto,largo,precio,id_marca,id_elemento,fecha_ingreso) VALUE (:x,:a,:z,:c,:e,:g,:k,curdate())'; //curdate captura la fecha actual
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $datos['anchoBD']);
            $preparado->bindParam(':z', $datos['altoBD']);
            $preparado->bindParam(':c', $datos['largoBD']);
            $preparado->bindParam(':e', $datos['precioBD']);
            $preparado->bindParam(':k', $datos['id_elementoBD']);
            $preparado->bindParam(':x', $datos['pesoBD']);
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
    //FIN MIEBLES//

 //HERRAMIENTAS//
    public static function guardarDetalleElementoHerramienta($datos) {
        #echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'detalle_elemento';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (precio,id_marca,id_elemento,fecha_ingreso) VALUE (:e,:g,:k,curdate())'; //curdate captura la fecha actual
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':e', $datos['precioBD']);
            $preparado->bindValue(':g', '1');
            $preparado->bindParam(':k', $datos['id_elementoBD']);
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

    public static function modificarDetalleElementoHerramienta($datos) {
         // echo "<script>alert('Entro al modelo')</script>";
         // var_dump($datos);
        $tabla = 'detalle_elemento';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'UPDATE `detalle_elemento` SET `precio` = :e, `id_marca` = :g, `fecha_ingreso` = curdate()  WHERE `detalle_elemento`.`id_elemento` = :k';
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':e', $datos['precioBD']);
            $preparado->bindValue(':g', '1');
            $preparado->bindParam(':k', $datos['id_elementoBD']);
            if ($preparado->execute()) {
                $id = $cnx->ultimoIngreso($tabla);
                $resultado = array('guardar' => TRUE, 'id' => $datos['id_elementoBD']);
                // echo "<script>alert('guardar si es true')</script>";
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
    //FIN HERRAMIENTAS//

     //laboratorio//
    public static function guardarDetalleElementoLaboratorio($datos) {
        #echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'detalle_elemento';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (precio,id_marca,id_elemento,fecha_ingreso) VALUE (:e,:g,:k,curdate())'; //curdate captura la fecha actual
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':e', $datos['precioBD']);
            $preparado->bindValue(':g', '1');
            $preparado->bindParam(':k', $datos['id_elementoBD']);
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

    public static function modificarDetalleElementoLaboratorio($datos) {
        #echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'detalle_elemento';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'UPDATE `detalle_elemento` SET `precio` = :e, `id_marca` = :g, `fecha_ingreso` = curdate()  WHERE `detalle_elemento`.`id_elemento` = :k';

        //curdate captura la fecha actual
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':e', $datos['precioBD']);
            $preparado->bindValue(':g', '1');
            $preparado->bindParam(':k', $datos['id_elementoBD']);
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
    //FIN laboratorio//

    //TIC//
    public static function modificarDetalleElementoTIC($datos) {
        #echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'detalle_elemento';
        $cnx = conexion::singleton_conexion();
         $cmdsql = 'UPDATE `detalle_elemento` SET `precio` = :e, `ram` = :i, `almacenamiento` = :a, `procesador` = :p, `id_marca` = :g, `fecha_ingreso` = curdate()  WHERE `detalle_elemento`.`id_elemento` = :k';


        // $cmdsql = 'INSERT INTO ' . $tabla . ' (precio,ram,almacenamiento,procesador,id_marca,id_elemento,fecha_ingreso) VALUE (:e,:i,:a,:p,:g,:k,curdate())'; //curdate captura la fecha actual
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':e', $datos['precioBD']);
            $preparado->bindParam(':i', $datos['ramBD']);
            $preparado->bindParam(':a', $datos['almacenamientoBD']);
            $preparado->bindParam(':p', $datos['procesadorBD']);
            $preparado->bindValue(':g', '1');
            $preparado->bindParam(':k', $datos['id_elementoBD']);
            if ($preparado->execute()) {
                $id = $cnx->ultimoIngreso($tabla);
                $resultado = array('guardar' => TRUE, 'id' => $datos['id_elementoBD']);
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

    public static function guardarDetalleElementoTIC($datos) {
        #echo "<script>alert('Entro al modelo')</script>";
        $tabla = 'detalle_elemento';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'INSERT INTO ' . $tabla . ' (precio,ram,almacenamiento,procesador,id_marca,id_elemento,fecha_ingreso) VALUE (:e,:i,:a,:p,:g,:k,curdate())'; //curdate captura la fecha actual
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':e', $datos['precioBD']);
            $preparado->bindParam(':i', $datos['ramBD']);
            $preparado->bindParam(':a', $datos['almacenamientoBD']);
            $preparado->bindParam(':p', $datos['procesadorBD']);
            $preparado->bindValue(':g', '1');
            $preparado->bindParam(':k', $datos['id_elementoBD']);
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

    #ELIMINAR ELEMENTO
     public function desactivarElementoModel($id) {
        $tabla = 'elemento';
        $enlace = conexion::singleton_conexion();
        $query = 'UPDATE `elemento` SET `estado` = :e WHERE `elemento`.`id_elemento` = :k';
        // $query = "DELETE FROM " . $tabla . " WHERE id_elemento= :id";
        try {
            $preparado = $enlace->preparar($query);
            $preparado->bindValue(':e', '2');
            $preparado->bindParam(':k', $id);
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
     public function mostrarElementoContadoModel() {
        $tabla = 'elemento';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT count(*) FROM " . $tabla . " WHERE `elemento`.`estado` = 1";
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
        $select = "SELECT * FROM elemento LIMIT ".$q.",".$cant." WHERE `elemento`.`estado` = 1";
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

    public static function mostrarLimitadoElementoModelPorID($q,$cant,$id) {
        $tabla = 'elemento';
        $cnx = conexion::singleton_conexion();
        $select = "SELECT * FROM elemento  WHERE `elemento`.`estado` = 1 AND id_ambiente = $id LIMIT ".$q.",".$cant;
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


    #MOSTRAR NOMBRE DEL AMBIENTE
    public static function mostrarAmbienteIDModel($id) {
        $tabla = 'ambiente';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT nombre FROM " . $tabla ." WHERE id_ambiente = $id";
        try {
            $preparado = $enlace->preparar($cmdsql);
            // Especificamos el fetch mode antes de llamar a fetch()
            $preparado->setFetchMode(PDO::FETCH_ASSOC);
            if ($preparado->execute()) {
                //echo "<script>alert('Se ha guardado la empresa');</script>";
                return $preparado->fetch();
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



     public static function mostrarLimitadoElementoPorIDAJAXMODEL($id) {
        echo "<script>alert('ENTRO AL MODELO');</script>";
        $tabla = 'elemento';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT nombre FROM " . $tabla ." WHERE id_ambiente = $id AND `elemento`.`estado` = 1";
        try {
            $preparado = $enlace->preparar($cmdsql);
            // Especificamos el fetch mode antes de llamar a fetch()
            $preparado->setFetchMode(PDO::FETCH_ASSOC);
            if ($preparado->execute()) {
                //echo "<script>alert('Se ha guardado la empresa');</script>";
                return $preparado->fetch();
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
    #########################

    #FUNCION PARA MOSTRAR TODOS LOS MODELOS

    public static function mostrarElementoModel() {
        $tabla = 'elemento';
        $enlace = conexion::singleton_conexion();
        $cmdsql = "SELECT * FROM " . $tabla ." WHERE `elemento`.`estado` = 1";
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
