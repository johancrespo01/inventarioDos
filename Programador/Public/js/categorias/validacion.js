$(document).ready(function() {

	//$(".btneditarE").click(function(){
		var material = $("#materialForValidacion").attr('value');
		//alert(material);
		mostrarOcultar(material);
//});

 function mostrarOcultar(material){
	 //alert("entro a la funcion");
	 if (material == 2) {
				 //alert("MUEBLES");
				//GENERALES//
				 nombre=document.getElementById("Dnombre");
				 nombre.style.display='block';
				 document.getElementById("Dnombre").value="";

				 descripcion=document.getElementById("Ddescripcion");
				 descripcion.style.display='block';
				 document.getElementById("Ddescripcion").value="";

				 serial=document.getElementById("Dserial");
				 serial.style.display='block';
				 document.getElementById("Dserial").value="";

				 placa=document.getElementById("Dplaca");
				 placa.style.display='block';
				 document.getElementById("Dplaca").value="";

				 responsable=document.getElementById("Dresponsable");
				 responsable.style.display='block';
				 document.getElementById("Dresponsable").value="";

				 ambiente=document.getElementById("Dambiente");
				 ambiente.style.display='block';
				 document.getElementById("Dambiente").value="";
				 //FIN GENERALES//

				 // MOSTRAR DETALLES//
				 alto=document.getElementById("Dalto");
				 alto.style.display='block';
				 document.getElementById("Dalto").value="";

				 largo=document.getElementById("Dlargo");
				 largo.style.display='block';
				 document.getElementById("Dlargo").value="";

				 ancho=document.getElementById("Dancho");
				 ancho.style.display='block';
				 document.getElementById("Dancho").value="";

				 peso=document.getElementById("Dpeso");
				 peso.style.display='block';
				 document.getElementById("Dpeso").value="";

				 precio=document.getElementById("Dprecio");
				 precio.style.display='block';
				 document.getElementById("Dprecio").value="";
				 //FIN MOSTRAR DETALLES//

				 //OCULTAR DETALLES//
				 ram=document.getElementById("Dram");
				 ram.style.display='none';
				 document.getElementById("Dram").value="";

				 procesador=document.getElementById("Dprocesador");
				 procesador.style.display='none';
				 document.getElementById("Dprocesador").value="";

				 almacenamiento=document.getElementById("Dalmacenamiento");
				 almacenamiento.style.display='none';
				 document.getElementById("Dalmacenamiento").value="";
	 }
	 if (material == 3) {
			 	//alert("Es tipo de material tres");
				//alert("METAL");
				//HERRAMIENTA//
				nombre=document.getElementById("Dnombre");
				nombre.style.display='block';
				document.getElementById("Dnombre").value="";

				descripcion=document.getElementById("Ddescripcion");
				descripcion.style.display='block';
				document.getElementById("Ddescripcion").value="";

				serial=document.getElementById("Dserial");
				serial.style.display='block';
				document.getElementById("Dserial").value="";

				placa=document.getElementById("Dplaca");
				placa.style.display='block';
				document.getElementById("Dplaca").value="";

				responsable=document.getElementById("Dresponsable");
				responsable.style.display='block';
				document.getElementById("Dresponsable").value="";

				ambiente=document.getElementById("Dambiente");
				ambiente.style.display='block';
				document.getElementById("Dambiente").value="";

				precio=document.getElementById("Dprecio");
				precio.style.display='block';
				document.getElementById("Dprecio").value="";
				//FIN GENERALES//

				// MOSTRAR DETALLES//
				//FIN MOSTRAR DETALLES//

			 //OCULTAR DETALLES//
				ram=document.getElementById("Dram");
				ram.style.display='none';
				document.getElementById("Dram").value="";

				procesador=document.getElementById("Dprocesador");
				procesador.style.display='none';
				document.getElementById("Dprocesador").value="";

				almacenamiento=document.getElementById("Dalmacenamiento");
				almacenamiento.style.display='none';
				document.getElementById("Dalmacenamiento").value="";
				//FIN OCULTAR DETALLES//
				//break;
	 }
	 if (material == 4) {
		 //alert("Equipos de laboratorio");
		 //GENERALES//
		 nombre=document.getElementById("Dnombre");
		 nombre.style.display='block';
		 document.getElementById("Dnombre").value="";

		 descripcion=document.getElementById("Ddescripcion");
		 descripcion.style.display='block';
		 document.getElementById("Ddescripcion").value="";

		 serial=document.getElementById("Dserial");
		 serial.style.display='block';
		 document.getElementById("Dserial").value="";

		 placa=document.getElementById("Dplaca");
		 placa.style.display='block';
		 document.getElementById("Dplaca").value="";

		 responsable=document.getElementById("Dresponsable");
		 responsable.style.display='block';
		 document.getElementById("Dresponsable").value="";

		 ambiente=document.getElementById("Dambiente");
		 ambiente.style.display='block';
		 document.getElementById("Dambiente").value="";

		 precio=document.getElementById("Dprecio");
		 precio.style.display='block';
		 document.getElementById("Dprecio").value="";
		 //FIN GENERALES//

		 // MOSTRAR DETALLES//
		 //FIN MOSTRAR DETALLES//

		//OCULTAR DETALLES//
		 ram=document.getElementById("Dram");
		 ram.style.display='none';
		 document.getElementById("Dram").value="";

		 procesador=document.getElementById("Dprocesador");
		 procesador.style.display='none';
		 document.getElementById("Dprocesador").value="";

		 almacenamiento=document.getElementById("Dalmacenamiento");
		 almacenamiento.style.display='none';
		 document.getElementById("Dalmacenamiento").value="";
		 //FIN OCULTAR DETALLES//
	 }
	 if (material == 5) {
		 //alert("TIC");
		 //GENERALES//
		 nombre=document.getElementById("Dnombre");
		 nombre.style.display='block';
		 document.getElementById("Dnombre").value="";

		 descripcion=document.getElementById("Ddescripcion");
		 descripcion.style.display='block';
		 document.getElementById("Ddescripcion").value="";

		 serial=document.getElementById("Dserial");
		 serial.style.display='block';
		 document.getElementById("Dserial").value="";

		 placa=document.getElementById("Dplaca");
		 placa.style.display='block';
		 document.getElementById("Dplaca").value="";

		 responsable=document.getElementById("Dresponsable");
		 responsable.style.display='block';
		 document.getElementById("Dresponsable").value="";

		 ambiente=document.getElementById("Dambiente");
		 ambiente.style.display='block';
		 document.getElementById("Dambiente").value="";
		 //FIN GENERALES//

		 // MOSTRAR DETALLES//

		 precio=document.getElementById("Dprecio");
		 precio.style.display='block';
		 document.getElementById("Dprecio").value="";

		 $("#defaultUncheckedU").click(function(){
					if( $('#defaultUncheckedU').is(':checked') ) {
						 $("#ram").removeAttr("readonly");
				 }else{
						 $("#ram").attr("readonly","readonly");
				 }
		 });

		 ram=document.getElementById("Dram");
		 ram.style.display='block';
		 document.getElementById("Dram").value="";

		 $("#defaultUncheckedD").click(function(){
					if( $('#defaultUncheckedD').is(':checked') ) {
						 $("#procesador").removeAttr("readonly");
				 }else{
						 $("#procesador").attr("readonly","readonly");
				 }
		 });

		 procesador=document.getElementById("Dprocesador");
		 procesador.style.display='block';
		 document.getElementById("Dprocesador").value="";

		 $("#defaultUncheckedT").click(function(){
					if( $('#defaultUncheckedT').is(':checked') ) {
						 $("#almacenamiento").removeAttr("readonly");
				 }else{
						 $("#almacenamiento").attr("readonly","readonly");
				 }
		 });

		 almacenamiento=document.getElementById("Dalmacenamiento");
		 almacenamiento.style.display='block';
		 document.getElementById("Dalmacenamiento").value="";




		 //FIN MOSTRAR DETALLES//

		 //OCULTAR DETALLES//
		 alto=document.getElementById("Dalto");
		 alto.style.display='none';
		 document.getElementById("Dalto").value="";

		 largo=document.getElementById("Dlargo");
		 largo.style.display='none';
		 document.getElementById("Dlargo").value="";

		 ancho=document.getElementById("Dancho");
		 ancho.style.display='none';
		 document.getElementById("Dancho").value="";

		 peso=document.getElementById("Dpeso");
		 peso.style.display='none';
		 document.getElementById("Dpeso").value="";
		 //FIN OCULTAR DETALLES//
	 }
				 if (material != 5 && material != 4 && material != 3 && material != 2) {
		 swal({
         title: "Hay un error en su peticion. el tipo de material esta errado, por favor comuniquise con el personal correspondiente",
         icon: "info"
			 })
	 }

 }

	//var material = $(".valorMaterial").attr('value');
	//alert(material);

});
