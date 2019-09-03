<?php 

require_once MODELO_PATH . 'conexion.php';

class ModeloCambiarPass extends conexion {
	
	public static function cambiarPassModel($pass,$persona) {
       // var_dump($pass);
        $tabla = 'usuario';
        $cnx = conexion::singleton_conexion();
        //UPDATE `programa` SET `estado` = '1' WHERE `programa`.`id_programa` = 1;
        $cmdsql = "UPDATE `usuario` SET `contrasenia` = :a WHERE `id_persona` = :g"; 
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindParam(':a', $pass);
            $preparado->bindParam(':g', $persona);
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

    
}
?>