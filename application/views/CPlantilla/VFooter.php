<!--script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.6.0/jq-3.3.1/dt-1.11.0/af-2.3.7/b-2.0.0/cr-1.5.4/date-1.1.1/fc-3.3.3/fh-3.1.9/kt-2.6.4/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.5/sb-1.2.0/sp-1.4.0/sl-1.3.3/datatables.min.js"></script-->

<script type="text/javascript" src="<?= base_url("assets/bootstrap/js/datatables.min.js") ?>"></script>

<!--script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script-->

<script type="text/javascript" src="<?= base_url("assets/bootstrap/js/bootstrap.min.js") ?>"></script>

<!--script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script-->
<script src="<?= base_url("assets/bootstrap/js/select2.min.js") ?>"></script>

<script>
    $(document).ready(function() {
        $('#cups').select2();
    });
</script>

<!-- Script para traducir el datatable al español -->
<script>
   
    $(document).ready(function () {
        if ($.fn.DataTable.isDataTable('#example')) { return; }
        $('#example').DataTable({
            'language': {
                'sProcessing': 'Procesando...',
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
    });

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
    });

</script>
