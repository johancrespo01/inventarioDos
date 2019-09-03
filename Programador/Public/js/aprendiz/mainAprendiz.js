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
                        title:'Inventario SENA - Aprendices',
                        titleAttr: 'Copiar',
                        className: 'btn btn-app export barras copiar',
                        exportOptions: {
                            columns: [ 2, 3, 4, 5, 6, 7]
                        }
                    },

                    {
                        extend:    'pdfHtml5',
                        text:      '<i class="fa fa-file-pdf-o"></i>PDF',
                        title:'Inventario SENA - Aprendices',
                        titleAttr: 'PDF',
                        className: 'btn btn-app export pdf',
                        exportOptions: {
                            columns: [ 2, 3, 4, 5, 6, 7]
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
                        title:'Inventario SENA - Aprendices',
                        titleAttr: 'Excel',
                        className: 'btn btn-app export excel',
                        exportOptions: {
                            columns: [ 2, 3, 4, 5, 6, 7]
                        },
                    },
                    {
                        extend:    'csvHtml5',
                        text:      '<i class="fa fa-file-text-o"></i>CSV',
                        title:'Titulo de tabla en CSV',
                        titleAttr: 'CSV',
                        className: 'btn btn-app export csv',
                        exportOptions: {
                            columns: [ 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend:    'print',
                        text:      '<p style="font-size:0.9rem">Imprimir</p>',
                        title:'Inventario SENA - Aprendices',
                        titleAttr: 'Imprimir',
                        className: 'btn btn-app export imprimir',
                        exportOptions: {
                            columns: [ 2, 3, 4, 5, 6, 7]
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

$(".btneditar").click(function(){
      //alert("Capturando Id...");
       var id = $(this).attr('value');
       //alert("El id del aprendiz es: "+id);
       editarAprendiz(id);
     //llamar una funcion que realice la edicion
 });
$("#formadd").submit(function (e) {
        e.preventDefault();
        var self = this;
        var idCorreo = $("#correo_user").val();
        var reglaMail = /^[a-zA-Z0-9-\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
        if (!reglaMail.test(idCorreo)) {
            //$("#TEXTOE").html('ERROR');
            swal({
               title: "Oops!",
               text: "El correo digitado no es valido",
               icon: "warning"
           });
            $("#correo_user").focus();
            $("#correo_user").css('border', '2px solid  #cd6155');
            return FALSE;
        } else {
            self.submit();
        }
    });
// SOLO LETRAS
    $(".soloLetras").keydown(function (e) {
        key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
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

    });

    // SOLO NUMEROS
    $(".soloNumeros").keydown(function (e) {
        key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " 1234567890e";
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

    });

     //*************Validar numero de documento**************///

    $("#numDoc").keyup(function (e) {
        var usuario = $("#numDoc").val();
        var postData = {"existe": usuario};
        var dataString = JSON.stringify(postData);
        var pswd = $(this).val();
        //var code = e.keyCode || e.which;
        if (usuario != "") {

                if (usuario.length >= 6) {
                    $.ajax({
                        url: '../Vista/modulos/Aprendiz/comprobar_num_doc.php',
                        data: {numExi: dataString},
                        type: 'POST',
                        success: function (respuesta) {
                            if (respuesta == 0) {
                                swal({
                                   title: "Oops!",
                                   text: "Este numero de documento ya se encuantra registrado",
                                   icon: "error"
                               });
                                $("#numDoc").css('border', '2px solid  #cd6155');
                                usuarioExi = true;
                            } else {
                                $("#numDoc").css('border', '1px solid #d1d3e2');
                                usuarioExi = false;
                            }
                        }
                    });

                } else {
                    //alert("Numero de documento no valido");

                   // usuario.focus();
                }



        } else {

        }
    });

function eliminarAprendiz(id_aprendiz) {
        swal({
            title: "Desea editar este Aprendiz ?",
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

});

function editarAprendiz(id_aprendiz) {
    swal({
        title: "Desea editar este Aprendiz ?",
        icon: "info",
        buttons: true
    }).then((willDelete) => {
        if (willDelete) {
            try {
                var at = id_aprendiz;
                var postData = {'id_aprendiz': at};
                var dataString = JSON.stringify(postData);
                $.ajax({
                    url: '../Vista/modulos/Aprendiz/editarAprendiz.php',
                    data: {detalleClases: dataString},
                    type: 'POST',
                    success: function (datos) {
                        $("#listaContacto").html(datos);
                       // if (datos = "ok") {
                       //          swal("Elemento Eliminado", {
                       //              icon: "success",
                       //          });
                       //          $('#Elemento' + id_elemento).remove();
                       //      } else {
                       //          alert('No se ha eliminado el elemento');
                       //      }
                    }
                });
            } catch (e) {
                alert(e.message);
            }
        }
    });
}
