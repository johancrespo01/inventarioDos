$(document).ready(function(){

$("#parametroBusquedaAprendiz").keyup(function(){
    buscarAprendiz();
});
/*___________________________________________*/

/*___________________________________________________*/
 function buscarAprendiz(){
     //alert("entra a la funcion");
            var tableReg = document.getElementById('buscarExt');
            var searchText = document.getElementById('parametroBusquedaAprendiz').value.toLowerCase();
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
});

