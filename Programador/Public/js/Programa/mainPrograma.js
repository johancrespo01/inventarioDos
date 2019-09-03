var idioma=

            {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningun dato disponible en esta tabla",
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
                    "sLast":     "Ultimo",
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

$(document).ready(function() {


  var table = $('#buscarExt').DataTable( {
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
                        title:'Inventario SENA - Programas',
                        titleAttr: 'Copiar',
                        className: 'btn btn-app export barras copiar',
                        exportOptions: {
                            columns: [ 2, 3 ]
                        }
                    },

                    {
                        extend:    'pdfHtml5',
                        text:      '<i class="fa fa-file-pdf-o"></i>PDF',
                        title:'Inventario SENA - Programas',
                        titleAttr: 'PDF',
                        className: 'btn btn-app export pdf',
                        exportOptions: {
                            columns: [ 2, 3 ]
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
                        title:'Inventario SENA - Programas',
                        titleAttr: 'Excel',
                        className: 'btn btn-app export excel',
                        exportOptions: {
                            columns: [ 2, 3 ]
                        },
                    },
                    {
                        extend:    'csvHtml5',
                        text:      '<i class="fa fa-file-text-o"></i>CSV',
                        title:'Inventario SENA - Programas',
                        titleAttr: 'CSV',
                        className: 'btn btn-app export csv',
                        exportOptions: {
                            columns: [ 2, 3 ]
                        }
                    },
                    {
                        extend:    'print',
                        text:      '<p style="font-size:0.9rem">Imprimir</p>',
                        title:'Inventario SENA - Programas',
                        titleAttr: 'Imprimir',
                        className: 'btn btn-app export imprimir',
                        exportOptions: {
                            columns: [ 2, 3 ]
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

  $(".btneditar").click(function () {
    //alert("leyendo.. click");
    var id = $(this).attr("value");
    editarPrograma(id);
    //alert(id);
 });

  function editarPrograma(id){
    swal({
            title: "Desea editar el Programa ?",
            icon: "info",
            buttons: true
        }).then((willDelete) => {
            if (willDelete) {
                try {
                    var at = id;
                    var postData = {'id_Programa': at};
                    var dataString = JSON.stringify(postData);
                    $.ajax({
                        url: '../Vista/modulos/Programa/editarPrograma.php',
                        data: {detalleClases: dataString},
                        type: 'POST',
                        success: function (datos) {
                            $("#listaContacto").html(datos);
                        }
                    });
                } catch (e) {
                    alert(e.message);
                }
            }
        });
  }


  $(".btnEliminar").click(function () {
   // alert("leyendo.. click");
    var id = $(this).attr("value");
    eliminarPrograma(id);
 });

  function eliminarPrograma(id){
    swal({
            title: "Desea eliminar el Programa ?",
            icon: "info",
            buttons: true
        }).then((willDelete) => {
            if (willDelete) {
                try {
                    var at = id;
                    var postData = {'id_Programa': at};
                    var dataString = JSON.stringify(postData);
                    $.ajax({
                        url: '../Vista/modulos/Programa/eliminarPrograma.php',
                        data: {detalleClases: dataString},
                        type: 'POST',
                        success: function (datos) {
                            if (resultado = "ok") {
                                 swal("Programa Eliminado", {
                                 icon: "success",
                                });
                                    $('#Programa' + id).remove();
                                } else {
                                    alert('No se ha eliminado el Programa');
                                }
                        }
                    });
                } catch (e) {
                    alert(e.message);
                }
            }
        });
  }

});
