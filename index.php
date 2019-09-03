<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inventario Sena</title>
	<link rel="stylesheet" href="css/main.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">
</head>
<body>
	<div id="contenedor_carga" class="animated zoomIn">
		<div id="carga"></div>
	</div>
</body>
</html>

<script>
	function cargarPagina(){
		var contenedor = document.getElementById('contenedor_carga');
		contenedor.classList.remove('zoomIn');
		contenedor.classList.add('animated','zoomOut');
		contenedor.style.opacity = '0';
		window.location.replace("Instructor/index.php");
	}
	setTimeout(cargarPagina,2000);
</script>
<!-- 
<?php 
#header('Location: Instructor/index.php');
 ?> -->