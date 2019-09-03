$(document).ready(function(){
	$( "#mueble" ).click(function() {
		//alert("Has dado click");
        var id = $(this).attr("value");
        cargarMueble(id);
        //document.getElementById('parametroBusquedaIndex').value = "";
	});
	$( "#herramienta" ).click(function() {
        var id = $(this).attr("value");
        cargarHerramienta(id);
       //document.getElementById('parametroBusquedaIndex').value = "";
	});$( "#tic" ).click(function() {
		//alert("click");
        var id = $(this).attr("value");
        cargarTic(id);
        //document.getElementById('parametroBusquedaIndex').value = "";
	});$( "#laboratorio" ).click(function() {
        var id = $(this).attr("value");
        cargarlaboratorio(id);
        //document.getElementById('parametroBusquedaIndex').value = "";
	});

	$( "#todosElementos" ).click(function() {
        var id = $(this).attr("value");
        cargarTodos(id);
        //document.getElementById('parametroBusquedaIndex').value = "";
	});


	function cargarTodos(id){
		/*alert('entra a la funcion');*/
		try {
			var dt = id;
			var postData = {'id': dt};
			var dataString = JSON.stringify(postData);
			$.ajax({
				url: 'Vista/modulos/categorias/todos.php',
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

	function cargarMueble(id){
		/*alert('entra a la funcion');*/
		try {
			var dt = id;
			var postData = {'id': dt};
			var dataString = JSON.stringify(postData);
			$.ajax({
				url: 'Vista/modulos/categorias/mueble.php',
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

	function cargarHerramienta(id){
		/*alert('entra a la funcion');*/
		try {
			var dt = id;
			var postData = {'id': dt};
			var dataString = JSON.stringify(postData);
			$.ajax({
				url: 'Vista/modulos/categorias/herramienta.php',
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


	function cargarTic(id){
		/*alert('entra a la funcion');*/
		try {
			var dt = id;
			var postData = {'id': dt};
			var dataString = JSON.stringify(postData);
			$.ajax({
				url: 'Vista/modulos/categorias/Tic.php',
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

	function cargarlaboratorio(id){
		/*alert('entra a la funcion');*/
		try {
			var dt = id;
			var postData = {'id': dt};
			var dataString = JSON.stringify(postData);
			$.ajax({
				url: 'Vista/modulos/categorias/laboratorio.php',
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

