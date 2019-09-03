<?php 

require_once MODELO_PATH . 'conexion.php';

class ModeloLaboratorio extends conexion {
	
    #FUNCION EN TIEMPO REAL
    public static function tiempoRealLaboratorioModel($q) {
        $tabla = 'elemento';
        $cnx = conexion::singleton_conexion();  
        $select = "SELECT * from elemento e,detalle_elemento d WHERE e.estado = 1 AND e.id_material = $q AND e.id_elemento = d.id_elemento";
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