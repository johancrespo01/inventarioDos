$(document).ready(function(){

	$( "#madera" ).click(function() {
        var id = $(this).attr("value");
        cargarMadera(id);
        document.getElementById('parametroBusquedaIndex').value = "";
	});
	$( "#metal" ).click(function() {
        var id = $(this).attr("value");
        cargarMetal(id);
       document.getElementById('parametroBusquedaIndex').value = "";
	});$( "#electronico" ).click(function() {
        var id = $(this).attr("value");
        cargarElectronico(id);
        document.getElementById('parametroBusquedaIndex').value = "";
	});$( "#plastico" ).click(function() {
        var id = $(this).attr("value");
        cargarplastico(id);
        document.getElementById('parametroBusquedaIndex').value = "";
	});

	function cargarMadera(id){
		/*alert('entra a la funcion');*/
		try {
			var dt = id;
			var postData = {'id': dt};
			var dataString = JSON.stringify(postData);
			$.ajax({
				url: 'Vista/modulos/categorias/madera.php',
				data: {parametro: dataString},
				type: 'POST',
				success: function (datos) {
					$("#datos").html(datos);
					//$(".tablaDiseño").show();
				}
			});

		} catch (e) {
			alert(e.message);
		}
	}

	function cargarMetal(id){
		/*alert('entra a la funcion');*/
		try {
			var dt = id;
			var postData = {'id': dt};
			var dataString = JSON.stringify(postData);
			$.ajax({
				url: 'Vista/modulos/categorias/metal.php',
				data: {parametro: dataString},
				type: 'POST',
				success: function (datos) {
					$("#datos").html(datos);
					//$(".tablaDiseño").show();
				}
			});

		} catch (e) {
			alert(e.message);
		}
	}


	function cargarElectronico(id){
		/*alert('entra a la funcion');*/
		try {
			var dt = id;
			var postData = {'id': dt};
			var dataString = JSON.stringify(postData);
			$.ajax({
				url: 'Vista/modulos/categorias/electronico.php',
				data: {parametro: dataString},
				type: 'POST',
				success: function (datos) {
					$("#datos").html(datos);
					//$(".tablaDiseño").show();
				}
			});

		} catch (e) {
			alert(e.message);
		}
	}

	function cargarplastico(id){
		/*alert('entra a la funcion');*/
		try {
			var dt = id;
			var postData = {'id': dt};
			var dataString = JSON.stringify(postData);
			$.ajax({
				url: 'Vista/modulos/categorias/plastico.php',
				data: {parametro: dataString},
				type: 'POST',
				success: function (datos) {
					$("#datos").html(datos);
					//$(".tablaDiseño").show();
				}
			});

		} catch (e) {
			alert(e.message);
		}
	}


});

