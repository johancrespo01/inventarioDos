<?php
require_once CONTROL_PATH. 'ControlSession.php';
$ingreso = ControlIngreso::singleton_ingreso();
$ingreso->ingresar();
$desenc = base64_decode(@$_GET['er']);
if ($err = isset($desenc) ? $desenc : null);

?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>SB Admin 2 - Dashboard</title>

	<!-- Custom fonts for this template-->
	<link href="<?php echo PUBLIC_PATH ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="<?php echo PUBLIC_PATH ?>css/sb-admin-2.css" rel="stylesheet">
	<!--DISEÑO PORPIO-->
	<link href="<?php echo PUBLIC_PATH ?>css/LoginCss.css" rel="stylesheet">
 <link href="<?php echo PUBLIC_PATH ?>css/animate.css" rel="stylesheet">
	<!--LOGIN-->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<title>Login Page</title>
	<!--Made with love by Mutiullah Samim -->

	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="styles.css">
	<!------ Include the above in your HEAD tag ---------->

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
</head>


<body>


	<div class="container animated zoomIn">

	    <div class="d-flex justify-content-center h-100">

	        <div class="card">

	            <div class="card-header">
	                <h3 style="text-align: center;">Inicio se sesion</h3>
	            </div>
	            <div class="card-body">
	                <form method="POST">
	                    <div class="input-group form-group">
	                        <div class="input-group-prepend">
	                            <span class="input-group-text"><i class="fas fa-user"></i></span>
	                        </div>
	                        <input type="text" name="user" class="form-control" placeholder="username">

	                    </div>
	                    <div class="input-group form-group">
	                        <div class="input-group-prepend">
	                            <span class="input-group-text"><i class="fas fa-key"></i></span>
	                        </div>
	                        <input type="password" name="pass" class="form-control" placeholder="password">
	                    </div>
	                    <div class="form-group">
	                        <input type="submit" value="Login" class="btn float-right login_btn">
	                    </div>
	                </form>

	            </div>

	            <?php
				if ($err == 1) {
					echo '<center> <p class="mensaje-login" style="color:#fff">Usuario ó Contraseña Incorrecta</p> </center>';
				} else if ($err == 2) {
					echo '<center> <p class="mensaje-login" style="color:#fff">Debe Iniciar Sesion para poder Acceder</p> </center>';
				} else if ($err == 3) {
					echo ' <center><p class="mensaje-login" style="color:#fff">Usuario Desactivado</p></center>';
				}else if ($err == 4) {
					echo '<center><p class="mensaje-login" style="color:#fff">XXXXROBOTXXXX</p></center> ';
				}else if ($err == 5) {
					echo '<center><p class="mensaje-login" style="color:#fff">Sesion cerrada</p></center> ';
				}
				?>
	        </div>
	    </div>
	</div>



	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
