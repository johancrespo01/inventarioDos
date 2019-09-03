<?php 
require_once CONTROL_PATH . 'Session.php';
require_once CONTROL_PATH . 'hash.php';
require_once MODELO_PATH . 'ModeloSession.php';
@session_start();
class ControlIngreso
{
	private static $instancia;
    private $objsession;

    public static function singleton_ingreso() {

        if (!isset(self::$instancia)) {

            $miclase = __CLASS__;

            self::$instancia = new $miclase;
        }

        return self::$instancia;
    }

    public function ingresar(){
    	if (isset($_POST['user']) &&
                !empty($_POST['user']) &&
                //preg_match('/^[a-zA-Z0-9]+$/', $_POST['user']) &&
                isset($_POST['pass']) &&
                !empty($_POST['pass']))
        {
    		#echo '<script>alert("Listo para hacer registro")</script>';
    		$rslt = ModeloIngreso::verificacionUsuario($_POST['user']);
           # $datosUsuario = ModeloIngreso::datosDelUsuario($_POST['user']);
            //var_dump($rslt);
            //exit();
    		$hash = $rslt['contrasenia']; //real
            $contrasenia = $_POST['pass']; //introducida
            if ($rslt != FALSE) {
                if ($_POST['user'] == $rslt['usuario']) {
                    if (Hash::verificar($hash, $contrasenia)) {
                       $this->objsession = new Session;
                        $this->objsession->iniciar();  
                        $this->objsession->SetSession('usuarioInv', $rslt["usuario"]);
                        $this->objsession->SetSession('validado', "SI");
                        $this->objsession->SetSession('id_persona', $rslt["id_persona"]);
                        $this->objsession->SetSession('contrasenia', $rslt["contrasenia"]);
                        $this->objsession->SetSession('personaUno', $rslt["nombre"]);
                        echo '<script>window.location.replace("index");</script>';
                        //header('Location:index');
                    }
                }
            }else{
                $er = '1';
                $error = base64_encode($er);
                echo '<script>window.location.replace("inicio?er='.$error.'");</script>';
                //header('Location:'.BASE_URL.'inicio?er=' . $error);
            }
    	}else{
            #echo '<script>alert("Variables no recibidas")</script>';
        }
    }
}
 ?>