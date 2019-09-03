
 function instructorinventario(valor){
    var tipo = valor;
    var instructor = $(".buscarMiInventario").attr("id");
      mostrarLimitadoElementoPorIDAJAXInstructor2(instructor,tipo);
    }

    function mostrarLimitadoElementoPorIDAJAXInstructor2(id, filtro){
       // alert('entra a la funcion');
       try {
        var dt = id;
        var at = filtro;
        var postData = {'id': dt,
        'fil':at};
        var dataString = JSON.stringify(postData);
        $.ajax({
        url: '../Vista/modulos/Reportes/inventarioInstructor.php',
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

 function ambienteinventario(valor){


        var tipo = valor;
    var ambiente = $(".buscarMiInventario").attr("id");
    // alert("tipo-> " + tipo+" ambiente-> "+ambiente);
    mostrarLimitadoElementoPorIDAJAX2(ambiente,tipo);
    }

    function mostrarLimitadoElementoPorIDAJAX2(id, filtro){
       // alert('entra a la funcion');
       try {
        var dt = id;
        var at = filtro;
        var postData = {'id': dt,
        'fil':at};
        var dataString = JSON.stringify(postData);
        $.ajax({
        url: '../Vista/modulos/Reportes/inventarioAmbientes.php',
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




var idioma=

            {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "NingÃºn dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Ãšltimo",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copyTitle": 'Informacion copiada',
                    "copyKeys": 'Use your keyboard or menu to select the copy command',
                    "copySuccess": {
                        "_": '%d filas copiadas al portapapeles',
                        "1": '1 fila copiada al portapapeles'
                    },

                    "pageLength": {
                    "_": "Mostrar %d filas",
                    "-1": "Mostrar Todo"
                    }
                }
            };

  $('#buscarExt').DataTable({
   "destroy":true,
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    "lengthMenu": [[5,10,20, -1],[5,10,50,"Mostrar Todo"]],
    dom: 'Bfrt<"col-md-6 inline"i> <"col-md-6 inline"p>',


    buttons: {
          dom: {
            container:{
              tag:'div',
              className:'flexcontent'
            },
            buttonLiner: {
              tag: null
            }
          },




          buttons: [


                    {
                        extend:    'copyHtml5',
                        text:      '<p style="font-size:0.9rem">Copiar</p>',
                        title:'Inventario SENA - Ambientes',
                        titleAttr: 'Copiar',
                        className: 'btn btn-app export barras copiar',
                        exportOptions: {
                            columns: [ 1, 2 ]
                        }
                    },

                    {
                        extend:    'pdfHtml5',
                        text:      '<i class="fa fa-file-pdf-o"></i>PDF',
                        title:'Inventario SENA - Ambientes',
                        titleAttr: 'PDF',
                        className: 'btn btn-app export pdf',
                        exportOptions: {
                            columns: [ 1, 2 ]
                        },
                        customize:function(doc) {

                            doc.styles.title = {
                                color: '#4c8aa0',
                                fontSize: '30',
                                alignment: 'center'
                            }
                            doc.styles['td:nth-child(2)'] = {
                                width: '100px',
                                'max-width': '100px'
                            },
                            doc.styles.tableHeader = {
                                fillColor:'#4c8aa0',
                                color:'white',
                                alignment:'center'
                            },
                            doc.content[1].margin = [ 100, 0, 100, 0 ]

                        }

                    },

                    {
                        extend:    'excelHtml5',
                        text:      '<i class="fa fa-file-excel-o"></i>Excel',
                        title:'Inventario SENA - Ambientes',
                        titleAttr: 'Excel',
                        className: 'btn btn-app export excel',
                        exportOptions: {
                            columns: [ 0, 1 ]
                        },
                    },
                    {
                        extend:    'csvHtml5',
                        text:      '<i class="fa fa-file-text-o"></i>CSV',
                        title:'Inventario SENA - Ambientes',
                        titleAttr: 'CSV',
                        className: 'btn btn-app export csv',
                        exportOptions: {
                            columns: [ 0, 1 ]
                        }
                    },
                    {
                        extend:    'print',
                        text:      '<p style="font-size:0.9rem">Imprimir</p>',
                        title:'Inventario SENA - Ambientes',
                        titleAttr: 'Imprimir',
                        className: 'btn btn-app export imprimir',
                        exportOptions: {
                            columns: [ 1, 2 ]
                        }
                    },
                    {
                        extend:    'pageLength',
                        titleAttr: 'Registros a mostrar',
                        className: 'selectTable'
                    }
                ]

          }

    });
  // alert("leido...");
  $("#instructor").click(function () {
    var id = $(this).attr("value");
    porInstructor(id);
    document.getElementById('parametroBusquedaIndex').value = "";
  });

  $("#por_ambiente").click(function () {
    //alert("click detectado");
    var id = $(this).attr("value");
    cargarPorAmbiente(id);
    document.getElementById('parametroBusquedaIndex').value = "";
  });

  $(".btnRetrocesoUno").click(function () {
    //alert("click detectado");
    var id = $(this).attr("id");
    //var id = document.getElementById('parametroBusquedaIndex').value();
   // alert(id);
   cargarPorAmbiente(id);
 });

  $(".btnRetrocesoDos").click(function () {
    //alert("click detectado");
    var id = $(this).attr("id");
    //var id = document.getElementById('parametroBusquedaIndex').value();
   // alert(id);
   porInstructor(id);
 });


  $("#electronico").click(function () {
    var id = $(this).attr("value");
    cargarElectronico(id);
    document.getElementById('parametroBusquedaIndex').value = "";
  });

  $("#plastico").click(function () {
    var id = $(this).attr("value");
    cargarplastico(id);
    document.getElementById('parametroBusquedaIndex').value = "";
  });

  $(".btnInventariosAmbiente").click(function () {
    //alert("Click detectado");
    var id = $(this).attr('id');
    // var filtro = $("#tipo_elemento").val();
    // if (filtro == null) {
    //  swal({
    //    title: "Oops!",
    //    text: "Seleccione el tipo de elemento",
    //    icon: "warning"
    //  });
    //  $( "#tipo_elemento" ).focus();
    // }else{
      mostrarLimitadoElementoPorIDAJAX(id);


  });

  $(".btnInventariosInstructor").click(function () {
     //alert("Click detectado");
     var id = $(this).attr('id');
    //  var filtro = $("#tipo_elementoI").val();
    //  if (filtro == null) {
    //   swal({
    //     title: "Oops!",
    //     text: "Seleccione el tipo de elemento",
    //     icon: "warning"
    //   });
    //   $( "#tipo_elementoI" ).focus();
    // }else{
      mostrarLimitadoElementoPorIDAJAXInstructor(id);

  });

  function porInstructor(id){
    /*alert('entra a la funcion');*/
    try {
     var dt = id;
     var postData = {'id': dt};
     var dataString = JSON.stringify(postData);
     $.ajax({
      url: '../Vista/modulos/Reportes/por_instructor.php',
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

 function cargarMetal(id){
  /*alert('entra a la funcion');*/
  try {
   var dt = id;
   var postData = {'id': dt};
   var dataString = JSON.stringify(postData);
   $.ajax({
    url: 'Vista/modulos/categorias/metal.php',
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

function mostrarLimitadoElementoPorIDAJAX(id){
       // alert('entra a la funcion '+id);
       try {
        var dt = id;
        // var at = filtro;
        var postData = {'id': dt};
        var dataString = JSON.stringify(postData);
        $.ajax({
         url: '../Vista/modulos/Reportes/inventarioAmbientes.php',
         data: {parametro3: dataString},
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



    function mostrarLimitadoElementoPorIDAJAXInstructor(id){
       // alert('entra a la funcion');
       try {
        var dt = id;

        var postData = {'id': dt};
        var dataString = JSON.stringify(postData);
        $.ajax({
         url: '../Vista/modulos/Reportes/inventarioInstructor.php',
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



    function cargarPorAmbiente(id){
        //alert('entra a la funcion');
        try {
          var dt = id;
          var postData = {'id': dt};
          var dataString = JSON.stringify(postData);
          $.ajax({
            url: '../Vista/modulos/Reportes/por_ambientes.php',
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

      function cargarplastico(id){
       /*alert('entra a la funcion');*/
       try {
        var dt = id;
        var postData = {'id': dt};
        var dataString = JSON.stringify(postData);
        $.ajax({
         url: 'Vista/modulos/categorias/plastico.php',
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

  // });
