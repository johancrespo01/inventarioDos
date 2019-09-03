<?php 
require_once MODELO_PATH . 'cambiarPassModel.php';
require_once CONTROL_PATH . 'hash.php';
@session_start();
class ControlCambiarPass 
{
	private static $instancia;

  public static function singleton_CambiarPass() {
    if (!isset(self::$instancia)) {

      $miclase = __CLASS__;
      self::$instancia = new $miclase;
    }
    return self::$instancia;
  }

  public function cambiarContrasenia(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
    	isset($_POST['passActual']) &&
     !empty($_POST['passActual']) &&
     isset($_POST['newPass']) &&
     !empty($_POST['newPass']) &&
     isset($_POST['veriPass']) &&
     !empty($_POST['veriPass']) 
   ){
      $contraseniaAntigua = $_POST['passActual'];
    $contraseniaNueva = $_POST['newPass'];
    $contraseniaNuevaVerifica = $_POST['veriPass'];

    $hash = $_SESSION["contrasenia"];

    $persona = $_SESSION['id_persona'];
    // var_dump($persona);exit();
    if ($contraseniaNueva == $contraseniaNuevaVerifica) {
      if (Hash::verificar($hash, $contraseniaAntigua)) {
    			// echo "<script>alert('Las contraseñas antiguas coinciden')</script>";
        $clavecifrada = Hash::hashpass($contraseniaNueva);
        $cambiar = ModeloCambiarPass::cambiarPassModel($clavecifrada,$persona);
        if ($cambiar != FALSE) {
         echo '<script>
         swal({
           title: "Operacion exitosa",
           text: "Se ha cambiado correctamente su contraseña",
           icon: "success"
           }).then((willDelete) => {
            if (willDelete) {
             
            }
            });
            </script>';
          }else{
           echo '<script>
           swal({
            title: "Oops!",
            text: "Ha ocurrido un error",
            icon: "error"
            });
            </script>';
          }
          
        }else{
          echo '<script>
          swal({
            title: "Oops!",
            text: "Verifique su contraseña",
            icon: "error"
            });
            </script>';
          }

        }else{
         echo '<script>
         swal({
          title: "Oops!",
          text: "No se recibieron algunos datos",
          icon: "error"
          });
          </script>';

        }
      }
    }
  }
  ?>