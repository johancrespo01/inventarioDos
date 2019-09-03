$(document).ready(function() {

    var table = $('#tablaHerramienta').DataTable({
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
    title:'Inventario SENA - Herramientas',
    titleAttr: 'Copiar',
    className: 'btn btn-app export barras copiar',
    exportOptions: {
        columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
    }
},

{
    extend:    'pdfHtml5',
    text:      '<i class="fa fa-file-pdf-o"></i>PDF',
    title:'Inventario SENA - Herramientas',
    titleAttr: 'PDF',
    className: 'btn btn-app export pdf',
    exportOptions: {
        columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
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
    title:'Inventario SENA - Herramientas',
    titleAttr: 'Excel',
    className: 'btn btn-app export excel',
    exportOptions: {
        columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
    },
},
{
    extend:    'csvHtml5',
    text:      '<i class="fa fa-file-text-o"></i>CSV',
    title:'Inventario SENA - Herramientas',
    titleAttr: 'CSV',
    className: 'btn btn-app export csv',
    exportOptions: {
        columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
    }
},
{
    extend:    'print',
    text:      '<p style="font-size:0.9rem">Imprimir</p>',
    title:'Inventario SENA - Herramientas',
    titleAttr: 'Imprimir',
    className: 'btn btn-app export imprimir',
    exportOptions: {
        columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
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

    $(".btnEliminarE").click(function(){
        // alert("realizar accion");
      var id = $(this).attr('value');
      eliminarAmbiente(id);
     //llamar una funcion que realice la eliminacion
 });

    $(".btneditarE").click(function(){
        // alert("realizar accion");
      var id = $(this).attr('value');
      var material = $(".valorMaterial").attr('value');
      //alert(material);
      editarElemento(id, material);
     //llamar una funcion que realice la eliminacion
 });

function editarElemento(id_elemento, material) {
        swal({
            title: "Desea editar este Objeto ?",
            icon: "info",
            buttons: true
        }).then((willDelete) => {
            if (willDelete) {
                try {
                    var at = id_elemento;
                    var ma = material;
                    var postData = {'id_elemento': at,
                                    'material': ma};
                    var dataString = JSON.stringify(postData);
                    $.ajax({
                        url: 'Vista/modulos/Ambiente/editarELemento.php',
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