<div class="modal fade" id="modal-ver-subareas" style="overflow-y: scroll;">
    <div class="modal-dialog modal-lg" style="width:60% !important">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title" id="titulo"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="col-sm-12" style="justify-content:right;text-align:right">
                        <button id='Agregar_Subarea' class="btn btn-warning">
                            Agregar Subarea </button>
                    </div>
                    <table id="table_subareas" class="table table-responsive-md table-striped  table-condensed">
                        <thead>

                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Acción</th>

                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let table = document.querySelector('#table_subareas');
        utils.dtTable(table);

        document.querySelector('#table_subareas').addEventListener('click', e => {
            e.preventDefault();

            if (e.target.classList.contains('btn-danger') || e.target.offsetParent.classList.contains(
                    'btn-danger')) {

                var id_subarea;
                if (e.target.classList.contains('btn-danger')) {
                    id_subarea = e.target.dataset.id;
                } else {
                    id_subarea = e.target.offsetParent.dataset.id;
                }


                Swal.fire({
                    title: '¿Estás seguro de ocultar esta subarea?',
                    text: "Esta subarea no será eliminada ni afectará otros registros pero ya no estará disponible!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ocultar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {

                    if (result.value == true) {
                        console.log("entre1" + id_subarea)
                        subarea.HideSubarea(id_subarea)
                    }
                })

                $('#modal-ver-subareas').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }
        });

        document.querySelector('#Agregar_Subarea').addEventListener('click', e => {
            e.preventDefault();
            $('#modal-agregar-subarea').modal('show');

        });

    });
</script>