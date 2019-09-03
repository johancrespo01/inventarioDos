	$( "#verV" ).click(function() {
		mostrarContrasenaVIeja();
	});
	$( "#verN" ).click(function() {
		mostrarContrasenaNueva();
	});
	$( "#verVer" ).click(function() {
		mostrarContrasenaVerifica();
	});
	$( ".cambiarPass" ).click(function() {
		comprobarClave();
	});
	function comprobarClave(){
		clave1 = $("#newPass").val();
		clave2 = $("#veriPass").val();
		if (clave1 == clave2){
			$( "#form_cambiarPass" ).submit(); 
		}else{
			swal({
				title: "Oops!",
				text: "Las contraseñas no son iguales",
				icon: "warning"
			}).then((willDelete) => {
				if (willDelete) {
					$( "#newPass" ).focus();
				}
			});
		}
	}

	function mostrarContrasenaVIeja(){
		var tipo = document.getElementById("passActual");
		if(tipo.type == "password"){
			tipo.type = "text";
		}else{
			tipo.type = "password";
		}
	}
	function mostrarContrasenaNueva(){
		var tipo = document.getElementById("newPass");
		if(tipo.type == "password"){
			tipo.type = "text";
		}else{
			tipo.type = "password";
		}
	}
	function mostrarContrasenaVerifica(){
		var tipo = document.getElementById("veriPass");
		if(tipo.type == "password"){
			tipo.type = "text";
		}else{
			tipo.type = "password";
		}
	}

	$("#newPass").keydown(function (e) {
		key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz1234567890";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }


        var pass = $("#newPass").val();


    });

