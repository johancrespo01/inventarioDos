
function inventarioambiente(valor){

        var tipo = valor;
    var ambiente = $(".buscarMiInventario").attr("id");
     // swal({
     //        title: "Oops!",
     //        text: "ya "+ambiente+" y "+tipo,
     //        icon: "warning"
     //    });
  // alert("ya "+ambiente+" y "+tipo);
    mostrarLimitadoElementoPorIDAJAX2(ambiente,tipo);
    }

   function mostrarLimitadoElementoPorIDAJAX2(id,filtro){
    // alert("ya llego "+id+" y "+filtro);
    try {
        var dt = id;
        var at = filtro;
        var postData = {'id': dt,
        'fil':at};
        var dataString = JSON.stringify(postData);
        $.ajax({
            url: '../Vista/modulos/Ambiente/inventarioAmbientes.php',
            data: {parametro1: dataString},
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



$(document).ready(function(){

    //alert("leyo");
    $("#parametroBusquedaAmbiente").keyup(function(){
     buscarAmbiente();
 });

    $(".btnInventarios").click(function(){
        var id = $(this).attr('id');
      //   var tipo = $("#tipo_elementoI").val();
      //   if (tipo == null) {
      //     swal({
      //       title: "Oops!",
      //       text: "Seleccione el tipo de elemento",
      //       icon: "warning"
      //   });
      //     $( "#tipo_elementoI" ).focus();
      // }else{
        mostrarLimitadoElementoPorIDAJAX(id);
    // }    
});

    $(".btnEliminarE").click(function(){
     var id = $(this).attr('value');
     eliminarFranja(id);
     //llamar una funcion que realice la eliminacion
 });
    $(".btnRetrocesoDos").click(function () {
        location.reload();
    //alert("click detectado");
    var id = $(this).attr("id");
    //var id = document.getElementById('parametroBusquedaIndex').value();
   // alert(id);
   porAmbiente(id);
});

    function porAmbiente(id){
        /*alert('entra a la funcion');*/
        try {
            var dt = id;
            var postData = {'id': dt};
            var dataString = JSON.stringify(postData);
            $.ajax({
                url: '../Vista/modulos/Ambiente/tablaAmbiente.php',
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
    $(".btneditarE").click(function(){
     var id = $(this).attr('value');
     var id_ambiente = $(".valorIDoculto").attr('value');
     reportarNovedad(id,id_ambiente);
     //llamar una funcion que realice la eliminacion
 });
    $(".btneditarEmuebles").click(function(){
     var id = $(this).attr('value');
     var id_ambiente = $(".valorIDoculto").attr('value');
     reportarNovedad(id,id_ambiente);
     //llamar una funcion que realice la eliminacion
 });
    $(".btneditarEtic").click(function(){
     var id = $(this).attr('value');
     var id_ambiente = $(".valorIDoculto").attr('value');
     reportarNovedad(id,id_ambiente);
     //llamar una funcion que realice la eliminacion
 });

    $(".btneditarEuno").click(function(){
     var id = $(this).attr('value');
     var id_instructor = $(".valorIDoculto").attr('value');
     reportarNovedadU(id,id_instructor);
     //llamar una funcion que realice la eliminacion
 });


    $(".btnEliminarA").click(function(){
     var id = $(this).attr('value');
     eliminarAmbiente(id);
     //llamar una funcion que realice la eliminacion
 });

    $(".btneditarA").click(function(){
     var id = $(this).attr('value');
     editarAmbiente(id);
     //llamar una funcion que realice la eliminacion
 });


    function editarAmbiente(id_ambiente) {
        swal({
            title: "Desea editar este Ambiente ?",
            icon: "info",
            buttons: true
        }).then((willDelete) => {
            if (willDelete) {
                try {
                    var at = id_ambiente;
                    var postData = {'id_ambiente': at};
                    var dataString = JSON.stringify(postData);
                    $.ajax({
                        url: '../Vista/modulos/Ambiente/editarAmbiente.php',
                        data: {detalleClases: dataString},
                        type: 'POST',
                        success: function (datos) {
                            $("#sobre").html('<div id="solapar"></div>');
                            $("#listaContacto").html(datos);
                            $("#recarga").hide();
                            $("#recarga").fadeOut(1000);
                            $("#recarga").load(" #recarga");
                            $("#recarga").fadeIn(1000);
                        }
                    });
                } catch (e) {
                    alert(e.message);
                }
            }
        });
    }

    function reportarNovedadU(id_elemento, id_instructor) {
        swal({
            title: "Desea adicionar una novedad a este elemento ?",
            icon: "info",
            buttons: true
        }).then((willDelete) => {
            if (willDelete) {
                try {
                    var dt = id_elemento;
                    var at = id_instructor;
                    var postData = {'id': dt,
                    'id_instructor': at};
                    var dataString = JSON.stringify(postData);
                    $.ajax({
                        url: '../Vista/modulos/Ambiente/editarElemento.php',
                        data: {detalleClasesU: dataString},
                        type: 'POST',
                        success: function (datos) {
                            $("#sobre").html('<div id="solapar"></div>');
                            $("#listaContacto").html(datos);
                            $("#recarga").hide();
                            $("#recarga").fadeOut(1000);
                            $("#recarga").load(" #recarga");
                            $("#recarga").fadeIn(1000);

                        }
                    });
                } catch (e) {
                    alert(e.message);
                }
            }
        });
    }

    function reportarNovedad(id_elemento, id_ambiente) {
        swal({
            title: "Desea adicionar una novedad a este elemento ?",
            icon: "info",
            buttons: true
        }).then((willDelete) => {
            if (willDelete) {
                try {
                    var dt = id_elemento;
                    var at = id_ambiente;
                    var postData = {'id': dt,
                    'id_ambiente': at};
                    var dataString = JSON.stringify(postData);
                    $.ajax({
                        url: '../Vista/modulos/Ambiente/editarElemento.php',
                        data: {detalleClases: dataString},
                        type: 'POST',
                        success: function (datos) {
                            $("#sobre").html('<div id="solapar"></div>');
                            $("#listaContacto").html(datos);
                            $("#recarga").hide();
                            $("#recarga").fadeOut(1000);
                            $("#recarga").load(" #recarga");
                            $("#recarga").fadeIn(1000);

                        }
                    });
                } catch (e) {
                    alert(e.message);
                }
            }
        });
    }

    function eliminarAmbiente(id) {

        swal({
          title: "Desea eliminar este ambiente?",
          text: "Se eliminara el ambiente",
          icon: "warning",
          buttons: true,
          dangerMode: true
      }).then((willDelete) => {
          if (willDelete) {
            try {
                $.ajax({
                    url: '../Vista/modulos/Ambiente/eliminarAmbiente.php',
                    method: 'POST',
                    data: {'idEliminar': id},
                    cache: false,
                    success: function (resultado) {
                        if (resultado = "ok") {
                         swal("Elemento Eliminado", {
                             icon: "success",
                         });
                         $('#Elemento' + id).remove();
                     } else {
                        alert('No se ha eliminado el elemento');
                    }
                }
            });
            } catch (evt) {
                alert(evt.message);
            }

        } else {

        }
    });
  }

  function eliminarFranja(id) {

    swal({
      title: "Desea eliminar este elemento?",
      text: "Se eliminara el elemento",
      icon: "warning",
      buttons: true,
      dangerMode: true
  }).then((willDelete) => {
      if (willDelete) {
        try {
            $.ajax({
                url: '../Vista/modulos/Objeto/eliminarElemento.php',
                method: 'POST',
                data: {'idEliminar': id},
                cache: false,
                success: function (resultado) {
                    if (resultado = "ok") {
                     swal("Elemento Eliminado", {
                         icon: "success",
                     });
                     $('#Elemento' + id).remove();
                 } else {
                    alert('No se ha eliminado el elemento');
                }
            }
        });
        } catch (evt) {
            alert(evt.message);
        }

    } else {

    }
});
}



function mostrarLimitadoElementoPorIDAJAX(id){
    try {
        var dt = id;
        // var at = tipo;
        var postData = {'id': dt};
        var dataString = JSON.stringify(postData);
        $.ajax({
            url: '../Vista/modulos/Ambiente/inventarioAmbientes.php',
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





/*___________________________________________________*/
function buscarAmbiente(){
     //alert("entra a la funcion");
     var tableReg = document.getElementById('buscarExt');
     var searchText = document.getElementById('parametroBusquedaAmbiente').value.toLowerCase();
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

        function verInventario(id) {

            try {
                $.ajax({
                    url: '../Vista/modulos/Ambiente/inventarioAmbiente.php',
                    method: 'POST',
                    data: {'idAmbiente': id},
                    cache: false,
                    success: function (resultado) {
                        if (resultado = "ok") {
                            swal("Instructor Eliminado", {
                                icon: "success",
                            });
                            $('#instructor' + id).remove();
                        } else {
                            alert('No se ha eliminado el usuario');
                        }
                    }
                });
            } catch (evt) {
                alert(evt.message);
            }

        }

        
        /*___________________________________________*/





    });

