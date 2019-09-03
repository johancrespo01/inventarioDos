$(document).ready(function() {
alert("leido");
	$("#btn-enviar-por-ajax").click(function(){
		alert("has dado click.."); 
		var tipo_elemento =document.getElementById("tipo_elemento").value;
		var responsableElemento = document.getElementById("responsableElemento").value;
		var nombre =document.getElementById("nombreA").value;
		var id_elemento = $("#idenElement").attr('value');
		var descripcion = document.getElementById("descripcionA").value;
		var numero_placa = $("#numero_placa").attr('value');
		var ambiente = document.getElementById("ambiente").value;
		var serial = $("#serial").attr('value');
		var Peso = $("#Peso").attr('value');
		var Ancho = $("#Ancho").attr('value');
		var Alto = $("#Alto").attr('value');
		var Largo = $("#Largo").attr('value');
		var Precio = $("#Precio").attr('value');
		var ram = $("#ram").attr('value');
		var almacenamiento = $("#almacenamiento").attr('value');
		var procesador = $("#procesador").attr('value');
		var marca = $("#marca").attr('value');
		var fecha_adquisicion = $("#fecha_adquisicion").attr('value');

		alert(nombre);
	//VALIDACION DE CAMPOS VARIANTES

	if (almacenamiento == "") {
		valor_almacenamiento = "N/A";
	}else{
		valor_almacenamiento = almacenamiento;
	}
	if (ram == "") {
		valor_ram = "N/A";
	}else{
		valor_ram = ram;
	}
	if (procesador == "") {
		valor_procesador = "N/A";
	}else{
		valor_procesador = procesador;
	}

	if (Peso == "") {
		valor_Peso = "N/A";
	}else{
		valor_Peso = Peso;
	}
	if (Ancho == "") {
		valor_Ancho = "N/A";
	}else{
		valor_Ancho = Ancho;
	}
	if (Alto == "") {
		valor_Alto = "N/A";
	}else{
		valor_Alto = Alto;
	}
	if (Largo == "") {
		valor_Largo = "N/A";
	}else{
		valor_Largo = Largo;
	}

	var arrayForm = {'tipo_elemento': tipo_elemento,
	'responsableElemento': responsableElemento,
	'nombre': nombre,
	'id_elemento': id_elemento,
	'descripcion': descripcion,
	'numero_placa': numero_placa,
	'ambiente': ambiente,
	'serial': serial,
	'Peso': valor_Peso,
	'Ancho': valor_Ancho,
	'Alto': valor_Alto,
	'Largo': valor_Largo,
	'Precio': Precio,
	'ram': valor_ram,
	'almacenamiento':valor_almacenamiento,
	'procesador': valor_procesador,
	'marca': marca,
	'fecha_adquisicion': fecha_adquisicion
};
		// alert(JSON.stringify(arrayForm, "", 2));
		// console.log(JSON.stringify(arrayForm, "", 2))
		try {
			var at = arrayForm;
			var postData = {'arreglo': at};
			var dataString = JSON.stringify(postData);
			$.ajax({
				url: '../Vista/modulos/Reportes/llamadoPorjax.php',
				data: {detalleClases: dataString},
				type: 'POST',
				success: function (datos) {
					$( "#datos" ).load( "#datos" );
					$('#exampleModal').modal('toggle'); 
					// document.getElementsByClassName('mub').setAttribute("id", "buscarExtMuebles");
					// $('.close').click(); 
				}
			});
		} catch (e) {
			alert(e.message);
		}
	});

	function enviar(){

		alert("entro a la funcion");
		// var tipoElemento = $("#tipo_elemento").attr('value');
		// var responsable = $("#responsableElemento").attr('value');
		// alert(tipoElemento);
	}
});