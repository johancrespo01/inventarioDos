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
            $password = trim($_POST['pass']);
            if ($rslt != FALSE) {
               // echo '<script>alert("Entro al si")</script>';
                if (password_verify($password, $rslt['contrasenia'])) {
                    #echo "COINCIDEN"; 
                    $this->objsession = new Session;
                    $this->objsession->iniciar();  
                    $this->objsession->SetSession('id_usuario', $rslt["id_persona"]);
                    $this->objsession->SetSession('usuario', $rslt["usuario"]);
                    $this->objsession->SetSession('validado', "SI");
                    //$this->objsession->SetSession('documento', $rslt["numeroDocumento"]);
                    $this->objsession->SetSession('contrasenia', $rslt["contrasenia"]);
                    $this->objsession->SetSession('persona', $rslt["nombre"]);
                    echo '<script>window.location.replace("index");</script>';
                    //header('Location:index');
                }else{
                    //echo '<script>alert("primer else")</script>';
                    $er = '1';
                    $error = base64_encode($er);
                    echo '<script>window.location.replace("inicio?er='.$error.'");</script>';
                   // header('Location:'.BASE_URL.'inicio?er=' . $error);
                }
            }else{
                //echo '<script>alert("segundo else")</script>';
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