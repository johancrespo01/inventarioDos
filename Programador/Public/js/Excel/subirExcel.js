$( "#btn_subir" ).click(function() {
		validarTipoElemento();
});

function validarTipoElemento(){
	clave1 = $("#tipoElemento").val();
		if (clave1 != "0"){
			$( "#formSubirExcel" ).submit(); 
		}else{
			swal({
				title: "Oops!",
				text: "Escoja un tipo de elemento",
				icon: "warning"
			}).then((willDelete) => {
				if (willDelete) {
					$( "#tipoElemento" ).focus();
				}
			});
		}
}