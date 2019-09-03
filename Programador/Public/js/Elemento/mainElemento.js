$(document).ready(function(){

    $("#parametroBusqueda").keyup(function(){
        var id = $("#parametroBusqueda").val().trim();
        buscarCoordinacion();
    });
    
    
    /*___________________________________________*/

    function buscarCoordinacion(){
     //alert("entra a la funcion");
            var tableReg = document.getElementById('buscarExt'); //TABLA
            var searchText = document.getElementById('parametroBusqueda').value.toLowerCase(); //INPUT
            var cellsOfRow="";
            var found=false;
            var compareWith="";

            // Recorremos todas las filas con contenido de la tabla
            for (var i = 1; i < tableReg.rows.length; i++){

                cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
                found = false;

                // Recorremos todas las celdas
                for (var j = 0; j < cellsOfRow.length && !found; j++){

                    compareWith = cellsOfRow[j].innerHTML.toLowerCase();

                    // Buscamos el texto en el contenido de la celda

                    if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1)){
                        found = true;
                    }
                }

                if(found){
                    tableReg.rows[i].style.display = '';
                } else {
                    // si no ha encontrado ninguna coincidencia, esconde la
                    // fila de la tabla
                    tableReg.rows[i].style.display = 'none';
                }
            }
 } 
           
        
/*___________________________________________*/

   $( "#tipo_elemento" ).change(function() {
      //alert( "cambio" );
      var tipoElemento = $("#tipo_elemento").val().trim();
      desactivar(tipoElemento);
    });

   function desactivar(tipoElemento){
    //var e  = document.getElementById("Rol");
    switch (tipoElemento) {
        case "2":
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
            //FIN OCULTAR DETALLES//

            break;
        case "3":
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
            //FIN OCULTAR DETALLES//
            break;
        case "4":
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
            //FIN OCULTAR DETALLES//
            break;
        case "5":
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
            break;
    }
   }
   

});


