<?php 
require_once 'conexion.php';
class ModeloIngreso extends conexion
{
	public static function verificacionUsuario($user){
		$tabla = 'usuario';
        $cnx = conexion::singleton_conexion();
        $cmdsql = 'SELECT p.nombre,p.apellido,u.id,u.usuario,u.contrasenia,u.id_persona FROM usuario u,persona p WHERE u.usuario=:user AND u.id_persona=p.id_persona AND p.id_rol = "4"';
        try {
            $preparado = $cnx->preparar($cmdsql);
            $preparado->bindValue(':user',$user);
            if ($preparado->execute()) {
                if ($preparado->rowCount() == 1) {
                    return $preparado->fetch();
                    $val = "correcto";
                    //echo '<script>alert("Usuario encontrado")</script>';
                    #header('Location:index');
                } else {
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            $this->setError($e->getMessage());
        }
        
        #$cnx->closed(); 
        $cnx = null;
	}
}

 ?>