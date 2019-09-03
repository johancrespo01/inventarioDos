$(document).ready(function() {
//alert("leido");

// ESTE CODIGO SOLO FUNCIONA CON UNA CONEXION A INTERNET 
	$("#btn-enviar-por-ajax").click(function(){
		//alert("has dado click.."); 
		//var id_elementoActual = 
		var nombre =document.getElementById("nombreElemento").value;
		var id_elemento = $("#idenElement").attr('value');
		var descripcion = document.getElementById("descripcion").value;
		var ambiente = document.getElementById("id_ambiente").value;
		var numero_placa = $("#placa").attr('value');
		var serial = $("#serial").attr('value');
		var ambienteNombre = $("#nombreAmbiente").attr('value');
		var apellidoRes = $("#apellido").attr('value'); 
		var correoRes = $("#correo").attr('value'); 
		var usuario = $("#usuario").attr('value'); 
	//VALIDACION DE CAMPOS VARIANTES

		var vector = {'nombre': nombre,
						'id_elemento': id_elemento,
						'descripcion': descripcion,
						'ambiente': ambiente,
						'numero_placa': numero_placa,
						'serial': serial,
						'ambienteNombre': ambienteNombre,
						'apellidoRes': apellidoRes,
						'correoRes': correoRes,
						'usuario': usuario
		};
		// alert(JSON.stringify(vector, "", 2));
		// console.log(JSON.stringify(vector, "", 2));
		 EnviarPorAjax(vector);
	});


	function EnviarPorAjax(vector){
		// CERGANDO
		//let timerInterval
		Swal.fire({
		  title: 'Registrando su novedad!',	
		  html: 'Cargando',
		  timer: 2000,
		  onBeforeOpen: () => {
			 try {
				 var at = vector;
				 var postData = {'arreglo': at};
				 var dataString = JSON.stringify(postData);
				 $.ajax({
				 	url: '../Vista/modulos/Ambiente/novedadAjax.php',
				 	data: {detalleClases: dataString},
				 	type: 'POST',
				 	success: function (datos) {
				 	}
				 });
			 } catch (e) {
					alert(e.message);
		  	 }

		    Swal.showLoading()
		    timerInterval = setInterval(() => {
		      Swal.getContent().querySelector('strong')
		        .textContent = Swal.getTimerLeft()
		    }, 100)
		  },
		  onClose: () => {
		    clearInterval(timerInterval);
		    Swal.fire({
                      title: "Enhorabuena!",
                      text: "Novedad registrada",
                      icon: "success"
                        }).then((willDelete) => {
            if (willDelete) {
                 $("#cerrarModal").click();
                 location.reload();
		    	// window.location.reloadeplace("tablaAmbiente");
            }else{
            	 $("#cerrarModal").click();
            	 location.reload();
		    	// window.location.replace("tablaAmbiente");
            }
            });
		  }
		}).then((result) => {
		  if (
		    // Read more about handling dismissals
		    result.dismiss === Swal.DismissReason.timer
		  ) {
		    console.log('I was closed by the timer')
		  }
		});
		//FIN CARGANDO


		 

	  	 //alert("Funcion ejecutada");
	}
});