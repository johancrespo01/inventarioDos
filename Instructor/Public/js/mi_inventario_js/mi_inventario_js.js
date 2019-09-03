function dd(valor){
    		var tipo = valor;
		var instructor = $(".buscarMiInventario").attr("id");
    $("#tipo_elementoI").val(0);
		//alert("buscar inventario de " + tipo + " del instructor " + instructor);
		buscarMiInventario(instructor,tipo);
    }

	function buscarMiInventario(id, filtro){
        //alert('entra a la funcion');
       try {
        var dt = id;
        var at = filtro;
        var postData = {'id': dt,
                        'fil':at};
         var dataString = JSON.stringify(postData);
         $.ajax({
           url: '../Vista/modulos/mi_inventario/inventarioInstructor.php',
           data: {parametro: dataString},
           type: 'POST',
           success: function (datos) {
            $("#datos_mostrar").html(datos);
                    //$(".tablaDiseño").show();
                  }
                });

       } catch (e) {
       	alert(e.message);
       }
   }

